<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<?php
	global $inove_nosidebar;
	$options = get_option('inove_options');
	if (is_home()) {
		$home_menu = 'current_page_item';
	} else {
		$home_menu = 'page_item';
	}
	if($options['feed'] && $options['feed_url']) {
		if (substr(strtoupper($options['feed_url']), 0, 7) == 'HTTP://') {
			$feed = $options['feed_url'];
		} else {
			$feed = 'http://' . $options['feed_url'];
		}
	} else {
		$feed = get_bloginfo('rss2_url');
	}
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
  <meta http-equiv="X-UA-Compatible" content="IE=11; IE=10; IE=9; IE=8; IE=7; IE=EDGE"/>
  <meta name="msvalidate.01" content="5DF42E2A00CDDD938D64797374866975" />

   <?php
if (is_home() || is_page()) {
    $description = "比特之理|とある東雲研究所の分所";
    $keywords = "算法, WordPress, 博客, 编程,php,编程,C++,Matlab,Mathematica,Python,动画,漫画,Euler Project,CSS,Bangumi,日剧,日影";
}
elseif (is_single()) {
    $description1 = get_post_meta($post->ID, "description_value", true);
    $description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));

    
    $description = $description1 ? $description1 : $description2;
   
    $keywords = get_post_meta($post->ID, "keywords_value", true);
    if($keywords == '') {
        $tags = wp_get_post_tags($post->ID);    
        foreach ($tags as $tag ) {        
            $keywords = $keywords . $tag->name . ", ";    
        }
        $keywords = rtrim($keywords, ', ');
    }
}
elseif (is_category()) {
    $description = category_description();
    $keywords = single_cat_title('', false);
}
elseif (is_tag()){
    $description = tag_description();
    $keywords = single_tag_title('', false);
}
$description = trim(strip_tags($description));
$keywords = trim(strip_tags($keywords));
?>
<meta name="description" content="<?php echo $description; ?>" />
<meta name="keywords" content="<?php echo $keywords; ?>" />
  
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/prettify/prettify-mma.css" type="text/css" media="screen, projection" />

  
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<!--ttp-equiv="X-UA-Compatible" content="IE=EmulateIE7" />-->
  <meta name="baidu-site-verification" content="63hJHaeIyF" />

	<title><?php bloginfo('name'); ?><?php wp_title(); ?>|<?php bloginfo('description'); ?></title>
	<link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all posts', 'inove'); ?>" href="<?php echo $feed; ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php _e('RSS 2.0 - all comments', 'inove'); ?>" href="<?php bloginfo('comments_rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <link rel="author" href="https://plus.google.com/u/0/101982058526999178226/posts"/>

  
	<!-- style START -->
	<!-- default style -->
	<style type="text/css" media="screen">@import url( <?php bloginfo('stylesheet_url'); ?> );</style>
	<!-- for translations -->
	<?php if (strtoupper(get_locale()) == 'ZH_CN' || strtoupper(get_locale()) == 'ZH_TW') : ?>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/chinese.css" type="text/css" media="screen" />
	<?php elseif (strtoupper(get_locale()) == 'HE_IL' || strtoupper(get_locale()) == 'FA_IR' || strtoupper(get_locale()) == 'UG_CN' || strtoupper(get_locale()) == 'CKB') : ?>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/rtl.css" type="text/css" media="screen" />
	<?php endif; ?>
	<!--[if IE]>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/ie.css" type="text/css" media="screen" />
	<![endif]-->
	<!-- style END -->

	<!-- script START -->
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/base.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/menu.js"></script>
	<!-- script END -->

	<?php wp_head(); ?>
 
</head>

<?php flush(); ?>

<body onload="prettyPrint()">
<!-- wrap START -->
<div id="wrap">

<!-- container START -->
<div id="container" <?php if($options['nosidebar'] || $inove_nosidebar){echo 'class="one-column"';} ?> >

<?php include('templates/header.php'); ?>

<!-- content START -->
<div id="content">

	<!-- main START -->
	<div id="main">
