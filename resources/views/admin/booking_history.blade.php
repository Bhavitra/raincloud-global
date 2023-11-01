@php 
use App\Models\TimezoneTime; 
use App\Models\Availability;
use App\Models\ClassStatus;
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
            <h1 class="m-0">Booking History</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Booking History</li>
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
                <th>Reference ID</th>
                <th>Student Name</th>
                <th>Student Timezone</th>
                <th>Subject Name</th>
                <th>Teacher Name</th>
                <th>Class Date</th>
                <th>Duration</th>
                <th>Amount</th>
                <th>Order Status</th>
                <th>Booking Date</th>
            </tr>
        </thead>
        <tbody>
          @php $i=1; @endphp
          @foreach($bookings as $booking)
          @php
          $date = Carbon\Carbon::parse($booking->created_at)->format('d/m/Y h:i A');
          $start = Carbon\Carbon::parse($booking->date)->format('d-m-Y');
          $timezone = TimezoneTime::where('availability_id',$booking->duration_id)->value('timezone');
          $book_count = Availability::where('id',$booking->duration_id)->where('cancelled','yes')->count();
          $teacher_income_status = ClassStatus::where('booking_id',$booking->booking_id)->value('class_status');
          @endphp
            <tr>
                <td>{{$i}}</td>
                 <td>{{$booking->id}}</td>
                <td>{{$booking->reference_id}}</td>
                <td>{{$booking->name}}</td>
                <td>{{$timezone}}</td>
                <td>{{$booking->subject_name}} > {{$booking->sub_sub_name}}</td>
                <td>{{$booking->first_name}} {{$booking->last_name}}</td>
                <td>{{$start}}</td>
                <td>{{$booking->title}}</td>
                <td>
                    @if($booking->currency=='dollar')
                    &#x24;
                    @else
                    &#x20B9;
                    @endif
                    {{$booking->amount}}
                    </td>
                <td>
                    @if($book_count<1)
                    @if($teacher_income_status !='cancelled' && $teacher_income_status !='completed')
                    {{$booking->order_status}}
                    @else
                    <span style="color:red;">Class cancelled</span>
                    @endif
                     @else
                    <span style="color:red;">Cancelled by student</span>
                    @endif
                    </td>
                <td>{{$date}}</td>
               
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
