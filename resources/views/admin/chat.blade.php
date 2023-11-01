@php
use App\Models\Teacher;
use App\Models\User;
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
            <h1 class="m-0">Chat History</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Chat History</li>
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
                <th>Sender ID</th>
                <th>Sender Name</th>
                <th>Recepient ID</th>
                <th>Recepient Name</th>
                <th>Chat</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
          @php $i=1; @endphp
          @foreach($chats as $chat)
          @php
          $sender_name_teacher_count = Teacher::where('id',$chat->sender_id)->count();
           $sender_name_user_count = User::where('id',$chat->sender_id)->count();
           $name='';
           if($sender_name_teacher_count>0){
           $sender_name = Teacher::where('id',$chat->sender_id)->first();
           $name = $sender_name->first_name." ".$sender_name->last_name;
           }else{
            $sender_name = User::where('id',$chat->sender_id)->first();
           $name = $sender_name->name;
           }
           
           $recepient_name_teacher_count = Teacher::where('id',$chat->recepient_id)->count();
           $recepient_name_user_count = User::where('id',$chat->recepient_id)->count();
           $name2='';
           if($recepient_name_teacher_count>0){
           $recepient_name = Teacher::where('id',$chat->recepient_id)->first();
           $name2 = $recepient_name->first_name." ".$recepient_name->last_name;
           }else{
            $recepient_name = User::where('id',$chat->recepient_id)->first();
            $name2 = $recepient_name->name;
           }
           
          $date = Carbon\Carbon::parse($chat->created_at)->format('d/m/Y h:i A');
          @endphp
            <tr>
                <td>{{$i}}</td>
                 <td>{{$chat->booking_id}}</td>
                <td>{{$chat->sender_id}}</td>
                <td>{{$name}}</td>
                <td>{{$chat->recepient_id}}</td>
                <td>{{$name2}}</td>
                <td>{{$chat->chat}}</td>
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
