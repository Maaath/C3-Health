<?php
require('../model/examsRecords.php');
class examsRecordsController extends examsRecords
{

    public function init()
    {
    }

    public function index()
    {
        $exams = new examsRecords();
        $recs = $exams->getAllExams();
        print_r($recs);
    }

    public function store($params)
    {
        $exams = new examsRecords();

        $data = array(
            'date' => $params['date'],
            'laboratory' => $params['laboratory'],
            'patient' => $params['patient'],
            'exam' => $params['exam'],
            'result' => $params['result'],
        );

        $exams->insertExam($data);
    }

    public function edit($params)
    {

        $exams = new examsRecords();

        $data = array(
            'date' => $params['date'],
            'laboratory' => $params['laboratory'],
            'patient' => $params['patient'],
            'exam' => $params['exam'],
            'result' => $params['result'],
        );

        $exams->editExam($data);
    }

    public function show($data)
    {
        $exams = new examsRecords();

        $rec = $exams->getOneExam($data);
        var_dump($rec);
    }
}

// $exams_controller = new examsRecordsController();

// $params = array(
//     'date' => '15-06-2021',
//     'laboratory' => '66.666.666/0001-66',
//     'patient' => '333.111.222-44',
//     'exam' => '2',
//     'result' => 'positivo',
// );

// $Exams->store($params);

// $params = array(
//     'date' => '15-06-2021',
//     'laboratory' => '66.666.666/0001-66',
//     'patient' => '333.111.222-44',
//     'exam' => '1',
//     'result' => 'negativo',
// );

// $Exams->edit($params);

// $Exams->index();

// $Exams->show($params);
