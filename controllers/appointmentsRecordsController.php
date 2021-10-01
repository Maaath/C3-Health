<?php
require('../model/appointmentsRecords.php');
class appointmentsRecordsController extends appointmentsRecords
{

    public function init()
    {
    }

    public function index()
    {
        $appointments_records = new appointmentsRecords();
        $recs = $appointments_records->getAllAppointments();
        print_r($recs);
    }

    public function store($params)
    {
        $appointments_records = new appointmentsRecords();

        $data = array(
            'date' => $params['date'],
            'doctor' => $params['doctor'],
            'patient' => $params['patient'],
            'prescription' => $params['prescription'],
            'obs' => $params['obs'],
        );

        $appointments_records->insertAppointment($data);
    }

    public function edit($params)
    {

        $appointments_records = new appointmentsRecords();

        $data = array(
            'date' => $params['date'],
            'doctor' => $params['doctor'],
            'patient' => $params['patient'],
            'prescription' => $params['prescription'],
            'obs' => $params['obs'],
        );

        $appointments_records->editAppointment($data);
    }

    public function show($params)
    {
        $appointments_records = new appointmentsRecords();

        $data = array(
            'date' => $params['date'],
            'doctor' => $params['doctor'],
            'patient' => $params['patient'],
        );

        $rec = $appointments_records->getAppointment($data);
        var_dump($rec);
    }
}

$appointments_record = new appointmentsRecordsController();

// $params = array(
//     'date' => "09-09-2021",
//     'doctor' => "33355555-1",
//     'patient' => "333.111.222-44",
//     'prescription' => "doctor's prescription",
//     'obs' => "doctor's observation",
// );

// $appointments_record->store($params);

// $params = array(
//     'date' => "09-09-2021",
//     'doctor' => "33355555-1",
//     'patient' => "333.111.222-44",
//     'prescription' => "doctor's prescription updated",
//     'obs' => "doctor's observation updated",
// );

// $appointments_record->edit($params);

// $appointments_record->index();

// $appointments_record->show($params);
