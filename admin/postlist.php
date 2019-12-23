<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php";?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <?php
            if(isset($_GET['deletePost']))
            {
                $delid = $_GET['deletePost'];
                
                $query = "select * from tbl_post where id='$delid'";
                $getData = $db->select($query);
                if($getData)
                {
                    while ($delimg = $getData->fetch_assoc())
                    {
                        $dellink = $delimg['image'];
                        unlink($dellink);
                    }
                }
                
                $delQuery = "delete from tbl_post where id='$delid'";
                $result = $db->delete($delQuery);
                if ($result)
                {
                    echo "<span class='success'>Post Deleted Successfully!!!</span>";
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
                    <th width="15%">Post Title</th>
                    <th width="15%">Description</th>
                    <th width="10%">Category</th>
                    <th width="10%">Image</th>
                    <th width="10%">Author</th>
                    <th width="10%">Tags</th>
                    <th width="10%">Date</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $query = "select tbl_post.*, tbl_category.name
                       from tbl_post
                       INNER JOIN tbl_category
                       ON tbl_post.cat = tbl_category.id
                       ORDER BY tbl_post.id DESC
                       ";
            $post = $db->select($query);
            if($post)
            {
                $i = 0;
                while ($result = $post->fetch_assoc())
                {
                    $i++;
            ?>
                <tr class="odd gradeX">
                    <td><?= $i; ?></td>
                    <td><?= $result['title'];?></td>
                    <td><?= $fDate->textShorten($result['body'],50);?></td>
                    <td><?= $result['name'];?></td>
                    <td><img src="<?= $result['image'];?>" height="40px" width="60px"></td>
                    <td><?= $result['author'];?></td>
                    <td><?= $result['tags'];?></td>
                    <td><?= $fDate->formatDate($result['date']);?></td>
                    <td>
                        <a href="viewpost.php?viewpostId=<?= $result['id'];?>">View</a>
                        <?php if(Session::get('userId') == $result['userid'] || Session::get('userRole') == '0'){ ?>
                            ||<a href="editpost.php?postId=<?= $result['id'];?>">Edit</a>
    
                            ||<a onclick="return confirm('Are You Sure Want To Delete')" href="?deletePost=<?= $result['id'];?>">Delete</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } } ?>
            </tbody>
        </table>

       </div>
    </div>
</div>
<?php include "inc/footer.php";?>
