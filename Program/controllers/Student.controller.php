<?php
include_once("conf.php");
include_once("models/Student.class.php");
include_once("views/Student.view.php");

class StudentController
{
    // properti kontroler
    private $student;

    // konstruktor kontroler student
    function __construct()
    {
        $this->student = new Student(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    // method yang mengarahkan ke halaman umum controller student
    public function index()
    {
        // membuka jalur ke database
        $this->student->open();

        // meneruskan request dari view (mengambil data student)
        $this->student->getStudent();
        
        // push data yang berbentuk object 1 per 1 ke variabel
        $data = array();
        while ($row = $this->student->getResult()) {
            array_push($data, $row);
        }
        
        // menutup jalur ke database
        $this->student->close();
        
        // meneruskan ke view
        $view = new StudentView();
        $view->render($data);
    }

    // method untuk menampilkan form tambah student
    public function formAdd()
    {
        $view = new StudentView();
        $view->formAdd();
    }

    // method untuk menampilkan form edit student berdasarkan id
    public function formEdit($id)
    {
        $this->student->open(); // membuka jalur ke database
        $this->student->getStudentById($id); // mengambil data student berdasarkan id
        $data = $this->student->getResult(); // menyimpan hasil query
        $this->student->close();  // menutup jalur ke database
        
        // menampilkan form edit dengan data student yang dipilih
        $view = new StudentView();
        $view->formEdit($data);
    }

    // method untuk menambahkan data student baru
    public function add($data)
    {
        $this->student->open(); // membuka jalur ke database
        $this->student->add($data); // menambahkan data student baru
        $this->student->close(); // menutup jalur ke database
        
        header("location:student.php");
    }

    // method untuk memperbarui data student
    public function update($data)
    {
        $this->student->open(); // membuka jalur ke database
        $this->student->update($data); // memperbarui data student
        $this->student->close(); // menutup jalur ke database
        
        header("location:student.php");
    }

    // method untuk menghapus data student berdasarkan id
    public function delete($id)
    {
        $this->student->open(); // membuka jalur ke database
        $this->student->delete($id); // menghapus data student berdasarkan id
        $this->student->close(); // menutup jalur ke database
        
        header("location:student.php");
    }
}