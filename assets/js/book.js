$(document).ready(function () {
  console.log("book.js loaded");

  // Get the ISBN from the URL fragment identifier
  var isbn = window.location.hash.split("=")[1]; // Extracts the ISBN after the '='

  console.log("ISBN from URL:", isbn);

  if (isbn != null) {
    console.log("ISBN found in URL");

    // Load JSON data for book details
    $.getJSON("assets/books.json", function (data) {
      console.log("JSON data loaded");

      // Find the book with the matching ISBN
      var book = data.find(function (book) {
        return book.isbn === isbn;
      });

      if (book) {
        console.log("Book details found:", book);

        // Populate book details
        $("#bookTitle").text(book.name);
        $("#bookImage").attr("src", book.image);
        $("#bookGenre").text(book.genre);
        $("#description").text(book.description);
        $("#bookPrice").text(book.price+ "KM");
        $("#bookAuthor").text(book.author);

        // Construct HTML for book details
        var bookDetailsHtml = `
                  <div class="col-md-6">
                      <ul>
                          <li>ISBN: ${book.isbn}</li>
                          <li>Publisher: ${book.publisher}</li>
                          <li>Publication Date: ${book.publicationDate}</li>
                          <li>Language: ${book.language}</li>
                          <li>Format: ${book.format}</li>
                          <li>Page Count: ${book.pageCount}</li>
                          <li>Dimensions: ${book.dimensions}</li>
                      </ul>
                  </div>
              `;

        // Append book details HTML to the container
        $("#bookDetailsContainer").html(bookDetailsHtml);
      } else {
        console.error("Book not found");
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
