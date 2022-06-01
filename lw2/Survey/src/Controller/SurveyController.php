<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\Survey\InterfaceSurveyService;

class SurveyController extends AbstractController
{
    private InterfaceSurveyService $action;

    public function __construct(InterfaceSurveyService $action)
    {
        $this->action = $action;
    }

    public function saveSurvey(): Response
    {
            return $this->render('save.html.twig',  $this->action->saveSurvey());
    }

    public function loadSurvey(): Response
    {
        return $this->render('view.html.twig', [ 'load' => $this->action->loadSurvey() ]);
    }

}