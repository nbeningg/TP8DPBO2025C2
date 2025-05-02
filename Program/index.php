<?php
include_once("views/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Home.controller.php");

$home = new HomeController();
$home->index();