<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * First API Endpoint example; returning json string
 *
 * Class CommentController
 * @package App\Controller
 */
class CommentController extends AbstractController
{

    /**
     * @Route("/comments/{id}/vote/{direction}")
     * @param string $id
     * @param string $direction
     * @return Response
     */
    public function commentVote(string $id, string $direction): Response
    {
        // todo: use id for db query

        if ($direction === 'up') {
            $currentVoteCount = rand(7, 100);
        } else {
            $currentVoteCount = rand(0, 5);
        }

        // Option 1:
        // return new Response(json_encode($currentVoteCount), 200, ['content-type' => 'application/json']);

        // Option 2: automatically makes json_encode on given data AND sets content-type to "application/json"
        //return new JsonResponse(['vote' => $currentVoteCount]);

        // Option 3: lazy version / uses serializer if object passed
        return $this->json(['vote' => $currentVoteCount]);
    }

}
