<?php
include 'koneksi.php';

// Ambil data kelas untuk dropdown
$query_kelas = "SELECT * FROM kelas";
$result_kelas = mysqli_query($koneksi, $query_kelas);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = htmlspecialchars($_POST['nis']);
    $nama = htmlspecialchars($_POST['nama']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $tempat_lahir = htmlspecialchars($_POST['tempat_lahir']);
    $tanggal_lahir = htmlspecialchars($_POST['tanggal_lahir']);
    $id_kelas = htmlspecialchars($_POST['id_kelas']);

    $query = "INSERT INTO siswa (nis, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, id_kelas) 
              VALUES ('$nis', '$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$id_kelas')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data siswa berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data siswa!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Tambah Siswa</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">NIS</label>
                <input type="text" name="nis" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="id_kelas" class="form-control" required>
                    <?php while ($row = mysqli_fetch_assoc($result_kelas)): ?>
                        <option value="<?php echo $row['id_kelas']; ?>"><?php echo $row['nama_kelas']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
