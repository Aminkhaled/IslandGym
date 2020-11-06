<?php

class SI_Widget_Main_State extends WP_Widget{
    public function __construct()
    {
        parent::__construct('SI_Widget_Main_State', 'SportIsland - Виджет с главной статьей',
            [
                'name' => 'SportIsland - Виджет с главной статьей',
                'description' => 'Выводит статью по выбору на главной странице',
            ]
        );
    }

    public function form( $instance )
    {
        $posts = get_posts();
        ?>
        <label for="<?php echo $this->get_field_id('id-post'); ?>">
            Выберите запись:
        </label>
        <select
            id="<?php echo $this->get_field_id('id-post'); ?>"
            name="<?php echo $this->get_field_name('post')?>"
            class="widefat"
        >
            <?php
            foreach ( $posts as $post ):
                ?>
                <option
                    value="<?php echo $post->ID; ?>"
                    <?php// selected( $instance['post'], $post, true); ?>
                >
                    <?php echo $post->post_title; ?>
                </option>
            <?php
            endforeach;
            ?>
        </select>
        <?php
    }

    public function widget($args, $instance)
    {
        $post = (
        get_posts([
            'include' => $instance,
            'post_type' => array('post', 'attachment')
        ])[0]
        );
        ?>
        <article class="about">
        <div class="wrapper about__flex">
            <div class="about__wrap">
                <h2 class="main-heading about__h"><?php echo $post->post_title ?></h2>
                <p class="about__text"><?php echo $post->post_content; ?></p>
                <a href="<?php echo get_post_permalink( $post->ID ); ?>" class="about__link btn">подробнее</a>
            </div>
            <figure class="about__thumb">
                <?php echo get_the_post_thumbnail( $post->ID, 'full' );?>
            </figure>
        </div>
    </article>
<?php
    }

    public function update($new_instance, $old_instance)
    {
        return $new_instance;
    }
}