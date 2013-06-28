<!DOCTYPE html>
<html xmlns:wb="http://open.weibo.com/wb">
<head>
<meta charset="utf-8">
<meta name="msapplication-TileColor"
    content="#566FAD" />
<meta name="msapplication-TileImage"
    content="logo.png" />
<?php $the_title = wp_title(' - ', false); if ($the_title != '') : ?>
    <title><?php echo wp_title('',false); ?></title>
<?php else : ?>
    <title><?php bloginfo('name'); ?><?php if ( $paged > 1 ) echo ( ' - page '.$paged ); ?></title>
<?php endif; ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="shortcut icon" href="http://app.wepost.me/favicon.ico" />
<link rel="apple-touch-icon-precomposed" href="logo.png" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="author" href="https://plus.google.com/u/0/107610745577083471112?rel=author" />
<link href='http://fonts.googleapis.com/css?family=Jura:600' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="http://192.168.1.168/jquery.lazyload.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($){$("img").lazyload({placeholder:"http://wepost.me/img/grey.gif",effect: "fadeIn"});});</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9144829" charset="UTF-8"></script>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=3496849073" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-25652577-6']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script');
ga.type = 'text/javascript';
ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);  })();
</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//wepost.me/js/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</head>
<body>
<div id="header">
	<div class="header-inner" id="top_bar" style="z-index: 999;">
	<div class="menu-home-container"><span id="search-4" class="widget widget_search" style="
    position: absolute;
    right: 0px;
    top: 3px;
"><form method="get" id="searchformtop" action="http://192.168.1.168/">
<div style="
"><table border="0" width="100%">
<tbody><tr><td style="
    border-radius: 3px;
"><input type="text" value="" name="s" id="s" class="searchtex" x-webkit-speech=""></td>
<td width="54px"><input type="submit" id="searchsubmit" value=""></td>
</tr></tbody></table></div>
</form></span>
	<?php wp_nav_menu( array('container' => 'false', 'theme_location' => 'primary' ) ); ?>
	<a href="http://192.168.1.168"><h1 id="logo">应用铺子</h1></a>
	</div>
	</div>
</div>
<div id="page">