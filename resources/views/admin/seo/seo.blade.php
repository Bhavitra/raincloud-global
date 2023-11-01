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
            <h1 class="m-0">Seo Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Seo Details</li>
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
                <th>Seo Title</th>
                <th>Description</th>
                <th>Keywords</th>
                <th>Canonical Url</th>
                <th>Json</th>
                <th>Page</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          @php $i=1; @endphp
          @foreach($seos as $seo)
            <tr>
                <td>{{$i}}</td>
                 <td>{{$seo->seo_title}}</td>
                <td>{{$seo->seo_description}}</td>
                <td>{{$seo->seo_keywords}}</td>
                <td>{{$seo->canonical_url}}</td>
                <td>{{$seo->seo_json}}</td>
                <td>{{$seo->page}}</td>
                <td><a href="javascript:void();" data-toggle="modal" data-target="#editModal" onclick="edit_seo({{$seo->id}});"><i class="fa fa-edit"></i></a></td>
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



<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Seo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.seo.update')}}" method="post">
          @csrf
  <div class="form-group">
    <label for="seo_title">Seo Title</label>
    <input type="text" name="seo_title" class="form-control" id="seo_title">
  </div>

  <div class="form-group">
    <label for="seo_description">Seo Description</label>
    <textarea class="form-control" name="seo_description"  id="seo_description"></textarea>
  </div>

  <div class="form-group">
    <label for="seo_keywords">Seo Keywords</label>
    <input type="text" name="seo_keywords"  class="form-control" id="seo_keywords">
  </div>

  <div class="form-group">
    <label for="canonical_url">Canonical Url</label>
    <input type="text" name="canonical_url"  class="form-control" id="canonical_url">
  </div>

  <input type="hidden" name="seo_id" id="seo">

  <div class="form-group">
    <label for="seo_json">Seo Json</label>
    <textarea name="seo_json" class="form-control" id="seo_json"></textarea>
  </div>
 

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
      
    </div>
  </div>
</div>


@endsection
