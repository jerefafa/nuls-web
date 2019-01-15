<div id="menu">
    <ul id="slide-out" class="side-nav fixed sidebar-background">

        <li class="sidebar-header user-view">
            <img class="circle center-block" src="Images/NULOGO.png">
            <p class="center">National University <br> Learning Resource Center</p>
        </li>

        <li><a href="Home.php"><i class="material-icons">home</i>Home</a></a></li>
        <li <?php
        if($_SESSION["position"]!="Chief Librarian" && $_SESSION["position"]!="Super Admin"){
            ?>
            style="display: none"
            <?php
        }
        ?>
        ><a href="Statistics.php"><i class="material-icons">equalizer</i>Statistics</a></a>
        </li>
        <li
            <?php
            if($_SESSION["position"]!="Chief Librarian" &&  $_SESSION["position"]!="Super Admin" && !check_access_control("Acquisition")){
                ?>
                style="display: none"
                <?php
            }
            ?>
        ><a href="ListOfCopies.php"><i class="material-icons">bookmark_border</i>Acquisition</a></a>
        </li>
        <li
            <?php
            if($_SESSION["position"]!="Chief Librarian" && !check_access_control("Catalog")&& $_SESSION["position"]!="Super Admin" ){
                ?>
                style="display:none"
                <?php
            }
            ?>><a href="Catalog.php"><i class="material-icons">bookmark</i>Catalog</a></a></li>
        <li
            <?php
            if($_SESSION["position"]!="Chief Librarian" && !check_access_control("Circulation") && $_SESSION["position"]!="Super Admin"){
                ?>
                style="display: none"
                <?php
            }
            ?>
        ><a href="Checkout.php"><i class="material-icons">book</i>Circulation</a></a>
        </li>
        <li  <?php
        if($_SESSION["position"]!="Chief Librarian" && !check_access_control("Reports") && $_SESSION["position"]!="Super Admin"){
            ?>
            style="display: none"
            <?php
        }
        ?>><a href="Inventory.php"><i class="material-icons">error</i>Reports</a></a>
        </li>
        <li
            <?php
            if($_SESSION["position"]!="Super Admin" && $_SESSION["position"]!="Chief Librarian" ){
                ?>
                style="display: none"
                <?php
            }
            ?>

        ><a href="UserManagementList.php"><i class="material-icons">contacts</i>User Management</a>

        </li>
        <li
            <?php
            if($_SESSION["position"]!="Super Admin" ){
                ?>
                style="display: none"
                <?php
            }
            ?>


        >
            <a href="Assets.php"><i class="material-icons">web_asset</i>Assets</a></li>
        <li><a href="login.php"><i class="material-icons">exit_to_app</i>Logout</a>
        </li>

    </ul>
</div>