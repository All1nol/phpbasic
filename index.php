<?php 

$pdo = new PDO('mysql:host=localhost; port=3306;dbname=products_crude', 'root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );


$search =$_GET['search'] ?? '';
if ($search) {
  $statament = $pdo->prepare('SELECT * FROM products WHERE title like :title ORDER BY   create_date Desc');
  $statament->bindValue(':title',"%$search%");
}
else{
$statament = $pdo->prepare('SELECT * FROM products ORDER BY  create_date Desc');

}

$statament->execute();
$products = $statament->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="edit.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <title>Products Crud</title>
  </head>
  <body>
    <h1>Products Crud</h1>

  <p>
    <a href="create.php" class="btn btn-success">Create Product</a>
  </p>

<form >
  <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Search Product" name="search" value=" <?php  echo $search ?>">
    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
  </div>
</form>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Create Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

<?php  foreach ($products as $i=> $product) {?>
  <tr>
    <th scope="row"> <?php echo $i +1?> </th>
    <td>
      <img src=" <?php echo $product['image'] ?>" class="img" >
    </td>
    <td> <?php  echo $product['title'] ?> </td>
    <td> <?php  echo $product['price'] ?> </td>
    <td> <?php  echo $product['create_date'] ?> </td>
    <td>
    <a href="update.php?id=<?php echo $product['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
    <form style="display: inline-block ;" action="delete.php" method="post">
      <input  type="hidden" name="id" value=" <?php echo $product['id'] ?>">
      <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
    </form>
    </td>
  </tr>
  <?php } ?>

  </tbody>
</table>
  </body>
</html>