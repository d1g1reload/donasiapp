<?php ob_start(); ?>
<?php session_start(); ?>
<?php include '../lib/db.php'; ?>
<?php include '../lib/config.php'; ?>
<?php include 'lib/function.php'; ?>
<?php include 'lib/admin_header.php'; ?>
<?php include 'lib/admin_navigation.php'; ?>
<?php 
// var_dump($_SESSION);
    if(!isset($_SESSION['user_status'])){
        redirect(BASE_URL);
    }
?>
<?php 

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = "";
    }

    switch($page){
        case 'dashboard' :
            include 'page/main_admin.php';
        break;

        case 'listposts' :
            include 'page/posts/listposts.php';
        break;

        case 'addpost' :
            include 'page/posts/addpost.php';
        break;

        case 'detailpost' :
            include 'page/posts/detailpost.php';
        break;

        case 'editpost' :
            include 'page/posts/editpost.php';
        break;

        case 'listkategori' :
            include 'page/kategori/listkategori.php';
        break;

        case 'addkategori' :
            include 'page/kategori/addkategori.php';
        break;

        case 'editkategori' :
            include 'page/kategori/editkategori.php';
        break;
        
        case 'listusers' :
            include 'page/users/listusers.php';
        break;

        case 'adduser' :
            include 'page/users/adduser.php';
        break;

        case 'detailuser' :
            include 'page/users/detailuser.php';
        break;

        case 'edituser' :
            include 'page/users/edituser.php';
        break;

        case 'listpayment' :
            include 'page/payments/listpayment.php';
        break;

        case 'pendingpayment' :
            include 'page/payments/pending.php';
        break;

        case 'detailpayment' :
            include 'page/payments/detail.php';
        break;

        case 'report_all' :
            include 'page/report/all.php';
        break;

        case 'slider' :
            include 'page/slider/slide.php';
        break;
        case 'editSlide' :
            include 'page/slider/editSlide.php';
        break;

        default :
            include 'page/main_admin.php';
        break;
    }


?>


           
<?php include 'lib/admin_footer.php'; ?>