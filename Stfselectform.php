<?php

include_once 'Stfconn.php';

class Stfselectform {
    
    function stfYearSelect() {
        
        $stfConn = Stfconn();
        
        $sqlYear = "SELECT YEAR(DT_BEGIN) FROM STF_FT_EVENT GROUP BY YEAR(DT_BEGIN)";
        $resultYear = mysqli_query($stfConn, $sqlYear);
        $queryResultYear = mysqli_num_rows($resultYear);
 
        if ($queryResultYear > 0) {
            $k = 0;
            while($rowYear = mysqli_fetch_assoc($resultYear)) {
                $tableYear[$k] = $rowYear["YEAR(DT_BEGIN)"];
                $k++;
            }
        }
        return $tableYear;
    }
    
    function stfSportSelect() {
        
        $stfConn = Stfconn();
        
        $sqlSport = "SELECT SPORT_NAME FROM STF_FT_EVENT GROUP BY SPORT_NAME";
        $resultSport = mysqli_query($stfConn, $sqlSport);
        $queryResultSport = mysqli_num_rows($resultSport);
 
        if ($queryResultSport > 0) {
            $i = 0;
            while($rowSport = mysqli_fetch_assoc($resultSport)) {
                $tableSport[$i] = $rowSport["SPORT_NAME"];
                $i++;
            }
        }
        return $tableSport;
    }
    
    function stfCoverageSelect() {
        
        $stfConn = Stfconn();
        
        $sqlCoverage = "SELECT EVENT_COVERAGE FROM STF_FT_EVENT GROUP BY EVENT_COVERAGE";
        $resultCoverage = mysqli_query($stfConn, $sqlCoverage);
        $queryResultCoverage = mysqli_num_rows($resultCoverage);
 
        if ($queryResultCoverage > 0) {
            $y = 0;
            while($rowCoverage = mysqli_fetch_assoc($resultCoverage)) {
                $tableCoverage[$y] = $rowCoverage["EVENT_COVERAGE"];
                $y++;
            }
        }
        return $tableCoverage;
    }
    
    function stfHcountrySelect() {
        
        $stfConn = Stfconn();
        
        $sqlHcountry = "SELECT HOST_COUNTRY FROM STF_FT_EVENT GROUP BY HOST_COUNTRY";
        $resultHcountry = mysqli_query($stfConn, $sqlHcountry);
        $queryResultHcountry = mysqli_num_rows($resultHcountry);
 
        if ($queryResultHcountry > 0) {
            $z = 0;
            while($rowHcountry = mysqli_fetch_assoc($resultHcountry)) {
                $tableHcountry[$z] = $rowHcountry["HOST_COUNTRY"];
                $z++;
            }
        }
        return $tableHcountry;
    }
    
    function stfIfSelect() {
        
        $stfConn = Stfconn();
        
        $sqlIf = "SELECT SPORT_ORG FROM STF_FT_EVENT INNER JOIN STF_SPORT_ORGANIZATION
                    WHERE STF_FT_EVENT.SPORT_ORG = STF_SPORT_ORGANIZATION.ACRONYM
                    AND STF_SPORT_ORGANIZATION.TYPE = 'IF' GROUP BY SPORT_ORG";
        $resultIf = mysqli_query($stfConn, $sqlIf);
        $queryResultIf = mysqli_num_rows($resultIf);
 
        if ($queryResultIf > 0) {
            $z = 0;
            while($rowIf = mysqli_fetch_assoc($resultIf)) {
                $tableIf[$z] = $rowIf["SPORT_ORG"];
                $z++;
            }
        }
        return $tableIf;
    }
    
    function stfSporgSelect() {
        
        $stfConn = Stfconn();
        
        $sqlSporg = "SELECT SPORT_ORG FROM STF_FT_EVENT INNER JOIN STF_SPORT_ORGANIZATION
                    WHERE STF_FT_EVENT.SPORT_ORG = STF_SPORT_ORGANIZATION.ACRONYM
                    AND STF_SPORT_ORGANIZATION.TYPE = 'SO' GROUP BY SPORT_ORG";
        $resultSporg = mysqli_query($stfConn, $sqlSporg);
        $queryResultSporg = mysqli_num_rows($resultSporg);
 
        if ($queryResultSporg > 0) {
            $z = 0;
            while($rowSporg = mysqli_fetch_assoc($resultSporg)) {
                $tableSporg[$z] = $rowSporg["SPORT_ORG"];
                $z++;
            }
        }
        return $tableSporg;
    }
    
    function stfItemCount($stfItem) {
        
        $stfConn = Stfconn();
        
        if (substr($stfItem,0,3) == "All") {
            $sqlylc = "SELECT COUNT(*) FROM `STF_FT_EVENT`";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        } else {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT WHERE YEAR(DT_BEGIN) = '".$stfItem."'";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        }
        
        return $stfItemC;
    }
    
    function stfItemCountSport($stfItem) {
        
        $stfConn = Stfconn();
        
        if (substr($stfItem,0,3) == "All") {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        } else {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT WHERE SPORT_NAME = '".$stfItem."'";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        }
        
        return $stfItemC;
    }
    
    function stfItemCountCoverage($stfItem) {
        
        $stfConn = Stfconn();
        
        if (substr($stfItem,0,3) == "All") {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        } else {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT WHERE EVENT_COVERAGE = '".$stfItem."'";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        }
        
        return $stfItemC;
    }
    
    function stfItemCountHcountry($stfItem) {
        
        $stfConn = Stfconn();
        
        if (substr($stfItem,0,3) == "All") {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        } else {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT WHERE HOST_COUNTRY = '".$stfItem."'";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        }
        
        return $stfItemC;
    }
    
    function stfItemCountSporg($stfItem) {
        
        $stfConn = Stfconn();
        
        if (substr($stfItem,0,3) == "All") {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT INNER JOIN STF_SPORT_ORGANIZATION
                    WHERE STF_FT_EVENT.SPORT_ORG = STF_SPORT_ORGANIZATION.ACRONYM
                    AND STF_SPORT_ORGANIZATION.TYPE = 'SO'";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        } else {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT INNER JOIN STF_SPORT_ORGANIZATION
                    WHERE STF_FT_EVENT.SPORT_ORG = STF_SPORT_ORGANIZATION.ACRONYM
                    AND STF_SPORT_ORGANIZATION.TYPE = 'SO' AND STF_FT_EVENT.SPORT_ORG = '".$stfItem."'";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        }
        
        return $stfItemC;
    }
    
    function stfItemCountIf($stfItem) {
        
        $stfConn = Stfconn();
        
        if (substr($stfItem,0,3) == "All") {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT INNER JOIN STF_SPORT_ORGANIZATION
                    WHERE STF_FT_EVENT.SPORT_ORG = STF_SPORT_ORGANIZATION.ACRONYM
                    AND STF_SPORT_ORGANIZATION.TYPE = 'IF'";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        } else {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT INNER JOIN STF_SPORT_ORGANIZATION
                    WHERE STF_FT_EVENT.SPORT_ORG = STF_SPORT_ORGANIZATION.ACRONYM
                    AND STF_SPORT_ORGANIZATION.TYPE = 'IF' AND STF_FT_EVENT.SPORT_ORG = '".$stfItem."'";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        }
        
        return $stfItemC;
    }
    
    function stfItemCountEventType($stfItem) {
        
        $stfConn = Stfconn();
        
        if (substr($stfItem,0,3) == "All") {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        } else {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT WHERE TYPE_EVENT = '".$stfItem."'";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        }
        
        return $stfItemC;
    }
    
    function stfItemCountSeason($stfItem) {
        
        $stfConn = Stfconn();
        
        if (substr($stfItem,0,3) == "All") {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        } else {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT WHERE SEASON_SPORT_TYPE = '".$stfItem."'";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        }
        
        return $stfItemC;
    }
    
    function stfItemCountOlyply($stfItem) {
        
        $stfConn = Stfconn();
        
        if (substr($stfItem,0,3) == "All") {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        } else {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT WHERE SPORT_OLY_PLY_OTH = '".$stfItem."'";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        }
        
        return $stfItemC;
    }
    
    function stfItemCountGenre($stfItem) {
        
        $stfConn = Stfconn();
        
        if (substr($stfItem,0,3) == "All") {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        } else {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT WHERE EVENT_GENRE = '".$stfItem."'";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        }
        
        return $stfItemC;
    }
    
    function stfItemCountTicket($stfItem) {
        
        $stfConn = Stfconn();
        
        if (substr($stfItem,0,3) == "All") {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        } else {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT WHERE TICKET = '".$stfItem."'";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        }
        
        return $stfItemC;
    }
    
    function stfItemCountStream($stfItem) {
        
        $stfConn = Stfconn();
        
        if (substr($stfItem,0,3) == "All") {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        } else {
            $sqlylc = "SELECT COUNT(*) FROM STF_FT_EVENT WHERE LINK_OS_STREAM != '' "
                    . "OR LINK_PP_STREAM != '' OR LINK_FB_STREAM != '' OR LINK_YT_STREAM != '' "
                    . "OR LINK_TW_STREAM != ''";
            $resultylc = mysqli_query($stfConn, $sqlylc);
            $rowylc = mysqli_fetch_assoc($resultylc);
            $stfItemC = $rowylc['COUNT(*)'];
        }
        
        return $stfItemC;
    }
    
}
