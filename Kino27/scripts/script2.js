$(function(){

    $('#btnSeating').on('click', createseating);
    $('#btnChoice').on('click', wybor);
    $('#btnGeneruj2').on('click', generacja);
    
    });
    class seat_class{
        constructor(x,zajete){
            this.miejsce = x;
            this.ava=zajete;
        }
        zmien(x){
            this.ava=x;
        }
    }
   // var xmlhttp = new XMLHttpRequest();
   var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    var myObj = JSON.parse(this.responseText);
    document.getElementById("demo").innerHTML = myObj.name;
    }
    };
    xmlhttp.open("GET", "demo_file.php", true);
    xmlhttp.send();

    window.alert('<?php echo json_encode($locliczba2) ?>');
    var liczba_max= JSON.parse('<?php echo json_encode($locliczba2) ?>');
    console.log(liczba_max);
    var licznik=0;
    var licznik2=0;
    var seatings=[];
    var seatingValue = [];
    var seatingValue2 = [];
    function createseating(){

    for ( var i = 0; i < 15; i++){   
        for (var j=0; j<20; j++){
            //var tmp=JSON.parse('<?php echo json_encode($myObj[(i*20)+j]) ?>');
            var tmp=false;
            if(tmp==true){
               seatings[(i*20)+j]= new seat_class((i*20)+j,true);
               licznik=licznik+1;
               licznik2=licznik2+1;
            }else{
                seatings[(i*20)+j]= new seat_class((i*20)+j,false);     
            }
        }
    }
 
   while(seatingValue.length>0){
    seatingValue.pop();
    }
     for ( var i = 0; i < 15; i++){
       
        for (var j=0; j<20; j++){
            if(seatings[(i*20)+j].ava==true){
                var seatingStyle = "<div class='seat unavailable'></div>";
                
   
            }else{
                
                var seatingStyle = "<div class='seat available'></div>";
                
            }
           
            seatingValue.push(seatingStyle);
           
    
      }   
    }

    $('#messagePanel').html(seatingValue);
         
           $(function(){
                $('.seat').on('click',function(){ 
                    if($(this).hasClass( "unavailable" )){
                        $( this ).addClass( "unavailable" )   
                                  
                  } else if($(this).hasClass( "selected" )){
                    $( this ).removeClass( "selected" );
                    licznik2=licznik2-1;

                  }else{                   
                    $( this ).addClass( "selected" );
                    licznik2=licznik2+1;
                  }
    
                });
    
                $('.seat').mouseenter(function(){     
                    $( this ).addClass( "hovering" );
    
                       $('.seat').mouseleave(function(){ 
                       $( this ).removeClass( "hovering" );
                          
                       });
                });
    
    
           });
    
    };
    function wybor(){ 
        console.log(licznik);
        console.log(licznik2);
        console.log(licznik+liczba_max);
        console.log(liczba_max);
        if((licznik+liczba_max)==licznik2){
            for ( var i = 0; i < 15; i++){
                for (var j=0; j<20; j++){
                    if($('.seat').eq((i*20)+j).hasClass( "selected" )){
                        seatings[(i*20)+j].ava=true; 
     
                    }
                }
            } 
        } else{
            window.alert("Wybierz odpowiednia liczbe miejsc");

        }
  



    };

    function generacja(){
        while(seatingValue2.length>0){
            seatingValue2.pop();
        }
        for ( var i = 0; i < 15; i++){
            for (var j=0; j<20; j++){
                if(seatings[(i*20)+j].ava==true){
                    var seatingStyle = "<div class='seat unavailable'></div>";
                }else{
                    var seatingStyle = "<div class='seat available'></div>";
                }
                seatingValue2.push(seatingStyle);

          }   
        }
        $('#messagePanel2').html(seatingValue2);
    };