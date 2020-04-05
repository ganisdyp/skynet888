<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="<? /*= $directoryAsset */ ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
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
                        'active' => true,
                        'label' => 'Content Management',
                        'icon' => 'x',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Index',
                                'icon' => 'home',
                                'url' => ['/content/home/update?id=1'],

                            ],
                            [
                                'label' => 'About Us',
                                'icon' => 'commenting',
                                'url' => ['/content/about/update?id=1'],

                            ],
                            [
                                'active' => true,
                                'label' => 'Projects',
                                'icon' => 'file-o',
                                'url' => '#',
                                'items' => [
                                    [
                                        'label' => 'Project Overview',
                                        'icon' => 'file-o',
                                        'url' => ['/content/projectov/update?id=1'],

                                    ],
                                    ['label' => 'Manage project', 'icon' => 'reorder', 'url' => Yii::$app->getHomeUrl() . 'content/project/index'],
                                        ['label' => 'Story', 'icon' => 'file', 'url' => Yii::$app->getHomeUrl() . 'content/story/index'],
                                    ['label' => 'Characters', 'icon' => 'group', 'url' => Yii::$app->getHomeUrl() . 'content/character/index'],
                                    ['label' => 'Environment', 'icon' => 'envira', 'url' => Yii::$app->getHomeUrl() . 'content/environment/index'],
                                    ['label' => 'Movie / Trailor', 'icon' => 'file-video-o', 'url' => Yii::$app->getHomeUrl() . 'content/movie/index'],
                                      ['label' => 'Screenshot', 'icon' => 'picture-o', 'url' => Yii::$app->getHomeUrl() . 'content/screenshot/index']
                                ],
                            ],
                            [
                                'active' => true,
                                'label' => 'News',
                                'icon' => 'bullhorn',
                                'url' => Yii::$app->getHomeUrl() . 'content/blog/update?id=1',
                            ],
                            [
                                'label' => 'Career',
                                'icon' => 'pencil-square-o',
                                'url' => ['/content/career/update?id=1'],

                            ],
                            [
                                'label' => 'Contact',
                                'icon' => 'phone-square',
                                'url' => ['/content/contact/update?id=1'],

                            ],
                        ],
                    ],
                    ['label' => 'User Management', 'icon' => 'user', 'url' => ['/personal/profile/index']],
                ],
            ]
        ) ?>

    </section>

</aside>
