<?php
$tags = get_the_tags();
?>
<?php if($tags) { ?>

        <?php the_tags('', '&nbsp;', ''); ?>

<?php } ?>