<?php
header("Content-Type: text/plain");

class RequestSurveyLoader
{
    public function getQueryStringParameter(): Survey
    {
        return new Survey($_GET['first_name'] ?? '',
            $_GET['last_name'] ?? '',
            $_GET['email'] ?? '',
            $_GET['age'] ?? '' );
    }
}