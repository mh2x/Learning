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
        <form method="POST">
            <input name="_method" value="DELETE" type="hidden">
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="/notes">
                    <!-- <button type="button" class="w-[6rem] bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full">Go Back</button> -->
                    <button type="button" class="w-32 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full">Go Back</button>
                </a>
                <a href="/note/edit?id=<?= $note['id'] ?>">
                    <button type="button" class="w-32 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Edit</button>
                </a>
                <button type="submit" class="w-32 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">Delete</button>
            </div>
        </form>
    </div>
</main>

<?php view('partials/footer.php') ?>