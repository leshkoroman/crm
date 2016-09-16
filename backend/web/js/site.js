/**
 * 
 * @param integer id
 * @returns boolean 
 * remove panel
 */
function my_close(id) {
    $.ajax({
        url: "/agents/delcomment",
        dataType: 'html',
        type: 'POST',
        data: {id: id},
        success: function (data) {
            if (data == 2) {
                return false;
            } else {
                $('#list_comments').find('#w_' + id).remove();
            }
        }
    });
}

/**
 * Get a random integer between `min` and `max`.
 * 
 * @param {number} min - min number
 * @param {number} max - max number
 * @return {int} a random integer
 */
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}
/**
 * 
 * @param integer days_ago
 * @returns date "Y-m-d H:i:s"
 */
function today(days_ago) {
    var today = new Date();
    today = new Date(today.getTime() - (60 * 60 * 24 * days_ago * 1000))

    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    var HH = today.getHours();
    var II = today.getMinutes();
    var SS = today.getSeconds();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    return (yyyy + '-' + mm + '-' + dd + ' ' + HH + ':' + II + ':' + SS);
}

$(document).ready(function () {
    $('#add_comment').click(function () {
        $('.comment').toggle(500);
    })

    $('#button_text_comment').click(function () {
        text = $('#text_comment').val();
        id = $(this).attr('data-id');
        $.ajax({
            url: "/agents/comment",
            dataType: 'html',
            type: 'POST',
            data: {id_agent: id, text: text},
            success: function (data) {
                if (data == 2) {
                    $('#text_comment').parent().addClass('has-error');
                } else {
                    html = "<div id=\"w_" + id + "\" class=\"x_panel\">\n\
                                <div class=\"x_content\">\n\
                                    <div class=\"row\">\n\
                                        <div class=\"col-md-10 col-xs-12\">\n\
                                            <div class=\"row\">\n\
                                                <div class=\"col-md-12 col-xs-12\">\n\
                                                    <span>" + today(0) + ". </span>\n\
                                                    <span>Добавил: <b><i>" + $('.profile_info').find('h2').text() + "</i></b></span>\n\
                                                    <span>для агента: <b><i>" + $('.agents-update').find('h1').text().replace('Изменить агента:', '') + "</i></b></span>\n\
                                                </div>\n\
                                                <hr>\n\
                                                <div class=\"row\">\n\
                                                    <div class=\"col-md-12 col-xs-12\">" + text + "</div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class=\"col-md-2 col-xs-12\">\n\
                                            <ul id=\"w13\" class=\"nav navbar-right panel_toolbox\" style=\"min-width:0px;\">\n\
                                                <li>\n\
                                                    <a onclick=\"my_close(" + id + ")\" data-id=\"" + data + "\" class=\"close-link\"><i class=\"fa fa-close\"></i></a>\n\
                                                </li>\n\
                                            </ul>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>";
                    if ($('#list_comments').children().length > 0){
                        $('#list_comments').find('.x_panel:first').before(html);
                    }else{
                        $('#list_comments').append(html);
                    }
                    
                    $('.comment').toggle(false);
                }
            }
        });
    })

    $('#text_comment').click(function () {
        $(this).parent().removeClass('has-error');
    })

});