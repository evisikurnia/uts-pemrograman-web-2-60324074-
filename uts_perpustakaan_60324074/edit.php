<?php
require_once 'config/database.php';

if(!isset($_GET['id'])){
    header("Location:index.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM kategori WHERE id_kategori=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if(!$data){
    header("Location:index.php?msg=Data tidak ditemukan");
    exit;
}

$errors=[];

if($_SERVER['REQUEST_METHOD']=='POST'){
    $kode = escape($conn,$_POST['kode']);
    $nama = escape($conn,$_POST['nama']);
    $deskripsi = escape($conn,$_POST['deskripsi']);
    $status = $_POST['status'];

    $check = $conn->prepare("SELECT id_kategori FROM kategori WHERE kode_kategori=? AND id_kategori!=?");
    $check->bind_param("si",$kode,$id);
    $check->execute();

    if($check->get_result()->num_rows>0){
        $errors[]="Kode sudah dipakai";
    }

    if(empty($errors)){
        $update = $conn->prepare("UPDATE kategori SET kode_kategori=?, nama_kategori=?, deskripsi=?, status=? WHERE id_kategori=?");
        $update->bind_param("ssssi",$kode,$nama,$deskripsi,$status,$id);

        if($update->execute()){
            header("Location:index.php?msg=Data berhasil diupdate");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Kategori</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<div class="card">
<div class="card-header"><h4>Edit Kategori</h4></div>
<div class="card-body">

<form method="POST">
<div class="mb-3">
<label>Kode</label>
<input type="text" name="kode" class="form-control" value="<?= $data['kode_kategori']; ?>">
</div>

<div class="mb-3">
<label>Nama</label>
<input type="text" name="nama" class="form-control" value="<?= $data['nama_kategori']; ?>">
</div>

<div class="mb-3">
<label>Deskripsi</label>
<textarea name="deskripsi" class="form-control"><?= $data['deskripsi']; ?></textarea>
</div>

<div class="mb-3">
<label>Status</label><br>
<input type="radio" name="status" value="Aktif" <?= $data['status']=='Aktif'?'checked':''; ?>> Aktif
<input type="radio" name="status" value="Nonaktif" <?= $data['status']=='Nonaktif'?'checked':''; ?>> Nonaktif
</div>

<button class="btn btn-primary">Update</button>
<a href="index.php" class="btn btn-secondary">Kembali</a>
</form>

</div>
</div>
</div>
</body>
</html>