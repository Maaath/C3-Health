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

  <title>C3 Health - Appointment History</title>

  <link rel="stylesheet" href="../../assets/css/maicons.css">

  <link rel="stylesheet" href="../../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../../assets/css/theme.css">
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

        <!-- <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="Pesquise aqui" aria-label="Username" aria-describedby="icon-addon1">
          </div>
        </form> -->

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
            <li class="nav-item active">
              <a class="nav-link appointment-history" href="/app/controllers/appointmentsRecordsController.php?action=seeRecords&doctor=<?= $_SESSION['user'] ?>&patient=">Histórico de consultas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link exams-history" href="/app/controllers/examsRecordsController.php?action=seeRecords&laboratory=<?= $_SESSION['user'] ?>&patient=">Histórico de exames</a>
            </li>
            <li class="nav-item">
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

  <div class="page-banner overlay-dark bg-image" style="background-image: url(../../assets/img/bg_image_1.jpg);">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Histórico de consultas</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">Histórico de consultas</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section">

  <div class="counters">
      <select id="counters" class="form-control form-control-sm" aria-label="Default select example">
        <option value="" selected>Quantidade de Exames:</option>
        <option value="<?= $_SESSION['counters'][0] ?>">Mensal</option>
        <option value="<?= $_SESSION['counters'][1] ?>">Anual</option>
        <option value="<?= $_SESSION['counters'][2] ?>">Média Mensal</option>
        <option value="<?= $_SESSION['counters'][3] ?>">Média Anual</option>
      </select>
    </div>

    <div class="num-counters">
      <h2 class="text-center mb-5 wow  counter-result" style="color: #00D9A5 ;"></h2> <!-- Resultado da consulta -->
    </div>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10 mt-5">
          <h1 class="text-center mb-5 wow fadeInUp" style="color: #00D9A5 ;">Consultas Anteriores</h1>
          <div class="owl-carousel wow fadeInUp" id="myCarrousel">

            <?php
            if (count($_SESSION['patient_record'])) {
              foreach ($_SESSION['patient_record'] as $value) {
            ?>
                <div class="item">
                  <div class="card-doctor">
                    <div class="header">
                      <img src="../../assets/img/place_holder.png" alt="">
                    </div>
                    <div class="body">
                      <p class="text-xl mb-1"><?= $value['patient_name'] ?></p>
                      <p class="text mb-1" style="color: red;"><?= $value['doctor_name'] ?></p>
                      <span class="text-sm text-grey"><?= str_replace("-", "/", $value->date) ?></span>
                    </div>
                    <div class="body">
                      <span class="text-sm text-grey"><?= $value->prescription ?></span>
                    </div>
                    <div class="body">
                      <span class="text-sm text-grey"><?= $value->obs ?></span>
                    </div>
                  </div>
                </div>
            <?php

              }
            }
            ?>

          </div> <!-- carrousel -->

        </div> <!-- col -->
      </div> <!-- row -->
    </div> <!-- container -->
  </div> <!-- page -->


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

  <script src="../../assets/js/jquery-3.5.1.min.js"></script>

  <script src="../../assets/js/bootstrap.bundle.min.js"></script>

  <script src="../../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

  <script src="../../assets/vendor/wow/wow.min.js"></script>

  <script src="../../assets/js/google-maps.js"></script>

  <script src="../../assets/js/theme.js"></script>

  <script src="../../assets/js/home.js"></script>

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIA_zqjFMsJM_sxP9-6Pde5vVCTyJmUHM&callback=initMap"></script>

</body>

</html>