<?php
/**
 * @package ajax comment vote
 * @author cosbeta
 * @version 1.71
 */
/*
Plugin Name: ajax-comment-vote
Plugin URI: http://www.storyday.com/html/y2009/2424_ajax-comment-vote.html
Description: vote for or again a comment. 
Version: 1.7
Author URI: http://www.huichuan365.com/
*/
/*
changelog
2010-04-03:������������</p>��ǩ�޷��رյ�����
2010-07-13:������wp3.0֧�ֵ����⣬������һ������ajax_recent_hot_comment_list
2011-03-02:������wp3.1��̨��ʾ�����Ű�����
2011-11-24:������δ��¼�û��޷����۵�����


*/

define('GOOGLE_JQ','http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js');

$sm_locale = get_locale();
$sm_mofile = dirname(__FILE__) . "/acv-$sm_locale.mo";
load_textdomain('acv', $sm_mofile);

if( !function_exists('print_comment_vote') ){
	function print_comment_vote( $post_content ){
	
	
	global $comment;
	$comment_ID = $comment->comment_ID;
	$cookie_index = "voted_comments_".$comment_ID ;
	if( $_COOKIE[$cookie_index] > 0) $pos =1 ;
	else $neg=1;
	$vote = '<div class="vote" id="vote-'.  $comment_ID.'"><span id="acv_stat_'.  $comment_ID.'"></span><a class="acvclick acv4" id="vote4-'.  $comment_ID.'" href="javascript:acv_vote('. $comment_ID.',1);">'.  __('vote','acv').'</a>(<span id="cos_support-'.  $comment_ID.'">'. $comment->vote_positive.'</span>)<a  class="acvclick acva"  id="votea-'.  $comment_ID.'"  href="javascript:acv_vote('. $comment_ID.',0);">'. __('against','acv').'</a>	(<span id="cos_unsupport-'.  $comment_ID.'">'. $comment->vote_negative.'</span>)</div>';
	$vote = "\n".$vote;
	return $post_content.$vote;
}
}

if ( !function_exists("ajax_comment_vote_print_js") ){
	function ajax_comment_vote_print_js(){
		global $googlejquery ;
		?>
<?php if( strlen(GOOGLE_JQ) > 16 ):?>
<script language="JavaScript" type="text/javascript" src="<?php echo GOOGLE_JQ;?>"></script>
<?php endif;?>

<link rel="stylesheet" href="<?php echo get_option('home');?>/wp-content/plugins/ajax-comment-vote/style.css" type="text/css" media="screen" />
<script language="JavaScript" type="text/javascript">
//<![CDATA[
var va = "<?php echo _e("You've voted","acv");?>";
function acv_vote(id,option, m){
	if( m==null) m ='';	m = m + '';
	$('#acv_stat_'+m+id).html('<?php _e('Loading...','acv');?>');
	var url="<?php echo get_option('home');?>/index.php?acv_ajax=true&option="+option+"&ID="+id;
	$.get(url,function(d){
		d =d.split('|');var s='#acv_stat_'+m+d[0];
		var sele = '#cos_support-'+m+id,unsele = '#cos_unsupport-'+m+id,tpjs = 'javascript:alert(va)';
		$( s ).html( d[1] );$(s).fadeOut(400,function(){$(s).fadeIn();});
		if( d[2] == 1 ){ $(sele).html($(sele).html()*1+1); }
		if( d[2] == -1 ){ $(unsele).html($(unsele).html()*1+1); } 
		$('#vote4-'+id).attr('href',tpjs);$('#vote4-2'+id).attr('href',tpjs);
		$('#votea-'+id).attr('href',tpjs);$('#votea-2'+id).attr('href',tpjs);
	});
}

//]]>
</script>
	<?php
		}
	
}

//send ajax comment vote
if ( !function_exists("ajax_comment_send") ){
	function ajax_comment_send(){
	
		if( $_GET['acv_ajax'] ){
			$ip = $_SERVER['REMOTE_ADDR'];
		
			global $wpdb;
			
			$tablecomments 	= $wpdb->comments;
			
			$tableposts		= $wpdb->posts	;
			
			$comment_ID = $_GET['ID'] * 1;
		
			if($_GET['option'] > 0){				
				//positive vote
					$cookie_var = 1;
					$sql = "UPDATE $tablecomments set vote_positive=vote_positive+1 ,vote_ip_pool=CONCAT(vote_ip_pool,',','$ip') 

							WHERE comment_ID = ".$comment_ID." AND LOCATE('".$ip ."',vote_ip_pool)=0 ";
				}else{
				//negative vote				
					
					$sql = "UPDATE $tablecomments set vote_negative=vote_negative+1 ,vote_ip_pool=CONCAT(vote_ip_pool,',','$ip') 
							WHERE comment_ID = ".$comment_ID." AND LOCATE('".$ip ."',vote_ip_pool)=0 ";

					$cookie_var = -1;					
				}
				
			$cookie_index = "voted_comments_".$comment_ID ;
			$curvoted_index = "voted";
			
			
			if( $_COOKIE[$cookie_index] == '' ){
			
			
			//no cookie do vote$
				
			$comments = $wpdb->get_results($sql);// execute insert
			// trunck the ip pool colum
			$sql = "UPDATE $tablecomments set vote_ip_pool='' WHERE comment_ID = ".$comment_ID." AND LENGTH(vote_ip_pool) > 2000";
			$comments = $wpdb->get_results($sql);// truncate overload data
			
			
			if( function_exists('htmlCacheDelNb') ){
				// delete html cache
					$sql = "select comment_post_ID FROM  $tablecomments  WHERE comment_ID = ".($_GET['ID'] * 1);				
					$post_ID = $wpdb->get_results($sql );					
					htmlCacheDelNb( $post_ID[0]->comment_post_ID );
				}
				
				setcookie($cookie_index, $cookie_var,  time()+360000,"/");
				$_COOKIE[$cookie_index] = $cookie_var;
				
				// save the voted hash for client
				
				$voted_hash = $_COOKIE["voted"]."|".$comment_ID.":".$cookie_var;
				setcookie('voted', $voted_hash,  time()+360000,"/");
				$_COOKIE['voted'] = $voted_hash;
				
				
				$vote_id_string = $_COOKIE["vote_id_string"]."|".$comment_ID.",".$cookie_var;
				setcookie('vote_id_string', $vote_id_string,  time()+360000,"/");
				$_COOKIE['vote_id_string'] = $vote_id_string;
				
				echo ($comment_ID."|");
				_e("Thank you","acv");
				echo ("|".$cookie_var);
				//set voted comment id string 
				
				die( );
			}
			else {
			//voted do nothing
				echo ($comment_ID."|");
				_e("You've voted","acv");
				echo ("|0");
				die();
			}
			
		die();		
		}
			
			
	
		
	}
	
}
//��ȡ���������ۣ�ͶƱ����������
if ( !function_exists("ajax_hot_comment_list") ){
	function ajax_hot_comment_list( $title="Hot comments ",$num=10 ){
	
	if( !is_single() ) return  false;
	
	$class="hotcomment" ;
	global $wpdb, $post;
	
	$tablecomments 	= $wpdb->comments;
			
	$tableposts		= $wpdb->posts	;
	
	echo '<div class="'.$class.'"><div class="in">';
	
	echo '<div class="bar">'.$title .'</div>';
	
	$request = "SELECT * FROM   $tablecomments WHERE comment_post_ID=$post->ID AND comment_approved=1 AND vote_positive>0 ORDER BY (vote_positive-vote_negative) DESC,vote_positive DESC LIMIT 0,$num ";
 
    $comments = $wpdb->get_results($request);
    $output = '';
	$i = 0;
    foreach ($comments as $comment) {
			$i ++;
			$comment_ID		= $comment->comment_ID; 
			
			if(   strlen( $comment->comment_author_url ) > 5 ){
			
				$author_url  ='<a href="'.$comment->comment_author_url.'" rel="externel nofollow">'.stripslashes($comment->comment_author).'</a>';
			}
			else{
				$author_url = stripslashes($comment->comment_author);
			}
		  ?>
		  
		  <div class="acv_author"><?php echo $author_url ?>  <?php echo _e("posted at","acv");?> <?php echo $comment->comment_date;?> <a href="#comment-<?php echo $comment_ID;?>">#</a></div>
		  <div class="acv_comment">
			
			<?php echo stripslashes($comment->comment_content);?>
		  
		  </div>
		  
		  <div class="vote votehot" id="vote-2<?php echo  $comment_ID;?>">
		  <span id="acv_stat_2<?php echo  $comment_ID;?>"></span>
	<a class="acvclick acv4" id="vote4-2<?php echo  $comment_ID;?>" href="javascript:acv_vote(<?php echo $comment_ID?>,1,2);"><?php  _e('vote','acv');?></a>
	(<span id="cos_support-2<?php echo  $comment_ID;?>"><?php echo $comment->vote_positive;?></span>)
	<a  class="acvclick acva"  id="votea-2<?php echo  $comment_ID;?>"  href="javascript:acv_vote(<?php echo $comment_ID?>,0,2);"><?php  _e('against','acv');?></a>
	(<span id="cos_unsupport-2<?php echo  $comment_ID;?>"><?php echo $comment->vote_negative;?></span>)
	
	</div>
		  
		  <?php
		   
	}
	if( $i == 0 ) _e("No Hot Comment","acv");
	
	echo '</div></div>'; 
		
	} 
		
}














//��ȡ����һ��ʱ���ڣ�ͶƱ����������
if ( !function_exists("ajax_recent_hot_comment_list") ){
	function ajax_recent_hot_comment_list( $days=10,$limit=20 ){
	
	$start_date = date("Y-m-d H:i:s");
	
	$end_date = date( "Y-m-d H:i:s", strtotime( "$start_date -$days days" ) );
	
	$class="hotcomment" ;
	global $wpdb, $post;
	
	$tablecomments 	= $wpdb->comments;
			
	$tableposts		= $wpdb->posts	;
	
	echo '<div class="'.$class.'"><div class="in">';
	
	echo '<div class="bar">'.$title .'</div>';
	
	$request = "SELECT * FROM   $tablecomments WHERE  comment_approved=1 AND comment_date>'".$end_date."' AND vote_positive>0  ORDER BY (vote_positive-vote_negative) DESC,vote_positive DESC LIMIT 0,$limit";
 
    $comments = $wpdb->get_results($request);
    $output = '';
	$i = 0;
    foreach ($comments as $comment) {
			$i ++;
			$comment_ID		= $comment->comment_ID; 
			
			if(   strlen( $comment->comment_author_url ) > 5 ){
			
				$author_url  ='<a href="'.$comment->comment_author_url.'" rel="externel nofollow">'.stripslashes($comment->comment_author).'</a>';
			}
			else{
				$author_url = stripslashes($comment->comment_author);
			}
		  ?>
		 
		  <div class="acv_author"><?php echo $author_url ?>  <?php echo _e("posted at","acv");?> <?php echo $comment->comment_date;?> <a href="<?php echo get_permalink( $comment->comment_post_ID );?>#comment-<?php echo $comment_ID;?>">#</a></div>
		  <div class="acv_comment">
			
			<?php echo stripslashes($comment->comment_content);?>
		  
		  </div>
		  
		  <div class="vote votehot" id="vote-2<?php echo  $comment_ID;?>">
		  <span id="acv_stat_2<?php echo  $comment_ID;?>"></span>
	<a class="acvclick acv4" id="vote4-2<?php echo  $comment_ID;?>" href="javascript:acv_vote(<?php echo $comment_ID?>,1,2);"><?php  _e('vote','acv');?></a>
	(<span id="cos_support-2<?php echo  $comment_ID;?>"><?php echo $comment->vote_positive;?></span>)
	<a  class="acvclick acva"  id="votea-2<?php echo  $comment_ID;?>"  href="javascript:acv_vote(<?php echo $comment_ID?>,0,2);"><?php  _e('against','acv');?></a>
	(<span id="cos_unsupport-2<?php echo  $comment_ID;?>"><?php echo $comment->vote_negative;?></span>)
	
	</div>
		  
		  <?php
		   
	}
	if( $i == 0 ) _e("No Hot Comment","acv");
	
	echo '</div></div>';
	
		
		
	}
		
			
	
		
}


function cos_ajax_comment_plug_active(){
		global $wpdb;
		
		$tablecomments 	= $wpdb->comments;
		$tableposts		= $wpdb->posts	;
		$sql = "ALTER TABLE $tablecomments  ADD `vote_positive` DOUBLE NOT NULL ;"	;
		$comments = $wpdb->get_results($sql);
		$sql = "ALTER TABLE $tablecomments  ADD `vote_negative` DOUBLE NOT NULL ;"	;
		$comments = $wpdb->get_results($sql);
		$sql = "ALTER TABLE $tablecomments  ADD `vote_ip_pool` TEXT NOT NULL ;"	;
		$comments = $wpdb->get_results($sql);
		
}	

 


register_activation_hook( __FILE__, 'cos_ajax_comment_plug_active' );
add_action('init','ajax_comment_send');
if( substr_count($_SERVER['REQUEST_URI'],'/wp-admin') <1 ){  
add_action('wp_print_scripts', 'ajax_comment_vote_print_js');
add_filter('get_comment_text', 'print_comment_vote');
}

 
?>
