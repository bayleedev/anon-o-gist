#!/bin/bash

ps -ef | grep 'java -jar' | grep -v grep | awk '{print $2}' > kill_1.pid
cat kill_1.pid | xargs kill -9
rm kill_1.pid
echo "Stopping Selenium Server"