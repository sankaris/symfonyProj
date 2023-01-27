<?php

namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Project;
 

class ProjecttController extends AbstractController
{
    /**
     * @Route("/projectt", name="app_projectt")
     */
    public function index(): Response{
        return $this->render('projectt/index.html.twig', [
            'controller_name' => 'ProjecttController',
        ]);
    }

    /**
     * @Route("/projectt/show-all",name="projectt_show_all",methods={"GET"})
     */
    public function showAll(): Response{
        $projects = $this->getDoctrine()->getRepository(Project::class)->findAll();
        $data = [];
        foreach($projects as $project){
           $data[] = [
              'id' => $project->getId(),
              'name' => $project->getName(),
              'description' => $project->getDescription(),
           ];
        }
        return $this->json($data);
    }

    /**
     * @Route("/projectt/show/{id}",name="project_show",methods={"GET"})
     */
    public function show(int $id):Response{
        $project = $this->getDoctrine()->getRepository(Project::class)->find($id);
        $data = [];
        if(!$project){
            return $this->json("No project found");
        }
        $data = [
            'id' => $project->getId(),
            'name' => $project->getName(),
            'description' => $project->getDescription(),
        ];
        return $this->json($data);
    }

    /**
     * @Route("/projectt/new", name="projectt_new", methods={"POST"})
     */
    public function new(Request $request): Response{
        $entityManager = $this->getDoctrine()->getManager();
        $project = new Project();
        $project->setName($request->request->get('name'));
        $project->setDescription($request->request->get('description'));
        $entityManager->persist($project);
        $entityManager->flush();
        return $this->json('Created new project successfully with id ' . $project->getId());
    }   

    /**
     * @Route("/projectt/edit/{id}", name="projectt_edit", methods={"PUT"})
     */
    public function edit(Request $request, int $id): Response{
        $entityManager = $this->getDoctrine()->getManager();
        $project = $entityManager->getRepository(Project::class)->find($id);
        if (!$project) {
            return $this->json('No project found for id' . $id, 404);
        }
        $project->setName($request->request->get('name'));
        $project->setDescription($request->request->get('description'));
        $entityManager->flush();
        $data =  [
            'id' => $project->getId(),
            'name' => $project->getName(),
            'description' => $project->getDescription(),
        ];
        return $this->json($data);
    }

    /**
     * @Route("/projectt/delete/{id}", name="projectt_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response{
        $entityManager = $this->getDoctrine()->getManager();
        $project = $entityManager->getRepository(Project::class)->find($id);
        if (!$project) {
        return $this->json('No project found for id' . $id, 404);
        }
        $entityManager->remove($project);
        $entityManager->flush();
        return $this->json('Deleted a project successfully with id ' . $id);
    }
}
