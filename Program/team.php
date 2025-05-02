<?php
include_once("views/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Team.controller.php");

$team = new TeamController();

if (isset($_POST['add'])) {
    $team->add($_POST);
} else if (isset($_POST['update'])) {
    $team->update($_POST);
} else if (isset($_POST['add_member'])) {
    $team->addMember($_POST['team_id'], $_POST['student_id']);
} else if (!empty($_GET['id_hapus'])) {
    $team->delete($_GET['id_hapus']);
} else if (!empty($_GET['id_edit'])) {
    $team->formEdit($_GET['id_edit']);
} else if (!empty($_GET['id_approval'])) {
    $team->approve($_GET['id_approval']);
} else if (!empty($_GET['id_detail'])) {
    if (!empty($_GET['id_remove_member'])) {
        $team->removeMember($_GET['id_detail'], $_GET['id_remove_member']);
    } else {
        $team->detail($_GET['id_detail']);
    }
} else if (isset($_GET['add'])) {
    $team->formAdd();
} else {
    $team->index();
}