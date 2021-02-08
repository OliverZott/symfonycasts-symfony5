<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

class QuestionController extends AbstractController
{

    /**
     * @return Response
     * @Route("/", name="app_homepage")
     */
    public function homepage(): Response
    {
        return $this->render('question/homepage.html.twig');
    }

    /**
     * @param string $input
     * @param CacheInterface $cache
     * @return Response
     * @throws \Psr\Cache\InvalidArgumentException
     * @Route("/questions/{input}")
     */
    public function show(string $input, CacheInterface $cache): Response
    {
        $answers = ['First Answer', 'Second Answer', 'Third Answer', 'Fourth Answer'];

        $questionDetail = [
            'Detailed answer to question 1',
            'Detailed answer to question 2',
            'Detailed answer to question 3',
            'Detailed answer to question 4'
        ];

        $questionText = "I've been turned into a cat, any thoughts on how to turn back? While I'm adorable, I don't really care for cat food.";
        $parsedQuestionText = $cache->get(
            'markdown_' . md5($questionText),
            function () use ($questionText) {
                return 'PARSED: ' . $questionText;
            }
        );


        $questionText2 = 'I\'ve been turned into a cat, any thoughts on how to turn back? While I\'m **adorable**, I don\'t really care for cat food.';
        $parsedQuestionText2 = $cache->get('markdown_'.md5($questionText), function() use ($questionText) {
            return strtoupper($questionText);
        });


        $detailedAnswers = array_combine($answers, $questionDetail);

        dump($detailedAnswers, $this);

        return $this->render(
            'question/show.html.twig',
            [
                'question' => ucwords(str_replace('-', ' ', $input)),
                'questionText' => $parsedQuestionText2,
                'answers' => $answers,
                'detailedAnswers' => $detailedAnswers,
            ],
        );
    }
}
