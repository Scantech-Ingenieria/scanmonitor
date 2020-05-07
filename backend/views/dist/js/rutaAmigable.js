function setearRuta(valor){
    var valor = valor.toLowerCase();
    var valor = valor.replace(" ", "-");
    var valor = valor.replace(" ", "-");
    return valor;
}

function insertar(valor,destino){
    valor=setearRuta(valor)
    valor=quitaacentos(valor)
    console.log(valor)
    console.log(destino)
  

    $('#'+destino).val(valor);
    
  
}

function quitaacentos(s) {
    var r=s.toLowerCase();
                r = r.replace(new RegExp(/\s/g),"");
                r = r.replace(new RegExp(/[àáâãäå]/g),"a");
                r = r.replace(new RegExp(/[èéêë]/g),"e");
                r = r.replace(new RegExp(/[ìíîï]/g),"i");
                r = r.replace(new RegExp(/ñ/g),"n");                
                r = r.replace(new RegExp(/[òóôõö]/g),"o");
                r = r.replace(new RegExp(/[ùúûü]/g),"u");
                
     return r;
    }