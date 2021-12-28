let session_user = $('#session_user').text();

if (session_user) {
    $(".btn.login").hide();
    let session_typeuser = $('#session_typeuser').text();
    if (session_typeuser == 'patient') {
        $(".nav-link.appointments").hide();
        $(".nav-link.exams").hide();
    } else if (session_typeuser == 'doctor') {
        $(".nav-link.doctors").hide();
        $(".nav-link.contact").hide();
        $(".nav-link.exams").hide();
        $(".nav-link.exams-history").hide();
        $(".nav-link.make-exam").hide();
        $(".nav-link.make-appointment").hide();
        $(".page-section.make-appointment").hide();
    } else if (session_typeuser == 'laboratory') {
        $(".nav-link.doctors").hide();
        $(".nav-link.appointments").hide();
        $(".nav-link.appointment-history").hide();
        $(".nav-link.contact").hide();
        $(".nav-link.make-appointment").hide();
        $(".nav-link.make-exam").hide();
        $(".page-section.make-appointment").hide();
    }

} else {
    $(".nav-link.appointments").hide();
    $(".nav-link.exams").hide();
    $(".nav-link.appointment-history").hide();
    $(".nav-link.exams-history").hide();
}

function makeAppointment() {

    var name = $("input.name").val();
    var email = $("input.email").val();
    var phone_number = $('input.phone_number').val();
    var gender = $('select.gender').val();
    var age = $('input.age').val();
    var patient = $('input.cpf').val();
    var date = $('input.date').val();
    var specialty = $('select.specialty').val();
    var address = $('input.address').val();

    date = date.split('-');

    date = date[2] + "-" + date[1] + "-" + date[0];

    var data = {
        name,
        email,
        phone_number,
        gender,
        age,
        patient,
        date,
        specialty,
        address,
        action: 'store'
    };

    $.ajax({
        url: "/app/controllers/appointmentsRecordsController.php",
        contentType: 'application/json',
        data: data,
        dataType: "json",
        success: function(data) {
            alert(data.message);
            // if (data.success) window.location.href = "/views/login.php";
        },
        error: function(data) {
            alert("erro ao efetuar o cadastro");
        }

    });
}

function makeExam() {

    var name = $("input.name").val();
    var email = $("input.email").val();
    var phone_number = $('input.phone_number').val();
    var gender = $('select.gender').val();
    var age = $('input.age').val();
    var patient = $('input.cpf').val();
    var date = $('input.date').val();
    var exam = $('select.exam').val();
    var address = $('input.address').val();

    date = date.split('-');

    date = date[2] + "-" + date[1] + "-" + date[0];


    var data = {
        patient,
        date,
        exam,
        action: 'store'
    };

    $.ajax({
        url: "/app/controllers/examsRecordsController.php",
        contentType: 'application/json',
        data: data,
        dataType: "json",
        success: function(data) {
            alert(data.message);
            // if (data.success) window.location.href = "/views/login.php";
        },
        error: function(data) {
            alert("erro ao efetuar o cadastro");
        }

    });
}

function acceptAppointment(doctor, patient, date) {

    var data = {
        doctor,
        patient,
        date,
        action: 'acceptAppointment'
    };

    $.ajax({
        url: "/app/controllers/appointmentsRecordsController.php",
        contentType: 'application/json',
        data: data,
        dataType: "json",
        success: function(data) {
            data.success ? document.location.reload(true) : alert(data.message);
        },
        error: function(data) {
            alert("erro confirmar consulta");
        }

    });
}

function denialAppointment(doctor, patient, date) {

    var data = {
        doctor,
        patient,
        date,
        action: 'denialAppointment'
    };

    $.ajax({
        url: "/app/controllers/appointmentsRecordsController.php",
        contentType: 'application/json',
        data: data,
        dataType: "json",
        success: function(data) {
            data.success ? document.location.reload(true) : alert(data.message);
        },
        error: function(data) {
            alert("erro confirmar consulta");
        }

    });
}

function seePatientRecords(doctor, patient) {
    var data = {
        doctor,
        patient,
        action: 'seeRecords'
    };

    $.ajax({
        url: "/app/controllers/appointmentsRecordsController.php",
        contentType: 'application/json',
        data: data,
        dataType: "json",
        success: function(data) {
            console.log(data);
            // data.success ? document.location.reload(true) : alert(data.message);
        },
        error: function(data) {
            alert("erro confirmar consulta");
        }

    });
}

function acceptExam(laboratory, patient, date) {

    var data = {
        laboratory,
        patient,
        date,
        action: 'acceptExam'
    };

    $.ajax({
        url: "/app/controllers/examsRecordsController.php",
        contentType: 'application/json',
        data: data,
        dataType: "json",
        success: function(data) {
            data.success ? document.location.reload(true) : alert(data.message);
        },
        error: function(data) {
            alert("erro confirmar consulta");
        }

    });
}

function denialExam(laboratory, patient, date) {

    var data = {
        laboratory,
        patient,
        date,
        action: 'denialExam'
    };

    $.ajax({
        url: "/app/controllers/examsRecordsController.php",
        contentType: 'application/json',
        data: data,
        dataType: "json",
        success: function(data) {
            data.success ? document.location.reload(true) : alert(data.message);
        },
        error: function(data) {
            alert("erro confirmar consulta");
        }

    });
}

function seePatientRecords(doctor, patient) {
    var data = {
        doctor,
        patient,
        action: 'seeRecords'
    };

    $.ajax({
        url: "/app/controllers/appointmentsRecordsController.php",
        contentType: 'application/json',
        data: data,
        dataType: "json",
        success: function(data) {
            console.log(data);
            // data.success ? document.location.reload(true) : alert(data.message);
        },
        error: function(data) {
            alert("erro confirmar consulta");
        }

    });
}