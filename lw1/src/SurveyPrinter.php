<?php
class SurveyPrinter
{


    private const END_OF_LINE = "\n";
    private const PARAGRAF_FIRST_NAME = 'First Name: ';
    private const PARAGRAF_LAST_NAME = 'Last Name: ';
    private const PARAGRAF_AGE = 'Age: ';
    private const PARAGRAF_EMAIL = 'Email: ';

    public function printSurvey(Survey $survey) : void
    {

        echo self::PARAGRAF_FIRST_NAME . $survey->getFirstName() . self::END_OF_LINE;
        echo self::PARAGRAF_LAST_NAME . $survey->getLastName() . self::END_OF_LINE;
        echo self::PARAGRAF_AGE . $survey->getAge() . self::END_OF_LINE;
        echo self::PARAGRAF_EMAIL . $survey->getEmail() . self::END_OF_LINE;
    }
}