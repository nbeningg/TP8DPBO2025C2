<?php

class Team extends DB
{
    // mengambil semua data team
    function getTeam()
    {
        $query = "SELECT * FROM team";
        return $this->execute($query);
    }

    // mengambil data tim berdasarkan id
    function getTeamById($id)
    {
        $query = "SELECT * FROM team WHERE id = '$id'";
        return $this->execute($query);
    }

    // menambahkan data tim baru
    function add($data)
    {
        $team_name = $data['team_name'];
        $category = $data['category'];
        $title = $data['title'];
        $submission_date = $data['submission_date'];
        $status = 'Pending';

        $query = "INSERT INTO team VALUES ('', '$team_name', '$category', '$title', '$submission_date', '$status')";
        return $this->execute($query);
    }

    // update data tim berdasarkan id
    function update($data)
    {
        $id = $data['id'];
        $team_name = $data['team_name'];
        $category = $data['category'];
        $title = $data['title'];
        $submission_date = $data['submission_date'];

        $query = "UPDATE team SET team_name = '$team_name', category = '$category', title = '$title', submission_date = '$submission_date' WHERE id = '$id'";
        return $this->execute($query);
    }

    // hapus data tim berdasarkan id
    function delete($id)
    {
        $query = "DELETE FROM team WHERE id = '$id'";
        return $this->execute($query);
    }

    // update status data tim jadi disetujui
    function updateStatus($id)
    {
        $query = "UPDATE team SET status = 'Approved' WHERE id = '$id'";
        return $this->execute($query);
    }
}