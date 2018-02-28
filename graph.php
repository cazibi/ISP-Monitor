<?php
include ("./vendor/jpgraph/jpgraph.php");
include ("./vendor/jpgraph/jpgraph_line.php");
include ("./vendor/jpgraph/jpgraph_utils.inc.php");

header('Pragma: public');
header('Cache-Control: max-age=0');
header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + 0));
header('Content-Type: image/png');

$date='2016-06-02';

if (isset($_GET['date'])) {
    $date=$_GET['date'];
}
$sPing=isset($_GET['ping']);
$sDown=isset($_GET['download']);
$sUp=isset($_GET['upload']);

$anySet=$sPing||$sDown||$sUp;

if(!$anySet){
  $sPing=true;
  $sDown=true;
  $sUp=true;
}

$width=1000;
$height=1000;

if(isset($_GET['w']))
  $width=$_GET['w'];
if(isset($_GET['h']))
  $height=$_GET['h'];


  

$resultFile = fopen("./isp/results.csv","r");

$resultSet = array();

// assume first CSV line contains the headers
  $headings=fgetcsv($resultFile);
while(!feof($resultFile)){
  $hourly=fgetcsv($resultFile);
  $resultSet[$hourly[0]][$headings[1]][]=$hourly[1];
  if($sPing)
    $resultSet[$hourly[0]][$headings[2]][]=$hourly[2];
  if($sDown)
    $resultSet[$hourly[0]][$headings[3]][]=$hourly[3];
  if($sUp)
    $resultSet[$hourly[0]][$headings[4]][]=$hourly[4];
//  $resultSet[$hourly[0]][$headings[5]][]=$hourly[5];
}
fclose($resultFile);

$graph = new Graph($width, $height);
$graph->title->Set($date);
$graph->title->SetFont(FF_VERDANA, FS_BOLD, 14);
$graph->title->SetColor('navy');
$graph->title->Show();

//$graph->tabtitle->Set($date);

$graph->SetScale("intlin");

$graph->img->SetAntiAliasing(false);
$graph->SetBox(false);

$graph->xgrid->Show();
$graph->xaxis->HideFirstLastLabel();

$xTagSize=($width>500?8:6);
$xLineWeight=($width>500?2:1);

$lines = array();
foreach($resultSet[$date] as $key => $kVal){
  if($key == 'Time'){
    $graph->xaxis->SetTickLabels($kVal);
    $graph->xaxis->SetFont(FF_VERDANA, FS_NORMAL, $xTagSize);
    $graph->xaxis->SetLabelAngle(45);
  } else {
    $line = new LinePlot($kVal);
    $line->SetLegend($key);
    $line->SetLineWeight($xLineWeight);
    $graph->Add($line);    
  }
}
$graph->legend->SetFont(FF_VERDANA, FS_NORMAL, 8);
$graph->legend->SetFrameWeight(0);
$graph->legend->Hide(false);
$graph->Stroke();

?>
