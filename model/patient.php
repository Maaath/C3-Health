<?php

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


    function setName($name)
    {
        $this->name = $name;
    }

    function getName()
    {
        return $this->name;
    }

    function setAddress($address)
    {
        $this->address = $address;
    }

    function getAddress()
    {
        return $this->name;
    }

    function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    function getPhoneNumber()
    {
        return $this->phone_number;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function getEmail()
    {
        return $this->email;
    }

    function setGender($gender)
    {
        $this->gender = $gender;
    }

    function getGender()
    {
        return $this->gender;
    }

    function setAge($age)
    {
        $this->age = $age;
    }

    function getAge()
    {
        return $this->age;
    }

    function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    function getCpf()
    {
        return $this->cpf;
    }

    function getAllPatients()
    {
        $xml = simplexml_load_file('./../public/files/patients.xml');

        if ($xml === false) {
            echo "Falha ao Carregar o XML: ";
            foreach (libxml_get_errors() as $error) {

                echo "<br>", $error->message;
            }
        } else {
            return $xml;
        }
    }

    function getPatient($cpf)
    {
        $file = './../public/files/patients.xml';

        $patients = simplexml_load_file($file);

        foreach ($patients->patient as $pat) {
            if (str_replace(array('-', '.'), "", $pat->cpf) == $cpf) {
                return $pat;
            }
        }
    }

    function insertPatient($data)
    {

        $file = "./../public/files/patients.xml";

        $xml = simplexml_load_file($file);

        $patients = $xml;

        $salvar = true;

        foreach ($patients as $pat) {
            if ($pat->cpf == $data['cpf']) $salvar = false;
        }

        if ($salvar) {

            $patient = $patients->addChild("patient");
            $patient->addChild("name", $data['name']);
            $patient->addChild("address", $data['address']);
            $patient->addChild("phone_number", $data['phone_number']);
            $patient->addChild("email", $data['email']);
            $patient->addChild("gender", $data['gender']);
            $patient->addChild("age", $data['age']);
            $patient->addChild("cpf", $data['cpf']);

            $xml->asXML($file);

            $retorno = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        } else {
            $retorno = array(
                'success' => false,
                'message' => 'Não foi possível salvar o Registro',
            );
        }

        return $retorno;
    }

    function editPatient($data)
    {

        $file = "./../public/files/patients.xml";

        $patients = simplexml_load_file($file);

        $salvar = false;

        foreach ($patients->patient as $pat) {
            if ($pat->cpf == $data['cpf']) {

                $salvar = true;

                $pat->name = $data['name'];
                $pat->address = $data['address'];
                $pat->phone_number = $data['phone_number'];
                $pat->email = $data['email'];
                $pat->gender = $data['gender'];
                $pat->age = $data['age'];
            }
        }

        if ($salvar) {

            $patients->asXML($file);

            $retorno = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        } else {
            $retorno = array(
                'success' => false,
                'message' => 'Não foi possível salvar o Registro',
            );
        }

        return $retorno;
    }
}
