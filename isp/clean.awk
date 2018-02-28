###################################################################################################
##  
##  Copyright 2016 Craig Hamilton
##  
##  Licensed under the Apache License, Version 2.0 (the "License");
##  you may not use this file except in compliance with the License.
##  You may obtain a copy of the License at
##  
##      http://www.apache.org/licenses/LICENSE-2.0
##  
##  Unless required by applicable law or agreed to in writing, software
##  distributed under the License is distributed on an "AS IS" BASIS,
##  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
##  See the License for the specific language governing permissions and
##  limitations under the License.
##  
##################################################################################################
function ltrim(s) { sub(/^[ \t\r\n]+/, "", s); return s }
function rtrim(s) { sub(/[ \t\r\n]+$/, "", s); return s }
function trim(s) { return rtrim(ltrim(s)); } 
/Date/ {gsub(" ms","",$7); gsub(" Mbit/s", "", $9);gsub(" Mbit/s","",$11); print trim($2)","trim($4)":"trim($5)","trim($7)","trim($9)","trim($11)",\""trim($13)":"trim($14)"\"" }
