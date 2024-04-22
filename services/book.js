$(document).ready(function () {
  console.log("book.js loaded");

  // Get the ISBN from the URL fragment identifier
  var isbn = window.location.hash.split("=")[1]; // Extracts the ISBN after the '='

  console.log("ISBN from URL:", isbn);

  if (isbn != null) {
      console.log("ISBN found in URL");

      // Load JSON data for book details
      $.ajax({
          url: "backend/get_books.php", // Change to the endpoint for fetching books
          dataType: "json",
          success: function (data) {
              console.log("Data from database loaded");

              // Find the book with the matching ISBN
              var book = data.find(function (book) {
                  return book.ISBN === isbn;
              });

              if (book) {
                  console.log("Book details found:", book);

                  // Populate book details
                  $("#bookTitle").text(book.Name);
                  $("#bookImage").attr("src", book.Image);
                  $("#bookGenre").text(book.Genre);
                  $("#description").text(book.Description);
                  $("#bookPrice").text(book.Price + "KM");
                  $("#bookAuthor").text(book.Author);

                  // Construct HTML for book details
                  var bookDetailsHtml = `
                      <div class="col-md-6">
                          <ul>
                              <li>ISBN: ${book.ISBN}</li>
                              <li>Publisher: ${book.Publisher}</li>
                              <li>Publication Date: ${book.PublicationDate}</li>
                              <li>Language: ${book.Language}</li>
                              <li>Format: ${book.Format}</li>
                              <li>Page Count: ${book.PageCount}</li>
                              <li>Dimensions: ${book.Dimensions}</li>
                          </ul>
                      </div>
                  `;

                  // Append book details HTML to the container
                  $("#bookDetailsContainer").html(bookDetailsHtml);
              } else {
                  console.error("Book not found");
              }
          },
          error: function (jqXHR, textStatus, errorThrown) {
              console.log("Error: " + textStatus + " " + errorThrown);
          }
      });
  } else {
      console.error("ISBN not found in URL");
  }

  $(".nav-link").on("click", function () {
      // Hide all tab panes
      $(".tab-pane").hide();

      // Deactivate all navigation buttons
      $(".nav-link").removeClass("active");

      // Activate the clicked navigation button
      $(this).addClass("active");

      // Show the corresponding tab pane
      var targetId = $(this).attr("aria-controls");
      $("#" + targetId).show();
  });
});

var BookService = {
  reload_book_datatable: function () {}
}
