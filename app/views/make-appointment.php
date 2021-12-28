<?php
session_start()
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="Nome, https://link.com/">

  <title>C3 Health - Make an appointment</title>

  <link rel="stylesheet" href="../../assets/css/maicons.css">

  <link rel="stylesheet" href="../../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../../assets/css/theme.css">

  <script src="../../assets/js/jquery-3.5.1.min.js"></script>

  <script src="../../assets/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="../../assets/js/jquery.mask.min.js"></script>

  <script>
    $(document).ready(function() {
      $("#cpf").mask("000.000.000-00")
      $("#telefone").mask("(00) 0000-00009")
      $("#telefone").blur(function(event) {
        if ($(this).val().length == 15) {
          $("#telefone").mask("(00) 90000-0000")
        } else {
          $("#telefone").mask("(00) 0000-0000")
        }
      })
    })
  </script>

</head>

<body>
  <span id="session_user" hidden><?= $_SESSION['user'] ?></span>
  <span id="session_typeuser" hidden><?= isset($_SESSION['typeUser']) ? $_SESSION['typeUser'] : '' ?></span>
  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> c3health@furg.br</a>
            </div>
          </div>
          <div class="col-sm-4 text-right text-sm">
            <div class="social-mini-button">
              <a href="#"><span class="mai-logo-facebook-f"></span></a>
              <a href="#"><span class="mai-logo-twitter"></span></a>
              <a href="#"><span class="mai-logo-instagram"></span></a>
            </div>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#"><span class="text-primary">C3</span>-Health</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link home" href="/app/views/index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link contact" href="/app/views/contact.php">Contato</a>
            </li>
            <li class="nav-item">
              <a class="nav-link appointments" href="/app/controllers/doctorController.php?action=index">Consultas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link exams" href="/app/controllers/laboratoryController.php?action=index">Exames</a>
            </li>
            <li class="nav-item">
              <a class="nav-link appointment-history" href="/app/controllers/appointmentsRecordsController.php?action=seeRecords&doctor=<?= $_SESSION['user'] ?>&patient=">Histórico de consultas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link exams-history" href="/app/controllers/examsRecordsController.php?action=seeRecords&laboratory=<?= $_SESSION['user'] ?>&patient=">Histórico de exames</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link make-appointment" href="/app/views/make-appointment.php">Marcar consulta</a>
            </li>
            <li class="nav-item">
              <a class="nav-link make-exam" href="/app/views/make-exam.php">Marcar exame</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3 login" href="/app/views/login.php">Entrar / Registrar</a>
            </li>
          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>

  <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Marque a sua consulta</h1>

      <!-- <form class="main-form"> -->
      <div class="row mt-5 ">
        <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
          <input type="text" class="form-control name" placeholder="Nome completo" required>
        </div>
        <div class="col-12 col-sm-6 py-2 wow fadeInRight">
          <input type="text" class="form-control email" placeholder="Email" required>
        </div>
        <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
          <input type="text" class="form-control phone_number" placeholder="Telefone" name="telefone" id="telefone" required>
        </div>
        <div class="col-12 col-sm-6 py-2 wow fadeInRight">
          <select name="gender" id="gender" class="custom-select gender" required>
            <option value="male">Masculino</option>
            <option value="female">Feminino</option>
          </select>
        </div>
        <div class="col-12 col-sm-6 py-2 wow fadeInLeft age">
          <input type="number" class="form-control" placeholder="Idade" required>
        </div>
        <div class="col-12 col-sm-6 py-2 wow fadeInRight">
          <input type="text" class="form-control cpf" placeholder="CPF" name="cpf" id="cpf" required>
        </div>
        <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
          <input type="date" class="form-control date" required>
        </div>
        <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
          <select name="departement" id="departement" class="custom-select specialty" required>
            <option value="general">Clínico Geral</option>
            <option value="cardiology">Cardiologista</option>
            <option value="dental">Dentista</option>
            <option value="neurology">Neurologista</option>
            <option value="orthopaedics">Ortopedista</option>
          </select>
        </div>
        <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
          <input type="text" class="form-control address" placeholder="Endereço" required>
        </div>
      </div>

      <button onclick="makeAppointment()" class="btn btn-primary mt-3 wow zoomIn">Marcar consulta</button>
      <!-- </form> -->
    </div>
  </div> <!-- .page-section -->

  </div> <!-- .banner-home -->

  <footer class="page-footer">
    <div class="container">
      <div class="row px-md-3">
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Compania</h5>
          <ul class="footer-menu">
            <li><a href="#">Sobre Nós</a></li>
            <li><a href="#">Carreira</a></li>
            <li><a href="#">Nosso Time</a></li>
            <li><a href="#">Proteção</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Mais</h5>
          <ul class="footer-menu">
            <li><a href="#">Termos & Condições</a></li>
            <li><a href="#">Privacidade</a></li>
            <li><a href="#">Anúncios</a></li>
            <li><a href="login.php">Entre no nosso time</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Nossos parceiros</h5>
          <ul class="footer-menu">
            <li><a href="#">C3</a></li>
            <li><a href="#">FURG</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Contato</h5>
          <p class="footer-link mt-2">351 Willow Street Franklin, MA 02038</p>
          <a href="#" class="footer-link">701-573-7582</a>
          <h2></h2>
          <a href="#" class="footer-link">c3health@furg.br</a>

          <h5 class="mt-3">Social Media</h5>
          <div class="footer-sosmed mt-3">
            <a href="#" target="_blank"><span class="mai-logo-facebook-f"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-twitter"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-google-plus-g"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-instagram"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-linkedin"></span></a>
          </div>
        </div>

      </div>

      <hr>

      <p id="copyright">Copyright &copy; 2021 Todos os direitos reservados.</p>
    </div>
  </footer>


  <script src="../../assets/js/bootstrap.bundle.min.js"></script>

  <script src="../../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

  <script src="../../assets/vendor/wow/wow.min.js"></script>

  <script src="../../assets/js/theme.js"></script>

  <script src="../../assets/js/home.js"></script>



</body>

</html>