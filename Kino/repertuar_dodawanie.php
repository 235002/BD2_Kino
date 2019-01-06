<?php

	session_start();
	
	if ((!isset($_POST['ID_film'])) || (!isset($_POST['godzina'])) || (!isset($_POST['data'])))
	{
		header('Location: dodaj_seans.php');
		exit();
	}
	
	$wszystko_OK=true;
	
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
			//Wstawianie nowego seansu
			//Walidacja
			$ID_film = $_POST['ID_film'];
			
			if(!$rezultat = $polaczenie->query("SELECT ID_film FROM film WHERE ID_film = '$ID_film'"))
			{
				throw new Exception($polaczenie->error);
			}
			
			if($ID_film == 0)
			{
				$wszystko_OK = false;
				$_SESSION['e_id_film']="Tytuł filmu musi być wybrany! ";
			}
			
			$tt = $_POST['godzina'];
			$godzina = date('H:i:s',strtotime($tt));
			
			$td = $_POST['data'];
			$data = date('Y-m-d',strtotime($td));
			
			$current_date = date('Y-m-d');

			if($data < $current_date)
			{
				$wszystko_OK = false;
				$_SESSION['e_data']="Podana data jest niepoprawna! ";
			}
			
			$liczba_wolnych = 300;
			//Sprawdzenie czy wstawiany seans nie jest już w repertuarze
			if(!$rezultat = $polaczenie->query("SELECT ID_repertuar FROM repertuar WHERE ID_film = $ID_film AND godzina = '$godzina' AND data = '$data'"))
			{
				$wszystko_OK = false;
				$_SESSION['e_dodawanie_seansu']="Podany seans już istnieje!";
				echo "Podany seans już istnieje!"."<br/>";
			}
			
			if($wszystko_OK == true)
			{
				$polaczenie->query("INSERT INTO repertuar VALUES (NULL, $ID_film, '$godzina', '$data', $liczba_wolnych)");
				$rezultat = $polaczenie->query("SELECT ID_repertuar FROM repertuar WHERE ID_film = $ID_film AND godzina = '$godzina' AND data = '$data'");
						
				$wiersz = $rezultat->fetch_assoc();
				$seans = $wiersz['ID_repertuar'];
				for($j=1;$j<=15;$j++)
				{
					for($k=1;$k<=20;$k++)
					{
						$polaczenie->query("INSERT INTO sala VALUES (NULL, $seans, '$j', '$k', 1)");
					}
				}	
				$rezultat->free_result();
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
?>
