$(document).ready(function () {
  // Function to check if the user is logged in
  /*function isLoggedIn(callback) {
        $.ajax({
            type: "GET",
            url: "backend/check_login.php",
            success: function(response) {
                callback(response.logged_in);
            },
            error: function(xhr, status, error) {
                console.error("Error checking login status:", error);
                callback(false);
            }
        });
    }*/

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

    $.ajax({
      type: "POST",
      url: "backend/add_user.php",
      data: { name: name, surname: surname, email: email, password: password },
      success: function (response) {
        console.log("Signup Response:", response);
        // Attempt to parse JSON response
        try {
          var jsonResponse = JSON.parse(response);
          if (jsonResponse.success) {
            console.log("User signed up successfully!");
            window.location.href = "#home";
          } else {
            console.log("Signup failed: " + jsonResponse.message);
            alert("User already exists. Please login.");
          }
        } catch (error) {
          console.log("Error parsing JSON response:", error);
        }
      },
      error: function (xhr, status, error) {
        console.log("Error: " + xhr.responseText);
      },
    });
  });

  $("#loginForm").submit(function (event) {
    event.preventDefault();
    var email = $("#loginEmail").val();
    var password = $("#loginPassword").val();

    console.log("Login Form Data:", { email: email, password: password });

    $.ajax({
      type: "POST",
      url: "backend/check_login.php",
      data: { email: email, password: password },
      success: function (response) {
        console.log("Login Response:", response);
        // Attempt to parse JSON response
        try {
          var jsonResponse = JSON.parse(response);
          if (jsonResponse.success) {
            console.log("User logged in successfully!");
            window.location.href = "#home";
          } else {
            console.log("Login failed: " + jsonResponse.message);
            alert("Invalid email or password. Please try again.");
          }
        } catch (error) {
          console.log("Error parsing JSON response:", error);
        }
      },
      error: function (xhr, status, error) {
        console.log("Error: " + xhr.responseText);
      },
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
