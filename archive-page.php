<?php
/*
Template Name: mufeng-archive
*/
?>

<?php get_header(); ?>
<script>
  jQuery(document).ready(function($) {   
    var old_top = $("#archives").offset().top,   
        _year = parseInt($(".year:first").attr("id").replace("year-", ""));   
    $(".year:first, .year .month:first").addClass("selected");   
    $(".month.monthed").click(function() {   
        var _this = $(this),   
            _id = "#" + _this.attr("id").replace("mont", "arti");   
        if (!_this.hasClass("selected")) {   
            var _stop = $(_id).offset().top - 10,   
                _selected = $(".month.monthed.selected");   
            _selected.removeClass("selected");   
            _this.addClass("selected");   
            $("body, html").scrollTop(_stop)   
        }   
    });   
    $(".year-toogle").click(function(e) {   
        e.preventDefault();   
        var _this = $(this),   
            _thisp = _this.parent();   
        if (!_thisp.hasClass("selected")) {   
            var _selected = $(".year.selected"),   
                _month = _thisp.children("ul").children("li").eq(0);   
            _selected.removeClass("selected");   
            _thisp.addClass("selected");   
            _month.click()   
        }   
    });   
    $(window).scroll(function() {   
        var _this = $(this),   
            _top = _this.scrollTop();   
        if (_top >= old_top + 10) {   
            $(".archive-nav").css({   
                top: 10   
            })   
        } else {   
            $(".archive-nav").css({   
                top: old_top + 10 - _top   
            })   
        }   
        $(".archive-title").each(function() {   
            var _this = $(this),   
                _ooid = _this.attr("id"),   
                _newyear = parseInt(_ooid.replace(/arti-(\d*)-\d*/, "$1")),   
                _offtop = _this.offset().top - 40,   
                _oph = _offtop + _this.height();   
            if (_top >= _offtop && _top < _oph) {   
                if (_newyear != _year) {   
                    $("#year-" + _year).removeClass("selected");   
                    $("#year-" + _newyear).addClass("selected");   
                    _year = _newyear   
                }   
                var _id = _id = "#" + _ooid.replace("arti", "mont"),   
                    _selected = $(".month.monthed.selected");   
                _selected.removeClass("selected");   
                $(_id).addClass("selected")   
            }   
        })   
    })   
});
</script>
<style type="text/css">
  #archives:after {   
    clear: both;   
    display: block;   
    visibility: hidden;   
    height: 0!important;   
    content: " ";   
    font-size: 0!important;   
    line-height: 0!important  
} 
 
#archives {   
    zoom: 1  
} 
 
#archives-content {   
     width: 100%;  
} 
 
#archive-nav {   
    float: left;   
    width: 50px  
    
} 
 

.archive-nav {   
    display: block;   
    position: fixed;   
    background: #f9f9f9;   
    width: 40px;   
    padding: 5px;   
    border: 1px solid #eee;   
    text-align: center;
    margin-left: -78px;
     margin-top: 40px;
} 
 
/*.archive-nav ol {
padding: 0px !important;
}*/

.post .content ul, 
.post .content ol {
list-style: none;
  padding:0px  !important;
  width: 50px !important;
}

.year {   
    border-top: 1px solid #ddd  
} 
 
.month {   
    color: #ccc;   
    padding: 5px;   
    cursor: pointer;   
    background: #f9f9f9  
} 
 
.month.monthed {   
    color: #777  
} 


.month.noshow {   
    display:none !important;
} 
 


.month.selected,.month:hover {   
    background: #f2f2f2  
} 
 
.monthall {   
    display: none  
} 
 
.year.selected .monthall {   
    display: block  
} 
 
.year-toogle {   
    display: block;   
    padding: 5px;   
    text-decoration: none;   
    background: #eee;   
    color: #333;   
    font-weight: bold  
} 
 
.archive-title {   
    padding-bottom: 40px  
} 
 
.brick {   
    float: left;
display: inline;
width: 30%;;
height: 100px;
margin: 0 10px 10px 0;
color: #ccc;
font-size: 12px;
margin-bottom: 10px;
position: relative;
padding: 0;
  text-shadow: none;
box-shadow: 0 1px 4px rgba(0, 0, 0, 0.65);
border-radius: 5px;
  -moz-border-radius: 5px;
-webkit-border-radius: 5px;
} 
 

.archives{
overflow: hidden;
padding-top: 8px;
padding-left: 8px;
list-style: none;
}

.archives a {   
position: relative;
display: block;
padding: 10px;
color: #333;
font-style: normal;
line-height: 18px;
height: 78px;
} 
 
.time {   
    color: #888;
padding-right: 10px;
display: block;
} 
 
.archives a:hover {   
    background: #eee  ;
    text-decoration: none;
} 
 .arch-day {
position: absolute;
bottom: 0;
right: 5px;
font-size: 18px;
font-weight: bold;
color: #DDD;
font-style: italic;
text-shadow: 0 1px 0 white;
  }

#archives h3 {   
    padding-bottom: 10px  
} 
 
.brick em {   
    color: #aaa;   
    padding-left: 10px  
}  
</style>
<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

	<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
		<div class="info">
		<!--<span class="date"><?php the_modified_time(__('F jS, Y', 'inove')); ?></span>-->
			<?php edit_post_link(__('Edit', 'inove'), '<span class="editpost">', '</span>'); ?>
			<?php if ($comments || comments_open()) : ?>
				<span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'inove'); ?></a></span>
				<span class="comments"><a href="#comments"><?php _e('Go to comments', 'inove'); ?></a></span>
			<?php endif; ?>
			<div class="fixed"></div>
		</div>
		<div class="content">
			<!-- archive -->   
<div id="archives">      
    <div id="archives-content">      
    <?php       
        $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' );      
        $year=0; $mon=0; $i=0; $j=0;      
        $all = array();      
        $output = '';      
        while ( $the_query->have_posts() ) : $the_query->the_post();      
            $year_tmp = get_the_time('Y');      
            $mon_tmp = get_the_time('n');
            $comment_num =  get_comments_number('0', '1', '%');
            $y=$year; $m=$mon;      
            if ($mon != $mon_tmp && $mon > 0) $output .= '</div></div>';      
            if ($year != $year_tmp) { // 输出年份      
                $year = $year_tmp;      
                $all[$year] = array();      
            }      
            if ($mon != $mon_tmp) { // 输出月份      
                $mon = $mon_tmp;      
                array_push($all[$year], $mon);      
                $output .= "<div class='archive-title' id='arti-$year-$mon'><h3>$year-$mon</h3><div class='archives archives-$mon' data-date='$year-$mon'>";      
            }      
            if ($comment_num > 0)
                 $output .= '<div class="brick"><a href="'.get_permalink() .'"><span class="time">'.get_the_time('d').'</span>'.get_the_title() .'<span class="arch-day">'. get_comments_number('0', '1', '%') .'</span></a></div>';      
           else  $output .= '<div class="brick"><a href="'.get_permalink() .'"><span class="time">'.get_the_time('d').'</span>'.get_the_title() .'</a></div>';
        endwhile;      
        wp_reset_postdata();      
        $output .= '</div></div>';      
        echo $output;      
     
        $html = "";      
        $year_now = date("Y");      
        foreach($all as $key => $value){// 输出 左侧年份表      
            $html .= "<li class='year' id='year-$key'><a href='#' class='year-toogle' id='yeto-$key'>$key</a><ul class='monthall'>";      
            for($i=12; $i>0; $i--){      
                  if($key == $year_now && $i > $value[0]) continue;     
                $html .= in_array($i, $value) ? ("<li class='month monthed' id='mont-$key-$i'>$i</li>") : ("<li class='month noshow'>$i</li>");
            }      
            $html .= "</ul></li>";   
        }      
    ?>     
    </div>      
    <div id="archive-nav">      
        <ul class="archive-nav"><?php echo $html;?></ul>      
    </div>      
  </div>
<!-- archive end -->  
			<div class="fixed"></div>
		</div>
	</div>

	<?php include('templates/comments.php'); ?>

<?php else : ?>
	<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'inove'); ?>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
