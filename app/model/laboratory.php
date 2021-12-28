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
        $xml = simplexml_load_file('./../../public/files/laboratories.xml');

        if ($xml === false) {
            echo "Falha ao Carregar o XML: ";
            foreach (libxml_get_errors() as $error) {

                echo "<br>", $error->message;
            }
        } else {
            return $xml;
        }
    }

    function getLaboratory($cnpj)
    {
        $file = './../../public/files/laboratories.xml';

        $laboratories = simplexml_load_file($file);

        foreach ($laboratories->laboratory as $lab) {
            if (str_replace(array('-', '.', '/'), "", $lab->cnpj) == $cnpj) {
                return $lab;
            }
        }
    }

    function insertLaboratory($data)
    {

        $file = "./../../public/files/laboratories.xml";

        $xml = simplexml_load_file($file);

        $laboratories = $xml;

        $salvar = true;

        foreach ($laboratories as $lab) {
            if ($lab->cnpj == $data['cnpj']) $salvar = false;
        }

        if ($salvar) {

            $laboratory = $laboratories->addChild("laboratory");
            $laboratory->addChild("name", $data['name']);
            $laboratory->addChild("address", $data['address']);
            $laboratory->addChild("phone_number", $data['phone_number']);
            $laboratory->addChild("email", $data['email']);
            $exams = $laboratory->addChild("exams");
            foreach ($data['exams'] as $exam) {
                $exams->addChild('exam', $exam);
            }
            $laboratory->addChild("cnpj", $data['cnpj']);

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

    function editLaboratory($data)
    {

        $file = "./../../public/files/laboratories.xml";

        $laboratories = simplexml_load_file($file);

        $salvar = false;

        foreach ($laboratories->laboratory as $lab) {
            if ($lab->cnpj == $data['cnpj']) {

                $salvar = true;

                $lab->name = $data['name'];
                $lab->address = $data['address'];
                $lab->phone_number = $data['phone_number'];
                $lab->email = $data['email'];
                unset($lab->exams);
                $exams = $lab->addChild("exams");
                foreach ($data['exams'] as $exam) {
                    $exams->addChild('exam', $exam);
                }
            }
        }

        if ($salvar) {

            $laboratories->asXML($file);

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
