<?php session_start(); ?>
<!DOCTYPE html>
<html>
<body>


    <?php


    if(isset($_POST["prijava"]) || isset($_POST["registracija"])){

        if (CRYPT_BLOWFISH == 1){ echo "enkripcija deluje"."<br>";} else die("napaka stran ne podpira vašega brskalnika");

        //$link=mysqli_connect("db4free.net","tadejandrejjerry","davcna20blagajna","davcna_blagajna");
        $link=mysqli_connect("localhost","root","","davcna_blagajna");

        if($link==false){
			setcookie("pazi","baza je trenutno preobremenjena pocakajte!", 0 ,"/");
            header("location:../pozdravljen.php");
        }
        else{

            if(isset($_POST["prijava"])){


                $user=mysqli_real_escape_string($link,$_POST['user']);
                $pass=mysqli_real_escape_string($link,$_POST["pass"]);

                echo "prijavljam .... "."<br>";



                //preverjam ce uporabnik sploh obstaja
                $q="select * from users where user_name='".$user."'";
                $r=mysqli_query($link,$q) or ("napaka".sleep(2).mysqli_error($link));
                $row_cnt = $r->num_rows;
                if($row_cnt==0){
                    //sleep(4);
                    setcookie("pazi","napacno geslo!", 0 ,"/");
                    header("location:../pozdravljen.php");
                }


                //delim podatke iz baze na array
                while($id=mysqli_fetch_assoc($r)){
                    //preverjam ce je uporabnik slucajno v waiting
                    $q_waiting="select * from waiting where users_ID_users = ".$id["ID_users"]."";
                    $r_waiting=mysqli_query($link,$q_waiting);
                    $row_cnt_waiting = $r_waiting->num_rows;
                    if($row_cnt_waiting==0){

                        //preverjam geslo
                        if (password_verify($pass,$id['user_password'])) {
                            //echo 'pozdravljen '.$id['user_name'];
                            //nastavljam sesion
                            $_SESSION["id_user"]=htmlentities($id["ID_users"]);
							$_SESSION["user_pass"]=htmlentities($id["user_password"]);
                            //preverjam ce je uporabnik admin
                            $q_admin="select * from admin where users_ID_users='".$id["ID_users"]."'";
                            $r_admin=mysqli_query($link,$q_admin);
                            $row_cnt_admin = $r_admin->num_rows;
                            if($row_cnt_admin==0){
                                header("location:../racun.php");
                            }
                            else{
                                header("location:../pozdravljen.php");
                            }





                        }
                        else {
                            setcookie("pazi","napacno geslo!", 0 ,"/");
                            //sleep(4);
                            header("location:../pozdravljen.php");
                        }
                    }else{
                        setcookie("pazi","administrator te se ni potrdil, POCAKAJ!", 0 ,"/");
                        header("location:../pozdravljen.php");
                    }

                }
            }

            if(isset($_POST["registracija"])){
                //echo"registracija";
                //preveri ali je vse vpisano
                if(isset($_POST["set_pass"]) &&
                    isset($_POST["set_user"]) &&
                    isset($_POST["set_firstname"]) &&
                    isset($_POST["set_lastname"]) &&
                    isset($_POST["set_tel"])
                    ){

                    $user=mysqli_real_escape_string($link,$_POST['set_user']);
                    $pass_kodiran=crypt(mysqli_real_escape_string($link,$_POST["set_pass"]),'$5$round=5000$MaloPosolimo$');
                    $tel=mysqli_real_escape_string($link,$_POST['set_tel']);
                    $firstname=mysqli_real_escape_string($link,$_POST['set_firstname']);
                    $lastname=mysqli_real_escape_string($link,$_POST['set_lastname']);

                    //$q="";

                    //gledam ce je nastavljen tudi mail
                    if(isset($_POST["set_mail"])){

                        $mail=mysqli_real_escape_string($link,$_POST['set_mail']);

                        $q="INSERT INTO users (user_name,user_password,firstname,lastname,user_mail,user_tel)
                        VALUES ('".$user."','".$pass_kodiran."','".$firstname."','".$lastname."','".$mail."','".$tel."');";

                    }else{
                        $q="INSERT INTO users (user_name,user_password,firstname,lastname,user_tel)
                        VALUES ('".$user."','".$pass_kodiran."','".$firstname."','".$lastname."','".$tel."');";
                    }


                    //dodajanje v dve tablei hkrati
                    //INSERT INTO users (user_name,user_password,firstname,lastname,user_mail,user_tel)
                    //VALUES ('neki','neki','neki','neki','neki','111');
                    //INSERT INTO waiting (is_waiting,users_ID_users)
                    //VALUES (1,LAST_INSERT_ID());



                    //vpisujem v bazo cakajoci kjer caka na potrditev administratorja
                    if($link->query($q)===TRUE){

                        $q="select * from users where user_name='".$user."'";

                        $r=mysqli_query($link,$q);
                        while($id=mysqli_fetch_assoc($r)){
                            $uporabnik_id=$id["ID_users"];
                        }

                        $q="INSERT INTO waiting (users_ID_users) VALUES ('".$uporabnik_id."');";


                        if($link->query($q)===TRUE){
                            setcookie("pazi","pocakati boste morali na administratorjevo potrditev", 0 ,"/");
                            header("location:../pozdravljen.php");
                        }else{
                            //echo "napaka ".$link->error;
                            header("location:../pozdravljen.php");
                        }
                    }else{
                        setcookie("pazi","napaka baze   ".$link->error, 0 ,"/");
                        //echo "napaka baze   ".$link->error;
                        header("location:../pozdravljen.php");
                    }


                    //$r=mysqli_query($link,$q) or ("napaka".sleep(2).mysqli_error($link));
                    //setcookie("pazi","pocakati boste morali na administratorjevo potrditev");
                    //header("location:../pozdravljen.php");



                }


            }







        }



        mysqli_close($link);
    }
    else{
        setcookie("pazi","vsak poskus vdora bo prijavljen!");
        header("location:pozdravljen.php");
    }








    ?>
</body>
</html>