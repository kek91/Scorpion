<?php
if(Input::exists())
{
    if(Token::check(Input::get('token')))
    {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));

        if($validation->passed())
        {
            $user = new User();
            $login = $user->login(Input::get('username'), Input::get('password'));

            if($login)
            {
                $_SESSION['welcome'] = 'Welcome back '.$user->data()->name.'!';
                Redirect::to('dashboard');
            }
            else
            {
                $_SESSION['error'] = 'Wrong username or password.';
                Redirect::to('login');
            }
        }
        else
        {
            echo '<div class="alert alert-dismissable alert-danger" role="alert">';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            foreach($validation->errors() as $error)
            {
                echo ucfirst($error), '<br>';
            }
            echo '</div>';
        }
    }
}
?>

<h1>Login</h1>
<form action="login" method="post">
    <input class="form-control" type="text" name="username" placeholder="Username/email"><br><br>
    <input class="form-control" type="password" name="password" placeholder="Password"><br><br>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input class="btn btn-primary" type="submit" value="Submit">
</form>