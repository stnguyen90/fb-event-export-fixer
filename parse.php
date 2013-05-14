<?php
require_once("./lib/iCalcreator/iCalcreator.class.php");

// retrieve inputs
$tz = 'America/Los_Angeles';
$uid = isset($_GET['uid']) ? $_GET['uid'] : '';
$key = isset($_GET['key']) ? $_GET['key'] : '';
$excludes = isset($_GET['excludes']) ? $_GET['excludes'] : array();
foreach ( $excludes as $exclude )
{
    if ( $exclude == 'ar' )
    {
        $ar = true;
    }
    else if ( $exclude == 'g' )
    {
        $g = true;
    }
    else if ( $exclude == 'm' )
    {
        $m = true;
    }
}

$url = "http://www.facebook.com/ical/u.php?uid=$uid&key=$key";

date_default_timezone_set($tz);

// initialize vcalendar
$config = array(
    'unique_id' => 'g33kdev.com',
    'TZID'      => $tz
);
$v = new vcalendar($config);

// get the ics from FB
$contents = file_get_contents($url);
$contents = preg_replace('/PARTSTAT:(.*)/', 'ATTENDEE;PARTSTAT=$1', $contents);

// import the ics
$v->parse($contents);

$componentsToDelete = array();
while( $vevent = $v->getComponent("vevent") )
{
    // read events, one by one
    $uid = $vevent->getProperty("uid");

    $attendee = $vevent->getProperty('attendee', false, true);
    // check for PARTSTAT=ACCEPTED
    if ( !empty($g) && !empty($attendee['params']) && $attendee['params']['PARTSTAT'] == 'ACCEPTED' )
    {
        // delete event
        $componentsToDelete[] = $uid;
    }
    // check for PARTSTAT=TENTATIVE
    else if ( !empty($m) && !empty($attendee['params']) && $attendee['params']['PARTSTAT'] == 'TENTATIVE' )
    {
        // delete event
        $componentsToDelete[] = $uid;
    }
    // check for PARTSTAT=NEEDS-ACTION
    else if ( !empty($ar) && empty($attendee['params']) || $attendee['params']['PARTSTAT'] == 'NEEDS-ACTION' )
    {
        // delete event
        $componentsToDelete[] = $uid;
    }
    // else
    // {
    //     echo $vevent->getProperty('summary') . " ($uid) has PARTSTAT: {$attendee['params']['PARTSTAT']}\n"; 
    // }
}

// remove events with PARTSTAT=NEEDS-ACTION
foreach ($componentsToDelete as $uid)
{
    $v->deleteComponent($uid);
}

// output the calendar
$v->returnCalendar();