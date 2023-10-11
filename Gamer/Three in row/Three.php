<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gato</title>
        <style type="text/css">
            body{
                width: 960px;
                margin: 0 auto;
                background-color: black;
            }
            h1{
                text-align: center;
                color: red;
            }
            #pantalla{
                border: groove 10px brown;
                background: #384448;
            }
            #boton{
                cursor: pointer;
                background-color: red;
                color: white;
                font-size: 20px;
                text-align: center;
                padding: 10px;    
            }
            #boton:hover{
                background-color: #ff0001;
            }
        
        </style>
        <script>
            var ctx, canvas;
            var fichas_array = new Array();
            var COLUMNAS = 3;
            var RENGLONES = 3;
            var fichas_X = 0;
            var fichas_O = 0;
            var tiradas = 0;
            var gameOver = false;
            var lados = 120;
            
             window.onload = function(){
                /*Verificar canvas y ejecutarlo si esta bien o msj si error*/
                canvas = document.getElementById("pantalla");
                if (canvas && canvas.getContext){
                     ctx = canvas.getContext("2d");
                    if (ctx){
                        /*Si canvas se ejecuto bien*/
                        gato();
                        mensaje("Pulse su jugada.");
                        canvas.addEventListener("click",seleccionUsuario,false);
                    } else{
                        /*Si error*/
                        alert("Error al crear el contexto!");
                    }
                }
            }
             
             function gato(){
                /*Estas funciones hacen que se cargue la imagen del tablero en el canvas*/
                var imagen = new Image();
                function procesaImagen(){
                    ctx.drawImage(imagen,0,0);
                }
                imagen.src = "tablero.png";
                imagen.onload = function(e){
                    procesaImagen();
                }
                /*Insertando fichas en array y las dibujamos   F,R,C */
                fichas_array.push(new Ficha(288,29,lados,lados,0,0,0));
                fichas_array.push(new Ficha(423,29,lados,lados,1,0,1));
                fichas_array.push(new Ficha(556,29,lados,lados,2,0,2));
                fichas_array.push(new Ficha(288,160,lados,lados,3,1,0));
                fichas_array.push(new Ficha(420,160,lados,lados,4,1,1));
                fichas_array.push(new Ficha(560,160,lados,lados,5,1,2));
                fichas_array.push(new Ficha(286,295,lados,lados,6,2,0));
                fichas_array.push(new Ficha(424,295,lados,lados,7,2,1));
                fichas_array.push(new Ficha(560,295,lados,lados,8,2,2));
            }
            
            function mensaje(cadena){
                    var lon = (canvas.width-(20*cadena.length))/2;
                    ctx.strokeStyle = "blue";
                    ctx.clearRect(0,420,canvas.width,100);
                    ctx.font = "bold 40px Courier";
                    ctx.fillText(cadena,lon,470);
                }
            
            
            function Ficha(x,y,w,h,i,ren,col){
                this.x = x;
                this.y = y;
                this.w = w;
                this.h = h;
                this.i = i;
                this.ren = ren;
                this.col = col;
                this.peso = 0;
                this.valor = "";
                this.pinta = pintaFicha;
            }
            
            
             function pintaFicha(valor){
                this.valor = valor;
                ctx.font = "bold 100px Arial";
                ctx.fillStyle = "blue";
                ctx.fillText(valor, this.x+30, this.y+100, this.w, this.h);
                
            }
            
            
            function ajustar(xx, yy){
                var posCanvas = canvas.getBoundingClientRect();
                var x = xx - posCanvas.left;
                var y = yy - posCanvas.top;
                return {x:x, y:y}
            }
            
            
             function seleccionUsuario(e){
                /*Ajusta la posicion en coordenadas del click*/
                var pos = ajustar(e.clientX, e.clientY);
                var x = pos.x;
                var y = pos.y;
                /*Ciclo verificacion si se ha dado en el lugar correcto y si esta vacio*/         
                var ficha;
                for (i=0; i<fichas_array.length; i++){
                    ficha = fichas_array[i];
                        /*Aqui se verifica si el click esta dentro del espacio correcto*/
                    if (ficha.x > 0){
                    if ((x > ficha.x)&&
                        (x < ficha.x + ficha.w)&&
                        (y > ficha.y)&&
                        (y < ficha.y + ficha.h)){
                        tiradas++;  //aumenta uno a las tiradas
                            break;  //Saca del ciclo
                         }
                    }
                }
                /*comprobar si aun se puede pintar ficha*/
                if(i<fichas_array.length){
                    /*Pintando la jugada del usuario (si esta vacio el lugar)*/
                    if (ficha.valor == ""){
                        ficha.pinta("X");
                        /*Lanza un timer para que tire la pc en un segundo*/
                        setTimeout(tiraMaquina,1000);
                    }
                }
                /****Verificamos si ganamos*******/
                    verificaRenglones(true);
                    verificaColumnas(true);
                    verificaDiagonal1(true);
                    verificaDiagonal2(true);
                if(gameOver==false && tiradas<9){
                    /***Si no ganamos****/
                    mensaje("Pensando...");
                    canvas.removeEventListener("click",seleccionUsuario,false);
                } else {
                    /*****Si ganamos desactivamos el listener******/
                    if(gameOver==false){
                    mensaje("Empatados!!!");
                        }
                }
            }
            
            
            function verificaFin(O, X){
                fin = false;
                if (X == 3) {
                    fin = true;
                    mensaje("Felicidades, has ganado!!!");
                    canvas.removeEventListener("click",seleccionUsuario,false);
                } else if (O == 3) {
                    fin = true;
                    mensaje("Lo siento, ha Perdido.");
                    canvas.removeEventListener("click",seleccionUsuario,false);
                }
                return fin;
            }
            
            
            function buscaFicha(i,j){
                for(k=0; k<fichas_array.length; k++){
                    ficha = fichas_array[k];
                    if(ficha.ren == i && ficha.col==j){
                        break;
                    }
                }
                return ficha;
            }
            
            
             function verificaRenglones(calculaPeso) {
                if(gameOver==false){
                    for (i=0; i<RENGLONES; i++) {
                        fichas_X = 0;
                        fichas_O = 0;
                        for (j=0; j<COLUMNAS; j++) {
                            ficha = buscaFicha(i,j);
                            fichas_X += (ficha.valor=="X"?1:0);
                            fichas_O += (ficha.valor=="O"?1:0);
                        }
                        if(calculaPeso){
                            for (j=0; j<COLUMNAS; j++) {
                                ficha = buscaFicha(i,j);
                                pesoFicha(ficha.i, fichas_O, fichas_X);
                            }
                        }
                        gameOver = verificaFin(fichas_O, fichas_X);
                        if(gameOver) break;
                    }
                }
            }
            /*********************/

            /****************Verificar Columnas*******************/
            function verificaColumnas(calculaPeso) {
                if(gameOver==false){
                    for (j=0; j<COLUMNAS; j++) {
                        fichas_X = 0;
                        fichas_O = 0;
                        for (i=0; i<RENGLONES; i++) {
                            ficha = buscaFicha(i,j);
                            fichas_X += (ficha.valor=="X"?1:0);
                            fichas_O += (ficha.valor=="O"?1:0);
                        }
                        if(calculaPeso){
                            for (i=0; i<RENGLONES; i++) {
                                ficha = buscaFicha(i,j);
                                pesoFicha(ficha.i, fichas_O, fichas_X);
                            }
                        }
                        gameOver = verificaFin(fichas_O, fichas_X);
                        if(gameOver) break;
                    }
                }
            }
            /*****************************************************/

            /*******Verificar diagonal desendiente********////
            function verificaDiagonal1(calculaPeso) {
                if(gameOver==false){
                    fichas_X = 0;
                    fichas_O = 0;
                    for (i=0; i<RENGLONES; i++) {
                        ficha = buscaFicha(i,i);
                        fichas_X += (ficha.valor=="X"?1:0);
                        fichas_O += (ficha.valor=="O"?1:0);
                    }
                    if(calculaPeso){
                        for(i=0; i<RENGLONES; i++) {
                            ficha = buscaFicha(i,i);
                            pesoFicha(ficha.i, fichas_O, fichas_X);
                        }
                    }
                    gameOver = verificaFin(fichas_O, fichas_X);
                }
            }
            /**************************************************/

            /*********Verificar Diagonal Acendente*****************/
            function verificaDiagonal2(calculaPeso) {
                if(gameOver==false){
                    fichas_X = 0;
                    fichas_O = 0;
                    j = 2;
                    for (i=0; i<RENGLONES; i++) {
                        ficha = buscaFicha(i,j);
                        fichas_X += (ficha.valor=="X"?1:0);
                        fichas_O += (ficha.valor=="O"?1:0);
                        j--;
                    }
                    if(calculaPeso){
                        j = 2
                        for (i=0; i<RENGLONES; i++) {
                            ficha = buscaFicha(i,j);
                            pesoFicha(ficha.i, fichas_O, fichas_X);
                            j--;
                        }
                    }
                    gameOver = verificaFin(fichas_O, fichas_X);
                }
            }
            
            function pesoFicha(i,fichas_O, fichas_X) {
                ficha = fichas_array[i];
                if (ficha.valor == ""){
                    if (fichas_O == 2 && fichas_X == 0) {
                        ficha.peso += 10;
                    } else if (fichas_O == 0 && fichas_X == 2) {
                        ficha.peso += 6;
                    } else if (fichas_O == 1 && fichas_X == 0) {
                        ficha.peso += 3;
                    } else {
                        ficha.peso += 1;
                    }
                } else {
                    ficha.peso = 0;
                }
            }
            
            function tiraMaquina(){
                tiradas++;
                console.log("Tirada numero: " + tiradas);
                /*Comprobar si hay ganador*/
                if (gameOver == false){
                    /*Verificar con el peso*/
                    verificaRenglones(true);
                    verificaColumnas(true);
                    verificaDiagonal1(true);
                    verificaDiagonal2(true);
                    /*Seleccionar mejor jugada*/
                    fichas_X = 0;
                    fichas_O = 0;
                    mejorJugada = 0;
                    for (i=0; i<fichas_array.length; i++){
                        ficha = fichas_array[i];
                        if (ficha.peso>mejorJugada){
                            mejorJugada = ficha.peso;
                            ii = i;
                        }
                    }
                    /*Realizar jugada de pc*/
                    ficha = fichas_array[ii];
                    ficha.pinta("O");
                    verificaRenglones(false);
                    verificaColumnas(false);
                    verificaDiagonal1(false);
                    verificaDiagonal2(false);
                    /*Verificamos si alguien gano*/
                    if(gameOver==false){
                        /*Si nadie gano activa el listener de click*/
                        if(tiradas<9){
                            canvas.addEventListener("click",seleccionUsuario,false);
                            mensaje("Pulse su jugada...");
                        }
                    }
                }
            }
             
        
        </script>
    </head>
    <body>
        <h1>"Juego del Gato"</h1>
        <canvas id="pantalla" width="960px" height="500px">
            Tu navegador no soporta Canvas.
        </canvas></br></br></br>
         <a id="boton" type="reset" onclick="javascript:window.location.reload();">Volver a Jugar</a>
    </body>
</html>