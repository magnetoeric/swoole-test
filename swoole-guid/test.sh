#/bin/bash
while true
do
 (echo 'get';sleep 0.01;) |nc  localhost 9501
done
