<?php

namespace App\Module\Survey;

use App\Module\Survey\Survey;

class RequestSurveyLoader
{
    public function getQueryStringParameter(): Survey
    {
        return new Survey($_GET['first_name'] ?? null,
            $_GET['last_name'] ?? null,
            $_GET['email'] ?? null,
            $_GET['age'] ?? null);
    }
}