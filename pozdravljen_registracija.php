
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
      <h1 class="h3 mb-3 font-weight-normal">Registracija</h1>
      <input type="text" name="set_firstname" id="ime" class="form-control" placeholder="Ime" required autofocus>
      <input type="text" name="set_lastname" id="priimek" class="form-control" placeholder="Priimek" required autofocus>
      <input type="text" name="set_user" id="uporabnisko" class="form-control" placeholder="Uporabniško ime" required autofocus>
      <input type="password" name="set_pass" id="geslo" class="form-control" placeholder="Geslo" required>
      <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">tel:</span>
                </div>
                <input type="text" name="set_tel" class="form-control" id="tel" required>
      </div>
      <input type="email" name="set_mail" id="gmail" class="form-control" placeholder="E-mail">
      <button class="btn btn-lg btn-success btn-block" type="submit" name="registracija">Registracija</button>
      <a href="pozdravljen.php"class="btn btn-lg btn-success btn-block" id="reg" name="registracija">Prijava</a>
      <p class="mt-5 mb-3 text-muted">&copy; Andrej Avbelj</p>
    </form>

  </body>
</html>
