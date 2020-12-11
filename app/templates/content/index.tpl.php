<h1 class="header header--main"><?php print $data['title']; ?></h1>
<h3 class="header"><?php print $data['heading']; ?></h3>
<?php print $data['buttons']['login_or_create']; ?>
<?php print $data['buttons']['add_discount']; ?>

<section class="grid-container">

    <?php foreach ($data['products'] as $product) : ?>

        <div class="grid-item <?php print ($product['discount'] ?? false) ? 'discount' : ''; ?>">
            <h4><?php print $product['name']; ?></h4>

            <?php if (isset($product['discount'])): ?>

                <p class="old-price"><?php print $product['price_diff']; ?></p>

            <?php endif; ?>

            <img class="product-img" src="<?php print $product['img']; ?>" alt="">
            <p><?php print $product['price']; ?></p>
            <?php print ($product['order'] ?? false) ? $product['order'] : ''; ?>
            <?php print ($product['link'] ?? false) ? $product['link'] : ''; ?>
            <?php print ($product['delete'] ?? false) ? $product['delete'] : ''; ?>
        </div>

    <?php endforeach; ?>

</section>
