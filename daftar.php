<?php
require_once("koneksi.php");

if(isset($_POST['daftar'])){

    $namadepan  = $_POST['nama_depan'];
    $namadepan  = filter_var($namadepan, FILTER_SANITIZE_STRING);
 
    $namabelakang   = $_POST['nama_belakang'];
    $namabelakang   = filter_var($namabelakang, FILTER_SANITIZE_STRING);

    $username   = $_POST['username'];
    $username   = filter_var($username, FILTER_SANITIZE_STRING);

    $email  = $_POST['email'];
    $email  = filter_var($email, FILTER_SANITIZE_STRING);

    $password   = md5($_POST['password']);
    $password   = filter_var($password, FILTER_SANITIZE_STRING);

    $konfirmasipassword = md5($_POST['konfirmasi_password']);
    $konfirmasipassword =filter_var($konfirmasipassword, FILTER_SANITIZE_STRING);

     $select = $conn->prepare("SELECT * FROM `user` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'user already exist!';
   }else{
      if($password != $konfirmasipassword){
         $message[] = 'confirm password not matched!';
      }else{
         $insert = $conn->prepare("INSERT INTO `user`(`nama_depan`, `nama_belakang`, `username`, `email`, `password`) VALUES(?,?,?,?,?)");
         $insert->execute([$namadepan, $namabelakang, $username, $email, $konfirmasipassword]);
         if($insert){
            header('location:masuk.php');
         }
      }
   }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <title>Registrasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="formregistrasi">
        <form action="daftar.php" method="POST">
            <p>&larr;<a href="index.php">Kembali</a></p>
            <h2>Sign Up</h2>
            <p class="hint-text">Silahkan buat akun Anda</p>
            <div class="form-group">
                <div class="row">
                    <div class="col"><input type="text" class="form-control text-dark" name="nama_depan"
                            placeholder="Nama Depan" required="required"></div>
                    <div class="col"><input type="text" class="form-control text-dark" name="nama_belakang"
                            placeholder="Nama Belakang" required="required"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <input type="text" class="form-control text-dark" name="username" placeholder="Username"
                        required="required">
                </div>
                <input type="email" class="form-control text-dark" name="email" placeholder="Email" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="pass" placeholder="Password"
                    required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="konfirmasi_password" id="pass2"
                    placeholder="Konfirmasi Password" required="required">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success btn-lg btn-block" name="daftar" value="Daftar Sekarang">
            </div>
            <div class="text-center">Sudah punya akun? <a href="masuk.php"
                    style="color:#636363; text-decoration:underline;">Masuk</a></div>
    </div>
    </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
    window.onload = function() {
        document.getElementById("pass").onchange = validatePassword;
        document.getElementById("pass2").onchange = validatePassword;
    }

    function validatePassword() {
        var pass2 = document.getElementById("pass2").value;
        var pass1 = document.getElementById("pass").value;
        if (pass1 != pass2)
            document.getElementById("pass2").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
        else
            document.getElementById("pass2").setCustomValidity('');
    }
    </script>
</body>

</html>
</body>

</html>