<?php
	session_start();
	require "../header.php";
	require '../includes/DB.php';

	$db = new DB();
	$classes = $db->getClasses();
	
?>
<body>
<?php
	require '../nav.php';
?>
<section id="index_class_section_1">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-8">
				<h3 class="blue_text inline_header">Classes</h3>
				<a class="right_link btn btn-default" href="/~mneborn/web4010project/classes/new.php">New Class</a>
				<div class="panel-group" id="classes-accordion" role="tablist" aria-multiselectable="true">
					<?php $count = 0; ?>
					<?php foreach($classes as $c):?>
						<?php
							$cid = $c['id'];
							$heading_id = "heading_$cid";
							$content_id = "content_$cid";
							$exams = $db->getExams($cid);
							$new_exam = "/~mneborn/web4010project/exams/new.php?class_id=$cid";
						?>
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id=<?= $heading_id ?>>
								<h4 class="panel-title">
									<a class="collapsed" data-toggle="collapse" data-parent="#classes-accordion" href=<?= "#$content_id" ?> aria-expanded="false" aria-controls=<?= $content_id ?>>
										<?= $c['name'] ?>
									</a>
								</h4>
								<a class="new_exam_link" href=<?= $new_exam ?>>New Exam</a>
							</div>
							<ul id=<?= "$content_id" ?> class="panel-collapse collapse list-group" role="tabpanel" aria-labelledby=<?= $heading_id ?>>
								<?php foreach($exams as $e):?>
									<?php
										$e_id = $e['id'];
										$exam_url = "/~mneborn/web4010project/exams/show.php?id=$e_id"
									?>
									<li class="list-group-item"><a href=<?= $exam_url ?>><?= $e['name'] ?></a></li>
								<?php endforeach ?>
							</ul>
						</div>

						<?php $count++; ?>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</section>
</body>
<?php
	require '../footer.php';
?>