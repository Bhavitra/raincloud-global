 @php $url = Request::segment(2); @endphp
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{url('/')}}/backend/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Tutor</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('/')}}/backend/image.webp" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
     
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <!--
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li>
        -->
              <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link {{$url == 'dashboard' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{route('admin.banner.slider')}}" class="nav-link {{$url == 'slider' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Banner Slider
               
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="{{route('admin.about')}}" class="nav-link {{$url == 'about' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                What We're About 
               
              </p>
            </a>
          </li>

             <li class="nav-item {{$url=='tutors' || $url=='tutor-income' || $url=='tutor-class-history' ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{$url=='tutors' || $url=='tutor-income' || $url=='tutor-class-history' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tutors
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.tutor.details')}}" class="nav-link {{$url=='tutors' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.tutor.income')}}" class="nav-link {{$url=='tutor-income' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Income</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{route('admin.tutor.class-history')}}" class="nav-link {{$url=='tutor-class-history' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class History</p>
                </a>
              </li>
           
            </ul>
          </li>

           <li class="nav-item {{$url=='students' || $url=='student-details' || $url == 'tutor-bookings' || $url=='student-tutor-bookings' || $url=='student-class-history'? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{$url=='students' || $url=='student-details' || $url=='student-tutor-bookings' || $url=='student-class-history' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Students
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.student.details')}}" class="nav-link {{$url=='student-details' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.student.tutor-bookings')}}" class="nav-link {{$url=='student-tutor-bookings' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tutor Bookings</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{route('admin.student.class-history')}}" class="nav-link {{$url=='student-class-history' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class History</p>
                </a>
              </li>
           
            </ul>
          </li>

           <li class="nav-item {{$url=='subjects' || $url=='sub-subjects' ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{$url=='subjects' || $url=='sub-subjects' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Subjects
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.subjects')}}" class="nav-link {{$url=='subjects' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Details</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{route('admin.sub.subjects')}}" class="nav-link {{$url=='sub-subjects' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Subjects</p>
                </a>
              </li>
            
            
           
            </ul>
          </li>

           <li class="nav-item">
            <a href="{{route('admin.level')}}" class="nav-link {{$url == 'levels' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Levels
          
              </p>
            </a>
         
          </li>

            <li class="nav-item">
            <a href="{{route('admin.languages')}}" class="nav-link {{$url == 'languages' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Languages
          
              </p>
            </a>
         
          </li>

            <li class="nav-item">
            <a href="{{route('admin.countries')}}" class="nav-link {{$url == 'countries' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Countries
          
              </p>
            </a>
         
          </li>

             <li class="nav-item">
            <a href="{{route('admin.commission')}}" class="nav-link {{$url == 'commission' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Commission
          
              </p>
            </a>
         
          </li>

            <li class="nav-item">
            <a href="{{route('admin.booking-history')}}" class="nav-link {{$url == 'booking-history' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Booking history
          
              </p>
            </a>
         
          </li>

            <li class="nav-item">
            <a href="{{route('admin.chat')}}" class="nav-link {{$url == 'chat-history' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Chat History
          
              </p>
            </a>
         
          </li>

            <li class="nav-item">
            <a href="{{route('admin.admin-income')}}" class="nav-link {{$url == 'admin-income' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Admin Income
          
              </p>
            </a>
         
          </li>

           <li class="nav-item">
            <a href="{{route('admin.currency.conversion')}}" class="nav-link {{$url == 'currency-conversion' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Currency Conversion
          
              </p>
            </a>
         
          </li>



           <li class="nav-item">
            <a href="{{route('admin.reviews')}}" class="nav-link {{$url == 'reviews' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Reviews
          
              </p>
            </a>
         
          </li>



             <li class="nav-item">
            <a href="{{route('admin.webinfo')}}" class="nav-link {{$url == 'webinfo' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Webinfo
          
              </p>
            </a>
         
          </li>


             <li class="nav-item">
            <a href="{{route('admin.seo')}}" class="nav-link {{$url == 'seo' ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Seo
          
              </p>
            </a>
         
          </li>

        

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>