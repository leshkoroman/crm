/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
                if(data ==2){
                    $('#text_comment').parent().addClass('has-error');
                }
                if(data == 1){
                    html = "<div id=\"w16\" class=\"x_panel\">\n\
                                <div class=\"x_content\">\n\
                                    <div class=\"row\">\n\
                                        <div class=\"col-md-10 col-xs-12\">\n\
                                            <div class=\"row\">\n\
                                                <div class=\"col-md-12 col-xs-12\">\n\
                                                    <span>2016-09-16 13:40:54. </span>\n\
                                                    <span>Добавил: <b><i>"+$('.profile_info').find('h2').text()+"</i></b></span>\n\
                                                    <span>для агента: <b><i>"+$('.agents-update').find('h1').text().replace('Изменить агента:','')+"</i></b></span>\n\
                                                </div>\n\
                                                <hr>\n\
                                                <div class=\"row\">\n\
                                                    <div class=\"col-md-12 col-xs-12\">"+text+"</div>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                        <div class=\"col-md-2 col-xs-12\">\n\
                                            <ul id=\"w13\" class=\"nav navbar-right panel_toolbox\" style=\"min-width:0px;\">\n\
                                                <li>\n\
                                                    <a data-id=\"5\" class=\"close-link\"><i class=\"fa fa-close\"></i></a>\n\
                                                </li>\n\
                                            </ul>\n\
                                        </div>\n\
                                    </div>\n\
                                </div>\n\
                            </div>";
                    
                }
            }
        });
    })
    
    $('#text_comment').click(function(){
        $(this).parent().removeClass('has-error');
    })
});