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
            <h1 class="m-0">Tutor Booking Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tutor Booking Details</li>
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
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Teacher ID</th>
                <th>Teacher Name</th>
                <th>Booking ID</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          @php $i=1; @endphp
          @foreach($bookings as $booking)
          @php
          $date = Carbon\Carbon::parse($booking->created_at)->format('d/m/Y h:i A');
          @endphp
            <tr>
                <td>{{$i}}</td>
                 <td>{{$booking->student_id}}</td>
                 <td>{{$booking->name}}</td>
                <td>{{$booking->teacher_id}}</td>
                <td>{{$booking->first_name}} {{$booking->last_name}}</td>
                <td>{{$booking->booking_id}}</td>
                <td>{{$date}}</td>
                <td><a href="{{route('admin.order_delete',['booking_id'=>$booking->id])}}"><i class="fa fa-trash" style="color:red;"></i></a></td>
               
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


@endsection
