$(function(){

    var footer= $(".spinner");
    var cont=$("<div>").load("plantillas/listadoAlojamientos.html",
    function(){
        var modelo = $(".plantillaAlojamiento");
        cont.empty();
        $.getJSON("Api/JSON_Alojamientos_Tipo",function (data) {
            $.each(data, function (ind, valor) { 
                var alojamiento = modelo.clone();
                alojamiento.find(".nombre").text(data[ind].nombre_Alojamiento);
                //footer.before(alojamiento);
                alojamiento.appendTo(cont);
            }); 
        }
    );
    })
    cont.appendTo("#cAlojamientos");
    // $.getJSON("Api/JSON_Alojamientos_Tipo",function (data) {
    //     console.log(data[0])
    // })
    
})
