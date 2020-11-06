<?php

class SI_Widget_Iframe extends WP_Widget{
    public function __construct()
    {
        parent::__construct('SI_Widget_Iframe', 'SportIsland - Выводит iframe',
            [
                'name' => 'SportIsland - Выводит iframe',
                'description' => 'Полезен для встраивания видео, карт и т.д',
            ]
        );
    }

    public function form( $instance )
    {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('id-code'); ?>">
                Введите текст:
            </label>
            <textarea
                id="<?php echo $this->get_field_id('id-code'); ?>"
                name="<?php echo $this->get_field_name('code')?>"
                value="<?php echo esc_html($instance['code']); ?>"
                class="widefat"
            >
                <?php echo $instance['code']; ?>
            </textarea>
        </p>
        <?php
    }

    public function widget($args, $instance)
    {
        //args- ключи переданные снаружи
        echo $instance['code'];
    }

    public function update($new_instance, $old_instance)
    {
        return $new_instance;
    }
}