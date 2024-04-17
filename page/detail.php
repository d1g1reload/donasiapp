<?php

use Midtrans\Config;
use Midtrans\Notification;



if (isset($_GET['id_post'])) {
    $id_post = $_GET['id_post'];
    $query = query("SELECT * FROM posts 
                    INNER JOIN category ON category.id_category = posts.id_category
                    INNER JOIN users ON users.id_user = posts.id_user 
                    WHERE id_post='$id_post'");
    $row = mysqli_fetch_array($query);
    $post_title = escape($row['post_title']);
    $post_content = $row['post_description'];
    $post_date = escape($row['post_date']);
    $category_name = $row['category_name'];
    $post_amount = $row['post_amount'];
    $fullname = $row['fullname'];
    $image = $row['post_image'];
}

if (isset($_POST['pay'])) {


    try {
        $id_user = $_SESSION['id_user'];
        $fullname = $_SESSION['fullname'];
        $email = $_SESSION['email'];
        $order_id = uniqid();
        $amount = $_POST['amount'];

        // include 'vendor/autoload.php';
        $serverKey = "SB-Mid-server-uaBbEV6DIb1zBYFSIelW1HJV";
        // $encode_key = base64_encode($serverKey . ':');
        Config::$serverKey = $serverKey;
        $amount = $_POST['amount'];

        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $amount
            ],

            'customer_details' => [
                'first_name' => $fullname,
                'email' => $email
            ],

            'enabled_payments' => ['indomaret'],
            'vtweb' => []

        ];
        $order_id = $params['transaction_details']['order_id'];
        $query = query("INSERT INTO payments(id_post,id_user,amount,payment_order,payment_date)
                    VALUES('$id_post','$id_user','$amount','$order_id',now()) ");
        confirmQuery($query);

        // $update = query("UPDATE posts SET post_amount =$post_amount+$amount WHERE id_post='$id_post'");
        // confirmQuery($update);
        // Get Snap Payment Page URL
        $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

        // Redirect to Snap Payment Page
        header('Location: ' . $paymentUrl);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}



?>





<div class="container">
    <div class="row push-from-top">
        <div class="col-md-12">
            <h1 class="text-center">Detail Donasi</h1>
        </div>
    </div>

    <div class="row push-from-top">
        <div class="col-md-8 mb-3">
            <div class="card border-0 shadow-lg">
                <div class="card-title">
                    <h1 class="text-center"><?php echo $post_title ?></h1>
                </div>
                <div class="card-body">
                    <p>
                        <?php echo $post_content ?>
                    </p>
                    <img src="<?php echo BASE_URL ?>assets/img/<?php echo $image ?> " class="img-fluid" style="width:100%;" alt="slide-image">

                    <i>Tanggal Posting : <?php echo $post_date ?></i> / <b>Kategori : <?php echo $category_name ?></b>
                    <br>
                    <i>Di Posting Oleh : <?php echo $fullname ?></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-lg">
                <div class="card-title">
                    <h1 class="text-center">Jumlah Donasi</h1>
                </div>
                <div class="card-body">
                    <?php if (isLoggedIn()) { ?>
                        <form method="post" autocomplete="off">
                            <div class="from-group">
                                <input type="text" class="form-control" name="amount" placeholder="masukan jumlah donasi anda" required>
                                <small class="form-text text-muted"><i>Contoh: 1000</i></small>
                            </div>
                            <br>
                            <div class="form-group">
                                <button class="btn bg-custom-primary btn-block text-white" type="submit" name="pay">Bayar</button>
                            </div>
                        </form>
                    <?php } else { ?>
                        <a href="<?php echo BASE_URL ?>?page=akun" class="btn btn-block btn-primary">Silahkan login untuk donasi</a>
                    <?php } ?>
                </div>
            </div>

            <div class="card border-0 shadow-lg mt-5">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center">Histori Donasi</h3>
                    </div>



                    <ul class="list-group">
                        <?php
                        $query = query("SELECT * FROM payments 
                                            INNER JOIN users ON users.id_user=payments.id_user
                                            WHERE id_post='$id_post' AND status_payment='approve' ");

                        while ($data = mysqli_fetch_array($query)) {
                            $payment_fullname = $data['fullname'];
                            $payment_amount = $data['amount'];

                            ?>
                            <li class="list-group-item">
                                Nama : <?php echo $payment_fullname ?>
                                <br>
                                Donasi Sebesar : Rp. <?php echo number_format($payment_amount, 2) ?>
                            </li>

                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>