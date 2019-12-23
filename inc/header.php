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
    <?php include "scripts/meta.php"; ?>
    <?php include "scripts/css.php"; ?>
    <?php include "scripts/js.php"; ?>
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
