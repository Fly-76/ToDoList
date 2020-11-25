<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("IS_AUTHENTICATED_FULLY")
*/
class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Route("/main", name="main")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('project_index');
    }
}
