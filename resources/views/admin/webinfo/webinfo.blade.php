@extends('admin.layouts.header')
@section('content')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 @include('admin.layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Webinfo Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Webinfo Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
    
          
         <!--starts here-->

           <form action="{{route('admin.webinfo.update')}}" method="post" enctype="multipart/form-data">
            @csrf
  <div class="form-group">
    <label for="logo">Logo</label>
    <input type="file" class="form-control" name="logo" id="logo">
    <img src="{{url('/')}}/backend/images/{{$webinfo->logo}}" style="width:100px;height:100px;border:1px solid blue;border-radius:20px;">
  </div>
    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email" value="{{$webinfo->email}}">
  </div>
    <div class="form-group">
    <label for="address">Address</label>
    <textarea class="form-control" name="address" id="address">{{$webinfo->address}}</textarea>
  </div>
    <div class="form-group">
    <label for="facebook">Facebook</label>
    <input type="text" class="form-control" name="facebook" id="facebook" value="{{$webinfo->facebook}}">
  </div>
    <div class="form-group">
    <label for="twitter">Twitter</label>
    <input type="text" class="form-control" name="twitter" id="twitter" value="{{$webinfo->twitter}}">
  </div>
    <div class="form-group">
    <label for="linkedin">Linkedin</label>
    <input type="text" class="form-control" name="linkedin" id="linkedin" value="{{$webinfo->linkedin}}">
  </div>
    <div class="form-group">
    <label for="youtube">Youtube</label>
    <input type="text" class="form-control" name="youtube" id="youtube" value="{{$webinfo->youtube}}">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>


         <!--ends here-->
         
       
       
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->









@endsection
