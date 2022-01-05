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

        foreach ($rec as $value) {
            if ($_SESSION['typeUser'] == 'laboratory') {
                if ($params['patient']) {
                    if ($value['laboratory'] == trim($params['laboratory']) && $value['patient'] == trim($params['patient'])) {
                        $patients = $patient->getPatient(str_replace(array(".", "-"), "", $value['patient']));
                        $value['patient_name'] = $patients['name'];
                        $laboratories = $laboratory->getLaboratory(str_replace(array('.', '/', "-"), "", $value['laboratory']));
                        $value['laboratory_name'] = $laboratories['name'];
                        $t_exams = $type_exams->getExam((string)$value['exam']);
                        $value['exam_name'] = $t_exams['name'];
                        $my_recs[] = $value;
                    }
                } else {
                    if (trim($value['laboratory']) == trim($params['laboratory'])) {
                        $patients = $patient->getPatient(str_replace(array(".", "-"), "", $value['patient']));
                        $value['patient_name'] = $patients['name'];
                        $laboratories = $laboratory->getLaboratory(str_replace(array('.', '/', "-"), "", $value['laboratory']));
                        $value['laboratory_name'] = $laboratories['name'];
                        $t_exams = $type_exams->getExam((string)$value['exam']);
                        $value['exam_name'] = $t_exams['name'];
                        $my_recs[] = $value;
                    }
                }
            } else if ($_SESSION['typeUser'] == 'patient') {
                if ($value['patient'] == $_SESSION['user']) {
                    $patients = $patient->getPatient(str_replace(array(".", "-"), "", $value['patient']));
                    $value['patient_name'] = $patients['name'];
                    $laboratories = $laboratory->getLaboratory(str_replace(array('.', '/', "-"), "", $value['laboratory']));
                    $value['laboratory_name'] = $laboratories['name'];
                    $t_exams = $type_exams->getExam((string)$value['exam']);
                    $value['exam_name'] = $t_exams['name'];
                    $my_recs[] = $value;
                }
            }
        }

        $countCurrMonth = $this->countByCurrentMonth($my_recs);
        $countCurrYear = $this->countByCurrentYear($my_recs);
        $countAveMonth = $this->countByAverageMonth($my_recs);
        $countAveYear = $this->countByAverageYear($my_recs);
        $counters = array($countCurrMonth, $countCurrYear, $countAveMonth, $countAveYear);

        $_SESSION['counters'] = $counters;
        $_SESSION['patient_record'] = $my_recs;


        include '../views/exams-history.php';
    }


    public function getTypeExams()
    {
        
        $type_exams = new typeExams();

        $rec = $type_exams->getAllExams();

        echo json_encode($rec);
    }

    private function countByCurrentMonth($records)
    {
        $currMonth = date('m');
        $counter = 0;
        foreach ($records as $value) {
            list($day, $month, $year) = explode('-', $value['date']);
            if ($month == $currMonth) $counter++;
        }

        return $counter;
    }

    private function countByCurrentYear($records)
    {
        $currYear = date('Y');
        $counter = 0;
        foreach ($records as $value) {
            list($day, $month, $year) = explode('-', $value['date']);
            if ($year == $currYear) $counter++;
        }

        return $counter;
    }

    private function countByAverageMonth($records)
    {
        $counter = array();
        foreach ($records as $value) {
            list($day, $month, $year) = explode('-', $value['date']);
            if (!in_array(($month.'-'.$year), $counter)) $counter[] = $month.'-'.$year;
        }

        return round(count($records)/count($counter));
    }

    private function countByAverageYear($records)
    {
        $counter = array();
        foreach ($records as $value) {
            list($day, $month, $year) = explode('-', $value['date']);
            if (!in_array($year, $counter)) $counter[] = $year;
        }

        return round(count($records)/count($counter));
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
    case 'getTypeExams':
        $exams_record_controller->getTypeExams();
        break;
}
