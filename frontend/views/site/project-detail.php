<?php
use common\models\ProjectSearch;
define('PAGE_NAME', 'project-detail');

$searchModel_project = new ProjectSearch();
$dataProvider_project = $searchModel_project->search(Yii::$app->request->queryParams);
$project = $dataProvider_project->query->where(['id'=>$_GET["id"]])->one();

?>
<div id="page-content">
  <div class="container-fluid">
    <div class="row my-5">
      <div class="col-12">
        <div id="float-menu-wrapper">
          <ul id="project-menu" class="navbar-nav">
            <li id="nav-story" class="nav-item active"><a class="nav-link" href="#sec-story"><span>Story</span></a></li>
            <li id="nav-character" class="nav-item"><a class="nav-link" href="#sec-character"><span>Characters</span></a></li>
            <li id="nav-environment" class="nav-item"><a class="nav-link" href="#sec-environment"><span>Environment</span></a></li>
            <li id="nav-movie" class="nav-item"><a class="nav-link" href="#sec-movie"><span>Moive/Trailer</span></a></li>
            <li id="nav-screenshot" class="nav-item"><a class="nav-link" href="#sec-screenshot"><span>Screenshot</span></a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-8 project-content">
        <div class="card-body">
          <h2><?php echo $project->name; ?></h2>
        <p><?php echo $project->description; ?></p>
            <img src="../backend" style="max-width: 100%;">
        </div>
        <div id="sec-story">
          <div class="project-section-head">Story</div>
          <div class="card-body">
            <p>Sit amet consectetur adipiscing elit. Scelerisque fermentum dui faucibus in ornare quam viverra orci sagittis. Ante in nibh mauris cursus mattis molestie a. Dictum sit amet justo donec enim. Vestibulum sed arcu non odio euismod lacinia at quis. Nunc lobortis mattis aliquam faucibus purus in massa. Sit amet mattis vulputate enim nulla aliquet porttitor lacus luctus. Volutpat blandit aliquam etiam erat. Sit amet risus nullam eget felis eget nunc lobortis mattis. Tincidunt dui ut ornare lectus sit amet. Urna cursus eget nunc scelerisque viverra mauris in aliquam. Natoque penatibus et magnis dis. Justo donec enim diam vulputate ut pharetra sit amet. Sit amet venenatis urna cursus eget nunc scelerisque viverra. Nibh sit amet commodo nulla facilisi nullam vehicula ipsum. Non nisi est sit amet facilisis. Erat imperdiet sed euismod nisi. Mi proin sed libero enim sed faucibus turpis. Pulvinar elementum integer enim neque volutpat. Mi tempus imperdiet nulla malesuada pellentesque elit eget gravida cum.</p>
            <p>Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Egestas pretium aenean pharetra magna ac placerat vestibulum. Sed nisi lacus sed viverra tellus in hac. Magnis dis parturient montes nascetur ridiculus mus. Potenti nullam ac tortor vitae purus faucibus ornare. Tortor posuere ac ut consequat semper viverra. Quis imperdiet massa tincidunt nunc pulvinar sapien et. Ut faucibus pulvinar elementum integer enim neque volutpat ac. Pulvinar proin gravida hendrerit lectus. Ornare suspendisse sed nisi lacus sed. Accumsan lacus vel facilisis volutpat est velit egestas.</p>
            <p>Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.</p>
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
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="character" href="images/mockup/screenshot/1.jpg" data-caption="Caption #1 Character Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="character" href="images/mockup/screenshot/1.jpg" data-caption="Caption #2 Character Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="character" href="images/mockup/screenshot/1.jpg" data-caption="Caption #3 Character Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="character" href="images/mockup/screenshot/1.jpg" data-caption="Caption #3 Character Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="character" href="images/mockup/screenshot/1.jpg" data-caption="Caption #3 Character Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
            </div>
          </div>
        </div>
        <div id="sec-environment">
          <div class="project-section-head">Environment</div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="environment" href="images/mockup/screenshot/1.jpg" data-caption="Caption #1 environment Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris.">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="environment" href="images/mockup/screenshot/1.jpg" data-caption="Caption #2 environment Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="environment" href="images/mockup/screenshot/1.jpg" data-caption="Caption #3 environment Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="environment" href="images/mockup/screenshot/1.jpg" data-caption="Caption #3 environment Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="environment" href="images/mockup/screenshot/1.jpg" data-caption="Caption #3 environment Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="environment" href="images/mockup/screenshot/1.jpg" data-caption="Caption #3 environment Set. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam. Facilisis gravida neque convallis a cras. Nullam vehicula ipsum a arcu cursus vitae congue mauris. Sit amet dictum sit amet justo. Morbi non arcu risus quis varius quam quisque id diam.">
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
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a data-fancybox href="https://www.youtube.com/watch?v=IwbwVpj-Ijc"><div class="holder img-16by9"><img class="img-fluid" src="images/mockup/screenshot/1.jpg"></div></a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a data-fancybox href="https://www.youtube.com/watch?v=IwbwVpj-Ijc"><div class="holder img-16by9"><img class="img-fluid" src="images/mockup/screenshot/1.jpg"></div></a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a data-fancybox href="https://www.youtube.com/watch?v=IwbwVpj-Ijc"><div class="holder img-16by9"><img class="img-fluid" src="images/mockup/screenshot/1.jpg"></div></a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a data-fancybox href="https://www.youtube.com/watch?v=IwbwVpj-Ijc"><div class="holder img-16by9"><img class="img-fluid" src="images/mockup/screenshot/1.jpg"></div></a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a data-fancybox href="https://www.youtube.com/watch?v=IwbwVpj-Ijc"><div class="holder img-16by9"><img class="img-fluid" src="images/mockup/screenshot/1.jpg"></div></a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a data-fancybox href="https://www.youtube.com/watch?v=IwbwVpj-Ijc"><div class="holder img-16by9"><img class="img-fluid" src="images/mockup/screenshot/1.jpg"></div></a>
              </div>
            </div>
          </div>
        </div>
        <div id="sec-screenshot">
          <div class="project-section-head">Screenshot</div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="screenshot" href="images/mockup/screenshot/1.jpg">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="screenshot" href="images/mockup/screenshot/1.jpg">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="screenshot" href="images/mockup/screenshot/1.jpg">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="screenshot" href="images/mockup/screenshot/1.jpg">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
                <a class="d-block" data-fancybox="screenshot" href="images/mockup/screenshot/1.jpg">
                  <img class="img-fluid" src="images/mockup/screenshot/1.jpg">
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-12 my-2 item d03s fadeIn animated" data-animation="fadeIn">
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
    }, { offset: -1 });

    $('#sec-character').waypoint(function (up) {
      $('.nav-item.active').removeClass('active');
      $('#nav-character').addClass('active');
    }, { offset: -1 });

    $('#sec-environment').waypoint(function (up) {
      $('.nav-item.active').removeClass('active');
      $('#nav-environment').addClass('active');
    }, { offset: -1 });

    $('#sec-movie').waypoint(function (up) {
      $('.nav-item.active').removeClass('active');
      $('#nav-movie').addClass('active');
    }, { offset: -1 });

    $('#sec-screenshot').waypoint(function (up) {
      $('.nav-item.active').removeClass('active');
      $('#nav-screenshot').addClass('active');
    }, { offset: -1 });
  });
</script>