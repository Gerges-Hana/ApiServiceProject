<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar " style="background-color:">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="/">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Companies</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="/companies">
            <i class="bi bi-circle"></i><span>All</span>
          </a>
        </li>

        <li>
          <a href="/companies">

            <a  href="{{ route('addCompany') }}">
                <i class="bi bi-circle"></i> <span>Add Company</span>
              </a>
          </a>
        </li>

        {{-- <li>
          <a href="/companies">
            <i class="bi bi-circle"></i><span>Package1</span>
          </a>
        </li>
        <li>
          <a href="/companies">
            <i class="bi bi-circle"></i><span>Package2</span>
          </a>
        </li>
        <li>
          <a href="/companies">
            <i class="bi bi-circle"></i><span>Package3</span>
          </a>
        </li> --}}
      </ul>
    </li><!-- End Companies Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Orders</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          {{-- <a href="/orders"> --}}
          <a href="{{route('orders-waiting')}}">
            <i class="bi bi-circle"></i><span>On hold</span>
          </a>
        </li>
        <li>
          <a href="/orders-onDelivering">
            <i class="bi bi-circle"></i><span>On delivering</span>
          </a>
        </li>
       
        <li>
          <a href="/orders-delivered">
            <i class="bi bi-circle"></i><span>Delivered</span>
          </a>
        </li>
        <li>
          <a href="/orders-canceled">
            <i class="bi bi-circle"></i><span>Canceled</span>
          </a>
          <li>
          <a href="/orders-returned">
            <i class="bi bi-circle"></i><span>returned</span>
          </a>
        </li>
        </li>
      </ul>
    </li><!-- End Orders Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Dlivery Staff</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="/delivery-staff">
            <i class="bi bi-circle"></i><span>All Delivery</span>
          </a>
        </li>
        <li>
          <a href="/delivery-free">
            <i class="bi bi-circle"></i><span>Available</span>
          </a>
        </li>
        <li>
          <a href="/delivery-busy">
            <i class="bi bi-circle"></i><span>Not Available</span>
          </a>
        </li>
      </ul>
    </li><!-- End Dlivery Staff Nav -->

    <!--============================-->

    {{-- <li class="nav-heading">Pages</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="users-profile.html">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li> --}}
{{--
    <li class="nav-item btn btn-primary btn-block">
      <a class="nav-link collapsed" href="{{ route('addCompany') }}">
        <span>Add Company</span>
      </a>
    </li><!-- End Profile Page Nav --> --}}

  </ul>

</aside><!-- End Sidebar-->
