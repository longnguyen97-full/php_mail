<?php 

class Routing {

	public static function buildRoute() {

		$controllerName = ucfirst( strtolower(trim($_GET['controller'] ?? 'Home')) . 'Controller' );
		$actionName = strtolower(trim($_GET['action'] ?? 'index'));

		if ( ! file_exists(CONTROLLER_PATH . $controllerName . '.php') ) {
			header('Location: ?controller=base&action=error_not_found');
		}

		require_once CONTROLLER_PATH . $controllerName . ".php";

		$controller = new $controllerName();
		
		if ( ! method_exists(get_class($controller), $actionName) ) {
			header('Location: ?controller=base&action=error_not_found');
		}

		if ( isset($_GET['params'][0]) ) {
			$paramPage = $_GET['params'][0];
			$modelName = substr( $paramPage, 0, -1 );
			$modelName = ucfirst( strtolower(trim($modelName ?? 'Base' )) . 'Model' );
			require_once MODEL_PATH . $modelName . ".php";

			$params = $_GET['params'];
			return call_user_func( [$controller, $actionName], $params );
		}
		
		return $controller->$actionName();
	}

}

?>