<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/22/2019
     * Time: 5:01 PM
     */
    
    include "inc/header.php";
    include "inc/sidebar.php";
    
    if (!isset($_GET['viewpostId']) || $_GET['viewpostId'] == NULL)
    {
        header("Location: postlist.php");
    }else{
        $ViewPostId = $_GET['viewpostId'];
    }
    ?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Edit Post</h2>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                header("Location: postlist.php");
            }
        ?>
        
        <div class="block">
            <?php
                $query = "select * from tbl_post where id='$ViewPostId' order by id desc";
                $post = $db->select($query);
                while ($result = $post->fetch_assoc())
                {
                    
                    ?>
                    <form action="" method="post">
                        <table class="form">
                            
                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?= $result['title']; ?>" placeholder="Enter Post Title..." class="medium" />
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
                                    <input type="text" readonly value="<?= $result['date']; ?>" id="date-picker" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img src="<?= $result['image']; ?>" alt="" height="80px" width="200px"><br>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <label>Tags</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?= $result['tags']; ?>" placeholder="Enter Tags" class="medium" />
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <label>Author</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?= $result['author']; ?>" placeholder="Enter Author" class="medium" />
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
