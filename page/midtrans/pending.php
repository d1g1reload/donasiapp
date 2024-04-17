<?php

use Midtrans\Config;
use Midtrans\Notification;

if (isset($_GET['status_code'])  == 201 && isset($_GET['transaction_status']) == "pending") {





    $serverKey = "SB-Mid-server-uaBbEV6DIb1zBYFSIelW1HJV";
    Config::$serverKey = $serverKey;
    Config::$isProduction = false;
    $notif = new \Midtrans\Notification();

    echo $notif;


    $order_id =  $_GET['order_id'];
    $transaction_status = $_GET['transaction_status'];
}

?>

<div class="contianer">
    <div class="row push-from-top mb-5">
        <div class="col-md-4 m-auto">
            <div class="card border-0 shadow-lg">
                <div class="card-title">
                    <h1 class="text-center">
                        Pembayaran Pending
                    </h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">Order Id : <?php echo $order_id ?></li>
                        <li class="list-group-item">Status Transaksi : <?php echo $transaction_status ?></li>
                    </ul>
                    <p>
                        Keterangan : Silahkan lakukan pembayarang melalui indomaret dan cek status pembayaran anda pada dashboard.
                    </p>
                    <a href="admin" class="btn btn-primary">Masuk Dashboard</a>
                </div>

            </div>
        </div>
    </div>
</div>