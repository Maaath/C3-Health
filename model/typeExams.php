<?php

class typeExams
{

    public $id;
    public $name;

    function getAllExams()
    {
        $xml = simplexml_load_file('./../public/files/type_exams.xml');

        if ($xml === false) {
            echo "Falha ao Carregar o XML: ";
            foreach (libxml_get_errors() as $error) {

                echo "<br>", $error->message;
            }
        } else {
            return $xml;
        }
    }

    function getExam($id)
    {
        $file = './../public/files/type_exams.xml';

        $exams = simplexml_load_file($file);

        foreach ($exams->exam as $e) {
            if ($e->id == $id) {
                return $e;
            }
        }
    }
}
