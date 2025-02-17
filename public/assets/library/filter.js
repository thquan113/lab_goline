(function ($) {
  "use strict";
  const Pro = {};
  let condition = "";
  let timer;
  Pro.search = () => {
    $(document).on("input", "#searchInput", function () {
      clearTimeout(timer);
      let _this = $(this);
      var keyword = _this.val();
      if (keyword == "") {
        $("#resultSearch").removeClass("p-3");
        $("#resultSearch").html("");
      } else {
        const url = `/search`;
        timer = setTimeout(function () {
          $.ajax({
            type: "GET",
            url: url,
            data: {
              keyword,
            },
            success: function (e) {
              let data = JSON.parse(e);
              $("#resultSearch").addClass("p-3");
              if (data.length > 0) {
                Pro.resultSearch(data);
              } else {
                $("#resultSearch").html(
                  `<div class="bg-light p-2">No results found</div>`
                );
              }
            },
            error: function (xhr, status, error) {
              console.error(error);
            },
          });
        }, 1000);
      }
    });
  };

  Pro.resultSearch = (data) => {
    $("#resultSearch").html(
      `<tr>
            <td colspan="100%" class="text-center">
                <div class="spinner-border text-primary" role="status">
                </div>
            </td>
        </tr>`
    );
    let result = "";
    data.forEach((e) => {
      result += ` <a href="/property/edit/${e.id}">
        <div class="row border-bottom pb-2">
          <div class="col-2"><img class="w-100" src="${e.image}" alt=""></div>
          <div class="col-7">
            <p class="fw-bold m-0">${e.title}</p>
            <p class="m-0">${e.description}</p>
          </div>
          <div class="col-3 text-muted">Detail</div>
        </div></a>`;
    });
    $("#resultSearch").html(result);
  };

  Pro.renderPerPage = (values = null) => {
    $("#tbody").html(
      `<tr>
            <td colspan="100%" class="text-center">
                <div class="spinner-border text-primary" role="status">
                </div>
            </td>
        </tr>`
    );
    var tbody = "";
    values.forEach((element) => {
      tbody += `
            <tr>
                <td>
                    <img decoding="async" src="${
                      element.image
                    }" alt="" width="100" class="m-3">
                </td>
                <td>
                    <p class="fw-bold">${element.title}</p>
                    <p>
                        ID: ${element.id} / ${element.address} / ${
        element.city
      } / ${element.description}
                    </p>
                </td>
                <td>
                        <span>${
                          element.price == 0 ? "" : element.price + "/Month"
                        }</span>
                </td>
                <td><span class="badge rounded-pill bg-success">${
                  element.status
                }</span></td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                        <div class="action-container">
                       <i class="bi bi-three-dots-vertical text-primary" id="actionTrigger" data-status="hide" data-id="${
                         element.id
                       }"></i>
                          <div id="customAction-${
                            element.id
                          }" class="position-absolute action-content d-flex flex-column d-none bg-light p-1 gap-2">
                            <a href="/property/edit/${
                              element.id
                            }" id="editAction" class="btn btn-sm btn-secondary">Edit</a>
                            <button id="removeAction" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#removeModal">Remove</button>
                                                          
                   </div>
                 </div> <div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="removeModalLabel" aria-hidden="true">
                         <div class="modal-dialog">
                           <div class="modal-content">
                             <div class="modal-body">
                               Remove the property?
                             </div>
                             <div class="modal-footer">
                               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                   <form action="/property/remove/${
                                     element.id
                                   }" method="POST">
                                   <input type="hidden" name="_method" value="DELETE">
                                   <input type="hidden" name="id" value="${
                                     element.id
                                   }">
                                     <button type="submit" class="btn btn-danger">Remove</button>
                                   </form>
                             </div>
                           </div>
                         </div>
                       </div>
                </td>
            </tr>`;
    });
    $("#tbody").html(tbody);
  };

  Pro.renderPages = (total_data, limit) => {
    if (total_data) {
      $("#countProduct").html(total_data);
      const urlParams = new URLSearchParams(window.location.search);
      const page = urlParams.get("page") || 1;
      var paginate = "";
      var total_perpages = Math.ceil(total_data / limit);
      for (let i = 0; i < total_perpages; i++) {
        paginate += `<p class="page-item btn btn-${
          page == i + 1 ? "" : "outline-"
        }primary " data-page="${i + 1}">${i + 1}</p>`;
      }
      $("#paginate").html(paginate);
    }
  };

  Pro.pageChange = () => {
    $(document).on("click", ".page-item", function () {
      const page = $(this).data("page");
      const url = new URL(window.location.href);
      url.searchParams.set("page", page);
      history.pushState({}, "", url.toString());
      Pro.filterData(condition);
    });
  };

  Pro.filter = () => {
    $(document).on("change", "#sortBy", function () {
      let _this = $(this);
      var methood = _this.val();
      const url = new URL(window.location.href);
      url.searchParams.set("sortBy", methood);
      history.pushState({}, "", url.toString());
      Pro.filterData();
    });
  };
  Pro.filterData = () => {
    const urlParams = new URLSearchParams(window.location.search);
    const url = new URL(window.location.href);
    const page = urlParams.get("page") || 1;
    const methood = urlParams.get("sortBy") || null;
    condition = methood == null ? "created_at,desc" : methood;
    if (condition) {
      $.ajax({
        type: "GET",
        url: `/filter`,
        data: {
          methood: condition,
          page: page,
        },
        success: function (e) {
          const data = JSON.parse(e);
          if (data.countData == 0) {
            $("#paginate").html(``);
            $("#tbody").html(
              `<tr>
                    <td colspan="100%" class="text-center">
                        No results found
                    </td>
                </tr>`
            );
          } else {
            if (data.data.length == 0) {
              url.searchParams.set("page", 1);
              history.pushState({}, "", url.toString());
              Pro.filterData();
            }
            Pro.renderPerPage(data.data);
            Pro.renderPages(data.countData, data.limit);
          }
        },
        error: function (xhr, status, error) {
          console.error(error);
        },
      });
    }
  };
  $(document).ready(function () {
    Pro.search();
    Pro.filterData();
    Pro.pageChange();
    Pro.filter();
  });
})(jQuery);
