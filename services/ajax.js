var currentPage = window.location.hash.substring(1); // Remove the "#" from the hash

function loadBooks() {
    // Clear the books container
    $('#booksContainer').empty();

    // Get the page identifier from the URL hash
    var currentPage = window.location.hash.substring(1); // Remove the "#" from the hash

    // Load data from the database
    if (currentPage !== "book") {
        $.ajax({
            url: "backend/books", // Change to the endpoint for fetching books with tags
            dataType: "json",
            headers: {
                "Content-Type": "application/json",
                'Authentication': JSON.parse(localStorage.getItem("user")).token
            },
            success: function (data) {
                console.log("Data loaded from database:", data);

                // Filter books based on the current page
                var filteredBooks = data.filter(function (book) {
                    if (!book.Tags) return false; // Check if tags exist
                    if (currentPage === "new") {
                        return book.Tags.includes("new");
                    } else if (currentPage === "featured") {
                        return book.Tags.includes("featured");
                    } else if (currentPage === "home") {
                        return book.Tags.includes("main");
                    } else if (currentPage === "books") {
                        return true;
                    }
                });

                // Limit to 8 books if the page is new or featured
                if (currentPage === "new" || currentPage === "featured") {
                    filteredBooks = filteredBooks.slice(0, 8);
                }

                // Iterate through the filtered array of books
                filteredBooks.forEach(function (book) {
                    var bookHtml = `
                        <div class="col-md-3 col-sm-6 col-6" id="${book.ISBN}">
                            <div class="product-item">
                                <figure class="product-style">
                                    <img src="${book.Image}" alt="Book Image" class="product-item">
                                </figure>
                                <figcaption>
                                    <h3>${book.Name}</h3>
                                    <span>${book.Author}</span>
                                    <div class="item-price">${book.Price}KM</div>
                                </figcaption>
                            </div>
                        </div>
                    `;

                    // Append the book HTML to the books container
                    $("#booksContainer").append(bookHtml);

                    $("#" + book.ISBN).on("click", function () {
                        console.log("Book clicked:", book);
                        var url = "index.html#book?isbn=" + book.ISBN;
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
    //$(document).ready(loadBooks);
    loadBooks();
});
