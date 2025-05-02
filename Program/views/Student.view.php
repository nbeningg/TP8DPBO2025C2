<?php

class StudentView
{
    public function render($data)
    {
        $dataStudent = null;
        foreach ($data as $val) {
            list($id, $name, $nim, $phone, $join_date) = $val;
            $dataStudent .= "
            <tr>
                <td>" . $id . "</td>
                <td>" . $name . "</td>
                <td>" . $nim . "</td>
                <td>" . $phone . "</td>
                <td>" . $join_date . "</td>
                <td>
                    <a href='student.php?id_edit=" . $id . "' class='btn btn-success'>Edit</a>
                    <a href='student.php?id_hapus=" . $id . "' class='btn btn-danger'>Delete</a>
                </td>
            </tr>";
        }

        $tpl = new Template("templates/student.html");
        $tpl->replace("JUDUL", "Students");
        $tpl->replace("DATA_TABEL", $dataStudent);
        $tpl->write();
    }

    public function formAdd()
    {
        $tpl = new Template("templates/studentForm.html");
        $tpl->replace("JUDUL", "Add Student");
        $tpl->replace("FORM_ACTION", "student.php");
        $tpl->replace("ACTION_NAME", "add");
        $tpl->replace("ACTION_TITLE", "Add Student");
        $tpl->replace("ACTION_BUTTON", "Submit");
        $tpl->replace("ID_VALUE", "");
        $tpl->replace("NAME_VALUE", "");
        $tpl->replace("NIM_VALUE", "");
        $tpl->replace("PHONE_VALUE", "");
        $tpl->replace("JOIN_DATE_VALUE", "");
        $tpl->write();
    }

    public function formEdit($data)
    {
        list($id, $name, $nim, $phone, $join_date) = $data;
        
        $tpl = new Template("templates/studentForm.html");
        $tpl->replace("JUDUL", "Edit Student");
        $tpl->replace("FORM_ACTION", "student.php");
        $tpl->replace("ACTION_NAME", "update");
        $tpl->replace("ACTION_TITLE", "Edit Student");
        $tpl->replace("ACTION_BUTTON", "Update");
        $tpl->replace("ID_VALUE", $id);
        $tpl->replace("NAME_VALUE", $name);
        $tpl->replace("NIM_VALUE", $nim);
        $tpl->replace("PHONE_VALUE", $phone);
        $tpl->replace("JOIN_DATE_VALUE", $join_date);
        $tpl->write();
    }
}