<?php

	session_start();
	
	if(isset($_POST['tytul']) && isset($_POST['rezyser']) && isset($_POST['scenariusz']) && isset($_POST['gatunek']) 
		&& isset($_POST['premiera']) && isset($_POST['kraj_pochodzenia']) && isset($_POST['czas_trwania']))
	{
		$WSZYSTKO_OK = true;
		
		//Walidacja pobranych danych
		//Sprawdź tytul
		$tytul = $_POST['tytul'];
		//Sprawdzenie długości tytulu
		if((strlen($tytul)<1) || (strlen($tytul)>255))
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_tytul'] = "Tytuł musi mieć od 1 do 255 znaków.";
		}
		
		//Sprawdź rezysera
		$rezyser = $_POST['rezyser'];
		//Sprawdzenie długości tytulu
		if((strlen($rezyser)<1) || (strlen($rezyser)>255))
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_rezyser'] = "Nazwa reżysera musi mieć od 1 do 255 znaków.";
		}
		//Sprawdzanie tytulu - pod względem znaków alfanumerycznych
		if(ctype_alnum(trim(str_replace(' ','',$rezyser))) == false)
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_rezyser'] = "Nazwa reżysera może składać się tylko z liter i cyfr(bez polskich znaków)";
		}
		
		//Sprawdź scenarzyste
		$scenariusz = $_POST['scenariusz'];
		//Sprawdzenie długości scenarzysty
		if((strlen($scenariusz)<1) || (strlen($scenariusz)>255))
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_scenariusz'] = "Scenariusz musi mieć od 1 do 255 znaków.";
		}
		//Sprawdzanie scenarzysty - pod względem znaków alfanumerycznych
		if(ctype_alnum(trim(str_replace(' ','',$scenariusz))) == false)
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_scenariusz'] = "Scenariusz może składać się tylko z liter i cyfr(bez polskich znaków)";
		}
		
		//Sprawdź gatunek
		$gatunek = $_POST['gatunek'];
		//Sprawdzenie długości gatunku
		if((strlen($gatunek)<1) || (strlen($gatunek)>255))
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_gatunek'] = "Gatunek musi mieć od 1 do 255 znaków.";
		}
		//Sprawdzanie gatunku - pod względem znaków alfanumerycznych
		if(ctype_alnum(trim(str_replace(' ','',$gatunek))) == false)
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_gatunek'] = "Gatunek może składać się tylko z liter i cyfr(bez polskich znaków)";
		}
		
		//Sprawdzenie daty premiery
		$premiera = date('Y-m-d',strtotime($_POST['premiera']));
		//Sprawdzenie czy film nie ma daty z przyszłości
		$current_date = date('Y-m-d');
		if($premiera > $current_date){
			$wszystko_OK = false;
			$_SESSION['e_premiera']="Podana data premiery jest niepoprawna! ";
		}
		
		//Sprawdź kraj pochodzenia
		$kraj_pochodzenia = $_POST['kraj_pochodzenia'];
		//Sprawdzenie długości
		if((strlen($kraj_pochodzenia)<1) || (strlen($kraj_pochodzenia)>255))
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_kraj_pochodzenia'] = "Kraj pochodzenia musi mieć od 1 do 255 znaków.";
		}
		//Sprawdzanie kraju pochodzenia - pod względem znaków alfanumerycznych
		if(ctype_alnum(trim(str_replace(' ','',$kraj_pochodzenia))) == false)
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_kraj_pochodzenia'] = "Kraj pochodzenia może składać się tylko z liter i cyfr(bez polskich znaków)";
		}
		
		//Sprawdzenie czasu trwania
		$czas_trwania = $_POST['czas_trwania'];
		if($czas_trwania < 0 || $czas_trwania > 9999999){
			$WSZYSTKO_OK = false;
			$_SESSION['e_czas_trwania'] = "Czas trwania jest niepoprawny.";
		}
		
		//Zapamiętanie wprowadzonych danych
		$_SESSION['fr_tytul'] = $tytul;
		$_SESSION['fr_rezyser'] = $rezyser;
		$_SESSION['fr_scenariusz'] = $scenariusz;
		$_SESSION['fr_gatunek'] = $gatunek;
		$_SESSION['fr_premiera'] = $premiera;
		$_SESSION['fr_kraj_pochodzenia'] = $kraj_pochodzenia;
		$_SESSION['fr_czas_trwania'] = $czas_trwania;
		
		require_once "connect.php";	
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try
		{
			$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
		
			if ($polaczenie->connect_errno!=0)	
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{	
				$query = "insert into Film (`tytul`, `rezyser`, `scenariusz`, `gatunek`, `premiera`, `kraj_pochodzenia`, `czas_trwania`) 
									values ('$tytul', '$rezyser', '$scenariusz', '$gatunek', '$premiera', '$kraj_pochodzenia', '$czas_trwania');";
				$query2 = "SELECT ID_film FROM Film WHERE tytul='$tytul' AND rezyser='$rezyser'  AND scenariusz='$scenariusz' AND gatunek='$gatunek'
													AND premiera='$premiera' AND kraj_pochodzenia='$kraj_pochodzenia' AND czas_trwania='$czas_trwania';";
				
				//Czy film już istnieje?
				$rezultat = $polaczenie->query($query2);
				
				if(!$rezultat)
					throw new Exception($polaczenie->error);
				if($rezultat->num_rows != 0){
					$_SESSION['blad'] = '<span style="color:red">Dla podanych danych istnieje już film! </span>';
					header('Location: dodaj_film.php');
				}
				if($rezultat->num_rows == 0){
					if($WSZYSTKO_OK == true)
					{
						if($polaczenie->query($query))
						{
								$_SESSION['udanaredodanie'] = true;
								header('Location: dodaj_film.php');
						}
						else
						{
							throw new Exception($polaczenie->error);
						}
					}
				}			
				else 
				{
					echo "Nie udało się zapisać danych do bazy danych! "."<br/>";
				}
				$polaczenie->close();
			}
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br/>Informacja developerska: '.$e;
		}		
	}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>Kino ODRA</title>
	
	<style>
		.error
		{
			color: red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
</head>
<body>
	<div id="dodaj_film">
		<form  method="post">
			Dodawanie filmu do bazy. <br/>
			Tytuł filmu: <br/> <input type="text" name="tytul" value="<?php
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
			
			Reżyser: <br/> <input type="text" name="rezyser" value="<?php
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
			
			Scenariusz: <br/> <input type="text" name="scenariusz" value="<?php
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
			
			Gatunek: <br/> <input type="text" name="gatunek" value="<?php
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
			
			Premiera: <br/> <input type="date" name="premiera" value="<?php
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
			
			Kraj pochodzenia: <br/> <input type="text" name="kraj_pochodzenia" value="<?php
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
			
			Czas trwania: <br/> <input type="number" name="czas_trwania" value="<?php
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
			?><br/>
			<input type="submit" value="Dodaj film"/>
		</form>
	</div>
</body>
</html>