<?php

class laboratory
{

    public $name;
    public $address;
    public $phone_number;
    public $email;
    public $exams;
    public $cnpj;

    function getAllLaboratories()
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $laboratories = $client->Health->laboratories;

        $result = $laboratories->find();

        return $result;
    }

    function getLaboratory($cnpj)
    {
        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $laboratories = $client->Health->laboratories;

        $result = $laboratories->find();

        foreach ($result as $lab) {
            if (str_replace(array('-', '.', '/'), "", $lab['cnpj']) == str_replace(array('-', '.', '/'), "", $cnpj)) {
                return $lab;
            }
        }
    }

    function insertLaboratory($data)
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $laboratories = $client->Health->laboratories;
        $lab_exam = $client->Health->lab_exam;

        $result = $laboratories->find();

        $salvar = true;

        foreach ($result as $lab) {
            if ($lab['cnpj'] == $data['cnpj']) $salvar = false;
        }

        $dataToSave = array(
            'name' => $data['name'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'cnpj' => $data['cnpj'],
        );

        $return = array(
            'success' => false,
            'message' => 'Não foi possível salvar o Registro',
        );

        if ($salvar) {
            $laboratories->insertOne($dataToSave);

            $laboratory = $this->getLaboratory($data['cnpj']);


            foreach ($data['exams'] as $key => $value) {
                $dataToSave = array(
                    'exams_id' => $value,
                    'laboratory_id' => (string)$laboratory['_id']
                );

                $lab_exam->insertOne($dataToSave);
            }

            $return = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        }

        return $return;
    }

    function editLaboratory($data)
    {
        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $laboratories = $client->Health->laboratories;
        $lab_exam = $client->Health->lab_exam;

        $result = $laboratories->find();

        $salvar = false;

        foreach ($result as $lab) {
            if ($lab['cnpj'] == $data['cnpj']) {

                $salvar = true;

                $dataToSave = array(
                    'name' => $data['name'],
                    'address' => $data['address'],
                    'phone_number' => $data['phone_number'],
                    'email' => $data['email'],
                    'cnpj' => $data['cnpj'],
                );

                $condition = array('laboratory_id' => (string)$lab['_id']);

                $lab_exam->deleteMany($condition);

                $condition = array('cnpj' => $lab['cnpj']);
            }
        }

        $retorno = array(
            'success' => false,
            'message' => 'Não foi possível salvar o Registro',
        );

        if ($salvar) {
            $laboratories->updateOne($condition, array('$set' => $dataToSave));

            $laboratory = $this->getLaboratory($data['cnpj']);

            foreach ($data['exams'] as $key => $value) {
                $dataToSave = array(
                    'exams_id' => $value,
                    'laboratory_id' => (string)$laboratory['_id']
                );

                $lab_exam->insertOne($dataToSave);
            }

            $retorno = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        }

        return $retorno;
    }
}
