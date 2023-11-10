<!--Start topbar header-->
    <header class="topbar-nav">

        <nav class="navbar navbar-expand fixed-top">

            <ul class="navbar-nav mr-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link toggle-menu" href="javascript:void();">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item">
                <!-- <form class="search-bar">
                    <input type="text" class="form-control" placeholder="Enter keywords">
                    <a href="javascript:void();"><i class="fa-solid fa-magnifying-glass"></i></a>
                </form> -->
                </li>
            </ul>
            
            <ul class="navbar-nav align-items-center right-nav-link">

                <?php //echo gethostname(); ?>
                <?php //echo getHostByName(getHostName()); ?>

                <li class="nav-item">

                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                        <span class="user-profile">
                            <img src="../assets/images/profile_img/User2.png" class="img-circle usr_img" alt="user avatar">
                        </span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">

                        <li class="dropdown-item user-details">
                            <a href="javaScript:void();">
                                <div class="media">
                                    <div class="avatar">
                                        <!-- <img class="align-self-start mr-3 usr_img" src="<?php //echo getHostByName(getHostName()); ?>/TEIPI_IMS/assets/images/users/" alt="user avatar"> -->
                                        <img class="align-self-start mr-3 usr_img" src="../assets/images/profile_img/User2.png" alt="user avatar">
                                        <input type="hidden" id="pc_ipaddr" value=<?php echo getHostByName(getHostName()); ?>>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="mt-2 user-title" id="usr_name">---</h6>
                                        <p class="user-subtitle" id="usr_position">---</p>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="dropdown-divider"></li>

                        <li class="dropdown-divider"></li>

                        <?php

                            if($_COOKIE["EIMS_usrlvl"] == 1){

                                ?>

                                    <li class="dropdown-item dd-hover" onclick="location.href='settings.php';"><i class="fa-solid fa-user-gear mr-2"></i> Settings</li>

                                <?php
                            }
                        ?>

                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item dd-hover" onclick="location.href='includes/logout.php';"><i class="fa-solid fa-power-off mr-2"></i> Logout</li>
                    </ul>
                </li>
            </ul>
            
        </nav>

    </header>
<!--End topbar header-->