<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<div><table border="0" width="100%">
<td><input type="text" value="<?php the_search_query(); ?>" name="s" id="s"  class="searchtex" autofocus x-webkit-speech></td>
<td width="54px"><input type="submit" id="searchsubmit" value=""></td>
</table></div>
</form>