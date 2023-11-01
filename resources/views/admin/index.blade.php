
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
     .field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

   </style>
<title>Tutor Admin</title>
<section class="vh-100" style="background-color: #9A616D;">
<div class="container py-5 h-100">
<div class="row d-flex justify-content-center align-items-center h-100">
<div class="col col-xl-10">
<div class="card" style="border-radius: 1rem;">
<div class="row g-0">
<div class="col-md-6 col-lg-5 d-none d-md-block">
<img src="{{url('/')}}/backend/howtochooseanlsattutor.jpg" alt="logo" class="img-fluid" style="border-radius: 1rem 0 0 1rem;margin-top:50px;" />
</div>
<div class="col-md-6 col-lg-7 d-flex align-items-center">
<div class="card-body p-4 p-lg-5 text-black">
<form action="{{route('admin.login')}}" method="post">
  @csrf
<div class="d-flex align-items-center mb-3 pb-1">
<i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
<span class="h1 fw-bold mb-0">Tutor</span>
</div>
<h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account for Admin</h5>
<div class="form-outline mb-4">
<input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter your email...." autocomplete="off" required value="{{old('email')}}"/>
<label class="form-label" for="email">Email address</label>
<span style="color:red;">{{Session::get('email_mismatch')}}</span>
</div>
<div class="form-outline mb-4 form2Example27">
<input type="password" id="form2Example27" name="password" placeholder="Enter your password..." class="form-control form-control-lg" autocomplete="off" required />
<span toggle="#form2Example27" class="fa fa-fw fa-eye field-icon toggle-password" style="display:none;" autocomplete="off" required></span>
<label class="form-label" for="form2Example27">Password</label>
<span style="color:red;">{{Session::get('password_mismatch')}}</span>
</div>
<div class="pt-1 mb-4">
<button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script>

  $(document).ready(function(){

    $('.form2Example27 .field-icon').css('display','none');
  $("#form2Example27").keyup(function(){
     var value2 = this.value;

  if(value2 != ''){

    $('.form2Example27 .field-icon').css('display','block');
  
 $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

}else{

     $('.form2Example27 .field-icon').css('display','none');

}

  });

});

  </script>