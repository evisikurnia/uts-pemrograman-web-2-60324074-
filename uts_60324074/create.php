<?php
require_once 'config/database.php';

$errors = [];
$kode = $nama = $deskripsi = '';
$status = 'Aktif';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $kode = escape($conn,$_POST['kode']);
    $nama = escape($conn,$_POST['nama']);
    $deskripsi = escape($conn,$_POST['deskripsi']);
    $status = $_POST['status'];

    if(empty($kode)) $errors[]="Kode wajib diisi";
    elseif(strlen($kode)<4 || strlen($kode)>10) $errors[]="Kode 4-10 karakter";
    elseif(substr($kode,0,4)!="KAT-") $errors[]="Kode harus diawali KAT-";

    if(empty($nama)) $errors[]="Nama wajib diisi";
    elseif(strlen($nama)<3 || strlen($nama)>50) $errors[]="Nama 3-50 karakter";

    if(strlen($deskripsi)>200) $errors[]="Deskripsi maksimal 200 karakter";

    if($status!='Aktif' && $status!='Nonaktif') $errors[]="Status tidak valid";

    $check = $conn->prepare("SELECT id_kategori FROM kategori WHERE kode_kategori=?");
    $check->bind_param("s",$kode);
    $check->execute();
    if($check->get_result()->num_rows>0){
        $errors[]="Kode kategori sudah ada";
    }

    if(empty($errors)){
        $stmt = $conn->prepare("INSERT INTO kategori(kode_kategori,nama_kategori,deskripsi,status) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss",$kode,$nama,$deskripsi,$status);

        if($stmt->execute()){
            header("Location:index.php?msg=Data berhasil ditambah");
            exit;
        } else {
            $errors[]="Gagal simpan data";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Kategori</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<div class="card">
<div class="card-header"><h4>Tambah Kategori</h4></div>
<div class="card-body">

<?php foreach($errors as $e): ?>
<div class="alert alert-danger"><?= $e; ?></div>
<?php endforeach; ?>

<form method="POST">
<div class="mb-3">
<label>Kode</label>
<input type="text" name="kode" class="form-control" value="<?= $kode ?>" required>
</div>

<div class="mb-3">
<label>Nama</label>
<input type="text" name="nama" class="form-control" value="<?= $nama ?>" required>
</div>

<div class="mb-3">
<label>Deskripsi</label>
<textarea name="deskripsi" class="form-control"><?= $deskripsi ?></textarea>
</div>

<div class="mb-3">
<label>Status</label><br>
<input type="radio" name="status" value="Aktif" checked> Aktif
<input type="radio" name="status" value="Nonaktif"> Nonaktif
</div>

<button class="btn btn-primary">Simpan</button>
<a href="index.php" class="btn btn-secondary">Kembali</a>
</form>

</div>
</div>
</div>
</body>
</html>