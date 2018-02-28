##################################################################################
##
##
##
##
#!/bin.sh
##
##################################################################################
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
