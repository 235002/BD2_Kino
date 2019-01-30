<?php 
    session_start();
    $normalny = $_POST['normal'];
    $ulgowy = $_POST['ulga'];
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
  header("Pragma: no-cache"); // HTTP 1.0.
  header("Expires: 0"); // Proxies.
  require_once "connect.php";
  mysqli_report(MYSQLI_REPORT_STRICT);
  $locliczba=$normalny+$ulgowy;
  $locliczba2=json_encode($locliczba);
  $_SESSION['liczba_biletow']=$locliczba;
  $_SESSION['normalne2'] = $normalny;
  $_SESSION['ulgowe2'] = $ulgowy;
  $_SESSION['koszt']=15*$normalny+10*$ulgowy;
  $zmienna=$_SESSION['ID_repertuaru'];
	try{
		$polaczenie = new  mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				$rezultat = $polaczenie->query(
                "SELECT ID_sala, ID_rodzajstanu
                FROM sala
                WHERE ID_repertuar = $zmienna
                ");
				if(!$rezultat) throw new Exception($polczenie->error);
				$polaczenie->close();
			}
		
	}catch(Exception $e){
		echo '<span style="color: red;"> Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
		echo '<br/>Informacja developerska:'.$e;
    }
    
    
    $boolsArr=array();
    while($row = $rezultat->fetch_assoc())
          {
            if($row['ID_rodzajstanu']==1){
                array_push($boolsArr,false);
            } else{
                array_push($boolsArr,true);
            }
            
          }
    
?>
<html>
<head>
	<title>Kino Odra</title>
	<link rel="stylesheet" href="CSS/styles.css">
	<link rel="stylesheet" href="CSS/style.css">
	<link rel="stylesheet" href="CSS/mainStyle.css" type="text/css">
	<script src="scripts/jQuery.js"></script>
	<script src="scripts/script.js"></script>
	<script src="scripts/jCook.js"></script>
	<script>
		$(function() {
			$('#btnSeating').on('click', createseating);
			$('#btnChoice').on('click', wybor);
			$('#btnGeneruj2').on('click', generacja);
		});
		class seat_class {
			constructor(x, zajete) {
				this.miejsce = x;
				this.ava = zajete;
			}
			zmien(x) {
				this.ava = x;
			}
		}
		var liczba_max = JSON.parse('<?php echo json_encode($locliczba2) ?>');
		var licznik = 0;
		var licznik2 = 0;
		var seatings = [];
		var seatings2 =[];
		var seatingValue = [];
		var seatingValue2 = [];
		var tmp;
		var tab = JSON.parse('<?php echo json_encode($boolsArr) ?>');
		function createseating() {
			for (var i = 0; i < 15; i++) {
				for (var j = 0; j < 20; j++) {
					tmp = tab[(i * 20) + j];
					if (tmp) {
						seatings[(i * 20) + j] = new seat_class((i * 20) + j, true);
						licznik = licznik + 1;
						licznik2 = licznik2 + 1;
						seatings2[(i * 20) + j]=2;
					} else {
						seatings[(i * 20) + j] = new seat_class((i * 20) + j, false);
						seatings2[(i * 20) + j]=1;
					}
				}
			}
			
            seatingValue = [];
			for (var i = 0; i < 15; i++) {
				for (var j = 0; j < 20; j++) {
					if (seatings[(i * 20) + j].ava) {
						var seatingStyle = "<div class='seat unavailable'></div>";
					} else {
						var seatingStyle = "<div class='seat available'></div>";
					}
					seatingValue.push(seatingStyle);
				}
			}
			$('#messagePanel').html(seatingValue);
			$(function() {
				$('.seat').on('click', function() {
					if ($(this).hasClass("unavailable")) {
						$(this).addClass("unavailable")
					} else if ($(this).hasClass("selected")) {
						$(this).removeClass("selected");
						licznik2 = licznik2 - 1;
					} else {
						$(this).addClass("selected");
						licznik2 = licznik2 + 1;
					}
				});
				$('.seat').mouseenter(function() {
					$(this).addClass("hovering");
					$('.seat').mouseleave(function() {
						$(this).removeClass("hovering");
					});
				});
			});
		};
		function wybor() {
			if ((licznik + liczba_max) == licznik2) {
				for (var i = 0; i < 15; i++) {
					for (var j = 0; j < 20; j++) {
						if ($('.seat').eq((i * 20) + j).hasClass("selected")) {
							seatings[(i * 20) + j].ava = true;
						}
					}
				}
				var returntab = [];
				for (var i = 0; i < 15; i++) {
					for (var j = 0; j < 20; j++) {
						if (!seatings[(i * 20) + j].ava) {
							returntab[(i * 20) + j] = 1;
						} else {
							returntab[(i * 20) + j] = 2;
						}
					}
				}
				//JSON.stringify(returntab);
				
				var numMiejsc=[];
				for(var i=0; i<returntab.length;i++){
					if (seatings2[i]!=returntab[i]){
						var num = i+1;
						var n = num.toString();
						numMiejsc.push(n);
					}
				}
				console.log(returntab);
				var x =JSON.stringify(numMiejsc)
				$.setCookie('numMiejsc', x );
				console.log(seatings2);
				//document.cookie = "varname=numMiejsc";
				//document.cookie = "varname2=returntab";
				//returntab.join(',');
				//$.post('podsumowanie.php', {'returntab': returntab});
				//$.ajax(
				//	{
				//	type: 'post',
				//	url: 'podsumowanie.php',
				//	data: {returntab: returntab}
				//	})
					
				document.location.href = 'podsumowanie.php';
					
			} else {
				window.alert("Wybierz odpowiednia liczbe miejsc");
			}
		};
		function generacja() {
			while (seatingValue2.length > 0) {
				seatingValue2.pop();
			}
			for (var i = 0; i < 15; i++) {
				for (var j = 0; j < 20; j++) {
					if (seatings[(i * 20) + j].ava == true) {
						var seatingStyle = "<div class='seat unavailable'></div>";
					} else {
						var seatingStyle = "<div class='seat available'></div>";
					}
					seatingValue2.push(seatingStyle);
				}
			}
			$('#messagePanel2').html(seatingValue2);
		};
	</script>

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

	<div id="center">
		<div id=content">
		<button id="btnSeating">Pokaz Sale</button>
		<div id="ll" style="color: white;">
			<?php echo "Liczba dostępnych biletów: ".$locliczba;?>
		</div>
		<div id="messagePanel" class="messagePanel"></div>
		<button id="btnChoice">Dokonalem Wyboru</button>
		<button id="btnGeneruj2">generuj</button>
		<div id="messagePanel2" class="messagePanel"></div>
	</div>
	</div>
</body>
</html>