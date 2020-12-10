<h1 class="header header--main"><?php print $data['title']; ?></h1>
<h3 class="header"><?php print $data['heading']; ?></h3>
<section class="grid-container">

    <?php foreach ($data['products'] as $product) : ?>
        <?php if (App\App::$session->getUser()): ?>

            <?php if (App\App::$session->getUser()['role'] === 'user') : ?>

                <div class="grid-item">
                    <h4><?php print $product['name']; ?></h4>
                    <img class="product-img" src="<?php print $product['img']; ?>" alt="">
                    <p><?php print $product['price']; ?> $</p>

                    <form method="POST">
                        <input type="hidden" name="id" value="ORDER">
                        <input type="hidden" name="name" value="<?php print $product['name']; ?>">
                        <button type="submit">Order</button>
                    </form>

                </div>
            <?php elseif (App\App::$session->getUser()['role'] === 'admin') : ?>

                <div class="grid-item">
                    <h4><?php print $product['name']; ?></h4>
                    <img class="product-img" src="<?php print $product['img']; ?>" alt="">
                    <p><?php print $product['price']; ?> $</p>


                </div>
            <?php endif; ?>

        <?php else: ?>

            <div class="grid-item">
                <h4><?php print $product['name']; ?></h4>
                <img class="product-img" src="<?php print $product['img']; ?>" alt="">
                <p><?php print $product['price']; ?> $</p>

            </div>

        <?php endif; ?>
    <?php endforeach; ?>

</section>
