<?php

	session_start();
	
	mysqli_report(MYSQLI_REPORT_STRICT);

	require_once "connect.php";
	
	
	if (!isset($_POST['ID_film']))
	{
		header('Location: modyfikuj_film.php');
		exit();
	}
	else
	{
		try
		{
			$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
		
			if ($polaczenie->connect_errno!=0)	
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{		
				$ID_film = $_POST['ID_film'];
				$_SESSION['ID_film'] = $_POST['ID_film'];
				
				$rezultat = $polaczenie->query("SELECT * FROM film WHERE ID_film = '$ID_film'");
				$row = $rezultat->fetch_assoc();
				
				$_SESSION['fr_tytul'] = $row['tytul'];
				$_SESSION['fr_rezyser'] = $row['rezyser'];
				$_SESSION['fr_scenariusz'] = $row['scenariusz'];
				$_SESSION['fr_gatunek'] = $row['gatunek'];
				$_SESSION['fr_premiera'] = $row['premiera'];
				$_SESSION['fr_kraj_pochodzenia'] = $row['kraj_pochodzenia'];
				$_SESSION['fr_czas_trwania'] = $row['czas_trwania'];

				$rezultat->free_result();
				$polaczenie->close();

				header("Location: modyfikuj_film.php");
				exit();
			}
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br/>Informacja developerska: '.$e;
		}	
	}
?>
