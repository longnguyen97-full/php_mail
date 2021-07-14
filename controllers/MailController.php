<?php

class MailController extends BaseController
{
	private $template_path = '/views/layouts/contact/';

	public function __construct() {
	    $this->model = new BaseModel();
	    $this->view = new Application();
	}

	public function index()
	{
	    $this->view->render($this->template_path . 'form.php');
	}

	public function confirm()
	{
	    $this->view->render($this->template_path . 'form_confim.php');
	}

	public function send_mail()
	{
		require(VIEW_PATH . '/layouts/contact/config_mail.php');

		if(isset( $_POST['name']))
		$name = $_POST['name'];
		if(isset( $_POST['email']))
		$email = $_POST['email'];
		if(isset( $_POST['message']))
		$message = $_POST['message'];
		if(isset( $_POST['subject']))
		$subject = $_POST['subject'];

		$mail->setFrom($email, $name);
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body    = $message;

		$mail->send() or die("Error!");
		$this->view->render($this->template_path . 'form_confirm.php');
    }
}

?>