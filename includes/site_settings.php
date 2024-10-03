<?php

//--------------------------------------------

function removeBadChars($strWords)
{
    $bad_string = array("select", "drop", "insert", "delete", "xp_", "%20union%20", "/*", "*/union/*", "+union+", "load_file", "outfile", "document.cookie", "onmouse", "<script", "<iframe", "<applet", "<meta", "<style", "<form", "<img", "<body", "<link", "_GLOBALS", "_REQUEST", "_GET", "_POST", "include_path", "prefix", "ftp://", "smb://", "<table", "<?php", "<?", ";", "'", "=");
    for ($i = 0; $i < count($bad_string); $i++) {
        $strWords = str_replace($bad_string[$i], "", $strWords);
    }
    return $strWords;
}

function removePtag($strWords)
{

    $relstr = array('<p class="MsoNormal" style="text-align:justify">', '<p>', '</p>', '<p class="MsoNormal" style="text-align: justify;">', '<o:p></o:p>', '<span', '</span>', '<br>', '<br />', '<font style="color: rgb(0, 0, 0);"><font style="font-size: 12px;">', '</font> </font>');
    $plcstr = array(' ', ' ', '', ' ', ' ', '<font', '</font>', '', '', '', '');
    $msgbody = str_replace($relstr, $plcstr, $strWords);
    return $msgbody;
}

function output_Pfields($feilds)
{
    return removePtag(stripslashes($feilds));
}

function output_fields($feilds)
{
    return trim(strip_tags(removeBadChars(stripslashes($feilds))));
}

function input_fields($feilds)
{
    return trim(strip_tags(removeBadChars(addslashes($feilds))));
}

function getCoursePlan($course, $plan)
{
    $valPlan = '';
    if ($course == 'Core Defend (Standard Course): 4 Weeks (8 sessions)' && $plan == 2500)
        $valPlan = 'Single Payment(₹2,500)';

    if ($course == 'Core Defend (Standard Course): 4 Weeks (8 sessions)' && $plan == 350)
        $valPlan = 'Pay Per Session(₹350)';

    if ($course == 'Core Defend (Standard Course): 4 Weeks (8 sessions)' && $plan == 6000)
        $valPlan = 'Discounted Group of 3(₹6,000)';
    if ($course == 'Total Defend (Extended Course): 8 Weeks (16 sessions)' && $plan == 4500)
        $valPlan = 'Single Payment(₹4,500)';

    if ($course == 'Total Defend (Extended Course): 8 Weeks (16 sessions)' && $plan == 350)
        $valPlan = 'Pay Per Session(₹350)';

    if ($course == 'Total Defend (Extended Course): 8 Weeks (16 sessions)' && $plan == 11000)
        $valPlan = 'Discounted Group of 3(₹11,000)';

    if ($course == 'Trial Class (1 Session)' && $plan == 350)
        $valPlan = 'Single Session Payment(₹350)';

    return $valPlan;
}

function PageNumber($pg)
{
    if ($pg == 1) {
        $retPage = 0;
    } else {
        $retPage = $pg * 20 - 20;
    }
    return $retPage;
}


function strip_tags_content($text)
{

    return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
}

function limitDescription($description, $limit = 100)
{
    if (strlen($description) > $limit) {
        $trimmed = substr($description, 0, $limit);
        $lastSpace = strrpos($trimmed, ' ');

        if ($lastSpace !== false) {
            return substr($trimmed, 0, $lastSpace) . '...';
        } else {
            return $trimmed . '...';
        }
    } else {
        return $description;
    }
}
function limit2Description($description, $limit = 100)
{
    if (strlen($description) > $limit) {
        $trimmed = substr($description, 0, $limit);
        $lastSpace = strrpos($trimmed, ' ');

        if ($lastSpace !== false) {
            return substr($trimmed, 0, $lastSpace);
        } else {
            return $trimmed;
        }
    } else {
        return $description;
    }
}
