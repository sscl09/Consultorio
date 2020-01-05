$(document).ready(function(){

	var dias = ["Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo"];

	$("#Btn_Guarda_Horario").click(function(){
		var cont = 0;
		for (var i = 0; i < 7; i++) {
			if ( $('#check'+i).prop('checked') ) {
				cont++;
			}
		}
		if (cont == 0) {
			$("#alerta_vacio").css({"display":"inline-block"});
		}else{
			$("#alerta_vacio").css({"display":"none"});

			var hora_Entrada = $("#horaEntrada").val();
			var aux = hora_Entrada.split(":");
			hora_Entrada = parseInt(aux[0], 10);;

			var hora_Salida = $("#horaSalida").val();
			aux = hora_Salida.split(":");
			hora_Salida = parseInt(aux[0], 10);;

			if( hora_Entrada >= hora_Salida ){
				$("#alerta_horario_invalido").css({"display":"inline-block"});
			} else {
				$("#alerta_horario_invalido").css({"display":"none"});
				registrar();
				window.location.href = "registroExitoso.php";
			}
		}
	});

	function registrar(){
		for (var i = 0; i < 7; i++) {
			if ( $('#check'+i).prop('checked') ) {
				var hora_Entrada = $("#horaEntrada").val()+":00";
				var hora_Salida = $("#horaSalida").val()+":00";
				var paquete = "\""+dias[i]+"\", \""+hora_Entrada+"\", \""+hora_Salida+"\"";
				MandaRegistro(paquete);
			}
		}
	}

	function MandaRegistro(paquete){
        var out = $.ajax({
            type: "POST", 
            url: "Funciones/FuncionesHorario.php",
            async: false,
            data: 'insert=' + paquete,
            success: function(data) {  
               return data;
            }
        }).responseText;
        console.log(out);
    }

});