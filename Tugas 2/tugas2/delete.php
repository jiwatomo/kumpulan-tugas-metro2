<?php
    session_start();

    // Handle post
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php');
        exit;
    }

    $id = (int) ($_POST['id'] ?? 0);
    if ($id <= 0) {
        $_SESSION['errors'] = ['ID buku tidak valid.'];
        header('Location: index.php');
        exit;
    }

    // ENV
    $dbname = 'Tugas2mentee';
    $dbhost = '127.0.0.1';
    $dbuser = 'root';
    $dbpw = '14731332';

    // Connection
    $conn = new mysqli($dbhost, $dbuser, $dbpw, $dbname);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    $conn->set_charset('utf8mb4');

    $stmt = $conn->prepare('DELETE FROM buku WHERE id = ?');
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $_SESSION['success'] = 'Buku berhasil dihapus.';
        } else {
            $_SESSION['errors'] = ['Buku tidak ditemukan.'];
        }
    } else {
        $_SESSION['errors'] = ['Gagal menghapus: ' . $stmt->error];
    }

    $stmt->close();
    $conn->close();

    header('Location: index.php');
    exit;
?>
