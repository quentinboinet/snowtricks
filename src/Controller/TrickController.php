<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentFormType;
use App\Form\TrickAddFormType;
use App\Form\TrickEditFormType;
use App\Repository\TrickRepository;
use App\Service\FileUploader;
use App\Service\MediaAdder;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Filesystem\Filesystem;
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
            $tricks = '';
        }

        return $this->render('home.html.twig', ['tricks' => $tricks]);
    }

    /**
     * @Route("/loadMore", name="get_more_tricks", methods={"POST"})
     */
    public function getMoreTricks(Request $request, TrickRepository $trickRepository)
    {
        if ($request->isXmlHttpRequest()) {
            $tricks = $trickRepository->showMoreTricks($request->request->get('offset'));

            $arrayCollection = [];
            foreach ($tricks as $trick) {
                $pictures = $trick->getPictures();
                if (0 != count($pictures)) {
                    //on récupère la première image associée à ce trick (image de couverture)
                    $picturePath = $pictures->first()->getPath();
                } else {
                    $picturePath = '';
                }

                $arrayCollection[] = [
                    'id' => $trick->getId(),
                    'name' => $trick->getName(),
                    'pictures' => $picturePath,
                ];
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

        if (!empty($trick)) {
            $comment = new Comment();
            $form = $this->createForm(CommentFormType::class, $comment);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $comment->setPublishedAt(new \DateTime());
                $comment->setUser($this->getUser());
                $comment->setTrick($trick);

                $em->persist($comment);
                $em->flush();

                $this->addFlash('success', 'Votre commentaire a bien été ajouté !');

                return $this->render('tricks/trickView.html.twig', ['trick' => $trick, 'commentForm' => $this->createForm(CommentFormType::class, new Comment())->createView()]);
            } else {
                return $this->render('tricks/trickView.html.twig', ['trick' => $trick, 'commentForm' => $form->createView()]);
            }
        } else {
            //renvoyer un message d'erreur pour dire que la figure n'existe pas
            return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
        }
    }

    /**
     * @Route("/tricks/add", name="trick_add")
     * @IsGranted("ROLE_USER")
     */
    public function trick_add(EntityManagerInterface $em, Request $request, MediaAdder $mediaAdder)
    {
        $trick = new Trick();
        $form = $this->createForm(TrickAddFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pictures = $trick->getPictures();
            $videos = $trick->getVideos();

            $mediaAdder->addMedias($pictures, $videos, $trick);

            $trick->setSlug(strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $trick->getName()), '-')));
            $trick->setPublishedAt(new \DateTime());
            $trick->setUpdatedAt(new \DateTime());
            $trick->setAuthorName($this->getUser());

            $em->persist($trick);
            $em->flush();

            $this->addFlash('success', 'La figure a bien été publiée ! Vous pouvez la retrouver ci-dessous.');

            return $this->redirectToRoute('home_page');
        } else {
            return $this->render('tricks/trickAdd.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/tricks/{trickId}/edit", name="trick_edit")
     * @IsGranted("ROLE_USER")
     */
    public function trick_edit($trickId, EntityManagerInterface $em, Request $request, FileUploader $fileUploader)
    {
        $trickRepo = $em->getRepository(Trick::class);
        $trick = $trickRepo->find($trickId);

        $categoryRepo = $em->getRepository(Category::class);
        $category = $categoryRepo->findAll();

        $originalPictures = new ArrayCollection();
        // Create an ArrayCollection of the current pictures objects in the database
        foreach ($trick->getPictures() as $picture) {
            $originalPictures->add($picture);
        }
        $originalVideos = new ArrayCollection();
        // Create an ArrayCollection of the current videos objects in the database
        foreach ($trick->getVideos() as $video) {
            $originalVideos->add($video);
        }

        $form = $this->createForm(TrickEditFormType::class, $trick, ['method' => 'PATCH']);
        $form->handleRequest($request);

        $fileSystem = new Filesystem();

        if ($form->isSubmitted() && $form->isValid()) {
            $pictures = $trick->getPictures();
            $videos = $trick->getVideos();

            foreach ($pictures as $picture) {
                if (null != $picture->getFile()) {
                    if (null !== $picture->getPath()) { //si c'est une modification d'image, alors d'abord on supprime l'ancienne du serveur
                        $fileSystem = new Filesystem();
                        $fileName = $this->getParameter('kernel.project_dir').'/public'.$picture->getPath();
                        $fileSystem->remove($fileName);
                    }
                    $fileName = $fileUploader->upload($picture->getFile());
                    $picture->setPath('/images/uploads/'.$fileName);
                } elseif (null === $picture->getFile() && false !== strpos($picture->getAlt(), '#TO_DELETE#')) { //c'est que c'est une image à supprimer
                    //on la supprime du serveur
                    $fileName = $this->getParameter('kernel.project_dir').'/public'.$picture->getPath();
                    $fileSystem->remove($fileName);
                    //et de la bdd
                    $em->remove($picture);
                }
            }
            foreach ($originalPictures as $picture) {
                if (false === $pictures->contains($picture)) {
                    $trick->addPicture($picture);
                }
            }

            foreach ($videos as $video) {
                if (null == $video->getUrl() || false !== strpos($video->getUrl(), '#TO_DELETE#')) {
                    $em->remove($video);
                }
            }
            foreach ($originalVideos as $video) {
                if (false === $videos->contains($video)) {
                    $trick->addVideo($video);
                }
            }

            $trick->setUpdatedAt(new \DateTime());
            $trick->setAuthorName($this->getUser());

            $em->flush();

            $this->addFlash('success', 'La figure a bien été modifiée ! Vous pouvez la retrouver ci-dessous.');

            return $this->redirectToRoute('trick_view', ['trickId' => $trick->getId()]);
        } else {
            if (!empty($trick)) {
                return $this->render('tricks/trickEdit.html.twig', ['form' => $form->createView(), 'trick' => $trick, 'categories' => $category, 'error' => '']);
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
    public function trick_delete($trickId, EntityManagerInterface $em)
    {
        $trickRepo = $em->getRepository(Trick::class);
        $trick = $trickRepo->find($trickId);

        if (!empty($trick)) {
            //on supprime les images (du serveur)
            $picturesAssociated = $trick->getPictures();
            $fileSystem = new Filesystem();
            foreach ($picturesAssociated as $picture) {
                //on la supprime du serveur
                $fileName = $this->getParameter('kernel.project_dir').'/public'.$picture->getPath();
                $fileSystem->remove($fileName);
            }

            $em->remove($trick);
            $em->flush();

            $tricks = $trickRepo->findBy([], ['updatedAt' => 'DESC'], 15); //On récupère les 15 derniers tricks
            $this->addFlash('warning', 'La figure a bien été supprimée !');

            return $this->redirectToRoute('home_page', ['tricks' => $tricks]);
        } else {
            //renvoyer un message d'erreur pour dire que la figure n'existe pas
            return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
        }
    }
}
