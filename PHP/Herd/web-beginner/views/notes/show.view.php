<?php view('partials/head.php') ?>
<?php view('partials/nav.php') ?>
<?php view('partials/banner.php', ['heading' => $heading]) ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <div class="m-8">
            <!-- avoid dangerous script tags in the body using htmlspecialchars-->
            <h1 class="text-blue-500 font-bold text-2xl"><?= htmlspecialchars($note['body']) ?></h1>
        </div>
        <hr />
        <form method="POST" action="/delete">
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="/notes">
                    <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Go Back</button>
                </a>
                <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Delete</button>
            </div>
        </form>
    </div>
</main>

<?php view('partials/footer.php') ?>