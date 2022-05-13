<?php
    abstract class Controller
    {
        protected $model;
        protected $class;
        protected $menu;
        protected function __construct()
        {
            $model = get_class( $this );            
            $model = str_replace( 'Controller', '', $model );
            $this->class = strtolower( $model );

            if ( $model != 'Home' )
            {
                $table = $this->class.'s';
                $model = $model. "Model";           
                require_once MODELS . $model. ".php";
                $this->model = new $model();
                $this->model->setTable( $table );
            }
        }
        
        public function getModel()
        {
            return $this->model;
        }

        public function index()
        {
            if ( $this->model )
            {
                $content = $this->model->findAll();                
                $this->render( __FUNCTION__, ['content' => $content] );
            }
            else
                $this->render( __FUNCTION__);
        }

        /**
         * Afficher une vue
         *
         * @param string $fichier
         * @param array $data
         * @return void
         */
        public function render( string $method, array $data = [], $template="default" )
        {
            $file = VIEWS . $this->class . "\\" . $method . ".php";                        
            extract($data); // Récupère les données et les extrait sous forme de variables

            ob_start(); // On démarre le buffer de sortie

            require_once( $file ); // Crée le chemin et inclut le fichier de vue
            $view = ob_get_clean(); // On stocke le contenu dans $content
            
            $default = VIEWS . $template.".php";
            require_once( $default );
        }

        public function getParams( $key, $value='' )
        {
            return isset( $_GET[$key] ) ? $_GET[$key] : $value;
        }
    }
?>