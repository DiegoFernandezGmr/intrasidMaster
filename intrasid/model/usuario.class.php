<?php
class Usuario {
	function validarUsuario($db,$email,$password){
                $email = addslashes(strtolower(trim($email)));
                $password = md5(trim($password));
		$sql = "SELECT id FROM usuario WHERE email='$email' AND password='$password'";
		$res = $db->query($sql)->fetch();
		if($res['id']){
			return true;
		}else{
			return false;
		}
	}

	function getUsuarioPorEmail($db,$email){
		$sql = "SELECT id,nombre,email,idPerfil FROM usuario WHERE email='$email' ";
		$res = $db->query($sql)->fetch();
		return $res;
	}
    
    function setEmail($db,$id,$email){
        $sql="UPDATE usuario SET 
                     email= '".$db->quote($email)."'
              WHERE id=".$id;
        $res = $db->exec($sql);
        return $res;
    }
    
    function setNombre($db,$id,$nombre){
         $sql="UPDATE usuario SET 
                     nombre= '".$db->quote($nombre)."'
              WHERE id=".$id;
        $res = $db->exec($sql);
        return $res;
    }
    function setPassword($db,$id,$password){
         $sql="UPDATE usuario SET 
                     password= '".md5($password)."'
              WHERE id=".$id;
        $res = $db->exec($sql);
        return $res;
    }
}
?>
