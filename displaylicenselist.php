<?php

global $wpdb;

// Table name
$tablename = $wpdb->prefix . "customlicense";

// Delete record
if (isset($_GET['delid'])) {
  $delid = $_GET['delid'];
  $wpdb->query("DELETE FROM " . $tablename . " WHERE id=" . $delid);
}

// Import CSV
if (isset($_POST['csvImport'])) {

  // File extension
  $extension = pathinfo($_FILES['import_file']['name'], PATHINFO_EXTENSION);

  // If file extension is 'csv'
  if (!empty($_FILES['import_file']['name']) && $extension == 'csv') {

    $totalInserted = 0;

    // Open file in read mode
    $csvFile = fopen($_FILES['import_file']['tmp_name'], 'r');

    fgetcsv($csvFile); // Skipping header row

    // Read file
    while (($csvData = fgetcsv($csvFile)) !== FALSE) {
      $csvData = array_map("utf8_encode", $csvData);

      // Row column length
      $dataLen = count($csvData);

      // Skip row if length > 0
      if (!($dataLen > 0)) continue;

      // Assign value to variables
      $type = trim($csvData[0]);
      $firstname = trim($csvData[1]);
      $middlename = trim($csvData[2]);
      $lastname = trim($csvData[3]);
      $ssnfein = trim($csvData[4]);
      $npn = trim($csvData[5]);
      $birthdate = trim($csvData[6]);
      $costcenter = trim($csvData[7]);
      $profileid = trim($csvData[8]);
      $cestate = trim($csvData[9]);
      $statelicense = trim($csvData[10]);
      $residency = trim($csvData[11]);
      $licensetype = trim($csvData[12]);
      $licensenumber = trim($csvData[13]);
      $expirationdate = trim($csvData[14]);
      $effectivedate = trim($csvData[15]);
      $loadetail = trim($csvData[16]);
      $loaeffectivedate = trim($csvData[17]);
      $loacanceldate = trim($csvData[18]);
      $licensestatus = trim($csvData[19]);
      $appointmentstatus = trim($csvData[20]);
      $designatehomestate = trim($csvData[21]);
      $renewalflag = trim($csvData[22]);

      // Check record already exists or not
      $cntSQL = "SELECT count(*) as count FROM {$tablename} WHERE loadetail='" . $loadetail . "' ";
    
      $record = $wpdb->get_results($cntSQL, OBJECT);

      if ($record[0]->count == 0) {
        $insert_sql = "INSERT INTO " . $tablename . "(type,firstname,middlename,lastname,ssnfein,npn,birthdate,costcenter,profileid,cestate,statelicense,residency,licensetype,licensenumber,expirationdate,effectivedate,loadetail,loaeffectivedate,loacanceldate,licensestatus,appointmentstatus,designatehomestate,renewalflag) values('" . $type . "','" . $firstname . "','" . $middlename . "','" . $lastname . "','" . $ssnfein . "','" . $npn . "','" . $birthdate . "','" . $costcenter . "','" . $profileid . "','" . $cestate . "','" . $statelicense . "','" . $residency . "','" . $licensetype . "','" . $licensenumber . "','" . $expirationdate . "','" . $effectivedate . "','" . $loadetail . "','" . $loaeffectivedate . "','" . $loacanceldate .  "','" . $licensestatus . "','" . $appointmentstatus . "','" . $designatehomestate . "','" . $renewalflag . "')";
        $wpdb->query($insert_sql);

        if ($wpdb->insert_id > 0) {
          $totalInserted++;
        }
      }
    }
    echo "<h3 style='color: green;'>Total record Inserted : " . $totalInserted . "</h3>";
  } else {
    echo "<h3 style='color: red;'>Invalid Extension</h3>";
  }
}

?>
<h2>All Entries</h2>

<!-- Form -->
<form method='post' action='<?= $_SERVER['REQUEST_URI']; ?>' enctype='multipart/form-data'>
  <input type="file" name="import_file">
  <input type="submit" name="csvImport" value="Import">
</form>

<!-- Record List -->
<table width='100%' border='1' style='border-collapse: collapse;'>
  <thead>
    <tr>
      <th>SN</th>
      <th>TYPE</th>
      <th>FIRSTNAME</th>
      <th>MIDDLENAME</th>
      <th>LASTNAME</th>
      <th>SSNFEIN</th>
      <th>NPN</th>
      <th>BIRTHDATE</th>
      <th>COSTCENTER</th>
      <th>PROFILEID</th>
      <th>CESTATE</th>
      <th>STATELICENSE</th>
      <th>RESIDENCY</th>
      <th>LICENSETYPE</th>
      <th>LICENSENUMBER</th>
      <th>EXPIRATIONDATE</th>
      <th>EFFECTIVEDATE</th>
      <th>LOADETAIL</th>
      <th>LOAEFFECTIVEDATE</th>
      <th>LOACANCELDATE</th>
      <th>LICENSESTATUS</th>
      <th>APPOINTMENTSTATUS</th>
      <th>DESIGNATEHOMESTATE</th>
      <th>RENEWALFLAG</th>
      <th>ACTION</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Fetch records
    $licenceList = $wpdb->get_results("SELECT * FROM " . $tablename . " order by id asc");
    if (count($licenceList) > 0) {
      $count = 0;
      foreach ($licenceList as $license) {
        $id = $license->id;
        $type = $license->type;
        $firstname = $license->firstname;
        $middlename = $license->middlename;
        $lastname = $license->lastname;
        $ssnfein = $license->ssnfein;
        $npn = $license->npn;
        $birthdate = $license->birthdate;
        $costcenter = $license->costcenter;
        $profileid = $license->profileid;
        $cestate = $license->cestate;
        $statelicense = $license->statelicense;
        $residency = $license->residency;
        $licensetype = $license->licensetype;
        $licensenumber = $license->licensenumber;
        $expirationdate = $license->expirationdate;
        $effectivedate = $license->effectivedate;
        $loadetail = $license->loadetail;
        $loaeffectivedate = $license->loaeffectivedate;
        $loacanceldate = $license->loacanceldate;
        $licensestatus = $license->licensestatus;
        $appointmentstatus = $license->appointmentstatus;
        $designatehomestate = $license->designatehomestate;
        $renewalflag = $license->renewalflag;

        echo "<tr>
          <td>" . ++$count . "</td>
          <td>" . $type . "</td>
          <td>" . $firstname . "</td>
          <td>" . $middlename . "</td>
          <td>" . $lastname . "</td>
          <td>" . $ssnfein . "</td>
          <td>" . $npn . "</td>
          <td>" . $birthdate . "</td>
          <td>" . $costcenter . "</td>
          <td>" . $profileid . "</td>
          <td>" . $cestate . "</td>
          <td>" . $statelicense . "</td>
          <td>" . $residency . "</td>
          <td>" . $licensetype . "</td>
          <td>" . $licensenumber . "</td>
          <td>" . $expirationdate . "</td>
          <td>" . $effectivedate . "</td>
          <td>" . $loadetail . "</td>
          <td>" . $loaeffectivedate . "</td>
          <td>" . $loacanceldate . "</td>
          <td>" . $licensestatus . "</td>
          <td>" . $appointmentstatus . "</td>
          <td>" . $designatehomestate . "</td>
          <td>" . $renewalflag . "</td>
          <td><a href='?page=customlicense&delid=" . $id . "'>Delete</a></td>
        </tr>
        ";
      }
    } else {
      echo "<tr><td colspan='5'>No record found</td></tr>";
    }
    ?>
  </tbody>
</table>