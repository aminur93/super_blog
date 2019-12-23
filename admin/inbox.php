<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php
                    if(isset($_GET['seenId']))
                    {
                        //echo "<script>window.location='inbox.php'</script>";
                        //header("Location: inbox.php");
                    
                        $seenid = $_GET['seenId'];
            
                        $query = "update tbl_contact set status='1' where id='$seenid'";
                        $contact = $db->update($query);
                        if($contact)
                        {
                            echo "<span class='success'>Message Seen Successfully!!</span>";
                            header("Location: inbox.php");
                        }else{
                            echo "<span class='error'>Something Went Wrong</span>";
                        }
                    }
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
                            <th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $query = "select * from tbl_contact where status='0' order by id desc";
                    $contact = $db->select($query);
                    if($contact)
                    {
                        $i = 0;
                        while($result = $contact->fetch_assoc())
                        {
                            $i++;
                    ?>
						<tr class="odd gradeX">
							<td><?= $i; ?></td>
							<td><?= $result['firstname'].' '.$result['lastname']; ?></td>
							<td><?= $result['email']; ?></td>
							<td><?= $fDate->textShorten($result['body'],30); ?></td>
							<td><?= $fDate->formatDate($result['date']); ?></td>
							<td>
                                <a href="viewmsg.php?msgId=<?= $result['id']; ?>">View</a> ||
                                <a href="replymsg.php?msgId=<?= $result['id']; ?>">Reply</a> ||
                                <a href="?seenId=<?= $result['id']; ?>">Seen</a>
                            </td>
						</tr>
                    <?php } } ?>
					</tbody>
				</table>
               </div>
            </div>
    
            <div class="box round first grid">
                <h2>Seen Message</h2>
                <?php
                    if(isset($_GET['delId']))
                    {
                        //echo "<script>window.location='inbox.php'</script>";
                        //header("Location: inbox.php");
            
                        $del_contact = $_GET['delId'];
            
                        $query = "delete from tbl_contact where id='$del_contact'";
                        $contact = $db->delete($query);
                        if($contact)
                        {
                            echo "<span class='success'>Message Deleted Successfully!!</span>";
                        }else{
                            echo "<span class='error'>Something Went Wrong</span>";
                        }
                    }
                ?>
                <div class="block">
                    <table class="data display datatable" id="example">
                        <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "select * from tbl_contact where status='1' order by id desc";
                            $contact = $db->select($query);
                            if($contact)
                            {
                                $i = 0;
                                while($result = $contact->fetch_assoc())
                                {
                                    $i++;
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?= $i; ?></td>
                                        <td><?= $result['firstname'].' '.$result['lastname']; ?></td>
                                        <td><?= $result['email']; ?></td>
                                        <td><?= $fDate->textShorten($result['body'],30); ?></td>
                                        <td><?= $fDate->formatDate($result['date']); ?></td>
                                        <td>
                                            <a href="?delId=<?= $result['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<?php include "inc/footer.php";?>