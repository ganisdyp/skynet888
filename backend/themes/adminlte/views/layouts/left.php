<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
       <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="<?/*= $directoryAsset */?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->

        <!-- search form -->
       <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Menu for Admin', 'options' => ['class' => 'header']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                            'active'=>true,
                        'label' => 'Content Management',
                        'icon' => 'edit',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Brands',
                                'icon' => 'pencil',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Manage brand', 'icon' => 'reorder', 'url' => Yii::$app->getHomeUrl().'content/brand/index',],
                                ],
                            ],
                            [
                                    'active' => true,
                                'label' => 'Products',
                                'icon' => 'file-photo-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Product categories', 'icon' => 'plus', 'url' => Yii::$app->getHomeUrl().'content/producttype/index',],
                                    ['label' => 'Manage products', 'icon' => 'th-large', 'url' => Yii::$app->getHomeUrl().'content/product/index',],
                                    //  ['label' => 'Manage product profiles', 'icon' => 'circle-o', 'url' => '#',],
                                ],
                            ],
                            [
                                    'active'=>true,
                                'label' => 'Blogs',
                                'icon' => 'bullhorn',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Blog categories', 'icon' => 'plus', 'url' => Yii::$app->getHomeUrl().'content/blogtype/index',],
                                    ['label' => 'Manage blogs', 'icon' => 'th-large', 'url' => Yii::$app->getHomeUrl().'content/blog/index',],
                                    // ['label' => 'Manage activites photos', 'icon' => 'circle-o', 'url' => '#',],
                                ],
                            ],
                        ],
                    ],
                    ['label' => 'User Management', 'icon' => 'user', 'url' => ['/personal/profile/index']],
                ],
            ]
        ) ?>

    </section>

</aside>
