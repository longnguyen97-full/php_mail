<?php

class BaseController
{
	public function __construct() {
		$this->model = new BaseModel();
		$this->view = new Application();
	}

	public function base_get_page( $template, $params )
	{
		$this->params['page'] = $params[0];
		$model = $this->filter_modelName( $this->params['page'] );
    	$this->params['post_list'] = $model::get_data( $this->params['page'] );
        $this->authentication_pages( $template, $this->params );
	}

	public function base_handleLogin( $table )
	{
		$this->is_post_method();

        $username = $_POST['username'];
        $password = $_POST['password'];

        // fetch data to authenticate
        $auth_data = $this->model->base_authenticate( $username, $password, $table );

        // result
    	$flag = 0;
        foreach ( $auth_data as $item ) {
        	if ( $item['username'] === $username ) {

        		$flag = 1;
        		$decryption = $this->decryption_data( $item['password'], $item['encryption_iv'] );

        		if ( $decryption === $password ) {

        			$flag = 2;
        			if ( $table === 'users' ) {
	        			$_SESSION['user_account'] = 1;
        			} else {
	        			$_SESSION['account'] = 1;
        			}

        		}
        	}
        }

        switch ( $flag ) {
        	case 1:
        		$_SESSION['message'] = "<p class='text-danger mt-3'>Password is wrong!</p>";
        		break;

        	case 2:
        		unset( $_SESSION['message'] );
        		break;

        	default:
        		$_SESSION['message'] = "<p class='text-danger mt-3'>Username is wrong!</p>";
        		break;
        }

        if ( !isset($_SESSION['message']) ) {
        	if ( isset($_SESSION['account']) ) {
        		header( 'Location: ?controller=admin' );
        	} else {
        		$user_cache = self::base_support_data_for_user( $item['id'] );
        		$_SESSION['user_cache'] = $user_cache;
        		header( "Location: ?controller=home" );
        	}
        } else {
	        header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

	}

	public function base_handleLogout( $side )
	{
		if ( $side === 'home' ) {
			unset($_SESSION['user_account']);
			unset($_SESSION['user_cache']);
			header( "Location: ?controller=home" );
		} else {
			unset($_SESSION['account']);
			header( "Location: ?controller=".$side."&action=login" );
		}
	}

	public function base_handleAdd( $page, $data_package_prepare )
	{
        // escape data from whitespace
        $escape_flag = $this->escape_whitespace( $data_package_prepare );
        if ( $escape_flag === 0 ) {
            $_SESSION['message'] = '<p class="text-danger mt-3">Can\'t be blank!</p>';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        // MODEL => insert data
        if ( $escape_flag !== 0 ) {
			$model = $this->filter_modelName( $this->params['page'] );
	        $result = $model::handleAdd( $data_package_prepare );
	    }

        // print result and redirect
	    $this->print_result( $result, 'create' );
	}

	public function base_handleEdit( $page, $data_package_prepare, $id )
	{
        // escape data from whitespace
        $escape_flag = $this->escape_whitespace( $data_package_prepare );
        if ( $escape_flag === 0 ) {
            $_SESSION['message'] = '<p class="text-danger mt-3">Can\'t be blank!</p>';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

        // add concatenation operator to elements
        $data_package_values = $this->handle_value( $data_package_prepare );

        // MODEL => update data
        if ( $escape_flag !== 0 ) {
			$model = $this->filter_modelName( $this->params['page'] );
	        $result = $model::handleEdit( $data_package_values, $id );
	    }

        // print result and redirect
	    $this->print_result( $result, 'update' );
	}

    public function base_handleDelete( $params )
    {
		$this->params['page'] = $params[0];
		$this->id = $params[1];
		$model = $this->filter_modelName( $this->params['page'] );
        $result = $model::handleDelete( $this->params['page'], $this->id );

        // print result and redirect
	    $this->print_result( $result, 'delete' );
    }

	/*
	** feature modules
	*/
	public function filter_modelName( $data )
	{
		return ucfirst(substr( $data, 0, -1 )) . 'Model';
	}

	public function is_post_method()
	{
		if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
			die();
		}
	}

	public function escape_whitespace( $data_package_prepare )
	{
        foreach ($data_package_prepare as $item) {
        	// loop through to the end
        }

		if ( empty(trim($item)) ) {
			return $escape_flag = 0;
		} else {
			return $escape_flag = 1;
		}
	}

	public function error_not_found()
	{
		$this->view->render('/views/layouts/404.php');
	}

	public function encryption_data( $pasword )
	{
		$encryption_iv = '';
		for($i = 0; $i < 16; $i++) {
		    $encryption_iv .= mt_rand( 0, 9 );
		}
		$encryption_key = sha1( 'training_mvc' );
		$encryption = openssl_encrypt( $pasword, CIPHERING, $encryption_key, OPTIONS, $encryption_iv );

		return $data_encryption = [
			'encryption_iv' => $encryption_iv,
			'encryption_key' => $encryption_key,
			'encryption' => $encryption
		];
	}

	public function decryption_data( $password, $encryption_iv )
	{
		$encryption = $password;
		$decryption_iv = $encryption_iv;
		$decryption_key = sha1( 'training_mvc' );
		return $decryption = openssl_decrypt ( $encryption, CIPHERING, $decryption_key, OPTIONS, $decryption_iv );
	}

	public function check_password( $id, $password, $table )
	{
		$new_password = $password;
		$current_password = $password;

		$result = $this->model->get_password( $id, $current_password, $table );

		foreach ($result as $value) {
			// loop through an array
		}

		if ( isset($value) ) {
			if ( $value[0] === $new_password ) {
				return 'match';
			}
		} else {
			return 'not_match';
		}
	}

	public static function upload_image( $img_name )
	{
		// check data
		if ( ! isset($_FILES["{$img_name}"]) ) {
			die();
		}

		// folder contain file upload
		$target_dir = "assets/uploads/";
		$target_file = $target_dir . basename($_FILES["{$img_name}"]["name"]);
		$allowUpload = true;

		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$maxfilesize   = 800000;
		$allowtypes    = array('jpg', 'png', 'jpeg', 'gif');

		if( isset($_POST["submit"]) ) {
		  $check = getimagesize($_FILES["{$img_name}"]["tmp_name"]);
		  if( $check !== false ) {
		      echo "This is image file - " . $check["mime"] . ".";
		      $allowUpload = true;
		  } else {
		      echo "This is not image file.";
		      $allowUpload = false;
		  }
		}

		// check duplicate
		if ( file_exists($target_file) ) {
		  echo "File is exists!";
		  $allowUpload = false;
		}

		// check oversize
		if ( $_FILES["{$img_name}"]["size"] > $maxfilesize )
		{
		  echo "Couldn't uploade image is over  $maxfilesize (bytes).";
		  $allowUpload = false;
		}

		// check type of file
		if ( ! in_array($imageFileType,$allowtypes ) )
		{
		  echo "Allow only these formats JPG, PNG, JPEG, GIF";
		  $allowUpload = false;
		}

		if ( $allowUpload )
		{
		  // move tmp_file to folder where need to storage
		  if ( move_uploaded_file($_FILES["{$img_name}"]["tmp_name"], $target_file) )
		  {
		      echo "File ". basename( $_FILES["{$img_name}"]["name"]). " Uploaded successfully";

		      echo "File saves as " . $target_file;

		  }
		  else
		  {
		      echo "It has occured!";
		  }
		}
		else
		{
		  echo "Couldn't upload file, maybe file was too large, or incorrect format ...";
		}

		return;
	}

	public function handle_value( $data_package_prepare )
	{
		foreach ($data_package_prepare as $value) {
			$data_package_values[] = "'". $value ."'";
		}
		return $data_package_values;
	}

	public function handle_field_value( $data_package_values, $fields )
	{
		$field_value = '';
		$i = -1;
		foreach ($fields as $key) {
			$i++;

			$field_value .= "{$key} = {$data_package_values[$i]}, ";

			// handle published
			if ( $key === 'published' ) {
				$published = 'published = ';
				$_value = trim($data_package_values[$i], "'");

				if ( $_value === 'on' ) {
					$boolean = 1;
				} else {
					$boolean = 0;
				}

			}
		}

		$field_value = substr( $field_value, 0, -2 );

		// handle published
		if ( isset($published) ) {
			$field_value = str_replace($published."'{$_value}'", $published.$boolean, $field_value);
		}

		return $field_value;
	}

	public function print_result( $result, $act )
	{
        do {
            if ( isset($result) ) {

            	$Act = ucfirst($act);

                if ( $result === "allow_{$act}" ) {

                    $_SESSION['message'] = "<p class='text-success mt-3'>{$Act} successfully!</p>";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    break;
                }
            }
            $_SESSION['message'] = "<p class='text-danger mt-3'>{$Act} failed!</p>";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } while(0);
	}

	//
    public function base_support_data_for_user( $id )
    {
    	return $this->model->base_support_data_for_user( 'users', $id );
    }
}
?>