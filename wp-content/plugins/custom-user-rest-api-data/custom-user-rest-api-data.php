<?php
/**
 * Plugin Name: Custom User Rest Api Data
 * Description: return/update custom data for wp users
 * Version: 0.1
 */

class REST_UserFriendsData{

	public $table_name;
	public $primary_key = 'id';

	function __construct()
	{
		$this->table_name = self::get_table_name();
	}

	static public function get_table_name()
	{
		global $wpdb;

		return $wpdb->prefix . 'rest_user_friends_data';
	}


	function update_data($user_id,$data)
	{
		global $wpdb;

		$user_id = absint( $user_id );

		if ( empty( $user_id ) ) {
			return false;
		}

		$result=$this->delete_data($user_id);

		if ($result===false) return false;

		if ( false === $this->add_data($user_id, $data)){
			return false;
		}

		return true;
	}

	function add_data($user_id, $data)
	{
		global $wpdb;

		$user_id = absint( $user_id );

		if ( empty( $user_id ) ) {
			return false;
		}

		$query = "INSERT INTO {$this->table_name} (user_id, email, status) VALUES ";

		$values=[];
		$place_holders=[];
		foreach ($data as $item){
			$email_status=trim($item[1]);
			$email_status=sanitize_text_field($item[1]);
			if (empty(trim($item[0]))) return false;
			array_push($values, $user_id,$item[0],$email_status);
			$place_holders[] = "('%d', '%s', '%s')";
		}

		$query .= implode( ', ', $place_holders );

		if ( false === $wpdb->query( $wpdb->prepare( "$query ", $values ) )){
			return false;
		}

		return true;
	}

	function delete_data($user_id){
		global $wpdb;

		if (!is_integer($user_id)) return false;

		$user_id = absint( $user_id );

		if ( empty( $user_id ) ) {
			return false;
		}

		if ( false === $wpdb->query( $wpdb->prepare( "DELETE FROM {$this->table_name} WHERE user_id = %d", $user_id ) ) ) {
			return false;
		}

		return true;
	}

	/**
	 * @param int $user_id
	 *
	 * @return array|null|object
	 *
	 * array(0=>{id,user_id,email,status},...)
	 *
	 *
	 */
	function get_data_by($user_id){
		global $wpdb;

		return $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * FROM {$this->table_name} WHERE user_id = %d;",
				$user_id
			)
		);
	}

	function find_row($user_id, $find_email){
		global $wpdb;

		return $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM {$this->table_name} WHERE user_id = %d AND email = %s;",
				$user_id, $find_email
			)
		) ;
	}

	function get_converted_data_by_user_id($user_id){
		$result=$this->get_data_by($user_id);
		if (empty($result)) return [];

		$new_format=[];
		foreach ($result as $item){
			$item_array=[];
			$item_array[]=$item->email;
			$item_array[]=$item->status;
			$new_format[]=$item_array;
		}

		return $new_format;
	}

	public function create_table()
	{

		global $wpdb;

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		$charset_collate = '';

		if ( ! empty( $wpdb->charset ) ) {
			$charset_collate .= "DEFAULT CHARACTER SET {$wpdb->charset}";
		}
		if ( ! empty( $wpdb->collate ) ) {
			$charset_collate .= " COLLATE {$wpdb->collate}";
		}

		$sql = "CREATE TABLE IF NOT EXISTS {$this->table_name} (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			user_id bigint(20) NOT NULL,
			email VARCHAR(150) NOT NULL,
			status VARCHAR(100) NOT NULL,
			PRIMARY KEY  (id)
		) {$charset_collate};";

		dbDelta( $sql );
	}

	public function table_exists( $table = '' ) {

		global $wpdb;

		if ( ! empty( $table ) ) {
			$table = sanitize_text_field( $table );
		} else {
			$table = $this->table_name;
		}

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.NoCaching
		$db_result = $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $table ) );

		return strtolower( $db_result ) === strtolower( $table );
	}
}

class REST_UserMeta_Controller extends WP_REST_Controller {

	function __construct() {
		$this->namespace = 'user-data/v1';
		$this->fields=['room','name','title','about','avatar','friends'];
	}

	function register_file_check_args_for_rest_request(array $order, WP_REST_Request $request){
        if ($request->get_route()=='/'.$this->namespace.'/authapi/avatar'){
            $order[]='FILES';
        }
        return $order;
    }

	function register_routes() {

		register_rest_route( $this->namespace, "/exist/(?P<email>.+)",
			[
				'methods'             => 'GET',
				'callback'            => [ $this, 'get_user_exist' ],
				'permission_callback' => '__return_true',
				'args'=>[
					'email'=>[
						'required'          =>true,
						'type'              =>[
							'type'   => 'string',
							'format' => 'email',
						]
					]
				]
			]
		);

		register_rest_route( $this->namespace, "/check/(?P<email>.+)/friend/(?P<email_check>.+)",
			[
				'methods'             => 'GET',
				'callback'            => [ $this, 'get_friend_email_status' ],
				'permission_callback' => [ $this, 'get_permissions_check' ],
				'args'=>[
					'email'=>[
						'required'          =>true,
						'type'              =>[
							'type'   => 'string',
							'format' => 'email',
						]
					],
					'email_check'=>[
						'required'          =>true,
						'type'              =>[
							'type'   => 'string',
							'format' => 'email',
						]
					]
				]
			]
		);

		register_rest_route( $this->namespace, "/authapi/",
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'update_user_meta_all' ],
				'permission_callback' => [ $this, 'get_permissions_check' ],
				'args'=>[
					'email'=>[
						'required'          =>true,
						'type'              =>[
							'type'   => 'string',
							'format' => 'email',
						]
					],
					'room'=>[
						'type'      =>'string',
						'required'  => true
					],
					'name'=>[
						'type'      =>'string',
						'required'  => true
					],
					'title'=>[
						'type'      =>'string',
						'required'  => true
					],
					'about'=>[
						'type'      =>'string',
						'required'  => true
					],
					'friends' => [
						'type'     => 'array',
						'items'    => [
							'type'  => 'array',
							'items' => [
								'type' => 'string'
							],
						],
						'required' => true
					],

				]
			]
		);

        register_rest_route( $this->namespace, "/authapi/room/",
            [
                'methods'             => 'POST',
                'callback'            => [ $this, 'update_user_room' ],
                'permission_callback' => [ $this, 'get_permissions_check' ],
                'args'=>[
                    'email'=>[
                        'required'          =>true,
                        'type'              =>[
                            'type'   => 'string',
                            'format' => 'email',
                        ]
                    ],
                    'room'=>[
                        'type'      =>'string',
                        'required'  => true
                    ]
                ]
            ]
        );

        register_rest_route( $this->namespace, "/authapi/name/",
            [
                'methods'             => 'POST',
                'callback'            => [ $this, 'update_user_name' ],
                'permission_callback' => [ $this, 'get_permissions_check' ],
                'args'=>[
                    'email'=>[
                        'required'          =>true,
                        'type'              =>[
                            'type'   => 'string',
                            'format' => 'email',
                        ]
                    ],
                    'name'=>[
                        'type'      =>'string',
                        'required'  => true
                    ]
                ]
            ]
        );

        register_rest_route( $this->namespace, "/authapi/title/",
            [
                'methods'             => 'POST',
                'callback'            => [ $this, 'update_user_title' ],
                'permission_callback' => [ $this, 'get_permissions_check' ],
                'args'=>[
                    'email'=>[
                        'required'          =>true,
                        'type'              =>[
                            'type'   => 'string',
                            'format' => 'email',
                        ]
                    ],
                    'title'=>[
                        'type'      =>'string',
                        'required'  => true
                    ]
                ]
            ]
        );

        register_rest_route( $this->namespace, "/authapi/about/",
            [
                'methods'             => 'POST',
                'callback'            => [ $this, 'update_user_about' ],
                'permission_callback' => [ $this, 'get_permissions_check' ],
                'args'=>[
                    'email'=>[
                        'required'          =>true,
                        'type'              =>[
                            'type'   => 'string',
                            'format' => 'email',
                        ]
                    ],
                    'about'=>[
                        'type'      =>'string',
                        'required'  => true
                    ]
                ]
            ]
        );

        register_rest_route( $this->namespace, "/authapi/friends/",
            [
                'methods'             => 'POST',
                'callback'            => [ $this, 'update_user_friends' ],
                'permission_callback' => [ $this, 'get_permissions_check' ],
                'args'=>[
                    'email'=>[
                        'required'          =>true,
                        'type'              =>[
                            'type'   => 'string',
                            'format' => 'email',
                        ]
                    ],
                    'friends' => [
                        'type'     => 'array',
                        'items'    => [
                            'type'  => 'array',
                            'items' => [
                                'type' => 'string'
                            ],
                        ],
                        'required' => true
                    ],
                ]
            ]
        );

        register_rest_route( $this->namespace, "/authapi/avatar/",
            [
                'methods'             => 'POST',
                'callback'            => [ $this, 'update_user_avatar' ],
                'permission_callback' => [ $this, 'get_permissions_check' ],
                'args'=>[
                    'email'=>[
                        'required'          =>true,
                        'type'              =>[
                            'type'   => 'string',
                            'format' => 'email',
                        ]
                    ],
                    /*'avatar'=>[
                        'type'  => 'array',
                        'required'          =>true,
                    ]*/
                ]
            ]
        );

        register_rest_route( $this->namespace, "/authapi/(?P<email>.+)",
            [
                'methods'             => 'GET',
                'callback'            => [ $this, 'get_user_meta_all' ],
                'permission_callback' => [ $this, 'get_permissions_check' ],
                'args'=>[
                    'email'=>[
                        'required'          =>true,
                        'type'              =>[
                            'type'   => 'string',
                            'format' => 'email',
                        ]
                    ]
                ]
            ]
        );
	}

	function update_simple_user_meta_field(WP_REST_Request $request, $field){
        $all_param=$request->get_params();
        $email     = $all_param['email'];
        $user=get_user_by('email',$email);
        if (!$user) return new WP_Error( 'no_author_posts', 'User not found', array( 'status' => 404 ) );

        if (!isset($all_param[$field]) || !$all_param[$field]){
            return new WP_Error( 'rest_parameter_error', 'Parameter '.$field.' is invalid', array( 'status' => 500 ) );
        }
        update_user_meta($user->ID,$field,$all_param[$field]);

        return $this->update_success_responce();
    }

	function update_user_room(WP_REST_Request $request){
	    $field='room';
	    $response=$this->update_simple_user_meta_field($request,$field);
	    return $response;
    }

    function update_user_name(WP_REST_Request $request){
        $field='name';
        $response=$this->update_simple_user_meta_field($request,$field);
        return $response;
    }

    function update_user_title(WP_REST_Request $request){
        $field='title';
        $response=$this->update_simple_user_meta_field($request,$field);
        return $response;
    }

    function update_user_about(WP_REST_Request $request){
        $field='about';
        $response=$this->update_simple_user_meta_field($request,$field);
        return $response;
    }

    function update_user_friends(WP_REST_Request $request){
        $field='friends';
        $all_param=$request->get_params();
        $email     = $request['email'];
        $user=get_user_by('email',$email);
        if (!$user) return new WP_Error( 'no_author_posts', 'User not found', array( 'status' => 404 ) );

        $user_friends=new REST_UserFriendsData();
        $res=$user_friends->update_data($user->ID,$all_param[$field]);
        if ($res===false)
            return new WP_Error( 'data_update_error', 'friends data not updated', array( 'status' => 500 ) );

        return $this->update_success_responce();
    }

    function update_user_avatar(WP_REST_Request $request){
        $field='avatar';
        $all_param=$request->get_params();
        $email     = $request['email'];
        $user=get_user_by('email',$email);
        if (!$user) return new WP_Error( 'no_author_posts', 'User not found', array( 'status' => 404 ) );

        $result=$this->update_avatar_image($user, $field);
        if (is_wp_error($result)) return $result;

        return $this->update_success_responce();
    }

    function update_avatar_image($user, $field){
        if ( isset($_FILES[$field]) && !empty($_FILES[$field])){
            $old_attachment_url=get_user_meta($user->ID,$field,single);
            if ($old_attachment_url) $old_attachment_id=attachment_url_to_postid($old_attachment_url);
            if ($old_attachment_id) wp_delete_attachment($old_attachment_id,true);
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';
            add_filter( 'intermediate_image_sizes_advanced', 'filter_image_size', 10, 3 );
            $attachment_id = media_handle_upload( 'avatar',0);
            if (is_wp_error($attachment_id)){
                return new WP_Error( 'file_upload_error', 'File cant upload', array( 'status' => 500 ) );
            }
            update_user_meta($user->ID,$field,wp_get_attachment_url($attachment_id));
            return true;
        }else{
            return new WP_Error( 'file_upload_error', 'File cant upload, array FILE is empty', array( 'status' => 500 ) );
        }
    }

    function update_success_responce(){
        return rest_ensure_response(
            [
                "code"=>"success",
                "message"=>"Update successful",
                "data"=> [
                    "status"=>200
                ]
            ]
        );
    }

	function get_user_meta_all( WP_REST_Request $request ) {
		$email     = $request['email'];
		$user=get_user_by('email',$email);
		if (!$user) return new WP_Error( 'no_author_posts', 'User not found', array( 'status' => 404 ) );

		$result = get_user_meta($user->ID);
		if (isset($result['friends'])) unset($result['friends']);
		if (!is_array($result)) $result=[];
		$responce_array=[];
		foreach ($this->fields as $field){
			if (isset($result[$field])){
				if (is_serialized($result[$field][0])){
					$responce_array[$field]=unserialize($result[$field][0]);
				}else{
					$responce_array[$field]=$result[$field][0];
				}
			}else{
				if ($field=='friends'){
					$user_friends=new REST_UserFriendsData();
					$result=$user_friends->get_converted_data_by_user_id($user->ID);
					if ($result===false) $result=[];
					$responce_array[$field]=$result;
				}
			}
		}

		return [
			"code"=>"success",
			"message"=>"",
			"data"=> [
				"status"=>200,
				"data"=>$responce_array
			]
		];
	}

	function get_user_exist(WP_REST_Request $request){
		$email     = $request['email'];
		$user=get_user_by('email',$email);
		if (!$user) return false;
		return true;
	}

	function get_friend_email_status(WP_REST_Request $request){
		$email     = $request['email'];
		$email_check    = $request['email_check'];
		$user=get_user_by('email',$email);
		if (!$user) return new WP_Error( 'no_author_posts', 'User not found', array( 'status' => 404 ) );

		$user_friends=new REST_UserFriendsData();
		$result=$user_friends->find_row($user->ID, trim($email_check));

		if (is_null($result)){
			$responce_array=[
			'check_email'=>trim($email_check),
			'exist'=>'no'
			];
		}else{
			$responce_array=[
				'check_email'=>trim($email_check),
				'exist'=>'yes',
				'status'=>$result->status
			];
		}

		return [
			"code"=>"success",
			"message"=>"",
			"data"=> [
				"status"=>200,
				"data"=>$responce_array
			]
		];
	}

	function update_user_meta_all(WP_REST_Request $request){
		$all_param=$request->get_params();
		$email     = $request['email'];
		$user=get_user_by('email',$email);
		if (!$user) return new WP_Error( 'no_author_posts', 'User not found', array( 'status' => 404 ) );

		foreach ($this->fields as $field){
			if (isset($all_param[$field])){
				if ($field=='friends'){
					$user_friends=new REST_UserFriendsData();
					$res=$user_friends->update_data($user->ID,$all_param[$field]);
					if ($res===false)
						return new WP_Error( 'data_update_error', 'friends data not updated', array( 'status' => 500 ) );
				}else{
					update_user_meta($user->ID,$field,$all_param[$field]);
				}

			}else{
				if ($field=='avatar'){
					$result=$this->update_avatar_image($user,$field);
					if (is_wp_error($result)) return $result;
				}
			}
		}

		return $this->update_success_responce();
	}

	function get_permissions_check( WP_REST_Request $request ) {
		if (!is_user_logged_in()) return false;
		$current_user_id=get_current_user_id();
		$email     = $request['email'];
		$user=get_user_by('email',$email);

		if (!$user) return false;
		$is_owner=($current_user_id==$user->ID);
		return (current_user_can('edit_users') || $is_owner );
	}
}

/*function var_error_log( $object=null ){
	ob_start();
	print_r( $object );
	$contents = ob_get_contents();
	ob_end_clean();
	error_log( $contents );
}*/

function api_filter_image_size( $new_sizes, $image_meta, $attachment_id ){

	$new_sizes=[
		'thumbnail',
		'medium_large'
	];

	return $new_sizes;
}

add_action( 'rest_api_init', 'curad_register_rest_routes' );
function curad_register_rest_routes() {
	$controller = new REST_UserMeta_Controller();
	$controller->register_routes();
    //add_filter( 'rest_request_parameter_order', [$controller,'register_file_check_args_for_rest_request'],10,2);
}

function json_basic_auth_handler( $user ) {
	global $wp_json_basic_auth_error;

	$wp_json_basic_auth_error = null;

	// Don't authenticate twice
	if ( ! empty( $user ) ) {
		return $user;
	}

	// Check that we're trying to authenticate
	if ( !isset( $_SERVER['PHP_AUTH_USER'] ) ) {
		return $user;
	}

	$username = $_SERVER['PHP_AUTH_USER'];
	$password = $_SERVER['PHP_AUTH_PW'];

	/**
	 * In multi-site, wp_authenticate_spam_check filter is run on authentication. This filter calls
	 * get_currentuserinfo which in turn calls the determine_current_user filter. This leads to infinite
	 * recursion and a stack overflow unless the current function is removed from the determine_current_user
	 * filter during authentication.
	 */
	remove_filter( 'determine_current_user', 'json_basic_auth_handler', 20 );

	$user = wp_authenticate( $username, $password );

	add_filter( 'determine_current_user', 'json_basic_auth_handler', 20 );

	if ( is_wp_error( $user ) ) {
		foreach ($user->get_error_codes() as $code){
			$user->remove($code);
		}
		$user->add('auth_error','Auth error',array( 'status' => 403 ));
		$wp_json_basic_auth_error = $user;
		return null;
	}

	$wp_json_basic_auth_error = true;

	return $user->ID;
}
add_filter( 'determine_current_user', 'json_basic_auth_handler', 20 );

function json_basic_auth_error( $error ) {
	// Passthrough other errors
	if ( ! empty( $error ) ) {
		return $error;
	}

	global $wp_json_basic_auth_error;

	if (!(defined('REST_REQUEST') && REST_REQUEST)) return $error;

	$route = untrailingslashit( $GLOBALS['wp']->query_vars['rest_route'] );
	if ( empty( $route ) ) {
		$route = '/';
	}

	if (mb_strpos($route, '/user-data/v1/')!==0) return $error;
	if (mb_strpos($route, '/user-data/v1/exist/')!==0) return $error;


	return $wp_json_basic_auth_error;
}
add_filter( 'rest_authentication_errors', 'json_basic_auth_error' );

function curad_activation_plugin(){

	$user_friends=new REST_UserFriendsData();
	if (!$user_friends->table_exists()){
		$user_friends->create_table();
	}
}

register_activation_hook(__FILE__,'curad_activation_plugin');
?>