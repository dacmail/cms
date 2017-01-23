<?php
$color = $web->getConfig('themes.default.color');
?>
<style>
    <?php
    if ($web->hasConfig('themes.default.background_type')) {
        switch ($web->getConfig('themes.default.background_type')) {
            case 'background_color':
                echo 'body { background: ' . $web->getConfig('themes.default.background_color') . '; }';
                break;

            case 'background_content_color':
                echo 'body { background: ' . $web->getConfig('themes.default.background_color') . '; }';
                echo '#wrapper { background: ' . $web->getConfig('themes.default.background_content_color') . '; }';
                break;

            case 'background_image':
                echo 'body { background: url(/assets/images/backgrounds/' . $web->getConfig('themes.default.background_image') . ') repeat; }';
                break;

            case 'background_image_content':
                echo 'body { background: url(/assets/images/backgrounds/' . $web->getConfig('themes.default.background_image') . ') repeat; }';
                echo '#wrapper { background: ' . $web->getConfig('themes.default.background_content_color') . '; }';
                break;

            default:
                break;
        }
    }
    ?>

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
