<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Project;
use Knp\Component\Pager\PaginatorInterface;

class PaginationController extends AbstractController{
    /**
     * @Route("/pagination", name="app_pagination")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response{
        $em = $this->getDoctrine()->getManager();
        $projectRepository = $em->getRepository(Project::class);
        $projectQuery = $projectRepository->createQueryBuilder('p')->getquery();
        $projects = $paginator->paginate(
                        $projectQuery,
                        $request->query->getInt('page',1),5
                    );
        return $this->render('pagination/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}
