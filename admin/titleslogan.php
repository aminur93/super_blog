<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php";?>
<style>
    .leftside{
        float: left;
        width: 70%;
    }
    
    .rightside{
        float: left;
        width: 30%;
    }
    
    .rightside img{
        height: 160px;
        width: 170px;
    }
</style>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $title = $fDate->validationData($_POST['title']);
                $slogan = $fDate->validationData($_POST['slogan']);
            
                $title = mysqli_real_escape_string($db->link, $title);
                $slogan = mysqli_real_escape_string($db->link, $slogan);
            
                $permited = array('png');
                $file_name = $_FILES['logo']['name'];
                $file_size = $_FILES['logo']['size'];
                $file_temp = $_FILES['logo']['tmp_name'];
            
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $same_image = 'logo' . '.' . $file_ext;
                $uploaded_image = "uploads/" . $same_image;
            
                if ($title == "" || $slogan == "" ) {
                    echo "<span class='error'>Field Must Not Be Empty</span>";
                }else {
                
                    if (!empty($file_name)) {
                        if ($file_size > 1048567) {
                            echo "<span class='error'>Image Size should be less then 1MB!</span>";
                        } elseif (in_array($file_ext, $permited) === false) {
                            echo "<span class='error'>You can upload only:-"
                                . implode(', ', $permited) . "</span>";
                        } else {
                            move_uploaded_file($file_temp, $uploaded_image);
                            $query = "UPDATE title_slogan
                                              SET
                                              title='$title',
                                              slogan='$slogan',
                                              logo='$uploaded_image'
                                              where id='1'
                                              ";
                        
                            $updated_row = $db->update($query);
                            if ($updated_row) {
                                echo "<span class='success'>Title Slogan Updated Successfully.</span>";
                            } else {
                                echo "<span class='error'>Title Slogan Not Updated !</span>";
                            }
                        }
                    } else {
                        $query = "UPDATE title_slogan
                                              SET
                                              title='$title',
                                              slogan='$slogan'
                                              where id='1'
                                              ";
                    
                        $updated_row = $db->update($query);
                        if ($updated_row) {
                            echo "<span class='success'>Title Slogan Updated Successfully.</span>";
                        } else {
                            echo "<span class='error'>Title Slogan Not Updated !</span>";
                        }
                    }
                }
            }
        ?>
    
        <div class="block sloginblock">
            <?php
                $query = "select * from title_slogan where id='1'";
                $title_slogan = $db->select($query);
                if($title_slogan)
                {
                    while ($result = $title_slogan->fetch_assoc())
                    {
                
            ?>
            <div class="leftside">
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?= $result['title'];?>" placeholder="Enter Website Title..."  name="title" class="medium" />
                            </td>
                        </tr>
                
                         <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?= $result['slogan'];?>" placeholder="Enter Website Slogan..." name="slogan" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Website Logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo" class="medium" />
                            </td>
                        </tr>
                 
                
                         <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            
            <div class="rightside">
                <img src="<?= $result['logo'];?>" alt="">
            </div>
            <?php } } ?>
        </div>
    </div>
</div>
<?php include "inc/footer.php";?>
