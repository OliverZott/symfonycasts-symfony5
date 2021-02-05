<?php


namespace App\Controller;


use Psr\Log\LoggerInterface;
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
     * @Route("/comments/{id<\d+>}/vote/{direction<up|down>}", methods={"POST", "GET"})
     * @param string $id
     * @param string $direction
     * @param LoggerInterface $logger
     * @return Response
     */
    public function commentVote(string $id, string $direction, LoggerInterface $logger): Response
    {
        // todo: use id for db query

        if ($direction === 'up') {
            $logger->info('Voting up!');
            $currentVoteCount = rand(7, 100);
        } else {
            $logger->info('Voting down!');
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
