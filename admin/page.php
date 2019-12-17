<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/15/2019
     * Time: 10:21 PM
     */
    include 'inc/header.php';
    include 'inc/sidebar.php';
    
    if(!isset($_GET['pageId']) || $_GET['pageId'] == NULL)
    {
        header("Location: addpage.php");
    }else{
        $pageid = $_GET['pageId'];
    }
    ?>
    <style>
        .actiondel{
            margin-left: 10px;
        }
        .actiondel a {
            border: 1px solid #ddd;
            color: #444;
            cursor: pointer;
            font-size: 17px;
            padding: 4px 10px;
            font-weight: normal;
            background: #f0f0f0 none repeat scroll 0 0;
        }
    </style>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Edit New Page</h2>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $title = $_POST['title'];
                $body = $_POST['body'];
                
                $title = mysqli_real_escape_string($db->link, $title);
                $body = mysqli_real_escape_string($db->link, $body);
                
                if($name = "" || $body == "")
                {
                    echo "<span class='error'>Field Must Not Be Empty</span>";
                }else{
                    $query = "update tbl_page set title='$title', body='$body' where id='$pageid'";
                    $page = $db->update($query);
                    
                    if($page)
                    {
                        echo "<span class='success'>Page Updated Successfully!!</span>";
                    }else{
                        echo "<span class='error'>Page Not Updated</span>";
                    }
                }
            }
        ?>
        <div class="block">
            <?php
            $query = "select * from tbl_page where id='$pageid'";
            $page = $db->select($query);
            
            if ($page)
            {
                while ($result = $page->fetch_assoc())
                {
            ?>
            <form action="" method="post">
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
                            <span class="actiondel"><a onclick="return confirm('Are you sure want to delete')" href="delete_page.php?delPage=<?= $result['id']; ?>">Delete</a></span>
                        </td>
                    </tr>
                </table>
            </form>
            <?php } }?>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>

