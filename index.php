<?php
ob_start();
error_reporting(0);
?>
<?php include 'lib/db.php'; ?>
<?php include 'lib/config.php'; ?>
<?php include 'admin/lib/function.php'; ?>
<?php include 'lib/header.php'; ?>
<?php include 'lib/navigation.php'; ?>
<?php require 'vendor/autoload.php'; ?>

<?php

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "";
}
switch ($page) {
    case 'akun':
        include 'page/akun.php';
        break;

    case 'kontak':
        include 'page/kontak.php';
        break;

    case 'donasi':
        include 'page/donasi.php';
        break;

    case 'detail':
        include 'page/detail.php';
        break;

    case 'kategori':
        include 'page/page_by_kategori.php';
        break;

    case 'payment_success':
        include 'page/midtrans/success.php';
        break;

    case 'payment_pending':
        include 'page/midtrans/pending.php';
        break;

    case 'bayar':
        include 'page/midtrans/bayar.php';
        break;

    case 'forgot':
        include 'page/forgot.php';
        break;
        
    case 'confirm':
        include 'page/confirm.php';
        break;

    default:
        include 'page/main.php';
        break;
}

?>

<?php include 'lib/footer.php'; ?>


