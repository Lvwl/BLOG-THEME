<?php

/** inove options */
class iNoveOptions {

	function getOptions() {
		$options = get_option('inove_options');
		if (!is_array($options)) {
			$options['google_cse'] = false;
			$options['google_cse_cx'] = '';
			$options['menu_type'] = 'pages';
			$options['nosidebar'] = false;
			$options['notice'] = false;
			$options['notice_content'] = '';
			$options['banner_registered'] = false;
			$options['banner_commentator'] = false;
			$options['banner_visitor'] = false;
			$options['banner_content'] = '';
			$options['showcase_registered'] = false;
			$options['showcase_commentator'] = false;
			$options['showcase_visitor'] = false;
			$options['showcase_caption'] = false;
			$options['showcase_title'] = '';
			$options['showcase_content'] = '';
			$options['author'] = true;
			$options['categories'] = true;
			$options['tags'] = true;
			$options['ctrlentry'] = false;
			$options['feed_readers'] = true;
			$options['feed'] = false;
			$options['feed_url'] = '';
			$options['feed_email'] = false;
			$options['feed_url_email'] = '';
			$options['twitter'] = false;
			$options['twitter_username'] = '';
			$options['analytics'] = false;
			$options['analytics_content'] = '';
			update_option('inove_options', $options);
		}
		return $options;
	}

	function add() {
		if(isset($_POST['inove_save'])) {
			$options = iNoveOptions::getOptions();

			// google custom search engine
			if ($_POST['google_cse']) {
				$options['google_cse'] = (bool)true;
			} else {
				$options['google_cse'] = (bool)false;
			}
			$options['google_cse_cx'] = stripslashes($_POST['google_cse_cx']);

			// menu
			$options['menu_type'] = stripslashes($_POST['menu_type']);

			// sidebar
			if ($_POST['nosidebar']) {
				$options['nosidebar'] = (bool)true;
			} else {
				$options['nosidebar'] = (bool)false;
			}

			// notice
			if ($_POST['notice']) {
				$options['notice'] = (bool)true;
			} else {
				$options['notice'] = (bool)false;
			}
			$options['notice_content'] = stripslashes($_POST['notice_content']);

			// banner
			if (!$_POST['banner_registered']) {
				$options['banner_registered'] = (bool)false;
			} else {
				$options['banner_registered'] = (bool)true;
			}
			if (!$_POST['banner_commentator']) {
				$options['banner_commentator'] = (bool)false;
			} else {
				$options['banner_commentator'] = (bool)true;
			}
			if (!$_POST['banner_visitor']) {
				$options['banner_visitor'] = (bool)false;
			} else {
				$options['banner_visitor'] = (bool)true;
			}
			$options['banner_content'] = stripslashes($_POST['banner_content']);

			// showcase
			if (!$_POST['showcase_registered']) {
				$options['showcase_registered'] = (bool)false;
			} else {
				$options['showcase_registered'] = (bool)true;
			}
			if (!$_POST['showcase_commentator']) {
				$options['showcase_commentator'] = (bool)false;
			} else {
				$options['showcase_commentator'] = (bool)true;
			}
			if (!$_POST['showcase_visitor']) {
				$options['showcase_visitor'] = (bool)false;
			} else {
				$options['showcase_visitor'] = (bool)true;
			}
			if ($_POST['showcase_caption']) {
				$options['showcase_caption'] = (bool)true;
			} else {
				$options['showcase_caption'] = (bool)false;
			}
			$options['showcase_title'] = stripslashes($_POST['showcase_title']);
			$options['showcase_content'] = stripslashes($_POST['showcase_content']);

			// posts
			if ($_POST['author']) {
				$options['author'] = (bool)true;
			} else {
				$options['author'] = (bool)false;
			}
			if ($_POST['categories']) {
				$options['categories'] = (bool)true;
			} else {
				$options['categories'] = (bool)false;
			}
			if (!$_POST['tags']) {
				$options['tags'] = (bool)false;
			} else {
				$options['tags'] = (bool)true;
			}

			// ctrl + entry
			if ($_POST['ctrlentry']) {
				$options['ctrlentry'] = (bool)true;
			} else {
				$options['ctrlentry'] = (bool)false;
			}

			// feed
			if (!$_POST['feed_readers']) {
				$options['feed_readers'] = (bool)false;
			} else {
				$options['feed_readers'] = (bool)true;
			}
			if ($_POST['feed']) {
				$options['feed'] = (bool)true;
			} else {
				$options['feed'] = (bool)false;
			}
			$options['feed_url'] = stripslashes($_POST['feed_url']);
			if ($_POST['feed_email']) {
				$options['feed_email'] = (bool)true;
			} else {
				$options['feed_email'] = (bool)false;
			}
			$options['feed_url_email'] = stripslashes($_POST['feed_url_email']);

			// twitter
			if ($_POST['twitter']) {
				$options['twitter'] = (bool)true;
			} else {
				$options['twitter'] = (bool)false;
			}
			$options['twitter_username'] = stripslashes($_POST['twitter_username']);

			// analytics
			if ($_POST['analytics']) {
				$options['analytics'] = (bool)true;
			} else {
				$options['analytics'] = (bool)false;
			}
			$options['analytics_content'] = stripslashes($_POST['analytics_content']);

			update_option('inove_options', $options);

		} else {
			iNoveOptions::getOptions();
		}

		add_theme_page(__('Current Theme Options', 'inove'), __('Current Theme Options', 'inove'), 'edit_themes', basename(__FILE__), array('iNoveOptions', 'display'));
	}

	function display() {
		$options = iNoveOptions::getOptions();
?>

<form action="#" method="post" enctype="multipart/form-data" name="inove_form" id="inove_form">
	<div class="wrap">
		<h2><?php _e('Current Theme Options', 'inove'); ?></h2>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Search', 'inove'); ?></th>
					<td>
						<label>
							<input name="google_cse" type="checkbox" value="checkbox" <?php if($options['google_cse']) echo "checked='checked'"; ?> />
							 <?php _e('Using google custom search engine.', 'inove'); ?>
						</label>
						<br/>
						<?php _e('CX:', 'inove'); ?>
						 <input type="text" name="google_cse_cx" id="google_cse_cx" class="code" size="40" value="<?php echo($options['google_cse_cx']); ?>">
						<br/>
						<?php printf(__('Find <code>name="cx"</code> in the <strong>Search box code</strong> of <a href="%1$s">Google Custom Search Engine</a>, and type the <code>value</code> here.<br/>For example: <code>014782006753236413342:1ltfrybsbz4</code>', 'inove'), 'http://www.google.com/coop/cse/'); ?>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Menubar', 'inove'); ?></th>
					<td>
						<label style="margin-right:20px;">
							<input name="menu_type" type="radio" value="pages" <?php if($options['menu_type'] != 'categories') echo "checked='checked'"; ?> />
							 <?php _e('Show pages as menu.', 'inove'); ?>
						</label>
						<label>
							<input name="menu_type" type="radio" value="categories" <?php if($options['menu_type'] == 'categories') echo "checked='checked'"; ?> />
							 <?php _e('Show categories as menu.', 'inove'); ?>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Sidebar', 'inove'); ?></th>
					<td>
						<label>
							<input name="nosidebar" type="checkbox" value="checkbox" <?php if($options['nosidebar']) echo "checked='checked'"; ?> />
							 <?php _e('Hide sidebar from all pages.', 'inove'); ?>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Notice', 'inove'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'inove'); ?></small>
					</th>
					<td>
						<!-- notice START -->
						<label>
							<input name="notice" type="checkbox" value="checkbox" <?php if($options['notice']) echo "checked='checked'"; ?> />
							 <?php _e('This notice bar will display at the top of posts on homepage.', 'inove'); ?>
						</label>
						<br />
						<label>
							<textarea name="notice_content" id="notice_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code"><?php echo($options['notice_content']); ?></textarea>
						</label>
						<!-- notice END -->
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Banner', 'inove'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'inove'); ?></small>
					</th>
					<td>
						<!-- banner START -->
						<?php _e('This banner will display at the right of header. (height: 60 pixels)', 'inove'); ?>
						<br/>
						<?php _e('Who can see?', 'inove'); ?>
						<label style="margin-left:10px;">
							<input name="banner_registered" type="checkbox" value="checkbox" <?php if($options['banner_registered']) echo "checked='checked'"; ?> />
							 <?php _e('Registered Users', 'inove'); ?>
						</label>
						<label style="margin-left:10px;">
							<input name="banner_commentator" type="checkbox" value="checkbox" <?php if($options['banner_commentator']) echo "checked='checked'"; ?> />
							 <?php _e('Commentator', 'inove'); ?>
						</label>
						<label style="margin-left:10px;">
							<input name="banner_visitor" type="checkbox" value="checkbox" <?php if($options['banner_visitor']) echo "checked='checked'"; ?> />
							 <?php _e('Visitors', 'inove'); ?>
						</label>
						<br/>
						<label>
							<textarea name="banner_content" id="banner_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code"><?php echo($options['banner_content']); ?></textarea>
						</label>
						<!-- banner END -->
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Showcase', 'inove'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'inove'); ?></small>
					</th>
					<td>
						<!-- showcase START -->
						<?php _e('This showcase will display at the top of sidebar.', 'inove'); ?>
						<br/>
						<?php _e('Who can see?', 'inove'); ?>
						<label style="margin-left:10px;">
							<input name="showcase_registered" type="checkbox" value="checkbox" <?php if($options['showcase_registered']) echo "checked='checked'"; ?> />
							 <?php _e('Registered Users', 'inove'); ?>
						</label>
						<label style="margin-left:10px;">
							<input name="showcase_commentator" type="checkbox" value="checkbox" <?php if($options['showcase_commentator']) echo "checked='checked'"; ?> />
							 <?php _e('Commentator', 'inove'); ?>
						</label>
						<label style="margin-left:10px;">
							<input name="showcase_visitor" type="checkbox" value="checkbox" <?php if($options['showcase_visitor']) echo "checked='checked'"; ?> />
							 <?php _e('Visitors', 'inove'); ?>
						</label>
						<br/>
						<label>
							<input name="showcase_caption" type="checkbox" value="checkbox" <?php if($options['showcase_caption']) echo "checked='checked'"; ?> />
							 <?php _e('Title:', 'inove'); ?>
						</label>
						 <input type="text" name="showcase_title" id="showcase_title" class="code" size="40" value="<?php echo($options['showcase_title']); ?>" />
						<br/>
						<label>
							<textarea name="showcase_content" id="showcase_content" cols="50" rows="10" style="width:98%;font-size:12px;" class="code"><?php echo($options['showcase_content']); ?></textarea>
						</label>
						<!-- showcase END -->
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Posts', 'inove'); ?></th>
					<td>
						<label style="margin-right:20px;">
							<input name="author" type="checkbox" value="checkbox" <?php if($options['author']) echo "checked='checked'"; ?> />
							 <?php _e('Show author on posts.', 'inove'); ?>
						</label>
						<label style="margin-right:20px;">
							<input name="categories" type="checkbox" value="checkbox" <?php if($options['categories']) echo "checked='checked'"; ?> />
							 <?php _e('Show categories on posts.', 'inove'); ?>
						</label>
						<label>
							<input name="tags" type="checkbox" value="checkbox" <?php if($options['tags']) echo "checked='checked'"; ?> />
							 <?php _e('Show tags on posts.', 'inove'); ?>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Comments', 'inove'); ?></th>
					<td>
						<label>
							<input name="ctrlentry" type="checkbox" value="checkbox" <?php if($options['ctrlentry']) echo "checked='checked'"; ?> />
							 <?php _e('Submit comments with Ctrl+Enter.', 'inove'); ?>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Feed', 'inove'); ?></th>
					<td>
						<label>
							<input name="feed_readers" type="checkbox" value="checkbox" <?php if($options['feed_readers']) echo "checked='checked'"; ?> />
							 <?php _e('Show the feed reader list when mouse over on feed button.', 'inove'); ?>
						</label>
						<br />
						<label>
							<input name="feed" type="checkbox" value="checkbox" <?php if($options['feed']) echo "checked='checked'"; ?> />
							 <?php _e('Custom feed.', 'inove'); ?>
						</label>
						 <?php _e('URL:', 'inove'); ?> <input type="text" name="feed_url" id="feed_url" class="code" size="60" value="<?php echo($options['feed_url']); ?>">
						<br/>
						<label>
							<input name="feed_email" type="checkbox" value="checkbox" <?php if($options['feed_email']) echo "checked='checked'"; ?> />
							 <?php _e('Email feed.', 'inove'); ?>
						</label>
						 <?php _e('URL:', 'inove'); ?> <input type="text" name="feed_url_email" id="feed_url_email" class="code" size="60" value="<?php echo($options['feed_url_email']); ?>">
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><?php _e('Twitter', 'inove'); ?></th>
					<td>
						<label>
							<input name="twitter" type="checkbox" value="checkbox" <?php if($options['twitter']) echo "checked='checked'"; ?> />
							 <?php _e('Add Twitter button.', 'inove'); ?>
						</label>
						<br />
						 <?php _e('Twitter username:', 'inove'); ?>
						 <input type="text" name="twitter_username" id="twitter_username" class="code" size="40" value="<?php echo($options['twitter_username']); ?>">
						<br />
						<a href="http://twitter.com/neoease/" onclick="window.open(this.href);return false;">Follow NeoEase</a>
						 | <a href="http://twitter.com/mg12/" onclick="window.open(this.href);return false;">Follow MG12</a>
					</td>
				</tr>
			</tbody>
		</table>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<?php _e('Web Analytics', 'inove'); ?>
						<br/>
						<small style="font-weight:normal;"><?php _e('HTML enabled', 'inove'); ?></small>
					</th>
					<td>
						<label>
							<input name="analytics" type="checkbox" value="checkbox" <?php if($options['analytics']) echo "checked='checked'"; ?> />
							 <?php _e('Add web analytics code to your site. (e.g. Google Analytics, Yahoo! Web Analytics, ...)', 'inove'); ?>
						</label>
						<label>
							<textarea name="analytics_content" cols="50" rows="10" id="analytics_content" class="code" style="width:98%;font-size:12px;"><?php echo($options['analytics_content']); ?></textarea>
						</label>
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<input class="button-primary" type="submit" name="inove_save" value="<?php _e('Save Changes', 'inove'); ?>" />
		</p>
	</div>
</form>

<!-- donation -->
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<div class="wrap" style="background:#E3E3E3; margin-bottom:1em;">

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">Donation</th>
					<td>
						If you find my work useful and you want to encourage the development of more free resources, you can do it by donating...
						<br />
						<input type="hidden" name="cmd" value="_s-xclick" />
						<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHLwYJKoZIhvcNAQcEoIIHIDCCBxwCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYCwFHlz2W/LEg0L98DkEuGVuws4IZhsYsjipEowCK0b/2Qdq+deAsATZ+3yU1NI9a4btMeJ0kFnHyOrshq/PE6M77E2Fm4O624coFSAQXobhb36GuQussNzjaNU+xdcDHEt+vg+9biajOw0Aw8yEeMvGsL+pfueXLObKdhIk/v3IDELMAkGBSsOAwIaBQAwgawGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIIMGcjXBufXGAgYibKOyT8M5mdsxSUzPc/fGyoZhWSqbL+oeLWRJx9qtDhfeXYWYJlJEekpe1ey/fX8iDtho8gkUxc2I/yvAsEoVtkRRgueqYF7DNErntQzO3JkgzZzuvstTMg2HTHcN/S00Kd0Iv11XK4Te6BBWSjv6MgzAxs+e/Ojmz2iinV08Kuu6V1I6hUerNoIIDhzCCA4MwggLsoAMCAQICAQAwDQYJKoZIhvcNAQEFBQAwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMB4XDTA0MDIxMzEwMTMxNVoXDTM1MDIxMzEwMTMxNVowgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBR07d/ETMS1ycjtkpkvjXZe9k+6CieLuLsPumsJ7QC1odNz3sJiCbs2wC0nLE0uLGaEtXynIgRqIddYCHx88pb5HTXv4SZeuv0Rqq4+axW9PLAAATU8w04qqjaSXgbGLP3NmohqM6bV9kZZwZLR/klDaQGo1u9uDb9lr4Yn+rBQIDAQABo4HuMIHrMB0GA1UdDgQWBBSWn3y7xm8XvVk/UtcKG+wQ1mSUazCBuwYDVR0jBIGzMIGwgBSWn3y7xm8XvVk/UtcKG+wQ1mSUa6GBlKSBkTCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb22CAQAwDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQUFAAOBgQCBXzpWmoBa5e9fo6ujionW1hUhPkOBakTr3YCDjbYfvJEiv/2P+IobhOGJr85+XHhN0v4gUkEDI8r2/rNk1m0GA8HKddvTjyGw/XqXa+LSTlDYkqI8OwR8GEYj4efEtcRpRYBxV8KxAW93YDWzFGvruKnnLbDAF6VR5w/cCMn5hzGCAZowggGWAgEBMIGUMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbQIBADAJBgUrDgMCGgUAoF0wGAYJKoZIhvcNAQkDMQsGCSqGSIb3DQEHATAcBgkqhkiG9w0BCQUxDxcNMDkwMTA4MTUwNTMzWjAjBgkqhkiG9w0BCQQxFgQU9yNbEkDR5C12Pqjz05j5uGf9evgwDQYJKoZIhvcNAQEBBQAEgYCWyKjU/IdjjY2oAYYNAjLYunTRMVy5JhcNnF/0ojQP+39kV4+9Y9gE2s7urw16+SRDypo2H1o+212mnXQI/bAgWs8LySJuSXoblpMKrHO1PpOD6MUO2mslBTH8By7rdocNUtZXUDUUcvrvWEzwtVDGpiGid1G61QJ/1tVUNHd20A==-----END PKCS7-----" />
						<input style="border:none;" type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" name="submit" alt="" />
						<img alt="" src="https://www.paypal.com/zh_XC/i/scr/pixel.gif" />
					</td>
				</tr>
			</tbody>
		</table>

	</div>
</form>

<?php
	}
}

// register functions
add_action('admin_menu', array('iNoveOptions', 'add'));

function enable_more_buttons($buttons) {   
        
     $buttons[] = 'fontselect';   
     $buttons[] = 'fontsizeselect';  
  $buttons[] = 'styleselect';  
  $buttons[] = 'backcolor';
    
     $buttons[] = 'wp_page';   
     $buttons[] = 'anchor';   
     
  $buttons[] = 'hr';   
     $buttons[] = 'del';   
     $buttons[] = 'sub';   
     $buttons[] = 'sup'; 
   $buttons[] = 'cleanup';      
      
     return $buttons;   
     }   
add_filter("mce_buttons_3", "enable_more_buttons"); 

function insertPreContent($content) {

if(!is_feed() && !is_home()) {

$content.= '正文<hr />
<p style="text-align: right"><strong><span style="font-size: large">【完】</span></strong></p>';

$content.= '<strong><span style="font-size: medium"> 本文内容遵从CC版权协议，转载请注明出自<a href="http://www.kylen314.com/">http://www.kylen314.com</a></span></strong>';


}

return $content;

}

add_filter ('default_content', 'insertPreContent');

/** l10n */
function theme_init(){
	load_theme_textdomain('inove', get_template_directory() . '/languages');
}
add_action ('init', 'theme_init');

/** widgets */
if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'north_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'south_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'west_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'east_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

/** Comments */
if (function_exists('wp_list_comments')) {
	// comment count
	function comment_count( $commentcount ) {
		global $id;
		$_comments = get_comments('status=approve&post_id=' . $id);
		$comments_by_type = &separate_comments($_comments);
		return count($comments_by_type['comment']);
	}
}

// custom comments
function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}
?>
	<li class="comment <?php if($comment->comment_author_email == get_the_author_email()) {echo 'admincomment';} else {echo 'regularcomment';} ?>" id="comment-<?php comment_ID() ?>">
		<div class="author">
			<div class="pic">
				<?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 32); } ?>
			</div>
			<div class="name">
				<?php if (get_comment_author_url()) : ?>
					<a id="commentauthor-<?php comment_ID() ?>" class="url" href="<?php comment_author_url() ?>" rel="external nofollow">
				<?php else : ?>
					<span id="commentauthor-<?php comment_ID() ?>">
				<?php endif; ?>

				<?php comment_author(); ?>

				<?php if(get_comment_author_url()) : ?>
					</a>
				<?php else : ?>
					</span>
				<?php endif; ?>
			</div>
		</div>

		<div class="info">
			<div class="date">
				<?php printf( __('%1$s at %2$s', 'inove'), get_comment_time(__('F jS, Y', 'inove')), get_comment_time(__('H:i', 'inove')) ); ?>
					 | <a href="#comment-<?php comment_ID() ?>"><?php printf('#%1$s', ++$commentcount); ?></a>
			</div>
			<div class="act">
				<a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('Reply', 'inove'); ?></a> | 
				<a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'commentbody-<?php comment_ID() ?>', 'comment');"><?php _e('Quote', 'inove'); ?></a>
				<?php
					if (function_exists("qc_comment_edit_link")) {
						qc_comment_edit_link('', ' | ', '', __('Edit', 'inove'));
					}
					edit_comment_link(__('Advanced edit', 'inove'), ' | ', '');
				?>
			</div>
			<div class="fixed"></div>
			<div class="content">
				<?php if ($comment->comment_approved == '0') : ?>
					<p><small><?php _e('Your comment is awaiting moderation.', 'inove'); ?></small></p>
				<?php endif; ?>

				<div id="commentbody-<?php comment_ID() ?>">
					<?php comment_text(); ?>
				</div>
			</div>
		</div>
		<div class="fixed"></div>

		
		
<?php
}

	function spam_protection_math(){
		$num1=rand(0,9);
		$num2=rand(0,9);

		echo "<input type='text' name='sum' class='math_textfield' value='' size='28' tabindex='4'> 验证码：$num1 + $num2 = ?"
		."<input type='hidden' name='num1' value='$num1'>"
		."<input type='hidden' name='num2' value='$num2'>";
		}
	function spam_protection_pre($commentdata){
		$sum=$_POST['sum'];
		switch($sum){
			case $_POST['num1']+$_POST['num2']:break;
			case null:wp_die('错误: 请输入验证码.');break;
			default:wp_die('错误: 验证码错误,请重试.');
		}
		return $commentdata;
	}
	if($comment_data['comment_type']==''){
		add_filter('preprocess_comment','spam_protection_pre');
	}
	// add more buttons to the html editor
function appthemes_add_quicktags() {
?>
 <script type="text/javascript">
 QTags.addButton( '横线', 'hr/', '<hr/>\n', '' ); 
 QTags.addButton( 'Mathemaitca', 'Mathemaitca', '<pre class="prettyprint1 lang-mma">\n\n</pre>', '' ); 
 QTags.addButton( '垂直空白', '垂直空白', '<span style="padding=10px;"></span>\n', '' ); 
 QTags.addButton( '居中', '居中', '<p style="text-align: center;">', "</p>" );
 QTags.addButton( '缩进', '缩进', '[toggle title=""]\n\n[/toggle]', '' ); 
 QTags.addButton( 'C++', 'C++', '[code lang="cpp"]\n\n[/code]\n', '' ); 
 QTags.addButton( 'Matlab', 'Matlab', '[code lang="matlab"]\n\n[/code]', '' ); 
 QTags.addButton( 'Python', 'Python', '[code lang="python"]\n\n[/code]', '' ); 
 QTags.addButton( 'PHP', 'PHP', '[code lang="php"]\n\n[/code]', '' ); 
 QTags.addButton( '空格', '空格', '&nbsp;', '' ); 
 QTags.addButton( '突出标记', '突出标记','<code class="myitem">', '</code>' );
 QTags.addButton( '颜色标记', '颜色标记', '<span class="mylabel" style="background-color: #5cb85c;">', "</span>" );
 QTags.addButton( 'h1', 'h1', "<h1>", "</h1>" );
 QTags.addButton( 'h2', 'h2', "<h2>", "</h2>" );
 QTags.addButton( 'h3', 'h3', "<h3>", "</h3>" );
 QTags.addButton( 'h4', 'h4', "<h4>", "</h4>" );
 QTags.addButton( '图片加框', '图片加框',"myborderimg", '' );  
 QTags.addButton( '加粗', '加粗', "<b>", "</b>" );
 QTags.addButton( '上标', '上标', "<sup>", "</sup>" );
 QTags.addButton( '下标', '下标', "<sub>", "</sub>" );
 QTags.addButton( 'Latex', 'Latex', '\\(\\)', '' );
 QTags.addButton( 'Σ', 'Σ', '\\sum\\limits_{}^{}', '' );
 QTags.addButton( '分数', '分数', '\\dfrac{}{}', '' );
 QTags.addButton( '平方', '平方', '²', '' );
 QTags.addButton( '矩阵', '矩阵', '\\(\\left(\\begin{array}{cc}A11 & A12 \\\\A21 & A22 \\end{array}\\right)\\)', '' );
 QTags.addButton( '多行公式', '多行公式', '\\(\\left\\{\\begin{array}{ll}equa1\\\\equa2\\end{array}\\right.\\)', '' );
 QTags.addButton( '公式推导', '公式推导', '\\(\\begin{eqnarray*}a & = &b \\\\& = & c\\end{eqnarray*}\\)', '' );
 QTags.addButton( '向量', '向量', '\\overrightarrow{A}', '' );
 QTags.addButton( '结束语', '结束语', '<hr />\n<p style="text-align: right;"><strong><span style="font-size: large;">【完】</span></strong></p><strong><span style="font-size: medium;"> 本文内容遵从CC版权协议，转载请注明出自<a href="http://www.kylen314.com/">http://www.kylen314.com</a></span></strong>', '' );
 QTags.addButton( '普通字体', '普通字体', '<span style="font-size: medium;">', "</span>" );
 QTags.addButton( '标红', '标红', '<span style="color: #ff0000;">', "</span>" );  
  
 QTags.addButton( '双线框', '双线框', '<div style="border: green 5px double;">', "</div>\n" );
 QTags.addButton( '侧边灰条', '侧边灰条', '<div style="border-left-width: 4.0px; border-left-style: solid; border-left-color: #dddddd; color: #777777; padding: 0.0px 1.0em; margin: 1.0em 0.0px;">', "</div>\n" );
 QTags.addButton( 'EP模板', 'EP模板', '<h1>Problem X:</h1>\n<blockquote>\n\n</blockquote>\n<div style="border-left-width: 4.0px; border-left-style: solid; border-left-color: #dddddd; color: #777777; padding: 0.0px 1.0em; margin: 1.0em 0.0px;">\n\n<span style="font-size: 25px;color:#2970A6;">翻译：</span>\n\n<div style="border-left-width: 4.0px; border-left-style: solid; border-left-color: #dddddd; color: #777777; padding: 0.0px 1.0em; margin: 1.0em 0.0px;">\n<span style="font-size: 25px;color:#2970A6;">思路:</span>\n\n</div>\n</div>\n<h3>Code：Python</h3>\n\n\n<hr />', '' );
 </script>


    

<?php
}
add_action('admin_print_footer_scripts', 'appthemes_add_quicktags' );

//设置 HTML 为默认编辑器
add_filter( 'wp_default_editor', create_function('', 'return "html";') );



//获取浏览数-参数文章ID      
function getPostViews($postID){      
    //字段名称      
    $count_key = 'post_views_count';      
    //获取字段值即浏览次数      
    $count = get_post_meta($postID, $count_key, true);      
    //如果为空设置为0      
    if($count==''){      
        delete_post_meta($postID, $count_key);      
        add_post_meta($postID, $count_key, '0');      
        return "0";      
    }      
    return $count;      
}      
//设置浏览数-参数文章ID      
function setPostViews($postID) {      
    //字段名称      
    $count_key = 'post_views_count';      
    //先获取获取字段值即浏览次数      
    $count = get_post_meta($postID, $count_key, true);      
    //如果为空就设为0      
    if($count==''){      
        $count = 0;      
        delete_post_meta($postID, $count_key);      
        add_post_meta($postID, $count_key, '0');      
    }else{      
        //如果不为空，加1，更新数据      
        $count++;      
        update_post_meta($postID, $count_key, $count);      
    }      
}    

$new_meta_boxes =
array(
    "description" => array(
        "name" => "description",
        "std" => "",
        "title" => "网页描述:"),

    "keywords" => array(
        "name" => "keywords",
        "std" => "",
        "title" => "关键字:")
);

function new_meta_boxes() {
    global $post, $new_meta_boxes;

    foreach($new_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];

        // 自定义字段标题
        echo'<h4>'.$meta_box['title'].'</h4>';

        // 自定义字段输入框
        echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
    }
    
    echo '<input type="hidden" name="newmetaboxes_noncename" id="newmetaboxes_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
}

function create_meta_box() {
    global $theme_name;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '自定义模块', 'new_meta_boxes', 'post', 'normal', 'high' );
    }
}

function save_postdata( $post_id ) {
    global $new_meta_boxes;
    
    if ( !wp_verify_nonce( $_POST['newmetaboxes_noncename'], plugin_basename(__FILE__) ))
        return;
    
    if ( !current_user_can( 'edit_posts', $post_id ))
        return;
                    
    foreach($new_meta_boxes as $meta_box) {
        $data = $_POST[$meta_box['name'].'_value'];

        if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
            add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
            update_post_meta($post_id, $meta_box['name'].'_value', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    }
}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');



/** Auto-Generate ALT tag for images */
function image_alt_tag($content){
    global $post;preg_match_all('/<img (.*?)\/>/', $content, $images);
    if(!is_null($images)) {
        foreach($images[1] as $index => $value){
            if(!preg_match('/alt=/', $value)){
                $new_img = str_replace('<img', '<img alt="'.get_the_title().'"', $images[0][$index]);
                $content = str_replace($images[0][$index], $new_img, $content);}
        }
    }
    return $content;
}
add_filter('the_content', 'image_alt_tag', 99999);
?>