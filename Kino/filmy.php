<?php 
  session_start();
    
  require_once "connect.php";
  mysqli_report(MYSQLI_REPORT_STRICT);
    
  try{
    $polaczenie = new  mysqli($host, $db_user, $db_password, $db_name);
    if ($polaczenie->connect_errno!=0)
    {
      throw new Exception(mysqli_connect_errno());
    }
    else
    {
      $rezultat = $polaczenie->query("SELECT * FROM film WHERE 1");
      if(!$rezultat) throw new Exception($polczenie->error);
      $polaczenie->close();
    }
  }
  catch(Exception $e){
  echo '<span style="color: red;"> Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
  echo '<br/>Informacja developerska:'.$e;
  }
    
?>
<html>
<head>
  <title>Instal jQuery</title>

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
    <form class="modal-content animate" action="/action_page.php">
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
    
  <div id="wrapper">
    <div id="content">
      <table id="customers" align="center">
        <tr>
          <th>Film</th>
          <th>Tytul</th>
          <th>Reżyser</th>
          <th>Scenariusz</th>
          <th>Gatunek</th>
          <th>Premiera</th>
          <th>Kraj Pochodzenia</th>
          <th>Wybor</th>
        </tr>
                  
        <?php 
          while($row = $rezultat->fetch_assoc())
          {
              echo "<tr>";
              echo "<td>".$row['ID_film']."</td>";
              echo "<td>".$row['tytul']."</td>";
              echo "<td>".$row['rezyser']."</td>";
              echo "<td>".$row['scenariusz']."</td>"; //i tak dalej
              echo "<td>".$row['gatunek']."</td>";
              echo "<td>".$row['kraj_pochodzenia']."</td>";
              echo '<td><input type="checkbox" name="ID[]"';
              echo "></td>";
              echo "</tr>";
          }               
        ?>                
      </table>
    </div>
  </div>
</body>
</html>
    