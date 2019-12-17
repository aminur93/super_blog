<?php include 'inc/header.php'; ?>
<?php
if(!isset($_GET['pageId']) || $_GET['pageId'] == NULL)
{
    header("Location: 404.php");
}else{
    $pageid = $_GET['pageId'];
}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
                <?php
                    $query = "select * from tbl_page where id='$pageid'";
                    $page = $db->select($query);
                    if($page) {
                        while ($result = $page->fetch_assoc()){
                ?>
				<h2><?= $result['title']; ?></h2>
	
				<?= $result['body']; ?>
                <?php } }else{ header("Location: 404.php"); } ?>
	        </div>

		</div>
  
<?php include "inc/sidebar.php";?>

<?php include "inc/footer.php"?>
        