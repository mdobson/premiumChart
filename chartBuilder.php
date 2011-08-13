<?php
<?php

include("mssqldatabase.php");

function dataPull()
{
	$sql = "grabEnrollmentBasedOnTypeAndSite";
	$returnArray = array();
	$queryRet = mssql_query($sql);
	
	while($row = mssql_fetch_row($queryRet))
	{
		
		$total = $row[0];
		$studyType = $row[1];
		$site = $row[2];
		
		array_push($returnArray, array($total,$studyType,$site));
		
	}
	
	return $returnArray;
}

function returnTotalEnrollment($array)
{
	$total = 0;
	foreach($array as $row)
	{
		$total = $total + $row[0];
	}
	
	return $total;
	
}

function returnSiteEnrollment()
{
	$sql = "pullSiteEnrollmentData";
	$returnArray = array();
	$queryRet = mssql_query($sql);
	
	while($row = mssql_fetch_row($queryRet))
	{
		
		$total = $row[0];
		$site = $row[1];
		
		
		array_push($returnArray, array($total,$site));
		
	}
	
	return $returnArray;	
}

function returnEnrollmentBasedOnType()
{
	$sql = "pullEnrollmentDataBasedOnStudyGroup";
	$returnArray = array();
	$queryRet = mssql_query($sql);
	
	while($row = mssql_fetch_row($queryRet))
	{
		
		$total = $row[0];
		$studyType = $row[1];
		
		
		array_push($returnArray, array($total,$studyType));
		
	}
	
	return $returnArray;
	
}

function main()
{
	$siteAndType = dataPull();
	$total = returnTotalEnrollment($siteAndType);
	$siteTotals = returnSiteEnrollment($siteAndType);
	$basedOnType = returnEnrollmentBasedOnType($siteAndType);
	
	$jsonRet = array("totalEnrolled"=>$total, "enrolledBySiteAndType"=>$siteAndType, "totalsBySite"=>$siteTotals, "basedOnType"=>$basedOnType);
	$retStr = json_encode($jsonRet);
	echo $retStr;
}

main();
?>
?>