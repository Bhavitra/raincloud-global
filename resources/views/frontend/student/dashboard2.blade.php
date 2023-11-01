@extends('frontend.layouts.header')
@section('content')


 <main>
        <!-- settings section -->
        <section class="settings-section py-5">
            <div class="container px-md-5">
                <div class="row px-md-5">
                    <div class="col-12 col-md-3 mb-3 mb-md-0">
                        <div>
                            <div class="list-group">
                                <a class="nav-link" id="v-pills-account-tab" data-toggle="pill"href="#account" data-bs-toggle="tab" class="list-group-item list-group-item-action p-2 border-0 bg-transparent text-dark active" aria-current="true">
                                  Account
                                </a>
                                <a href="#password" data-bs-toggle="tab" class="list-group-item list-group-item-action p-2 border-0 bg-transparent text-dark">Password</a>
                                <a href="#payment-history" data-bs-toggle="tab" class="list-group-item list-group-item-action p-2 border-0 bg-transparent text-dark">Booking history</a>
                                <a href="javscript:void();" class="list-group-item list-group-item-action p-2 border-0 bg-transparent text-dark" onclick="logout();">Logout</a>
                              </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-9 bg-white">
                        <div>
                            <div class="tab-content p-3">

                                <div class="tab-pane fade show active" id="v-pills-account-tab">
                                    <h4>Account Settings</h4>
                                    <hr>
                                    <form action="{{route('student.profile.update')}}" class="form" method="post" enctype="multipart/form-data">
                                    	@csrf
                                        <div class="mb-3 row justify-content-between">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Profile image</label>
                                            <div class="col-sm-8">
                                              <div class="d-flex">
                                                <img class="mr-2 rounded" src="{{url('/')}}/frontend/images/{{Auth::user()->image}}" alt="" width="100" height="100">
                                                <input type="file" name="image" id="upload" class="">
                                              </div>
                                            </div>
                                          </div>
                                        <div class="mb-3 row justify-content-between">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-8">
                                              <input type="text" class="form-control" name="name" id="staticEmail" value="{{Auth::user()->name}}">
                                            </div>
                                          </div>
                                        <div class="mb-3 row justify-content-between">
                                            <label for="staticEmail" class="col-sm-2 col-form-label text-nowrap">Phone number</label>
                                            <div class="col-sm-8">
                                              <input type="text" name="phone" class="form-control" id="staticEmail" value="{{Auth::user()->phone}}">
                                            </div>
                                          </div>
                                          <div class="row justify-content-center">
                                            <button class="btn btn-info mr-3" type="submit">Save settings</button>
                                            <button class="btn btn-danger" type="button" onclick="delete_account();">Delete account</button>
                                          </div>
                                    </form>
                                </div>
                              
                                <div class="tab-pane fade show" id="password">
                                    <h4>Create Password</h4>
                                    <hr>
                                    <form>
                                        <div class="my-5 row justify-content-between">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">New password</label>
                                            <div class="col-sm-8">
                                              <input type="email" class="form-control" id="staticEmail">
                                            </div>
                                          </div>
                                        <div class="my-5 row justify-content-between">
                                            <label for="staticEmail" class="col-sm-2 col-form-label">Verify password</label>
                                            <div class="col-sm-8">
                                              <input type="email" class="form-control" id="staticEmail">
                                            </div>
                                          </div>
                                          <div class="row justify-content-center">
                                            <button class="btn btn-info mr-3" type="submit">Save settings</button>
                                          </div>
                                    </form>
                                </div>
                            
                                <div class="tab-pane fade" id="payment-history">
                                    <h4>Booking history</h4>
                                    <table class="table table-striped mt-3">
                                        <thead>
                                            <tr>
                                                <th>DATE</th>
                                                <th>HOURS</th>
                                                <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>23 Feb 2023</td>
                                                <td>12:00 PM</td>
                                                <td>Test</td>
                                            </tr>
                                            <tr>
                                                <td>23 Feb 2023</td>
                                                <td>12:00 PM</td>
                                                <td>Test</td>
                                            </tr>
                                            <tr>
                                                <td>23 Feb 2023</td>
                                                <td>12:00 PM</td>
                                                <td>Test</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                              
                       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- settings section end -->
    </main>



@endsection