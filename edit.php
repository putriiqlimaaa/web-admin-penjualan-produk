<?php

@include 'config.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

   $nama_produk = $_POST['nama_produk'];
   $stok_produk = $_POST['stok_produk'];
   $harga_produk = $_POST['harga_produk'];
   $gambar_produk = $_FILES['gambar_produk']['name'];
   $gambar_produk_tmp_name = $_FILES['gambar_produk']['tmp_name'];
   $gambar_produk_folder = 'gambar/'.$gambar_produk;

   if(empty($nama_produk) || empty($stok_produk) || empty($harga_produk) || empty($gambar_produk)){
      $message[] = 'Tolong isi semuanya!';    
   }else{

      $update_data = "UPDATE produk SET nama='$nama_produk', stok='$stok_produk', harga='$harga_produk', gambar='$gambar_produk'  WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($gambar_produk_tmp_name, $gambar_produk_folder);
         header('location:index.php');
      }else{
         $$message[] = 'Tolong isi semuanya!'; 
      }

   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Produk</title>
   <link rel="stylesheet" href="stylecss.css">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="container">


<div class="admin-product-form-container centered">

   <?php
      
      $select = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Perbarui produk</h3>
      <input type="text" class="box" name="nama_produk" value="<?php echo $row['nama']; ?>" placeholder="Masukkan nama produk">
      <input type="number" min="0" class="box" name="stok_produk" value="<?php echo $row['stok']; ?>" placeholder="Masukkan stok produk">
      <input type="number" min="0" class="box" name="harga_produk" value="<?php echo $row['harga']; ?>" placeholder="Masukkan harga produk">
      <input type="file" class="box" name="gambar_produk"  accept="image/png, image/jpeg, image/jpg">
      <input type="submit" value="Perbarui Produk" name="update_product" class="btn">
      <a href="index.php" class="btn">Kembali</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>