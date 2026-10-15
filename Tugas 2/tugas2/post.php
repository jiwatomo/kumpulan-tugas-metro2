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

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $judul        = trim($_POST['judul'] ?? '');
    $tahun_terbit = trim($_POST['tahun_terbit'] ?? '');
    $kategori     = trim($_POST['kategori'] ?? '');
    $isbn_doi     = trim($_POST['isbn_doi'] ?? '');
    $lokasi       = trim($_POST['lokasi'] ?? '');
    $penerbit       = trim($_POST['penerbit'] ?? '');
    $pengarang       = trim($_POST['pengarang'] ?? '');

    // var_dump($_POST);
    // exit;

    // Error handler
    $errors = [];

    if ($judul === '') {
        $errors[] = 'Judul buku wajib diisi.';
    }
    if ($tahun_terbit === '' || !ctype_digit($tahun_terbit)) {
        $errors[] = 'Tahun terbit harus berupa angka.';
    } elseif ((int) $tahun_terbit < 1000 || (int) $tahun_terbit > (int) date('Y')) {
        $errors[] = 'Tahun terbit tidak valid.';
    }

    $allowedKategori = ['Sejarah', 'Teknologi', 'MIPA', 'Ekonomi', 'Hukum'];
    if (!in_array($kategori, $allowedKategori, true)) {
        $errors[] = 'Kategori tidak valid.';
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old']    = $_POST;
        header('Location: index.php');
        exit;
    }

    // Post buku baru
    $sql = 'INSERT INTO buku (judul, tahun_terbit, kategori, isbn_doi, lokasi, penerbit, pengarang)
            VALUES (?, ?, ?, ?, ?, ?, ?)';

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        $_SESSION['errors'] = ['Prepare failed: ' . $conn->error];
        header('Location: index.php');
        exit;
    }

    $isbn_doi = $isbn_doi !== '' ? $isbn_doi : null;
    $lokasi   = $lokasi   !== '' ? $lokasi   : null;
    $penerbit = $penerbit !== '' ? $penerbit : null;
    $pengarang   = $pengarang   !== '' ? $pengarang   : null;

    $stmt->bind_param(
        'sisssss',
        $judul,
        $tahun_terbit,
        $kategori,
        $isbn_doi,
        $lokasi,
        $penerbit,
        $pengarang
    );

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Buku berhasil ditambahkan.';
    } else {
        $_SESSION['errors'] = ['Gagal menyimpan: ' . $stmt->error];
    }

    $stmt->close();
    $conn->close();

    header('Location: index.php');
    exit;
?>
