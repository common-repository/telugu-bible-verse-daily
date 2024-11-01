<?php 
  /*
   Plugin Name:  తెలుగు బైబిల్ వచనములు    
   Plugin URI:http://www.telugubibleonline.com/plugins/Telugu-Bible-Verse-display
   Description: Telugu Bible Verse Display lets you have a bible verse displayed in a widget, on a page, or in a post. మీ పేజీ లో గాని పోస్ట్ లో గాని తెలుగు బైబిల్ వచనము రావాలంటే ఈ ప్లగిన్ వాడండి .
   Version: 1.0
   Author: Zechariah
   Author URI: http://www.telugubibleonline.com

   Copyright 2013  Zechariah 
   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.
   
   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.
   
   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  */
// Start Telugu Verse display calss
if (!class_exists("TVDisplay")) {
  class TVDisplay {
     
    function TVDisplay() {
    
    }

    function activate() {
      // add options to database
      //add_option("tvd_post_version", '31');	
      add_option("tvd_post_type", 'fav');
      add_option("tvd_connection", 'fopen');
      //add_option("tvd_show_version", '1');
      add_option("tvd_favorites", 'కీర్తనలు:53:5|కీర్తనలు:1:1');
    }

    function deactivate() {
      // remove options from database
     // delete_option("tvd_post_version");	
      delete_option("tvd_post_type");
      delete_option("tvd_connection");
      //delete_option("tvd_show_version");
      delete_option("tvd_favorites");
    }

    function add_admin_page() {
      add_submenu_page('options-general.php', 'తెలుగు బైబిల్ వచనములు', 'తెలుగు బైబిల్ వచనములు', 10, __FILE__, array(&$this, 'admin_page'));
    } 

    function admin_page() {     
      // update settings
      if(isset($_POST['tvd_update'])) {

	// posted data
	$type = $_POST['tvd_post_type'];
	$cxn = $_POST['tvd_connection'];
	        
	// update data in database
	update_option("tvd_post_type", $type);	
	update_option("tvd_connection", $cxn);	
	
	
	// updated message
	echo "<div id=\"message\" class=\"updated fade\"><p><strong>Telugu Bible Verse Display options updated.</strong></p></div>";
      }

      // add new favorite
      else if(isset($_POST['tvd_add'])) {	
	$new = trim($_POST['tvd_new_fav']);

	if (!TVDisplay::isVerse($new)) {
	  echo "<div id=\"message\" class=\"updated fade\"><p><strong>Invalid verse format.</strong></p></div>";
	} else {
	  TVDisplay::updateFavorites($new);
	  echo "<div id=\"message\" class=\"updated fade\"><p><strong>Added $new to Favorites.</strong></p></div>";
	}
      }
      //add new favorite
      else if(isset($_POST['verse_add'])){
       $book = $_POST['books_id'];
       $chapter = $_POST['chapter'];
       $verse = $_POST['verse'];
       
	  TVDisplay::updateFavorites2($book,$chapter,$verse);
	  echo "<div id=\"message\" class=\"updated fade\"><p><strong>Added Verse to Favorites.</strong></p></div>";
	
      }

      // delete favorite
      else if (isset($_POST) && !empty($_POST)) {
	foreach ($_POST as $key => $val) {
	  if (preg_match('/^tvd_delete_([0-9]+)$/', $key, $matches)) {
	    TVDisplay::updateFavorites($matches[1]);
	    echo "<div id=\"message\" class=\"updated fade\"><p><strong>Removed item.</strong></p></div>";
	  }
	}
      }

      $favorites = explode('|', get_option('tvd_favorites', '')); 

      require_once('admin_page.php');
    }


function updateFavorites2($bk,$ch,$vr){
      $favorites = explode('|', get_option('tvd_favorites', ''));

      // delete action
      if (preg_match('/^[0-9]+$/', $str)) {
	unset($favorites[$str]);
	$str = '';
      }

      // add action
      else {
        $str = $bk.":".$ch.":".$vr;
	$str .= "|";
      }

      foreach ($favorites as $fav) $str .= "$fav|";
      $str = trim($str, '|');
      
      update_option("tvd_favorites", $str);
    }

   
    
    function updateFavorites($str) {
      $favorites = explode('|', get_option('tvd_favorites', ''));

      // delete action
      if (preg_match('/^[0-9]+$/', $str)) {
	unset($favorites[$str]);
	$str = '';
      }

      // add action
      else {
	$str .= "|";
      }

      foreach ($favorites as $fav) $str .= "$fav|";
      $str = trim($str, '|');
      
      update_option("tvd_favorites", $str);
    }

    //@@@ need better verse matching
    function isVerse($v) {
      return preg_match('/^[a-z0-9: -]+$/i', $v);
    }

    function widget_init() {
      if (!function_exists('register_sidebar_widget') || !function_exists('register_widget_control'))
	return;

      register_widget('TVDisplayWidget');
    }


    function add_js() {
      echo file_get_contents(ABSPATH.'wp-content/plugins/telugubibleversedisplay/functions.js');
    }

  }
}

class TVDisplayWidget extends WP_Widget {
  

  function TVDisplayWidget() {
    

    $widget_ops = array('classname' => 'tvd', 'description' => 'తెలుగు బైబిల్ వచనములు చూపు విడ్జెట్ ');
    $control_ops = array('id_base' => 'tvd-widget');

    $this->WP_Widget('tvd-widget', 'తెలుగు బైబిల్ వచనములు', $widget_ops, $control_ops);
  }

    function replace_shortcode($atts) {
      // set defaults
      extract(shortcode_atts(array('type'=> get_option('tvd_post_type'), 'class' => 'tvdshortcode'), $atts));

      return $this->get_verse($type, $class);
    }

  
  function fetch_url($url) {
    switch (get_option('tvd_connection')) {
    case "curl":
      if (function_exists("curl_init")) {
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);  
        curl_close($ch);
	return $output;
      }
      break;

    case "fopen": // falls through
    default:
      return ($fp = fopen($url, 'r')) ? stream_get_contents($fp) : false;
      break;
    }

    return false;
  }

  function get_verse($type, $class='tvdwidget') {
    switch($type) {
    case "fav":
      $favorites = explode('|', get_option('tvd_favorites', ''));
//      $lookup = urlencode($favorites[array_rand($favorites)]);
$lookup = $favorites[array_rand($favorites)];
      
      $keywords = preg_split("/[:]+/", "$lookup");
      $keywords[0]=urlencode($keywords[0]);
      $url = "http://www.telugubibleonline.com/telugubible/?book=$keywords[0]&chapter=$keywords[1]&verse=$keywords[2]";
      $verse = "";

      $content = $this->fetch_url($url); 
      if ($content != "") {
	// get verse in HTML off biblegateway.com
	if (preg_match('/<label>(.*?)<\/label>/', $content, $matches)){
	  $verse = $matches[1];
     	} else {
	  echo "Couldn't get ".urldecode($lookup)." ($url).";
	}

	if ($verse != "") {
	  // add scripture reference
	  $verse .= " &mdash; ".urldecode($lookup);

	  
	}
      } else {
	echo "No verse found.";
      }

      break;

    case "aa":
      
      $url = "https://www.telugubibleonline.com/dailyverse/feed/atom/";

      $content = $this->fetch_url($url); 
      if ($content != "") {
	$cnt1 = preg_match('/<title type="html"><\!\[CDATA\[(.*?)\]\]><\/title>/i', $content, $matches1);
	$cnt2 = preg_match('/<summary type="html"><\!\[CDATA\[(.*?)\]\]><\/summary>/', $content, $matches2);

	if ($cnt2 == 1) {
	  $verse = $matches2[1];
	  $verse .= " &mdash; ".$matches1[1];
	  
	  } else {
	  $verse = "Couldn't get Verse of the Day.";
	}
      } else {
	$verse = "No Verse of the Day found.";
      }

      break;

    default:
      $verse = "No verse found.";
      break;
    }

    return "<div class=\"$class\">$verse</div>";
  }

  function widget($args, $instance) {
    extract($args);

    $title = apply_filters('widget_title', $instance['title']);
    $type = $instance['type'];
    $showDate = $instance['showDate'];
    $dateFormat = $instance['dateFormat'];

    echo $before_widget;

    if ($showDate) {
      switch($dateFormat) {
      case 'y-m-d':
	$title = trim($title." ".date('Y-m-d', time()));
	break;
      case 'd/m/y':
	$title = trim($title." ".date('j/n/Y', time()));
	break;
      case 'd.m.y':
	$title = trim($title." ".date('d.m.Y', time()));
	break;
      case 'm/d/y':
	$title = trim($title." ".date('n/j/Y', time()));
	break;
      }
    }

    if ( $title )
      echo $before_title . $title . $after_title;

    if ( $type )
      echo "<p><strong style=\"line-height:1.5em;\">".TVDisplayWidget::get_verse($type)."</strong></p>";
      
    echo $after_widget;
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;

    $instance['title'] = strip_tags( $new_instance['title'] );
  
  
    $instance['type'] = $new_instance['type'];
    $instance['showDate'] = $new_instance['showDate'];
    $instance['dateFormat'] = $new_instance['dateFormat'];

    return $instance;
  }

  function form($instance) {

    $defaults = array( 'title' => 'Verse of the Day', 'type' => 'fav', 'showDate' =>'0', 'dateFormat' => 'y-m-d');
    $instance = wp_parse_args( (array) $instance, $defaults ); 

    include("widget_form.php");
  }
}

  // instantiate class
if (class_exists("TVDisplay")) {
  $tvdisplay = new TVDisplay();
}

if (class_exists("TVDisplay")) {
  $bvwidget = new TVDisplayWidget();
}

// actions/filters
if (isset($tvdisplay)) {
  // administrative options
  add_action('admin_menu', array(&$tvdisplay, 'add_admin_page'));  
  add_action("widgets_init", array(&$tvdisplay, 'widget_init'));

  // shortcodes for using in posts or pages
  
  add_shortcode('telugu-verse-display', array(&$bvwidget, 'replace_shortcode'));

  // activate/deactivate
  register_activation_hook(__FILE__, array(&$tvdisplay, 'activate'));
  register_deactivation_hook(__FILE__, array(&$tvdisplay, 'deactivate'));
}
?>