<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/18/2019
     * Time: 11:55 PM
     */
    include "inc/header.php";
    include "inc/sidebar.php";
    ?>
<?php
    if(!Session::get('userRole') == 0) {
        header("Location: index.php");
    }
?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Add New Users</h2>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $fDate->validationData($_POST['username']);
                $password = $fDate->validationData($_POST['password']);
                $role = $fDate->validationData($_POST['role']);
                $email = $fDate->validationData($_POST['email']);
    
                $username = mysqli_real_escape_string($db->link, $username);
                $password = mysqli_real_escape_string($db->link, md5($password));
                $role = mysqli_real_escape_string($db->link, $role);
                $email = mysqli_real_escape_string($db->link, $email);
                
                
                if (empty($username) || empty($password) || empty($role) || empty($email))
                {
                    echo "<span class='error'>Field Must Not Be Empty</span>";
                }else {
    
                    $query = "select * from tbl_user where email='$email' limit 1";
                    $allUser = $db->select($query);
                    if ($allUser != false) {
                        echo "<span class='error'>Email Already Exist!!</span>";
                    } else {
                        $query = "insert into tbl_user(username,password,role,email)VALUES ('$username','$password','$role','$email')";
                        $userData = $db->insert($query);
        
                        if ($userData) {
                            echo "<span class='success'>User Data Stored Sucessfully!!</span>";
                        } else {
                            echo "<span class='error'>Something Went Wrong</span>";
                        }
                    }
                }
            }
        ?>
        <div class="block">
            <form action="" method="post">
                <table class="form">
                    
                    <tr>
                        <td>
                            <label>User Name</label>
                        </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter User Name" class="medium" />
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" name="email" placeholder="Enter Valid Email" class="medium" />
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            <label>Password</label>
                        </td>
                        <td>
                            <input type="password" name="password" placeholder="Enter Password" class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Role</label>
                        </td>
                        <td>
                            <select id="select" name="role">
                                <option value="">Select Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>
