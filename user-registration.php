<!-- header -->
<?php require "templates/header.php"; ?>

<?php


// waits for form to submit
if (isset($_POST['submit'])) {

    try {
        // connect to db
        $connection = new PDO($dsn, $username, $password, $options);

        $new_user = array(
            "firstname" => $_POST['firstname'],
            "lastname" => $_POST['lastname'],
            "email" => $_POST['email'],
            "passwordHash" => sha1($_POST['password']),
            "birthdate" => $_POST['birthdate']
        );

        // generate sql query to add user
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "users",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        // execute query
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
        // add a query parameter for a new user
        header('Location: user-registration.php?action=joined');
        exit;
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<main>

    <div id="main-body" class="album py-5 bg-light">
        <!-- container to keep page content in a centered box -->
        <div class="container">
            <div class="alert alert-danger" style="visibility: hidden;" role="alert" id="error">
            </div>

            <?php if (isset($_POST['submit']) && $statement) { ?>
                <div class="alert alert-primary" role="alert" id="error">
                    <?php echo $_POST['firstname']; ?> successfully added.
                </div>
            <?php } ?>
            <div class="card mb-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Register a New User</h5>
                    <p class="card-text text-center">Complete this form to sign up a new user. </p>

                    <form method="post" onsubmit="return validate(this)">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="firstname">First Name</label>
                                <!-- text type input -->
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter first name" value="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastname">Last Name</label>
                                <!-- text type input -->
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter last name" value="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" aria-describedby="password-help" placeholder="Password" required>
                            <small id="password-help" class="form-text text-muted">Make sure not to tell anyone else
                                this password.</small>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Date of Birth</label>
                            <input class="form-control" type="date" id="birthdate" name="birthdate" required>
                        </div>
                        <div class="form-group">
                            <label for="number-input">Favorite Number</label>
                            <input type="number" class="form-control" id="number-input" placeholder="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bio-input">Your Profile Bio</label>
                            <textarea class="form-control" id="bio-input" rows="3" aria-describedby="bio-help"></textarea>
                            <small id="bio-help" class="form-text text-muted">You can write a bit about yourself
                                here.</small>
                        </div>
                        <div class="form-group">
                            <label>Which Starter Pokemon is your favorite?</label>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="starter-choice" id="starter-choice-1" value="option1" required>
                                <label class="custom-control-label" for="starter-choice-1">Charmander</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="starter-choice" id="starter-choice-2" value="option2" required>
                                <label class="custom-control-label" for="starter-choice-2">Squirtle</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="starter-choice" id="starter-choice-3" value="option3" required>
                                <label class="custom-control-label" for="starter-choice-3">Bulbasaur</label>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="invalidCheck2" required>
                            <label class="custom-control-label" for="invalidCheck2">Do you agree to signing up for
                                this site?</label>
                            <div class="invalid-feedback">You must agree to this before submitting</div>
                        </div>
                        <input class="btn btn-primary btn--red" name="submit" value="Submit" type="submit">
                    </form>
                </div>
            </div>

        </div>
    </div>

</main>

<!-- local javascript for user registration -->
<script src="./js/user-registration.js"></script>

<!-- footer -->
<?php require "templates/footer.php"; ?>
