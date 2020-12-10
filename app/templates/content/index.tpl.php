<h1 class="header header--main"><?php print $data['title']; ?></h1>
<h3 class="header"><?php print $data['heading']; ?></h3>
<?php print $data['redirect']; ?>
<section class="grid-container">

    <?php foreach ($data['products'] as $product) : ?>
        <div class="grid-item">
            <h4><?php print $product['name']; ?></h4>
            <img class="product-img" src="<?php print $product['img']; ?>" alt="">
            <p><?php print $product['price']; ?> $</p>
            <?php if (App\App::$session->getUser()): ?>
                <?php print $product['order']; ?>
                <?php print $product['link']; ?>
                <?php print $product['delete']; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</section>
