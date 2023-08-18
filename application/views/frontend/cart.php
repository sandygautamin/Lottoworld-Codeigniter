<div class="banner_txt">
        	<div class="hadding">
        		<h1>Your order</h1>
        	</div>
        </div>
<div class="wrap cart-page">
   <div class="mainnewpay2" data-ng-init="">
      <?php /*?>
      <div class="alert alert-warning ng-hide" role="alert" ng-show="ngCart.getTotalItems() === 0">
         <div class="hideEmptyCart ng-hide" ng-hide="hideEmptyCart">
            <h1 class="emptycartbig">Shopping cart</h1>
            <h2 class="emptycartbig emptycartbig2">is empty</h2>
            <div class="emptycartimg"></div>
            <br><br>
            <h2 class="noitmessmall">You have no items in your cart</h2>
            <br><br>
            <button class="addticket" ng-click="redirectToPlayPageTopJackpot()">Please add a ticket</button>
            <br><br><br><br>
         </div>
         <div class="cart-page">
            <div  class="cart-static">
               <span class="part1">Lottery Name</span>
               <span class="part2">Lines</span>
               <span class="part3">Draws</span>
               <span class="part4">PRICE</span>
            </div>
            <div  class="payment2line">
               <div class="pay2linegeneral pay2linegeneralupper">
                  
                  <ng-include class="animate-switch " src="'/wp-content/themes/lotto_theme/fragments/cart-partials/products/freeproduct.html'">
                     <div class="product-top pay2linegeneral pay2linegeneralupper pay2linegeneralupperpersonal pay2linegeneralupperanytype pay2linegeneralupperfree ">
                        <div class="loto lotoforMegaMillions">
                           <div class="lottinner sliderlogoMegaMillions"></div>
                        </div>
                        <div class="ticket ng-binding">MegaMillions</div>
                        <div class="linesdraws lines">
                           <div class="wordlines ng-binding">Share</div>
                           <input type="text" value="1" ng-disabled="true" disabled="disabled">
                          
                        </div>
                        <div class="linesdraws draws">
                           <div class="wordlines ng-binding">Draw</div>
                           <input type="text" value="1" ng-disabled="true" disabled="disabled">
                         
                        </div>
                        <div class="view view247premium">
                           <div class="viewmoreless viewmore">
                           </div>
                        </div>
                        <div class="discount hide-discount">
                        </div>
                        <div class="total total247premium free-price-width ng-binding">
                           Free
                        </div>
                     </div>
                     
                  </ng-include>
               </div>
            </div>
         </div>
      </div>
      <?php */
      //pr($_POST);die;;
      ?>
      <div ng-hide="ngCart.getTotalItems() === 0">
         <div class="cart-page">
            <div class="cart-static">
               <span class="part1">Product</span>
               <span class="part2">Lines</span>
               <span class="part3">Draws</span>
               <span class="part4">Discount</span>
               <span class="part5">PRICE</span>
            </div>
            <?php //pr($this->cart->contents()); ;
            $currency='$';
            $total=0;?>
            <?php if($this->cart->contents()):
                foreach($this->cart->contents() as $item):
                  $currency=$item['currency'];
                ?>
            <div class="product-line " >
               <div class="pay2linegeneral pay2linegeneralupper" ng-switch="" on="item.getProductType()">
                  
                  <div ng-switch-when="1" class="">
                   
                        <div class="product-top pay2linegeneral pay2linegeneralupper pay2linegeneralupperpersonal pay2linegeneralupperanytype " >
                           <div class="loto lotofor<?php echo $item['name']?>">
                              <div class="lottinner sliderlogo<?php echo $item['name']?>"></div>
                           </div>
                           <div class="ticket">
                              <div class="lottery-name-section">
                                 <div class="lottery-name ng-binding"><?php echo $item['name']?></div>
                                 <div class="remove-button fa fa-trash-alt" data-rowid="<?php echo $item['rowid']?>"></div>
                              </div>
                              <div class="subscription" ng-hide="item.getProductIdSpecial() === 999">
                                 <input type="checkbox" ng-model="subscription" ng-click="subscriptionChanged(item.getId())" class="ng-pristine ng-untouched ng-valid">
                                 <div class="checkboxsentence ng-binding">
                                    Subscription - Never miss a draw
                                    <span class="tooltip">
                                       <!--Subscription tooltip -->
                                       <i class="fa fa-info-circle ticket-info-icon"></i>
                                       <span>
                                          SUBSCRIPTION 
                                          <hr>
                                          <br>Earn more VIP points, more discounts and never miss a draw! Choose your billing period of 1 week, 2 weeks or 4 weeks.
                                       </span>
                                    </span>
                                 </div>
                              </div>
                           </div>
                           <div class="linesdraws lines">
                              <div class="wordlines">
                                 <ng-pluralize >Lines</ng-pluralize>
                              </div>
                              <input type="text" ng-value="item.getNumberOfLinesOrShares()" ng-disabled="true" disabled="disabled" value="<?php echo $item['qty']?>">
                              <div class="arrows" ng-hide="item.getProductIdSpecial() === 999">
                                 <div class="vmorelines">
                                    <div class="morelinesinner" ng-click="progress || addLine(item)" ng-disabled="progress">
                                    </div>
                                 </div>
                                 <div class="vlesslines">
                                    <div class="lesslinesinner" ng-click="progress || removeLine(item)" ng-disabled="progress">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="linesdraws draws">
                              <div class="wordlines">
                                  Draw
                              </div>
                              <input type="text" disabled="disabled" value="<?php echo isset($item['draws'])?$item['draws']:'0'?>">
                              <div class="arrows" ng-hide="item.getProductIdSpecial() === 999">
                                 <div class="vmorelines">
                                    <div class="morelinesinner" ng-click="progress || addDraw(item)" ng-disabled="progress">
                                    </div>
                                 </div>
                                 <div class="vlesslines">
                                    <div class="lesslinesinner" ng-click="progress || removeDraw(item)" ng-disabled="progress">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="discount <?php echo isset($item['discount']) && $item['discount']<0?'hide-discount':''?>" >
                              - <?php echo SITE_CURRENCY;?><?php echo number_format($item['discount'],2);?> (<?php echo isset($item['discount_percent'])?$item['discount_percent']:''?>%)
                           </div>
                           <div class="total ng-binding">
                              <?php echo $item['currency']?><?php echo numberformat($item['ssubtotal']); ?>
                              <?php $total=$total+$item['ssubtotal']?>
                           </div>
                           <div class="more-lotto-details fa  fa-angle-down" >
                           </div>
                        </div>
                        <div class="hiddenlinenumbers ">
                           <h3 class="ng-binding">
                              Your lines
                           </h3>
						   <?php 
						   $mainHtml='';
						   if ($this->cart->has_options($item['rowid']) == TRUE): 
								$datacart=$this->cart->product_options($item['rowid']);
								
								$main='';
                        $other='';
								foreach ($this->cart->product_options($item['rowid']) as $option_name => $option_value): 
								if($option_name=='row'){
									$lines_exp=explode("|",rtrim($option_value,'|'));
									foreach($lines_exp as $line){
										$numbers=explode("#",$line);
                              if(isset($numbers[0])){
										   $main = "<div class='number numberblue'>".str_replace(',',"</div><div class='number numberblue'>",$numbers[0])."</div>";
                              }
										if(isset($numbers[1])){
										$other="<div class='number numberorange'>".str_replace(',',"</div><div class='number numberorange'>",$numbers[1])."</div>";
                              }
										$mainHtml.="<div class='alloneline onelineofEuroJackpot'><div class='lineofnumbers'>".$main.$other."</div></div>";
									}
								}
								endforeach;?>
							<?php endif; ?>
							<div class="alllines alllinesofEuroJackpot">
								<?php echo $mainHtml;?>
							</div>
                        </div>
                     
                  </div>
               </div>
            </div>
            <?php endforeach;endif;?>
            <div class="product-line " ng-if="showFreeTicket">
               <!-- ngInclude: undefined -->
               <ng-include class="animate-switch " src="'/wp-content/themes/lotto_theme/fragments/cart-partials/products/freeproduct.html'">
                  <div class="product-top pay2linegeneral pay2linegeneralupper pay2linegeneralupperpersonal pay2linegeneralupperanytype pay2linegeneralupperfree ">
                     <div class="loto lotoforMegaMillions">
                        <div class="lottinner sliderlogoMegaMillions"></div>
                     </div>
                     <div class="ticket ng-binding">MegaMillions</div>
                     <div class="linesdraws lines">
                        <div class="wordlines ng-binding">Share</div>
                        <input type="text" value="1" ng-disabled="true" disabled="disabled">
                       
                     </div>
                     <div class="linesdraws draws">
                        <div class="wordlines ng-binding">Draw</div>
                        <input type="text" value="1" ng-disabled="true" disabled="disabled">
                      
                     </div>
                     <div class="view view247premium">
                        <div class="viewmoreless viewmore">
                           <!--<div class="viewmorearrow"></div>-->
                        </div>
                     </div>
                     <div class="discount hide-discount">
                     </div>
                     <div class="total total247premium free-price-width ng-binding">
                        Free
                     </div>
                  </div>
                  
               </ng-include>
            </div>
            <!-- end ngIf: showFreeTicket -->
         </div>
         <!--Control 3 -Checkout -->
         <div class="checkoutmain">
            <div class="checkoutmaininner">
               <div class="checkoutmaintitle">
                  <p class="ng-binding">
                     Checkout
                  </p>
               </div>
               <div class="chceckboxes">
                  <div class="checkboxline">
                     <div id="checkboxcart" class="checkboxsign" ng-mouseover="showtooltipcart('checkboxcart')" ng-mouseout="hidetooltipcart('checkboxcart')">
                        <div id="checkboxcartinner" class="checkboxsigntooltip ng-hide" ng-show="tooltipcart=='checkboxcart'">
                           <p class="ng-binding">Enjoy a personal and fast processing and support</p>
                        </div>
                     </div>
                  </div>
                 
                  <div class="checkboxpromo ng-hide" ng-show="promoactive==true">
                     <input id="TextBoxPromoCode" type="text" placeholder="___-___- ___" class="ng-pristine ng-untouched ng-valid">
                     <div class="validorinvalid">
                        <div class="clearthepromo" ng-show="redeemCodeWrong"></div>
                        <div class="validpromocode ng-hide" ng-show="redeemCodeOk"></div>
                     </div>
                     <button class="deposit ng-binding" >Redeem</button>
                     <span class="codesuccess"> 
                     <span id="LabelPromoMessage">Code succeeded</span>
                     </span>
                     <span class="invalid">
                     <span id="LabelPromoError">Invalid Code</span>
                     </span>
                  </div>
               </div>
               <div class="prices">
                  <div class="totalorder ng-binding">Total order</div>
                  <div class="numberprice">                        
                     <span id="finalprice" class="ng-binding"><?php echo $currency?><?php echo numberformat($total);?></span>                    
                  </div>
                  <input name="order_total" id="order_total" type="hidden" value="<?php echo $total?>">
               </div>
               <div class="promodiscount ng-hide" ng-show="ngCart.getRedeemAmount() > 0">
                  <span class="promodiscountwords">Promo code discount</span>
                  <span class="promodiscountnum ng-binding">- </span>
               </div>
            </div>
            <div class="clear"></div>
         </div>
         <div class="clear"></div>
      </div>
   </div>
</div>
<div class="load-iframe" style=""></div>
<?php $this->load->view("frontend/cart/checkout-singup",[])?>

<!-- After logged in -->
<?php $this->load->view("frontend/cart/account",['total'=>$total])?>


</div>
</div>
</div>
</div>

<!-- Modal -->

