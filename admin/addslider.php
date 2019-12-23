<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/23/2019
     * Time: 4:53 PM
     */
    
    include "inc/header.php";
    include "inc/sidebar.php"
    ?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Add New Slider</h2>
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
                
                if ($title == "" || $file_name == "") {
                    echo "<span class='error'>Field Must Not Be Empty</span>";
                } elseif ($file_size > 1048567) {
                    echo "<span class='error'>Image Size should be less then 1MB!</span>";
                } elseif (in_array($file_ext, $permited) === false) {
                    echo "<span class='error'>You can upload only:-"
                        . implode(', ', $permited) . "</span>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "INSERT INTO tbl_slider(title,image)
                        VALUES('$title','$uploaded_image')";
                    $inserted_rows = $db->insert($query);
                    if ($inserted_rows) {
                        echo "<span class='success'>Slider Inserted Successfully.</span>";
                    } else {
                        echo "<span class='error'>Slider Not Inserted !</span>";
                    }
                }
            }
        ?>
        <div class="block">
            <form action="addslider.php" method="post" enctype="multipart/form-data">
                <table class="form">
                    
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
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
