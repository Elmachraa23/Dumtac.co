<?php
    if ( isset($this->menu ) )
        echo $this->menu;
?>

<?php

    /*if (version_compare(phpversion(), '5.4.0', '<')) {
        if(session_id() == '') {
           session_start();
        }
    }
    else
    {
       if (session_status() == PHP_SESSION_NONE) {
           session_start();
       }
    }*/

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if ( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
        if ( isset( $_POST['login'] ) )
        {       
            if ( !isset( $_POST["username"] ) )
                echo "Please enter your identifiers";
            else
            { 
                $usermodel = $this->model;
                //var_dump($usermodel);die;
                
                $username = $_POST["username"];
                $password = $_POST['password'];

                if ( filter_var( $username, FILTER_VALIDATE_EMAIL ) )
                    $user = $usermodel->getUserByEmail( $username );
                else
                    $user = $usermodel->getUserByUsername( $username );
                
                if ( $user && password_verify( $password, $user->password ) )
                {
                    $_SESSION['logged'] = $user;
                    header("Location: ?page=user/profil");
                }   
                else
                    echo "Impossible de se connecter !!!";
            }
        }
    }
?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 container bg-light">
        <div class="wrapper-main">
            <div class="container">
                <h2>Page de connextion :</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="email">Username / E-mail:</label>
                        <input type="text" class="form-control" name="username">
                    </div>

                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" name="password">
                    </div>

                    <div class="form-group form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember">Se souvenir de moi
                        </label>
                    </div>
                    <br> <br>
                    <button type="submit" name="login" class="btn btn-primary">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>