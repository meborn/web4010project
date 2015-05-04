<?php
	session_start();
	require '../includes/DB.php';
	
	$class_id = $_GET['class_id'];
	$db = new DB();
	$class = $db->getClass($class_id);

	require '../header.php';

	require '../nav.php';
?>

<body>

	<section id="new_exam_section_1">
		<div class="container">
			<!-- display errors -->
			<?php if($_SESSION['error']): ?>
				<div class="row">
					<div class="col-xs-12">
						<div class="alert alert-danger">
							<?= $_SESSION['error'] ?>
						</div>
					</div>
				</div>
			<?php endif ?>
			<!-- display errors -->
			<div class="row">
				<div class="col-xs-12 col-md-8">
					<h1><?= $class['name'] ?></h1>
					<h2>New Exam</h2>
					<form method="post" action="create.php">
						<div class="form-group">
							<label for="name">Exam Name</label>
							<input type="hidden" name="class_id" value=<?= $class_id ?> >
							<input type="text" name="name" class="form-control" placeholder="Class Name"> 
						</div>
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</section>

</body>

<?php
	unset($_SESSION['error']);
?>