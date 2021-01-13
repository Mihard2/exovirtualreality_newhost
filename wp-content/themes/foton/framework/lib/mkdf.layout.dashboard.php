<?php

/*
   Class: FotonMikadoClassDashboardForm
   A class that initializes Mikado Dashboard Container
*/
class FotonMikadoClassDashboardForm implements iFotonMikadoInterfaceLayoutNode, iFotonMikadoInterfaceRender {
	public $children;
	public $name;
	public $form_id;
	public $form_method;
	public $form_action;
	public $form_nonce_action;
	public $form_nonce_name;
	public $button_label;
	public $button_args = array();

	function __construct($name="", $form_id = "", $form_method = "", $form_action = "", $form_nonce_action = "", $form_nonce_name = "", $button_label = "", $button_args = array()) {
		$this->children = array();
		$this->name = $name;
		$this->form_id = $form_id;
		$this->form_method = $form_method;
		$this->form_action = $form_action;
		$this->form_nonce_action = $form_nonce_action;
		$this->form_nonce_name = $form_nonce_name;
		$this->button_label = $button_label;
		$this->button_args = $button_args;
	}

	public function hasChidren() {
		return (count($this->children) > 0)?true:false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		$user_id = get_current_user_id();
		$action_class = '';

		//set default class for form if action is set
		if ($this->form_action !== '') {
			$action_class = 'mkdf-dashboard-form';
		}
		?>
		<form method="<?php echo esc_attr($this->form_method);?>" id="<?php echo esc_attr($this->form_id);?>" class="<?php echo esc_attr($action_class)?>" data-action="<?php echo esc_attr($this->form_action);?>">
			<input type="hidden" name="mkdf_form_name" value="<?php echo esc_attr($this->name)?>"/>
			<?php foreach ($this->children as $child) {
				$this->renderChild($child, $factory);
			} ?>
			<?php
			if ( foton_mikado_core_plugin_installed() ) {
				echo foton_mikado_get_button_html( array(
					'text'      => $this->button_label,
					'html_type' => 'button',
					'custom_attrs' => $this->button_args
				) );
			} else {
				echo '<button type="submit">' . esc_html($this->button_label) . '</button>';
			} ?>
			<?php 
			if ($this->form_nonce_action !== '' && $this->form_nonce_name !== '') {
				wp_nonce_field( $this->form_nonce_action, $this->form_nonce_name );
			} else {
				wp_nonce_field( 'mkdf_validate_'.$this->name.'_'.$user_id, 'mkdf_nonce_'.$this->name.'_'.$user_id );				
			}
			?>
		</form>
		<?php
	}

	public function renderChild(iFotonMikadoInterfaceRender $child, $factory) {
		$child->render($factory);
	}
}

/*
   Class: FotonMikadoClassDashboardGroup
   A class that initializes FotonMikadoClass Group Field
*/
class FotonMikadoClassDashboardGroup implements iFotonMikadoInterfaceLayoutNode, iFotonMikadoInterfaceRender{
	public $children;
	public $name;
	public $title;
	public $description;

	function __construct($name="", $title_label = "", $description = "") {
		$this->children = array();
		$this->name = $name;
		$this->title = $title_label;
		$this->description = $description;
	}

	public function hasChidren() {
		return (count($this->children) > 0)?true:false;
	}

	public function getChild($key) {
		return $this->children[$key];
	}

	public function addChild($key, $value) {
		$this->children[$key] = $value;
	}

	public function render($factory) {
		?>
		<div class="mkdf-dashboard-group">
			<div class="mkdf-dashboard-group-desc">
				<h4><?php echo esc_html($this->title); ?></h4>
				<p><?php echo esc_html($this->description); ?></p>
			</div>
			<div class="mkdf-dashboard-group-content">
				<?php foreach ($this->children as $child) { ?>
					<div class="mkdf-dashboard-group-item">
						<?php $this->renderChild($child, $factory); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}

	public function renderChild(iFotonMikadoInterfaceRender $child, $factory) {
		$child->render($factory);
	}

}

/*
   Class: FotonMikadoClassDashboardTitle
   A class that initializes Dashboard Title
*/
class FotonMikadoClassDashboardTitle implements iFotonMikadoInterfaceRender {
	private $name;
	private $title;

	function __construct($name="",$title_dash="") {
		$this->title = $title_dash;
		$this->name = $name;
	}

	public function render($factory) { ?>
		<h5 class="mkdf-dashboard-section-subtitle" id="mkdf_<?php echo esc_attr($this->name); ?>"><?php echo esc_html($this->title); ?></h5>
	<?php
	}
}

/*
   Class: FotonMikadoClassDashboardField
   A class that initializes FotonMikadoClass Front Field
*/

class FotonMikadoClassDashboardField implements iFotonMikadoInterfaceRender {
	private $type;
	private $name;
	private $label;
	private $description;
	private $options = array();
	private $args = array();
	private $value;

	function __construct( $type, $name, $label = "", $description = "", $options = array(), $args = array(), $value = '') {
		$this->type        = $type;
		$this->name        = $name;
		$this->label       = $label;
		$this->description = $description;
		$this->options     = $options;
		$this->args        = $args;
		$this->value        = $value;
	}
	
	public function render( $factory ) {
		$factory->render( $this->type, $this->name, $this->label, $this->description, $this->options, $this->args, $this->value);
	}
}

abstract class FotonMikadoClassDashboardFieldType {
	abstract public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $value = "" );
}

class FotonMikadoClassDashboardFieldText extends FotonMikadoClassDashboardFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $value = '', $repeat = array() ) {
		$col_width = 12;

		if (isset($args['col_width'])) {
            $col_width = $args['col_width'];
        }

        $input_type = 'text';

        if (isset($args['input_type'])) {
        	$input_type = $args['input_type'];
        }

        if ($input_type == 'password') {
        	$value = '';
        }

        $suffix = !empty($args['suffix']) ? $args['suffix'] : false;

        $class = '';

        if (!empty($repeat) && array_key_exists('name', $repeat) && array_key_exists('index', $repeat)) {
			$id		= $name . '-' . $repeat['index'];
			$name	= $repeat['name'] . '['.$repeat['index'].']['. $name .']';
		} else {
            $id = $name;
        }

        if($description !== '') {
            $class .= ' mkdf-has-description';
        }

        if(isset($args['custom_class']) && $args['custom_class'] != '') {
            $class .= ' '  . $args['custom_class'];
        }

		?>
		<div class="mkdf-dashboard-field-holder <?php echo esc_attr($class); ?>">
			<div class="mkdf-dashboard-field-row">
				<div class="mkdf-dashboard-item col-lg-<?php echo esc_attr($col_width); ?>">
					<div class="mkdf-dashboard-input-holder">
						<label for="<?php echo esc_attr($name);?>"><?php echo esc_html( $label ); ?></label>
						<input class="mkdf-dashboard-input" type="<?php echo esc_attr($input_type);?>" name="<?php echo esc_attr($name);?>" id="<?php echo esc_attr($id);?>"
						       value="<?php echo esc_attr( htmlspecialchars( $value ) ); ?>">
						<?php if ($description !== '') { ?>
							<p class="description"><?php echo esc_html( $description ); ?></p>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class FotonMikadoClassDashboardFieldTextArea extends FotonMikadoClassDashboardFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $value = '', $repeat = array() ) {
		$col_width = 12;

		if (isset($args['col_width'])) {
            $col_width = $args['col_width'];
        }

        $input_type = 'text';

        if (isset($args['input_type'])) {
        	$input_type = $args['input_type'];
        }

        if ($input_type == 'password') {
        	$value = '';
        }

        $suffix = !empty($args['suffix']) ? $args['suffix'] : false;

        $class = '';

        if (!empty($repeat) && array_key_exists('name', $repeat) && array_key_exists('index', $repeat)) {
			$id		= $name . '-' . $repeat['index'];
			$name	= $repeat['name'] . '['.$repeat['index'].']['. $name .']';
		} else {
            $id = $name;
        }

        if($description !== '') {
            $class .= ' mkdf-has-description';
        }

        if(isset($args['custom_class']) && $args['custom_class'] != '') {
            $class .= ' '  . $args['custom_class'];
        }
		?>
		<div class="mkdf-dashboard-field-holder <?php echo esc_attr($class); ?>">
			<div class="mkdf-dashboard-field-row">
				<div class="mkdf-dashboard-item col-lg-<?php echo esc_attr($col_width); ?> mkdf-style-form">
					<label for="<?php echo esc_attr($name);?>"><?php echo esc_html( $label ); ?></label>
					<textarea name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr($id);?>" rows="5"><?php echo esc_html( htmlspecialchars( $value ) ); ?></textarea>
					<?php if ($description !== '') { ?>
						<p class="description"><?php echo esc_html( $description ); ?></p>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
	}
}

class FotonMikadoClassDashboardFieldImage extends FotonMikadoClassDashboardFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $value = '', $repeat = array() ) {
        $class = '';

        if (!empty($repeat) && array_key_exists('name', $repeat) && array_key_exists('index', $repeat)) {
			$id		= $name . '-' . $repeat['index'];
			$name	= $repeat['name'] . '['.$repeat['index'].']['. $name .']';
			$hidden_name = 'hidden_'.$repeat['name'] . '['.$repeat['index'].']';
		} else {
            $id = $name;
			$hidden_name = 'hidden_'.$name;
        }

        if($description !== '') {
            $class .= ' mkdf-has-description';
        }

        if(isset($args['custom_class']) && $args['custom_class'] != '') {
            $class .= ' '  . $args['custom_class'];
        }

        if(isset($args['not_image']) && $args['not_image'] == true) {
        	$value_html = '<span class="mkdf-dashboard-input-text">'.esc_html($value).'</span>';
        } else {
            if (is_numeric($value)){
				$value_html = '<li class="mkdf-dashboard-gallery-image">'.wp_get_attachment_image($value,'thumbnail').'</li>';
            } else {
				$value_html = '<li class="mkdf-dashboard-gallery-image"><img src="'.esc_url($value).'" /></li>';
            }
	    }

		?>
		<div class="mkdf-dashboard-field-holder <?php echo esc_attr($class); ?>">
			<label for="<?php echo esc_attr($name);?>"><?php echo esc_html( $label ); ?></label>
			<?php if ($description !== '') { ?>
				<p class="description"><?php echo esc_html( $description ); ?></p>
			<?php } ?>
			<div class="mkdf-dashboard-gallery-holder">
				<ul class="mkdf-dashboard-gallery-images-holder">
					<?php if ( isset($value_html) ) { 
						print foton_mikado_get_module_part($value_html);
					} ?>
				</ul>
				<div class="mkdf-dashboard-gallery-uploader">
					<?php 
					if ( foton_membership_theme_installed() ) {
						echo foton_mikado_get_button_html( array(
							'text'      => esc_html__( 'Upload', 'foton' ),
							'custom_class' => 'mkdf-dashboard-gallery-upload'
						) );
					} else {
						echo '<a itemprop="url" href="#" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-dashboard-gallery-upload"><span class="mkdf-btn-text">' . esc_html__( 'Upload', 'foton' ) . '</span></a>';
					} ?>
					<input class="mkdf-dashboard-gallery-upload-hidden" type="file" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>"
					       value="">
					<input type="hidden" class="mkdf-dashboard-media-hidden" name="<?php echo esc_attr( $hidden_name ); ?>" value="<?php echo esc_attr($value);?>"/>
					<?php if ($value !== '' && $value !== false) { ?>
						<button class="mkdf-btn mkdf-btn-solid mkdf-dashboard-remove-image"><?php esc_html_e('Remove Media','foton'); ?></button>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
	}
}

class FotonMikadoClassDashboardFieldGallery extends FotonMikadoClassDashboardFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $value = '', $repeat = array() ) {
        $class = '';

        if (!empty($repeat) && array_key_exists('name', $repeat) && array_key_exists('index', $repeat)) {
			$id		= $name . '-' . $repeat['index'];
			$name	= $repeat['name'] . '['.$repeat['index'].']['. $name .']';
			$hidden_name = 'hidden_'.$repeat['name'] . '['.$repeat['index'].']';
		} else {
            $id = $name;
            $hidden_name = 'hidden_'.$name;
        }

        if($description !== '') {
            $class .= ' mkdf-has-description';
        }

        if(isset($args['custom_class']) && $args['custom_class'] != '') {
            $class .= ' '  . $args['custom_class'];
        }
		?>
		<div class="mkdf-dashboard-field-holder <?php echo esc_attr($class); ?>">
			<label for="<?php echo esc_attr($name);?>"><?php echo esc_html( $label ); ?></label>
			<?php if ($description !== '') { ?>
				<p class="description"><?php echo esc_html( $description ); ?></p>
			<?php } ?>
			<div class="mkdf-dashboard-gallery-holder">
				<ul class="mkdf-dashboard-gallery-images-holder">
					<?php 
					if (isset($value)) {
						$gallery_images = explode(',', $value);
						foreach ($gallery_images as $image) {
							$url = wp_get_attachment_url($image); ?>
							<li class="mkdf-membership-gallery-image">
								<img src="<?php echo esc_url($url);?>"/>
							</li>
						<?php } 
					} ?>
				</ul>
				<div class="mkdf-dashboard-gallery-uploader">
					<?php 
					if ( foton_membership_theme_installed() ) {
						echo foton_mikado_get_button_html( array(
							'text'      => esc_html__( 'Upload', 'foton' ),
							'custom_class' => 'mkdf-dashboard-gallery-upload'
						) );
					} else {
						echo '<a itemprop="url" href="#" class="mkdf-btn mkdf-btn-medium mkdf-btn-solid mkdf-dashboard-gallery-upload"><span class="mkdf-btn-text">' . esc_html__( 'Upload', 'foton' ) . '</span></a>';
					} ?>
					<input class="mkdf-dashboard-gallery-upload-hidden" type="file" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>"
					       value="" multiple>
					<input type="hidden" class="mkdf-dashboard-media-hidden" name="<?php echo esc_attr( $hidden_name ); ?>" value="<?php echo esc_attr($value);?>"/>
					<?php if ($value !== '') { ?>
						<button class="mkdf-btn mkdf-btn-solid mkdf-dashboard-remove-image"><?php esc_html_e('Remove Media','foton'); ?></button>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
	}
}

class FotonMikadoClassDashboardFieldSelect extends FotonMikadoClassDashboardFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $value = '', $repeat = array() ) {
        $class = '';

        if (!empty($repeat) && array_key_exists('name', $repeat) && array_key_exists('index', $repeat)) {
			$id		= $name . '-' . $repeat['index'];
			$name	= $repeat['name'] . '['.$repeat['index'].']['. $name .']';
		} else {
            $id = $name;
        }

        if($description !== '') {
            $class .= ' mkdf-has-description';
        }

        if(isset($args['custom_class']) && $args['custom_class'] != '') {
            $class .= ' '  . $args['custom_class'];
        }

		$select2 = '';
		if (isset($args['select2'])) {
			$select2 = 'mkdf-select2';
		}
		?>
		<div class="mkdf-dashboard-field-holder <?php echo esc_attr($class); ?>">
			<div class="mkdf-dashboard-field-row">
				<div class="mkdf-dashboard-item">
					<label for="<?php echo esc_attr($name);?>"><?php echo esc_html( $label ); ?></label>
					<?php if ($description !== '') { ?>
						<p class="description"><?php echo esc_html( $description ); ?></p>
					<?php } ?>
					<select class="<?php echo esc_attr($select2)?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr($id);?>">
						<?php foreach ( $options as $key => $svalue ) {
							if ( $key == "-1" ) {
								$key = "";
							} ?>
							<option <?php if ($value == $key) { echo "selected='selected'"; } ?> value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $svalue ); ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		<?php
	}
}

class FotonMikadoClassDashboardFieldDate extends FotonMikadoClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $value = '', $repeat = array() ) {
        if (!empty($repeat) && array_key_exists('name', $repeat) && array_key_exists('index', $repeat)) {
			$id		= $name . '-' . $repeat['index'];
			$name	= $repeat['name'] . '['.$repeat['index'].']['. $name .']';
		} else {
            $id = $name;
        }

   		$col_width = 12;

		if (isset($args['col_width'])) {
            $col_width = $args['col_width'];
        }

        $class = '';

        if($description !== '') {
            $class .= ' mkdf-has-description';
        }

        if(isset($args['custom_class']) && $args['custom_class'] != '') {
            $class .= ' '  . $args['custom_class'];
        }

		$select2 = '';
		if (isset($args['select2'])) {
			$select2 = 'mkdf-select2';
		}

		if(isset($args['input-data']) && $args['input-data'] != '') {
			foreach($args['input-data'] as $data_key => $data_value) {
				$data_string .= $data_key . '=' . $data_value;
				$data_string .= ' ';
			}
		}
		?>
		<div class="mkdf-dashboard-field-holder <?php echo esc_attr($class); ?>">
			<div class="mkdf-dashboard-field-row">
				<div class="mkdf-dashboard-item col-lg-<?php echo esc_attr($col_width); ?>">
					<div class="mkdf-dashboard-input-holder">
						<label for="<?php echo esc_attr($name);?>"><?php echo esc_html( $label ); ?></label>
						<input type="text" id="mkdf_<?php echo esc_attr($id);?>dp" class="mkdf-dashboard-input datepicker" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($value); ?>" />
						<?php if ($description !== '') { ?>
							<p class="description"><?php echo esc_html( $description ); ?></p>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

class FotonMikadoClassDashboardFieldIcon extends FotonMikadoClassDashboardFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $value = '', $repeat = array() ) {
		$options           = foton_mikado_icon_collections()->getIconCollectionsEmpty();
		$icons_collections = foton_mikado_icon_collections()->getIconCollectionsKeys();
		
		if ( ! empty( $repeat ) && array_key_exists( 'name', $repeat ) && array_key_exists( 'index', $repeat ) ) {
			$id   = $name . '-' . $repeat['index'];
			$name = $repeat['name'] . '[' . $repeat['index'] . '][' . $name . ']';
		} else {
			$id = $name;
		}
		
		$class = '';
		if ( $description !== '' ) {
			$class .= ' mkdf-has-description';
		}
		
		if ( isset( $args['custom_class'] ) && $args['custom_class'] != '' ) {
			$class .= ' ' . $args['custom_class'];
		}
		?>
		
		<div class="mkdf-dashboard-field-holder <?php echo esc_attr($class); ?>">
			<div class="mkdf-dashboard-field-row">
				<div class="mkdf-dashboard-item">
					<label for="<?php echo esc_attr($name);?>"><?php echo esc_html( $label ); ?></label>
					<?php if ($description !== '') { ?>
						<p class="description"><?php echo esc_html( $description ); ?></p>
					<?php } ?>
					<div class="mkdf-dashboard-icon-holder">
						<div class="mkdf-dashboard-icon-holder-inner">
							<select name="<?php echo esc_attr( $name ) . '[icon_pack]'; ?>" id="<?php echo esc_attr( $name ); ?>" class="icon-dependence">
								<?php foreach ( $options as $key => $ivalue ) { ?>
									<option <?php if (!empty($value) && $value['icon_pack'] == $key) { echo "selected='selected'"; } ?> value="<?php echo esc_attr( $key ); ?>"><?php echo esc_attr( $ivalue ); ?></option>
								<?php } ?>
							</select>
						</div>
						<?php foreach ( $icons_collections as $icons_collection ) {
							$icons_param = foton_mikado_icon_collections()->getIconCollectionParamNameByKey( $icons_collection );
	                        $style       = 'display: none';
	                        if ( !empty($value) && $value['icon_pack'] == $icons_collection ) {
	                            $style = 'display: block';
	                        }
							?>
							<div class="mkdf-icon-collection-holder" style="<?php echo esc_attr( $style ); ?>" data-icon-collection="<?php echo esc_attr( $icons_collection ); ?>">
                                <select name="<?php echo esc_attr( $name . '[' . $icons_param . ']'); ?>" id="<?php echo esc_attr( $name . '[' . $icons_param . ']'); ?>">
									<?php
									$icons = foton_mikado_icon_collections()->getIconCollection( $icons_collection );
                                    $active_icon = $value[$icons_param];
									foreach ( $icons->icons as $key => $ivalue ) { ?>
										<option <?php if ($active_icon == $key) { echo "selected='selected'"; } ?> value="<?php echo esc_attr( $key ); ?>"><?php echo esc_attr( $ivalue ); ?></option>
									<?php } ?>
								</select>
							</div>
						<?php } ?>
					</div>		
				</div>
			</div>
		</div>
		<?php
	}
}

class FotonMikadoClassDashboardFieldColor extends FotonMikadoClassDashboardFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $value = '', $repeat = array() ) {
        if (!empty($repeat) && array_key_exists('name', $repeat) && array_key_exists('index', $repeat)) {
			$id		= $name . '-' . $repeat['index'];
			$name	= $repeat['name'] . '['.$repeat['index'].']['. $name .']';
		} else {
            $id = $name;
        }

        $class = '';

        if($description !== '') {
            $class .= ' mkdf-has-description';
        }

        if(isset($args['custom_class']) && $args['custom_class'] != '') {
            $class .= ' '  . $args['custom_class'];
        }
		?>
		
		<div class="mkdf-dashboard-field-holder <?php echo esc_attr($class); ?>">
			<div class="mkdf-dashboard-field-row">
				<div class="mkdf-dashboard-item">
					<div class="mkdf-dashboard-input-holder">
						<label for="<?php echo esc_attr($name);?>"><?php echo esc_html( $label ); ?></label>
						<input class="mkdf-dashboard-color-field" type="text" name="<?php echo esc_attr($name);?>" id="<?php echo esc_attr($id);?>"
						       value="<?php echo esc_attr( htmlspecialchars( $value ) ); ?>">
						<?php if ($description !== '') { ?>
							<p class="description"><?php echo esc_html( $description ); ?></p>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class FotonMikadoClassDashboardFieldCheckBoxGroup extends FotonMikadoClassDashboardFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $value = '', $repeat = array() ) {
		$col_width = 12;

		if (isset($args['col_width'])) {
            $col_width = $args['col_width'];
        }

        $input_type = 'text';

        if (isset($args['input_type'])) {
        	$input_type = $args['input_type'];
        }

        if ($input_type == 'password') {
        	$value = '';
        }

        $suffix = !empty($args['suffix']) ? $args['suffix'] : false;

        $class = '';

        if (!empty($repeat) && array_key_exists('name', $repeat) && array_key_exists('index', $repeat)) {
			$id		= $name . '-' . $repeat['index'];
			$name	= $repeat['name'] . '['.$repeat['index'].']['. $name .']';
		} else {
            $id = $name;
        }

        if($description !== '') {
            $class .= ' mkdf-has-description';
        }

        if(isset($args['custom_class']) && $args['custom_class'] != '') {
            $class .= ' '  . $args['custom_class'];
        }
		?>
		<div class="mkdf-dashboard-field-holder <?php echo esc_attr($class); ?>">
			<div class="mkdf-dashboard-field-row">
				<div class="mkdf-dashboard-item col-lg-<?php echo esc_attr($col_width); ?>">
					<div class="mkdf-dashboard-input-holder">
						<label for="<?php echo esc_attr($name);?>"><?php echo esc_html( $label ); ?></label>
						<?php if ($description !== '') { ?>
							<p class="description"><?php echo esc_html( $description ); ?></p>
						<?php } ?>
						<div class="mkdf-checkbox-style">
                            <?php foreach($options as $option_key => $option_label) { 
                            	$i = 1; 
                                $checked = is_array($value) && in_array($option_key, $value);
                                $checked_attr = $checked ? 'checked' : ''; ?>
	                        	<div class="col-lg-3">
									<label class="mkdf-checkbox-label" for="<?php echo esc_attr($name.'_'.$option_key).'-'.$i; ?>">
										<input <?php echo esc_attr($checked_attr); ?> type="checkbox" id="<?php echo esc_attr($name.'_'.$option_key).'-'.$i; ?>"
																name="<?php echo esc_attr($name.'[]'); ?>"
																value="<?php echo esc_attr($option_key); ?>">
										<span class="mkdf-label-text">
											<?php echo esc_html($option_label); ?>
										</span>
									</label>
								</div>
								<?php 
								$i++;
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class FotonMikadoClassDashboardFieldAddress extends FotonMikadoClassFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $value = '', $repeat = array() ) {
		$col_width = 12;
		if ( isset( $args["col_width"] ) ) {
			$col_width = $args["col_width"];
		}
				
		$class = $id = $country = $lat_field = $long_field = '';
		if (!empty($repeat) && array_key_exists('name', $repeat) && array_key_exists('index', $repeat)) {
			$id		= $name . '-' . $repeat['index'];
			$name	= $repeat['name'] . '['.$repeat['index'].']['. $name .']';
		} else {
			$id    = $name;
		}
		
        if($description !== '') {
            $class .= ' mkdf-has-description';
        }
		
		if ( isset( $args['country'] ) && $args['country'] != '' ) {
			$country = $args['country'];
		}

        if ( isset( $args['latitude_field'] ) && $args['latitude_field'] != '' ) {
            $lat_field = $args['latitude_field'];
        }

        if ( isset( $args['longitude_field'] ) && $args['longitude_field'] != '' ) {
            $long_field = $args['longitude_field'];
        }
		?>
		<div class="mkdf-dashboard-field-holder mkdf-dashboard-address-field <?php echo esc_attr($class); ?>" data-country="<?php echo esc_attr( $country ); ?>" data-lat-field="<?php echo esc_attr( $lat_field ); ?>" data-long-field="<?php echo esc_attr( $long_field ); ?>" id="mkdf_<?php echo esc_attr( $id ); ?>">
			<div class="mkdf-dashboard-field-row">
				<div class="mkdf-dashboard-item col-lg-<?php echo esc_attr($col_width); ?>">
					<div class="mkdf-dashboard-input-holder">
						<label for="<?php echo esc_attr($name);?>"><?php echo esc_html( $label ); ?></label>
						<?php if ($description !== '') { ?>
							<p class="description"><?php echo esc_html( $description ); ?></p>
						<?php } ?>
						<input class="mkdf-dashboard-input" type="text" name="<?php echo esc_attr($name);?>" id="<?php echo esc_attr($id);?>"
						       value="<?php echo esc_attr( htmlspecialchars( $value ) ); ?>">
						<div class="map_canvas"></div>
						<a id="reset" href="#" style="display:none;"><?php esc_html_e( 'Reset Marker', 'foton' ); ?></a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

class FotonMikadoClassDashboardRepeater implements iFotonMikadoInterfaceRender {
	private $label;
	private $description;
	private $name;
	private $fields;
	private $num_of_rows;
	private $button_text;
	private $table_layout;
	private $value;
	
	function __construct( $fields, $name, $label = '', $description = '', $button_text = '', $table_layout = false, $value = array() ) {
		global $foton_mikado_global_Framework;
		
		$this->label       = $label;
		$this->description = $description;
		$this->fields      = $fields;
		$this->name        = $name;
		$this->num_of_rows = 1;
		$this->button_text = ! empty( $button_text ) ? $button_text : esc_html__( 'Add New Item', 'foton' );
		$this->table_layout = $table_layout;
		$this->value = $value;
		
		$counter = 0;
		foreach ( $this->fields as $field ) {
			
			if ( ! isset( $this->fields[ $counter ]['options'] ) ) {
				$this->fields[ $counter ]['options'] = array();
			}
			if ( ! isset( $this->fields[ $counter ]['args'] ) ) {
				$this->fields[ $counter ]['args'] = array();
			}
			if ( ! isset( $this->fields[ $counter ]['label'] ) ) {
				$this->fields[ $counter ]['label'] = '';
			}
			if ( ! isset( $this->fields[ $counter ]['description'] ) ) {
				$this->fields[ $counter ]['description'] = '';
			}
			if ( ! isset( $this->fields[ $counter ]['default_value'] ) ) {
				$this->fields[ $counter ]['default_value'] = '';
			}
			$counter ++;
		}
	}
	
	public function render( $factory ) {
		global $post;
		
		$clones = array();
		$wrapper_classes = array();
		
		if ( ! empty( $this->value ) ) {
			$clones = $this->value;
		}
		
		$sortable_class = 'sortable';
		
		foreach ( $this->fields as $field ) {
			if ( $field['type'] == 'textareahtml' ) {
				$sortable_class = '';
				break;
			}
		}

		if ($this->table_layout){
			$wrapper_classes[] = 'mkdf-dashboard-repeater-table';
		}

		?>
		<div class="mkdf-dashboard-repeater-wrapper <?php echo implode(' ', $wrapper_classes)?>">
			<?php  if ( $this->label !== '') { ?>
				<h4><?php echo esc_attr($this->label); ?></h4>
			<?php } ?>
			<?php if($this->description != ''){ ?>
				<p><?php echo esc_attr($this->description); ?></p>
			<?php } ?>
			<?php if ($this->table_layout) { ?>
				<div class="mkdf-dashboard-repeater-table-heading">
					<div class="mkdf-dashboard-repeater-fields-holder">
						<div class="mkdf-dashboard-repeater-table-cell mkdf-dashboard-repeater-sort"><?php esc_html_e( 'Order', 'foton' ) ?></div>
						<div class="mkdf-dashboard-repeater-fields">
							<?php foreach ( $this->fields as $field ) { 
								$col_width_class = 'col-lg-12';
								if ( ! empty($field['col_width']) ) {
									$col_width_class = 'col-lg-'.$field['col_width'];
								} ?>
								<div class="mkdf-dashboard-repeater-table-cell <?php echo esc_attr($col_width_class);?>"><?php echo esc_html( $field['th'] ); ?></div>
							<?php } ?>
						</div>
						<div class="mkdf-dashboard-repeater-table-cell mkdf-dashboard-repeater-remove"><?php esc_html_e( 'Remove', 'foton' ) ?></div>
					</div>
				</div>
			<?php } ?>
			<div class="mkdf-dashboard-repeater-wrapper-inner <?php echo esc_attr( $sortable_class ); ?>" data-template="<?php echo str_replace('_', '-', $this->name); ?>">
				<?php if (! empty($clones) && count($clones) > 0) {
					$counter = 0;
					foreach($clones as $clone) {
					?>
					<div class="mkdf-dashboard-repeater-fields-holder clearfix" data-index="<?php echo esc_attr($counter); ?>">
						<div class="mkdf-dashboard-repeater-sort">
							<i class="fa fa-sort"></i>
						</div>
						<div class="mkdf-dashboard-repeater-fields">
							<?php
								foreach ($this->fields as $field) {
									$col_width_class = 'col-lg-12';
									if ( ! empty($field['col_width']) ) {
										$col_width_class = 'col-lg-'.$field['col_width'];
									}
									?>
									<div class="mkdf-dashboard-repeater-fields-row <?php echo esc_attr($col_width_class);?>">
										<div class="mkdf-dashboard-repeater-fields-row-inner">
										<?php
											if($field['type'] == 'repeater'){ 

												$sortable_inner_class = 'sortable';
												foreach ( $field['fields'] as $field_inner ) {
													if ( $field_inner['type'] == 'textareahtml' ) {
														$sortable_inner_class = '';
														break;
													}
												} ?>
												<div class="mkdf-dashboard-repeater-inner-wrapper">
													<div class="mkdf-dashboard-repeater-inner-wrapper-inner <?php echo esc_attr( $sortable_inner_class ); ?>" data-template="<?php echo str_replace('_', '-', $field['name']); ?>">
														<h4><?php echo esc_attr($field['label']); ?></h4>
														<?php if($field['description'] != ''){ ?>
															<p><?php echo esc_attr($field['description']); ?></p>
														<?php } ?>
														<?php if (!empty($clone[$field['name']]) && count($clone[$field['name']]) > 0) {
															$counter2 = 0;

															foreach($clone[$field['name']] as $clone_inner) {
																?>
																<div class="mkdf-dashboard-repeater-inner-fields-holder mkdf-second-level clearfix" data-index="<?php echo esc_attr($counter2); ?>">
																	<div class="mkdf-dashboard-repeater-sort">
																		<i class="fa fa-sort"></i>
																	</div>
																	<div class="mkdf-dashboard-repeater-inner-fields">
																		<?php
																		foreach ($field['fields'] as $field_inner) { 
																			$col_width_inner_class = 'col-lg-12';
																			if ( ! empty($field_inner['col_width']) ) {
																				$col_width_inner_class = 'col-lg-'.$field_inner['col_width'];
																			} ?>
																			<div class="mkdf-dashboard-repeater-inner-fields-row <?php echo esc_attr( $col_width_inner_class ); ?>">
																				<div class="mkdf-dashboard-repeater-inner-fields-row-inner">
																					<?php

																					if (!isset($field_inner['options'])) {
																						$field_inner['options'] = array();
																					}
																					if (!isset($field_inner['args'])) {
																						$field_inner['args'] = array();
																					}
																					if (!isset($field_inner['label'])) {
																						$field_inner['label'] =  '';
																					}
																					if (!isset($field_inner['description'])) {
																						$field_inner['description'] = '';
																					}
																					if (!isset($field_inner['default_value'])) {
																						$field_inner['default_value'] = '';
																					}

																					if($clone_inner[$field_inner['name']] == '' && $field_inner['default_value'] != ''){
																						$repeater_inner_field_value = $field_inner['default_value'];
																					} else {
																						$repeater_inner_field_value = $clone_inner[$field_inner['name']];
																					}

																					$factory->render($field_inner['type'], $field_inner['name'], $field_inner['label'], $field_inner['description'], $field_inner['options'], $field_inner['args'], $repeater_inner_field_value, array('name'=> $this->name . '['.$counter.']['.$field['name'].']', 'index' => $counter2));
																					?>
																				</div>
																			</div>
																			<?php
																		} ?>
																	</div>
																	<div class="mkdf-dashboard-repeater-remove">
																		<a class="mkdf-clone-inner-remove" href="#"><i class="fa fa-times"></i></a>
																	</div>
																</div>
																<?php $counter2++; } 
															} ?>
													</div>
													<div class="mkdf-dashboard-repeater-inner-add">
														<a class="mkdf-inner-clone btn btn-sm btn-primary"
														   data-count="<?php echo esc_attr($this->num_of_rows) ?>"
														   href="#"><?php echo esc_html($field['button_text']); ?></a>
													</div>
												</div>
											<?php
											} else {
												if($clone[$field['name']] == '' && $field['default_value'] != ''){
													$repeater_field_value = $field['default_value'];
												} else {
													$repeater_field_value = $clone[$field['name']];
												}

												$factory->render($field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], $repeater_field_value, array('name'=> $this->name, 'index' => $counter));
											} ?>
										</div>
									</div>
							<?php } ?>
						</div>
						<div class="mkdf-dashboard-repeater-remove">
							<a class="mkdf-clone-remove" href="#"><i class="fa fa-times"></i></a>
						</div>
					</div>
				<?php $counter++; } } ?>
				<script type="text/html" id="tmpl-mkdf-dashboard-repeater-template-<?php echo str_replace('_', '-', $this->name); ?>">
					<div class="mkdf-dashboard-repeater-fields-holder <?php echo esc_attr( $sortable_class ); ?> clearfix"  data-index="{{{ data.rowIndex }}}">
						<div class="mkdf-dashboard-repeater-sort">
							<i class="fa fa-sort"></i>
						</div>
						<div class="mkdf-dashboard-repeater-fields">
							<?php
							foreach ($this->fields as $field) { 
								$col_width_class = 'col-lg-12';
								if ( ! empty($field['col_width']) ) {
									$col_width_class = 'col-lg-'.$field['col_width'];
								} ?>
								<div class="mkdf-dashboard-repeater-fields-row <?php echo esc_attr($col_width_class);?>">
									<div class="mkdf-dashboard-repeater-fields-row-inner">
										<?php
										if($field['type'] == 'repeater') { ?>
											<div class="mkdf-dashboard-repeater-inner-wrapper">
												<div class="mkdf-dashboard-repeater-inner-wrapper-inner" data-template="<?php echo str_replace('_', '-', $field['name']); ?>">
													<h4><?php echo esc_attr($field['label']); ?></h4>
													<?php if($field['description'] != ''){ ?>
														<p><?php echo esc_attr($field['description']); ?></p>
													<?php } ?>
												</div>
												<div class="mkdf-dashboard-repeater-inner-add">
													<a class="mkdf-inner-clone btn btn-sm btn-primary"
													   data-count="<?php echo esc_attr($this->num_of_rows) ?>"
													   href="#"><?php echo esc_html($field['button_text']); ?></a>
												</div>
											</div>
										<?php } else {
											$repeater_template_field_value = ($field['default_value'] != '') ? $field['default_value'] : '';
											$factory->render($field['type'], $field['name'], $field['label'], $field['description'], $field['options'], $field['args'], '', array('name' => $this->name, 'index' => '{{{ data.rowIndex }}}', 'value' => $repeater_template_field_value));
										} ?>
									</div>
								</div>
								<?php
							} ?>
						</div>
						<div class="mkdf-dashboard-repeater-remove">
							<a class="mkdf-clone-remove" href="#"><i class="fa fa-times"></i></a>
						</div>
					</div>
				</script>
				<?php 
				//add script if field type repeater
				foreach ($this->fields as $field) {
					if($field['type'] == 'repeater') {
					?>
					<script type="text/html" id="tmpl-mkdf-dashboard-repeater-inner-template-<?php echo str_replace('_', '-', $field['name']); ?>">
						<div class="mkdf-dashboard-repeater-inner-fields-holder mkdf-second-level clearfix" data-index="{{{ data.rowInnerIndex }}}">
							<div class="mkdf-dashboard-repeater-sort">
								<i class="fa fa-sort"></i>
							</div>
							<div class="mkdf-dashboard-repeater-inner-fields">
								<?php $counter2 = 0;
								foreach ($field['fields'] as $field_inner) { 
									$col_width_inner_class = 'col-lg-12';
									if ( ! empty($field_inner['col_width']) ) {
										$col_width_inner_class = 'col-lg-'.$field_inner['col_width'];
									} ?>
									<div class="mkdf-dashboard-repeater-inner-fields-row <?php echo esc_attr($col_width_inner_class);?>">
										<div class="mkdf-dashboard-repeater-fields-row-inner">
											<?php

											if (!isset($field_inner['options'])) {
												$field_inner['options'] = array();
											}
											if (!isset($field_inner['args'])) {
												$field_inner['args'] = array();
											}
											if (!isset($field_inner['label'])) {
												$field_inner['label'] =  '';
											}
											if (!isset($field_inner['description'])) {
												$field_inner['description'] = '';
											}
											if (!isset($field_inner['default_value'])) {
												$field_inner['default_value'] = '';
											}
											$repeater_inner_template_field_value = ($field_inner['default_value'] != '') ? $field_inner['default_value'] : '';
											$factory->render($field_inner['type'], $field_inner['name'], $field_inner['label'], $field_inner['description'], $field_inner['options'], $field_inner['args'], '', array('name'=> $this->name . '[{{{ data.rowIndex }}}]['.$field['name'].']', 'index' => '{{{ data.rowInnerIndex }}}', 'value' => $repeater_inner_template_field_value));

											?>
										</div>
									</div>
									<?php
									$counter2++;	} ?>
							</div>
							<div class="mkdf-dashboard-repeater-remove">
								<a class="mkdf-clone-inner-remove" href="#"><i class="fa fa-times"></i></a>
							</div>
						</div>
					</script>
					<?php }
				} ?>
			</div>
			<div class="mkdf-dashboard-repeater-add">
				<a class="mkdf-clone btn btn-sm btn-primary" data-count="<?php echo esc_attr( $this->num_of_rows ) ?>" href="#"><?php echo esc_html( $this->button_text ); ?></a>
			</div>
		</div>
		<?php
	}
}

class FotonMikadoClassDashboardFieldFactory {
	public function render( $field_type, $name, $label = "", $description = "", $options = array(), $args = array(), $value = '', $repeat = array()) {
		switch ( strtolower( $field_type ) ) {
			case 'text':
				$field = new FotonMikadoClassDashboardFieldText();
				$field->render( $name, $label, $description, $options, $args, $value, $repeat );
				break;

			case 'textarea':
				$field = new FotonMikadoClassDashboardFieldTextArea();
				$field->render( $name, $label, $description, $options, $args, $value, $repeat );
				break;

			case 'date':
				$field = new FotonMikadoClassDashboardFieldDate();
				$field->render( $name, $label, $description, $options, $args, $value, $repeat );
				break;
			
			case 'image':
				$field = new FotonMikadoClassDashboardFieldImage();
				$field->render( $name, $label, $description, $options, $args, $value, $repeat );
				break;

			case 'gallery':
				$field = new FotonMikadoClassDashboardFieldGallery();
				$field->render( $name, $label, $description, $options, $args, $value, $repeat );
				break;
			
			case 'select':
				$field = new FotonMikadoClassDashboardFieldSelect();
				$field->render( $name, $label, $description, $options, $args, $value, $repeat );
				break;
			
			case 'icon':
				$field = new FotonMikadoClassDashboardFieldIcon();
				$field->render( $name, $label, $description, $options, $args, $value, $repeat );
				break;
			
			case 'color':
				$field = new FotonMikadoClassDashboardFieldColor();
				$field->render( $name, $label, $description, $options, $args, $value, $repeat );
				break;

			case 'checkboxgroup':
				$field = new FotonMikadoClassDashboardFieldCheckBoxGroup();
				$field->render( $name, $label, $description, $options, $args, $value, $repeat );
				break;

			case 'address':
				$field = new FotonMikadoClassDashboardFieldAddress();
				$field->render( $name, $label, $description, $options, $args, $value );
				break;

			default:
				break;
		}
	}
}
