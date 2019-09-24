<!-- navbar -->
<nav class="navbar navbar-expand-lg mx-auto fixed-top">
    <a class="navbar-brand" href="{{ route('home') }}">PORTAL</a>
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-align-right navbar-toggler-icon"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Departments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.index') }}">Pharmacy</a>
            </li>
            <li>
                <a class="nav-link" href="#contact">Contact</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('auth.login') }}">LOGIN</a>
            </li>

            <li class="nav-item">
                <a class="nav-link"  href="{{ route('patient.register') }}">REGISTRATION</a>
            </li>
        </ul>
    </div>
</nav>
