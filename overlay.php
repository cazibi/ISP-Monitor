<?php
include ("./vendor/jpgraph/jpgraph.php");
include ("./vendor/jpgraph/jpgraph_line.php");
include ("./vendor/jpgraph/jpgraph_utils.inc.php");

header('Pragma: public');
header('Cache-Control: max-age=0');
header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + 0));
header('Content-Type: image/png');

$sDown=isset($_GET['download']);
$sUp=isset($_GET['upload']);
$sPing=isset($_GET['ping']);

$anySet=$sPing||$sDown||$sUp;

if(!$anySet)
  $sDown=true;

if($sDown){
  $sUp=false;
  $sPing=false;
}
if($sUp)
  $sPing=false;

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
$title=$headings[3];
if($sUp)
  $title=$headings[4];
if($sPing)
  $title=$headings[2];
$lastDate='';
$getTimes=true;
$times=array();
while(!feof($resultFile)){
  $hourly=fgetcsv($resultFile);
  if($hourly[0]&&$hourly[0]!=$lastDate){
    if($lastDate!='')
      $getTimes=false;
    $lastDate=$hourly[0];
  }
  if($getTimes)
    $times[]=$hourly[1];
  if($sPing)
    $resultSet[$lastDate][]=$hourly[2];
  if($sDown)
    $resultSet[$lastDate][]=$hourly[3];
  if($sUp)
    $resultSet[$lastDate][]=$hourly[4];
}
fclose($resultFile);

$graph = new Graph($width, $height);
$graph->title->Set($title);
$graph->title->SetFont(FF_VERDANA, FS_BOLD, 14);
$graph->title->SetColor('navy');
$graph->title->Show();

$graph->SetScale("intlin");

$graph->img->SetAntiAliasing(false);
$graph->SetBox(false);

$graph->xgrid->Show();

$lines = array();
$graph->xaxis->SetTickLabels($times);
$graph->xaxis->SetFont(FF_VERDANA, FS_NORMAL, 8);
$graph->xaxis->SetLabelAngle(45);
foreach($resultSet as $key => $kVal){
  $line = new LinePlot($kVal);
  $line->SetLegend($key);
  if($width>500)
    $line->SetLineWeight(2);
  $graph->Add($line);    
}

if($width>500)
  $graph->legend->SetLineWeight(2);
$graph->legend->Hide(false);
$graph->Stroke();

?>
