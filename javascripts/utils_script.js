function close() {
    document.location.replace("../php_scripts/exit.php");
    console.log("Closing");
}

function registration_form_control(login_id,pass_id,d_pass_id,button_id){
    button_id ='#' + button_id;
    var bool = check_nick(login_id) & check_first_pass(pass_id,d_pass_id) &
        compare_password(pass_id,d_pass_id);
    if(bool === 0)
    $(button_id).attr('disabled',true);
    else $(button_id).attr('disabled',false);
}

function check_first_pass(id_1, id_2) {
    id_1 = '#'+id_1;
    id_2 = '#'+id_2;
    var input_data = $(id_1).val();
    if(input_data.length < 8){
        $(id_2).attr('disabled',true);
        return false;
    }else {
        $(id_2).attr('disabled',false);
        return true;
    }
}

function check_nick(nick_id) {
    nick_id= '#' + nick_id;
    return $(nick_id).val().length >= 3;
}

function compare_password(pass_id,d_pass_id){
    pass_id = '#' + pass_id;
    d_pass_id = '#' + d_pass_id;
    return $(d_pass_id).val() === $(pass_id).val();
}

function save_state(mode, right, all) {
    document.location.replace("../../php_scripts/set_statistic.php?mode="+mode+"&right="+right+"&all="+all+"&");
}
