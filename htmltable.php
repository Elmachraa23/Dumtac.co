<?php
// https://programminghistorian.org/en/lessons/creating-and-viewing-html-files-with-python
if (version_compare(phpversion(), '5.4.0', '<')) {
    if(session_id() == '') {
       session_start();
    }
}
else
{
   if (session_status() == PHP_SESSION_NONE) {
       session_start();
   }
}

    class HtmlTable
    {
        public static function showIcon( $icon, $color, $path, $id )
        {
            //if ( isset( $_SESSION['user'] ) )
            //    $path = $_SESSION['user']->role.'.'.$path;

            $str = '<a href="?page='.$path.'&id='.$id.'">';
            //<span class="glyphicon glyphicon-'.$icon;
            $str .= '<i class="icon fa fa-'.$icon.' text-'.$color.'"></i>';
            $str .= '</a>';
            return $str;
        }

        public static function showEye( $path, $id )
        {
            return self::showIcon( 'eye', 'success', $path, $id );
        }
       
        public static function showPencil( $path, $id )
        {
            return self::showIcon( 'pencil-square-o', 'warning', $path, $id );
        }

        public static function showTrash( $path, $id )
        {
            return self::showIcon( 'trash', 'danger', $path, $id );
        }

        public static function showPlus( $path, $id )
        {
            return self::showIcon( 'glyphicon-plus', 'red', $path, $id );
        }

        public static function showPagination( )
        {
            if ( isset( $_SERVER['db'] ) && $_SERVER['db']->isToShow === true ) // pagination si necessaire
            {								
                $str = '<nav aria-label="Page navigation">';
                    $str .= '<ul class="pagination pagination-sm">';
                        $str .= $_SERVER['db']->getPagination();                    
                    $str .= '</ul>';
                $str .= '</nav>';
                return $str;
            }
            return '';
        }

        public static function showAddDetailMateriels( $materiel, $materiels, $categorie = null  )
        {
            //echo '<div class="panel panel-default">'; // <!-- Default panel contents -->	
                echo '<div class="panel-heading" align="center">';
                    echo '<b><h3>';						
                        if ( isset($categorie) && $categorie!= null )
                        {
                            echo "Liste du matériel : ";
                            echo "<input type='submit' class='btn btn-primary' name='add' value='Ajouter' />";
                            echo $categorie->designation;
                            if ( isset($sous_categorie) )
                                echo ' --> '.$sous_categorie->designation;
                        }
                        else
                            echo 'Liste de tout le matériel';						
                                                    
                        echo '</h3></b>';				    
                echo '</div>';
                if ( !empty($materiels) )
                {
                    echo '<table class="table table-striped table-bordered">';
                        echo '<tr>';
                            $liste_indices = array_keys( (array)$materiels[0] );
                            foreach($liste_indices as $indice => $value )
                                echo '<th><center>'.$value.'</center></th>';
                            
                            echo '<th></th><th></th>';
                                
                            echo self::showPlus( 'addDetail', $materiel->id );
                        echo '</tr>';
                
                        foreach ( (array)$materiels as $cle_tableau => $ligne )
                        {
                            echo '<tr>';
                                foreach( $ligne as $cle => $valeur )
                                    echo '<td align="left">'.$valeur.'</td>';

                                echo self::showEye('detail', $ligne->id );
                                                            
                                if ( isset( $_SESSION['user'] ) )
                                { 
                                    echo self::showPencil('editDetail', $ligne->id );
                                    echo self::showTrash('deleteDetail', $ligne->id );
                                }
                            echo '</tr>';
                        }			        	
                    echo '</table>';
                }
                else
                {
                    echo "<center><h1>Liste vide !!!</h1></center>";
                    echo self::showPlus( 'addDetail', $materiel->id );
                }
            //echo '</div>';

            echo self::afficherPagination(); // afficher pagination
        }

        public static function showDetailMateriels( $materiels, $materiel=null, $categorie = null  )
        {
            echo '<div class="panel panel-default">'; // <!-- Default panel contents -->	
                echo '<div class="panel-heading" align="center">';
                    echo '<b><h3>';						
                        if ( isset($categorie) && $categorie!= null )
                        {
                            echo "Liste du matériel : ";
                            echo $categorie->designation;
                            if ( isset($sous_categorie) )
                                echo ' --> [ '.$sous_categorie->designation. ' ]';
                        }
                        else
                            echo 'Liste du detail matériel';
                    echo '</h3></b>';				    
                echo '</div>';
                if ( !empty($materiels) )
                {
                    echo '<table class="table table-striped table-bordered">';
                        echo '<tr>';
                            $liste_indices = array_keys( (array)$materiels[0] );
                            foreach($liste_indices as $indice => $value )
                                if ( $value != "id_detail_materiels" )
                                    echo '<th><center>'.$value.'</center></th>';
                        echo '</tr>';
                
                        foreach ( (array)$materiels as $cle_tableau => $ligne )
                        {
                            echo '<tr>';
                                foreach( $ligne as $cle => $valeur )
                                    if ( $cle != "id_detail_materiels" )
                                        echo '<td align="left">'.$valeur.'</td>';
                                
                                echo self::showEye( 'detail', $ligne->id );
                                
                                if ( isset( $_SESSION['user'] ) )
                                {
                                    echo self::showPencil( 'editDetail', $ligne->id );
                                    echo self::showTrash( 'delDetail', $ligne );
                                }
                    
                            echo '</tr>';
                        }			        	
                    echo '</table>';
                }
                else{
                    echo "<center><h1>Liste vide !!!</h1></center>";
                    echo self::showPlus( 'addDetail', $materiel->id );
                }
            echo '</div>';

            echo self::showPagination(); // afficher pagination
        }

        public static function showTitleOfTable()
        {
            if ( isset($categorie) && $categorie!= null )
            {
                echo "Liste du matériel : ";
                echo $categorie->designation;
                if ( isset($sous_categorie) )
                    echo ' --> '.$sous_categorie->designation;
            }
            else
                echo 'Liste de tout le matériel';
        }
        
        public static function getHtmlListe( $class, $liste, $categorie = null  )
        {
            $str = '<div class="panel panel-default">
                <div class="panel-heading" align="center">
                    <b><h3>Liste de tout le matériel</h3></b></div>';
    
            $str .= '<table class="table table-striped table-bordered">
                    <tr>';
                $liste_indices = array_keys( (array)$liste[0] );
                
                foreach($liste_indices as $key => $value )
                    if ($key != 'id' )
                        $str .= '<th><center>'.$value.'</center></th>';
                
                $str .= '<th></th></tr>';
                
                foreach ( $liste as $ligne )
                {
                    $str .= '<tr>';
                        foreach( $ligne as $key =>$valeur )
                        {
                            if ($key != 'id' )
                            {
                                $str .= '<td align="left">'.$valeur.'</td>';
                            }
                        }
                        
                        $str .= '<td align="center" width="130px;">';
                        $str .= self::showEye( $class.'/show', $ligne->id );
            
                        if ( isset( $_SESSION['logged'] ) )
                        {
                            $str .= self::showPencil( $class.'/edit', $ligne->id );
                            $str .= self::showTrash( $class.'/delete', $ligne->id );
                        }
                        $str .= '</td></tr>';
                }	        	
            $str .= '</table></div>';
            return $str;
        }

        public static function showCategories( $categories )
        {
            echo '<div class="panel panel-default">';
                echo '<div class="panel-heading" align="center"><b><h3>Catégories</b></h3></div>';
                echo '<ul>';
                    if ( isset( $_SESSION['user'] ) )
                    {
                        echo "<br/>
                        <li>
                            <a href='?page=admin.materiel.index'>
                            Tous le matériel
                        </a>
                        </li>";
                        foreach( $categories as $categorie )
                        {
                            echo '<li>';
                                echo showEye( 'categorie.show', $categorie->id );
                                echo ' <a href="'.$categorie->url.'">';
                                    echo $categorie->designation;
                                echo '</a>';			        		
                            echo '</li>';
                        }
                    }
                    else
                    {
                        foreach( $categories as $categorie )
                        { 
                            echo '<li>';
                                echo '<a href="'.$categorie->url.'">';
                                    echo $categorie->designation;
                                echo '</a>';
                            echo '</li>';
                        }

                        echo "<br>
                        <li>
                            <a href='?page=materiel.index&cp=1'>Tous le matériel</a>
                        </li>";
                    }	
                echo '</ul>';
            echo '</div>';	
        }

        public static function showSousCategories( $categorie, $sous_categories )
        {
            echo '<div class="panel panel-default">';
                echo '<div class="panel-heading" align="center">';
                    echo '<h3><b>Sous-Catégories</b></h3>';
                echo '</div>';

                echo '<ul>';
                    if( $sous_categories != null )
                    {
                        echo showEye( 'categorie', $categorie->id.'"&cp=1>' );
                        echo 'Tout le materiel';
                        
                        foreach( $sous_categories as $sous_categorie )
                        {
                            echo '<li>';
                                echo 'categorie'.$categorie->id.'&id_sc='.$sous_categorie->id.'">';
                                echo $sous_categorie->designation;
                                echo '</a>';
                            echo '</li>';
                        }
                    }				
                echo '</ul>';
            echo '</div>';
        }
    }
?>