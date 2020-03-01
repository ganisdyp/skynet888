<?php

?>
<div id="sidebar-nav-wrapper">
    <ul class="sidebar-nav">
        <i class="fa fa-times toggle-btn" id="close-btn" aria-hidden="true"></i>
        <ul id="menu-mobile" class="sidebar-nav">
            <li class="nav-item <?php echo (PAGE_NAME == 'index') ? 'active' : ''; ?>"><a class="nav-link" href="index">About Us</a></li>
            <li class="nav-item <?php echo (PAGE_NAME == 'projects') ? 'active' : ''; ?>"><a class="nav-link" href="projects">Projects</a></li>
            <li class="nav-item <?php echo (PAGE_NAME == 'news') ? 'active' : ''; ?>"><a class="nav-link" href="news">News</a></li>
            <li class="nav-item  <?php echo (PAGE_NAME == 'careers') ? 'active' : ''; ?>"><a class="nav-link" href="careers">Careers</a></li>
            <li class="nav-item  <?php echo (PAGE_NAME == 'contact-us') ? 'active' : ''; ?>"><a class="nav-link" href="contact-us">Contact</a></li>
            <ul id="social-mobile" class="navbar-nav flex-row justify-content-center">
                <li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                <li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                <li><a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a></li>
            </ul>
        </ul>
    </ul>
    <div class="clearfix"></div>
</div>
<?php
echo '<div class="view-content">';
?>
<div id="navbar-menu-wrapper">
    <div id="upper-menu">
        <ul id="nav-social">
            <li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
            <li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
            <li><a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a></li>
        </ul>
    </div>
    <div id="top-menu-wrapper" class="justify-content-between">
        <i class="fa fa-bars toggle-btn" id="toggle-btn" aria-hidden="true"></i>
        <div class="top-menu-left d-flex">
            <a class="navbar-brand" href="index.php">
                <img id="nav-logo" src="../frontend/web/images/logo-skynet888.png" alt="Skynet888 logo">
            </a>
            <div class="nav-box-title my-auto">
                <a href="index.php" id="site-title">SKYNET888</a>
                <p id="site-desc" class="mb-0">Skynet888 website for all gamers</p>
            </div>
        </div>
        <div class="top-menu-right align-self-center">
            <nav id="navbar-lg" class="navbar navbar-sub px-0">
                <div id="navbarsub">
                    <ul class="navbar-nav flex-row">
                        <li class="nav-item <?php echo (PAGE_NAME == 'index') ? 'active' : ''; ?>">
                            <a class="nav-link" href="index">About Us</a>
                        </li>
                        <li class="nav-item <?php echo (PAGE_NAME == 'projects') ? 'active' : ''; ?>">
                            <a class="nav-link" href="projects">Projects</a>
                        </li>
                        <li class="nav-item <?php echo (PAGE_NAME == 'news') ? 'active' : ''; ?>">
                            <a class="nav-link" href="news">News</a>
                        </li>
                        <li class="nav-item <?php echo (PAGE_NAME == 'careers') ? 'active' : ''; ?>">
                            <a class="nav-link" href="careers">Careers</a>
                        </li>
                        <li class="nav-item mr-2 <?php echo (PAGE_NAME == 'contact-us') ? 'active' : ''; ?>">
                            <a class="nav-link" href="contact-us">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>