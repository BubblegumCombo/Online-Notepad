<?php

    session_start();

    $error = "";    

    if (array_key_exists("logout", $GET)) {

        $link = mysqli_connect("shareddb-t.hosting.stackcp.net", "secretdi-313331c60f", "snj5ijbtx6", "secretdi-313331c60f");

            if(mysqli_connect_error()){

                die("Datase connection error");

}

        $error ="";

        if (!$_POST['email']) {

            $error .= "An email address is required!<br>";
        }

        if (!$_POST['password']) {

        $error .= "A password is required<br>";
        
        }

        if ($error != "") {

            $error = "<p>There were error(s) in your form:</p>".$error;
        } else {

            $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

                $result = mysqli_query($link, $query);

                if (mysqli_num_rows($result) >0) {

                    $error = "That email address is taken.";
                
                } else {

                    $query = "INSERT INTO `users` (`email` , `password`) VALUES
                    ('".mysqli_real_escape_string($link, $_POST['email'])."',
                    '".mysqli_real_escape_string($link, $_POST['password'])."')";

                            if (!mysqli_query($link, $query)) {

                                $error ="<p> Could not sign up. Please try again</p>";
                } else {

                        $query = "UPDATE `users` SET password ='".md5(md5(mysqli_inster_id($link)).$_POST['password'])."' WHERE id = ".mysqli_inster_id($link)."LIMIT 1";

                            mysqli_query($link, $query);

                            $_SESSION['id'] = mysqli_instert_id($link);

                            if ($_POST['stayLoggedIn'] == '1') {

                                setcookie("id", mysqli_insert_id($link), time() + 60 *60*24*365);
                            }

                        echo "Sign up successful";
                }

        }

    }


?>



<div id="error"><?php echo $error; ?></div>


<form method="post">

    <input type="email" name="email" placeholder="Your Email">
    <input type="password" name="password" placeholder="Password">

    <input type="checkbox" name="stayLoggedIn" value=1>

        <input type="submit" name="submit" value="Sign up!">

</form>

<form method="post">

    <input type="email" name="email" placeholder="Your Email">
    <input type="password" name="password" placeholder="Password">

    <input type="checkbox" name="stayLoggedIn" value=1>

        <input type="submit" name="submit" value="Log in!">

</form>