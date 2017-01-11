<?php
$color = $web->getConfig('themes.default.color');

if ((bool) $web->getConfig('themes.default.border_radius') === true
    || is_null($web->getConfig('themes.default.border_radius'))) {
    $radius = true;
} else {
    $radius = false;
}
?>

<style>
    /**
     * Border
     */
    .header {
        border-radius: <?php echo (bool) $radius ? '0 0 10px 10px' : '0'; ?>
    }

    .header img {
        border-radius: <?php echo (bool) $radius ? '0 0 10px 10px' : '0'; ?>
    }

    .widgets .widget h4 {
        border-radius: <?php echo (bool) $radius ? '10px 10px 0 0' : '0'; ?>
    }

    .widgets .widget .widget-bottom {
        border-radius: <?php echo (bool) $radius ? '0 0 10px 10px' : '0'; ?>
    }

    .widgets .widget ul li:last-child {
        border-radius: <?php echo (bool) $radius ? '0 0 10px 10px' : '0'; ?>
    }

    .posts .post {
        border-radius: <?php echo (bool) $radius ? '10px' : '0'; ?>
    }

    .animals > h3 {
        border-radius: <?php echo (bool) $radius ? '10px' : '0'; ?>
    }

    .animals .animal .animal-block {
        border-radius: <?php echo (bool) $radius ? '10px' : '0'; ?>
    }

    .animal-card {
        border-radius: <?php echo (bool) $radius ? '10px' : '0'; ?>
    }

    .animal-contact {
        border-radius: <?php echo (bool) $radius ? '10px' : '0'; ?>
    }

    .animals .animal .animal-block img {
        border-radius: <?php echo (bool) $radius ? '10px 10px 0 0' : '0'; ?>
    }

    /**
     * Color
     */
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
</style>
