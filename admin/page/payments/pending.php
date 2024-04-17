<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Pending Payments</h1>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Judul Posting</th>
                                    <th>Nama</th>
                                    <th>Jumlah Donasi</th>
                                    <th>Kode Order</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $id_user = $_SESSION['id_user'];
                                    if($_SESSION['id_role'] == 1){
                                    $query = query("SELECT * FROM payments
                                                    INNER JOIN posts ON posts.id_post=payments.id_post
                                                    INNER JOIN users ON users.id_user=payments.id_user
                                                    WHERE payments.status_payment='pending'");
                                    }else{
                                    $query = query("SELECT * FROM payments
                                                    INNER JOIN posts ON posts.id_post=payments.id_post
                                                    INNER JOIN users ON users.id_user=payments.id_user
                                                    WHERE payments.id_user='$id_user' AND payments.status_payment='pending' ");
                                    }
                                    while($row = mysqli_fetch_array($query)){
                                    $post_title = $row['post_title'];
                                    $fullname = $row['fullname'];
                                    $amount = $row['amount'];
                                    $payment_order = $row['payment_order'];
                                        
                                ?>
                                <tr>
                                    
                                    <td><?php echo $post_title ?></td>
                                    <td><?php echo $fullname ?></td>
                                    <td><?php echo $amount ?></td>
                                    <td><?php echo $payment_order ?></td>
                                    <td>
                                        <a class="btn btn-dark btn-block" href="<?php echo BASE_URL_ADMIN ?>?page=detailpayment&detail=<?php echo $row['id_payment'] ?>"><i class="fa fa-eye"></i> Detail</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

