<?php
include_once("conf.php");
include_once("models/Student.class.php");
include_once("models/Team.class.php");
include_once("views/Home.view.php");

class HomeController
{
    // properti kontroler
    private $student;
    private $team;

    // konstruktor kontroler home
    function __construct()
    {
        $this->student = new Student(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->team = new Team(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    // method yang mengarahkan ke halaman utama home
    public function index()
    {
        // ambil total student
        $this->student->open();
        $this->student->getStudent();
        $totalStudents = 0;
        while ($this->student->getResult()) {
            $totalStudents++;
        }
        $this->student->close();
        
        // ambil total team
        $this->team->open();
        $this->team->getTeam();
        $totalTeams = 0;
        $approvedTeams = 0;
        
        while ($row = $this->team->getResult()) {
            $totalTeams++;
            // ambil total team yang sudah di approved
            if ($row['status'] == 'Approved') {
                $approvedTeams++;
            }
        }
        $this->team->close();
        
        $stats = [
            'totalStudents' => $totalStudents,
            'totalTeams' => $totalTeams,
            'approvedTeams' => $approvedTeams
        ];
        
        // meneruskan ke view
        $view = new HomeView();
        $view->render($stats);
    }
}