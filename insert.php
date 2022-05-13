<?php

    require_once "models/usermodel.php";

    $model= new UserModel();
    $model->setTable('users');

    $data=[

    'username', 
    'password', 
    '500', 
    '1', 
    'email', 
    'nom', 
    'prenom', 
    'M', 
    'cin', 
    'grade', 
    'departement', 
    'service', 
    '1', 
    '1' ];
    $model->create($data);
    
?>