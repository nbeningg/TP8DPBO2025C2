<?php

class Student extends DB
{
    // mengambil semua data student
    function getStudent()
    {
        $query = "SELECT * FROM students";
        return $this->execute($query);
    }

    // mengambil data student berdasarkan id
    function getStudentById($id)
    {
        $query = "SELECT * FROM students WHERE id = '$id'";
        return $this->execute($query);
    }

    // mengambil data student yang belum masuk sebuah tim
    function getStudentsNotInTeam($teamId)
    {
        $query = "SELECT * FROM students WHERE id NOT IN (SELECT student_id FROM team_member WHERE team_id = '$teamId')";
        return $this->execute($query);
    }

    // menambahkan data student baru
    function add($data)
    {
        $name = $data['name'];
        $nim = $data['nim'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];

        $query = "INSERT INTO students VALUES ('', '$name', '$nim', '$phone', '$join_date')";
        return $this->execute($query);
    }

    // update data stundent berdasarkan id
    function update($data)
    {
        $id = $data['id'];
        $name = $data['name'];
        $nim = $data['nim'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];

        $query = "UPDATE students SET name = '$name', nim = '$nim', phone = '$phone', join_date = '$join_date' WHERE id = '$id'";
        return $this->execute($query);
    }

    // delete data student berdasarkan id
    function delete($id)
    {
        $query = "DELETE FROM students WHERE id = '$id'";
        return $this->execute($query);
    }
}