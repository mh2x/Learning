<?php view('partials/head.php') ?>
<?php view('partials/nav.php') ?>
<?php view('partials/banner.php', ['heading' => $heading]) ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p>Hello, welcome to the notes page</p>

        <div class="mt-4 pb-4">
            <ul class="mt-4 pb-4">
                <?php foreach ($notes as $note): ?>
                    <a href="/note?id=<?= $note['id'] ?>" class="text-blue-500 hover:underline">
                        <!-- avoid dangerous script tags in the body using htmlspecialchars-->
                        <li><?= htmlspecialchars($note['body']) ?></li>
                    </a>
                <?php endforeach; ?>
            </ul>
            <hr />


            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="/notes/create">
                    <button
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Add New Note...
                    </button>
                </a>
                </P>
            </div>
        </div>
</main>

<?php view('partials/footer.php') ?>