$(document).ready(function () {
  // Fetch book data from JSON file and populate the slider
  fetch("assets/books.json")
    .then((response) => response.json())
    .then((data) => {
      var mainSlider = $(".main-slider");

      // Select only the first two books
      var booksToShow = data.slice(7, 9);

      booksToShow.forEach(function (book) {
        var sliderItem = $('<div class="slider-item">');
        var bannerContent = $('<div class="banner-content">');
        var bannerTitle = $('<h2 class="banner-title">').text(book.name);
        var bannerText = $('<p class="products-content">').text(
          book.description
        );
        var btnWrap = $('<div class="btn-wrap">');
        var btnLink = $(
          '<a href="book.html?isbn=' +
            book.isbn +
            '" class="btn btn-outline-accent btn-accent-arrow">'
        ).text("Read More");
        var arrowIcon = $('<i class="icon icon-ns-arrow-right"></i>');
        var bannerImage = $("<img>")
          .attr("src", book.image)
          .attr("alt", book.name)
          .addClass("banner-image");

        btnLink.append(arrowIcon);
        btnWrap.append(btnLink);
        bannerContent.append(bannerTitle, bannerText, btnWrap);
        sliderItem.append(bannerContent, bannerImage);
        sliderItem.data("isbn", book.isbn); // Attach ISBN data to slider item
        mainSlider.append(sliderItem);
      });

      // Initialize Slick slider
      mainSlider.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000, // Adjust speed as needed
        prevArrow: $(".prev"),
        nextArrow: $(".next"),
        dots: true, // If you want to add dots for navigation
      });

      // Populate the best selling book section with book data
      var bestSellingBook = data[6];
      $(".products-thumb img")
        .attr("src", bestSellingBook.image)
        .attr("alt", bestSellingBook.name);
      $(".author-name").text("By " + bestSellingBook.author);
      $(".item-title").text(bestSellingBook.name);
      $(".item-description").text(bestSellingBook.description);
      $(".item-price").text(bestSellingBook.price + "KM");

      // Navigate to book details page when "Read More" button in slider is clicked
      $(".main-slider .btn-wrap a").on("click", function (e) {
        e.preventDefault(); // Prevent default link behavior
        var isbn = $(this).closest(".slider-item").data("isbn");
        window.location.href = "#book?isbn=" + isbn;
      });

      // Navigate to book details page when "See it now" button in best selling section is clicked
      $("#best-selling .btn-wrap a").on("click", function (e) {
        e.preventDefault(); // Prevent default link behavior
        var isbn = bestSellingBook.isbn; // Using ISBN of best selling book
        window.location.href = "#book?isbn=" + isbn;
      });
    });
});
