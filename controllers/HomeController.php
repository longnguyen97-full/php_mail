<?php

class HomeController extends BaseController
{
    private $template_path = '/views/layouts/client/';

    public function __construct() {
        $this->model = new BaseModel();
        $this->view = new Application();
    }

    public function index()
    {
        $this->view->render($this->template_path . 'index.php');
    }

    public function login()
    {
        $this->authentication_login_home();
    }

    public function get_page( $params )
    {
        $this->base_get_page( $this->template_path, $params );
    }

    public function get_page_condition( $params)
    {
        // params[0]=blogs&params[1]=published&params[2]=1
        $this->params['page'] = $params[0];
        $this->params['condition_key'] = $params[1];
        $this->params['condition_value'] = $params[2];
        $model = $this->filter_modelName( $this->params['page'] );
        $this->params['post_list'] = $model::get_data_by_condition( $this->params['page'], $this->params['condition_key'], $this->params['condition_value'] );
        $this->view->render( $this->template_path . 'index.php', $this->params );
    }

    public function handleLogin()
    {
        $this->base_handleLogin( 'users' );

    }

    public function handleLogout()
    {
        $this->base_handleLogout( 'home' );
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
                        $published = $_POST['published']
                    ];
                    break;
            }
            $this->base_handleEdit( $this->params['page'], $data_package_start, $this->params['id'] );
        }
    }

    public function contact()
    {
        $this->view->render($this->template_path . 'pages/contact.php');
    }

    /*
    ** feature modules
    */
    private function authentication_login_home()
    {
        if ( isset($_SESSION['user_account']) ) {
            header( 'Location: ?controller=home' );
        } else {
            $this->view->render($this->template_path . 'pages/login.php');
        }
    }

    public function support_data_for_user( $id )
    {
        return $this->base_support_data_for_user( $id );
    }
}

?>