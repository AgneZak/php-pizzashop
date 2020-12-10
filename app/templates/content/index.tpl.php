<h1 class="header header--main"><?php print $data['title']; ?></h1>
<h3 class="header"><?php print $data['heading']; ?></h3>

<?php if (!App\App::$session->getUser()): ?>
    <form method="POST" action="/login">
        <button>Login</button>
    </form>

<?php elseif (App\App::$session->getUser()): ?>

    <?php if (App\App::$session->getUser()['role'] === 'admin') : ?>
        <form method="POST" action="/add">
            <button>Create</button>
        </form>
    <?php endif; ?>

<?php endif; ?>

<section class="grid-container">

    <?php foreach ($data['products'] as $product) : ?>
        <?php if (App\App::$session->getUser()): ?>

            <?php if (App\App::$session->getUser()['role'] === 'user') : ?>

                <div class="grid-item">
                    <h4><?php print $product['name']; ?></h4>
                    <img class="product-img" src="<?php print $product['img']; ?>" alt="">
                    <p><?php print $product['price']; ?> $</p>
                    <?php print $product['order']; ?>
                </div>
            <?php elseif (App\App::$session->getUser()['role'] === 'admin') : ?>

                <div class="grid-item">
                    <h4><?php print $product['name']; ?></h4>
                    <img class="product-img" src="<?php print $product['img']; ?>" alt="">
                    <p><?php print $product['price']; ?> $</p>
                    <form method="POST" action="<?php print $product['link']; ?>">
                        <button>Edit</button>
                    </form>
                    <?php print $product['delete']; ?>
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
