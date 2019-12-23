<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php";?>
<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/14/2019
     * Time: 7:10 PM
     */
    
    if(!isset($_GET['postId']) || $_GET['postId'] == NULL)
    {
        header("Location: postlist.php");
    }else{
        $postId = $_GET['postId'];
    }
    ?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Edit Post</h2>
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
                
                if ($title == "" || $category == "" || $tag == "" || $author == "" || $body == "") {
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
                            $query = "UPDATE tbl_post
                                  SET
                                  cat='$category',
                                  title='$title',
                                  body='$body',
                                  image='$uploaded_image',
                                  author='$author',
                                  tags='$tag',
                                  userid='$userid'
                                  where id='$postId'
                                  ";
            
                            $updated_row = $db->update($query);
                            if ($updated_row) {
                                echo "<span class='success'>Post Updated Successfully.</span>";
                            } else {
                                echo "<span class='error'>Post Not Updated !</span>";
                            }
                        }
                    } else {
                        $query = "UPDATE tbl_post
                                  SET
                                  cat='$category',
                                  title='$title',
                                  body='$body',
                                  author='$author',
                                  tags='$tag',
                                  userid='$userid'
                                  where id='$postId'
                                  ";
        
                        $updated_row = $db->update($query);
                        if ($updated_row) {
                            echo "<span class='success'>Post Updated Successfully.</span>";
                        } else {
                            echo "<span class='error'>Post Not Updated !</span>";
                        }
                    }
                }
            }
        ?>
        
        <div class="block">
            <?php
                $query = "select * from tbl_post where id='$postId' order by id desc";
                $post = $db->select($query);
                while ($result = $post->fetch_assoc())
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
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="cat">
                                <option value="">Select Category</option>
                                <?php
                                    $query = "select * from tbl_category";
                                    $category = $db->select($query);
                                    while ($res = $category->fetch_assoc()){
                                        ?>
                                        <option value="<?= $res['id']; ?>" <?=(($result['cat'] == $res['id'])?' selected':'')?>><?= $res['name']; ?></option>
                                    <?php } ?>
                            </select>
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <td>
                            <label>Date Picker</label>
                        </td>
                        <td>
                            <input type="text" value="<?= $result['date']; ?>" name="date" id="date-picker" />
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
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" value="<?= $result['tags']; ?>" name="tags" placeholder="Enter Tags" class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Author</label>
                        </td>
                        <td>
                            <input type="text" value="<?= $result['author']; ?>" name="author" placeholder="Enter Author" class="medium" />
                            <input type="hidden" value="<?= Session::get('userId'); ?>" name="userid" class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"><?= $result['body']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Edit" />
                        </td>
                    </tr>
                </table>
            </form>
                <?php } ?>
        </div>
    </div>
</div>
<?php include "inc/footer.php";?>
