<?php
/**
 * Handles registering and rendering of Gridly_Widget
 * 
 * @package Gridly
 */

namespace Gridly\Widgets;

use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Gridly\Traits\Helpers;
use Gridly\Traits\Templates;

defined( 'ABSPATH' ) || exit;

/**
 * Gridly_Widget class
 */
class Gridly_Widget extends Widget_Base {

    /**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'gridly';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Gridly', 'gridly' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'gridly' );
	}

	/**
	 * Gridly help URL
	 *
	 * @return string $url
	 */
	public function get_custom_help_url() {
        return 'https://www.xoxodev.com/gridly';
    }

	/**
	 * Register Gridly widget controls.
	 */
	protected function _register_controls() {

		// Main Query Controls.
		$this->start_controls_section(
			'gridly_content_section',
			array(
				'label' => __( 'Main Query', 'gridly' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'gridly_post_type',
			array(
				'label'   => __( 'Post Type', 'gridly' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post',
				'options' => Helpers::get_all_post_types(),
			)
		);

		$taxonomies = get_taxonomies( array(), 'objects' );

		foreach ( $taxonomies as $taxonomy => $object ) {
            if ( ! isset( $object->object_type[0] )  || ! in_array( $object->object_type[0], array_keys( Helpers::get_all_post_types() ) ) ) {
                continue;
            }

			$taxonomy_options = wp_list_pluck( get_terms( $taxonomy ), 'name', 'term_id' );

            $this->add_control(
                $taxonomy . '_ids',
                array(
                    'label'       => __( $object->label, 'gridly' ),
                    'type'        => Controls_Manager::SELECT2,
                    'multiple'    => true,
                    'object_type' => $taxonomy,
                    'options'     => $taxonomy_options,
                    'condition'   => array(
                        'gridly_post_type' => $object->object_type,
					),
				)
            );
        }

		$this->add_control(
            'gridly_post_authors', 
			array(
                'label'    => __( 'Author', 'gridly' ),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'default'  => array(),
                'options'  => Helpers::get_authors(),
			)
        );

		$this->add_control(
            'gridly_post_orderby', 
			array(
                'label'   => __( 'Order By', 'gridly' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => Helpers::get_orderby_filter(),
			)
        );
		
		$this->add_control(
            'gridly_post_order', 
			array(
                'label'   => __( 'Order', 'gridly' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => array(
					'asc'  => __( 'Ascending', 'gridly' ),
					'desc' => __( 'Descending', 'gridly' ),
				),
			)
        );

		$this->add_control(
            'gridly_posts_per_page', 
			array(
                'label'   => __( 'Posts Per Page', 'gridly' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3,
				'min'     => 1,
				'max'     => 150   
			)
        );

		$this->end_controls_section();

		// Style Controls.
		$this->start_controls_section(
			'gridly_style_section',
			array(
				'label' => __( 'Layouts', 'gridly' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
            'gridly_post_layout', 
			array(
                'label'       => __( 'Gridly Layout', 'gridly' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'grid',
                'options'     => array(
					'grid'      => __( 'Smart Grid', 'gridly' ),
					'flipper'   => __( '3D Smart Grid', 'gridly' ),
					'smartcard' => __( 'Smart Card', 'gridly' ),
					'appcard'   => __( 'App Card', 'gridly' ),
				),
			)
        );

		$this->add_control(
            'gridly_post_columns', 
			array(
                'label'       => __( 'Columns Per Row', 'gridly' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 3,
                'options'     => array(
					4 => __( 'Two', 'gridly' ),
					3 => __( 'Three', 'gridly' ),
					2 => __( 'Four', 'gridly' ),
				),
				'selectors'   => array(
					'{{WRAPPER}} .gridly-grids .grid' => 'width: {{VALUE}}1%;',
					'{{WRAPPER}} .gridly-grids .gridly-app-card' => 'width: {{VALUE}}50px; height: {{VALUE}}50px;',
				),
			)
        );

		$this->add_control(
            'gridly_post_title_toggle', 
			array(
                'label'        => __( 'Show Title?', 'gridly' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'gridly' ),
				'label_off'    => __( 'No', 'gridly' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
        );

		$this->add_control(
            'gridly_post_title_length', 
			array(
                'label'   => __( 'Title Length', 'gridly' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3,
				'condition' => array(
					'gridly_post_title_toggle' => 'yes',
				),
			)
        );

		$this->add_control(
            'gridly_post_image_toggle', 
			array(
                'label'        => __( 'Show Image?', 'gridly' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'gridly' ),
				'label_off'    => __( 'No', 'gridly' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
        );

		$this->add_control(
            'gridly_post_excerpt_toggle', 
			array(
                'label'        => __( 'Show Excerpt?', 'gridly' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'gridly' ),
				'label_off'    => __( 'No', 'gridly' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'     => array(
					'gridly_post_layout!' => 'appcard',
				),
			)
        );

		$this->add_control(
            'gridly_post_excerpt_length', 
			array(
                'label'   => __( 'Excerpt Length', 'gridly' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 20,
				'condition' => array(
					'gridly_post_excerpt_toggle' => 'yes',
					'gridly_post_layout!' => 'appcard',
				),
			)
        );

		$this->add_control(
            'gridly_post_pagination_toggle', 
			array(
                'label'        => __( 'Show Pagination?', 'gridly' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'gridly' ),
				'label_off'    => __( 'No', 'gridly' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
        );

		$this->end_controls_section();

	}

	/**
	 * Render Gridly widget on the frontend.
	 */
	protected function render() {

		$settings = $this->get_settings();

		Templates::render( $settings );		

	}
}