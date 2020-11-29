<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/project")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="project_index", methods={"GET"})
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('project/index.html.twig', [
            'projects' => $projectRepository->findBy(
                array('isArchived'=> false), 
                array('scheduleDate' => 'DESC'),
            )
        ]);
    }

    /**
     * @Route("/archive", name="project_archive", methods={"GET"})
     */
    public function archive(ProjectRepository $projectRepository): Response
    {
        return $this->render('project/archive.html.twig', [
            'projects' => $projectRepository->findBy(
                array('isArchived'=> true), 
                array('scheduleDate' => 'DESC'),
            )
        ]);
    }

    /**
     * @Route("/new", name="project_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $project = new Project();
        $project->setScheduleDate(new \DateTime());
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $project->setState('A faire');
            $project->setOpenDate(new \DateTime());
            $project->setIsArchived(false);
            $project->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('project_index');
        }

        return $this->render('project/new.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="project_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Project $project): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($project->getState('Fini') && empty($project->getCloseDate()))
                $project->setCloseDate(new \DateTime());
            else
                $project->setCloseDate(null);
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect(
                $this->generateUrl('project_edit', [
                    'id' => $project->getId(),
                ])                    
            );
        }

        return $this->render('project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="project_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Project $project): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('project_index');
    }

    /**
     * @Route("/{id}", name="project_archiv", methods={"ARCHIV"})
     */
    public function archiv(Request $request, Project $project): Response
    {
        if ($this->isCsrfTokenValid('archiv'.$project->getId(), $request->request->get('_token'))) {

            $project->setIsArchived(true);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('project_index');
    }

    /**
     * @Route("/{id}", name="project_activate", methods={"ACTIVATE"})
     */
    public function activate(Request $request, Project $project): Response
    {
        if ($this->isCsrfTokenValid('activate'.$project->getId(), $request->request->get('_token'))) {

            $project->setIsArchived(false);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('project_index');
    }
}
