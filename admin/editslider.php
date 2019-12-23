<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/23/2019
     * Time: 5:16 PM
     */
    include "inc/header.php";
    include "inc/sidebar.php";
    
    if (!isset($_GET['sliderId']) || $_GET['sliderId'] == NULL)
    {
        header("Location: sliderlist.php");
    }else{
        $sliderId = $_GET['sliderId'];
    }
    ?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Edit New Slider</h2>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $title = $_POST['title'];
        
                $title = mysqli_real_escape_string($db->link, $title);
        
                $permited = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];
        
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                $uploaded_image = "uploads/" . $unique_image;
        
                if ($title == "") {
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
                            $query = "UPDATE tbl_slider
                                  SET
                                  title='$title',
                                  image='$uploaded_image',
                                  where id='$postId'
                                  ";
                    
                            $updated_row = $db->update($query);
                            if ($updated_row) {
                                echo "<span class='success'>slider Updated Successfully.</span>";
                            } else {
                                echo "<span class='error'>slider Not Updated !</span>";
                            }
                        }
                    } else {
                        $query = "UPDATE tbl_slider
                                  SET
                                  title='$title'
                                  where id='$sliderId'
                                  ";
                
                        $updated_row = $db->update($query);
                        if ($updated_row) {
                            echo "<span class='success'>slider Updated Successfully.</span>";
                        } else {
                            echo "<span class='error'>slider Not Updated !</span>";
                        }
                    }
                }
            }
        ?>
        <div class="block">
            <?php
            $query = "select * from tbl_slider where id='$sliderId'";
            $slider = $db->select($query);
            
            while ($result = $slider->fetch_assoc())
            {
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" value="<?= $result['title']; ?>" name="title" placeholder="Enter Post Title..." class="medium" />
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?= $result['image']; ?>" alt="" height="80px" width="200px"><br>
                            <input type="file" name="image" />
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
<?php include "inc/footer.php"; ?>
