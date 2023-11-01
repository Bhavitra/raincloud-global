@php 
use App\Models\Webinfo;
$webinfo = Webinfo::first();
@endphp
 <footer class="py-5" style="background: url(./img/jpg/topbanner.jpg) 0 0 no-repeat; background-size: cover;
    background-position: center; background-attachment: fixed; position: relative;">
      <div class="container">
        <div class="row align-items-center pb-5">
          <div class="col-lg-12">
            <div class="logo mb-2">
            
            </div>
            <p>
              Color Experts International, Inc. is a renowned photo manipulation
              and graphic design service provider. CEI boasts more than 30 years
              of experience in the image editing industry serving the top global
              brands including Adidas, Nike, Puma, Apple, Samsung, Tommy
              Hilfiger, Hugo Boss, etc. The company provides simple but
              effective solutions to the photographers, e-commerce companies,
              advertising agencies, web design companies, magazine publishers,
              printing companies, etc.
            </p>
          </div>

         <!--  <div class="col-lg-5">
            <div class="newsletter">
              <form action="">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Enter Your Email Address"
                />
                <button class="btn btn-primary">subscribe</button>
              </form>
            </div>
          </div> -->
        </div>

        <div class="row footer-2">
          <div class="col-lg-3 col-md-3 col-sm-6">
            <h5>for student</h5>
            <ul>
              <li><a href="">Preply Blog</a></li>
              <li><a href="">Questions and Answers</a></li>
              <li><a href="">Student discount</a></li>
              <li><a href="">Referral program</a></li>
              <li><a href="">English placement test</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-6">
            <h5>for tutors</h5>
            <ul>
              <li><a href="">Become an online tutor</a></li>
              <li><a href="">Teach English online</a></li>
              <li><a href="">Teach French online</a></li>
              <li><a href="">Teach Spanish online</a></li>
              <li><a href="">Teach German online</a></li>
              <li><a href="">See all online tutoring jobs</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-6">
            <h5>Support</h5>
            <h6 class="mb-4">Need any help?</h6>
            <a href="" class="footer-email"
              ><i class="fa-solid fa-envelope"></i>&nbsp;{{$webinfo->email}}</a
            >
            <br /><br /><br />
            <h5>Support</h5>
            <p class="mb-0">
              <img
                src="https://img.icons8.com/external-bearicons-flat-bearicons/32/000000/external-Flag-diwali-bearicons-flat-bearicons.png"
              />&nbsp;&nbsp;India
            </p>
            <p class="mb-0">
             {{$webinfo->address}}
            </p>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-6">
            <h5>Social</h5>

            <ul class="social-icon">
              <li>
                <a href="{{$webinfo->facebook}}">
                <img
                  src="https://img.icons8.com/color/48/000000/facebook.png"
                /><span>Facebook</span>
              </a>
              </li>
              <li>
                <a href="{{$webinfo->twitter}}">
                <img
                  src="https://img.icons8.com/fluency/48/000000/twitter-squared.png"
                /><span>Twitter</span>
              </a>
              </li>
              <li>
                <a href="{{$webinfo->linkedin}}">
                <img
                  src="https://img.icons8.com/fluency/48/000000/linkedin.png"
                /><span>Linkedin</span>
              </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <div class="copyright">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <p>© 2023 Tutor</p>
          </div>
          <div class="col-lg-6">
            <p class="text-right">
              Design & Developed <a href="#">Bhavitra Technologies</a>
            </p>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/js/custom.js"></script>
    <script src="{{url('/')}}/js/animation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.0.6/swiper-bundle.min.js"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <!---gsap--->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/animation.gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
    <script src="{{url('/')}}/backend/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="{{url('/')}}/js/script.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    
     {{--starts here--}}

     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{--ends here--}}

    <script>
      $(document).ready(function () { $('#booking').DataTable(); });
      $(document).ready(function () {
    $('#example').DataTable();
    $('#example2').DataTable();
    
    
});


$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    
    </script>
    
    

    <!---gsap--->

    <script>
      const swiper = new Swiper(".swiper", {
        // Optional parameters
        direction: "horizontal",
        loop: true,

        // If we need pagination
        pagination: {
          el: ".swiper-pagination",
        },

        // Navigation arrows
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },

        // And if we need scrollbar
        scrollbar: {
          el: ".swiper-scrollbar",
        },
      });
    </script>

    <script>
  const controller = new ScrollMagic.Controller();
  const tl = new TimelineMax();

  tl.from(".how-it-starts-ins", 0.5, {
    scale:0,
    opacity:0,
    stagger:0.3,
  });

  const scene = new ScrollMagic.Scene({
    triggerElement:".how-it-starts",
    triggerHook: "onLeave",
    duration:100,
    
}) .setTween(tl)
   .addTo(controller);

      AOS.init();


    const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});


    const togglePassword2 = document.querySelector('#togglePasswordConfirmation');
  const password2 = document.querySelector('#id_password_confirmation');

  togglePassword2.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});


   $url = "https://raincloud-global.com/";
  function teacher_sub_subject(id){

    if(id != ''){

      $.ajax({

        url:"/teacher-sub-subject-fetch",
        type:"get",
        data:{id:id},
        success:function(data){
          if(data != ''){
             $(".subject_taught").css('display','block');
             $("#subject_taught").html(data);

               }else{

                  $(".subject_taught").css('display','none');
               }
        }


      });
    }else{

       $(".subject_taught").css('display','none');

    }

  }



  function teacher_time(day,id){
     
     console.log(day+id);
     $.ajax({

      url:"/teacher-timing",
      type:"get",
      data:{day:day,id:id},
      success:function(data){
        if(data != null){
         $("#timing").html(data);
       }
      }

     });
   

  }


  function delete_account(){
    
    if(confirm("Do you want to Delete?")){
        
        $.ajax({
               url:"/student-delete",
               type:"get",
               success:function(data){
                 
                 window.location.href="{{url('/')}}";

               }
        });
  }
}



function teacher_logout(){
  if(confirm("Do you want to logout?")){
  $.ajax({
      
      url:"/teacher/logout",
      type:"get",
      success:function(data){

        window.location.href="{{url('/')}}/teacher-login";

      }
  });
}

}


function review_teacher(id,booking_id){

  $("#teacher").val(id);
  $("#booking_review").val(booking_id);

}


function student_logout(){
    
    if(confirm("Do you want to Logout?")){
        
            sessionStorage.removeItem('storage');
            
            $.ajax({
                
                url:"/logout",
                type:"POST",
                success:function(data){
                    
                 window.location.href="/student-login";
                 
                }
            });
    };
}



function teacher_delete(){

 if(confirm('Do you want to Delete Account?')){

       $.ajax({

        url:"/teacher/account-delete",  
        type:"get",
        success:function(data){

          window.location.href="{{url('/')}}/teacher-login";

        }

       });

 }

}



function update_status(id){
    
   $("#status").val(id);
}



function teacher_details(id){
    
    $.ajax({
        
        url:"/teacher-detail-listing",
        type:"get",
        data:{id:id},
        success:function(data){
            
            $("#teacher_view").html(data);
        }
        
    });
}


function teacher_day(id){
    

     $.ajax({
        
        url:"/teacher-detail-day",
        type:"get",
        data:{id:id},
        success:function(data){
            
            
              $("#hello").html(data);
              
              
            
        }
        
    });
    
}




function day_change(day,id){
    
    alert(day+id);
}


function day_time(id){
    
      $.ajax({
        
        url:"/teacher-day-time",
        type:"get",
        data:{id:id},
        success:function(data){
            
          $("#times_slot").css("display","none");
          $("#day").html(data.day); 
          //$("#time").html(data.time);  
          $("#teacher_id").val(data.id);
          $("#amount").val(data.amount);   
            
        }
        
    });
    
}



function submit_form(day,time){
     
     localStorage.setItem('day',day); 
    $("#day_input").html("You select day as"+localstorage.getItem('day'));
     //$("#time_slot").html("You select time slot as"+time);
     
   
}




function day_change(day,id){
   
 $.ajax({
        
        url:"/teacher-day-change",
        type:"get",
        data:{day:day,id:id},
        success:function(data){
            
         $("#times_slot").css("display","block");
         
          $("#time").html(data.time);  
         
            
        }
        
    });
}






function day(day){

	

	$.ajax({

		url:"/teacher/fetch-availabilities",
		type:'get',
		data:{day:day},
		success:function(data){

			$("#fetch_value").html(data);

		}

	});

}




<!--starts here-->


$url = "https://raincloud-global.com/"
$(document).ready(function(){

$("#teaching_experience").summernote({
   
   height:"100"
});

$("#current_situation").summernote({
   
   height:"100"
});

});


function subject_value_change(id){

	$.ajax({

		url:"/teacher/subjectwise-subsubject",
		type:"get",
		data:{id:id},
		success:function(data){
          if(data.html8 == 1){
          	 $(".sub_subject").css('display','none');
           $(".sub_subject2").css('display','none');

        
      }else{

      	   $(".sub_subject").css('display','block');
           $(".sub_subject2").css('display','none');
          $("#sub_subject_fetch").html(data.html);

      }
		}
	})

}





function logout(){
	if(confirm("Do you want to logout?")){

	    window.location.href = "/teacher/logout";
	}
}


function timing_delete(id){
	if(confirm("Do you want to Delete?")){
        
        $.ajax({
        	  url:"/teacher/timing-delete",
        	  type:"get",
        	  data:{id:id},
        	  success:function(data){
              
             // location.reload();
              //$(".gh").removeClass('active');
              //$(".bhalo").addClass('active');
              //$('#detailsModal').modal('show');

        	  	$("#fetch_value").html(data);

        	  }
        })
	}
}

<!--ends here-->


  

    </script>
    
     <script>
$(document).ready(function () {
   
var SITEURL = "{{ url('/') }}";
  
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  
var calendar = $('#calendar').fullCalendar({
                    editable: true,
                    events: "/fullcalender",
                    displayEventTime: false,
                    editable: true,
                    defaultView: 'agendaWeek',
                    eventRender: function (event, element, view) {
                        if (event.allDay === 'true') {
                                event.allDay = true;
                        } else {
                                event.allDay = false;
                        }
                    },
                    selectable: true,
                    selectHelper: true,
                    select: function (start, end, allDay) {
                        var title = prompt('Time Select(12 hrs format:such as:4PM-5PM):');
                        if (title) {
                            
                            //starts here
                            
                            const pattern1 = "AM";
                            const patern2 = "PM";
                          
        
                             const sub1 = title.split('-')[0];
                             const sub2 = title.split('-')[1];
                             
                              const sub3 = title.split('AM')[0];
                              const sub4 = title.split('AM')[1];
                              
                                const sub6 = title.split('PM')[0];
                                 const sub8 = title.split('PM')[1];
                                 
                                 
                                 
                                 const position = title.indexOf('-');
                              
                                 
                                 
                                sub3_num = Number(sub3);
                                
                              $gh = typeof sub3_num;
                              
                             
                              
                              
                       
                             
                             
                             
                             
                             
                            
                              
                              
                              
                             
                            
                              
                            
                             if(title.includes('-')){
                             if(sub1.includes("AM") || sub1.includes("PM")){
                               
                                 
                                 if(sub2.includes("AM") || sub2.includes("PM")){
                                     
                                     
                                     /*
                                       if(isNaN(sub3) && isNaN(sub4)){
                             
                             if(isNaN(sub6) || isNaN(sub8)){
                                 
                                 alert("value must be number");
                                 return false;
                             }
                         }
                              
                              
                            
                              
                              
                                if(isNaN(sub6) && isNaN(sub8)){
                             
                             if(isNaN(sub3) || isNaN(sub4)){
                                 
                                 alert("value must be number");
                                 return false;
                             }
                         }
                              */
                                     
                              
                              /*
                               if(title.indexOf('-') ==3 || title.indexOf('-') ==4){
                                   
                                 
                               }else{
                                     alert("wrong format");
                                   return false;
                               }
                               */
                              
                                     
                                 }else{
                                     
                                     alert("format mismatch....AM or PM is missing");
                                     return false;
                                 }
                                 
                             }else{
                                alert("format mismatch....AM or PM is missing");
                                return false;
                             }
                             
                             }else{
                                 
                                 alert("format mismatch....hyphen is missing");
                                 return false;
                             }
                             
                          
                             
                            
                            
                            //ends here
                            
                            var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                            var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                            var today = new Date();
                            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date+' '+time;
                           
                            if(new Date(start) >= new Date(date)){
                            $.ajax({
                                url: "/fullcalenderAjax",
                                data: {
                                    title: title,
                                    start: start,
                                    end: end,
                                    type: 'add'
                                },
                                type: "POST",
                                success: function (data) {
                                    displayMessage("Event Created Successfully");
  
                                    calendar.fullCalendar('renderEvent',
                                        {
                                            id: data.id,
                                            title: title,
                                            start: start,
                                            end: end,
                                            allDay: allDay
                                        },true);
  
                                    calendar.fullCalendar('unselect');
                                }
                            });
                            }else{
                                
                                alert('You can not add previous date value....');
                            }
                        }
                    },
                    eventDrop: function (event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                        
                        var today = new Date();
                            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date+' '+time;

if(new Date(start) >= new Date(date)){
  
                        $.ajax({
                            url:'/fullcalenderAjax',
                            data: {
                                title: event.title,
                                start: start,
                                end: end,
                                id: event.id,
                                type: 'update'
                            },
                            type: "POST",
                            success: function (response) {
                                displayMessage("Event Updated Successfully");
                            }
                        });
}else{
                                
                                alert('You can not update previous date value....');
                            }
                    },
                    eventClick: function (event) {
                        var deleteMsg = confirm("Do you really want to delete?");
                        if (deleteMsg) {
                            $.ajax({
                                type: "POST",
                                url:  '/fullcalenderAjax',
                                data: {
                                        id: event.id,
                                        type: 'delete'
                                },
                                success: function (response) {
                                    calendar.fullCalendar('removeEvents', event.id);
                                    displayMessage("Event Deleted Successfully");
                                }
                            });
                        }
                    }
 
                });
                
                
                
         
                
              
          
 
});
 
function displayMessage(message) {
    toastr.success(message, 'Event');
} 


function view_details2(teacher_id,i){
    
     $.ajax({
                             
                                url:  '/fullcalender2',
                                data: {teacher_id:teacher_id},
                                
                            });
    
                        
                      
                 var calendar2 = $('.calendar'+i).fullCalendar({
                  
                  
                    editable: false,
                    defaultView: 'agendaWeek',
                    events: "/fullcalender2?teacher_id="+teacher_id,
                    firstDay :moment().weekday(),
    viewRender: function(currentView){
        var minDate = moment();
        // Past
        if (minDate >= currentView.start && minDate <= currentView.end) {
            $(".fc-prev-button").prop('disabled', true); 
            $(".fc-prev-button").addClass('fc-state-disabled'); 
        }
        else {
            $(".fc-prev-button").removeClass('fc-state-disabled'); 
            $(".fc-prev-button").prop('disabled', false); 
        }

    },
                   
                    eventRender: function (event, element, view) {
                        if (event.allDay === 'true') {
                                event.allDay = true;
                        } else {
                                event.allDay = false;
                        }
                        
                          console.log(event.title);
                        
                       
                    },
                    
                   
                
                
                    eventClick: function (event) {
                        $id = sessionStorage.getItem("storage");
                        if($id != null){
                        var deleteMsg = confirm("Do you want to book?");
                        if (deleteMsg) {
                            $("#myModal").modal('show');
                            $.ajax({
                                type: "POST",
                                url:  '/fullcalenderAjax2',
                                data: {
                                        id: event.id,
                                        type: 'book'
                                },
                                success: function (response) {
                                    //calendar2.fullCalendar('removeEvents', event.id);
                                    //displayMessage("Event Deleted Successfully");
                                    $("#date").html(response.date);
                                    $("#day").html(response.day);
                                    $("#time").html(response.title);
                                    $("#amount").html(response.amount);
                                    $("#teacher_name").html(response.teacher_name);
                                    $("#currency").html(response.currency);
                                    
                                     $("#amount2").val(response.amount);
                                     $("#teacher_id").val(response.teacher_id);
                                     $("#date2").val(response.date);
                                     $("#day2").val(response.day);
                                     $("#time2").val(response.availability.title);
                                     $("#id").val(response.id);
                                     $("#currency2").val(response.cu);
                                  
                                    
                                   
                                }
                            });
                        }
                        
                        }else{
                            
                            alert("please login....");
                            location.href="{{url('/')}}/student-login?booking-initiate=yes&subject-search=<?php echo Session::get('url'); ?>"
                        }
                        
                        
                    }
                    
                    
                }); 
                  
              
}



function booking_cancel(id){
    
    if(confirm("Do you want to cancel?")){
    $.ajax({
        
        url:"/student/booking-cancel",
        data:{id:id},
        success:function(data){
         location.reload();
        }
        
    });
    }
}



  
</script>

<script type="text/javascript">
        (function($) {
          $('#picker').markyourcalendar({
            availability: [
              ['1:00', '2:00', '3:00', '4:00', '5:00'],
              ['2:00'],
              ['3:00'],
              ['4:00'],
              ['5:00'],
              ['6:00'],
              ['7:00']
            ],
            // startDate: new Date("2020-10-25"),
            onClick: function(ev, data) {
              // data is a list of datetimes
              var d = data[0].split(' ')[0];
              var t = data[0].split(' ')[1];
              $('#selected-date').val(d);
              $('#selected-time').val(t);
            },
            onClickNavigator: function(ev, instance) {
              var arr = [
                [
                  ['1:00', '2:00', '3:00', '4:00', '5:00'],
                  ['2:00'],
                  ['3:00'],
                  ['4:00'],
                  ['5:00'],
                  ['6:00'],
                  ['7:00']
                ],
                [
                  ['2:00', '5:00'],
                  ['4:00', '5:00', '6:00', '7:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00', '8:00'],
                  ['4:00', '5:00'],
                  ['2:00', '5:00'],
                  ['2:00', '5:00'],
                  ['2:00', '5:00'],
                  ['2:00', '5:00']
                ],
                [
                  ['4:00', '5:00'],
                  ['4:00', '5:00'],
                  ['4:00', '5:00', '6:00', '7:00', '8:00'],
                  ['3:00', '6:00'],
                  ['3:00', '6:00'],
                  ['3:00', '6:00'],
                  ['3:00', '6:00']
                ],
                [
                  ['4:00', '5:00'],
                  ['4:00', '5:00'],
                  ['4:00', '5:00'],
                  ['4:00', '5:00', '6:00', '7:00', '8:00'],
                  ['4:00', '5:00'],
                  ['4:00', '5:00'],
                  ['4:00', '5:00']
                ],
                [
                  ['4:00', '6:00'],
                  ['4:00', '6:00'],
                  ['4:00', '6:00'],
                  ['4:00', '6:00'],
                  ['4:00', '5:00', '6:00', '7:00', '8:00'],
                  ['4:00', '6:00'],
                  ['4:00', '6:00']
                ],
                [
                  ['3:00', '6:00'],
                  ['3:00', '6:00'],
                  ['3:00', '6:00'],
                  ['3:00', '6:00'],
                  ['3:00', '6:00'],
                  ['4:00', '5:00', '6:00', '7:00', '8:00'],
                  ['3:00', '6:00']
                ],
                [
                  ['3:00', '4:00'],
                  ['3:00', '4:00'],
                  ['3:00', '4:00'],
                  ['3:00', '4:00'],
                  ['3:00', '4:00'],
                  ['3:00', '4:00'],
                  ['4:00', '5:00', '6:00', '7:00', '8:00']
                ]
              ]
              var rn = Math.floor(Math.random() * 10) % 7;
              var index = $('#arrIndex').val();
              instance.setAvailability(arr[index]);
              if (index == 0) {
                $('#myc-prev-week').css('display', 'none');
              }
            }
          });
        })(jQuery);
        if ($('#arrIndex').val() == 0) {
                $('#myc-prev-week').css('display', 'none');
        }
    </script>
  </body>
</html>
