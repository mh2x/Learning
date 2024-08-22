<?php view('partials/head.php') ?>
<?php view('partials/nav.php') ?>
<?php view('partials/banner.php', ['heading' => $heading]) ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <form method="POST">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Adding a new note</h2>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="col-span-full">
                            <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                            <div class="mt-2">
                                <textarea id="body" name="body" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-indigo-600 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Write your thoughts here..."
                                    required><?= $_POST['body'] ?? '' ?></textarea>

                                <?php if (isset($errors)) : ?>

                                    <p class="font-bold text-xs mt-1 text-red-500"><?= $errors['body'] ?></p>
                                <?php endif ?>

                            </div>
                            <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences for your note...</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="/notes">
                        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    </a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
        </form>
    </div>
</main>

<?php view('partials/footer.php') ?>