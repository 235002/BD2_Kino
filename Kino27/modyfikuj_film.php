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
</head>
<body>
	<div id="modyfikowanie_filmu">
		Modyfikowanie filmu
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
			Tytuł: <input type ="text" name="tytul" value="<?php
				if(isset($_SESSION['fr_tytul']))
				{
					echo $_SESSION['fr_tytul'];
					unset($_SESSION['fr_tytul']);
				}
			?>"/><br/>
			Reżysera: <input type ="text" name="rezyser" value="<?php
				if(isset($_SESSION['fr_rezyser']))
				{
					echo $_SESSION['fr_rezyser'];
					unset($_SESSION['fr_rezyser']);
				}
			?>"/><br/>
			Scenariusz: <input type ="text" name="scenariusz" value="<?php
				if(isset($_SESSION['fr_scenariusz']))
				{
					echo $_SESSION['fr_scenariusz'];
					unset($_SESSION['fr_scenariusz']);
				}
			?>"/><br/>
			Gatunek: <input type ="text" name="gatunek" value="<?php
				if(isset($_SESSION['fr_gatunek']))
				{
					echo $_SESSION['fr_gatunek'];
					unset($_SESSION['fr_gatunek']);
				}
			?>"/><br/>
			Datę premiery: <input type ="date" name="premiera" value="<?php
				if(isset($_SESSION['fr_premiera']))
				{
					echo $_SESSION['fr_premiera'];
					unset($_SESSION['fr_premiera']);
				}
			?>"/><br/>
			Kraj pochodzenia: <input type ="text" name="kraj_pochodzenia" value="<?php
				if(isset($_SESSION['fr_kraj_pochodzenia']))
				{
					echo $_SESSION['fr_kraj_pochodzenia'];
					unset($_SESSION['fr_kraj_pochodzenia']);
				}
			?>"/><br/>
			Czas trwania: <input type ="number" name="czas_trwania" value="<?php
				if(isset($_SESSION['fr_czas_trwania']))
				{
					echo $_SESSION['fr_czas_trwania'];
					unset($_SESSION['fr_czas_trwania']);
				}
			?>"/><br/>
			<input type="submit" value="Modyfikuj dane" /><br/><br/>
		</form>
	</div>
</body>
</html>
