<!DOCTYPE html>
<html>
<head>
  <title>Upravljanje in pregled</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/dashboard.css?version=2'">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="javascript/dashboard_racuni.js"></script>

</head>

<body>
  <h1 class="hidden" id="hide" hidden>Računi za obdobje</h1>
 <div class="sidebar" id="sideBar">

  <a href="dashboard_DodajUsluzbenca.php"><img class="img-fluid" src="images/dashLogo.png" ></a>

  <a href="dashboard_DodajUsluzbenca.php" class="select">Dodaj uslužbenca</a>
  <a href="racun.php" class="select">Blagajna</a>
  <a href="dashboard_Racuni.php" class="select selected">Računi</a>
  <a href="pozdravljen.php" class="selectred">Odjava</a>
</div>

<div class="mainRight" id="mainR">
  <div id="right-panel" class="right-panel">

        <form class="form-inline mt-4" id="form">
          <div class="form-group mr-3">
            <select class="form-control" id="sel1" onchange="razpon(this.value)">
                <option value="danes">Danes</option>
                <option value="vceraj">Včeraj</option>
                <option value="ta_teden">Ta teden</option>
                <option value="ta_mesec">Ta mesec</option>
                <option value="to_leto">To leto</option>
            </select>
          </div>
          <div class="form-group">
            <input type="date" name="datum1" class="form-control d-inline mr-2" id="datum1" value="">
          </div>
          <div class="form-group">
            <label for="datum2">-</label>
            <input type="date" name="datum2" class="form-control d-inline ml-2" id="datum2" value="">
          </div>

          <button type="button" class="btn btn-success ml-3 rounded" onclick="datumFields()">Prikaži</button>
        </form>

        <div class="d-inline-block float-right mr-5">
          <button onCLick='natisni_obracun()' class='m-3 d-inline-block btn-success rounded' id="natisni">Natisni</button>
        </div>

        <table class="table" id="tabela">
          <thead>
            <tr>
              <th scope="col">Datum</th>
              <th scope="col">Racun ID</th>
              <th scope="col">Cena</th>
              <th scope="col">Miza</th>
              <th scope="col">Racun izdal</th>
            </tr>
          </thead>
          <tbody id="tbody">

          </tbody>
        </table>
    </div>
</div>

</body>
</html>
