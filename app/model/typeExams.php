<?php

require '../../vendor/autoload.php';

class typeExams
{

    public $id;
    public $name;

    function getAllExams()
    {        
        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");
        
        $exams = $client->Health->exams;

        $result = $exams->find();

        return $result;
        
        // $xml = simplexml_load_file('./../../public/files/type_exams.xml');

        // if ($xml === false) {
        //     echo "Falha ao Carregar o XML: ";
        //     foreach (libxml_get_errors() as $error) {

        //         echo "<br>", $error->message;
        //     }
        // } else {
        //     return $xml;
        // }
    }

    function getExam($id)
    {
        
        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");
        
        $exams = $client->Health->exams;

        $id = new MongoDB\BSON\ObjectId($id);

        $result = $exams->findOne(array('_id' => $id));

        return $result;

        // var_dump($result);die;
        
        // foreach ($result as $res) {
        //     echo $res['name'] . '<br>';
        // }
        // die;
        // echo $id;
        // $file = './../../public/files/type_exams.xml';

        // $exams = simplexml_load_file($file);

        // foreach ($exams->exam as $e) {
        //     if ($e->id == $id) {
        //         var_dump($e);die;
        //         return $e;
        //     }
        // }
    }
}
