@echo off
title Podcast Queue Worker
cd /d C:\laragon\www\voxcraft

:loop
C:\laragon\bin\php\php-8.2.29-Win32-vs16-x64\php.exe -d max_execution_time=0 artisan queue:work --queue=podcast-generation --tries=3 --timeout=900
echo Queue worker stopped. Restarting in 5 seconds...
timeout /t 5
goto loop
