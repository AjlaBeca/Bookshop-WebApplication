document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    // Get email and password from the form
    const email = document.getElementById("loginEmail").value;
    const password = document.getElementById("loginPassword").value;

    // Check user
    checkUser(email, password);
});

function checkUser(email, password) {
    // Read users data from JSON file
    fetch('assets/users.json')
        .then(response => response.json())
        .then(users => {
            // Check if user exists
            for (user of users) {
                if (user.email === email && user.password === password) {
                    console.log('User exists and the password is correct.');
                    return;
                }
            }
            console.log('User does not exist and/or the password is not correct.');
        })
        .catch(error => console.error('Error reading JSON:', error));
}
