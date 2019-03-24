<?php    
    require_once 'Stfselectform.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/normalize.css">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css"/>
        <link id="bs-css" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
        <script src="./js/numscroller-1.0.js"></script>
        <title>sportofollow</title>
        <script>
            function disableintorg(valorg) {
                var valdis = valorg; 
                if(valdis=="All IFs") {
                    document.getElementById("sporg").disabled = false;
                }else{                    
                    document.getElementById("sporg").disabled = true;
                }
            }
            function disableintif(valif) {
                var valdist = valif; 
                if(valdist=="All Sport Orgs") {
                    document.getElementById("intfed").disabled = false;
                }else{                    
                    document.getElementById("intfed").disabled = true;
                }
            }
        </script>
    </head>
    <body>
                
        <header class="headerhome">
            <div class="bg1"><div class="logobox"><a href="http://www.sportofollow.com"><img class="logoimg stflogohome" src="./images/stf_logo1b.png"></a></div></div>
            <div class="bg2"><div class="logobox"><a href="http://www.sportofollow.com"><img class="logoimg stflogohome" src="./images/stf_logo1b.png"></a></div></div>
            <div class="bg3"><div class="logobox"><a href="http://www.sportofollow.com"><img class="logoimg stflogohome" src="./images/stf_logo1b.png"></a></div></div>
            <div class="logobox mobil"><a href="http://www.sportofollow.com"><img class="logoimg stflogohome" src="./images/stf_logo1b.png"></a></div>
        </header>

        <div class="icon-bar">
          <a href="https://www.facebook.com/sportofollow/" class="smbar facebook" target="_blank"></a> 
          <a href="https://twitter.com/sportofollow/" class="smbar twitter" target="_blank"></a> 
          <a href="https://www.youtube.com/channel/UCzVe8WX8OnEhPHzKhv5jLOA" class="smbar youtube" target="_blank"></a> 
          <a href="https://www.instagram.com/sportofollow/" class="smbar instagram" target="_blank"></a> 
          <a href="https://www.linkedin.com/company/wsportcalendar/" class="smbar linkedin" target="_blank"></a>          
        </div>
                
        <form class="formsearch" action="Stfresult.php" method="POST">
            <div class="tbformsearch">
                <div class="tbformsearchrow">
                    <div class="tbformsearchi">
                        <div class="tbformsearchrow">
                            <div class="tbformsearchcell colhome11">
                                <input class="geralsearch" type="text" name="geralsearch" placeholder="Insert words for your search" />
                            </div>
                            <div class="tbformsearchcell tag"></div>
                            <div class="tbformsearchcell colhome12">
                                <input class="submithome" type="submit" name="submit-search" value="Search">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tbformsearchrow">
                    <div class="tbformsearchi">
                        <div class="tbformsearchrow">
                            <div class="tbformsearchcell colhome20">
                                <select class="searchselect" name="yearselect" />
                                <option>All Years</option>                            
                                        <?php
                                            $stfYear = new Stfselectform();
                                            foreach ($stfYear->stfYearSelect() as $yearItem) {                                        
                                        ?>
                                        <option class="selectall" value="<?php echo strtolower($yearItem); ?>"><?php echo $yearItem; ?></option>
                                        <?php } ?>                             
                                </select>
                            </div>
                            <div class="tbformsearchcell tag"></div>
                            <div class="tbformsearchcell colhome20" id="sandbox-container">                                
                                <div class="input-group date">
                                  <input type="text" class="form-control" name="initialdate" placeholder="Initial Date">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                            <div class="tbformsearchcell tag"></div>
                            <div class="tbformsearchcell colhome20" id="sandbox-container">
                                <div class="input-group date">
                                  <input type="text" class="form-control" name="finishdate" placeholder="Finish Date">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tbformsearchrow">
                    <div class="tbformsearchi">
                        <div class="tbformsearchrow">
                            <div class="tbformsearchcell colhome20">
                                <select class="searchselect" name="sportselect" />
                                    <option>All Sports</option>                            
                                    <?php
                                        $stfSport = new Stfselectform();
                                        foreach ($stfSport->stfSportSelect() as $sportItem) {                                        
                                    ?>
                                    <option class="selectall" value="<?php echo $sportItem; ?>"><?php echo $sportItem; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="tbformsearchcell tag"></div>
                            <div class="tbformsearchcell colhome20">
                                <select class="searchselect" name="coverageselect" />
                                    <option>All Coverages</option>                            
                                    <?php
                                        $stfCoverage = new Stfselectform();
                                        foreach ($stfCoverage->stfCoverageSelect() as $coverageItem) {                                        
                                    ?>
                                    <option class="selectall" value="<?php echo $coverageItem; ?>"><?php echo $coverageItem; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="tbformsearchcell tag"></div>
                            <div class="tbformsearchcell colhome20">
                                <select class="searchselect" name="hostcountryselect" />
                                    <option>All Host Countries</option>                            
                                    <?php
                                        $stfHcountry = new Stfselectform();
                                        foreach ($stfHcountry->stfHcountrySelect() as $hcountryItem) {                                        
                                    ?>
                                    <option class="selectall" value="<?php echo $hcountryItem; ?>"><?php echo $hcountryItem; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="stfhometab">              
                <input class="stfhomeinput" id="tab-home" type="checkbox" name="tabhome">
                <label class="stfhomelabel" for="tab-home">+ Advanced Search</label>
                <div class="stfhometabrowhi">
                    <div class="stfhometabcontent">
                        <div class="stfhometabcontentrow">
                            <div class="stfhometabcontentcell colselect">
                                <select class="selecthomei" onchange="disableintif(this.value)" id="sporg" name="sporg">
                                    <option>All Sport Orgs</option>
                                    <?php
                                        $stfSporg = new Stfselectform();
                                        foreach ($stfSporg->stfSporgSelect() as $sporgItem) {                                        
                                    ?>
                                    <option class="selectall" value="<?php echo $sporgItem; ?>"><?php echo $sporgItem; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="stfhometabcontentcell tag"></div>                            
                            <div class="stfhometabcontentcell colselect">
                                <select class="selecthomei" onchange="disableintorg(this.value)" id="intfed" name="intfed"/>
                                    <option>All Int. Federations</option>
                                    <?php
                                        $stfIf = new Stfselectform();
                                        foreach ($stfIf->stfIfSelect() as $ifItem) {                                        
                                    ?>
                                    <option class="selectall" value="<?php echo $ifItem; ?>"><?php echo $ifItem; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="stfhometabcontentcell tag"></div>
                            <div class="stfhometabcontentcell colradio">
                                <label class="stfradiolabel" for="eventtype">Event Type:</label>
                                <div>
                                    <label class="radiocontainer inline">
                                        <input type="radio" checked="checked" name="eventtype" value="All Events">
                                        <span>All Events</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="eventtype" value="Competition">
                                        <span>Competition</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="eventtype" value="Conference">
                                        <span>Conference</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="stfhometabcontentcell colradio">
                                <label class="stfradiolabel" for="season">Season Sport Type:</label>
                                <div>
                                    <label class="radiocontainer inline">
                                        <input type="radio" checked="checked" name="season" value="All Sport Seasons">
                                        <span>All Sport Seasons</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="season" value="Summer">
                                        <span>Summer</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="season" value="Winter">
                                        <span>Winter</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="stfhometabcontentcell colradio">
                                <label class="stfradiolabel" for="olyply">Olympic/Paralympic:</label>
                                <div>
                                    <label class="radiocontainer inline">
                                        <input type="radio" checked="checked" name="olyply" value="All Sports">
                                        <span>All Sports</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="olyply" value="Olympic">
                                        <span>Olympic</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="olyply" value="Paralympic">
                                        <span>Paralympic</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="olyply" value="Other">
                                        <span>Other</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="stfhometabcontentcell colradio">
                                <label class="stfradiolabel" for="genre">Competition Genre:</label>
                                <div>
                                    <label class="radiocontainer inline">
                                        <input type="radio" checked="checked" name="genre" value="All Genres">
                                        <span>All Genres</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="genre" value="Men/Women">
                                        <span>Men/Women</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="genre" value="Men">
                                        <span>Men</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="genre" value="Women">
                                        <span>Women</span>
                                    </label>
                                </div>
                            </div>
                            <div class="stfhometabcontentcell colradio">
                                <label class="stfradiolabel" for="season">Web Live Stream:</label>
                                <div>
                                    <label class="radiocontainer inline">
                                        <input type="radio" checked="checked" name="livestream" value="All Events">
                                        <span>All Events</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="livestream" value="Live Stream Only">
                                        <span>Live Stream Only</span>
                                    </label>
                                </div>
                            </div>                            
                            <div class="stfhometabcontentcell colradio">
                                <label class="stfradiolabel" for="season">Event Tickets:</label>
                                <div>
                                    <label class="radiocontainer inline">
                                        <input type="radio" checked="checked" name="ticket" value="All Events">
                                        <span>All Events</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="ticket" value="Buy">
                                        <span>Buy</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="ticket" value="Free">
                                        <span>Free</span>
                                    </label>
                                    <label class="radiocontainer inline">
                                        <input type="radio" name="ticket" value="Closed">
                                        <span>Closed</span>
                                    </label>
                                </div>
                            </div>
                            
                            
                        </div>                        
                    </div>
                </div>
            </div>
            
        </form>
        
        <div class="stfaboutus">
            <div class="stfaboutusover">
                <div class="stfaboutustable">
                    <div class="stfaboutusrow">
                        <div class="stfaboutuscell colleft">
                            <img class="champsimg" src="./images/stfcompetitions.png">
                        </div>
                        <div class="stfaboutuscell colright">
                            <p><strong>SPORTOFOLLOW</strong> IS A<br>
                            COMPREHENSIVE WEB<br>
                            PLATFORM WHERE YOU<br>
                            CAN FIND WORLDWIDE<br>
                            <strong>SPORTING EVENTS</strong>.<br>
                            HERE YOU CAN SEE<br>
                            INFORMATION ABOUT<br>
                            <strong>TICKETS</strong>, <strong>LIVE WEB</strong> OR<br>
                            <strong>SOCIAL MEDIA</strong> STREAMING,<br>
                            AND ALL OTHER DETAILS<br>
                            YOU NEED TO FOLLOW<br>
                            YOUR <strong>FAVOURITE SPORT!</strong>.</p>
                        </div>
                    </div>
                </div>
                <div class="stfaboutustable">
                    <div class="stfaboutusrow">
                        <div class="stfaboutuscell aboutusfooter">
                            <img class="ftabsimg" src="./images/ftaboutus.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="stfguide">
            <div class="stfguide titleguide">
                <p>Quick Overview</p>
            </div>
            <div class="stfguide mainguide">
                <div class="stfguiderow">                
                    <div class="stfguidecell guide1">
                        <img class="guide1bgimg" src="./images/homeguide1.png">
                    </div>
                    <div class="stfguidecell guidetext1">
                        <p>FRIENDLY, FREE<br>
                            and EASY to<br>
                            use sporting<br>
                            events list<br>
                            with multiple<br>
                            filters to<br>
                            tailor your<br>
                            search to your<br>
                            requirements</p>
                    </div>
                </div>
                <div class="stfguiderow">                
                    <div class="stfguidecell guide1">
                        <img class="guide1bgimg" src="./images/homeguide2.png">
                    </div>
                    <div class="stfguidecell guidetext2">
                        <p>RELIABLE and<br>
                            CONSTANTLY<br>
                            revised data<br>
                            direct from<br>
                            event and<br>
                            sporting<br>
                            organisations,<br>
                            such as the<br>
                            International<br>
                            Sport<br>
                            Federations<br>
                            website</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="stfnumbers ntb1">
            <div class="stfnumbersrow">
                <div class="stfnumberscell nuntag"></div>
                <div class="stfnumberscell ncol">
                    <div class="stfnumbers">
                        <div class="stfnumbersrow">
                            <div class="stfnumberscell"><p>Sports</p></div>
                        </div>
                        <div class="stfnumbersrow">
                            <div class="stfnumberscell">
                                <span class='numscroller' data-min='1' data-max='33' data-delay='1' data-increment='1'>33</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stfnumberscell ncol">
                    <div class="stfnumbers">
                        <div class="stfnumbersrow">
                            <div class="stfnumberscell"><p>Championships</p></div>
                        </div>
                        <div class="stfnumbersrow">
                            <div class="stfnumberscell">
                                <span class='numscroller' data-min='1' data-max='298' data-delay='5' data-increment='5'>298</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stfnumberscell ncol">
                    <div class="stfnumbers">
                        <div class="stfnumbersrow">
                            <div class="stfnumberscell"><p>Host Countries</p></div>
                        </div>
                        <div class="stfnumbersrow">
                            <div class="stfnumberscell">
                                <span class='numscroller' data-min='1' data-max='89' data-delay='5' data-increment='5'>89</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stfnumberscell ncol">
                    <div class="stfnumbers">
                        <div class="stfnumbersrow">
                            <div class="stfnumberscell"><p>Sport Organizations</p></div>
                        </div>
                        <div class="stfnumbersrow">
                            <div class="stfnumberscell">
                                <span class='numscroller' data-min='1' data-max='52' data-delay='1' data-increment='1'>52</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stfnumberscell ncol">
                    <div class="stfnumbers">
                        <div class="stfnumbersrow">
                            <div class="stfnumberscell"><p>Live Streamings</p></div>
                        </div>
                        <div class="stfnumbersrow">
                            <div class="stfnumberscell">
                                <span class='numscroller' data-min='1' data-max='43' data-delay='1' data-increment='1'>43</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stfnumberscell nuntag"></div>
            </div>            
        </div>
        <div class="stfusers">
            <div class="stfguide titleguide">
                <p>Target Users</p>
            </div>
            <div class="stfusers tb1">            
                <div class="stfusersrow">
                    <div class="stfuserscell">
                        <div class="stfusers tb2">
                            <div class="stfusersrow">
                                <div class="stfuserscell"><img class="guide1bgimg" src="./images/tofans.png"></div>                            
                            </div>
                            <div class="stfusersrow">
                                <div class="stfuserscell">
                                    <p>Free access to information<br>
                                        about your favorite sport.<br>
                                        Here you can verify tickets<br>
                                        and discover whether the<br>
                                        event will be live streamed<br>
                                        via  the Internet or social<br>
                                        media. You can choose the<br>
                                        sports and events to follow<br>
                                        throughout all seasons.</p>
                                </div>                            
                            </div>                        
                        </div>
                    </div>
                    <div class="stfuserscell">
                        <div class="stfusers tb2">
                            <div class="stfusersrow">
                                <div class="stfuserscell"><img class="guide1bgimg" src="./images/toathletes.png"></div>                            
                            </div>
                            <div class="stfusersrow">
                                <div class="stfuserscell">
                                    <p>Comprehensive list of the<br>
                                        main sport competitions<br>
                                        around the world. Here you<br>
                                        will find information about<br>
                                        your sport to analyse and<br>
                                        to create your plan for the<br>
                                        season. You can choose the<br>
                                        competitions and create the<br>
                                        operational plan to be there.</p>
                                </div>                            
                            </div>                        
                        </div>
                    </div>
                    <div class="stfuserscell"> 
                        <div class="stfusers tb2">
                            <div class="stfusersrow">
                                <div class="stfuserscell"><img class="guide1bgimg" src="./images/tosportmanagers.png"></div>                            
                            </div>
                            <div class="stfusersrow">
                                <div class="stfuserscell">
                                    <p>Accurate and up-to-date<br>
                                        details to enable you to<br>
                                        plan the journey of your<br>
                                        organization and/or your<br>
                                        athlete development projects.<br>
                                        This data is compiled from<br>
                                        the communication channels<br>
                                        of the sport events, such<br>
                                        the Int. Sport Federations.</p>
                                </div>                            
                            </div>                        
                        </div>
                    </div>
                </div>
                <div class="stfusersrow userstag">                
                </div>
                <div class="stfusersrow">
                    <div class="stfuserscell">
                        <div class="stfusers tb2">
                            <div class="stfusersrow">
                                <div class="stfuserscell"><img class="guide1bgimg" src="./images/toeventmanagers.png"></div>                            
                            </div>
                            <div class="stfusersrow">
                                <div class="stfuserscell">
                                    <p>Plan your events calendar<br>
                                        and marketing strategy<br>
                                        based upon accurate<br>
                                        information for world-wide<br>
                                        sporting events. The<br>
                                        database is updated in <br>
                                        real-time, as organizations<br>
                                        release the details of<br>
                                        their season calendar.</p>
                                </div>                            
                            </div>                        
                        </div>
                    </div>
                    <div class="stfuserscell"> 
                        <div class="stfusers tb2">
                            <div class="stfusersrow">
                                <div class="stfuserscell"><img class="guide1bgimg" src="./images/tosportorgs.png"></div>                            
                            </div>
                            <div class="stfusersrow">
                                <div class="stfuserscell">
                                    <p>Follow the event calendar<br>
                                        definitions of other sport<br>
                                        organizations and event<br>
                                        organizers. Then, use<br>
                                        this information to<br>
                                        support your strategic<br>
                                        decision-making when<br>
                                        you select host cities<br>
                                        and event dates.</p>
                                </div>                            
                            </div>                        
                        </div>
                    </div>
                    <div class="stfuserscell"> 
                        <div class="stfusers tb2">
                            <div class="stfusersrow">
                                <div class="stfuserscell"><img class="guide1bgimg" src="./images/toacademics.png"></div>                            
                            </div>
                            <div class="stfusersrow">
                                <div class="stfuserscell">
                                    <p>An exhaustive list of sport<br>
                                        conferences to facilitate<br>
                                        all sport researches and<br>
                                        academics with planning<br>
                                        event participations.<br>
                                        Academic institutions<br>
                                        can get information to<br>
                                        decide the best moments<br>
                                        to realize their own events.</p>
                                </div>                            
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footerhome">
            <div class="footerhomerow">                
                <div class="footerhomecell">
                    <ul>
                      <li><a href="#">About</a></li>
                      <li><a href="./Stfcontact.php">Contact</a></li>
                      <li><a href="#">FAQ</a></li>
                      <li><a href="#">Terms</a></li>
                      <li><a href="#">Privacy</a></li>
                    </ul>
                </div>
                <div class="footerhomecell">   
                    <p>Copyright 2018 by SPORTOFOLLOW</p>
                </div>
            </div>            
        </footer>
        <script>
            $(function(){
              $('#sandbox-container .input-group.date').datepicker({
                    format: "yyyy-mm-dd",
                    todayBtn: true,
                    orientation: "top auto",
                    keyboardNavigation: false,
                    autoclose: true,
                    todayHighlight: true
                });
            })
        </script>

    </body>
</html>
