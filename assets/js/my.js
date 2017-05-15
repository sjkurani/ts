$(document).ready(function() {
  //Date format
  var date = new Date();
  date.setDate(date.getDate());

$(".date_fields")
.datetimepicker({
  format: "dd/mm/yyyy - HH:ii P",
  showMeridian: true,
  autoclose: true,
  todayBtn: "linked",
  startDate: date,
  linkField: "selected_pickup_date",
  linkFormat: "yyyy-mm-dd hh:ii"
})
.on('changeDate', function(ev){
  //assign_enddate();
});

function assign_enddate(){
  enddate =  new Date($("#selected_pickup_date").val());
  $(".end_datetime").datetimepicker({
    format: "dd/mm/yyyy - HH:ii P",
    showMeridian: true,
    autoclose: true,        
    startDate: enddate
  });
}
});