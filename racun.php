<!DOCTYPE html>

<html>
<head>

  <title>Blagajna</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/racun.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="javascript/racun.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<script>

function minus_hrana(data){

  console.log([data]);
  jQuery.ajax({
    type: "POST",
    url: 'scripts/php_ajax_requests.php',
    data: {functionname: 'minus_kolicina_hrana', type: [data],miza:[document.getElementById("mize").value]},
    success:function(data) {
    document.getElementById("izpis_mize").innerHTML=data;
    }
});
}

function plus_hrana(data){
  jQuery.ajax({
    type: "POST",
    url: 'scripts/php_ajax_requests.php',
    data: {functionname: 'plus_kolicina_hrana', type: [data],miza:[document.getElementById("mize").value]},
    success:function(data) {
    document.getElementById("izpis_mize").innerHTML=data;
    }
});
}

function minus_pijaca(data){
  jQuery.ajax({
    type: "POST",
    url: 'scripts/php_ajax_requests.php',
    data: {functionname: 'minus_kolicina_pijaca', type: [data],miza:[document.getElementById("mize").value]},
    success:function(data) {
    document.getElementById("izpis_mize").innerHTML=data;
    }
});
}

function plus_pijaca(data){
  jQuery.ajax({
    type: "POST",
    url: 'scripts/php_ajax_requests.php',
    data: {functionname: 'plus_kolicina_pijaca', type: [data],miza:[document.getElementById("mize").value]},
    success:function(data) {
    document.getElementById("izpis_mize").innerHTML=data;
    }
});
}

function izbral_hrano(){
	    jQuery.ajax({
        type: "POST",
        url: 'scripts/php_ajax_requests.php',
        data: {functionname: 'izpis_hrana', type: [document.getElementById("hrana").value]},
        success:function(data) {
        document.getElementById("hrana_dolocenega_tipa").innerHTML=data;
        }
    });
}


function izbral_pijaco(){
	    jQuery.ajax({
        type: "POST",
        url: 'scripts/php_ajax_requests.php',
        data: {functionname: 'izpis_pijaca', type: [document.getElementById("pijaca").value]},
        success:function(data) {
        document.getElementById("pijaca_dolocenega_tipa").innerHTML=data;

        }
    });
}

function izbral_mizo(){
	    jQuery.ajax({
        type: "POST",
        url: 'scripts/php_ajax_requests.php',
        data: {functionname: 'izpis_mize', type: [document.getElementById("mize").value]},
        success:function(data) {
        document.getElementById("izpis_mize").innerHTML=data;
        }
    });
}


function koncaj_narocilo(katero_nar,katera_miz){

	    jQuery.ajax({
        type: "POST",
        url: 'scripts/php_ajax_requests.php',
        data: {functionname: 'zakljuci_nar', type: [katero_nar], miza: [katera_miz]},
        success:function(data) {
        document.getElementById("izpis_mize").innerHTML=data;
        }
    });
      nWin();
}


function dodaj_hrano_narocilo(){
  console.log("izbrana hrana "+document.getElementById("hrana_dolocenega_tipa").value);
  if(document.getElementById("hrana_dolocenega_tipa").value!=null){
    console.log("dodajam");
    jQuery.ajax({
      type: "POST",
      url: 'scripts/php_ajax_requests.php',
      data: {functionname: 'dodaj_hrano_racun', type: [document.getElementById("hrana_dolocenega_tipa").value],miza:[document.getElementById("mize").value]},
      success:function(data) {
          document.getElementById("izpis_mize").innerHTML=data;
      }
    });
  }
}


function dodaj_pijaco_narocilo(){

  if(document.getElementById("pijaca_dolocenega_tipa").value!=null){

    jQuery.ajax({
      type: "POST",
      url: 'scripts/php_ajax_requests.php',
      data: {functionname: 'dodaj_pijaco_racun', type: [document.getElementById("pijaca_dolocenega_tipa").value],miza:[document.getElementById("mize").value]},
      success:function(data) {
          document.getElementById("izpis_mize").innerHTML=data;
      }
    });
  }
}




</script>

<?php
    require 'scripts/connection.php';

    $link=connect();
    global $link;



 ?>


<body>
<div class="container">
  <div class="zapri"> 
    <a href="dashboard_Racuni.php" class="btn-danger vac">X</a>
  </div>
    <div class="col">
      <?php
        //izpise vse mize to bo uporabno predvsem za izdelavo racuna
      echo "<div class='form-group'>";
        $q="SELECT * FROM `table`";
        $r=mysqli_query($link,$q);
        echo "<select size='4' id='mize' onchange='izbral_mizo()' class='form-control mizeIzbira'>";
        while($id=mysqli_fetch_assoc($r)){
          $id_mize=$id["ID_table"];
            if($id_mize == 1){
              echo "<option value='".$id_mize."' class='miza' selected>miza ".$id_mize."</option>";

            }
            else{
              echo "<option value='".$id_mize."' class='miza'>miza ".$id_mize."</option>";
            }
          }
        echo "</select>";
        echo "</div>";
      ?>

    </div>


    <div class="row">
        <div class="col-sm-6">
          <div class="row prvi">
              <?php
              //izpise tipe hrane
              $q="select * from food_type";
              $r=mysqli_query($link,$q);
              echo "<select onchange='izbral_hrano()' id='hrana' class='form-control tipHrane'>";
              while($id=mysqli_fetch_assoc($r)){
                $tip_hrane=$id["type"];
                $id_tipa_hrane=$id["ID_food_type"];
                echo "<option value='".$id_tipa_hrane."' class='optionHrana'>".$tip_hrane."</option>";

                }
              echo "</select>";
            ?>
          </div>

          <div class="row drugi">
            <div class="col-sm-11">
              <select multiple size="5" id='hrana_dolocenega_tipa' class='d-inline form-control selectHrana'></select>
            </div>
            <div class="col-sm-1">
              <button id="dodaj_hrano" onclick="dodaj_hrano_narocilo()" class="btn btn-success">></button>
            </div>
          </div>

          <div class="row prvi">
            <?php
                //izpise tipe pijace
                $q="select * from drink_type";
                $r=mysqli_query($link,$q);
                echo "<select onchange='izbral_pijaco()' id='pijaca' class='form-control tipHrane'>";
                while($id=mysqli_fetch_assoc($r)){
                  $tip_pijace=$id["type"];
                  $id_tipa_pijace=$id["ID_drink_type"];
                  echo "<option value='".$id_tipa_pijace."' class='optionHrana'>".$tip_pijace."</option>";

                  }
                echo "</select>";
            ?>
          </div>

          <div class="row drugi">
            <div class="col-sm-11">
              <select multiple size="5" id='pijaca_dolocenega_tipa' class='d-inline form-control selectHrana'></select>
            </div>
            <div class="col-sm-1">
              <button id="dodaj_pijaco" onclick="dodaj_pijaco_narocilo()" class="btn btn-success">></button>
            </div>
          </div>
        </div>
        <div class="col-sm-5 red">
          <div class="izpis">
            <div class="row align-items-center">
                <div class="col" id="izpis_mize"></div>
                <div class="col" id="izpis_pijace"></div>
                <div id="debug"></div>
            </div>
          </div>
        </div>
  </div>


<div class="izpis">
  <div class="row align-items-center">
      <div class="col" id="izpis_mize"></div>
      <div class="col" id="izpis_pijace"></div>
      <div id="debug"></div>
  </div>
</div>

</div>

<script type="text/javascript">

$(document).ready(function() {
    izbral_mizo();
});

</script>

</body>
<?php disconnect($link); ?>
</html>
