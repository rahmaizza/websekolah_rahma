<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];

    // Validasi agar id_kelas adalah angka
    if (filter_var($id_kelas, FILTER_VALIDATE_INT)) {
        // Query untuk menghapus data kelas berdasarkan id_kelas
        $query = "DELETE FROM kelas WHERE id_kelas = ?";
        $stmt = mysqli_prepare($koneksi, $query);

        if ($stmt) {
            // Menyiapkan parameter dan menjalankan query
            mysqli_stmt_bind_param($stmt, 'i', $id_kelas); // 'i' berarti integer

            // Menjalankan query
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>
                        alert('Data kelas berhasil dihapus');
                        window.location.href = 'edit_kelas.php'; // Redirect ke halaman data kelas
                      </script>";
            } else {
                echo "<script>
                        alert('Gagal menghapus data');
                        window.location.href = 'edit_kelas.php';
                      </script>";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "<script>
                    alert('Gagal menyiapkan query');
                    window.location.href = 'edit_kelas.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('ID tidak valid');
                window.location.href = 'edit_kelas.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID tidak ditemukan');
            window.location.href = 'edit_kelas.php';
          </script>";
}
?>