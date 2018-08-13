#!/bin/sh
# wait until MySQL is really available
sleep 10

cd /app
yes "yes" | /app/yii migrate