<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/17/2019
     * Time: 2:37 PM
     */
    
    include '../lib/Session.php';
    Session::checkSession();
    
    include '../config/config.php';
    
    include '../lib/Database.php';
    
    $db = new Database();
    ?>

<?php
if(!isset($_GET['delPage']) || $_GET['delPage'] == NULL)
{
    header("Location: index.php");
}else{
    $pageDel = $_GET['delPage'];
    
    $delquery = "delete from tbl_page where id='$pageDel'";
    $delData = $db->delete($delquery);
    if($delData)
    {
        echo "<script>alert('Page Deleted Successfully!!!')</script>";
        echo "<script>window.location = 'index.php'</script>";
    }else{
        echo "<script>alert('Page Not Deleted Successfully!!!')</script>";
        echo "<script>window.location = 'index.php'</script>";
    }
}
?>
