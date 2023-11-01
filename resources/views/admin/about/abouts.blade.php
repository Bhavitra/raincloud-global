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
            <h1 class="m-0">What We're About</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">What We're About</li>
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

         <table id="tutor_details" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            
                <th>Title</th>
                 <th>Description</th>
                 <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
       
       
            <tr>
                <td>{{$about->title}}</td>
                <td>@php echo $about->description; @endphp</td>
                <td><img src="{{url('/')}}/backend/about/{{$about->image}}" width="100" height="100"></td>
                 <td><a href="#aboutEditModal" data-toggle="modal" data-target="#aboutEditModal" onclick="about_edit({{$about->id}});"><i class="fa fa-edit"></i></a></td>
               
               
            </tr>
           
        </tbody>
     
    </table>


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


<div class="modal fade" id="aboutEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit About</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.about.update')}}" method="post" enctype="multipart/form-data">
          @csrf
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" id="title_about" aria-describedby="emailHelp" value="{{$about->title}}">
  </div>
   <div class="form-group">
     <label for="desc">Description</label>
    <textarea class="form-control" name="desc" id="desc" aria-describedby="emailHelp">@php echo $about->description; @endphp</textarea>
  </div>
  <input type="hidden" name="about_id" value="{{$about->id}}">
    <div class="form-group">
      <input type="file" name="image" class="form-control">
    </div>
      <div class="form-group">
        <img src="{{url('/')}}/backend/about/{{$about->image}}" width="100" height="100">
      </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
      
    </div>
  </div>
</div>

@endsection
