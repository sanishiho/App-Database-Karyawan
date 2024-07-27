<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}

include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Netship</title>
  <meta name="description" content="Netship">
  <meta name="author" content="Kelompok7.com">
  <link rel="icon" href="favicon.ico">
  
  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <style>
    html, body {
      height: 100%;
    }
    body {
      display: flex;
      flex-direction: column;
      margin: 0;
    }
    .container {
      flex: 1;
      padding-top: 60px;
    }
    .footer {
      background-color: #f5f5f5;
      border-top: 1px solid #e5e5e5;
      text-align: center;
      padding: 15px 0;
    }
    .panel {
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }
    .panel-heading {
      background-color: #007bff;
      color: white;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
      padding: 10px;
    }
    .panel-title {
      margin: 0;
      font-size: 1.5em;
    }
    .panel-body {
      padding: 20px;
    }
    .img-thumbnail {
      border-radius: 8px;
      max-width: 100%;
      height: auto;
    }
  </style>
</head>

<body>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="./">Netship</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data_admin.php">Data Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data_jabatan.php">Data Jabatan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data_golongan.php">Data Golongan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data_pegawai.php">Data Pegawai</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data_kehadiran.php">Data Kehadiran</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data_penggajian.php"></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="cetak_laporan_pegawai.php">Laporan Data Pegawai</a></li>
              <li><a class="dropdown-item" href="cetak_laporan_golongan.php">Laporan Data Golongan</a></li>
              <li><a class="dropdown-item" href="cetak_laporan_jabatan.php">Laporan Data Jabatan</a></li>
              <li><a class="dropdown-item" href="laporan_kehadiran.php">Laporan Kehadiran Pegawai</a></li>
              <li><a class="dropdown-item" href="laporan_lemburan.php">Laporan Lembur Pegawai</a></li>
              <li><a class="dropdown-item" href="laporan_potongan.php">Laporan Potongan Gaji</a></li>
              <li><hr class="dropdown-divider"></li>
              <li class="dropdown-header">Nav header</li>
              <li><a class="dropdown-item" href="#">Laporan Data Pegawai</a></li>
              <li><a class="dropdown-item" href="#">One more separated link</a></li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Begin page content -->
  <div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Halaman Utama Aplikasi Penggajian</h3>
      </div>
      <div class="panel-body text-center">
      </div>
    </div>
  </div>

