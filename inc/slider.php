<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 12/11/2019
     * Time: 11:32 AM
     */
    ?>
<div class="slidersection templete clear">
    <div id="slider">
        <?php
        $query = "select * from tbl_slider";
        $slider = $db->select($query);
        if($slider){
            while ($result = $slider->fetch_assoc())
            {
        ?>
        <a href="#"><img src="admin/<?= $result['image']; ?>" alt="nature 1" title="<?= $result['title']; ?>" /></a>
        <?php } } ?>
    </div>

</div>
