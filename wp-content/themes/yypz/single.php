<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="navigation">
			<div class="alignright single"><?php previous_post_link('%link') ?></div>
			<div class="alignleft single"><?php next_post_link('%link') ?></div>
		</div><div id="clearnavigation">&nbsp;</div>

		<div class="post" id="post-<?php the_ID(); ?>">
				<div class="postTitle"><div><h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a><div class="postCMT"><?php comments_popup_link(__('0'),__('1'),__('%')); ?></div></h2> 	<small>| <?php the_time('l, F jS, Y') ?> by <?php the_author() ?> Posted in <?php the_category(', ') ?> </small> <small>| <wb:share-button appkey="3496849073" ></wb:share-button><g:plusone size="small"></g:plusone></small></div></div>

			<div class="entry">
			
				<?php the_content('下面还有'); ?>
			
			<p id="article-tag">
			<?php the_tags('', '', ''); ?>
			</p>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	
					<div id="wumiiDisplayDiv"></div>			

				<!--p class="postmetadata alt">
					<small>
						Posted
						<?php /* This is commented, because it requires a little adjusting sometimes.
							You'll need to download this plugin, and follow the instructions:
							http://binarybonsai.com/archives/2004/08/17/time-since-plugin/ */
							/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>
						on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?> in <?php the_category(', ') ?> | 
						<?php comments_rss_link('rss feed for comments'); ?>
| 
						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							<a href="#respond">Leave a response</a>, or <a href="<?php trackback_url(true); ?>" rel="trackback">trackback</a> 

						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open ?>
							Responses are currently closed, but you can <a href="<?php trackback_url(true); ?> " rel="trackback">trackback</a> from your own site.

						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>
							You can skip to the end and leave a response. Pinging is currently not allowed.

						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.

						<?php } edit_post_link('Edit this entry.','',''); ?>

					</small>
                                  </p-->
<div id="article-author">
<div id="author-image">
<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_email(), '80' ); }?>
</div>
<div id="author-text">
 <strong>我是 <?php the_author_link(); ?></strong>
 <p><?php the_author_description();?></p>
</div>
</div>

			</div>
		</div>


	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

	</div>
<!--script style="text/javascript">
document.onkeydown = chang_page;
function chang_page(e) {
    var e = e || event,
    keycode = e.which || e.keyCode;

    if (keycode == 74)
        location = "<?php echo get_permalink(get_adjacent_post(false,'',false)); ?>";
    if (keycode == 75)
        location = "<?php echo get_permalink(get_adjacent_post(false,'',true)); ?>";
}
</script-->
<!--?php get_sidebar(); ?-->
<?php get_footer(); ?>