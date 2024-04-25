<?php
// Koneksi ke database
$host = "localhost"; // Ganti sesuai host Anda
$username = "root"; // Ganti sesuai username database Anda
$password = ""; // Ganti sesuai password database Anda
$database = "unj"; // Ganti sesuai nama database Anda

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk memeriksa apakah username sudah terdaftar
$query_check = "SELECT * FROM data WHERE username='$username'";
$result_check = $conn->query($query_check);

if ($result_check->num_rows > 0) {
    // Jika username sudah terdaftar, tampilkan pesan kesalahan
    echo "<div class='panel error'>Username sudah terdaftar. Silakan gunakan username lain.</div>";
} else {
    // Jika username belum terdaftar, lakukan pendaftaran
    // Query untuk memasukkan data ke dalam tabel users
    $query_insert = "INSERT INTO data (username, password) VALUES ('$username', '$password')";
    
    if ($conn->query($query_insert) === TRUE) {
        // Jika pendaftaran berhasil, alihkan ke halaman beranda
        header("Location: unj.html");
        exit(); // Penting untuk menghentikan eksekusi kode setelah mengalihkan
    } else {
        // Jika terjadi kesalahan saat memasukkan data, tampilkan pesan error
        echo "<div class='panel error'>Error: " . $query_insert . "<br>" . $conn->error . "</div>";
    }
}

// Tutup koneksi setelah selesai
$conn->close();
?>
