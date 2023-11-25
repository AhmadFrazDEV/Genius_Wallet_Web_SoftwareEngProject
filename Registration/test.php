<?php
// Fetch countries data from Rest Countries API
$countriesJson = file_get_contents('https://restcountries.com/v3.1/all');
$countries = json_decode($countriesJson, true);

// HTML for the select box
echo '<select name="countries" id="countries">';
echo '<option value="" selected disabled>Select a country</option>';

foreach ($countries as $country) {
    $countryName = $country['name']['common'];
    echo "<option value='$countryName'>$countryName</option>";
}

echo '</select>';
?>
