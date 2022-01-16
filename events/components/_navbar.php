<?php
      if (isset($_SESSION['user'])) {
          echo '
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">EVENTRADAR</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Former Events</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Events</a></li>
            <li><a class="dropdown-item" href="#">Teams </a></li>
            <li><a class="dropdown-item" href="#">Locations</a></li>
            <li><a class="dropdown-item" href="#">Categories</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex">
        
        <a href=""><button class="btn btn-outline-success" type="submit">Log out</button></a>
      </form>
    </div>
  </div>
</nav>
</header>
 <div class="manageEvent mx-auto w-75 mt-3">
     <div class="mb-3">
         <a href="create.php">
             <button class="btn btn-primary" type="button">New Event</button>
        </a>
     </div>
     
    ';

    }

    else {

        echo '

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">EVENTRADAR</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Former Events</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">About</a>
        </li>
        
      </ul>
      <ul class="d-flex navbar-nav mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="#">Log in</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">Register</a></li>
      </ul>
    </div>
  </div>
</nav>
           ';

    } 
    

    ?>
    