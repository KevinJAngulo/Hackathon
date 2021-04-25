<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <img src="images/logo.png" class="img-fluid header-logo" alt="logo">
    <h4 class="text-red ml-auto mt-4">Welcome, <?php echo $_SESSION['firstname']. " " . $_SESSION['lastname'];?></h4>
    

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item active">
            <a class="nav-link" href="#" id="menu-toggle">My Majors <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="main.php">Explore <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
        </ul>
    </div>
</nav>