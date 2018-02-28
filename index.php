<html>
<head>
  <title>Tesltra Cable Performance</title>
</head>
<body>
  <h1>Telstra Cable Performance</h2>
  <table cellspacing="3" cellpadding="3" border="1">
<?php
  $resultFile = fopen("./isp/results.csv","r");
  $resultSet = array();
// assume first CSV line contains the headers
  $headings=fgetcsv($resultFile);
  $lastDate="";
  while(!feof($resultFile)){
    $hourly=fgetcsv($resultFile);
    if($hourly[0]&&$hourly[0]!=$lastDate){
      $lastDate=$hourly[0];
?>
    <tr>
      <td><a href="./graph.php?date=<?=$lastDate?>&w=1024&h=768"><img border="0"  src="./graph.php?date=<?=$lastDate?>&w=400&h=300"/></a></td>
      <td><a href="./graph.php?date=<?=$lastDate?>&w=1024&h=768&download"><img border="0"  src="./graph.php?date=<?=$lastDate?>&w=400&h=300&download"/></a></td>
      <td><a href="./graph.php?date=<?=$lastDate?>&w=1024&h=768&upload"><img border="0" src="./graph.php?date=<?=$lastDate?>&w=400&h=300&upload"/></a></td>
      <td><a href="./graph.php?date=<?=$lastDate?>&w=1024&h=768&ping"><img border="0" src="./graph.php?date=<?=$lastDate?>&w=400&h=300&ping"/></a></td>
    </tr>
<?php
    }
  }
  fclose($resultFile);
?>
  <tr>
    <td colspan="4"><img src="./overlay.php"/></td>
  </tr>
  </table>
</body>
</html> 
