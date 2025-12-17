document.getElementById('registrationForm').addEventListener('submit', function(e) {
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.style.borderColor = '#ddd';
        const parent = input.closest('.group') || input.parentElement;
        const error = parent.querySelector('.err-msg');
        if (error) error.remove();
    });

    const fullName = document.getElementById('fullName').value.trim();
    const email = document.getElementById('email').value.trim();
    const contact = document.getElementById('contact').value.trim();
    const address = document.getElementById('address').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const terms = document.getElementById('terms').checked;

    let valid = true;

    const setError = (id, msg) => {
        const el = document.getElementById(id);
        if (el) el.style.borderColor = 'red';

        const parent = el ? (el.closest('.group') || el.parentElement) : document.querySelector(id);
        const errDiv = document.createElement('div');
        errDiv.className = 'err-msg';
        errDiv.style.color = 'red';
        errDiv.style.fontSize = '12px';
        errDiv.innerText = msg;
        parent.appendChild(errDiv);
        valid = false;
    };

    if (fullName === "" || !/^[a-zA-Z\s]+$/.test(fullName)) {
        setError('fullName', 'Name must contain only letters and spaces.');
    }

    if (email === "" || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        setError('email', 'Enter a valid email address.');
    }

    if (contact === "" || !/^\d{11}$/.test(contact)) {
        setError('contact', 'Contact must be exactly 11 digits.');
    }

    if (address === "") {
        setError('address', 'Address is required.');
    }

    if (password === "" || !/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/.test(password)) {
        setError('password', 'Password must be 8+ chars, with 1 uppercase, 1 number, and 1 special char.');
    }

    if (confirmPassword === "" || password !== confirmPassword) {
        setError('confirmPassword', 'Passwords do not match.');
    }

    if (!terms) {
        setError('.terms', 'You must agree to the terms.');
    }

    if (grecaptcha.getResponse().length === 0) {
        setError('.Anti-bot', 'Please complete the Captcha.');
    }

    if (!valid) {
        e.preventDefault();
    }
});