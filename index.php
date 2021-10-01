<?php
	session_unset();
	// require_once  'controller/homeController.php';		
    // $home_controller = new homeController();	
    // $home_controller->index();
    
    session_start();
    $_SESSION['user'] = null;

    include "./views/index.php";
?>