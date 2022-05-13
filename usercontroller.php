<?php
    require_once 'models/usermodel.php';
    require_once 'core/controller.php';
    
    class UserController extends Controller
    {
        public function __construct( $model )
        {
            parent::__construct( $model );
        }

        public function index()
        {            
            $content = parent::index();
            $titre = "Liste des produits";
            $data =
            [
                "titre" => $titre,
                "content" => $content         
            ];
        
            $this->render( __FUNCTION__, $data, true );
        }

        public function login()
        {
            return $this->render( __FUNCTION__, [], true );
        }

        public function insert()
        {
            return $this->render( __FUNCTION__ );
        }

        public function logout()
        {
            
            $this->render( __FUNCTION__, [], true );
        }

        public function passedit()
        {
            
            $this->render( __FUNCTION__ );
        } 
        public function register()
        {
            $this->render( __FUNCTION__, [], true );
        }

        public function profil()
        {
            $this->render( __FUNCTION__, [], true );
        }
    }
?>