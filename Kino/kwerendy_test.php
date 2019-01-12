<?php

	session_start();
	
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
			//Logowanie
			/*
			$login = "JanNow";
			$haslo = "1234";
			$query = "SELECT * FROM Osoba WHERE login = '$login' AND haslo = '$haslo'";
			$rezultat = $polaczenie->query($query);
			if(!$rezultat) throw new Exception($polaczenie->error);
			
			$ile_wynikow = $rezultat->num_rows;
			$wiersz = $rezultat->fetch_assoc();
			
			echo "Wynik dla operacji logowania.<br/>";
			echo "Kwerenda: ".$query."<br/>";
			echo "Liczba wyników: ".$ile_wynikow."<br/>";
			echo "Dane z bazy: ".$wiersz['ID_osoba']." ".$wiersz['imie']." ".$wiersz['nazwisko']." "
								.$wiersz['login']." ".$wiersz['haslo']." ".$wiersz['e-mail']." "
								.$wiersz['nr_telefonu']." ".$wiersz['ID_rodzajkonta']." ".$wiersz['liczba_punktow']."<br/><br/>";
			
			*///Rejestracja
			/*
			$email = "test1@wp.pl";
			$login = "test1";
			$imie = "TEST1";
			$nazwisko = "TEST1";
			$haslo = "1234";
			$numer_telefonu = 123456789;
			
			$query = "SELECT ID_osoba FROM Osoba WHERE `e-mail` = '$email'";
			$query2 = "SELECT ID_osoba FROM Osoba WHERE login = '$login'";
			$query3 = "INSERT INTO Osoba ( `imie`, `nazwisko`, `login`, `haslo`, `e-mail`, `nr_telefonu`, `ID_rodzajkonta`, `liczba_punktow`) 
								  VALUES ('$imie', '$nazwisko', '$login', '$haslo', '$email', $numer_telefonu, 3, 0)";
			
			
			$rezultat = $polaczenie->query($query);
			if(!$rezultat)
				throw new Exception($polaczenie->error);
			
			$rezultat2 = $polaczenie->query($query2);
			if(!$rezultat2)
				throw new Exception($polaczenie->error);
			
			if($rezultat->num_rows != 0 || $rezultat2->num_rows != 0){
				echo "Podany login lub e-mail są już zajęte";
			}
			else{
				echo "Wynik dla operacji rejestracji.<br/>";
				echo "Kwerenda: ".$query3."<br/><br/>";
				$polaczenie->query($query3);
			}
			*/
			
			
			//Modyfikowanie filmu
			/*$tytul = "TEST1";
			$rezyser = "TEST1";
			$scenariusz = "TEST1";
			$premiera = date('Y-m-d',strtotime("2000-01-01"));
			
			$query2 = "SELECT * FROM Film WHERE tytul='$tytul' AND rezyser='$rezyser' AND scenariusz='$scenariusz' AND premiera='$premiera';";
			
			$rezultat = $polaczenie->query($query2);
			if(!$rezultat)
				throw new Exception($polaczenie->error);
			
			if($rezultat->num_rows == 1){
				echo "Na podstawie danych: ".$tytul.", ".$rezyser.", ".$scenariusz.", ".$premiera."<br/>";
				echo "Znaleziono ".$rezultat->num_rows." wyników.<br/>";
				
				$wiersz = $rezultat->fetch_assoc();
				
				$_SESSION['ID_film'] = $wiersz['ID_film'];
				$_SESSION['tytul'] = $wiersz['tytul'];
				$_SESSION['rezyser'] = $wiersz['rezyser'];
				$_SESSION['scenariusz'] = $wiersz['scenariusz'];
				$_SESSION['gatunek'] = $wiersz['gatunek'];
				$_SESSION['premiera'] = $wiersz['premiera'];
				$_SESSION['kraj_pochodzenia'] = $wiersz['kraj_pochodzenia'];
				$_SESSION['czas_trwania'] = $wiersz['czas_trwania'];
				
				if(isset($_POST['tytul']) || isset($_POST['rezyser']) || isset($_POST['scenariusz']) || isset($_POST['gatunek']) 
				   || isset($_POST['premiera']) || isset($_POST['kraj_pochodzenia']) || isset($_POST['czas_trwania'])){
					   
					$ID_film = $_SESSION['ID_film'];
					$tytul = $_POST['tytul'];
					$rezyser = $_POST['rezyser'];
					$scenariusz = $_POST['scenariusz'];
					$gatunek = $_POST['gatunek'];
					$premiera = date('Y-m-d',strtotime($_POST['premiera']));
					$kraj_pochodzenia = $_POST['kraj_pochodzenia'];
					$czas_trwania = $_POST['czas_trwania'];
					
					$_SESSION['tytul'] =  $_POST['tytul'];
					$_SESSION['rezyser'] = $_POST['rezyser'];
					$_SESSION['scenariusz'] = $_POST['scenariusz'];
					$_SESSION['gatunek'] = $_POST['gatunek'];
					$_SESSION['premiera'] = $_POST['premiera'];
					$_SESSION['kraj_pochodzenia'] = $_POST['kraj_pochodzenia'];
					$_SESSION['czas_trwania'] = $_POST['czas_trwania'];
					
					
					$query = "update Film
					  set tytul = '$tytul', rezyser = '$rezyser', 
						  scenariusz = '$scenariusz', gatunek = '$gatunek',
						  premiera ='$premiera', kraj_pochodzenia = '$kraj_pochodzenia',
						  czas_trwania='$czas_trwania'
					  where ID_film = '$ID_film'";
					
					echo "Wynik dla operacji modyfikowania filmu.<br/>";
					echo "Kwerenda: ".$query."<br/><br/>";
				
					$rezultat = $polaczenie->query($query);
				}
			}
			else{
				echo "Nie znaleziono żadnego pasującego filmu!<br/>";
			}*/
			
			//Kod do resetowania rekordu testowego ID_film = 35 
			/*$premiera = date('Y-m-d',strtotime("2000-01-01"));
				$query = "update Film
				  set tytul = 'TEST1', rezyser = 'TEST1', 
					  scenariusz = 'TEST1', gatunek = 'TEST1',
					  premiera ='$premiera', kraj_pochodzenia = 'TEST1',
					  czas_trwania=100
				  where ID_film = 35";
					  
			  $polaczenie->query($query);
			*/
			
			//Usuwanie filmu
			/*$ID_film = 35;
			$query = "DELETE FROM Film WHERE ID_film = '$ID_film'";
			$rezultat = $polaczenie->query($query);
			if(!$rezultat) 
				throw new Exception($polaczenie->error);
			
			if($rezultat){
				echo "Wynik dla operacji usuwania filmu.<br/>";
				echo "Kwerenda: ".$query."<br/>";
				echo "Operacja usuwania filmu wykonała się. <br/><br/>";
			}
			else{
				echo "Operacja usuwania filmu nie wykonała się!<br/><br/>";
			}*/
			
			$polaczenie->close();
		}
	}
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		echo '<br/>Informacja developerska: '.$e;
	}	
?>


