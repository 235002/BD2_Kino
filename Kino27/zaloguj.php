<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try
	{
		$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
		
		if ($polaczenie->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			$login = $_POST['login'];
			$haslo = $_POST['haslo'];
			
			$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		
			if ($rezultat = $polaczenie->query(
			sprintf("SELECT * FROM osoba WHERE login ='%s'",
			mysqli_real_escape_string($polaczenie,$login))))
			{
				$ilu_userow = $rezultat->num_rows;
				if($ilu_userow>0)
				{
					$wiersz = $rezultat->fetch_assoc();
					
					if ($haslo == $wiersz['haslo'])
					{
						$_SESSION['zalogowany'] = true;
						$_SESSION['ID_osoba'] = $wiersz['ID_osoba'];
						$_SESSION['imie'] = $wiersz['imie'];
						$_SESSION['nazwisko'] = $wiersz['nazwisko'];
						$_SESSION['login'] = $wiersz['login'];
						$_SESSION['e-mail'] = $wiersz['e-mail'];
						$_SESSION['nr_telefonu'] = $wiersz['nr_telefonu'];
						$_SESSION['ID_rodzajkonta'] = $wiersz['ID_rodzajkonta'];
						$_SESSION['liczba_punktow'] = $wiersz['liczba_punktow'];
						
						unset($_SESSION['blad']);
						$rezultat->free_result();
						header('Location: konto.php');
					}
					else 
					{
						$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
						header('Location: index.php');
					}
				} 
				else
				{
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: index.php');
				}
			}
			else
			{
				throw new Exception($polaczenie->error);
			}
			$polaczenie->close();
		}
	}
	catch(Exception $e)
	{
		echo '<span style="color: red;"> Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		echo '<br/>Informacja developerska:'.$e;
	}
?>