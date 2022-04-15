<?php
header("Content-Type: text/plain");

class SurveyFileStorage
{
    private const END_OF_LINE = PHP_EOL;
    private const PARAGRAF_FIRST_NAME = 'First name';
    private const PARAGRAF_LAST_NAME = 'Last name';
    private const PARAGRAF_EMAIL = 'Email';
    private const PARAGRAF_AGE = 'Age';
    private const SEPARATOR = ': ';
    private const DATA_DIR = 'data/';
    private string $fullPath;

    public function loadSurvey(Survey $survey) : Survey
    {
        $this->fullPath = self::DATA_DIR . $survey->getEmail() . '.txt';
        if (file_exists($this->fullPath))
        {
            $userData = $this->makeArrayFromFile();
            return new Survey($userData[self::PARAGRAF_FIRST_NAME], $userData[self::PARAGRAF_LAST_NAME], $userData[self::PARAGRAF_EMAIL], $userData[self::PARAGRAF_AGE]);
        }
        return new Survey();
    }

    public function saveSurvey(Survey $survey) : void
    {
        $this->fullPath = self::DATA_DIR . $survey->getEmail() . '.txt';
        $email = $survey->getEmail();
        if (!is_dir(self::DATA_DIR))
        {
            mkdir(self::DATA_DIR);
        }
        if ($email !== '')
        {
            $prevSurvey = $this->loadSurvey($survey);
            $text = $this->makeStringToSave($survey, $prevSurvey);
            if (file_put_contents($this->fullPath, $text))
            {
                echo self::END_OF_LINE. "Save complited sucsessful" . self::END_OF_LINE ;
            }
            else
            {
                echo self::END_OF_LINE . "Saved ERROR!!!!" . self::END_OF_LINE;
            }
        }
    }

    private function makeArrayFromFile() : array
    {
        $userTempArr =  explode(self::END_OF_LINE, file_get_contents($this->fullPath));
        $returnedArr = [];
        for ($i = 0; $i < sizeof($userTempArr); $i++)
        {
            $pair = explode(self::SEPARATOR, $userTempArr[$i]);
            $returnedArr[$pair[0]] = $pair[1];
        }
        return $returnedArr;
    }

    private function makeStringToSave(Survey $survey, Survey $prevSurvey) : string
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
}
