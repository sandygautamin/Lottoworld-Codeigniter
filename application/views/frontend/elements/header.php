<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#" ng-app="myApp" ng-controller="mainCtrl">
   <head id="Head1">
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width">
      <title>Play lotteries online - LWG</title>
      <link rel='stylesheet' href="<?php echo base_url('assets/css/style.css');?>" type="text/css" />
      <link rel='stylesheet' href="<?php echo base_url('assets/css/jquery.drawer.css');?>" type="text/css" />
      <link rel='stylesheet' href="<?php echo base_url('assets/css/owl.carousel.css');?>" type="text/css" />
      <link rel='stylesheet' href="<?php echo base_url('assets/css/my-account.css');?>" type="text/css" />
      <link rel='stylesheet' href="<?php echo base_url('assets/css/home.css');?>" type="text/css" />
      <link rel='stylesheet' href="<?php echo base_url('assets/css/cart.css');?>" type="text/css" />
      <link rel='stylesheet' href="<?php echo base_url('assets/css/responsive-tabs.css');?>" type="text/css" />
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> 
      <?php global $_LOTTERY_CONFIG;?>
      <script>
         var CONFIG = {
         	"imgurl": "https://www.lottoworldgroup.com/wp-content/themes/lotto_theme/images/loading.gif",
         	"templateURL" : "https://www.lottoworldgroup.com/wp-content/themes/lotto_theme",
         	"adminURL": "<?php echo base_url()?>",
         	"homeURL": "<?php echo base_url()?>",
                "base_url": "<?php echo base_url()?>",
         	"isHome": "",
         	"isMobile": false,
         	"isLogin": false,
         	"sessionId": 0,
         	"affiliateId": 0,
         	"isThankYouPage": false,
         	"siteCurrency": "€",
         	"cartPromoCode": "",
         	"countryCode": "",
         	"isFirstPurchase": "false",
         	"siteLang": "en"
         };
         
         

var CART_CONFIG = {"CART_PARTIALS_URI":"https://www.lottoworldgroup.com/wp-content/themes/lotto_theme/fragments/cart-partials/","CART_TRANSLATION_URL":"https://www.lottoworldgroup.com\/wp-content/themes/lotto_theme/languages/translations/","CART_PRODUCTS":"","CART_OLAP_AFFILIATE_CODE":"0","CART_IS_FIRSTTIME_PURCHASE":"0","CART_DEV":"0"};
/* ]]> */

         var cacheData='<?php echo json_encode($_LOTTERY_CONFIG)?>';
         localStorage.setItem("cachefactory.caches.cachelottoyard.data.lottery-rules", cacheData);
         var translationObject=<?php echo $translation_array =json_encode($this->config->item('translation_array'));?>
      </script>
   </head>
   <body class="home ">
      <?php 
         //echo "<pre>";//echo print_r($draws);die;
         $all_lottaryies = all_lottaryies($draws);
         $upcoming_lottary=$all_lottaryies['upcoming_lottary'];
         $previous_lottery=$all_lottaryies['previous_lottery'];
         $defaultLotoLinks=$this->config->item('default_lotto_links');
         
         $defaultLoto=getDefaultLottary();
         //$defaultLoto = array_slice($defaultLoto, 0, 7, true);
          //echo "<pre>";print_r($previous_lottery); die;
         //die;
         ?>
      <main>
      <header id="header" class="clearfix">
         <div class="wrap">
            <a class="logo" href="<?php echo base_url();?>">LWG</a> <a href="#" data-href="nav" class="mobile-trigger trigger-nav"> <i> <span class="line-1"></span> <span class="line-2"></span> <span class="line-3"></span> </i> </a>
            <div id="menu-container">
               <div class="wrap-top-menu">
                  <ul id="menu-header-menu" class="top-menu">
                     <li id="menu-item-1395" class="lottary-play show-dd menu-item menu-item-type-post_type menu-item-object-page menu-item-1395">
                        <div class="menu-arrow"></div>
                        <a href="#">Lotteries</a> 
                     </li>
                     <li id="menu-item-1394" class="lottary-info show-dd menu-item menu-item-type-post_type menu-item-object-page menu-item-1394">
                        <div class="menu-arrow"></div>
                        <a href="#">Results</a> 
                     </li>
                     <li id="menu-item-1381" class="nav-item-my-account nav-item menu-item menu-item-type-post_type menu-item-object-page menu-item-1381 show-sign-up">
                        <div class="menu-arrow"></div>
                        <a href="<?php echo base_url('users/account');?>">My Account</a> 
                     </li>
                     <li id="menu-item-1382" class="nav-item menu-item menu-item-type-post_type menu-item-object-page menu-item-1382">
                        <div class="menu-arrow"></div>
                        <a href="<?php echo base_url("support")?>">Support</a> 
                     </li>
                  </ul>
                  <div class="wrap-cta">
                     <?php if($this->session->userdata('userId')):?>
                     <a href="<?php echo base_url("/")?>" class="show-sign-in"><i class="fas fa-user"></i> <?php echo $this->session->userdata('fname');?></a> <a href="<?php echo base_url("users/logout")?>" class="show-sign-in"></i>Logout</a>
                     <?php else:?>
                     <a href="<?php echo base_url("login-signup")?>" class="show-sign-in"><i class="fas fa-sign-in-alt"></i>Log in</a> <a href="<?php echo base_url("login-signup")?>" class="show-sign-up"><i class="fas fa-edit"></i>Register</a>
                     <?php endif;?>
                  </div>
                  <?php //$rows = count($this->cart->contents()); ?>
                  <a class="paymentheadercontrol" href="<?php echo base_url();?>cart"> <?php //echo $rows;?></a>
                  
                  
               </div>
               <!--End whole price cart-->
              

              
               
               <!-- ./wrap-top-menu -->
               <div class="wrap-popups hidden-xs">
                  <div class="playlottary  hidden-xs" style="display: none;">
                     <div id="navbar-item-lotto-games" class="dropdown-menu" style="display: block;">
                        <div id="lotto-games-container" class="lotto-games-container">
                           <div class="lotto-games-content">
                              <ul class="menu-games">
                                <?php /*?> <li class="menu-item beton">
                                    <div class="menu-arrow"></div>
                                    <div class="item-header">
                                       <div class="brand-logo"><img src="<?php echo base_url();?>assets/images/logos/13.png" title="Irish Lotto"></div>
                                       <div class="brand-prize">
                                          <h2 class="prize">€2.24<span class="small-m">B</span></h2>
                                       </div>
                                       <div class="brand-name">NAVIDAD</div>
                                    </div>
                                    <div class="item-body">
                                       <div class="brand-command"> <a href="<?php echo base_url();?>navidad" class="play-beton">PLAY</a> </div>
                                       <div class="timer" data-days="5"> <span class="timer-value"> </span> </div>
                                    </div>
                                    <div class="item-footer">
                                       <div class="subscription-link"> <a href="<?php echo base_url();?>navidad">Syndicate &gt;</a> </div>
                                    </div>
                                 </li><?php */?>
                                 <?php if($upcoming_lottary):
                                    foreach($upcoming_lottary as $lottary):
                                      
                                       if(!in_array($lottary['type'],$defaultLoto) ){
                                          continue;
                                       }
                                       $lottary['type']=lottery_name_mapping($lottary['type']);
                                       
                                    
                                       $mytotalSec = (strtotime(date("Y-m-d H:i:s", strtotime($lottary['date'])))-time());
                                       
                                    ?>
                                 <li class="menu-item beton">
                                    <div class="menu-arrow"></div>
                                    <div class="item-header">
                                       <div class="brand-logo"><img src="<?php echo base_url() ?>/assets/images/logos/<?php echo $lottary['type']?>1.png" title="Irish Lotto"></div>
                                       <div class="brand-prize">
                                          <h2 class="prize"><?php echo getSymbolByCode($lottary['currency']);?><?php echo convert_number($lottary['jackpot']['total']);?></h2>
                                       </div>
                                       <div class="brand-name"><?php echo $lottary['type']?></div>
                                    </div>
                                    <div class="item-body">
                                       <?php 
                                          $lotterynameLink = strtolower(ChangeLotteryNameForUrl($lottary['type']));
                                          $linkplay        = base_url() .$lotterynameLink . '-lottery/';?>
                                       <div class="brand-command"> <a href="<?php echo $linkplay?>" class="play-beton">PLAY</a> </div>
                                       <div class="timer" data-days="5"> <span class="timer-value"><?php echo secondsToWordsNew($mytotalSec); ?> </span> </div>
                                    </div>
                                    <div class="item-footer">
                                       <div class="subscription-link"> <a href="<?php  echo $linkplay;?>">Syndicate &gt;</a> </div>
                                    </div>
                                 </li>
                                 <?php endforeach;endif;?>
                              </ul>
                           </div>
                        </div>
                        <div class="lotto-games-footer"><a href="<?php echo base_url('lotteries');?>">See all lotteries</a></div>
                     </div>
                  </div>
                  <div class="result_info" style="display: none;">
                     <div id="navbar-item-result" class="dropdown-menu hidden-xs" style="display: none;">
                        <p class="latest-results">Latest Results</p>
                        <div class="results-info-box-content" style="min-height: 250px;">
                           <div class="results-info-box-content-result" style="display: block;">
                              <ul class="menu-result-container">
                                 <?php if($previous_lottery):
								
                                    foreach($previous_lottery as $lotto){
                                    
                                    if(!in_array($lotto['type'],$defaultLoto)){
                                       continue;
                                    }
                                    $lotto['type']=lottery_name_mapping($lotto['type']);
                                    $lotloDate=new DateTime($lotto['date']);
                                    ?>
                                 <li class="res-menu-item">
                                    <div class="menu-info-line info-line-logo"> <img src="<?php echo base_url()?>assets/images/logos/<?php echo  $lotto['type']?>1.png" alt="<?php echo  $lotto['type']?>" title="<?php echo  $lotto['type']?>"> </div>
                                    <div class="menu-info-line info-line-brand">
                                       <div class="info-brand-name"><?php echo ucfirst($lotto['type']);?></div>
                                       <div class="info-brand-timer"><?php echo $lotloDate->format("f j M") ?></div>
                                    </div>
                                    <div class="menu-info-line info-line-numbers">
                                       <?php if(isset($lotto['numbers']['main'])):
									   foreach($lotto['numbers']['main'] as $number): ?>
                                       <div class="draw-number draw-number-type-1"><?php echo $number?></div>
                                       <?php endforeach;?>
                                       <?php endif;?>
                                       <?php 
                                          $key=getDrawTypeTwo($lotto['type']);
                                          $type2='';
                                          if(!empty($key) && isset($lotto['numbers'][$key])){
                                             if(!is_array($lotto['numbers'][$key])){
                                                ?>
                                       <div class="draw-number draw-number-type-2"><?php echo $lotto['numbers'][$key]?></div>
                                       <?php 
                                          }
                                          else 
                                          echo '<div class="draw-number draw-number-type-2">'.implode('</div> <div class="draw-number draw-number-type-2">',$lotto['numbers'][$key])."</div>";
                                          }?>
                                    </div>
                                    <div class="menu-info-line info-line-text" style="display:none;"> <a href="https://www.lottoworldgroup.com/powerball-results/">More Results</a><br>
                                       <a href="https://www.lottoworldgroup.com/powerball-info/">More Info</a> 
                                    </div>
                                    <div class="menu-info-line info-line-command"> <a href="https://www.lottoworldgroup.com/powerball-lottery/" class="play-now-btn">PLAY</a> </div>
                                 </li>
                                 <?php } endif;?>
                              </ul>
                           </div>
                        </div>
                        <div class="results-info-box results-footer">
                           <div class="panel">
                              <div class="panel-footer">
                                 <div class="subscribe"> <a href="<?php echo base_url('lottery-results');?>" title="" class="subscribe-txt">Click HERE for Lottery Results and Winning Numbers</a> </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- ./wrap-popups --> 
            </div>
            <!-- ./menu-container --> 
         </div>
         <!-- ./wrap-header --> 
      </header>