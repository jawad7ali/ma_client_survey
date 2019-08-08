<?php

/*
*   @method mixed getDateOffset()
*/
function getDateOffset()
{
	return $date = date("Y-m-d H:i:s");
}

function getRatingPercentage ( $rating ) 
{
	switch ($rating) {
        case '1':
            $ratingPercentage = 20;
            break;
        
        case '2':
            $ratingPercentage = 40;
            break;
        
        case '3':
        $ratingPercentage = 60;
        break;

        case '4':
        $ratingPercentage = 80;
        break;

        case '5':
            $ratingPercentage = 100;
            break;
        default:
            $ratingPercentage = "0%";
            break;
    }

    return $ratingPercentage;
}

function getAveragePercentage( $records )
{
	$avgPerc = '';
	foreach( $records as $record ) :
		$avgPerc += $record['RATING_PERC'];
	endforeach;

	$avgPerc = $avgPerc / 5;
	return $avgPerc . '%';
}