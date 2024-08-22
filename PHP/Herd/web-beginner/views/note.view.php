<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="m-8">
            <!-- avoid dangerous script tags in the body using htmlspecialchars-->
            <h1 class="text-blue-500 font-bold text-2xl"><?= htmlspecialchars($note['body']) ?></h1>
        </div>
        <hr />
        <p class="mt-4">
            <a class="text-blue-500 hover:underline" href="/notes">
                Go Back...</a>
        </p>
    </div>
</main>

<?php require('partials/footer.php') ?>