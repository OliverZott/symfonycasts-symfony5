<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{

    /**
     * @return Response
     * @Route("/")
     */
    public function homepage(): Response
    {
        return $this->render('question/homepage.html.twig');
    }

    /**
     * @param string $input
     * @return Response
     * @Route("/questions/{input}")
     */
    public function show(string $input): Response
    {
        $answers = ['First Answer', 'Second Answer', 'Third Answer', 'Fourth Answer'];

        $questionDetail = [
            'Detailed answer to question 1',
            'Detailed answer to question 2',
            'Detailed answer to question 3',
            'Detailed answer to question 4'
        ];

        $detailedAnswers = array_combine($answers, $questionDetail);

        dump($detailedAnswers, $this);

        return $this->render(
            'question/show.html.twig',
            [
                'question' => ucwords(str_replace('-', ' ', $input)),
                'answers' => $answers,
                'detailedAnswers' => $detailedAnswers,
            ],
        );
    }
}
