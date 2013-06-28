<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>
	
		<?php while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">
				
	
				<div class="postTitle"><div><h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a><div class="postCMT"><?php comments_popup_link(__('0'),__('1'),__('%')); ?></div></h2> 	<small>| <?php the_time('l, F jS, Y') ?> by <?php the_author() ?> Posted in <?php the_category(' ') ?> </small></div></div>


				<div class="entry">
					<?php the_content('下面还有'); ?>
				</div>

				<p id="article-tag"><?php the_category(' ') ?>  <?php edit_post_link('Edit'); ?>  <?php comments_popup_link('还没人回复', '1 条回复', '% 条回复'); ?></p>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignright"><?php next_posts_link('较旧的文章 &gt;&gt;') ?></div>
			<div class="alignleft"><?php previous_posts_link('&lt;&lt; 较新的文章') ?></div>
		</div>
	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	</div>
<!--script style="text/javascript">
document.onkeydown = chang_page;
function chang_page(e) {
    var e = e || event,
    keycode = e.which || e.keyCode;

    if (keycode == 74)
        location = "<?php echo get_previous_posts_page_link(); ?>";
    if (keycode == 75)
        location = "<?php echo get_next_posts_page_link(); ?>";
}
</script-->
<?php get_sidebar(); ?>

<?php get_footer(); ?>