
var wait = false;
var min_value = Number(document.getElementById("min").value);
var max_value = Number(document.getElementById("max").value);

var value_gen = switchGenerator(document.getElementById("current_mode").value);

function switchGenerator(mode){
	switch(mode){
		case "div" : return divided_value_gen;
		case "sqr" : return sqr_value_gen;
		default : return standart_value_gen;
	}
}

function start_training(){
	update();
}

function update(){
	value_gen("first_operand","second_operand");
	document.getElementById("answer").style.color = "rgb(18, 144, 226)";
	clear_field("answer");
	wait = false;
}

function standart_value_gen(left_oprd_id, right_oprd_id){
	$("#"+left_oprd_id).text(getRandomInt(min_value, max_value));
	$("#"+right_oprd_id).text(getRandomInt(min_value, max_value));
}

function divided_value_gen(left_oprd_id, right_oprd_id){
	var right = getRandomInt(min_value, max_value);
	var answer = getRandomInt(min_value, max_value);
	$("#"+left_oprd_id).text(right * answer);
	$("#"+right_oprd_id).text(right);
}

function sqr_value_gen(left_oprd_id, right_oprd_id){
	$("#"+left_oprd_id).text(getRandomInt(min_value, max_value));
	$("#"+right_oprd_id).text(2);
}

function clear_field(field_id){
	document.getElementById(field_id).value = "";
}

function key_action(func,id_1, id_2, ans_id, stat_right_id, stat_all_id){
	if(event.keyCode === 13 && !wait){
		wait = true;
	var check = switchFunc(func)(id_1, id_2, ans_id);
	$("#"+stat_all_id).text(Number($("#"+stat_all_id).text()) + 1);
	if(check){
		$("#"+ ans_id).css('color','#00e200');
		$("#"+stat_right_id).text(Number($("#"+stat_right_id).text()) + 1);
	}else{
		$("#"+ ans_id).css('color','#d40000');
	}
	setTimeout(function() {update();}, 1000);
	}
	
}

function switchFunc(func_name){
	switch(func_name){
	 case "add" : return addition_check;
	 case "sub" : return sub_check;
	 case "mult": return mult_check;
	 case "sqr" : return sqr_check;
	 case "div" : return div_check;
	}
}

/* function addition_check(left_operand_id, right_operand_id, answer_operand_id){
	var left = Number(document.getElementById(left_operand_id).value);
	var right = Number(document.getElementById(right_operand_id).value);
	var answer = document.getElementById(answer_operand_id).value;
	return (left + right == answer);
} */


function getRandomInt(min, max){
	return Math.floor(Math.random() * (max - min) + min);
}

function getRandomIntOnlyMax(max){
	return getRandomInt(0, max);
}

function viewElementById(id){
	var elem = document.getElementById(id);		
		if(elem){
			elem.style.display = "block";
		}		
}

function hideElementById(id){
		var elem = document.getElementById(id);		
		if(elem){
			elem.style.display = "none";
		}
}

function setElementValue(elem_id, value){
	var elem = document.getElementById(elem_id);
		if(elem){
			elem.value = value;
		}
}

