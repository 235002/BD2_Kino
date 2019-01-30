<?php 
    session_start();

    if(isset($_SESSION['zalogowany'])){
      $numMiejsc = json_decode( $_COOKIE['numMiejsc'], true );
      header("Pragma: no-cache"); // HTTP 1.0.
      header("Expires: 0"); // Proxies.
      require_once "connect.php";
      mysqli_report(MYSQLI_REPORT_STRICT);

      $ID_repertuar = $_SESSION['ID_repertuaru'];
    
      print_r($numMiejsc);
      echo "<br/>".$ID_repertuar;
    
    try{
      $polaczenie = new  mysqli($host, $db_user, $db_password, $db_name);
      if ($polaczenie->connect_errno!=0)
        {
          throw new Exception(mysqli_connect_errno());
        }
        else
        {
            if(isset($_POST['rezerwacja'])){

              $ID_osoba = $_SESSION['ID_osoba'];
              $liczba_biletow =  $_SESSION['liczba_biletow'];
              $koszt = $_SESSION['koszt'];
              $date = new DateTime();
              $data = $date->format('Y-m-d');
              $status = 'rezerwacja';

              $rezultat = $polaczenie->query("INSERT INTO zamowienie VALUES (NULL,$ID_osoba,'rezerwacja',$liczba_biletow,$koszt,$data)");
              if(!$rezultat) throw new Exception($polaczenie->error);

              $rezultat = $polaczenie->query("SELECT ID_zamowienie FROM zamowienie WHERE ID_osoba = $ID_osoba AND status_zamowienia='rezerwacja'
                                                    AND liczba_biletow = $liczba_biletow AND cena_zamowienia=$koszt AND data_zamowienia=$data");
              if(!$rezultat) throw new Exception($polaczenie->error);
              $wynik = $rezultat->fetch_assoc();
              $ID_zamowienia = $wynik['ID_zamowienie'];
              $ID_repertuar = $_SESSION['ID_repertuaru'];
              $ID_sala = array();

              for($i = 0; $i < count($numMiejsc); ++$i) {
                $rzad = intval($numMiejsc[$i]/20) + 1;
                $miejsce = $numMiejsc[$i]%20 ;
                $rezultat = $polaczenie->query("SELECT ID_sala FROM sala WHERE ID_repertuar=$ID_repertuar AND rzad=$rzad AND miejsce=$miejsce");
                if(!$rezultat) throw new Exception($polaczenie->error);
                $wynik = $rezultat->fetch_assoc();
                array_push($ID_sala, $wynik['ID_sala']);
              }
              $ulgowe = $_SESSION['ulgowe2'];
              $normalne = $_SESSION['normalne2'];

              for($i=0; $i<count($ID_sala);++$i){
                if($ulgowe>0){
                  $x = $ID_sala[$i];
                  $x = intval($x);
                  echo "ID zamowienia: ".$ID_zamowienia." ".gettype($ID_zamowienia);
                  echo "ID repertuar: ".$ID_repertuar." ".gettype($ID_repertuar);
                  echo $x." ".gettype($x);
                  
                  $rezultat = $polaczenie->query("INSERT INTO bilet VALUES (NULL, $ID_zamowienia, $ID_repertuar, $x, 2)");
                  if(!$rezultat) throw new Exception($polaczenie->error);
                  $rezultat = $polaczenie->query("UPDATE sala SET ID_rodzajstanu=2 WHERE ID_sala=$x");
                  if(!$rezultat) throw new Exception($polaczenie->error);
                  $ulgowe--;
                  continue;
                }
                if($normalne>0){
                  $x = $ID_sala[$i];
                  $x = intval($x);
                  $rezultat = $polaczenie->query("INSERT INTO bilet VALUES (NULL, $ID_zamowienia, $ID_repertuar, $x, 1 )");
                  if(!$rezultat) throw new Exception($polaczenie->error);
                  $rezultat = $polaczenie->query("UPDATE sala SET ID_rodzajstanu=2 WHERE ID_sala=$x");
                  if(!$rezultat) throw new Exception($polaczenie->error);
                  $normalne--;
                  continue;
                }
              }
              $_SESSION['udana_usluga'] = "Rezerwacja zrealizowana poprawnie! <br/>";
            }
            elseif(isset($_POST['zakup'])){
              $ID_osoba = $_SESSION['ID_osoba'];
              $liczba_biletow =  $_SESSION['liczba_biletow'];
              $koszt = $_SESSION['koszt'];
              $date = new DateTime();
              $data = $date->format("Y-m-d");
              $status = "zakup";

              $rezultat = $polaczenie->query("SELECT liczba_punktow FROM osoba WHERE ID_osoba=$ID_osoba");
              $wynik = $rezultat->fetch_assoc();
              $liczba_punktow = $wynik['liczba_punktow'];

              if($koszt > $liczba_punktow){
                $_SESSION['udana_usluga'] = "Masz za mało punktów na koncie. Doładuj punkty w kasie kina! <br/>";
              }
              else{
                $rezultat = $polaczenie->query("INSERT INTO zamowienie VALUES (NULL,$ID_osoba,'zakup',$liczba_biletow,$koszt,$data)");
                if(!$rezultat) throw new Exception($polaczenie->error);

                $rezultat = $polaczenie->query("SELECT ID_zamowienie FROM zamowienie WHERE ID_osoba = $ID_osoba AND status_zamowienia='zakup'
                                                      AND liczba_biletow = $liczba_biletow AND cena_zamowienia=$koszt AND data_zamowienia=$data");
                if(!$rezultat) throw new Exception($polaczenie->error);
                $wynik = $rezultat->fetch_assoc();
                $ID_zamowienia = $wynik['ID_zamowienie'];
                $ID_repertuar = $_SESSION['ID_repertuaru'];
                $ID_sala = array();
  
                for($i = 0; $i < count($numMiejsc); ++$i) {
                  $rzad = intval($numMiejsc[$i]/20) + 1;
                  $miejsce = $numMiejsc[$i]%20 ;
                  $rezultat = $polaczenie->query("SELECT ID_sala FROM sala WHERE ID_repertuar=$ID_repertuar AND rzad=$rzad AND miejsce=$miejsce");
                  if(!$rezultat) throw new Exception($polaczenie->error);
                  $wynik = $rezultat->fetch_assoc();
                  array_push($ID_sala, $wynik['ID_sala']);
                }
                $ulgowe = $_SESSION['ulgowe2'];
                $normalne = $_SESSION['normalne2'];
  
                for($i=0; $i<count($ID_sala);++$i){
                  if($ulgowe>0){
                    $x = $ID_sala[$i];
                    $x = intval($x);
                    echo "ID zamowienia: ".$ID_zamowienia." ".gettype($ID_zamowienia);
                    echo "ID repertuar: ".$ID_repertuar." ".gettype($ID_repertuar);
                    echo $x." ".gettype($x);
                    
                    $rezultat = $polaczenie->query("INSERT INTO bilet VALUES (NULL, $ID_zamowienia, $ID_repertuar, $x, 2)");
                    if(!$rezultat) throw new Exception($polaczenie->error);
                    $rezultat = $polaczenie->query("UPDATE sala SET ID_rodzajstanu=2 WHERE ID_sala=$x");
                    if(!$rezultat) throw new Exception($polaczenie->error);
                    $ulgowe--;
                    continue;
                  }
                  if($normalne>0){
                    $x = $ID_sala[$i];
                    $x = intval($x);
                    $rezultat = $polaczenie->query("INSERT INTO bilet VALUES (NULL, $ID_zamowienia, $ID_repertuar, $x, 1 )");
                    if(!$rezultat) throw new Exception($polaczenie->error);
                    $rezultat = $polaczenie->query("UPDATE sala SET ID_rodzajstanu=2 WHERE ID_sala=$x");
                    if(!$rezultat) throw new Exception($polaczenie->error);
                    $normalne--;
                    continue;
                  }
                }
                $_SESSION['udana_usluga'] = "Zakup zrealizowany poprawnie! <br/>";
              }
            }
        }
        $polaczenie->close();
      }catch(Exception $e){
      echo '<span style="color: red;"> Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
      echo '<br/>Informacja developerska:'.$e;
    }	
  }
  else{
    header("Location: index.php");
    exit();
  }
?>
<html>
    <head>
        <title>Instal jQuery</title>
        <link rel="stylesheet" href="CSS/mainStyle.css" type="text/css">
        <link rel="stylesheet" href="CSS/style.css" type="text/css">
        <script src ="scripts/jQuery.js"></script>
        <script src ="scripts/script.js"></script>
    </head>
    <body>
    
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="filmy.php">Filmy</a>
        <a href="seanse.php">Repertuar</a>
        <a href="#">Kup</a>
        <a href="#">Zarezerwuj</a>
    </div>

	<div  id="menu">
		<ul>
			<li><a href="#news"><span color onclick="openNav()">Menu</span></a></li>
			<li><a class="active" href="index.php">Home</a></li>
			<li><a href="kontakt.php">Kontakt</a></li>
			<li><a onclick="document.getElementById('id01').style.display='block'">Logowanie</a></li>
			<li><a href="rejestracja.php">Rejestracja</a></li>
			<li><a href="konto.php">Moje Konto</a></li>
			<li>
				<?php if(isset($_SESSION['zalogowany']))
						echo '<a href="logout.php">Wyloguj</a>';
				?>
			</li>
		</ul>
	</div>


    <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="close" title="Close Modal">&times;</span>
        <form class="modal-content animate" action="/action_page.php">
           <div class="imgcontainer">
              <img src="images/avatar_2.png"  height="25%" width="25%" alt="Avatar" class="avatar">
                  </div>
                  <div class="container">
                    <label for="uname"><b>Login</b></label>
                    <input type="text" placeholder="Wprowadź Login" name="uname" required>
              
                    <label for="psw"><b>Hasło</b></label>
                    <input type="password" placeholder="Wprowadź Hasło" name="psw" required>
              
                    <button type="submit">Login</button>
                  </div>
            
                  <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                    <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
                  </div>
                </form>
              </div>
    
  <div id="wrapper">
    <div id="content">
      <?php
        if(isset($_SESSION['udana_usluga'])){
          echo $_SESSION['udana_usluga'];
          unset($_SESSION['udana_usluga']);
        }
      ?>
      <form method="post">
        <input type="submit" name="rezerwacja" value="Rezerwacja"/><br/>
      </form>
      <form method="post">
        <input type="submit" name="zakup" value="Zakup"/><br/>
      </form>
    </div>
  </div>
         
</body>
</html>