$(document).ready(function () {
  // Handle signup form submission
  $("#signupForm").submit(function (event) {
    event.preventDefault();
    var name = $("#signupName").val();
    var surname = $("#signupSurname").val(); // Add this line
    var email = $("#signupEmail").val();
    var password = $("#signupPassword").val();

    console.log("Signup Form Data:", {
      name: name,
      surname: surname,
      email: email,
      password: password,
    });

    fetch('../backend/auth/register', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({
          name: name,
          surname: surname,
          email: email,
          password: password
      })
      }).then(function (response) {
      console.log(response);
      if (response.ok) {
          window.location.href = '../login';
      } else {
          alert('An error occurred. Please try again.');
      }
      }).catch(function (error) {
          console.log(error);
          alert(error.message);
      });
  });
// Handle login form submission
$("#loginForm").submit(function (event) {
  event.preventDefault();
  var email = $("#loginEmail").val();
  var password = $("#loginPassword").val();

  console.log("Login Form Data:", { email: email, password: password });

  fetch('../backend/auth/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      email: email,
      password: password
    })
  })
  .then(function (response) {
    console.log(response);
    if (response.ok) {
      return response.json().then(function (responseData) {
        console.log('Login Success:', responseData);
        window.localStorage.setItem('user', JSON.stringify(responseData));
        window.location.href = 'index.html';
      });
    } else {
      return response.text().then(text => { throw new Error(text) });
    }
  })
  .catch(function (error) {
    console.error('Login Error:', error);
    alert('Login failed: ' + error.message);
  });
});

  /* Check if the user is logged in on page load
    isLoggedIn(function(loggedIn) {
        if (loggedIn) {
            console.log("User is already logged in!");
        } else {
            console.log("User is not logged in.");
        }
    });*/
});
