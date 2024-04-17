<?php

if (isset($_GET['detail'])) {
    $id_payment = $_GET['detail'];

    $query = query("SELECT * FROM payments
                    INNER JOIN posts ON posts.id_post=payments.id_post
                    INNER JOIN users ON users.id_user=payments.id_user
                    WHERE payments.id_payment='$id_payment'");
    $data = mysqli_fetch_array($query);
    $id_post = $data['id_post'];

    $post_amount = $data['post_amount'];
    $amount = $data['amount'];
    $order_id = $data['payment_order'];
    $total = $post_amount + $amount;

    $status_payment = $data['status_payment'];
    if ($status_payment == 'pending') {
        $status = '<span class="badge badge-danger">' . $status_payment . '</span>';
    } else {
        $status = '<span class="badge badge-primary">' . $status_payment . '</span>';
    }

    if (isset($_POST['pending']) == 'pending') {
        $query = query("UPDATE payments SET status_payment='approve' WHERE id_payment='$id_payment' ");
        query("UPDATE posts SET post_amount =$post_amount+$amount WHERE posts.id_post='$id_post'");
        if ($query) {
            redirect('?page=listpayment');
        }
    }
    if (isset($_POST['approve']) == 'approve') {
        $query = query("UPDATE payments SET status_payment='pending' WHERE id_payment='$id_payment' ");
        query("UPDATE posts SET post_amount =$post_amount-$amount WHERE posts.id_post='$id_post'");
        if ($query) {
            redirect('?page=listpayment');
        }
    }

    // $update = query("UPDATE posts SET post_amount =$post_amount+$amount WHERE id_post='$id_post'");
    // confirmQuery($update);
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Detail Payments</h1>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            Nama : <?php echo $data['fullname'] ?>
                        </li>
                        <li class="list-group-item">
                            Jumlah Donasi : Rp. <?php echo number_format($data['amount'], 2) ?>
                        </li>
                        <li class="list-group-item">
                            Donasi Untuk : <?php echo $data['post_title'] ?>
                        </li>
                        <li class="list-group-item">
                            Kode Order : <?php echo $data['payment_order'] ?>
                        </li>
                        <li class="list-group-item">
                            Tanggal Donasi : <?php echo $data['payment_date'] ?>
                        </li>
                        <li class="list-group-item">
                            Status Pembayaran : <?php echo $status ?>
                        </li>
                    </ul>
                    <?php if($_SESSION['id_role'] == 1) :?>
                    <div class="mt-3">
                        <form method="post">
                            <?php
                            if ($status_payment == 'pending') :
                                ?>
                                <div class="form-group">
                                    <button type="submit" name="pending" class="btn btn-outline-primary btn-block">Approve Payment</button>
                                </div>
                            <?php endif ; ?>
                                
                        </form>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <?php
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sandbox.midtrans.com/v2/' . $order_id . '/status',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic U0ItTWlkLXNlcnZlci11YUJiRVY2REliMXpCWUZTSWVsVzFISlY6'
            ),
        ));

        $response = curl_exec($curl);
        $data = json_decode($response, true);
        curl_close($curl);

        /**
         * decode response
         */
        $payment_code = $data['payment_code'];
        $store = $data['store'];
        $transaction_time = $data['transaction_time'];
        $gross_amount = $data['gross_amount'];
        $currency = $data['currency'];
        $order_id = $data['order_id'];
        $payment_type = $data['payment_type'];
        $signature_key = $data['signature_key'];
        $status_code = $data['status_code'];
        $transaction_id = $data['transaction_id'];
        $status_message = $data['status_message'];
        $merchant_id = $data['merchant_id'];
        $transaction_status = $data['transaction_status'];

        if ($transaction_status == "settlement") {
            $status_transaksi = '<span class="badge badge-pill badge-primary">' . $transaction_status . '</span>';
        } else {
            $status_transaksi = '<span class="badge badge-pill badge-danger">' . $transaction_status . '</span>';
        }


        if ($status_code == 200) {
            $settlement_time = $data['settlement_time'];
        }






        ?>

        <div class="col-md-12">
            <div class="card border-0 shadow-lg">

                <div class="card-body">
                    <div class="card-title">
                        <h1 class="text-center">Status Payment</h1>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">Kode Pembayaran : <?php echo $payment_code ?></li>
                        <li class="list-group-item">Pembayaran melalui : <?php echo $store ?></li>
                        <li class="list-group-item">Waktu Transaksi : <?php echo $transaction_time ?></li>
                        <li class="list-group-item">Jumlah Pembayaran : <?php echo $gross_amount ?></li>
                        <li class="list-group-item">Mata Uang : <?php echo $currency ?></li>
                        <li class="list-group-item">Order Id : <?php echo $order_id ?></li>
                        <li class="list-group-item">Tipe Pembayaran : <?php echo $payment_type ?></li>
                        <li class="list-group-item">Kode Signature : <?php echo $signature_key ?></li>
                        <li class="list-group-item">Kode Status : <?php echo $status_code ?></li>
                        <li class="list-group-item">ID transaksi : <?php echo $transaction_id ?></li>
                        <li class="list-group-item">Status Transaksi : <?php echo $status_transaksi ?></li>
                        <?php if ($status_code == 200) { ?>
                            <li class="list-group-item">Waktu Settle : <?php echo $settlement_time ?></li>
                        <?php } ?>
                        <li class="list-group-item">Status Pesan : <?php echo $status_message ?></li>
                        <li class="list-group-item">Kode Merchant : <?php echo $merchant_id ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>