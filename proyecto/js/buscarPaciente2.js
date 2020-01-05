$(document).ready(function(){
    $(".obtener").click(function(){

        var valores="";

        // Obtenemos todos los valores contenidos en los <td> de la fila
        // seleccionada
        $(this).parents("tr").find("th").each(function(){
            valores+=$(this).html()+" ";
        });
        var val = valores.split(" ");

        document.getElementById("id-paciente").value = val[0];
        
    
    });
});