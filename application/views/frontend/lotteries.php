
<?php

$all_lottaryies = all_lottaryies($draws);
$upcoming_lottery=$all_lottaryies['upcoming_lottary'];

?>
<div class="wrap">
<div id="middle" class="innerbg" style="margin-top: 0px;">
    <div class="wrap">
        <div class="innerpage">
            <!--<h1>Next lotto draws jackpot</h1>-->
            <div class="all-lot-title">
                <h1>Coming Lottery games at LWG</h1>
            </div>
            <!--<div class="clear_inner">&nbsp;</div>-->
            <div class="allresult_table">
                <table id="myTable" class="tablesorter lotteries-table" border="0" cellpadding="0" cellspacing="1">
                    <thead>
                        <tr>
                            <th class="header">Country</th>
                            <th class="header">Lottery</th>
                            <th class="header">Next draw</th>
                            <th class="header">Jackpot</th>
                        </tr>
                    </thead>
                    <tbody class="allbrands">
                        <tr>
                            <td><img src="<?php echo base_url() . 'assets/images/flag_spain.png'; ?>"/>&nbsp;Spain</td>
                            <td>Navidad</td>
                            <td>22/12/2018</td>
                            <td>
                                € 2,240,000,000&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo base_url() . '/navidad/'; ?>" class="dd_play_button" style="float:right;"> <?php _e('Play Now', 'twentythirteen') ?></a>
                            </td>
                        </tr>
                        <?php 
                        
                        foreach($upcoming_lottery as $lottery):
                           
                            $defaultLoto = getDefaultLottary(strtolower($lottery['type']));
                            if(!$defaultLoto){
                               continue;
                            }
                            
                            $lotterynameLink = strtolower(ChangeLotteryNameForUrl($lottery['type']));
                            $linkplay        = base_url() .$lotterynameLink . '-lottery/';
                            if ($lottery['jackpot']['total'] < 0) {
                                $jackpot = 'PENDING';
                            } else {
                                $jackpot = getSymbolByCode($lottery['currency']) . ' ' . number_format($lottery['jackpot']['total'], 0, "", ",");
                            }
                         
                         ?>
                        <tr>
                            <td><img src="<?php base_url();?>assets/images/flag_<?php echo strtolower($defaultLoto->CountryName); ?>.png">&nbsp;<?php echo $defaultLoto->CountryName?></td>
                            <td><?php echo $defaultLoto->LotteryName; ?></td>
                            <td>
                                <?php  //$drawDate=new DateTime($lottery['DrawDate']);
                                $date=date_create($lottery['date']);
                                echo date_format($date,"d/m/Y");
                              //  echo  $lottery['date'];//$drawDate->format("d/m/Y");
                                ?>
                        
                            </td>
                            <td>
                                <?php echo  $jackpot?>&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo  $linkplay ?>" class="dd_play_button" style="float:right;"> Play Now</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
                </div>
            <div class="clear_inner">&nbsp;</div>
            <div class="resultschecker">
                                    <p>Choose your preferred lottery from the list above, click ‘Play’ and select Your Lucky Numbers. LottoWorldGroup offers you the most greatest lotteries worldwide, such as the Powerball and the Mega-Millions from the USA and Europe’s Major lotteries such as Euro-Millions , Eurojackpot.</p>
<p></p>
<h1>Buy secure lotto tickets</h1>
<p>
At LottoWorldGroup, we use the highest security standards to guarantee that your payment details are safe. You buy lottery ticket digitally only via secured servers – EV SSL issued by GeoTrust.</p>
<h1>Electronic ticket scan &amp; winning transfer service:</h1>
<p>
It is a part of our service that every ticket you buy is scanned and uploaded to your account up to 30 minutes before each draw. Right after the draw, we announce the results and automatically calculate your profits in consonance with the numbers you matched. After that, all your profits are transferred to your account and are displayed as ‘Real Money’ on your Account’s balance. You can withdraw your profits and your money will be transferred to your bank account at any given time.</p>
<h1>Worldwide lottery collection:</h1>
<p>
At LottoWorldGroup, we have gathered the greatest and most profitable lottery games from in the world, so you can play to win the biggest lotto jackpots in the world anytime you want. As far as winning the lottery is concerned, big jackpots is not all we have for you. There is a great variety of games in our lottery collection. You can find lotteries such as the UK Lotto, BonoLotto and Lotto649 which may not be the lotteries with the biggest jackpots, but importantly, have the highest winning chances. Did you know that the 6/49 lotteries have much better winning odds than the big jackpot lotteries? Yes, the winnings may be smaller but what really matters is that they are much more frequent. By having a couple of big jackpot lotteries such as the Mega Millions, Powerball or EuroMillions in addition to a couple of 6/49 lotteries, you create yourself a lottery portfolio of the true winner. Just combine a few big jackpot lotteries to have a chance to win big and become a multi-millionaire with a few best odds lotteries and to get some nice winnings until you hit that big jackpot of yours! When choosing our offer and playing smart, you will never lose the lottery. No special expertise is required to win a lottery – just play it smart, aim big and always combine lotteries that will get those winnings coming to keep you going.</p>
<h1>Boost your chances with a group acquisition:</h1>
<p>
We now have the offer that enables you to join lottery groups started by our own VIP members. Each member started a group for their own lottery with up to 150 vacant seats for each draw. As long as there are vacant seats, anyone can join anytime and play with 50 lines per draw. You can instantly boost your winning chances to any lotto game you choose. The group owners selected themselves the lucky numbers for each lottery, taking into consideration that some lotteries have extra bonus numbers. For those special lotteries, all potential combinations of the extra bonus numbers are picked so there is a guaranteed win on each draw.<br>
Purchasing lottery tickets online</p>
<p>Ever thought of getting lottery tickets in a more convenient way? Did you know that there are no limits for you to have a substantial chance of winning the lottery when using internet? Anyone around the globe can play the lottery online at any time with no trouble by using any online device like a desktop, laptop, phone, or smartphone. Purchasing lottery tickets online gives you a more comfortable, accurate, and secured way to win your lucky lottery numbers. This online lottery service guarantees that. There are a few simple steps to help you enter the world of online lotteries. Beginners have to register their online account before they can submit their ticket and join the lottery. A team of professional managers will supervise the game. Winners are immediately notified through email alerts, free SMS, and by the customer support team when the lotto results are announced online. Fair and simple guidance is provided on how to claim the prizes.</p>
                                </div>
        </div>
    </div>
    </div>
</div><!-- ./.wrap -->
