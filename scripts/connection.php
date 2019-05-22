<?php
	    

		//funkcija preveri sesion imena in gesla z tistim v bazi
		function check_user($link){
			session_start();

			$verified="nic";

			if(isset($_SESSION["id_user"]) && isset($_SESSION["user_pass"])){
				$user=mysqli_real_escape_string($link,$_SESSION['id_user']);
                $pass=mysqli_real_escape_string($link,$_SESSION["user_pass"]);
				
				$q="select * from users where ID_users='".$user."' and user_password='".$pass."'";
                $r=mysqli_query($link,$q);
                $row_cnt = $r->num_rows;
                if($row_cnt==0){
                    setcookie("pazi","vsak poskus vdora bo prijavljen!", 0 ,"/");
                    header("location:../pozdravljen.php");
					return $verified=false;
                }else{
					return $verified=true;
				}

			}else{
				    setcookie("pazi","vsak poskus vdora bo prijavljen!", 0 ,"/");
                    header("location:../pozdravljen.php");
					return $verified=false;
			}
			return $verified;
		}
		
		//prever ce je uporabnik admin uporabi ga potem ko uporabis check_user da nebo kaksnih varnsostnih lukenj
		function check_admin($link){
			$admin=false;
			$user=mysqli_real_escape_string($link,$_SESSION['id_user']);
			$q="select * from admin where users_ID_users='".$user."'";
            $r=mysqli_query($link,$q);
            
			$row_cnt = $r->num_rows;
            if($row_cnt==0){
				$admin=false;
            }else{
				$admin=true;
			}

			return admin;
		}
		




		//funkcija odpre povezavo
		function connect(){
			//$conn=mysqli_connect("db4free.net","tadejandrejjerry","davcna20blagajna","davcna_blagajna");
			$conn=mysqli_connect("localhost","root","","davcna_blagajna");

			if($conn==false){
				setcookie("pazi","baza je trenutno preobremenjena pocakajte!", 0 ,"/");
                header("location:/pozdravljen.php");
			}
mysqli_set_charset($conn, "utf8");

			return $conn;
		}

		//funkcija zapre povezavo
		function disconnect($link){
			mysqli_close($link);
		}

?>