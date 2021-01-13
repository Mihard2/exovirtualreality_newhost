<?php

class ElementorComparisonPricingTableHolder extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_comparison_pricing_table_holder';
	}
	
	public function get_title() {
		return esc_html__( 'Comparison Pricing Table', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-comparison-pricing-table';
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
			'columns',
			[
				'label'   => esc_html__( 'Columns', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'mkdf-two-columns'   => esc_html__( 'Two', 'foton-core' ),
					'mkdf-three-columns' => esc_html__( 'Three', 'foton-core' )
				],
				'default' => 'mkdf-three-columns'
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'features',
			[
				'label'       => esc_html__( 'Features', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'Enter features. Separate each features with comma (,)', 'foton-core' )
			]
		);
		
		$this->add_control(
			'show_footer',
			[
				'label'   => esc_html__( 'Show Footer', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'yes' => esc_html__( 'Yes', 'foton-core' ),
					'no'  => esc_html__( 'No', 'foton-core' )
				],
				'default' => 'yes'
			]
		);
		
		$this->add_control(
			'footer_image',
			[
				'label'       => esc_html__( 'Footer Image', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( 'Select image from media library', 'foton-core' ),
				'condition'   => [
					'show_footer' => array( 'yes' )
				]
			]
		);
		
		$this->add_control(
			'footer_text',
			[
				'label'     => esc_html__( 'Footer Text', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_footer' => array( 'yes' )
				]
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		foton_mikado_icon_collections()->getElementorParamsArray( $repeater, '', '' );
		
		$repeater->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size (px)', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT
			]
		);
		
		$repeater->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR
			]
		);
		
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT
			]
		);
		
		$repeater->add_control(
			'show_button',
			[
				'label'   => esc_html__( 'Show Button', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'yes' => esc_html__( 'Yes', 'foton-core' ),
					'no'  => esc_html__( 'No', 'foton-core' )
				]
			]
		);
		
		$repeater->add_control(
			'button_text',
			[
				'label'     => esc_html__( 'Button Text', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_button' => array( 'yes' )
				],
			]
		);
		
		$repeater->add_control(
			'button_link',
			[
				'label'     => esc_html__( 'Button Link', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_button' => array( 'yes' )
				],
			]
		);
		
		$repeater->add_control(
			'content',
			[
				'label'   => esc_html__( 'Content', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::WYSIWYG,
				'default' => '<ul><li>' . esc_html__( 'content content content', 'foton-core' ) . '</li><li>' . esc_html__( 'content content content', 'foton-core' ) . '</li><li>' . esc_html__( 'content content content', 'foton-core' ) . '</li></ul>'
			]
		);
		
		$this->add_control(
			'comparision_pricing_item',
			[
				'label'       => esc_html__( 'Comparison Pricing Item', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => esc_html__( 'Client Item' ),
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args = array(
			'columns'      => 'mkdf-three-columns',
			'features'     => '',
			'title'        => '',
			'show_footer'  => 'yes',
			'footer_image' => '',
			'footer_text'  => '',
		);
		
		$params['features']       = $this->getFeaturesArray( $params );
		$params['holder_classes'] = $this->getHolderClasses( $params );
		
		if ( is_array( $params['features'] ) && count( $params['features'] ) ) : ?>
			<div <?php foton_mikado_class_attribute( $params['holder_classes'] ); ?>>
				<div class="mkdf-cpt-features-holder mkdf-cpt-table">
					<div class="mkdf-cpt-features-title-holder mkdf-cpt-table-head-holder">
						<div class="mkdf-cpt-table-head-holder-inner">
							<h4 class="mkdf-cpt-features-title"><?php echo wp_kses_post( preg_replace( '#^<\/p>|<p>$#', '', $params['title'] ) ); ?></h4>
						</div>
					</div>
					<div class="mkdf-cpt-features-list-holder mkdf-cpt-table-content">
						<ul class="mkdf-cpt-features-list">
							<?php foreach ( $params['features'] as $feature ) : ?>
								<li class="mkdf-cpt-features-item"><p><?php echo esc_html( $feature ); ?></p></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				
				<?php foreach ( $params['comparision_pricing_item'] as $cpi ) {
					
					$iconPackName = foton_mikado_icon_collections()->getIconCollectionParamNameByKey( $cpi['icon_pack'] );
					
					$cpi['icon']                     = $iconPackName ? $cpi[ $iconPackName ] : '';
					$cpi['icon_attributes']['style'] = $this->getIconStyles( $cpi );
					$cpi['table_classes']            = $this->getTableClasses( $cpi );
					$cpi['button_parameters']        = $this->getButtonParameters( $cpi );
					
					echo foton_core_get_shortcode_module_template_part( 'templates/elementor-cpt-item-template', 'comparison-pricing-table', '', $cpi );
				} ?>
				
				<?php if ( $params['show_footer'] == 'yes' ) { ?>
					<div class="mkdf-cpt-footer-holder">
						<div class="mkdf-cpt-image-holder">
							<?php echo wp_get_attachment_image( $params['footer_image']['id'], 'full' ); ?>
						</div>
						<span class="mkdf-cpt-text-holder">
							<?php echo esc_html( $params['footer_text'] ); ?>
                        </span>
					</div>
				<?php } ?>
			</div>
		<?php endif;
	}
	
	private function getFeaturesArray( $params ) {
		$features = array();
		
		if ( ! empty( $params['features'] ) ) {
			$features = explode( ',', $params['features'] );
		}
		
		return $features;
	}
	
	private function getHolderClasses( $params ) {
		$classes = array( 'mkdf-comparision-pricing-table-holder' );
		
		if ( $params['columns'] !== '' ) {
			$classes[] = $params['columns'];
		}
		
		return $classes;
	}
	
	private function getTableClasses( $cpi ) {
		$classes = array( 'mkdf-comparision-item-holder', 'mkdf-cpt-table' );
		
		return $classes;
	}
	
	private function getIconStyles( $cpi ) {
		$styles = array();
		
		if ( ! empty( $cpi['icon_color'] ) ) {
			$styles[] = 'color: ' . $cpi['icon_color'];
		}
		
		if ( ! empty( $cpi['icon_size'] ) ) {
			$styles[] = 'font-size: ' . foton_mikado_filter_px( $cpi['icon_size'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getButtonParameters( $cpi ) {
		$button_params_array = array();
		
		if ( ! empty( $cpi['button_text'] ) ) {
			$button_params_array['text'] = $cpi['button_text'];
		}
		
		if ( ! empty( $cpi['button_link'] ) ) {
			$button_params_array['link'] = $cpi['button_link'];
		}
		
		$button_params_array['size'] = 'medium';
		
		$button_params_array['type'] = 'simple';
		
		return $button_params_array;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorComparisonPricingTableHolder() );