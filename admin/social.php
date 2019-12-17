<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php";?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $fb = $fDate->validationData($_POST['facebook']);
            $tw = $fDate->validationData($_POST['twitter']);
            $ln = $fDate->validationData($_POST['linkedin']);
            $gp = $fDate->validationData($_POST['googleplus']);
            
            $fb = mysqli_real_escape_string($db->link, $fb);
            $tw = mysqli_real_escape_string($db->link, $tw);
            $ln = mysqli_real_escape_string($db->link, $ln);
            $gp = mysqli_real_escape_string($db->link, $gp);
            
            if($gp == "" || $tw == "" || $ln == "" || $gp == "")
            {
                echo "<span class='error'>Field Must Not Be Empty</span>";
            }else{
                $query = "UPDATE tbl_social SET fb='$fb',tw='$tw',ln='$ln',gp='$gp' where id='1'";
                $social_update = $db->update($query);
                if($social_update)
                {
                    echo "<span class='success'>Social Update Successfully</span>";
                }else{
                    echo "<span class='error'>Something Went Wrong</span>";
                }
            }
        }
        ?>
        <div class="block">
        <?php
            $query = "select * from tbl_social where id='1'";
            $social = $db->select($query);
            if($social)
            {
                while ($result = $social->fetch_assoc())
                {
        ?>
         <form action="" method="post">
            <table class="form">
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" value="<?= $result['fb']; ?>" name="facebook" placeholder="Facebook link.." class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" value="<?= $result['tw']; ?>" name="twitter" placeholder="Twitter link.." class="medium" />
                    </td>
                </tr>
                
                 <tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" value="<?= $result['ln']; ?>" name="linkedin" placeholder="LinkedIn link.." class="medium" />
                    </td>
                </tr>
                
                 <tr>
                    <td>
                        <label>Google Plus</label>
                    </td>
                    <td>
                        <input type="text" value="<?= $result['gp']; ?>" name="googleplus" placeholder="Google Plus link.." class="medium" />
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
        <?php } } ?>
        </div>
    </div>
</div>
<?php include "inc/footer.php";?>
