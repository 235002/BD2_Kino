

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
        czy_zajete() {
            return `${this.aval}`;
        }
        zmien(x){
            this.ava=x;
        }
    }
   // var xmlhttp = new XMLHttpRequest();
    
   
    var N=3;
    var cn1=0;
    var cn2=0;
    var seatings=[];
    var seatingValue = [];
    var seatingValue2 = [];
    function createseating(){
     
    for ( var i = 0; i < 15; i++){   
        for (var j=0; j<20; j++){

            if(i>10){
               seatings[(i*20)+j]= new seat_class((i*20)+j,true);
            }else{
                seatings[(i*20)+j]= new seat_class((i*20)+j,false);     
            }
        }
    }
    /*
    for ( var i = 0; i < 15; i++){   
        for (var j=0; j<20; j++){
            var tmp ="<?php echo $myObj[(i*20)+j]; ?>";
            if(tmp==true){
               seatings[(i*20)+j]= new seat_class((i*20)+j,true);
            }else{
                seatings[(i*20)+j]= new seat_class((i*20)+j,false);     
            }
        }
    }
    */




    /* Tutaj jest funkcja alternatywna do tej wyżej do miejsc,
     jak już będą stany miejsc  w tej tablicy z php myObj
    for ( var i = 0; i < 15; i++){   
        for (var j=0; j<20; j++){
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            
            if(myObj[(i*20)+j]==true){
                seatings[(i*20)+j]= new seat_class((i*20)+j,true);
             }else{
                 seatings[(i*20)+j]= new seat_class((i*20)+j,false);     
             }
            }
            }
        }
    }
    */    
     
     for ( var i = 0; i < 15; i++){
       
        for (var j=0; j<20; j++){
            if(seatings[(i*20)+j].ava==true){
                var seatingStyle = "<div class='seat unavailable'></div>";
                cn1++;
            }else{
                
                var seatingStyle = "<div class='seat available'></div>";
            }
            seatingValue.push(seatingStyle);
    
             if ( j === 19){
            console.log("hi");
             var seatingStyle = "<div class='clearfix'></div>";
            seatingValue.push(seatingStyle);   
    
    
    
         }
      }   
    }
    
    $('#messagePanel').html(seatingValue);
        
           $(function(){
                $('.seat').on('click',function(){ 
                    if($(this).hasClass( "unavailable" )){
                        $( this ).addClass( "unavailable" )             
                  } else if($(this).hasClass( "selected" )){
                    $( this ).removeClass( "selected" );
                        N++;
                  }else{                   
                    $( this ).addClass( "selected" );
                        N--;
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
        cn2=cn1;
            for ( var i = 0; i < 15; i++){
                for (var j=0; j<20; j++){
                    if($('.seat').eq((i*20)+j).hasClass( "selected" )){
                        seatings[(i*20)+j].ava=true; 
                        cn2++;
                        
                    }
                }
            }
        if(cn2!=cn1+N){
            alert("Wyrano zla liczbe miejsc");
        }
    // xmlhttp.open("POST", "index.php", true);
    // xmlhttp.send();

    };

    function generacja(){
        for ( var i = 0; i < 15; i++){
            for (var j=0; j<20; j++){
                if(seatings[(i*20)+j].ava==true){
                    var seatingStyle = "<div class='seat unavailable'></div>";
                }else{
                    var seatingStyle = "<div class='seat available'></div>";
                }
                seatingValue2.push(seatingStyle);
        
                 if ( j === 19){
                console.log("hi");
                 var seatingStyle = "<div class='clearfix'></div>";
                seatingValue2.push(seatingStyle);   

             }
          }   
        }
        $('#messagePanel2').html(seatingValue2);
    };