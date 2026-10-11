<?php
    session_start();
    if (!isset($_SESSION["mahasiswa"])) {
        $_SESSION["mahasiswa"] = [];
        $_SESSION["mahasiswa"][] = ["Nama\tNilai\tGrade"];
    }
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $inpnama = $_POST['mhsname'];
        $inpnilai = $_POST['mhsnilai'];
        if($inpnilai <= 40) {
            $grade = 'D';
        } else if ($inpnilai < 70) {
            $grade = 'C';
        } else if ($inpnilai <= 80) {
            $grade = 'B';
        } else {
            $grade = 'A';
        }
        $_SESSION["mahasiswa"][] = ["nama" => $inpnama, "nilai" => $inpnilai, "GRADE" => $grade];
    }
    $mahasiswa = $_SESSION['mahasiswa'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tugas 1 Metro</title>
</head>
<body>
    <a href="logout.php"><button>Reset Data</button></a>
    <form method="post">
        <label>Grading Nilai Mahasiswa</label>
        <table>
            <tr>
                <td>Nama: </td>
                <td><input type="text" name="mhsname"></td>
            </tr>
            <tr>
                <td>Nilai: </td>
                <td><input type="text" name="mhsnilai"></td>
            </tr>
        </table>
        <input type="submit">
    </form>
    <table>
        <?php foreach($mahasiswa as $row): ?>
            <tr>
                <?php foreach($row as $cell): ?>
                    <td><?= $cell?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
