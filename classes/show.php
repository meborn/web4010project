<?php
	session_start();
	
	require '../includes/DB.php';

	$id = $_GET['id'];
	$db = new DB();
	$class = $db->getClass($id);
	$exams = $db->getExams($id);
	$new_exam_url = "/~mneborn/web4010project/exams/new.php?class_id=$id";

	require '../header.php';
	require '../nav.php';
?>
<body>
	<section id="show_class_section_1">
		<div class="container">
			<!-- display success -->
			<?php if($_SESSION['success']):?>
				<div class="row">
					<div class="col-xs-12">
						<div class="alert alert-success">
							<?= $_SESSION['success'] ?>
						</div>
					</div>
				</div>
			<?php endif ?>
			<!-- display success -->
			<div class="row">
				<div class="col-xs-12 col-md-10">
					<?= $class['name'] ?>
				</div>
				<div class="col-xs-12 col-md-2">
					<a href=<?= $new_exam_url ?> >New Exam</a>
				</div>
			</div>
			<div class="row">
				<ul class="list-group">
					<?php foreach($exams as $e):?>
						<?php 
							$e_id = $e['id']; 
							$e_show_url = "/~mneborn/web4010project/exams/show.php?id=$e_id";
						?>
						<a href=<?= $e_show_url ?> > 
							<li class="list-group-item"><?= $e['name'] ?></li>
						</a>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</section>
</body>




<?php
	unset($_SESSION['success']);
?>