<?php

function executePowerShellCommand($command) {
    $escapedCommand = escapeshellarg($command);
    $output = shell_exec("powershell -command $escapedCommand");
    return $output;
}


executePowerShellCommand('Restart-Computer -Force');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restarting...</title>
</head>
<body>
    <h1>Restarting the computer...</h1>
</body>
</html>
