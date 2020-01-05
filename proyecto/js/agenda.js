$(document).ready(function(){


    var urlDir = "Funciones/funcionesAgenda.php"
    var hoy = new Date();
    var mes = (hoy.getMonth() +1) < 10 ? '0' + (hoy.getMonth() +1) : (hoy.getMonth() +1);
    var dia = hoy.getDate() < 10 ? '0' + hoy.getDate() : hoy.getDate();

    var fechaPrimera = hoy.getFullYear() + "-" + mes + "-" + dia;
    var fechaUltima = null;

    console.log( ObtenerColumna(fechaPrimera));
    var tamaño = ObtenerColumna(fechaPrimera).length;
    var auxColorDiv = null;
    var row = null;
    var col = null;

    /*    */
    var tabla = {
        col1: [],
        col2: [],
        col3: [],
        col4: [],
        col5: []
    };
    var tablaId = {
        col1: [],
        col2: [],
        col3: [],
        col4: [],
        col5: []
    };
    /*   */

    var meses = ["", "Enero","Febrero","Marzo","Abril","Junio","Marzo","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre",];
    var colores = ["f9ebea", "fdedec", "f5eef8", "f4ecf7","eaf2f8", "ebf5fb","e8f8f5", "e8f6f3", "e9f7ef","eafaf1","fef9e7","fef5e7","fdf2e9","fbeee6","f8f9f9","f4f6f6","f2f4f4","ebedef"];
    
    RellenarTabla(fechaPrimera);
    ActualizarTabla();

    $("#Btn_cerrar").click(function(){
        $("#formulario").css({"display" : "none"});
    });

    function ActualizarTabla(){
        var NmesFinal = fechaUltima.split('-')[1].split('0').length == 2 ? fechaUltima.split('-')[1].split('0')[1] : fechaUltima.split('-')[1].split('0')[0] ; 
        var NmesActual = fechaPrimera.split('-')[1].split('0').length == 2 ? fechaPrimera.split('-')[1].split('0')[1] : fechaPrimera.split('-')[1].split('0')[0] ; 
        $("#mes_actual").html(meses[NmesActual]);
        $("#mes_actual").css({"background": "linear-gradient(to right, #"+colores[NmesActual]+" 0%, white 100%)"});
        $("#mes_sig").html(meses[NmesFinal]);
        $("#mes_sig").css({"background": "linear-gradient(to right, white 0%, #"+colores[NmesFinal]+" 100%)"});

        $(".cont_celd").unbind();
        var com = "";
        for (var i = 1; i < 6; i++) {
            $("#tit_"+i).html( titulo = tabla['col'+i][0] );
            for (var j = 0; j < tamaño -1 ; j++) {
                aux = new String(tabla['col'+i][j+1]);
                com = aux.substring(0,7);

                    $(".cont_celd").mouseenter(function(){
                        row = $(this).attr('id').substring(10,11);
                        col = $(this).attr('id').substring(11,12);
                        $("#hora_cont_"+row+"0").css({"background-color":"#d4e6f1", "font-weight": "bold"});
                        $("#tit_"+col).css({"background-color":"#d4e6f1", "font-weight": "bold"});
                    });
                    $(".cont_celd").mouseleave(function(){
                        $("#hora_cont_"+row+"0").css({"background-color":" white", "font-weight": "400"});
                        $("#tit_"+col).css({"background-color":" white", "font-weight": "400"});
                    });

                if (com == "<button"){
                    $("#celd_cont_"+j+""+i).html("<button type=\"button\" id=\"btn_cont_"+j+i+"\" class=\"cont_btn btn btn-default btn-sm\"  >Agendar<br>Cita</br></button>");
                    $("#celd_cont_"+j+""+i).css({"background-color" : "white" });
                    $("#celd_cont_"+j+""+i).mouseenter(function(){
                        $("#Btn_editar").css({ "display": "none" });
                    });
                    $("#btn_cont_"+j+i).mouseenter(function(){
                        $(this).css({"background-color":"rgb(198, 226, 254)", "font-weight": "bold"});
                    });
                    $("#btn_cont_"+j+i).mouseleave(function(){
                        $(this).css({"background-color": "white" , "font-weight": "400"});
                    });
                    $("#btn_cont_"+j+i).click(function(){
                        var row = $(this).attr('id').substring(9,10);
                        var col = $(this).attr('id').substring(10,11);
                        var tit = $("#tit_"+col).text() + " a las " + $("#hora_cont_"+row+"0").text();

                        var k = parseInt(col);
                        var m = parseInt(row)+1;

                        $("#ContenedorID").html(k + "&" + m);

                        $("#nombre").val("");
                        $("#nombre").css({"font-weight" : "400"});
                        $("#ApellidoPaterno").val("");
                        $("#ApellidoPaterno").css({"font-weight" : "400"});
                        $("#ApellidoMaterno").val("");
                        $("#ApellidoMaterno").css({"font-weight" : "400"});
                        $("#Descripcion").val("");
                        $("#Descripcion").css({"font-weight" : "400"});

                        $("#Cita_tit").text(tit);
                        $("#Btn_Eliminar").css({"display": "none"});
                        $("#formulario").css({"display" : "inline-block"});
                    });

                }else {
                    $("#celd_cont_"+j+""+i).html(aux);
                    $("#celd_cont_"+j+""+i).css({"background-color" : pastel() });
                    $("#celd_cont_"+j+""+i).mouseenter(function(){
                        auxColorDiv = $(this).css('background-color');
                        $(this).css({
                            "background-color":"transparent", 
                            "font-weight": "bold",  
                            "cursor": "pointer"
                        });
                        var coordenadas = $(this).position();
                        var r = coordenadas.left+$(this).width()-15;
                        $("#Btn_editar").css({
                            "top": coordenadas.top,
                            "left": r,
                            "display": "inline-block",
                            "opacity":"0.7"
                        });
                    });
                    $("#celd_cont_"+j+""+i).mouseleave(function(){
                        $(this).css({
                            "background-color": auxColorDiv , 
                            "font-weight": "400", 
                            "cursor":"default"
                        });
                        $("#Btn_editar").css({ "display": "none" });
                    });
                    $("#celd_cont_"+j+""+i).click(function(){
                        var row = $(this).attr('id').substring(10,11);
                        var col = $(this).attr('id').substring(11,12);
                        var tit = $("#tit_"+col).text() + " a las " + $("#hora_cont_"+row+"0").text();

                        $("#Cita_tit").text(tit);
                        var k = parseInt(col);
                        var m = parseInt(row)+1;

                        $("#ContenedorID").html(k + "&" + m);

                        var texto = tabla['col'+k][m].split("<br>");
                        $("#nombre").val(texto[0]);
                        $("#nombre").css({"font-weight" : "bold"});
                        $("#Descripcion").val(texto[2]);
                        $("#Descripcion").css({"font-weight" : "bold"});

                        texto = texto[1].split("&nbsp;");
                        $("#ApellidoPaterno").val(texto[0]);
                        $("#ApellidoPaterno").css({"font-weight" : "bold"});
                        $("#ApellidoMaterno").val(texto[1]);
                        $("#ApellidoMaterno").css({"font-weight" : "bold"});

                        $("#formulario").css({"display" : "inline-block"});
                        $("#Btn_Eliminar").css({"display": "inline-block"});
                    });
                }
            }
        }
        $(".btn_cont.btn.btn-default.btn-sm").css({
            "width": "100%", 
            "height": "90%", 
        });
    }
    $("#Btn_Guardar").click(function(){

        var coor = $("#ContenedorID").text().split('&');
        var id = tablaId['col'+coor[0]][coor[1]].split('&');

        var id1 = id[0];
        var fe = id[1];
        var ho = id[2];
        var nm = $("#nombre").val();
        var am = $("#ApellidoMaterno").val();
        var ap = $("#ApellidoPaterno").val();
        var ds = $("#Descripcion").val();
        var idm = ObtenerID();

        if ( id[0] != 'DEFAULT' ){
            eliminar ( id[0] ); 
        }

        insertar(idm, id1, nm, ap, am, ds, fe, ho);

        RellenarTabla(fechaPrimera);
        ActualizarTabla();
        $("#formulario").css({"display" : "none"});
    });

    $("#Btn_Eliminar").click(function(){
        var coor = $("#ContenedorID").text().split('&');
        console.log(coor[0]);
        console.log(tablaId['col'+coor[0]]);
        var id = tablaId['col'+coor[0]][coor[1]].split('&');
        eliminar( id[0] );
        RellenarTabla(fechaPrimera);
        ActualizarTabla();
        $("#formulario").css({"display" : "none"});
    });


    function pastel(){ 
        var num = Math.round ( Math.abs(Math.random() * colores.length-1) );
        return "#" + colores[num];
    }

    function RellenarTabla (fecha_Inicio) {
        tabla.col1 = ObtenerColumna(fecha_Inicio);
        tablaId.col1 = ObtenerColumnaID(fecha_Inicio);
        for (var i = 2; i < 6; i++) {
            fecha_Inicio = ObtenerDiaSiguiente(fecha_Inicio);
            tabla['col'+i] = ObtenerColumna(fecha_Inicio);
            tablaId['col'+i] = ObtenerColumnaID(fecha_Inicio);
        }
        fechaUltima = fecha_Inicio;
    }

    function ObtenerColumna(fecha){
        var out = $.ajax({
            type: "POST", 
            url: urlDir,
            async: false,
            data: 'fecha='+fecha,
            success: function(data) {  
               return data;
            }
        }).responseText;
        return out.split('%');
    }

    function ObtenerColumnaID(fecha){
        var out = $.ajax({
            type: "POST", 
            url: urlDir, 
            async: false,
            data: 'fechaID='+fecha,
            success: function(data) {  
               return data;
            }
        }).responseText;
        return out.split('%');
    }

    function ObtenerDiaSiguiente(fecha){
        var out = $.ajax({
            type: "POST", 
            url: urlDir,
            async: false,
            data: 'fechaSig='+fecha,
            success: function(data) {  
               return data;
            }
        }).responseText;
        return out;
    }
    function ObtenerDiaAnterior(fecha){
        var out = $.ajax({
            type: "POST", 
            url: urlDir,
            async: false,
            data: 'fechaAnt='+fecha,
            success: function(data) {  
               return data;
            }
        }).responseText;
        return out;
    }
    function ObtenerID(){
        var out = $.ajax({
            type: "POST", 
            url: urlDir,
            async: false,
            data: 'id=null',
            success: function(data) {  
               return data;
            }
        }).responseText;
        return out;
    }
    function insertar(idm, id, nombre, ApellidoPaterno, ApellidoMaterno, Descripcion, fecha, Hora){
        var paquete = id +", "+idm+", \""+ nombre +"\", \""+ ApellidoPaterno +"\", \""+ ApellidoMaterno +"\", \""+ fecha + "\", \""+ Hora + "\", \"" + Descripcion + "\"";
        var out = $.ajax({
            type: "POST", 
            url: urlDir,
            async: false,
            data: 'insert=' + paquete,
            success: function(data) {  
               return data;
            }
        }).responseText;
        console.log(out);
    }
    function eliminar(id){
        $.ajax({
            type: "POST", 
            url: urlDir,
            async: false,
            data: 'delete=' + id,
            success: function(data) {  
               return data;
            }
        });
    }

     //1 avanza, 2 retrocede
    $("#btn2").click(function(){
        cambioUNO(2)
    });
    $("#btn4").click(function(){
        cambioUNO(1)
    });
    $("#btn5").click(function(){
        fechaPrimera = ObtenerDiaSiguiente(fechaUltima);
        cambioCINCO(fechaPrimera);
    });
    $("#btn1").click(function(){
        for (var i = 0; i < 5; i++) {
            fechaPrimera = ObtenerDiaAnterior(fechaPrimera);
        }
        cambioCINCO(fechaPrimera);
    });



    function cambioUNO(n){
        if (n == 1){
            for (var i = 1; i < 5; i++) {
                tabla['col'+i] = tabla['col'+(i+1)];
                tablaId['col'+i] = tablaId['col'+(i+1)];
            }
            fechaPrimera = ObtenerDiaSiguiente(fechaPrimera);
            fechaUltima = ObtenerDiaSiguiente(fechaUltima);
            tabla['col5'] = ObtenerColumna(fechaUltima);
            tablaId['col5'] = ObtenerColumnaID(fechaUltima);
        } else {
            for (var i = 5; i > 1; i--) {
                tabla['col'+i] = tabla['col'+(i-1)];
                tablaId['col'+i] = tablaId['col'+(i-1)];
            }
            fechaUltima = ObtenerDiaAnterior(fechaUltima);
            fechaPrimera = ObtenerDiaAnterior(fechaPrimera);
            tabla['col1'] = ObtenerColumna(fechaPrimera);
            tablaId['col1'] = ObtenerColumnaID(fechaPrimera);
        }
        ActualizarTabla();
    }

    function cambioCINCO (fechaDestino){
        RellenarTabla(fechaDestino);
        ActualizarTabla();
    }





});