<?php
require('../model/doctor.php');
require('../model/appointmentsRecords.php');
require('../model/patient.php');
session_start();
class doctorController extends doctor
{


    public function index()
    {

        $appointments_records = new appointmentsRecords();
        $patients = new patient();
        $recs = $appointments_records->getAllAppointments();

        // get wait appointments, my patients and next appointments
        $wait_appointments = [];
        $my_patients = [];
        $next_appointments = [];

        foreach ($recs as $key => $val) {
            $date = explode("-", $val['date']);
            $date = $date[2] . "-" . $date[1] . "-" . $date[0];
            if (strtotime(date('Y-m-d')) < strtotime($date) && $val['accept'] === 'wait' && $val['specialty'] == $_SESSION['specialty']) $wait_appointments[] = $val;
            if ($val['doctor'] == $_SESSION['user']) $my_patients[] = $val;
            if (strtotime(date('Y-m-d')) < strtotime($date) && $val['accept'] === true && $val['doctor'] == $_SESSION['user']) $next_appointments[] = $val;
        }

        foreach ($wait_appointments as  $value) {
            $patient = $patients->getPatient(str_replace(array('-', '.'), "", $value['patient']));
            $value['patient_name'] = $patient['name'];
        }

        session_start();

        $my_patients = array_map(function ($value) {
            return (string)$value['patient'];
        }, $my_patients);

        $my_patients = array_unique($my_patients);

        $my_patients = array_map(function ($value) {
            $patients = new patient();
            $patient = $patients->getPatient(str_replace(array('-', '.'), "", $value));
            return array("patient" => (string)$value, "patient_name" => (string)$patient['name']);
        }, $my_patients);

        $next_appointments = array_map(function ($value) {
            $patients = new patient();
            $patient = $patients->getPatient(str_replace(array('-', '.'), "", $value['patient']));
            $value["patient_name"] = (string)$patient['name'];
            return $value;
        }, $next_appointments);

        $_SESSION['wait_appointments'] = $wait_appointments;
        $_SESSION['my_patients'] = $my_patients;
        $_SESSION['next_appointments'] = $next_appointments;

        include "../views/appointment.php";
    }

    public function store($params)
    {
        $doctors = new doctor();

        $data = array(
            'name' => $params['name'],
            'address' => $params['address'],
            'phone_number' => $params['phone_number'],
            'email' => $params['email'],
            'specialty' => $params['specialty'],
            'crm' => $params['crm'],
        );

        $insert = $doctors->insertDoctor($data);

        echo json_encode($insert);
    }

    public function edit($params)
    {

        $doctors = new doctor();

        $data = array(
            'name' => $params['name'],
            'address' => $params['address'],
            'phone_number' => $params['phone_number'],
            'email' => $params['email'],
            'specialty' => $params['specialty'],
            'crm' => $params['crm'],
        );

        $update = $doctors->editDoctor($data);

        echo json_encode($update);
    }

    public function show($crm)
    {
        $doctors = new doctor();

        $doctor = $doctors->getDoctor($crm);
        var_dump($doctor);
    }
}

$doctor_controller = new doctorController();

$params = $_GET;

$action = isset($_GET['action']) ? $_GET['action'] : NULL;
switch ($action) {
    case 'store':
        $doctor_controller->store($params);
        break;
    case 'edit':
        $doctor_controller->edit($params);
        break;
    case 'index':
        $doctor_controller->index();
        break;
}
