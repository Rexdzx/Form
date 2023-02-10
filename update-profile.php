<?php

include 'koneksi.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:masuk.php');
};


if(isset($_POST['update'])){

    $username   = $_POST['username'];
    $username   = filter_var($username, FILTER_SANITIZE_STRING);

        if(empty($username)){
        $pesan[] = 'Isi username anda terlebih dahulu';
        }else{
        $update_profile = $conn->prepare("UPDATE `users` SET username = ? WHERE id = ? ");
        $update_profile->execute([$username, $user_id]);
        $pesan[] = 'Username telah diupdate';   
             
    }

 


    $password_lama = $_POST['password_lama'];

    $password_sebelumnya = md5($_POST['password_sebelumnya']);
    $password_sebelumnya = filter_var($password_sebelumnya, FILTER_SANITIZE_STRING);

    $password_baru = md5($_POST['password_baru']);
    $password_baru = filter_var($password_baru, FILTER_SANITIZE_STRING);
   
    $konfirmasi_password = md5($_POST['konfirmasi_password']);
    $konfirmasi_password = filter_var($konfirmasi_password, FILTER_SANITIZE_STRING);

    if(!empty($password_sebelumnya) || !empty($password_baru) || !empty($konfirmasi_password)){
      if($password_sebelumnya != $password_lama){
         $pesan[] = 'Password Sebelumnya Tidak Sama!';
      }elseif($password_baru != $konfirmasi_password){
         $pesan[] = 'Konfirmasi Password Tidak Sama!';
      }else{
         $update_password = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ? ");
         $update_password->execute([$konfirmasi_password, $user_id]);
         $pesan[] = 'Password Telah Diupdate!';
      }
   }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../form/css/style.css">


    <title>Update Profile</title>
</head>

<body style="background-color:#92959a;">
    <?php
   if(isset($pesan)){
      foreach($pesan as $pesn){
         echo '
         <div class="pesan">
            <span>'.$pesn.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

    <div class="container">

        <div class="row">
            <div class="col-md-4 offset-md-4 mt-5">
                <div class="card ">
                    <div class="card-title text-center">
                        <h1 class="text-dark mt-3">Update Profile</h1>
                    </div>
                    <div class="card-body">
                        <?php
                              $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                              $select_profile->execute([$user_id]);
                              $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                            ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username" class="text-dark">Username</label>
                                <input type="text" name="username" class="form-control" style="color:#000;"
                                    id="Username" value="<?= $fetch_profile['username']?>" aria-describedby="Username"
                                    placeholder="Username" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="password_lama" value="<?= $fetch_profile['password']; ?>">
                                <label for="password" class="text-dark">Password Sebelumnya</label>
                                <input type="password" name="password_sebelumnya" class="form-control" id="password"
                                    placeholder="Password Sebelumnya">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-dark">Password Baru</label>
                                <input type="password" name="password_baru" class="form-control" id="password_baru"
                                    placeholder="Password Baru">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-dark">Konfirmasi Password</label>
                                <input type="password" name="konfirmasi_password" class="form-control"
                                    id="konfirmasi_password" placeholder="Konfirmasi Password">
                            </div>

                            <button type="submit" class="btn btn-success" name="update" value="update profile"
                                class="text-dark">Update
                                Profile</button>
                        </form>

                        <a href="profile.php" style="color:#636363; text-decoration: underline;">Batal</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</body>

</html>