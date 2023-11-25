<?php
// Fetch countries data from Rest Countries API
$countriesJson = file_get_contents('https://restcountries.com/v3.1/all');
$countries = json_decode($countriesJson, true);
?>