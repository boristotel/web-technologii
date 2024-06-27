<?php

function executePowerShellCommand($command) {
    $escapedCommand = escapeshellarg($command);
    $output = shell_exec("powershell -command $escapedCommand");
    return $output;
}


function isDockerInstalled() {
    $output = executePowerShellCommand('docker --version');
    return strpos($output, 'Docker version') !== false;
}

function installDocker() {
   
    executePowerShellCommand('Enable-WindowsOptionalFeature -Online -FeatureName Microsoft-Hyper-V-All -All -NoRestart');

   
    executePowerShellCommand('Enable-WindowsOptionalFeature -Online -FeatureName Containers -All -NoRestart');

    $installerPath = 'C:\\Temp\\DockerDesktopInstaller.exe';
    executePowerShellCommand("Invoke-WebRequest -Uri https://desktop.docker.com/win/stable/Docker%20Desktop%20Installer.exe -OutFile $installerPath");
    executePowerShellCommand("$installerPath install");

    $output = executePowerShellCommand('docker --version');
    return $output;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isDockerInstalled()) {
        echo "Docker is already installed.<br>";
        echo executePowerShellCommand('docker --version');
    } else {
        echo "Docker is not installed. Installing Docker...<br>";
        $output = installDocker();
        echo "Docker installed successfully.<br>";
        echo $output;
        echo "<br>Please restart your computer to complete the installation.";
        echo "<br><button onclick=\"confirmRestart()\">Restart Now</button>";
    }
} else {
    echo "Invalid request method.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Install Docker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2; 
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: rgb(88, 166, 235); 
        }
        button {
            padding: 15px 30px;
            background-color: rgb(88, 166, 235); 
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #5aadd8; 
        }
    </style>
    <script>
        function confirmRestart() {
            var restart = confirm("The system needs to be restarted to complete the Docker installation. Do you want to restart now?");
            if (restart) {
                window.location.href = 'restart_computer.php';
            }
        }
    </script>
</head>
<body>
    <h1>Install Docker</h1>
    <form method="POST" action="">
        <button type="submit">Install Docker</button>
    </form>
</body>
</html>
