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
            <h1 class="m-0">Subjects</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Subjects</li>
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
          <a href="#addSubjectModal" style="float:right;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addSubjectModal">+Add</a>
         <table id="tutor_details" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            
                <th>SL No</th>
                 <th>Subject Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
       
            @php $i=1; @endphp
       
              @foreach($subjects as $subject)
            <tr>
              <td>{{$i}}</td>
                <td>{{$subject->subject_name}}</td>
                 <td><a href="#subjectDeleteModal" data-toggle="modal" data-target="#subjectDeleteModal" data-backdrop="static" data-keyboard="false" onclick="subject_delete({{$subject->id}});"><i class="fa fa-trash" style="color:red;"></i></a></td>
               
               
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

<div class="modal fade" id="subjectDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
        <form action="{{route('admin.subject.delete')}}" method="post">
          @csrf
  <div class="form-group">
    <label>Do you want to Delete?</label>
   <input type="hidden" id="subject" name="subject_id">
  </div>
  <button type="submit" class="btn btn-primary">Yes</button>
 <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
</form>
      </div>
      
    </div>
  </div>
</div>



<div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.subject.add')}}" method="post">
          @csrf
    <div class="form-group">
    <label for="subject">Subject Name</label><br>
   <input type="text" name="subject" id="subject" class="form-control" required>
   <span style="color:red;">{{$errors->first('subject')}}</span>
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
