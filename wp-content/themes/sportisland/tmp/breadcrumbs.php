<!--<ul class="breadcrumbs">-->
<!--    <li class="breadcrumbs__item breadcrumbs__item_home">-->
<!--        <a href="index.html" class="breadcrumbs__link">Главная</a>-->
<!--    </li>-->
<!--    <li class="breadcrumbs__item">-->
<!--        <a href="blog.html" class="breadcrumbs__link">Блог</a>-->
<!--    </li>-->
<!--</ul>-->
<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>