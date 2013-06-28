<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">Search Results</h2>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Next Entries &raquo;') ?></div>
		</div>
<div id="clearnavigation"></div>

		<?php while (have_posts()) : the_post(); ?>


			
			
			<div class="post" id="post-<?php the_ID(); ?>">
				
				<div class="postTitle"><h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2> 	<small>| <?php the_time('F jS, Y') ?> by <?php the_author() ?> </small></div>
				<p id="article-tag">
						<?php the_tags('', '', ''); ?>
						</p>
				<span id="article-tag"><?php the_category(' ') ?> <?php edit_post_link('Edit'); ?>  <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span>
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Previous Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Next Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">No posts found. Try a different search?</h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

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