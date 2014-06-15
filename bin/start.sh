#!/bin/bash

PWD="`pwd`"
PWD="${PWD##/*/}"

if [ "$PWD" != 'anon-o-gist' ]
  then
    cd ..
    PWD="`pwd`"
    PWD="${PWD##/*/}"
    if [ "$PWD" != 'anon-o-gist' ]
      then
        echo "Must be run from the root directory (ex. bin/start.sh)"
      else
        java -jar ./bin/selenium.jar > /dev/null &
        echo '' > /dev/null
    fi
  else
    java -jar ./bin/selenium.jar > /dev/null &
    echo '' > /dev/null
fi
