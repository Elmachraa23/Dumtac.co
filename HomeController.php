<?php
    require_once 'core/controller.php';
    
    class HomeController extends Controller
    {
        public function __construct()
        {
            //var_dump( $model, $isToRender, $controller );die;
            parent::__construct();//, $isToRender);//, $action );
        }

        public function index()
        {
            $liste = parent::index();
            return $this->render( __FUNCTION__ );
        }

        public function contact()
        {
            //$liste = parent::index();
            return $this->render( __FUNCTION__ );
        }

        
    }
?>