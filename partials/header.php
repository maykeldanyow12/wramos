<nav class="navbar fixed-top  shadow-sm bg-white navbar-expand-lg">
    <div class="container-fluid px-5">
        <a class="navbar-brand" href="#">
            <img src="<?= $host ?>/images/logo-inline.jpg" width="90px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" style="flex-grow: 0 !important;" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="gap: 1rem;">
                <li class="nav-item">
                    <a class="nav-link py-2 text-danger" href="#home">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-2 text-danger" href="#services">
                        Services
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-2 text-danger" href="#contactus">
                        Contact Us
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link py-2 text-danger" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Log In
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown ">
                        <a class="dropdown-item" href="./user/login.php">USER</a>
                        <a class="dropdown-item" href="./admin/">ADMIN</a>
                        <a class="dropdown-item" href="./cashier/">CASHIER</a>
                    </div>
                </li>
                </li>
            </ul>
        </div>
    </div>
    <script> 
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></scrip>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </script>
</nav>

