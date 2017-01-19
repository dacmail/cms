<?php
$color = $web->getConfig('themes.default.color');
?>
<style>
    .widgets .widget .widget-bottom {
        background: <?php echo $color; ?>;
    }
    .widgets .widget > h4 {
        background: <?php echo $color; ?>;
    }

    .animal-card .animal-share i:hover {
        color: <?php echo $color; ?>;
    }

    .posts .post .post-share i:hover {
        color: <?php echo $color; ?>;
    }

    .pagination > .active > span {
        background-color: <?php echo $color; ?>;
        border-color: <?php echo $color; ?>;
    }

    .pagination > .active > span:hover {
        background-color: darken(<?php echo $color; ?>;, 5)
        border-color: darken(<?php echo $color; ?>;, 5)
    }
 
    .back-to-top {
        position: fixed;
        bottom: 10px;
        right: 10px;
        color: #333;
        display: none;
        font-size: 2em;
    }
</style>
