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
				if (!$rezultat) throw new Exception($polaczenie->error);
			}
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br/>Informacja developerska: '.$e;
		}	
	?>
	<div id="dodawanie_seanse">
		<form action="repertuar_dodawanie.php" method="post">
			Dodawanie nowego seansu do bazy. <br/>
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
</body>
</html>
