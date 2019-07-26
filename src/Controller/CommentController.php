<?php


namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\Video;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/loadMoreComments", name="get_more_comments")
     */
    public function getMoreComments(Request $request, CommentRepository $commentRepository) {
        if ($request->isXmlHttpRequest())
        {
            $comments = $commentRepository->showMoreComments($request->request->get('offset'), $request->request->get('trickId'));
            $arrayCollection = array();
            foreach($comments as $comment) {
                $arrayCollection[] = array(
                    'date' => $comment->getPublishedAt()->format('Y-m-d H:i:s'),
                    'author' => $comment->getUser()->getUsername(),
                    'content' => $comment->getContent(),
                );
            }
            return new JsonResponse($arrayCollection);
        }
    }

    /**
     * @Route("/comments/{commentId}/delete", name="delete_comment")
     */
    public function deleteComment($commentId, EntityManagerInterface $em) {

        $commentRepo = $em->getRepository(Comment::class);
        $comment = $commentRepo->find($commentId);

        if (!empty($comment)) {

            $trickRepo = $em->getRepository(Trick::class);

            $trickId = $comment->getTrick()->getId();
            $trick = $trickRepo->find($trickId);
            $trick->removeComment($comment);
            $em->remove($comment);
            $em->flush();

            $this->addFlash('success', 'Le commentaire a bien été supprimé !');
            return $this->redirectToRoute('trick_view', array('trickId' => $trickId));

        } else {
            //renvoyer un message d'erreur pour dire que la figure n'existe pas
            return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
        }

    }
}