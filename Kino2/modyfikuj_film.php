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
			$rezultat = $polaczenie->query("SELECT * FROM film ");
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
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Kino ODRA</title>
	<meta name="description" content="Kino ODRA - spotkajmy się w kinie!" />
	<meta name="keywords" content="kino, filmy, repertuar, seans, odra" />
	<link rel="stylesheet" href="CSS/mainStyle.css" type="text/css"> 
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
			Modyfikowanie filmu<br/>
			<?php 
				if(isset($_SESSION['udana_modyfikacja']) && $_SESSION['udana_modyfikacja'] == true)
				{
					echo  "Udało się zmodyfikować dane. <br/>";
					unset($_SESSION['udana_modyfikacja']);
				}
				if(isset($_SESSION['udana_modyfikacja']) && $_SESSION['udana_modyfikacja'] == false)
				{
					echo  "Nie udało się zmodyfikować dane. <br/>";
					unset($_SESSION['udana_modyfikacja']);				
				}
			?>
			<form action="film_modyfikowanie.php" method="post">
				Wybierz film: 
					<select name="ID_film">						
						<option value="0">Wybierz film</option>
						<?php
							while($row = $rezultat->fetch_assoc())
							{
						?>
								<option value = "<?php echo($row['ID_film'])?>">
									<?php echo($row['tytul']);?>
								</option>
						<?php
							}               
						?>
					</select><br />
					<input type="submit" value="Załaduj dane"/>
			</form>

			<form action="film_modyfikowanie2.php" method="post">		
				Modyfikuj dane :<br/>
				<?php 
					if(isset($_SESSION['e_zapis'])){
						echo '<div class="error">'.$_SESSION['e_zapis'].'</div>';
						unset($_SESSION['e_zapis']);
					}
				?>
				Tytuł: <input type ="text" name="tytul" value="<?php
					if(isset($_SESSION['fr_tytul']))
					{
						echo $_SESSION['fr_tytul'];
						unset($_SESSION['fr_tytul']);
					}
				?>"/><br/>
				<?php
					if(isset($_SESSION['e_tytul']))
					{
						echo '<div class="error">'.$_SESSION['e_tytul'].'</div>';
						unset($_SESSION['e_tytul']);
					}
				?>
				Reżysera: <input type ="text" name="rezyser" value="<?php
					if(isset($_SESSION['fr_rezyser']))
					{
						echo $_SESSION['fr_rezyser'];
						unset($_SESSION['fr_rezyser']);
					}
				?>"/><br/>
				<?php
					if(isset($_SESSION['e_rezyser']))
					{
						echo '<div class="error">'.$_SESSION['e_rezyser'].'</div>';
						unset($_SESSION['e_rezyser']);
					}
				?>
				Scenariusz: <input type ="text" name="scenariusz" value="<?php
					if(isset($_SESSION['fr_scenariusz']))
					{
						echo $_SESSION['fr_scenariusz'];
						unset($_SESSION['fr_scenariusz']);
					}
				?>"/><br/>
				<?php
					if(isset($_SESSION['e_scenariusz']))
					{
						echo '<div class="error">'.$_SESSION['e_scenariusz'].'</div>';
						unset($_SESSION['e_scenariusz']);
					}
				?>
				Gatunek: <input type ="text" name="gatunek" value="<?php
					if(isset($_SESSION['fr_gatunek']))
					{
						echo $_SESSION['fr_gatunek'];
						unset($_SESSION['fr_gatunek']);
					}
				?>"/><br/>
				<?php
					if(isset($_SESSION['e_gatunek']))
					{
						echo '<div class="error">'.$_SESSION['e_gatunek'].'</div>';
						unset($_SESSION['e_gatunek']);
					}
				?>
				Datę premiery: <input type ="date" name="premiera" value="<?php
					if(isset($_SESSION['fr_premiera']))
					{
						echo $_SESSION['fr_premiera'];
						unset($_SESSION['fr_premiera']);
					}
				?>"/><br/>
				<?php
					if(isset($_SESSION['e_premiera']))
					{
						echo '<div class="error">'.$_SESSION['e_premiera'].'</div>';
						unset($_SESSION['e_premiera']);
					}
				?>
				Kraj pochodzenia: <input type ="text" name="kraj_pochodzenia" value="<?php
					if(isset($_SESSION['fr_kraj_pochodzenia']))
					{
						echo $_SESSION['fr_kraj_pochodzenia'];
						unset($_SESSION['fr_kraj_pochodzenia']);
					}
				?>"/><br/>
				<?php
					if(isset($_SESSION['e_kraj_pochodzenia']))
					{
						echo '<div class="error">'.$_SESSION['e_kraj_pochodzenia'].'</div>';
						unset($_SESSION['e_kraj_pochodzenia']);
					}
				?>
				Czas trwania: <input type ="number" name="czas_trwania" value="<?php
					if(isset($_SESSION['fr_czas_trwania']))
					{
						echo $_SESSION['fr_czas_trwania'];
						unset($_SESSION['fr_czas_trwania']);
					}
				?>"/><br/>
				<?php
					if(isset($_SESSION['e_czas_trwania']))
					{
						echo '<div class="error">'.$_SESSION['e_czas_trwania'].'</div>';
						unset($_SESSION['e_czas_trwania']);
					}
				?>
				<input type="submit" value="Modyfikuj dane" /><br/><br/>
			</form>
		</div>
	</div>
</body>
</html>
