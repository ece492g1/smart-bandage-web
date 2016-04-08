<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="logout.php" class="btn btn-default navbar-btn">Logout</a>
      <?php
      session_start();
        if ($_SESSION['user_type'] == 'n'){
          echo  "<a href='nursehome.php' class='btn btn-default navbar-btn'>My Home</a>";
        }
        if ($_SESSION['user_type'] == 'a'){
          echo  "<a href='adminhome.php' class='btn btn-default navbar-btn'>My Home</a>";
        }
       ?>
    </div>
  </div>
</nav>
