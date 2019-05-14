function addition_check(left_operand_id, right_operand_id, answer_operand_id){
	var left = Number($("#"+left_operand_id).text());
	var right = Number($("#"+right_operand_id).text());
	var answer = document.getElementById(answer_operand_id).value;
	return (left + right == answer);
}
function sub_check(left_operand_id, right_operand_id, answer_operand_id){
	var left = Number($("#"+left_operand_id).text());
	var right = Number($("#"+right_operand_id).text());
	var answer = document.getElementById(answer_operand_id).value;
	return (left - right == answer);
}
function mult_check(left_operand_id, right_operand_id, answer_operand_id){
	var left = Number($("#"+left_operand_id).text());
	var right = Number($("#"+right_operand_id).text());
	var answer = document.getElementById(answer_operand_id).value;
	return (left * right == answer);
	
}function div_check(left_operand_id, right_operand_id, answer_operand_id){
	var left = Number($("#"+left_operand_id).text());
	var right = Number($("#"+right_operand_id).text());
	var answer = document.getElementById(answer_operand_id).value;
	return (left / right == answer);
}
function sqr_check(left_operand_id, right_operand_id, answer_operand_id){
	var left = Number($("#"+left_operand_id).text());
	var right = Number($("#"+right_operand_id).text());
	var answer = document.getElementById(answer_operand_id).value;
	return (Math.pow(left, right) == answer);
}