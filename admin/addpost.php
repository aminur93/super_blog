<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $title = $_POST['title'];
                    $category = $_POST['cat'];
                    $tag = $_POST['tags'];
                    $author = $_POST['author'];
                    $body = $_POST['body'];
                    $userid = $_POST['userid'];
    
                    $title = mysqli_real_escape_string($db->link, $title);
                    $category = mysqli_real_escape_string($db->link, $category);
                    $tag = mysqli_real_escape_string($db->link, $tag);
                    $author = mysqli_real_escape_string($db->link, $author);
                    $body = mysqli_real_escape_string($db->link, $body);
                    $userid = mysqli_real_escape_string($db->link, $userid);
    
                    $permited = array('jpg', 'jpeg', 'png', 'gif');
                    $file_name = $_FILES['image']['name'];
                    $file_size = $_FILES['image']['size'];
                    $file_temp = $_FILES['image']['tmp_name'];
    
                    $div = explode('.', $file_name);
                    $file_ext = strtolower(end($div));
                    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                    $uploaded_image = "uploads/" . $unique_image;
    
                    if ($title == "" || $category == "" || $tag == "" || $author == "" || $body == "" || $file_name == "") {
                        echo "<span class='error'>Field Must Not Be Empty</span>";
                    } elseif ($file_size > 1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB!</span>";
                    } elseif (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-"
                            . implode(', ', $permited) . "</span>";
                    } else {
                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "INSERT INTO tbl_post(cat,title,body,image,author,tags,userid)
                        VALUES('$category','$title','$body','$uploaded_image','$author','$tag','$userid')";
                        $inserted_rows = $db->insert($query);
                        if ($inserted_rows) {
                            echo "<span class='success'>Post Inserted Successfully.</span>";
                        } else {
                            echo "<span class='error'>Post Not Inserted !</span>";
                        }
                    }
                }
                ?>
                <div class="block">
                 <form action="addpost.php" method="post" enctype="multipart/form-data">
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
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option value="">Select Category</option>
                                    <?php
                                    $query = "select * from tbl_category";
                                    $category = $db->select($query);
                                    while ($result = $category->fetch_assoc()){
                                    ?>
                                    <option value="<?= $result['id']; ?>"><?= $result['name']; ?></option>
                                        <?php } ?>
                                </select>
                            </td>
                        </tr>
                   
                    
                        <tr>
                            <td>
                                <label>Date Picker</label>
                            </td>
                            <td>
                                <input type="text" name="date" id="date-picker" />
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
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Enter Tags" class="medium" />
                            </td>
                        </tr>
    
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?= Session::get('username'); ?>" class="medium" />
                                <input type="hidden" name="userid" value="<?= Session::get('userId'); ?>" class="medium" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
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
<?php include "inc/footer.php";?>