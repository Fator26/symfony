<?php
header("Content-Type: text/plain");

class Survey
{
    private $first_Name;
    private $last_Name;
    private $email;
    private $age;

    function __construct($first_Name = "", $last_Name = "", $email = "", $age = "")
    {
        $this -> first_Name = $first_Name;
        $this -> last_Name = $last_Name;
        $this -> email = $email;
        $this -> age = $age;
    }

    public function getDataArray() {
        return [
            "First Name" => $this -> first_Name,
            "Last Name" => $this -> last_Name,
            "Email" => $this -> email,
            "Age" => $this -> age,
        ];
    }
}

class RequestSurveyLoader
{
    public function getQueryStringParameter()
    {
        return new Survey(isset($_GET["first_name"]) ? $_GET["first_name"] : null,
                          isset($_GET["last_name"]) ? $_GET["last_name"] : null,
                          isset($_GET["email"]) ? $_GET["email"] : null,
                          isset($_GET["age"]) ? $_GET["age"] : null);
    }
}

class SurveyFileStorage
{
    private string $fullPath = "";
    private array $lines;

    function getParameterFromLines($lines, $parameterIndex) {
        $line = trim($lines[$parameterIndex], "\r\n");
        return substr($line, strpos($line, ":") + 2);
    }

    function Load()
    {
        $email = isset($_GET['email']) ? $_GET['email'] : getParameterFromLines($lines, 1);
        $this -> fullPath = 'data/' . $email . '.txt';
        echo $this -> fullPath . "\r\n";
        if (file_exists($this -> fullPath))
        {
            $firstName = isset($_GET['first_name']) ? $_GET['first_name'] : getParameterFromLines($lines, 0);
            $lastName = isset($_GET['last_name']) ? $_GET['last_name'] : getParameterFromLines($lines, 1);
            $age = isset($_GET['age']) ? $_GET['age'] : getParameterFromLines($lines, 3);
            $outEmail = "Email: $email" . "\r\n";
            $outFirstName = "First name: " . $firstName . "\r\n";
            $outLastName = "Last name: " . $lastName . "\r\n";
            $outAge = "Age: " . $age . "\r\n";
        }
        $data = ($outFirstName .  $outLastName . $outEmail  . $outAge);
        $file = fopen($this -> fullPath, 'w+');
        fwrite($file, $data);
        fclose($file);

        if ($this -> fullPath)
                echo "Saved successful: $this->fullPath";
            else
                echo "Saved ERROR. Check spelling email";
    }
}

class SurveyPrinter
{
    function printUserData($data)
    {
        foreach ($data as $key => $value)
        {
            echo "$key: $value\r\n";
        }
    }

}


$requestsurveyloader = new RequestSurveyLoader();
$dataFromUrl = $requestsurveyloader -> getQueryStringParameter();
$userData = $dataFromUrl -> getDataArray();

$surveyprinter = new SurveyPrinter();
$surveyprinter -> printUserData($userData);

if (!is_dir("data"))
{
    mkdir("data");
}
$surveyfilestorage = new SurveyFileStorage();
$createfile = $surveyfilestorage -> Load($userData);