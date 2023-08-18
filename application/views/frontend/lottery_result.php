<?php $all_lottaryies = all_lottaryies($draws);

   $lotteries_results=$all_lottaryies['previous_lottery'];

   /*if($previous_lottery):
    foreach($previous_lottery as $lotto){
    
    if(!in_array($lotto['type'],$defaultLoto)){
       continue;
    }
    $lotloDate=new DateTime($lotto['date']);

}
endif;*/
   
?>
<div class="wrap">
<div id="middle" class="innerbg" style="margin-top: 0px;">
    <div class="innerpage">
      
        <div class="all-lot-res-title">
            <h1>Latest Lottery games results</h1>
        </div>
        <!--<div class="clear_inner">&nbsp;</div>-->
        <div class="allresult_table">
    <table id="myTable" class="tablesorter tablesorter-result" border="0" cellpadding="0" cellspacing="1">
        <thead>
        <tr>
            <th class="header"><?php _e('Country', 'twentythirteen') ?></th>
            <th class="header"><?php _e('Lottery', 'twentythirteen') ?></th>
            <th class="header"><?php _e('Last draw', 'twentythirteen') ?></th>
            <th class="header"><?php _e('Payout', 'twentythirteen') ?></th>
            <th style="background-image:none;"><?php _e('Winning Numbers', 'twentythirteen') ?></th>
        </tr>
        </thead>
        <tbody class="allresult">
            <?php
                foreach ($lotteries_results as $key => $lotto) {
                   
                    $value = getDefaultLottary(strtolower($lotto['type']));
                    //pr($lotto);
                    if(!$value){
                        continue;
                    }
                    
                    $green2='';
                    $green ="";$blue ='';$response='';
					if(($value->LotteryTypeId == 27) || ($value->LotteryTypeId == 13) || ($value->LotteryTypeId == 24) ) continue; //hide fathersday, navidad, elnino
                    $LotteryNameChanged = strtolower(ChangeLotteryNameForUrl($value->LotteryName));
                    $flag = base_url() . 'assets/images/flag_' . strtolower($value->CountryName) . '.png';
                    $resultlink = base_url() . '/' . strtolower($LotteryNameChanged) . '-results/';
                    $green = $blue = "";
                    if (isset($lotto['winners']) && $lotto['winners'] != "") {
                        
                       foreach($lotto['numbers']['main'] as $number): 
                            $green2.='<li class="result_ellipse_green">'.$number."</li>";
                        endforeach;

                       /* if ($value->BonusNumber > 0) {
                            $temp2 = explode(",",
                                $value->BonusNumber);
                            $green2 = '<li class="result_ellipse_green special">' . implode('</li><li class="result_ellipse_green special">',
                                    $temp2) . "</li>";
                        } else {
                            $green2 = "";
                        }*/

                      



                        /*$temp1 = explode(",",
                            $temp[0]);
                        $blue = '<li class="result_ellipse_blue">' . implode('</li><li class="result_ellipse_blue">',
                                $temp1) . "</li>";*/

                                  $key=getDrawTypeTwo($lotto['type']);
                                       $type2='';
                                       if(!empty($key) && isset($lotto['numbers'][$key])){
                                          if(!is_array($lotto['numbers'][$key])){
                                            
                                            $blue.= '<li class="result_ellipse_blue">'.$lotto['numbers'][$key].'</li>';
                           
                                          }
                                          else 
                                          $blue.= '<li class="result_ellipse_blue">'.implode('</li> <li class="result_ellipse_blue">',$lotto['numbers'][$key])."</li>";
                                       }
                    }

                    if ($green2 != "" || $green != "" || $blue != "") {
                        /*if ($value->RollOver == 0) {
                            $jackpot = 'RollOver';
                        } else {
                            $jackpot = $value->LotteryCurrency . '' . floatval(number_format($value->RollOver,0,"",","));
                        }
                        */
                        $jackpot = 'RollOver';
                        if ($value->LotteryName === "Navidad") {
                            $response .= '';
                        } else {
                            $response .= '<tr>
                                                <td><img src="' . $flag . '" />&nbsp;&nbsp;' . convert_country_name($value->CountryName) . '</td>
                                                <td><a style="color:#0c2e61;" href="' . $resultlink . '">' . $value->LotteryName . '</a></td>
                                                <td>' . date("d/m/Y", changeDate($value->LotteryName, $value->DrawDate)) . '</td>
                                                <td> ' . $jackpot . '</td>
                                                <td>
                                                    <div class="result_number">
                                                        <ul>
                                                            ' . $blue . $green . $green2 . '
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>';
                        }
                    }
                }
                echo $response; ?>
        </tbody>
    </table>
</div>
        <div class="clear_inner">&nbsp;</div>
        <div class="results-page">
           <h1>Real-time results !</h1>
            <p>
            Having chance to participate in a wide range of lotteries available from around the world is very thrilling and could prove very profitable to those who try their luck at the many options out there. LottoWorldGroup provides players with a variety of lotteries from the US, Canada and Europe.</p>
            <p>The favor of playing lotteries online is that players can not only access this wide variety of lotteries normally out of their reach in the first place, but also that participating in these lotteries can be done anywhere, at any time.</p>
            <p>As far as finding out results is concerned, LottoWorldGroup guarantees that you are always kept up to date in real-time. With lotteries being drawn on regular basis, having access to real-time lottery results of the draw you have taken part in allows you to find out immediately whether you have won. Far more convenient than the regular lottery.</p>
            <p>The best thing about our real-time results page is that it also lets you get access to winning numbers from each of the lotteries. This means that you can take a look at what seems to work best for others, and implement it into your strategy.</p>
            <p>When you register at LottoWorldGroup, you can also have real-time alerts sent to you as soon as the lottery results come in, putting you even further ahead of the game.</p>
            <p>Real-Time results also allow you to examine the results of lotteries that you may play in the future which should help you in decision making about which lotteries to add to your portfolio on LottoWorldGroup.<br>
            Roll-Over vs. Pay-out Frequency<br>
            Two things can happen when a lottery is drawn. Either, somebody wins the jackpot, generally by matching all their numbers, sometimes including a supplementary number or no one comes up with the matching numbers so that the jackpot continues unclaimed.</p>
            <p>In this case, a roll-over comes into play. A roll-over occurs when the previously unclaimed jackpot is included in the next draw. This means that the jackpot keeps growing every time a roll-over occurs. Most lotteries have a limit on roll-overs, while others keep the jackpot accumulating until it is won.</p>
            <p>The favor of playing a lottery that rolls over regularly is that their jackpots are bigger than those that have roll-overs limited. Obviously, the frequency of roll-overs indicates the difficulty of getting big money from that particular lottery.</p>
            <p>Therefore, it is vital to also look at the frequency of payouts in those lotteries, just to figure out how often their jackpots are won. Obviously, the probability of winning the jackpot is bigger when a lottery has a greater pay-out frequency, even if the jackpot is relatively smaller.</p>
            <p>If you access past results of the lotteries on LottoWorldGroup results page, we provide you with the crucial data you need to work out the pay-out frequency of your main lotteries. With this information, you are now able to decide whether you want to aim big and go for a lottery where the payout is huge due to regular roll-over, or play it safe and choose a jackpot where the payouts are smaller but more often.</p>
            <h1>Create your lottery portfolio</h1>
            <p>
            With a wide range of lotteries available through LottoWorldGroup, you can optimize your chances of winning by creating a well-organized lottery portfolio. The great aspect of having access to so many good quality lotteries just at the click of a button is that you can build a portfolio of various lotteries that can be played.<br>
            When selecting which lotteries to put into your portfolio, it is essential to consider which lotteries have a low pay-out frequency, but provide immense jackpots, and which lotteries pay out regularly but with smaller jackpots. The reason behind it is to have at least one of each type of lottery in your LottoWorldGroup lottery portfolio. By doing this, you create opportunities for yourself to win big, but also a greater shot of winning more frequently.<br>
            To make up your mind, just have a look at the past results pages of each of the lotteries. Try and see if there is a link between the frequency of roll-overs and the frequency of draws. This will give you a clue on how to pick up the lotteries to your portfolio.<br>
            Another hint is to join a group of those lotteries that only pay out on an infrequent basis. Thus, you will be able to have more tickets in each draw, and in this way you will grow your chances of winning. You may choose how many seats you want to take in the group (maximum of 150 seats per group).<br>
            Moreover, you can always determine when there’s a Raffle event, and join in. On a raffle a winner is a mandatory and there are great prizes for those who come as runner-ups.<br>
            Lastly, make sure that your portfolio is diversified in other ways too. Perhaps pick up a European lottery and then a US or Canadian lottery and mix them up with a French or Spanish local lottery.</p>
            <h1>Easy online access for lottery results</h1>
            <p>
            With LottoWorldGroup, your lottery results online are just a click away, at any time and any place. No need to go out just to check if your ticket has won. As long as you have internet access alongside a computing device, checking lottery results is now as easy as one click of your mouse. LottoWorldGroup brings you a secured online access to view your lotto results of famous lotteries like Spain’s major lottery El Gordo De la Primitiva (also known as “El Gordo”), the European Union’s transnational lottery, the famous EuroMillions, and Canada’s very own Lotto 649. Also you can get access to the National Lottery Results of America’s top lotteries like Power Ball and Mega Millions. LottoWorldGroup brings you the most intuitive, user-friendly, and up-to-date game results. Another inventive feature the LottoWorldGroup offers is the free tools to alert you of the results. Be sure that playing lotto and checking the results has never been this simple, fast and comfortable.</p>
        </div>
    </div>
</div></div>