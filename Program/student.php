<?php
include_once("views/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Student.controller.php");

$student = new StudentController();

if (isset($_POST['add'])) {
    $student->add($_POST);
} else if (isset($_POST['update'])) {
    $student->update($_POST);
} else if (!empty($_GET['id_hapus'])) {
    $student->delete($_GET['id_hapus']);
} else if (!empty($_GET['id_edit'])) {
    $student->formEdit($_GET['id_edit']);
} else if (isset($_GET['add'])) {
    $student->formAdd();
} else {
    $student->index();
}