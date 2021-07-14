<?php 

// Header Content
require './views/layouts/admin/header.php';

if ( isset($params) ) {
	if ( isset($params['post_list']) ) {
		require_once $params['page'] . '_form_edit.php';
	} else {
		require_once $params['page'] . '_form_add.php';
	}
}

// Footer Content
require './views/layouts/admin/footer.php';

?>