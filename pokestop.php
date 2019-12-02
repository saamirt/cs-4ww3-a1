<!-- importing header -->
<?php require "templates/header.php"; ?>

<?php
// converts the query parameters into variables
parse_str($_SERVER['QUERY_STRING']);
try {
	// connect to db
	$connection = new PDO($dsn, $username, $password, $options);

	// sql query to combine pokestops with their average ratings (determined by averaging all ratings for a pokestop)
	$sql = "SELECT * FROM pokestops LEFT JOIN (SELECT pokestopID, AVG(rating) as avg_rating FROM reviews GROUP BY pokestopID) table2 ON pokestops.pokestopID = table2.pokestopID WHERE pokestops.pokestopID = :id";

	// execute query
	$statement = $connection->prepare($sql);
	$statement->bindParam(':id', $id, PDO::PARAM_INT);
	$statement->execute();
	$result = $statement->fetchAll();
	$stop = $result[0];


	// sql query to get reviews for the pokestop
	$sql2 = "SELECT * FROM reviews WHERE pokestopID = :id";

	$statement2 = $connection->prepare($sql2);
	$statement2->bindParam(':id', $id, PDO::PARAM_INT);
	$statement2->execute();
	$result2 = $statement2->fetchAll();

	// stores the results in javascript for other functions to use
	echo "<script>var pokestop = " . json_encode($stop) . ';</script>';
} catch (PDOException $error) {
	echo $sql . "<br>" . $error->getMessage();
}


// wait for form submit
if (isset($_POST['submit'])) {
	try {
		// connect to db
		$connection = new PDO($dsn, $username, $password, $options);
		$new_user = array(
			"pokestopID" => $stop['pokestopID'],
			"title" => $_POST['title'],
			"text" => $_POST['text'],
			"rating" => $_POST['rating'],
			"author" => $_SESSION['email']
		);

		// creates a query based on form array to add a new review
		$sql = sprintf(
			"INSERT INTO %s (%s) values (%s)",
			"reviews",
			implode(", ", array_keys($new_user)),
			":" . implode(", :", array_keys($new_user))
		);

		// executes query
		$statement = $connection->prepare($sql);
		$statement->execute($new_user);
		header("Refresh:0");
	} catch (PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>

<main>
	<div id="main-body" class="album py-5 bg-light">
		<!-- container to keep page content in a centered box -->
		<div class="container">
			<!-- main card that contains details about the pokestop -->
			<div class="card mb-5">
				<!-- small header above card that shows lat/long -->
				<div id="pokestop-loc" class="card-header text-center small">
					Latitude: <?php echo escape($stop["latitude"]); ?>, Longitude: <?php echo escape($stop["longitude"]); ?>
				</div>
				<!-- main body of the card -->
				<div class="card-body">
					<h5 id="pokestop-title" class="card-title text-center"><?php echo escape($stop["title"]); ?></h5>
					<p id="pokestop-desc" class="card-text text-center"><?php echo escape($stop["description"]); ?></p>
					<!-- <iframe class="w-100 card map mb-4"
							src="https://maps.google.com/maps?q=mcmaster&t=&z=16&ie=UTF8&iwloc=&output=embed"
							allowfullscreen></iframe> -->
					<!-- Google Api Map -->
					<div class="w-100 card map mb-4" id="map"></div>

					<!-- list of reviews -->

					<?php if (count($result2) > 0) { ?>
						<div class="reviews list-group overflow-auto">
							<!-- review item -->
							<?php foreach ($result2 as $review) { ?>
								<div class="list-group-item flex-column align-items-start mb-3">
									<div class="d-flex w-100 justify-content-between">
										<h5 class="mb-3">
											<?php for ($x = 0; $x < $review["rating"]; $x++) { ?>
												<i class="fas fa-star text-warning"></i>
											<?php } ?>
											<?php echo escape($review["title"]); ?></h5>
										<small><?php echo escape($review["created_at"]); ?></small>
									</div>
									<p class="mb-3"><?php echo escape($review["text"]); ?></p>
									<small><?php echo escape($review["author"]); ?></small>
								</div>
							<?php } ?>
						</div>
					<?php } else { ?>
						<!-- if there are no reviews -->
						<div class="text-center">
							There are currently no reviews
						</div>
					<?php } ?>

					<?php
					// check if logged in
					if (!empty($_SESSION['email'])) { ?>
						<!-- show form only when logged in -->
						<form className="mt-3" method="post">
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" class="form-control" id="title" name="title" placeholder="Write a title here...">
							</div>
							<div class="form-group mb-3">
								<label for="review">Write a Review</label>
								<textarea class="form-control" id="text" name="text" placeholder="Write your review here..." required></textarea>
							</div>
							<select class="custom-select mb-3" id="rating" name="rating" required>
								<option selected>Choose a rating...</option>
								<option value="1">1 Star</option>
								<option value="2">2 Stars</option>
								<option value="3">3 Stars</option>
								<option value="4">4 Stars</option>
								<option value="5">5 Stars</option>
							</select>
							<button class="btn btn-primary" type="submit" name="submit">Submit</button>
						</form>
					<?php } else { ?>
						<!-- show a fake disabled version of the form if not logged in -->
						<div class="mt-3 text-center">
							Sign in to leave a review
						</div>
						<form>
							<div class="form-group">
								<label for="title">Title</label>
								<input disabled type="text" class="form-control" placeholder="Write a title here...">
							</div>
							<div class="form-group mb-3">
								<label for="review">Write a Review</label>
								<textarea disabled class="form-control" placeholder="Write your review here..." required></textarea>
							</div>
							<select class="custom-select mb-3" id="rating" name="rating" required disabled>
								<option selected>Choose a rating...</option>
							</select>
							<button disabled class="btn btn-primary" type="submit">Submit</button>
						</form>
					<?php } ?>
				</div>
				<!-- small footer on the bottom of the card -->
			</div>

		</div>
	</div>

</main>

<script src="./js/pokestop.js"></script>
<!-- google maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBnMuPBJUs37mOls7fPhrcF0E5MPe3l4Y&libraries=geometry&callback=initMap" async defer></script>

<!-- footer -->
<?php require "templates/footer.php"; ?>