<?php


namespace App\Controller;


use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
                    'date' => $comment->getPublishedAt(),
                    'author' => $comment->getUser(),
                    'content' => $comment->getContent(),
                );
            }
            return new JsonResponse($arrayCollection);
        }
    }
}