<?php
    include_once 'Stfconn.php';
    require_once 'Stfselectform.php';
    
    $stfConn = Stfconn();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/normalize.css">
        <link rel="stylesheet" href="./css/insertformstyle.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
        <script>
            (function(e,t,n){
                var r=e.querySelectorAll("html")[0];
                r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")
            })
            (document,window,0);
        </script>
        <title>sportofollow</title>         
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
                    <a href="./Stfinsertform.php"><div class="hdmenubt">Individual Insert</div></a>
                </div>
                <div class="stfheaderinsertcell hdmenu">
                    <a href="./Stfinsertmassform.php"><div class="hdmenubt menusel">Mass Insert</div></a>
                </div>
            </div>
        </header>
        
        <form class="stfforminsert" action="" method="post" enctype="multipart/form-data">    
            <div class="stfinserttab">
                <div class="stfinsertrow">
                    <div class="stfinsertcell tag"></div>                    
                    <div class="stfinsertcell colsimp">
                        <div class="icolins">
                            <input type="file" name="file" id="file-1" class="inputfile" data-multiple-caption="{count} files selected" multiple />
                            <label for="file-1">
                                <svg width="20" height="17" viewBox="0 0 20 17">
                                    <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                </svg>
                                <span>Choose a file&hellip;</span>
                            </label>
                        </div>
                    </div>
                    <div class="stfinsertcell tag"></div>
                    <div class="stfinsertcell colsimp">
                        <div class="icolins">
                            <input type="submit" name="Import" value="Display File Data">
                        </div>
                    </div>
                    <div class="stfinsertcell tag"></div>
                    <div class="stfinsertcell colsimp"></div>
                    <div class="stfinsertcell tag"></div>
                    <div class="stfinsertcell colsimp"></div>
                    <div class="stfinsertcell tag"></div>
                </div>  
            </div>
        </form>
        
        <?php
            if(isset($_POST["Import"])){

                $filename=$_FILES["file"]["tmp_name"];

                if($_FILES["file"]["size"] > 0) {
                    $file = fopen($filename, "r");
                    $sqlt = "TRUNCATE TABLE STF_FT_EVENT_TMP";
                    $resultt = mysqli_query($stfConn, $sqlt);
                    $countdata = 0;
                    $counterro = 0;
                    $countinsert = 0;
                    echo "<div class='errobox'>";

                    while ((($getData = fgetcsv($file, 50000, ";")) !== FALSE) and ($resultt == TRUE)) {
                            $countdata++;
                            $sqlinsert = 'INSERT INTO STF_FT_EVENT_TMP (DT_INSERT,DT_BEGIN,DT_END,TYPE_EVENT,EVENT_COVERAGE,
                                EVENT_GENRE,SEASON_SPORT_TYPE,SPORT_OLY_PLY_OTH,SPORT_NAME,SPORT_ORG,
                                NAME_CHAMPIONSHIP,NAME_EVENT,HOST_CITY,HOST_COUNTRY,LINK_EVENTORG,TICKET,
                                LINK_TICKET,LINK_OS_STREAM,LINK_PP_STREAM,LINK_FB_STREAM,LINK_YT_STREAM,
                                LINK_TW_STREAM) VALUES (NOW(),';
                            foreach ($getData as $par) {                    
                                $sqlinsert = $sqlinsert.'"'.$par.'",';         
                            }
                            $sqlinsert = substr($sqlinsert,0,-1).')';    
                            $resulttmp = mysqli_query($stfConn, $sqlinsert);
                            if (!$resulttmp) {
                                echo "Erro when insert item line ".$countdata." - Description: " . mysqli_error($stfConn)."<br>";
                                $counterro++;
                            }
                    }
                    $countinsert = $countdata - $counterro;

                    echo "<br><strong>(".$countdata.") itens have been read; (".$countinsert.") itens inserted with sucess; (".$counterro.") itens with erros (no inserted).</strong>";

                    fclose($file);	
                }
                echo "</div>";
            }
            
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
                    <?php if ($rowtmp['SPORT_NAME'] == "Multi-sports" or $rowtmp['LINK_EVENTORG'] != '') {?>
                        <a href="<?php echo $rowsporg['WEBSITE'];?>" target="_blank"><?php echo $rowtmp['SPORT_ORG'];?> | </a>
                        <a href="<?php echo $rowtmp['LINK_EVENTORG'];?>" target="_blank">OCOG</a>
                    <?php } else { ?>
                        <a href="<?php echo $rowsporg['WEBSITE'];?>" target="_blank"><?php echo $rowtmp['SPORT_ORG'];?> | </a>
                        <a href="<?php echo $rowsporg['WEBSITE_AGENDA'];?>" target="_blank">Agenda</a>
                    <?php }?>
                </div>
                <div class='stfinsertdisplaycell bdy'>
                    <a href="<?php echo $rowtmp['LINK_TICKET'];?>" target="_blank"><?php echo $rowtmp['TICKET'];?></a>
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
                    <div class="stfinsertcell colsimp"></div>
                    <div class="stfinsertcell tag"></div>
                    <div class="stfinsertcell colsimp"></div>
                    <div class="stfinsertcell tag"></div>
                </div>  
            </div>
        </form>
        
        <?php
                
            if(isset($_POST["Insertind"])){

                $uns = 0;
                $suc = 0;
                $itens = 0;
                echo "<div class='errobox'>";
                $queryins = "SELECT * FROM STF_FT_EVENT_TMP ORDER BY DT_BEGIN";  
                $resultins = mysqli_query($stfConn, $queryins);  

                while($rowins = mysqli_fetch_assoc($resultins))  { 
                    $itens++;

                    
                    $stfsqlflags = "SELECT LOWER(COUNTRY_FLAG),COUNTRY_CODE FROM STF_COUNTRY WHERE NAME = '";                    
                    $stfsqlflag = $stfsqlflags.$rowins['HOST_COUNTRY']."'";
                    $resultflag = mysqli_query($stfConn, $stfsqlflag);
                    $rowflag = mysqli_fetch_assoc($resultflag);                    
                                       
                    $stfsqlcity = 'SELECT NAME FROM STF_CITY WHERE NAME LIKE "%';
                    $stfsqlcity = $stfsqlcity.$rowins['HOST_CITY'].'%" AND COUNTRY_CODE = "'.$rowflag['COUNTRY_CODE'].'"';
                    $resultcity = mysqli_query($stfConn, $stfsqlcity); 
                    $rowcity = mysqli_fetch_assoc($resultcity);                    

                    if ($rowflag == '') {
                        echo "The country ".$rowins['HOST_COUNTRY']." doesn't exist!<br>";
                        $uns++;
                    } else if ($rowcity == '' and $rowins['HOST_CITY'] != "Multi-cities") {
                                echo "The city ".$rowins['HOST_CITY']." from ".$rowins['HOST_COUNTRY']." doesn't exist!<br>";
                                $uns++;                                        
                            } else {                                        
                                $sqli = 'INSERT INTO STF_FT_EVENT (DT_INSERT,DT_BEGIN,DT_END,TYPE_EVENT,EVENT_COVERAGE,
                                            EVENT_GENRE,SEASON_SPORT_TYPE,SPORT_OLY_PLY_OTH,SPORT_NAME,SPORT_ORG,
                                            NAME_CHAMPIONSHIP,NAME_EVENT,HOST_CITY,HOST_COUNTRY,LINK_EVENTORG,
                                            TICKET,LINK_TICKET,LINK_OS_STREAM,LINK_PP_STREAM,LINK_FB_STREAM,
                                            LINK_YT_STREAM,LINK_TW_STREAM)
                                            VALUES (NOW(),"'
                                            .$rowins['DT_BEGIN'].'","'
                                            .$rowins['DT_END'].'","'
                                            .$rowins['TYPE_EVENT'].'","'
                                            .$rowins['EVENT_COVERAGE'].'","'
                                            .$rowins['EVENT_GENRE'].'","'
                                            .$rowins['SEASON_SPORT_TYPE'].'","'
                                            .$rowins['SPORT_OLY_PLY_OTH'].'","'
                                            .$rowins['SPORT_NAME'].'","'
                                            .$rowins['SPORT_ORG'].'","'                                            
                                            .$rowins['NAME_CHAMPIONSHIP'].'","'
                                            .$rowins['NAME_EVENT'].'","'
                                            .$rowins['HOST_CITY'].'","'
                                            .$rowins['HOST_COUNTRY'].'","'
                                            .$rowins['LINK_EVENTORG'].'","'
                                            .$rowins['TICKET'].'","'
                                            .$rowins['LINK_TICKET'].'","'
                                            .$rowins['LINK_OS_STREAM'].'","'
                                            .$rowins['LINK_PP_STREAM'].'","'
                                            .$rowins['LINK_FB_STREAM'].'","'
                                            .$rowins['LINK_YT_STREAM'].'","'
                                            .$rowins['LINK_TW_STREAM'].'")';

                                $resulti = mysqli_query($stfConn, $sqli);

                                if (!$resulti) {              
                                    $uns++;
                                    echo "Erro when insert item line ".$itens." - Description: " . mysqli_error($stfConn)."<br>";
                                } else {                                                             
                                    $sqld = "DELETE FROM STF_FT_EVENT_TMP WHERE ID_EVENTS = '".$rowins['ID_EVENTS']."'";                
                                    mysqli_query($stfConn, $sqld);
                                    $suc++;
                                }
                            }    
                }  
                echo "<br><strong>De (".$itens.") itens, (".$suc.") foram carregados com sucesso e (".$uns.") não foram carregados.</strong>";
                echo "</div>";
             }

        ?>
        
        <script src="js/custom-file-input.js"></script>
    
    </body>
</html>
