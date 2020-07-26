<div class="grid-wrapper-headline">

    <h1><?php echo $product->name; ?></h1>
    
</div>

<div class="grid-wrapper">

    <div>
        <p>
            <?php echo $product->description; ?>
        </p>

        <hr>

        <p>
            <?php echo $product->full_description; ?>
        </p>

        <div class="price"><?php printf('%0.2f ,-', $product->price); ?></div>

        <form action="cart/add/<?php echo $product->id; ?>" method="post">
            <label for="quantity"> Quantitiy:
                <input id="quantity" type="number" value="1" min="1" name="quantity">
            </label>

            <button type="submit">Add to Cart</button>
        </form>

        <div>
            <a href="magazines">View all magazines</a>
        </div>
    </div>

    <div class="magazin item2">
        <?php if (!empty($product->images)): ?>
            <div>
                <?php foreach ($product->images as $image): ?>
                    <img class="magazin_cover" src="storage/<?php echo $image; ?>" alt="<?php echo $product->name; ?>" style="box-shadow: 0 3px 7px lightgray; margin-bottom: 10px; width: 100%; margin-bottom: 0.5rem;">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>    

    <span></span>

</div>