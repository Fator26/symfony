<?php

namespace App\Module\Survey;

use App\Module\Survey\Survey;

class SurveyFileStorage
{
    private const FILE_EXTENSION = 'txt';
    private const END_OF_LINE = PHP_EOL;
    private const PARAGRAF_FIRST_NAME = 'First name';
    private const PARAGRAF_LAST_NAME = 'Last name';
    private const PARAGRAF_EMAIL = 'Email';
    private const PARAGRAF_AGE = 'Age';
    private const SEPARATOR = ': ';
    private const DATA_DIR = 'data/';
    private string $fullPath;

    private function getFullPath(Survey $survey): string
    {
        return self::DATA_DIR . $survey->getEmail() . '.' . self::FILE_EXTENSION;
    }

    private function makeArrayFromFile(): array
    {
        $userTempArr =  explode(self::END_OF_LINE, file_get_contents($this->fullPath));
        $returnedArr = [];
        for ($i = 0; $i < sizeof($userTempArr); ++$i)
        {
            $pair = explode(self::SEPARATOR, $userTempArr[$i]);
            if (sizeof($pair) > 1)
            {
                $returnedArr[$pair[0]] = $pair[1];
            }
            else
            {
                $returnedArr[$pair[0]] = '';
            }
        }
        return $returnedArr;
    }

    private function makeStringToSave(Survey $survey, Survey $prevSurvey): string
    {
        $resString = '';
        $values = [
            self::PARAGRAF_FIRST_NAME => $survey->getFirstName() !== '' ? $survey->getFirstName() : $prevSurvey->getFirstName(),
            self::PARAGRAF_LAST_NAME => $survey->getLastName() !== '' ? $survey->getLastName() : $prevSurvey->getLastName(),
            self::PARAGRAF_AGE => $survey->getAge() !== '' ? $survey->getAge() : $prevSurvey->getAge(),
            self::PARAGRAF_EMAIL => $survey->getEmail() !== '' ? $survey->getEmail() : $prevSurvey->getEmail(),
        ];
        foreach (array_keys($values) as $key)
        {
            $resString .= $key . self::SEPARATOR . $values[$key] . self::END_OF_LINE;
        }
        return $resString;
    }

    public function loadSurvey(Survey $survey): Survey
    {
        $this->fullPath = $this->getFullPath($survey);
        if (!file_exists($this->fullPath))
        {
            return new Survey(null, null, null, null);
        }

        $userData = $this->makeArrayFromFile();
        return new Survey($userData[self::PARAGRAF_FIRST_NAME], $userData[self::PARAGRAF_LAST_NAME], $userData[self::PARAGRAF_EMAIL], $userData[self::PARAGRAF_AGE]);
    }

    public function saveSurvey(Survey $survey): bool
    {
        $this->fullPath = $this->getFullPath($survey);
        $email = $survey->getEmail();
        if ($email == null)
        {
            return false;
        }
        $prevSurvey = $this->loadSurvey($survey);
        $text = $this->makeStringToSave($survey, $prevSurvey);
        return (bool) file_put_contents($this->fullPath, $text);
    }


}
