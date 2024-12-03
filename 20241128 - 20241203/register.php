<?php
require('functions.inc.php');

requiredLoggedOut();



$pageTitle = "Register";
$errors = [];

$firstname = "";
$lastname = "";
$email = "";
$password = "";
$optin = 0;

if (isset($_POST['button'])) { // WERD FORMULIER VERZONDEN?

    // VALIDATIE FIRSTNAME
    if (!isset($_POST['inputfirstname'])) { // INGEVULD?
        $errors[] = "Firstname is required!";
    } else {
        $firstname = $_POST['inputfirstname'];

        if ($firstname < 1) { // LANG GENOEG?
            $errors[] = "Firstname is required!";
        }
        if (preg_match('/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i', $firstname)) { // ZIJN ER NIET-TOEGELATEN KARAKTERS?
            $errors[] = "Firstname can not contain special characters!";
        }
    }

    // VALIDATIE LASTNAME
    if (!isset($_POST['inputlastname'])) { // INGEVULD?
        $errors[] = "Lastname is required!";
    } else {
        $lastname = $_POST['inputlastname'];

        if ($lastname < 1) { // LANG GENOEG?
            $errors[] = "Lastname is required!";
        }
        if (preg_match('/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i', $lastname)) { // ZIJN ER NIET-TOEGELATEN KARAKTERS?
            $errors[] = "Lastname can not contain special characters!";
        }
    }

    // VALIDATIE EMAIL
    if (!isset($_POST['inputmail'])) { // INGEVULD?
        $errors[] = "Email is required!";
    } else {
        $email = $_POST['inputmail'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // KLOPT DE BUILD VAN JE EMAIL?
            $errors[] = "Email adress is invalid!";
        } else { // SYNTAX IS VALID MAAR IS DEZE EMAIL UNIEK?
            if (!isMailUnique($email)) {
                $errors[] = 'This email adress is already in use. Are you trying to <a href="login.php"> log in instead?';
            }
        }
    }

    // VALIDATIE PASSWORD
    if (!isset($_POST['inputpass'])) {
        $errors[] = "Password is required.";
    } else {
        $password = $_POST['inputpass'];

        if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $password)) {
            $errors[] = "Password needs to contain at least 1 uppercase letter, 1 lowercase, 1 symbol, 1 number and needs to be at least 8 characters long.";
        }
    }

    // VALIDATIE OPTIN
    if (isset($_POST['inputoptin'])) { // AANWEZIG?
        $optin = 1;
    }

    // ALS ERRORS LEEG IS PUSH IN DATABASE
    if (count($errors) == 0) {
        $newId = insertIntoDB($firstname, $lastname, $email, $password, $optin);

        if (!$newId) {
            $errors[] = "An unknown error has occured, please contact us!";
        } else {
            setLogin($newId);
            $_SESSION['message'] = "Welcome $firstname!";
            header('Location: admin.php');
            exit;
        }
    }
}


print '<pre>';
print_r($_SESSION);
print '</pre>';

require('head.inc.php');

?>
<div class="main_content_iner ">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="dashboard_header mb_50">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="dashboard_header_title">
                                <h3><?= $pageTitle; ?></h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="dashboard_breadcam text-end">
                                <p><a href="index.html">Dashboard</a> <i class="fas fa-caret-right"></i> <?= $pageTitle; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="row justify-content-center">

                        <div class="col-lg-6">
                            <!-- sign_in  -->
                            <div class="modal-content cs_modal">
                                <div class="modal-header justify-content-center theme_bg_1">
                                    <h5 class="modal-title text_white"><?= $pageTitle; ?></h5>
                                </div>

                                <div class="modal-body">

                                    <!-- TOON ERRORS INDIEN AANWWEZIG -->
                                    <?php if (count($errors)): ?>
                                        <ul>
                                            <?php foreach ($errors as $error): ?>
                                                <li><?= $error; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?></php>

                                    <form method="post" action="register.php">
                                        <div class="">
                                            <input name="inputfirstname" id="inputfirstname" type="text" class="form-control" placeholder="Firstname" value="<?= $firstname ? $firstname : "" ?>">
                                        </div>
                                        <div class="">
                                            <input name="inputlastname" id="inputlastname" type="text" class="form-control" placeholder="Lastname" value="<?= $lastname ? $lastname : "" ?>">
                                        </div>

                                        <div class="">
                                            <input name="inputmail" id="inputmail" type="text" class="form-control" placeholder="Enter your email" value="<?= $email ? $email : "" ?>">
                                        </div>
                                        <div class="">
                                            <input name="inputpass" id="inputpass" type="password" class="form-control" placeholder="Password">
                                        </div>

                                        <div class="cs_check_box">
                                            <input type="checkbox" id="inputoptin" name="inputoptin" class="common_checkbox">
                                            <label class="form-label" for="inputoptin">
                                                Keep me up to date
                                            </label>
                                        </div>

                                        <button class="btn_1 full_width text-center" value="test" name="button">Sign up</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require('footer.inc.php'); ?>