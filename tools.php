<?php print_r($_REQUEST);?>

<?php
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
session_start();
// Load up the Basic LTI Support code
require_once 'lti/lti_util.php';
error_reporting(1);
$context = new BLTI("Consumer123", false, false);

$sourcedid = $_REQUEST['lis_result_sourcedid'];

$_SESSION['lis_result_sourcedid'] =  $sourcedid;
$_SESSION['lis_outcome_service_url'] = $_REQUEST['lis_outcome_service_url'];

if (get_magic_quotes_gpc()) $sourcedid = stripslashes($sourcedid);
$sourcedid = urlencode($sourcedid);

if ( $context->valid ) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Sample 1</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <style>
    body {
      font: 20px Montserrat, sans-serif;
      line-height: 1.8;
      /*color: #f5f6f7;*/
    }

    h1 {
      text-align: center;
    }

    #title {
      text-decoration: underline;
    }

    #quiz {
      text-indent: 10px;
      display: none;
    }

    .button {
      /*border: 4px solid;*/
      border-radius: 5px;
      width: 65px;
      padding-left: 5px;
      padding-right: 5px;
      position: relative;
      float: right;
      background-color: #DCDCDC;
      color: black;
      margin: 0 2px 0 2px;
    }

    .button.active {
      background-color: #F8F8FF;
      color: #525252;
    }

    button {
      position: relative;
      float: right;
    }

    .button a {
      text-decoration: none;
      color: black;
    }

    #container {
      width: 50%;
      margin: auto;
      padding: 0 25px 40px 10px;
      /*background-color: #1E90FF;*/
      border: 4px solid #B0E0E6;
      border-radius: 5px;
      /*color: #FFFFFF;*/
      font-weight: bold;
      box-shadow: 5px 5px 5px #888;
    }

    ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    #prev {
      display: none;
    }

    #start {
      display: none;
      width: 90px;
    }
  </style>
</head>

<body>


  <div id='container'>
    <div id='title'>
      <h1>Learning : Project #1 - Quiz</h1>
    </div>
    <br/>
    <div id='quiz'></div>
    <div class='button' id='next'>
      <a href='#'>Next</a>
    </div>
    <div class='button' id='prev'>
      <a href='#'>Prev</a>
    </div>
    <div class='button' id='start'>
      <a href='#'>Start Over</a>
    </div>
  </div>

  <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
  <script type='text/javascript' src='jsquiz.js'></script>

  <!-- Footer -->
  <footer class="container-fluid bg-4 text-center">
    <p> Made By
      <a href="">LearningMate</a>
    </p>
  </footer>

</body>

</html>
<?php
}
else {
    print "<p style=\"color:red\">Could not establish context: ".$context->message."<p>\n";
}
?>
