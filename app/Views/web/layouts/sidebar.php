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
                    <img src="<?= base_url('media/photos/talao.jpg'); ?>" alt="" srcset="">
                </div>
                <div class="p-2 d-flex justify-content-center">Hello, Visitor!</div>
                <ul class="menu">

                    <li class="sidebar-item <?= ($uri1 == 'index') ? 'active' : '' ?>">
                        <a href="/web" class="sidebar-link">
                            <i class="fa-solid fa-house"></i><span>Home</span>
                        </a>
                    </li>

                    <!-- Object -->

                    <li class="sidebar-item <?= ($uri1 == 'tracking') ? 'active' : '' ?>">
                        <a href="<?= base_url('/web/tracking'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-tree"></i><span>Tracking Mangrove</span>
                        </a>
                    </li>

                    <li class="sidebar-item <?= ($uri1 == 'talao') ? 'active' : '' ?>">
                        <a href="<?= base_url('/web/talao'); ?>" class="sidebar-link">
                            <i class="fa-solid fa-water"></i><span>Estuaria/Talao</span>
                        </a>
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
                                    <!-- Event by Category -->
                                    <!-- <li class="submenu-item submenu-marker" id="ev-by-category">
                                        <a data-bs-toggle="collapse" href="#searchCategoryEV" role="button" aria-expanded="false" aria-controls="searchCategoryEV"><i class="fa-solid fa-check-to-slot me-3"></i>By Category</a>
                                        <div class="collapse mb-3" id="searchCategoryEV">
                                            <div class="d-grid">
                                                <script>getCategory();</script>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="categoryEVSelect">
                                                    </select>
                                                </fieldset>
                                                <button class="btn btn-outline-primary" type="submit" id="button-addon2" onclick="findByCategory('EV')">
                                                    <span class="material-icons" style="font-size: 1.5rem; vertical-align: bottom">search</span>
                                                </button>
                                            </div>
                                        </div>
                                    </li> -->
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Package -->
                    <li class="sidebar-item <?= ($uri1 == 'package') ? 'active' : '' ?> has-sub">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fa-square-poll-horizontal"></i><span>Package</span>
                        </a>

                        <ul class="submenu <?= ($uri1 == 'package') ? 'active' : '' ?>">
                            <!-- List Package -->
                            <li class="submenu-item" id="pa-list">
                                <a href="<?= base_url('/web/package'); ?>"><i class="fa-solid fa-list me-3"></i>List</a>
                            </li>
                            <!-- Package Around You -->
                            <li class="submenu-item" id="pa-around-you">
                                <a data-bs-toggle="collapse" href="#searchRadiusPA" role="button" aria-expanded="false" aria-controls="searchRadiusPA"><i class="fa-solid fa-compass me-3"></i>Around You</a>
                                <div class="collapse mb-3" id="searchRadiusPA">
                                    <label for="inputRadiusPA" class="form-label">Radius: </label>
                                    <label id="radiusValuePA" class="form-label">0 m</label>
                                    <input type="range" class="form-range" min="0" max="20" value="0" id="inputRadiusPA" name="inputRadius" onchange="updateRadius('PA'); radiusSearch({postfix: 'PA'});">
                                </div>
                            </li>
                            <li class="submenu-item has-sub" id="pa-search">
                                <a data-bs-toggle="collapse" href="#subsubmenu" role="button" aria-expanded="false" aria-controls="subsubmenu" class="collapse"><i class="fa-solid fa-magnifying-glass me-3"></i>Search</a>
                                <ul class="subsubmenu collapse" id="subsubmenu">
                                    <!-- Package by Name -->
                                    <li class="submenu-item submenu-marker" id="pa-by-name">
                                        <a data-bs-toggle="collapse" href="#searchNamePA" role="button" aria-expanded="false" aria-controls="searchNamePA"><i class="fa-solid fa-arrow-down-a-z me-3"></i>By Name</a>
                                        <div class="collapse mb-3" id="searchNamePA">
                                            <div class="d-grid gap-2">
                                                <input type="text" name="namePA" id="namePA" class="form-control" placeholder="Name" aria-label="Recipient's username" aria-describedby="button-addon2">
                                                <button class="btn btn-outline-primary" type="submit" id="button-addon2" onclick="findByName('PA')">
                                                    <span class="material-icons" style="font-size: 1.5rem; vertical-align: bottom">search</span>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Event by Category -->
                                    <!-- <li class="submenu-item submenu-marker" id="ev-by-category">
                                        <a data-bs-toggle="collapse" href="#searchCategoryEV" role="button" aria-expanded="false" aria-controls="searchCategoryEV"><i class="fa-solid fa-check-to-slot me-3"></i>By Category</a>
                                        <div class="collapse mb-3" id="searchCategoryEV">
                                            <div class="d-grid">
                                                <script>getCategory();</script>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="categoryEVSelect">
                                                    </select>
                                                </fieldset>
                                                <button class="btn btn-outline-primary" type="submit" id="button-addon2" onclick="findByCategory('EV')">
                                                    <span class="material-icons" style="font-size: 1.5rem; vertical-align: bottom">search</span>
                                                </button>
                                            </div>
                                        </div>
                                    </li> -->
                                </ul>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>