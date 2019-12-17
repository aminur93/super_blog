<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    $copy_right = $fDate->validationData($_POST['copyright']);
                    
                    $copy_right = mysqli_real_escape_string($db->link, $copy_right);
                    
                    if($copy_right == "")
                    {
                        echo "<span class='success'>Field Must Not Be Empty</span>";
                    }else{
                        $query = "UPDATE tbl_copyright SET copy_right='$copy_right' where id='1'";
                        $copyRight = $db->update($query);
                        if($copyRight)
                        {
                            echo "<span class='success'>Copy Right Updated Successfully!!</span>";
                        }else{
                            echo "<span class='error'>Somehting Went Wrong</span>";
                        }
                    }
                }
                ?>
                <div class="block copyblock">
                <?php
                    $query = "select * from tbl_copyright where id='1'";
                    $copRight = $db->select($query);
                    if($copRight)
                    {
                        while ($result = $copRight->fetch_assoc())
                        {
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?= $result['copy_right']; ?>" placeholder="Enter Copyright Text..." name="copyright" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } } ?>
                </div>
            </div>
        </div>
<?php include "inc/footer.php";?>