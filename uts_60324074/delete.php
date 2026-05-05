<?php
require_once 'config/database.php';

$id=$_GET['id'] ?? 0;

$stmt=$conn->prepare("DELETE FROM kategori WHERE id_kategori=?");
$stmt->bind_param("i",$id);

if($stmt->execute()){
    header("Location:index.php?msg=Berhasil hapus");
}else{
    header("Location:index.php?msg=Gagal hapus");
}
exit;
?>