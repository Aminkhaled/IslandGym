<?php
/*
Template Name: Шаблон для главной страницы
 */

get_header();
?>

<main class="main-content">
    <h1 class="sr-only"> Домашняя страница спортклуба SportIsland. </h1>
    <div class="banner">
        <span class="sr-only">Будь в форме!</span>
        <a href="<?php echo get_post_type_archive_link('services'); ?>" class="banner__link btn">записаться</a>
    </div>

    <?php
    if (is_active_sidebar('si-main-state') ){
        dynamic_sidebar('si-main-state');
    }
    ?>
    <?php
    $sales = get_posts([
        'numberposts' => -1,
        'category_name' => 'sales',
        'meta_key' => 'sales_actual',
        'meta_value' => '1',
    ]);
    if ($sales) :
    ?>
    <section class="sales">
        <div class="wrapper">
            <header class="sales__header">
                <h2 class="main-heading sales__h"> акции и скидки </h2>
                <p class="sales__btns">
                    <button class="sales__btn sales__btn_prev">
                        <span class="sr-only"> Предыдущие акции </span>
                    </button>
                    <button class="sales__btn sales__btn_next">
                        <span class="sr-only"> Следующие акции </span>
                    </button>
                </p>
            </header>
            <div class="sales__slider slider">

                <?php
                global $post;
                foreach ( $sales as $post ):
                    setup_postdata( $post )
                ?>
                <section class="slider__slide stock">
                    <a href="<?php the_permalink(); ?>" class="stock__link" aria-label="Подробнее об акции Скидка 30% на занятия с тренером">
                        <?php the_post_thumbnail('full', ['class' => 'stock__thumb']); ?>
                        <h3 class="stock__h"><?php the_title(); ?></h3>
                        <p class="stock__text"><?php echo get_the_excerpt(); ?></p>
                        <span class="stock__more  link-more_inverse link-more">Подробнее</span>
                    </a>
                </section>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
    endif;
    ?>
    <section class="cards cards_index">
        <div class="wrapper">
            <h2 class="main-heading cards__h"> клубные карты </h2>
            <ul class="cards__list row">
                <?php
                $query = new WP_Query([
                    'numberposts' => -1,
                    'post_type' => 'cards',
                    'meta_key' => 'club_order',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                ]);
                $cards = $query->posts;
                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ):
                        $query->the_post();
                        $profit_class = '';
                    if( get_field( 'club_profit' )) {
                        $profit_class = 'card_profitable';
                    }
                    $benefits = get_field('club_list');
                    $benefits = explode("\n", $benefits);
                    $bg = get_field('club_bg');
                    $default = _si_assets_path('img/index__cards_card1.jpg');
                    $bg = $bg ?
                        "style=\"background-image: url(${bg})\";" :
                        "style=\"background-image: url(${default})\";";
                ?>
                <li class="card <?php echo $profit_class; ?>" <?php echo $bg; ?>>
                    <h3 class="card__name"><?php the_title(); ?></h3>
                    <p class="card__time">
                        <?php the_field('club_timestart'); ?>
                        &ndash;
                        <?php the_field('club_timeend'); ?>
                    </p>
                    <p class="card__price price"> <?php the_field('club_price'); ?> <span class="price__unit" aria-label="рублей в месяц">р.-/мес.</span>
                    </p>
                    <ul class="card__features">
                        <?php
                        foreach ($benefits as $benefit) :
                            ?>
                            <li class="card__feature"><?php echo $benefit; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a data-post-id="<?php echo $id; ?>" href="#modal-form" class="card__buy btn btn_modal">купить</a>
                </li>
                <?php
                endwhile;
                wp_reset_postdata();
                endif; ?>
            </ul>
        </div>
    </section>
</main>

<?php
get_footer();
?>
