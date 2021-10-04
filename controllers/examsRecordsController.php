<?php
session_start();
require('../model/examsRecords.php');
require('../model/laboratory.php');
require('../model/patient.php');
require('../model/typeExams.php');
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
            'accept' => 'wait',
        );

        $insert = $exams->insertExam($data);

        echo json_encode($insert);
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

    public function acceptExam($params)
    {
        $exams_records = new examsRecords();

        $data = array(
            'date' => $params['date'],
            'laboratory' => $params['laboratory'],
            'patient' => $params['patient'],
        );

        $rec = $exams_records->acceptExam($data);

        echo json_encode($rec);
    }

    public function denialExam($params)
    {
        $exams_records = new examsRecords();

        $data = array(
            'date' => $params['date'],
            'doctor' => $params['doctor'],
            'patient' => $params['patient'],
        );

        $rec = $exams_records->denialExam($data);

        echo json_encode($rec);
    }

    public function seeRecords($params)
    {

        $exams_records = new examsRecords();
        $laboratory = new laboratory();
        $patient = new patient();
        $type_exams = new typeExams();

        $rec = $exams_records->getAllExams();

        $my_recs = array();

        foreach ($rec->record as $value) {
            if ($_SESSION['typeUser'] == 'laboratory') {
                if ($params['patient']) {
                    if ($value->laboratory == trim($params['laboratory']) && $value->patient == trim($params['patient'])) {
                        $patients = $patient->getPatient(str_replace(array(".", "-"), "", $value->patient));
                        $value['patient_name'] = $patients->name;
                        $laboratories = $laboratory->getLaboratory(str_replace(array('.', '/', "-"), "", $value->laboratory));
                        $value['laboratory_name'] = $laboratories->name;
                        $t_exams = $type_exams->getExam((string)$value->exam);
                        $value['exam_name'] = $t_exams->name;
                        $my_recs[] = $value;
                    }
                } else {
                    if (trim($value->laboratory) == trim($params['laboratory'])) {
                        $patients = $patient->getPatient(str_replace(array(".", "-"), "", $value->patient));
                        $value['patient_name'] = $patients->name;
                        $laboratories = $laboratory->getLaboratory(str_replace(array('.', '/', "-"), "", $value->laboratory));
                        $value['laboratory_name'] = $laboratories->name;
                        $t_exams = $type_exams->getExam((string)$value->exam);
                        $value['exam_name'] = $t_exams->name;
                        $my_recs[] = $value;
                    }
                }
            } else if ($_SESSION['typeUser'] == 'patient') {
                // echo "in";die;
                if ($value->patient == $_SESSION['user']) {
                    $patients = $patient->getPatient(str_replace(array(".", "-"), "", $value->patient));
                    $value['patient_name'] = $patients->name;
                    $laboratories = $laboratory->getLaboratory(str_replace(array('.', '/', "-"), "", $value->laboratory));
                    $value['laboratory_name'] = $laboratories->name;
                    $t_exams = $type_exams->getExam((string)$value->exam);
                    $value['exam_name'] = $t_exams->name;
                    $my_recs[] = $value;
                }
            }
        }

        $_SESSION['patient_record'] = $my_recs;


        include '../views/exams-history.php';
    }
}

$exams_record_controller = new examsRecordsController();

$params = $_GET;
$action = isset($_GET['action']) ? $_GET['action'] : NULL;

switch ($action) {
    case 'index':
        $exams_record_controller->index();
        break;
    case 'store':
        $exams_record_controller->store($params);
        break;
    case 'acceptExam':
        $exams_record_controller->acceptExam($params);
        break;
    case 'denialExam':
        $exams_record_controller->denialExam($params);
        break;
    case 'seeRecords':
        $exams_record_controller->seeRecords($params);
        break;
}
