<?php include "inc/header.php"; ?>

 <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $firstname = $fDate->validationData($_POST['firstname']);
        $lastname = $fDate->validationData($_POST['lastname']);
        $email = $fDate->validationData($_POST['email']);
        $body = $fDate->validationData($_POST['body']);
    
        $firstname = mysqli_real_escape_string($db->link, $firstname);
        $lastname = mysqli_real_escape_string($db->link, $lastname);
        $email = mysqli_real_escape_string($db->link, $email);
        $body = mysqli_real_escape_string($db->link, $body);
        
        $errorf = "";
        
        if(empty($firstname))
        {
            $error = "First Name Must Not Be Empty";
        }elseif (!filter_var($firstname,FILTER_SANITIZE_SPECIAL_CHARS))
        {
            $error = "Invalid Name";
        }elseif (empty($lastname))
        {
            $error = "Last Name Must Not Be Empty";
        }elseif (empty($email))
        {
            $error = "Email Must Not Be Empty";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error = "Email Is not Valid. Please Enter Valid Email !!";
        }elseif (empty($body))
        {
            $error = "Message Must Not Be Empty";
        }else{
            $query = "insert into tbl_contact(firstname,lastname,email,body) VALUES ('$firstname','$lastname','$email','$body')";
            $contact = $db->insert($query);
            if($contact)
            {
                $msg = "Message Sent Successfully!!";
            }else{
                $error = "Something Went Wrong!!";
            }
            
        }
        
    }
 ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
                <?php
                    if(isset($error))
                    {
                        echo "<span style='color: red;'>$error</span>";
                    }
    
                    if(isset($msg))
                    {
                        echo "<span style='color: green;'>$msg</span>";
                    }
                ?>
			    <form action="" method="post">
                    <table>
                        <tr>
                            <td>Your First Name:</td>
                            <td>
                            <input type="text" name="firstname" placeholder="Enter first name"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Your Last Name:</td>
                            <td>
                            <input type="text" name="lastname" placeholder="Enter Last name"/>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Your Email Address:</td>
                            <td>
                            <input type="text" name="email" placeholder="Enter Email Address" />
                            </td>
                        </tr>
                        <tr>
                            <td>Your Message:</td>
                            <td>
                            <textarea name="body"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                            <input type="submit" name="submit" value="Send"/>
                            </td>
                        </tr>
                    </table>
	            <form>
            </div>
        </div>
        
<?php include "inc/sidebar.php"; ?>

<?php include "inc/footer.php"; ?>
        