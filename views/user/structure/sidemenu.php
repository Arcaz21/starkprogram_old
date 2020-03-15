
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <ul class="nav side-menu">
        <li><a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a></li>
        <?php if($_SESSION['type']=='locked-in' || $_SESSION['type']=='trading' || $_SESSION['type'] == 'shareholder'): ?>
          <li><a><i class="fa fa-briefcase"></i> Accounts <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
          <!--     <li><a href="profile.php"><i class="fa fa-male"></i>Profile</a></li> -->
              <li><a href="add_account.php"><i class="fa fa-plus-square"></i>Add Account</a></li>
              <li><a href="switch_account.php"><i class="fa fa-history"></i>Switch Account</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['type']=='locked-in' || $_SESSION['type']=='shareholder' && $_SESSION['subscription'] == TRUE ): ?>
          <li><a><i class="fa fa-sitemap"></i> Genealogy <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <!-- <li><a href="referral_tree.php"><i class="fa fa-users"></i>Referral Tree</a></li> -->
              <li><a href="referral_group.php"><i class="fa fa-cubes"></i>Referral Group</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['type']=='locked-in'): ?>
          <li><a><i class="fa fa-suitcase"></i>Wallet <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="request_encashment.php"><i class="fa fa-credit-card"></i>Request Encashment</a></li>
              <li><a href="encashment_history.php"><i class="fa fa-check-square"></i>Encashment History</a></li>
              <!-- <li><a href="transfercoins.php"><i class="fa fa-shopping-cart"></i>Transfer BDCoins</a></li> -->
            </ul>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['type']=='shareholder' && $_SESSION['subscription'] == TRUE): ?>
          <li><a><i class="fa fa-suitcase"></i>Wallet <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="share_request_encashment.php"><i class="fa fa-credit-card"></i>Request Encashment</a></li>
              <li><a href="share_history_encashment.php"><i class="fa fa-check-square"></i>Encashment History</a></li>
              <!-- <li><a href="share_transfer_wallet.php"><i class="fa fa-arrows-h"></i>Transfer BDCoins</a></li> -->
            </ul>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['type']=='locked-in'): ?>
          <!-- <li><a><i class="fa fa-suitcase"></i>Packages <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="request_packages.php"><i class="fa fa-paper-plane"></i>Request Packages</a></li>
              <li><a href="package_list.php"><i class="fa fa-list-alt"></i>Package List</a></li>
            </ul>
          </li> -->
        <?php endif; ?>
        <?php if($_SESSION['type']=='dtm30' && $_SESSION['subscription'] == TRUE): ?>
          <li><a><i class="fa fa-archive"></i>DTM30 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="dtm30_cash.php"><i class="fa fa-suitcase"></i>Invest Now!</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['type']=='trading' && $_SESSION['subscription'] == TRUE): ?>
          <li><a><i class="fa fa-archive"></i>Trading <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="trade_cash.php"><i class="fa fa-suitcase"></i>Trade Now!</a></li>
              <li><a href="trading.php"><i class="fa fa-check-square"></i>Trading History</a></li>
              <li><a href="trading_pins.php"><i class="fa fa-key"></i>Trade Pins</a></li>
              <li><a href="pin_list.php"><i class="fa fa-list-alt"></i>Pin List</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['type']=='trading' && $_SESSION['subscription'] == TRUE): ?>
          <li><a><i class="fa fa-credit-card"></i>Wallet <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="tradingencashment.php"><i class="fa fa-money"></i>Encashment</a></li>
              <li><a href="trad_encash_history.php"><i class="fa fa-list"></i>Encashment History</a></li>
              <!-- <li><a href="transfer_wallet.php"><i class="fa fa-arrows-h"></i>Transfer BDCoins</a></li> -->
            </ul>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['type']=='dtm30' && $_SESSION['subscription'] == TRUE): ?>
          <li><a><i class="fa fa-credit-card"></i>Wallet <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="dtm30encashment.php"><i class="fa fa-money"></i>Encashment</a></li>
              <li><a href="dtm30_encash_history.php"><i class="fa fa-list"></i>Encashment History</a></li>
              <!-- <li><a href="transfer_wallet.php"><i class="fa fa-arrows-h"></i>Transfer BDCoins</a></li> -->
            </ul>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['type']=='locked-in'): ?>
          <li><a><i class="fa fa-money"></i> Earnings <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="additional_income.php"><i class="fa fa-certificate fa-spin fa-3x fa-fw"></i>Direct Sponsor Bonus</a></li>
              <li><a href="monthlybonus.php"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>D.S. Monthly Bonus</a></li>
              <li><a href="netprofit.php"><i class="fa fa-cube"></i>Net Profit Shares</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['type']=='shareholder' && $_SESSION['subscription'] == TRUE): ?>
          <li><a><i class="fa fa-money"></i> Earnings <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="share_additional_income.php"><i class="fa fa-certificate fa-spin fa-3x fa-fw"></i>Direct Sponsor Bonus</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if($_SESSION['type']=='locked-in'): ?>
          <!-- <li><a><i class="fa fa-newspaper-o"></i> Reporting <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="summary_report.php"><i class="fa fa-file-text-o"></i>Summary Report</a></li>
            </ul>
          </li> -->
        <?php endif; ?>
        <!-- <?php if($_SESSION['type']=='locked-in'): ?>
          <li><a><i class="fa fa-sliders"></i>Settings <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="fixed_sidebar.html"><i class="fa fa-wrench"></i>Auto Maintenance</a></li>
              <li><a href="change_pass.php"><i class="fa fa-unlock-alt"></i>Change Password</a></li>
            </ul>
          </li>
        <?php endif; ?> -->
      </ul>
    </div>
  </div>