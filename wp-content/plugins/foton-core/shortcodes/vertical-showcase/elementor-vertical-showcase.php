<?php

class ElementorVerticalShowcase extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_vertical_showcase';
	}
	
	public function get_title() {
		return esc_html__( 'Vertical Showcase', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-vertical-showcase';
	}
	
	public function get_categories() {
		return [ 'mikado' ];
	}
	
	protected function _register_controls() {
		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'foton-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'contact_form_title',
			[
				'label' => esc_html__( 'Contact Form Title', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'contact_form_subtitle',
			[
				'label' => esc_html__( 'Contact Form Subtitle', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'contact_form',
			[
				'label'   => esc_html__( 'Select Contact Form 7', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $this->setParams()
			]
		);
		
		$this->add_control(
			'bg_text',
			[
				'label'   => esc_html__( 'Background Text', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'enable_phone_frame',
			[
				'label'   => esc_html__( 'Enable Phone Frame', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false, true ),
				'default' => 'yes'
			]
		);
		
		$this->add_control(
			'enable_app_store_link',
			[
				'label'   => esc_html__( 'Enable App Store Link', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false )
			]
		);
		
		$this->add_control(
			'app_store_link',
			[
				'label'     => esc_html__( 'Link Address', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'enable_app_store_link' => array( 'yes' )
				],
			]
		);
		
		$this->add_control(
			'enable_play_store_link',
			[
				'label'   => esc_html__( 'Enable Google Play Store Link', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_yes_no_select_array( false )
			]
		);
		
		$this->add_control(
			'play_store_link',
			[
				'label'     => esc_html__( 'Link Address', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'enable_play_store_link' => array( 'yes' )
				],
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'icon_image',
			[
				'label'   => esc_html__( 'Icon Image', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
			]
		);
		
		$repeater->add_control(
			'slide_text',
			[
				'label'     => esc_html__( 'Text beside number', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$repeater->add_control(
			'title',
			[
				'label'     => esc_html__( 'Slide Title', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$repeater->add_control(
			'subtitle',
			[
				'label'     => esc_html__( 'Slide Subtitle', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$repeater->add_control(
			'image',
			[
				'label'   => esc_html__( 'Image', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
			]
		);
		
		$this->add_control(
			'link_items',
			[
				'label'       => esc_html__( 'Link Items', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => esc_html__( 'Link Item' ),
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		if ( ! empty( $params['parallax_image'] ) ) {
			$params['parallax_image'] = $params['parallax_image']['id'];
		}
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		
		$params['elementor'] = 'yes';
		
		echo foton_core_get_shortcode_module_template_part( 'templates/vertical-showcase', 'vertical-showcase', '', $params );
	}
	
	protected function setParams() {
		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
		
		$contact_forms = array();
		if ( $cf7 ) {
			foreach ( $cf7 as $cform ) {
				$contact_forms[ $cform->ID ] = $cform->post_title;
			}
		} else {
			$contact_forms[0] = esc_html__( 'No contact forms found', 'foton' );
		}
		
		$formatted_cf_array = array();
		
		if ( is_array( $contact_forms ) && count( $contact_forms ) ) {
			foreach ( $contact_forms as $key => $value ) {
				$formatted_cf_array[ $key ] = $value;
			}
		}
		
		return $formatted_cf_array;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = $params['enable_phone_frame'] == "no" ? 'mkdf-vs-no-frame' : '';
		
		return implode( ' ', $holderClasses );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorVerticalShowcase() );