<?php
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	if($_SESSION['ID_rodzajkonta'] == 1 || $_SESSION['ID_rodzajkonta'] == 3)
	{
		header('Location: konto.php');
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<link rel="stylesheet" href="CSS/mainStyle.css" type="text/css"/>
	<link rel="stylesheet" href="CSS/style.css" type="text/css"/>
	<link rel="stylesheet" href="CSS/styles.css" type="text/css"/>
    <script src ="scripts/jQuery.js"></script>
    <script src ="scripts/script.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,900&amp;subset=latin-ext" rel="stylesheet"/>
	<title>Kino Odra</title>
</head>
<body>

<div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="filmy.php">Filmy</a>
        <a href="seanse.php">Repertuar</a>
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
			<span onclick="document.getElementById('id01').style.display='none'"  class="close" title="Close Modal">&times;
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
				Witaj <?php echo $_SESSION['imie'];?>!<br/>
				Twoje dane
				Imie:	<?php echo $_SESSION['imie'];?><br/>
				Nazwisko:	<?php echo $_SESSION['nazwisko'];?><br/>
				Login:	<?php echo $_SESSION['login'];?><br/>
				E-mail:	<?php echo $_SESSION['e-mail'];?><br/>
				Numer telefonu:	<?php echo $_SESSION['nr_telefonu'];?><br/>
				Liczba punktów:	<?php echo $_SESSION['liczba_punktow'];?><br/><br/>

				<table>
					<th>Operacje możliwe do wykonania</th>
					<tr><td><a href="moje_zamowienia.php" style="text-decoration: none; color: white;">Moje Zamówienia</a></td></tr>
					<tr><td><a href="moje_bilety.php" style="text-decoration: none; color: white;">Moje Bilety</a></td></tr>
					<tr><td><a href="doladuj_punkty.php" style="text-decoration: none; color: white;">Doładuj punkty</a></td></tr>
					<tr><td><a href="rezerwacje.php" style="text-decoration: none; color: white;">Obsługa rezewacji</a></td></tr><tr>
				</table>
			</div>
		</div>
</body>
</html>