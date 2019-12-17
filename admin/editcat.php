<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php";?>
<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/13/2019
     * Time: 11:26 PM
     */
    if(!isset($_GET['catId']) || $_GET['catId'] == NULL)
    {
        //echo "<script>window.location = 'catlist.php'</script>";
        header("Location: catlist.php");
    }else{
        $catId = $_GET['catId'];
    }
?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Edit Category</h2>
        <div class="block copyblock">
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST["name"];
                    $name = mysqli_real_escape_string($db->link, $name);
                    
                    if(empty($name))
                    {
                        echo "<span class='error'>Field Must Not Be Empty!!</span>";
                    }else{
                        $query = "UPDATE tbl_category SET name='$name' where id='$catId'";
                        $cat_update = $db->update($query);
                        if($cat_update)
                        {
                            echo "<span class='success'>Catgeory Updated Successfully!!</span>";
                        }else{
                            echo "<span class='error'>Something Wrong!!</span>";
                        }
                    }
                }
            ?>
            <?php
                $query = "select * from tbl_category where id='$catId' order by id desc";
                $category = $db->select($query);
                while ($result = $category->fetch_assoc())
                {
            ?>
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" value="<?= $result['name']; ?>" name="name" placeholder="Enter Category Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
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
