<?php
    require_once 'core/database.php';
    require 'core/htmltable.php';

    abstract class Model
    {
        public $table;
    
        protected function __construct()
        {
        }

        public function setTable( $table )
        {
            $this->table = $table;
        }

        public function getTable()
        {
            return $this->table;
        }

		public static function getLastID()
	    {
            $pdo = Database::getInstance();
		    return $pdo->lastInsertId();
	    }

        public function requete( 
            string $sql, 
            bool $isToFetchOne = false,
            array $data = null
        )
        {
          try 
		    {
                $pdo = Database::getInstance();
                
                if ( $data != null )
                {
                    $resultat = $pdo->prepare( $sql );// PDOStatement
					$resultat->execute( $data );
                }
                else
                    $resultat = $pdo->query( $sql );

			    if ( 
                    strpos( $sql, 'INSERT' ) === 0 ||
                    strpos( $sql, 'DELETE' ) === 0 ||
                    strpos( $sql, 'UPDATE' ) === 0 
                )
                    return $resultat;
                else // SELECT
                {
                    if ( $isToFetchOne )
                        return $resultat->fetch();
                    else
                        return $resultat->fetchAll();
                }                    
            }
            catch( PDOExecption $e ) 
            {
                print "Error!: " . $e->getMessage() . "</br>";
                return null;
            }
        }

        protected function getAll( string $sql = '', array $attributes = null )
        {
            if ( $sql == '' )
                $sql = "SELECT * FROM ".$this->table;

            $liste = $this->requete( $sql, false, $attributes );

            return HtmlTable::getHtmlListe( $liste );
        }

        protected function getOne( string $sql='', array $attributs = null  )
        {
            return $this->requete( $sql, true, $attributs );
        }

        public function getNbreElements( string $sql='', array $attributs = null ) : int
        {
            try 
		    {
                $resultat = $this->requete( $sql, false, $attributs );

                return 4;
                /*if ( $resultat === null )
                    return 0;
                else
                    return $resultat->rowCount();*/
            }
            catch( PDOExecption $e ) 
            {
                print "Error!: " . $e->getMessage() . "</br>";
                return -1;
            }
        }

        // CRUD

        // chercher touss les enregistrements
        public function findAll($sql='')
        {
            return $this->getAll($sql);         
        }

        // chercher un ou plusieurs enregistrements ayant les critères suivant
        public function findBy($param)
        {
            $liste = $this->getFields();
            
            $champs = [];
            $valeurs = [];

            // On boucle pour éclater le tableau
            foreach( $liste as $key => $value )
            {
                $champs[] = "$value->Field = ?";
                $valeurs[] = $param;
            }

            // On transforme le tableau "champs" en une chaine de caractères
            $liste_champs = implode(' OR ', $champs);
            $liste_valeurs = implode(' , ', $valeurs);
            
            // On exécute la requête
            $sql = 'SELECT * FROM '.$this->table.' WHERE '. $liste_champs;
            
            return $this->requete( $sql, false, $valeurs ); // all
        }

        public function find( int $id )
        {
            $sql = "SELECT * FROM $this->table WHERE id = ?";
            return $this->requete( $sql, true, [$id] ); // all
        }

        public function create( $data )
        {
            $champs = [];
            $inter = [];
            $valeurs = [];

            $fields = $this->getFields();
            //var_dump($fields);die;
            // On boucle pour éclater le tableau
            foreach( $fields as $valeur )
            {
                $champs [] = $valeur->Field;
                $inter [] = '?';
                /*// INSERT INTO annonces (titre, description, actif) VALUES (?, ?, ?)
                if( $valeur !== null && $champ !== "db" && $champ !== "table" )
                {
                    $champs [] = $valeur->Field;
                    $inter [] = '?';
                    //$valeurs [] = $valeur;
                }*/
            }

            // On transforme le tableau "champs" en une chaine de caractères
            $liste_champs = implode( ', ', $champs );
            $liste_inter = implode( ', ', $inter );

            //var_dump( $liste_champs);
            // On exécute la requête
             $sql = "INSERT INTO ".$this->table." ( ". $liste_champs." ) VALUES (".$liste_inter.")";
            
           // var_dump( $sql );die;
            
            return $this->requete( $sql, false, $data );
        }

        public function update( int $id, Model $model )
        {
            
            $champs = [];
            $valeurs = [];

            // On boucle pour éclater le tableau
            foreach($model as $champ => $valeur){
                // UPDATE annonces SET titre = ?, description = ?, actif = ? WHERE id= ?
                if( $valeur !== null && $champ !== "b" && $champ !== "table" )
                {
                    $champs [] = $champ." = ?";
                    $valeurs [] = $valeur;
                }
            }

            $valeurs [] = $id;

            // On transforme le tableau "champs" en une chaine de caractères
            $liste_champs = implode( ', ', $champs );

            // On exécute la requête
            $sql = "UPDATE ".$this->table." SET ". $liste_champs." WHERE id = ?";
            return $this->requete( $sql, false, $valeurs);
        }

        public function delete(int $id)
        {
            $sql = "DELETE FROM ". $this->table. " WHERE id = ?";
            return $this->requete( $sql, false, [$id] );
        }

        public function getFields()
        {
            $sql = "DESCRIBE ".$this->table;
            
            return $this->requete( $sql, false, null );
        }
    }
?>