<?php
    include_once 'Stfconn.php';
    
    $stfConn = Stfconn();
    
    if (isset($_POST['submit-edit'])) {
        $editid = filter_input(INPUT_POST, 'editid');   
    
        $sqledit = "SELECT * FROM STF_FT_EVENT WHERE ID_EVENTS = ".$editid;
        $resultedit = mysqli_query($stfConn, $sqledit);
        $rowedit = mysqli_fetch_assoc($resultedit);        
    }
    
    if (isset($_POST['submit-update'])) {                    
        $initialdate = filter_input(INPUT_POST, 'initialdate');
        $finishdate = filter_input(INPUT_POST, 'finishdate');
        $eventtype = filter_input(INPUT_POST, 'eventtype');
        $coverage = filter_input(INPUT_POST, 'coverage');
        $genre = filter_input(INPUT_POST, 'genre');
        $season = filter_input(INPUT_POST, 'season');
        $olyply = filter_input(INPUT_POST, 'olyply');
        $sport = filter_input(INPUT_POST, 'sport');
        if ($forminsertspo != "Multi-sport") {
            $sqlif = "SELECT IF_ACRONYM FROM STF_SPORT WHERE NAME = '".$sport."' AND OLYPLY = '".$olyply."' AND SEASON = '".$season."'";
            $resultif = mysqli_query($stfConn, $sqlif);
            $rowfif = mysqli_fetch_assoc($resultif);                    
            $sportorg = $rowfif['IF_ACRONYM'];
        } else {
            $sportorg = filter_input(INPUT_POST, 'sportorg'); 
        }
        $champname = filter_input(INPUT_POST, 'champname');
        $eventname = filter_input(INPUT_POST, 'eventname');
        $hcity = filter_input(INPUT_POST, 'hcity');
        $hcountry = filter_input(INPUT_POST, 'hcountry');
        $linkorg = filter_input(INPUT_POST, 'linkorg'); 
        $ticket = filter_input(INPUT_POST, 'ticket'); 
        $linkticket = filter_input(INPUT_POST, 'linkticket'); 
        $linkstrsoif = filter_input(INPUT_POST, 'linkstrsoif'); 
        $linkstrpp = filter_input(INPUT_POST, 'linkstrpp'); 
        $linkstrfb = filter_input(INPUT_POST, 'linkstrfb'); 
        $linkstryt = filter_input(INPUT_POST, 'linkstryt'); 
        $linkstrtw = filter_input(INPUT_POST, 'linkstrtw');
        $editid = filter_input(INPUT_POST, 'editid'); 

        $sqlinsert = 'UPDATE STF_FT_EVENT
                        SET DT_INSERT = NOW()
                        ,DT_BEGIN = "'.$initialdate.'"'
                        .',DT_END = "'.$finishdate.'"'
                        .',TYPE_EVENT = "'.$eventtype.'"'
                        .',EVENT_COVERAGE = "'.$coverage.'"'
                        .',EVENT_GENRE = "'.$genre.'"'
                        .',SEASON_SPORT_TYPE = "'.$season.'"'
                        .',SPORT_OLY_PLY_OTH = "'.$olyply.'"'
                        .',SPORT_NAME = "'.$sport.'"'
                        .',SPORT_ORG = "'.$sportorg.'"'
                        .',NAME_CHAMPIONSHIP = "'.$champname.'"'
                        .',NAME_EVENT = "'.$eventname.'"'
                        .',HOST_CITY = "'.$hcity.'"'
                        .',HOST_COUNTRY = "'.$hcountry.'"'
                        .',LINK_EVENTORG = "'.$linkorg.'"'
                        .',TICKET = "'.$ticket.'"'
                        .',LINK_TICKET = "'.$linkticket.'"'
                        .',LINK_OS_STREAM = "'.$linkstrsoif.'"'
                        .',LINK_PP_STREAM = "'.$linkstrpp.'"'
                        .',LINK_FB_STREAM = "'.$linkstrfb.'"'
                        .',LINK_YT_STREAM = "'.$linkstryt.'"'
                        .',LINK_TW_STREAM = "'.$linkstrtw.'"'
                        .' WHERE ID_EVENTS = '.$editid;

        mysqli_query($stfConn, $sqlinsert);

        header( "refresh:0; url=Stfeditdeleteform.php" );
    } // if submit
    
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
                    <a href="./Stfeditdeleteform.php"><div class="hdmenubt menusel">Edit/Delete</div></a>
                </div>
                <div class="stfheaderinsertcell hdmenu">
                    <a href="./Stfinsertform.php"><div class="hdmenubt">Individual Insert</div></a>
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
                                <input class="formtext" type="text" name="eventname" value="<?php echo $rowedit['NAME_EVENT']; ?>">
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="initialdate">Initial Date:</label>
                                <input class="formdate" type="date" id="initialdate" name="initialdate" value="<?php echo $rowedit['DT_BEGIN']; ?>">
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="finishdate">Finish Date:</label>
                                <input class="formdate" type="date" id="finishdate" name="finishdate" value="<?php echo $rowedit['DT_END']; ?>">
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
                                <input class="formtext" type="text" id="lname" name="champname" value="<?php echo $rowedit['NAME_CHAMPIONSHIP']; ?>">
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="hcountry">Host Country:</label>        
                                <select class="formselect" name="hcountry"/>
                                    <?php
                                    $querycountry ="SELECT * FROM STF_COUNTRY ORDER BY NAME";
                                    $resultscountry = mysqli_query($stfConn, $querycountry);                                                                         
                                        foreach($resultscountry as $country) { 
                                            if ($rowedit['HOST_COUNTRY'] == $country["NAME"]) { ?>                                            
                                                <option selected value="<?php echo $country["NAME"]; ?>"><?php echo $country["NAME"]; ?></option>
                                        <?php } else { ?>
                                                <option value="<?php echo $country["NAME"]; ?>"><?php echo $country["NAME"]; ?></option>
                                        <?php } } ?>
                                </select>
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="hcity">Host City:</label>
                                <input class="formtext" type="text" name="hcity" value="<?php echo $rowedit['HOST_CITY']; ?>">
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
                                <input class="formtext" type="text" name="coverage" value="<?php echo $rowedit['EVENT_COVERAGE']; ?>">
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="sport">Sport:</label>
                                <select onchange="disableintorg(this.value)" name="sport">
                                    <?php
                                    $querysport ="SELECT * FROM STF_SPORT GROUP BY NAME ORDER BY NAME";
                                    $resultssport = mysqli_query($stfConn, $querysport);
                                    ?>
                                    <option value="Multi-sport">Multi-sport</option>
                                    <?php
                                    foreach($resultssport as $sport) { 
                                        if ($rowedit['SPORT_NAME'] == $sport["NAME"]) { ?>                                            
                                            <option selected value="<?php echo $sport["NAME"]; ?>"><?php echo $sport["NAME"]; ?></option>
                                    <?php } else { ?>
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
                                    <?php } ?>                                       
                                </select>
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp"> 
                                <label for="linkorg">Link Organizer:</label>
                                <input class="formtext" type="text" name="linkorg" id="linkorg" value="<?php echo $rowedit['LINK_EVENTORG']; ?>">
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
                                            if ($rowedit['LINK_EVENTORG'] == 'Conference') { ?>
                                                checked="checked" <?php } ?> ">
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
                                            if ($rowedit['SEASON_SPORT_TYPE'] == 'Winter') { ?>
                                                checked="checked" <?php } ?> ">
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
                                            if ($rowedit['SPORT_OLY_PLY_OTH'] == 'Paralympic') { ?>
                                                checked="checked" <?php } ?> ">
                                        <span>Paralympic</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="olyply" value="Other" <?php
                                            if ($rowedit['SPORT_OLY_PLY_OTH'] == 'Other') { ?>
                                                checked="checked" <?php } ?> ">
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
                                           if ($rowedit['EVENT_GENRE'] == 'Men') { ?>
                                                    checked="checked" <?php } ?> ">
                                        <span>Men</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="genre" value="Women" <?php
                                            if ($rowedit['EVENT_GENRE'] == 'Women') { ?>
                                                checked="checked" <?php } ?> ">
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
                                            if ($rowedit['TICKET'] == 'Buy') { ?>
                                                checked="checked" <?php } ?> ">
                                        <span>Buy</span>
                                    </label>                                    
                                    <label class="radiocontainer inlinetrue firstno">
                                        <input onchange="disableintticket(this.value)" type="radio" name="ticket" value="Closed" <?php
                                            if ($rowedit['TICKET'] == 'Closed') { ?>
                                                    checked="checked" <?php } ?> ">
                                        <span>Close</span>
                                    </label>
                                </div>
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="linkticket">Link Ticket:</label>
                                <input class="formtext" type="text" name="linkticket" id="linkticket" <?php
                                    if ($rowedit['TICKET'] == 'Buy') { ?>
                                        value="<?php echo $rowedit['LINK_TICKET'];?>"                                            
                                    <?php } else { ?>
                                        disabled
                                    <?php } ?> >
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp">
                                <label for="linkstrsoif">Link Live Stream SO/IF:</label>
                                <input class="formtext" type="text" name="linkstrsoif" value="<?php echo $rowedit['LINK_OS_STREAM']; ?>">
                            </div>
                            <div class="stfinsertcell tag"></div>
                            <div class="stfinsertcell colsimp"> 
                                <label for="linkstrpp">Link Live Stream PP:</label>
                                <input class="formtext" type="text" name="linkstrpp" value="<?php echo $rowedit['LINK_PP_STREAM']; ?>">
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
                                <input class="formtext" type="text" name="linkstrfb" value="<?php echo $rowedit['LINK_FB_STREAM']; ?>">
                            </div>
                            <div class="stfinsertcell tag endblock"></div>
                            <div class="stfinsertcell colsimp endblock">
                                <label for="linkstryt">Link Live Stream YouTube:</label>
                                <input class="formtext" type="text" name="linkstryt" value="<?php echo $rowedit['LINK_YT_STREAM']; ?>">
                            </div>
                            <div class="stfinsertcell tag endblock"></div>
                            <div class="stfinsertcell colsimp endblock">
                                <label for="linkstrtw">Link Live Stream Twitter:</label>
                                <input class="formtext" type="text" name="linkstrtw" value="<?php echo $rowedit['LINK_TW_STREAM']; ?>">
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
                                    <input class="stfeditformtext" type="text" name="editid" value="<?php echo $rowedit['ID_EVENTS'];?>">
                                    <input type="submit" name="submit-update" value="Update Event">
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
                
    </body>
</html>
