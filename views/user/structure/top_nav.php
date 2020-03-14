        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt=""><?php
                    if($_SESSION['type'] == 'trading'):
                      echo $tradinguser[0]['Full_Name'];
                    elseif($_SESSION['type'] == 'shareholder'):
                      echo $shareuser[0]['Full_Name'];
                    else:
                      echo $datauser[0]['Full_Name'];
                    endif;
                     ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="login.php?log=TRUE"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    <li><a href="profile.php"><i class="fa fa-user pull-right"></i>My Profile</a></li>
                    <li><a href="change_mpin.php"><i class="fa fa-lock pull-right"></i>Change MPIN</a></li>
                    <li><a href="account_info.php"><i class="fa fa-suitcase pull-right"></i>Bank Details</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>