<?php
require '../model/patient.php';
require '../model/doctor.php';
require '../model/laboratory.php';
class homeController
{

    public function index()
    {
        
    }

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
                $_SESSION['user'] = (string) $patient->cpf;
                $_SESSION['typeUser'] = "patient";
                $returnJSON['success'] = true;
            }
        }
        if ($doctor) {
            if ($doctor->email == $params['email']) {
                $_SESSION['user'] = (string) $doctor->crm;
                $_SESSION['typeUser'] = "doctor";
                $_SESSION['specialty'] = (string) $doctor->specialty;
                $returnJSON['success'] = true;
            }
        }
        if ($laboratory) {
            if ($laboratory->email == $params['email']) {
                $_SESSION['user'] = (string) $laboratory->cnpj;
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
        
}
