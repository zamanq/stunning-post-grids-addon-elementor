<?php
/**
 * Handles registering and rendering of SPGA_Widget
 * 
 * @package SPGA Elementor
 */

namespace SPGA_Elementor\Widgets;

use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use SPGA_Elementor\Traits\Helpers;
use SPGA_Elementor\Traits\Templates;

defined( 'ABSPATH' ) || exit;

/**
 * SPGA_Widget class
 */
class SPGA_Widget extends Widget_Base {

    /**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'spga-elementor';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'SPGA Grid', 'spga-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-apps';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'spga-elementor' );
	}

	/**
	 * Register SPGA widget controls.
	 */
	protected function _register_controls() {

		// Main Query Controls.
		$this->start_controls_section(
			'spga_content_section',
			array(
				'label' => __( 'Main Query', 'spga-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'spga_post_type',
			array(
				'label'   => __( 'Post Type', 'spga-elementor' ),
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
                    'label'       => __( $object->label, 'spga-elementor' ),
                    'type'        => Controls_Manager::SELECT2,
                    'multiple'    => true,
                    'object_type' => $taxonomy,
                    'options'     => $taxonomy_options,
                    'condition'   => array(
                        'spga_post_type' => $object->object_type,
					),
				)
            );
        }

		$this->add_control(
            'spga_post_authors', 
			array(
                'label'    => __( 'Author', 'spga-elementor' ),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'default'  => array(),
                'options'  => Helpers::get_authors(),
			)
        );

		$this->add_control(
            'spga_post_orderby', 
			array(
                'label'   => __( 'Order By', 'spga-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => Helpers::get_orderby_filter(),
			)
        );
		
		$this->add_control(
            'spga_post_order', 
			array(
                'label'   => __( 'Order', 'spga-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => array(
					'asc'  => __( 'Ascending', 'spga-elementor' ),
					'desc' => __( 'Descending', 'spga-elementor' ),
				),
			)
        );

		$this->add_control(
            'spga_posts_per_page', 
			array(
                'label'   => __( 'Posts Per Page', 'spga-elementor' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
				'min'     => 1,
				'max'     => 150
			)
        );

		$this->end_controls_section();

		// Style Controls.
		$this->start_controls_section(
			'spga_style_section',
			array(
				'label' => __( 'Layouts', 'spga-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
            'spga_post_layout', 
			array(
                'label'   => __( 'Layout', 'spga-elementor' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => array(
					'grid'      => __( 'Smart Grid', 'spga-elementor' ),
					'flipper'   => __( '3D Smart Grid', 'spga-elementor' ),
					'smartcard' => __( 'Smart Card', 'spga-elementor' ),
				),
			)
        );

		$this->add_control(
            'spga_post_columns', 
			array(
                'label'     => __( 'Columns Per Row', 'spga-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 3,
                'options'   => array(
					4 => __( 'Two', 'spga-elementor' ),
					3 => __( 'Three', 'spga-elementor' ),
					2 => __( 'Four', 'spga-elementor' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .spga-grids .grid' => 'width: {{VALUE}}1%;',
					'(desktop){{WRAPPER}} .spga-grids .spga-flipper' => 'width: {{VALUE}}1%;',
					'(tablet){{WRAPPER}} .spga-grids .spga-flipper' => 'width: 45%;',
					'(mobile){{WRAPPER}} .spga-grids .spga-flipper' => 'width: 100%;',
				),
				'condition' => array(
					'spga_post_layout!' => 'smartcard'
				),
			)
        );

		$this->add_control(
            'spga_post_columns_smartcard', 
			array(
                'label'     => __( 'Columns Per Row', 'spga-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 4,
                'options'   => array(
					2 => __( 'Two', 'spga-elementor' ),
					3 => __( 'Three', 'spga-elementor' ),
					4 => __( 'Four', 'spga-elementor' ),
				),
				'selectors' => array(
					'(desktop){{WRAPPER}} .smart-card-wrapper' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
					'(tablet){{WRAPPER}} .smart-card-wrapper' => 'grid-template-columns: repeat(2, 1fr);',
					'(mobile){{WRAPPER}} .smart-card-wrapper' => 'grid-template-columns: repeat(1, 1fr);',
				),
				'condition' => array(
					'spga_post_layout' => 'smartcard'
				),
			)
        );

		$this->add_control(
            'spga_post_columns_gap', 
			array(
                'label'     => __( 'Columns Gap', 'spga-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 15,
				'selectors' => array(
					'{{WRAPPER}} .spga-grids .spga-flipper' => 'margin: {{VALUE}}px;',
					'{{WRAPPER}} .spga-grids .grid' => 'margin-right: {{VALUE}}px; margin-bottom: {{VALUE}}px;',
					'{{WRAPPER}} .smart-card-wrapper' => 'grid-gap: {{VALUE}}px;',
				),
			)
        );

		$this->add_control(
            'spga_post_columns_border_radius', 
			array(
                'label'     => __( 'Border Radius', 'spga-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 15,
				'selectors' => array(
					'{{WRAPPER}} .spga-grids .grid' => 'border-radius: {{VALUE}}px;',
					'{{WRAPPER}} .spga-grids .spga-flipper .container .front' => 'border-radius: {{VALUE}}px;',
					'{{WRAPPER}} .spga-grids .spga-flipper .container .front::after' => 'border-radius: {{VALUE}}px;',
					'{{WRAPPER}} .spga-grids .spga-flipper .container .back' => 'border-radius: {{VALUE}}px;',
					'{{WRAPPER}} .smart-card-wrapper .spga-smart-card' => 'border-radius: {{VALUE}}px;',
				),
			)
        );

		$this->add_control(
			'spga_post_content_align',
			array(
				'label'     => __( 'Content Alignment', 'spga-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'spga-elementor' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'spga-elementor' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'spga-elementor' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'default'   => 'center',
				'toggle'    => true,
				'condition' => array(
					'spga_post_layout' => 'grid',
				),
				'selectors' => array(
					'{{WRAPPER}} .spga-grids .grid .grid-info' => 'text-align: {{VALUE}}',
				),
			)
		);

		$this->add_control(
            'spga_post_readmore', 
			array(
                'label'       => __( 'Read More Text', 'spga-elementor' ),
                'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Read More', 'spga-elementor' ),
				'placeholder' => __( 'Add read more text', 'spga-elementor' ),
				'condition'   => array(
					'spga_post_layout' => array( 'flipper', 'smartcard' ),
				),
			)
        );

		$this->add_control(
            'spga_post_taxonomy_toggle', 
			array(
                'label'        => __( 'Show Taxonomy?', 'spga-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'spga-elementor' ),
				'label_off'    => __( 'No', 'spga-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'spga_post_layout' => 'grid',
				),
			)
        );

		$this->add_control(
            'spga_post_author_toggle', 
			array(
                'label'        => __( 'Show Author?', 'spga-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'spga-elementor' ),
				'label_off'    => __( 'No', 'spga-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'spga_post_layout' => 'grid',
				),
			)
        );

		$this->add_control(
            'spga_post_title_toggle', 
			array(
                'label'        => __( 'Show Title?', 'spga-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'spga-elementor' ),
				'label_off'    => __( 'No', 'spga-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
        );

		$this->add_control(
            'spga_post_title_length', 
			array(
                'label'     => __( 'Title Length', 'spga-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 3,
				'condition' => array(
					'spga_post_title_toggle' => 'yes',
				),
			)
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'spga_post_title_typography',
				'label'     => __( 'Title Typography', 'spga-elementor' ),
				'selector'  => '{{WRAPPER}} .smart-card-wrapper .spga-smart-card .title, {{WRAPPER}} .spga-grids .grid .grid-info .grid-title, {{WRAPPER}} .spga-grids .spga-flipper .container .front .inner .title',
				'condition' => array(
					'spga_post_title_toggle' => 'yes',
				),
			)
		);

		$this->add_control(
            'spga_post_image_toggle', 
			array(
                'label'        => __( 'Show Image?', 'spga-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'spga-elementor' ),
				'label_off'    => __( 'No', 'spga-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
        );

		$this->add_control(
            'spga_post_date_toggle', 
			array(
                'label'        => __( 'Show Date?', 'spga-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'spga-elementor' ),
				'label_off'    => __( 'No', 'spga-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'spga_post_layout' => 'flipper',
				)
			)
        );

		$this->add_control(
            'spga_post_excerpt_toggle', 
			array(
                'label'        => __( 'Show Excerpt?', 'spga-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'spga-elementor' ),
				'label_off'    => __( 'No', 'spga-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'spga_post_layout!' => 'flipper',
				),
			)
        );

		$this->add_control(
            'spga_post_excerpt_length', 
			array(
                'label'     => __( 'Excerpt Length', 'spga-elementor' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 20,
				'condition' => array(
					'spga_post_excerpt_toggle' => 'yes',
					'spga_post_layout!' => 'flipper',
				),
			)
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'spga_post_excerpt_typography',
				'label'     => __( 'Excerpt Typography', 'spga-elementor' ),
				'selector'  => '{{WRAPPER}} .smart-card-wrapper .spga-smart-card .copy, {{WRAPPER}} .spga-grids .grid .grid-info .grid-excerpt',
				'condition' => array(
					'spga_post_excerpt_toggle' => 'yes',
					'spga_post_layout!' => 'flipper',
				),
			)
		);

		$this->add_control(
            'spga_post_pagination_toggle', 
			array(
                'label'        => __( 'Show Pagination?', 'spga-elementor' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'spga-elementor' ),
				'label_off'    => __( 'No', 'spga-elementor' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
        );

		$this->end_controls_section();

		// Colors section.
		$this->start_controls_section(
			'spga_color_section',
			array(
				'label' => __( 'Colors', 'spga-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'spga_title_color',
			array(
				'label'     => __( 'Title Color', 'spga-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'spga_post_title_toggle' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .smart-card-wrapper .spga-smart-card .title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .spga-grids .grid .grid-info .grid-title a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .spga-grids .spga-flipper .container .front .inner .title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'spga_excerpt_color',
			array(
				'label'     => __( 'Excerpt Color', 'spga-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'spga_post_excerpt_toggle' => 'yes',
					'spga_post_layout' => array( 'grid', 'smartcard' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .smart-card-wrapper .spga-smart-card .copy' => 'color: {{VALUE}}',
					'{{WRAPPER}} .spga-grids .grid .grid-info .grid-excerpt' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'spga_reading_time_color',
			array(
				'label'     => __( 'Reading Time Color', 'spga-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'spga_post_layout' => 'grid',
				),
				'selectors' => array(
					'{{WRAPPER}} .spga-grids .grid .grid-info-hover .grid-clock-info .grid-clock' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .spga-grids .grid .grid-info-hover .grid-clock-info .grid-time' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'spga_pagination_color',
			array(
				'label'     => __( 'Pagination Color', 'spga-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#302c2c',
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'spga_post_pagination_toggle' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .spga-pagination .page-numbers' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'spga_pagination_current_color',
			array(
				'label'     => __( 'Pagination Current Page Color', 'spga-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'spga_post_pagination_toggle' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .spga-pagination .current' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'spga_pagination_current_bg_color',
			array(
				'label'     => __( 'Pagination Current Page BG Color', 'spga-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2165e4',
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'spga_post_pagination_toggle' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .spga-pagination .current' => 'background: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'spga_post_date_color',
			array(
				'label'     => __( 'Date Color', 'spga-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'scheme'    => array(
					'type'  => Color::get_type(),
					'value' => Color::COLOR_1,
				),
				'condition' => array(
					'spga_post_layout' => 'flipper',
					'spga_post_date_toggle' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .spga-grids .spga-flipper .container .front .inner .date' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render SPGA widget on the frontend.
	 */
	protected function render() {

		$settings = apply_filters( 'spga_settings_args', $this->get_settings() );

		Templates::render( $settings );

	}
}