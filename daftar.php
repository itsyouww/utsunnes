<?php
// daftar.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>::Data Registrasi::</title>
    <style type="text/css">
        body{
            display: flex; justify-content: center; align-items: center;
            min-height: 100vh; background-size: cover;
            background-image: url("https://cdn.arstechnica.net/wp-content/uploads/2023/06/bliss-update-1440x960.jpg");
            font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 20px;
        }
        .container{
            background-color: white; border: 3px solid grey; padding: 30px;
            border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            max-width: 900px; width: 100%;
        }
        h1{ text-align: center; margin-top: 0; }
        .ok{ background:#d4edda; color:#155724; border:1px solid #c3e6cb; padding:12px; border-radius:6px; text-align:center; font-weight:bold; }
        .err{ background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; padding:12px; border-radius:6px; text-align:center; font-weight:bold; }
        table{ width:100%; border-collapse:collapse; margin-top:16px; }
        th, td{ border-bottom:1px solid #ddd; padding:10px 12px; text-align:left; }
        th{ background:#f8f9fa; }
        .back{ text-align:center; margin-top:16px; }
        .back a{ background:#007bff; color:#fff; padding:10px 18px; border-radius:6px; text-decoration:none; }
        .back a:hover{ background:#0056b3; }
    </style>
</head>
<body>
<div class="container">
    <h1>Data Registrasi User</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    // Ambil & rapikan input
    $nama_depan     = isset($_POST['nama_depan'])    ? trim($_POST['nama_depan'])    : '';
    $nama_belakang  = isset($_POST['nama_belakang']) ? trim($_POST['nama_belakang']) : '';
    $asal_kota      = isset($_POST['asal_kota'])     ? trim($_POST['asal_kota'])     : '';
    $umur_raw       = isset($_POST['umur'])          ? $_POST['umur']                : '';

    // Validasi: field wajib
    if ($nama_depan === '' || $nama_belakang === '' || $asal_kota === '' || $umur_raw === '') {
        echo '<div class="err">Error: Semua field wajib diisi.</div>';
        echo '<div class="back"><a href="index.html">Kembali ke Form Registrasi</a></div>';
    }
    // Validasi: umur harus digit
    elseif (!ctype_digit((string)$umur_raw)) {
        echo '<div class="err">Error: Umur harus berupa angka bulat.</div>';
        echo '<div class="back"><a href="index.html">Kembali ke Form Registrasi</a></div>';
    }
    else {
        $umur = (int)$umur_raw;

        // Validasi minimal umur = 10
        if ($umur < 10) {
            echo '<div class="err">Error: Jumlah umur minimal adalah 10. Silakan masukkan umur ≥ 10.</div>';
            echo '<div class="back"><a href="index.html">Kembali ke Form Registrasi</a></div>';
        } else {
            $nama_lengkap = $nama_depan . ' ' . $nama_belakang;

            echo '<div class="ok">Registrasi Berhasil!</div>';

            echo '<table>';
            echo '<thead><tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Asal Kota</th>
                  </tr></thead><tbody>';

            for ($i = 1; $i <= $umur; $i++) {
                // hanya nomor ganjil dan skip 7 & 13
                if (($i % 2 === 1) && $i !== 7 && $i !== 13) {
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . htmlspecialchars($nama_lengkap, ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td>' . htmlspecialchars((string)$umur, ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '<td>' . htmlspecialchars($asal_kota, ENT_QUOTES, 'UTF-8') . '</td>';
                    echo '</tr>';
                }
            }

            echo '</tbody></table>';
            echo '<div class="back"><a href="index.html">Kembali ke Form Registrasi</a></div>';
        }
    }

} else {
    echo '<div class="err">Error: Data tidak ditemukan. Silakan isi form registrasi terlebih dahulu.</div>';
    echo '<div class="back"><a href="index.html">Kembali ke Form Registrasi</a></div>';
}
?>
</div>
</body>
</html>
