
<?php 
$all_lottaryies = all_lottaryies($draws);
$upcoming_lottary=$all_lottaryies['upcoming_lottary'];
$linkplay='';
$defaultLotteryTotal=0;
$defaultLotteryCurrency='';
$defaultLotteryName='';
foreach($upcoming_lottary as $lottary):
   $defaultLoto = getDefaultLottary(strtolower($lottary['type']));
   if(!$defaultLoto){
      continue;
   }
   $lotterynameLink = strtolower(ChangeLotteryNameForUrl($lottary['type']));
   $linkplay        = base_url() .$lotterynameLink . '-lottery/';
   $defaultLotteryTotal=convert_number($lottary['jackpot']['total']);
   $defaultLotteryCurrency=getSymbolByCode($lottary['currency']);
   $defaultLotteryName=$defaultLoto->LotteryName;
   break;
endforeach;
?>
<div id="main" class="clearfix">
   <div class="phoenix-slider hidden-xs" style="display: flex; justify-content: center; height: 391px;">
      <div class="phoenix-feather" style="background-image: url(&quot;undefined&quot;); z-index: 99999; opacity: 1;">
         <div class="slider_content">
            <div class="l-stageTemplate-banner <?php echo $defaultLotteryName; ?>">
               <div class="l-stageTemplate-banner-iconContainer">
                  <img class="l-stageTemplate-banner-iconContainer-icon" src="<?php echo base_url();?>assets/images/logos/<?php echo strtolower($defaultLotteryName); ?>1.png">
               </div>
               <div class="l-stageTemplate-banner-jackpot">
                  <span class="l-stageTemplate-banner-jackpot-currency"><?php echo $defaultLotteryCurrency?></span>
                  <span class="l-stageTemplate-banner-jackpot-amount">
                  <strong> <?php echo $defaultLotteryTotal;?>  </strong>
                  </span>
                  <span class="l-stageTemplate-banner-jackpot-million">
                  <span class="l-stageTemplate-banner-jackpot-translation">Million</span>
                  </span>
               </div>
               <div class="l-stageTemplate-banner-ctaWrapper">
                  <span class="l-stageTemplate-banner-ctaWrapper-pitch">
                  Buy official lottery tickets online               
                  </span>
                  <a href="<?php echo $linkplay;?>" class="btn btn-primary stageBtnAlignment">
                  PLAY NOW
                  </a>
               </div>
            </div>
         </div>
      </div>
      <img src="<?php echo base_url();?>assets/images/home-blue-banner.jpg" style="height: 410px;" alt="" class="loto_banner">
   </div>
</div>
<div class="clear">
</div>
<!-- SECTION 2 -->

<div class="wrap lotto-owl-slider">
   <div id="owl-demo" class="owl-carousel">
      <?php foreach($upcoming_lottary as $lottary):
         
     $defaultLoto = getDefaultLottary(lottery_name_mapping(strtolower($lottary['type'])) );
      if(!$defaultLoto){
         continue;
      }
      if(lottery_name_mapping($lottary['type'])){
         $lottary['type']=lottery_name_mapping($lottary['type']);
      }
      $lotterynameLink = strtolower(ChangeLotteryNameForUrl($lottary['type']));
      $linkplay        = base_url() .$lotterynameLink . '-lottery/';
          $mytotalSec = (strtotime(date("Y-m-d H:i:s", strtotime($lottary['date'])))-time());
         ?>
      <div class="slide <?php echo $defaultLoto->LotteryName?> track" data-track-name="slideWM">
         <a data-query="dyj=false" href="<?php  echo $linkplay;?>" class="js-ajaxNavi ajaxNavi">
            <div class="teaserBox">
               <div class="content">
                  <img style="width: 80px;float: right;" src = "<?php echo base_url();?>assets/images/logos/<?php echo $lottary['type']?>1.png" />
                  <div class="lottoLabel">
                     <?php echo $defaultLoto->LotteryName?>                                
                  </div>
                  <div class="jackpot">
                  <?php echo getSymbolByCode($lottary['currency']);?><?php echo convert_number($lottary['jackpot']['total']);?>                                
                  </div>
               </div>
               <div class="footer">
                  <div class="countdown" id="caro_clock_0"><?php echo secondsToWordsNew($mytotalSec); ?> </div>
                  <a href="<?php echo  $linkplay;?>" class="button goOn">Play Now</a>
         </div>
         </div>
         </a>
      </div>
      <?php endforeach;?>

      
   </div>
   <a href="<?php echo base_url();?>lottery/" class="right" style="margin: 12px 0 0 0;">View all lotteries<i class="ico-arrow-right"></i></a>
   <div class="clear"></div>
</div>
<!-- SECTION 3 -->
<div class="clear">&nbsp;</div>
<div id="middle_home">
   <div class="wrap">
      <div id="middle_about">
         <div class="cart-products">
            <!-- <h1 class="special-heading">Increase your chances by <a href="https://www.orolotto.com/all-group/">playing with a group,</a> pay a fraction of the cost and win!</h1> -->
            <!--<div class="row">
               <div class="cart-item item">
                   <div class="slider_box">
                       <div class="slider_bg new-york-lotto">
                           <div class="slidewrap">
                               <h1 class="lname">Get 200 tickets</h1>
                               <h2 class="lname2">$600</h2>
                           </div>
                           <div class="item_img">
                               <div class="lottinner sliderlogoMegaMillions"></div>
                           </div>
                       </div>
               
                       <div class="carousel_time">
                           <div class="comman">
                               <a href="#" onclick="buyNowProductBtn(3, 4, 2, 1)">
                                   <span id="firstJackpot" class="buy_button cart_button"></span>
                               </a>
                           </div>
               
                           <div class="comman">
                               <a href="#" onclick="viewMorePopUp(3, 1, 2)">
                                   <span class="buy_button view_button"></span>
                               </a>
                           </div>
                       </div>
                   </div>
               </div>
               
               <div class="cart-item item">
                   <div class="slider_box">
                       <div class="slider_bg new-york-lotto">
                           <div class="slidewrap">
                               <h1 class="lname">Get 200 tickets</h1>
                               <h2 class="lname2">$550</h2>
                           </div>
                           <div class="item_img">
                               <div class="lottinner sliderlogoPowerBall"></div>
                           </div>
                       </div>
               
                       <div class="carousel_time">
                           <div class="comman">
                               <a href="#" onclick="buyNowProductBtn(3, 4, 1, 1)">
                                   <span id="secondJackpot" class="buy_button cart_button"></span>
                               </a>
                           </div>
               
                           <div class="comman">
                               <a href="#" onclick="viewMorePopUp(3, 1, 1)">
                                   <span class="buy_button view_button"></span>
                               </a>
                           </div>
                       </div>
                   </div>
               </div>
               
               <div class="cart-item item">
                   <div class="slider_box">
                       <div class="slider_bg new-york-lotto">
                           <div class="slidewrap">
                               <h1 class="lname">Get 200 tickets</h1>
                               <h2 class="lname2">€90</h2>
                           </div>
                           <div class="item_img">
                               <div class="lottinner sliderlogoSuperEnalotto"></div>
                           </div>
                       </div>
               
                       <div class="carousel_time">
                           <div class="comman">
                               <a href="#" onclick="buyNowProductBtn(3, 4, 8, 1)">
                                   <span id="thirdJackpot" class="buy_button cart_button"></span>
                               </a>
                           </div>
               
                           <div class="comman">
                               <a href="#" onclick="viewMorePopUp(3, 1, 8)">
                                   <span class="buy_button view_button"></span>
                               </a>
                           </div>
                       </div>
                   </div>
               </div>
               </div>-->
            <div class="row row-special" style="display:none;">
               <div class="cart-item item" id="americanGroup">
                  <div class="slider_box">
                     <div class="slider_bg new-york-lotto">
                        <div class="item_img">
                           <img src="<?php echo base_url();?>assets/images/product-logo-america.png">                                
                        </div>
                        <div class="slidewrap">
                           <h1 class="lname">American <span class="brand-color">Group</span></h1>
                           <h2 class="lname2"></h2>
                        </div>
                     </div>
                     <div class="carousel_time">
                        <div class="comman">
                           <a href="#" onclick="viewMorePopUp(999, 1, 7)">
                           <span class="buy_button view_big">Details</span>
                           </a>
                        </div>
                        <div class="comman">
                           <a href="#" onclick="buyNowProductBtn(999, 2, 7, 1)">
                           <span class="buy_button special">Join Group</span>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="cart-item item" id="euroGroup">
                  <div class="slider_box">
                     <div class="slider_bg new-york-lotto">
                        <div class="item_img">
                           <img src="<?php echo base_url();?>assets/images/product-logo-euro.png">                                
                        </div>
                        <div class="slidewrap">
                           <h1 class="lname">Euro <span class="brand-color">Group</span></h1>
                           <h2 class="lname2"></h2>
                        </div>
                     </div>
                     <div class="carousel_time">
                        <div class="comman">
                           <a href="#" onclick="viewMorePopUp(998, 1, 7)">
                           <span class="buy_button view_big">Details</span>
                           </a>
                        </div>
                        <div class="comman">
                           <a href="#" onclick="buyNowProductBtn(998, 2, 7, 1)">
                           <span class="buy_button special">Join Group</span>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="cart-item item" id="topGroup">
                  <div class="slider_box">
                     <div class="slider_bg new-york-lotto">
                        <div class="item_img">
                           <img src="<?php echo base_url();?>assets/images/product-logo-tophunter.png">                                
                        </div>
                        <div class="slidewrap">
                           <h1 class="lname">Jackpot <span class="brand-color">hunter</span></h1>
                           <h2 class="lname2"></h2>
                        </div>
                     </div>
                     <div class="carousel_time">
                        <div class="comman">
                           <a href="#" onclick="viewMorePopUp(14, 2, 7)">
                           <span class="buy_button view_big">Details</span>
                           </a>
                        </div>
                        <div class="comman">
                           <a href="#" onclick="buyNowProductBtn(14, 2, 7, 1)">
                           <span class="buy_button special">Join Group</span>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="cart-item item" id="americanGroup">
                  <div class="slider_box">
                     <div class="slider_bg new-york-lotto">
                        <div class="item_img">
                           <img src="<?php echo base_url();?>assets/images/product-logo-america.png">                                
                        </div>
                        <div class="slidewrap">
                           <h1 class="lname">American <span class="brand-color">Group</span></h1>
                           <h2 class="lname2"></h2>
                        </div>
                     </div>
                     <div class="carousel_time">
                        <div class="comman">
                           <a href="#" onclick="viewMorePopUp(999, 1, 7)">
                           <span class="buy_button view_big">Details</span>
                           </a>
                        </div>
                        <div class="comman">
                           <a href="#" onclick="buyNowProductBtn(999, 2, 7, 1)">
                           <span class="buy_button special">Join Group</span>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="cart-popup" id="">
         <a href="#" onclick="viewMorePopUpHide()">
            <div class="close-btn"></div>
         </a>
         <div class="signinwrap">
            <div class="form-title">
               <div class="product-logo" id="popUpProduct"></div>
               <div class="form_hadding" id="popUpTitle"></div>
            </div>
         </div>
      </div>
      <div class="wrap">
         <div class="home-new-section-playgroup-result">
            <div class="play-in-group-section">
               <h1>Playing in a group</h1>
               <div id="nav-megamillions-group-ticket" class="home-banner-new" style="cursor:pointer;">
                  <h2>Playing in a group is <br>more fun and <br>cost less!</h2>
                  <a href="./all-group/" class="banner-buy-btn">Join Now</a>
                  <!--    <a href="?group-tab" class="banner-buy-btn">Join Now</a> -->
               </div>
            </div>
            <div class="lotto-results-section">
               <h1>Last Lotto Result</h1>
               <div class="lotteryresultslist-new">
                  <style type="text/css">
                     /* #scroller > li:nth-of-type(even) {background-color:rgb(219, 224, 238);} */
                  </style>
                  <div class="vert simply-scroll-container">
                     <div class="simply-scroll-clip">
                        <div class="simply-scroll-list" >
                           <ul class="container simply-scroll-list" id="scroller" >
                              <li class="block">
                                 <div class="result-list-info">
                                    <div class="result-lottery-logo"><img src="<?php echo base_url();?>assets/images/logos/elgordo1.png" title="ElGordo"></div>
                                    <div class="result-lottery-titledate">
                                       <div class="hadding">
                                          <div class="name">ElGordo</div>
                                       </div>
                                       <div class="datenum">10.01.2021 </div>
                                    </div>
                                    <div class="result-join-now-link">
                                       <a href="<?php echo base_url();?>/elgordo-results/" class="item" style="display:none;">Join Now</a>
                                    </div>
                                 </div>
                                 <div class="result">
                                    <ul>
                                       <li class="ellipse_blue">2</li>
                                       <li class="ellipse_blue">19</li>
                                       <li class="ellipse_blue">20</li>
                                       <li class="ellipse_blue">21</li>
                                       <li class="ellipse_blue">25</li>
                                       <li class="ellipse_green">0</li>
                                    </ul>
                                 </div>
                              </li>
                              <li class="block">
                                 <div class="result-list-info">
                                    <div class="result-lottery-logo"><img src="<?php echo base_url();?>assets/images/logos/newyorklotto1.png" title="NewYorkLotto"></div>
                                    <div class="result-lottery-titledate">
                                       <div class="hadding">
                                          <div class="name">NewYorkLotto</div>
                                       </div>
                                       <div class="datenum">09.01.2021 </div>
                                    </div>
                                    <div class="result-join-now-link">
                                       <a href="<?php echo base_url();?>/newyorklotto-results/" class="item" style="display:none;">Join Now</a>
                                    </div>
                                 </div>
                                 <div class="result">
                                    <ul>
                                       <li class="ellipse_blue">16</li>
                                       <li class="ellipse_blue">30</li>
                                       <li class="ellipse_blue">34</li>
                                       <li class="ellipse_blue">43</li>
                                       <li class="ellipse_blue">46</li>
                                       <li class="ellipse_blue">50</li>
                                       <li class="ellipse_green special">29</li>
                                    </ul>
                                 </div>
                              </li>
                              <li class="block">
                                 <div class="result-list-info">
                                    <div class="result-lottery-logo"><img src="<?php echo base_url();?>assets/images/logos/lotto6491.png" title="Lotto649"></div>
                                    <div class="result-lottery-titledate">
                                       <div class="hadding">
                                          <div class="name">Lotto649</div>
                                       </div>
                                       <div class="datenum">09.01.2021 </div>
                                    </div>
                                    <div class="result-join-now-link">
                                       <a href="<?php echo base_url();?>/lotto649-results/" class="item" style="display:none;">Join Now</a>
                                    </div>
                                 </div>
                                 <div class="result">
                                    <ul>
                                       <li class="ellipse_blue">4</li>
                                       <li class="ellipse_blue">8</li>
                                       <li class="ellipse_blue">18</li>
                                       <li class="ellipse_blue">24</li>
                                       <li class="ellipse_blue">31</li>
                                       <li class="ellipse_blue">32</li>
                                       <li class="ellipse_green special">40</li>
                                    </ul>
                                 </div>
                              </li>
                              <li class="block">
                                 <div class="result-list-info">
                                    <div class="result-lottery-logo"><img src="<?php echo base_url();?>assets/images/logos/uklotto1.png" title="UkLotto"></div>
                                    <div class="result-lottery-titledate">
                                       <div class="hadding">
                                          <div class="name">UkLotto</div>
                                       </div>
                                       <div class="datenum">09.01.2021 </div>
                                    </div>
                                    <div class="result-join-now-link">
                                       <a href="<?php echo base_url();?>/uklotto-results/" class="item" style="display:none;">Join Now</a>
                                    </div>
                                 </div>
                                 <div class="result">
                                    <ul>
                                       <li class="ellipse_blue">9</li>
                                       <li class="ellipse_blue">21</li>
                                       <li class="ellipse_blue">23</li>
                                       <li class="ellipse_blue">30</li>
                                       <li class="ellipse_blue">35</li>
                                       <li class="ellipse_blue">38</li>
                                       <li class="ellipse_green special">53</li>
                                    </ul>
                                 </div>
                              </li>
                              <li class="block">
                                 <div class="result-list-info">
                                    <div class="result-lottery-logo"><img src="<?php echo base_url();?>assets/images/logos/laprimitiva1.png" title="LaPrimitiva"></div>
                                    <div class="result-lottery-titledate">
                                       <div class="hadding">
                                          <div class="name">LaPrimitiva</div>
                                       </div>
                                       <div class="datenum">09.01.2021 </div>
                                    </div>
                                    <div class="result-join-now-link">
                                       <a href="<?php echo base_url();?>/laprimitiva-results/" class="item" style="display:none;">Join Now</a>
                                    </div>
                                 </div>
                                 <div class="result">
                                    <ul>
                                       <li class="ellipse_blue">8</li>
                                       <li class="ellipse_blue">13</li>
                                       <li class="ellipse_blue">19</li>
                                       <li class="ellipse_blue">25</li>
                                       <li class="ellipse_blue">29</li>
                                       <li class="ellipse_blue">38</li>
                                       <li class="ellipse_green special">32</li>
                                    </ul>
                                 </div>
                              </li>
                              <li class="block">
                                 <div class="result-list-info">
                                    <div class="result-lottery-logo"><img src="<?php echo base_url();?>assets/images/logos/bonoloto1.png" title="BonoLoto"></div>
                                    <div class="result-lottery-titledate">
                                       <div class="hadding">
                                          <div class="name">BonoLoto</div>
                                       </div>
                                       <div class="datenum">09.01.2021 </div>
                                    </div>
                                    <div class="result-join-now-link">
                                       <a href="<?php echo base_url();?>/bonoloto-results/" class="item" style="display:none;">Join Now</a>
                                    </div>
                                 </div>
                                 <div class="result">
                                    <ul>
                                       <li class="ellipse_blue">7</li>
                                       <li class="ellipse_blue">11</li>
                                       <li class="ellipse_blue">18</li>
                                       <li class="ellipse_blue">30</li>
                                       <li class="ellipse_blue">31</li>
                                       <li class="ellipse_blue">35</li>
                                       <li class="ellipse_green special">49</li>
                                    </ul>
                                 </div>
                              </li>
                              <li class="block">
                                 <div class="result-list-info">
                                    <div class="result-lottery-logo"><img src="<?php echo base_url();?>assets/images/logos/superenalotto1.png" title="SuperEnalotto"></div>
                                    <div class="result-lottery-titledate">
                                       <div class="hadding">
                                          <div class="name">SuperEnalotto</div>
                                       </div>
                                       <div class="datenum">09.01.2021 </div>
                                    </div>
                                    <div class="result-join-now-link">
                                       <a href="<?php echo base_url();?>/superenalotto-results/" class="item" style="display:none;">Join Now</a>
                                    </div>
                                 </div>
                                 <div class="result">
                                    <ul>
                                       <li class="ellipse_blue">14</li>
                                       <li class="ellipse_blue">16</li>
                                       <li class="ellipse_blue">35</li>
                                       <li class="ellipse_blue">47</li>
                                       <li class="ellipse_blue">58</li>
                                       <li class="ellipse_blue">64</li>
                                       <li class="ellipse_green special">40</li>
                                    </ul>
                                 </div>
                              </li>
                              <li class="block">
                                 <div class="result-list-info">
                                    <div class="result-lottery-logo"><img src="<?php echo base_url();?>assets/images/logos/megamillions1.png" title="MegaMillions"></div>
                                    <div class="result-lottery-titledate">
                                       <div class="hadding">
                                          <div class="name">MegaMillions</div>
                                       </div>
                                       <div class="datenum">08.01.2021 </div>
                                    </div>
                                    <div class="result-join-now-link">
                                       <a href="<?php echo base_url();?>/megamillions-results/" class="item" style="display:none;">Join Now</a>
                                    </div>
                                 </div>
                                 <div class="result">
                                    <ul>
                                       <li class="ellipse_blue">3</li>
                                       <li class="ellipse_blue">6</li>
                                       <li class="ellipse_blue">16</li>
                                       <li class="ellipse_blue">18</li>
                                       <li class="ellipse_blue">58</li>
                                       <li class="ellipse_green">11</li>
                                    </ul>
                                 </div>
                              </li>
                              <li class="block">
                                 <div class="result-list-info">
                                    <div class="result-lottery-logo"><img src="<?php echo base_url();?>assets/images/logos/powerball1.png" title="PowerBall"></div>
                                    <div class="result-lottery-titledate">
                                       <div class="hadding">
                                          <div class="name">PowerBall</div>
                                       </div>
                                       <div class="datenum">08.01.2021 </div>
                                    </div>
                                    <div class="result-join-now-link">
                                       <a href="<?php echo base_url();?>/powerball-results/" class="item" style="display:none;">Join Now</a>
                                    </div>
                                 </div>
                                 <div class="result">
                                    <ul>
                                       <li class="ellipse_blue">14</li>
                                       <li class="ellipse_blue">26</li>
                                       <li class="ellipse_blue">38</li>
                                       <li class="ellipse_blue">45</li>
                                       <li class="ellipse_blue">46</li>
                                       <li class="ellipse_green">13</li>
                                    </ul>
                                 </div>
                              </li>
                              <li class="block">
                                 <div class="result-list-info">
                                    <div class="result-lottery-logo"><img src="<?php echo base_url();?>assets/images/logos/euromillions1.png" title="EuroMillions"></div>
                                    <div class="result-lottery-titledate">
                                       <div class="hadding">
                                          <div class="name">EuroMillions</div>
                                       </div>
                                       <div class="datenum">08.01.2021 </div>
                                    </div>
                                    <div class="result-join-now-link">
                                       <a href="<?php echo base_url();?>/euromillions-results/" class="item" style="display:none;">Join Now</a>
                                    </div>
                                 </div>
                                 <div class="result">
                                    <ul>
                                       <li class="ellipse_blue">18</li>
                                       <li class="ellipse_blue">23</li>
                                       <li class="ellipse_blue">37</li>
                                       <li class="ellipse_blue">41</li>
                                       <li class="ellipse_blue">42</li>
                                       <li class="ellipse_green">4</li>
                                       <li class="ellipse_green">6</li>
                                    </ul>
                                 </div>
                              </li>
                              <li class="block">
                                 <div class="result-list-info">
                                    <div class="result-lottery-logo"><img src="<?php echo base_url();?>assets/images/logos/eurojackpot1.png" title="EuroJackpot"></div>
                                    <div class="result-lottery-titledate">
                                       <div class="hadding">
                                          <div class="name">EuroJackpot</div>
                                       </div>
                                       <div class="datenum">08.01.2021 </div>
                                    </div>
                                    <div class="result-join-now-link">
                                       <a href="<?php echo base_url();?>/eurojackpot-results/" class="item" style="display:none;">Join Now</a>
                                    </div>
                                 </div>
                                 <div class="result">
                                    <ul>
                                       <li class="ellipse_blue">8</li>
                                       <li class="ellipse_blue">22</li>
                                       <li class="ellipse_blue">25</li>
                                       <li class="ellipse_blue">38</li>
                                       <li class="ellipse_blue">50</li>
                                       <li class="ellipse_green">8</li>
                                       <li class="ellipse_green">9</li>
                                    </ul>
                                 </div>
                              </li>
                              <li class="block">
                                 <div class="result-list-info">
                                    <div class="result-lottery-logo"><img src="<?php echo base_url();?>assets/images/logos/ozlotto1.png" title="OzLotto"></div>
                                    <div class="result-lottery-titledate">
                                       <div class="hadding">
                                          <div class="name">OzLotto</div>
                                       </div>
                                       <div class="datenum">05.01.2021 </div>
                                    </div>
                                    <div class="result-join-now-link">
                                       <a href="<?php echo base_url();?>/ozlotto-results/" class="item" style="display:none;">Join Now</a>
                                    </div>
                                 </div>
                                 <div class="result">
                                    <ul>
                                       <li class="ellipse_blue">6</li>
                                       <li class="ellipse_blue">9</li>
                                       <li class="ellipse_blue">11</li>
                                       <li class="ellipse_blue">20</li>
                                       <li class="ellipse_blue">33</li>
                                       <li class="ellipse_blue">42</li>
                                       <li class="ellipse_blue">45</li>
                                       <li class="ellipse_green special">22</li>
                                       <li class="ellipse_green special">31</li>
                                    </ul>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <a class="more-result-link" href="<?php echo base_url();?>lottery-results/">More Results</a>
               </div>
            </div>
         </div>
         <div class="home-new-security-section">
            <div class="security-section-title">
               <h2>Security on lotto world group</h2>
            </div>
            <div class="security-logos-section">
               <div class="security-logo-new notlast">
                  <img src="<?php echo base_url();?>assets/images/new-security-logo1.png" alt="100% Satisfaction Guaranteed" title="100% Satisfaction Guaranteed"><br>
                  <span>100%</span><br>
                  <p>SATISFACTION GUARANTEED</p>
               </div>
               <div class="security-logo-new notlast">
                  <img src="<?php echo base_url();?>assets/images/new-security-logo2.png" alt="100% Satisfaction Guaranteed" title="100% Satisfaction Guaranteed"><br>
                  <span>100%</span><br>
                  <p>SECURE</p>
               </div>
               <div class="security-logo-new">
                  <img src="<?php echo base_url();?>assets/images/new-security-logo3.png" alt="100% Satisfaction Guaranteed" title="100% Satisfaction Guaranteed"><br>
                  <span>24/7</span><br>
                  <p>CUSTOMER SUPPORT</p>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--<div class="full-width">
      <div class="wrap">
      <h3>Buying Lottery Tickets Online Has Never Been Easier!</h3>
      <div class="plus">+</div>
      <div class="full-width-text" style="display: none;">
      <p>Not so long ago, playing the lottery meant going over to your neighborhood grocery’s lotto ticket-dispensing machine to buy tickets. Forget all that. You can now buy lottery tickets online, all from the comfort of your own home or office, and even from your mobile smartphone. As long as you’re online and can surf the Web, you can go to the Orolotto website (www.lottoworldgroup.com), buy a virtual ticket, choose your lotto numbers, and view lottery results, all from the comfort of your own desk or phone. But the best part about getting onto Orolotto online lottery via is you’re no longer stuck to playing locally.</p>
      <p>You can now gain access to other major lotteries from other countries, which now permit online participation. Examples of major lotteries you can access through Orolotto include Spain’s El Gordo de la Primitiva (sometimes called El Gordo for short), Canada’s Lotto 649, and the EU’s classic giant lottery, Euro Millions. Of course, access to the best and the biggest of American lotteries is also available. You can try your luck at Power Ball and Mega Millions. It’s not an online version of your grocery lotto dispenser machine. Orolotto gives you one distinct advantage, too: there are special group subscriptions and rewards (e.g., Tell A Friend) for you and your friends, which will let you participate in more lottery draws—thus, raising your chances of actually winning a prize in any of these online lotteries.</p>
      <p>The site also acts like your lottery monitoring dashboard and odds-detector in one. For any of the lotteries mentioned, you can view the odds of winning the jackpot, the history of lottery results, details on any secondary prizes (plus the odds of winning those), and even information on which numbers are the least or most often drawn. Online payment for your purchased lottery tickets can be done through various means, which include major credit cards, Neteller, GiroPay, and iDeal. Should you win, the process of cashing out your prize can also be done online.</p>
      </div>
      <script type="text/javascript">
      var plusOpened = false;
      jQuery(".plus").click(function (){
      plusOpened = !plusOpened;
      if (plusOpened) {
      jQuery(this).html("-");
      jQuery('.full-width-text').show();
      } else {
      jQuery(this).html("+");
      jQuery('.full-width-text').hide();
      }
      })
      </script>
      </div>
      </div>-->
   <script type="text/javascript">
      jQuery(function ($) {
          jQuery(this).find("#middle_sec")
          .click(function(){
              jQuery(".show-sign-up").click();
          });
      });
   </script>
   <div id="middle_sec" style="cursor:pointer;">
      <div class="bannersignup"></div>
   </div>
   <div id="wrap" class="loyality_div-new">
      <h2>Our exclusive Loyalty Program</h2>
      <div class="loyalty-section-sahdow">
         <div class="half">
            <div class="half-wrap right">
               <div class="icon"><img src="<?php echo base_url();?>assets/images/loyalty-new-2.png"></div>
               <h1>Get Your Personal Manager</h1>
               <div class="textwidget">As a VIP member you are entitled to Personal VIP service! You will be assigned with your own Personal Account Manager that will update you on winnings, results, special jackpot alerts etc.</div>
               <p></p>
            </div>
         </div>
         <div class="half">
            <div class="half-wrap">
               <div class="icon"><img src="<?php echo base_url();?>assets/images/loyalty-new-1.png"></div>
               <h1>Get a discount on every purchase</h1>
               <div class="textwidget">Our VIP members get a permanent discount on EVERY purchase. On every purchase you make you will see the sum of points you receive for that purchase at your "Purchase-Summary - VIP Plan"</div>
               <p></p>
            </div>
         </div>
      </div>
   </div>
   <div id="middle_about" class="wrap news-section-new">
      <div class="news">
         <div style="width:100%;">
            <h1 style="margin-top:40px;">Latest news</h1>
            <div id="box-news" class="clearfix">
               <div class="news-column">
                  <div class="news-column-thumbnail">
                     <img class="news-thumbnail" src="<?php echo base_url();?>assets/images/nothing-stops-powerball.jpg" alt="" title="">
                  </div>
                  <div class="news-details">
                     <div class="news-date">12 Feb 2017</div>
                     <div class="news-title">Nothing stops the US PowerBall</div>
                     <div class="news-excerpt">As no winners announced on saturday night's draw the jackpot has continued to grow and is now above $300k. $310,000,000 to be exact.
                        Excite...
                     </div>
                     <div class="news-readmore-link">
                        <a href="#" >Read More</a>
                     </div>
                  </div>
               </div>
               <!-- <div class="partnews">
                  <div class="col3">
                  <div class="datetxt">
                  <div class="datenum">12</div>
                  <div class="dateletters">Feb</div>
                  </div>
                  <h2>
                  <a href="<?php echo base_url();?>/nothing-stops-us-powerball/">
                  Nothing stops the US PowerBall                                    </a>
                  </h2>
                  <div class="textwidget">
                  As no winners announced on saturday night's draw the jackpot has continued to grow and is now above $300k. $310,000,000 to be exact.
                  Excitement continues to grow, lotter...                                </div>
                  </div>
                  </div> -->
               <div class="news-column">
                  <div class="news-column-thumbnail">
                     <img class="news-thumbnail" src="<?php echo base_url();?>assets/images/powerball-breaking-apart.jpg" alt="" title="">
                  </div>
                  <div class="news-details">
                     <div class="news-date">02 Feb 2017</div>
                     <div class="news-title">The PowerBall lottery is breaking apart again</div>
                     <div class="news-excerpt">As no winners hit were announced in yesterday's draws the jackpot keeps climbing...
                        Already at $229 Million.
                        we are all excited and are ...
                     </div>
                     <div class="news-readmore-link">
                        <a href="#">Read More</a>
                     </div>
                  </div>
               </div>
               <!-- <div class="partnews">
                  <div class="col3">
                  <div class="datetxt">
                  <div class="datenum">02</div>
                  <div class="dateletters">Feb</div>
                  </div>
                  <h2>
                  <a href="<?php echo base_url();?>/powerball-lottery-breaking-apart/">
                  The PowerBall lottery is breaking apart again                                    </a>
                  </h2>
                  <div class="textwidget">
                  As no winners hit were announced in yesterday's draws the jackpot keeps climbing...
                  Already at $229 Million.
                  
                  we are all excited and are looking for the next big winne...                                </div>
                  </div>
                  </div> -->
               <div class="news-column">
                  <div class="news-column-thumbnail">
                     <img class="news-thumbnail" src="<?php echo base_url();?>assets/images/winning-powerball.jpg" alt="" title="">
                  </div>
                  <div class="news-details">
                     <div class="news-date">18 Dec 2016</div>
                     <div class="news-title">The winning Powerball numbers for Saturday</div>
                     <div class="news-excerpt">The winning Powerball numbers for Saturday, Dec. 17, are: 1, 8, 16, 40, 48 and the Powerball of 10.
                        Saturday's cash payout would be $71.2 m...
                     </div>
                     <div class="news-readmore-link">
                        <a href="#">Read More</a>
                     </div>
                  </div>
               </div>
               <!-- <div class="partnews">
                  <div class="col3">
                  <div class="datetxt">
                  <div class="datenum">18</div>
                  <div class="dateletters">Dec</div>
                  </div>
                  <h2>
                  <a href="<?php echo base_url();?>/winning-powerball-numbers-saturday/">
                  The winning Powerball numbers for Saturday                                    </a>
                  </h2>
                  <div class="textwidget">
                  The winning Powerball numbers for Saturday, Dec. 17, are: 1, 8, 16, 40, 48 and the Powerball of 10.
                  Saturday's cash payout would be $71.2 million. Powerball drawings are...                                </div>
                  </div>
                  </div> -->
            </div>
         </div>
      </div>
   </div>
</div>