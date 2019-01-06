<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Retrogranie</title>
	
	<meta name="description" content="Kino ODRA - spotkajmy się w kinie!" />
	<meta name="keywords" content="kino, filmy, repertuar, seans, odra" />
	
</head>
<body>
	<?php
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
				$rezultat2 = $polaczenie->query("SELECT repertuar.ID_repertuar, film.tytul, repertuar.godzina, repertuar.data
												 FROM repertuar 
												 INNER JOIN film ON repertuar.ID_film = film.ID_film");
				if (!$rezultat) throw new Exception($polaczenie->error);
			}
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br/>Informacja developerska: '.$e;
		}	
	?>
	<div id="modyfikowanie_seansu">
		<form action="repertuar_modyfikacja.php" method="post">
			Modyfikowanie seansu. <br/>
			Wybierz seans do modyfikacji:
						<select name="ID_repertuar">						
							<option value="0">Wybierz seans</option>
							<?php
								while($row = $rezultat2->fetch_assoc())
								{
								?>
								<option value = "<?php echo($row['ID_repertuar'])?>" >
									<?php echo("ID repertuaru: ".$row['ID_repertuar']." <br/>".
											   "Tytuł filmu: ".$row['tytul']." <br/>".
											   "Godzina seansu: ".$row['godzina']." <br/>".
											   "Data seansu: ".$row['data']." <br/>");
									?>
								</option>
								<?php
								}               
							?>
						</select><br/>
			
			Wybierz film: 
						<select name="ID_film">						
							<option value="0">Wybierz film</option>
							<?php
								while($row = $rezultat->fetch_assoc())
								{
								?>
								<option value = "<?php echo($row['ID_film']);?>" >
									<?php echo($row['tytul'])?>
								</option>
								<?php
								}               
							?>
						</select><br/>
						
			Wybierz godzinę: <select name="godzina">
								<option value="09:00:00">09:00</option>
								<option value="13:00:00">13:00</option>
								<option value="17:00:00">17:00</option>
								<option value="21:00:00">21:00</option>
							</select><br/>
			Wybierz datę: <input type="date" name="data" /> <br />
			<input type="submit" value="Modyfikuj"/>
		</form>
	</div>
</body>
</html>
