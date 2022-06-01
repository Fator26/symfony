<?php

namespace App\Service\Survey;

use App\Module\Survey\Survey;

interface InterfaceSurveyService
{

    public function saveSurvey(): array;
    public function loadSurvey(): array;
}