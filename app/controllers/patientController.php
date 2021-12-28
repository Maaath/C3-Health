<?php
require '../model/patient.php';
class patientController extends patient
{

    public function index()
    {
        $patient = new patient();
        $pat = $patient->getAllPatients();
        print_r($pat);
    }

    public function store($params)
    {
        $patients = new patient();

        $data = array(
            'name' => $params['name'],
            'address' => $params['address'],
            'phone_number' => $params['phone_number'],
            'email' => $params['email'],
            'gender' => $params['gender'],
            'age' => $params['age'],
            'cpf' => $params['cpf'],
        );

        $insert = $patients->insertPatient($data);

        echo json_encode($insert);
    }

    public function edit($params)
    {
        $patients = new patient();

        $data = array(
            'name' => $params['name'],
            'address' => $params['address'],
            'phone_number' => $params['phone_number'],
            'email' => $params['email'],
            'gender' => $params['gender'],
            'age' => $params['age'],
            'cpf' => $params['cpf'],
        );

        $update = $patients->editPatient($data);

        echo json_encode($update);
    }

    public function show($cpf)
    {
        $patients = new patient();  

        $patient = $patients->getPatient($cpf);
        var_dump($patient);
    }
}

$patient_controller = new patientController();

$params = $_GET;

$action = isset($_GET['action']) ? $_GET['action'] : NULL;
switch ($action) {
    case 'store':
        $patient_controller->store($params);
        break;
    case 'edit':
        $patient_controller->edit($params);
        break;
}
