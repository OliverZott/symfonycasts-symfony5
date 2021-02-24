<?php


namespace App\Controller;


use App\Service\MarkdownHelper;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @param MarkdownHelper $markdownHelper
     * @return Response
     * @throws InvalidArgumentException
     * @Route("/questions/{input}")
     */
    public function show(string $input, MarkdownHelper $markdownHelper): Response
    {
        $answers = ['First Answer', 'Second Answer', 'Third Answer', 'Fourth Answer'];

        $questionDetail = [
            'Detailed answer to question 1',
            'Detailed answer to question 2',
            'Detailed answer to question 3',
            'Detailed answer to question 4'
        ];

        $questionText = "I've been turned into a cat, any thoughts on how to turn back? While I'm adorable, I don't really care for cat food.";
        $parsedQuestionText = $markdownHelper->parse($questionText);

        // check in cross-hair in debug toolbar (cache.adapter from dev/prod env)
        // dump($cache);

        $detailedAnswers = array_combine($answers, $questionDetail);

        return $this->render(
            'question/show.html.twig',
            [
                'question' => ucwords(str_replace('-', ' ', $input)),
                'questionText' => $parsedQuestionText,
                'answers' => $answers,
                'detailedAnswers' => $detailedAnswers,
            ],
        );
    }
}
