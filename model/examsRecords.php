<?php

class examsRecords
{

    public $date;
    public $laboratory;
    public $patient;
    public $exam;
    public $result;


    function setDate($date)
    {
        $this->date = $date;
    }

    function getDate()
    {
        return $this->date;
    }

    function setLaboratory($laboratory)
    {
        $this->laboratory = $laboratory;
    }

    function getLaboratory()
    {
        return $this->laboratory;
    }

    function setPatient($patient)
    {
        $this->patient = $patient;
    }

    function getPatient()
    {
        return $this->patient;
    }

    function setExam($exam)
    {
        $this->exam = $exam;
    }

    function getExam()
    {
        return $this->exam;
    }

    function setResult($result)
    {
        $this->result = $result;
    }

    function getResult()
    {
        return $this->result;
    }

    function getAllExams()
    {
        $xml = simplexml_load_file('./../public/files/exams_records.xml');

        if ($xml === false) {
            echo "Falha ao Carregar o XML: ";
            foreach (libxml_get_errors() as $error) {

                echo "<br>", $error->message;
            }
        } else {
            return $xml;
        }
    }

    function getOneExam($params)
    {
        $file = './../public/files/exams_records.xml';

        $xml = simplexml_load_file($file);

        foreach ($xml->record as $rec) {
            if ($rec->patient == $params['patient'] && $rec->laboratory == $params['laboratory'] && $rec->date == $params['date']) {
                return $rec;
            }
        }
    }

    function insertExam($data)
    {

        $file = './../public/files/exams_records.xml';

        $xml = simplexml_load_file($file);

        $salvar = true;

        foreach ($xml as $rec) {
            if ($rec->patient == $data['patient'] && $rec->laboratory == $data['laboratory'] && $rec->date == $data['date']) $salvar = false;
        }

        if ($salvar) {

            $record = $xml->addChild("record");
            $record->addChild("date", $data['date']);
            $record->addChild("laboratory", $data['laboratory']);
            $record->addChild("patient", $data['patient']);
            $record->addChild("exam", $data['exam']);
            $record->addChild("result", $data['result']);
            $record->addChild("accept", $data['accept']);

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

    function editExam($data)
    {

        $file = './../public/files/exams_records.xml';

        $xml = simplexml_load_file($file);

        // $salvar = false;

        foreach ($xml->record as $rec) {
            if ($rec->date == $data['date'] && $rec->patient == $data['patient'] && $rec->laboratory == $data['laboratory']) {

                // $salvar = true;
                $rec->exam = $data['exam'];
                $rec->result = $data['result'];
            }
        }


        // if ($salvar) {

        $xml->asXML($file);

        //     $retorno = array(
        //         'success' => true,
        //         'message' => 'Registro Salvo com sucesso!',
        //     );
        // } else {
        //     $retorno = array(
        //         'success' => false,
        //         'message' => 'Não foi possível salvar o Registro',
        //     );
        // }

        // return $retorno;
    }

    function acceptExam($data)
    {

        $file = './../public/files/exams_records.xml';

        $xml = simplexml_load_file($file);

        $salvar = false;

        foreach ($xml->record as $rec) {
            if ($rec->date == $data['date'] && $rec->patient == $data['patient']) {

                $salvar = true;
                $rec->laboratory = $data['laboratory'];
                $rec->accept = true;
            }
        }

        if ($salvar) {

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
    
    function denialExam($data)
    {

        $file = './../public/files/exams_records.xml';

        $xml = simplexml_load_file($file);

        $salvar = false;

        foreach ($xml->record as $rec) {
            if ($rec->date == $data['date'] && $rec->patient == $data['patient']) {
                $salvar = true;
                $rec->laboratory = $data['laboratory'];
                $rec->accept = false;
            }
        }

        if ($salvar) {

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
}
