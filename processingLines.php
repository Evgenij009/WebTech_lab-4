<?php
function handlingString($str)
{
    $resultStr = "";
    preg_match_all('/[А-ЯЁA-Z]{1}[^.!?]*[.!?]/u', $str, $arrayMatches, PREG_PATTERN_ORDER);
    $arrayLines = $arrayMatches[0];

    for ($i = 0; $i < count($arrayLines); ++$i) {
        $arrayLines[$i] = trimSpace($arrayLines[$i]);
    }

    foreach ($arrayLines as $line) {
        echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
        workAbbreviation($line);
        for ($i = 0; $i < strlen($line); ++$i) {
            if (is_numeric($line[$i])) {
                echo "<span style=\"color: blue\">$line[$i]</span>";
            } else {
                echo $line[$i];
            }
        }
        echo "<br>";
    }
}

function workAbbreviation(&$line)
{
    $arrayMatches = array();
    preg_match_all('/(\s[А-ЯЁA-Z]+\s)/u', $line, $arrayMatches, PREG_PATTERN_ORDER);
    $arrayMatches = $arrayMatches[0];
    // print_r($arrayMatches);

    foreach ($arrayMatches as $value) {
        $temp = trim($value, " ");
        //$value = trim($value, ",");
        $replace = " <u>$temp</u> ";
        $line = str_replace($value, $replace, $line);
    }
}

function trimSpace($line)
{
    $lineResult = $line[0];
    $count = 0;
    for ($i = 1; $i < strlen($line); ++$i) {
        if (
            !($lineResult[$count] === ' '  && $line[$i] === $lineResult[$count]) &&
            $line[$i] !== "\n"
        ) {
            $lineResult .= $line[$i];
            ++$count;
        }
    }

    return $lineResult;
}
