<?php
	session_start();

	if(isset($_POST['login']) && isset($_POST['liczba_punktow']))
	{
		//Walidacja udana
		$WSZYSTKO_OK = true;

		//Walidacja loginu
		$login = $_POST['login'];
		$login = strval($login);
		if($login == "" || $login == NULL)
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_login'] = "Podany login jest nie poprawny. ";
		}

		$liczba_punktow = $_POST['liczba_punktow'];
		if($liczba_punktow <= 0)
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_punkty'] = "Liczba punktów musi być większa od zera. ";
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
				//Czy takie konto istnieje
				$rezultat = $polaczenie->query("SELECT * FROM osoba WHERE `login` = '$login'");

				$wynik = $rezultat->fetch_assoc();
				$liczba_punktow += $wynik['liczba_punktow'];
				
				if(!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_loginow = $rezultat->num_rows;
				if($ile_takich_loginow <= 0)
				{
					$WSZYSTKO_OK = false;
					$_SESSION['e_login'] = "Podanego loginu nie ma w bazie";
				}


				if($WSZYSTKO_OK == true)
				{
					//Hurra, wszystkie tesy zaliczone dodjamey gracza do bazy
					if($polaczenie->query("UPDATE osoba SET liczba_punktow = $liczba_punktow WHERE login = '$login'"))
					{
						$_SESSION['dodanie'] = "Udało się doładować konto. ";
					}
					else
					{
						$_SESSION['dodanie'] = "Nie udało się doładować konta. ";
						throw new Exception($polaczenie->error);
					}
				}
				$polaczenie->close();
			}
		}
		
		catch(Exception $e)
		{
			echo '<span style="color: red;"> Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br/>Informacja developerska:'.$e;
		}
	}	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>Kino ODRA</title>
	
	<meta name="description" content="Kino ODRA - spotkajmy się w kinie!" />
	<meta name="keywords" content="kino, filmy, repertuar, seans, odra" />

	<link rel="stylesheet" href="CSS/mainStyle.css" type="text/css"> 
	<link rel="stylesheet" href="CSS/styles.css" type="text/css"> 
	<link rel="stylesheet" href="CSS/style.css" type="text/css"> 
    <script src ="scripts/jQuery.js"></script>
    <script src ="scripts/script.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,900&amp;subset=latin-ext" rel="stylesheet"/>
</head>	
<body>

	<div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="filmy.php">Filmy</a>
        <a href="#">Repertuar</a>
        <a href="#">Kup</a>
        <a href="#">Zarezerwuj</a>
    </div>

	<div  id="menu">
		<ul>
			<li><a href="#news"><span color onclick="openNav()">Menu</span></a></li>
			<li><a class="active" href="index.php">Home</a></li>
			<li><a href="kontakt.php">Kontakt</a></li>
			<li><a onclick="document.getElementById('id01').style.display='block'">Logowanie</a></li>
			<li><a href="rejestracja.php">Rejestracja</a></li>
			<li><a href="konto.php">Moje Konto</a></li>
			<li>
				<?php if(isset($_SESSION['zalogowany']))
						echo '<a href="logout.php">Wyloguj</a>';
				?>
			</li>
		</ul>
	</div>

    <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;
		</span>
            <form method="post" class="modal-content animate" action="zaloguj.php">
				<div class="imgcontainer">
					<img src="images/avatar_2.png"  height="25%" width="25%" alt="Avatar" class="avatar">
				</div>
			
				<div class="container">
					<label for="uname"><b>Login</b></label>
					<input type="text" placeholder="Wprowadź Login" name="login" required>
					<label for="psw"><b>Hasło</b></label>
					<input type="password" placeholder="Wprowadź Hasło" name="haslo" required>
			
					<button type="submit">Zaloguj</button>
				</div>
			
				<div class="container" style="background-color:#f1f1f1">
					<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Anuluj</button>
				</div>
            </form>
		  </div>
	  
	  	<div id="wrapper">
			<div id="content">
				Doładuj punkty dla konta:<br/>
				<?php 
					if(isset($_SESSION['dodanie']))
					{
						echo  $_SESSION['dodanie'];
						unset($_SESSION['dodanie']);
					}

					if(isset($_SESSION['dodanie']))
					{
						echo  $_SESSION['dodanie'];
						unset($_SESSION['dodanie']);
					}
				?>

				<form method="post">
					Login doładowywanego konta: <input type="text" name="login"/> <br/>
					<?php
						if(isset($_SESSION['e_login']))
						{
							echo '<div class="error">'.$_SESSION['e_login'].'</div>';
							unset($_SESSION['e_login']);
						}
					?>
					Liczba punktów do doładowania (1 punkt = 1 złoty): <input type="number" name="liczba_punktow"/>
					<?php
						if(isset($_SESSION['e_punkty']))
						{
							echo '<div class="error">'.$_SESSION['e_punkty'].'</div>';
							unset($_SESSION['e_punkty']);
						}
					?>
					<input type="submit" value="Doładuj konto"/>
				</form>
			</div>
		</div>

</body>
</html>