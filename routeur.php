<?php
    class Routeur
    {
        public function __construct()
        {
        }

        public function run()
        {
            if( isset( $_GET['page'] ) && !empty(  $_GET['page'] ) )
                $params = $_GET['page'];
            else
                $params = "home/index";
            
            $params = explode( '/', $params );
            
            $model = array_shift( $params );
            if ( empty($params[0]) )
                $params[0]='index';

            //var_dump($params);die;

            $action = isset($params[0]) ? array_shift($params) : 'index';
           
            if (!empty($params) )
            {
                $model = $action;
                $action = $params[0];
            }

            $controller = ucfirst( $model ).'Controller';

            require_once CONTROLLERS.$controller.".php";

            $controller = new $controller();
            
            if( method_exists( $controller, $action ) )
                /*(isset($params[0])) ? 
                call_user_func_array([$controller,$action], $params) : */
                $controller->$action( $params );
            else
            {
                http_response_code(404);
                echo "La page recherchée n'existe pas";
                $erreur = new ErreurController();
                $erreur->page404();
            }            
        }        
    }
?>