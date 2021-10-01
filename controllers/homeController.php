<?php
require '../model/patient.php';
require '../model/doctor.php';
require '../model/laboratory.php';
class homeController
{

    public function index()
    {
        // $patient = new patient();
        // $pat = $patient->getAllPatients();
        // print_r($pat);
    }

    // public function store($params)
    // {
    // $patients = new patient();

    // $data = array(
    //     'name' => $params['name'],
    //     'address' => $params['address'],
    //     'phone_number' => $params['phone_number'],
    //     'email' => $params['email'],
    //     'gender' => $params['gender'],
    //     'age' => $params['age'],
    //     'cpf' => $params['cpf'],
    // );

    // $patients->insertPatient($data);
    // }

    // public function edit($params)
    // {
    //     $patients = new patient();

    //     $data = array(
    //         'name' => $params['name'],
    //         'address' => $params['address'],
    //         'phone_number' => $params['phone_number'],
    //         'email' => $params['email'],
    //         'gender' => $params['gender'],
    //         'age' => $params['age'],
    //         'cpf' => $params['cpf'],
    //     );

    //     $patients->editPatient($data);
    // }

    public function logar($params)
    {
        $patients = new patient();
        $doctors = new doctor();
        $laboratories = new laboratory();

        $patient = $patients->getPatient($params['password']);
        $doctor = $doctors->getDoctor($params['password']);
        $laboratory = $laboratories->getLaboratory($params['password']);

        $returnJSON = array(
            "success" => false,
            "message" => "Usuário e/ou Senha incorreta!",
        );

        session_start();

        if ($patient) {
            if ($patient->email == $params['email']) {
                $_SESSION['user'] = $params['email'];
                $_SESSION['typeUser'] = "patient";
                $returnJSON['success'] = true;
            }
        }
        if ($doctor) {
            if ($doctor->email == $params['email']) {
                $_SESSION['user'] = $params['email'];
                $_SESSION['typeUser'] = "doctor";
                $returnJSON['success'] = true;
            }
        }
        if ($laboratory) {
            if ($laboratory->email == $params['email']) {
                $_SESSION['user'] = $params['email'];
                $_SESSION['typeUser'] = "laboratory";
                $returnJSON['success'] = true;
            }
        }

        echo json_encode($returnJSON);
    }
}

$home_controller = new homeController();

$params = $_GET;

$action = isset($_GET['action']) ? $_GET['action'] : NULL;
switch ($action) {
    case 'logar':
        $home_controller->logar($params);
        break;
    case 'store':
        $home_controller->store($params);
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