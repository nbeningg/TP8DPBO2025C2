-- Buat database dan gunakan
CREATE DATABASE gelatik;
USE gelatik;

-- Tabel students
CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  nim VARCHAR(20) NOT NULL,
  phone VARCHAR(15) NOT NULL,
  join_date DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel team
CREATE TABLE team (
  id INT AUTO_INCREMENT PRIMARY KEY,
  team_name VARCHAR(100) NOT NULL,
  category VARCHAR(100) NOT NULL,
  title VARCHAR(200) NOT NULL,
  submission_date DATE NOT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabel team_member
CREATE TABLE team_member (
  id INT AUTO_INCREMENT PRIMARY KEY,
  team_id INT NOT NULL,
  student_id INT NOT NULL,
  FOREIGN KEY (team_id) REFERENCES team(id) ON DELETE CASCADE,
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data students
INSERT INTO students (name, nim, phone, join_date) VALUES
('Julian', '230101001', '081234567890', '2024-01-10'),
('Natasha', '230101002', '081234567891', '2024-01-12'),
('Bening', '230101003', '081234567892', '2024-01-15'),
('Ghifari', '230101004', '081234567893', '2024-01-17'),
('Meisya', '230101005', '081234567894', '2024-01-18'),
('Azzam', '230101006', '081234567895', '2024-01-20');

-- Data team
INSERT INTO team (team_name, category, title, submission_date, status) VALUES
('CyberX', 'Keamanan Siber (Cyber Security)', 'Keamanan Jaringan pada Era IoT', '2024-03-01', 'Pending'),
('DataPros', 'Penambangan Data (Data Mining)', 'Analisis Pola Belanja Mahasiswa', '2024-03-02', 'Pending'),
('InovEdu', 'Inovasi Teknologi Digital Pendidikan (ITDP)', 'Platform Pembelajaran Adaptif', '2024-03-03', 'Pending'),
('PixelWave', 'Animasi (Animation)', 'Animasi Edukasi Mengenai Sampah Plastik', '2024-03-04', 'Pending');

-- Data team_member
INSERT INTO team_member (team_id, student_id) VALUES
(1, 1),
(1, 2), 
(2, 3), 
(2, 4), 
(3, 5), 
(4, 6); 
