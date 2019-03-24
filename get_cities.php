<?php
    include_once 'Stfconn.php';
    
    if (!empty($_POST["country_code"])) {
            $query = "SELECT id_city, name FROM stf_city WHERE stf_city.country_code = '" . $_POST["country_code"] . "' ORDER BY name";
            $results = mysqli_query($stfConn, $query);

            foreach($results as $state) {
            ?>
                <option value="<?php echo $state["id_city"]; ?>"><?php echo $state["name"]; ?></option>
            <?php
            }
    }
?>