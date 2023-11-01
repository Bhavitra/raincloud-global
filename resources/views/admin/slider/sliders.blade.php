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
            <h1 class="m-0">Banner Sliders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Banner Sliders</li>
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
          <a href="#addSliderModal" style="float:right;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addSliderModal">+Add</a>
         <table id="tutor_details" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            
                <th>SL No</th>
                 <th>Slider Title</th>
                 <th>Description</th>
                 <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
       
            @php $i=1; @endphp
       
              @foreach($sliders as $slider)
            <tr>
              <td>{{$i}}</td>
                <td>@php echo $slider->title; @endphp</td>
                <td>@php echo $slider->description; @endphp</td>
                <td><img src="{{url('/')}}/backend/banner/{{$slider->image}}" width="50" height="50"></td>
                 <td><a href="#sliderDeleteModal" data-toggle="modal" data-target="#sliderDeleteModal" data-backdrop="static" data-keyboard="false" onclick="slider_delete({{$slider->id}});"><i class="fa fa-trash" style="color:red;"></i></a></td>
               
               
            </tr>
            @php $i++; @endphp
            @endforeach

            @php $i++; @endphp
           
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

<div class="modal fade" id="sliderDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
        <form action="{{route('admin.slider.delete')}}" method="post">
          @csrf
  <div class="form-group">
    <label>Do you want to Delete?</label>
   <input type="hidden" id="slider" name="slider">
  </div>
  <button type="submit" class="btn btn-primary">Yes</button>
 <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
</form>
      </div>
      
    </div>
  </div>
</div>



<div class="modal fade" id="addSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Slider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.banner.slider.add')}}" method="post" enctype="multipart/form-data">
          @csrf
    <div class="form-group">
    <label for="title">Slider Title</label><br>
   <textarea id="title" name="title" class="form-control" required></textarea>
   <span style="color:red;">{{$errors->first('title')}}</span>
  </div>
  <div class="form-group">
    <label for="desc">Description</label><br>
   <textarea id="desc" name="desc" class="form-control" required></textarea>
   <span style="color:red;">{{$errors->first('desc')}}</span>
  </div>
  <div class="form-group">
    <label for="image">Image</label><br>
   <input type="file" id="image" name="image" class="form-control" required>
   <span style="color:red;">{{$errors->first('image')}}</span>
  </div>
  <div class="form-group">
  <input type="submit" class="btn btn-sm btn-primary">
  </div>
 
</form>
      </div>
      
    </div>
  </div>
</div>


@endsection
