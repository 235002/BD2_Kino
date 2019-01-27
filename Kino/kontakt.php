<?php
  session_start();
?>
<html>
<head>
  <title>Kino ODRA</title>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <link rel="stylesheet" href="CSS/mainStyle.css" type="text/css"> 
	<link rel="stylesheet" href="CSS/styles.css" type="text/css"> 
	<link rel="stylesheet" href="CSS/style.css" type="text/css"> 
  <script src ="scripts/jQuery.js"></script>
  <script src ="scripts/script.js"></script>
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
    <span onclick="document.getElementById('id01').style.display='none'" 
      class="close" title="Close Modal">&times;</span>
    <form class="modal-content animate" method="post" action="zaloguj.php">
      <div class="imgcontainer">
        <img src="images/avatar_2.png"  height="25%" width="25%" alt="Avatar" class="avatar">
      </div>
      <div class="container">
        <label for="uname"><b>Login</b></label>
        <input type="text" placeholder="Wprowadź Login" name="uname" required>
        <label for="psw"><b>Hasło</b></label>
        <input type="password" placeholder="Wprowadź Hasło" name="psw" required>
        <button type="submit">Login</button>
      </div>         
      <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
    </form>
  </div>
        
 <div id="main">
    <h2>Kino ODRA w Nowej Soli - ul. Wojska Polskiego 37, 67-100 Nowa Sól</h2>
    <h2>Telefon: 68 387 90 15</h2>
  </div>

</body>
</html>
        