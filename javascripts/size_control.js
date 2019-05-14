var m_width = window.screen.availWidth;
var s_heigth = screen.availHeight - 90;
function alert_info() {
    alert("outer height - "+window.outerHeight + " height - " + window.innerHeight
    + " sub - " + (window.outerHeight - window.innerHeight));
}

function set_sizes(className) {
    className = '.'+className;
    $(className).css({
        'min-width': m_width - 1,
        'min-height' : s_heigth - 1
    });
}

function check_first_pass(id_1, id_2) {
    id_1 = '#'+id_1;
    id_2 = '#'+id_2;
    var input_data = $(id_1).val();
    if(input_data.length < 8){
        $(id_2).attr('disabled',true);
    }else {
        $(id_2).attr('disabled',false);
    }
}

function compare_password(){
    if($('#double_password_field').val() !== $('#password_field').val()){
        $('#reg_input_button').attr('disabled',true);
    }else {
        $('#reg_input_button').attr('disabled',false);
    }
}

