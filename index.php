<?php

@include 'config.php';

if(isset($_POST['tambah_produk'])){

   $nama_produk = $_POST['nama_produk'];
   $stok_produk = $_POST['stok_produk'];
   $harga_produk = $_POST['harga_produk'];
   $gambar_produk = $_FILES['gambar_produk']['name'];
   $gambar_produk_tmp_name = $_FILES['gambar_produk']['tmp_name'];
   $gambar_produk_folder = 'gambar/'.$gambar_produk;

   if(empty($nama_produk) || empty($stok_produk) || empty($harga_produk) || empty($gambar_produk)){
      $message[] = 'Tolong isi semuanya!';
   }else{
      $insert = "INSERT INTO produk(nama, stok, harga, gambar) VALUES('$nama_produk', '$stok_produk', '$harga_produk', '$gambar_produk')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($gambar_produk_tmp_name, $gambar_produk_folder);
         $message[] = 'Sukses menambahkan produk baru!';
      }else{
         $message[] = 'Tidak dapat menambahkan produk, coba lagi!';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM produk WHERE id = $id");
   header('location:index.php');
};


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Halaman Admin</title>

   <link rel="stylesheet" href="stylecss.css">
   <script src="btn.js"></script>

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>

<div class="data">
   <h> Nama    : Putri Iqlima </h><br>
   <h> Nim     : 220180013 </h><br>
   <h> Kelas   : A1 Sistem Informasi </h>
</div>
   
<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Tambahkan produk baru</h3>
         <input type="text" placeholder="Masukkan nama produk" name="nama_produk" class="box">
         <input type="number" placeholder="Masukkan stok produk" name="stok_produk" class="box">
         <input type="number" placeholder="Masukkan harga produk" name="harga_produk" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="gambar_produk" class="box">
         <input type="submit" class="btn" name="tambah_produk" value="Tambah Produk">
      </form>

   </div>

   <?php

   $no =1;
   $select = mysqli_query($conn, "SELECT * FROM produk");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>No.</th>
            <th>Gambar Produk</th>
            <th>Nama Produk</th>
            <th>Stok Produk</th>
            <th>Harga Produk</th>
            <th>Aksi</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $no++; ?></td>
            <td><img src="gambar/<?php echo $row['gambar']; ?>" height="100" alt=""></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['stok']; ?></td>
            <td>Rp<?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
            <td>
               <a href="edit.php?edit=<?php echo $row['id']; ?>" data-id= "<?php echo $row['id']; ?>" class="btn-edit"> <i class="fas fa-edit"></i> Edit </a>
               <a href="index.php?delete=<?php echo $row['id']; ?>" data-id= "<?php echo $row['id']; ?>" class="btn-delete"> <i class="fas fa-trash"></i> Hapus </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>