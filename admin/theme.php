<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/23/2019
     * Time: 2:46 PM
     */
    
    include "inc/header.php";
    include "inc/sidebar.php";
    ?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Theme</h2>
        <div class="block copyblock">
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $theme = $_POST["theme"];
                    $theme = mysqli_real_escape_string($db->link, $theme);
                   
                    $query = "UPDATE tbl_theme SET theme='$theme' where id='1'";
                    $theme_update = $db->update($query);
                    if($theme_update)
                    {
                        echo "<span class='success'>Theme Updated Successfully!!</span>";
                    }else{
                        echo "<span class='error'>Something Wrong!!</span>";
                    }
                    
                }
            ?>
            
            <?php
            $query = "select * from tbl_theme where id='1'";
            $theme = $db->select($query);
            while ($result = $theme->fetch_assoc())
            {
            ?>
            
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input <?php if($result['theme'] == 'default'){ echo "checked";}?> type="radio" name="theme" value="default" /> Default
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            <input <?php if($result['theme'] == 'green'){ echo "checked";}?> type="radio" name="theme" value="green" /> Green
                        </td>
                    </tr>
    
                    <tr>
                        <td>
                            <input <?php if($result['theme'] == 'red'){ echo "checked";}?> type="radio" name="theme" value="red" /> Red
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Change" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php } ?>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>
