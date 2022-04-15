<?php
class SurveyPrinter
{


    private const END_OF_LINE = PHP_EOL ;
    private const PARAGRAF_FIRST_NAME = 'First Name';
    private const PARAGRAF_LAST_NAME = 'Last Name';
    private const PARAGRAF_AGE = 'Age';
    private const PARAGRAF_EMAIL = 'Email';
    private const SEPARATOR = ': ';


    public function printSurvey(Survey $survey) : void
    {

        echo self::PARAGRAF_FIRST_NAME . self::SEPARATOR . $survey->getFirstName() . self::END_OF_LINE;
        echo self::PARAGRAF_LAST_NAME . self::SEPARATOR . $survey->getLastName() . self::END_OF_LINE;
        echo self::PARAGRAF_AGE . self::SEPARATOR . $survey->getAge() . self::END_OF_LINE;
        echo self::PARAGRAF_EMAIL . self::SEPARATOR . $survey->getEmail() . self::END_OF_LINE;
    }
}