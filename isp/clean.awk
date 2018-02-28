function ltrim(s) { sub(/^[ \t\r\n]+/, "", s); return s }
function rtrim(s) { sub(/[ \t\r\n]+$/, "", s); return s }
function trim(s) { return rtrim(ltrim(s)); } 
/Date/ {gsub(" ms","",$7); gsub(" Mbit/s", "", $9);gsub(" Mbit/s","",$11); print trim($2)","trim($4)":"trim($5)","trim($7)","trim($9)","trim($11)",\""trim($13)":"trim($14)"\"" }
