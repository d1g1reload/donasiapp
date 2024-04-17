<?php 
if(isset($_POST['contact'])){
    $email = trim($_POST['email']);
    $subjek = trim($_POST['subjek']);
    $message = trim($_POST['message']);

    $error = [
        'email' => '',
        'subjek' => '',
        'message' => ''
    ];

    if($email == ''){
        $error['email'] = "Email tidak boleh kosong";
    }

    if($subjek == ''){
        $error['subjek'] = "Subjek tidak boleh kosong";
    }

    if($message == ''){
        $error['message'] = "Pesan tidak boleh kosong";
    }

    if($email && $subjek && $message){
        $query = query("INSERT INTO contacts (email,subjek,message,contact_date) VALUES('$email','$subjek','$message',now())");
        confirmQuery($query);

        if($query){
            $notif = "pesan berhasil di kirim";
        }
    }

}

?>


<div class="container">
    <div class="row push-from-top">
        <div class="col-md-12">
            <h1 class="text-center">Kontak Kami</h1>
        </div>
    </div>
    <div class="row push-from-top">
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-lg">
                <div class="card-title"><h1 class="text-center">Daftar</h1></div>
                <div class="card-body">
                    <h5><?php echo isset($notif) ? $notif : '';?></h5>
                    <form method="post" autocomplete="off">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" class="form-control" name="email">
                            <p>
                                <?php echo isset($error['email']) ? $error['email'] : '' ;?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="name">Subjek</label>
                            <input type="text" class="form-control" name="subjek">
                            <p>
                                <?php echo isset($error['subjek']) ? $error['subjek'] : '' ;?>
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="name">Pesan</label>
                            <textarea name="message" cols="30" rows="10" class="form-control"></textarea>
                            <p>
                                <?php echo isset($error['message']) ? $error['message'] : '' ;?>
                            </p>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="contact" class="btn btn-block bg-custom-primary text-white">Kirim Pesan</button>
                        </div>
                </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-lg">
                <div class="card-title"><h1 class="text-center">Peta Kami</h1></div>
                <div class="card-body">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126920.28185639124!2d106.75947798530434!3d-6.229571228957863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1608359788580!5m2!1sid!2sid" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>