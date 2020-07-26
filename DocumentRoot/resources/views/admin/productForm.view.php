
<div class="grid-wrapper-headline">

    <h1>Item: <?php echo $product->name; ?></h1>

</div>

<div class="grid-wrapper">

    <div> 
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>

        <form action="products/<?php echo $product->id; ?>/do-edit" method="post" enctype="multipart/form-data">

            <div>
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="<?php echo $product->name; ?>">
            </div>

            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="5"><?php echo $product->description; ?></textarea>
            </div>

            <div>
                <label for="full_description">Full Description</label>
                <textarea class="full_description" name="full_description" id="full_description" rows="5"><?php echo $product->full_description; ?></textarea>
            </div>

            <div>
                <div>
                    <label for="price">Price</label>
                    <input id="price" type="number" name="price" step="0.01" value="<?php echo $product->getPriceFloat(); ?>">
                </div>

                <div>
                    <label for="stock">Stock</label>
                    <input id="stock" type="number" name="stock" value="<?php echo $product->stock; ?>">
                </div>
            </div>

            <div class="container_image">
                <div>
                    <label for="images[]">Add Images</label>
                    <input id="images[]" type="file" name="images[]" multiple>
                </div>


                <div class="label_img" >
                    <?php if (!empty($product->images)): ?>
                        <div>
                            <?php foreach ($product->images as $image): ?>
                                <div>
                                    <label for="delete-images">Delete Images</label><br>                           
                                    <input id="delete-images" type="checkbox" name="delete-images[<?php echo $image; ?>]">
                                    <img alt="Cover of current hash magazine issue" class="delete_img" src="storage/<?php echo $image; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>You haven't uploaded an image yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <a class="button_cancel" href="dashboard">Cancel</a>

            <button type="submit">Save</button>

        </form>

    </div>

    <div></div>

</div>