<?php
	session_start();
	
	if(isset($_POST['email']))
	{
		//Udana walidacja? Załóżmy, że tak
		$WSZYSTKO_OK = true;
		
		//Sprawdź nickname
		$imie = $_POST['imie'];		
		//Sprawdzanie imienia - pod względem znaków alfanumerycznych
		if(ctype_alnum($imie) == false)
		{
			$WSZYSTKO_OK = false;
			$_SESSION['imie'] = "Imie może składać się tylko z liter i cyfr(bez polskich znaków)";
        }
        
        //Sprawdź nickname
		$nazwisko = $_POST['nazwisko'];		
		//Sprawdzanie nazwiska - pod względem znaków alfanumerycznych
		if(ctype_alnum($nazwisko) == false)
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_nazwisko'] = "Nick może składać się tylko z liter i cyfr(bez polskich znaków)";
        }
        
        //Sprawdź login
		$login = $_POST['login'];
		//Sprawdzenie długości loginu
		if((strlen($login)<3) || (strlen($login)>20))
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_login'] = "Login musi posiadać od 3 do 20 znaków";
		}
		
		//Sprawdzanie loginu - pod względem znaków alfanumerycznych
		if(ctype_alnum($login) == false)
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_login'] = "Login może składać się tylko z liter i cyfr(bez polskich znaków)";
		}
		
		//Sprawdz poprawność adresu e-mail
		$email = $_POST['email'];
		$emailB = filter_var($email,FILTER_SANITIZE_EMAIL);	
		
		if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB != $email))
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_email'] = "Podaj poprawny adres e-mail";
        }
        
        //Sprawdzenie poprawności numeru telefonu
        $nr_telefonu = $_POST['nr_telefonu'];
        $nr_telefonu = (int)$nr_telefonu;
        if($nr_telefonu<100000000 || $nr_telefonu>999999999)
        {
            $WSZYSTKO_OK = false;
            $_SESSION['e_nr_telefonu'] = "Podaj poprawny numer telefonu";
        }
		
		//Sprawdzenie poprawności haseł
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		if((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_haslo'] = "Hasło musi posiadać od 8 do 20 znaków";
		}
		
		if($haslo1 != $haslo2)
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_haslo'] = "Podane hasła nie są identyczne";
		}
        
        
        //Hashowanie haseł na razie nie potrzebne
        //$haslo_hash = password_hash($haslo1,PASSWORD_DEFAULT);
        $haslo = $haslo1;
		
		//Czy zaakceptowano regulamin
		if(!isset($_POST['regulamin']))
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_regulamin'] = "Potwierdź akceptację regulaminu";
		}
		
		//Bot or not? Oto jest pytanie
		$secret = "6LfxL4kUAAAAACUDcsyiFBK3luQqVyDph8otjawz";
		
		$sprawdz = file_get_contents(
		'https://www.google.com/recaptcha/api/siteverify?secret='
		.$secret.'&response='.$_POST['g-recaptcha-response']);
		
		$odpowiedz = json_decode($sprawdz);
		
		if($odpowiedz->success == false)
		{
			$WSZYSTKO_OK = false;
			$_SESSION['e_bot'] = "Potwierdź, że nie jesteś botem";
		}
		
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_imie'] = $imie;
		$_SESSION['fr_nazwisko'] = $nazwisko;
		$_SESSION['fr_login'] = $login;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_nr_telefonu'] = $nr_telefonu;
		$_SESSION['fr_haslo1'] = $haslo1;
		$_SESSION['fr_haslo2'] = $haslo2;
		if(isset($_POST['regulamin']))
			$_SESSION['fr_regulamin'] = true;
		
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
				//Czy e-mail już istnieje?
				$rezultat = $polaczenie->query("SELECT ID_osoba FROM osoba WHERE `e-mail`='$email'");
				
				if(!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$WSZYSTKO_OK = false;
					$_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu e-mail";
				}
				
				//Czy nick jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT ID_osoba FROM osoba WHERE login='$login'");
				
				if(!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_loginow = $rezultat->num_rows;
				if($ile_takich_loginow>0)
				{
					$WSZYSTKO_OK = false;
					$_SESSION['e_login'] = "Podany login jest już zajęty! Wybierz inny!";
				}
				
				if($WSZYSTKO_OK == true)
				{
					//Hurra, wszystkie tesy zaliczone dodjamey gracza do bazy
					if($polaczenie->query("INSERT INTO osoba 
					VALUES (NULL, '$imie', '$nazwisko', '$login', '$haslo', '$email', $nr_telefonu, 3, 0);"))
					{
						$_SESSION['udanarejestracja'] = true;
						//header('Location: witamy.php');
					}
					else
					{
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
	<title>Kino Odra</title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<link rel="stylesheet" href="CSS/mainStyle.css">
	<link rel="stylesheet" href="CSS/styles.css">
    <script src ="scripts/jQuery.js"></script>
    <script src ="scripts/script.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,900&amp;subset=latin-ext" rel="stylesheet"/>
	
	<style>
		.error
		{
			color: red;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>
</head>
<body><div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="filmy.php">Filmy</a>
        <a href="#">Repertuar</a>
        <a href="#">Kup</a>
        <a href="#">Zarezerwuj</a>
    </div>

	<div  id="menu">
		<ul >
			<li>
				<a href="#news"><span color onclick="openNav()">Menu</span></a>
			</li>
			<li>
				<a class="active" href="index.php">Home</a>
			</li>
			<li>
				<a href="kontakt.php">Kontakt</a>
			</li>
			<li>
				<a onclick="document.getElementById('id01').style.display='block'">Logowanie</a>
			</li>
			<li>
				<a href="rejestracja.php">Rejestracja</a>
			</li>
			<li>
				<a href="konto.php">Moje Konto</a>
			</li>
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
          
            <!-- Modal Content -->
            <form method="post" class="modal-content animate" action="zaloguj.php">
				<div class="imgcontainer">
					<img src="images/avatar_2.png"  height="25%" width="25%" alt="Avatar" class="avatar">
				</div>
          
				<div class="container">
					<label for="uname"><b>Login</b></label>
					<input type="text" placeholder="Wprowadź Login" name="login" required>
			
					<label for="psw"><b>Hasło</b></label>
					<input type="password" placeholder="Wprowadź Hasło" name="password" required>
			
					<button type="submit">Login</button>
				</div>
          
              	<div class="container" style="background-color:#f1f1f1">
            		<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
              	</div>
            </form>
        </div>
	
	
      <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
      <<div id="main">

            <div class="centered">
				<form method="post">
						Imie: <br/> <input type="text" name="imie" value="<?php
						if(isset($_SESSION['fr_imie']))
						{
							echo $_SESSION['fr_imie'];
							unset($_SESSION['fr_imie']);
						}
					?>"/><br/>
					<?php
						if(isset($_SESSION['e_imie']))
						{
							echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
							unset($_SESSION['e_imie']);
						}
					?>
					
					Nazwisko: <br/> <input type="text" name="nazwisko" value="<?php
						if(isset($_SESSION['fr_nazwisko']))
						{
							echo $_SESSION['fr_nazwisko'];
							unset($_SESSION['fr_nazwisko']);
						}
					?>"/><br/>
					<?php
						if(isset($_SESSION['e_nazwisko']))
						{
							echo '<div class="error">'.$_SESSION['e_nazwisko'].'</div>';
							unset($_SESSION['e_nazwisko']);
						}
					?>
					
					Login: <br/> <input type="text" name="login" value="<?php
						if(isset($_SESSION['fr_login']))
						{
							echo $_SESSION['fr_login'];
							unset($_SESSION['fr_login']);
						}
					?>"/><br/>
					<?php
						if(isset($_SESSION['e_login']))
						{
							echo '<div class="error">'.$_SESSION['e_login'].'</div>';
							unset($_SESSION['e_login']);
						}
					?>

					E-mail: <br/> <input type="text" name="email" value="<?php
						if(isset($_SESSION['fr_email']))
						{
							echo $_SESSION['fr_email'];
							unset($_SESSION['fr_email']);
						}
					?>"/><br/>
					<?php
						if(isset($_SESSION['e_email']))
						{
							echo '<div class="error">'.$_SESSION['e_email'].'</div>';
							unset($_SESSION['e_email']);
						}
					?>

					Numer Telefonu: <br/> <input type="text" name="nr_telefonu" value="<?php
						if(isset($_SESSION['fr_nr_telefonu']))
						{
							echo $_SESSION['fr_nr_telefonu'];
							unset($_SESSION['fr_nr_telefonu']);
						}
					?>"/><br/>
					<?php
						if(isset($_SESSION['e_nr_telefonu']))
						{
							echo '<div class="error">'.$_SESSION['e_nr_telefonu'].'</div>';
							unset($_SESSION['e_nr_telefonu']);
						}
					?>

					Hasło: <br/> <input type="password" name="haslo1" value="<?php
						if(isset($_SESSION['fr_haslo1']))
						{
							echo $_SESSION['fr_haslo1'];
							unset($_SESSION['fr_haslo1']);
						}
					?>"/><br/>
					<?php
						if(isset($_SESSION['e_haslo']))
						{
							echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
							unset($_SESSION['e_haslo']);
						}
					?>
					
					Powtórz hasło: <br/> <input type="password" name="haslo2" value="<?php
						if(isset($_SESSION['fr_haslo2']))
						{
							echo $_SESSION['fr_haslo2'];
							unset($_SESSION['fr_haslo2']);
						}
					?>"/><br/>

					<label>
						<input type="checkbox" name="regulamin" <?php
							if(isset($_SESSION['fr_regulamin']))
							{
								echo "checked";
								unset($_SESSION['fr_regulamin']);
							}
						
						?>/> Akceptuję regulamin
					</label>
					<?php
						if(isset($_SESSION['e_regulamin']))
						{
							echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
							unset($_SESSION['e_regulamin']);
						}
					?>
					
					<div class="g-recaptcha" data-sitekey="6LfxL4kUAAAAAB5uRWatbY_D1mJiUK-hCcyQYKJR"></div>
					<?php
						if(isset($_SESSION['e_bot']))
						{
							echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
							unset($_SESSION['e_bot']);
						}
					?>
					<br/>
					<input type="submit" id="btt" value="Zarejestruj się"/>
				</form>
            </div>
      </div>
</body>
</html>