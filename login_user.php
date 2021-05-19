<?php

use sarassoroberto\usm\model\UserModel;
use sarassoroberto\usm\validator\bootstrap\ValidationFormHelper;

require "./__autoload.php";

//session_start();

$action = './login_user.php';
$submit = 'accedi';

if($_SERVER['REQUEST_METHOD']==='GET'){

    list($email,$emailClass,$emailClassMessage,$emailMessage) = ValidationFormHelper::getDefault();
    list($password,$passwordClass,$passwordClassMessage,$passwordMessage) = ValidationFormHelper::getDefault();

}

if($_SERVER['REQUEST_METHOD']==='POST'){

    //list($email,$emailClass,$emailClassMessage,$emailMessage) = ValidationFormHelper::getDefault();
    //list($password,$passwordClass,$passwordClassMessage,$passwordMessage) = ValidationFormHelper::getDefault();
    $email = $_POST['email'];
    $password = $_POST['password'];
    //var_dump($email);
    //var_dump($password);
    $prova = new UserModel();
    $isValid = $prova->autenticate($email,$password);

    if($isValid){
        header('location: ./list_users.php');
    }else{
        $loginClass = "is-invalid";
        $loginClassMessage = "Invalid-feedback";
        $loginMessage = "Email o Password errata!";
    }

    //var_dump($prova->autenticate($email,$password));

    


}
include './src/view/login_user_view.php';