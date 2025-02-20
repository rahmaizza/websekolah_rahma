<?php
include 'koneksi.php';

$nama_kelas = ''; // Default value to prevent undefined variable warning

if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];

    // Ambil data kelas berdasarkan id_kelas
    $query = "SELECT * FROM kelas WHERE id_kelas = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        // Mengikat parameter dan mengeksekusi query
        mysqli_stmt_bind_param($stmt, 'i', $id_kelas);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Jika data ditemukan
        if ($row = mysqli_fetch_assoc($result)) {
            $nama_kelas = $row['nama_kelas'];
        } else {
            echo "<script>
                    alert('Data kelas tidak ditemukan');
                    window.location.href = 'edit_kelas.php';
                  </script>";
        }
        mysqli_stmt_close($stmt);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data yang diinputkan oleh user
    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];

    // Update data kelas
    $query = "UPDATE kelas SET nama_kelas = ? WHERE id_kelas = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        // Bind parameter dan update
        mysqli_stmt_bind_param($stmt, 'si', $nama_kelas, $id_kelas);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                    alert('Data kelas berhasil diperbarui');
                    window.location.href = 'edit_kelas.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal memperbarui data');
                  </script>";
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Kelas</h2>
        <form method="POST">
            <div class="mb-3">
                <input type="hidden" name="id_kelas" value="<?php echo htmlspecialchars($id_kelas); ?>">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" value="<?php echo htmlspecialchars($nama_kelas); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="edit_kelas.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>