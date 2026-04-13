CREATE DATABASE IF NOT EXISTS db_perpustakaan;
USE db_perpustakaan;

CREATE TABLE anggota (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'anggota') DEFAULT 'anggota'
);

CREATE TABLE buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    penulis VARCHAR(255) NOT NULL
);

CREATE TABLE peminjaman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_buku INT NOT NULL,
    id_anggota INT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    FOREIGN KEY (id_buku) REFERENCES buku(id),
    FOREIGN KEY (id_anggota) REFERENCES anggota(id)
);

-- Insert sample data
INSERT INTO anggota (username, password, role) VALUES
('admin', '$2y$10$examplehashedpassword', 'admin'),
('user1', '$2y$10$examplehashedpassword', 'anggota');

INSERT INTO buku (judul, penulis) VALUES
('Book 1', 'Author 1'),
('Book 2', 'Author 2');