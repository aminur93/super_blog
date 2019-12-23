<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/22/2019
     * Time: 3:17 PM
     */
    include "inc/header.php";
    include "inc/sidebar.php";
    
    if(!isset($_GET['userId']) || $_GET['userId'] == NULL)
    {
        header("Location: userlist.php");
    }else{
        $userId = $_GET['userId'];
    }
    ?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>View User</h2>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                header("Location: userlist.php");
            }
        ?>
        
        <div class="block">
            <?php
                $query = "select * from tbl_user where id='$userId'";
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
                                    <input type="text" value="<?= $result['name']; ?>" readonly placeholder="Enter Name" class="medium" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <label>User Name</label>
                                </td>
                                <td>
                                    <input type="text" value="<?= $result['username']; ?>" readonly placeholder="Enter User Name" class="medium" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="email" value="<?= $result['email']; ?>" readonly placeholder="Enter Email" class="medium" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Details</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" readonly><?= $result['details']; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Ok" />
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php } ?>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>
