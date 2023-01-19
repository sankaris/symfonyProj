<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Contracts\Cache\CacheInterface;

class QuestionController extends AbstractController
{

    /**
     * @Route("/{page<\d+>}", name="app_homepage")
     */
    /*public function homepage(QuestionRepository $repository, int $page = 1)
    {
        /*$queryBuilder = $repository->createAskedOrderedByNewestQueryBuilder();
        $pagerfanta = new Pagerfanta(new QueryAdapter($queryBuilder));
        $pagerfanta->setMaxPerPage(5);
        $pagerfanta->setCurrentPage($page);
        return $this->render('question/homepage.html.twig', [
            'pager' => $pagerfanta,
        ]);*/
        /*return new Response("Successfully viewing the logged in page");
    }*/

    /**
     * @Route("/questions/{slug}",name="app_question_show")
     */
    public function show($slug,MarkdownParserInterface $markdownParser,CacheInterface $cache)
    {
        $questionText = 'I\'ve been turned into a cat, any *thoughts* on how to turn back? While I\'m **adorable**, I don\'t really care for cat food.';
        //$parsedQuestionText = $markdownParser->transformMarkdown($questionText);
        $parsedQuestionText = $cache->get('markdown_'.md5($questionText), function() use ($questionText, $markdownParser) {
            return $markdownParser->transformMarkdown($questionText);
        });
        $answers = [
            'Make sure your cat is sitting `purrrfectly` still ?',
            'Honestly, I like furry shoes better than MY cat',
            'Maybe... try saying the spell backwards?',
        ];
        return $this->render('question/show.html.twig', [
            'question' => ucwords(str_replace('-', ' ', $slug)),
            'questionText' => $parsedQuestionText,
            'answers' => $answers,
        ]);
        dd($markdownParser);
    }
}
