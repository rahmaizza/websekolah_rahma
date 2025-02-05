<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_wali = $_GET['id'];
    $query = "SELECT * FROM wali_murid WHERE id_wali = '$id_wali'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); window.location='wali_murid.php';</script>";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_wali = $_POST['id_wali'];
    $nama_wali = mysqli_real_escape_string($koneksi, $_POST['nama_wali']);
    $kontak = mysqli_real_escape_string($koneksi, $_POST['kontak']);

    if (!empty($nama_wali) && !empty($kontak)) {
        $update_query = "UPDATE wali_murid SET nama_wali='$nama_wali', kontak='$kontak' WHERE id_wali='$id_wali'";
        if (mysqli_query($koneksi, $update_query)) {
            echo "<script>alert('Data berhasil diperbarui!'); window.location='wali_murid.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui data!');</script>";
        }
    } else {
        echo "<script>alert('Nama dan kontak tidak boleh kosong!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Edit Wali Murid</h2>
        <a href="wali_murid.php" class="btn btn-primary mb-3">Kembali ke Data Wali Murid</a>

        <form method="POST" action="">
            <input type="hidden" name="id_wali" value="<?php echo htmlspecialchars($data['id_wali']); ?>">
            <div class="mb-3">
                <label for="nama_wali" class="form-label">Nama Wali</label>
                <input type="text" name="nama_wali" id="nama_wali" class="form-control" value="<?php echo htmlspecialchars($data['nama_wali']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="kontak" class="form-label">No. Telepon</label>
                <input type="text" name="kontak" id="kontak" class="form-control" value="<?php echo htmlspecialchars($data['kontak']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
