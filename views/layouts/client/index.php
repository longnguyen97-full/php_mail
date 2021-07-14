<?php 

// Header Content
require 'header.php';

// Main Content
if ( ! isset($params['page']) ) {
	$params['page'] = 'home';
}
require 'pages/'.$params['page'].'.php';

// Footer Content
require 'footer.php';

?>