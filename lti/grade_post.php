<?php
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
session_start();
// Load up the Basic LTI Support code
require('lti_util.php');
error_reporting(1);

//$context->info['lis_result_sourcedid'] = '{"data":{"instanceid":"67","userid":"2","launchid":888957919},"hash":"acf68a51d936983562ecb656dc8142c618ffe520a75d4642abc4a1e8cbdd2bc9"}';
//$context->info['lis_outcome_service_url'] = 'http://61.16.177.237/JWSG3/mod/lti/service.php';
//$context = new BLTI("secret", false, false);


if(isset($_REQUEST['score'])){
	//send pass grade to the lms
	$grade = $_REQUEST['score'];
	//if($grade == '5'){
	$grade = $grade/5;
	//}

	echo $grade;
    $response = replaceResultRequest($grade, $_SESSION['lis_result_sourcedid'], $_SESSION['lis_outcome_service_url'], 'Consumer123', 'Secret123');

    echo '<pre>';print_r($response);
    sleep(10);

    if ($response['imsx_codeMajor'] == 'success') {
    	echo '1';
    }
    else{
    	echo '0';
    }
}
?>