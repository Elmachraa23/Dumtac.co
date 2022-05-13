<?php
    require_once 'models/studiomodel.php';
    require_once 'core/controller.php';

    class StudioController extends Controller
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
    }
?>