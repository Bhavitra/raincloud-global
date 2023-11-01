<script src="{{url('/')}}/backend/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('/')}}/backend/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{url('/')}}/backend/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{url('/')}}/backend/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{url('/')}}/backend/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{url('/')}}/backend/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('/')}}/backend/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{url('/')}}/backend/plugins/moment/moment.min.js"></script>
<script src="{{url('/')}}/backend/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('/')}}/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{url('/')}}/backend/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{url('/')}}/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/backend/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="{{url('/')}}/backend/dist/js/demo.js"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('/')}}/backend/dist/js/pages/dashboard.js"></script>
<!--datatable-->
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('/')}}/backend/script/script.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
<script>
$(document).ready(function () {
    $('#tutor_details').DataTable();
});

function student_delete(id){
  if(confirm('Do you want to Delete?')){
  window.location.href="{{url('/')}}/admin/student-delete/"+id;
}
}

function edit_seo(id){
  
  $.ajax({

    url:"https://raincloud-global.com/admin/edit-seo",
    type:"get",
    data:{id:id},
    success:function(data){
       
       console.log(data);
       $("#seo_title").val(data.seo_title);
       $("#seo_description").text(data.seo_description);
       $("#seo_keywords").val(data.seo_keywords);
       $("#canonical_url").val(data.canonical_url);
        $("#seo_json").text(data.seo_json);
        $("#seo").val(data.id);
    }

  });
}


function status_update(id){

     $.ajax({
          
          url:"/admin/status-update",
          type:"get",
          data:{id:id},
          success:function(data){
            
            $("#booking").val(data);
          }
     });
}


//starts here

$url = "https://raincloud-global.com/";


function tutor_status(status,id){

	$check_status = '';
         if(status == 'active'){

         	$check_status = "deactivate";
         }else{

         	$check_status = "activate";
         }
        if(confirm('Do you want to '+$check_status)){

        	$.ajax({

	 url: "/admin/tutor-status-update",
	 type: "GET",
	 data: {status:status,id:id},
	 success:function(){

	 	window.location.href=$url+"admin/tutors";
	 	
	 }

	});
              
        }
    
	
}




function tutor_view(id){

	$.ajax({

	 url: "/admin/tutor-view",
	 type: "GET",
	 data: {id:id},
	 success:function(data){

	 $("#name").html(data.first_name+" "+data.last_name);
	 $("#email").html(data.email);
	  $("#subject").html(data.subject_name);
	   $("#sub_subject").html(data.sub_sub_name);
	 $("#hourly_rate").html(data.hourly_rate);
	 $("#timezone").html(data.timezone);
	 if(data.currency == 'inr'){
	 $("#currency").html("&#8377");
	}else{
		$("#currency").html("&#36");
	}
	 $("#teaching_experience").summernote("code",data.teaching_experience);
	 $("#current_situation").summernote("code",data.current_situation);
	 $("#phone").html(data.phone);
	 $image_src = $url+"backend/"+data.tutor_image;
	 $("#image").attr('src',$image_src);
	 	
	 }

	});

}


function tutor_availability(teacher_id){
    
      
     
     $.ajax({
                             
                                url:  '/admin/fullcalender2',
                                data: {teacher_id:teacher_id},
                                success:function(events){
                                    
                                     $('#tutor_availability').fullCalendar('removeEvents');
              $('#tutor_availability').fullCalendar('addEventSource', events);         
              $('#tutor_availability').fullCalendar('rerenderEvents' );
                                }
                                
                            });
                            
                            
                          
                      
                      
                 var tutor_availability = $('#tutor_availability').fullCalendar({
                  
                  
                  
                    events: "/admin/fullcalender2?teacher_id="+teacher_id,
                   
                    eventRender: function (event, element, view) {
                        
                        
               
                        
                      
                        
                       
                    },
                    
                   
                    
                    
                });
                
                
                //$('#tutor_availability').fullCalendar( 'refetchEvents' );
                
                
               

}


function currency_edit(id){

	$.ajax({

	 url: "/admin/currency-edit",
	 type: "GET",
	 data: {id:id},
	 success:function(data){
	 	
	  $("#rupee").val(data);
	 	
	 }

	});

}


function commission_edit(id){

	$.ajax({

	 url: "/admin/commission-edit",
	 type: "GET",
	 data: {id:id},
	 success:function(data){
	 	
	  $("#commission").val(data);
	 	
	 }

	});

}



function subject_delete(id){

	$("#subject").val(id);

}


function sub_subject_delete(id){

	$("#sub_subject").val(id);

}


function level_delete(id){

	$("#level").val(id);

}


function language_delete(id){

	$("#language").val(id);

}


function country_delete(id){

	$("#country").val(id);

}

function slider_delete(id){

	$("#slider").val(id);

}


$(document).ready(function(){

$("#title").summernote({
   
   height:"100"
});


$("#desc").summernote({
   
   height:"300"
});

$("#teaching_experience").summernote({
   
   height:"200"
});

$("#current_situation").summernote({
   
   height:"200"
});

});



function teacher_delete(id){
    
    if(confirm('Do you want to Delete?')){
        
        window.location.href="{{url('/')}}/admin/teacher-delete/"+id;
    }
}





//ends here
</script>
</body>
</html>