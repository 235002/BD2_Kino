<?php
	session_start();
	
	if(isset($_SESSION['zalogowany'])&&($_SESSION['zalogowany']==true))
	{
		$ID_osoba = $_SESSION['ID_osoba'];
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		  
		try{
			$polaczenie = new  mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_errno());
				}
				else
				{
					$rezultat = $polaczenie->query("SELECT 	zamowienie.ID_zamowienie, zamowienie.status_zamowienia,
															zamowienie.liczba_biletow, zamowienie.cena_zamowienia, 
															zamowienie.data_zamowienia, osoba.imie, osoba.nazwisko,
															osoba.login, repertuar.godzina, repertuar.data, film.tytul
													FROM zamowienie 
													JOIN osoba ON zamowienie.ID_osoba = osoba.ID_osoba
													JOIN bilet ON bilet.ID_zamowienie = zamowienie.ID_zamowienie
													JOIN repertuar ON repertuar.ID_repertuar = bilet.ID_repertuar
													JOIN film ON repertuar.ID_film = film.ID_film
													WHERE osoba.ID_osoba = $ID_osoba 
													GROUP BY ID_zamowienie;");
					if(!$rezultat) throw new Exception($polczenie->error);
					$polaczenie->close();
				}
			
		}catch(Exception $e){
			echo '<span style="color: red;"> Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br/>Informacja developerska:'.$e;
		}
	}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>Kino ODRA</title>
	<meta name="description" content="Kino ODRA - spotkajmy się w kinie!" />
	<meta name="keywords" content="kino, filmy, repertuar, seans, odra" />
	<link rel="stylesheet" href="CSS/mainStyle.css" type="text/css"> 
	<link rel="stylesheet" href="CSS/styles.css" type="text/css"> 
	<link rel="stylesheet" href="CSS/style.css" type="text/css"> 
    <script src ="scripts/jQuery.js"></script>
    <script src ="scripts/script.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,900&amp;subset=latin-ext" rel="stylesheet"/>
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
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;
		</span>
            <form method="post" class="modal-content animate" action="zaloguj.php">
				<div class="imgcontainer">
					<img src="images/avatar_2.png"  height="25%" width="25%" alt="Avatar" class="avatar">
				</div>
			
				<div class="container">
					<label for="uname"><b>Login</b></label>
					<input type="text" placeholder="Wprowadź Login" name="login" required>
					<label for="psw"><b>Hasło</b></label>
					<input type="password" placeholder="Wprowadź Hasło" name="haslo" required>
			
					<button type="submit">Zaloguj</button>
				</div>
			
				<div class="container" style="background-color:#f1f1f1">
					<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Anuluj</button>
				</div>
            </form>
		  </div>
	  
	  	<div id="wrapper">
			<table id="customers">
				<tr>
					<th>ID Zamówienia</th>
					<th>Imię</th>
					<th>Nazwisko</th>
					<th>Status zamówienia</th>
					<th>Liczba biletów</th>
					<th>Cena Zamówienia</th>
					<th>Data zamówienia</th>
					<th>Tytuł filmu</th>
					<th>Data seansu</th>
					<th>Godzina seansu</th>
				</tr>
				<?php
					while($row = $rezultat->fetch_assoc())
					{
						echo "<tr>";
						echo "<td>".$row['ID_zamowienie']."</td>";
						echo "<td>".$row['imie']."</td>";
						echo "<td>".$row['nazwisko']."</td>";
						echo "<td>".$row['status_zamowienia']."</td>";
						echo "<td>".$row['liczba_biletow']."</td>";
						echo "<td>".$row['cena_zamowienia']."</td>";
						echo "<td>".$row['data_zamowienia']."</td>";
						echo "<td>".$row['tytul']."</td>";
						echo "<td>".$row['data']."</td>";
						echo "<td>".$row['godzina']."</td>";
						echo "</tr>";
					}
				?>
			</table>
		</div>
</body>
</html>