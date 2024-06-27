<?php

function executeShellCommand($command) {
    $output = shell_exec($command);
    return $output;
}


function isDockerInstalled() {
    $output = executeShellCommand('docker --version');
    return strpos($output, 'Docker version') !== false;
}

function installDocker() {
   
    executeShellCommand('sudo apt-get update');
   
    executeShellCommand('sudo apt-get install apt-transport-https ca-certificates curl gnupg-agent software-properties-common -y');

    executeShellCommand('curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -');

    
    executeShellCommand('sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"');

    executeShellCommand('sudo apt-get update');


    executeShellCommand('sudo apt-get install docker-ce docker-ce-cli containerd.io -y');

    executeShellCommand('sudo usermod -aG docker $USER');

    $output = executeShellCommand('docker --version');
    return $output;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isDockerInstalled()) {
        echo "Docker is already installed.<br>";
        echo executeShellCommand('docker --version');
    } else {
        echo "Docker is not installed. Installing Docker...<br>";
        $output = installDocker();
        echo "Docker installed successfully.<br>";
        echo $output;
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
            margin-top: 50px; 
        }
        button {
            padding: 15px 30px;
            background-color: rgb(88, 166, 235); 
            color: white;
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
</head>
<body>
    <h1>Install Docker</h1>
    <form method="POST" action="">
        <button type="submit">Install Docker</button>
    </form>
</body>
</html>
