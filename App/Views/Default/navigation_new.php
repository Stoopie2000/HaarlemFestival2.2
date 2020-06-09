<div class="container-fluid pr-0">
  <div class="row justify-content-md-center">
    <div class="col-md-auto logo-container">
      <div class="twist">
        <a class="navbar-brand p-3" href="#">
          <img class="untwist" src="<?php use App\Config; echo Config::URLROOT; ?>/img/jazz/haarlem-logo-png-transparent.png" alt="Logo Haarlem" width="180" height="150">
        </a>
      </div>
    </div>
    <div class="col ml-n3 pl-4">
      <div class="row twist">
        <div class="col-12">
          <div class="row top-nav-container">
            <div class="col-12">
              <nav id="top_nav" class="navbar navbar-expand-lg navbar-light p-0 pr-4">
                <ul class="navbar-nav ml-auto">
                    <?php if(isset($_SESSION["user_id"])){ ?>
                      <li class="nav-item"><a class="nav-link p-2" href=""><span>Account</span></a></li>
                      <li class="nav-item"><a class="nav-link p-2" href="/login/new"><span>Logout</span></a></li>
                    <?php }else{ ?>
                      <li class="nav-item"><a class="nav-link p-2" href="/login/new"><span>Login</span></a></li>
                    <?php }?>
                  <li class="nav-item"><a class="nav-link p-2" href="/order/basket"><span>Basket</span></a></li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="row bot-nav-container mr-n5">
            <div class="col-12 pl-0">
              <nav id="new_nav" class="navbar navbar-expand-lg p-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item homeButton ">
                      <a class="nav-link p-4" href="/"><span>Home</span></a>
                    </li>
                    <li class="nav-item jazzButton">
                      <a class="nav-link p-4" href="/jazz"><span>Jazz</span></a>
                    </li>
                    <li class="nav-item danceButton ">
                      <a class="nav-link p-4" href="/dance"><span>Dance</span></a>
                    </li>
                    <li class="nav-item foodButton ">
                      <a class="nav-link p-4" href="/food"><span>Food</span></a>
                    </li>
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
