document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('insert_server_form').addEventListener('submit', function(event) {
        event.preventDefault();
        fetch('insert_server.php', {
            method: 'POST',
            body: new FormData(this)
        }).then(response => response.text())
        .then(data => alert(data));
    });

    document.getElementById('update_server_form').addEventListener('submit', function(event) {
        event.preventDefault();
        fetch('update_server.php', {
            method: 'POST',
            body: new FormData(this)
        }).then(response => response.text())
        .then(data => alert(data));
    });

    document.getElementById('check_status_form').addEventListener('submit', function(event) {
        event.preventDefault();
        fetch('check_status.php', {
            method: 'POST',
            body: new FormData(this)
        }).then(response => response.text())
        .then(data => alert(data));
    });

    document.getElementById('start_container_form').addEventListener('submit', function(event) {
        event.preventDefault();
        fetch('start_container.php', {
            method: 'POST',
            body: new FormData(this)
        }).then(response => response.json())
        .then(data => alert(JSON.stringify(data)));
    });

    document.getElementById('stop_container_form').addEventListener('submit', function(event) {
        event.preventDefault();
        fetch('stop_container.php', {
            method: 'POST',
            body: new FormData(this)
        }).then(response => response.json())
        .then(data => alert(JSON.stringify(data)));
    });

    document.getElementById('restart_container_form').addEventListener('submit', function(event) {
        event.preventDefault();
        fetch('restart_container.php', {
            method: 'POST',
            body: new FormData(this)
        }).then(response => response.json())
        .then(data => alert(JSON.stringify(data)));
    });

    document.getElementById('create_container_form').addEventListener('submit', function(event) {
        event.preventDefault();
        fetch('create_container.php', {
            method: 'POST',
            body: new FormData(this)
        }).then(response => response.json())
        .then(data => alert(JSON.stringify(data)));
    });
});
