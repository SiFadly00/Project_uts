<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Produk - Inventory</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #fafafa; 
            color: #333;
            margin: 0; 
            padding: 40px; 
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border: 1px solid #ddd;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        h2 { margin: 0; font-size: 24px; text-transform: uppercase; letter-spacing: 1px; }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        th, td { 
            padding: 12px; 
            text-align: left; 
            border-bottom: 1px solid #eee; 
        }
        th { 
            background-color: #fcfcfc; 
            font-size: 13px; 
            text-transform: uppercase; 
            color: #777;
        }
        
        
        .img-container {
            width: 60px;
            height: 60px;
            overflow: hidden;
            border: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        img { width: 100%; height: auto; }

        
        .btn { 
            padding: 7px 12px; 
            text-decoration: none; 
            font-size: 12px; 
            font-weight: bold;
            transition: 0.2s;
        }
        .btn-tambah { 
            background: #333; 
            color: #fff; 
        }
        .btn-tambah:hover { background: #555; }
        
        .btn-edit { 
            color: #2c3e50; 
            border: 1px solid #2c3e50;
            margin-right: 5px;
        }
        .btn-edit:hover { background: #2c3e50; color: #fff; }
        
        .btn-hapus { 
            color: #e74c3c; 
            border: 1px solid #e74c3c;
        }
        .btn-hapus:hover { background: #e74c3c; color: #fff; }

        .price { font-family: 'Courier New', Courier, monospace; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h2>Daftar Produk</h2>
        <a href="tambah.php" class="btn btn-tambah">+ TAMBAH</a>
    </header>
    
    <table>
        <thead>
            <tr>
                <th width="80">Foto</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th width="80">Stok</th>
                <th width="150" style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM produk");
            if(mysqli_num_rows($query) == 0) {
                echo "<tr><td colspan='5' style='text-align:center; padding:30px; color:#999;'>Belum ada data produk.</td></tr>";
            }
            while($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td>
                    <div class="img-container">
                        <img src="uploads/<?php echo $row['foto']; ?>" alt="produk">
                    </div>
                </td>
                <td><strong><?php echo $row['nama']; ?></strong></td>
                <td class="price">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td style="text-align: center;">
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">EDIT</a>
                    <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn btn-hapus" onclick="return confirm('Hapus produk ini?')">HAPUS</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>