<?php



	require_once '../db/DBManager.php';

	$response = array();


	if(isset($_GET['op'])){

		switch($_GET['op']){

			case 'addUser':
				if(!empty($_POST['name']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['password'])){
					$db = new DBManager();

          if($db->checkExistUser($_POST['email'])){
  					if($db->createUser($_POST['name'], $_POST['lastName'], $_POST['email'], $_POST['password'])){
  						$response['error'] = false;
  						$response['message'] = 'Usuario creado correctamente';
  					}else{
  						$response['error'] = true;
  						$response['message'] = 'Error al crear el usuario';
  					}
          }else{
            $response['error'] = true;
            $response['message'] = 'Ya existe el usuario';
          }
				}else{
					$response['error'] = true;
					$response['message'] = 'Faltan párametros requeridos';
				}
			break;
			case 'getUsers':
				$db = new DBManager();
				$users = $db->getUsers();
				if(count($users)<=0){
					$response['error'] = true;
					$response['message'] = 'No hay usuarios en BD';
				}else{
					$response['error'] = false;
					$response['users'] = $users;
				}
			break;
			default:
				$response['error'] = true;
				$response['message'] = 'No hay proceso';
		}

	}else{
		$response['error'] = false;
		$response['message'] = 'Peticiòn inválida';
	}

	echo json_encode($response);
