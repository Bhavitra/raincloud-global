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
            <h1 class="m-0">Review Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Review Details</li>
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
                <th>Teacher ID</th>
                <th>Teacher Name</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
          @php $i=1; @endphp
          @foreach($reviews as $review)
          @php $date_format = Carbon\Carbon::parse($review->date)->format('d/m/Y A'); @endphp
            <tr>
                <td>{{$i}}</td>
                 <td>{{$review->booking_id}}</td>
                <td>{{$review->student_id}}</td>
                <td>{{$review->name}}</td>
                <td>{{$review->teacher_id}}</td>
                <td>{{$review->first_name}} {{$review->last_name}}</td>
                <td>{{$review->rating}}</td>
                <td>{{$review->review}}</td>
                <td>{{$date_format}}</td>
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
