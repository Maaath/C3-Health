<?php
require('../model/laboratory.php');
class laboratoryController extends laboratory
{

    public function index()
    {
        $laboratories = new laboratory();
        $labs = $laboratories->getAllLaboratories();
        var_dump($labs);
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
}

// $params = array(
//     'name' => "Analisa 2",
//     'address' => "Barcelar #65",
//     'phone_number' => "(53)3230-7830",
//     'email' => "analisa2.analises@gmail.com.br",
//     'exams' => array(1, 2, 3),
//     'cnpj' => "66.666.666/0001-68",
// );

// $Laboratory->store($params);

// $params = array(
//     'name' => "Analisa 3",
//     'address' => "Aquidaban #65",
//     'phone_number' => "(53)3232-7830",
//     'email' => "analisa3.analises@gmail.com.br",
//     'exams' => array(1, 2),
//     'cnpj' => "66.666.666/0001-68",
// );

// $Laboratory->edit($params);

// // $Laboratory->index();

// $Laboratory->show($params['cnpj']);
