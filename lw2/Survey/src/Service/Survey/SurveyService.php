<?php

namespace App\Service\Survey;

use App\Module\Survey\SurveyFileStorage;
use App\Module\Survey\RequestSurveyLoader;

class SurveyService implements InterfaceSurveyService
{
    private RequestSurveyLoader $requestSurveyLoader;
    private SurveyFileStorage $surveyFileStorage;

    public function __construct(RequestSurveyLoader $requestSurveyLoader, surveyFileStorage $surveyFileStorage)
    {
        $this->requestSurveyLoader = $requestSurveyLoader;
        $this->surveyFileStorage = $surveyFileStorage;
    }

    public function saveSurvey(): array
    {
        $survey = $this->requestSurveyLoader->getQueryStringParameter();
        if ($survey->getEmail() != null) {
            $isSaved = $this->surveyFileStorage->saveSurvey($survey);
            if ($isSaved)
            {
                $survey = $this->surveyFileStorage->loadSurvey($survey);
                return [
                    'saveResult' => 'Save sucsessful',
                    'firstname'    => $survey->getFirstName(),
                    'lastname' => $survey->getLastName(),
                    'email' => $survey->getEmail(),
                    'age' => $survey->getAge(),
                ];
            }
        }
        return ['saveResult' => 'Error!'];

    }
    public function loadSurvey(): array
    {
        $survey = $this->requestSurveyLoader->getQueryStringParameter();
        if ($survey->getEmail() !== '' && $survey->getEmail() !== null)
        {
            $survey = $this->surveyFileStorage->loadSurvey($survey);
            return [
                'firstname'    => $survey->getFirstName(),
                'lastname' => $survey->getLastName(),
                'email' => $survey->getEmail(),
                'age' => $survey->getAge(),
            ];
        }
        return ['email' => null,];
    }
}