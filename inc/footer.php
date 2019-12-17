<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/11/2019
     * Time: 11:33 AM
     */
    ?>

</div>

<div class="footersection templete clear">
    <div class="footermenu clear">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="privacy.php">Privacy</a></li>
        </ul>
    </div>
    <?php
    $query = "select * from tbl_copyright where id='1'";
    $copyRight = $db->select($query);
    $result = $copyRight->fetch_assoc();
    //var_dump($result);die;
    ?>
    <p><?= $result['copy_right']; ?></p>
</div>
<div class="fixedicon clear">
    <a href="http://www.facebook.com"><img src="images/fb.png" alt="Facebook"/></a>
    <a href="http://www.twitter.com"><img src="images/tw.png" alt="Twitter"/></a>
    <a href="http://www.linkedin.com"><img src="images/in.png" alt="LinkedIn"/></a>
    <a href="http://www.google.com"><img src="images/gl.png" alt="GooglePlus"/></a>
</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>
