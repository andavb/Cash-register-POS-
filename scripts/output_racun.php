
<?php
	//izpise uporabnike	
	//function output_waiting($link){
		include 'connection.php';
		$link = connect();

		$datum1 = $_GET['datum1'];
		$datum2 = $_GET['datum2'];

		$podatki[] = $datum1;
		$podatki[] = $datum2;


		//samo izpis
		$q="SELECT `order`.ID_order, `order`.time, `order`.price_all, `order`.table_ID_table, users.firstname, users.lastname FROM `order` INNER JOIN users ON `order`.users_ID_users=users.ID_users WHERE completed != 0 AND date(`time`) BETWEEN  '".$datum1."' AND '".$datum2."'";

		//po datumu
		//$q="SELECT * FROM `order` ORDER BY time ASC";

		//po datumu obratno
		//$q="SELECT * FROM `order` ORDER BY time DESC";

		//po usluzbencih
		//$q="SELECT * FROM `order` ORDER BY users_ID_users";

		//opravljene
		//$q="SELECT * FROM `order` ORDER BY completed";

		$r=mysqli_query($link,$q);

		while($id=mysqli_fetch_assoc($r)){
			$podatki[] = $id;
			/*$id_order=$id["ID_order"];
			$time=$id["time"];
			$cena=$id["price_all"];
			$usluzbenec=$id["users_ID_users"];
			$miza=$id["table_ID_table"];*/
			//zdej pa sam echo kar bos rabu
		}
		echo json_encode($podatki);
	//}

	//tko klices sam nevem se kaj bom naredu z link
	//output_waiting($link);
?>
