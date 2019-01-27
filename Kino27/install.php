
<?php 

    session_start();
    $normalny = $_POST['normal'];
    $ulgowy = $_POST['ulga'];
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
  header("Pragma: no-cache"); // HTTP 1.0.
  header("Expires: 0"); // Proxies.
  require_once "connect.php";
  mysqli_report(MYSQLI_REPORT_STRICT);
  $_SESSION['koszt']=15*$normalny+10*$ulgowy;
  $zmienna=$_SESSION['ID_repertuaru'];

	try{
		$polaczenie = new  mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				$rezultat = $polaczenie->query(
                "SELECT ID_sala, ID_rodzajstanu
                FROM sala
                WHERE ID_repertuar = $zmienna
                ");
				if(!$rezultat) throw new Exception($polczenie->error);
				$polaczenie->close();
			}
		
	}catch(Exception $e){
		echo '<span style="color: red;"> Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		echo '<br/>Informacja developerska:'.$e;
    }
    
    
    $boolsArr=array();
    while($row = $rezultat->fetch_assoc())
          {
            if($row['ID_rodzajstanu']==1){
                array_push($boolsArr,false);
            } else{
                array_push($boolsArr,true);
            }
            
          }
    

?>
<html>
    <head>
        <title>Kino Odra</title>
      <!--  <link rel="stylesheet" href="CSS/mainStyle.css" type="text/css"> -->
        <link rel="stylesheet" href="CSS/styles.css" type="test/css">
        <script src ="scripts/jQuery.js"></script>
        <script src ="scripts/script2.js"></script>
        <script src ="scripts/script.js"></script>
        

    
    </head>
    <body>
    <!--
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="filmy.php">Filmy</a>
            <a href="#">Repertuar</a>
            <a href="#">Kup</a>
            <a href="#">Zarezerwuj</a>
          </div>
          <div  id="menu">
		<ul >
			<li>
				<a href="#news"><span color onclick="openNav()">Menu</span></a>
			</li>
			<li>
				<a class="active" href="index.php">Home</a>
			</li>
			<li>
				<a href="kontakt.php">Kontakt</a>
			</li>
			<li>
				<a onclick="document.getElementById('id01').style.display='block'">Logowanie</a>
			</li>
			<li>
				<a href="rejestracja.php">Rejestracja</a>
			</li>
			<li>
				<a href="konto.php">Moje Konto</a>
			</li>
			<li>
                
				<?php/* if(isset($_SESSION['zalogowany']))
						echo '<a href="logout.php">Wyloguj</a>';*/
				?>
			</li>
		</ul>
    </div>
        -->
<!--
          
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

                  </div>
                </form>
              </div>
    
    
    

          </div>
    
                
        -->
            
        <button  class="ha" id="btnSeating" >Pokaz Sale</button>
        <div id="messagePanel" class="messagePanel"></div>
        <button class="ha" id="btnChoice" >Dokonalem Wyboru</button>
        <button class="ha" id="btnGeneruj2" >generuj</button>
        <div id="messagePanel2" class="messagePanel"></div>

    </body>
    </html>
    