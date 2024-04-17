<?php 

    if(isset($_GET['detail'])){
        $id_post = $_GET['detail'];

        $query = query("SELECT * FROM posts 
                        INNER JOIN category ON category.id_category = posts.id_category
                        INNER JOIN users ON users.id_user = posts.id_user
                        WHERE id_post='$id_post' ");
        $data = mysqli_fetch_array($query);

        $fullname = $data['fullname'];
        $category = $data['category_name'];
        $title = $data['post_title'];
        $description = $data['post_description'];
        $amount = number_format($data['post_amount'],2);
        $date = $data['post_date'];
        $image = $data['post_image'];
    }

?>

<div class="container">
    <div class="row">
        <di class="col-md-12">
            <h1 class="text-center">
                Detail Post
            </h1>
        </di>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                <a href="<?php echo BASE_URL_ADMIN ?>?page=listposts" class="btn btn-secondary mb-3"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="col-md-3">Nama Lengkap</td>
                                <td>:</td>
                                <td><?php echo $fullname ?> </td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Kategori</td>
                                <td>:</td>
                                <td><?php echo $category ?> </td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Judul</td>
                                <td>:</td>
                                <td><?php echo $title ?> </td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Deskripsi</td>
                                <td>:</td>
                                <td><?php echo $description ?> </td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Jumlah Donasi</td>
                                <td>:</td>
                                <td>Rp. <?php echo $amount ?> </td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Tanggal Posting</td>
                                <td>:</td>
                                <td><?php echo $date ?> </td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Poster</td>
                                <td>:</td>
                                <td>
                                    <img src="<?php echo BASE_URL ?>/assets/img/<?php echo $image ?> " class="img-fluid" alt="poster">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card border-0 shadow-lg">
                <div class="card-title"><h1 class="text-center">History Donasi</h1></div>
                <div class="card-body">
                
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Donatur</th>
                                <th>Jumlah Donasi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = query("SELECT * FROM payments
                                                INNER JOIN posts ON posts.id_post = payments.id_post
                                                INNER JOIN users ON users.id_user = payments.id_user
                                                WHERE payments.id_post='$id_post'");
                                while($item = mysqli_fetch_array($query)){
                                    $status = $item['status_payment'];
                                    if($status == "pending"){
                                        $status_payment = '<div class="badge badge-danger">Pending</div> ';
                                    }else{
                                        $status_payment = '<div class="badge badge-success">Success</div> ';
                                    }
                            ?>
                            <tr>
                                <td><?php echo $item['fullname'] ?></td>
                                <td>Rp. <?php echo number_format($item['amount'],2) ?></td>
                                <td><?php echo $status_payment ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>