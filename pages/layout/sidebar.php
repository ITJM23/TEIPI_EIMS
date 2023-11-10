<!--Start sidebar-wrapper-->
    <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">

        <div class="brand-logo">
            <a href="index.php">
                <img src="../assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
                <h5 class="logo-text">Dashtreme Admin</h5>
            </a>
        </div>
        
        <ul class="sidebar-menu do-nicescrol">
            <li class="sidebar-header">MAIN NAVIGATION</li>
            <li>
                <a href="index.php">
                    <i class="fa-solid fa-gauge"></i> <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a>
                    <i class="fa-solid fa-tv"></i> <span>POS</span>
                </a>
            </li>

            <li>
                <a onclick="sdbrItems('sdbr_dd1')">
                    <i class="fa-solid fa-clipboard-list"></i> <span>Items</span>
                </a>
            </li>
                <ul class="list-unstyled sdbr-sub-item" style="display:none" id="sdbr_dd1">
                    <li>
                        <a href="#">
                            <span>On Hand</span>
                            <button type="button" class="btn btn-outline-success">+</button>
                        </a>
                    </li>
                    <li><a href="#">Fast Moving</a></li>
                    <li><a href="#">Slow Moving</a></li>
                    <li><a href="#">Critical Stocks</a></li>
                </ul>

            <li>
                <a>
                    <i class="fa-solid fa-rectangle-list"></i> <span>Categories</span>
                    <!-- <button type="button" class="btn btn-outline-success">+</button> -->
                </a>
            </li>

            <li>
                <a class="sdbr-action">
                    <i class="fa-solid fa-users"></i> <span>Suppliers</span>
                    <!-- <small class="badge float-right badge-light">New</small> -->
                </a>
            </li>

            <li>
                <a>
                    <i class="fa-solid fa-wrench"></i> <span>Services</span>
                </a>
            </li>

            <li>
                <a onclick="sdbrItems('sdbr_dd2')">
                    <i class="fa-solid fa-user-group"></i> <span>Contacts</span>
                    <!-- <button type="button" class="btn btn-outline-success">+</button> -->
                </a>
            </li>
                <ul class="list-unstyled sdbr-sub-item" style="display:none;" id="sdbr_dd2">
                    <li>
                        <a href="#">
                            <span>Customers</span>
                            <button type="button" class="btn btn-outline-success">+</button>
                        </a>
                    </li>
                </ul>

            <li>
                <a onclick="sdbrItems('sdbr_dd3')">
                    <i class="fa-solid fa-hand-holding-dollar"></i> <span>Sales</span>
                </a>
            </li>
                <ul class="list-unstyled sdbr-sub-item" style="display:none;" id="sdbr_dd3">
                    <li>
                        <a href="#">
                            <span>Daily</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span>Weekly</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span>Monthly</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span>Yearly</span>
                        </a>
                    </li>
                </ul>

            <li>
                <a>
                    <i class="fa-solid fa-print"></i> <span>Reports</span>
                </a>
            </li>
                <!-- <ul class="list-unstyled sdbr-sub-item">
                    <li>
                        <a href="#">
                            <span>Daily</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span>Weekly</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span>Monthly</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span>Yearly</span>
                        </a>
                    </li>
                </ul> -->

            <li class="sidebar-header">LABELS</li>
            <li><a href="javaScript:void();"><i class="fa-solid fa-circle-info text-success"></i> <span>Important</span></a></li>
            <li><a href="javaScript:void();"><i class="fa-solid fa-triangle-exclamation text-warning"></i> <span>Warning</span></a></li>
            <li><a href="javaScript:void();"><i class="fa-solid fa-circle-info text-info"></i> <span>Information</span></a></li>

        </ul>
    
    </div>
<!--End sidebar-wrapper-->