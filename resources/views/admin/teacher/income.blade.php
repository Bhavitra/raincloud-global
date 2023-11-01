@php
use App\Models\Commission;
use App\Models\CurrencyValue;
use App\Models\Availability;
use App\Models\ClassStatus;
use App\Models\TutorIncomeStatus;
$commission = Commission::value('tutor_commission');
$currency_value = CurrencyValue::value('rupee_value');
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
            <h1 class="m-0">Tutor Income</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tutor Income</li>
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
                <th>Teacher ID</th>
                <th>Teacher Name</th>
                 <th>Income</th>
                 <th>Status</th>
            </tr>
        </thead>
        <tbody>
          @php
          $i=1;
          @endphp
       
       

             @foreach($orders as $order)
             @php

 $check_status = TutorIncomeStatus::where('booking_id',$order->booking_id)->where('tutor_income_status_deleted','no')->value('income_status');
 $book_count = Availability::where('id',$order->duration_id)->where('cancelled','yes')->count();
 $teacher_income_status = ClassStatus::where('booking_id',$order->booking_id)->value('class_status');
             @endphp
             
            <tr>
              <td>{{$i}}</td>
               <td>{{$order->booking_id}}</td>
                <td>{{$order->teacher_id}}</td>
                 <td>{{$order->first_name}} {{$order->last_name}}</td>
               <td>
                 @if($order->currency == 'inr')
                   @php
                  
                   $dollar = $order->amount/$currency_value;
                   $income = $dollar-($dollar*$commission/100);
                    $currency_value = CurrencyValue::value('rupee_value');
                    $value = round($order->teacher_commission/$currency_value,3);
                    echo "$".$value;
                   @endphp
                   @else
                   @php
                   $income = ($order->amount)-($order->amount*$commission/100);
                    echo "$".$order->teacher_commission;
                   @endphp
                 @endif
               </td>
            
               <td>
                   @if($book_count<1)
                   @if($teacher_income_status !='cancelled' && $teacher_income_status !='completed')
                  @if($check_status == 'pending')
                <a href="javascript:void();" class="btn btn-sm btn-success" data-toggle="modal" data-target="#updateModal" onclick="status_update({{$order->booking_id}});">Update</a>
                @elseif($check_status == 'cancelled')
                 <span style="color:red;">Payment Cancelled</span>
                 @else
                 <span style="color:green;">Payment Sent</span>
                @endif
                @else
               <span style="color:red;">Not applicable due to cancellation by teacher</span>
                @endif
                 @else
                  <span style="color:red;">Not applicable due to cancellation by student</span>
                @endif

              </td>
               
            </tr>
            @php $i++;@endphp
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


<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Tutor Income Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="{{route('admin.tutor.income.update')}}" method="post">
        @csrf
  <div class="form-group">
    <label>Status</label>
    <select class="form-control" name="status">
      <option value="">--Select Status--</option>
      <option value="sent">Payment Sent</option>
      <option value="cancelled">Payment Cancelled</option>
    </select>
  </div>

  <input type="hidden" name="booking_id" id="booking">

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
    </div>
  </div>
</div>

@endsection
