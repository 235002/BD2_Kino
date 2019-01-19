<?php

	session_start();
	
	if (!isset($_POST['ID_repertuar']))
	{
		header('Location: usun_seans.php');
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
			//Usuwanie seansu			
			//Walidacja
			$ID_repertuar = $_POST['ID_repertuar'];
			
			//Sprawdzenie czy usuwany seans jest w repertuarze
			if(!$rezultat = $polaczenie->query("SELECT ID_repertuar FROM repertuar WHERE ID_repertuar = $ID_repertuar"))
			{
				$wszystko_OK = false;
				$_SESSION['e_dodawanie_seansu']="Podany seans nie istnieje!";
				echo "Podany seans nie istnieje!"."<br/>";
				$rezultat->free_result();
			}
			
			if($wszystko_OK == true)
			{
				//DELETE
				$polaczenie->query("DELETE FROM sala WHERE ID_repertuar = $ID_repertuar;");
				$polaczenie->query("DELETE FROM repertuar WHERE ID_repertuar = $ID_repertuar;");
				
				$rezultat->free_result();
				$polaczenie->close();
				header("Location: usun_seans.php");
				exit();
			}
			else 
			{
				echo "Nie udało się usunąć danych z bazy danych! "."<br/>";
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
