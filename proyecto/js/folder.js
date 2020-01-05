function cambiarPestana(n){
        
    document.getElementById("DatosGenerales").style.display = 'none';
    document.getElementById("AntecedentesPerinatales").style.display = 'none';
    document.getElementById("AntecedentesPatologicos").style.display = 'none';
    document.getElementById("Vacunas").style.display = 'none';
    
    var p1 = document.getElementById("P1");
    var p2 = document.getElementById("P2");
    var p3 = document.getElementById("P3");
    var p4 = document.getElementById("P4");
    
    var pestanas = [ p1, p2, p3, p4 ];
    
    var i = 0;
    while ( i <= pestanas.length - 1 ) {
        pestanas[i].style.zIndex = "2";
        pestanas[i].style.borderBottom = 'solid 2px grey';
        pestanas[i].style.paddingBottom = '22px';
        pestanas[i].style.fontWeight = '400';
        i++;
    }
    var cambio;
    switch(n){
        case 1:
            document.getElementById("DatosGenerales").style.display = 'block';
            cambio = p1;
            break;
        case 2:
            document.getElementById("AntecedentesPerinatales").style.display = 'block';
            cambio = p2;
            break;
        case 3:
            document.getElementById("AntecedentesPatologicos").style.display = 'block';
            cambio = p3;
            break;
        case 4:
            document.getElementById("Vacunas").style.display = 'block';
            cambio = p4;
            break;
    }
    
    cambio.style.zIndex = '3';
    cambio.style.borderBottom = 'solid 0px';
    cambio.style.paddingBottom = '24px';
    cambio.style.fontWeight = 'bold';        
}
cambiarPestana(1);