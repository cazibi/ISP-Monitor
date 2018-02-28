<!--**************************************************************************************************
**  
**  Copyright 2016 Craig Hamilton
**  
**  Licensed under the Apache License, Version 2.0 (the "License");
**  you may not use this file except in compliance with the License.
**  You may obtain a copy of the License at
**  
**      http://www.apache.org/licenses/LICENSE-2.0
**  
**  Unless required by applicable law or agreed to in writing, software
**  distributed under the License is distributed on an "AS IS" BASIS,
**  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
**  See the License for the specific language governing permissions and
**  limitations under the License.
**  
**************************************************************************************************-->
<html>
<head>
  <title>ISP Performance</title>
</head>
<body>
  <h1>ISP Performance</h2>
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
