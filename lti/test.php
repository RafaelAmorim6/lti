<?php

$headers = 'POST /mod/lti/service.php HTTP/1.0
Host: moodle.wileyglobaled.com
Referer: http://moodle.wileyglobaled.com/mod/lti/service.php
Content-Length: 719
Authorization: OAuth realm="",oauth_version="1.0",oauth_nonce="d28af22bc732ea3ba1ec2d1f8c47f7db",oauth_timestamp="1374582034",oauth_consumer_key="040313439f76baf",oauth_body_hash="3UMCpqeZUyWVfJO2smnmHXEbwaM%3D",oauth_signature_method="HMAC-SHA1",oauth_signature="d0C61Lw39Tmi6aNGjCLOjuw22%2F0%3D"
Content-Type: application/xml

<?xml version = "1.0" encoding = "UTF-8"?>
<imsx_POXEnvelopeRequest xmlns = "http://www.imsglobal.org/services/ltiv1p1/xsd/imsoms_v1p0">
  <imsx_POXHeader>
    <imsx_POXRequestHeaderInfo>
      <imsx_version>V1.0</imsx_version>
      <imsx_messageIdentifier>51ee751219c51</imsx_messageIdentifier>
    </imsx_POXRequestHeaderInfo>
  </imsx_POXHeader>
  <imsx_POXBody>
    <readResultRequest>
      <resultRecord>
        <sourcedGUID>
          <sourcedId>{"data":{"instanceid":"15","userid":"4","launchid":1685664265},"hash":"e9431abfd2ada9a5416c47a889b0df5e092a8e9004630a53a585f0fc4a2da639"}</sourcedId>
        </sourcedGUID>
      </resultRecord>
    </readResultRequest>
  </imsx_POXBody>
</imsx_POXEnvelopeRequest>';
$fp = fsockopen("moodle.wileyglobaled.com", 80, $errno, $errstr, 1000);
      if($fp) {
        fputs($fp, $headers);
        var_dump($fp);
        $result = '';
        while(!feof($fp)) { $result .= fgets($fp, 1024); }
        fclose($fp);
        //removes headers
        $pattern="/^.*\r\n\r\n/s";
        $result=preg_replace($pattern,'',$result);
      }
      print_r($result);