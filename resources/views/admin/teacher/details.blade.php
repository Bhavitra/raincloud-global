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
            <h1 class="m-0">Tutor Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tutor Details</li>
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
                <th>Sl No</th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Hourly Rate</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          @php $i=1; @endphp
          @foreach($tutor_details as $tutor)
            <tr>
                <td>{{$i}}</td>
                 <td>{{$tutor->id}}</td>
                <td>{{$tutor->first_name}} {{$tutor->last_name}}</td>
                <td>{{$tutor->email}}</td>
                <td>
                  @if($tutor->currency == 'inr')
                  &#8377;
                  @else
                   &#36
                  @endif
                  {{$tutor->hourly_rate}}
                </td>
                <td>
                  @if($tutor->status == 'active')
                  <a href="javascript:void();" class="btn btn-sm btn-success" onclick="tutor_status('{{$tutor->status}}',{{$tutor->id}});">Active</a>
                  @else
                  <a href="javascript:void();" class="btn btn-sm btn-danger" onclick = "tutor_status('{{$tutor->status}}',{{$tutor->id}});">Inactive</a>
                  @endif
                  <a href="#tutorViewModal" class="btn btn-sm btn-warning" onclick="tutor_view({{$tutor->id}});" data-toggle="modal" data-target="#tutorViewModal">View</a>
                  <a href="#tutorAvailabilityModal" class="btn btn-sm btn-info" onclick="tutor_availability({{$tutor->id}});" data-toggle="modal" data-target="#tutorAvailabilityModal">Availability</a>
                  <a href="javascript:void();" class="btn btn-sm btn-danger" onclick="teacher_delete({{$tutor->id}});"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @php $i++; @endphp
            @endforeach
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


<div class="modal fade" id="tutorViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tutor Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
  <div class="form-group">
    <label>Name</label>
   <div class="form-control" id="name"></div>
  </div>
   <div class="form-group">
    <label>Email</label>
   <div class="form-control" id="email"></div>
  </div>
   <div class="form-group">
    <label>Hourly Rate</label>
   <div class="form-control" id="hourly_rate"></div>
  </div>
   <div class="form-group">
    <label>Subject</label>
   <div class="form-control" id="subject"></div>
  </div>
   <div class="form-group">
    <label>Sub Subject</label>
   <div class="form-control" id="sub_subject"></div>
  </div>
   <div class="form-group">
    <label>Currency</label>
   <div class="form-control" id="currency"></div>
  </div>
    <div class="form-group">
    <label>Phone</label>
   <div class="form-control" id="phone"></div>
  </div>
   <div class="form-group">
    <label>Timezone</label>
   <div class="form-control" id="timezone"></div>
  </div>
   <div class="form-group">
    <label>Teaching Experience</label>
   <div class="form-control" id="teaching_experience"></div>
  </div>
   <div class="form-group">
    <label>Current Situation</label>
   <div class="form-control" id="current_situation"></div>
  </div>
  <!--
    <div class="form-group">
    <label>Image</label><br>
   <img id="image" width="100" height="100">
  </div>
  -->
 
</form>
      </div>
      
    </div>
  </div>
</div>




<div class="modal fade" id="tutorAvailabilityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tutor Availability</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
          <div id="tutor_availability"></div>
 
 

      </div>
      
    </div>
  </div>
</div>


@endsection
