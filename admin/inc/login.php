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
                Session::flash('welcomeBack', 'Velkommen tilbake '.$user->data()->name.'!');
                Redirect::to('main');
            }
            else
            {
                Session::flash('error', 'Feil brukernavn eller passord.');
                Redirect::to('login');
            }
        }
        else
        {
            echo '<div class="unsuccessful"><b>Error:<br><br></b>';
            foreach($validation->errors() as $error)
            {
                echo '- ', ucfirst($error), '<br>';
            }
            echo '</div>';
        }
    }
}
echo Session::flash('error');
echo Session::flash('welcomeBack');
?>

<!--<div class="container-fluid" style="border-radius:5px; background:#333; padding:20px; color:#eee;">-->
<h1>Login</h1>
<form action="login" method="post">
    <input class="form-control" type="text" name="username" placeholder="Username/email"><br><br>
    <input class="form-control" type="password" name="password" placeholder="Password"><br><br>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input class="btn btn-primary" type="submit" value="Submit">
</form>
<!--</div>-->