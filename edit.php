<?php 
include 'koneksi.php'; 

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if(isset($_POST['submit'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];
    
    $foto_baru = $_FILES['foto']['name'];
    $tmp       = $_FILES['foto']['tmp_name'];

    if($foto_baru != "") {
    
        if(file_exists("uploads/" . $data['foto'])) {
            unlink("uploads/" . $data['foto']);
        }
        move_uploaded_file($tmp, "uploads/" . $foto_baru);
        $foto_update = $foto_baru;
    } else {
        $foto_update = $data['foto'];
    }

    $update = mysqli_query($conn, "UPDATE produk SET nama='$nama', harga='$harga', stok='$stok', foto='$foto_update' WHERE id='$id'");

    if($update) {
        header("location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
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
            font-size: 20px;
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
        .img-preview {
            margin-top: 5px;
            border: 1px solid #eee;
            padding: 5px;
            width: 80px;
            display: block;
        }
        .btn-update {
            background: #333;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
        }
        .btn-update:hover {
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
        small {
            font-size: 11px;
            color: #888;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <h2>Update Produk</h2>
    <form id="formEdit" action="" method="post" enctype="multipart/form-data">
        <div class="field">
            <label>Nama Produk</label>
            <input type="text" name="nama" id="nama" value="<?php echo $data['nama']; ?>">
        </div>

        <div class="field">
            <label>Harga</label>
            <input type="number" name="harga" id="harga" value="<?php echo $data['harga']; ?>">
        </div>

        <div class="field">
            <label>Stok</label>
            <input type="number" name="stok" id="stok" value="<?php echo $data['stok']; ?>">
        </div>

        <div class="field">
            <label>Foto Saat Ini</label>
            <img src="uploads/<?php echo $data['foto']; ?>" class="img-preview">
        </div>

        <div class="field">
            <label>Ganti Foto <small>(Opsional)</small></label>
            <input type="file" name="foto" id="foto">
        </div>

        <button type="submit" name="submit" class="btn-update">UPDATE DATA</button>
        <a href="index.php" class="link-back">Batal</a>
    </form>
</div>

<script>
document.getElementById('formEdit').onsubmit = function() {
    let nama = document.getElementById('nama').value;
    let harga = document.getElementById('harga').value;
    let stok = document.getElementById('stok').value;
    let foto = document.getElementById('foto');

    
    if(nama == "" || harga == "" || stok == "") {
        alert("Nama, harga, dan stok tidak boleh kosong!");
        return false;
    }

    
    if(foto.files.length > 0) {
        let file = foto.files[0];
        if(!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
            alert("Format harus gambar (JPG/PNG)!");
            return false;
        }
        if(file.size > 2 * 1024 * 1024) {
            alert("Ukuran maksimal file adalah 2MB!");
            return false;
        }
    }
    
    return true;
};
</script>

</body>
</html>