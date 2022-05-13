<?php
    require_once 'core/model.php';

    class UserModel extends Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function getUserByUsername( $username )
        {
            $sql = "SELECT * from ".$this->table." WHERE username=?";
            return $this->requete( $sql, true, [ $username ] );            
        }

        public function getUserByEmail( $email )
        {
            $sql = "SELECT * from ".$this->table." WHERE email=?";
            return $this->requete( $sql, true, [ $email ] );
        }

        public function getUser( $username_email )
        {
            $sql = "SELECT * from ".$this->table.
            " WHERE username=? OR email=?";
            return $this->requete( $sql, true, [ $username_email, $username_email ] );
        }

        public function insertUser( $data )
        {
            $sql = "INSERT INTO users (
                username, email, password, id_admin, nom, prenom, sexe, cin, grade,
                departement, service, actif, banned
            ) VALUES ( ?, ?, ?, '1', 
            'x', 'x', 'x', 'x', 
            'x','x','x', '0', '0' )";

            //var_dump($sql);die;
            
            return $this->requete( $sql, false, $data );
        }

        public function setTable($table)
        {
            $this->table = $table;
        }
    }
?>