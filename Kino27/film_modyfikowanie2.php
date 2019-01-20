<?php

	session_start();
	
	mysqli_report(MYSQLI_REPORT_STRICT);

	if(isset($_POST['tytul']) && isset($_POST['rezyser']) && isset($_POST['scenariusz']) && isset($_POST['gatunek']) 
		&& isset($_POST['premiera']) && isset($_POST['kraj_pochodzenia']) && isset($_POST['czas_trwania']) && isset($_SESSION['ID_film']))
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
				echo $tytul."<br/>";
				echo $rezyser."<br/>";
				echo $scenariusz."<br/>";
				echo $gatunek."<br/>";
				echo $premiera."<br/>";
				echo $kraj_pochodzenia."<br/>";
				echo $czas_trwania."<br/>";
				
				$ID_film = $_SESSION['ID_film'];

				$query = "UPDATE Film
						  SET tytul = '$tytul', rezyser = '$rezyser', scenariusz = '$scenariusz', gatunek = '$gatunek', premiera = '$premiera',
							  kraj_pochodzenia = '$kraj_pochodzenia', czas_trwania = '$czas_trwania'
						  WHERE ID_film = '$ID_film' ;";
				
				if($WSZYSTKO_OK == true)
				{
					if($polaczenie->query($query))
					{
							$polaczenie->close();
							$_SESSION['udana_modyfikacja'] = true;
							header('Location: modyfikuj_film.php');
					}
					else
					{
							throw new Exception($polaczenie->error);
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
