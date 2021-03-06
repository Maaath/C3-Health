<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="../../assets/css/login.css">

    <script src="../../assets/js/jquery-3.5.1.min.js"></script>

    <script src="../../assets/js/bootstrap.min.js"></script>

    <script src="../../assets/js/login.js"></script>

    <script type="text/javascript" src="../../assets/js/jquery.mask.min.js"></script>

    <script>
        function checkvalue(val) {
            if (val === "none") {

                document.getElementById('name').style.display = 'none';
                document.getElementById('address').style.display = 'none';
                document.getElementById('phone').style.display = 'none';
                document.getElementById('email').style.display = 'none';
                document.getElementById('specialty').style.display = 'none';
                document.getElementById('typeexam').style.display = 'none';
                document.getElementById('gender').style.display = 'none';
                document.getElementById('age').style.display = 'none';
                document.getElementById('crm').style.display = 'none';
                document.getElementById('cnpj').style.display = 'none';
                document.getElementById('cpf').style.display = 'none';
                document.getElementById("namelabel").style.display = 'none';
                document.getElementById("addrlabel").style.display = 'none';
                document.getElementById("phonelabel").style.display = 'none';
                document.getElementById("elabel").style.display = 'none';
                document.getElementById("speclabel").style.display = 'none';
                document.getElementById("genlabel").style.display = 'none';
                document.getElementById("agelabel").style.display = 'none';
                document.getElementById("crmlabel").style.display = 'none';
                document.getElementById("cpflabel").style.display = 'none';
                document.getElementById("cnpjlabel").style.display = 'none';
                document.getElementById("submit").style.display = 'none';
            } else if (val === "doctor") {
                $(".exams").empty();
                document.getElementById('name').style.display = 'block';
                document.getElementById('address').style.display = 'block';
                document.getElementById('phone').style.display = 'block';
                document.getElementById('email').style.display = 'block';
                document.getElementById('specialty').style.display = 'block';
                document.getElementById('typeexam').style.display = 'none';
                document.getElementById('gender').style.display = 'none';
                document.getElementById('age').style.display = 'none';
                document.getElementById('crm').style.display = 'block';
                document.getElementById('cnpj').style.display = 'none';
                document.getElementById('cpf').style.display = 'none';
                document.getElementById("namelabel").style.display = 'block';
                document.getElementById("addrlabel").style.display = 'block';
                document.getElementById("phonelabel").style.display = 'block';
                document.getElementById("elabel").style.display = 'block';
                document.getElementById("speclabel").style.display = 'block';
                document.getElementById("genlabel").style.display = 'none';
                document.getElementById("agelabel").style.display = 'none';
                document.getElementById("crmlabel").style.display = 'block';
                document.getElementById("cpflabel").style.display = 'none';
                document.getElementById("cnpjlabel").style.display = 'none';
                document.getElementById("submit").style.display = 'block';
            } else if (val === "lab") {

                $.ajax({
                    url: "/app/controllers/examsRecordsController.php",
                    contentType: 'application/json',
                    data: {
                        'action': 'getTypeExams'
                    },
                    dataType: "json",
                    success: function(data) {
                        let exam_type = data.reduce(function(acc, curr, index) {
                            curr = Object.entries(curr);
                            new_value = `${acc} 
                                        <div style="display: flex;"> 
                                            <input id="exams_${curr[0][0]}" type="checkbox" class="check" style="display: block;margin:10px 0px"> <label for="check" id=exam_${curr[0][0]} style="display:block; padding: 10px;"> ${curr[0][1]} </label> 
                                        </div> `;
                            return new_value;
                        }, '');
                        $('.exams').append(exam_type);
                        // console.log(exam_type);
                        // if (data.success) window.location.href = "/views/login.php";
                    },
                    error: function(data) {
                        alert("erro ao efetuar o cadastro");
                    }

                });

                document.getElementById('name').style.display = 'block';
                document.getElementById('address').style.display = 'block';
                document.getElementById('phone').style.display = 'block';
                document.getElementById('email').style.display = 'block';
                document.getElementById('specialty').style.display = 'none';
                document.getElementById('typeexam').style.display = 'block';
                document.getElementById('gender').style.display = 'none';
                document.getElementById('age').style.display = 'none';
                document.getElementById('crm').style.display = 'none';
                document.getElementById('cnpj').style.display = 'block';
                document.getElementById('cpf').style.display = 'none';
                document.getElementById("namelabel").style.display = 'block';
                document.getElementById("addrlabel").style.display = 'block';
                document.getElementById("phonelabel").style.display = 'block';
                document.getElementById("elabel").style.display = 'block';
                document.getElementById("speclabel").style.display = 'none';
                document.getElementById("examlabel").style.display = 'block';
                document.getElementById("genlabel").style.display = 'none';
                document.getElementById("agelabel").style.display = 'none';
                document.getElementById("crmlabel").style.display = 'none';
                document.getElementById("cpflabel").style.display = 'none';
                document.getElementById("cnpjlabel").style.display = 'block';
                document.getElementById("submit").style.display = 'block';



            } else if (val === "pat") {
                $(".exams").empty();
                document.getElementById('name').style.display = 'block';
                document.getElementById('address').style.display = 'block';
                document.getElementById('phone').style.display = 'block';
                document.getElementById('email').style.display = 'block';
                document.getElementById('specialty').style.display = 'none';
                document.getElementById('typeexam').style.display = 'none';
                document.getElementById('gender').style.display = 'block';
                document.getElementById('age').style.display = 'block';
                document.getElementById('crm').style.display = 'none';
                document.getElementById('cnpj').style.display = 'none';
                document.getElementById('cpf').style.display = 'block';
                document.getElementById("namelabel").style.display = 'block';
                document.getElementById("addrlabel").style.display = 'block';
                document.getElementById("phonelabel").style.display = 'block';
                document.getElementById("elabel").style.display = 'block';
                document.getElementById("speclabel").style.display = 'none';
                document.getElementById("genlabel").style.display = 'block';
                document.getElementById("agelabel").style.display = 'block';
                document.getElementById("crmlabel").style.display = 'none';
                document.getElementById("cpflabel").style.display = 'block';
                document.getElementById("cnpjlabel").style.display = 'none';
                document.getElementById("submit").style.display = 'block';

            }
        };

        function checkpass(val) {
            if (val == "adm123") {
                document.getElementById('selectlabel').style.display = 'block';
                document.getElementById('usertype').style.display = 'block';
                document.getElementById('admlabel').style.display = 'none';
                document.getElementById('admpass').style.display = 'none';

            }
        };
    </script>

    <script>
        $(document).ready(function() {
            $("#cpf").mask("000.000.000-00")
            $("#cnpj").mask("00.000.000/0000-00")
            var options = {
                translation: {
                    'U': {
                        pattern: /[A-Z]/
                    },
                    'F': {
                        pattern: /[A-Z]/
                    }
                }
            }
            $("#crm").mask("00.000/UF", options)
            $("#phone").mask("(00) 0000-00009")
            $("#phone").blur(function(event) {
                if ($(this).val().length == 15) {
                    $("#phone").mask("(00) 90000-0000")
                } else {
                    $("#phone").mask("(00) 0000-0000")
                }
            })

        })
    </script>


</head>

<body>
    <div class="row">
        <div class="col-md-6 mx-auto p-0">
            <div class="card">
                <div class="login-box">
                    <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Entrar</label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">??rea do Admin</label>
                        <div class="login-space">
                            <div class="login">
                                <div class="group"> <label for="user" class="label">E-mail</label> <input id="user" type="text" class="input" placeholder="Seu e-mail" required> </div>
                                <div class="group"> <label for="pass" class="label">Senha (CPF/CNPJ/CRM)</label> <input id="pass" type="password" class="input" data-type="password" placeholder="Sua senha" required> </div>
                                <div class="group"> <input id="check" type="checkbox" class="check" checked> <label for="check"><span class="icon"></span> Manter-me logado</label> </div>
                                <div class="group"> <input type="submit" class="button" value="Sign In" href="index.php" onclick="login()"> </div>
                                <div class="hr"></div>
                                <div class="foot"> <a href="#">Esqueceu sua senha?</a> </div>
                            </div>
                            <form action="" id="login">
                                <div class="sign-up-form">
                                    <div class="group">
                                        <div class="group"> <label for="pass" class="label" id="admlabel">Senha de Administrador</label> <input id="admpass" type="password" class="input" data-type="password" placeholder="Sua senha" onchange="checkpass(this.value)"> </div>
                                        <label for="usertype" class="label" id="selectlabel" style="display: none;">Selecione</label>
                                        <select class="select" id="usertype" name="select" style="display: none;" onchange="checkvalue(this.value)" required>
                                            <option value="none">-- Tipo de cadastro que deseja fazer --</option>
                                            <option value="doctor">M??dico</option>
                                            <option value="lab">Laborat??rio</option>
                                            <option value="pat">Paciente</option>
                                        </select>
                                    </div>
                                    <div class="group"> <label for="user" class="label" id="namelabel" style="display: none;">Nome</label> <input id="name" type="text" class="required input" placeholder="Nome" style="display: none;" required> </div>
                                    <div class="group"> <label for="pass" class="label" id="addrlabel" style="display: none;">Endere??o</label> <input id="address" type="text" class="input" data-type="endere??o" placeholder="Endere??o" style="display: none;" required> </div>
                                    <div class="group"> <label for="pass" class="label" id="phonelabel" style="display: none;">Telefone</label> <input id="phone" type="text" class="input" data-type="tel" pattern="(\([0-9]{2}\))\s([9]{1})?([0-9]{4})-([0-9]{4})" placeholder=" (99) 9999-9999" style="display: none;" required> </div>
                                    <div class="group"> <label for="pass" class="label" id="elabel" style="display: none;">Email</label> <input id="email" type="email" class="input" placeholder="Email" style="display: none;" required> </div>
                                    <div class="group"> <label for="pass" class="label" id="speclabel" style="display: none;">Especialidade</label> <select class="select" id="specialty" name="select" style="display: none;" onchange=this.value required>
                                            <option value="none">-- Selecione a sua especialidade --</option>
                                            <option value="general">Cl??nico Geral</option>
                                            <option value="cardiology">Cardiologista</option>
                                            <option value="dental">Dentista</option>
                                            <option value="neurology">Neurologista</option>
                                            <option value="orthopaedics">Ortopedista</option>
                                        </select> </div>
                                    <div class="group" id="typeexam" style="display: none;"> <label for="pass" class="label" id="examlabel">Tipos de exame</label>
                                        <div style="display:flex; flex-wrap: wrap;" class="exams">
                                        </div>
                                    </div>
                                    <div class="group"> <label for="pass" class="label" id="genlabel" style="display: none;">G??nero</label> <select class="select" id="gender" name="select" style="display: none;" onchange=this.value required>
                                            <option value="none">-- Selecione o seu g??nero --</option>
                                            <option value="male">Masculino</option>
                                            <option value="female">Feminino</option>
                                        </select> </div>
                                    <div class="group"> <label for="pass" class="label" id="agelabel" style="display: none;">Idade</label> <input id="age" type="number" min="0" max="120" class="input" placeholder="Digite a sua idade" style="display: none;" required> </div>
                                    <div class="group"> <label for="pass" class="label" id="crmlabel" style="display: none;">CRM</label> <input id="crm" type="text" class="input" placeholder="Digite o seu CRM" style="display: none;" required> </div>
                                    <div class="group"> <label for="pass" class="label" id="cnpjlabel" style="display: none;" required>CNPJ</label> <input id="cnpj" type="text" class="input" placeholder="Digite o CNPJ da sua empresa" style="display: none;"> </div>
                                    <div class="group"> <label for="pass" class="label" id="cpflabel" style="display: none;" required>CPF</label> <input id="cpf" type="text" class="input" placeholder="Digite o seu CPF" style="display: none;" required> </div>
                                    <div class="group"> <input type="submit" class="button" id="submit" value="Sign Up" style="display: none;" onclick="cadastrar()" required> </div>
                                    <div class="hr"></div>
                                    <div class="foot"> <label class="foot" for="tab-1">J?? ?? cadastrado?</label> </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>