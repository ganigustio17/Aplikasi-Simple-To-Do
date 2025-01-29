 <!-- 00. Navbar -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid col-md-7">
        <div class="navbar-brand" onclick="window.location.href='{{route('todo')}}'" style="cursor:pointer;">Simple To Do List</div>
        
        <div class="navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('user.update-data')}}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
 
    </div>
</nav>