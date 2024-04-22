(function ($) {
  "use strict";

  $(document).ready(function () {

    /*
    const tabs = document.querySelectorAll("[data-tab-target]");
    const tabContents = document.querySelectorAll("[data-tab-content]");

    tabs.forEach((tab) => {
      tab.addEventListener("click", () => {
        const target = document.querySelector(tab.dataset.tabTarget);
        tabContents.forEach((tabContent) => {
          tabContent.classList.remove("active");
        });
        tabs.forEach((tab) => {
          tab.classList.remove("active");
        });
        tab.classList.add("active");
        target.classList.add("active");
      });
    });

    // Add functionality for switching between "Sign Up" and "Log In" sections
    const signInLink = document.querySelector("#sign-in-link");
    const signUpLink = document.querySelector("#sign-up-link");
    const signInSection = document.getElementById("nav-sign-in");
    const signUpSection = document.getElementById("nav-register");

    signInLink.addEventListener("click", () => {
      signInSection.classList.add("show", "active");
      signUpSection.classList.remove("show", "active");
    });

    signUpLink.addEventListener("click", () => {
      signUpSection.classList.add("show", "active");
      signInSection.classList.remove("show", "active");
    });*/

    function updateActiveNavLink() {
        // Get the id of the currently visible section
        var activeSectionId = $('#spapp > section:visible').attr('id');

        // Remove active class from all nav links
        $('.nav-link').removeClass('active');

        // Add active class to the nav link corresponding to the active section
        $('.nav-link[href="#' + activeSectionId + '"]').addClass('active');
    }

    // Update active state of nav links whenever a new section is loaded
    $('#spapp > section').on('load', updateActiveNavLink);

    // Update active state of nav links on page load
    updateActiveNavLink();

    // Responsive Navigation with Button
    const hamburger = document.querySelector(".hamburger");
    const navMenu = document.querySelector(".menu-list");

    hamburger.addEventListener("click", mobileMenu);

    function mobileMenu() {
      hamburger.classList.toggle("active");
      navMenu.classList.toggle("responsive");
    }

    const navLink = document.querySelectorAll(".nav-link");

    navLink.forEach((n) => n.addEventListener("click", closeMenu));

    function closeMenu() {
      hamburger.classList.remove("active");
      navMenu.classList.remove("responsive");
    }

    var initScrollNav = function () {
      var scroll = $(window).scrollTop();

      if (scroll >= 200) {
        $("#header").addClass("fixed-top");
      } else {
        $("#header").removeClass("fixed-top");
      }
    };
    var windowElement = $(window)[0];

    windowElement.addEventListener('scroll', function() {
      initScrollNav();
    }, { passive: true });

    initScrollNav();

    Chocolat(document.querySelectorAll(".image-link"), {
      imageSize: "contain",
      loop: true,
    });

    $("#header-wrap").on("click", ".search-toggle", function (e) {
      var selector = $(this).data("selector");

      $(selector).toggleClass("show").find(".search-input").focus();
      $(this).toggleClass("active");

      e.preventDefault();
    });

    // close when click off of container
    $(document).on("click touchstart", function (e) {
      if (
        !$(e.target).is(
          ".search-toggle, .search-toggle *, #header-wrap, #header-wrap *"
        )
      ) {
        $(".search-toggle").removeClass("active");
        $("#header-wrap").removeClass("show");
      }
    });

    $(".product-grid").slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 2000,
      dots: true,
      arrows: false,
      responsive: [
        {
          breakpoint: 1400,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 999,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 660,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });

    //search functionality, if i put in isbn it will redirect me to the book page with that isbn :))

    $('.search-box').on('submit', function(e) {
      e.preventDefault(); // Prevent default form submission

      // Get the entered ISBN from the search input field
      var isbn = $('.search-input').val();

      // Construct the URL with the ISBN and navigate to it
      var url = '#book?isbn=' + isbn;
      window.location.href = url;
  });

    AOS.init({
      duration: 1200,
      once: true,
    });

    jQuery(".stellarnav").stellarNav({
      theme: "plain",
      closingDelay: 250,
      mobileMode: false,
    });
  }); 


  
})(jQuery);
