<?php


namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Trick;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
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
}