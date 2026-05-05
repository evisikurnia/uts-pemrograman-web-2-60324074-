<?php
require_once 'config/database.php';

if(!isset($_GET['id'])){
    header("Location:index.php?msg=ID tidak valid");
    exit;
}

$id = intval($_GET['id']);

$check = $conn->prepare("SELECT id_kategori FROM kategori WHERE id_kategori=?");
$check->bind_param("i",$id);
$check->execute();

if($check->get_result()->num_rows==0){
    header("Location:index.php?msg=Data tidak ditemukan");
    exit;
}

$stmt = $conn->prepare("DELETE FROM kategori WHERE id_kategori=?");
$stmt->bind_param("i",$id);

if($stmt->execute() && $stmt->affected_rows>0){
    header("Location:index.php?msg=Data berhasil dihapus");
} else {
    header("Location:index.php?msg=Gagal hapus data");
}
?>