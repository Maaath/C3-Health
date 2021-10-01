<?php
require('../model/doctor.php');
class doctorController extends doctor
{


    public function index()
    {
        $doctors = new doctor();
        $docs = $doctors->getAllDoctors();
        print_r($docs);
        die;
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

        $doctors->editDoctor($data);
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
}


// $doctor_controller = new doctorController;

// // $params = array(
// //     'name' => "André Lima Barros",
// //     'address' => "Marechal Floreano #964",
// //     'phone_number' => "(51)3231-9564",
// //     'email' => "andre.barros@stacasa.com.br",
// //     'specialty' => "Clinico Geral",
// //     'crm' => "9657755446",
// // );

// // $Doctor->store($params);


// $params = array(
//     'name' => "Marcelo Lima Barros",
//     'address' => "Marechal Floreano  Peixoto #964",
//     'phone_number' => "(51)3232-9664",
//     'email' => "marcelo.barros@stacasa.com.br",
//     'specialty' => "Cirurgião Plastico",
//     'crm' => "9657755446",
// );

// // $Doctor->edit($params);

// // $Doctor->index();

// $Doctor->show($params['crm']);
