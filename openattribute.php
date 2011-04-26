<?php
/*
Plugin Name: Open Attribute
Plugin URI: http://openattribute.com
OpenAttribute allows you to add licensing information to your Wordpress site and individual blogs. It places information into posts and RSS feeds as well as other user friendly features.
Version: 0.91
Author: Open Attribute team
Author URI: http://openattribute.com
*/

function openattribute_firstrun(){

	if(get_option('openattribute_firstrun')=='1'){

		echo "<div class='updated fade'>";
	    	
	    echo "<p style=\"text-decoration:underline; font-weight:bold\">Information on OpenAttribute</p>";
	    	
	    echo "<p>Thanks for installing OpenAttribute. You can find out about how to use our <a href=\"http://http://openattribute.com/first-run-wordpress/\" target=\"_blank\">wordpress plugin</a> on our <a href=\"http://openattribute.com\">OpenAttribute</a> site, where we also have browser plugins.</p>";
	    
	    echo "<p>If you'd like to get started straight away - either go to <a href=\"options-general.php?page=openattribute\">OpenAttribute settings page</a> or start a new blog post and look for the symbol below.</p>";
	    
	    echo "<p><img src=\"" . WP_PLUGIN_URL . "/" . str_replace(basename( __FILE__),"",plugin_basename(__FILE__)) . "information.png\" /></p>";
	    
	    echo "<p>You can turn this screen off on the <a href=\"options-general.php?page=openattribute\">OpenAttribute settings page</a></p>";
	    
	    echo "</div>";
    
    }

}

function add_openattribute_action() {
  
	?>
	
	<script language="Javascript" type="text/javascript">
	
				function insert() {
					
					license_url = document.getElementById('license_oa').options[document.getElementById('license_oa').selectedIndex].getAttribute("license_value");
					license_shorthand = document.getElementById('license_oa').options[document.getElementById('license_oa').selectedIndex].text;
      	      		title = document.getElementById("title_oa").value;
      	      		attribution_url = document.getElementById("url_oa").value;
      	      		author = document.getElementById("author_oa").value;
      	      		           			
      				string = ' <a id="oatitle" href="<? echo $_GET['post']; ?>" xmlns:dc="http://purl.org/dc/terms/" property="dc:title">' + title + '</a>'
      				string += ' by <a id="oaattributionurl" xmlns:cc="http://creativecommons.org/ns#" href="' + attribution_url + '" property="cc:attributionName" rel="cc:attributionURL" oaauthor="' + author + '">' + author + '</a>';
      				string += ' is licensed under a <a id="oalicense" rel="license" href="' + license_url + '">' + license_shorthand + '</a>.<br />';
      				string += ' Based on a work at <a xmlns:dct="http://purl.org/dc/terms/" href="<? echo $_GET['post']; ?>" rel="dct:source"><?php echo $_GET['post']; ?></a>.';
      				      	    				
      				alert(string);      				
      				      				
      				var win = window.dialogArguments || opener || parent || top;
      				win.send_to_editor(string);
      				      				
      				return true;
    			}
    			
    			function insert_author(){
    			
    				document.getElementById("author_oa").value = document.getElementById('user').options[document.getElementById('user').selectedIndex].text;
    				document.getElementById("url_oa").value = "<?php echo get_option('home'); ?>/?author=" + document.getElementById('user').selectedIndex;
    			
    			}
    
    </script>
    <link rel='stylesheet' id='colors-css'  href='<?PHP echo WP_PLUGIN_URL . '/openattribute_posts/'; ?>openattribute_iframe.css' type='text/css' media='all' />
	<div id="openattribute">		
		<img src="<?PHP echo WP_PLUGIN_URL . '/openattribute_posts/'; ?>openAttrLogo.jpg" />
    	<h3>Adding licensing to your blog post</h3>
    	<p>Choose the author for this blog 
    <?php 
    
    	$args = array(
			'show_option_all'         => '',
			'orderby'                 => 'display_name',
			'order'                   => 'ASC',
			'multi'                   => true,
			'show'                    => 'display_name',
			'name'                    => 'user',
			'id'                      => 'user',
			'class'                   => '', 
			'blog_id'                 => $GLOBALS['blog_id']
		);
		
		wp_dropdown_users( $args ); ?></p><p>Next click to insert the author<input type="button" class="button" onclick="insert_author()" value="Insert" /></p>
		<script type="text/javascript">
				
			var win = window.dialogArguments || opener || parent || top;
			
			author = win.document.getElementById('content').innerHTML;
		
			author_data = author.split('oaattributionurl');
			
			if(author_data.length!=1){
		
				author = author_data[1].split('&gt;');
		
				author = author[1].split('&lt;');
				
				author=author[0];
			
				if(author!=""){
			
					document.write('<p>If you wish to change the details you can do so now <input id="author_oa" type="text" value="' + author + '" size="90" /></p>');
				
				}
				
			}else{
			
				document.write('<p>If you wish to change the details you can do so now <input id="author_oa" type="text" value="" size="90" /></p>');
			
			}			
			
		</script>
		<script type="text/javascript">
		
			var win = window.dialogArguments || opener || parent || top;
		
			data_to_parse = win.document.getElementById('content').innerHTML;
		
			title_data = data_to_parse.split('oatitle');
			
			if(title_data.length!=1){
		
				title = title_data[1].split('&gt;');
				
				title = title[1].split('&lt;');
			
				if(title.length!=1){
		
					title=title[0];
			
					if(title!=""){
			
						document.write('<p>If you wish to give the work a title you can do so<input id="title_oa" type="text" value="' + title + '" size="90" /></p>');
				
					}
				
				}else{
			
					document.write('<p>If you wish to give the work a title you can do so<input id="title_oa" type="text" value="" size="90" /></p>');
			
				}
				
			}else{
			
				document.write('<p>If you wish to give the work a title you can do so<input id="title_oa" type="text" value="" size="90" /></p>');
			
			}				
			
		</script>
		<script type="text/javascript">
		
			var win = window.dialogArguments || opener || parent || top;
		
			data_to_parse = win.document.getElementById('content').innerHTML;
		
			attribution_url_data = data_to_parse.split('oaattributionurl');
		
			if(attribution_url_data.length!=1){
			
				attribution_url = attribution_url_data[1].split('href="');
				
				attribution_url = attribution_url[1].split('"');
			
				if(attribution_url.length!=1){
		
					attribution_url=attribution_url[0];
					
				}
			
				if(attribution_url!=""){
			
					document.write('<p>You can set a URL for yourself as an author (Wordpress address set by default)<input id="url_oa" type="text" value="' + attribution_url + '" size="90" /></p>');
				
				}else{
			
					document.write('<p>You can set a URL for yourself as an author (Wordpress address set by default)<input id="url_oa" type="text" value="<?PHP echo site_url(); ?>" size="90" /></p>');
			
				}
				
			}else{
			
				document.write('<p>You can set a URL for yourself as an author (Wordpress address set by default)<input id="url_oa" type="text" value="<?PHP echo site_url(); ?>" size="90" /></p>');
			
			}			
			
		</script>
		<p>Now choose a license
			<select name="license_oa" id="license_oa">
				<?PHP 
						
						$licenses = explode("\n",get_option('openattribute_licenses')); 						
						
						while($license_pair = array_shift($licenses)){
						
							$data = explode(",",$license_pair);
			
							?><option license_value="<?PHP echo $data[0]; ?>"><?PHP echo $data[1]; ?></option><?PHP
			
						}
						?>						
			</select>		
		</p>
		<script type="text/javascript">
	
		var win = window.dialogArguments || opener || parent || top;
		
		data_to_parse = win.document.getElementById('content').innerHTML;		
		
		oashorthand_data = data_to_parse.split('oalicense');
		
		if(oashorthand_data.length!=1){
		
			oashorthand = oashorthand_data[1].split('&gt;');
			
			oashorthand = oashorthand[1].split('&lt;');
		
			if(oashorthand.length!=1){
		
				oashorthand=oashorthand[0];
		
				if(oashorthand!=""){
			
					document.write('<p>The current license is set as ' + oashorthand + '</p>');
				
				}
				
			}
			
		}
			
		</script>
		<p><input type="button" class="button" onclick="insert()" value="Insert" /></p>
	<?php
}

function openattribute_button($context) {
  
    $icon_url = WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__),"",plugin_basename(__FILE__)) . 'openatt.png';
    
    $string = get_permalink();
    
    $result = '<a href="media-upload.php?type=openattribute&amp;post=' . $string . '&amp;TB_iframe=1" class="thickbox" title="' . __('OpenAttribute - Add Licensing information') . '"><img src="'.$icon_url.'" alt="'. __('Add license') .'" title="'. __('Add licensing information') .'" /></a>';
       
    return $context . $result;
}

function openattribute_register() {

	add_option('openattribute_licenses', "http://creativecommons.org/licenses/by-nd/3.0,Attribution-NoDerivatives CC BY-ND\nhttp://creativecommons.org/licenses/by-nc-sa/3.0,Attribution-NonCommercial-ShareAlike CC BY-NC-SA\nhttp://creativecommons.org/licenses/by-sa/3.0,Attribution-ShareAlike CC BY-SA\nhttp://creativecommons.org/licenses/by-nc/3.0,Attribution-NonCommercial CC BY-NC\nhttp://creativecommons.org/licenses/by-nc-nd/3.0,Attribution-NonCommercial-NoDerivatives CC BY-NC-ND\n");
	add_option('openattribute_firstrun', 1);
	add_option('openattribute_rss', 1);
	add_option('openattribute_blogoverride', 1);
	add_option('openattribute_buttonset', 1);
	add_option('openattribute_linkset', 1);
	add_option('openattribute_widgetset', 1);
	add_option('openattribute_rdfa', 1);
	add_option('openattribute_disable', 1);
	add_option('openattribute_site_license', '');
	add_option('openattribute_site_author', '');
	add_option('openattribute_site_attribution_url', '');
	add_option('openattribute_append_content', '1');
	add_option('openattribute_append_footer', '1');
	add_option('openattribute_pre_license_html', '<div>');
	add_option('openattribute_post_license_html', '</div>');
	
}

function openattribute_options_page() {
  ?>
  	<div class="wrap">
	<h2>Open Attribute</h2>
	<p>Open attribute is a Wordpress plugin designed to allow users to add reuse licenses into their wordpress sites and then provide features so that people using your blog can attribute you.</p>
	<p>Built to allow users to be as flexible as possible with their licenses, Open Attribute allows you to attribute your entire blog with a license and to attribute each blog individually if required.</p>
	<p>On this control panel options for licensing are therefore divided between <a href="#blog">per blog</a> and <a href="#site">per site</a> options. You can also <a href="#license">add</a> any licenses you would like to be able to use</p>
	<p>This control panel also has <a href="#plugin">plugin settings</a> to control features such as RSS and attribution buttons</p>
	<form method="post" action="<?PHP echo $_SERVER[REQUEST_URI]; ?>">
	<input name="submitted" type="hidden" value="openattribute" /><?PHP    
    
   		$first_run = get_option('openattribute_firstrun')=='1'?"checked":"";
    	$rss_feed = get_option('openattribute_rss')=='1'?"checked":"";
    	$blog_override = get_option('openattribute_blogoverride')=='1'?"checked":"";
    	$buttonset = get_option('openattribute_buttonset')=='1'?"checked":"";
    	$linkset = get_option('openattribute_linkset')=='1'?"checked":"";
    	$widgetset = get_option('openattribute_widgetset')=='1'?"checked":"";    	
    	$rdfa = get_option('openattribute_rdfa')=='1'?"checked":"";
    	$disable = get_option('openattribute_disable')=='1'?"checked":"";
    	$append_content = get_option('openattribute_append_content')=='1'?"checked":"";
		$append_footer = get_option('openattribute_append_footer')=='1'?"checked":"";
    	
    ?><h3><a name="plugin">Attribution appearance settings</a></h3>
    <p>Here you can set settings for the plugin, these settings can be changed at anytime.</p>
    <div style="width:95%; padding:10px; border:1px solid black"><b><u>Choosing how the visitor sees the attribution</u></b><br/>
    	<p>
    		The attribution can appear in two ways (both can be used if you wish).
    	</p>
    	<div style="float:left; position:relative; width:50%; text-align:center; height:75px; padding-bottom:10px;">
    		<img src="<?PHP echo WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__),"",plugin_basename(__FILE__)) . 'attrib_button.png';?>" />
    		<p>
    			As this button.
    		</p>
    	</div>
    	<div style="float:left; position:relative; width:50%; text-align:center; height:75px; padding-bottom:10px;">
    		<p>
    			<a href="">
    				Attribute this resource
    			</a>
    		</p>
    		<p>
    			As a link such as the one above.
    		</p>    	
    	</div>
    	<br />
    	<input type="checkbox" name="openattribute_buttonset" <?PHP echo $buttonset; ?> /> If this box is ticked, an Open Attribute "Attribute Me" button will appear on all attributed resources <br />
    	<input type="checkbox" name="openattribute_linkset" <?PHP echo $linkset; ?> /> If this box is ticked, an Open Attribute "Attribute Me" link will appear on all attributed resources <br />
    </div>
    <div style="width:95%; padding:10px; border:1px solid black; margin-top:7px;"><b><u>Using the widget</u></b><br/>
    	<p>
    		The attribution can appear as a widget. You can use this and the blog options.
    	</p>
    	<input type="checkbox" name="openattribute_widgetset" <?PHP echo $widgetset; ?> /> If this box is ticked, the attribution will appear in the widget<br />
    </div>
    <div style="width:95%; padding:10px; border:1px solid black; margin-top:7px;"><b><u>Where will the link / button appear?</u></b><br/>
    	<p>
    		Your license can either appear directly at the end of your blog - or at the end of the blog's page (after comments). You can tick both boxes if you prefer.
    	</p>
    	<input type="checkbox" name="openattribute_append_content" <?PHP echo $append_content; ?> /> If this box is ticked, the attribution will appear after the blog's content<br />
    	<input type="checkbox" name="openattribute_append_footer" <?PHP echo $append_footer; ?> /> If this box is ticked, the attribution will appear in the blog's footer (both this, and the option aboive, can be ticked)<br />
    	<input type="checkbox" name="openattribute_rdfa" <?PHP echo $rdfa; ?> /> If this box is ticked, the attribution info will appear as a block of text as well (with RDFa)<br />
    </div>
    <div style="width:95%; padding:10px; border:1px solid black; margin-top:7px;"><b><u>HTML Options</u></b><br/>
    	<p>
    		This section allows you (if you wish) to style how the attribution will appear.
    	</p>
    	<input type="textbox" name="openattribute_pre_license_html" value="<?PHP echo addslashes(get_option('openattribute_pre_license_html')) ?>" /><br />
    	<input type="textbox" name="openattribute_post_license_html" value="<?PHP echo addslashes(get_option('openattribute_post_license_html')) ?>" /><br />
    </div>
    <div style="width:95%; padding:10px; border:1px solid black; margin-top:7px;"><b><u>Add licensing info to the RSS feeds</u></b><br/>
    	<p>
    		Your license can either appear directly at the end of your blog - or at the end of the blog's page (after comments). You can tick both boxes if you prefer.
    	</p>
    	<input type="checkbox" name="openattribute_rss" <?PHP echo $rss_feed; ?> /> If this box is ticked, the license information will be added to the RSS and Atom feeds <br />
    </div>
    <div style="width:95%; padding:10px; border:1px solid black; margin-top:7px;"><b><u>Administrative features</u></b><br/>
    	<p>
    		You can allow an author to override a site license with a blog post specific license, or allow a user to opt out of licensing a specific blog post completely.
    	</p>
    	<input type="checkbox" name="openattribute_blogoverride" <?PHP echo $blog_override; ?> /> If this box is ticked, if you add a license into the blog, then the site license will not be displayed <br />
 		<input type="checkbox" name="openattribute_disable" <?PHP echo $disable; ?> /> If this box is ticked, a blog author can opt out of having their work attributed<br />
    </div>
    <div style="width:95%; padding:10px; border:1px solid black; margin-top:7px;"><b><u>The first run page</u></b><br/>
    	<p>
    		You can turn off the first run page here.
    	</p>
    	<input type="checkbox" name="openattribute_firstrun" <?PHP echo $first_run; ?> /> If this box is ticked, the "first run" guidance will be displayed <br />
    </div>
    <h3><a name="licenses">Add Licenses</a></h3>
    <p>Please enter the licenses you wish to use below. The format for the license is "<b>URL</b><b>,</b><b>text to display on screen</b>". If you wish to use a custom license, perhaps create a page on your blog to hold your licensing info. By default you have been provided with some <a href="http://www.creativecommons.org" target="_blank">Creative Commons licenses</a>.</p>
    <textarea rows="5" cols="100" name="openattribute_licenses" ><?php 
    
    														$string = get_option('openattribute_licenses');
    														
    														if($string==""){
    														
    															echo "http://creativecommons.org/licenses/by-nd/3.0,Attribution-NoDerivatives CC BY-ND\n";
																echo "http://creativecommons.org/licenses/by-nc-sa/3.0,Attribution-NonCommercial-ShareAlike CC BY-NC-SA\n";
																echo "http://creativecommons.org/licenses/by-sa/3.0,Attribution-ShareAlike CC BY-SA\n";
																echo "http://creativecommons.org/licenses/by-nc/3.0,Attribution-NonCommercial CC BY-NC\n";
																echo "http://creativecommons.org/licenses/by-nc-nd/3.0,Attribution-NonCommercial-NoDerivatives CC BY-NC-ND\n";
    														
    														}else{
    														
    															echo $string;
    														
    														}
    														 
    														
    												?></textarea> 
    <h3><a name="site">Setup a site license</a></h3>
    <p>Choose a site license from this list - you can add new licenses in the box above</p>
	<select name="openattribute_license_for_site" id="openattribute_license_for_site">
			<?PHP 
						
					$licenses = explode("\n",get_option('openattribute_licenses')); 						
						
					while($license_pair = array_shift($licenses)){
						
						$data = explode(",",$license_pair);
			
						?><option license_value="<?PHP 
						
							echo $data[0];
						
							echo "\" ";
							
							if(trim(get_option('openattribute_site_license'))==trim($data[1])){
							
								echo " selected ";
							
							}
							
							echo ">" . $data[1] . "</option>";							
									
					}
			?>						
	</select><p>The current license is - <?PHP
	
		echo get_option('openattribute_site_license');
	
	?>
	<p>Choose an author name to display for this site<br /><?PHP
	
	$args = array(
			'show_option_all'         => '',
			'orderby'                 => 'display_name',
			'order'                   => 'ASC',
			'multi'                   => true,
			'show'                    => 'display_name',
			'name'                    => 'user',
			'id'                      => 'user',
			'class'                   => '', 
			'blog_id'                 => $GLOBALS['blog_id']
		);
		
		wp_dropdown_users( $args );
		
	?>or enter a name <input type="text" size="50" name="oa_author" value="<?PHP
	
		echo get_option('openattribute_site_author');
	
	?>" /></p>
	<p>Do you wish to use a URL for this author (called an attribution url)<input value="<?PHP	
		
		echo get_option('openattribute_site_attribution_url');
	
	?>" type="text" size="50" name="oa_url" /></p>
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    <input type="reset" class="button-primary" value="Cancel" id="cancel" />
    </p>
	</form>
</div>
  
  <?php
}

function openattribute_postform(){

	if ( (isset($_POST['submitted'])) && ($_POST['submitted'] == 'openattribute')) {
	
		update_option('openattribute_licenses', $_POST['openattribute_licenses']);
		
		if($_POST['openattribute_firstrun']=="on"){
		
			update_option('openattribute_firstrun', 1);
		
		}else{
		
			update_option('openattribute_firstrun', 0);
		
		}
		
		if($_POST['openattribute_rss']=="on"){
		
			update_option('openattribute_rss', 1);
		
		}else{
		
			update_option('openattribute_rss', 0);
		
		}
		
		if($_POST['openattribute_blogoverride']=="on"){
		
			update_option('openattribute_blogoverride', 1);
		
		}else{
		
			update_option('openattribute_blogoverride', 0);
		
		}
		
		if($_POST['openattribute_buttonset']=="on"){
		
			update_option('openattribute_buttonset', 1);
		
		}else{
		
			update_option('openattribute_buttonset', 0);
		
		}
		
		if($_POST['openattribute_linkset']=="on"){
		
			update_option('openattribute_linkset', 1);
		
		}else{
		
			update_option('openattribute_linkset', 0);
		
		}
		
		if($_POST['openattribute_widgetset']=="on"){
		
			update_option('openattribute_widgetset', 1);
		
		}else{
		
			update_option('openattribute_widgetset', 0);
		
		}
		
		update_option('openattribute_pre_license_html', $_POST['openattribute_pre_license_html']);
				
		update_option('openattribute_post_license_html', $_POST['openattribute_post_license_html']);
		
		
		if($_POST['openattribute_rdfa']=="on"){
		
			update_option('openattribute_rdfa', 1);
		
		}else{
		
			update_option('openattribute_rdfa', 0);
		
		}
		
		if($_POST['openattribute_disable']=="on"){
		
			update_option('openattribute_disable', 1);
		
		}else{
		
			update_option('openattribute_disable', 0);
		
		}
		
		if($_POST['openattribute_append_content']=="on"){
		
			update_option('openattribute_append_content', 1);
		
		}else{
		
			update_option('openattribute_append_content', 0);
		
		}
		
		if($_POST['openattribute_append_footer']=="on"){
		
			update_option('openattribute_append_footer', 1);
		
		}else{
		
			update_option('openattribute_append_footer', 0);
		
		}
		
		if($_POST['oa_author']!=""){
		
			update_option('openattribute_site_author', $_POST['oa_author']);
		
		}else{
		
			update_option('openattribute_site_author', get_the_author_meta( "display_name", $_POST['user'] ));
		
		}
		
		update_option('openattribute_site_license', $_POST['openattribute_license_for_site']);
		update_option('openattribute_site_attribution_url', $_POST['oa_url']);		
	
	}

}

function openattribute_menu_option() {
  add_options_page('OpenAttribute Options', 'OpenAttribute Options', 'manage_options', 'openattribute', 'openattribute_options_page');
}

function openattribute_save_post($post_id){
	
		  if ( !wp_verify_nonce( $_POST['openattribute_noncename'], plugin_basename(__FILE__) )) {
    			return $post_id;
  		  }

		  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
    	  		return $post_id;

		  if('page'==$_POST['post_type']){
    			if(!current_user_can('edit_page',$post_id))
      				return $post_id;
  		  }else{
    			if ( !current_user_can('edit_post',$post_id))
      				return $post_id;
  		  }
  		    		  
  		  if($_POST['disable_license']=="on"){	
	
				update_post_meta($post_id, 'disable_license', "on");
			  
		  }else{
			  
			  	update_post_meta($post_id, 'disable_license', "off");		  
		
		  }
  		  
}

function openattribute_disable_menu(){
	
		wp_nonce_field( plugin_basename(__FILE__), 'openattribute_noncename' );
		
		$meta = get_post_meta($_GET['post'], 'disable_license');
		
		if($meta[0]=="on"){
		
			$checked = "checked";
			
		}else{
		
			$checked = "";
		
		}
		
		if((get_option('openattribute_disable')==1)||($meta[0]=="on")){
		
			echo "To disable attribution for this post please tick this box <input type=\"checkbox\" name=\"disable_license\" $checked />";
		
		}
		
}

function openattribute_add_disable_menu($output){

		if(get_option('openattribute_disable')==1){
	
			add_meta_box( 'openattribute_id', 'OpenAttribute',"openattribute_disable_menu","post","normal","high");
			
		}
		
		$meta = get_post_meta($_GET['post'], 'disable_license');
		
		if($meta[0]=="on"){
		
			add_meta_box( 'openattribute_id', 'OpenAttribute',"openattribute_disable_menu","post","normal","high");
		
		}
	
}

function openattribute_add_license_content($output){

	global $wp_query;

	if(is_single()){

		if(get_option('openattribute_append_content')==1){
	
			$disable = get_post_meta($wp_query->posts[0]->ID, 'disable_license');
			
			if($disable[0]=="off"||$disable[0]==""){
			
				$display = true;
			
				if(get_option('openattribute_blogoverride')==1){
				
					$author = explode("oaauthor",$output);
					$title = explode("oatitle",$output);
					$oashorthand = explode("oalicense",$output);	
					
					if(count($author)!=1){
					
						$display = false;
					
					}
					
					if(count($title)!=1){
					
						$display = false;
					
					}
					
					if(count($oashorthand)!=1){
					
						$display = false;
					
					}
					
				}
					
				if($display){
				
					if(is_single()){	
				
						$author = get_option('openattribute_site_author');		
						$site_license = get_option('openattribute_site_license');
						$site_attribution_url = get_option('openattribute_site_attribution_url');
						$licenses = get_option('openattribute_licenses');
						
						$data_licenses = explode("\n",$licenses);
						
						while($license = array_shift($data_licenses)){
						
							$pair = explode(",",$license);
							
							if(trim($pair[1])==trim($site_license)){
							
								$site_license_url = $pair[0];
							
							}
						
						}
						
						if(get_option('openattribute_buttonset')==1){
			    		
			    			$output .= '<div onclick="attribute_button(event)" style="float:left; position:relative; display:inline; cursor:pointer;cursor:hand"><img src="' . WP_PLUGIN_URL . '/' . '/openattribute_posts/' . 'attrib_button.png" /></DIV>';
			    		
			    		}		    		
			
						$license_data .= get_option('openattribute_pre_license_html');
			
						$license_data .= '<span xmlns:dct="http://purl.org/dc/terms/" property="dct:title"><a href="' . $post->guid . '">' . the_title( '', '', 0 ) . '</a> / <a href="' . home_url() . '">' . get_bloginfo( "name" ) . '</a></span>';
		      			$license_data .= ' by <a xmlns:cc="http://creativecommons.org/ns#" href="' . $site_attribution_url . '" property="cc:attributionName" rel="cc:attributionURL" >' . $author . '</a>';
		      			$license_data .= ' is licensed under a <a rel="license" href="' . $site_license_url . '">' . $site_license . '</a>';
		    			$license_data .= get_option('openattribute_post_license_html');
		    		
		    			$output .= $license_data;
		    			
		    		}
		
				}
			
			}
		
		}
	
	}
	
	return get_option('openattribute_pre_license_html') . $output . get_option('openattribute_post_license_html');

}

function openattribute_add_license_footer($content){

	global $wp_query,$post;
	
	if(is_single()){

		if(get_option('openattribute_append_footer')==1){
	
			$disable = get_post_meta($wp_query->posts[0]->ID, 'disable_license');
			
			if($disable[0]=="off"||$disable[0]==""){
			
				$display = true;
			
				if(get_option('openattribute_blogoverride')==1){
				
					$content = $wp_query->posts[0]->post_content;
				
					$author = explode("oaauthor",$content);
					$title = explode("oatitle",$content);
					$oashorthand = explode("oashorthand",$content);	
					
					if(count($author)!=1){
					
						$display = false;
					
					}
					
					if(count($title)!=1){
					
						$display = false;
					
					}
					
					if(count($oashorthand)!=1){
					
						$display = false;
					
					}
					
				}
					
				if($display){
				
					get_option('openattribute_buttonset');
					$author = get_option('openattribute_site_author');		
					$site_license = get_option('openattribute_site_license');
					$site_attribution_url = get_option('openattribute_site_attribution_url');
					$licenses = get_option('openattribute_licenses');
					
					$data_licenses = explode("\n",$licenses);
					
					while($license = array_shift($data_licenses)){
					
						$pair = explode(",",$license);
						
						if(trim($pair[1])==trim($site_license)){
												
							$site_license_url = $pair[0];
						
						}
					
					}
					
					if(is_single()){
					
						if(get_option('openattribute_buttonset')==1){
			    		
			    			$output = '<div onclick="attribute_button(event)" style="display:inline; cursor:pointer;cursor:hand"><img src="' . WP_PLUGIN_URL . '/' . '/openattribute_posts/' . 'attrib_button.png" /></DIV>';
			    		
			    		}
			    		
						$license_data .= get_option('openattribute_pre_license_html');
			
						$license_data .= '<span xmlns:dct="http://purl.org/dc/terms/" property="dct:title"><a href="' . $post->guid . '">' . the_title( '', '', 0 ) . '</a> / <a href="' . home_url() . '">' . get_bloginfo( "name" ) . '</a></span>';
		      			$license_data .= ' by <a xmlns:cc="http://creativecommons.org/ns#" href="' . $site_attribution_url . '" property="cc:attributionName" rel="cc:attributionURL" >' . $author . '</a>';
		      			$license_data .= ' is licensed under a <a rel="license" href="' . $site_license_url . '">' . $site_license . '</a>';
		    			$license_data .= get_option('openattribute_post_license_html');
		    		
		    			$output .= $license_data;
		    			
		    			echo $output;
		    		
		    		}
		
				}
			
			}
		
		}
	
	}

}

function openattribute_add_license_header(){

	global $post;

	if(is_single()){

		if((get_option('openattribute_append_footer')==1)||(get_option('openattribute_append_content')==1)||(get_option('openattribute_widgetset')==1)){
	
			if($disable[0]==""){
			
				$disable = get_post_meta($_GET['page_id'], 'disable_license');
			
			}
			
			if($disable[0]=="off"||$disable[0]==""){
			
				$display = true;
					
				if($display){
					
					if((get_option('openattribute_buttonset')==1)||(get_option('openattribute_linkset')==1)||(get_option('openattribute_widgetset')==1)){
					
						$author = get_option('openattribute_site_author');		
						$site_license = get_option('openattribute_site_license');
						//$site_attribution_url = get_option('openattribute_site_attribution_url');
						$licenses = get_option('openattribute_licenses');
						
						$data_licenses = explode("\n",$licenses);
						
						while($license = array_pop($data_licenses)){
						
							$pair = explode(",",$license);
							
							if(trim($pair[1])==trim($site_license)){
													
								$site_license_url = $pair[0];
							
							}
						
						}
						
						if(is_single()){
						
							echo '<script type="text/javascript"> function attribute_button(event){ ';
							echo ' document.getElementById("openattribute_license_holder").style.position = "absolute";';
							echo ' document.getElementById("openattribute_license_holder").style.top = (document.documentElement.scrollTop+(event.clientY/2)) + "px";';
							echo ' document.getElementById("openattribute_license_holder").style.left = ((document.documentElement.clientWidth/2)-350) + "px";';			    			
							echo ' document.getElementById("openattribute_license_holder").style.zIndex = 2;';
							echo ' document.getElementById("openattribute_license_holder").style.display = "block";';
			    			echo ' }</script>';							    		
					
							$license_data = '<div id="openattribute_license_holder" style="float:left; border:3px solid #1F3350; width:850px; padding:20px; display:none;"><div style="float:left; position:relative;"><img src="' . WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__),"",plugin_basename(__FILE__)) . 'openAttrLogo.jpg" /><p style="margin:0px; padding:0px">HTML Text<br><textarea rows="5" cols="100" style="margin:0px; padding:0px;"><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title"><a href="' . $post->guid . '">' . the_title( '', '', 0 ) . '</a> / <a href="' . home_url() . '">' . get_bloginfo( "name" ) . '</a></span>';
				      		$license_data .= ' by <a xmlns:cc="http://creativecommons.org/ns#" href="' . $site_attribution_url . '" property="cc:attributionName" rel="cc:attributionURL" >' . $author . '</a>';
				      		$license_data .= ' is licensed under a <a rel="license" href="' . $site_license_url . '">' . $site_license . '</a></textarea></p>';
				      		
				      		$license_data .= '<p style="margin:0px; padding:0px">Plain text<br /><textarea rows="5" cols="100" style="float:left; position:relative; clear:left; left:0px;">' . the_title( '', '', 0 ) . ' by ' . $author . ' @ ' . $site_attribution_url . ' is licensed under a <a rel="license" href="' . $site_license_url . '">' . $site_license . '</a></textarea></p><p style="text-decoration:underline;cursor:hand;cursor:pointer; margin:0px; padding:0px;" onclick="this.parentNode.parentNode.style.display=\'none\';">Close</p></div></div>';
				    		
				    		echo $license_data;
			    		
			    		}
		    		
		    		}
		
				}
			
			}
		
		}
	
	}

}

function openattribute_rdf_ns(){

	if(get_option('openattribute_site_license')!=""){

		echo 'xmlns:cc="http://creativecommons.org/ns#" ';
	
	}

}

function openattribute_rdf_head(){

     if(get_option('openattribute_site_license')!=""){
     
     	echo '<cc:license rdf:resource="' . get_option('openattribute_site_license') . '" />';
     	
     }
} 

function openattribute_rss2_head(){

     if(get_option('openattribute_site_license')!=""){
     
     	echo '<cc:license ';
     	
     	if($_GET['feed']=="rss"){
     	
     		echo ' xmlns:cc="http://creativecommons.org/ns#" ';
     	
     	}
     	
     	echo '>' . get_option('openattribute_site_license') . '</cc:license>';
     	echo '<dc:rights ';
     	
     	if($_GET['feed']=="rss"){
     	
     		echo ' xmlns:dc="http://purl.org/dc/elements/1.1/" ';
     		
     	}
     	
     	echo ' >' . get_option('openattribute_site_license') . '</dc:rights>';
     	
     }

}

function openattribute_atom_head() {

     if(get_option('openattribute_site_license')!=""){
     
     	echo '<link rel="license" type="text/html" href="' . get_option('openattribute_site_license') . '" />';
     	
     }

}

function openattribute_augment_feed($content) {
	
		if(get_option('openattribute_site_license')!=""){
		
			if(get_option('openattribute_blogoverride')==0){
			
				echo '<cc:license>' . get_option('openattribute_site_license') . '</cc:license>';
     			echo '<dc:rights>' . get_option('openattribute_site_license') . '</dc:rights>';
     	
     		}else{

				$display = true;
				
				$content = $wp_query->post->post_content;
			
				if(get_option('openattribute_blogoverride')==1){
				
					$author = explode("oaauthor",$content);
					$title = explode("oatitle",$content);
					$oashorthand = explode("oashorthand",$content);	
					
					if(count($author)!=1){
					
						$display = false;
					
					}
					
					if(count($title)!=1){
					
						$display = false;
					
					}
					
					if(count($oashorthand)!=1){
					
						$display = false;
					
					}
					
					if($display){
					
						$data=explode("oalicenseurl=\"",$content);
						
						if(count($data)!=1){
						
							$license = explode("\"",$data[0]);
							
							echo '<creativeCommons:license>' . $license[0] . '</creativeCommons:license>';
     						echo '<dc:rights>' . $license[0] . '</dc:rights>';
						
						}
					
					}
					
				}  		
     		
     		}     		
    		
		}else{
		
			$content = $wp_query->post->post_content;
			$display = true;
				
			$author = explode("oaauthor",$content);
			$title = explode("oatitle",$content);
			$oashorthand = explode("oashorthand",$content);	
					
			if(count($author)!=1){
					
				$display = false;
					
			}
					
			if(count($title)!=1){
					
				$display = false;
					
			}
					
			if(count($oashorthand)!=1){
					
				$display = false;
					
			}
					
			if($display){
					
				$data=explode("oalicenseurl=\"",$content);
						
				if(count($data)!=1){
						
					$license = explode("\"",$data[0]);
							
					echo '<creativeCommons:license>' . $license[0] . '</creativeCommons:license>';
     				echo '<dc:rights>' . $license[0] . '</dc:rights>';
						
				}
					
			}
		
		}
	
	}
	
	function openattribute_stylesheet(){
	
		echo '<link rel="stylesheet" href="' . WP_PLUGIN_URL . '/openattribute_posts/' . 'openattribute_popup.css" type="text/css" media="screen,projection" /> ';	
	
	}
	
	function openattribute_widget(){

		register_widget('OpenAttributeWidget');
	
	}

// Modifications to feeds
;
add_action('rss_head', 'openattribute_rss2_head');
add_action('rss2_head', 'openattribute_rss2_head');
add_action('atom_head', 'openattribute_atom_head');
add_action('rss2_ns', 'openattribute_rdf_ns');
add_action('rdf_ns', 'openattribute_rdf_ns');
add_action('rdf_header', 'openattribute_rdf_head');
add_action("atom_entry","openattribute_augment_feed");
add_action("rdf_item","openattribute_augment_feed");
add_action("rss2_item","openattribute_augment_feed");
add_action("rss_item","openattribute_augment_feed");

// Admin options on wp-admin side of things

add_action('admin_init', 'openattribute_register' );
add_action('admin_menu', 'openattribute_menu_option');
add_action('admin_head', 'openattribute_postform');
add_action('admin_notices', 'openattribute_firstrun');

// Code for the insert into blog function for non-site licenses.

add_filter('media_buttons_context', 'openattribute_button');
add_filter('media_upload_openattribute', 'add_openattribute_action');

// Code to handle blog specific licensing

add_action("add_meta_boxes", "openattribute_add_disable_menu" );
add_action('save_post', 'openattribute_save_post');

// Code to display site licenses

add_action("the_content", 'openattribute_add_license_content');
add_action('get_footer', 'openattribute_add_license_footer');
add_action('loop_start', 'openattribute_add_license_header');

// Load pop up for style sheet

add_action('wp_head', 'openattribute_stylesheet');

// Load the Widget code

include "openattribute_widget.php";

// Widget register

add_action('widgets_init', 'openattribute_widget');


?>