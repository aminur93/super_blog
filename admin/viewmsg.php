<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/17/2019
     * Time: 9:20 PM
     */
    include "inc/header.php";
    include "inc/sidebar.php";
    
    if(!isset($_GET['msgId']) || $_GET['msgId'] == NULL)
    {
        header("Location: inbox.php");
    }else{
        $message = $_GET['msgId'];
    }
    ?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>View Message</h2>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                header("Location: inbox.php");
            }
        ?>
        <div class="block">
            <form action="" method="post">
                <?php
                    $query = "select * from tbl_contact where id='$message'";
                    $contact = $db->select($query);
                    if($contact)
                    {
                    while($result = $contact->fetch_assoc())
                    {
                ?>
                <table class="form">
                    
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" value="<?= $result['firstname'].' '.$result['lastname'];?>"  class="medium" readonly/>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" value="<?= $result['email']; ?>" class="medium" readonly/>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Date</label>
                        </td>
                        <td>
                            <input type="text" value="<?= $fDate->formatDate($result['date']) ;?>" class="medium" readonly/>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea class="tinymce" readonly><?= $result['body']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Ok" />
                        </td>
                    </tr>
                </table>
                <?php } } ?>
            </form>
        </div>
    </div>
</div>
<?php include "inc/footer.php";?>
