<?php
/**
 * @author Leniy
 */
/*
Template Name: 评论统计图表
*/
?>

<?php get_header(); ?>

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
<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
          
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<h2>活跃用户排名</h2><div id="chart_user_div" style="width: 640px; height: 400px; margin: auto;"></div>
<h2>评论数量图表</h2><div id="chart_day_div" style="width: 640px; height: 500px; margin: auto;"></div>
<h2>评论数量图表</h2><div id="chart_month_div" style="width: 640px; height: 500px; margin: auto;"></div>
    <?php
    global $wpdb;
    $numbers_day   = 30;
    $numbers_month = 9;
    $numbers_user  = 12;
    $query_day  ="SELECT COUNT(*) AS `cnt` , DATE_FORMAT( `comment_date` , '%Y-%m-%d' ) AS d FROM $wpdb->comments GROUP BY d ORDER BY `d` DESC LIMIT 0 , " . $numbers_day;
    $query_month="SELECT COUNT(*) AS `cnt` , DATE_FORMAT( `comment_date` , '%Y-%m' )    AS d FROM $wpdb->comments GROUP BY d ORDER BY `d` DESC LIMIT 0 , " . $numbers_month;
    $query_user ="
        SELECT
            COUNT( comment_author_email ) AS number,
            comment_author_email,
            comment_author
        FROM (
            SELECT *
            FROM $wpdb->comments
            LEFT OUTER JOIN $wpdb->posts
            ON ( $wpdb->posts.ID = $wpdb->comments.comment_post_ID )
            WHERE
                    comment_date > date_sub( NOW(), INTERVAL 180 DAY )
                AND user_id = '0'
                AND comment_approved =  '1'
            ORDER BY comment_ID DESC
        ) AS tempcmt
        GROUP BY comment_author_email
        ORDER BY number DESC
        LIMIT {$numbers_user}";
    $output_day   = $wpdb->get_results($query_day);
    $output_month = $wpdb->get_results($query_month);
    $output_user  = $wpdb->get_results($query_user);
?>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart_day);
    google.setOnLoadCallback(drawChart_month);
    google.setOnLoadCallback(drawChart_user);
    function drawChart_day() {
        var data = google.visualization.arrayToDataTable([
        ['date', 'comments'],
        <?php foreach (array_reverse($output_day) as $o) {echo "['" . $o->d . "'," . $o->cnt . "],";} ?>
        ]);
        var options = {
            title: '每日评论数图'
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart_day_div'));
        chart.draw(data, options);
    }
    function drawChart_month() {
        var data = google.visualization.arrayToDataTable([
        ['date', 'comments'],
        <?php foreach (array_reverse($output_month) as $o) {echo "['" . $o->d . "'," . $o->cnt . "],";} ?>
        ]);
        var options = {
            title: '每月评论数图'
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_month_div'));
        chart.draw(data, options);
    }
    function drawChart_user() {
        var data = google.visualization.arrayToDataTable([
        ['comment_author', 'comments'],
        <?php foreach ($output_user as $o) {echo "['" . $o->comment_author . "'," . $o->number . "],";} ?>
        ]);
        var options = {
            title: '半年内最活跃用户图'
        };
        var chart = new google.visualization.PieChart(document.getElementById('chart_user_div'));
        chart.draw(data, options);
    }
</script>
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
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/archive-page.js"></script>