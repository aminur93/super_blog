<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/15/2019
     * Time: 9:56 PM
     */
    include 'inc/header.php';
    include 'inc/sidebar.php';
    ?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Add New Page</h2>
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
                $query = "insert into tbl_page(title,body) VALUES ('$title','$body')";
                $page = $db->insert($query);
                
                if($page)
                {
                    echo "<span class='success'>Page Inserted Successfully!!</span>";
                }else{
                    echo "<span class='error'>Page Not Inserted</span>";
                }
            }
        }
        ?>
        <div class="block">
            <form action="" method="post">
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
                            <input type="submit" name="submit" Value="Create" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
