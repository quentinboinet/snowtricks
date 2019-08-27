<?php


namespace App\Controller;


use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\Video;
use App\Repository\TrickRepository;
use App\Service\MediaEditer;
use App\Service\MediaRemover;
use App\Service\MediaUploader;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Filesystem\Filesystem;
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
    public function trick_add(EntityManagerInterface $em, Request $request, Security $security, MediaUploader $uploader)
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

                //on appelle le service uploader pour uploader toutes les images
                $nbImages = $request->request->get('pictureNb');
                $result = $uploader->picturesUpload('add', $nbImages, $request, $trick, $category);
                if ($result == "tooHeavy") {
                    return $this->render('tricks/trickAdd.html.twig', ['trick' => $trick, 'categories' => $category, 'error' => 'Image trop lourde ! (max. 2Mo autorisé)']);
                }
                elseif ($result == "wrongFormat") {
                    return $this->render('tricks/trickAdd.html.twig', ['trick' => $trick, 'categories' => $category, 'error' => 'Seules les images au format .jpg, .jpeg, .png et .gif sont autorisées.']);
                }

                //on appelle le service uploader pour uploader toutes les vidéos
                $nbVideos = $request->request->get('videoNb');
                $uploader->videosUpload('add', $nbVideos, $request, $trick);

                $trickCategory = $em->getRepository(Category::class)->find($request->request->get('category'));
                $trick->setCategory($trickCategory);

                $em->persist($trick);
                $em->flush();

                $this->addFlash('success', 'La figure a bien été publiée ! Vous pouvez la retrouver ci-dessous.');
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
    public function trick_edit($trickId, EntityManagerInterface $em, Request $request, Security $security, MediaUploader $uploader, MediaRemover $mediaRemover, MediaEditer $mediaEditer)
    {
        $trickRepo = $em->getRepository(Trick::class);
        $trick = $trickRepo->find($trickId);

        $categoryRepo = $em->getRepository(Category::class);
        $category = $categoryRepo->findAll();

        if ($request->isMethod('POST')) {

            $tricks = $trickRepo->findOneBy(['name' => $request->request->get('name')]);
            if ($tricks == "" OR $tricks->getId() == $trickId)//si il y a une figure avec le même nom (celle-ci) ou aucune
            {
                //on commence par supprimer les images
                $picturesToDelete = explode("-", $request->request->get('picturesToDelete'));
                $nbrePicturesToDelete = count($picturesToDelete);
                $pictureRepo = $em->getRepository(Picture::class);
                $mediaRemover->picturesRemove($nbrePicturesToDelete, $picturesToDelete, $pictureRepo, $trick);

                // puis on supprime les vidéos
                $videosToDelete = explode("-", $request->request->get('videosToDelete'));
                $nbreVideosToDelete = count($videosToDelete);
                $videoRepo = $em->getRepository(Video::class);
                $mediaRemover->videosRemove($nbreVideosToDelete, $videosToDelete, $videoRepo, $trick);

                $picturesToEdit = explode("-", $request->request->get('picturesToEdit'));
                $nbrePicturesToEdit = count($picturesToEdit);

                //puis on édite les images (upload des nouvelles, maj de bdd et suppression des anciennes sur le serveur
                $nbImages = $request->request->get('pictureNb');
                $result = $mediaEditer->picturesEdit($nbrePicturesToEdit, $picturesToEdit, $request, $pictureRepo, $trick, $category);
                if ($result == "tooHeavy") {
                    return $this->render('tricks/trickEdit.html.twig', ['trick' => $trick, 'categories' => $category, 'error' => 'Image trop lourde ! (max. 2Mo autorisé)']);
                }
                elseif ($result == "wrongFormat") {
                    return $this->render('tricks/trickEdit.html.twig', ['trick' => $trick, 'categories' => $category, 'error' => 'Seules les images au format .jpg, .jpeg, .png et .gif sont autorisées.']);
                }

                //puis on édite les vidéos (maj de BDD)
                $videosToEdit = explode("-", $request->request->get('videosToEdit'));
                $nbreVideosToEdit = count($videosToEdit);
                $mediaEditer->videosEdit($nbreVideosToEdit, $videosToEdit, $request, $videoRepo, $trick);

                //on upload les nouvelles images
                //on appelle le service uploader pour uploader toutes les images
                $nbNouvellesImages = $request->request->get('pictureAddNb');
                $result = $uploader->picturesUpload('edit', $nbNouvellesImages, $request, $trick, $category);
                if ($result == "tooHeavy") {
                    return $this->render('tricks/trickEdit.html.twig', ['trick' => $trick, 'categories' => $category, 'error' => 'Image trop lourde ! (max. 2Mo autorisé)']);
                }
                elseif ($result == "wrongFormat") {
                    return $this->render('tricks/trickEdit.html.twig', ['trick' => $trick, 'categories' => $category, 'error' => 'Seules les images au format .jpg, .jpeg, .png et .gif sont autorisées.']);
                }

                //on ajoute les nouvelles vidéos, en passant par le service uploader
                $nbVideos = $request->request->get('videoAddNb');
                $uploader->videosUpload('edit', $nbVideos, $request, $trick);

                $trick->setName($request->request->get('name'));
                $trick->setSlug(strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->request->get('name')), '-')));
                $trick->setDescription($request->request->get('description'));
                $trick->setUpdatedAt(new \DateTime());
                $trick->setAuthorName($security->getUser());

                $trickCategory = $em->getRepository(Category::class)->find($request->request->get('category'));
                $trick->setCategory($trickCategory);

                $em->persist($trick);
                $em->flush();

                $this->addFlash('success', 'La figure a bien été mise à jour ! Vous pouvez la retrouver ci-dessous.');
                return $this->redirectToRoute('trick_view', array('trickId' => $trickId));
            }
            else {
                return $this->render('tricks/trickEdit.html.twig', ['trick' => $trick, 'categories' => $category, 'error' => 'Une figure avec ce nom existe déjà ! Veuillez en choisir un autre.']);
            }
        }
        else {
            if (!empty($trick)) {
                return $this->render('tricks/trickEdit.html.twig', ['trick' => $trick, 'categories' => $category, 'error' => '']);
            } else {
                //renvoyer un message d'erreur pour dire que la figure n'existe pas
                return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
            }
        }
    }


    /**
     * @Route("/tricks/{trickId}/delete", name="trick_delete")
     * @IsGranted("ROLE_USER")
     */
    public function trick_delete($trickId, EntityManagerInterface $em) {

        $trickRepo = $em->getRepository(Trick::class);
        $trick = $trickRepo->find($trickId);

        if (!empty($trick)) {

            $pictureRepo = $em->getRepository(Picture::class);
            $videoRepo = $em->getRepository(Video::class);
            $commentsRepo = $em->getRepository(Comment::class);

            //on supprime les commentaires associés
            $commentsAssociated = $commentsRepo->findBy(['trick' => $trickId]);
            foreach ($commentsAssociated as $comment)
            {
                $em->remove($comment);
            }

            //on supprime les images (en bdd + du serveur)
            $picturesAssociated = $trick->getPictures();
            $fileSystem = new Filesystem();
            foreach ($picturesAssociated as $picture)
            {
                //on la supprime du serveur
                $fileName = $this->getParameter('kernel.project_dir') . '/public' . $picture->getPath();
                $fileSystem->remove($fileName);

                //et de la bdd
                $em->remove($picture);
            }

            //on supprime les vidéos (bdd)
            $videosAssociated = $trick->getVideos();
            foreach ($videosAssociated as $video)
            {
                $em->remove($video);
            }

            $em->remove($trick);
            $em->flush();

            $tricks = $trickRepo->findBy([], ['updatedAt' => 'DESC'], 15); //On récupère les 15 derniers tricks
            $this->addFlash('warning', 'La figure a bien été supprimée !');
            return $this->redirectToRoute('home_page', array('tricks' => $tricks));

        } else {
            //renvoyer un message d'erreur pour dire que la figure n'existe pas
            return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
        }
    }
}