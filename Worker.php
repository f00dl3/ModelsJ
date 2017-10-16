<?php

/* PHP Worker with queries */

$query_GFSFHA = "SELECT FHour, GFS, NAM, RAP, CMC, HRRR, HRWA, HRWA as HRWN FROM GFSFHA WHERE DoGet=1;";
$query_Heights = "SELECT HeightMb FROM ModelHeightLevels WHERE GFS=1 ORDER BY HeightMb DESC;";
$query_HeightsAll = "SELECT HeightMb FROM ModelHeightLevels ORDER BY HeightMb DESC;";
$query_JSONModelData = "SELECT RunString, GFS, NAM, RAP, CMC, HRRR, HRWA, HRWN FROM KOJC_MFMD WHERE RunString=:RunSearch;";
$query_JSONModelLast = "SELECT RunString FROM MOS_Index ORDER BY RunID DESC LIMIT 1;";
$query_JSONModelRuns = "SELECT RunString FROM MOS_Index ORDER BY RunID DESC LIMIT 48;";

?>
