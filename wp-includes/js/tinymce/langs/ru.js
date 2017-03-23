// RU lang variables

if (navigator.userAgent.indexOf('Mac OS') != -1) {
// Mac OS browsers use Ctrl to hit accesskeys
    var metaKey = 'Ctrl';
}
else {
    var metaKey = 'Alt';
}

tinyMCE.addToLang('',{
wordpress_more_button : 'Разбить страницу тегом More (' + metaKey + '+t)',
wordpress_page_button : 'Разбить страницу тегом Page',
wordpress_adv_button : 'Спрятать/показать доп. панель (' + metaKey + '+b)',
wordpress_more_alt : 'Разбить...',
wordpress_page_alt : '...страница...',
help_button_title : 'Помощь (' + metaKey + '+h)',
bold_desc : 'Полужирный (Ctrl+B)',
italic_desc : 'Курсив (Ctrl+I)',
underline_desc : 'Подчеркнутый (Ctrl+U)',
link_desc : 'Вставить/редактировать ссылку (' + metaKey + '+a)',
unlink_desc : 'Убрать ссылку (' + metaKey + '+s)',
image_desc : 'Вставить/редактировать картинку (' + metaKey + '+m)',
striketrough_desc : 'Перечеркнутый (' + metaKey + '+k)',
justifyleft_desc : 'Выровнять влево (' + metaKey + '+f)',
justifycenter_desc : 'Выровнять по центру (' + metaKey + '+c)',
justifyright_desc : 'Выровнять вправо (' + metaKey + '+r)',
justifyfull_desc : 'Выровнять по ширине (' + metaKey + '+j)',
bullist_desc : 'Маркированный список (' + metaKey + '+l)',
numlist_desc : 'Нумерованный список (' + metaKey + '+o)',
outdent_desc : 'Убрать отступ (' + metaKey + '+w)',
indent_desc : 'Отступ (' + metaKey + '+q)'
});
