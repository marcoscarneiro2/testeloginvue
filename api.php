<?php 
$con = new mysqli("localhost","root","","vuephpcrud");
if($con -> connect_error){
    die("servidor não encontrado");
}
$res = array('error' => false);

$action = 'read';

if(isset($_GET['action'])){
    $action = $_GET['action'];
}
if($action == 'read'){
    $result = $con ->query("SELECT * FROM `usuario`");
    $usuario = array();

    while($row = $result -> fetch_assoc()){
        array_push($usuario,$row);
    }
    $res['usuario'] = $usuario;
}
if($action == 'create'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    $result = $con ->query("INSERT INTO `usuario` (`id`,`username`,`email`,`mobile`) 
    VALUES ('$id','$username','$email','$mobile')");

    if($result){
        $res['message'] = "Usuário adicionado";
    }else{
        $res['error'] = true;
        $res['message'] = "Erro ao adicionar Usuário";
    }
    
    $res['usuario'] = $usuario;
}

$con -> close();
header("Content-type: application/json");
echo json_encode($res);
die();
?>