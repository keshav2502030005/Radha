document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const msg = document.getElementById('message');

    msg.textContent = '';
    msg.style.color = 'red';

    if (email === '' || password === '') {
        msg.textContent = 'Email and Password cannot be empty.';
        return;
    }

    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);

    fetch('../auth/login.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {

        msg.textContent = data.message;
        msg.style.color = data.success ? 'green' : 'red';

        if (data.success) {
            setTimeout(() => {
                window.location.href = '../dashboard/index.html';
            }, 1000);
        }
    })
    .catch(err => {
        console.error(err);
        msg.textContent = 'Fetch error: Check Apache or wrong file path.';
    });
});
