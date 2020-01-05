<?php 
    //include "Recursos/conexion.php";
    //require_once("Recursos/conexion.php");

    $nombreServidor = "localhost";
    $UsuarioBD = "root";
    $PasswordDB = "";
    $NombreDB = "Consultorio";
    $puertoDB = "8080";
    
    $link = mysqli_connect($nombreServidor,$UsuarioBD,$PasswordDB,$NombreDB, $puertoDB); 

    setlocale(LC_ALL,"es_ES");

    $IDM = 1;
    $entra = null;
    $total = null;
    $dias = array("Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo");

    $sql = "SELECT Hora_Entrada entr, Hora_Salida sal, (Hora_Salida - Hora_Entrada)/10000 cant FROM horario WHERE `ID_Medico` = ".$IDM."";
    $result = mysqli_query($link, $sql);
    
    if ( $salida = mysqli_fetch_array($result) ){
        $entra = $salida['entr'];
        $total = $salida['cant']; 
    }

    
    //Genera Fila dias
    function iniciar(){
        global $link, $entra, $total, $IDM;
        echo "<div class=\"row\">";
        echo "<div id=\"tit_0\" class=\"col col-md-1\">Hora</div>";

        for ( $i = 1 ; $i < 6 ; $i++ ) {
            echo "<div id=\"tit_" . $i . "\" class=\"col col-md-2\"></div>";
        }
        echo "</div>";

        //Genera Toda la tabla respecto al horario del medico
        echo "<div class=\"row\">";
        for ($i=0; $i < $total; $i++) { 
            echo "<div id=\"hora_cont_" . $i . "0\" class=\"cont_hour col-md-1\">" . date("g:i A", strtotime($entra." +".$i." hour")). "</div>";
            echo "<div id=\"celd_cont_" . $i . "1\" class=\"cont_celd col-md-2\"></div>";
            echo "<div id=\"celd_cont_" . $i . "2\" class=\"cont_celd col-md-2\"></div>";
            echo "<div id=\"celd_cont_" . $i . "3\" class=\"cont_celd col-md-2\"></div>";
            echo "<div id=\"celd_cont_" . $i . "4\" class=\"cont_celd col-md-2\"></div>";
            echo "<div id=\"celd_cont_" . $i . "5\" class=\"cont_celd col-md-2\"></div>";
        }
        echo "</div>";
    }


    function ObtenerColumna($dia_Fecha){
        global $link, $total, $entra, $IDM, $dias;

        $arreglo = array();
        $dia = date('N', strtotime($dia_Fecha))-1;
        array_push($arreglo, $dias[$dia].(date(' - j', strtotime($dia_Fecha))));

        $sql = "SELECT Nombre nm, Apellido_paterno ap, Apellido_materno am, Descripcion de, time_format(hora, '%h:%i') hor FROM consultorio.cita WHERE ID_Medico = ".$IDM." and fecha = '".$dia_Fecha."' order by Hora asc;";
        $out = mysqli_query($link, $sql);

        $Hora_Entrada = date("h:i", strtotime($entra));
        $casilla = 0;

        while ( $salida = mysqli_fetch_array($out)){
            $hora = $salida['hor'];
            $text = $salida['nm']."<br>".$salida['ap']."&nbsp;".$salida['am']."<br>".$salida['de'];

            while($hora != $Hora_Entrada){
                $casilla = $casilla + 1;
                $Hora_Entrada = date("h:i", strtotime($entra. " +".$casilla." hour"));
                array_push($arreglo, "<button>");
            }

            array_push($arreglo, $text);

            $casilla = $casilla+1;
            $Hora_Entrada = date("h:i", strtotime($entra. " +".$casilla." hour"));
        }
        while (count($arreglo) != $total+1) {
            array_push($arreglo, "<button>");
        }

        return $arreglo;
    }

    function ObtenerColumnaID($dia_Fecha){
        global $link, $total, $entra, $IDM;
        $arreglo = array();

        $sql = "SELECT Hora h, ID_Cita i, time_format(hora, '%h:%i') hor FROM consultorio.cita WHERE ID_Medico = ".$IDM." and fecha = '".$dia_Fecha."' order by Hora asc;";
        $out = mysqli_query($link, $sql);

        $Hora_Entrada = date("h:i", strtotime($entra));
        $cas = 0;

        array_push($arreglo, " ");
        while ( $salida = mysqli_fetch_array($out)){
            $hora = $salida['hor'];
            

            while($hora != $Hora_Entrada){
                $cas = $cas + 1;
                $Hora_Entrada = date("h:i", strtotime($entra. " +".$cas." hour"));
                $aux = date("h:i", strtotime($Hora_Entrada. " -1 hour"));
                array_push($arreglo, "DEFAULT"."&".$dia_Fecha."&".$aux.":00");
            }
            
            $cas = $cas+1;
            $Hora_Entrada = date("h:i", strtotime($entra. " +".$cas." hour"));
            
            $aux = date("h:i", strtotime($Hora_Entrada. " -1 hour"));
            $text = $salida['i']."&".$dia_Fecha."&".$aux.":00";
            array_push($arreglo, $text);

        }
        while (count($arreglo) != $total+1) {
            $cas = $cas + 1;
            $Hora_Entrada = date("h:i", strtotime($entra. " +".$cas." hour"));
            $aux = date("h:i", strtotime($Hora_Entrada. " -1 hour"));
            array_push($arreglo, "DEFAULT"."&".$dia_Fecha."&".$aux.":00");
        }
        return $arreglo;

    }

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    if(isset($_POST['fecha'])) {
        echo implode("%", ObtenerColumna($_POST['fecha'])) ;
    }
    if(isset($_POST['fechaID'])) {
        echo  implode("%", ObtenerColumnaID($_POST['fechaID'])) ;
    }
    if(isset($_POST['fechaSig'])) {
        $fecha = diaENE( $_POST['fechaSig'], '+1' );
        echo $fecha;
    }
    if(isset($_POST['id'])) {
        echo $IDM;
    }
    if(isset($_POST['fechaAnt'])) {
        $fecha = diaENE( $_POST['fechaAnt'], '-1' );
        echo $fecha;
    }
    if(isset($_POST['insert'])){
        $sqlAux = "INSERT INTO consultorio.cita VALUES ( ".$_POST['insert']." );";
        mysqli_query($link, $sqlAux);
        echo $sqlAux;
    }
    if(isset($_POST['delete'])){
        $sqlAux = "DELETE FROM consultorio.cita WHERE ID_Cita=".$_POST['delete'].";";
        mysqli_query($link, $sqlAux);
    }

    function diaENE( $fecha, $n ){
        global $IDM, $link, $dias;
        $arregloDias = array();

        $sql = "SELECT Dia d FROM consultorio.horario where ID_Medico=".$IDM;
        $out = mysqli_query($link, $sql);

        while ( $salida = mysqli_fetch_array($out)){
            array_push($arregloDias, $salida['d']);
        }
        $num = 0;
        do{
            $fecha = Date("Y-m-d", strtotime( $fecha ." ". $n . " day" ));
            $numero = intval(date('N', strtotime($fecha))) - 1;
            $diaN = $dias[ $numero ];
        } while ( !( in_array($diaN, $arregloDias) ) ); //

        return $fecha;

    }


?>