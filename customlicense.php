<?php

/*
Plugin Name: Custom License
Plugin URI: #
Description: #
Version: 0.1
Author: 
Author URI: 
*/

// Create a new table
function customlicense_table()
{

  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();

  $tablename = $wpdb->prefix . "customlicense";

  $sql = "CREATE TABLE $tablename (
    id mediumint(20) NOT NULL AUTO_INCREMENT,
    type varchar(80) NOT NULL,
    firstname varchar(80) NOT NULL,
    middlename varchar(80) NOT NULL,
    lastname varchar(80) NOT NULL,
    ssnfein varchar(80) NOT NULL,
    npn mediumint(20) NOT NULL,
    birthdate varchar(80) NOT NULL,
    costcenter varchar(80) NOT NULL,
    profileid varchar(80) NOT NULL,
    cestate varchar(80) NOT NULL,
    statelicense varchar(80) NOT NULL,
    residency varchar(80) NOT NULL,
    licensetype varchar(80) NOT NULL,
    licensenumber mediumint(20) NOT NULL,
    expirationdate varchar(80) NOT NULL,
    effectivedate varchar(80) NOT NULL,
    loadetail varchar(80) NOT NULL,
    loaeffectivedate varchar(80) NOT NULL,
    loacanceldate varchar(80) NOT NULL,
    licensestatus varchar(80) NOT NULL,
    appointmentstatus varchar(80) NOT NULL,
    designatehomestate varchar(80) NOT NULL,
    renewalflag varchar(80) NOT NULL,
    PRIMARY KEY (id)
   ) $charset_collate";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}
register_activation_hook(__FILE__, 'customlicense_table');

// Add menu
function customlicense_menu()
{

  add_menu_page("Custom License", "Custom License", "manage_options", "customlicense", "displayLicenseList", plugins_url('/customlicense/img/icon.png'));
}
add_action("admin_menu", "customlicense_menu");

function displayLicenseList()
{
  include "displaylicenselist.php";
}
