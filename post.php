<?php include "inc/header.php"; ?>

<?php
    if(!isset($_GET['id']) || $_GET['id'] == NULL)
    {
        header("Location: 404.php");
    }else{
        $id = $_GET['id'];
    }
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
                <?php
                    $query = "select * from tbl_post where id=$id";
                    $post = $db->select($query);
                    if($post)
                    {
                    while ($result = $post->fetch_assoc())
                    {
                ?>
				<h2><?php echo $result['title']; ?></h2>
                <h4><?php echo $fDate->formatDate($result['date']); ?>, By <?php echo $result['author']; ?></h4>
                <img src="admin/<?php echo $result['image']; ?>" alt="post image"/>
				<?php echo $result['body']; ?>
				
				<div class="relatedpost clear">
					<h2>Related articles</h2>
                    <?php
                        $catId = $result['cat'];
                        $query_related = "select * from tbl_post where cat='$catId' order by rand() limit 6";
                        $related_post = $db->select($query_related);
                        if($related_post)
                        {
                        while ($related_result = $related_post->fetch_assoc())
                        {
                    ?>
					<a href="post.php?id=<?php echo $related_result['id']; ?>"><img src="admin/<?php echo $related_result['image']; ?>" alt="post image"/></a>
                    <?php } }else{ echo "No Related Post Available!!"; }?>
				</div>
                <?php } }else{ header("Location: 404.php");} ?>
	        </div>
		</div>
  
<?php include "inc/sidebar.php"; ?>

<?php include "inc/footer.php"; ?>
        