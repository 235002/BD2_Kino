<?php
	session_start();
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try
	{
		require_once "connect.php";	
		$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	
		if ($polaczenie->connect_errno!=0)	
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{	
			$rezultat = $polaczenie->query("SELECT ID_film, tytul FROM film ");
			if (!$rezultat) throw new Exception($polaczenie->error);
		}
	}
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		echo '<br/>Informacja developerska: '.$e;
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
		<div id="content">
			<form action="repertuar_dodawanie.php" method="post">
				Dodawanie nowego seansu do bazy. <br/>
				<?php 
					if(isset($_SESSION['dodawanie_udane']) && $_SESSION['dodawanie_udane'] == true)
					{
						echo "Udało się dodać nowy film do bazy danych. <br/>";
						unset($_SESSION['dodawanie_udane']);
					}

					if(isset($_SESSION['dodawanie_udane']) && $_SESSION['dodawanie_udane'] == false)
					{
						echo  "Nie udało się zapisać danych do bazy danych! <br/>";
						unset($_SESSION['dodawanie_udane']);
					}
				?>
				Wybierz film: 
							<select name="ID_film">						
								<option value="0">Wybierz film</option>
								<?php
									while($row = $rezultat->fetch_assoc())
									{
									?>
									<option value = "<?php echo($row['ID_film'])?>" >
										<?php echo($row['tytul'])?>
									</option>
									<?php
									}               
								?>
							</select><br />
				Wybierz godzinę: <select name="godzina">
									<option value="09:00:00">09:00</option>
									<option value="13:00:00">13:00</option>
									<option value="17:00:00">17:00</option>
									<option value="21:00:00">21:00</option>
								</select><br/>
				Wybierz datę: <input type="date" name="data" /> <br />
				<input type="submit"/><br/>
			</form>
		</div>
	</div>
</body>
</html>
