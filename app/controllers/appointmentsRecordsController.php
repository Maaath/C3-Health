<?php
session_start();
require('../model/appointmentsRecords.php');
require('../model/patient.php');
require('../model/doctor.php');
class appointmentsRecordsController extends appointmentsRecords
{

    public function init()
    {
    }

    public function index()
    {
        $appointments_records = new appointmentsRecords();
        $recs = (array) $appointments_records->getAllAppointments();

        $next_appointments = array_filter($recs['record'], function ($val) {
            return $val->date == '31-10-2021';
        });

        $_SESSION['data'] = $recs;

        include "../views/appointment.php";
    }

    public function store($params)
    {
        $appointments_records = new appointmentsRecords();

        $data = array(
            'date' => $params['date'],
            'doctor' => $params['doctor'],
            'patient' => $params['patient'],
            'prescription' => $params['prescription'],
            'obs' => $params['obs'],
            'specialty' => $params['specialty'],
            'accept' => 'wait',
        );

        $insert = $appointments_records->insertAppointment($data);

        echo json_encode($insert);
    }

    public function edit($params)
    {

        $appointments_records = new appointmentsRecords();

        $data = array(
            'date' => $params['date'],
            'doctor' => $params['doctor'],
            'patient' => $params['patient'],
            'prescription' => $params['prescription'],
            'obs' => $params['obs'],
        );

        $appointments_records->editAppointment($data);
    }

    public function show($params)
    {
        $appointments_records = new appointmentsRecords();

        $data = array(
            'date' => $params['date'],
            'doctor' => $params['doctor'],
            'patient' => $params['patient'],
        );

        $rec = $appointments_records->getAppointment($data);
        var_dump($rec);
    }

    public function acceptAppointment($params)
    {
        $appointments_records = new appointmentsRecords();

        $data = array(
            'date' => $params['date'],
            'doctor' => $params['doctor'],
            'patient' => $params['patient'],
        );

        $rec = $appointments_records->acceptAppointment($data);

        echo json_encode($rec);
    }

    public function denialAppointment($params)
    {
        $appointments_records = new appointmentsRecords();

        $data = array(
            'date' => $params['date'],
            'doctor' => $params['doctor'],
            'patient' => $params['patient'],
        );

        $rec = $appointments_records->denialAppointment($data);

        echo json_encode($rec);
    }

    public function seeRecords($params)
    {
        $appointments_records = new appointmentsRecords();
        $doctor = new doctor();
        $patient = new patient();

        $rec = $appointments_records->getAllAppointments();

        $my_recs = array();

        foreach ($rec as $value) {


            if ($_SESSION['typeUser'] == 'doctor') {
                if ($params['patient']) {
                    if ($value['doctor'] == trim($params['doctor']) && $value['patient'] == trim($params['patient'])) {
                        $patients = $patient->getPatient(str_replace(array(".", "-"), "", $value['patient']));
                        $value['patient_name'] = $patients['name'];
                        $doctors = $doctor->getDoctor(str_replace(array('.', '/'), "", $value['doctor']));
                        $value['doctor_name'] = $doctors['name'];
                        $my_recs[] = $value;
                    }
                } else {
                    if ($value['doctor'] == trim($params['doctor'])) {
                        $patients = $patient->getPatient(str_replace(array(".", "-"), "", $value['patient']));
                        $value['patient_name'] = $patients['name'];
                        $doctors = $doctor->getDoctor(str_replace(array('.', '/'), "", $value['doctor']));
                        $value['doctor_name'] = $doctors['name'];
                        $my_recs[] = $value;
                    }
                }
            } else if ($_SESSION['typeUser'] == 'patient') {
                if ($value['patient'] == $_SESSION['user']) {
                    $patients = $patient->getPatient(str_replace(array(".", "-"), "", $value['patient']));
                    $value['patient_name'] = $patients['name'];
                    $doctors = $doctor->getDoctor(str_replace(array('.', '/'), "", $value['doctor']));
                    $value['doctor_name'] = $doctors['name'];
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


        include '../views/appointment-history.php';
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

$appointments_record_controller = new appointmentsRecordsController();

$params = $_GET;
$action = isset($_GET['action']) ? $_GET['action'] : NULL;

switch ($action) {
    case 'index':
        $appointments_record_controller->index();
        break;
    case 'store':
        $appointments_record_controller->store($params);
        break;
    case 'acceptAppointment':
        $appointments_record_controller->acceptAppointment($params);
        break;
    case 'denialAppointment':
        $appointments_record_controller->denialAppointment($params);
        break;
    case 'seeRecords':
        $appointments_record_controller->seeRecords($params);
        break;
}
