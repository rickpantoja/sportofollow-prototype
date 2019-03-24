<?php
    include_once 'Stfconn.php';
    
    $stfConn = Stfconn();
    $insup = 0;
    
    if (isset($_POST['submit-edit'])) {
        $insup++;
        $editid = filter_input(INPUT_POST, 'editid');   
    
        $sqledit = "SELECT * FROM STF_FT_EVENT WHERE ID_EVENTS = ".$editid;
        $resultedit = mysqli_query($stfConn, $sqledit);
        $rowedit = mysqli_fetch_assoc($resultedit);
        
        $sqlt = "TRUNCATE TABLE STF_FT_EVENT_TMP";                
        mysqli_query($stfConn, $sqlt);
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/normalize.css">
        <link rel="stylesheet" href="./css/insertformstyle.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
        <title>sportofollow</title> 
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>        
        <script>
            function disableintorg(val) {
                var valdis = val; 
                if(valdis=="Multi-sport") {
                    document.getElementById("sportorg").disabled = false;
                    document.getElementById("linkorg").disabled = false;
                }else{                    
                    document.getElementById("sportorg").disabled = true;
                    document.getElementById("linkorg").disabled = true;
                }
            }
            function disableintticket(valt) {
                var valdist = valt; 
                if(valdist=="Free") {
                    document.getElementById("linkticket").disabled = true;
                }else if(valdist=="Close"){                    
                    document.getElementById("linkticket").disabled = true;
                }else{
                    document.getElementById("linkticket").disabled = false;
                }
            }
        </script>
    </head>
    <body>
        
        <header class="stfheaderinsert">
            <div class="stfheaderinsertrow">
                <div class="stfheaderinsertcell stflogoinsert">
                    <a href="http://www.sportofollow.com"><img src="./images/stf_logo2.png"></a>
                </div>
                <div class="stfheaderinsertcell hdmenu">
                    <a href="./Stfeditdeleteform.php"><div class="hdmenubt">Edit/Delete</div></a>
                </div>
                <div class="stfheaderinsertcell hdmenu">
                    <a href="./Stfinsertform.php"><div class="hdmenubt menusel">Individual Insert</div></a>
                </div>
                <div class="stfheaderinsertcell hdmenu">
                    <a href="./Stfinsertmassform.php"><div class="hdmenubt">Mass Insert</div></a>
                </div>
            </div>
        </header>
        
        <form class="stfforminsert" action="" method="post">    
            <div class="stfinserttab">
                <div class="stfinsertrow">
                    <div class="stfinserttab">
                        <div class="stfinsertrow">
                            <div class="stfinsertcell tag"></div> 
                            <div class="stfinsertcell coldup">
                                <label for="eventname">Event Name:</label>
                                <input class="formtext" type="text" name="eventname" value="<?php
                                    if (isset($_POST['submit-edit'])) { echo $rowedit['NAME_EVENT']; } ?>">
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="initialdate">Initial Date:</label>
                                <input class="formdate" type="date" id="initialdate" name="initialdate" value="<?php
                                    if (isset($_POST['submit-edit'])) { echo $rowedit['DT_BEGIN']; } ?>">
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="finishdate">Finish Date:</label>
                                <input class="formdate" type="date" id="finishdate" name="finishdate" value="<?php
                                    if (isset($_POST['submit-edit'])) { echo $rowedit['DT_END']; } ?>">
                            </div>
                            <div class="stfinsertcell tag"></div>
                        </div>  
                    </div>  
                </div>  
                <div class="stfinsertrow">
                    <div class="stfinserttab">
                        <div class="stfinsertrow">
                            <div class="stfinsertcell tag"></div> 
                            <div class="stfinsertcell coldup">
                                <label for="champname">Championship Name:</label>
                                <input class="formtext" type="text" id="lname" name="champname" value="<?php
                                    if (isset($_POST['submit-edit'])) { echo $rowedit['NAME_CHAMPIONSHIP']; } ?>">
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="hcountry">Host Country:</label>        
                                <select class="formselect" name="hcountry"/>
                                    <?php
                                    $querycountry ="SELECT * FROM STF_COUNTRY ORDER BY NAME";
                                    $resultscountry = mysqli_query($stfConn, $querycountry);
                                    if (isset($_POST['submit-edit'])) {                                        
                                        foreach($resultscountry as $country) { 
                                            if ($rowedit['HOST_COUNTRY'] == $country["NAME"]) { ?>                                            
                                                <option selected value="<?php echo $country["NAME"]; ?>"><?php echo $country["NAME"]; ?></option>
                                        <?php } else { ?>
                                                <option value="<?php echo $country["NAME"]; ?>"><?php echo $country["NAME"]; ?></option>
                                        <?php } } 
                                    } else {?>                                
                                        <option hidden selected></option>
                                        <?php 
                                        foreach($resultscountry as $country) { ?>
                                            <option value="<?php echo $country["NAME"]; ?>"><?php echo $country["NAME"]; ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="hcity">Host City:</label>
                                <input class="formtext" type="text" name="hcity" value="<?php
                                    if (isset($_POST['submit-edit'])) { echo $rowedit['HOST_CITY']; } ?>">
                            </div>
                            <div class="stfinsertcell tag"></div>
                        </div>  
                    </div>  
                </div> 
                <div class="stfinsertrow">
                    <div class="stfinserttab">
                        <div class="stfinsertrow">
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp"> 
                                <label for="coverage">Coverage:</label>
                                <input class="formtext" type="text" name="coverage" value="<?php
                                    if (isset($_POST['submit-edit'])) { echo $rowedit['EVENT_COVERAGE']; } ?>">
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="sport">Sport:</label>
                                <select onchange="disableintorg(this.value)" name="sport">
                                    <?php
                                    $querysport ="SELECT * FROM STF_SPORT GROUP BY NAME ORDER BY NAME";
                                    $resultssport = mysqli_query($stfConn, $querysport);
                                    if (isset($_POST['submit-edit'])) { ?>
                                        <option value="Multi-sport">Multi-sport</option>
                                        <?php
                                        foreach($resultssport as $sport) { 
                                            if ($rowedit['SPORT_NAME'] == $sport["NAME"]) { ?>                                            
                                                <option selected value="<?php echo $sport["NAME"]; ?>"><?php echo $sport["NAME"]; ?></option>
                                                
                                        <?php } else { ?>
                                                <option value="<?php echo $sport["NAME"]; ?>"><?php echo $sport["NAME"]; ?></option>
                                        <?php } } 
                                    } else {?>                                
                                        <option hidden selected></option>
                                        <option value="Multi-sport">Multi-sport</option>
                                        <?php 
                                        foreach($resultssport as $sport) { ?>
                                            <option value="<?php echo $sport["NAME"]; ?>"><?php echo $sport["NAME"]; ?></option>
                                    <?php } } ?>
                                </select>
                            </div>                            
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="sportorg">Sport Organization:</label>
                                                                    
                                    <?php
                                    $querysporg ="SELECT * FROM STF_SPORT_ORGANIZATION WHERE TYPE = 'SO' GROUP BY ACRONYM";
                                    $resultssporg = mysqli_query($stfConn, $querysporg);
                                    if (isset($_POST['submit-edit'])) {
                                        if ($rowedit['SPORT_NAME'] == 'Multi-sports'){ ?>
                                            <select id="sportorg" name="sportorg">
                                            <?php
                                            foreach($resultssporg as $sportorg) { 
                                                if ($rowedit['SPORT_ORG'] == $sportorg["ACRONYM"]) { ?>                                            
                                                    <option selected value="<?php echo $sportorg["ACRONYM"]; ?>"><?php echo $sportorg["ACRONYM"]; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $sportorg["ACRONYM"]; ?>"><?php echo $sportorg["ACRONYM"]; ?></option>
                                                <?php } }
                                        } else { ?>
                                            <select id="sportorg" name="sportorg" disabled>
                                            <option hidden selected></option>
                                        <?php }
                                    } else { ?>
                                        <select id="sportorg" name="sportorg" disabled>
                                        <option hidden selected></option>
                                        <?php 
                                        foreach($resultssporg as $sportorg) { ?>
                                            <option value="<?php echo $sportorg["ACRONYM"]; ?>"><?php echo $sportorg["ACRONYM"]; ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp"> 
                                <label for="linkorg">Link Organizer:</label>
                                <input class="formtext" type="text" name="linkorg" id="linkorg" value="<?php
                                    if (isset($_POST['submit-edit'])) { echo $rowedit['LINK_EVENTORG']; } ?>">
                            </div>
                            <div class="stfinsertcell tag"></div>
                        </div>  
                    </div>  
                </div>
                <div class="stfinsertrow">
                    <div class="stfinserttab">
                        <div class="stfinsertrow">
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp endblock"> 
                                <label for="eventtype">Event Type:</label>
                                <div>
                                    <label class="radiocontainer inline">
                                        <input type="radio" checked="checked" name="eventtype" value="Competition">
                                        <span>Competition</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="eventtype" value="Conference" <?php
                                            if (isset($_POST['submit-edit'])) { if ($rowedit['LINK_EVENTORG'] == 'Conference') { ?>
                                                    checked="checked" <?php } } ?> ">
                                        <span>Conference</span>
                                    </label>
                                </div>
                            </div>
                            <div class="stfinsertcell tag endblock"></div>
                            <div class="stfinsertcell colsimp endblock">
                                <label for="season">Season Sport Type:</label>
                                <div>
                                    <label class="radiocontainer inline">
                                        <input type="radio" checked="checked" name="season" value="Summer">
                                        <span>Summer</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="season" value="Winter" <?php
                                            if (isset($_POST['submit-edit'])) { if ($rowedit['SEASON_SPORT_TYPE'] == 'Winter') { ?>
                                                    checked="checked" <?php } } ?> ">
                                        <span>Winter</span>
                                    </label>
                                </div>
                            </div>
                            <div class="stfinsertcell tag endblock"></div>
                            <div class="stfinsertcell colsimp endblock">
                                <label for="olyply">Olympic/Paralympic:</label>
                                <div>
                                    <label class="radiocontainer inline">
                                        <input type="radio" checked="checked" name="olyply" value="Olympic">
                                        <span>Olympic</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="olyply" value="Paralympic" <?php
                                            if (isset($_POST['submit-edit'])) { if ($rowedit['SPORT_OLY_PLY_OTH'] == 'Paralympic') { ?>
                                                    checked="checked" <?php } } ?> ">
                                        <span>Paralympic</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="olyply" value="Other" <?php
                                            if (isset($_POST['submit-edit'])) { if ($rowedit['SPORT_OLY_PLY_OTH'] == 'Other') { ?>
                                                    checked="checked" <?php } } ?> ">
                                        <span>Other</span>
                                    </label>
                                </div>
                            </div>
                            <div class="stfinsertcell tag endblock"></div>
                            <div class="stfinsertcell colsimp endblock">
                                <label for="genre">Competition Genre:</label>
                                <div>
                                    <label class="radiocontainer inline">
                                        <input type="radio" checked="checked" name="genre" value="Men/Women">
                                        <span>Men/Women</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="genre" value="Men" <?php
                                            if (isset($_POST['submit-edit'])) { if ($rowedit['EVENT_GENRE'] == 'Men') { ?>
                                                    checked="checked" <?php } } ?> ">
                                        <span>Men</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="genre" value="Women" <?php
                                            if (isset($_POST['submit-edit'])) { if ($rowedit['EVENT_GENRE'] == 'Women') { ?>
                                                    checked="checked" <?php } } ?> ">
                                        <span>Women</span>
                                    </label>
                                </div>
                            </div>
                            <div class="stfinsertcell tag"></div>
                        </div>  
                    </div>  
                </div>
                <div class="stfinsertrow">
                    <div class="stfinserttab">
                        <div class="stfinsertrow">
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="ticket">Ticket:</label>
                                <div>
                                    <label class="radiocontainer inlinetrue">
                                        <input onchange="disableintticket(this.value)" type="radio" checked="checked" name="ticket" value="Free">
                                        <span>Free</span>
                                    </label>
                                    <label class="radiocontainer inlinetrue firstno">
                                        <input onchange="disableintticket(this.value)" type="radio" name="ticket" value="Buy" <?php
                                            if (isset($_POST['submit-edit'])) { if ($rowedit['TICKET'] == 'Buy') { ?>
                                                    checked="checked" <?php } } ?> ">
                                        <span>Buy</span>
                                    </label>                                    
                                    <label class="radiocontainer inlinetrue firstno">
                                        <input onchange="disableintticket(this.value)" type="radio" name="ticket" value="Closed" <?php
                                            if (isset($_POST['submit-edit'])) { if ($rowedit['TICKET'] == 'Closed') { ?>
                                                    checked="checked" <?php } } ?> ">
                                        <span>Close</span>
                                    </label>
                                    <label class="radiocontainer inlinetrue firstno">
                                        <input onchange="disableintticket(this.value)" type="radio" name="ticket" value="" <?php
                                            if (isset($_POST['submit-edit'])) { if ($rowedit['TICKET'] == '') { ?>
                                                    checked="checked" <?php } } ?> ">
                                        <span>NotDef</span>
                                    </label>
                                </div>
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="linkticket">Link Ticket:</label>
                                <input class="formtext" type="text" name="linkticket" id="linkticket" <?php
                                    if (isset($_POST['submit-edit'])) { 
                                        if ($rowedit['TICKET'] == 'Buy') { ?>
                                            value="<?php echo $rowedit['LINK_TICKET'];?>" <?php } else { ?>
                                            disabled
                                        <?php }
                                    } ?> >
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="linkstrsoif">Link Live Stream SO/IF:</label>
                                <input class="formtext" type="text" name="linkstrsoif" value="<?php
                                    if (isset($_POST['submit-edit'])) { echo $rowedit['LINK_OS_STREAM']; } ?>">
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp"> 
                                <label for="linkstrpp">Link Live Stream PP:</label>
                                <input class="formtext" type="text" name="linkstrpp" value="<?php
                                    if (isset($_POST['submit-edit'])) { echo $rowedit['LINK_PP_STREAM']; } ?>">
                            </div>
                            <div class="stfinsertcell tag"></div>
                        </div>  
                    </div>  
                </div>
                <div class="stfinsertrow">
                    <div class="stfinserttab">
                        <div class="stfinsertrow">                            
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp endblock">
                                <label for="linkstrfb">Link Live Stream Facebook:</label>
                                <input class="formtext" type="text" name="linkstrfb" value="<?php
                                    if (isset($_POST['submit-edit'])) { echo $rowedit['LINK_FB_STREAM']; } ?>">
                            </div>
                            <div class="stfinsertcell tag endblock"></div>
                            <div class="stfinsertcell colsimp endblock">
                                <label for="linkstryt">Link Live Stream YouTube:</label>
                                <input class="formtext" type="text" name="linkstryt" value="<?php
                                    if (isset($_POST['submit-edit'])) { echo $rowedit['LINK_YT_STREAM']; } ?>">
                            </div>
                            <div class="stfinsertcell tag endblock"></div>
                            <div class="stfinsertcell colsimp endblock">
                                <label for="linkstrtw">Link Live Stream Twitter:</label>
                                <input class="formtext" type="text" name="linkstrtw" value="<?php
                                    if (isset($_POST['submit-edit'])) { echo $rowedit['LINK_TW_STREAM']; } ?>">
                            </div>
                            <div class="stfinsertcell tag endblock"></div>
                            <div class="stfinsertcell colsimp endblock"></div>
                            <div class="stfinsertcell tag"></div>
                        </div>  
                    </div>  
                </div>
                <div class="stfinsertrow">
                    <div class="stfinserttab">
                        <div class="stfinsertrow">
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <div class="icolins">
                                    <input type="submit" name="submit-insert" value="Display Data">
                                </div>
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp"></div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell coldup"></div>
                            <div class="stfinsertcell tag"></div>
                        </div>  
                    </div>  
                </div>  
            </div>
        </form>
        
        <?php           
            $forminsertar = array();
            if (isset($_POST['submit-insert'])) {                    
                $forminsertar[0] = '"'.filter_input(INPUT_POST, 'initialdate').'",';
                $forminsertar[1] = '"'.filter_input(INPUT_POST, 'finishdate').'",';
                $forminsertar[2] = '"'.filter_input(INPUT_POST, 'eventtype').'",';
                $forminsertar[3] = '"'.filter_input(INPUT_POST, 'coverage').'",';
                $forminsertar[4] = '"'.filter_input(INPUT_POST, 'genre').'",';
                $forminsertar[5] = '"'.filter_input(INPUT_POST, 'season').'",';
                $forminsertseason = filter_input(INPUT_POST, 'season');
                $forminsertar[6] = '"'.filter_input(INPUT_POST, 'olyply').'",';
                $forminsertolyply = filter_input(INPUT_POST, 'olyply');
                $forminsertar[7] = '"'.filter_input(INPUT_POST, 'sport').'",';
                $forminsertspo = filter_input(INPUT_POST, 'sport');
                if ($forminsertspo != "Multi-sport") {
                    $sqlif = "SELECT IF_ACRONYM FROM STF_SPORT WHERE NAME = '".$forminsertspo."' AND OLYPLY = '".$forminsertolyply."' AND SEASON = '".$forminsertseason."'";
                    $resultif = mysqli_query($stfConn, $sqlif);
                    $rowfif = mysqli_fetch_assoc($resultif);                    
                    $forminsertar[8] = '"'.$rowfif['IF_ACRONYM'].'",';
                } else {
                    $forminsertar[8] = '"'.filter_input(INPUT_POST, 'sportorg').'",'; 
                }
                $forminsertar[9] = '"'.filter_input(INPUT_POST, 'champname').'",';
                $forminsertar[10] = '"'.filter_input(INPUT_POST, 'eventname').'",';
                $forminsertar[11] = '"'.filter_input(INPUT_POST, 'hcity').'",';
                $forminsertar[12] = '"'.filter_input(INPUT_POST, 'hcountry').'",';
                $forminsertar[13] = '"'.filter_input(INPUT_POST, 'linkorg').'",'; 
                $forminsertar[14] = '"'.filter_input(INPUT_POST, 'ticket').'",'; 
                $forminsertar[15] = '"'.filter_input(INPUT_POST, 'linkticket').'",'; 
                $forminsertar[16] = '"'.filter_input(INPUT_POST, 'linkstrsoif').'",'; 
                $forminsertar[17] = '"'.filter_input(INPUT_POST, 'linkstrpp').'",'; 
                $forminsertar[18] = '"'.filter_input(INPUT_POST, 'linkstrfb').'",'; 
                $forminsertar[19] = '"'.filter_input(INPUT_POST, 'linkstryt').'",'; 
                $forminsertar[20] = '"'.filter_input(INPUT_POST, 'linkstrtw').'")'; 
                                
                $sqlinsert = "INSERT INTO STF_FT_EVENT_TMP (DT_INSERT,DT_BEGIN,DT_END,TYPE_EVENT,EVENT_COVERAGE,
                                EVENT_GENRE,SEASON_SPORT_TYPE,SPORT_OLY_PLY_OTH,SPORT_NAME,SPORT_ORG,
                                NAME_CHAMPIONSHIP,NAME_EVENT,HOST_CITY,HOST_COUNTRY,LINK_EVENTORG,TICKET,
                                LINK_TICKET,LINK_OS_STREAM,LINK_PP_STREAM,LINK_FB_STREAM,LINK_YT_STREAM,
                                LINK_TW_STREAM) VALUES (NOW(),";
                /*DT_INSERTDT*/
                foreach ($forminsertar as $par) {                    
                    $sqlinsert = $sqlinsert.$par;         
                }
                
                mysqli_query($stfConn, $sqlinsert);                    

            } // if submit

            $sqltmp = "SELECT * FROM STF_FT_EVENT_TMP ORDER BY DT_INSERT";
            $resulttmp = mysqli_query($stfConn, $sqltmp);
            

        ?>
        
        <div class='stfinsertdisplaytb'>
            <div class='stfinsertdisplayrow headertb'>
                <div class='stfinsertdisplaycell hd'>Period</div>
                <div class='stfinsertdisplaycell hd'>EventType</div>
                <div class='stfinsertdisplaycell hd'>Coverage</div>
                <div class='stfinsertdisplaycell hd'>Genre</div>
                <div class='stfinsertdisplaycell hd'>Season</div>
                <div class='stfinsertdisplaycell hd'>Oly/Ply</div>
                <div class='stfinsertdisplaycell hd'>Sport</div>
                <div class='stfinsertdisplaycell hd'>ChampsName/EventName</div>
                <div class='stfinsertdisplaycell hd'>City</div>
                <div class='stfinsertdisplaycell hd'>Country</div>
                <div class='stfinsertdisplaycell hd'>OS/IF | OC/Agenda</div>
                <div class='stfinsertdisplaycell hd'>Ticket</div>
                <div class='stfinsertdisplaycell hd'>Web Live Streaming</div>
            </div>                    
        
            <?php

            foreach ($resulttmp as $rowtmp) { 

                $stfsqlflags = "SELECT LOWER(COUNTRY_FLAG) FROM STF_COUNTRY WHERE NAME = '";                        
                $stfsqlflag = $stfsqlflags.$rowtmp['HOST_COUNTRY']."'";
                $resultflag = mysqli_query($stfConn, $stfsqlflag);
                $rowflag = mysqli_fetch_assoc($resultflag);
                
                $stfsqlsporgs = "SELECT WEBSITE,WEBSITE_AGENDA FROM STF_SPORT_ORGANIZATION WHERE ACRONYM = '";                        
                $stfsqlsporg = $stfsqlsporgs.$rowtmp['SPORT_ORG']."'";
                $resultsporg = mysqli_query($stfConn, $stfsqlsporg);
                $rowsporg = mysqli_fetch_assoc($resultsporg);
                
            ?>
                        
            <div class='stfinsertdisplayrow bodytb'>
                <div class='stfinsertdisplaycell bdy'>
                    <?php echo date_format(date_create($rowtmp['DT_BEGIN']), 'd/M/Y');?>
                    <br><?php echo date_format(date_create($rowtmp['DT_END']), 'd/M/Y');?>
                </div>
                <div class='stfinsertdisplaycell bdy'><?php echo $rowtmp['TYPE_EVENT'];?></div>
                <div class='stfinsertdisplaycell bdy'><?php echo $rowtmp['EVENT_COVERAGE'];?></div>
                <div class='stfinsertdisplaycell bdy'><?php echo $rowtmp['EVENT_GENRE'];?></div>
                <div class='stfinsertdisplaycell bdy'><?php echo $rowtmp['SEASON_SPORT_TYPE'];?></div>
                <div class='stfinsertdisplaycell bdy'><?php echo $rowtmp['SPORT_OLY_PLY_OTH'];?></div>
                <div class='stfinsertdisplaycell bdy'><?php echo $rowtmp['SPORT_NAME'];?></div>
                <div class='stfinsertdisplaycell bdy'>
                    <?php echo $rowtmp['NAME_CHAMPIONSHIP'];?>
                    <br><?php echo $rowtmp['NAME_EVENT'];?>
                </div>
                <div class='stfinsertdisplaycell bdy'><?php echo $rowtmp['HOST_CITY'];?></div>       
                <div class='stfinsertdisplaycell bdy'>
                    <img class='flags' src='./images/flags/<?php echo $rowflag['LOWER(COUNTRY_FLAG)'];?>.png' title='<?php echo $rowtmp['HOST_COUNTRY'];?>'>
                </div>
                <div class='stfinsertdisplaycell bdy'>
                    <?php if ($rowtmp['SPORT_NAME'] == "Multi-sport" or $rowtmp['LINK_EVENTORG'] != '') {?>
                        <a href="<?php echo $rowsporg['WEBSITE'];?>" target="_blank"><?php echo $rowtmp['SPORT_ORG'];?> </a>
                        <a href="<?php echo $rowtmp['LINK_EVENTORG'];?>" target="_blank">OCG</a>
                    <?php } else { ?>
                        <a href="<?php echo $rowsporg['WEBSITE'];?>" target="_blank"><?php echo $rowtmp['SPORT_ORG'];?> | </a>
                        <a href="<?php echo $rowsporg['WEBSITE_AGENDA'];?>" target="_blank">Agenda</a>
                    <?php }?>
                </div>
                <div class='stfinsertdisplaycell bdy'>
                    <a href="<?php echo $rowtmp['LINK_TICKET'];?>" target="_blank"><?php echo $rowtmp['TICKET'];?></a>
                </div>
                <div class='stfinsertdisplaycell bdy'>
                    <a href="<?php echo $rowtmp['LINK_OS_STREAM'];?>" target="_blank">OS | </a>
                    <a href="<?php echo $rowtmp['LINK_PP_STREAM'];?>" target="_blank">PP | </a>
                    <a href="<?php echo $rowtmp['LINK_FB_STREAM'];?>" target="_blank">FB | </a>
                    <a href="<?php echo $rowtmp['LINK_YT_STREAM'];?>" target="_blank">YT | </a>
                    <a href="<?php echo $rowtmp['LINK_TW_STREAM'];?>" target="_blank">TW</a>
                </div>
            </div>
            
            <?php
                } 
            ?>
        </div> 
        
        <form class="stfforminsertm" action="" method="post">
            <div class="stfinserttab">
                <div class="stfinsertrow">
                    <div class="stfinsertcell tag"></div>
                    <div class="stfinsertcell colsimp">
                        <div class="icolins">
                            <input type="submit" name="Insertind" value="Insert Data">
                        </div>
                    </div>
                    <div class="stfinsertcell tag"></div>
                    <div class="stfinsertcell colsimp"></div>
                    <div class="stfinsertcell tag"></div>
                    <div class="stfinsertcell coldup"></div>
                    <div class="stfinsertcell tag"></div>
                </div>  
            </div>
        </form>
        
        <?php
            if(isset($_POST["Insertind"])){
                $uns = 0;
                $suc = 0;
                $itens = 0;                
            ?> 
        
            <div class='errobox'>
        
            <?php                
                $query = "SELECT * FROM STF_FT_EVENT_TMP ORDER BY DT_BEGIN";  
                $result = mysqli_query($stfConn, $query);                 

                foreach ($result as $row)  { 
                   $itens++;
                   
                   if ($insup == 0) {
                       $sqli = 'INSERT INTO STF_FT_EVENT (DT_INSERT,DT_BEGIN,DT_END,TYPE_EVENT,EVENT_COVERAGE,
                           EVENT_GENRE,SEASON_SPORT_TYPE,SPORT_OLY_PLY_OTH,SPORT_NAME,SPORT_ORG,NAME_CHAMPIONSHIP,
                           NAME_EVENT,HOST_CITY,HOST_COUNTRY,LINK_EVENTORG,TICKET,LINK_TICKET,LINK_OS_STREAM,
                           LINK_PP_STREAM,LINK_FB_STREAM,LINK_YT_STREAM,LINK_TW_STREAM)
                           VALUES (NOW(),"'.$row['DT_BEGIN']
                               .'","'.$row['DT_END']
                               .'","'.$row['TYPE_EVENT']
                               .'","'.$row['EVENT_COVERAGE']
                               .'","'.$row['EVENT_GENRE']
                               .'","'.$row['SEASON_SPORT_TYPE']
                               .'","'.$row['SPORT_OLY_PLY_OTH']
                               .'","'.$row['SPORT_NAME']
                               .'","'.$row['SPORT_ORG']                           
                               .'","'.$row['NAME_CHAMPIONSHIP']
                               .'","'.$row['NAME_EVENT']
                               .'","'.$row['HOST_CITY']
                               .'","'.$row['HOST_COUNTRY']
                               .'","'.$row['LINK_EVENTORG']
                               .'","'.$row['TICKET']
                               .'","'.$row['LINK_TICKET']
                               .'","'.$row['LINK_OS_STREAM']
                               .'","'.$row['LINK_PP_STREAM']
                               .'","'.$row['LINK_FB_STREAM']
                               .'","'.$row['LINK_YT_STREAM']
                               .'","'.$row['LINK_TW_STREAM']
                               .'")';
                   } else {
                        $sqli = 'UPDATE STF_FT_EVENT SET 
                                DT_INSERT = NOW()'
                                .'", DT_BEGIN = "'.$row['DT_BEGIN']
                                .'", DT_END = "'.$row['DT_END']
                                .'", TYPE_EVENT = "'.$row['TYPE_EVENT']
                                .'", EVENT_COVERAGE = "'.$row['EVENT_COVERAGE']
                                .'", EVENT_GENRE = "'.$row['EVENT_GENRE']
                                .'", SEASON_SPORT_TYPE = "'.$row['SEASON_SPORT_TYPE']
                                .'", SPORT_OLY_PLY_OTH = "'.$row['SPORT_OLY_PLY_OTH']
                                .'", SPORT_NAME = "'.$row['SPORT_NAME']
                                .'", SPORT_ORG = "'.$row['SPORT_ORG']  
                                .'", NAME_CHAMPIONSHIP = "'.$row['NAME_CHAMPIONSHIP']
                                .'", NAME_EVENT = "'.$row['NAME_EVENT']
                                .'", HOST_CITY = "'.$row['HOST_CITY']
                                .'", HOST_COUNTRY = "'.$row['HOST_COUNTRY']
                                .'", LINK_EVENTORG = "'.$row['LINK_EVENTORG']
                                .'", TICKET = "'.$row['TICKET']
                                .'", LINK_TICKET = "'.$row['LINK_TICKET']
                                .'", LINK_OS_STREAM = "'.$row['LINK_OS_STREAM']
                                .'", LINK_PP_STREAM = "'.$row['LINK_PP_STREAM']
                                .'", LINK_FB_STREAM = "'.$row['LINK_FB_STREAM']
                                .'", LINK_YT_STREAM = "'.$row['LINK_YT_STREAM']
                                .'", LINK_TW_STREAM = "'.$row['LINK_TW_STREAM']
                                .' WHERE ID_EVENTS = '.$editid;
                   }
                   
                   $resulti = mysqli_query($stfConn, $sqli);

                   if (!$resulti) {              
                        $uns++;
                        echo "Erro when insert item line ".$itens." - Description: " . mysqli_error($stfConn)."<br>";
                    } else {                                                             
                        $sqld = "DELETE FROM STF_FT_EVENT_TMP WHERE ID_EVENTS = '".$row['ID_EVENTS']."'";                
                        mysqli_query($stfConn, $sqld);
                        $suc++;
                    }                                        
                }  
                echo "<br><strong>De (".$itens.") itens, (".$suc.") foram carregados com sucesso e (".$uns.") não foram carregados.</strong>";
                ?>
            
            </div>
        
        <?php
            }
        ?>
        
    </body>
</html>
