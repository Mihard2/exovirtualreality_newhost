<?php

class ElementorItemShowcase extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_item_showcase';
	}
	
	public function get_title() {
		return esc_html__( 'Item Showcase', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-item-showcase';
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
			'item_image',
			[
				'label' => esc_html__( 'Image', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			]
		);
		
		$this->add_control(
			'image_top_offset',
			[
				'label'   => esc_html__( 'Image Top Offset', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '-100px'
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		foton_mikado_icon_collections()->getElementorParamsArray( $repeater, '', '' );
		
		$repeater->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Icon Type', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'mkdf-normal' => esc_html__( 'Normal', 'foton-core' ),
					'mkdf-circle' => esc_html__( 'Circle', 'foton-core' ),
					'mkdf-square' => esc_html__( 'Square', 'foton-core' )
				],
			]
		);
		
		$repeater->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type!' => ''
				],
			]
		);
		
		$repeater->add_control(
			'custom_icon',
			[
				'label' => esc_html__( 'Custom Icon', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			]
		);
		
		$repeater->add_control(
			'item_position',
			[
				'label'   => esc_html__( 'Item Position', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'left'  => esc_html__( 'Left', 'foton-core' ),
					'right' => esc_html__( 'Right', 'foton-core' )
				],
				'default' => 'left'
			]
		);
		
		$repeater->add_control(
			'item_title',
			[
				'label' => esc_html__( 'Item Title', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$repeater->add_control(
			'item_link',
			[
				'label'     => esc_html__( 'Item Link', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'item_title!' => ''
				],
			]
		);
		
		$repeater->add_control(
			'item_target',
			[
				'label'   => esc_html__( 'Item Target', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_link_target_array(),
				'default' => '_self'
			]
		);
		
		$repeater->add_control(
			'item_title_tag',
			[
				'label'   => esc_html__( 'Item Title Tag', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => foton_mikado_get_title_tag( true ),
				'default' => 'h4'
			]
		);
		
		$repeater->add_control(
			'item_title_color',
			[
				'label'     => esc_html__( 'Item Title Color', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'item_title!' => ''
				],
			]
		);
		
		$repeater->add_control(
			'item_text',
			[
				'label' => esc_html__( 'Item Text', 'foton-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);
		
		$repeater->add_control(
			'item_text_color',
			[
				'label'     => esc_html__( 'Item Text Color', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'item_text!' => ''
				],
			]
		);
		
		$this->add_control(
			'item_showcase_list_item',
			[
				'label'       => esc_html__( 'Item Showcase List Items', 'foton-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => esc_html__( 'Item Showcase List Item' ),
			]
		);
		
		$this->end_controls_section();
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args = array(
			'item_image'       => '',
			'image_top_offset' => '',
		);
		
		$params['item_image_style'] = '';
		if ( ! empty( $params['image_top_offset'] ) ) {
			$params['item_image_style'] = 'margin-top: ' . foton_mikado_filter_px( $params['image_top_offset'] ) . 'px';
		}
		
		if ( ! empty( $params['item_image'] ) ) {
			$params['item_image'] = $params['item_image']['id'];
		}
		
		?>
		
		<div class="mkdf-item-showcase-holder clearfix">
			
			<?php foreach ( $params['item_showcase_list_item'] as $isli ) {
				
				if ( ! empty( $isli['custom_icon'] ) ) {
					$isli['custom_icon'] = $isli['custom_icon']['id'];
				}
				
				$isli['icon_params']         = $this->getIconParameters( $isli );
				$isli['showcase_item_class'] = $this->getShowcaseItemClasses( $isli );
				$isli['item_target']         = ! empty( $isli['item_target'] ) ? $isli['item_target'] : '_self';
				$isli['item_title_tag']      = ! empty( $isli['item_title_tag'] ) ? $isli['item_title_tag'] : 'h4';
				$isli['item_title_styles']   = $this->getTitleStyles( $isli );
				$isli['item_text_styles']    = $this->getTextStyles( $isli );
				
				echo foton_core_get_shortcode_module_template_part( 'templates/item-showcase-item', 'item-showcase', '', $isli );
			} ?>
			
			<?php if ( ! empty( $params['item_image'] ) ) { ?>
				<div class="mkdf-is-image" <?php echo foton_mikado_get_inline_style( $params['item_image_style'] ) ?>>
					<?php echo wp_get_attachment_image( $params['item_image'], 'full' ); ?>
				</div>
			<?php } ?>
		</div>
		
		<?php
	}
	
	private function getIconParameters( $isli ) {
		$isli_array = array();
		
		if ( empty( $isli['custom_icon'] ) ) {
			$iconPackName = foton_mikado_icon_collections()->getIconCollectionParamNameByKey( $isli['icon_pack'] );
			
			$isli_array['icon_pack']  = $isli['icon_pack'];
			$isli_array['icon_color'] = $isli['icon_color'];
			
			if ( ! empty( $isli['icon_type'] ) ) {
				$isli_array['type'] = $isli['icon_type'];
			}
			
			$isli_array[ $iconPackName ] = $isli[ $iconPackName ];
			
			$isli_array['size'] = 'mkdf-icon-medium';
			
		}
		
		return $isli_array;
	}
	
	private function getShowcaseItemClasses( $isli ) {
		$itemClass = array();
		
		if ( ! empty( $isli['item_position'] ) ) {
			$itemClass[] = 'mkdf-is-' . $isli['item_position'];
		}
		
		return implode( ' ', $itemClass );
	}
	
	private function getTitleStyles( $isli ) {
		$styles = array();
		
		if ( ! empty( $isli['item_title_color'] ) ) {
			$styles[] = 'color: ' . $isli['item_title_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $isli ) {
		$styles = array();
		
		if ( ! empty( $isli['item_text_color'] ) ) {
			$styles[] = 'color: ' . $isli['item_text_color'];
		}
		
		return implode( ';', $styles );
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorItemShowcase() );