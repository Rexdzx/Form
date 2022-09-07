<?php

include 'koneksi.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location: masuk.php');
}

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</head>

<body style="background-color:#92959a ;">

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 mt-5">
                <div class="card">
                    <div class="card-title text-center">
                        <h1>Profile</h1><br>
                        <p><a href="update-profile.php" style="text-decoration:none ;">Update Profile</a></p>
                        <?php
                            $select_profile = $conn->prepare("SELECT * FROM `user` WHERE id = ?");
                            $select_profile->execute([$user_id]);
                            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                          ?>

                    </div>
                    <div class="card-body">
                        <p style="font-size:24px ;">Halo : <?= $fetch_profile['username']; ?></p>
                        <p>Anda Berhasil Masuk Ke Halaman Profil</p>
                        <center>
                            <a href="logout.php" style="text-decoration:none;">Logout</a>
                        </center>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
<?php
?>