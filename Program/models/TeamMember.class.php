<?php

class TeamMember extends DB
{
    // mengambil semua data anggota tim (detail tim)
    function getTeamMembers($team_id)
    {
        $query = "SELECT tm.id, s.name, s.nim, s.phone 
                FROM team_member tm 
                JOIN students s ON tm.student_id = s.id 
                WHERE tm.team_id = '$team_id'";
        return $this->execute($query);
    }

    // menghitung jumlah anggota dari sebuah tim
    function countTeamMembers($team_id)
    {
        $query = "SELECT COUNT(*) as count FROM team_member WHERE team_id = '$team_id'";
        $this->execute($query);
        $result = $this->getResult();
        return $result['count'];
    }

    // menambahkan anggota baru ke sebuah tim
    function add($team_id, $student_id)
    {
        $query = "INSERT INTO team_member VALUES ('', '$team_id', '$student_id')";
        return $this->execute($query);
    }

    // hapus anggota dari sebuah tim
    function delete($id)
    {
        $query = "DELETE FROM team_member WHERE id = '$id'";
        return $this->execute($query);
    }

    // hapus semua anggota tim
    function deleteByTeamId($team_id)
    {
        $query = "DELETE FROM team_member WHERE team_id = '$team_id'";
        return $this->execute($query);
    }
}
