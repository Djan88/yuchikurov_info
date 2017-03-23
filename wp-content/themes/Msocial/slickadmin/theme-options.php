<?php
/**
 * Slick Admin theme options
 *
 * Used to set default theme options
 */
function sa_theme_options() {

    $options = array(
    //Основные
        array(
            'name' => __( 'Основные настройки', 'slickadmin' ),
            'id' => 'tab_main',
            'type' => 'opentab',
        ),

        array(
            'name' => __( 'Видеоролик', 'slickadmin' ),
            'type' => 'text',
            'desc' => 'Вставьте HTML код видео с "YouTube" или похожего видо сервиса',
            'id' => 'video_field',
        ),

        array(
            'name' => __( 'Описание к видео', 'slickadmin' ),
            'type' => 'text',
            'desc' => 'Добавьте текст описания к видеоролику',
            'id' => 'phone_field',
        ),

        array(
            'type' => 'closetab',
        )

    );

    return $options;

}

?>
