<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/22/2019
     * Time: 8:37 PM
     */
    ?>
<?php
    if(isset($_GET['pageId']))
    {
        $pageTitle = $_GET['pageId'];
        $query = "select * from tbl_page where id='$pageTitle'";
        $page = $db->select($query);
        if($page) {
            while ($result = $page->fetch_assoc()) {
                ?>
                <title><?= $result['title']; ?>-<?= TITLE; ?></title>
            <?php } } }elseif(isset($_GET['id'])){
        $postId  = $_GET['id'];
        $query = "select * from tbl_post where id='$postId'";
        $post = $db->select($query);
        if($post) {
            while ($results = $post->fetch_assoc()) {
                ?>
                <title><?= $results['title']; ?>-<?= TITLE; ?></title>
            <?php } } }else{ ?>
        <title><?= $fDate->title(); ?>-<?= TITLE; ?></title>
<?php } ?>
<meta name="language" content="English">
<meta name="description" content="It is a website about education">
<?php
    if (isset($_GET['id']))
    {
        $keyword = $_GET['id'];
        $query = "select * from tbl_post where id='$keyword'";
        $keywords = $db->select($query);
        if ($keywords)
        {
            while ($result = $keywords->fetch_assoc())
            {
                
                ?>
                <meta name="keywords" content="<?= $result['tags']; ?>">
            <?php } } }else{ ?>
        <meta name="keywords" content="<?= KEYWORDS; ?>">
    <?php } ?>
<meta name="author" content="Aminur">
