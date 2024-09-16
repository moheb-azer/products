<?php require base_path('views/layout/header.php'); ?>

<div class="m-2">
    <div class="m-2 d-flex justify-content-between border-bottom border-dark">
        <h1>Product Add</h1>
        <div>
            <button id="saveBtn" type="submit" class="btn btn-primary" form="product_form">Save</button>
            <button id="cancelBtn" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
<!--    <div id="errorMessages" class="text-danger"></div>-->
    <?php if (isset($errors['save_error'])): ?>
        <div class="error">
            <p><?= htmlspecialchars($errors['save_error']) ?></p>
        </div>
    <?php endif; ?>
    <div>

        <form id="product_form" name="product_form" method="POST" action="/add-product">
            <!-- SKU Field -->
            <div class="mb-3">
                <div class="row g-3 align-items-center">
                    <div class="col-1">
                        <label for="sku" class="form-label">SKU</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" class="form-control" id="sku" name="sku" value="<?= $_POST['sku'] ?? '' ?>">
                        <?php if (isset($errors['sku'])): ?>
                            <span class="text-danger">*<?= $errors['sku'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Name Field -->
            <div class="mb-3">
                <div class="row g-3 align-items-center">
                    <div class="col-1">
                        <label for="name" class="form-label">Name</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $_POST['name'] ?? '' ?>">
                        <?php if (isset($errors['name'])): ?>
                            <span class="text-danger">*<?= $errors['name'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Price Field -->
            <div class="mb-3">
                <div class="row g-3 align-items-center">
                    <div class="col-1">
                        <label for="price" class="form-label">Price ($)</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" class="form-control" id="price" name="price" value="<?= $_POST['price'] ?? '' ?>">
                        <?php if (isset($errors['price'])): ?>
                            <span class="text-danger">*<?= $errors['price'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Product Type Switcher -->
            <div class="mb-3">
                <div class="row g-3 align-items-center">
                    <div class="col-1">
                        <label for="productType" class="form-label">Product Type</label>
                    </div>
                    <div class="col-auto">
                        <select class="form-select" id="productType" name="productType">
                            <option value="" selected>Select Type</option>
                            <?php foreach ($productTypes as $productType) : ?>
                                <option value="<?= $productType ?>"
                                    <?= $_POST['productType']==$productType?'selected':''?> >
                                    <?= $productType ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['productType'])): ?>
                            <span class="text-danger">*<?= $errors['productType'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- DVD Fields -->
            <div id="dvdFields" class="mb-3" style="display: none;">
                <div class="row g-3 align-items-center" >
                    <div class="col-1">
                        <label for="size" class="form-label">Size (MB)</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" class="form-control" id="size" name="size" value="<?= $_POST['size'] ?? '' ?>">
                        <?php if (isset($errors['size'])): ?>
                            <span class="text-danger">*<?= $errors['size'] ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-auto">
                        <small class="form-text text-muted">Please, provide size of the DVD in MBs</small>
                    </div>
                </div>
            </div>

            <!-- Furniture Fields -->
            <div id="furnitureFields" class="mb-3" style="display: none;">
                <div class="row g-3 align-items-center">
                    <div class="col-1">
                        <label for="height" class="form-label">Height (CM)</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" class="form-control" id="height" name="height" value="<?= $_POST['height'] ?? '' ?>">
                        <?php if (isset($errors['height'])): ?>
                            <span class="text-danger">*<?= $errors['height'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="col-1">
                        <label for="width" class="form-label">Width (CM)</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" class="form-control" id="width" name="width" value="<?= $_POST['width'] ?? '' ?>">
                        <?php if (isset($errors['width'])): ?>
                            <span class="text-danger">*<?= $errors['width'] ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row g-3 align-items-center">
                    <div class="col-1">
                        <label for="length" class="form-label">Length (CM)</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" class="form-control" id="length" name="length" value="<?= $_POST['length'] ?? '' ?>">
                        <?php if (isset($errors['length'])): ?>
                            <span class="text-danger">*<?= $errors['length'] ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-auto">
                        <small class="form-text text-muted">Please, provide dimensions of the furniture (HxWxL) in
                            cm</small>
                    </div>
                </div>
            </div>

            <!-- Book Fields -->
            <div id="bookFields" class="mb-3" style="display: none;">
                <div class="row g-3 align-items-center">
                    <div class="col-1">
                        <label for="weight" class="form-label">Weight (KG)</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" class="form-control" id="weight" name="weight" value="<?= $_POST['weight'] ?? '' ?>">
                        <?php if (isset($errors['weight'])): ?>
                            <span class="text-danger">*<?= $errors['weight'] ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-auto">
                        <small class="form-text text-muted">Please, provide weight of the book in KG</small>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- jQuery and JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Dynamically show fields based on product type
        let productType = $('#productType');
        const dvd = $('#dvdFields');
        const furniture =$('#furnitureFields');
        const book =$('#bookFields');
        if (productType.val() === 'DVD') {
            dvd.show();
        } else if (productType.val()  === 'Furniture') {
            furniture.show();
        } else if (productType.val()  === 'Book') {
            book.show();
        }else {
            dvd.hide();
            furniture.hide();
            book.hide()
        }
        productType.on('change', function () {
            productType = $(this).val();
            // Hide all special fields
            dvd.hide();
            furniture.hide();
            book.hide();
            // Show relevant fields based on product type
            if (productType === 'DVD') {
                dvd.show();
            } else if (productType === 'Furniture') {
                furniture.show();
            } else if (productType === 'Book') {
                book.show();
            }
        });

        // Handle form submission with client side validations

        // $('#saveBtn').on('click', function (event) {
        //     event.preventDefault();
        //     const errors = [];
        //     const productType = $('#productType').val();
        //     const sku = $('#sku').val();
        //     const name = $('#name').val();
        //     const price = $('#price').val();
        //
        //     // Clear previous errors
        //     $('#errorMessages').html('');
        //
        //     // Validate required fields
        //     if (!sku || !name || !price || !productType) {
        //         errors.push("Please, submit required data.");
        //     }
        //
        //     // Product type-specific validation
        //     if (productType === 'DVD' && !$('#size').val()) {
        //         // errors.push("Please, provide the DVD size MB.");
        //         errors.push("Please, provide the data of indicated type");
        //     } else if (productType === 'Furniture' && (!$('#height').val() || !$('#width').val() || !$('#length').val())) {
        //         // errors.push("Please, provide dimensions (HxWxL).");
        //         errors.push("Please, provide the data of indicated type");
        //     } else if (productType === 'Book' && !$('#weight').val()) {
        //         // errors.push("Please, provide the book weight in KG.");
        //         errors.push("Please, provide the data of indicated type");
        //     }
        //
        //     // If errors exist, display them
        //     if (errors.length > 0) {
        //         $('#errorMessages').html(errors.join('<br>'));
        //     } else {
        //         // Simulate SKU uniqueness check and form submission (typically server-side)
        //         // For now, simulate success by redirecting
        //         // window.location.href = '/';
        //         $('#product_form').submit();
        //     }
        // });

        // Handle Cancel button
        $('#cancelBtn').on('click', function (event) {
            event.preventDefault();
            // Simulate cancel action (redirect to product list)
            window.location.href = '/';
        });
    });
</script>

<?php require base_path('views/layout/footer.php'); ?>
