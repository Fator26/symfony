<?php
require_once('./src/common.inc.php');

$request = new RequestSurveyLoader();
$print = new SurveyPrinter();
$fileStorage = new SurveyFileStorage();
$survey = $request->getQueryStringParameter();
$print->printSurvey($survey);
$fileStorage->saveSurvey($survey);
$data = $fileStorage->loadSurvey($survey);
$print->printSurvey($data);