<?php
require('functions.inc.php');
requireLoggedIn();

$pageTitle = "Admin home";
require('head.inc.php');

$articles = getArticles();

print '<pre>';
print_r($_SESSION);
print '</pre>';
?>

<div class="main_content_iner ">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="dashboard_header mb_50">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="dashboard_header_title">
                                <h3> Admin pagina</h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="dashboard_breadcam text-end">
                                <p><a href="index.html">Dashboard</a> <i class="fas fa-caret-right"></i> Admin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-danger" role="alert">
                A simple danger alert—check it out!
            </div>
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="row justify-content-center">

                        admin...

                    </div>
                    <div class="table-responsive m-b-30">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Publication date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($articles as $article): ?>
                                    <tr>
                                        <th scope="row"><?= $article['id']; ?></th>
                                        <td><?= mb_strimwidth($article['title'], 0, 30, '...'); ?></td>
                                        <td><?= $article['users_name']; ?></td>
                                        <td><?= $article['status'] ? 'published' : 'unpublished'; ?></td>
                                        <td><?= date('j M Y', strtotime($article['publication_date'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require('footer.inc.php'); ?>

// PREV NEXT CRUD VAN 200 WAARVAN 20 TONEN PER PAGINA!!!
// DELETE KNOP MAKEN DIE VRAAGT 'BEN JE HET ZEKER?'
// ADD KNOP WAARBIJ JE ARTIKEL KUNT TYPEN IN BROWSER