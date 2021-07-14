<?php 

// Header Content
require 'header.php';

// dashboard
if ( ! isset($params['page']) ) {
	$params['page'] = 'dashboard';
}
require 'pages/'.$params['page'].'.php';

// Footer Content
require 'footer.php';

?>