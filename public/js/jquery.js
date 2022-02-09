$(function(){
    // $("#fechaIni").datepicker({ minDate: 0, maxDate: "+1M +10D" });
    // $("#fechaFin").datepicker({ minDate: -20, maxDate: "+1M +10D" });
    // $( ".fecha" ).datepicker( "option", "dateFormat", "dd/mm/yy" );

    var disabledDays = [
        "17-2-2022", "25-12-2016", "26-12-2016",
        "4-4-2017", "5-4-2017", "6-4-2017", "6-4-2016", "7-4-2017", "8-4-2017", "9-4-2017"
    ];

    var dateFormat = "mm/dd/yy",
    from = $( "#fechaIni" )
      .datepicker({
        changeMonth: true,
        numberOfMonths: 3,
        minDate: 0
      }
      )
      .on( "change", function() {
        to.datepicker( "option", "minDate", getDate( this ) );
        console.log($("#fechaIni").val());
      }),
    to = $( "#fechaFin" ).datepicker({
      changeMonth: true,
      numberOfMonths: 3
    })
    .on( "change", function() {
        if(getDate(from)==null){
            
            from.datepicker("setDate", new Date(getDate(this)-1))
        }
      from.datepicker( "option", "maxDate", getDate( this ) );
    });

  function getDate( element ) {
    var date;
    try {
      date = $.datepicker.parseDate( dateFormat, element.value );
    } catch( error ) {
      date = null;
    }

    return date;
  }



// //replace these with the id's of your datepickers
// $("#fechaIni,#fechaFin").datepicker({
//    beforeShowDay: function(date) {return bloqueaDias(date)}

// });

    function bloqueaDiasIni(date){ 
        var day = date.getDay();
        var string = $.datepicker.formatDate('d-m-yy', date);
        var isDisabled = ($.inArray(string, disabledDays) != -1);
    
        //day != 0 disables all Sundays
        return [!isDisabled];
    }

    function bloqueaDiasFin(date){ 
        var day = date.getDay();
        var hoy = new Date();
        var fIni = getDate($("#fechaIni"));
        var string = $.datepicker.formatDate('d-m-yy', date);
        var isDisabled = ($.inArray(string, disabledDays) != -1 || hoy>date ||date<=fIni);
    
        //day != 0 disables all Sundays
        return [!isDisabled];
    }
})