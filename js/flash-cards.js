//create cards object
var createCards = function(questions) {
	console.log("create cards called");
	var cards = [];
	$.each(questions, function(index, q) {
		var card = {
			learned: false,
			data: q
		}
		cards.push(card);
	});
	console.log(cards);
	return cards;
}
//get random card
var getCardIndex = function(cards) {
	console.log("get card index called");
	var random = Math.floor((Math.random() * cards.length));
	console.log(random);
	return random;
}
//set card view
var getCard = function(index, cards) {
	console.log("get card called");
	if(cards.length > 0) {
		var card = cards[index];
		$(".front").empty();
		$(".back").empty();
		$(".front").append("<p>"+card.data.question+"</p>");
		// $(".back").append("<p>"+card.data.answer+"</p>");
	}
	
}
//flip card
var showAnswer = function(card) {
	// if($(".flip-container .flipper").hasClass("flip")) {
	// 	$(".flip-container .flipper").removeClass("flip");
	// }
	// else {
	// 	$(".flip-container .flipper").addClass("flip");
	// }
	$("#card").flip(true);
	$(".back").append("<p>"+card.data.answer+"</p>");
	$(".btn_container").toggle();
	$("#show_answer").toggle();
}

var hideAnswer = function() {
	$("#card").flip(false);
	$(".btn_container").toggle();
	$("#show_answer").toggle();
}

var getProgress = function() {
	var correct = correctCards.length
	var percent = Math.floor((correct/card_count) * 100)+"%";
	console.log(percent);
	$('#progress').css('background-color', '#0fc47a');
	$('#progress').css('width', percent);
	$('#progress_fraction').text(correct+"/"+card_count);
}

var correctCard = function() {
	console.log("correct card called");
	//flipCard();
	if(cards.length > 0) {
		var c = cards[card_index];
		cards.splice(card_index,1);
		correctCards.push(c);
		getProgress();
		card_index = getCardIndex(cards);
		if(cards.length == 0) {
			$(".front").empty();
			$(".back").empty();
			$(".front").append("<p>Congratulations!</p>");
			$("#show_answer").toggle();
			$("#start_over").toggle();
		}
		else {
			getCard(card_index, cards);
		}
	}
	else {
		alert("Congratulations!");
	}
	
	console.log(cards);
	console.log(correctCards);	
	
}

var incorrectCard = function() {
	var old_index = card_index;
	var new_index = getCardIndex(cards);
	if(cards.length > 1) {
		while(old_index == new_index) {
			new_index = getCardIndex(cards);
		}
	}
	
	card_index = new_index;
	getCard(card_index, cards);
}

var init = function(questions) {
	cards = createCards(questions);
	card_count = cards.length;
	card_index = getCardIndex(cards);
	correctCards = [];
	getCard(card_index, cards);
}

var cards = [];
var card_count;
var correctCards;
var card_index;



