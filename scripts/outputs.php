
<?php
	//izpise uporabnike	
	//function output_waiting($link){
		include 'connection.php';
		$link = connect();
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

					echo "<option value=".$uporabnik.">".$ime." ".$priimek."</option>";
			}
		}

	echo "</select>";

	//}

	//tko klices sam nevem se kaj bom naredu z link
	//output_waiting($link);
?>
