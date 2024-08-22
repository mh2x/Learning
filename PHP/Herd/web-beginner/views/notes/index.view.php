<?php view('partials/head.php') ?>
<?php view('partials/nav.php') ?>
<?php view('partials/banner.php', ['heading' => $heading]) ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p>Hello, welcome to the notes page</p>

        <div class="mt-4">
            <ul>
                <?php foreach ($notes as $note): ?>
                    <a href="/note?id=<?= $note['id'] ?>" class="text-blue-500 hover:underline">
                        <!-- avoid dangerous script tags in the body using htmlspecialchars-->
                        <li><?= htmlspecialchars($note['body']) ?></li>
                    </a>
                <?php endforeach; ?>
            </ul>

            <P class="mt-6">
                <a href="/notes/create" class="text-blue-500 hover:underline">Add New Note</a>
            </P>
        </div>
    </div>
</main>

<?php view('partials/footer.php') ?>