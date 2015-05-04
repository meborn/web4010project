<?php
	session_start();
	require '../header.php';

	require '../nav.php';
?>
<body>

	<section id="new_class_section_1">
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
					<h1>New Class</h1>
					<form method="post" action="create.php">
						<div class="form-group">
							<label for="name">Class Name</label>
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