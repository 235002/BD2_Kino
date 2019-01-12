<?php
	session_start();
	
	if(isset($_SESSION['zalogowany'])&&($_SESSION['zalogowany']==true))
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
	<title>Kino ODRA</title>
	
	<meta name="description" content="Kino ODRA - spotkajmy się w kinie!" />
	<meta name="keywords" content="kino, filmy, repertuar, seans, odra" />
	
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,900&amp;subset=latin-ext" rel="stylesheet"/>
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
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tempus sem vel elit varius, quis eleifend lorem sodales. 
		Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec sollicitudin orci at arcu sodales, ac rutrum ex semper.
		Fusce feugiat sollicitudin libero nec finibus. Phasellus ullamcorper nisi nec ante dapibus, nec pellentesque neque consequat. 
		Pellentesque mi metus, tincidunt consectetur tellus sed, ultrices lacinia sem. Vestibulum in ex ac tortor porttitor dictum. 
		Nulla porttitor non urna in tempor. Aenean ut mattis velit, vitae vestibulum leo. Proin aliquam quam vel justo lacinia, a tristique velit finibus. 
		Fusce ultricies eget diam eget dictum. <br><br>

		Quisque ornare odio blandit, laoreet lacus ut, pulvinar lacus. Nullam sit amet tortor eget augue pulvinar dignissim. 
		Duis tempor felis a molestie finibus. Curabitur a hendrerit felis. Etiam consequat ultrices condimentum. In imperdiet volutpat auctor.
		Vivamus convallis malesuada efficitur. Sed ullamcorper, sem sit amet finibus aliquet, quam nisi hendrerit justo, at volutpat velit neque sit
		amet urna. Nullam in mi felis. Phasellus sed nisi et lacus semper ullamcorper. Nullam vel enim varius mauris maximus luctus sed in leo. 
		Phasellus luctus enim sed massa tincidunt dignissim. Sed blandit augue id turpis pretium molestie. Donec lacinia urna quis sapien faucibus,
		nec blandit turpis lacinia. Vivamus malesuada vulputate porttitor.<br><br>

		Morbi nibh est, facilisis eget nisi ac, euismod varius mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, 
		per inceptos himenaeos. Morbi in est eget sem porta hendrerit. Vivamus nisi tellus, vestibulum vel erat id, bibendum ornare purus.
		Nulla venenatis hendrerit nisi sed lacinia. Suspendisse mattis sagittis nulla nec dignissim. Sed eget vulputate dui, a molestie nibh.
		Quisque condimentum velit eget aliquam ornare. Cras accumsan finibus tortor, id varius nisl gravida sed. In gravida risus vel nunc pulvinar 
		sollicitudin. Donec gravida non elit consequat egestas. Aliquam erat volutpat. Quisque vestibulum diam a massa tempus porta sed et magna.
		Vestibulum sodales ante ligula, at vestibulum purus tempus et. Praesent non condimentum sem. Maecenas ornare sem ut orci interdum, at commodo 
		<br><br>
		</div>
		<div id="footer">
		
		</div>
	</div>

</body>
</html>