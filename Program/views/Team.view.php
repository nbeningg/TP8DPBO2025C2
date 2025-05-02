<?php

class TeamView
{
    public function render($data)
    {
        $dataTeam = null;
        foreach ($data as $val) {
            list($id, $team_name, $category, $title, $submission_date, $status) = $val;
            
            if ($status == 'Approved') {
                $dataTeam .= "
                <tr>
                    <td>" . $id . "</td>
                    <td>" . $team_name . "</td>
                    <td>" . $category . "</td>
                    <td>" . $title . "</td>
                    <td>" . $submission_date . "</td>
                    <td>" . $status . "</td>
                    <td>
                        <a href='team.php?id_detail=" . $id . "' class='btn btn-primary'>Details</a>
                        <a href='team.php?id_hapus=" . $id . "' class='btn btn-danger'>Delete</a>
                    </td>
                </tr>";
            } else {
                $dataTeam .= "
                <tr>
                    <td>" . $id . "</td>
                    <td>" . $team_name . "</td>
                    <td>" . $category . "</td>
                    <td>" . $title . "</td>
                    <td>" . $submission_date . "</td>
                    <td>" . $status . "</td>
                    <td>
                        <a href='team.php?id_detail=" . $id . "' class='btn btn-primary'>Details</a>
                        <a href='team.php?id_edit=" . $id . "' class='btn btn-success'>Edit</a>
                        <a href='team.php?id_approval=" . $id . "' class='btn btn-warning'>Approve</a>
                        <a href='team.php?id_hapus=" . $id . "' class='btn btn-danger'>Delete</a>
                    </td>
                </tr>";
            }
        }

        $tpl = new Template("templates/team.html");
        $tpl->replace("JUDUL", "Teams");
        $tpl->replace("DATA_TABEL", $dataTeam);
        $tpl->write();
    }

    public function formAdd($categories)
    {
        $categoryOptions = "";
        foreach ($categories as $category) {
            $categoryOptions .= "<option value='" . $category . "'>" . $category . "</option>";
        }

        $tpl = new Template("templates/teamForm.html");
        $tpl->replace("JUDUL", "Add Team");
        $tpl->replace("FORM_ACTION", "team.php");
        $tpl->replace("ACTION_NAME", "add");
        $tpl->replace("ACTION_TITLE", "Add Team");
        $tpl->replace("ACTION_BUTTON", "Submit");
        $tpl->replace("ID_VALUE", "");
        $tpl->replace("TEAM_NAME_VALUE", "");
        $tpl->replace("CATEGORY_OPTIONS", $categoryOptions);
        $tpl->replace("TITLE_VALUE", "");
        $tpl->replace("SUBMISSION_DATE_VALUE", "");
        $tpl->write();
    }

    public function formEdit($data, $categories)
    {
        list($id, $team_name, $category, $title, $submission_date) = $data;
        
        $categoryOptions = "";
        foreach ($categories as $cat) {
            $selected = ($cat == $category) ? "selected" : "";
            $categoryOptions .= "<option value='" . $cat . "' " . $selected . ">" . $cat . "</option>";
        }

        $tpl = new Template("templates/teamForm.html");
        $tpl->replace("JUDUL", "Edit Team");
        $tpl->replace("FORM_ACTION", "team.php");
        $tpl->replace("ACTION_NAME", "update");
        $tpl->replace("ACTION_TITLE", "Edit Team");
        $tpl->replace("ACTION_BUTTON", "Update");
        $tpl->replace("ID_VALUE", $id);
        $tpl->replace("TEAM_NAME_VALUE", $team_name);
        $tpl->replace("CATEGORY_OPTIONS", $categoryOptions);
        $tpl->replace("TITLE_VALUE", $title);
        $tpl->replace("SUBMISSION_DATE_VALUE", $submission_date);
        $tpl->write();
    }

    public function renderDetail($team, $members, $availableStudents)
    {
        list($id, $team_name, $category, $title, $submission_date, $status) = $team;
        
        $dataMember = "";
        $no = 1;
        foreach ($members as $member) {
            list($member_id, $name, $nim, $phone) = $member;
            $dataMember .= "
            <tr>
                <td>" . $no++ . "</td>
                <td>" . $name . "</td>
                <td>" . $nim . "</td>
                <td>" . $phone . "</td>
                <td>
                    <a href='team.php?id_detail=" . $id . "&id_remove_member=" . $member_id . "' class='btn btn-danger'>Remove</a>
                </td>
            </tr>";
        }

        $studentsOption = "";
        if (!empty($availableStudents)) {
            foreach ($availableStudents as $student) {
                list($student_id, $name, $nim, $phone, $join_date) = $student;
                $studentsOption .= "<option value='" . $student_id . "'>" . $name . " (" . $nim . ")</option>";
            }
        }

        $tpl = new Template("templates/teamDetail.html");
        $tpl->replace("JUDUL", "Team Detail");
        $tpl->replace("TEAM_ID", $id);
        $tpl->replace("TEAM_NAME", $team_name);
        $tpl->replace("CATEGORY", $category);
        $tpl->replace("TITLE", $title);
        $tpl->replace("SUBMISSION_DATE", $submission_date);
        $tpl->replace("STATUS", $status);
        $tpl->replace("DATA_MEMBER", $dataMember);
        $tpl->replace("STUDENTS_OPTION", $studentsOption);
        $tpl->write();
    }
}