<?php
session_start();
require('../model/laboratory.php');
require('../model/examsRecords.php');
require('../model/patient.php');
class laboratoryController extends laboratory
{

    public function index()
    {
        $exams_records = new examsRecords();
        $patients = new patient();
        $recs = (array) $exams_records->getAllExams();
        
        // get wait exams
        $wait_exams = array_filter($recs['record'], function ($val) {
            $laboratories = new laboratory();
            $laboratory = $laboratories->getLaboratory(str_replace(array('.', '/', '-'), '', $_SESSION['user']));
            $date = explode("-", $val->date);
            $date = $date[2] . "-" . $date[1] . "-" . $date[0];
            return strtotime(date('Y-m-d')) < strtotime($date) && $val->accept == 'wait' && in_array((string)$val->exam, (array)$laboratory->exams->exam);
        });

        foreach ($wait_exams as  $value) {
            $patient = $patients->getPatient(str_replace(array('-', '.'), "", $value->patient));
            $value->patient_name = $patient->name;
        }


        // get my patients
        $my_patients = array_filter($recs['record'], function ($val) {
            return $val->laboratory == $_SESSION['user'];
        });

        $my_patients = array_map(function ($value) {
            return (string)$value->patient;
        }, $my_patients);


        $my_patients = array_unique($my_patients);

        $my_patients = array_map(function ($value) {
            $patients = new patient();
            $patient = $patients->getPatient(str_replace(array('-', '.'), "", $value));
            return array("patient" => (string)$value, "patient_name" => (string)$patient->name);
        }, $my_patients);

        // get next exams
        $next_exams = array_filter($recs['record'], function ($val) {
            $date = explode("-", $val->date);
            $date = $date[2] . "-" . $date[1] . "-" . $date[0];
            return strtotime(date('Y-m-d')) < strtotime($date) && $val->accept == '1' && $val->laboratory == $_SESSION['user'];
        });

        $next_exams = array_map(function ($value) {
            $patients = new patient();
            $patient = $patients->getPatient(str_replace(array('-', '.'), "", $value->patient));
            $value["patient_name"] = (string)$patient->name;
            return $value;
        }, $next_exams);

        $_SESSION['wait_exams'] = $wait_exams;
        $_SESSION['my_patients'] = $my_patients;
        $_SESSION['next_exams'] = $next_exams;

        include "../views/exams.php";
    }

    public function store($params)
    {
        $laboratories = new laboratory();

        $data = array(
            'name' => $params['name'],
            'address' => $params['address'],
            'phone_number' => $params['phone_number'],
            'email' => $params['email'],
            'exams' => $params['exams'],
            'cnpj' => $params['cnpj'],
        );

        $insert = $laboratories->insertLaboratory($data);

        echo json_encode($insert);
    }

    public function edit($params)
    {
        $laboratories = new laboratory();

        $data = array(
            'name' => $params['name'],
            'address' => $params['address'],
            'phone_number' => $params['phone_number'],
            'email' => $params['email'],
            'exams' => $params['exams'],
            'cnpj' => $params['cnpj'],
        );

        $laboratories->editLaboratory($data);
    }

    public function show($cnpj)
    {
        $laboratories = new laboratory();

        $laboratory = $laboratories->getLaboratory($cnpj);
        var_dump($laboratory);
    }
}

$laboratory_controller = new laboratoryController();

$params = $_GET;

$action = isset($_GET['action']) ? $_GET['action'] : NULL;
switch ($action) {
    case 'store':
        $laboratory_controller->store($params);
        break;
    case 'index':
        $laboratory_controller->index();
        break;
}
