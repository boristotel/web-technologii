<?php
// Function to execute PowerShell commands and return output
function executePowerShellCommand($command) {
    $escapedCommand = escapeshellarg($command);
    $output = shell_exec("powershell -command $escapedCommand");
    return $output;
}

// Function to check if Docker is installed
function isDockerInstalled() {
    $output = executePowerShellCommand('docker --version');
    return strpos($output, 'Docker version') !== false;
}

// Function to install Docker
function installDocker() {
    // Enable the Hyper-V feature
    executePowerShellCommand('Enable-WindowsOptionalFeature -Online -FeatureName Microsoft-Hyper-V-All -All -NoRestart');

    // Enable the Containers feature
    executePowerShellCommand('Enable-WindowsOptionalFeature -Online -FeatureName Containers -All -NoRestart');

    // Download and install Docker Desktop
    $installerPath = 'C:\\Temp\\DockerDesktopInstaller.exe';
    executePowerShellCommand("Invoke-WebRequest -Uri https://desktop.docker.com/win/stable/Docker%20Desktop%20Installer.exe -OutFile $installerPath");
    executePowerShellCommand("$installerPath install");

    // Print the Docker version to verify installation (this will only execute after restart if you run the script again)
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
    <script>
        function confirmRestart() {
            var restart = confirm("The system needs to be restarted to complete the Docker installation. Do you want to restart now?");
            if (restart) {
                // If user confirms, restart the computer
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
