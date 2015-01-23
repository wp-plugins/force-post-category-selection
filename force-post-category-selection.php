<?php
/*
Plugin Name: Force Post Category Selection
Description: Forces user to assign a category to a post before publishing 
Contributors: j_p_s
Author: Jatinder Pal Singh
Author URI: http://www.jpsays.com
Tags: post, category, publish, without, require, force, must, draft
Requires at least: 3.x
Tested up to: 4.1
Stable tag: 1.0
Version: 1.0
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