<?php

class doctor
{

    public $name;
    public $address;
    public $phone_number;
    public $email;
    public $specialty;
    public $crm;


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

    function setSpecialty($specialty)
    {
        $this->specialty = $specialty;
    }

    function getSpecialty()
    {
        return $this->specialty;
    }

    function setCrm($crm)
    {
        $this->crm = $crm;
    }

    function getCrm()
    {
        return $this->crm;
    }

    function getAllDoctors()
    {
        $xml = simplexml_load_file('./../public/files/doctors.xml');

        if ($xml === false) {
            echo "Falha ao Carregar o XML: ";
            foreach (libxml_get_errors() as $error) {

                echo "<br>", $error->message;
            }
        } else {
            return $xml;
        }
    }

    function getDoctor($crm)
    {
        $file = './../public/files/doctors.xml';

        $doctors = simplexml_load_file($file);

        foreach ($doctors->doctor as $doc) {
            if (str_replace(array('-', '/', '.'), "", $doc->crm) == $crm) {
                return $doc;
            }
        }
    }

    function insertDoctor($data)
    {

        $file = "./../public/files/doctors.xml";

        $xml = simplexml_load_file($file);

        $doctors = $xml;

        $salvar = true;

        foreach ($doctors as $doc) {
            if ($doc->crm == $data['crm']) $salvar = false;
        }

        if ($salvar) {

            $doctor = $doctors->addChild("doctor");
            $doctor->addChild("name", $data['name']);
            $doctor->addChild("address", $data['address']);
            $doctor->addChild("phone_number", $data['phone_number']);
            $doctor->addChild("email", $data['email']);
            $doctor->addChild("specialty", $data['specialty']);
            $doctor->addChild("crm", $data['crm']);

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

    function editDoctor($data)
    {

        $file = "./../public/files/doctors.xml";

        $doctors = simplexml_load_file($file);

        $salvar = false;

        foreach ($doctors->doctor as $doc) {
            if ($doc->crm == $data['crm']) {

                $salvar = true;

                $doc->name = $data['name'];
                $doc->address = $data['address'];
                $doc->phone_number = $data['phone_number'];
                $doc->email = $data['email'];
                $doc->specialty = $data['specialty'];
            }
        }


        if ($salvar) {

            $doctors->asXML($file);

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
