var setSlotData = function(questions) {
	$('.answer_slot').each(function(index) {
		$(this).data('answer', questions[index].answer);
	});
	// $('.answer').each(function(index) {
	// 	$(this).data('answer', questions[index].answer);
	// });
}

var setAndShuffle = function(questions) {
	var l = questions.length;
	var original = questions;
	var new_array = [];
	for(var i = 0; i < l; i++) {
		var r = Math.floor((Math.random() * original.length));
		var n = original[r];
		new_array.push(n);
		original.splice(r, 1);
	}
	console.log(new_array);
	$.each(new_array, function(index, question) {
		$('#answer_list').append("<li id='answer_"+index+"' class='list-group-item'></li>");
		$('#answer_'+index).append("<div class='answer'>"+question.answer+"</div>");
	});
	$('.answer').each(function(index) {
		$(this).data('answer', new_array[index].answer);
	});
}

var handleCardDrop = function(event, ui) {
			
	var slotAnswer = $(this).data('answer');
	var answer = ui.draggable.data('answer');
	if(slotAnswer === answer) {
		correct++;
		ui.draggable.draggable('disable');
		$(this).droppable('disable');
		ui.draggable.draggable('option', 'revert', false);
	}
	if(correct === questions_length ) {
		$('#matching_row').toggle();
		$('#done_row').toggle();
	}
	
}

var init = function(questions) {
	questions_length = questions.length;
	correct = 0;
	$.each(questions, function(index, question) {
		$('#question_list').append("<li id='question_"+index+"' class='list-group-item'></li>");
		$('#question_'+index).append("<p>"+question.question+"</p>");
		$('#question_'+index).append("<div class='answer_slot'></div>");
	});
	// $.each(questions, function(index, question) {
	// 	$('#answer_list').append("<li id='answer_"+index+"' class='list-group-item'></li>");
	// 	$('#answer_'+index).append("<div class='answer'>"+question.answer+"</div>");
	// });
	setSlotData(questions);
	setAndShuffle(questions);
	$('.answer').draggable({
		revert: true
	});
	$('.answer_slot').droppable({
		accept: ".answer",
		drop: handleCardDrop
	});
}

var questions_length;
var correct;