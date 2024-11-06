const form = document.getElementById("contact-form");

// Handle form submission
form.addEventListener("submit", function (event) {
  event.preventDefault();

  const spinner = document.getElementById("email-spinner");
  const successMessage = document.getElementById("email-success");
  const errorMessage = document.getElementById("email-failure");

  // Show the loader
  spinner.style.opacity = "1";

  // Send the form data using Fetch API
  fetch("mail.php", {
    method: "POST",
    body: new FormData(this),
  })
    .then((response) => response.json()) // Parse JSON response
    .then((data) => {
      // Hide the loader
      spinner.style.opacity = "0";

      // Check the response status
      if (data.status === "success") {
        // Show the success popup
        successMessage.style.opacity = "1";

        // Optionally, hide the success popup after a few seconds
        setTimeout(() => {
          successMessage.style.opacity = "0";
        }, 3000);
        form.reset();
      } else {
        // Show the error popup with specific message
        errorMessage.style.opacity = "1";

        // Optionally, hide the error popup after a few seconds
        setTimeout(() => {
          errorMessage.style.opacity = "0";
        }, 3000);
      }
    })
    .catch((error) => {
      // Hide the loader
      spinner.style.opacity = "0";

      // Show the error popup for network or parsing errors
      errorMessage.style.opacity = "1";

      // Optionally, hide the error popup after a few seconds
      setTimeout(() => {
        errorMessage.style.opacity = "0";
      }, 3000);
    });
});
