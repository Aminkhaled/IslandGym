<?php

$widgets = [
    'widget-text.php',
    'widget-contacts.php',
    'widget-social-links.php',
    'widget-iframe.php',
    'widget-info.php',
    'widget-main-state.php',
];

foreach ($widgets as $w ){
    require_once( __DIR__ . '/inc/' . $w);
}

add_action('after_setup_theme', 'si_setup');
add_action('wp_enqueue_scripts', 'si_scripts');
add_action('widgets_init', 'si_register');
add_action('init', 'si_register_types');
add_action( 'add_meta_boxes', 'si_meta_boxes');
add_action( 'save_post', 'si_save_like_meta' );
add_action( 'admin_init', 'si_register_slogan' );
add_action('admin_post_nopriv_si-modal-form', 'si_modal_form_handler');
add_action('admin_post_si-modal-form', 'si_modal_form_handler');
add_action('wp_ajax_nopriv_post-likes', 'si_likes');
add_action('wp_ajax_post-likes', 'si_likes');
add_action('manage_posts_custom_column', 'si_like_column', 5, 2);
add_shortcode( 'si-paste-link', 'si_paste_link' );
add_filter('si_widget_text', 'do_shortcode');
add_filter('manage_posts_columns', 'si_add_col_likes');

function si_setup(){
    register_nav_menu( 'menu-header', 'Меню в шапке' );
    register_nav_menu( 'menu-footer', 'Меню в подвале' );

    add_theme_support( 'custom-logo' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
//    add_theme_support( 'menus' );
}

function si_scripts(){
    wp_enqueue_script('js',
        _si_assets_path('js/js.js'),
        [],
        '1.0',
    true
    );
    wp_enqueue_style(
        'si-style',
        _si_assets_path('css/styles.css'),
        [],
        '1.0',
        'all'
    );
}

function si_register(){
    register_sidebar([
        'name' => 'Контакты в шапке сайта',
        'id' => 'si-header',
        'before_widget' => null,
        'after_widget' => null,
    ]);
    register_sidebar([
        'name' => 'Контакты в подвале сайта',
        'id' => 'si-footer',
        'before_widget' => null,
        'after_widget' => null,
    ]);
    register_sidebar([
        'name' => 'Сайдбар в подвале сайта - колонка 1',
        'id' => 'si-footer-col1',
        'before_widget' => null,
        'after_widget' => null,
    ]);
    register_sidebar([
        'name' => 'Сайдбар в подвале сайта - колонка 2',
        'id' => 'si-footer-col2',
        'before_widget' => null,
        'after_widget' => null,
    ]);
    register_sidebar([
        'name' => 'Сайдбар в подвале сайта - колонка 3',
        'id' => 'si-footer-col3',
        'before_widget' => null,
        'after_widget' => null,
    ]);
    register_sidebar([
        'name' => 'Карта',
        'id' => 'si-map',
        'before_widget' => null,
        'after_widget' => null,
    ]);
    register_sidebar([
        'name' => 'Сайдбар под картой',
        'id' => 'si-after-map',
        'before_widget' => null,
        'after_widget' => null,
    ]);
    register_sidebar([
        'name' => 'Сайдбар с главной статьей',
        'id' => 'si-main-state',
        'before_widget' => null,
        'after_widget' => null,
    ]);

    register_widget( 'SI_Widget_Text' );
    register_widget( 'SI_Widget_Contacts' );
    register_widget( 'SI_Widget_Social_Links' );
    register_widget( 'SI_Widget_Iframe' );
    register_widget( 'SI_Widget_Info' );
    register_widget( 'SI_Widget_Main_State' );
}

function si_register_types( ){
    register_post_type( 'services', [
        'labels' => [
            'name'               => 'Услуги', // основное название для типа записи
            'singular_name'      => 'Услуга', // название для одной записи этого типа
            'add_new'            => 'Добавить новую услугу', // для добавления новой записи
            'add_new_item'       => 'Добавить новую услугу', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать услугу', // для редактирования типа записи
            'new_item'           => 'Новая услуга', // текст новой записи
            'view_item'          => 'Смотреть услуги', // для просмотра записи этого типа.
            'search_items'       => 'Искать услуги', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Услуги', // название меню
        ],
        'public'              => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-buddicons-activity',
        'hierarchical'        => false,
        'supports'            => ['title'],
        'has_archive' => true
    ]);

    register_post_type( 'trainers', [
        'labels' => [
            'name'               => 'Тренеры', // основное название для типа записи
            'singular_name'      => 'Тренер', // название для одной записи этого типа
            'add_new'            => 'Добавить нового тренера', // для добавления новой записи
            'add_new_item'       => 'Добавить нового тренера', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать тренера', // для редактирования типа записи
            'new_item'           => 'Новый тренер', // текст новой записи
            'view_item'          => 'Смотреть тренера', // для просмотра записи этого типа.
            'search_items'       => 'Искать тренера', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Тренеры', // название меню
        ],
        'public'              => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-buddicons-buddypress-logo',
        'hierarchical'        => false,
        'supports'            => ['title'],
        'has_archive' => true
    ]);

    register_post_type( 'schedule', [
        'labels' => [
            'name'               => 'Занятия', // основное название для типа записи
            'singular_name'      => 'Занятие', // название для одной записи этого типа
            'add_new'            => 'Добавить занятие', // для добавления новой записи
            'add_new_item'       => 'Добавить занятие', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать занятие', // для редактирования типа записи
            'new_item'           => 'Новое занятие', // текст новой записи
            'view_item'          => 'Смотреть занятие', // для просмотра записи этого типа.
            'search_items'       => 'Искать занятие', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Занятия', // название меню
        ],
        'public'              => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-games',
        'hierarchical'        => false,
        'supports'            => ['title'],
        'has_archive' => true
    ]);

    register_post_type( 'prices', [
        'labels' => [
            'name'               => 'Прайсы', // основное название для типа записи
            'singular_name'      => 'Прайс', // название для одной записи этого типа
            'add_new'            => 'Добавить прайс', // для добавления новой записи
            'add_new_item'       => 'Добавить прайс', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать прайс', // для редактирования типа записи
            'new_item'           => 'Новый прайс', // текст новой записи
            'view_item'          => 'Смотреть прайс', // для просмотра записи этого типа.
            'search_items'       => 'Искать прайс', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Прайсы', // название меню
        ],
        'public'              => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-cart',
        'hierarchical'        => false,
        'show_in_rest'        => true,
        'supports'            => ['title', 'editor'],
        'has_archive' => true
    ]);

    register_post_type( 'cards', [
        'labels' => [
            'name'               => 'Карты', // основное название для типа записи
            'singular_name'      => 'Карта', // название для одной записи этого типа
            'add_new'            => 'Добавить карту', // для добавления новой записи
            'add_new_item'       => 'Добавить карту', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать карту', // для редактирования типа записи
            'new_item'           => 'Новая карта', // текст новой записи
            'view_item'          => 'Смотреть карту', // для просмотра записи этого типа.
            'search_items'       => 'Искать карту', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Карты', // название меню
        ],
        'public'              => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-menu-alt3   ',
        'hierarchical'        => false,
        'supports'            => ['title'],
        'has_archive' => false
    ]);

    register_post_type( 'orders', [
        'labels' => [
            'name'               => 'Заявки', // основное название для типа записи
            'singular_name'      => 'Заявка', // название для одной записи этого типа
            'add_new'            => 'Добавить заявку', // для добавления новой записи
            'add_new_item'       => 'Добавить заявки', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактировать заявки', // для редактирования типа записи
            'new_item'           => 'Новая заявка', // текст новой записи
            'view_item'          => 'Смотреть заявки', // для просмотра записи этого типа.
            'search_items'       => 'Искать заявки', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Заявки', // название меню
        ],
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-text-page',
        'hierarchical'        => false,
        'supports'            => ['title'],
        'has_archive'         => false
    ]);

    register_taxonomy('schedule_days', ['schedule'], [
        'labels'                => [
            'name'              => 'Дни недели',
            'singular_name'     => 'День',
            'search_items'      => 'Найти день недели',
            'all_items'         => 'Все дни недели',
            'view_item '        => 'Посмотреть дни недели',
            'edit_item'         => 'Редактировать дни недели',
            'update_item'       => 'Обновить',
            'add_new_item'      => 'Добавить день недели',
            'new_item_name'     => 'Добавить день недели',
            'menu_name'         => 'Все дни недели',
        ],
        'description'           => '',
        'public'                => true,
        'hierarchical'          => true
    ]);

    register_taxonomy('places', ['schedule'], [
        'labels'                => [
            'name'              => 'Залы',
            'singular_name'     => 'Зал',
            'search_items'      => 'Найти зал',
            'all_items'         => 'Все залы',
            'view_item '        => 'Посмотреть зал',
            'edit_item'         => 'Редактировать зал',
            'update_item'       => 'Обновить',
            'add_new_item'      => 'Добавить зал',
            'new_item_name'     => 'Добавить зал',
            'menu_name'         => 'Все залы',
        ],
        'description'           => '',
        'public'                => true,
        'hierarchical'          => true
    ]);
}

function si_paste_link( $attr ){
    $params = shortcode_atts([ //Сливаются данные
        'link' => '',
        'text' => '',
        'type' => 'link'
    ], $attr);
    $params['text'] = $params['text'] ? $params['text'] : $params['link'];
    if( $params['link'] ){
        $protocol = '';
        switch ( $params['type'] ){
            case 'email':
                $protocol = 'mailto:';
                break;
            case 'phone':
                $protocol = 'tel:';
                $params['link'] = preg_replace('/[^+0-9]/', '', $params['link']);
                break;
            default:
                $protocol = '';
                break;
        }
        $link = $protocol . $params['link'];
        $text = $params['text'];
        return "<a href=\"${link}\">${text}</a>";
    } else {
        return '';
    }
}

function si_meta_boxes(){
    add_meta_box(
        'si-like',
        'Кол-во лайков: ',
        'si_meta_like_cb',
        'post'
    );
    $fields = [
            'si_order_date' => 'Дата заявки: ',
            'si_order_name' => 'Имя клиента: ',
            'si_order_phone' => 'Номер телефона: ',
            'si_order_choice' => 'Выбор клиента: ',
    ];
    foreach ($fields as $slug => $text){
        add_meta_box(
            $slug,
            $text,
            'si_order_fields_cb',
            'orders',
            'advanced',
            'default',
            $slug
        );
    }
}

function si_register_slogan(){
    add_settings_field(
        'si_option_field_slogan',
        'Слоган вашего сайта: ',
        'si_option_slogan_cb',
        'general',
        'default',
        ['label_for' => 'si_option_field_slogan']
    );
    register_setting(
        'general',
        'si_option_field_slogan',
        'strval'
    );
}

function si_option_slogan_cb( $args ){
    $slug = $args['label_for'];
    ?>
    <input
        type="text"
        id="<?php echo $slug; ?>"
        value="<?php echo get_option( $slug ); ?>"
        name="<?php echo $slug; ?>"
        class="regular-text code"
    >
<?php
}

function si_meta_like_cb( $post_obj ){
    $likes = get_post_meta( $post_obj->ID, 'si-like', true);
    $likes = $likes ? $likes : 0;
//    echo "<input type=\"text\" name=\"si-like\" value=\"${likes}\"";
    echo '<p>' . $likes . '</p>';
}

function si_order_fields_cb( $post_obj, $slug ){
    $slug = $slug['args'];
    switch ( $slug ){
        case 'si_order_date':
            $date = $post_obj->post_date;
            break;
        case 'si_order_choice':
            $id = get_post_meta( $post_obj->ID, $slug, true);
            $title = get_the_title( $id );
            $type = get_post_type_object( get_post_type( $id ) )->labels->singular_name;
            $date = 'Клиент выбрал: ' . $title . ' из раздела ' . $type;
            break;
        default:
            $date = get_post_meta( $post_obj->ID, $slug, true);
            $date = $date ? $date : 'Нет данных';
            break;
    }
    echo '<span>' . $date . '</span>';
}

function si_save_like_meta( $post_id ){
    if( isset( $_POST['si-like'] ) ){
        update_post_meta( $post_id, 'si-like', $_POST['si-like'] );
    }
}

function si_modal_form_handler(){
    $name = $_POST['si-user-name'] ? $_POST['si-user-name'] : 'Аноним';
    $phone = $_POST['si-user-phone'] ? $_POST['si-user-phone'] : 'false';
    $choice = $_POST['form-post-id'] ? $_POST['form-post-id'] : 'empty';
    if( $phone ) {
        $name = wp_strip_all_tags( $name );
        $phone = wp_strip_all_tags( $phone );
        $choice = wp_strip_all_tags( $choice );
        $id = wp_insert_post( wp_slash([
                'post_title' => 'Заявка номер',
            'post_type' => 'orders',
            'post_status' => 'publish',
            'meta_input' => [
                    'si_order_name' => $name,
                    'si_order_phone' => $phone,
                    'si_order_choice' => $choice,
            ]
        ]) );
        if ( $id !== 0 ){
            wp_update_post([
               'ID' => $id,
                'post_title' => 'Заявка номер' . $id
            ]);
            update_field('orders_status', 'new', $id);
        }
    }
    header('Location: ' . home_url());
}

function si_likes() {
    $id = $_POST['id'];
    $todo = $_POST['todo'];
    $current_data = get_post_meta('si-like', true);
    $current_data = $current_data ? $current_data : 0;
    if ( $todo == 'plus'){
        $current_data++;
    } else {
        $current_data--;
    }
    $res = update_post_meta( $id, 'si-like', $current_data );
    if ( $res ) {
        echo $current_data;
        wp_die();
    } else {
        wp_die('Лайк не сохранился. Попробуйте еще раз', 500);
    }
}

function si_like_column( $col_name, $id ){
    if ( $col_name !== 'col_likes' ) return;
    $likes = get_post_meta( $id, 'si-like', true);
    echo $likes ? $likes : 0;
}

function si_add_col_likes( $defaults ){
    $type = get_current_screen();
    if ($type->post_type === 'post') {
        $defaults['col_likes'] = "Лайки";
    }
    return $defaults;
}

function _si_assets_path( $path ){
    return get_template_directory_uri() . '/assets/' . $path;
}