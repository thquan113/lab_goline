(function ($) {
  "use strict";
  const Api = {};
  Api.getLocation = () => {
    fetch("https://provinces.open-api.vn/api/p/")
      .then((response) => response.json())
      .then((data) => {
        data.forEach((e) => {
          $("#city").append(`<option value="${e.name}">${e.name}</option>`);
        });
      })
      .catch((error) => console.error("Lỗi:", error));
  };
 
  $(document).ready(function () {
    Api.getLocation();
  });
})(jQuery);
