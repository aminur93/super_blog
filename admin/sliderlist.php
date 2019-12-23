<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/23/2019
     * Time: 4:53 PM
     */
    
    include "inc/header.php";
    include "inc/sidebar.php";
    ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <?php
            if(isset($_GET['deleteSlider']))
            {
                $delid = $_GET['deleteSlider'];
                
                $query = "select * from tbl_slider where id='$delid'";
                $getData = $db->select($query);
                if($getData)
                {
                    while ($delimg = $getData->fetch_assoc())
                    {
                        $dellink = $delimg['image'];
                        unlink($dellink);
                    }
                }
                
                $delQuery = "delete from tbl_slider where id='$delid'";
                $result = $db->delete($delQuery);
                if ($result)
                {
                    echo "<span class='success'>Slider Deleted Successfully!!!</span>";
                    //header("Location: postlist.php");
                }else{
                    echo "<span class='error'>Something Went Wrong!!!</span>";
                }
            }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th width="5%">#Sl</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $query = "select * from tbl_slider";
                    $slider = $db->select($query);
                    if($slider)
                    {
                        $i = 0;
                        while ($result = $slider->fetch_assoc())
                        {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?= $i; ?></td>
                                <td><?= $result['title'];?></td>
                                <td><img src="<?= $result['image'];?>" height="40px" width="100px"></td>
                                <td>
                                    
                                     <a href="editslider.php?sliderId=<?= $result['id'];?>">Edit</a>
                                        
                                    ||<a onclick="return confirm('Are You Sure Want To Delete')" href="?deleteSlider=<?= $result['id'];?>">Delete</a>
                                    
                                </td>
                            </tr>
                        <?php } } ?>
                </tbody>
            </table>
        
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>
