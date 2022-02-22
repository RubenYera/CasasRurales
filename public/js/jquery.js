$(function(){
    // $("#fechaIni").datepicker({ minDate: 0, maxDate: "+1M +10D" });
    // $("#fechaFin").datepicker({ minDate: -20, maxDate: "+1M +10D" });
    // $( ".fecha" ).datepicker( "option", "dateFormat", "dd/mm/yy" );

    var disabledDays = [
        "2-17-2022", "2-25-2022"
    ];

    var from = $( "#fechaIni" )
      .datepicker({
        changeMonth: true,
        numberOfMonths: 2,
        minDate: 0,
        firstDay:1
      }
      )
      .on( "change", function() {
        var fecha = new Date(from.datepicker("getDate"));
        fecha.setDate(fecha.getDate()+1);
        if(to.datepicker("getDate")==null){
          to.datepicker("setDate", fecha )
        }
        from.datepicker("option","maxDate",from.datepicker("getDate"))
        to.datepicker( "option", "minDate", fecha );

        console.log();
      }),
    to = $( "#fechaFin" ).datepicker({
      changeMonth: true,
      numberOfMonths: 2,
      minDate: 0,
      firstDay:1
    })
    .on( "change", function() {
      var fecha = new Date(to.datepicker("getDate"));
      fecha.setDate(fecha.getDate()-1);
        if(from.datepicker("getDate")==null){
          from.datepicker("setDate", fecha)
        }
      
      to.datepicker("option","minDate",to.datepicker("getDate"))
      from.datepicker( "option", "maxDate", fecha );
    });

  // function getDate( element ) {
  //   var date;
  //   try {
  //     date = $.datepicker.parseDate( dateFormat, element.value );
  //   } catch( error ) {
  //     date = null;
  //   }

  //   return date;
  // }

// //replace these with the id's of your datepickers
// $("#fechaIni,#fechaFin").datepicker({
//    beforeShowDay: function(date) {return bloqueaDias(date)}

// });

//     function bloqueaDias(date){ 
//         var day = date.getDay();
//         var string = $.datepicker.formatDate('mm-dd-yyyy', date);
//         var isDisabled = ($.inArray(string, disabledDays) != -1);
    
//         //day != 0 disables all Sundays
//         return [!isDisabled];
//     }

//     function bloqueaDiasFin(date){ 
//         var day = date.getDay();
//         var hoy = new Date();
//         var fIni = getDate($("#fechaIni"));
//         var string = $.datepicker.formatDate('d-m-yy', date);
//         var isDisabled = ($.inArray(string, disabledDays) != -1 || hoy>date ||date<=fIni);
    
//         //day != 0 disables all Sundays
//         return [!isDisabled];
//     }
})