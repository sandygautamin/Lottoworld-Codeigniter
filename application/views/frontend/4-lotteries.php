<script>

var CART_CONFIG = {"CART_PARTIALS_URI":"https://www.lottoworldgroup.com/wp-content/themes/lotto_theme/fragments/cart-partials/","CART_TRANSLATION_URL":"https://www.lottoworldgroup.com\/wp-content/themes/lotto_theme/languages/translations/","CART_PRODUCTS":"","CART_OLAP_AFFILIATE_CODE":"0","CART_IS_FIRSTTIME_PURCHASE":"0","CART_DEV":"0"};
/* ]]> */

</script>

<div class="wrap page-template-buynow">
<?php
   
//unset($_SESSION['groupdata']);
//unset($_SESSION['allbrand']);
//pr($_SESSION);
    function selectNumCol($data, $numbOfTicket)
    {
        $lotteriesNames = array(
            'PowerBall'    => ' 1 Power Ball',
            'MegaMillions' => ' 1 Mega Ball',
            'EuroMillions' => ' 2 Lucky Numbers',
            'EuroJackpot'  => ' 2 EuroStars',
        );

        if (wp_is_mobile()) { ?>

        <!-- mobile ver /-->

        <div class="select_num_col">

            <div class="close-btn">
                <a href="javascript:void(0)" class="quickpic_close visible-xs">
                    <img src="<?php echo base_url(); ?>assets/images/close-icon.png"/>
                </a>
            </div>

            <div class="select_num_col_part">

                <div class="all_num_part">
                    <div class="lt_numbers_wrapper">
                        <?php
                            for ($i = 1; $i <= $data['NumberOfMainNumbers']; $i++) {
                                echo "<span id=\"$i\">$i</span>";
                            }
                        ?>
                    </div>
                </div>
                <?php if ($data['NumberOfExtraNumbers'] > 0) : ?>
                    <div class="select_num_part">

                        <div class="select_num_part_wrapper">
                            <?php
                                for ($i = $data["MinExtraNumber"]; $i <= $data['NumberOfExtraNumbers']; $i++) {
                                    echo "<span class=\"line\" id=\"$i\">$i</span>";
                                }
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>

                <div class="quickpic-mobile">
                    <div class="quickpic_text" style="display:none;">QUICK PICK</div>
                    <a href="javascript:void(0)" class="quickpic_delete">

                    </a>
                </div>
            </div>

        </div>

        <?php } else {  ?>

        <!-- desktop ver /-->

        <div class="select_num_col">
            <div class="select_num_col_part">
                <div class="select_num_col_part-blue"></div>
                <?php /* //Display Delete Button one hover of column */?>
                <div class="quickpic">
                    <div class="quickpic_text on_ticket">&nbsp;</div>
                    <h6 class="pick_num_title"><?php _e('Pick', 'lotto') ?>  <?php echo $data['AmountOfMainNumbersToMatch']; ?> <?php _e('Numbers', 'lotto') ?></h6>
                    <a href="javascript:void(0)" class="quickpic_delete">
                        <!--<img src="<?php echo base_url(); ?>assets/images/delete.png"/>-->
                    </a>
                    <a href="javascript:void(0)" class="quickpic_close visible-xs">
                        <img src="<?php echo base_url(); ?>assets/images/close-icon.png"/>
                    </a>
                </div>
                <div class="all_num_part">

                    <!--<h6 class="slide-trigger"><?php _e('Pick', 'lotto') ?>  <?php echo $data['AmountOfMainNumbersToMatch']; ?> <?php _e('Numbers', 'lotto') ?></h6>-->
                    <div class="watermarktry">
                        <p class="watermarkdigit"><?php echo $numbOfTicket; ?></p>
                    </div>
                    <div class="lt_numbers_wrapper">
                        <!--<div class="watermarktry">
                        <p class="watermarkdigit">2</p>
                        </div>-->
                        <?php
                            for ($i = 1; $i <= $data['NumberOfMainNumbers']; $i++) {
                                echo "<span id=\"$i\">$i</span>";
                            }
                        ?>
                    </div> 
                </div>
                <?php if ($data['NumberOfExtraNumbers'] > 0) : ?>
                    <div class="select_num_part">
                        <h5 class="slide-trigger"><?php _e('Pick', 'lotto') ?> <?php echo $lotteriesNames[$data['LotteryName']]; ?></h5>
                        <div class="select_num_part_wrapper">
                            <?php
                                for ($i = $data["MinExtraNumber"]; $i <= $data['NumberOfExtraNumbers']; $i++) {
                                    echo "<span class=\"line\" id=\"$i\">$i</span>";
                                }
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>
            </div>
        </div>

        <?php } ?>

    <?php } ?>
<?php 
if (empty($_SESSION['allbrand'])) {
        $response = $all_brand_draws;
        $response_decoded = json_decode($response["response"]);
        if ($response["status"] == 200 && is_array($response_decoded)) {
            usort($response_decoded, "sortByOrder");
            $_SESSION['allbrand'] = $response_decoded;
        }
    }

    $lottery = GetLotteryNameFromUrl($_SERVER['REQUEST_URI']);
    if (isset($_SESSION['allbrand'])) {
        foreach ($_SESSION['allbrand'] as $key => $value) {
            if (strtolower($lottery) === strtolower($value->LotteryName)) {
                $data = json_decode(json_encode($value), 1);
                $lotterytypeid = $value->LotteryTypeId;

                break;
            }
        }
    }
    // get rules min lines
    $data["MinExtraNumber"] =1;
    
    $response = $lottery_rules;
    $response_decoded1 = json_decode($response["response"]);
    if ($response["status"] == 200 && is_array($response_decoded1)) {
        $rulesData = $response_decoded1;
        
        foreach ($rulesData as $key => $value) {
            if ($value->LotteryTypeId === $lotterytypeid) {
                $data["MinExtraNumber"] = $value->MinExtraNumber;
                $data["MinLines"] = $value->MinLines;
                $data["MaxLines"] = $value->MaxLines;
                $data["EvenLinesOnly"] = $value->EvenLinesOnly;
                break;
            }
        }
    }

    if (!isset($_SESSION['groupdata'])) {
        $response = $prices_and_discounts;
        $response_decoded = json_decode($response["response"]);
        if ($response["status"] == 200 && is_array($response_decoded)) {
            $_SESSION['groupdata'] = $response_decoded;
        }
    }

    if (isset($_SESSION['groupdata'])) {
        
        foreach ($_SESSION['groupdata'] as $key => $value) {
            if ($lotterytypeid == $value->LotteryTypeId) {
                $groupdata = json_decode(json_encode($value), 1);
                break;
            }
        }
    }

    $selectedno = $groupsel = "";
    if (isset($_SESSION['user_selection']) && count($_SESSION['user_selection']) > 0) {
        foreach ($_SESSION['user_selection'] as $key => $value) {
            if ($key === $data['LotteryName'] && $value['quantity'] > 0) {
                $groupsel = $value;
            }

            if ($key === $data['LotteryName'] && $value['lines'] > 0) {
                $selectedno = $value;
            }
        }
    }
    $sdraws='';
    if (count($data) > 0) {
        // Selections
        $draws = 0;

        $multidraw = array(2, 4, 8, 26, 52);
        $subs = array(1, 2, 4);

        $drawop1 = $drawop2 = $drawop3 = $gdrawop1 = $gdrawop2 = $gdrawop3 = $tdraw = $ssubs = $gtdraw = $gsubs = $drawopSelected1 = $drawopSelected2 = $drawopSelected3 = $gdrawopSelected1 = $gdrawopSelected2 = $gdrawopSelected3 = "";
       
        if (isset($_POST['single_drawop']) && $_POST['single_drawop'] == 1) {
            $sdraws = $_POST['single_drawop'];
            $drawop1 = "checked='checked'";
            $drawopSelected1 = 'selcteddrow';
        } else {
            if (isset($_POST['single_drawop']) && $_POST['single_drawop'] == 2) {
                $sdraws = $_POST['single_totaldraw'];
                $drawop2 = "checked='checked'";
                $drawopSelected2 = 'selcteddrow';
                if (in_array($sdraws, $multidraw)) {
                    $tdraw[$draws] = "selected";
                }
            } else {
                if (isset($_POST['single_drawop']) && $_POST['single_drawop'] == 3) {
                    $sdraws = $_POST['single_subs'];
                    $drawop3 = "checked='checked'";
                    $drawopSelected3 = 'selcteddrow';
                    if (in_array($sdraws, $subs)) {
                        $ssubs[$draws] = "selected";
                    }
                } else {
                    $drawop1 = "checked='checked'";
                    $drawopSelected1 = 'selcteddrow';
                }
            }
        }

        if (isset($_POST['group_drawop']) && $_POST['group_drawop'] == 1) {
            $draws = $_POST['group_drawop'];
            $gdrawop1 = "checked='checked'";
            $gdrawopSelected1 = "selcteddgrouprow";

        } else {
            if (isset($_POST['group_drawop']) && $_POST['group_drawop'] == 2) {
                $draws = $_POST['group_totaldraw'];
                $gdrawop2 = "checked='checked'";
                $gdrawopSelected2 = "selcteddgrouprow";
                if (in_array($draws, $multidraw)) {
                    $gtdraw[$draws] = "selected";
                }
            } else {
                if (isset($_POST['group_drawop']) && $_POST['group_drawop'] == 3) {
                    $draws = $_POST['group_subs'];
                    $gdrawop3 = "checked='checked'";
                    $gdrawopSelected3 = "selcteddgrouprow";
                    if (in_array($draws, $subs)) {
                        $gsubs[$draws] = "selected";
                    }
                } else {
                    $gdrawop1 = "checked='checked'";
                    $gdrawopSelected1 = "selcteddgrouprow";
                }
            }
        }

        if ($selectedno !== "" || $groupsel !== "") {
            if (isset($selectedno['single_drawop']) && $selectedno['single_drawop'] == 1) {
                $sdraws = $selectedno['single_drawop'];
                $drawop1 = "checked='checked'";
                $drawopSelected1 = 'selcteddrow';
            } else {
                if (isset($selectedno['single_drawop']) && $selectedno['single_drawop'] == 2) {
                    $sdraws = $selectedno['single_totaldraw'];
                    $drawop2 = "checked='checked'";
                    $drawopSelected2 = 'selcteddrow';
                    if (in_array($sdraws, $multidraw)) {
                        $tdraw[$draws] = "selected";
                    }
                } else {
                    if (isset($selectedno['single_drawop']) && $selectedno['single_drawop'] == 3) {
                        $sdraws = $selectedno['single_subs'];
                        $drawop3 = "checked='checked'";
                        $drawopSelected3 = 'selcteddrow';
                        if (in_array($sdraws, $subs)) {
                            $ssubs[$draws] = "selected";
                        }
                    } else {
                        $drawop1 = "checked='checked'";
                        $drawopSelected1 = 'selcteddrow';
                    }
                }
            }

            if (isset($groupsel['group_drawop']) && $groupsel['group_drawop'] == 1) {
                $draws = $groupsel['group_drawop'];
                $gdrawop1 = "checked='checked'";
                $gdrawopSelected1 = "selcteddgrouprow";
            } else {
                if (isset($groupsel['group_drawop']) && $groupsel['group_drawop'] == 2) {
                    $draws = $groupsel['group_totaldraw'];
                    $gdrawop2 = "checked='checked'";
                    $gdrawopSelected2 = "selcteddgrouprow";
                    if (in_array($draws, $multidraw)) {
                        $gtdraw[$draws] = "selected";
                    }
                } else {
                    if (isset($groupsel['group_drawop']) && $groupsel['group_drawop'] == 3) {
                        $draws = $groupsel['group_subs'];
                        $gdrawop3 = "checked='checked'";
                        $gdrawopSelected3 = "selcteddgrouprow";
                        if (in_array($draws, $subs)) {
                            $gsubs[$draws] = "selected";
                        }
                    } else {
                        $gdrawop1 = "checked='checked'";
                        $gdrawopSelected1 = "selcteddgrouprow";
                    }
                }
            }
        }

       

    ?>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/css/mobile2.css">

    <div id="middle" class="lotterydetail">

        <div id="buy-now-page" class="wrap">
            <div id="buy-now-top" class="row visible-xs">
                <br />
                <br />
                <br />
                <div class="col-xs-3">
                    <div class="mob-center">
                        <img src="<?php echo base_url(); ?>assets/images/<?php echo strtolower($data['LotteryName']) ?>.png">
                    </div>
                </div>

                <div class="col-xs-9">
                    <div class="row">
                        <div class="banner-mobile">

                            <h2>
                                <?php echo ($data['LotteryName']); ?>
                            </h2>

                        </div>
                        <div class="banner-mobile">

                            <h1>
                                <?php
                                    if ($data['Jackpot'] < 0) {
                                        $jackpot = 'PENDING';
                                    } else {
                                        $jackpot =  $data['LotteryCurrency2'] . " " . ($data['Jackpot'] / 1000000) . ' ' .__('Million','lotto');
                                    }
                                    echo $jackpot;
                                ?>
                            </h1>

                        </div>
                    </div>
                </div>
                <br />
                <br />
                <br />
                <hr>
            </div>
            <div class="banner_txt">
                <div class="slider_content">
                    <div class="clock">
                        <span id="dispclock"><?php echo date("Y-m-d H:i:s", strtotime($data['DrawDate'])); ?></span>
                    </div>
                </div>
                <div class="hadding">
                    <h2>
                        <?php
                            if ($data['Jackpot'] < 0) {
                                $jackpot = 'PENDING';
                            } else {
                                $jackpot =  $data['LotteryCurrency2'] . " " . ($data['Jackpot'] / 1000000) . ' ' .__('Million','lotto');
                            };

                            if (stripos($data['LotteryName'], 'lotto') !== false || stripos($data['LotteryName'], 'loto') !== false) {
                                echo $data['LotteryName'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $jackpot;
                            } else {
                                echo $data['LotteryName'] . " lotto jackpot" . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $jackpot;
                            }
                        ?>
                    </h2>
                </div>
            </div>

            <ul id="main-nav" class="green-nav-buttons mid_buttons">
                <!--<input name="" type="button" value="<?php _e('Clear All','lotto')?>" class="clearall_btn clearall"/>-->
                <span class="removelines hide hidden-xs"><?php _e('Less Lines','lotto')?></span>
                <?php if (wp_is_mobile()): ?>
                    <br>
                    <br>
                    <div class="addline-more extra-lines-button"><?php _e('More Lines','lotto')?></div>
                    <br>
                    <?php endif ?>
                <span class="addlines hidden-xs"><?php _e('More Lines','lotto')?></span>
                <div class="clearall_btn clearall"><img src="<?php echo base_url(); ?>assets/images/delete_red.png" title="Clear All" /></div>
                <input name="" type="button" value="<?php _e('Quick Pick All','lotto')?>" class="picall_btn pickall"/>
            </ul>
            <div class="flex-container">
                <div class="how-to-play">
                    <div class="label">Take a few easy steps</div>
                    <div class="step">
                        <img class="icon" src="<?php echo base_url(); ?>assets/images/step1-icon.png"/>
                        <div class="text" id="how-to-play-label-step1">1. Choose your numbers or QuickPick</div>
                        <div class="step-arrow fa fa-angle-right"></div>
                    </div>
                    <div class="step">
                        <img class="icon" src="<?php echo base_url(); ?>assets/images/step2-icon.png"/>
                        <div class="text">2. Select your draws and duration</div>
                        <div class="step-arrow fa fa-angle-right"></div>
                    </div>
                    <div class="step">
                        <img class="icon" src="<?php echo base_url(); ?>assets/images/step3-icon.png"/>
                        <div class="text">3. Press continue</div>
                    </div>
                </div>
                <a href="#single" class="person-ticket-button" id="person-ticket-button" style="display: none;">
                    <img class="icon" src="<?php echo base_url(); ?>assets/images/group-ticket-icon.png"/>
                    Person ticket
                </a>
            </div>
            <div class="beton-header <?php echo strtolower($data['LotteryName']); ?> <?php echo $data['LotteryName']; ?>">
                <div class="lotto-name-container">
                    <?php 
                        $lotterynameNew = strtolower(ChangeLotteryNameForUrl($data['LotteryName']));
                        $imgsrcNew = '/images/logos/' . $lotterynameNew . '1.png';
                    ?>
                    <img src="<?php echo base_url()."assets/".$imgsrcNew; ?>" class="lotto-logo">
                    <span class="lotto-name"><?php echo $data['LotteryName']; ?></span>
                </div>
                <div class="lotto-prize-container">
                    <?php
                        if ($data['Jackpot'] < 0) {
                            $jackpotnew = 'PENDING';
                        } else {

                            $jackpotnew =  $data['LotteryCurrency2'].($data['Jackpot'] / 1000000).'<span class="small-m">M</span>';
                        };
                    ?>
                    <h1 class="lotto-prize"><?php echo $jackpotnew; ?></h1>
                </div>
                <!-- Timer - Start -->
                <div class="lotto-timer">
                    <div class="timer-view">
                        <table>
                            <tbody>
                                <tr id="caro_clock_time">
                                    <?php /*Replace Time*/ ?>
                                </tr>
                                <tr>
                                    <td><div class="timer-unit unit-1">Hours</div></td>
                                    <td></td>
                                    <td><div class="timer-unit unit-2">Mins</div></td>
                                    <td></td>
                                    <td><div class="timer-unit unit-3">Sec</div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <script type="text/javascript">
                        jQuery(document).ready(function () {
                            var date = '<?php echo date("Y-m-d H:i:s", strtotime($data["DrawDate"])); ?>';
                            var days = '<?php echo date("d", strtotime($data["DrawDate"])) ?>';
                            days*=1;
                            jQuery("#caro_clock_time").countdown(date, function (event) {

                                var totalHours = event.offset.totalDays * 24 + event.offset.hours;

                                //var myhtml = '<td><div class="timer-value value-1">%H</div></td>';
                                //myhtml += '<td><div class="timer-delimiter">:</div></td>';
                                var hourhtml = '';
                                hourhtml += '<td><div class="timer-value value-1">'+totalHours+'</div></td>';
                                hourhtml += '<td><div class="timer-delimiter">:</div></td>';
                                var myhtml = '';
                                myhtml += '<td><div class="timer-value value-2">%M</div></td>';
                                myhtml += '<td><div class="timer-delimiter">:</div></td>';
                                myhtml += '<td><div class="timer-value value-3">%S</div></td>';

                                jQuery(this).html(hourhtml + event.strftime(myhtml));
                            });

                            jQuery( "#magic-pickall" ).click(function() {
                                jQuery( ".picall_btn" ).trigger( "click" );
                            });
                        });
                    </script>

                </div>
                <!-- Timer - End -->


                <div class="lotto-action-container" id="pick-all-button">
                    <button type="button" id="magic-pickall" class="btn-magic-all"><i class="fa fa-magic"></i> <span class="btn-magic-all-text">Pick All</span></button>
                    <!--<button class="btn-trash-all"><i class="fa fa-trash-o"></i></button>-->
                </div>

            </div>
            <form name="singledata" id="singledata" action="<?php echo base_url(); ?>cart" method="post">
                <div class="single active" id="single">
                    <ul id="main-nav" class="green-nav-buttons mid_buttons2">
                        <!--<input name="" type="button" value="<?php _e('Clear All','lotto')?>" class="clearall_btn clearall"/>-->

                        <span class="tooltip" style="display: none;">
                            <div class="removelines hide hidden-xs"></div>
                            <span class="tip-remove-line"><?php _e('Remove Lines','lotto')?></span>
                        </span>
                        <span class="tooltip" style="display: none;">
                            <div class="addlines hidden-xs"></div>
                            <span class="tip-add-line"><?php _e('Add 5 more Lines','lotto')?></span>
                        </span>
                        <span class="tooltip" style="display: none;">
                            <div class="clearall_btn clearall"></div>
                            <span class="tip-clear-line"><?php _e('Clear all selected numbers','lotto')?></span>
                        </span>
                        <span class="tooltip" style="display: none;">
                            <input name="" type="button" class="picall_btn pickall"/>
                            <span class="tip-pick-line"><?php _e('QuickPick Select Numbers on All Tickets on the Page','lotto')?></span>
                        </span>

                    </ul>
                    <div class="cardlist <?php echo $data['LotteryName']; ?>">
                        <input type="hidden" id="totallines" value="1"/>
                        <input type="hidden" id="choosenTab" value="#single"/>
                        <input type="hidden" id="lotteryId" value="<?php echo $lotterytypeid;?>" name="lotteryId" />
                        <input type="hidden" id="m" value="<?php echo $data['NumberOfMainNumbers']; ?>"/>
                        <input type="hidden" id="m1" value="<?php echo $data['AmountOfMainNumbersToMatch']; ?>"/>
                        <input type="hidden" id="e" value="<?php echo $data['NumberOfExtraNumbers']; ?>"/>
                        <input type="hidden" id="e1" value="<?php echo $data['AmountOfExtraNumbersToMatch']; ?>"/>
                        <input type="hidden" id="lines" name="lines"
                            value="<?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['lines'] : ""; ?>"/>
                        <input type="hidden" id="selno" name="selno"
                            value="<?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['selno'] : ""; ?>"/>
                        <input type="hidden" id="singtp" name="totalprice"
                            value="<?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['totalprice'] : ""; ?>"/>
                        <input type="hidden" id="singsubtp" name="subtotal"
                            value="<?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['subtotal'] : ""; ?>"/>
                        <input type="hidden" id="singbm" name="bonusmoney"
                            value="<?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['bonusmoney'] : ""; ?>"/>
                        <input type="hidden" id="minl" value=""/>
                        <input type="hidden" id="maxl" value=""/>
                        <input type="hidden" id="even" value=""/>
                        <input type="hidden" id="storeselected"
                            value="<?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['storeselected'] : ""; ?>" name="storeselected"/>
                        <input type="hidden" id="otherdata" name="otherdata" value="<?php echo $data['LotteryCurrency2'] . "|" . $data['LotteryName'] . "|0"; ?>"/>


                        <div class="card_row addcardrow cardline" id="row_1">
                            <div class="tabin_main">
                                <div class="tabin_main_select left 33  ">
                                    <?php
                                        $cardCount = $data['MinLines'] > 4 ? $data['MinLines'] : 4;
                                        for ($i = 0; $i < $cardCount; $i++) {
                                            selectNumCol($data, $i + 1);
                                        }
                                    ?>
                                </div>
                                <div class="last-section">
                                    <div class="group-ticket-block" style="display:none;">
                                        <a href="#group" class="group-ticket-button" id="group-ticket-button">
                                            <img class="icon" src="<?php echo base_url(); ?>assets/images/group-ticket-icon.png"/>
                                            Group ticket
                                        </a>
                                    </div>
                                    <div class="buy-now-section-new box_det">
                                        <div class="one-time-entry space_add col3 option-row selcteddrow" for="radio1Label">
                                            <div class="spa">
                                                <label for="radio1" class="radio inline radGroup1 oro-option-label" id="radio1Label">
                                                    <input type="radio" name="single_drawop" id="radio1" class="css-checkbox" value="1" <?php echo $drawop1; ?>/>
                                                    <span class="f"><?php _e('1 Draw','lotto')?>
                                                    <span class="tooltip">
                                                        <img src="<?php echo base_url(); ?>assets/images/info_icon.png"/>
                                                        <span>
                                                            <?php _e('1 DRAW','lotto')?> <hr/> <br/> <?php _e('Play for the next upcoming Draw only. <br/> Try a Multi-Draw or Subscription and get higher  discounts per draw.','lotto')?>
                                                        </span>
                                                    </span> 
                                                </label>
                                                <span class="one-draw-description">
                                                    <?php _e('For the upcoming draw only','lotto'); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="multi-drow space_add col3 option-row" for="radio2Label">
                                            <div class="spa">
                                            <label for="radio2" class="radio inline radGroup1 oro-option-label" id="radio2Label"> 
                                                    <input type="radio" name="single_drawop" id="radio2" class="css-checkbox" value="2" <?php echo $drawop2; ?> />
                                                    <span class="f"><?php _e('Multi-draw','lotto')?>
                                                    <span class="tooltip">
                                                            <img src="<?php echo base_url(); ?>assets/images/info_icon.png"/>
                                                            <span>
                                                                <?php _e('MULTI-DRAW','lotto')?> <hr/><br/><?php _e('Choose Multi-Draw to play for several draws in  advance. Save up to 25% per draw.','lotto')?>
                                                            </span>
                                                    </span> 
                                                </label>
                                                <div class="comman left dropdown-option">
                                                    <div class="dropdown_new_c oro-single-dropdown_new_c" style="margin-left: 0px;">
                                                        <select class="single_totaldraw" name="single_totaldraw">
                                                            <option value="2" <?php echo isset($tdraw[2])?$tdraw[2]:''; ?>><?php _e('<span>2 draws</span> 2% discount','lotto')?></option>
                                                            <option value="4" <?php echo isset($tdraw[4])?$tdraw[4]:''; ?>><?php _e('4 draws 4% discount','lotto')?></option>
                                                            <option value="8" <?php echo isset($tdraw[8])?$tdraw[8]:''; ?>><?php _e('8 draws 15% discount','lotto')?></option>
                                                            <option value="26" <?php echo isset($tdraw[26])?$tdraw[26]:''; ?>><?php _e('26 draws 22% discount','lotto')?></option>
                                                            <option value="52" <?php echo isset($tdraw[52])?$tdraw[52]:''; ?>><?php _e('52 draws 25% discount','lotto')?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="subscription space_add col3 option-row" for="radio3Label" style="display:none;">
                                            <div class="spa">
                                                <label for="radio3" class="radio inline radGroup1 oro-option-label" id="radio3Label"> 
                                                    <input type="radio" name="single_drawop" id="radio3" class="css-checkbox" value="3" <?php echo $drawop3; ?> />
                                                    <span class="f"><?php _e('Subscription','lotto')?>
                                                    <span class="tooltip">
                                                        <img src="<?php echo base_url(); ?>assets/images/info_icon.png"/>
                                                        <span>
                                                            <?php _e('Subscription','lotto')?> <hr/><br/><?php _e('Earn more VIP points, more discounts and never miss a draw! Choose your billing period of 1 week, 2 weeks or 4 weeks.','lotto')?>
                                                        </span>
                                                    </span> 
                                                </label>
                                            
                                                <div class="comman left dropdown-option">
                                                    <div class="dropdown_new_c oro-single-dropdown_new_c" style="margin-left: 0px;">
                                                        <select class="single_subs" name="single_subs">
                                                            <option value="1" <?php echo isset($ssubs[1])?$ssubs[1]:''; ?>>
                                                                <?php echo getDiscount('single',1,$data['LotteryName']); ?>
                                                            </option>
                                                            <option value="2" <?php  echo isset($ssubs[2])?$ssubs[2]:''; ?>>
                                                                <?php echo getDiscount('single',2,$data['LotteryName']); ?>
                                                            </option>
                                                            <option value="4" <?php  echo isset($ssubs[4])?$ssubs[4]:''; ?>>
                                                                <?php echo getDiscount('single',4,$data['LotteryName']); ?>
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="space_add">
                                            <div class="spa oro-fill-width">
                                                <div class="oro-lines-draws">
                                                    <div>
                                                        <div class="lines oro-lines"><?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['lines'] : "0" ?> <?php _e('lines','lotto'); ?></div>
                                                        <div class="oro-draws-label">X <span class="draws"><?php echo ($sdraws > 0) ? $sdraws : "1"; ?> <?php _e('Draws','lotto'); ?></span></div>
                                                    </div>
                                                    <div class="oro-lines-draws-price">
                                                        <?php echo SITE_CURRENCY; ?>&nbsp;
                                                        <span class="subtotal"><?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['subtotal'] : floatval(number_format(0.00, 2)); ?></span>
                                                    </div>
                                                </div>
                                                <div style="margin-bottom: 10px;">
                                                    <div id="disc_single" style="display:none;">
                                                        <div>Discount:</div>
                                                        <div>-<?php echo SITE_CURRENCY; ?><span class="discountprice">0.00</span></div>
                                                    </div>
                                                </div>
                                                <div class="oro-ttl_share_lab">
                                                    <div class="oro-bonus-money-block">
                                                        <div class="oro-bonus-money">
                                                            <div class="oro-bonus-label"><?php _e('Bonus Money','lotto'); ?></div>
                                                        </div>
                                                        <span class="tooltip">
                                                            <img src="<?php echo base_url(); ?>assets/images/info_icon.png"/>
                                                            <span><?php _e('Bonus Money','lotto'); ?>
                                                                <hr/><br/>
                                                                <?php _e('This is the amount of bonus money you get on this   purchase. Bonus money can be used to purchase more tickets for free.','lotto'); ?>
                                                            </span>
                                                        </span>
                                                        <div>
                                                            <span class="bmcurrency oro-bmcurrency"><?php echo SITE_CURRENCY; ?></span>&nbsp;
                                                            <span
                                                                class="bonusmoney oro-bonusmoney"><?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['bonusmoney'] : floatval(number_format(0.00,
                                                                2)); ?>
                                                            </span>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="total space_add oro-total-width">
                                            <div class="spa oro-fill-width">
                                                <div class="oro-total-price-text">
                                                    <div class="font13 oro-total-price-label"><?php _e('Total','lotto'); ?></div>
                                                    <div class="font22 oro-total-price-number">
                                                        <?php echo SITE_CURRENCY; ?>&nbsp;
                                                        <span class="totalprice"><?php echo (is_array($selectedno) && count($selectedno) > 0) ? $selectedno['totalprice'] : floatval(number_format(0.00, 2)); ?></span>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="stp" value="<?php echo floatval(number_format($data['PricePerLine'], 2)); ?>" id="stp">
                                                <div class="tpt">
                                            <a class="oro-single-total_share_conti_btn" id="single_continue"><?php _e('Continue','lotto'); ?></a>
                                            <input type="submit" name="submit" value="submit" id="submitform" style="display:none;">
                                            </div>
                                        </div>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear_inner hidden-xs" style="height: 5px;">&nbsp;</div>
                    <?php /*
                        <!--<div class="comman">
                        <hr class="visible-xs">
                        <span class="removelines hide hidden-xs"><?php _e('Less Lines','lotto')?></span>

                        <?php if (wp_is_mobile()): ?>
                        <br>
                        <br>
                        <div class="addline-more extra-lines-button"><?php _e('More Lines','lotto')?></div>
                        <br>
                        <?php endif ?>
                        <span class="addlines hidden-xs"><?php _e('More Lines','lotto')?></span>
                    </div>--> */ ?>

                    <style type="text/css">
                        .col-3-contain {
                            padding: 20px 0px 0px 10px;
                        }
                    </style>

                    <div class="select_page_det left">

                        <!-- <h1><?php //the_title(); ?></h1>-->

                        <div class="col8 left">
                            <?php //while (have_posts()) : the_post(); ?>
                                <?php //the_content(); ?>
                                <?php //endwhile; ?>
                        </div>

                        <div class="col2 left">
                            <img src="<?php echo base_url(); ?>assets/images/scanned_ticket.png"/>
                        </div>

                    </div>

                    <div class="select_page_det2">
                        <div class="del_cup"><img src="<?php echo base_url(); ?>assets/images/del_cup.png"/></div>
                        <div class="star"><img src="<?php echo base_url(); ?>assets/images/star.png"/></div>
                        <div class="font13"><?php //get_field("buynow_field"); ?></div>
                    </div>

                    <div class="hide" id="error">
                        <a href="#" class="remodal-close error-close">&#10006;</a>
                        <div id="errorbox">Ticket lines must between X and Y</div>
                    </div>
                </div>
                </div>
                </div>
            </form>

            <form name="groupdata" action="<?php echo base_url(); ?>/cart" id="groupdata" method="post">
                <div class="group-ticket-section hide" id="group">
                    <div class="body-section">
                        <img class="hidden-xs" src="<?php echo base_url(); ?>assets/images/group.jpg"/>
                        <div class="body-right">
                            <div class="title hidden-xs"><?php echo $data['LotteryName']; ?> <?php _e('Group','lotto'); ?></div>
                            <p class="hidden-xs"><?php _e("Increase your winning chances with a Group Subscription. 1 in 4 jackpots is won by a Group Ticket. On this Subscription we cover all the bonus numbers to increase the winning chances of the group. You get: 50 lines and up to 150 shares in the group. Get more shares so you'll have a bigger portion from the winning","lotto"); ?></p>

                            <div class="shars_countre center-block-mobile">
                                <?php _e('How many shares would you like?','lotto'); ?>

                                <div class="countre">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td width="35" align="left" valign="middle">
                                                <a href="javascript:void(0)" class='qtyminus' field='quantity'>
                                                    <img src="<?php echo base_url(); ?>assets/images/remove_share.png"/>
                                                </a>
                                            </td>
                                            <td width="80" align="center" valign="middle">
                                                <input type="text" name='quantity' class="u_share_fill qty" value="<?php echo ($groupsel != "") ? $groupsel['quantity'] : "1"; ?>"/>
                                            </td>
                                            <td width="35" align="right" valign="middle">
                                                <a href="javascript:void(0)" class="qtyplus" field='quantity'>
                                                    <img src="<?php echo base_url(); ?>assets/images/add_share.png"/>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="group-option-section left">
                        <div class="choose_option left">
                            <div class="box_det" style="width: 100%;padding: 0px;">
                                <div class="col3 group-option-row <?php echo $gdrawopSelected1;?>" style="min-height: 140px;" for="grpradio1">
                                    <div class="col-3-contain">
                                        <label for="grpradio1" class="grp-option-label radGroup1">
                                            <?php _e('1 Draw','lotto'); ?>
                                            <input type="radio" name="group_drawop" id="grpradio1" class="css-checkbox" value="1" <?php echo $gdrawop1; ?>/>
                                            <span class="grp-checkmark"></span>
                                            <span class="tooltip">
                                                <img src="<?php echo base_url(); ?>assets/images/info_icon.png"/>
                                                <span>
                                                    <?php _e('1 Draw','lotto'); ?> <hr/> <br/>
                                                    <?php _e('Play for the next upcoming Draw only. <br/> Try a Multi-Draw or Subscription and get higher  discounts per draw.','lotto'); ?>
                                                </span>
                                            </span>
                                        </label>
                                        <div class="group-single-draw-description">
                                            <span>
                                                <?php _e('For the upcoming draw only','lotto'); ?>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col3 group-option-row <?php echo $gdrawopSelected2;?>" style="min-height: 140px;" for="grpradio2">
                                    <div class="col-3-contain">
                                        <label for="grpradio2" class="grp-option-label radGroup1">
                                            <?php _e('Multi-draw','lotto'); ?>
                                            <input type="radio" name="group_drawop" id="grpradio2" class="css-checkbox" value="2" <?php echo $gdrawop2; ?>/>
                                            <span class="grp-checkmark"></span>
                                            <span class="tooltip">
                                                <img src="<?php echo base_url(); ?>assets/images/info_icon.png"/>
                                                <span><?php _e('Multi-draw','lotto'); ?> <hr/><br/><?php _e('Choose Multi-Draw to play for several draws in  advance. Save up to 20% per draw.','lotto'); ?></span>
                                            </span>
                                        </label>

                                        <div class="comman left">
                                            <div class="dropdown_new_c group-dropdown-option" style="margin-left: 0px;">
                                                <select class="group_totaldraw" name="group_totaldraw">
                                                    <option value="2" <?php echo isset($gtdraw[2])?$gtdraw[2]:''; ?>><?php _e('2 draws','lotto'); ?></option>
                                                    <option value="4" <?php echo isset($gtdraw[4])?$gtdraw[4]:''; ?>><?php _e('4 draws','lotto'); ?></option>
                                                    <option value="8" <?php echo isset($gtdraw[8])?$gtdraw[8]:''; ?>><?php _e('8 draws','lotto'); ?></option>
                                                    <option value="26" <?php echo isset($gtdraw[26])?$gtdraw[26]:''; ?>><?php _e('26 draws 15% discount','lotto'); ?></option>
                                                    <option value="52" <?php echo isset($gtdraw[52])?$gtdraw[52]:''; ?>><?php _e('52 draws 20% discount','lotto'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col3 group-option-row <?php echo $gdrawopSelected3;?>" style="min-height: 140px;" for="grpradio3">
                                    <div class="col-3-contain">
                                        <label for="grpradio3" class="grp-option-label radGroup1">
                                            <?php _e('Subscription','lotto'); ?>
                                            <input type="radio" name="group_drawop" id="grpradio3" class="css-checkbox" value="3" <?php echo $gdrawop3; ?>/>
                                            <span class="grp-checkmark"></span>
                                            <span class="tooltip">
                                                <img src="<?php echo base_url(); ?>assets/images/info_icon.png"/>
                                                <span><?php _e('Subscription','lotto'); ?>
                                                    <hr/><br/><?php _e('Earn more VIP points, more discounts and never miss a draw! Choose your billing period of 1 week, 2 weeks or 4 weeks.','lotto'); ?>
                                                </span>
                                            </span>
                                        </label>

                                        <div class="comman left">
                                            <div class="dropdown_new_c group-dropdown-option" style="margin-left: 0px;">
                                              <select class="group_subs" name="group_subs">
                                                    <option value="1" <?php echo $gsubs[1]; ?>>
                                                        <?php echo getDiscount('group',1,$data['LotteryName']);?>
                                                    </option>
                                                    <option value="2" <?php echo $gsubs[2]; ?>>
                                                    <?php echo getDiscount('group',2,$data['LotteryName']);?>
                                                    </option>
                                                    <option value="4" <?php echo $gsubs[4]; ?>>
                                                    <?php echo getDiscount('group',4,$data['LotteryName']);?>
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="total_sum right">
                            <div class="shares-draws">
                                <div class="shares-draws-label">
                                    <span class="shares"><?php echo ($groupsel !== "") ? $groupsel['quantity'] : "1"; ?> <?php _e('Shares','lotto');?></span>
                                    X <span class="draws"><?php echo ($groupsel != "") ? $draws : "1"; ?> <?php _e('Draws','lotto');?></span>
                                </div>
                                <div class="value">
                                    <?php echo SITE_CURRENCY; ?>
                                    <span class="subtotal"><?php echo ($groupsel != "") ? $groupsel['subtotal'] : floatval(number_format($groupdata['Price'], 2)); ?></span>
                                </div>
                            </div>
                            <div class="discount-section" id="disc_group" style="display:none">
                                <div class="label">Discount</div>
                                <div class="value">-<?php echo SITE_CURRENCY; ?><span class="discountprice">0.00</span></div>
                            </div>
                            <div class="bonusmoney-section">
                                <div class="label">Bonus Money</div>
                                <div class="value">
                                    <?php echo SITE_CURRENCY; ?>
                                    <span class="bonusmoney">
                                        <?php echo ($groupsel != "") ? $groupsel['bonusmoney'] : floatval(number_format($groupdata['Price'], 2)); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="bottom-section">
                                <div class="total">
                                    <div class="label">Total</div>
                                    <div class="value">
                                        <?php echo SITE_CURRENCY; ?>&nbsp;
                                        <span class="totalprice"><?php echo ($groupsel != "") ? $groupsel['totalprice'] : floatval(number_format($groupdata['Price'], 2)); ?></span>
                                    </div>
                                </div>
                                <input type="hidden" value="<?php echo floatval(number_format($groupdata['Price'], 2)); ?>"
                                    id="gtp">
                                <input type="hidden" id="grptp" name="totalprice"
                                    value="<?php echo ($groupsel != "") ? $groupsel['totalprice'] : ""; ?>"/>
                                <input type="hidden" id="grpsubtp" name="subtotal"
                                    value="<?php echo ($groupsel != "") ? $groupsel['subtotal'] : ""; ?>"/>
                                <input type="hidden" id="grpbm" name="bonusmoney"
                                    value="<?php echo ($groupsel != "") ? $groupsel['bonusmoney'] : ""; ?>"/>
                                <input type="hidden" id="otherdata" name="otherdata" value="
                                    <?php echo $data['LotteryCurrency2'] . "|" . $data['LotteryName'] . "|0"; ?>"/>
                                <input type="hidden" id="productid" name="productid" value="<?php echo $groupdata['ProductId']; ?>"/>
                                <a href="#" class="total_share_conti_btn" id="group_continue"><?php _e('Continue','lotto');?></a>
                            </div>
                        </div>
                    </div>
                    <div class="clear_inner" style="height: 0;">&nbsp;</div>

                    <div class="visible-xs">

                        <div class="grp_left visible-xs">
                            <div class="grp_ttl"><?php _e('Improve your odds with group','lotto'); ?></div>
                            <div class="grp_img">
                                <img src="<?php echo base_url(); ?>assets/images/man_jumping.png"/>
                            </div>
                            <div class="grp_ttl"><?php echo $data['LotteryName']; ?> <?php _e('Group','lotto'); ?></div>
                            <br>
                            <p><?php _e("Increase your winning chances with a Group Subscription. 1 in 4 jackpots is won by a Group Ticket. On this Subscription we cover all the bonus numbers to increase the winning chances of the group. You get: 50 lines and up to 150 shares in the group. Get more shares so you'll have a bigger portion from the winning","lotto"); ?></p>
                            <br>
                        </div>

                    </div>

                    <div class="select_page_det left">
                        <!--<h1><?php //the_title(); ?></h1>-->
                        <div class="col8 left">
                            <?php //while (have_posts()) : the_post(); ?>
                                <?php //the_content(); ?>
                                <?php //endwhile; ?>
                        </div>
                        <div class="col2 left">
                            <img src="<?php echo base_url(); ?>assets/images/scanned_ticket.png"/>
                        </div>
                    </div>

                    <div class="select_page_det2">
                        <div class="del_cup"><img src="<?php echo base_url(); ?>assets/images/del_cup.png"/></div>
                        <div class="star"><img src="<?php echo base_url(); ?>assets/images/star.png"/></div>
                        <div class="font13"><?php //get_field("buynow_field"); ?></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
} else {
    echo "<script>location.reload();</script>";
    exit();
}
