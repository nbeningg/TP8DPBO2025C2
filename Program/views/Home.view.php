<?php

class HomeView
{
    public function render($stats)
    {
        $tpl = new Template("templates/index.html");
        $tpl->replace("JUDUL", "Gelatik Management Home");
        $tpl->replace("TOTAL_STUDENTS", $stats['totalStudents']);
        $tpl->replace("TOTAL_TEAMS", $stats['totalTeams']);
        $tpl->replace("APPROVED_TEAMS", $stats['approvedTeams']);
        $tpl->write();
    }
}