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
        $messageId = $_GET['msgId'];
    }
?>
<div class="grid_10">
    
    <div class="box round first grid">
        <h2>Reply Message</h2>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $to = $fDate->validationData($_POST['toEmail']);
                $from = $fDate->validationData($_POST['fromEmail']);
                $subject = $fDate->validationData($_POST['subject']);
                $message = $fDate->validationData($_POST['message']);
                
                $sendmail = mail($to,$subject,$message,$from);
                
                if ($sendmail)
                {
                    echo "<span class='success'>Message Send Successfully!!</span>";
                }else{
                    echo "<span class='success'>Something Went Wrong</span>";
                }
            }
        ?>
        <div class="block">
            <form action="" method="post">
                <?php
                    $query = "select * from tbl_contact where id='$messageId'";
                    $contact = $db->select($query);
                    if($contact)
                    {
                        while($result = $contact->fetch_assoc())
                        {
                            ?>
                            <table class="form">
                                
                                <tr>
                                    <td>
                                        <label>To</label>
                                    </td>
                                    <td>
                                        <input type="text" readonly name="toEmail" value="<?= $result['email']; ?>" class="medium"/>
                                    </td>
                                </tr>
    
                                <tr>
                                    <td>
                                        <label>From</label>
                                    </td>
                                    <td>
                                        <input type="text" name="fromEmail" placeholder="Enter Your Email Address" class="medium"/>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <label>Subject</label>
                                    </td>
                                    <td>
                                        <input type="text" name="subject" class="medium"/>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td style="vertical-align: top; padding-top: 9px;">
                                        <label>Message</label>
                                    </td>
                                    <td>
                                        <textarea class="tinymce" name="message"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="submit" name="submit" Value="Send" />
                                    </td>
                                </tr>
                            </table>
                        <?php } } ?>
            </form>
        </div>
    </div>
</div>
<?php include "inc/footer.php";?>
