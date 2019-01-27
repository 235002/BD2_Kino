<?php
    require('html_table.php');
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    
    $ID_bilet = $_GET['id'];

    try{
        $polaczenie = new  mysqli($host, $db_user, $db_password, $db_name);
        if ($polaczenie->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                $rezultat = $polaczenie->query("SELECT 	bilet.ID_bilet, zamowienie.ID_zamowienie, film.tytul, repertuar.godzina,
                                                        repertuar.data, rodzaj_biletu.nazwa, sala.rzad, sala.miejsce
                                                FROM bilet 
                                                JOIN repertuar ON bilet.ID_repertuar = repertuar.ID_repertuar
                                                JOIN zamowienie ON zamowienie.ID_zamowienie = bilet.ID_zamowienie
                                                JOIN film ON film.ID_film = repertuar.ID_film
                                                JOIN sala ON sala.ID_sala = bilet.ID_sala
                                                JOIN rodzaj_biletu ON rodzaj_biletu.ID_rodzajbiletu = bilet.ID_rodzajbiletu
                                                WHERE bilet.ID_bilet = $ID_bilet");
                if(!$rezultat) throw new Exception($polczenie->error);
                $row = $rezultat->fetch_assoc();
                if($row['nazwa'] == "normalny"){
                    $cena = "20";
                }
                elseif($row['nazwa'] == "ulgowy"){
                    $cena = "15";
                }
                $polaczenie->close();
            }
        
    }catch(Exception $e){
        echo '<span style="color: red;"> Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
        echo '<br/>Informacja developerska:'.$e;
    }

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',16);

    $html='<table border="1">
    <tr><td width="700" height="60" colspan="2">BILET KINA ODRA</td></tr>
    <tr><td width="700" height="60" class="tg-jpc1">ID biletu: '.$row['ID_bilet'].'</td></tr>
    <tr><td width="700" height="60" class="tg-jpc1">ID zamowienia: '.$row['ID_zamowienie'].'</td></tr>
    <tr><td width="700" height="60" class="tg-jpc1">Tytul filmu: '.$row['tytul'].'</td></tr>
    <tr><td width="700" height="60" class="tg-jpc1">Cena: '.$cena.'</td></tr>
    <tr><td width="700" height="60" class="tg-jpc1">Godzina: '.$row['godzina'].'</td></tr>
    <tr><td width="700" height="60" class="tg-jpc1">Data: '.$row['data'].'</td></tr>
    <tr><td width="700" height="60" class="tg-jpc1">Rzad: '.$row['rzad'].'</td></tr>
    <tr><td width="700" height="60" class="tg-jpc1">Miejsce: '.$row['miejsce'].'</td></tr>
    </table>';

    $pdf->WriteHTML($html);
    $pdf->Output();
?>