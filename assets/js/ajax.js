var currentPage = window.location.hash.substring(1); // Remove the "#" from the hash

function loadBooks() {
  // Clear the books container
  //$('#booksContainer').empty();

  // Get the page identifier from the URL hash
  console.log("Current page:", currentPage);

  // Load JSON data
  if (currentPage !== "book") {
    $.ajax({
      url: "assets/books.json",
      dataType: "json",
      success: function (data) {
        console.log("JSON data loaded:", data);
        // Reverse the array to display the newest books first
        data.reverse();

        // Filter books based on the current page
        var filteredBooks = data.filter(function (book) {
          if (currentPage === "new") {
            return book.tag.includes("new");
          } else if (currentPage === "featured") {
            return book.tag.includes("featured");
          } else if (currentPage === "home") {
            return book.tag.includes("main");
          } else if (currentPage === "books") {
            return true;
          }
        });

        console.log("Filtered books:", filteredBooks);

        // Limit to 8 books if the page is new or featured
        if (currentPage === "new" || currentPage === "featured") {
          filteredBooks = filteredBooks.slice(0, 8);
        }

        // Iterate through the filtered array of books
        filteredBooks.forEach(function (book) {
          var bookHtml = `
          <div class="col-md-3 col-sm-6 col-6" id="${book.isbn}">
              <div class="product-item">
                  <figure class="product-style">
                      <img src="${book.image}" alt="Book Image" class="product-item">
                  </figure>
                  <figcaption>
                      <h3>${book.name}</h3>
                      <span>${book.author}</span>
                      <div class="item-price">${book.price}KM</div>
                  </figcaption>
              </div>
          </div>
      `;

          // Append the book HTML to the books container
          $("#booksContainer").append(bookHtml);

          $("#" + book.isbn).on("click", function () {
            console.log("Book clicked:", book);
            var url = "index.html#book?isbn=" + book.isbn;
            console.log("Navigating to:", url);
            window.location.href = url;
          });

          console.log("Book loaded");
        });
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + textStatus + " " + errorThrown);
      },
    });
  }
}

// Run loadBooks when the page loads
if (
  currentPage == "home" ||
  currentPage == "new" ||
  currentPage == "featured" ||
  currentPage == "books"
) {
  $(document).ready(loadBooks);
}

// Refresh the page when the hash changes, except when on the account page
$(window).on("hashchange", function () {
  location.reload();
});
