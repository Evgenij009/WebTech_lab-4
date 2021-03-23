<?php
function handlingString($str)
{
    $resultStr = "";
    preg_match_all('/[А-ЯЁA-Z]{1}[^.!?]*[.!?]/u', $str, $arrayMatches, PREG_PATTERN_ORDER);
    //print_r($arrayMatches);
    $arrayLines = $arrayMatches[0];

    for ($i = 0; $i < count($arrayLines); ++$i) {
        $arrayLines[$i] = trimSpace($arrayLines[$i]);
    }

    print_r($arrayLines);

    return $resultStr;
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
