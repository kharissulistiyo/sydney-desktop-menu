<?php
/**
 * Sydney Desktop Menu
 *
 * @package     Sydney Desktop Menu
 * @author      kharisblank
 * @copyright   2020 kharisblank
 * @license     GPL-2.0+
 *
 * @sy-desktop-menu
 * Plugin Name: Sydney Desktop Menu
 * Plugin URI:  https://easyfixwp.com/
 * Description: This plugin enables Sydney WordPress theme's desktop menu style on smaller screen. Made specifically for Sydney theme.
 * Version:     0.0.6
 * Author:      kharisblank
 * Author URI:  https://easyfixwp.com
 * Text Domain: sy-desktop-menu
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 */

// Disallow direct access to file
defined( 'ABSPATH' ) or die( __('Not Authorized!', 'sy-desktop-menu') );

define( 'SY_DESKTOP_MENU_FILE', __FILE__ );
define( 'SY_DESKTOP_MENU_URL', plugins_url( null, SY_DESKTOP_MENU_FILE ) );

if ( !class_exists('SY_Desktop_Menu') ) :
  class SY_Desktop_Menu {

    public function __construct() {

      add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts'), 9999 );

    }

    /**
     * Check whether Sydney theme is active or not
     * @return boolean true if either Sydney or Sydney Pro is active
     */
    function is_sydney_active() {

      $theme  = wp_get_theme();
      $parent = wp_get_theme()->parent();

      if ( ($theme != 'Sydney' ) && ($theme != 'Sydney Pro' ) && ($parent != 'Sydney') && ($parent != 'Sydney Pro') ) {
        return false;
      }

      return true;

    }

    function main_navigation() {
      ob_start();
      ?>
      <nav id="mainnav2" class="mainnavx" role="navigation">
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'sydney_menu_fallback' ) ); ?>
      </nav><!-- #site-navigation -->
      <?php
      $main_navigation = ob_get_contents(); ob_end_clean();
      return $main_navigation;
    }

    /**
     * Enqueue plugin scripts
     * @return void
     */
    function enqueue_scripts() {

      $main_nav = $this->main_navigation();

      if( false == $this->is_sydney_active() ) {
        $main_nav = 'not-exists';
      }

      $css_file = apply_filters('sydney_video_lightbox_button_css_file_url', SY_DESKTOP_MENU_URL . '/css/sy-desktop-menu-style.css');
      $js_file = apply_filters('sydney_video_lightbox_button_js_file_url', SY_DESKTOP_MENU_URL .'/js/sy-desktop-menu.js');

      wp_register_style( 'sy-desktop-menu-style', $css_file, array(), null );
      wp_register_script('sy-desktop-menu-script', $js_file, array ('jquery'), false, true);

      wp_localize_script( 'sy-desktop-menu-script', 'sy_main_nav', $main_nav );

      wp_enqueue_style( 'sy-desktop-menu-style' );
      wp_enqueue_script( 'sy-desktop-menu-script' );

    }



  }
endif;

new SY_Desktop_Menu;
