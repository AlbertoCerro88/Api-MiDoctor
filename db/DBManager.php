<?php


class DBManager
{
    private $con;

  function __construct()
  {
      require_once dirname(__FILE__) . '\DBConnect.php';
      $db = new DBConnect();
      $this->con = $db->connect();
  }

	public function createUser($name, $lastName, $email, $password){
		$stmt = $this->con->prepare("INSERT INTO usuarios (id, nombre, apellido, email, password) VALUES (NULL, ?, ?, ?, ?);");
		$stmt->bind_param("ssss", $name, $lastName, $email, $password);
		if($stmt->execute())
			return true;
		return false;
	}

  public function checkExistUser($email){
    $result = false;
    $stmt = $this->con->prepare("SELECT id FROM usuarios WHERE email = ?");
		$stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();

    if(!isset($id)) $result = true;

    return $result;
	}

  public function getUsers(){
		$stmt = $this->con->prepare("SELECT id, nombre, apellido FROM usuarios");
		$stmt->execute();
		$stmt->bind_result($id, $nombre, $apellido);
		$users = array();

		while($stmt->fetch()){
			$temp = array();
			$temp['id'] = $id;
			$temp['nombre'] = $nombre;
			$temp['apellido'] = $apellido;
			array_push($users, $temp);
		}
		return $users;
	}
}


?>
