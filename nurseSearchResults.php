<?php
require('include/login_functions.php');
require('../sql_connect.php');
session_start();
  if ($_SESSION['user_type'] != 'a'){
    redirect_user();
  }




 ?>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
     <meta name="description" content="">
     <meta name="author" content="">

     <title>Patient Search Results</title>

     <!-- Bootstrap core CSS -->
     <link href="/dist/css/bootstrap.min.css" rel="stylesheet">


     <!-- Custom styles for this template -->
     <!--<link href="/dist/custom/css/signin.css" rel="stylesheet">-->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
     <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
     <!--[if lt IE 9]>
       <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
     <![endif]-->
   </head>

   <body>
    <?php
 		include('include/navbar.php');
 		?>
    <h1 class="text-center">User Search Results</h1>
 		<div class=container>
      <?php
        include('include/search_functions.php');
        list($ok,$results) = nurseSearch($dbc,$_POST['searchNurseParam']);
        if ($ok){
          echo tabulateNurseResultSet($results);
        }else {
          echo "No results were found please return to your home page";
        }
       ?>


    </div>
   </body>
 </html>
