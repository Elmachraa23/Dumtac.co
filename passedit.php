<?php
    if ( session_status() == PHP_SESSION_NONE )
        session_start();

    if ( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
        if ( isset( $_POST['save'] ) && isset($_SESSION['logged']))
        {
            $user = $_SESSION['logged'];

            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
            
            if ( password_verify( $old_password, $user->password ) )
            {
                //il a une change de changer le mot de passe
                if ( $new_password == $confirm_password )
                {
                    // il a le droit de changer son mot de passe
                    $password = password_hash( $new_password, PASSWORD_BCRYPT );
                    $sql = "UPDATE users SET password=? WHERE username=? AND email=?";
                    $data =[$password, $user->username, $user->email ];
                    $test = $this->model->requete( $sql, false, $data );
                }
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
                        <label for="pwd">Old Password:</label>
                        <input type="password" class="form-control" name="old_password">
                    </div>

                    <div class="form-group">
                        <label for="pwd">New Password:</label>
                        <input type="password" class="form-control" name="new_password">
                    </div>

                    <div class="form-group">
                        <label for="pwd">Confirm New Password:</label>
                        <input type="password" class="form-control" name="confirm_password">
                    </div>
                    
                    <br> <br>
                    <button type="submit" name="save" class="btn btn-primary">save</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>