<?php require base_path('views/layout/header.php'); ?>

<div class="m-2">
    <div class="m-2 d-flex justify-content-between border-bottom border-dark bg-light fixed-top mb-auto">
        <h1>Product list</h1>
        <div>
            <a href="/add-product" class="btn btn-primary">ADD</a>
            <button id="delete-product-btn" type="submit" form="delete-products" class="btn btn-danger">MASS DELETE</button>
        </div>
    </div>
    <div class="album py-5 bg-light mt-5">
        <div class="container">
            <form id="delete-products" action="/delete-products" method="POST">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
                    <?php foreach ($products as $product) : ?>
                        <div class="col">
                            <div class="card  shadow p-3  rounded">
                                <div class="card-body">
                                    <div class="form-check">
                                        <input class="form-check-input delete-checkbox" type="checkbox" name="productIds[]"
                                               value="<?= $product['id'] ?>" id="flexCheckDefault">
                                    </div>
                                    <div class="text-center">
                                        <p class="card-text"><?= $product['sku'] ?></p>
                                        <p class="card-text"><?= $product['name'] ?></p>
                                        <p class="card-text"><?= $product['price'] ?></p>
                                        <p class="card-text">
                                            <?php
                                            if ($product['productType'] === 'DVD') {
                                                echo "Size: {$product['size']} MB";
                                            } elseif ($product['productType'] === 'Book') {
                                                echo "Weight: {$product['weight']} KG";
                                            } elseif ($product['productType'] === 'Furniture') {
                                                echo "Dimensions: {$product['height']}x{$product['width']}x{$product['length']}";
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require base_path('views/layout/footer.php'); ?>
