<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/19/2019
     * Time: 1:04 AM
     */
    include "inc/header.php";
    include "inc/sidebar.php";
    
    $user_id = Session::get('userId');
    $user_role = Session::get('userRole');
    ?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>User Profile Update</h2>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['name'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $details = $_POST['details'];
                
                $name = mysqli_real_escape_string($db->link, $name);
                $username = mysqli_real_escape_string($db->link, $username);
                $email = mysqli_real_escape_string($db->link, $email);
                $details = mysqli_real_escape_string($db->link, $details);
                
                if (empty($name) || empty($username) || empty($email) || empty($details))
                {
                    echo "<span class='error'>Field Must Not Be Empty!!</span>";
                }else{
                    $query = "update tbl_user set name='$name', username='$username', email='$email', details='$details' where id='$user_id'";
                    $user = $db->update($query);
                    
                    if($user)
                    {
                        echo "<span class='success'>User Data Updated Successfully!!</span>";
                    }else{
                        echo "<span class='error'>Something Went Wrong</span>";
                    }
                }
            }
        ?>
        
        <div class="block">
            <?php
                $query = "select * from tbl_user where id='$user_id' and role='$user_role'";
                $post = $db->select($query);
                while ($result = $post->fetch_assoc())
                {
                    
            ?>
                    <form action="" method="post">
                        <table class="form">
                            
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" value="<?= $result['name']; ?>" name="name" placeholder="Enter Name" class="medium" />
                                </td>
                            </tr>
    
                            <tr>
                                <td>
                                    <label>User Name</label>
                                </td>
                                <td>
                                    <input type="text" value="<?= $result['username']; ?>" name="username" placeholder="Enter User Name" class="medium" />
                                </td>
                            </tr>
    
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="email" value="<?= $result['email']; ?>" name="email" placeholder="Enter Email" class="medium" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Details</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="details"><?= $result['details']; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php } ?>
        </div>
    </div>
</div>
<?php include "inc/footer.php";?>
