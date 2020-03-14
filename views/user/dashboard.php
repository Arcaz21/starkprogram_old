<?php
//require 'structure/cache.php';
require __DIR__ . "/structure/session.php";
include __DIR__ . "/../../controllers/userFunctions.php";
//echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>| Dashboard</title>

  <!-- favicon -->
  <link rel="icon" href="../user/images/favicon.png" type="image/png" sizes="16x16">
  <!-- Bootstrap -->
  <link  href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.css" rel="stylesheet">
</head>

<body class="nav-md">
  <?php include "loading/startloading.php"; ?>
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="dashboard.php" class="site_title"><img src="../user/images/favicon.png" style="margin-left: 10%; width: 70%; height: auto;"></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <?php include "structure/quickinfo.php" ?>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <?php include "structure/sidemenu.php" ?>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.php?id=101">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <?php include "structure/top_nav.php" ?>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">

          <!-- top tiles -->
          <div class="row tile_tiles">
            <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-user"></i></div>
                <?php if ($_SESSION['type'] == 'locked-in') : ?>
                <div class="count sky_blue"><?php //echo $datauser[0]['Accnt_Name']; 
                                              echo $_SESSION['username']; ?></div>
                <h3><?php echo $datauser[0]['Package_Name']; ?></h3>
                <h3>Account ID: <?php echo $_SESSION['accountid'] ?></h3>
                <?php endif; ?>
                <?php if ($_SESSION['type'] == 'trading') : ?>
                <div class="count sky_blue"><?php //echo $tradinguser[0]['Accnt_Name']; 
                                              echo $_SESSION['username']; ?></div>
                <h3>Trader</h3>
                <h3>Account ID: <?php echo $_SESSION['accountid'] ?></h3>
                <?php endif; ?>
                <?php if ($_SESSION['type'] == 'shareholder') : ?>
                <div class="count sky_blue"><?php //echo $tradinguser[0]['Accnt_Name']; 
                                              echo $_SESSION['username']; ?></div>
                <h3>Holding <?php echo $getshrecount->sharecount; ?> Share/s  </h3>
                <?php if($getshrecount->sharecount == 15): ?>
                  <h3>Company Share: 10%</h3>
                <?php endif; ?>
                <h3>Account ID: <?php echo $_SESSION['accountid'] ?></h3>
                <?php endif; ?>

              </div>
            </div>
            <!-- Trading -->
            <?php if ($_SESSION['type'] == 'trading') : ?>
            <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-money"></i></div>
                <div class="count sky_blue">₱<?php if ($tradinguser[0]['Accnt_Bal'] != NULL) : echo number_format($tradinguser[0]['Accnt_Bal'], 2);
                                                else : echo "0.00";
                                                endif; ?></div>
                <h3>Available BDCoins</h3>
              </div>
            </div>
            <?php endif; ?>
            <!-- End Trading -->
            <!-- Trading -->
            <?php if ($_SESSION['type'] == 'shareholder') : ?>
            <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-money"></i></div>
                <div class="count sky_blue">₱<?php if ($shareuserinfo[0]['Accnt_Bal'] != NULL) : echo number_format($shareuserinfo[0]['Accnt_Bal'], 2);
                                                else : echo "0.00";
                                                endif; ?></div>
                <h3>Available BDCoins</h3>
              </div>
            </div>
            <?php endif; ?>
            <!-- End Trading -->
            <!-- locked-in -->
            <?php if ($_SESSION['type'] == 'locked-in') : ?>
            <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="count sky_blue"><?php if ($databal->accbal != NULL) : echo '<i class="fa fa-gg"></i> ' . number_format($databal->accbal, 2);
                                              else : echo "0.00";
                                              endif; ?></div>
                <h3>Available BDCoins</h3>
              </div>
            </div>
            <?php endif; ?>
            <!-- End locked-in -->
          </div>
          <!-- /top tiles -->

          <!-- top tiles new -->
          <div class="row top_tiles">
            <?php error_reporting(E_ERROR | E_PARSE);
            foreach ($getstatnp as $index => $np) : ?>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats bg-sky_blue">
                <div class="icon"><i class="fa fa-user"></i></div>
                <div class="count"><?php echo $np['totalshares']; ?></div>
                <h3><?php echo $np['Class']; ?></h3>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <!-- /top tiles new -->

          <!-- fixed monthly bonus -->
          <?php if ($_SESSION['type'] == 'locked-in') : ?>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2 class="sky_blue">Fixed Monthly Bonus</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr class="bg-sky_blue">
                      <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+1 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                      <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+2 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                      <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+3 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                      <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+4 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                      <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+5 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                      <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+6 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                      <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+7 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                      <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+8 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                      <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+9 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                      <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+10 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                      <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+11 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                      <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+12 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                        <?php if($gettotaldownlines->Downlines >= 5): ?>
                            <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+13 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                            <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+14 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                            <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+15 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                            <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+16 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                            <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+17 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                            <th><?php $date = date_create(date('Y-m-d', strtotime($getmbmaturity->Start_Date . "+18 month")));
                            echo date_format($date, "l jS \of F Y"); ?></th>
                        <?php endif; ?>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <?php if (empty($getmbmaturity->Month1)) :
                            echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                          else :
                            echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month1, 2) . ' <span style="color:green">Transfered</span>';
                          endif;
                          ?>
                      </td>
                      <td><?php if (empty($getmbmaturity->Month2)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month2, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                      <td><?php if (empty($getmbmaturity->Month3)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month3, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                      <td><?php if (empty($getmbmaturity->Month4)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month4, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                      <td><?php if (empty($getmbmaturity->Month5)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month5, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                      <td><?php if (empty($getmbmaturity->Month6)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month6, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                      <td><?php if (empty($getmbmaturity->Month7)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month7, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                      <td><?php if (empty($getmbmaturity->Month8)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month8, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                      <td><?php if (empty($getmbmaturity->Month9)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month9, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                      <td><?php if (empty($getmbmaturity->Month10)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month10, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                      <td><?php if (empty($getmbmaturity->Month11)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month11, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                      <td><?php if (empty($getmbmaturity->Month12)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month12, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                        <?php if($gettotaldownlines->Downlines >= 5): ?>
                            <td><?php if (empty($getmbmaturity->Month13)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month13, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                            <td><?php if (empty($getmbmaturity->Month14)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month14, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                            <td><?php if (empty($getmbmaturity->Month15)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month15, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                            <td><?php if (empty($getmbmaturity->Month16)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month16, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                            <td><?php if (empty($getmbmaturity->Month17)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month17, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                            <td><?php if (empty($getmbmaturity->Month18)) :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Monthly, 2);
                            else :
                              echo '<i class="fa fa-gg"></i> ' . number_format($getmbmaturity->Month18, 2) . ' <span style="color:green">Transfered</span>';
                            endif;
                            ?></td>
                        <?php endif; ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <!-- /fixed monthly bonus -->

          <?php if ($_SESSION['type'] == 'trading') : ?>
          <!-- Trading -->
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div id="webterminal" style="width:100%;height:600px;"></div>
                    <script type="text/javascript" src="https://trade.mql5.com/trade/widget.js"></script>
                    <script type="text/javascript">
                        new MetaTraderWebTerminal( "webterminal", {
                            version: 5,
                            server: "MetaQuotes-Demo",
                            demoAllowPhone: true,
                            startMode: "create_demo",
                            lang: "en",
                            colorScheme: "black_on_white"
                        } );
                    </script>
                    <!--<iframe width="100%" height="315" src="https://www.youtube.com/embed/ISsUS54ZiI8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2 class="sky_blue">Trading Table</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr class="bg-sky_blue">
                      <th>Amount</th>
                      <th>Term</th>
                      <th>Interest</th>
                      <th>Entry Date</th>
                      <th>Maturity Date</th>
                      <th>Payout Amount</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php error_reporting(E_ERROR | E_PARSE);
                      foreach ($gettrading as $index => $trade) : ?>
                    <tr>
                      <td><?php echo $trade['Trade_Amount']; ?></td>
                      <td><?php echo $trade['term'] . " days"; ?></td>
                      <td><?php echo $trade['rate'] . "%"; ?></td>
                      <td><?php echo $trade['entry_date']; ?></td>
                      <td><?php $date = date_create($trade['Payout_Date']);
                              echo date_format($date, "l jS \of F Y"); ?></td>
                      <td><?php echo $trade['Payout_Amount']; ?></td>
                      <td><?php echo $trade['status']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <!-- /Trading -->

          <?php if ($_SESSION['type'] == 'shareholder') : ?>
          <!-- Share Holder -->
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div id="webterminal" style="width:100%;height:600px;"></div>
                    <script type="text/javascript" src="https://trade.mql5.com/trade/widget.js"></script>
                    <script type="text/javascript">
                        new MetaTraderWebTerminal( "webterminal", {
                            version: 5,
                            server: "MetaQuotes-Demo",
                            demoAllowPhone: true,
                            startMode: "create_demo",
                            lang: "en",
                            colorScheme: "black_on_white"
                        } );
                    </script>
                </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2 class="sky_blue">Trading Table</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr class="bg-sky_blue">
                      <th>Amount</th>
                      <th>Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php error_reporting(E_ERROR | E_PARSE);
                      foreach ($getShareIncome as $index => $share) : ?>
                    <tr>
                      <td><?php echo $share['value']; ?></td>
                      <td><?php $date = date_create($share['Date']);
                              echo date_format($date, "l jS \of F Y"); ?></td>
                      <td><?php echo $share['status']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php endif; ?>
          <!-- /Share Holder -->

          
        </div>
      </div>
      <!-- /page content -->
      <?php include "structure/modal.php" ?>
                            
      <!-- footer content -->
      <?php include "structure/footer.php" ?>
      <!-- /footer content -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="../vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="../vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../vendors/nprogress/nprogress.js"></script>
  <!-- iCheck -->
  <script src="../vendors/iCheck/icheck.min.js"></script>
  <!-- Datatables -->
  <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
  <script src="../vendors/jszip/dist/jszip.min.js"></script>
  <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
  <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="../build/js/custom.js"></script>
</body>

</html>
<?php include "loading/finishloading.php"; ?>