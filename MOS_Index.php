<?php

require_once($_SERVER['DOCUMENT_ROOT'] . 'ASWebUI/Templates/MinHeader.php');

$stmt_Hours = $wxpdo -> prepare($query_GFSFHA);
$stmt_JSONModelData = $wxpdo -> prepare($query_JSONModelData);
$stmt_Heights = $wxpdo -> prepare($query_Heights);
$stmt_Runs = $wxpdo -> prepare($query_JSONModelRuns);

if(!isset($_POST['RunSearch'])) {
	$stmt_Last = $wxpdo -> prepare($query_JSONModelLast);
	$stmt_Last -> execute();
	$row_Last = $stmt_Last -> fetch(PDO::FETCH_ASSOC);
	$searchString = $row_Last['RunString']; 
	$stmt_JSONModelData -> bindParam(':RunSearch', $searchString, PDO::PARAM_STR, 16);
} else {
	$searchString = $_POST['RunSearch'];
	$stmt_JSONModelData -> bindParam(':RunSearch', $searchString, PDO::PARAM_STR, 16);
}

$models = array("CMC", "GFS", "HRRR", "NAM", "RAP", "HRWA", "HRWN");
$reportingModels = "";

$stmt_Heights -> execute();
while($row_Heights = $stmt_Heights -> fetch(PDO::FETCH_ASSOC)) { $Heights[] = $row_Heights['HeightMb']; }

?>

<h3>GRIB2 JSON Model Output Data</h3>
<em>For KOJC / Olathe Johnson County<br/>Auto-updated every hour.</em>
<br/><a href="/G2Out/">Automatic model image output</a>

<p>

<form id='ModelRunForm' action='/ASWebUI/Include/MOSData.php' method='post'>
<select id='RunSearch' name='RunSearch'>
<option value=''>Select...</option>

<?php

$stmt_Runs -> execute();
while($row_Runs = $stmt_Runs -> fetch(PDO::FETCH_ASSOC)) {
	echo "<option value='" . $row_Runs['RunString'] . "'>" . $row_Runs['RunString'] . "</option>";
}

?>

</select><p>

<div class='table'>

<div class='tr'>

<span class='td'>
	<a href="/G2Out/MergedJ/Loops/FOCUS_Loop.mp4" target='top'>
	<video id="FocusLoop" class='th_sm_med' autoplay controls loop>
	<source src="/G2Out/MergedJ/Loops/FOCUS_Loop.mp4?ts=<?php echo $thisTimeStamp; ?>"></source>
	</video></a><br/>
	Focus
</span>

<span class='td'>
	<a href="pChart/ch_Dynamic.php?DynVar=WxMOSTemp&RunString=<?php echo $searchString; ?>&js=True" target="pChart">
	<img class="th_sm_med" src="pChart/ch_Dynamic.php?Thumb=1&DynVar=WxMOSTemp&RunString=<?php echo $searchString; ?>"/>
	</a><br/>
	Temperature
</span>

<span class='td'>
	<a href="pChart/ch_Dynamic.php?DynVar=WxMOSWind&RunString=<?php echo $searchString; ?>&js=True" target="pChart">
	<img class="th_sm_med" src="pChart/ch_Dynamic.php?Thumb=1&DynVar=WxMOSWind&RunString=<?php echo $searchString; ?>"/>
	</a><br/>
	Wind Speed
</span>

</div>

</div>

<?php

$stmt_JSONModelData -> execute();

while ($row_JSONModelData = $stmt_JSONModelData -> fetch(PDO::FETCH_ASSOC)) {
	$RunString = $row_JSONModelData['RunString'];
	$CMC_JSON = $row_JSONModelData['CMC'];
	$GFS_JSON = $row_JSONModelData['GFS'];
	$HRRR_JSON = $row_JSONModelData['HRRR'];
	$HRWA_JSON = $row_JSONModelData['HRWA'];
	$HRWN_JSON = $row_JSONModelData['HRWN'];
	$NAM_JSON = $row_JSONModelData['NAM'];
	$RAP_JSON = $row_JSONModelData['RAP'];
}

echo "<p>";

$CMCData = json_decode($CMC_JSON, true);
$GFSData = json_decode($GFS_JSON, true);
$HRRRData = json_decode($HRRR_JSON, true);
$HRWAData = json_decode($HRWA_JSON, true);
$HRWNData = json_decode($HRWN_JSON, true);
$NAMData = json_decode($NAM_JSON, true);
$RAPData = json_decode($RAP_JSON, true);

if(!empty($CMCData['T0_3'])) { $reportingModels .= " CMC"; }
if(!empty($GFSData['T0_3'])) { $reportingModels .= " GFS"; }
if(!empty($HRRRData['T0_3'])) { $reportingModels .= " HRRR"; }
if(!empty($HRWAData['T0_3'])) { $reportingModels .= " HRWA"; }
if(!empty($HRWNData['T0_3'])) { $reportingModels .= " HRWN"; }
if(!empty($NAMData['T0_3'])) { $reportingModels .= " NAM"; }
if(!empty($RAPData['T0_3'])) { $reportingModels .= " RAP"; }

$stmt_Hours -> execute();
while($row_Hours = $stmt_Hours -> fetch(PDO::FETCH_ASSOC)) { $gfsFh[] = $row_Hours['FHour']; }

$RunDateTime = DateTime::createFromFormat('Ymd\_HT', $RunString);

echo "<strong>Data from" . $reportingModels . "</strong><p>";

?>

<div class='table'>

<div class='tr'>

<span class='td'><strong>Forecast</strong></span>
<span class='td'><strong>TA</strong></span>
<span class='td'><strong>TD</strong></span>
<span class='td'><strong>RH</strong></span>
<span class='td'><strong>WND</strong></span>
<span class='td'><strong>P3</strong></span>
<span class='td'><strong>PT</strong></span>
<span class='td'><strong>X3</strong></span>
<span class='td'><strong>PW</strong></span>
<span class='td'><strong>LI</strong></span>
<span class='td'><strong>CAPE</strong></span>
<span class='td'><strong>CIN</strong></span>
<span class='td'><strong>950</strong></span>
<span class='td'><strong>900</strong></span>
<span class='td'><strong>850</strong></span>
<span class='td'><strong>800</strong></span>
<span class='td'><strong>750</strong></span>
<span class='td'><strong>700</strong></span>
<span class='td'><strong>650</strong></span>
<span class='td'><strong>600</strong></span>
<span class='td'><strong>550</strong></span>
<span class='td'><strong>500</strong></span>
<span class='td'><strong>450</strong></span>
<span class='td'><strong>400</strong></span>
<span class='td'><strong>350</strong></span>
<span class='td'><strong>300</strong></span>
<span class='td'><strong>250</strong></span>
<span class='td'><strong>200</strong></span>
<span class='td'><strong>150</strong></span>
<span class='td'><strong>100</strong></span>
</div>

<?php

$EstZRainTot = 0; $EstSnowTot = 0; $PrecipTot = 0;

$i = 0;

$urlPrefix = clone $RunDateTime;
$urlPrefix = $urlPrefix->format('Ymd\_H\_');

foreach($gfsFh as $tFh) {

	if(!empty($tFh)) {
		$tValidTime = clone $RunDateTime;
		$tValidTime->modify('+' . $tFh . ' hours');
		$tValidTimeStr = $tValidTime->format('Y-m-d H');
	} else { continue; }

	if(
		empty($CMCData['T0_' . $tFh]) &&
		empty($GFSData['T0_' . $tFh]) &&
		empty($HRRRData['T0_' . $tFh]) &&
		empty($HRWAData['T0_' . $tFh]) &&
		empty($HRWNData['T0_' . $tFh]) &&
		empty($NAMData['T0_' . $tFh]) &&
		empty($RAPData['T0_' . $tFh])
	) {

		continue;

	} else {

		$tAutoCounter = 0; $tAuto_0TF = 0;
		foreach($models as $thisModel) {
			if(!empty(${$thisModel . "Data"}['T0_' . $tFh]) && ${$thisModel . "Data"}['T0_' . $tFh] > -50) {
				${"t" . $thisModel . "Auto_0TF"} = Conv2TF(${$thisModel . "Data"}['T0_' . $tFh],0);
				$tAuto_0TF = $tAuto_0TF + ${"t" . $thisModel . "Auto_0TF"};
				$tAutoCounter++;
			} else { continue; }
		}
		$tAuto_0TF = round(($tAuto_0TF/$tAutoCounter),0);	
	
		$tAutoCounter = 0; $tAuto_900TF = 0;
		foreach($models as $thisModel) {
			if(!empty(${$thisModel . "Data"}['T900_' . $tFh]) && ${$thisModel . "Data"}['T900_' . $tFh] > -50) {
				${"t" . $thisModel . "Auto_900TF"} = Conv2TF(${$thisModel . "Data"}['T900_' . $tFh],0);
				$tAuto_900TF = $tAuto_900TF + ${"t" . $thisModel . "Auto_900TF"};
				$tAutoCounter++;
			}
		}
		$tAuto_900TF = round(($tAuto_900TF/$tAutoCounter),0);	
	
		$tAutoCounter = 0; $tAuto_0DF = 0;
		foreach($models as $thisModel) {
			if(!empty(${$thisModel . "Data"}['D0_' . $tFh]) && ${$thisModel . "Data"}['D0_' . $tFh] > -70) {
				${"t" . $thisModel . "Auto_0DF"} = Conv2TF(${$thisModel . "Data"}['D0_' . $tFh],0);
				$tAuto_0DF = $tAuto_0DF + ${"t" . $thisModel . "Auto_0DF"};
				$tAutoCounter++;
			}
		}
		$tAuto_0DF = round(($tAuto_0DF/$tAutoCounter),0);	
	
		$tAutoCounter = 0; $tAuto_0WD = 0;
		foreach($models as $thisModel) {
			if(!empty(${$thisModel . "Data"}['WD0_' . $tFh]) && ${$thisModel . "Data"}['WD0_' . $tFh] > -100) {
				$tAuto_0WD = $tAuto_0WD + ${$thisModel . "Data"}['WD0_' . $tFh];
				$tAutoCounter++;
			}
		}
		$tAuto_0WD = round(($tAuto_0WD/$tAutoCounter),0);	
	
		$tAutoCounter = 0; $tAuto_0WS = 0;
		foreach($models as $thisModel) {
			if(!empty(${$thisModel . "Data"}['WS0_' . $tFh]) && ${$thisModel . "Data"}['WS0_' . $tFh] > -100) {
				$tAuto_0WS = $tAuto_0WS + ${$thisModel . "Data"}['WS0_' . $tFh];
				$tAutoCounter++;
			}
		}
		$tAuto_0WS = round(($tAuto_0WS/$tAutoCounter),0);	
	
		$tAutoCounter = 0; $tAuto_PRATE = 0;
		foreach($models as $thisModel) {
			$tAutoCounter++;
			if(!empty(${$thisModel . "Data"}['PRATE_' . $tFh]) && ${$thisModel . "Data"}['PRATE_' . $tFh] > -100) {
				$tAuto_PRATE = $tAuto_PRATE + ${$thisModel . "Data"}['PRATE_' . $tFh];
			} else {
				$tAuto_PRATE = 0.001;
			}
		}
		$tAuto_PRATE = round(($tAuto_PRATE/$tAutoCounter),2);	
	
		switch(true) {
			case ($tAuto_0TF > 34 && $tAuto_900TF > 32):	
				$EstimatedSnow = 0;	
				$EstZRain = 0;
				break;
			case ($tAuto_0TF <= 34 && $tAuto_0TF > 32 && $tAuto_900TF <= 32):
				$EstimatedSnow = round(10 * ($tAuto_PRATE * SnowRatio($tAuto_PRATE,$tAuto_0TF)),1);
				$EstZRain = 0;
			break;
			case ($tAuto_0TF <= 32): 
				if ($tAuto_900TF > 32) {
					$EstimatedSnow = 0;
					$EstZRain = $tAuto_PRATE;
				}
				else {
					$EstimatedSnow = round(10 * ($tAuto_PRATE * SnowRatio($tAuto_PRATE,$tAuto_0TF)),1);
					$EstZRain = 0;
				}
				break;
			default:	
				$EstimatedSnow= 0;
				$EstZRain = 0;
				break;
		}
	
		$PrecipTot = round($PrecipTot + $tAuto_PRATE,2);
		$EstSnowTot = $EstSnowTot + $EstimatedSnow;
		$EstZRainTot = $EstZRainTot + $EstZRain;
		$rHumidity = RelativeHumidity($tAuto_0TF,$tAuto_0DF);
	
		$tAutoCounter = 0; $tAuto_PWAT = 0;
		foreach($models as $thisModel) {
			$tAutoCounter++;
			if(!empty(${$thisModel . "Data"}['PWAT_' . $tFh]) && ${$thisModel . "Data"}['PWAT_' . $tFh] > -100) {
				$tAuto_PWAT = $tAuto_PWAT + ${$thisModel . "Data"}['PWAT_' . $tFh];
			} else {
				$tAuto_PWAT = 0.001;
			}
		}
		$tAuto_PWAT = round(($tAuto_PWAT+0.001/$tAutoCounter),2);	
	
		$tAutoCounter = 0; $tAuto_LI = 0;
		foreach($models as $thisModel) {
			if(!empty(${$thisModel . "Data"}['LI_' . $tFh]) && ${$thisModel . "Data"}['LI_' . $tFh] > -100) {
				$tAuto_LI = $tAuto_LI + ${$thisModel . "Data"}['LI_' . $tFh];
				$tAutoCounter++;
			}
		}
		if ($tAuto_LI > 0.1) { $tAuto_LI = round(($tAuto_LI+0.001/$tAutoCounter),2); }
	
		$tAutoCounter = 0; $tAuto_CAPE = 0;
		foreach($models as $thisModel) {
			if(!empty(${$thisModel . "Data"}['CAPE_' . $tFh]) && ${$thisModel . "Data"}['CAPE_' . $tFh] > -100) {
				$tAuto_CAPE = $tAuto_CAPE + ${$thisModel . "Data"}['CAPE_' . $tFh];
				$tAutoCounter++;
			}
		}
		if ($tAuto_CAPE > 0.1) { $tAuto_CAPE = round(($tAuto_CAPE+0.001/$tAutoCounter),2); }
	
		$tAutoCounter = 0; $tAuto_CIN = 0;
		foreach($models as $thisModel) {
			if(!empty(${$thisModel . "Data"}['CIN_' . $tFh]) && ${$thisModel . "Data"}['CIN_' . $tFh] > -100) {
				$tAuto_CIN = $tAuto_CIN + ${$thisModel . "Data"}['CIN_' . $tFh];
				$tAutoCounter++;
			}
		}
		if ($tAuto_CIN > 0.1) { $tAuto_CIN = round(($tAuto_CIN+0.001/$tAutoCounter),2); }
	
	
		echo "<div class='tr'>";
		echo "<span class='td'><div class='UPop'>" . $tValidTimeStr . "Z<div class='UPopO'>" . $RunDateTime->format('Y-m-d H') . " +" . $tFh . "h</div></div></span>";
		echo "<span class='td' style='" . ColorTemp2($tAuto_0TF) . "'>";
		echo "<div class='UPopNM'>" . $tAuto_0TF;
		echo "<div class='UPopNMO'>";
		if(!empty($CMCData['T0_' . $tFh])) { echo "CMC: <span style='" . ColorTemp2($tCMCAuto_0TF) . "'>" . $tCMCAuto_0TF . "</span>"; }
		if(!empty($GFSData['T0_' . $tFh])) { echo "GFS: <span style='" . ColorTemp2($tGFSAuto_0TF) . "'>" . $tGFSAuto_0TF . "</span>"; }
		if(!empty($HRRRData['T0_' . $tFh])) { echo "HRRR: <span style='" . ColorTemp2($tHRRRAuto_0TF) . "'>" . $tHRRRAuto_0TF . "</span>"; }
		if(!empty($HRWAData['T0_' . $tFh])) { echo "HRWA: <span style='" . ColorTemp2($tHRWAAuto_0TF) . "'>" . $tHRWAAuto_0TF . "</span>"; }
		if(!empty($HRWNData['T0_' . $tFh])) { echo "HRWN: <span style='" . ColorTemp2($tHRWNAuto_0TF) . "'>" . $tHRWNAuto_0TF . "</span>"; }
		if(!empty($NAMData['T0_' . $tFh])) { echo "NAM: <span style='" . ColorTemp2($tNAMAuto_0TF) . "'>" . $tNAMAuto_0TF . "</span>"; }
		if(!empty($RAPData['T0_' . $tFh])) { echo "RAP: <span style='" . ColorTemp2($tRAPAuto_0TF) . "'>" . $tRAPAuto_0TF . "</span>"; }
		echo "</div></div></span>";
		echo "<span class='td' style='" . ColorTemp2($tAuto_0DF) . "'>";
		echo "<div class='UPop'>" . $tAuto_0DF;
		echo "<div class='UPopO'>";
		if(!empty($NAMData['D0_' . $tFh])) { echo "NAM: <span style='" . ColorTemp2($tNAMAuto_0DF) . "'>" . $tNAMAuto_0DF . "</span>"; }
		if(!empty($GFSData['D0_' . $tFh])) { echo "GFS: <span style='" . ColorTemp2($tGFSAuto_0DF) . "'>" . $tGFSAuto_0DF . "</span>";  }
		if(!empty($HRRRData['D0_' . $tFh])) { echo "HRRR: <span style='" . ColorTemp2($tHRRRAuto_0DF) . "'>" . $tHRRRAuto_0DF . "</span>"; }
		if(!empty($HRWAData['D0_' . $tFh])) { echo "HRWA: <span style='" . ColorTemp2($tHRWAAuto_0DF) . "'>" . $tHRWAAuto_0DF . "</span>"; }
		if(!empty($HRWNData['D0_' . $tFh])) { echo "HRWN: <span style='" . ColorTemp2($tHRWNAuto_0DF) . "'>" . $tHRWNAuto_0DF . "</span>"; }
		if(!empty($RAPData['D0_' . $tFh])) { echo "RAP: <span style='" . ColorTemp2($tRAPAuto_0DF) . "'>" . $tRAPAuto_0DF . "</span>"; }
		echo "</div></div></span>";
		echo "<span class='td' style='" . ColorRH2($rHumidity) . "'>" . $rHumidity . "</span>";
		echo "<span class='td' style='" . ColorWind2($tAuto_0WS) . "'>" . WindDirSVG($tAuto_0WD) . " (" . $tAuto_0WS . ")</span>";
		echo "<span class='td' style='" . ColorLiquid2($tAuto_PRATE) . "'>";
		echo "<div class='UPopNM'>" . $tAuto_PRATE;
		echo "<div class='UPopNMO'>";
		if(!empty($CMCData['PRATE_' . $tFh])) { echo "CMC: <span style='" . ColorLiquid2($CMCData['PRATE_' . $tFh]) . "'>" . $CMCData['PRATE_' . $tFh] . "</span>"; }
		if(!empty($GFSData['PRATE_' . $tFh])) { echo "GFS: <span style='" . ColorLiquid2($GFSData['PRATE_' . $tFh]) . "'>" . $GFSData['PRATE_' . $tFh] . "</span>"; }
		if(!empty($HRRRData['PRATE_' . $tFh])) { echo "HRRR: <span style='" . ColorLiquid2($HRRRData['PRATE_' . $tFh]) . "'>" . $HRRRData['PRATE_' . $tFh] . "</span>"; }
		if(!empty($HRWAData['PRATE_' . $tFh])) { echo "HRWA: <span style='" . ColorLiquid2($HRWAData['PRATE_' . $tFh]) . "'>" . $HRWAData['PRATE_' . $tFh] . "</span>"; }
		if(!empty($HRWNData['PRATE_' . $tFh])) { echo "HRWN: <span style='" . ColorLiquid2($HRWNData['PRATE_' . $tFh]) . "'>" . $HRWNData['PRATE_' . $tFh] . "</span>"; }
		if(!empty($NAMData['PRATE_' . $tFh])) { echo "NAM: <span style='" . ColorLiquid2($NAMData['PRATE_' . $tFh]) . "'>" . $NAMData['PRATE_' . $tFh] . "</span>"; }
		if(!empty($RAPData['PRATE_' . $tFh])) { echo "RAP: <span style='" . ColorLiquid2($RAPData['PRATE_' . $tFh]) . "'>" . $RAPData['PRATE_' . $tFh] . "</span>"; }
		echo "</div></div></span>";
		echo "<span class='td' style='" . ColorLiquid2($PrecipTot) . "'>" . $PrecipTot . "</span>";
		echo "<span class='td'><div class='UPopNM'>" . $EstimatedSnow;
		echo "<div class='UPopNMO'>";
		echo "<strong>Total snow</strong>: " . $EstSnowTot . " in.<br/>";
		echo "<strong>Freezing rain</strong>: " . $EstZRainTot . " in.<br/>";
		echo "</div></div></span>";
		echo "<span class='td' style='" . ColorLiquid2($tAuto_PWAT) . "'>" . $tAuto_PWAT . "</span>";
		echo "<span class='td' style='" . ColorLI2($tAuto_LI) . "'>" . $tAuto_LI . "</span>";
		echo "<span class='td' style='" . ColorCAPE2($tAuto_CAPE) . "''>" . $tAuto_CAPE . "</span>";
		echo "<span class='td " . ColorCIN($tAuto_CIN) . "''>" . $tAuto_CIN . "</span>";
		foreach ($Heights as $tHgt) {
			if ($tHgt != "0" && $tHgt != 1000) {
				$tAutoCounter = 0; ${"tAuto_" . $tHgt . "TF"} = 0;
				foreach($models as $thisModel) {
					if(!empty(${$thisModel . "Data"}['T' . $tHgt . '_' . $tFh]) && ${$thisModel . "Data"}['T' . $tHgt . '_' . $tFh] > -50) {
						${"t" . $thisModel . "Auto_" . $tHgt . "TF"} = Conv2TF(${$thisModel . "Data"}['T' . $tHgt . '_' . $tFh],0);
						${"tAuto_" . $tHgt . "TF"} = ${"tAuto_" . $tHgt . "TF"} + ${"t" . $thisModel . "Auto_" . $tHgt . "TF"};
						$tAutoCounter++;
					} else { continue; }
				}
				if (${"tAuto_" . $tHgt . "TF"} > 0) { ${"tAuto_" . $tHgt . "TF"} = round((${"tAuto_" . $tHgt . "TF"}/$tAutoCounter),0); }
				echo "<span class='td' style='" . ColorTemp2(${"tAuto_" . $tHgt . "TF"}) . "'>" . ${"tAuto_" . $tHgt . "TF"} . "</span>";
			}
		}
		echo "</div>";
		$i++;
		
		unset($tValidTime);

	}

}

?>

</div>

<div id='MOSTableHolder'></div>
