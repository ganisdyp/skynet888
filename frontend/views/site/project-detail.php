<?php

use common\models\ProjectSearch;
use common\models\StorySearch;
use common\models\CharacterSearch;

define('PAGE_NAME', 'project-detail');

$searchModel_project = new ProjectSearch();
$dataProvider_project = $searchModel_project->search(Yii::$app->request->queryParams);
$project = $dataProvider_project->query->where(['id' => $_GET["id"]])->one();
/* Get Story */
$searchModel_story = new StorySearch();
$dataProvider_story = $searchModel_story->search(Yii::$app->request->queryParams);
$story = $dataProvider_story->query->where(['project_id' => $_GET["id"]])->one();
/* Get Character list */
$searchModel_character = new CharacterSearch();
$dataProvider_character = $searchModel_character->search(Yii::$app->request->queryParams);
$characters = $dataProvider_character->query->where(['project_id' => $_GET["id"]])->all();
?>
<div id="page-content">
    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-12">
                <div id="float-menu-wrapper">
                    <ul id="project-menu" class="navbar-nav">
                        <li id="nav-story" class="nav-item active"><a class="nav-link"
                                                                      href="#sec-story"><span>Story</span></a></li>
                        <li id="nav-character" class="nav-item"><a class="nav-link" href="#sec-character"><span>Characters</span></a>
                        </li>
                        <li id="nav-environment" class="nav-item"><a class="nav-link" href="#sec-environment"><span>Environment</span></a>
                        </li>
                        <li id="nav-movie" class="nav-item"><a class="nav-link"
                                                               href="#sec-movie"><span>Moive/Trailer</span></a></li>
                        <li id="nav-screenshot" class="nav-item"><a class="nav-link" href="#sec-screenshot"><span>Screenshot</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 project-content">
                <div class="card-body">
                    <h2><?php echo $project->name; ?></h2>
                    <p><?php echo $project->description; ?></p>
                    <img src="../backend/uploads/project/<?php echo $project->main_photo; ?>" style="max-width: 100%;">
                </div>
                <div id="sec-story">
                    <div class="project-section-head">Story</div>
                    <div class="card-body">
                        <p><?= $story->name; ?></p>
                        <p><?= $story->description; ?></p>
                    </div>
                </div>
                <div id="sec-character">
                    <div class="project-section-head">Characters</div>
                    <div class="card-body">
                        <?php /*
            <div class="row">
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a href="images/mockup/screenshot/1.jpg" data-lightbox="character" data-title="Character Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam."><div class="holder img-4by3"><img class="img-fluid" src="images/mockup/screenshot/1.jpg"></div></a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a href="images/mockup/screenshot/1.jpg" data-lightbox="character" data-title="Character Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam."><div class="holder img-4by3"><img class="img-fluid" src="images/mockup/screenshot/1.jpg"></div></a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a href="images/mockup/screenshot/1.jpg" data-lightbox="character" data-title="Character Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam."><div class="holder img-4by3"><img class="img-fluid" src="images/mockup/screenshot/1.jpg"></div></a>
              </div>
            </div>
            */ ?>
                        <div class="row">
                            <?php foreach ($characters as $character) { ?>
                                <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                     data-animation="fadeIn">
                                    <a class="d-block" data-fancybox="character" href="../backend/uploads/character/<?= $character->main_photo;?>"
                                       data-caption="<?= $character->description;?>">
                                        <img class="img-fluid" src="../backend/uploads/character/<?= $character->main_photo;?>">
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div id="sec-environment">
                    <div class="project-section-head">Environment</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a class="d-block" data-fancybox="environment" href="images/mockup/screenshot/1.jpg"
                                   data-caption="Caption #1 environment Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris.">
                                    <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a class="d-block" data-fancybox="environment" href="images/mockup/screenshot/1.jpg"
                                   data-caption="Caption #2 environment Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
                                    <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a class="d-block" data-fancybox="environment" href="images/mockup/screenshot/1.jpg"
                                   data-caption="Caption #3 environment Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
                                    <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a class="d-block" data-fancybox="environment" href="images/mockup/screenshot/1.jpg"
                                   data-caption="Caption #3 environment Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
                                    <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a class="d-block" data-fancybox="environment" href="images/mockup/screenshot/1.jpg"
                                   data-caption="Caption #3 environment Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
                                    <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a class="d-block" data-fancybox="environment" href="images/mockup/screenshot/1.jpg"
                                   data-caption="Caption #3 environment Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
                                    <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="sec-movie">
                    <div class="project-section-head">Moive/Trailer</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a data-fancybox href="https://www.youtube.com/watch?v=IwbwVpj-Ijc">
                                    <div class="holder img-16by9"><img class="img-fluid"
                                                                       src="images/mockup/screenshot/1.jpg"></div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a data-fancybox href="https://www.youtube.com/watch?v=IwbwVpj-Ijc">
                                    <div class="holder img-16by9"><img class="img-fluid"
                                                                       src="images/mockup/screenshot/1.jpg"></div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a data-fancybox href="https://www.youtube.com/watch?v=IwbwVpj-Ijc">
                                    <div class="holder img-16by9"><img class="img-fluid"
                                                                       src="images/mockup/screenshot/1.jpg"></div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a data-fancybox href="https://www.youtube.com/watch?v=IwbwVpj-Ijc">
                                    <div class="holder img-16by9"><img class="img-fluid"
                                                                       src="images/mockup/screenshot/1.jpg"></div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a data-fancybox href="https://www.youtube.com/watch?v=IwbwVpj-Ijc">
                                    <div class="holder img-16by9"><img class="img-fluid"
                                                                       src="images/mockup/screenshot/1.jpg"></div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a data-fancybox href="https://www.youtube.com/watch?v=IwbwVpj-Ijc">
                                    <div class="holder img-16by9"><img class="img-fluid"
                                                                       src="images/mockup/screenshot/1.jpg"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="sec-screenshot">
                    <div class="project-section-head">Screenshot</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a class="d-block" data-fancybox="screenshot" href="images/mockup/screenshot/1.jpg">
                                    <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a class="d-block" data-fancybox="screenshot" href="images/mockup/screenshot/1.jpg">
                                    <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a class="d-block" data-fancybox="screenshot" href="images/mockup/screenshot/1.jpg">
                                    <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a class="d-block" data-fancybox="screenshot" href="images/mockup/screenshot/1.jpg">
                                    <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a class="d-block" data-fancybox="screenshot" href="images/mockup/screenshot/1.jpg">
                                    <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated"
                                 data-animation="fadeIn">
                                <a class="d-block" data-fancybox="screenshot" href="images/mockup/screenshot/1.jpg">
                                    <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // waypoint for project detail page
    $(document).ready(function () {
        // Make navbtn active when page is scrolled down to slide
        $('#sec-story').waypoint(function (down) {
            $('.nav-item.active').removeClass('active'); // remove the class from the currently selected
            $('#nav-story').addClass('active'); // add the class to the newly clicked link
        });

        $('#sec-character').waypoint(function (down) {
            $('.nav-item.active').removeClass('active');
            $('#nav-character').addClass('active');
        });

        $('#sec-environment').waypoint(function (down) {
            $('.nav-item.active').removeClass('active');
            $('#nav-environment').addClass('active');
        });

        $('#sec-movie').waypoint(function (down) {
            $('.nav-item.active').removeClass('active');
            $('#nav-movie').addClass('active');
        });

        $('#sec-screenshot').waypoint(function (down) {
            $('.nav-item.active').removeClass('active');
            $('#nav-screenshot').addClass('active');
        });
    });

    $(document).ready(function () {
        // Make navbtn active when page is scrolled up to slide
        $('#sec-story').waypoint(function (up) {
            $('.nav-item.active').removeClass('active');
            $('#nav-story').addClass('active');
        }, {offset: -1});

        $('#sec-character').waypoint(function (up) {
            $('.nav-item.active').removeClass('active');
            $('#nav-character').addClass('active');
        }, {offset: -1});

        $('#sec-environment').waypoint(function (up) {
            $('.nav-item.active').removeClass('active');
            $('#nav-environment').addClass('active');
        }, {offset: -1});

        $('#sec-movie').waypoint(function (up) {
            $('.nav-item.active').removeClass('active');
            $('#nav-movie').addClass('active');
        }, {offset: -1});

        $('#sec-screenshot').waypoint(function (up) {
            $('.nav-item.active').removeClass('active');
            $('#nav-screenshot').addClass('active');
        }, {offset: -1});
    });
</script>