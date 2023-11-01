@php
use App\Models\Availability;
@endphp
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
            <h1 class="m-0">Student Class History</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Class History</li>
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
                <th>Booking ID</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Class Status</th>
            </tr>
        </thead>
        <tbody>
          @php $i=1; @endphp
          @foreach($bookings as $booking)
          @php

 $book_count = Availability::where('id',$booking->duration_id)->where('cancelled','yes')->count();
             @endphp
            <tr>
                <td>{{$i}}</td>
                 <td>{{$booking->booking_id}}</td>
                <td>{{$booking->student_id}}</td>
                <td>{{$booking->name}}</td>
                <td>
                    @if($book_count<1)
                  @if($booking->class_status == 'pending')
                  <span style="color:green;">Class yet not Started</span>
                  @endif
                   @if($booking->class_status == 'cancelled')
                  <span style="color:red;">Class Cancelled</span>
                  @endif
                   @if($booking->class_status == 'completed')
                  <span style="color:green;">Class Completed</span>
                  @endif
                  @else
                  <span style="color:red;">Not appliacble due to cancellation by student</span>
                  @endif
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


@endsection
