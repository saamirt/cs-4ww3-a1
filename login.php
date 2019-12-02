<!-- import header -->
<?php require "templates/header.php"; ?>

<?php

// wait for form submit
if (isset($_POST['submit'])) {

    try {
        // connect to db
        $connection = new PDO($dsn, $username, $password, $options);

        $email = $_POST['email'];
        // password is hashed before sign up and the hash of the input is checked on login
        $pwd = sha1($_POST['password']);

        // sql query for user
        $sql = "SELECT * FROM users WHERE email = :email AND passwordHash = :passwordHash";

        // executes the query
        $statement = $connection->prepare($sql);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':passwordHash', $pwd, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // checks if auth worked
        if ($result != false) {
            if ($pwd == $result['passwordHash']) {
                // sets session details
                $_SESSION['firstname'] = $result['firstname'];
                $_SESSION['lastname'] = $result['lastname'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['passwordHash'] = $result['passwordHash'];
                // redirects to index page
                header('Location: index.php');
                exit;
            }
        }
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
            <!-- alert for incorrect login -->
            <?php if (isset($_POST['submit']) && $statement && $result != false) { ?>
                <div class="alert alert-danger" role="alert" id="error">
                    Incorrect or non-existent login.
                </div>
            <?php } ?>
            <div class="card mb-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Login</h5>
                    <p class="card-text text-center">Complete this form to login</p>

                    <!-- login form -->
                    <form method="post">
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
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <input class="btn btn-primary btn--red" name="submit" value="Submit" type="submit">
                    </form>
                </div>
            </div>

        </div>
    </div>

</main>

<!-- local javascript -->
<script src="./js/user-registration.js"></script>

<!-- footer -->
<?php require "templates/footer.php"; ?>