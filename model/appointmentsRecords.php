<?php

class appointmentsRecords
{

    public $date;
    public $doctor;
    public $patient;
    public $prescription;
    public $obs;

    function getAllAppointments()
    {
        $xml = simplexml_load_file('./../public/files/appointment_records.xml');

        if ($xml === false) {
            echo "Falha ao Carregar o XML: ";
            foreach (libxml_get_errors() as $error) {

                echo "<br>", $error->message;
            }
        } else {
            return $xml;
        }
    }

    function getAppointment($params)
    {
        $file = './../public/files/appointment_records.xml';

        $xml = simplexml_load_file($file);

        foreach ($xml->record as $rec) {
            if ($rec->patient == $params['patient'] && $rec->doctor == $params['doctor'] && $rec->date == $params['date']) {
                return $rec;
            }
        }
    }

    function insertAppointment($data)
    {

        $file = './../public/files/appointment_records.xml';

        $xml = simplexml_load_file($file);

        $salvar = true;

        foreach ($xml as $rec) {
            if ($rec->patient == $data['patient'] && $rec->doctor == $data['doctor'] && $rec->date == $data['date']) $salvar = false;
        }

        if ($salvar) {

            $record = $xml->addChild("record");
            $record->addChild("date", $data['date']);
            $record->addChild("doctor", $data['doctor']);
            $record->addChild("patient", $data['patient']);
            $record->addChild("prescription", $data['prescription']);
            $record->addChild("specialty", $data['specialty']);
            $record->addChild("accept", $data['accept']);
            $record->addChild("obs", $data['obs']);

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

    function editAppointment($data)
    {

        $file = './../public/files/appointment_records.xml';

        $xml = simplexml_load_file($file);

        $salvar = false;

        foreach ($xml->record as $rec) {
            if ($rec->date == $data['date'] && $rec->patient == $data['patient'] && $rec->doctor == $data['doctor']) {

                $salvar = true;
                $rec->obs = $data['obs'];
                $rec->prescription = $data['prescription'];
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
    
    function acceptAppointment($data)
    {

        $file = './../public/files/appointment_records.xml';

        $xml = simplexml_load_file($file);

        $salvar = false;

        foreach ($xml->record as $rec) {
            if ($rec->date == $data['date'] && $rec->patient == $data['patient']) {

                $salvar = true;
                $rec->doctor = $data['doctor'];
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
    
    function denialAppointment($data)
    {

        $file = './../public/files/appointment_records.xml';

        $xml = simplexml_load_file($file);

        $salvar = false;

        foreach ($xml->record as $rec) {
            if ($rec->date == $data['date'] && $rec->patient == $data['patient']) {
                $salvar = true;
                $rec->doctor = $data['doctor'];
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