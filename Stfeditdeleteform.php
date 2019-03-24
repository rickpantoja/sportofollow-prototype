<?php
    include_once 'Stfconn.php';
    require_once 'Stfselectform.php';
    
    $stfConn = Stfconn();
    
    if (isset($_POST['submit-delete'])) {
        $deleteid = filter_input(INPUT_POST, 'deleteid');   

        $sqldelete = "DELETE FROM STF_FT_EVENT WHERE ID_EVENTS = ".$deleteid;
        $resultdelete = mysqli_query($stfConn, $sqldelete);

        header("Refresh:5;");
    }
            
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/normalize.css">
        <link rel="stylesheet" href="./css/insertformstyle.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
        
        <title>sportofollow</title>         
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
        
        <?php
            $sqltmp = "SELECT * FROM STF_FT_EVENT ORDER BY DT_BEGIN";
            $resulttmp = mysqli_query($stfConn, $sqltmp);
        ?>
        
        <div class='stfinsertdisplaytb editdeletepage'>
            <div class='stfinsertdisplayrow headertb'>
                <div class='stfinsertdisplaycell hd'></div>
                <div class='stfinsertdisplaycell hd'></div>
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
                    <form class="stfeditdeleteform editgreen" action="Stfeditform.php" method="post" enctype="multipart/form-data">
                        <input class="stfeditformtext" type="text" name="editid" value="<?php echo $rowtmp['ID_EVENTS'];?>">
                        <input type="submit" name="submit-edit" value="">
                    </form>
                </div>
                <div class='stfinsertdisplaycell bdy'>
                    <form class="stfeditdeleteform deletered" action="" method="post" enctype="multipart/form-data">
                        <input class="stfeditformtext" type="text" name="deleteid" value="<?php echo $rowtmp['ID_EVENTS'];?>">
                        <input type="submit" name="submit-delete" value="">
                    </form>                       
                </div>
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
                    <?php if ($rowtmp['SPORT_NAME'] == "Multi-sports" or $rowtmp['LINK_EVENTORG'] != '') {?>
                        <a href="<?php echo $rowsporg['WEBSITE'];?>" target="_blank"><?php echo $rowtmp['SPORT_ORG'];?> | </a>
                        <a href="<?php echo $rowtmp['LINK_EVENTORG'];?>" target="_blank">OCOG</a>
                    <?php } else { ?>
                        <a href="<?php echo $rowsporg['WEBSITE'];?>" target="_blank"><?php echo $rowtmp['SPORT_ORG'];?> | </a>
                        <a href="<?php echo $rowsporg['WEBSITE_AGENDA'];?>" target="_blank">Agenda</a>
                    <?php }?>
                </div>
                <div class='stfinsertdisplaycell bdy'>
                    <?php if ($rowtmp['TICKET'] == 'Buy') { ?>
                        <a href="<?php echo $rowtmp['LINK_TICKET'];?>" target="_blank"><?php echo $rowtmp['TICKET'];?></a>
                    <?php } else { echo $rowtmp['TICKET']; } ?>
                </div>
                <div class='stfinsertdisplaycell bdy'>
                    <?php 
                        $linkcount = 0;                         
                        if ($rowtmp['LINK_OS_STREAM'] != "") {
                     ?>
                        <a href="<?php $linkcount++; echo $rowtmp['LINK_OS_STREAM'];?>" target="_blank">OS</a>
                    <?php }?>
                    <?php 
                        if ($rowtmp['LINK_PP_STREAM'] != "") {
                            if ($linkcount > 0) { ?> | <?php } ?>
                        <a href="<?php $linkcount++; echo $rowtmp['LINK_PP_STREAM'];?>" target="_blank">PP</a>
                    <?php }?>
                    <?php if ($rowtmp['LINK_FB_STREAM'] != "") {
                            if ($linkcount > 0) { ?> | <?php } ?>
                        <a href="<?php $linkcount++; echo $rowtmp['LINK_FB_STREAM'];?>" target="_blank">FB</a>
                    <?php } ?>
                    <?php if ($rowtmp['LINK_YT_STREAM'] != "") {
                            if ($linkcount > 0) { ?> | <?php } ?>
                        <a href="<?php $linkcount++; echo $rowtmp['LINK_YT_STREAM'];?>" target="_blank">YT</a>
                    <?php }?>
                    <?php if ($rowtmp['LINK_TW_STREAM'] != "") {
                            if ($linkcount > 0) { ?> | <?php } ?>
                        <a href="<?php $linkcount++; echo $rowtmp['LINK_TW_STREAM'];?>" target="_blank">TW</a>
                    <?php }?>
                </div>
                
            </div>
            
            <?php
            }
            ?>
                
        </div>
        
    </body>
</html>
