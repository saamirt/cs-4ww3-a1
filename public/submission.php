<?php require "templates/header.php";
require './aws.php'; ?>
<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

require '../vendor/autoload.php';


if (isset($_POST['submit'])) {

	try {
		$connection = new PDO($dsn, $username, $password, $options);
		$new_user = array(
			"title" => $_POST['title'],
			"latitude"  => $_POST['latitude'],
			"longitude"     => $_POST['longitude'],
			"description"     => $_POST['description'],
			"image"     => $_FILES['fileToUpload']['name']
		);

		$sql = sprintf(
			"INSERT INTO %s (%s) values (%s)",
			"pokestops",
			implode(", ", array_keys($new_user)),
			":" . implode(", :", array_keys($new_user))
		);

		$statement = $connection->prepare($sql);
		$statement->execute($new_user);
	} catch (PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}

	$bucketName = 'cs4ww3-pokestop-images';

	try {
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

	// For this, I would generate a unqiue random string for the key name. But you can do whatever.
	$keyName = 'pokestops/' . basename($_FILES["fileToUpload"]['name']);
	$pathInS3 = 'https://s3.us-east-2.amazonaws.com/' . $bucketName . '/' . $keyName;
	// Add it to S3
	try {
		// Uploaded:
		$file = $_FILES["fileToUpload"]['tmp_name'];
		$s3->putObject(
			array(
				'Bucket' => $bucketName,
				'Key' =>  $keyName,
				'SourceFile' => $file,
				'StorageClass' => 'REDUCED_REDUNDANCY'
			)
		);
	} catch (S3Exception $e) {
		die('Error:' . $e->getMessage());
	} catch (Exception $e) {
		die('Error:' . $e->getMessage());
	}
}
?>

<main>

	<div id="main-body" class="album py-5 bg-light">
		<!-- container to keep page content in a centered box -->
		<div class="container">

			<?php if (isset($_POST['submit']) && $statement) { ?>
				<div class="alert alert-primary" role="alert" id="error">
					<?php echo $_POST['title']; ?> successfully added.
				</div>
			<?php } ?>
			<!-- main card that contains the content of the form -->
			<div class="card mb-5">
				<div class="card-body">
					<h5 class="card-title text-center">Submit a New PokeStop</h5>
					<p class="card-text text-center">Complete this form to submit a new PokeStop. </p>

					<!-- form that will be submitted -->
					<form method="post" enctype="multipart/form-data">
						<!-- each form input is in a form group or row for styling purposes -->
						<div class="form-group">
							<label for="pokestop-name-input">PokeStop Name</label>
							<!-- text type input -->
							<input type="text" pattern="^ *[^ ].*" class="form-control" id="title" name="title" placeholder="PokeStop Name" value="" required>
						</div>
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="latitude-input">Latitude</label>
								<!-- text type input -->
								<input type="text" pattern="^-?\d+(.\d+)?$" class="form-control" id="latitude" name="latitude" placeholder="Latitude" value="" required>
							</div>
							<div class="col-md-6 mb-3">
								<label for="longitude-input">Longitude</label>
								<!-- text type input -->
								<input type="text" pattern="^-?\d+(.\d+)?$" class="form-control" id="longitude" name="longitude" placeholder="Longitude" value="" required>
							</div>
						</div>
						<div class="form-group mb-3">
							<button class="btn btn-primary btn--red mx-auto d-flex" onclick="getLocation()" type="button">
								Set to Current Location
								<i class="ml-2 my-auto fas fa-search"></i>
							</button>
						</div>

						<div class="form-group">
							<label for="description-input">Description</label>
							<textarea class="form-control" id="description" name="description" rows="3" required></textarea>
						</div>

						<div class="form-group">
							<label for="picture-input">Upload a picture</label>
							<input type="file" class="form-control-file" id="fileToUpload " name="fileToUpload">
						</div>
						<input class=" btn btn-primary btn--red" name="submit" value="Submit" type="submit">
					</form>
				</div>
			</div>

		</div>
	</div>

</main>

<script src="./js/submission.js"></script>

<?php require "templates/footer.php"; ?>