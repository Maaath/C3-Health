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

        $patients->editPatient($data);
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
}
// $params = array(
//     'name' => "André Lima Barros",
//     'address' => "Marechal Floreano #964",
//     'phone_number' => "(51)3231-9564",
//     'email' => "andre.barros@stacasa.com.br",
//     'gender' => "não quero manifestar",
//     'age' => '12',
//     'cpf' => "666.999.555-77",
// );

// $Patient->store($params);

// $params = array(
//     'name' => "Marcela Lima Barros",
//     'gender' => "feminino",
//     'address' => "Marechal Floreano  Peixoto #964",
//     'phone_number' => "(51)3232-9664",
//     'email' => "marcelo.barros@stacasa.com.br",
//     'age' => "50",
//     'cpf' => "666.999.555-77",
// );

// $Patient->edit($params);

// $Patient->index();

// $Patient->show($params['cpf']);