<?php 

if(isset($_GET['success'])){
    $user_email = $_GET['success'];
    if($user_email)
    {
        mysqli_query($connection, "UPDATE users SET user_status='2'  WHERE email='$user_email' ");
        echo '<h1>Akun berhasil di aktivasi</h1>';
    }else{
        echo '<h1>Akun gagal di aktivasi</h1>';
    }
}

?>