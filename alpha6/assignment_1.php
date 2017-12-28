<?php //print_r($_REQUEST);?>

<?php
header('P3P:CP="CAO IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
session_start();
// Load up the Basic LTI Support code
require_once 'lti/lti_util.php';
error_reporting(1);
$context = new BLTI("Consumer123", false, false);

$sourcedid = $_REQUEST['lis_result_sourcedid'];

$_SESSION['lis_result_sourcedid'] =  $sourcedid;
$_SESSION['lis_outcome_service_url'] = $_REQUEST['lis_outcome_service_url'];

//For speccific canvas score
$_SESSION['custom_canvas_assignment_points_possible'] = $_REQUEST['custom_canvas_assignment_points_possible'];
//print_r($_SESSION);
if (get_magic_quotes_gpc()) $sourcedid = stripslashes($sourcedid);
$sourcedid = urlencode($sourcedid);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Assessment Player</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link href="css/assignmentPlayer.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="overflow: hidden;">
<header class="main-header-block">
		
  <section class="header-top">
    <div class="col-sm-12"  id='title'>
      <h1 class="title">Learning : Project #1 - Quiz</h1>
    </div>
    <div class="clearfix"></div>
  </section>
  <section class="header-action">
    <div class="col-sm-12 primary">
      <div class="btn-group nxt-prev" role="group" aria-label="Navigation">
        <button class="btn btn-default btn-arrow-left" id='prev'><i class="fa fa-arrow-circle-left fa-fw"></i> Previous Question</button>
        <button class="btn btn-default btn-arrow-right" id='next'> Next Question<i class="fa fa-arrow-circle-right fa-fw"></i></button>
        <button class="btn btn-default btn-sm" id='start' style="display:none" ><span class="glyphicon glyphicon-refresh"></span> Start Over </button>
     
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
  </section>
  
  <div class="clearfix"></div>
</header>
<div class="main-body-block">
    <section class="container" id='container'>
            <section class="contentArea" id='quiz'>
              
              </section>
              
              <!--<div id='quiz'></div>-->
     </section>     
</div>





<footer class="main-footer-block text-center">
	Created By <a href="">LearningMate</a>
	<div class="clearfix"/></div>
</footer>
<script>
  var lis_result_sourcedid="<?php echo $_REQUEST['lis_result_sourcedid'];?>";
  var lis_outcome_service_url="<?php echo $_REQUEST['lis_outcome_service_url'];?>";
  var custom_canvas_assignment_points_possible="<?php echo $_REQUEST['custom_canvas_assignment_points_possible'];?>";
  </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> 
<script>
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
</script>

<!--<script src="js/main.js" type="text/javascript"></script>-->
<script type="text/javascript" src="js/jsquiz.js"></script>

</body>
</html>
