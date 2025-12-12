document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const messageDiv = document.getElementById('message');

    messageDiv.textContent = '';
    messageDiv.style.color = 'red';

    if (emailInput.value.trim() === '' || passwordInput.value.trim() === '') {
        messageDiv.textContent = 'Email and Password cannot be empty.';
        return;
    }

    const formData = new FormData();
    formData.append('email', emailInput.value);
    formData.append('password', passwordInput.value);

    console.log('Sending fetch request...');
    fetch('auth/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.success) {
            messageDiv.style.color = 'green';
            messageDiv.textContent = data.message;
            setTimeout(() => {
                window.location.href = 'admin_dashboard.php';
            }, 1000);
        } else {
            messageDiv.style.color = 'red';
            messageDiv.textContent = data.message;
            if (data.redirect) {
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1500);
            }
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        messageDiv.textContent = 'A connection error occurred. Make sure Apache is running and you opened via localhost.';
    });
});
