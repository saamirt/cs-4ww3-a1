<!-- importing header and aws keys -->
<?php require "templates/header.php";
require './aws.php'; ?>
<?php

/**
 * Function to query information based on 
 * a parameter: in this case, location.
 *
 */

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

require './vendor/autoload.php';

// checking if form is submitted
if (isset($_POST['submit'])) {
    // switching query based on which form was submitted
    if ($_POST['action'] == "rating") {
        try {
            // connecting to db
            $connection = new PDO($dsn, $username, $password, $options);

            // sql query to combine pokestops with their average ratings (determined by averaging all ratings for a pokestop)
            $sql = "SELECT * FROM pokestops JOIN (SELECT pokestopID, AVG(rating) as avg_rating FROM reviews GROUP BY pokestopID) table2 ON pokestops.pokestopID = table2.pokestopID WHERE avg_rating >= :rating";

            $rating = $_POST['rating'];

            // executing query
            $statement = $connection->prepare($sql);
            $statement->bindParam(':rating', $rating, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll();
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    } elseif ($_POST['action'] == "title") {
        try {

            // connecting to db
            $connection = new PDO($dsn, $username, $password, $options);

            // sql query to combine pokestops with their average ratings (determined by averaging all ratings for a pokestop)
            $sql = "SELECT * FROM pokestops LEFT JOIN (SELECT pokestopID, AVG(rating) as avg_rating FROM reviews GROUP BY pokestopID) table2 ON pokestops.pokestopID = table2.pokestopID WHERE title LIKE :title";

            $title = $_POST['title'] . "%";

            // executing query
            $statement = $connection->prepare($sql);
            $statement->bindParam(':title', $title, PDO::PARAM_STR);
            $statement->execute();
            $result = $statement->fetchAll();
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    } else {
        try {

            // connecting to db
            $connection = new PDO($dsn, $username, $password, $options);

            // sql query to combine pokestops with their average ratings (determined by averaging all ratings for a pokestop)
            $sql = "SELECT * FROM pokestops LEFT JOIN (SELECT pokestopID, AVG(rating) as avg_rating FROM reviews GROUP BY pokestopID) table2 ON pokestops.pokestopID = table2.pokestopID";

            // executing query
            $statement = $connection->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
    // adding db results to javascript for other functions
    echo "<script>var pokestops = " . json_encode($result) . ';</script>';
}

// connecting to s3 bucket to retrieve images
$bucketName = 'cs4ww3-pokestop-images';
try {
    // connecting to s3
    $s3 = S3Client::factory(
        array(
            'credentials' => array(
                'key' => $IAM_KEY,
                'secret' => $IAM_SECRET
            ),
            'version' => 'latest',
            'region'  => 'us-east-2'
        )
    );
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

?>
<script src="./js/search.js"></script>

<main>

    <div id="main-body" class="album py-5 bg-light">
        <!-- container to keep page content in a centered box -->
        <div class="container">

            <!-- this is the search form section with all the various search methods -->

            <h3 class=" text-center text-white text-uppercase font-weight-bold">Search for a PokeStop</h3>
            <p class="mb-4 text-center text-white">Search for a PokeStop either by
                its' name or by its rating. Enter your search query or rating and click the adjacent search button.
                Clicking the search buttons without entering anything will show all the pokestops.
            </p>

            <!-- search by title -->
            <form class="input-group mb-3" method="post">
                <div class="input-group-prepend">
                    <span class="input-group-text">Search by Title</span>
                </div>
                <input type="text" class="form-control" placeholder="Enter your query" id="title" name="title" aria-label="Recipient's username">
                <input type="hidden" name="action" value="title">
                <div class="input-group-append">
                    <button class="btn btn-default" type="submit" name="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <!-- search by rating (finds pokestops with equal or greater rating) -->
            <form class="input-group mb-3" method="post">
                <div class="input-group-prepend">
                    <span class="input-group-text">Search by Rating</span>
                </div>
                <select class="custom-select" id="rating" name="rating">
                    <option selected>Choose...</option>
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
                <input type="hidden" name="action" value="rating">
                <div class="input-group-append">
                    <button class="btn btn-default" type="submit" name="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <!-- search by location -->
            <form class="input-group mb-3" method="post">
                <input type="hidden" name="action" value="location">
                <button class="btn btn-light mx-auto" onclick="getLocation()" type="submit" name="submit">Search Near Your Location <i class="fas fa-search"></i></button>
            </form>

            <!-- --------------------------------------------------------------------------------------------------------------------------------------- -->
            <!-- from here on, its displaying search results -->

            <h3 class=" text-center text-white text-uppercase font-weight-bold">Search Results</h3>
            <p class="mb-4 text-center text-white">PokeStop Search results are displayed on a map and as tabular
                results below.
            </p>

            <!-- row for the map -->
            <div class="w-100 mb-4">
                <div class="card lg-4 shadow--sm">
                    <!-- iframe for the map -->
                    <!-- <iframe class="card map"
                    src="https://maps.google.com/maps?q=mcmaster&t=&z=16&ie=UTF8&iwloc=&output=embed"
                    allowfullscreen></iframe> -->
                    <div class="card map" id="map"></div>
                </div>
            </div>

            <!-- list of cards for the results -->
            <div class="row" id="search-cards">
                <!-- Below is a template card, all cards are populated by js -->
                <!-- <div class="col-lg-4"> -->
                <!-- <a href="./pokestop.php" class="card card--clickable mb-4 shadow--sm"> -->
                <!-- random images were used temporarily for each result -->
                <!-- <img class="card-img-top img--search" alt="PokeStop Image" -->
                <!-- src="https://www7.mississauga.ca/documents/miway/transitway/Mississauga-Transitway_Erin-Mills-Station_002_1024x677.jpg" -->
                <!-- data-holder-rendered="true"> -->
                <!-- each card has some temporary hardcoded text to show what it may look like -->
                <!-- <div class="card-body"> -->
                <!-- <h5 class="card-title">PokeStop Title</h5> -->
                <!-- <p class="card-text">33 Norfolk St N, Hamilton, ON L8S 3J9</p> -->
                <!-- <p class="card-text"><small class="text-muted">Added 10 days ago</small></p> -->
                <!-- </div> -->
                <!-- </a> -->
                <!-- </div> -->

                <?php

                if (isset($_POST['submit'])) {
                    //checks for valid results before displaying pokestops
                    if ($result && $statement->rowCount() > 0) { ?>
                        <!-- displays each pokestop from db based on search method -->
                        <?php foreach ($result as $row) {
                                    // retrieves an authorized url for each image
                                    try {
                                        $cmd = $s3->getCommand('GetObject', [
                                            'Bucket' => "cs4ww3-pokestop-images",
                                            'Key' =>  "pokestops/" . $row["image"]
                                        ]);
                                        // sets up a requst for the image for the next 20 minutes
                                        $request = $s3->createPresignedRequest($cmd, '+20 minutes');
                                        $row['url'] = (string) $request->getUri();
                                    } catch (S3Exception $e) {
                                        die('Error:' . $e->getMessage());
                                    } catch (Exception $e) {
                                        die('Error:' . $e->getMessage());
                                    } ?>
                            <!-- card that displays the pokestop -->
                            <div class="col-lg-4 d-flex align-items-stretch">
                                <a href="./pokestop.php?&id=<?php echo escape($row[0]); ?>" class="pokestop-card card card--clickable mb-4 shadow--sm">
                                    <img class="card-img-top img--search" alt="PokeStop Image" src="<?php echo escape($row["url"]); ?>" data-holder-rendered="true">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="card-title card-title--ellipsis"> <?php echo escape($row["title"]); ?> </h5>
                                            <h6> <span class="badge badge-light badge--gray"> <?php echo escape(number_format($row["avg_rating"], 1) . " Stars"); ?></span> </h6>
                                        </div>
                                        <p class="card-text"><?php echo escape($row["description"]); ?></p>
                                    </div>
                                    <div class="card-footer text-muted"> <?php echo escape($row["latitude"]) . ", " . escape($row["longitude"]); ?> </div>
                                </a>
                            </div>
                        <?php
                                } ?>
                    <?php } ?>
                <?php }

                ?>
            </div>
        </div>
    </div>

</main>

<!-- <script src="./js/pokestop.js"></script>
<script src="./js/submission.js"></script>
<script src="./js/user-registration.js"></script> -->

<!-- google maps api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBnMuPBJUs37mOls7fPhrcF0E5MPe3l4Y&libraries=geometry&callback=initMap" async defer></script>

<!-- footer -->
<?php require "templates/footer.php"; ?>