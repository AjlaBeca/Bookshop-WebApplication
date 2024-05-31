var Constants = {
    get_api_base_url: function () {
      if (location.hostname == "localhost") {
        return "http://localhost/webprogramming_bookshop/backend/";
      } else {
        return "";
      }
    },
  };