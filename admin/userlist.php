<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/22/2019
     * Time: 3:04 PM
     */
    include "inc/header.php";
    include "inc/sidebar.php";
    ?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>User List</h2>
            <?php
                if(isset($_GET['deluser']))
                {
                    $delid = $_GET['deluser'];
                    $delquery = "delete from tbl_user where id='$delid'";
                    $result = $db->delete($delquery);
                    if($result)
                    {
                        echo "<span class='success'>User Deleted Successfully!!!</span>";
                        header("Location: userlist.php");
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
                        <th>Name</th>
                        <th>UserName</th>
                        <th>Email</th>
                        <th>Details</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = "select * from tbl_user order by id desc";
                        $user = $db->select($query);
                        if($user)
                        {
                            $i = 0;
                            while($result = $user->fetch_assoc())
                            {
                                $i++;
                                
                                ?>
                                <tr class="odd gradeX">
                                    <td><?= $i ?></td>
                                    <td><?= $result['name']; ?></td>
                                    <td><?= $result['username']; ?></td>
                                    <td><?= $result['email']; ?></td>
                                    <td><?= $fDate->textShorten($result['details'],20); ?></td>
                                    <td>
                                        <?php
                                            if($result['role'] == 0)
                                            {
                                                echo "Admin";
                                            }elseif ($result['role'] == 1)
                                            {
                                                echo "Author";
                                            }elseif ($result['role'] == 2)
                                            {
                                                echo "Editor";
                                            }else{
                                                echo "No Role";
                                            }
                                        ?>
                                    </td>
                                    <td><a href="user_view.php?userId=<?= $result['id'];?>">View</a>
                                        <?php
                                        if(Session::get('userRole') == 0)
                                        {
                                        ?>
                                        ||<a onclick="return confirm('Are You Sure Want to Delete')" href="?deluser=<?= $result['id']; ?>">Delete</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php    } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include "inc/footer.php";?>