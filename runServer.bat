@echo off
start /B "Register" php app/Sockets/register.php start -d
start /B "BusinessWorker" php app/Sockets/business_worker.php start -d
start /B "Gateway" php app/Sockets/gateway.php start -d
