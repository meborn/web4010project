// var createAskQuestions = function(allQuestions) {
// 	question_array = []
// 	$.each(allQuestions, function(index, q) {
// 		var question = {
// 			qindex: index,
// 			data: q
// 		}
// 		question_array.push(question);
// 	});
// 	return question_array;
// }

// var getCurrent = function() {
// 	var random = Math.floor((Math.random() * askQuestions.length));
// 	currentIndex = random;
// 	currentQuestion = askQuestions[random];
// 	$("#question").text(currentQuestion.data.question);
// 	currentAnswer = askQuestions[random];
// 	var masterIndex = currentQuestion.qindex;
// 	var answers = [];
// 	$.each(allQuestions, function(index, q) {
// 		if(index != masterIndex) {
// 			var a = {
// 				aindex: index,
// 				data: q
// 			}
// 			answers.push(a);
// 		}
// 	});
// 	notAnswer = answers;
// 	console.log(notAnswer);
// }

// var setCurrentView = function() {
// 	var range = Math.floor(notAnswer.length/3);
// 	var r1 = Math.floor((Math.random() * range));
// 	console.log("r1 " + r1);
// 	var r2 = Math.floor((Math.random() * (range * 2)) + range);
// 	console.log("r2 " + r2);
// 	var r3 = Math.floor((Math.random() * (range * 3)) + (range * 2));
// 	console.log("r3 " + r3);
// 	var randoms = [r1, r2, r3];
// 	var choices = [];
// 	var answerIndex = Math.floor((Math.random() * 3));
// 	for(var i = 0; i < 4; i++) {
// 		var r = Math.floor((Math.random() * randoms.length))
// 		if(i != answerIndex) {
// 			choices.push(notAnswer[randoms[r]].aindex);
// 			randoms.splice(r, 1);
// 		}
// 		else {
// 			choices.push(currentAnswer.qindex);
// 		}
		
// 	}
// 	$.each(choices, function(index, c) {
// 		$("#choice_"+index).text(allQuestions[c].answer);
// 	});
// 	console.log(choices);

// }
// var init = function(questions) {
// 	allQuestions = questions;
// 	askQuestions = createAskQuestions(allQuestions);
// 	getCurrent();
// 	setCurrentView();
// }

// var allQuestions;
// var askQuestions;
// var currentIndex;
// var currentQuestion;
// var currentAnswer;
// var notAnswer;

// var correctQuestions;
var getChoices = function() {
	choices = [];
	var answer_index = Math.floor((Math.random() * 4));
	for(var i = 0; i < 4; i++) {
		if(i != answer_index) {
			var r = Math.floor((Math.random() * notAnswer.length));
			choices.push(notAnswer[r]);
			notAnswer.splice(r,1);
		}
		else {
			choices.push(current);
		}
		$('#input_'+i).val(masterQuestions[choices[i]].answer);
		$('#choice_'+i).text(masterQuestions[choices[i]].answer);
		console.log("choices");
		console.log(masterQuestions[choices[i]]);
	}

}

var getQuestion = function() {
	var random = Math.floor((Math.random() * askQuestions.length));
	current = askQuestions[random];
	$('#question').text(masterQuestions[current].question);
	console.log("question: " + masterQuestions[current].question);
	console.log("answer: " + masterQuestions[current].answer);
	var not = [];
	$.each(masterQuestions, function(index, q) {
		if(index != current) {
			not.push(index);
		}
	});
	notAnswer = not;
	console.log("not the answer");
	$.each(notAnswer, function(index, n) {
		console.log(masterQuestions[n]);
	});
}

var getProgress = function() {
	var correct = correctQuestions.length
	var count = masterQuestions.length
	var percent = Math.floor((correct/count) * 100)+"%";
	console.log(percent);
	$('#progress').css('background-color', '#0fc47a');
	$('#progress').css('width', percent);
	$('#progress_fraction').text(correct+"/"+count);
}

var checkAnswer = function(answer) {
	if(masterQuestions[current].answer === answer) {
		alert("Correct!");
		var askQuestionIndex = askQuestions.indexOf(current);
		askQuestions.splice(askQuestionIndex, 1);
		correctQuestions.push(current);
		if(askQuestions.length > 0) {
			getQuestion();
			getChoices();

		}
		else {
			$('#questions_row').toggle();
			$('#congrats_row').toggle();
		}
		getProgress();
		
	}
	else {
		alert("Wrong!");
		getQuestion();
		getChoices();
	}
}

var init = function(questions) {
	askQuestions = [];
	correctQuestions = [];
	masterQuestions = questions;
	$.each(masterQuestions, function(index, q) {
		askQuestions.push(index);
	});
	getQuestion();
	getChoices();
	getProgress();
}


var masterQuestions;
var askQuestions;
var correctQuestions;
var current;
var notAnswer;
var choices;

