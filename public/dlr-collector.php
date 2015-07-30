<?php
/**
 * Script to collect DLR from infobip
 * Url for this script should be set at https://customer.infobip.com/MyAccount/Profile.aspx
 */

//read raw POST data
$postData = file_get_contents("php://input");

//extract xml structure from it using PHP's DoMDocument object model parser
$dom = new DOMDocument();
$dom->loadXML($postData);

//create new xpath object for quering XML element nodes
$xPath = new DOMXPath($dom);

//query "message" element
$reports = $xPath->query("/DeliveryReport/message");

//write out attributes of each message element
foreach ($reports as $node) {

    echo $node->getAttribute('id');
    $node->getAttribute('sentdate');
    $node->getAttribute('donedate');
    $node->getAttribute('status');
    $node->getAttribute('gsmerrorcode');

}