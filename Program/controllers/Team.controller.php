<?php
include_once("conf.php");
include_once("models/Team.class.php");
include_once("models/Student.class.php");
include_once("models/TeamMember.class.php");
include_once("views/Team.view.php");

class TeamController
{
    // properti kontroler
    private $team;
    private $student;
    private $teamMember;
    private $categories;

    // konstruktor kontroler team
    function __construct()
    {
        $this->team = new Team(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->student = new Student(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->teamMember = new TeamMember(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        
        // kategori / cabang lomba gelatik yang tersedia untuk dipilih
        $this->categories = [
            "Pemrograman (Programming)",
            "Keamanan Siber (Cyber Security)",
            "Penambangan Data (Data Mining)",
            "Desain Pengalaman Pengguna (UX Design)",
            "Animasi (Animation)",
            "Kota Cerdas (Smart City)",
            "Karya Tulis Ilmiah TIK (ICT Scientific Paper)",
            "Pengembangan Perangkat Lunak (Software Development)",
            "Peranti Cerdas, Sistem Benam & Internet Untuk Segala (Smart Device, Embedded System & IoT)",
            "Pengembangan Aplikasi Bermain (Game Development)",
            "Pengembangan Bisnis TIK (ICT Business Development)",
            "Kecerdasan Buatan (Artificial Intelligence)",
            "Kompetisi Statistika Nasional / National Statistics Competition (NSC)",
            "Kompetisi Esai Statistika / Statistics Essay Competition (SEC)",
            "Kompetisi Infografis Statistika / Statistics Infographic Competition (SIC)",
            "Tantangan Mahadata / Big Data Challenges (BDC)",
            "Inovasi Teknologi Digital Pendidikan (ITDP)",
            "Inovasi Pembelajaran Digital Pendidikan (IPDP)",
            "Video Digital Pendidikan (VDP)",
            "Poster Digital Pendidikan (PDP)",
            "Microteaching Digital Pendidikan (MTDP)"
        ];
    }

    // method untuk menampilkan daftar semua tim
    public function index()
    {
        // membuka koneksi ke database
        $this->team->open();

        // mengambil semua data tim
        $this->team->getTeam();
        
        // menyimpan data tim ke dalam array
        $data = array();
        while ($row = $this->team->getResult()) {
            array_push($data, $row);
        }

        // menutup koneksi database
        $this->team->close();
        
        // menampilkan halaman dengan data tim
        $view = new TeamView();
        $view->render($data);
    }

    // method untuk menampilkan form tambah tim
    public function formAdd()
    {
        $view = new TeamView();
        $view->formAdd($this->categories);
    }

    // method untuk menampilkan form edit tim
    public function formEdit($id)
    {
        $this->team->open(); // membuka koneksi ke database
        $this->team->getTeamById($id);  // mengambil data tim berdasarkan id
        $data = $this->team->getResult(); // menyimpan data tim
        $this->team->close(); // menutup koneksi database
        
        // menampilkan form edit dengan data tim dan daftar kategori
        $view = new TeamView();
        $view->formEdit($data, $this->categories);
    }

    // method untuk menampilkan detail tim dan anggotanya
    public function detail($id)
    {
        // mengambil data tim
        $this->team->open();
        $this->team->getTeamById($id);
        $teamData = $this->team->getResult();
        $this->team->close();
        
        // mengambil data anggota tim
        $this->teamMember->open();
        $this->teamMember->getTeamMembers($id);
        $members = array();
        while ($row = $this->teamMember->getResult()) {
            array_push($members, $row);
        }
        
        // mengambil data mahasiswa yang belum menjadi anggota tim (saat ini)
        $this->student->open();
        $this->student->getStudentsNotInTeam($id);
        $availableStudents = array();
        while ($row = $this->student->getResult()) {
            array_push($availableStudents, $row);
        }
        
        // menutup koneksi database
        $this->student->close();
        $this->teamMember->close();
        
        // menampilkan halaman
        $view = new TeamView();
        $view->renderDetail($teamData, $members, $availableStudents);
    }
    
    // method untuk menambahkan anggota ke tim
    public function addMember($team_id, $student_id)
    {
        // membuka koneksi ke database
        $this->teamMember->open();
        
        // memeriksa apakah tim sudah memiliki 3 anggota
        $count = $this->teamMember->countTeamMembers($team_id);
        
        // jika anggota kurang dari 3, bisa tambahkan anggota baru
        if ($count < 3) {
            $this->teamMember->add($team_id, $student_id);
        }
        
        // menutup koneksi database
        $this->teamMember->close();
        
        header("location:team.php?id_detail=" . $team_id);
    }
    
    // method untuk menghapus anggota dari tim
    public function removeMember($team_id, $member_id)
    {
        $this->teamMember->open(); // membuka koneksi ke database
        $this->teamMember->delete($member_id);  // menghapus anggota tim
        $this->teamMember->close(); // menutup koneksi database
        
        header("location:team.php?id_detail=" . $team_id);
    }

     // method untuk menambahkan tim baru
    public function add($data)
    {
        $this->team->open(); // membuka koneksi ke database
        $this->team->add($data); // menambahkan data tim baru
        $this->team->close();  // menutup koneksi database
        
        header("location:team.php");
    }

    // method untuk memperbarui data tim
    public function update($data)
    {
        $this->team->open(); // membuka koneksi ke database
        $this->team->update($data); // memperbarui data tim
        $this->team->close(); // menutup koneksi database
        
        header("location:team.php");
    }

    // method untuk menyetujui tim
    public function approve($id)
    {
        $this->team->open(); // membuka koneksi ke database
        $this->team->updateStatus($id);  // memperbarui status tim menjadi disetujui
        $this->team->close(); // menutup koneksi database
        
        header("location:team.php");
    }

    // method untuk menghapus tim
    public function delete($id)
    {
        // menghapus semua anggota tim terlebih dahulu
        $this->teamMember->open();
        $this->teamMember->deleteByTeamId($id);
        $this->teamMember->close(); 
        
        // kemudian menghapus tim
        $this->team->open();
        $this->team->delete($id);
        $this->team->close();
        
        header("location:team.php");
    }
}