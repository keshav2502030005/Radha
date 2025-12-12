document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const email = document.getElementById('reg_email').value;
    const password = document.getElementById('reg_password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const messageDiv = document.getElementById('reg-message');

    messageDiv.textContent = '';
    messageDiv.style.color = 'red';

    
    if (password !== confirmPassword) {
        messageDiv.textContent = 'Passwords do not match.';
        return;
    }
    
    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password); 

    fetch('registration.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            messageDiv.style.color = 'green';
            messageDiv.textContent = data.message;
           
            setTimeout(() => {
                window.location.href = 'login.html'; 
            }, 2000); 
        } else {
            messageDiv.textContent = data.message;
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        messageDiv.textContent = 'A network error occurred during registration.';
    });
});