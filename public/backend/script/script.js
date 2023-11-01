/*
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

	 url: $url+"admin/tutor-status-update",
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

	 url: $url+"admin/tutor-view",
	 type: "GET",
	 data: {id:id},
	 success:function(data){

	 $("#name").html(data.first_name+" "+data.last_name);
	 $("#email").html(data.email);
	 $("#hourly_rate").html(data.hourly_rate);
	 if(data.currency == 'inr'){
	 $("#currency").html("&#8377");
	}else{
		$("#currency").html("&#36");
	}
	 $("#teaching_experience").html(data.teaching_experience);
	 $("#current_situation").html(data.current_situation);
	 $("#phone").html(data.phone);
	 $image_src = $url+"backend/"+data.tutor_image;
	 $("#image").attr('src',$image_src);
	 	
	 }

	});

}


function tutor_availability(id){

	$.ajax({

	 url: $url+"admin/tutor-availability",
	 type: "GET",
	 data: {id:id},
	 success:function(data){
	 	
	  $("#tutor_availability").html(data);
	 	
	 }

	});

}


function currency_edit(id){

	$.ajax({

	 url: $url+"admin/currency-edit",
	 type: "GET",
	 data: {id:id},
	 success:function(data){
	 	
	  $("#rupee").val(data);
	 	
	 }

	});

}


function commission_edit(id){

	$.ajax({

	 url: $url+"admin/commission-edit",
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


});

*/

