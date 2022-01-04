<?php

class examsRecords
{

    public $date;
    public $laboratory;
    public $patient;
    public $exam;
    public $result;

    function getAllExams()
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $exam_records = $client->Health->exam_records;

        $result = $exam_records->find();

        return $result;
    }

    function getOneExam($params)
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $exam_records = $client->Health->exam_records;

        $result = $exam_records->find();

        foreach ($result as $rec) {
            if ($rec['patient'] == $params['patient'] && $rec['laboratory'] == $params['laboratory'] && $rec['date'] == $params['date']) {
                return $rec;
            }
        }
    }

    function insertExam($data)
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $exam_records = $client->Health->exam_records;

        $result = $exam_records->find();

        $salvar = true;

        foreach ($result as $rec) {
            if ($rec['patient'] == $data['patient'] && $rec['laboratory'] == $data['laboratory'] && $rec['date'] == $data['date']) $salvar = false;
        }

        $dataToSave = array(
            'date' => $data['date'],
            'laboratory' => $data['laboratory'],
            'patient' => $data['patient'],
            'exam' => $data['exam'],
            'result' => $data['result'],
            'accept' => $data['accept'],
        );

        $retorno = array(
            'success' => false,
            'message' => 'Não foi possível salvar o Registro',
        );

        if ($salvar) {

            $exam_records->insertOne($dataToSave);

            $retorno = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        }

        return $retorno;
    }

    function editExam($data)
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $exam_records = $client->Health->exam_records;

        $result = $exam_records->find();

        $salvar = false;

        foreach ($result as $rec) {
            if ($rec['date'] == $data['date'] && $rec['patient'] == $data['patient'] && $rec['laboratory'] == $data['laboratory']) {

                $salvar = true;

                $dataToSave = array(
                    'exam' => $data['exam'],
                    'result' => $data['result'],

                );

                $condition = array(
                    'date' => $data['date'],
                    'laboratory' => $data['laboratory'],
                    'patient' => $data['patient'],
                );
            }
        }

        $retorno = array(
            'success' => false,
            'message' => 'Não foi possível salvar o Registro',
        );

        if ($salvar) {

            $exam_records->updateOne($condition, array('$set' => $dataToSave));

            $retorno = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        }

        return $retorno;
    }

    function acceptExam($data)
    {
        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");
        
        $exam_records = $client->Health->exam_records;
        
        $result = $exam_records->find();
        
        $salvar = false;
        
        foreach ($result as $rec) {
            if ($rec['date'] == $data['date'] && $rec['patient'] == $data['patient']) {

                $salvar = true;

                $dataToSave = array(
                    'laboratory' => $data['laboratory'],
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

            $exam_records->updateOne($condition, array('$set' => $dataToSave));

            $retorno = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        }

        return $retorno;
    }

    function denialExam($data)
    {

        $client = new MongoDB\Client("mongodb+srv://admin:admin@cluster0.lisav.mongodb.net/Health?retryWrites=true&w=majority");

        $exam_records = $client->Health->exam_records;

        $result = $exam_records->find();

        $salvar = false;

        foreach ($result as $rec) {
            if ($rec['date'] == $data['date'] && $rec['patient'] == $data['patient']) {
                $salvar = true;
                $dataToSave = array(
                    'laboratory' => $data['laboratory'],
                    'accept' => false
                );

                $condition = array(
                    'date' => $data['date'],
                    'patient' => $data['patient']
                );
            }
        }

        $retorno = array(
            'success' => false,
            'message' => 'Não foi possível salvar o Registro',
        );

        if ($salvar) {

            $exam_records->updateOne($condition, array('$set' => $dataToSave));

            $retorno = array(
                'success' => true,
                'message' => 'Registro Salvo com sucesso!',
            );
        }

        return $retorno;
    }
}
