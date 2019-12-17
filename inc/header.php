<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/11/2019
     * Time: 11:31 AM
     */
     include 'config/config.php';

     include 'lib/Database.php';

     include 'helpers/Format.php';
     
     $db = new Database();
     $fDate = new Format();
    ?>
<!DOCTYPE html>
<html>
<head>
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
    <meta name="keywords" content="blog,cms blog">
    <meta name="author" content="Delowar">
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
    <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.nivo.slider.js" type="text/javascript"></script>
    
    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider({
                effect:'random',
                slices:10,
                animSpeed:500,
                pauseTime:5000,
                startSlide:0, //Set starting Slide (0 index)
                directionNav:false,
                directionNavHide:false, //Only show on hover
                controlNav:false, //1,2,3...
                controlNavThumbs:false, //Use thumbnails for Control Nav
                pauseOnHover:true, //Stop animation while hovering
                manualAdvance:false, //Force manual transitions
                captionOpacity:0.8, //Universal caption opacity
                beforeChange: function(){},
                afterChange: function(){},
                slideshowEnd: function(){} //Triggers after all slides have been shown
            });
        });
    </script>
</head>

<body>
<div class="headersection templete clear">
    <a href="index.php">
        <div class="logo">
            <?php
            $query = "select * from title_slogan where id='1'";
            $getData = $db->select($query);
            $result = $getData->fetch_assoc();
            //print_r($result);die;
            ?>
            <img src="admin/<?= $result['logo']; ?>" alt="Logo"/>
            <h2><?= $result['title'];?></h2>
            <p><?= $result['slogan'];?></p>
        </div>
    </a>
    <div class="social clear">
        <div class="icon clear">
            <?php
            $query = "select * from tbl_social where id='1'";
            $social = $db->select($query);
            $result = $social->fetch_assoc();
            //print_r($result);die;
            ?>
            <a href="<?= $result['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="<?= $result['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="<?= $result['ln']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
            <a href="<?= $result['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
        </div>
        <div class="searchbtn clear">
            <form action="search.php" method="get">
                <input type="text" name="search" placeholder="Search keyword..."/>
                <input type="submit" name="submit" value="Search"/>
            </form>
        </div>
    </div>
</div>
<div class="navsection templete">
    <?php
        $path = $_SERVER['SCRIPT_FILENAME'];
        $currentPage = basename($path,'.php');
    ?>
    <ul>
        <li>
            <a <?php if($currentPage == 'index'){ echo 'id="active"'; }?> href="index.php">Home</a>
        </li>
        <?php
        $query = "select * from tbl_page";
        $page = $db->select($query);
        if($page)
        {
            while ($result = $page->fetch_assoc())
            {
        ?>
        <li><a
            <?php
                if(isset($_GET['pageId']) && $_GET['pageId'] == $result['id'])
                {
                    echo 'id="active"';
                }
            ?>
            href="page.php?pageId=<?= $result['id']; ?>"><?= $result['title']; ?></a></li>
        <?php } }?>
        <li><a <?php if($currentPage == 'contact'){ echo 'id="active"'; }?> href="contact.php">Contact</a></li>
    </ul>
</div>
