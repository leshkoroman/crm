/**
 * 
 * @param integer id
 * @param object o
 * @returns boolean
 */
function task_do(id, o) {
    text = o.parent().find('#text_task_result').val();
    text1 = $('#task_comment_' + id).text();
    if (!text) {
        o.parent().addClass('has-error');
        return false;
    }
    $.ajax({
        url: "/agents/donetask",
        dataType: 'html',
        type: 'POST',
        data: {id: id, text: text},
        success: function (data) {
            if (data == '_2') {
                o.parent().addClass('has-error');
                return false;
            } else {
                task_name = $("#hidden_tasks_name" + id).val()
                $('#tt_' + id).remove();
                html = "<div id=\"w_" + data + "\" class=\"x_panel\">\n\
                                <div class=\"x_content\">\n\
                                    <div class=\"row\">\n\
                                        <div class=\"col-md-10 col-xs-12\">\n\
                                            <div class=\"row\">\n\
                                                <div class=\"col-md-12 col-xs-12\">\n\
                                                    <span class=\"task_footer\">Задача </span>\n\
                                                    <span>" + today(0) + ". </span>\n\
                                                    <span>Добавил: <b><i>" + $('.profile_info').find('h2').text() + "</i></b></span>\n\
                                                    <span>для агента: <b><i>" + $('.agents-update').find('h1').text().replace('Изменить агента:', '') + "</i></b></span>\n\
                                                </div>\n\
                                                <hr>\n\
                                                <div class=\"row\">\n\
                                                    <div class=\"col-md-12 col-xs-12 task_decor\">" + text1 + "</div>\n\
                                                </div>\n\
                                                <hr/>\n\
                                                <div class=\"col-md-12 col-xs-12\">\n\
                                                    <span>Задача: <b>" + task_name + ".</b></span> <span>Результат: <b>" + text + "</b></span>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class=\"col-md-2 col-xs-12\">\n\
                                            <ul id=\"w13\" class=\"nav navbar-right panel_toolbox\" style=\"min-width:0px;\">\n\
                                                <li>\n\
                                                    <a onclick=\"my_close(" + data + ")\" data-id=\"" + data + "\" class=\"close-link\"><i class=\"fa fa-close\"></i></a>\n\
                                                </li>\n\
                                            </ul>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>";
                if ($('#list_comments').children().length > 0) {
                    $('#list_comments').find('.x_panel:first').before(html);
                } else {
                    $('#list_comments').append(html);
                }
                return true;
            }
        }
    });
}

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
                return true;
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
        $('.comment').toggle(300);
    });

    $('#add_task').click(function () {
        $('.task').toggle(300);
    });

    $('#button_text_task_close').click(function () {
        $('.task').toggle(false);
    });

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
                                                    <span class='comment_footer'> Комментарий </span><span>" + today(0) + ". </span>\n\
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
                    if ($('#list_comments').children().length > 0) {
                        $('#list_comments').find('.x_panel:first').before(html);
                    } else {
                        $('#list_comments').append(html);
                    }

                    $('.comment').toggle(false);
                }
            }
        });
    })

    $('#text_comment').click(function () {
        $(this).parent().removeClass('has-error');
    });

    $('.text_task_result').click(function () {
        $(this).parent().removeClass('has-error');
    });


    $('#button_text_task').click(function () {
        task_text_comment = $('#task_text_comment').val();
        task_date = $('#task_date').val();
        task_type = $('#task_type').val();
        rr=$('#task_type').find('option');
        rr.each(function(){
           if($(this).prop('selected')){
               t_name=$(this).text();
           }
        });
        id = $(this).attr('data-id');     
        if (!task_type || !task_date) {
            return false;
        }
        $.ajax({
            url: "/agents/savetask",
            dataType: 'html',
            type: 'POST',
            data: {id: id, task_text_comment: task_text_comment, task_date: task_date, task_type:task_type},
            success: function (data) {
                if (data == '_2') {
                    return false;
                } else {
                    Data = JSON.parse(data);
                    html="<div id=\"tt_"+Data.id+"\" class=\"x_panel\" style=\"border:solid "+Data.color+"\">\n\
                            <div class=\"x_title\">\n\
                                <h2>"+t_name+": исполнить до "+Data.date_to.replace('00:00:00','')+"</h2>\n\
                                <div class=\"clearfix\"></div>\n\
                            </div>\n\
                            <div class=\"x_content\">\n\
                                <input type=\"hidden\" name=\"ddd\" value=\""+t_name+"\" id=\"hidden_tasks_name"+Data.id+"\">\n\
                                <div class=\"row\">\n\
                                    <div class=\"col-md-12 col-xs-12\">\n\
                                        <div class=\"row\">\n\
                                            <div class=\"col-md-12 col-xs-12\">\n\
                                                <span>Добавил "+today(0)+". </span>\n\
                                                <span>"+$('.profile_info').find('h2').text()+"</span>\n\
                                                <span>По агенту "+$('.agents-update').find('h1').text().replace('Изменить агента:', '')+"</span>\n\
                                            </div>\n\
                                            <hr>\n\
                                        <div class=\"row\">\n\
                                            <div class=\"col-md-12 col-xs-12\" id=\"task_comment_"+Data.id+"\">"+Data.comment+"</div>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                            <div class=\"row\">\n\
                                <div class=\"form-group\" style=\"margin-bottom: 0px;\">\n\
                                    <input type=\"text\" id=\"text_task_result\" class=\"form-control text_task_result\" name=\"task_result\" rows=\"6\" placeholder=\"Добавить результат\" style=\"resize:none\">\n\
                                    <button data-id=\""+Data.id+"\" type=\"button\" onclick=\"task_do("+Data.id+", $(this))\" class=\"btn my_button_save_comment\">Выполнить</button>\n\
                                </div>\n\
                            </div>\n\
                        </div>\n\
                    </div>";
                    if ($('.my_comments_task').children().length > 0) {
                        $('.my_comments_task').find('div:first').before(html);
                    } else {
                        $('.my_comments_task').append(html);
                    }
                    $('.task').toggle(false);
                }
            }
        });

    })


});