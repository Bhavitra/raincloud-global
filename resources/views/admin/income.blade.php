@php 
use App\Models\Commission;
use App\Models\CurrencyValue;
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
            <h1 class="m-0">Admin Income</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Income</li>
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
                <th>Income</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
          @php $i=1; @endphp
          @foreach($orders as $order)
          @php 
          $commission = Commission::value('tutor_commission'); 
          $net_value = ($order->amount)*$commission/100;
          //$admin_income = ($order->amount)-$commission;
          $book_count = Availability::where('id',$order->duration_id)->where('cancelled','yes')->count();
          $teacher_income_status = ClassStatus::where('booking_id',$order->booking_id)->value('class_status');
          @endphp
            <tr>
                <td>{{$i}}</td>
                 <td>{{$order->booking_id}}</td>
               <td>
                   $
                   @if($order->currency == 'inr')
                   @php
                    $currency_value = CurrencyValue::value('rupee_value');
                    $value = round($order->admin_commission/$currency_value,3);
                    echo $value;
                    @endphp
                   @else
                    {{$order->admin_commission}}
                   @endif
                   </td>
                   <td>
                       @if($book_count<1)
                        @if($teacher_income_status !='cancelled' && $teacher_income_status !='completed')
                       <span style="color:green;">Approved</span>
                       @else
                       <span style="color:red;">Cancelled</span>
                       @endif
                       @else
                       <span style="color:red;">Not applicable due to cancellation by student</span>
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
