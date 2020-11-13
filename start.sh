#!/usr/bin/env bash

set -e
if [ "$role" = "php" ]; then
    exec php /var/www/html/worker.php
fi