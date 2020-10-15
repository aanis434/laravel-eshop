 <!-- List -->
 <ul id="sidebarNav" class="list-unstyled mb-0 sidebar-navbar view-all">
     <li><a class="dropdown-title" href="{{ route('my-account-profile') }}">My Account</a></li>
     <li><a class="dropdown-title" href="{{ route('my-account-orders') }}">My Orders</a></li>
     <li><a class="dropdown-title" href="javascript:void()">My List</a></li>
     <li><a class="dropdown-title" href="javascript:void()">My Wishlist</a></li>
     <li><a class="dropdown-title" href="javascript:void()">My Rating and Reviews</a></li>
     <li><a class="dropdown-title" href="javascript:void()" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a></li>
 </ul>
 <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
     {{ csrf_field() }}
 </form>
 <!-- End List -->