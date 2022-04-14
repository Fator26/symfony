<?php
header("Content-Type: text/plain");

class SurveyFileStorage
{
    private const END_OF_LINE = "\n";
    private const PARAGRAF_FIRST_NAME = 'First name: ';
    private const PARAGRAF_LAST_NAME = 'Last name: ';
    private const PARAGRAF_EMAIL = 'Email: ';
    private const PARAGRAF_AGE = 'Age: ';
    private const DATA_DIR = 'data/';
    private string $fullPath = "";

    public function loadSurvey(Survey $survey) : Survey
    {
        $this->fullPath = self::DATA_DIR . $survey->getEmail() . '.txt';

        if (file_exists($this->fullPath))
        {
            $dataFile = fopen($this->fullPath, 'r');
            if ($dataFile)
            {
                $userData = $this->makeStringsFromFile($dataFile);
                fclose($dataFile);
                return new Survey($userData[self::PARAGRAF_FIRST_NAME], $userData[self::PARAGRAF_LAST_NAME], $userData[self::PARAGRAF_EMAIL], $userData[self::PARAGRAF_AGE]);
            }
        }
        return new Survey();
    }

    public function saveSurvey(Survey $survey) : void
    {
        $email = $survey->getEmail();
        if (!is_dir(self::DATA_DIR))
        {
            mkdir(self::DATA_DIR);
        }
        if ($email !== '') {
            $path = self::DATA_DIR . $email . '.txt';
            $prevSurvey = $this->loadSurvey($survey);
            $text = $this->makeStringToSave($survey, $prevSurvey);
            if (file_put_contents($path, $text))
            {
                echo END_OF_LINE. "Save complited sucsessful" . END_OF_LINE;
            }
            else
            {
                echo END_OF_LINE . "Save complited sucsessful" . END_OF_LINE;
            }
        }
    }

    private function makeStringsFromFile($dataFile) : array
    {
        $arr = file($dataFile);
        $returnedArray= [];
        foreach ($arr as $line)
        {

            $pair = explode(':', line);
            $returnedArray[$pair[0]] = $pair[1];
        }
        return $returnedArray;
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
            $resString .= $key . $values[$key] . self::END_OF_LINE;
        }
        return $resString;
    }
}
