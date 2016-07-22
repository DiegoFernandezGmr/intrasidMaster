<?php
class sesion{

    function __construct() {		
	if(!session_id()) session_start();		
    }	
	function iniciaDatosSesion($datosUsuario){
		if(!session_id()) session_start();
		$_SESSION['idUsuario'] = $datosUsuario['id'];
		$_SESSION['nombreUsuario'] = $datosUsuario['nombre'];
		$_SESSION['emailUsuario'] = $datosUsuario['email'];
		$_SESSION['perfilUsuario'] = $datosUsuario['idPerfil'];
		$_SESSION['usuarioValido'] = 1;
	}

	function iniciaSesion(){
		if(!session_id()) session_start();
	}

	
	function validarSesion(){
            if(isset($_SESSION['usuarioValido']) && $_SESSION['usuarioValido']==1){
                return true;
            }else{
                return false;
            }
	}

	function getNombreUsuario(){
		if(isset($_SESSION['nombreUsuario'])){
			return $_SESSION['nombreUsuario'];
		}else{
			return false;
		}
	}

	function getEmailUsuario(){
		if(isset($_SESSION['emailUsuario'])){
			return $_SESSION['emailUsuario'];
		}else{
			return false;
		}
	}
    function cierraSesion(){
		// Destruir todas las variables de sesión.
		$_SESSION = array();

		// Si se desea destruir la sesión completamente, borre también la cookie de sesión.
		// Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}

		// Finalmente, destruir la sesión.
		session_destroy();		
	}

}
?>
