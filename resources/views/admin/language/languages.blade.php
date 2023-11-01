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
            <h1 class="m-0">Languages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Languages</li>
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
          <a href="#addLanguageModal" style="float:right;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addLanguageModal">+Add</a>
         <table id="tutor_details" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            
                <th>SL No</th>
                 <th>Language</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
       
            @php $i=1; @endphp
       
              @foreach($languages as $language)
            <tr>
              <td>{{$i}}</td>
                <td>{{$language->language_name}}</td>
                 <td><a href="#languageDeleteModal" data-toggle="modal" data-target="#languageDeleteModal" data-backdrop="static" data-keyboard="false" onclick="language_delete({{$language->id}});"><i class="fa fa-trash" style="color:red;"></i></a></td>
               
               
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

<div class="modal fade" id="languageDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
        <form action="{{route('admin.language.delete')}}" method="post">
          @csrf
  <div class="form-group">
    <label>Do you want to Delete?</label>
   <input type="hidden" id="language" name="language">
  </div>
  <button type="submit" class="btn btn-primary">Yes</button>
 <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
</form>
      </div>
      
    </div>
  </div>
</div>



<div class="modal fade" id="addLanguageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Language</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.language.add')}}" method="post">
          @csrf
    <div class="form-group">
    <label for="subject">Language Name</label><br>
   <input type="text" name="language" class="form-control" required>
   <span style="color:red;">{{$errors->first('language')}}</span>
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
