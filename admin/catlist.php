<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php";?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php
            if(isset($_GET['delcat']))
            {
                $delid = $_GET['delcat'];
                $delquery = "delete from tbl_category where id='$delid'";
                $result = $db->delete($delquery);
                if($result)
                {
                    echo "<span class='success'>Catgeory Deleted Successfully!!!</span>";
                    header("Location: catlist.php");
                }else{
                    echo "<span class='error'>Something Went Wrong!!!</span>";
                }
            }
        ?>
        <div class="block">
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "select * from tbl_category order by id desc";
                $category = $db->select($query);
                if($category)
                {
                    $i = 0;
                    while($result = $category->fetch_assoc())
                    {
                    $i++;
                 
            ?>
                <tr class="odd gradeX">
                    <td><?= $i ?></td>
                    <td><?= $result['name']; ?></td>
                    <td><a href="editcat.php?catId=<?= $result['id'];?>">Edit</a> || <a onclick="return confirm('Are You Sure Want to Delete')" href="?delcat=<?= $result['id']; ?>">Delete</a></td>
                </tr>
            <?php    } } ?>
            </tbody>
        </table>
       </div>
    </div>
</div>
<?php include "inc/footer.php";?>