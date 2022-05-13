<?php
    require_once 'models/agencymodel.php';
    require_once 'core/controller.php';

    class AgencyController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            //$liste = parent::index();
            return $this->render( __FUNCTION__ );
        }

        public function strategie_branding()
        {
            //$liste = parent::index();
            return $this->render( __FUNCTION__ );
        }

        public function content_factory()
        {
            //$liste = parent::index();
            return $this->render( __FUNCTION__ );
        }

        public function social_media()
        {
            //$liste = parent::index();
            return $this->render( __FUNCTION__ );
        }
    }
?>