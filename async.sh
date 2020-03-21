     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawbinance  && echo "Done 1" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawbittrex && echo "Done 2" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawindodax && echo "Done 3" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawhuobi && echo "Done 4" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawokex && echo "Done 5" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawaex && echo "Done 6" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawcoinsbit && echo "Done 7" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawbilaxy && echo "Done 8" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawfolgory && echo "Done 9" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawbkex && echo "Done 10" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawbitz && echo "Done 11" &

     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/syncindodax && echo "Done 12" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/syncbittrex && echo "Done 13" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/syncbinance && echo "Done 14" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/synchuobi && echo "Done 15" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/syncaex && echo "Done 16" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/syncokex && echo "Done 17" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/syncbilaxy && echo "Done 18" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/syncfolgory && echo "Done 19" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/synccoinsbit && echo "Done 20" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/syncbkex && echo "Done 21" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/syncbitz && echo "Done 22" &


     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawprobitkr && echo "Done 25" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/syncprobitkr && echo "Done 26" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawlatoken && echo "Done 29" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/synclatoken && echo "Done 30" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawcoinbene && echo "Done 31" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/synccoinbene && echo "Done 32" &
     # curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawdigifinex && echo "Done 33" &
     # curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/syncigifinex && echo "Done 33" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawbhex && echo "Done 34" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/syncbhex && echo "Done 35" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawhitbtc && echo "Done 36" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/synchitbtc && echo "Done 37" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawcointiger && echo "Done 38" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/synccointiger && echo "Done 39" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawexx && echo "Done 40" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/syncexx && echo "Done 41" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/rawtokok && echo "Done 42" &
     curl -o /dev/null -s %{time_total}\\n foo http://localhost:8001/api/synctokok && echo "Done 43" &

sleep 15
echo "Sync Success"