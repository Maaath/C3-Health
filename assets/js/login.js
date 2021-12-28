function login() {

    let user = $('#user').val();
    let password = $('#pass').val();

    password = password.replaceAll('.', '');
    password = password.replaceAll('-', '');
    password = password.replaceAll('/', '');

    $.ajax({
        url: "/app/controllers/homeController.php",
        contentType: 'application/json',
        data: {
            email: user,
            password,
            action: 'logar'
        },
        dataType: "json",
        success: function(data) {
            data.success ? window.location.href = "/app/views/index.php" : alert(data.message);
        },
        error: function(data) {
            alert("erro ao efetuar o login");
        }

    });
}

function cadastrar() {

    let usertype = $('#usertype').val();
    let name = $('#name').val();
    let address = $('#address').val();
    let phone_number = $('#phone').val();
    let email = $('#email').val();
    let specialty = $('#specialty').val();
    var exam = [1, 2, 3];
    let gender = $('#gender').val();
    let age = $('#age').val();
    let crm = $('#crm').val();
    let cnpj = $('#cnpj').val();
    let cpf = $('#cpf').val();

    if (!$('#exams3').is(":checked")) exam.splice(2, 1);
    if (!$('#exams2').is(":checked")) exam.splice(1, 1);
    if (!$('#exams1').is(":checked")) exam.splice(0, 1);

    if (usertype == 'doctor') {
        var url = "/app/controllers/doctorController.php";
        var data = {
            name,
            email,
            address,
            phone_number,
            specialty,
            crm,
            action: 'store'
        };
    } else if (usertype == 'lab') {
        var url = "/app/controllers/laboratoryController.php";
        var data = {
            name,
            email,
            address,
            phone_number,
            exams: exam,
            cnpj,
            action: 'store'
        };
    } else if (usertype == 'pat') {
        var url = "/app/controllers/patientController.php";
        var data = {
            name,
            email,
            address,
            phone_number,
            gender,
            age,
            cpf,
            action: 'store'
        };
    }

    $.ajax({
        url: url,
        contentType: 'application/json',
        data: data,
        dataType: "json",
        success: function(data) {
            alert(data.message);
            if (data.success) window.location.href = "/app/views/login.php";
        },
        error: function(data) {
            alert("erro ao efetuar o cadastro");
        }

    });
}