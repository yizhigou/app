<div id="footer">
<!-- If you'd like to support WordPress, having the "powered by" link somewhere on your blog is the best way, it's our only promotion or advertising. -->
		<?php bloginfo('name'); ?> | ©2011-2013 | 订阅: <a href="<?php bloginfo('rss2_url'); ?>">文章</a> &amp; <a href="<?php bloginfo('comments_rss2_url'); ?>">评论</a>.
		<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->
</div>
</div>

		<?php wp_footer(); ?>


<!-- 将此呈现调用放在适当的位置 -->
<script type="text/javascript">
  window.___gcfg = {lang: 'zh-CN'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<script type='text/javascript'>
    jQuery(document).ready(function($){
        $.fn.scrollToTop = function() {
            $(this).hide().removeAttr("href");
            if ($(window).scrollTop() != "0") {
                $(this).fadeIn("slow");
            };
            var scrollDiv = $(this);
            $(window).scroll(function() {
                if ($(window).scrollTop() == "0") {
                    $(scrollDiv).fadeOut("slow");
                } else {
                    $(scrollDiv).fadeIn("slow");
                }
            });
            $(this).click(function() {
                $("html, body").animate({scrollTop: 0}, "slow");
            });
        };
        $("#w2b-StoTop").scrollToTop();
    });
</script>
<!--
<a href='#' id='w2b-StoTop' style='display:none;'> ↑↑UPUP↑↑ </a>	
-->
<script type='text/javascript'>
jQuery(function($){
    $.fn.scrollToTop = function() {
        $(this).click(function(e) {
            e.target.tagName != "INPUT" && $("html, body").animate({scrollTop: 0}, "1000");
        });
    };
    $("#top_bar").scrollToTop();
});
</script>

<script type="text/javascript">
function bgChanger() {
	var hour = new Date().getHours();
	if (11 <= hour && hour < 18) {
		pic = "http://ww4.sinaimg.cn/large/807e45adjw1e5scfci4sqj21ao0t648o.jpg";
	} else if (5 <= hour && hour < 11) {
		pic = "http://ww1.sinaimg.cn/large/807e45adjw1e5scf7l9twj21ao0t6n4l.jpg";
	} else {
		pic = "http://ww2.sinaimg.cn/large/807e45adjw1e5scf0mqbpj21ao0t6dnr.jpg";
	}
	var img = new Image();
	img.onload = function () {
		document.body.style.backgroundImage = "url(" + pic + ")";
	};
	img.src = pic;
};
bgChanger();
setInterval(bgChanger, 10000);
</script>


</body>
</html>