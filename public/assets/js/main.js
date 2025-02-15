(function ($) {
  "use strict";
  const Cus = {};
  Cus.showAction = () => {
    $(document).on("click", "#actionTrigger", function () {
      let _this = $(this);
      var id = _this.data("id");
      var status = _this.data("status");
      $(`#customAction-${id}`).toggleClass('d-none', status !== 'hide');
      _this.data('status', status === 'hide' ? 'show' : 'hide');
    });
  };
  $(document).ready(function () {
    Cus.showAction();
  });
})(jQuery);
