<?php

	session_start();
	
	if (!isset($_POST['ID_film']) || $_POST['ID_film'] == 0)
	{
		header('Location: usun_film.php');
		exit();
	}
	
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
			$ID_film = $_POST['ID_film'];

			$query = "SELECT ID_repertuar FROM repertuar WHERE ID_film = '$ID_film'";

			$rezultat = $polaczenie->query($query);
			if(!$rezultat)
			{
				$wszystko_OK = false;
				$_SESSION['e_dodawanie_seansu']="Podany film nie istnieje!";
				echo "Podany film nie istnieje!"."<br/>";
				$rezultat->free_result();
			}

			if(($wszystko_OK = true) && ($ID_film != 0))
			{
				$wynik = $rezultat->fetch_assoc();
				$ID_repertuar = $wynik['ID_repertuar'];

				//DELETE
				$polaczenie->query("DELETE FROM sala WHERE ID_repertuar = $ID_repertuar;");
				$polaczenie->query("DELETE FROM repertuar WHERE ID_repertuar = $ID_repertuar;");
				$polaczenie->query("DELETE FROM film WHERE ID_film = '$ID_film';");

				$rezultat->free_result();
				$polaczenie->close();
				$_SESSION['usuwanie_prawidlowe'] = "Prawidłowo usunięto film. <br/>" ;
				header("Location: usun_film.php");
				exit();

			}
			else
			{
				$_SESSION['usuwanie_nieprawidlowe'] = "Nie można usunąć filmu. <br/>" ;
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
