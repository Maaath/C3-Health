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
        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $appointment_records = $client->Health->appointment_records;

        $result = $appointment_records->find();

        return $result;
    }

    function getAppointment($params)
    {
        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $appointment_records = $client->Health->appointment_records;

        $result = $appointment_records->find();

        foreach ($result as $rec) {
            if ($rec['patient'] == $params['patient'] && $rec['doctor'] == $params['doctor'] && $rec['date'] == $params['date']) {
                return $rec;
            }
        }
    }

    function insertAppointment($data)
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $appointment_records = $client->Health->appointment_records;

        $result = $appointment_records->find();

        $salvar = true;

        foreach ($result as $rec) {
            if ($rec['patient'] == $data['patient'] && $rec['doctor'] == $data['doctor'] && $rec['date'] == $data['date']) $salvar = false;
        }

        $dataToSave = array(
            'date' => $data['date'],
            'doctor' => $data['doctor'],
            'patient' => $data['patient'],
            'prescription' => $data['prescription'],
            'specialty' => $data['specialty'],
            'accept' => $data['accept'],
            'obs' => $data['obs'],
        );

        $retorno = array(
            'success' => false,
            'message' => 'Não foi possível salvar o Registro',
        );

        if ($salvar) {

            $appointment_records->insertOne($dataToSave);

            $retorno = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        }

        return $retorno;
    }

    function editAppointment($data)
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $appointment_records = $client->Health->appointment_records;

        $result = $appointment_records->find();

        $salvar = false;

        foreach ($result as $rec) {

            if ($rec['date'] == $data['date'] && $rec['patient'] == $data['patient'] && $rec['doctor'] == $data['doctor']) {

                $salvar = true;

                $dataToSave = array(
                    'prescription' => $data['prescription'],
                    'obs' => $data['obs'],
                );

                $condition = array(
                    'date' => $data['date'],
                    'patient' => $data['patient'],
                    'doctor' => $data['patient'],
                );
            }
        }

        $retorno = array(
            'success' => false,
            'message' => 'Não foi possível salvar o Registro',
        );

        if ($salvar) {

            $appointment_records->updateOne($condition, array('$set' => $dataToSave));

            $retorno = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        }

        return $retorno;
    }

    function acceptAppointment($data)
    {
        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");
        
        $appointment_records = $client->Health->appointment_records;
        
        $result = $appointment_records->find();
        
        $salvar = false;
        
        foreach ($result as $rec) {
            if ($rec['date'] == $data['date'] && $rec['patient'] == $data['patient']) {

                $salvar = true;

                $dataToSave = array(
                    'doctor' => $data['doctor'],
                    'accept' => true,
                );

                $condition = array(
                    'date' => $data['date'],
                    'patient' => $data['patient'],
                );
            }
        }

        $retorno = array(
            'success' => false,
            'message' => 'Não foi possível salvar o Registro',
        );

        if ($salvar) {

            $appointment_records->updateOne($condition, array('$set' => $dataToSave));

            $retorno = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        }

        return $retorno;
    }

    function denialAppointment($data)
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $appointment_records = $client->Health->appointment_records;

        $result = $appointment_records->find();

        $salvar = false;

        foreach ($result as $rec) {
            if ($rec['date'] == $data['date'] && $rec['patient'] == $data['patient']) {
                $salvar = true;

                $dataToSave = array(
                    'doctor' => $data['doctor'],
                    'accept' => false,
                );

                $condition = array(
                    'date' => $data['date'],
                    'patient' => $data['patient'],
                );
            }
        }

        $retorno = array(
            'success' => false,
            'message' => 'Não foi possível salvar o Registro',
        );

        if ($salvar) {

            $appointment_records->updateOne($condition, array('$set' => $dataToSave));

            $retorno = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        }

        return $retorno;
    }
}
