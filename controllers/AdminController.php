<?php

class AdminController extends BaseController
{
    private $template_path = '/views/layouts/admin/';

    public function __construct() {

        $this->model = new BaseModel();
        $this->view = new Application();
    }

    public function index()
    {
        $this->authentication_index();
    }

    public function login()
    {
        $this->authentication_login();
    }

    public function get_page( $params )
    {
        $this->base_get_page( $this->template_path, $params, 'admin' );
    }

    public function handleLogin()
    {
        $this->base_handleLogin( 'admins' );
    }

    public function handleLogout()
    {
        $this->base_handleLogout( 'admin' );
    }

    public function add( $params )
    {
        $this->params['page'] = implode( $params );
        $this->view->render($this->template_path . 'forms/master_form.php', $this->params);
    }

    public function handleAdd( $params )
    {
        if ( isset($_POST['btnSubmit']) ) {
            $this->params['page'] = implode( $params );

            if ( isset($_POST['password']) ) {
                $data_encryption = $this->encryption_data( $_POST['password'] );
            }

            if ( isset($_FILES['avatar']) ) {
                $result = $this->upload_image( 'avatar' );
            }

            if ( isset($_FILES['thumbnail']) ) {
                $result = $this->upload_image( 'thumbnail' );
            }

            switch ( $this->params['page'] ) {
                case 'admins':
                    $data_package_start = [
                        $username = $_POST['username'],
                        $password = $data_encryption['encryption'],
                        $role = $_POST['role'],
                        $email = $_POST['email'],
                        $encryption_iv = $data_encryption['encryption_iv'],
                        $encryption_key = $data_encryption['encryption_key']
                    ];
                    break;

                case 'users':
                    $data_package_start = [
                        $fullname = $_POST['fullname'],
                        $email = $_POST['email'],
                        $username = $_POST['username'],
                        $password = $data_encryption['encryption'],
                        $phone = $_POST['phone'],
                        $avatar = $_FILES['avatar']['name'],
                        $encryption_iv = $data_encryption['encryption_iv'],
                        $encryption_key = $data_encryption['encryption_key']
                    ];
                    break;

                case 'blogs':
                    $data_package_start = [
                        $title = $_POST['title'],
                        $summary = $_POST['summary'],
                        $content = $_POST['content'],
                        $thumbnail = $_FILES['thumbnail']['name'],
                        $published = $_POST['published']
                    ];
                    break;
            }
            $this->base_handleAdd( $this->params['page'], $data_package_start );
        }
    }

    public function edit( $params )
    {
        $this->params['page'] = $params[0];
        $this->params['id'] = $params[1];
        $model = $this->filter_modelName( $this->params['page'] );
        $this->params['post_list'] = $model::get_data_by_id( $this->params['page'], $this->params['id'] );
        $this->view->render($this->template_path . 'forms/master_form.php', $this->params);
    }

    public function handleEdit( $params )
    {
        if ( isset($_POST['btnSubmit']) ) {
            $this->params['page'] = $params[0];
            $this->params['id'] = $params[1];

            if ( isset($_POST['password']) ) {

                $result = $this->check_password( $this->params['id'], $_POST['password'], $this->params['page'] );

                if ( $result === 'match' ) {
                    $data_encryption['encryption'] = $_POST['password'];
                } else {
                    $data_encryption = $this->encryption_data( $_POST['password'] );
                }
            }

            if ( !isset($_POST['published']) ) {
                $published = 'off';
            } else {
                $published = 'on';
            }

            switch ( $this->params['page'] ) {
                case 'admins':
                    $data_package_start = [
                        $username = $_POST['username'],
                        $password = $data_encryption['encryption'],
                        $role = $_POST['role'],
                        $email = $_POST['email']
                    ];
                    break;

                case 'users':
                    $data_package_start = [
                        $fullname = $_POST['fullname'],
                        $email = $_POST['email'],
                        $username = $_POST['username'],
                        $password = $data_encryption['encryption'],
                        $phone = $_POST['phone'],
                        $avatar = $_POST['avatar']
                    ];
                    break;

                case 'blogs':
                    $data_package_start = [
                        $title = $_POST['title'],
                        $summary = $_POST['summary'],
                        $content = $_POST['content'],
                        $thumbnail = $_POST['thumbnail'],
                        $published
                    ];
                    break;

            }
            $this->base_handleEdit( $this->params['page'], $data_package_start, $this->params['id'] );

        }
    }

    public function handleDelete( $params )
    {
        $this->base_handleDelete( $params );
    }

    /*
    ** feature modules
    */
    public function authentication_index()
    {
        if ( isset($_SESSION['account']) ) {
            $this->view->render($this->template_path . 'index.php');
        } else {
            header( 'Location: ?controller=admin&action=login' );
        }
    }

    public function authentication_login()
    {
        if ( isset($_SESSION['account']) ) {
            header( 'Location: ?controller=admin' );
        } else {
            $this->view->render($this->template_path . 'pages/login.php');
        }
    }

    public function authentication_pages( $template, $params )
    {
        if ( isset($_SESSION['account']) ) {
            $this->view->render($template . 'index.php', $this->params);
        } else {
            header( 'Location: ?controller=admin&action=login' );
        }
    }
}

?>