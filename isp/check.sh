#!/bin.sh
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
_wd=$(dirname "$0")
_today=$(date +"%Y-%m-%d")
_now=$(date +"%H:%M")
_fileMark=$(date +"%Y-%m-%d-%H.%M")
_file="$_wd/$_fileMark.log"
echo "Date: $_today" > "$_file"
echo "Time: $_now" >> "$_file"
/usr/local/bin/speedtest --simple --share >> "$_file"
echo $'' >> "$_file"
awk -F ':' -v RS="" -f "$_wd/clean.awk" "$_file" >> "$_wd/results.csv"
rm -f "$_file"
