<?php

require '../../vendor/autoload.php';

class doctor
{

    public $name;
    public $address;
    public $phone_number;
    public $email;
    public $specialty;
    public $crm;

    function getAllDoctors()
    {
        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $doctors = $client->Health->doctors;

        $result = $doctors->find();

        return $result;
    }

    function getDoctor($crm)
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $doctors = $client->Health->doctor;

        $result = $doctors->find();

        foreach ($result as $doc) {
            if (str_replace(array('-', '/', '.'), "", $doc->crm) == $crm) {
                return $doc;
            }
        }
    }

    function insertDoctor($data)
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $doctors = $client->Health->doctor;

        $result = $doctors->find();

        $salvar = true;

        foreach ($result as $doc) {
            if ($doc->crm == $data['crm']) $salvar = false;
        }

        $dataToSave = array(
            'name' => $data['name'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'specialty' => $data['specialty'],
            'crm' => (string) $data['crm'],
        );

        $return = array(
            'success' => false,
            'message' => 'Não foi possível salvar o Registro',
        );

        if ($salvar) {
            $doctors->insertOne($dataToSave);

            $return = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        }

        return $return;
    }

    function editDoctor($data)
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $doctors = $client->Health->doctor;

        $result = $doctors->find();

        $salvar = false;

        foreach ($result as $doc) {
            if ($doc['crm'] == $data['crm']) {

                $salvar = true;

                $dataToSave = array(
                    'name' => $data['name'],
                    'address' => $data['address'],
                    'phone_number' => $data['phone_number'],
                    'email' => $data['email'],
                    'specialty' => $data['specialty'],
                );

                $condition = array('crm' => (string)$doc['crm']);
            }
        }

        $return = array(
            'success' => false,
            'message' => 'Não foi possível salvar o Registro',
        );

        if ($salvar) {

            $doctors->updateOne($condition, array('$set' => $dataToSave));

            $return = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        }

        return $return;
    }
}
