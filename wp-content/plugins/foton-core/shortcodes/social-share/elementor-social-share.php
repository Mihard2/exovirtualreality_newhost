<?php

class ElementorSocialShare extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'mkdf_elementor_social_share';
	}
	
	public function get_title() {
		return esc_html__( 'Social Share', 'foton-core' );
	}
	
	public function get_icon() {
		return 'foton-elementor-custom-icon foton-elementor-social-share';
	}
	
	public function get_categories() {
		return [ 'mikado' ];
	}
	
	public function getSocialNetworks() {
		$socialNetworks = array(
			'twitter',
			'facebook',
			'google_plus',
			'linkedin',
			'tumblr',
			'pinterest',
			'vk'
		);
		
		return $socialNetworks;
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
			'type',
			[
				'label'   => esc_html__( 'Type', 'foton-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'list'     => esc_html__( 'List', 'foton-core' ),
					'dropdown' => esc_html__( 'Dropdown', 'foton-core' ),
					'text'     => esc_html__( 'Text', 'foton-core' )
				],
				'default' => 'list'
			]
		);
		
		$this->add_control(
			'icon_type',
			[
				'label'     => esc_html__( 'Icons Type', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'font-awesome' => esc_html__( 'Font Awesome', 'foton-core' ),
					'font-elegant' => esc_html__( 'Font Elegant', 'foton-core' ),
				],
				'condition' => [
					'type' => array( 'list', 'dropdown' )
				],
				'default'   => 'font-elegant'
			]
		);
		
		$this->add_control(
			'title',
			[
				'label'     => esc_html__( 'Social Share Title', 'foton-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'type' => array( 'list', 'dropdown' )
				],
			]
		);
	}
	
	public function render() {
		$params = $this->get_settings_for_display();
		
		$args = array(
			'type'      => 'list',
			'icon_type' => 'font-elegant',
			'title'     => ''
		);
		
		//Is social share enabled
		$params['enable_social_share'] = ( foton_mikado_options()->getOptionValue( 'enable_social_share' ) == 'yes' ) ? true : false;
		
		//Is social share enabled for post type
		$post_type         = get_post_type();
		$params['enabled'] = ( foton_mikado_options()->getOptionValue( 'enable_social_share_on_' . $post_type ) == 'yes' ) ? true : false;
		
		//Social Networks Data
		$params['networks'] = $this->getSocialNetworksParams( $params );
		
		if ( $params['enable_social_share'] ) {
			if ( $params['enabled'] ) {
				echo foton_core_get_shortcode_module_template_part( 'templates/' . $params['type'], 'social-share', '', $params );
			}
		}
	}
	
	/**
	 * Get Social Networks data to display
	 * @return array
	 */
	private function getSocialNetworksParams( $params ) {
		$networks   = array();
		$icons_type = $params['icon_type'];
		$type       = $params['type'];
		
		$socialNetworks = array(
			'twitter',
			'facebook',
			'google_plus',
			'linkedin',
			'tumblr',
			'pinterest',
			'vk'
		);
		
		foreach ( $socialNetworks as $net ) {
			$html = '';
			
			if ( foton_mikado_options()->getOptionValue( 'enable_' . $net . '_share' ) == 'yes' ) {
				$image  = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				$params = array(
					'name' => $net,
					'type' => $type
				);
				
				$params['link'] = $this->getSocialNetworkShareLink( $net, $image );
				
				if ( $type == 'text' ) {
					$params['text'] = $this->getSocialNetworkText( $net );
				} else {
					$params['icon'] = $this->getSocialNetworkIcon( $net, $icons_type );
				}
				
				$params['custom_icon'] = ( foton_mikado_options()->getOptionValue( $net . '_icon' ) ) ? foton_mikado_options()->getOptionValue( $net . '_icon' ) : '';
				
				$html = foton_core_get_shortcode_module_template_part( 'templates/parts/network', 'social-share', '', $params );
			}
			
			$networks[ $net ] = $html;
		}
		
		return $networks;
	}
	
	/**
	 * Get share link for networks
	 *
	 * @param $net
	 * @param $image
	 *
	 * @return string
	 */
	private function getSocialNetworkShareLink( $net, $image ) {
		switch ( $net ) {
			case 'facebook':
				if ( wp_is_mobile() ) {
					$link = 'window.open(\'http://m.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '\');';
				} else {
					$link = 'window.open(\'http://www.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');';
				}
				break;
			case 'twitter':
				$count_char  = ( isset( $_SERVER['https'] ) ) ? 23 : 22;
				$twitter_via = ( foton_mikado_options()->getOptionValue( 'twitter_via' ) !== '' ) ? ' via ' . foton_mikado_options()->getOptionValue( 'twitter_via' ) . ' ' : '';
				if ( wp_is_mobile() ) {
					$link = 'window.open(\'https://twitter.com/intent/tweet?text=' . urlencode( foton_mikado_the_excerpt_max_charlength( $count_char ) . $twitter_via ) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
				} else {
					$link = 'window.open(\'http://twitter.com/home?status=' . urlencode( foton_mikado_the_excerpt_max_charlength( $count_char ) . $twitter_via ) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
				}
				break;
			case 'google_plus':
				$link = 'popUp=window.open(\'https://plus.google.com/share?url=' . urlencode( get_permalink() ) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'linkedin':
				$link = 'popUp=window.open(\'http://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode( get_permalink() ) . '&amp;title=' . urlencode( get_the_title() ) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'tumblr':
				$link = 'popUp=window.open(\'http://www.tumblr.com/share/link?url=' . urlencode( get_permalink() ) . '&amp;name=' . urlencode( get_the_title() ) . '&amp;description=' . urlencode( get_the_excerpt() ) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'pinterest':
				$link = 'popUp=window.open(\'http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . foton_mikado_addslashes( get_the_title() ) . '&amp;media=' . urlencode( $image[0] ) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'vk':
				$link = 'popUp=window.open(\'http://vkontakte.ru/share.php?url=' . urlencode( get_permalink() ) . '&amp;title=' . urlencode( get_the_title() ) . '&amp;description=' . urlencode( get_the_excerpt() ) . '&amp;image=' . urlencode( $image[0] ) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			default:
				$link = '';
		}
		
		return $link;
	}
	
	private function getSocialNetworkIcon( $net, $type ) {
		switch ( $net ) {
			case 'facebook':
				$icon = ( $type == 'font-elegant' ) ? 'social_facebook' : 'fab fa-facebook';
				break;
			case 'twitter':
				$icon = ( $type == 'font-elegant' ) ? 'social_twitter' : 'fab fa-twitter';
				break;
			case 'google_plus':
				$icon = ( $type == 'font-awesome' ) ? 'social_googleplus' : 'fab fa-google-plus-g';
				break;
			case 'linkedin':
				$icon = ( $type == 'font-elegant' ) ? 'social_linkedin' : 'fab fa-linkedin';
				break;
			case 'tumblr':
				$icon = ( $type == 'font-elegant' ) ? 'social_tumblr' : 'fab fa-tumblr';
				break;
			case 'pinterest':
				$icon = ( $type == 'font-elegant' ) ? 'social_pinterest' : 'fab fa-pinterest';
				break;
			case 'vk':
				$icon = 'fab fa-vk';
				break;
			default:
				$icon = '';
		}
		
		return $icon;
	}
	
	private function getSocialNetworkText( $net ) {
		switch ( $net ) {
			case 'facebook':
				$text = esc_html__( 'fb', 'foton-core' );
				break;
			case 'twitter':
				$text = esc_html__( 'tw', 'foton-core' );
				break;
			case 'google_plus':
				$text = esc_html__( 'g+', 'foton-core' );
				break;
			case 'linkedin':
				$text = esc_html__( 'lnkd', 'foton-core' );
				break;
			case 'tumblr':
				$text = esc_html__( 'tmb', 'foton-core' );
				break;
			case 'pinterest':
				$text = esc_html__( 'pin', 'foton-core' );
				break;
			case 'vk':
				$text = esc_html__( 'vk', 'foton-core' );
				break;
			default:
				$text = '';
		}
		
		return $text;
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ElementorSocialShare() );