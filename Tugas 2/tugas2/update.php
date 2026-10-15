<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
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
    if ($conn->connect_error) die('Connection failed: ' . $conn->connect_error);
    $conn->set_charset('utf8mb4');

    $id           = (int) ($_POST['edit-id'] ?? 0);
    $judul        = trim($_POST['edit-judul'] ?? '');
    $tahun_terbit = trim($_POST['edit-terbit'] ?? '');
    $kategori     = trim($_POST['edit-kategori'] ?? '');
    $isbn_doi     = trim($_POST['edit-isbn'] ?? '');
    $lokasi       = trim($_POST['edit-lokasi'] ?? '');
    // var_dump($_POST);
    // exit;
    $errors = [];
    if ($id <= 0)                                                              $errors[] = 'ID tidak valid.';
    if ($judul === '')                                                         $errors[] = 'Judul wajib diisi.';
    if (!ctype_digit($tahun_terbit))                                           $errors[] = 'Tahun terbit harus angka.';
    if (!in_array($kategori, ['Sejarah','Teknologi','MIPA','Ekonomi','Hukum'], true)) $errors[] = 'Kategori tidak valid.';

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: index.php');
        exit;
    }

    $isbn_doi = $isbn_doi !== '' ? $isbn_doi : null;
    $lokasi   = $lokasi   !== '' ? $lokasi   : null;
    $tahun    = (int) $tahun_terbit;

    $sql = 'UPDATE buku
            SET judul = ?, tahun_terbit = ?, kategori = ?, isbn_doi = ?, lokasi = ?
            WHERE id = ?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sisssi', $judul, $tahun, $kategori, $isbn_doi, $lokasi, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Buku berhasil diperbarui.';
    } else {
        $_SESSION['errors'] = ['Gagal memperbarui: ' . $stmt->error];
    }

    $stmt->close();
    $conn->close();

    header('Location: index.php');
    exit;
?>
