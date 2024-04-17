<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




//======================DATABASE HELPER======================//

function query($query){
    global $connection;
    return mysqli_query($connection,$query);
}

function escape($value){
    global $connection;
    return mysqli_real_escape_string($connection,$value);
}

function redirect($location){
    header('Location: ' . $location);
    exit();
}

function confirmQuery($result){
    global $connection;
    if(!$result){
        die('QUERY FAILED ' . mysqli_error($connection));
    }
}


//======================END DATABASE HELPER======================//


//======================REGISTER/LOGIN USERS======================//

function loginUser($email,$password){
    $email = trim($email);
    $password = trim($password);

    $email = escape($email);
    $password = escape($password);

    $query = query("SELECT * FROM users WHERE email='$email' AND user_status='2' ");
    confirmQuery($query);

    while($row = mysqli_fetch_array($query)){
        $db_user_id = $row['id_user'];
        $db_user_role_id = $row['id_role'];
        $db_fullname = $row['fullname'];
        $db_phone = $row['phone'];
        $db_email = $row['email'];
        $db_user_status = $row['user_status'];
        $db_password = $row['password'];

        if(password_verify($password,$db_password)){
            $_SESSION['id_user'] = $db_user_id;
            $_SESSION['id_role'] = $db_user_role_id;
            $_SESSION['fullname'] = $db_fullname;
            $_SESSION['phone'] = $db_phone;
            $_SESSION['email'] = $db_email;
            $_SESSION['user_status'] = $db_user_status;

            redirect(BASE_URL_ADMIN);
        }
    }
    return true;
}


function registerUser($fullname,$phone,$email,$password){
    
        $fullname = escape($fullname);
        $phone = escape($phone);
        $email = escape($email);
        $password = password_hash($password,PASSWORD_BCRYPT,array('cost'=>'10'));

        $query = query("INSERT INTO users (fullname,phone,email,password,user_registered)
                        VALUES('$fullname','$phone','$email','$password',now()) ");
        confirmQuery($query);
}

function email_exists($email){
    $query = query("SELECT email FROM users WHERE email='$email'");
    confirmQuery($query);
    if(mysqli_num_rows($query) > 0){
        return true;
    }else{
        return false;
    }
}

function isLoggedIn(){
    if(isset($_SESSION['email'])){
        return true;
    }
    return false;
}

//======================END REGISTER/LOGIN USERS======================//

//======================Dashboard analytics======================//


function total_dana(){
    $query = query("SELECT SUM(post_amount) as 'total' FROM posts ");
    $data = mysqli_fetch_array($query);
    if($data){
        return number_format($data['total'],2);
    }else{
        return false;
    }

    
    
}

function total_dana_user($iduser=null){
    $query = query("SELECT SUM(post_amount) as 'total' FROM posts
                    WHERE posts.id_user='$iduser' ");
    $data = mysqli_fetch_array($query);
    return number_format($data['total'],2);
    
}

function total_kategori(){
    $query = query("SELECT COUNT(*) as 'total_kategori' FROM category");
    $data = mysqli_fetch_array($query);
    return $data['total_kategori'];
}

function total_posts(){
    $query = query("SELECT COUNT(*) as 'total_posts' FROM posts");
    $data = mysqli_fetch_array($query);
    return $data['total_posts'];
}

function total_users(){
    $query = query("SELECT COUNT(*) as 'total_users' FROM users");
    $data = mysqli_fetch_array($query);
    return $data['total_users'];
}


//======================End Dashboard analytics======================//



//======================Mailer Handle======================//


function send_email($email)
{
  
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
        //Server settings
//         $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = SMTP_HOST;                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = SMTP_USERNAME;                     //SMTP username
        $mail->Password   = SMTP_PASSWORD;                               //SMTP password
        $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
        $mail->Port       = SMTP_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
        //Recipients
        $mail->setFrom('no-reply@donasiapps.com', 'Website Funding');
        $mail->addAddress($email);     //Add a recipient
        
        
        
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Aktivasi Link Pendaftaran Website Donasi';
        $mail->Body    = "Silahkan klik link aktivasi berikut 
                            <a href='http://localhost/lecture/webdonasi/?page=confirm&success={$email}'>Aktivasi Akun</a>";
        
        
        $mail->send();
        //         var_dump($mail);
        //         echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

//======================End Mailer Handle======================//


?>