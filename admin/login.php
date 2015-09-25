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
                Redirect::to('main.php');
            }
            else
            {
                Session::flash('error', 'Feil brukernavn eller passord.');
                Redirect::to('index.php?page=login');
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

echo '<h1>Vennligst logg inn</h1>
<form action="index.php" method="post">
    <input type="text" name="username" placeholder="Brukernavn"><br><br>
    <input type="password" name="password" placeholder="Passord"><br><br>
    <input type="hidden" name="token" value="'.Token::generate().'">
    <input type="submit" value="Logg inn">
</form>
<br><br>
Bruk <b>nodlys</b> som brukernavn og passord under testperioden.
';