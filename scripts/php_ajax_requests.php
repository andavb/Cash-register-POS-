<?php
session_start();


	//vzame tip in izpise hrano tipa
	function izpis_hrana($tip){
    global $link;
		$q="select * from food where food_type_ID_food_type='".$tip."'";
		$r=mysqli_query($link,$q);
		while($id=mysqli_fetch_assoc($r)){
			$hrana=$id["name"];
			$id_hrana=$id["ID_food"];
			$cena_hrane=$id["price"];
			echo "<option value='".$id_hrana."' class='optionHrana'>".$hrana."</option>";

		}
	}


	//vzame tip in izpise pijaco tipa
	function izpis_pijaca($tip){
	  global $link;
		$q="select * from drink where drink_type_ID_drink_type='".$tip."'";
		$r=mysqli_query($link,$q);
		while($id=mysqli_fetch_assoc($r)){
			$pijaca=$id["name"];
			$id_pijaca=$id["ID_drink"];
			$cena_pijace=$id["price"];
			echo "<option value='".$id_pijaca."'>".$pijaca."</option>";
		}
	}

	function izpis_miza($katera){

	  global $link;
		$neporavnan=false;
		$q="SELECT `order`.ID_order, `order`.time, `order`.price_all,`order`.completed, `order`.table_ID_table, users.firstname, users.lastname FROM `order` INNER JOIN users ON `order`.users_ID_users=users.ID_users WHERE `order`.table_ID_table=".$katera."";
		$r=mysqli_query($link,$q);
		while($id=mysqli_fetch_assoc($r)){

			if($id['completed']==0){
				izracunaj_ceno($id['ID_order']);
				echo "<table class='table table-hover'>
						  <thead>
						    <tr>
						      <th scope='col'>#</th>
						      <th scope='col'>Datum naročila</th>
						      <th scope='col'>Skupna cena</th>
						      <th scope='col'>Izdal</th>
						    </tr>
						  </thead>";
				echo "  <tbody>
							    <tr>
							      <th scope='row'>".$id['ID_order']."</th>
							      <td>".$id["time"]."</td>
							      <td>".$id["price_all"]."€</td>
							      <td>".$id["firstname"]." ".$id["lastname"]."</td>
							    </tr>
								</tbody>
							</table>";
				echo '<button class="btn btn-success gumbNaTleh" type="button" onClick="koncaj_narocilo('.$id['ID_order'].','.$katera.')">Zaključi naročilo</button>';
				$neporavnan=true;
				izpisi_narocilo($id['ID_order']);
				echo"<div id='toNewWindow' style='visibility: hidden;'>";
				izpisi_racun($id['ID_order']);
				echo"<th>Skupna cena: ".$id["price_all"]."€</th>";
				echo"</div>";
			}
		}

		if($neporavnan==false){
			echo"odpiram novo naročilo.... ne pozabi shraniti svojega naročila preden izbereš drugo mizo!";
		}


	}

	function zakljuci_nar($katero_nar){
	  global $link;
		$q="UPDATE `order` SET completed=1 where ID_order='".$katero_nar."'";
		$r=mysqli_query($link,$q);
		echo "zaključil naročilo ".$katero_nar."<br/>";
		if(isset($_POST["miza"])){
			izpis_miza(implode($_POST["type"]));
		}

	}

//funckija preveri ali ima miza kaj nezakljucenih narocil
	function check_miza($miza){
		global $link;
		$neporavnan=false;
		$q="SELECT `order`.ID_order,`order`.completed, `order`.table_ID_table
				FROM `order`
				WHERE `order`.table_ID_table=".$miza.";";
		$r=mysqli_query($link,$q);
		echo mysqli_error($link);
		while($id=mysqli_fetch_assoc($r)){

			if($id['completed']==0){
				$neporavnan=true;
			}
		}

		if($neporavnan==true){
			return true;
		}else{
			return false;
		}
	}

//funckija vrne narocilo ki se ni bilo zakljuceno
	function find_narocilo($miza){
		global $link;
		$neporavnan=0;
		$q="SELECT `order`.ID_order,`order`.completed, `order`.table_ID_table FROM `order` WHERE `order`.table_ID_table=".$miza.";";
		$r=mysqli_query($link,$q);

		while($id=mysqli_fetch_assoc($r)){

			if($id['completed']==0){
				$neporavnan=$id['ID_order'];
			}
		}
		return $neporavnan;
	}



//funkcija vrne id narocila ki se ni bil opravljen ce takega narocila ni ga naredi
	function naredi_najdi(){
		global $link;
		$miza=implode($_POST["miza"]);
		$user=0;
		//for testing
		if(isset($_SESSION["id_user"])){
			$user=mysqli_real_escape_string($link,$_SESSION['id_user']);
		}

		if(check_miza($miza)==false){
			$q="INSERT INTO `order`(`time`, `completed`, `users_ID_users`, `table_ID_table`) VALUES (now(),0,".$user.",".$miza.")";
			$r=mysqli_query($link,$q);
		}
		$id_nar=find_narocilo($miza);
		return $id_nar;
	}



	function dodaj_hrano_racun($katera_hrana){
		global $link;
		$narocilo=naredi_najdi();
		$koliko=1;//zaenkrat bom tole pustil
		$q="INSERT INTO `food_orderd`(`order_ID_order`, `food_ID_food`, `quantity`) VALUES (".$narocilo.",".$katera_hrana.",".$koliko.")";
		$r=mysqli_query($link,$q);
		izracunaj_ceno($narocilo);

		izpis_miza(implode($_POST["miza"]));
	}


	function dodaj_pijaco_racun($katera_pijaca){
		global $link;
		$narocilo=naredi_najdi();
		$koliko=1;//zaenkrat bom tole pustil
		$q="INSERT INTO `drink_orderd`(`order_ID_order`, `drink_ID_drink`, `quantity`) VALUES (".$narocilo.",".$katera_pijaca.",".$koliko.")";
		$r=mysqli_query($link,$q);
		izracunaj_ceno($narocilo);
		izpis_miza(implode($_POST["miza"]));
	}


	function izracunaj_ceno($narocilo){
		global $link;
		$skupna_cena=0;
		$q="SELECT * FROM `food_orderd` INNER JOIN food ON food_orderd.food_ID_food=food.ID_food WHERE food_orderd.order_ID_order=".$narocilo.";";
		$r=mysqli_query($link,$q);
		while($id=mysqli_fetch_assoc($r)){
			$skupna_cena+=$id["price"]*$id["quantity"];
		}
		$q="SELECT * FROM `drink_orderd` INNER JOIN drink ON drink_orderd.drink_ID_drink=drink.ID_drink WHERE drink_orderd.order_ID_order=".$narocilo.";";
		$r=mysqli_query($link,$q);
		while($id=mysqli_fetch_assoc($r)){
			$skupna_cena+=$id["price"]*$id["quantity"];
		}

		$q="UPDATE `order` SET `price_all`=".$skupna_cena." WHERE ID_order=".$narocilo.";";
		$r=mysqli_query($link,$q);
	}



	function izpisi_narocilo($katero){
		global $link;
		echo "<table class='table table-hover'>
					<thead>
						<tr>
							<th scope='col'>ID</th>
							<th scope='col'>izdelek</th>
							<th scope='col'>cena</th>
							<th scope='col'>kolicina</th>
							<th scope='col'><h3>-</h3></th>
							<th scope='col'><h3>+</h3></th>
						</tr>
					</thead>
						<tbody>";
		$q="SELECT * FROM `food_orderd` INNER JOIN food ON food_orderd.food_ID_food=food.ID_food WHERE food_orderd.order_ID_order=".$katero.";";
		$r=mysqli_query($link,$q);
		while($id=mysqli_fetch_assoc($r)){

			if($id["quantity"]>0){
				echo "
									<tr>
										<th scope='row'>".$id['ID_food']."</th>
										<td>".$id["name"]."</td>
										<td>".$id["price"]."€</td>
										<td>".$id["quantity"]."</td>
										<td><button onClick=minus_hrana(".$id["ID_food_orderd"].")>-</button></td>
										<td><button onClick=plus_hrana(".$id["ID_food_orderd"].")>+</button></td>
									</tr>";

			}

		}
		$q="SELECT * FROM `drink_orderd` INNER JOIN drink ON drink_orderd.drink_ID_drink=drink.ID_drink WHERE drink_orderd.order_ID_order=".$katero.";";
		$r=mysqli_query($link,$q);
		while($id=mysqli_fetch_assoc($r)){
			if($id["quantity"]>0){
				echo "
									<tr>
										<th scope='row'>".$id['ID_drink']."</th>
										<td>".$id["name"]."</td>
										<td>".$id["price"]."€</td>
										<td>".$id["quantity"]."</td>
										<td><button onClick=minus_pijaca(".$id["ID_drink_orderd"].")>-</button></td>
										<td><button onClick=plus_pijaca(".$id["ID_drink_orderd"].")>+</button></td>
									</tr>";

				}
		}
		echo 		"</tbody>
					</table>";

	}

	function izpisi_racun($katero){
		global $link;
		echo "
					<title>Račun</title>
					<meta charset='utf-8'>
					<meta name='viewport' content='width=device-width, initial-scale=1'>
					<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
					<link rel='stylesheet' type='text/css' href='css/racun.css'>
					<script src='javascript/racun.js'></script>

					<table class='table table-hover'>
					<thead>
						<tr>
							<th scope='col'>ID</th>
							<th scope='col'>izdelek</th>
							<th scope='col'>cena</th>
							<th scope='col'>kolicina</th>
						</tr>
					</thead>
						<tbody>";
		$q="SELECT * FROM `food_orderd` INNER JOIN food ON food_orderd.food_ID_food=food.ID_food WHERE food_orderd.order_ID_order=".$katero.";";
		$r=mysqli_query($link,$q);
		while($id=mysqli_fetch_assoc($r)){

			if($id["quantity"]>0){
				echo "
									<tr>
										<th scope='row'>".$id['ID_food']."</th>
										<td>".$id["name"]."</td>
										<td>".$id["price"]."€</td>
										<td>".$id["quantity"]."</td>
									</tr>";

			}

		}
		$q="SELECT * FROM `drink_orderd` INNER JOIN drink ON drink_orderd.drink_ID_drink=drink.ID_drink WHERE drink_orderd.order_ID_order=".$katero.";";
		$r=mysqli_query($link,$q);
		while($id=mysqli_fetch_assoc($r)){
			if($id["quantity"]>0){
				echo "
									<tr>
										<th scope='row'>".$id['ID_drink']."</th>
										<td>".$id["name"]."</td>
										<td>".$id["price"]."€</td>
										<td>".$id["quantity"]."</td>
									</tr>";

				}
		}
		echo 		"</tbody>
					</table>";


	}



	function plus_kolicina_hrana($narocilo){
		global $link;
		$q="UPDATE `food_orderd` SET `quantity`=`quantity`+1 WHERE `ID_food_orderd`=".$narocilo.";";
		$r=mysqli_query($link,$q);
		izracunaj_ceno(find_narocilo(implode($_POST["miza"])));
		izpis_miza(implode($_POST["miza"]));
	}


	function minus_kolicina_hrana($narocilo){
		global $link;
		@$q="SELECT * FROM `food_orderd` WHERE `ID_food_orderd`=".$narocilo.";";
		@$r=mysqli_query($link,$q);
		while(@$id=mysqli_fetch_assoc($r)){
			if(@$id["quantity"]>0){
				@$q="UPDATE `food_orderd` SET `quantity`=`quantity`-1 WHERE `ID_food_orderd`=".$narocilo.";";
				@$r=mysqli_query($link,$q);
			}
		}
		izracunaj_ceno(find_narocilo(implode($_POST["miza"])));
		izpis_miza(implode($_POST["miza"]));
	}

	function plus_kolicina_pijaca($narocilo){
		global $link;
		$q="UPDATE `drink_orderd` SET `quantity`=`quantity`+1 WHERE `ID_drink_orderd`=".$narocilo.";";
		$r=mysqli_query($link,$q);
		izracunaj_ceno(find_narocilo(implode($_POST["miza"])));
		izpis_miza(implode($_POST["miza"]));
	}


	function minus_kolicina_pijaca($narocilo){
		global $link;
		@$q="SELECT * FROM `drink_orderd` WHERE `ID_drink_orderd`=".$narocilo.";";
		@$r=mysqli_query($link,$q);
		while(@$id=mysqli_fetch_assoc($r)){
			if(@$id["quantity"]>0){
				@$q="UPDATE `drink_orderd` SET `quantity`=`quantity`-1 WHERE `ID_drink_orderd`=".$narocilo.";";
				@$r=mysqli_query($link,$q);
			}
		}
		izracunaj_ceno(find_narocilo(implode($_POST["miza"])));
		izpis_miza(implode($_POST["miza"]));
	}

	function izpis_upor(){
		global $link;

		$q="select * from waiting";
		$r=mysqli_query($link,$q);
		echo "<select class='custom-select selectCustom' multiple id='select'>";

			while($id=mysqli_fetch_assoc($r)){
				$id_userja=$id["users_ID_users"];
				$x="select * from users where ID_users='".$id_userja."'";
				$k=mysqli_query($link,$x);

				while($id_userjev=mysqli_fetch_assoc($k)){
					$uporabnik=$id_userjev["user_name"];
					$ime=$id_userjev["firstname"];
					$priimek=$id_userjev["lastname"];
					$id_uporabnika=$id_userja;

						echo "<option value=".$id_uporabnika.">".$ime." ".$priimek."</option>";
				}
			}

		echo "</select>";

	}

	function dodj_upor($data){
		global $link;
		@$q="DELETE FROM waiting WHERE waiting.`users_ID_users` = ".$data.";";
		@$r=mysqli_query($link,$q);
		$q="select * from waiting";
		$r=mysqli_query($link,$q);
		echo "<select class='custom-select selectCustom' multiple id='neki'>";

			while($id=mysqli_fetch_assoc($r)){
				$id_userja=$id["users_ID_users"];
				$x="select * from users where ID_users='".$id_userja."'";
				$k=mysqli_query($link,$x);

				while($id_userjev=mysqli_fetch_assoc($k)){
					$uporabnik=$id_userjev["user_name"];
					$ime=$id_userjev["firstname"];
					$priimek=$id_userjev["lastname"];
					$id_uporabnika=$id_userja;

						echo "<option value=".$id_uporabnika.">".$ime." ".$priimek."</option>";
				}
			}

		echo "</select>";

	}

	


//funkcije so tu zgoraj--------------------------------------------------------------------

	require 'connection.php';


	$link=connect();
  global $link;

  if(isset($_POST["functionname"])){
		switch($_POST["functionname"]){

			case 'izpis_hrana':
				izpis_hrana(implode($_POST["type"]));
				break;

      case 'izpis_pijaca':
        izpis_pijaca(implode($_POST["type"]));
        break;

			case 'izpis_mize':
				izpis_miza(implode($_POST["type"]));
				break;

			case 'zakljuci_nar':
				zakljuci_nar(implode($_POST["type"]));
				break;

			case 'dodaj_hrano_racun':
				dodaj_hrano_racun(implode($_POST["type"]));
				break;

			case 'dodaj_pijaco_racun':
				dodaj_pijaco_racun(implode($_POST["type"]));
				break;

			case 'plus_kolicina_hrana':
				plus_kolicina_hrana(implode($_POST["type"]));
				break;

			case 'minus_kolicina_hrana':
				minus_kolicina_hrana(implode($_POST["type"]));
				break;

			case 'plus_kolicina_pijaca':
				plus_kolicina_pijaca(implode($_POST["type"]));
				break;

			case 'minus_kolicina_pijaca':
				minus_kolicina_pijaca(implode($_POST["type"]));
				break;

			case 'dodj_upor':
				dodj_upor(implode($_POST["type"]));
				break;

			case 'izpis_upor':
				izpis_upor();
				break;
		}
	}





	disconnect($link);

?>
