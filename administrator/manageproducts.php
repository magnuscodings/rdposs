<?php 
include "navigation.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage product</title>
   </head>
<body style="background-color: #770E08;">
    
      <div class="container-fluid d-flex justify-content-center">
        <div class="card" style="width: 80rem;">
          <div class="card-body">
            <div class="container-fluid">
              <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success me-1" type="submit">SEARCH</button>
                <div class="cantainer">
                  <div class="container-fluid">
                    <div class="container-fluid">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        ADD PRODUCTS
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="container d-flex justify-content-center">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">ADD NEW PRODUCTS</h1>
                                    </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="container">
                                                        <div class="container mb-2">
                                                            <div class="dropdown">
                                                                <button class="btn btn-outline-secondary col-12 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-align: left;">
                                                                Category
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#">Action</a></li>
                                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="container mb-2">
                                                            <input type="text" class="form-control" id="inputPassword2" placeholder="Product Name">
                                                        </div>
                                                        <div class="container mb-2">
                                                            <input type="text" class="form-control" id="inputPassword2" placeholder="Stocks">
                                                        </div>
                                                        <div class="container mb-2">
                                                            <input type="text" class="form-control" id="inputPassword2" placeholder="Unit">
                                                        </div>
                                                        <div class="container mb-2">
                                                            <input type="text" class="form-control" id="inputPassword2" placeholder="Original Price">
                                                        </div>
                                                        <div class="container mb-2">
                                                            <input type="text" class="form-control" id="inputPassword2" placeholder="Retail Price">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="container">
                                                        <div class="container mb-2">
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Description" style="resize: none;"></textarea>
                                                        </div>
                                                        <div class="container mb-2">
                                                            <input type="text" class="form-control" id="inputPassword2" placeholder="Critical Level">
                                                        </div>
                                                        <div class="container mb-2">
                                                            <input type="text" class="form-control" id="inputPassword2" placeholder="Status">
                                                        </div>
                                                        <div class="container mb-2">
                                                            <input type="image" class="form-control" id="inputPassword2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="modal-footer">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <div class="container d-flex justify-content-center">
                                                    <button type="button" class="btn btn-danger col-10" data-bs-dismiss="modal">CANCEL</button>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="container d-flex justify-content-center">
                                                    <button type="button" class="btn btn-success col-10">SAVE</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- <button type="button" class="btn btn-primary me-1 col-2">ADD PRODUCTS</button> -->
                <button type="button" class="btn btn-danger me-1 col-2">DELETE SELECTED</button>
                <div class="container-fluid d-flex justify-content-left w-50">
                  <div class="row align-items-center">
                    <div class="col">
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          CATEGORY
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">NONE</a></li>
                          <li><a class="dropdown-item" href="#">NONE</a></li>
                          <li><a class="dropdown-item" href="#">NONE</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col">
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          10
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="#">NONE</a></li>
                          <li><a class="dropdown-item" href="#">NONE</a></li>
                          <li><a class="dropdown-item" href="#">NONE</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <div class="mb-3"></div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Product Code</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Stocks</th>
                    <th scope="col">Orignal Price</th>
                    <th scope="col">Retail Price</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Dog Cage</td>
                    <td>10</td>
                    <td>₱ 160.00</td>
                    <td>₱ 170.00</td>
                    <td>None</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Cat Litter 5kg</td>
                    <td>50</td>
                    <td>₱ 144.00</td>
                    <td>₱ 160.00</td>
                    <td>None</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Chewing toy bone -Small</td>
                    <td>10</td>
                    <td>₱ 31.50</td>
                    <td>₱ 40.00</td>
                    <td>None</td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Chicken Cage -Small</td>
                    <td>11</td>
                    <td>₱ 324.00</td>
                    <td>₱ 360.00</td>
                    <td>None</td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Dog Collar -Large</td>
                    <td>15</td>
                    <td>₱ 150.00</td>
                    <td>₱ 160.00</td>
                    <td>None</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>