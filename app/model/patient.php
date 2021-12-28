<?php

require '../../vendor/autoload.php';

class patient
{

    public $name;
    public $address;
    public $phone_number;
    public $email;
    public $exams;
    public $gender;
    public $age;
    public $cpf;

    function getAllPatients()
    {
        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $patients = $client->Health->patients;

        $result = $patients->find();

        return $result;

        // $xml = simplexml_load_file('./../../public/files/patients.xml');

        // if ($xml === false) {
        //     echo "Falha ao Carregar o XML: ";
        //     foreach (libxml_get_errors() as $error) {

        //         echo "<br>", $error->message;
        //     }
        // } else {
        //     return $xml;
        // }
    }

    function getPatient($cpf)
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $patients = $client->Health->patients;

        $result = $patients->find();

        foreach ($result as $pat) {
            if (str_replace(array('-', '.'), "", $pat->cpf) == $cpf) {
                return $pat;
            }
        }
    }

    function insertPatient($data)
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $patients = $client->Health->patients;

        $result = $patients->find();

        $salvar = true;

        foreach ($result as $pat) {
            if ($pat->cpf == $data['cpf']) $salvar = false;
        }

        $dataToSave = array(
            'name' => $data['name'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'age' => $data['age'],
            'cpf' => $data['cpf'],
        );

        $return = array(
            'success' => false,
            'message' => 'Não foi possível salvar o Registro',
        );

        if ($salvar) {
            $patients->insertOne($dataToSave);

            $return = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        }

        return $return;
    }

    function editPatient($data)
    {
        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $patients = $client->Health->patients;

        $result = $patients->find();

        $salvar = false;
        
        foreach ($result as $pat) {

            if ($pat['cpf'] == $data['cpf']) {

                $salvar = true;

                $dataToSave = array(
                    'name' => $data['name'],
                    'address' => $data['address'],
                    'phone_number' => $data['phone_number'],
                    'email' => $data['email'],
                    'gender' => $data['gender'],
                    'age' => $data['age'],
                );

                $condition = array('cpf' => $pat['cpf']);
            }
        }
        
        $return = array(
            'success' => false,
            'message' => 'Não foi possível salvar o Registro',
        );

        if ($salvar) {

            $patients->updateOne($condition, array('$set' => $dataToSave));

            $return = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        }

        return $return;
    }
}
