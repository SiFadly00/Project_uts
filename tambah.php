<?php 
include 'koneksi.php'; 
if(isset($_POST['submit'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];
    
    $foto  = $_FILES['foto']['name'];
    $tmp   = $_FILES['foto']['tmp_name'];
    $path  = "uploads/" . $foto;

    if(move_uploaded_file($tmp, $path)) {
        mysqli_query($conn, "INSERT INTO produk (nama, harga, stok, foto) VALUES ('$nama', '$harga', '$stok', '$foto')");
        header("location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            color: #333;
            margin: 0;
            padding: 50px;
        }
        .wrapper {
            max-width: 400px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
        }
        h2 {
            margin-top: 0;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .field {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 13px;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box; 
        }
        .btn-simpan {
            background: #333;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            width: 100%;
        }
        .btn-simpan:hover {
            background: #555;
        }
        .link-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
            color: #777;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <h2>Input Produk</h2>
    <form id="formProduk" action="" method="post" enctype="multipart/form-data">
        <div class="field">
            <label>Nama Produk</label>
            <input type="text" name="nama" id="nama">
        </div>

        <div class="field">
            <label>Harga</label>
            <input type="number" name="harga" id="harga">
        </div>

        <div class="field">
            <label>Stok</label>
            <input type="number" name="stok" id="stok">
        </div>

        <div class="field">
            <label>Foto Produk</label>
            <input type="file" name="foto" id="foto">
        </div>

        <button type="submit" name="submit" class="btn-simpan">SIMPAN DATA</button>
        <a href="index.php" class="link-back">Kembali ke Daftar</a>
    </form>
</div>

<script>
document.getElementById('formProduk').onsubmit = function() {
    let nama = document.getElementById('nama').value;
    let harga = document.getElementById('harga').value;
    let stok = document.getElementById('stok').value;
    let foto = document.getElementById('foto');

    if(nama == "" || harga == "" || stok == "" || foto.files.length == 0) {
        alert("Harap isi semua data!");
        return false;
    }

    let file = foto.files[0];
    if(!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
        alert("Gunakan format gambar (JPG/PNG)!");
        return false;
    }

    if(file.size > 2 * 1024 * 1024) {
        alert("Ukuran file maksimal 2MB!");
        return false;
    }
    
    return true;
};
</script>

</body>
</html>