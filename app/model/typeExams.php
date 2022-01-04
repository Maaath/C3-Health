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

        $return = array();

        foreach ($result as $key => $value) {
            $return[] = array((string)$value['_id'] => $value['name']);
        }

        return $return;
    }

    function getExam($id)
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $exams = $client->Health->exams;

        $id = new MongoDB\BSON\ObjectId($id);

        $result = $exams->findOne(array('_id' => $id));

        return $result;
    }
}
