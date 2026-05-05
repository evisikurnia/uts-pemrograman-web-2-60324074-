<?php
require_once 'config/database.php';

$id=$_GET['id'] ?? 0;

$stmt=$conn->prepare("SELECT * FROM kategori WHERE id_kategori=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$data=$stmt->get_result()->fetch_assoc();

if(!$data){
    header("Location:index.php?msg=Data tidak ditemukan");
    exit;
}

$kode=$data['kode_kategori'];
$nama=$data['nama_kategori'];
$deskripsi=$data['deskripsi'];
$status=$data['status'];

$errors=[];

if($_SERVER['REQUEST_METHOD']=='POST'){
    $kode=$_POST['kode'];
    $nama=$_POST['nama'];
    $deskripsi=$_POST['deskripsi'];
    $status=$_POST['status'];

    // CEK DUPLIKAT
    $cek=$conn->prepare("SELECT id_kategori FROM kategori WHERE kode_kategori=? AND id_kategori!=?");
    $cek->bind_param("si",$kode,$id);
    $cek->execute();
    if($cek->get_result()->num_rows>0){
        $errors[]="Kode sudah dipakai";
    }

    if(empty($errors)){
        $stmt=$conn->prepare("UPDATE kategori SET kode_kategori=?,nama_kategori=?,deskripsi=?,status=? WHERE id_kategori=?");
        $stmt->bind_param("ssssi",$kode,$nama,$deskripsi,$status,$id);
        $stmt->execute();
        header("Location:index.php?msg=Berhasil update");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

<h3>Edit Kategori</h3>

<?php foreach($errors as $e): ?>
<div class="alert alert-danger"><?= $e ?></div>
<?php endforeach; ?>

<form method="POST">
<input name="kode" class="form-control mb-2" value="<?= $kode ?>">
<input name="nama" class="form-control mb-2" value="<?= $nama ?>">
<textarea name="deskripsi" class="form-control mb-2"><?= $deskripsi ?></textarea>

<select name="status" class="form-control mb-2">
<option <?= $status=='Aktif'?'selected':'' ?>>Aktif</option>
<option <?= $status=='Nonaktif'?'selected':'' ?>>Nonaktif</option>
</select>

<button class="btn btn-warning">Update</button>
<a href="index.php" class="btn btn-secondary">Kembali</a>
</form>

</div>
</body>
</html>