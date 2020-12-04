<?php
/**
 * Plugin Name: Whitepaper
 * Plugin URI: 
 * Description: Migration plugin.
 * Version: 1.0
 * Author: Harish
 * Author URI: 
 * */

define('WHITEPAPAER_PLUGIN_PATH', dirname(__FILE__));

/**
 * Contains action method for Whitepapaer.
 */
class Whitepapaer {

	/**
	 * The unique instance of the plugin.
	 *
	 * @var instance
	 */
	private static $instance;
	

	/**
	 * Gets an instance of our plugin.
	 *
	 * @return Whitepapaer
	 */
	public static function get_instance() {
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Define the core functionality of the plugin.
	 */
	public function __construct() {
		add_action('init', array($this, 'create_custom_taxonomies'));
		add_action('init', array($this, 'my_custom_post_whitepaper'));
	}
	/**
	 * Function to register the taxonomies.
	 */
	public function create_custom_taxonomies() {
		$taxonomies = array(
			array('slug' => 'brand','single_name' => 'Brand','plural_name' => 'Brands'),
			array('slug' => 'publisher','single_name' => 'Publisher','plural_name' => 'Publishers',
			)
		);
		foreach ($taxonomies as $taxonomy) {
			$labels = array(
				'name' => _x($taxonomy['plural_name'], 'taxonomy general name'),
				'singular_name' => _x($taxonomy['single_name'], 'taxonomy singular name'),
				'search_items' => __('Search ' . $taxonomy['single_name']),
				'popular_items' => __('Popular ' . $taxonomy['plural_name']),
				'all_items' => __('All ' . $taxonomy['plural_name']),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __('Edit ' . $taxonomy['single_name']),
				'update_item' => __('Update ' . $taxonomy['single_name']),
				'add_new_item' => __('Add New ' . $taxonomy['single_name']),
				'new_item_name' => __('New ' . $taxonomy['single_name'] . ' Name'),
				'separate_items_with_commas' => __('Separate ' . $taxonomy['single_name'] . ' with commas'),
				'add_or_remove_items' => __('Add or remove ' . $taxonomy['single_name']),
				'choose_from_most_used' => __('Choose from the most used ' . $taxonomy['single_name']),
				'menu_name' => __($taxonomy['plural_name']),
			);
			register_taxonomy(
				$taxonomy['plural_name'], 'post', array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'show_admin_column' => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var' => true,
				'rewrite' => array('slug' => 'topic'),
				)
			);
		}
	}
	/**
	 * Function to register custom post for whitepaper.
	 */
	function my_custom_post_whitepaper() {
		$labels = array(
			'name' => _x('Whitepaper', 'post type general name'),
			'singular_name' => _x('Whitepaper', 'post type singular name'),
			'add_new' => _x('Add New', 'book'),
			'add_new_item' => __('Add New Whitepaper'),
			'edit_item' => __('Edit Whitepaper'),
			'new_item' => __('New Whitepaper'),
			'all_items' => __('All Whitepaper'),
			'view_item' => __('View Whitepaper'),
			'search_items' => __('Search Whitepaper'),
			'not_found' => __('No Whitepaper found'),
			'not_found_in_trash' => __('No Whitepaper found in the Trash'),
			'parent_item_colon' => '',
			'menu_name' => 'Whitepaper'
		);
		$args = array(
			'labels' => $labels,
			'description' => 'Holds our Whitepapers and Whitepaper specific data',
			'public' => true,
			'menu_position' => 5,
			//'show_in_rest' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
			'taxonomies' => array('category','Brands'),
			'has_archive' => true,
		);
		register_post_type('Whitepaper', $args);
	}
}
Whitepapaer::get_instance();
