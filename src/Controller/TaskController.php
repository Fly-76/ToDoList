<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/task")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class TaskController extends AbstractController
{
    /**
     * @Route("/new/{id}", name="task_new", methods={"GET","POST"})
     */
    public function new(Request $request, Project $project): Response
    {
        $task = new Task();
        $task->setScheduleDate(new \DateTime());
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setState('A faire');
            $task->setOpenDate(new \DateTime());
            $task->setProject($project);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirect(
                $this->generateUrl('project_edit', [
                    'id' => $project->getId(),
                ])                    
            );
        }

        return $this->render('task/new.html.twig', [
            'task' => $task,
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="task_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Task $task): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        $project = $task->getProject();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect(
                $this->generateUrl('project_edit', [
                    'id' => $project->getId(),
                ])                    
            );
        }

        return $this->render('task/edit.html.twig', [
            'task' => $task,
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="task_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Task $task): Response
    {
        $project = $task->getProject();

        if ($this->isCsrfTokenValid('delete'.$task->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($task);
            $entityManager->flush();
        }

        return $this->redirect(
            $this->generateUrl('project_edit', [
                'id' => $project->getId(),
            ])                    
        );
    }
}
