<?php

include("mssqldatabase.php");

function dataPull()
{
	$sql = "grabEnrollmentBasedOnTypeAndSite";
	$returnArray = array();
	$queryRet = mssql_query($sql);
	
	while($row = mssql_fetch_object($queryRet))
	{
		
		$total = $row->Column1;
		$studyType = $row->StudyAnswerDropDown;
		$site = $row->SiteId;
		array_push($returnArray, array($total,$studyType,$site));
		
	}
	
	return $total;
}

function returnTotalEnrollment($array)
{
	$total = 0;
	foreach($row in $array)
	{
		$total = $total + $row[0];
	}
	
	return $total;
	
}

function returnSiteEnrollment($array)
{
	$returnArray = array();
	foreach($row in $array)
	{
		if(in_array($array[2], array_keys($returnArray)))
		{
			$returnArray[$array[2]] = $returnArray[$array[2]] + $array[0];	
		}	
	}	
}

function returnEnrollmentBasedOnType($array)
{
	$returnArray = array();
	foreach($row in $array)
	{
		if(in_array($array[1], array_keys($returnArray)))
		{
			$returnArray[$array[1]] = $returnArray[$array[1]] + $array[0];	
		}	
	}
	
}

function main()
{
	$siteAndType = dataPull();
	$total = returnTotalEnrollment($siteAndType);
	$siteTotals = returnSiteEnrollment($siteAndType);
	$basedOnType = returnEnrollmentBasedOnType($siteAndType);
	
	echo"Pulling charts data";
	
	var_dump($siteAndType);
	var_dump($total);
	var_dump($siteTotals);
	var_dump($basedOnType);
	
}

main();
?>