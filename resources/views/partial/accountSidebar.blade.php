<div class="card bg-light mb-3">
    <div class="card-header">
        <h4 class="text-uppercase">My Account</h4>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills nav-sidebar flex-column">
            <li class="nav-item">
                <a href="{{ route('myProfile') }}" class="nav-link text-dark">Dashboard</a>
            </li>
            @if(auth()->user()->role == 'patient')
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark">Account Information</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('myOrder') }}" class="nav-link text-dark">My Orders</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark">My Reports</a>
                </li>
            @elseif(auth()->user()->role == 'doctor')
                <li class="nav-item">
                    <a href="#" class="nav-link text-dark">My Patients</a>
                </li>
            @endif
        </ul>
    </div>
</div>
