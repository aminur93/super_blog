<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/11/2019
     * Time: 5:50 PM
     */
    include "inc/header.php";
?>

<?php
    if(!isset($_GET['search']) || $_GET['search'] == NULL)
    {
        header("Location: 404.php");
    }else{
        $search = $_GET['search'];
    }
?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <?php
            $query = "select * from tbl_post where title LIKE '%$search%' OR body LIKE '%$search%' OR tags LIKE '%$search%'";
            $post = $db->select($query);
            if($post)
            {
                while ($result = $post->fetch_assoc())
                {
                    
                    ?>
                    <div class="samepost clear">
                        <h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
                        <h4><?php echo $fDate->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
                        <a href="#"><img src="admin/uploads/<?php echo $result['image']; ?>" alt="post image"/></a>
                        <?php echo $fDate->textShorten($result['body']); ?>
                        <div class="readmore clear">
                            <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
                        </div>
                    </div>
                <?php } ?> <!--End While Loop-->
                
            <?php } else { ?>
                <p>Your Search Query Is Not Found!!!</p>
           <?php }?>
    </div>
    
    <?php include 'inc/sidebar.php'; ?>
    
    <?php include 'inc/footer.php'; ?>
