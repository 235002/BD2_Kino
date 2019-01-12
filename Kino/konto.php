<?php
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link href="" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,900&amp;subset=latin-ext" rel="stylesheet"/>
	<title>Kino Odra</title>
</head>
<body>
<div id="wrapper" >
		<div id="header">
			<div id="logo">
				<b><span style="color: #2424ff;">KINO</span> <span style="color: #cc0000">ODRA</span></b>
			</div>
			<div id="menu">
				<div class="option">
					<a href="#" >Repertuar</a>
				</div>
				<div class="option">
					<a href="konto.php" style="decoration: none;">Moje konto</a>
				</div>
				<div id="login">
					<form action="zaloguj.php" method="post">
					Login: <input type="text" name="login"/><br/>
					Hasło: <input type="password" name="haslo"/><br/>
					<input type="submit" value="Zaloguj"/><br/>
					</form>

					<?php
						if(isset($_SESSION['blad']))
						echo $_SESSION['blad'];
					?>

				</div>
				<div class="option">
					<a href="rejestracja.php" >Rejestracja</a>
				</div>
				<div style="clear: both;"/>
			</div>
		</div>
       
		<div id="content">
            <?php
                    echo "<p>Witaj ".$_SESSION['imie']." ".$_SESSION['nazwisko']."! ";
                    echo "Twoje dane: ";
            ?>
        </div>
        <div id="footer">
	
		</div>
	</div>

</body>
</html>