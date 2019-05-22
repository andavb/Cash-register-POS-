<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/logo.png">

    <title>Davcna blagajna</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="POST" action="scripts/preveri.php">
      <img class="mb-4" src="images/logo.png" alt="" width="100" height="100">
      <h1 class="h3 mb-3 font-weight-normal">Davčna blagajna</h1>
      <label for="inputEmail" class="sr-only">Uporabnisko ime</label>
      <input type="text" name="user" id="inputEmail" class="form-control" placeholder="Uporabnisko ime" required autofocus>
      <label for="inputPassword" class="sr-only">Geslo</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Geslo" name="pass" required>
      <div class="checkbox mb-3">
      </div>
        <button class="btn btn-lg btn-success btn-block" type="submit" name="prijava">Prijava</button>
      <a href="pozdravljen_registracija.php"class="btn btn-lg btn-success btn-block" id="reg" name="registracija">Registracija</a>
        <?php

	        if(isset($_COOKIE["pazi"])){
                echo '<p class="mt-5 mb-3 text-muted">'.$_COOKIE['pazi'].'</p>';
	            unset($_COOKIE['pazi']);
	        }

        ?>
      <p class="mt-5 mb-3 text-muted">&copy; Andrej Avbelj</p>
    </form>
  </body>
</html>

