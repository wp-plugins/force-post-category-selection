<?php
/*
Plugin Name: Force Post Category Selection
Plugin URI: http://appinstore.com
Description: Forces user to assign a category to a post before publishing 
Author: Jatinder Pal Singh
Version: 0.1
Author URI: http://appinstore.com/
*/ 
function force_post_cat_init() 
{
  wp_enqueue_script('jquery');
}
function force_post_cat() 
{
  echo "<script type='text/javascript'>\n";
  echo "
  jQuery('#publish').click(function() 
  {
   	var cats = jQuery('[id^=\"taxonomy\"]')
      .find('.selectit')
      .find('input');
    category_selected=false;
    for (counter=0; counter<cats.length; counter++) 
	{
        if (cats.get(counter).checked==true) 
		{
        	category_selected=true;
	        break;
    	}
    }
    if(category_selected==false) 
	{
      alert('You have not selected any category for the post. Kindly select post category.');
      setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
      jQuery('[id^=\"taxonomy\"]').find('.tabs-panel').css('background', '#F96');
      setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
      return false;
    }
  });
  ";
   echo "</script>\n";
}
add_action('admin_init', 'force_post_cat_init');
add_action('edit_form_advanced', 'force_post_cat');
?>