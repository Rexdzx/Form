<?php
include("koneksi.php");
session_start();



if(isset($_POST['masuk'])){
            
    $email    = $_POST['email'];
    $email    = filter_var($email, FILTER_SANITIZE_STRING);

    $password = md5($_POST['password']);
    $password = filter_var($password, FILTER_SANITIZE_STRING);


    $select  =$conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select->execute([$email, $password]);
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if($select->rowCount() > 0){
      
     if($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header('location:profile.php');

      }else{
         $pesan[] = 'User Tidak Ditemukan!';
      }
      
   }else{
      $pesan[] = 'Email Atau Password Salah!';
   }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../form/css/style.css">
</head>

<body>

    <?php
   if(isset($pesan)){
      foreach($pesan as $pesan){
         echo '
         <div class="pesan">
            <span>'.$pesan.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>


    <div class="formmasuk">
        <form action="" method="POST" enctype="multipart/form-data">
            <p>&larr; <a href="index.php">Kembali</a>
            <p>
            <h2>Sign In</h2>

            <div class="form-group">
                <label for="email" style="color:#000">Email</label>
                <input class="form-control" type="email" name="email" placeholder="Email" required="required"
                    style="color: rgb(20, 16, 16);">
            </div>
            <div class="form-group">
                <label for="password" style="color:#000">Password</label>
                <input class="form-control" type="password" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success btn-lg btn-block" name="masuk" value="Masuk">
            </div>
            <div class="text-center">Belum punya akun? <a href="daftar.php"
                    style="color:#636363; text-decoration:underline">Daftar</a></div>
        </form>
    </div>



</body>

</html>