<?php
/*
Template Name: 固定ページ／麹町法人会について
*/
?>
<?php get_header(); ?>

<!--pageName-->
<div class="about">
<div id="photo-contest">

<h2>麹町法人会について</h2>

<p class="subTtl sp"><?php the_title(); ?></p>

<!--leftCol-->
<div id="leftCol">

<?php get_template_part('sidenav'); ?>

</div>
<!--/leftCol-->

<!--rightCol-->
<div id="rightCol">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php
remove_filter('the_content', 'wpautop');
the_content();
add_filter('the_content', 'wpautop');
?>

<?php endwhile; ?>
<?php else : ?>
<?php endif; ?>

<?php wp_reset_query(); ?>

</div>
<!--/rightCol-->

</div>
</div>
<!--/pageName-->


<?php get_footer(); ?>