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
            <h1 class="m-0">Countries</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Countries</li>
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
          <a href="#addCountryModal" style="float:right;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addCountryModal">+Add</a>
         <table id="tutor_details" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            
                <th>SL No</th>
                 <th>Country</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
       
            @php $i=1; @endphp
       
              @foreach($countries as $country)
            <tr>
              <td>{{$i}}</td>
                <td>{{$country->country_name}}</td>
                 <td><a href="#countryDeleteModal" data-toggle="modal" data-target="#countryDeleteModal" data-backdrop="static" data-keyboard="false" onclick="country_delete({{$country->id}});"><i class="fa fa-trash" style="color:red;"></i></a></td>
               
               
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

<div class="modal fade" id="countryDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
        <form action="{{route('admin.country.delete')}}" method="post">
          @csrf
  <div class="form-group">
    <label>Do you want to Delete?</label>
   <input type="hidden" id="country" name="country">
  </div>
  <button type="submit" class="btn btn-primary">Yes</button>
 <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
</form>
      </div>
      
    </div>
  </div>
</div>



<div class="modal fade" id="addCountryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Country</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.country.add')}}" method="post">
          @csrf
    <div class="form-group">
    <label for="subject">Country Name</label><br>
   <input type="text" name="country" class="form-control" required>
   <span style="color:red;">{{$errors->first('country')}}</span>
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
