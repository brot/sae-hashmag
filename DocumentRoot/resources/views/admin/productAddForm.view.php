<div class="grid-wrapper-headline">

    <h1>New product:</h1>

</div>

<div class="grid-wrapper">

    <div> 

        <?php foreach ($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>

        <form action="dashboard/products/do-add" method="post" enctype="multipart/form-data">

            <div>
                <label for="name">Name</label>
                <input id="name" type="text" name="name" placeholder="Magazin #..">
            </div>

            <div>
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5" placeholder="In this issue we cover the following topics ..."></textarea>
            </div>

            <div>
                <div>
                    <label for="price">Price</label>
                    <input id="price" type="number" name="price" step="0.01" placeholder="15">
                </div>

                <div>
                    <label for="stock">Stock</label>
                    <input id="stock" type="number" name="stock" placeholder="5">
                </div>
            </div>

            <div>
                <div>
                    <label for="images[]">Add Images</label>
                    <input id="images[]" type="file" name="images[]" multiple>
                </div>


                <div>
                    <p id="images_p">Images</p>
                    <?php if (!empty($product->images)): ?>
                        <div>
                            <?php foreach ($product->images as $image): ?>
                                <div>
                                    <input id="delete-images" type="checkbox" name="delete-images[<?php echo $image; ?>]">
                                    <img src="storage/<?php echo $image; ?>" width="50" height="auto">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>
                            You haven't uploaded an image yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <a class="button_cancel" href="dashboard">Cancel</a>

            <button type="submit">Save</button>

        </form>
    </div>
    
    <div></div>
</div>
