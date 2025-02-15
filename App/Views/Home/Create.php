<?php
namespace App\Views\Home;

class Create
{
    public static function render($data = null)
    {
        ?>
        <form action="/property/store" method="post" enctype="multipart/form-data">
            <div class="container my-5">
                <div class="row">
                    <div class="col-xl-9">
                        <div class="card">
                            <div class="card-header">
                                <h3>Create</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-primary" role="alert">
                                    <strong>Note:</strong> <span class="text-danger">(*)</span> is a required field.
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label for="">Building name: <span class="text-danger">(*)</span></label>
                                        <input type="text" name="title" maxlength="50" pattern="[A-Za-z0-9]+" id="title"
                                            class="form-control" placeholder="..." required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">City: <span class="text-danger">(*)</span></label>
                                        <!-- <input type="text" name="city" id="city" class="form-control"
                                            placeholder="..." required> -->
                                        <select name="city" id="city" class="form-control" required>
                                            <option value="">--Select city--</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Address: <span class="text-danger">(*)</span></label><input type="text"
                                            name="address" id="address" class="form-control" placeholder="..." required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Description: <span class="text-danger">(*)</span></label><input
                                            type="text" name="description" id="description" class="form-control"
                                            placeholder="..." required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label for="">Price/Month: <span class="text-danger">(*)</span></label><input
                                            type="text" name="price" id="numberInput" class="form-control" placeholder="..."
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 bg-light p-3 rounded h-100">
                        <div class="my-4">
                            <label for="">Image:</label>
                            <div class="d-flex justify-content-center">
                                <input type="file" name="image" id="image">
                            </div>
                        </div>
                        <div class="my-4">
                            <label for="">Status:</label>
                            <select name="status" id="status" class="form-select">
                                <option value="available">available</option>
                                <option value="sold">sold</option>
                                <option value="rented">rented</option>
                            </select>
                        </div>
                        <div class="btn-control d-flex justify-content-center gap-3">
                            <button type="submit" name="store" class="store btn btn-primary w-50">Create</button>
                            <a class="btn btn-danger w-50" href="/">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
}
?>