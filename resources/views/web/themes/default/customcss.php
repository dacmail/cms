<?php if (!$web->getConfig('themes.default.border_radius')) { ?>
/*
    BORDER RADIUS
*/
.header,
.header img,
.widgets .widget h4,
.widgets .widget .widget-bottom,
.widgets .widget ul li:last-child,
.posts .post,
.animals > h3,
.animals .animal .animal-block,
.animal-card,
.animal-contact,
.animals .animal .animal-block img,
.widgets .widget {
    border-radius: 0px;
}
<?php } ?>

<?php
$color = $web->getConfig('themes.default.color');
?>
/*
    CUSTOM COLORS
*/
.widgets .widget .widget-bottom,
.widgets .widget > h4,
.pagination > .active > span {
    background-color: <?php echo $color; ?>;
}
.animal-card .animal-share i:hover,
.posts .post .post-share i:hover {
    color: <?php echo $color; ?>;
}
.pagination > .active > span {
    border-color: <?php echo $color; ?>;
}
.pagination > .active > span:hover {
    background-color: darken(<?php echo $color; ?>;, 5)
    border-color: darken(<?php echo $color; ?>;, 5)
}

/*
    CUSTOM BACKGROUND
*/

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
