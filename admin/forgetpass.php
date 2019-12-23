<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/22/2019
     * Time: 6:33 PM
     */
    
    include '../lib/Session.php';
    Session::checkLogin();
    
    include '../config/config.php';
    
    include '../lib/Database.php';
    
    include '../helpers/Format.php';
    
    $db = new Database();
    $fDate = new Format();
    ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Recovery Password</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
    <section id="content">
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $email = $fDate->validationData($_POST['email']);
    
                $email = mysqli_real_escape_string($db->link,$email);
                
                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    echo "Invalid Email Address";
                }else {
    
                    $mailCheck = "select * from tbl_user where email='$email' limit 1";
                    $allUser = $db->select($mailCheck);
                    
                    if ($allUser != false) {
                        while ($value = $allUser->fetch_assoc())
                        {
                            $userid = $value['id'];
                            $username = $value['username'];
                        }
                        $text = substr($email,0,3);
                        $rand = rand(10000,99999);
                        $newpass = "$text$rand";
                        $password = md5($newpass);
                        
                        $query = "update tbl_user set password='$password' where id='$userid'";
                        $updated_row = $db->update($query);
                        
                        $to = "$email";
                        $from = "aminurrashid126@gmail.com";
                        $headers = "From: $from\n";
                        $headers .= 'MIME-Version: 1.0';
                        $headers .= 'Content-type: text/html; charset=iso-8859-1';
                        $subject = "Your Password";
                        $message = "Your Username ".$username." and Password is ".$newpass." Please Visit Website Login";
                        
                        $sendmail = mail($to,$subject,$message,$headers);
                        if($sendmail)
                        {
                            echo "<span style='color:green;font-size: 18px;'>Plase Check Your Email For New Password !!</span>";
                        }else{
                            echo "<span style='color:red;font-size: 18px;'>Email Not Sent!!</span>";
                        }
                    }else {
                        echo "<span style='color:red;font-size: 18px;'>Email Not Exist!!</span>";
                    }
                }
            }
        ?>
        <form action="" method="post">
            <h1>Recovery Password</h1>
            <div>
                <input type="text" placeholder="Enter Email" required="" name="email"/>
            </div>
            <div>
                <input type="submit" value="Send Email" />
            </div>
        </form><!-- form -->
        <div class="button">
            <a href="login.php">Login</a>
        </div><!-- button -->
        <div class="button">
            <a href="#">Developer Aminur Rashid</a>
        </div><!-- button -->
    </section><!-- content -->
</div><!-- container -->
</body>
</html>
