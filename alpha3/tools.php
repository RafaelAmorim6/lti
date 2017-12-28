<?php print_r($_REQUEST); ?>

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

//For speccific canvas score
$_SESSION['custom_canvas_assignment_points_possible'] = $_REQUEST['custom_canvas_assignment_points_possible'];

if (get_magic_quotes_gpc()) $sourcedid = stripslashes($sourcedid);
$sourcedid = urlencode($sourcedid);

?>

<?php

$contents = '{ "@context" : "http://purl.imsglobal.org/ctx/lti/v1/ContentItem",
"@graph" : [  
{
"@type": "LtiLinkItem",
"@id": "https://learning.appraisalinstitute.org/alpha2/tools.php",
"url": "https://learning.appraisalinstitute.org/alpha2/tools.php",
"title": "test",
"text": "text",
"mediaType": "application/vnd.ims.lti.v1.ltilink",
"placementAdvice": {
"displayWidth" : 800,
"presentationDocumentTarget" : "iframe",
"displayHeight" : 800
}
}
]
}';
?>
        
			

<form method="post" action="<?php echo $_REQUEST['content_item_return_url'];?>" id="assignment_selection">
 <input type="hidden" name="data" value="<?php echo $_REQUEST['data'];?>"/>
 <input type="hidden" name="lti_message_type" value="ContentItemSelection"/>
 <input type="hidden" name="custom_variable" value="Vivek Aswal"/>
 <input type="hidden" name="lti_version" value="LTI-1p0"/>
 <input type="hidden" name="content_items" value='<?php echo $contents ;?>'/>
 <input type="submit" name="sum" value="submit"/>
 
</form>