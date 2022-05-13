<?php
    if ( session_status() == PHP_SESSION_NONE )
        session_start();

    if ( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
        if ( isset( $_POST['register'] ) )
        {
            $hash = password_hash( $_POST['password'], PASSWORD_BCRYPT );
            //, ['cost' => 12]);
            $data =
            [
                $_POST['username'],
                $_POST['email'],
                $hash // mot de passe hashé
            ];
        
            $user = $this->model->getUser( $_POST['username'] );
            
            if ( !$user )
                echo 'Ce compte existe déja !!!';
            else
            {
                echo 'Ce compte est possible !!!';
                $test = $this->model->insertUser( $data );
                if ( $test )
                {
                    $_SESSION['logged'] = Model::getLastID();
                    header("Location: ?page=user/profil");
                }
                else
                    echo "Inscription impossible";
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
                        <label for="email">Username:</label>
                        <input type="text" class="form-control" name="username">
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" name="email">
                    </div>

                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" name="password">
                    </div>

                    <div class="form-group">
                        <label for="pwd">Confirm Password:</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    
                    <br> <br>
                    <button type="submit" name="register" class="btn btn-primary">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>