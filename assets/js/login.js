// $(function() {

//     $('#login-form-link').click(function(e) {
// 		$("#login-form").delay(100).fadeIn(100);
//  		$("#register-form").fadeOut(100);
// 		$('#register-form-link').removeClass('active');
// 		$(this).addClass('active');
// 		e.preventDefault();
// 	});
// 	$('#register-form-link').click(function(e) {
// 		$("#register-form").delay(100).fadeIn(100);
//  		$("#login-form").fadeOut(100);
// 		$('#login-form-link').removeClass('active');
// 		$(this).addClass('active');
// 		e.preventDefault();
// 	});
// 	$('#login').on('submit',function(e) {
// 		$.ajax({
// 			type: "POST",
// 			// data: {
// 			// invoiceno:jobid
// 			// },
// 			url: "c3-health/controllers/DoctorController/index",
// 			dataType: "html",
// 			async: false,
// 			success: function(data) {
// 				console.log(data);
// 			}		
// 	});
// 	});
// $('#login').attr({
//     onsubmit: 'return true',
//     action: '/controllers/homeController.php',
//     target: ''
// }).submit();
// // });
// $("#submit").on('click', function() {
//     alert("teste");
// });


function login() {

    let user = $('#user').val();
    let password = $('#pass').val();

    password = password.replaceAll('.', '');
    password = password.replaceAll('-', '');
    password = password.replaceAll('/', '');

    $.ajax({
        url: "/controllers/homeController.php",
        contentType: 'application/json',
        data: {
            email: user,
            password,
            action: 'logar'
        },
        dataType: "json",
        success: function(data) {
            data.success ? window.location.href = "/views/index.php" : alert(data.message);
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
    let exam = $('#exams').val();
    let gender = $('#gender').val();
    let age = $('#age').val();
    let crm = $('#crm').val();
    let cnpj = $('#cnpj').val();
    let cpf = $('#cpf').val();
    alert("in");
    // console.log(usertype, name, address, phone_number, email, specialty, exams, gender, age, crm, cnpj, cpf);

    if (usertype == 'doctor') {
        var url = "/controllers/doctorController.php";
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
        var url = "/controllers/laboratoryController.php";
        var data = {
            name,
            email,
            address,
            phone_number,
            exams: [exam],
            cnpj,
            action: 'store'
        };
    } else if (usertype == 'pat') {
        var url = "/controllers/patientController.php";
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
            if (data.success) window.location.href = "/views/login.php";
        },
        error: function(data) {
            alert("erro ao efetuar o cadastro");
        }

    });
}