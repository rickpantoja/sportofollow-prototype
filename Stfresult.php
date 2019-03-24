<?php
    include_once 'Stfconn.php';
    require_once 'Stfselectform.php';
    
    $stfIt = new Stfselectform();
    $stfYear = new Stfselectform();
    $stfSport = new Stfselectform();
    $stfCoverage = new Stfselectform();
    $stfHcountry = new Stfselectform();
    $stfSporg = new Stfselectform();
    $stfIf = new Stfselectform();
    
    $yearselect = array();
    $initialdate = array();
    $finishdate = array();
    $sportselect = array();
    $coverageselect = array();
    $hostcountryselect = array();
    $intfed = array();
    $sporg = array();
    $eventtype = array();
    $season = array();
    $olyply = array();
    $genre = array();
    $livestream = array();
    $ticket = array();
    
    if (isset($_POST['submit-search'])) {
        $geralsearch = filter_input(INPUT_POST, 'geralsearch');
        $yearselect[0] = filter_input(INPUT_POST, 'yearselect');
        $initialdate[0] = filter_input(INPUT_POST, 'initialdate');
        $finishdate[0] = filter_input(INPUT_POST, 'finishdate');
        $sportselect[0] = filter_input(INPUT_POST, 'sportselect');
        $coverageselect[0] = filter_input(INPUT_POST, 'coverageselect');
        $hostcountryselect[0] = filter_input(INPUT_POST, 'hostcountryselect');
        $intfed[0] = filter_input(INPUT_POST, 'intfed');
        $sporg[0] = filter_input(INPUT_POST, 'sporg');
        $eventtype[0] = filter_input(INPUT_POST, 'eventtype');
        $season[0] = filter_input(INPUT_POST, 'season');
        $olyply[0] = filter_input(INPUT_POST, 'olyply');
        $genre[0] = filter_input(INPUT_POST, 'genre');
        $livestream[0] = filter_input(INPUT_POST, 'livestream');
        $ticket[0] = filter_input(INPUT_POST, 'ticket');
        
        if ($initialdate[0] == '') {
            $initialdate[0] = date('Y-m-d');
        }

        $yeararray = array();
        $yeararray[0] = 'All Years';
        $xyear = 1;
        $yearsuncheck = '';
        foreach ($stfYear->stfYearSelect() as $yearitem) {
            $yeararray[$xyear] = $yearitem;
            $yearsuncheck = $yearsuncheck."'".$yearitem."',";
            $xyear++;
        }
        
        $sportarray = array();
        $sportarray[0] = 'All Sports';
        $xsport = 1;
        $sportsuncheck = '';
        foreach ($stfSport->stfSportSelect() as $sportitem) {
            $sportarray[$xsport] = $sportitem;
            $sportsuncheck = $sportsuncheck."'".$sportitem."',";
            $xsport++;
        }
        
        $coveragearray = array();
        $coveragearray[0] = 'All Coverages';
        $xcoverage = 1;
        $coveragesuncheck = '';
        foreach ($stfCoverage->stfCoverageSelect() as $coverageitem) {
            $coveragearray[$xcoverage] = $coverageitem;
            $coveragesuncheck = $coveragesuncheck."'".$coverageitem."',";
            $xcoverage++;
        }
        
        $hcountryarray = array();
        $hcountryarray[0] = 'All Host Countries';
        $xhcountry = 1;
        $hcountrysuncheck = '';
        foreach ($stfHcountry->stfHcountrySelect() as $hcountryitem) {
            $hcountryarray[$xhcountry] = $hcountryitem;
            $hcountrysuncheck = $hcountrysuncheck."'".$hcountryitem."',";
            $xhcountry++;
        }
        
        $sporgarray = array();
        $sporgarray[0] = 'All Sport Orgs';
        $xsporg = 1;
        $sporgsuncheck = '';
        foreach ($stfSporg->stfSporgSelect() as $sporgitem) {
            $sporgarray[$xsporg] = $sporgitem;
            $sporgsuncheck = $sporgsuncheck."'".$sporgitem."',";
            $xsporg++;
        }
        
        $ifarray = array();
        $ifarray[0] = 'All Int. Federations';
        $xif = 1;
        $ifsuncheck = '';
        foreach ($stfIf->stfIfSelect() as $ifitem) {
            $ifarray[$xif] = $ifitem;
            $ifsuncheck = $ifsuncheck."'".$ifitem."',";
            $xif++;
        }
        
        $eventtypearray = array('All Events','Competition','Conference');
        $eventtypesuncheck = "'advCompetition','advConference'";
        
        $seasonarray = array('All Sport Seasons','Summer','Winter');
        $seasonsuncheck = "'advSummer','advWinter'";
        
        $olyplyarray = array('All Sports','Olympic','Paralympic','Other');
        $olyplysuncheck = "'advOlympic','advParalympic','advOther'";
        
        $genrearray = array('All Genres','Men/Women','Men','Women');
        $genresuncheck = "'advMen/Women','advMen','advWomen'";
        
        $ticketarray = array('All Events','Buy','Free','Closed');
        $ticketsuncheck = "'advtBuy','advtFree','advtClosed'";
        
        $streamarray = array('All Events','Live Stream Only');
        $streamsuncheck = "'advlLive Stream Only'";
                
        if ($geralsearch != "") {
        $stfsql = "SELECT * FROM STF_FT_EVENT "
                . "WHERE DT_BEGIN LIKE '%$geralsearch%' "
                . "OR DT_END LIKE '%$geralsearch%' "
                . "OR TYPE_EVENT LIKE '%$geralsearch%' "
                . "OR EVENT_COVERAGE LIKE '%$geralsearch%' "
                . "OR EVENT_GENRE LIKE '%$geralsearch%' "
                . "OR SEASON_SPORT_TYPE LIKE '%$geralsearch%' "
                . "OR SPORT_OLY_PLY_OTH LIKE '%$geralsearch%' "
                . "OR SPORT_NAME LIKE '%$geralsearch%' "
                . "OR SPORT_ORG LIKE '%$geralsearch%' "                
                . "OR NAME_CHAMPIONSHIP LIKE '%$geralsearch%' "
                . "OR NAME_EVENT LIKE '%$geralsearch%' "
                . "OR HOST_CITY LIKE '%$geralsearch%' "
                . "OR HOST_COUNTRY LIKE '%$geralsearch%'";
    } else {

        $stfsearcharray = array(
            $yearselect,
            $initialdate,
            $finishdate,
            $sportselect,
            $coverageselect,
            $hostcountryselect,
            $intfed,
            $sporg,
            $eventtype,
            $season,
            $olyply,
            $genre,
            $livestream,
            $ticket);

        $stftabcol = array(
            "YEAR(DT_BEGIN) IN ",
            "(DT_BEGIN >= ",
            "DT_END <= ",
            "SPORT_NAME IN ",
            "EVENT_COVERAGE IN ",
            "HOST_COUNTRY IN ",
            "SPORT_ORG IN ",
            "SPORT_ORG IN ",
            "TYPE_EVENT IN ",
            "SEASON_SPORT_TYPE IN ",
            "SPORT_OLY_PLY_OTH IN ",
            "EVENT_GENRE IN ",
            "",
            "TICKET IN ");

        $vazios = 0;
        $cheios = 0;
        $x = 0;
        $stfsql = "SELECT * FROM STF_FT_EVENT";        

        foreach ($stfsearcharray as $stfvalue){
            $stfvalueitens = "(";
            if (count($stfvalue) > 1 and $stfvalue != $initialdate and $stfvalue != $finishdate) {
                foreach ($stfvalue as $stfvalueitem) {
                    if ($stfvalueitem != '') {                                                                                  
                        if ($stfvalueitem === end($stfvalue)) {
                                $stfvalueitens = $stfvalueitens."'".$stfvalueitem."'";                                                
                            } else {
                                $stfvalueitens = $stfvalueitens."'".$stfvalueitem."',";
                            }
                    }
                }
                $stfvalueitens = substr($stfvalueitens,0,-1);
                $stfvalueitens = $stfvalueitens.")";
            } else {
                foreach ($stfvalue as $stfvalueitem) {
                    $stfvalueitens = "('".$stfvalueitem."')";
                }
            } /*echo $stfvalueitens;*/

            if ($stfvalueitens == "('')" or substr($stfvalueitens,2,3) == "All") {
                $vazios++;
            } else if ($cheios == 0) {
                if ($stfvalueitens == "('Live Stream Only')") {
                    $stfsql = $stfsql." WHERE (LINK_OS_STREAM != '' OR LINK_PP_STREAM != '' OR LINK_FB_STREAM != '' OR LINK_YT_STREAM != '' OR LINK_TW_STREAM != '')";
                    $cheios++;
                } else {
                    $stfsql = $stfsql." WHERE $stftabcol[$x] $stfvalueitens";
                        if ($stfvalue == $initialdate) {
                            $stfsql = $stfsql." OR DT_END >= $stfvalueitens)";
                        }
                    $cheios++;                    
                }
                } else {
                    if ($stfvalueitens == "('Live Stream Only')") {
                    $stfsql = $stfsql." AND (LINK_OS_STREAM != '' OR LINK_PP_STREAM != '' OR LINK_FB_STREAM != '' OR LINK_YT_STREAM != '' OR LINK_TW_STREAM != '')";
                    $cheios++;
                    } else {
                        $stfsql = $stfsql." AND $stftabcol[$x] $stfvalueitens";
                        if ($stfvalue == $initialdate) {
                                $stfsql = $stfsql." OR DT_END >= $stfvalueitens)";
                            }
                    $cheios++;                    
                    }
                }
            $x++;    
        }
    }
    }
    
    if (isset($_POST['submit-cont'])) {   
        $geralsearch = filter_input(INPUT_POST, 'geralsearch');
        $yearselect[0] = filter_input(INPUT_POST, 'yearselect');
        $initialdate[0] = filter_input(INPUT_POST, 'initialdate');
        $finishdate[0] = filter_input(INPUT_POST, 'finishdate');
        $sportselect[0] = filter_input(INPUT_POST, 'sportselect');
        $coverageselect[0] = filter_input(INPUT_POST, 'coverageselect');
        $hostcountryselect[0] = filter_input(INPUT_POST, 'hostcountryselect');
        $intfed[0] = filter_input(INPUT_POST, 'intfed');
        $sporg[0] = filter_input(INPUT_POST, 'sporg');
        $eventtype[0] = filter_input(INPUT_POST, 'eventtype');
        $season[0] = filter_input(INPUT_POST, 'season');
        $olyply[0] = filter_input(INPUT_POST, 'olyply');
        $genre[0] = filter_input(INPUT_POST, 'genre');
        $livestream[0] = filter_input(INPUT_POST, 'livestream');
        $ticket[0] = filter_input(INPUT_POST, 'ticket');
        
        $yeararray = array();
        $yeararray[0] = 'All Years';
        $xyear = 1;
        $yearsuncheck = '';
        foreach ($stfYear->stfYearSelect() as $yearitem) {
            $yeararray[$xyear] = $yearitem;
            $yearsuncheck = $yearsuncheck."'".$yearitem."',";
            $xyear++;
        }
        $yearselect[0] = '';
        $yeararx = 0;
        foreach ($yeararray as $yeararitem) {
            if (substr($yeararitem,0,3) == "All") {
                $vyeara = "it".substr($yeararitem,0,3).substr($yeararitem,4,3);
                $yearselect[$yeararx] = filter_input(INPUT_POST, $vyeara);
            } else {
                $vyear = "it".$yeararitem;
                $yearselect[$yeararx] = filter_input(INPUT_POST, $vyear);
            }
            $yeararx++;
        }
            
        $sportarray = array();
        $sportarray[0] = 'All Sports';
        $xsport = 1;
        $sportsuncheck = '';
        foreach ($stfSport->stfSportSelect() as $sportitem) {
            $sportarray[$xsport] = $sportitem;
            $sportsuncheck = $sportsuncheck."'".$sportitem."',";
            $xsport++;
        }
        $sportselect[0] = '';
        $sportarx = 0;
        foreach ($sportarray as $sportaritem) {
            if (substr($sportaritem,0,3) == "All") {
                $vsporta = "ita".substr($sportaritem,0,3).substr($sportaritem,4,3);
                $sportselect[$sportarx] = filter_input(INPUT_POST, $vsporta);
            } else {
                $vsport = "it".$sportaritem;
                $sportselect[$sportarx] = filter_input(INPUT_POST, $vsport);
            }
            $sportarx++;
        }            
        
        $coveragearray = array();
        $coveragearray[0] = 'All Coverages';
        $xcoverage = 1;
        $coveragesuncheck = '';
        foreach ($stfCoverage->stfCoverageSelect() as $coverageitem) {
            $coveragearray[$xcoverage] = $coverageitem;
            $coveragesuncheck = $coveragesuncheck."'".$coverageitem."',";
            $xcoverage++;
        }
        $coverageselect[0] = '';
        $coveragearx = 0;
        foreach ($coveragearray as $coveragearitem) {
            if (substr($coveragearitem,0,3) == "All") {
                $vcoveragea = "it".substr($coveragearitem,0,3).substr($coveragearitem,4,3);
                $coverageselect[$coveragearx] = filter_input(INPUT_POST, $vcoveragea);
            } else {
                $vcoverage = "it".$coveragearitem;
                $coverageselect[$coveragearx] = filter_input(INPUT_POST, $vcoverage);
            }
            $coveragearx++;
        }
        
        $hcountryarray = array();
        $hcountryarray[0] = 'All Host Countries';
        $xhcountry = 1;
        $hcountrysuncheck = '';
        foreach ($stfHcountry->stfHcountrySelect() as $hcountryitem) {
            $hcountryarray[$xhcountry] = $hcountryitem;
            $hcountrysuncheck = $hcountrysuncheck."'".$hcountryitem."',";
            $xhcountry++;
        }
        $hostcountryselect[0] = '';
        $hcountryarx = 0;
        foreach ($hcountryarray as $hcountryaritem) {
            if (substr($hcountryaritem,0,3) == "All") {
                $vhcountrya = "it".substr($hcountryaritem,0,3).substr($hcountryaritem,4,3);
                $hostcountryselect[$hcountryarx] = filter_input(INPUT_POST, $vhcountrya);
            } else {
                $vhcountry = "it".substr($hcountryaritem,0,3).substr($hcountryaritem,-3);
                $hostcountryselect[$hcountryarx] = filter_input(INPUT_POST, $vhcountry);
            }
            $hcountryarx++;
        }
        
        $sporgarray = array();
        $sporgarray[0] = 'All Sport Orgs';
        $xsporg = 1;
        $sporgsuncheck = '';
        foreach ($stfSporg->stfSporgSelect() as $sporgitem) {
            $sporgarray[$xsporg] = $sporgitem;
            $sporgsuncheck = $sporgsuncheck."'".$sporgitem."',";
            $xsporg++;
        }
        $sporg[0] = '';
        $sporgarx = 0;
        foreach ($sporgarray as $sporgaritem) {
            if (substr($sporgaritem,0,3) == "All") {
                $vsporga = "itg".substr($sporgaritem,0,3).substr($sporgaritem,4,3);
                $sporg[$sporgarx] = filter_input(INPUT_POST, $vsporga);
            } else {
                $vsporg = "it".substr($sporgaritem,0,3).substr($sporgaritem,-3);
                $sporg[$sporgarx] = filter_input(INPUT_POST, $vsporg);
            }
            $sporgarx++;
        }
        
        $ifarray = array();
        $ifarray[0] = 'All Int. Federations';
        $xif = 1;
        $ifsuncheck = '';
        foreach ($stfIf->stfIfSelect() as $ifitem) {
            $ifarray[$xif] = $ifitem;
            $ifsuncheck = $ifsuncheck."'".$ifitem."',";
            $xif++;
        }
        $intfed[0] = '';
        $ifarx = 0;
        foreach ($ifarray as $ifaritem) {
            if (substr($ifaritem,0,3) == "All") {
                $vifa = "it".substr($ifaritem,0,3).substr($ifaritem,4,3);
                $intfed[$ifarx] = filter_input(INPUT_POST, $vifa);
            } else {
                $vif = "it".substr($ifaritem,0,3).substr($ifaritem,-3);
                $intfed[$ifarx] = filter_input(INPUT_POST, $vif);
            }
            $ifarx++;
        }
        
        $eventtypearray = array('All Events','Competition','Conference');
        $eventtypesuncheck = "'advCompetition','advConference'";
        $eventtype[0] = '';
        $eventtypearx = 0;
        foreach ($eventtypearray as $eventtypearitem) {
            if (substr($eventtypearitem,0,3) == "All") {
                $veventtypea = "ite".substr($eventtypearitem,0,3).substr($eventtypearitem,4,3);
                $eventtype[$eventtypearx] = filter_input(INPUT_POST, $veventtypea);
            } else {
                $veventtype = "it".substr($eventtypearitem,0,3).substr($eventtypearitem,-3);
                $eventtype[$eventtypearx] = filter_input(INPUT_POST, $veventtype);
            }
            $eventtypearx++;
        }
        
        $seasonarray = array('All Sport Seasons','Summer','Winter');
        $seasonsuncheck = "'advSummer','advWinter'";
        $season[0] = '';
        $seasonarx = 0;
        foreach ($seasonarray as $seasonaritem) {
            if (substr($seasonaritem,0,3) == "All") {
                $vseasona = "its".substr($seasonaritem,0,3).substr($seasonaritem,4,3);
                $season[$seasonarx] = filter_input(INPUT_POST, $vseasona);
            } else {
                $vseason = "it".substr($seasonaritem,0,3).substr($seasonaritem,-3);
                $season[$seasonarx] = filter_input(INPUT_POST, $vseason);
            }
            $seasonarx++;
        }
        
        $olyplyarray = array('All Sports','Olympic','Paralympic','Other');
        $olyplysuncheck = "'advOlympic','advParalympic','advOther'";
        $olyply[0] = '';
        $olyplyarx = 0;
        foreach ($olyplyarray as $olyplyaritem) {
            if (substr($olyplyaritem,0,3) == "All") {
                $volyplya = "ito".substr($olyplyaritem,0,3).substr($olyplyaritem,4,3);
                $olyply[$olyplyarx] = filter_input(INPUT_POST, $volyplya);
            } else {
                $volyply = "it".substr($olyplyaritem,0,3).substr($olyplyaritem,-3);
                $olyply[$olyplyarx] = filter_input(INPUT_POST, $volyply);
            }
            $olyplyarx++;
        }
        
        $genrearray = array('All Genres','Men/Women','Men','Women');
        $genresuncheck = "'advMen/Women','advMen','advWomen'";
        $genre[0] = '';
        $genrearx = 0;
        foreach ($genrearray as $genrearitem) {
            if (substr($genrearitem,0,3) == "All") {
                $vgenrea = "it".substr($genrearitem,0,3).substr($genrearitem,4,3);
                $genre[$genrearx] = filter_input(INPUT_POST, $vgenrea);
            } else {
                $vgenre = "it".substr($genrearitem,0,3).substr($genrearitem,-3);
                $genre[$genrearx] = filter_input(INPUT_POST, $vgenre);
            }
            $genrearx++;
        }
        
        $ticketarray = array('All Events','Buy','Free','Closed');
        $ticketsuncheck = "'advtBuy','advtFree','advtClosed'";
        $ticket[0] = '';
        $ticketarx = 0;
        foreach ($ticketarray as $ticketaritem) {
            if (substr($ticketaritem,0,3) == "All") {
                $vticketa = "itt".substr($ticketaritem,0,3).substr($ticketaritem,4,3);
                $ticket[$ticketarx] = filter_input(INPUT_POST, $vticketa);
            } else {
                $vticket = "it".substr($ticketaritem,0,3).substr($ticketaritem,-3);
                $ticket[$ticketarx] = filter_input(INPUT_POST, $vticket);
            }
            $ticketarx++;
        }
        
        $streamarray = array('All Events','Live Stream Only');
        $streamsuncheck = "'advlLive Stream Only'";
        $livestream[0] = '';
        $streamarx = 0;
        foreach ($streamarray as $streamaritem) {
            if (substr($streamaritem,0,3) == "All") {
                $vstreama = "itw".substr($streamaritem,0,3).substr($streamaritem,4,3);
                $livestream[$streamarx] = filter_input(INPUT_POST, $vstreama);
            } else {
                $vstream = "it".substr($streamaritem,0,3).substr($streamaritem,-3);
                $livestream[$streamarx] = filter_input(INPUT_POST, $vstream);
            }
            $streamarx++;
        }
                
        $stfsearcharray = array(            
            $yearselect,
            $initialdate,
            $finishdate,
            $sportselect,
            $coverageselect,
            $hostcountryselect,
            $intfed,
            $sporg,
            $eventtype,
            $season,
            $olyply,
            $genre,
            $livestream,
            $ticket);
        
        $stftabcol = array(
            "YEAR(DT_BEGIN) IN ",
            "(DT_BEGIN >= ",
            "DT_END <= ",
            "SPORT_NAME IN ",
            "EVENT_COVERAGE IN ",
            "HOST_COUNTRY IN ",
            "SPORT_ORG IN ",
            "SPORT_ORG IN ",
            "TYPE_EVENT IN ",
            "SEASON_SPORT_TYPE IN ",
            "SPORT_OLY_PLY_OTH IN ",
            "EVENT_GENRE IN ",
            "",
            "TICKET IN ");

        $vazios = 0;
        $cheios = 0;
        $x = 0;
        $stfsql = "SELECT * FROM STF_FT_EVENT";        

        foreach ($stfsearcharray as $stfvalue){
            $stfvalueitens = "(";
            if (count($stfvalue) > 1 and $stfvalue != $initialdate and $stfvalue != $finishdate) {
                foreach ($stfvalue as $stfvalueitem) {
                    if ($stfvalueitem != '') {
                        $stfvalueitens = $stfvalueitens."'".$stfvalueitem."',";                         
                    }
                }
                $stfvalueitens = substr($stfvalueitens,0,-1);
                $stfvalueitens = $stfvalueitens.")";
            } else {
                foreach ($stfvalue as $stfvalueitem) {
                    $stfvalueitens = "('".$stfvalueitem."')";
                }
            } /*echo $stfvalueitens;*/

            if ($stfvalueitens == "('')" or substr($stfvalueitens,2,3) == "All") {
                $vazios++;
            } else if ($cheios == 0) {
                if ($stfvalueitens == "('Live Stream Only')") {
                    $stfsql = $stfsql." WHERE (LINK_OS_STREAM != '' OR LINK_PP_STREAM != '' OR LINK_FB_STREAM != '' OR LINK_YT_STREAM != '' OR LINK_TW_STREAM != '')";
                    $cheios++;
                } else {
                    $stfsql = $stfsql." WHERE $stftabcol[$x] $stfvalueitens";
                        if ($stfvalue == $initialdate) {
                            $stfsql = $stfsql." OR DT_END >= $stfvalueitens)";
                        }
                    $cheios++;                    
                }
                } else {
                    if ($stfvalueitens == "('Live Stream Only')") {
                    $stfsql = $stfsql." AND (LINK_OS_STREAM != '' OR LINK_PP_STREAM != '' OR LINK_FB_STREAM != '' OR LINK_YT_STREAM != '' OR LINK_TW_STREAM != '')";
                    $cheios++;
                    } else {
                        $stfsql = $stfsql." AND $stftabcol[$x] $stfvalueitens";
                        if ($stfvalue == $initialdate) {
                                $stfsql = $stfsql." OR DT_END >= $stfvalueitens)";
                            }
                    $cheios++;                    
                    }
                }
            $x++;                            
        }
        $stfsqli = $stfsql;        
    }    
    
    if (isset($_POST['submit-search'])) {
        $stfsqlorder = " ORDER BY DT_BEGIN ASC";
        $stfsqli = $stfsql.$stfsqlorder;
    }
    
    if (isset($_POST['submit-yearasc'])){
        $stfsql = filter_input(INPUT_POST, 'sqlqueryi');
        $stfsqlorder = " ORDER BY DT_BEGIN ASC";
        $stfsqli = $stfsql.$stfsqlorder;
    } 
    
    if (isset($_POST['submit-yeardesc'])){
        $stfsql = filter_input(INPUT_POST, 'sqlqueryi');
        $stfsqlorder = " ORDER BY DT_BEGIN DESC";
        $stfsqli = $stfsql.$stfsqlorder;
    }
    
    if (isset($_POST['submit-periodasc'])){
        $stfsql = filter_input(INPUT_POST, 'sqlqueryi');
        $stfsqlorder = " ORDER BY DT_BEGIN ASC";
        $stfsqli = $stfsql.$stfsqlorder;
    } 
    
    if (isset($_POST['submit-perioddesc'])){
        $stfsql = filter_input(INPUT_POST, 'sqlqueryi');
        $stfsqlorder = " ORDER BY DT_BEGIN DESC";
        $stfsqli = $stfsql.$stfsqlorder;
    }
    
    if (isset($_POST['submit-enameasc'])){
        $stfsql = filter_input(INPUT_POST, 'sqlqueryi');
        $stfsqlorder = " ORDER BY NAME_EVENT ASC";
        $stfsqli = $stfsql.$stfsqlorder;
    } 
    
    if (isset($_POST['submit-enamedesc'])){
        $stfsql = filter_input(INPUT_POST, 'sqlqueryi');
        $stfsqlorder = " ORDER BY NAME_EVENT DESC";
        $stfsqli = $stfsql.$stfsqlorder;
    }
    
    if (isset($_POST['submit-sportasc'])){
        $stfsql = filter_input(INPUT_POST, 'sqlqueryi');
        $stfsqlorder = " ORDER BY SPORT_NAME ASC";
        $stfsqli = $stfsql.$stfsqlorder;
    } 
    
    if (isset($_POST['submit-sportdesc'])){
        $stfsql = filter_input(INPUT_POST, 'sqlqueryi');
        $stfsqlorder = " ORDER BY SPORT_NAME DESC";
        $stfsqli = $stfsql.$stfsqlorder;
    }
    
    if (isset($_POST['submit-cityasc'])){
        $stfsql = filter_input(INPUT_POST, 'sqlqueryi');
        $stfsqlorder = " ORDER BY HOST_CITY ASC";
        $stfsqli = $stfsql.$stfsqlorder;
    } 
    
    if (isset($_POST['submit-citydesc'])){
        $stfsql = filter_input(INPUT_POST, 'sqlqueryi');
        $stfsqlorder = " ORDER BY HOST_CITY DESC";
        $stfsqli = $stfsql.$stfsqlorder;
    }
    
    if (isset($_POST['submit-countryasc'])){
        $stfsql = filter_input(INPUT_POST, 'sqlqueryi');
        $stfsqlorder = " ORDER BY HOST_COUNTRY ASC";
        $stfsqli = $stfsql.$stfsqlorder;
    } 
    
    if (isset($_POST['submit-countrydesc'])){
        $stfsql = filter_input(INPUT_POST, 'sqlqueryi');
        $stfsqlorder = " ORDER BY HOST_COUNTRY DESC";
        $stfsqli = $stfsql.$stfsqlorder;
    }    
    /*echo $stfsqli;*/
    $stfConn = Stfconn();
    $result = mysqli_query($stfConn, $stfsqli);
    $queryResult = mysqli_num_rows($result);
    
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
        <title>sportofollow</title>        
        <script type="text/javascript">
            /*Unchecked All Option*/
            function uncheck(){
                var a=uncheck.arguments,z0=0;
                for (;z0<a.length;z0++){
                 document.getElementById(a[z0])?document.getElementById(a[z0]).checked=false:null;
                }
            }
        </script>
    </head>
    <body>
        
        <header class="stfheaderresult">
            <div class="stfheaderresultrow">
                <div class="stfheaderresultcell stfsmresult">
                    <div class="stfsmtb">
                        <div class="stfsmrow">
                            <div class="stfsmcell lhome"><a href="http://www.sportofollow.com"></a></div>
                            <div class="stfsmcell lface"><a href="https://www.facebook.com/sportofollow/" target="_blank"></a></div>
                            <div class="stfsmcell ltwit"><a href="https://twitter.com/sportofollow/" target="_blank"></a></div>
                            <div class="stfsmcell lyout"><a href="https://www.youtube.com/channel/UCzVe8WX8OnEhPHzKhv5jLOA" target="_blank"></a></div>
                            <div class="stfsmcell linst"><a href="https://www.instagram.com/sportofollow/" target="_blank"></a></div>
                            <div class="stfsmcell llink"><a href="https://www.linkedin.com/company/wsportcalendar/" target="_blank"></a></div>
                        </div>
                    </div>
                </div>
                <div class="stfheaderresultcell stflogoresult">
                    <a href="http://www.sportofollow.com"><img class="logoimg" src="./images/stf_logo1b.png"></a>
                </div>
            </div>
        </header>        
        
        <div class="stfpageresultrow">
            
            <!-- Result page left side - Search Result -->
            
            <div class='column stfformcont'>
                
                <form class="stfformleftside" action="" method="POST">

                    <div class="stfcontdate">
                        <div class="stfcontdaterow dateth">
                            <div class="stfcontdatecell">Initial Date</div>
                            <div class="stfcontdatecell">Finish Date</div>
                        </div>
                        <div class="stfcontdaterow">
                            <div class="stfcontdatecell" id="sandbox-container">
                                <?php if ($initialdate[0] == "") { ?>
                                    <input type="text" class="form-control stfcont" name="initialdate" placeholder="yyyy-mm-dd">
                                <?php } else { ?>
                                    <input type="text" class="form-control stfcont" name="initialdate" placeholder="<?php echo $initialdate[0]; ?>">
                                <?php } ?>
                            </div>
                            <div class="stfcontdatecell" id="sandbox-container">
                                <?php if ($finishdate[0] == "") { ?>
                                    <input type="text" class="form-control stfcont" name="finishdate" placeholder="yyyy-mm-dd">                                 
                                <?php } else { ?>
                                    <input type="text" class="form-control stfcont" name="finishdate" placeholder="<?php echo $finishdate[0]; ?>">
                                <?php } ?>    
                            </div>
                        </div>
                    </div>

                    <div class="tab">
                        <input id="tab-one" type="checkbox">
                        <label for="tab-one"><strong>Year</strong></label>
                        
                        <div class="tab-content">
                            <div class="checktopbottom"></div>  
                                <?php 
                                    foreach ($yeararray as $yearitemlist) {
                                ?>                                    
                                <label class="checkcontainer"><?php echo $yearitemlist; ?>
                                    <span class="countright">(<?php                                                      
                                        $It = $stfIt->stfItemCount($yearitemlist); echo $It; ?>)                                    
                                    </span>
                                    <input type="checkbox" id="<?php echo $yearitemlist; ?>" <?php
                                        if ($yearitemlist == 'All Years') {?>
                                            onClick="uncheck(<?php echo $yearsuncheck; ?>);" 
                                            <?php } else { ?>
                                            onClick="uncheck('All Years');"
                                        <?php } foreach ($yearselect as $yearsel) {
                                                    if ($yearitemlist == $yearsel) {?>
                                                        checked="checked"
                                        <?php }} ?> value="<?php echo $yearitemlist; ?>"
                                        name="<?php if (substr($yearitemlist,0,3) == "All") {
                                                        echo "it".substr($yearitemlist,0,3).substr($yearitemlist,4,3); } else {
                                                            echo "it".$yearitemlist;
                                    }?>">                                                        
                                    <span class="checkmark"></span>
                                </label>                                    
                                <?php                                         
                                    } 
                                ?>                        
                            <div class="checktopbottom"></div>
                        </div>

                    </div>
                    
                    <div class="tab">
                        <input id="tab-two" type="checkbox">
                        <label for="tab-two"><strong>Sport</strong></label>

                        <div class="tab-content">
                            <div class="checktopbottom"></div>  
                                <?php 
                                    foreach ($sportarray as $sportitemlist) {
                                ?>                                    
                                <label class="checkcontainer"><?php echo $sportitemlist; ?>
                                    <span class="countright">(<?php                                                      
                                            $It = $stfIt->stfItemCountSport($sportitemlist); echo $It; ?>)                                    
                                    </span>
                                    <input type="checkbox" id="<?php echo $sportitemlist; ?>" <?php
                                        if ($sportitemlist == 'All Sports') {?>
                                            onClick="uncheck(<?php echo $sportsuncheck; ?>);" 
                                            <?php } else { ?>
                                            onClick="uncheck('All Sports');"
                                        <?php } foreach ($sportselect as $sportsel) {
                                                    if ($sportitemlist == $sportsel) {?>
                                                        checked="checked"
                                        <?php }} ?> value="<?php echo $sportitemlist; ?>"
                                        name="<?php if (substr($sportitemlist,0,3) == "All") {
                                                        echo "ita".substr($sportitemlist,0,3).substr($sportitemlist,4,3); } else {
                                                            echo "it".$sportitemlist;
                                    }?>">                                                        
                                    <span class="checkmark"></span>
                                </label>                                    
                                <?php                                         
                                    } 
                                ?>                        
                            <div class="checktopbottom"></div>
                        </div>

                    </div>
                    
                    <div class="tab">
                        <input id="tab-three" type="checkbox">
                        <label for="tab-three"><strong>Coverage</strong></label>

                        <div class="tab-content">
                            <div class="checktopbottom"></div>  
                                <?php 
                                    foreach ($coveragearray as $coverageitemlist) {
                                ?>                                    
                                <label class="checkcontainer"><?php echo $coverageitemlist; ?>
                                    <span class="countright">(<?php                                                      
                                            $It = $stfIt->stfItemCountCoverage($coverageitemlist); echo $It; ?>)                                    
                                    </span>
                                    <input type="checkbox" id="<?php echo $coverageitemlist; ?>" <?php
                                        if ($coverageitemlist == 'All Coverages') {?>
                                            onClick="uncheck(<?php echo $coveragesuncheck; ?>);" 
                                            <?php } else { ?>
                                            onClick="uncheck('All Coverages');"
                                        <?php } foreach ($coverageselect as $coveragesel) {
                                                    if ($coverageitemlist == $coveragesel) {?>
                                                        checked="checked"
                                        <?php }} ?> value="<?php echo $coverageitemlist; ?>"
                                        name="<?php if (substr($coverageitemlist,0,3) == "All") {
                                                        echo "it".substr($coverageitemlist,0,3).substr($coverageitemlist,4,3); } else {
                                                            echo "it".$coverageitemlist;
                                    }?>">                                                        
                                    <span class="checkmark"></span>
                                </label>                                    
                                <?php                                         
                                    } 
                                ?>                        
                            <div class="checktopbottom"></div>
                        </div>

                    </div>
                    
                    <div class="tab">
                        <input id="tab-four" type="checkbox">
                        <label for="tab-four"><strong>Host Country</strong></label>

                        <div class="tab-content">
                            <div class="checktopbottom"></div>  
                                <?php 
                                    foreach ($hcountryarray as $hcountryitemlist) {
                                ?>                                    
                                <label class="checkcontainer"><?php echo $hcountryitemlist; ?>
                                    <span class="countright">(<?php                                                      
                                            $It = $stfIt->stfItemCountHcountry($hcountryitemlist); echo $It; ?>)                                    
                                    </span>
                                       <input type="checkbox" id="<?php echo $hcountryitemlist; ?>" <?php
                                        if ($hcountryitemlist == 'All Host Countries') {?>
                                            onClick="uncheck(<?php echo $hcountrysuncheck; ?>);" 
                                            <?php } else { ?>
                                            onClick="uncheck('All Host Countries');"
                                        <?php } foreach ($hostcountryselect as $hcountrysel) {
                                                    if ($hcountryitemlist == $hcountrysel) {?>
                                                        checked="checked"
                                        <?php }} ?> value="<?php echo $hcountryitemlist; ?>"
                                        name="<?php if (substr($hcountryitemlist,0,3) == "All") {
                                                        echo "it".substr($hcountryitemlist,0,3).substr($hcountryitemlist,4,3); } else {
                                                            echo "it".substr($hcountryitemlist,0,3).substr($hcountryitemlist,-3);
                                    }?>">
                                    <span class="checkmark"></span>
                                </label>                                    
                                <?php                                         
                                    } 
                                ?>                        
                            <div class="checktopbottom"></div>
                        </div>

                    </div>
                    
                    <div class="tab">
                        <input id="tab-five" type="checkbox">
                        <label for="tab-five"><strong>Sport Organizations</strong></label>

                        <div class="tab-content">
                            <div class="checktopbottom"></div>  
                                <?php 
                                    foreach ($sporgarray as $sporgitemlist) {
                                ?>                                    
                                <label class="checkcontainer"><?php echo $sporgitemlist; ?>
                                    <span class="countright">(<?php                                                      
                                            $It = $stfIt->stfItemCountSporg($sporgitemlist); echo $It; ?>)                                    
                                    </span>
                                       <input type="checkbox" id="<?php echo $sporgitemlist; ?>" <?php
                                        if ($sporgitemlist == 'All Sport Orgs') {?>
                                            onClick="uncheck(<?php echo $sporgsuncheck; ?>);" 
                                            <?php } else { ?>
                                            onClick="uncheck('All Sport Orgs');"
                                        <?php } foreach ($sporg as $sporgsel) {
                                                    if ($sporgitemlist == $sporgsel) {?>
                                                        checked="checked"
                                        <?php }} ?> value="<?php echo $sporgitemlist; ?>"
                                        name="<?php if (substr($sporgitemlist,0,3) == "All") {
                                                        echo "itg".substr($sporgitemlist,0,3).substr($sporgitemlist,4,3); } else {
                                                            echo "it".substr($sporgitemlist,0,3).substr($sporgitemlist,-3);
                                    }?>">
                                    <span class="checkmark"></span>
                                </label>                                    
                                <?php                                         
                                    } 
                                ?>                        
                            <div class="checktopbottom"></div>
                        </div>

                    </div>
                    
                    <div class="tab">
                        <input id="tab-six" type="checkbox">
                        <label for="tab-six"><strong>International Federations</strong></label>

                        <div class="tab-content">
                            <div class="checktopbottom"></div>  
                                <?php 
                                    foreach ($ifarray as $ifitemlist) {
                                ?>                                    
                                <label class="checkcontainer"><?php echo $ifitemlist; ?>
                                    <span class="countright">(<?php                                                      
                                            $It = $stfIt->stfItemCountIf($ifitemlist); echo $It; ?>)                                    
                                    </span>
                                       <input type="checkbox" id="<?php echo $ifitemlist; ?>" <?php
                                        if ($ifitemlist == 'All Int. Federations') {?>
                                            onClick="uncheck(<?php echo $ifsuncheck; ?>);" 
                                            <?php } else { ?>
                                            onClick="uncheck('All Int. Federations');"
                                        <?php } foreach ($intfed as $ifsel) {
                                                    if ($ifitemlist == $ifsel) {?>
                                                        checked="checked"
                                        <?php }} ?> value="<?php echo $ifitemlist; ?>"
                                        name="<?php if (substr($ifitemlist,0,3) == "All") {
                                                        echo "it".substr($ifitemlist,0,3).substr($ifitemlist,4,3); } else {
                                                            echo "it".substr($ifitemlist,0,3).substr($ifitemlist,-3);
                                    }?>">
                                    <span class="checkmark"></span>
                                </label>                                    
                                <?php                                         
                                    } 
                                ?>                        
                            <div class="checktopbottom"></div>
                        </div>

                    </div>
                    
                    <div class="tab">
                        <input id="tab-seven" type="checkbox">
                        <label for="tab-seven">Advanced Search</label>

                        <div class="tab-content">
                            <div class="checktopbottom"></div> 
                                <div class="advsearchlabel">Event Type:</div> 
                                <?php 
                                    foreach ($eventtypearray as $eventtypeitemlist) {
                                ?>                                    
                                <label class="checkcontainer"><?php echo $eventtypeitemlist; ?>
                                    <span class="countright">(<?php                                                      
                                            $It = $stfIt->stfItemCountEventType($eventtypeitemlist); echo $It; ?>)                                    
                                    </span>
                                       <input type="checkbox" id="<?php echo "adv".$eventtypeitemlist; ?>" <?php
                                        if ($eventtypeitemlist == 'All Events') {?>
                                            onClick="uncheck(<?php echo $eventtypesuncheck; ?>);" 
                                        <?php } else { ?>
                                            onClick="uncheck('advAll Events');"
                                        <?php } foreach ($eventtype as $eventtypesel) {
                                                    if ($eventtypeitemlist == $eventtypesel) {?>
                                                        checked="checked"
                                        <?php }} ?> value="<?php echo $eventtypeitemlist; ?>"
                                        name="<?php if (substr($eventtypeitemlist,0,3) == "All") {
                                                        echo "ite".substr($eventtypeitemlist,0,3).substr($eventtypeitemlist,4,3);                                                         
                                                    } else {
                                                        echo "it".substr($eventtypeitemlist,0,3).substr($eventtypeitemlist,-3);
                                                    }?>">
                                    <span class="checkmark"></span>
                                </label>                                    
                                <?php                                         
                                    } 
                                ?>
                                <div class="checktopbottom"></div>
                                <div class="advsearchlabel">Season Sport Type:</div> 
                                <?php 
                                    foreach ($seasonarray as $seasonitemlist) {
                                ?>                                    
                                <label class="checkcontainer"><?php echo $seasonitemlist; ?>
                                    <span class="countright">(<?php                                                      
                                            $It = $stfIt->stfItemCountSeason($seasonitemlist); echo $It; ?>)                                    
                                    </span>
                                       <input type="checkbox" id="<?php echo "adv".$seasonitemlist; ?>" <?php
                                        if ($seasonitemlist == 'All Sport Seasons') {?>
                                            onClick="uncheck(<?php echo $seasonsuncheck; ?>);" 
                                        <?php } else { ?>
                                            onClick="uncheck('advAll Sport Seasons');"
                                        <?php } foreach ($season as $seasonsel) {
                                                    if ($seasonitemlist == $seasonsel) {?>
                                                        checked="checked"
                                        <?php }} ?> value="<?php echo $seasonitemlist; ?>"
                                        name="<?php if (substr($seasonitemlist,0,3) == "All") {
                                                        echo "its".substr($seasonitemlist,0,3).substr($seasonitemlist,4,3);                                                         
                                                    } else {
                                                        echo "it".substr($seasonitemlist,0,3).substr($seasonitemlist,-3);
                                                    }?>">
                                    <span class="checkmark"></span>
                                </label>                                    
                                <?php                                         
                                    } 
                                ?>
                                <div class="checktopbottom"></div>
                                <div class="advsearchlabel">Olympic/Paralympic:</div> 
                                <?php 
                                    foreach ($olyplyarray as $olyplyitemlist) {
                                ?>                                    
                                <label class="checkcontainer"><?php echo $olyplyitemlist; ?>
                                    <span class="countright">(<?php                                                      
                                            $It = $stfIt->stfItemCountOlyply($olyplyitemlist); echo $It; ?>)                                    
                                    </span>
                                       <input type="checkbox" id="<?php echo "adv".$olyplyitemlist; ?>" <?php
                                        if ($olyplyitemlist == 'All Sports') {?>
                                            onClick="uncheck(<?php echo $olyplysuncheck; ?>);" 
                                        <?php } else { ?>
                                            onClick="uncheck('advAll Sports');"
                                        <?php } foreach ($olyply as $olyplysel) {
                                                    if ($olyplyitemlist == $olyplysel) {?>
                                                        checked="checked"
                                        <?php }} ?> value="<?php echo $olyplyitemlist; ?>"
                                        name="<?php if (substr($olyplyitemlist,0,3) == "All") {
                                                        echo "ito".substr($olyplyitemlist,0,3).substr($olyplyitemlist,4,3);                                                         
                                                    } else {
                                                        echo "it".substr($olyplyitemlist,0,3).substr($olyplyitemlist,-3);
                                                    }?>">
                                    <span class="checkmark"></span>
                                </label>                                    
                                <?php                                         
                                    } 
                                ?>
                                <div class="checktopbottom"></div>
                                <div class="advsearchlabel">Competition Genre:</div> 
                                <?php 
                                    foreach ($genrearray as $genreitemlist) {
                                ?>                                    
                                <label class="checkcontainer"><?php echo $genreitemlist; ?>
                                    <span class="countright">(<?php                                                      
                                            $It = $stfIt->stfItemCountGenre($genreitemlist); echo $It; ?>)                                    
                                    </span>
                                       <input type="checkbox" id="<?php echo "adv".$genreitemlist; ?>" <?php
                                        if ($genreitemlist == 'All Genres') {?>
                                            onClick="uncheck(<?php echo $genresuncheck; ?>);" 
                                        <?php } else { ?>
                                            onClick="uncheck('advAll Genres');"
                                        <?php } foreach ($genre as $genresel) {
                                                    if ($genreitemlist == $genresel) {?>
                                                        checked="checked"
                                        <?php }} ?> value="<?php echo $genreitemlist; ?>"
                                        name="<?php if (substr($genreitemlist,0,3) == "All") {
                                                        echo "it".substr($genreitemlist,0,3).substr($genreitemlist,4,3);                                                         
                                                    } else {
                                                        echo "it".substr($genreitemlist,0,3).substr($genreitemlist,-3);
                                                    }?>">
                                    <span class="checkmark"></span>
                                </label>                                    
                                <?php                                         
                                    } 
                                ?>
                                <div class="checktopbottom"></div>
                                <div class="advsearchlabel">Event Tickets:</div> 
                                <?php 
                                    foreach ($ticketarray as $ticketitemlist) {
                                ?>                                    
                                <label class="checkcontainer"><?php echo $ticketitemlist; ?>
                                    <span class="countright">(<?php                                                      
                                            $It = $stfIt->stfItemCountTicket($ticketitemlist); echo $It; ?>)                                    
                                    </span>
                                       <input type="checkbox" id="<?php echo "advt".$ticketitemlist; ?>" <?php
                                        if ($ticketitemlist == 'All Events') {?>
                                            onClick="uncheck(<?php echo $ticketsuncheck; ?>);" 
                                        <?php } else { ?>
                                            onClick="uncheck('advtAll Events');"
                                        <?php } foreach ($ticket as $ticketsel) {
                                                    if ($ticketitemlist == $ticketsel) {?>
                                                        checked="checked"
                                        <?php }} ?> value="<?php echo $ticketitemlist; ?>"
                                        name="<?php if (substr($ticketitemlist,0,3) == "All") {
                                                        echo "itt".substr($ticketitemlist,0,3).substr($ticketitemlist,4,3);                                                         
                                                    } else {
                                                        echo "it".substr($ticketitemlist,0,3).substr($ticketitemlist,-3);
                                                    }?>">
                                    <span class="checkmark"></span>
                                </label>                                    
                                <?php                                         
                                    } 
                                ?>
                                <div class="checktopbottom"></div>
                                <div class="advsearchlabel">Web Live Stream:</div> 
                                <?php 
                                    foreach ($streamarray as $streamitemlist) {
                                ?>                                    
                                <label class="checkcontainer"><?php echo $streamitemlist; ?>
                                    <span class="countright">(<?php                                                      
                                            $It = $stfIt->stfItemCountStream($streamitemlist); echo $It; ?>)                                    
                                    </span>
                                       <input type="checkbox" id="<?php echo "advl".$streamitemlist; ?>" <?php
                                        if ($streamitemlist == 'All Events') {?>
                                            onClick="uncheck(<?php echo $streamsuncheck; ?>);" 
                                        <?php } else { ?>
                                            onClick="uncheck('advlAll Events');"
                                        <?php } foreach ($livestream as $streamsel) {                                                    
                                                    if ($streamitemlist == $streamsel) {?>
                                                        checked="checked"
                                        <?php }} ?> value="<?php echo $streamitemlist; ?>"
                                        name="<?php if (substr($streamitemlist,0,3) == "All") {
                                                        echo "itw".substr($streamitemlist,0,3).substr($streamitemlist,4,3);                                                         
                                                    } else {
                                                        echo "it".substr($streamitemlist,0,3).substr($streamitemlist,-3);
                                                    }?>">
                                    <span class="checkmark"></span>
                                </label>                                    
                                <?php                                         
                                    } 
                                ?>
                            <div class="checktopbottom"></div>
                        </div>

                    </div>

                    <div class="submitside">
                        <input type="submit" class="submitsidebutton" name="submit-cont" value="Search">
                    </div>

                </form>

                <div class="pagefooter">
                    <p><strong>Copyright 2018 by SPORTOFOLLOW</strong></p>
                </div>
                
            </div>        
            
            <!-- Result page right side - Report -->
            
            <div class='column stftablecontainer'>
                
                <form action="" method="POST">
                <input type="hidden" name="sqlqueryi" value="<?php echo $stfsql; ?>">

                <div class="stfrestabh">
                    <div class="stfrestabrowh">
                        <div class="stfrestabcell col1"></div>
                        <div class="stfrestabcell col2">
                            <div class="tablet"><div class="rowt">
                                <div class="cellt labelleft c1">Year</div>
                                <div class="cellt labelright c1">
                                    <div class="tablet">
                                        <div class="rowt"><div class="cellt">
                                            <input class="button-up" type="submit" name="submit-yearasc">
                                        </div></div>
                                        <div class="rowt"><div class="cellt">
                                            <input class="button-down" type="submit" name="submit-yeardesc">
                                        </div></div>
                                    </div>
                                </div>
                            </div></div>
                        </div>
                        <div class="stfrestabcell col3">
                            <div class="tablet"><div class="rowt">
                                <div class="cellt labelleft c2">Period</div>
                                <div class="cellt labelright c2">
                                    <div class="tablet">
                                        <div class="rowt"><div class="cellt">
                                            <input class="button-up" type="submit" name="submit-periodasc">
                                        </div></div>
                                        <div class="rowt"><div class="cellt">
                                            <input class="button-down" type="submit" name="submit-perioddesc">
                                        </div></div>
                                    </div>
                                </div>
                            </div></div>
                        </div>
                        <div class="stfrestabcell eventtypename col4">
                            <div class="tablet"><div class="rowt">
                                <div class="cellt labelleft c3">Event Type/Event Name</div>
                                <div class="cellt labelright c3">
                                    <div class="tablet">
                                        <div class="rowt"><div class="cellt">
                                            <input class="button-up" type="submit" name="submit-enameasc">
                                        </div></div>
                                        <div class="rowt"><div class="cellt">
                                            <input class="button-down" type="submit" name="submit-enamedesc">
                                        </div></div>
                                    </div>
                                </div>
                            </div></div>
                        </div>
                        <div class="stfrestabcell col5">
                            <div class="tablet"><div class="rowt">
                                <div class="cellt labelleft c4">Sport</div>
                                <div class="cellt labelright c4">
                                    <div class="tablet">
                                        <div class="rowt"><div class="cellt">
                                            <input class="button-up" type="submit" name="submit-sportasc">
                                        </div></div>
                                        <div class="rowt"><div class="cellt">
                                            <input class="button-down" type="submit" name="submit-sportdesc">
                                        </div></div>
                                    </div>
                                </div>
                            </div></div>
                        </div>                       
                        <div class="stfrestabcell col6">
                            <div class="tablet"><div class="rowt">
                                <div class="cellt labelleft c5">City</div>
                                <div class="cellt labelright c5">
                                    <div class="tablet">
                                        <div class="rowt"><div class="cellt">
                                            <input class="button-up" type="submit" name="submit-cityasc">
                                        </div></div>
                                        <div class="rowt"><div class="cellt">
                                            <input class="button-down" type="submit" name="submit-citydesc">
                                        </div></div>
                                    </div>
                                </div>
                            </div></div>
                        </div>
                        <div class="stfrestabcell col7">
                            <div class="tablet"><div class="rowt">
                                <div class="cellt labelleft c6">Country</div>
                                <div class="cellt labelright c6">
                                    <div class="tablet">
                                        <div class="rowt"><div class="cellt">
                                            <input class="button-up" type="submit" name="submit-countryasc">
                                        </div></div>
                                        <div class="rowt"><div class="cellt">
                                            <input class="button-down" type="submit" name="submit-countrydesc">
                                        </div></div>
                                    </div>
                                </div>
                            </div></div>
                        </div>
                        <div class="stfrestabcell col8">Ticket</div>                        
                        <div class="stfrestabcell col9">Web Live Streaming</div>
                    </div>
                    
                </div>
                
                </form>
                
                <div class="stfrestabfline">
                </div>
                
                <div class="stfrestab">
                
                <?php

                    if ($queryResult > 0){
                            while ($row = mysqli_fetch_assoc($result)){
                                $stfsqlflags = "SELECT LOWER(COUNTRY_FLAG) FROM STF_COUNTRY WHERE NAME = '";
                                $stfsqlflag = $stfsqlflags.$row['HOST_COUNTRY']."'";
                                $resultflag = mysqli_query($stfConn, $stfsqlflag);
                                $rowflag = mysqli_fetch_assoc($resultflag);
                                
                                $stfsqlsporg = "SELECT * FROM STF_SPORT_ORGANIZATION WHERE ACRONYM = '";
                                $stfsqlsporg = $stfsqlsporg.$row['SPORT_ORG']."'";
                                $resultsporg = mysqli_query($stfConn, $stfsqlsporg);
                                $rowsporg = mysqli_fetch_assoc($resultsporg);
                                
                ?>
                    
                    <div class="stfrestabrow">
                        <input class="stfresultinput" id="tab-<?php echo $row['ID_EVENTS']; ?>" type="checkbox" name="tabs">
                        <label class="stfresultlabel" for="tab-<?php echo $row['ID_EVENTS']; ?>">
                            <div class="stfrestab">
                                <div class="stfrestabrow">
                                    <div class="stfrestabcell col1"></div>
                                    <div class="stfrestabcell col2">
                                        <?php
                                            $dtybegin = date_format(date_create($row['DT_BEGIN']), 'Y');
                                            if($dtybegin % 2){?>
                                                <div class="coldty evenyear"><?php echo $dtybegin; ?></div>
                                            <?php } else { ?>
                                                <div class="coldty oddyear"><?php echo $dtybegin; ?></div>
                                            <?php
                                            }
                                        ?>
                                    </div>                                                
                                    <div class="stfrestabcell col3">
                                        <div class="stfdatetab dtbegin">
                                            <div class="stfdatetabrow">
                                                <div class="stfdatetabcell datedia">
                                                    <?php echo date_format(date_create($row['DT_BEGIN']), 'd'); ?>
                                                </div>                                                
                                            </div>
                                            <div class="stfdatetabrow">
                                                <div class="stfdatetabcell datemonth">
                                                    <?php echo date_format(date_create($row['DT_BEGIN']), 'M'); ?>
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="stfdatetab dtend">
                                            <div class="stfdatetabrow">
                                                <div class="stfdatetabcell datedia">
                                                    <?php echo date_format(date_create($row['DT_END']), 'd'); ?>
                                                </div>                                                
                                            </div>
                                            <div class="stfdatetabrow">
                                                <div class="stfdatetabcell datemonth">
                                                    <?php echo date_format(date_create($row['DT_END']), 'M'); ?>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stfrestabcell coline col4">
                                        <strong><?php echo $row['NAME_CHAMPIONSHIP']; ?></strong>
                                        <br><?php 
                                                $nameeventstr = $row['NAME_EVENT'];
                                                $limit = 40;
                                                if (strlen($nameeventstr) > $limit) {
                                                    echo substr($nameeventstr, 0, $limit) . "...";
                                                } else {
                                                    echo $nameeventstr;
                                                }
                                            ?>
                                    </div>
                                    <div class="stfrestabcell colsport col5">
                                        <?php echo $row['SPORT_NAME']; ?>                                        
                                    </div>                       
                                    <div class="stfrestabcell col6">
                                        <?php
                                           
                                            $hcitystr = $row['HOST_CITY'];
                                            if ($hcitystr == "Multi-Cities") {
                                                $hcitystr = $row['HOST_COUNTRY'];
                                            }
                                            $hcityarr = str_split($hcitystr);
                                            $hcity = "https://www.google.de/maps/place/";
                                            foreach ($hcityarr as $hcitycar) {
                                                if ($hcitycar == " ") {
                                                    $hcity = $hcity."+";
                                                } else {
                                                    $hcity = $hcity.$hcitycar;
                                                }
                                            }
                                        ?>
                                        <a class="stfmaplink" href="<?php echo $hcity; ?>" target="_blank">
                                        <img class='stfmapimg' src='./images/mapmarker.png' title='Google Maps'>
                                        <br><?php echo $row['HOST_CITY']; ?>
                                        </a>
                                    </div>
                                    <div class="stfrestabcell col7">
                                        <img class='flags' src='./images/flags/<?php echo $rowflag['LOWER(COUNTRY_FLAG)']; ?>.png' title='<?php echo $row['HOST_COUNTRY']; ?>'>
                                    </div> 
                                    <div class="stfrestabcell col8">
                                        <?php
                                            if ($row['TICKET'] == "Buy") { ?>
                                                <a class="stfmaplink" href="<?php echo $row['LINK_TICKET']; ?>" target="_blank">
                                                <div class = "tktcol tbuy">BUY</div>
                                                </a>
                                            <?php } else if ($row['TICKET'] == "Free") { ?>                                                
                                                <div class = "tktcol tfree">FREE</div>
                                            <?php } else if ($row['TICKET'] == "Closed") { ?>                                                
                                                <div class = "tktcol tclosed">CLOSED</div>
                                            <?php } else { ?>                                                
                                                <div class = "tktcol tndef">NOTDEF</div>
                                            <?php
                                            }
                                        ?>
                                    </div> 
                                    <div class="stfrestabcell col9">
                                        <div class="stfstreamtab">
                                            <div class="stfstreamrow">
                                                <?php if ($row['LINK_OS_STREAM'] != "") { ?>
                                                    <div class="stfstreamcell">
                                                            <a class="stfmaplink" href="<?php echo $row['LINK_OS_STREAM']; ?>" target="_blank">
                                                            <div class="stfstreambox bx1">
                                                                <?php                                                            
                                                                    if ($row['SPORT_NAME'] == "Multi-sports") { ?>
                                                                        <img class='stfstreamimg' src='./images/stfwebtvic.png' title='WebTV International Federation'>
                                                                    <?php } else { ?>
                                                                        <img class='stfstreamimg' src='./images/stfwebtvif.png' title='WebTV Sport Organization'>
                                                                    <?php }
                                                                ?>
                                                            </div>
                                                            </a>
                                                    </div>
                                                <?php } if ($row['LINK_PP_STREAM'] != "") { ?>
                                                <div class="stfstreamcell">
                                                    <a class="stfmaplink" href="<?php echo $row['LINK_PP_STREAM']; ?>" target="_blank">
                                                    <div class="stfstreambox bx2">
                                                        <img class='stfstreamimg' src='./images/stfwebtvpp.png' title='WebTV On Demand'>
                                                    </div>
                                                    </a>
                                                </div>
                                                <?php } if ($row['LINK_FB_STREAM'] != "") { ?>
                                                <div class="stfstreamcell">
                                                    <a class="stfmaplink" href="<?php echo $row['LINK_FB_STREAM']; ?>" target="_blank">
                                                    <div class="stfstreambox bx3">
                                                        <img class='stfstreamimg' src='./images/stffbtv.png' title='Live On Facebbok'>
                                                    </div>
                                                    </a>
                                                </div>
                                                <?php } if ($row['LINK_YT_STREAM'] != "") { ?>
                                                <div class="stfstreamcell">
                                                    <a class="stfmaplink" href="<?php echo $row['LINK_YT_STREAM']; ?>" target="_blank">
                                                    <div class="stfstreambox bx4">
                                                        <img class='stfstreamimg' src='./images/stfyttv.png' title='Live On Youtube'>
                                                    </div>
                                                    </a>
                                                </div>
                                                <?php } if ($row['LINK_TW_STREAM'] != "") { ?>
                                                <div class="stfstreamcell">
                                                    <a class="stfmaplink" href="<?php echo $row['LINK_TW_STREAM']; ?>" target="_blank">
                                                    <div class="stfstreambox bx5">
                                                        <img class='stfstreamimg' src='./images/stftwtv.png' title='Live On Twitter'>
                                                    </div>
                                                    </a>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div> 
                                </div>                                                       
                            </div>
                        </label>
                        <div class="stfrestabrowhi">
                            <div class="stfrestabhidden">
                                <div class="stfrestabrowhidden headerhidden">
                                    <div class="stfrestabcell col11"></div> 
                                    <div class="stfrestabcell colhid col21">Event Type</div>
                                    <div class="stfrestabcell colhid col31">Coverage</div>
                                    <div class="stfrestabcell colhid col41">Genre</div>
                                    <div class="stfrestabcell colhid col51">Sport Season</div>
                                    <div class="stfrestabcell colhid col61">Oly/Ply</div>
                                    <?php if ($row['SPORT_NAME'] == "Multi-sports") { ?>
                                            <div class="stfrestabcell colhid col71">Sport Organization</div>
                                            <div class="stfrestabcell colhid col81">Event OC</div>
                                        <?php } else { ?>
                                            <div class="stfrestabcell colhid col71">Sport IF</div>
                                            <div class="stfrestabcell colhid col81">IF Agenda</div>
                                        <?php }
                                    ?>
                                </div>
                                <div class="stfrestabrowhidden">
                                    <div class="stfrestabcell col11"></div> 
                                    <div class="stfrestabcell colhid col21"><?php echo $row['TYPE_EVENT']; ?></div>
                                    <div class="stfrestabcell colhid col31"><?php echo $row['EVENT_COVERAGE']; ?></div>
                                    <div class="stfrestabcell colhid col41"><?php echo $row['EVENT_GENRE']; ?></div>
                                    <div class="stfrestabcell colhid col51"><?php echo $row['SEASON_SPORT_TYPE']; ?></div>
                                    <div class="stfrestabcell colhid col61"><?php echo $row['SPORT_OLY_PLY_OTH']; ?></div>
                                    <div class="stfrestabcell colhid col71">
                                        <a class="stfmaplink" href="<?php echo $rowsporg['WEBSITE']; ?>" target="_blank" title="<?php echo $rowsporg['SPORT_ORG_NAME']; ?>" >
                                        <img class='stflinkwebsite' src='./images/stflinkicon.png' title='IF Website'>
                                        <?php echo $row['SPORT_ORG']; ?>
                                        </a>
                                    </div>
                                    <div class="stfrestabcell colhid col81">
                                        <?php if ($row['SPORT_NAME'] == "Multi-sports" or $row['LINK_EVENTORG'] != '') { ?>
                                            <a class="stfmaplink" href="<?php echo $row['LINK_EVENTORG']; ?>" target="_blank" >
                                            <img class='stflinkwebsite' src='./images/stflinkicon.png' title='OC Website'>                                        
                                            OCOG
                                            </a>
                                        <?php } else { ?>
                                            <a class="stfmaplink" href="<?php echo $rowsporg['WEBSITE_AGENDA']; ?>" target="_blank" >
                                            <img class='stflinkwebsite' src='./images/stflinkicon.png' title='OC Website'>                                        
                                            IF Agenda
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>                                                       
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }         
                    ?>
                </div>
                
            </div>

        </div>
        
        <script>
            $(function(){
                $('#sandbox-container input').datepicker({
                    format: "yyyy-mm-dd",
                    todayBtn: "linked",
                    orientation: "bottom auto",
                    todayHighlight: true
                });
            })
        </script>
        
     </body>
</html>
   