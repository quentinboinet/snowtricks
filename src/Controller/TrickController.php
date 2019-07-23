<?php


namespace App\Controller;


use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\Video;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class TrickController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function home(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Trick::class);
        $tricks = $repository->findBy([], ['updatedAt' => 'DESC'], 15); //On récupère les 15 derniers tricks

        if (!$tricks) {
            $tricks = "";
        }
        return $this->render('home.html.twig', ['tricks' => $tricks]);
    }

    /**
     * @Route("/loadMore", name="get_more_tricks", methods={"POST"})
     */
    public function getMoreTricks(Request $request, TrickRepository $trickRepository)
    {
        if ($request->isXmlHttpRequest())
        {
            $tricks = $trickRepository->showMoreTricks($request->request->get('offset'));

            $arrayCollection = array();
            foreach($tricks as $trick) {
                $pictures = $trick->getPictures();
                if (count($pictures) != 0) {
                    $i=0;
                    foreach ($pictures as $picture) {
                        if ($i==0) { $picturePath = $picture->getPath(); } //on récupère la première image associée à ce trick (image de couverture)
                        $i++;
                    }
                } else {$picturePath = ""; }

                $arrayCollection[] = array(
                    'id' => $trick->getId(),
                    'name' => $trick->getName(),
                    'pictures' => $picturePath,
                );
            }
            return new JsonResponse($arrayCollection);
        }
    }

    /**
     * @Route("/tricks/{trickId}/view", name="trick_view")
     */
    public function viewOneTrick($trickId, EntityManagerInterface $em, Request $request, Security $security)
    {
        $trickRepo = $em->getRepository(Trick::class);
        $trick = $trickRepo->find($trickId);
        if (!empty($trick))
        {
            if ($request->isMethod('POST'))//si on ajoute un commentaie
            {
                //on vérifie que user connecté pour avoir le droit d'ajouter un commentaire
                if ($security->getUser() !== null) {
                    if ($request->request->get('comment') !== null) {
                        $comment = new Comment();
                        $comment->setPublishedAt(new \DateTime());
                        $comment->setContent($request->request->get('comment'));
                        $comment->setTrick($trick);
                        $comment->setUser($security->getUser());

                        $em->persist($comment);
                        $em->flush();

                        $this->addFlash('success', 'Votre commentaire a bien été ajouté !');
                        return $this->render('tricks/trickView.html.twig', ['trick' => $trick]);
                    }
                    else {
                        $this->addFlash('fail', 'Vous ne pouvez pas ajouter un commentaire vide !');
                        return $this->render('tricks/trickView.html.twig', ['trick' => $trick]);
                    }
                }
                else {
                    $this->addFlash('fail', 'Vous devez être connecté pour ajouter un commentaire sur les figures.');
                    return $this->render('tricks/trickView.html.twig', ['trick' => $trick]);
                }
            }
            else {
                    return $this->render('tricks/trickView.html.twig', ['trick' => $trick]);
                }

        }
        else {
            //renvoyer un message d'erreur pour dire que la figure n'existe pas
            return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
        }
    }

    /**
     * @Route("/tricks/add", name="trick_add")
     * @IsGranted("ROLE_USER")
     */
    public function trick_add(EntityManagerInterface $em, Request $request, Security $security)
    {
        $categoryRepo = $em->getRepository(Category::class);
        $category = $categoryRepo->findAll();

        if ($request->isMethod('POST')) {

            //on vérifie qu'il n'y a pas de figure avec ce nom enregistré
            $trickRepo = $em->getRepository(Trick::class);
            $trick = $trickRepo->findOneBy(array('name' => $request->request->get('name')));

            if (is_null($trick)) {
                $trick = new Trick();
                $trick->setName($request->request->get('name'));
                $trick->setSlug(strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->request->get('name')), '-')));
                $trick->setDescription($request->request->get('description'));
                $trick->setPublishedAt(new \DateTime());
                $trick->setUpdatedAt(new \DateTime());
                $trick->setAuthorName($security->getUser());


                $nbImages = $request->request->get('pictureNb');

                //on boucle pour uploader toutes les images
                for ($i = 1; $i <= $nbImages; $i++) {
                    $pictureField = 'picture' . $i;
                    if (!empty($request->files->get($pictureField))) {
                        /** @var UploadedFile $uploadedFile */
                        $uploadedFile = $request->files->get($pictureField);
                        if ($uploadedFile->isValid() AND $uploadedFile->getSize() <= 2097152) {
                            if ($uploadedFile->guessExtension() == "jpg" OR $uploadedFile->guessExtension() == "jpeg" OR $uploadedFile->guessExtension() == "png" OR $uploadedFile->guessExtension() == "gif") {
                                $destination = $this->getParameter('kernel.project_dir') . '/public/images/uploads';
                                $newFilename = uniqid() . '.' . $uploadedFile->guessExtension();
                                $uploadedFile->move($destination, $newFilename);

                                $picture = new Picture();
                                $picture->setPath('/images/uploads/' . $newFilename);
                                $em->persist($picture);

                                $trick->addPicture($picture);
                            } else {
                                return $this->render('tricks/trickAdd.html.twig', ['categories' => $category, 'error' => 'Seules les images au format .jpg, .jpeg, .png et .gif sont autorisées.']);
                            }
                        } else {
                            return $this->render('tricks/trickAdd.html.twig', ['categories' => $category, 'error' => 'Image trop lourde ! (max. 2Mo autorisé)']);
                        }
                    }
                }

                $nbVideos = $request->request->get('videoNb');
                //on boucle pour enregistrer toutes les videos
                for ($i = 1; $i <= $nbVideos; $i++) {
                    if (!empty($request->request->get('video' . $i))) {
                        $videoURL = $request->request->get('video' . $i);
                        $video = new Video();
                        $video->setUrl($videoURL);
                        $em->persist($video);

                        $trick->addVideo($video);
                    }
                }

                $trickCategory = $em->getRepository(Category::class)->find($request->request->get('category'));
                $trick->setCategory($trickCategory);

                $em->persist($trick);
                $em->flush();

                $this->addFlash('success', 'La figure a bien été insérée dans notre base de données ! Vous pouvez la retrouver ci-dessous.');
                return $this->redirectToRoute('home_page');
            }
            else {
                return $this->render('tricks/trickAdd.html.twig', ['categories' => $category, 'error' => 'Une figure possède déjà ce nom ! Veuillez en choisir un autre.']);
            }
        }
        else {
            return $this->render('tricks/trickAdd.html.twig', ['categories' => $category, 'error' => '']);
        }
    }

    /**
     * @Route("/tricks/{trickId}/edit", name="trick_edit")
     * @IsGranted("ROLE_USER")
     */
    public function trick_edit($trickId, EntityManagerInterface $em)
    {
        $trickRepo = $em->getRepository(Trick::class);
        $trick = $trickRepo->find($trickId);

        $categoryRepo = $em->getRepository(Category::class);
        $category = $categoryRepo->findAll();

        if (!empty($trick)) {
            return $this->render('tricks/trickEdit.html.twig', ['trick' => $trick, 'categories' =>$category, 'error' => '']);
        }
        else {
            //renvoyer un message d'erreur pour dire que la figure n'existe pas
            return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
        }
    }
}