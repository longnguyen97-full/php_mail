<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PHP MVC Training</title>

  <!-- Bootstrap core CSS -->
  <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="./assets/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="./assets/css/landing-page.min.css" rel="stylesheet">
  <!-- Favicon-->
  <link rel="shortcut icon" href="./assets/img/favicon.png?3">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?='?controller=home' ?>">Start Bootstrap</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="?controller=home">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?controller=mail&action=index">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?controller=admin" tabindex="-1" aria-disabled="true">Visit Admin</a>
        </li>

        <?php 
        if ( isset($_SESSION['user_account']) && isset($_SESSION['user_cache']) ) {
          foreach ($_SESSION['user_cache'] as $item) {
            ?>
            <li class="nav-item dropdown float-right">
              <a class="nav-link dropdown-toggle" href="'?controller=home&action=login'" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?=$item['username'] ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="?controller=home&action=edit&params[0]=users&params[1]=<?=$item['id'] ?>">Edit Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="?controller=home&action=handleLogout">Log out</a>
              </div>
            </li>
            <?php
          }
        ?>
        <?php
        } else {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="<?='?controller=home&action=login' ?>" tabindex="-1" aria-disabled="true">Sign in</a>
        </li>
        <?php
        }
        ?>
      </ul>
    </div>
  </nav>