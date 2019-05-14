let hidden = true;

function set_mode(name, mode, hidden_div_id) {
    if (!hidden) return;
    hidden = false;
    $('input[name="' + name + '"]').val(mode);
    $("#" + hidden_div_id).css('display', 'block');
}

function cancel(name, hidden_id_div) {
    hidden = true;
    $('input[name="' + name + '"]').val("");
    $("#" + hidden_id_div).css('display', 'none');
}

function select_level(level, tag_name, form_id) {
    $('input[name="' + tag_name + '"]').val(level);
}
