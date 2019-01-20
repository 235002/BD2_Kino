<?php

	session_start();
	
	if (!isset($_POST['ID_osoba']))
	{
		header('Location: odbierz_uprawnienia_pracownikowi.php');
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
			$ID_osoba = $_POST['ID_osoba'];
			
			//Sprawdzenie czy usuwany seans jest w repertuarze
			if(!$rezultat = $polaczenie->query("SELECT ID_osoba, ID_rodzajkonta FROM osoba WHERE ID_osoba = $ID_osoba"))
			{
				$wszystko_OK = false;
				$_SESSION['e_uprawnienia']="Podana osoba nie istnieje!";
				$rezultat->free_result();
			}
			
			if($_POST['ID_osoba'] == 0)
			{
				$wszystko_OK = false;
				$_SESSION['e_uprawnienia']="Podana osoba nie istnieje!";
			}
			
			if($wszystko_OK == true)
			{
				//UPDATE
				$polaczenie->query("UPDATE osoba SET ID_rodzajkonta = 3 WHERE ID_osoba = $ID_osoba");
				$polaczenie->close();
				$_SESSION['e_uprawnienia'] = "Prawidłowo odebrano uprawnienia. <br/>";
				header("Location: odbierz_uprawnienia_pracownikowi.php");
				exit();
			}
			else 
			{
				$_SESSION['e_uprawnienia'] = "Nie udało się odebrać uprawnień. <br/>";
				header("Location: odbierz_uprawnienia_pracownikowi.php");
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
