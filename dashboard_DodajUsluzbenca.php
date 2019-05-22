<!DOCTYPE html>
<html>
<head>
  <title>Upravljanje in pregled</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/dashboard.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/javascript">

window.onload = izpisi();

function izpisi(){


    jQuery.ajax({
      type: "POST",
      url: 'scripts/php_ajax_requests.php',
      data: {functionname: 'izpis_upor'},
      success:function(data) {
        document.getElementById("txtHint").innerHTML = data;
  }
  });

  document.getElementById("select").hidden;
}


    function potrdi(){
      var izbrana = document.getElementById("select").value;
       console.log(izbrana);
      if(izbrana){
        jQuery.ajax({
          type: "POST",
          url: 'scripts/php_ajax_requests.php',
          data: {functionname: 'dodj_upor', type: [izbrana]},
          success:function(data) {
            document.getElementById("txtHint").innerHTML = "";
            document.getElementById("txtHint").innerHTML = data;
          }
      });
      }
      document.getElementById("select").hidden;
    }

    function zbrisi(){
      var izbrana = document.getElementById("select").value;
      if(izbrana){

        var ok = confirm("Ali res želite zbrisati uporabnika: " + izbrana);
        if (ok == true) {
          jQuery.ajax({
            type: "POST",
            url: 'scripts/php_ajax_requests.php',
            data: {functionname: 'dodj_upor', type: [izbrana]},
            success:function(data) {
            document.getElementById("txtHint").innerHTML = data;
            }
        });}
      }
      else{
        alert("Niste izbrali uporabnika!");
      }
    }

  </script>

</head>
  
<body>
  <div class="sidebar">
    <a href="dashboard_DodajUsluzbenca.php"><img class="img-fluid" src="images/dashLogo.png" ></a>
    <a href="dashboard_DodajUsluzbenca.php" class="select selected">Dodaj uslužbenca</a>
    <a href="racun.php" class="select">Blagajna</a>
    <a href="dashboard_Racuni.php" class="select">Računi</a>
    <a href="pozdravljen.php" class="selectred">Odjava</a>
  </div>

  <div class="main">
    <div class="jumbotron">
      <div id="txtHint"></div>
      <button class="d-inline-block btn-success zelen" onclick="potrdi()">Potrdi</button>
      <button class="d-inline-block btn-danger rdec" onclick="zbrisi()">Zbriši</button>
    </div>

  </div>
</body>
</html>
