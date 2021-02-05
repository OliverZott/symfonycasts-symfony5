<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class QuestionController extends AbstractController
{

    /**
     * @param Environment $twigEnvironment
     * @return Response
     * @Route("/", name="app_homepage")
     */
    public function homepage(Environment $twigEnvironment): Response
    {
        try {
            $html = $twigEnvironment->render('question/homepage.html.twig');
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
        }

        return new Response($html);
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
