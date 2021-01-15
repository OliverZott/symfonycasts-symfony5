<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController
{

    /**
     * @return Response
     * @Route("/")
     */
    public function homepage(): Response
    {
        return new Response('First Controller test :)');
    }

    /**
     * @param string $input
     * @return Response
     * @Route("/questions/{input}")
     */
    public function show(string $input): Response
    {
        return new Response(sprintf(
            'Here is question: "%s".', ucwords(str_replace("-", " ", $input))
        ));
    }
}
