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
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
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
                'label'   => __( 'Gridly Layout', 'gridly' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => array(
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
                'label'     => __( 'Columns Per Row', 'gridly' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 3,
                'options'   => array(
					4 => __( 'Two', 'gridly' ),
					3 => __( 'Three', 'gridly' ),
					2 => __( 'Four', 'gridly' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .gridly-grids .grid' => 'width: {{VALUE}}1%;',
					'(desktop){{WRAPPER}} .gridly-grids .gridly-flipper' => 'width: {{VALUE}}1%;',
					'(tablet){{WRAPPER}} .gridly-grids .gridly-flipper' => 'width: 45%;',
					'(mobile){{WRAPPER}} .gridly-grids .gridly-flipper' => 'width: 100%;',
					'{{WRAPPER}} .gridly-grids .gridly-app-card' => 'width: {{VALUE}}50px; height: {{VALUE}}50px;',
				),
				'condition' => array(
					'gridly_post_layout!' => 'smartcard'
				),
			)
        );

		$this->add_control(
            'gridly_post_columns_smartcard', 
			array(
                'label'     => __( 'Columns Per Row', 'gridly' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 4,
                'options'   => array(
					2 => __( 'Two', 'gridly' ),
					3 => __( 'Three', 'gridly' ),
					4 => __( 'Four', 'gridly' ),
				),
				'selectors' => array(
					'(desktop){{WRAPPER}} .smart-card-wrapper' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
					'(tablet){{WRAPPER}} .smart-card-wrapper' => 'grid-template-columns: repeat(2, 1fr);',
					'(mobile){{WRAPPER}} .smart-card-wrapper' => 'grid-template-columns: repeat(1, 1fr);',
				),
				'condition' => array(
					'gridly_post_layout' => 'smartcard'
				),
			)
        );

		$this->add_control(
            'gridly_post_columns_gap', 
			array(
                'label'     => __( 'Columns Gap', 'gridly' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 6,
				'selectors' => array(
					'{{WRAPPER}} .gridly-grids .gridly-flipper' => 'margin: {{VALUE}}px;',
					'{{WRAPPER}} .gridly-grids .gridly-app-card' => 'margin: {{VALUE}}px;',
					'{{WRAPPER}} .gridly-grids .grid' => 'margin-right: {{VALUE}}px; margin-bottom: {{VALUE}}px;',
					'{{WRAPPER}} .smart-card-wrapper' => 'grid-gap: {{VALUE}}px;',
				),
			)
        );

		$this->add_control(
            'gridly_post_columns_border_radius', 
			array(
                'label'     => __( 'Border Radius', 'gridly' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 15,
				'selectors' => array(
					'{{WRAPPER}} .gridly-grids .grid' => 'border-radius: {{VALUE}}px;',
					'{{WRAPPER}} .gridly-grids .gridly-app-card' => 'border-radius: {{VALUE}}px;',
					'{{WRAPPER}} .gridly-grids .gridly-flipper .container .front' => 'border-radius: {{VALUE}}px;',
					'{{WRAPPER}} .gridly-grids .gridly-flipper .container .front::after' => 'border-radius: {{VALUE}}px;',
					'{{WRAPPER}} .gridly-grids .gridly-flipper .container .back' => 'border-radius: {{VALUE}}px;',
					'{{WRAPPER}} .gridly-grids .gridly-app-card .card-image' => 'border-radius: {{VALUE}}px;',
					'{{WRAPPER}} .gridly-grids .gridly-app-card .card-image a' => 'border-radius: {{VALUE}}px;',
					'{{WRAPPER}} .gridly-grids .gridly-app-card .card-image a img' => 'border-radius: {{VALUE}}px;',
					'{{WRAPPER}} .smart-card-wrapper .gridly-smart-card' => 'border-radius: {{VALUE}}px;',
				),
			)
        );

		$this->add_control(
			'gridly_post_content_align',
			array(
				'label'     => __( 'Content Alignment', 'gridly' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'gridly' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'gridly' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'gridly' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'default'   => 'center',
				'toggle'    => true,
				'condition' => array(
					'gridly_post_layout' => 'grid',
				),
				'selectors' => array(
					'{{WRAPPER}} .gridly-grids .grid .grid-info' => 'text-align: {{VALUE}}',
				),
			)
		);

		$this->add_control(
            'gridly_post_readmore', 
			array(
                'label'       => __( 'Read More Text', 'gridly' ),
                'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Read More', 'gridly' ),
				'placeholder' => __( 'Add read more text', 'gridly' ),
				'condition'   => array(
					'gridly_post_layout' => array( 'flipper', 'smartcard' ),
				),
			)
        );

		$this->add_control(
            'gridly_post_taxonomy_toggle', 
			array(
                'label'        => __( 'Show Taxonomy?', 'gridly' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'gridly' ),
				'label_off'    => __( 'No', 'gridly' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'gridly_post_layout' => 'grid',
				),
			)
        );

		$this->add_control(
            'gridly_post_author_toggle', 
			array(
                'label'        => __( 'Show Author?', 'gridly' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'gridly' ),
				'label_off'    => __( 'No', 'gridly' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'gridly_post_layout' => 'grid',
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
                'label'     => __( 'Title Length', 'gridly' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 3,
				'condition' => array(
					'gridly_post_title_toggle' => 'yes',
				),
			)
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'gridly_post_title_typography',
				'label'     => __( 'Title Typography', 'gridly' ),
				'selector'  => '{{WRAPPER}} .smart-card-wrapper .gridly-smart-card .title, {{WRAPPER}} .gridly-grids .gridly-app-card .card-title h3 a, {{WRAPPER}} .gridly-grids .grid .grid-info .grid-title, {{WRAPPER}} .gridly-grids .gridly-flipper .container .front .inner .title',
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
            'gridly_post_date_toggle', 
			array(
                'label'        => __( 'Show Date?', 'gridly' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'gridly' ),
				'label_off'    => __( 'No', 'gridly' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'gridly_post_layout' => 'flipper',
				)
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
				'condition'    => array(
					'gridly_post_layout!' => array( 'flipper', 'appcard' ),
				),
			)
        );

		$this->add_control(
            'gridly_post_excerpt_length', 
			array(
                'label'     => __( 'Excerpt Length', 'gridly' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 20,
				'condition' => array(
					'gridly_post_excerpt_toggle' => 'yes',
					'gridly_post_layout!' => array( 'flipper', 'appcard' ),
				),
			)
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'gridly_post_excerpt_typography',
				'label'     => __( 'Excerpt Typography', 'gridly' ),
				'selector'  => '{{WRAPPER}} .smart-card-wrapper .gridly-smart-card .copy, {{WRAPPER}} .gridly-grids .grid .grid-info .grid-excerpt',
				'condition' => array(
					'gridly_post_excerpt_toggle' => 'yes',
					'gridly_post_layout!' => array( 'flipper', 'appcard' ),
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

		// Colors section.
		$this->start_controls_section(
			'gridly_color_section',
			array(
				'label' => __( 'Colors', 'gridly' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'gridly_title_color',
			array(
				'label'     => __( 'Title Color', 'gridly' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'gridly_post_title_toggle' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .smart-card-wrapper .gridly-smart-card .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .gridly-grids .gridly-app-card .card-title h3 a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .gridly-grids .grid .grid-info .grid-title a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .gridly-grids .gridly-flipper .container .front .inner .title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'gridly_excerpt_color',
			array(
				'label'     => __( 'Excerpt Color', 'gridly' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'gridly_post_excerpt_toggle' => 'yes',
					'gridly_post_layout' => array( 'grid', 'smartcard' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .smart-card-wrapper .gridly-smart-card .copy' => 'color: {{VALUE}}',
					'{{WRAPPER}} .gridly-grids .grid .grid-info .grid-excerpt' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'gridly_reading_time_color',
			array(
				'label'     => __( 'Reading Time Color', 'gridly' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'gridly_post_layout' => 'grid',
				),
				'selectors' => array(
					'{{WRAPPER}} .gridly-grids .grid .grid-info-hover .grid-clock-info .grid-clock' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .gridly-grids .grid .grid-info-hover .grid-clock-info .grid-time' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'gridly_pagination_color',
			array(
				'label'     => __( 'Pagination Color', 'gridly' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#302c2c',
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'gridly_post_pagination_toggle' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .gridly-pagination .page-numbers' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'gridly_pagination_current_color',
			array(
				'label'     => __( 'Pagination Current Page Color', 'gridly' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'gridly_post_pagination_toggle' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .gridly-pagination .current' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'gridly_pagination_current_bg_color',
			array(
				'label'     => __( 'Pagination Current Page BG Color', 'gridly' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2165e4',
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'gridly_post_pagination_toggle' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .gridly-pagination .current' => 'background: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'gridly_post_date_color',
			array(
				'label'     => __( 'Date Color', 'gridly' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'gridly_post_layout' => 'flipper',
					'gridly_post_date_toggle' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .gridly-grids .gridly-flipper .container .front .inner .date' => 'color: {{VALUE}}',
				),
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