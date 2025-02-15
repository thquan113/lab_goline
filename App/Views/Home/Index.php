<?php
namespace App\Views\Home;
use App\Views\BaseViews;
use config\general;
class Index extends BaseViews
{
  public static function render($data = null)
  {
    $config = general::filter();
    $sortBy = $config['sortBy'];
    $method = $_GET['sortBy'] ?? '';
    // parse_str($sort, $method);
    ?>
    <body>
      <div class="container w-75 mt-5 p-4 bg-light">
        <section id="goline" class="goline">
          <div class="d-flex justify-content-between align-items-center">
            <a href="#" class="text-decoration-none">
              <h1>goline</h1>
            </a>
            <a href="/property/create" class="btn btn-primary"><i class="bi bi-plus"></i>Add Product</a>
          </div>
          <div class="d-flex justify-content-between align-items-center my-3">
            <div class="text-muted d-flex align-items-center gap-2">
              <div class="w-100">Sort by: </div>
              <select name="sortBy" id="sortBy" class="form-select w-100">
                <option value="">Featured</option>
                <?php
                foreach ($sortBy as $key => $sort) {
                  foreach ($sort as $value) {
                    ?>
                    <option <?php echo $method == $value['id'] ? 'selected' : '' ?> value="<?= $value['id'] ?>"><?= "$key: " . $value['name'] ?></option>
                    <?php
                  }
                } ?>
              </select>
            </div>
            <div class="form-group col-5 position-relative">
              <input type="text" name="keyword" id="searchInput" value="" class="form-control" placeholder="Search">
              <div class="d-flex flex-column position-absolute bg-light shadow mb-5 bg-body rounded gap-3" id="resultSearch" style="z-index: 1000;">
                <!-- Render js -->
              </div>
            </div>
          </div>
          <div class="">
            <span id="countProduct" class="count-product fw-bold"><?= count($data) ?></span> products
          </div>
          <div class="table">
            <table class="table">
              <thead class="table-light">
                <tr>
                  <th>Image</th>
                  <th>ID/ building name/ address/ description</th>
                  <th class="w-25">Price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="tbody">
                <!-- Render js -->
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-center">
            <div class="d-flex gap-2" id="paginate"></div>
            <!-- Render js -->
          </div>
        </section>
      </div>
      <?php
  }
}
?>