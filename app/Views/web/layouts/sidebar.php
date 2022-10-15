<?php
$uri = service('uri')->getSegments();
$uri1 = $uri[1] ?? 'index';
$uri2 = $uri[2] ?? '';
$uri3 = $uri[3] ?? '';
?>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <!-- Sidebar Header -->
        <?= $this->include('web/layouts/sidebar_header'); ?>

        <!-- Sidebar -->
        <div class="sidebar-menu">
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-center avatar avatar-xl me-3" id="avatar-sidebar">
                    <img src="<?= base_url('media/photos/default.jpg'); ?>" alt="" srcset="">
                </div>
                <div class="p-2 d-flex justify-content-center">Hello, Visitor</div>
                <ul class="menu">

                    <li class="sidebar-item <?= ($uri1 == 'index') ? 'active' : '' ?>">
                        <a href="/web" class="sidebar-link">
                            <i class="fa-solid fa-house"></i><span>Home</span>
                        </a>
                    </li>

                    <!-- <li class="sidebar-item <? //= ($uri1 == 'attraction') ? 'active' : '' 
                                                    ?>">
                        <a href="/web/attraction" class="sidebar-link">
                            <i class="fa-solid fa-list"></i><span>List Attraction</span>
                        </a>
                    </li> -->

                    <!-- Object -->
                    <li class="sidebar-item <?= ($uri1 == 'attraction') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                        <i class="fa-solid fa-tree"></i><span>Attraction</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'attraction') ? 'active' : '' ?>">
                            <!-- List Object -->
                            <li class="submenu-item" id="at-list">
                                <a href="<?= base_url('/web/attraction'); ?>"><i class="fa-solid fa-list me-3"></i>List</a>
                            </li>

                            <!-- Object Around You -->
                            <li class="submenu-item" id="at-around-you">
                                <a data-bs-toggle="collapse" href="#searchRadiusAT" role="button" aria-expanded="false" aria-controls="searchRadiusAT"><i class="fa-solid fa-compass me-3"></i>Around You</a>
                                <div class="collapse mb-3" id="searchRadiusAT">
                                    <label for="inputRadiusAT" class="form-label">Radius: </label>
                                    <label id="radiusValueAT" class="form-label">0 m</label>
                                    <input type="range" class="form-range" min="0" max="20" value="0" id="inputRadiusAT" name="inputRadius" onchange="updateRadius('AT'); radiusSearch({postfix: 'AT'});">
                                </div>
                            </li>

                            <!-- Object Search -->
                            <li class="submenu-item has-sub" id="at-search">
                                <a data-bs-toggle="collapse" href="#subsubmenu" role="button" aria-expanded="false" aria-controls="subsubmenu" class="collapse"><i class="fa-solid fa-magnifying-glass me-3"></i>Search</a>
                                <ul class="subsubmenu collapse" id="subsubmenu">
                                    <!-- Seach by Name -->
                                    <li class="submenu-item submenu-marker" id="at-by-name">
                                        <a data-bs-toggle="collapse" href="#searchNameAT" role="button" aria-expanded="false" aria-controls="searchNameAT"><i class="fa-solid fa-arrow-down-a-z me-3"></i>By Name</a>
                                        <div class="collapse mb-3" id="searchNameAT">
                                            <div class="d-grid gap-2">
                                                <input type="text" name="nameAT" id="nameAT" class="form-control" placeholder="Name" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                                                    <span class="material-icons" style="font-size: 1.5rem; vertical-align: bottom">search</span>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Event -->
                    <li class="sidebar-item <?= ($uri1 == 'event') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fa-bullhorn"></i><span>Event</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'event') ? 'active' : '' ?>">
                            <!-- List Event -->
                            <li class="submenu-item" id="ev-list">
                                <a href="<?= base_url('/web/event'); ?>"><i class="fa-solid fa-list me-3"></i>List</a>
                            </li>
                            <!-- Event Around You -->
                            <li class="submenu-item" id="ev-around-you">
                                <a data-bs-toggle="collapse" href="#searchRadiusEV" role="button" aria-expanded="false" aria-controls="searchRadiusEV"><i class="fa-solid fa-compass me-3"></i>Around You</a>
                                <div class="collapse mb-3" id="searchRadiusEV">
                                    <label for="inputRadiusEV" class="form-label">Radius: </label>
                                    <label id="radiusValueEV" class="form-label">0 m</label>
                                    <input type="range" class="form-range" min="0" max="20" value="0" id="inputRadiusEV" name="inputRadius" onchange="updateRadius('EV'); radiusSearch({postfix: 'EV'});">
                                </div>
                            </li>
                            <li class="submenu-item has-sub" id="ev-search">
                                <a data-bs-toggle="collapse" href="#subsubmenu" role="button" aria-expanded="false" aria-controls="subsubmenu" class="collapse"><i class="fa-solid fa-magnifying-glass me-3"></i>Search</a>
                                <ul class="subsubmenu collapse" id="subsubmenu">
                                    <!-- Event by Name -->
                                    <li class="submenu-item submenu-marker" id="ev-by-name">
                                        <a data-bs-toggle="collapse" href="#searchNameEV" role="button" aria-expanded="false" aria-controls="searchNameEV"><i class="fa-solid fa-arrow-down-a-z me-3"></i>By Name</a>
                                        <div class="collapse mb-3" id="searchNameEV">
                                            <div class="d-grid gap-2">
                                                <input type="text" name="nameEV" id="nameEV" class="form-control" placeholder="Name" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                <button class="btn btn-outline-primary" type="submit" id="button-addon2" onclick="findByName('EV')">
                                                    <span class="material-icons" style="font-size: 1.5rem; vertical-align: bottom">search</span>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Event by Rating -->
                                    <li class="submenu-item submenu-marker" id="ev-by-rating">
                                        <a data-bs-toggle="collapse" href="#searchRatingEV" role="button" aria-expanded="false" aria-controls="searchRatingEV"><i class="fa-regular fa-star me-3"></i>By Rating</a>
                                        <div class="collapse mb-3" id="searchRatingEV">
                                            <div class="d-grid gap-2">
                                                <div class="star-containter">
                                                    <i class="fa-solid fa-star" id="star-1" onclick="setStar('star-1');"></i>
                                                    <i class="fa-solid fa-star" id="star-2" onclick="setStar('star-2');"></i>
                                                    <i class="fa-solid fa-star" id="star-3" onclick="setStar('star-3');"></i>
                                                    <i class="fa-solid fa-star" id="star-4" onclick="setStar('star-4');"></i>
                                                    <i class="fa-solid fa-star" id="star-5" onclick="setStar('star-5');"></i>
                                                    <input type="hidden" id="star-rating" value="0">
                                                </div>
                                                <button class="btn btn-outline-primary" type="submit" id="button-addon2" onclick="findByRating('EV')">
                                                    <span class="material-icons" style="font-size: 1.5rem; vertical-align: bottom">search</span>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Event by Category -->
                                    <li class="submenu-item submenu-marker" id="ev-by-category">
                                        <a data-bs-toggle="collapse" href="#searchCategoryEV" role="button" aria-expanded="false" aria-controls="searchCategoryEV"><i class="fa-solid fa-check-to-slot me-3"></i>By Category</a>
                                        <div class="collapse mb-3" id="searchCategoryEV">
                                            <div class="d-grid">
                                                <script>
                                                    getCategory();
                                                </script>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="categoryEVSelect">
                                                    </select>
                                                </fieldset>
                                                <button class="btn btn-outline-primary" type="submit" id="button-addon2" onclick="findByCategory('EV')">
                                                    <span class="material-icons" style="font-size: 1.5rem; vertical-align: bottom">search</span>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Event by Date -->
                                    <li class="submenu-item submenu-marker" id="ev-by-date">
                                        <a data-bs-toggle="collapse" href="#searchDateEV" role="button" aria-expanded="false" aria-controls="searchDateEV"><i class="fa-solid fa-calendar-days me-3"></i>By Date</a>
                                        <div class="collapse mb-3" id="searchDateEV">
                                            <div class="d-grid gap-2">
                                                <div class="input-group date" id="datepicker">
                                                    <input type="text" class="form-control" id="eventDate">
                                                    <div class="input-group-addon ms-2">
                                                        <i class="fa-solid fa-calendar-days" style="font-size: 1.5rem; vertical-align: bottom"></i>
                                                    </div>
                                                </div>
                                                <button class="btn btn-outline-primary" type="submit" id="button-addon2" onclick="findByDate()">
                                                    <span class="material-icons" style="font-size: 1.5rem; vertical-align: bottom">search</span>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>