<?php
  session_start();
  // include db config
  include("../../config/user_config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ABOUT AUTHOR</title>
  
  <!-- cdn icon link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- css file -->
  <link rel="stylesheet" href="../../css/user_Style.css">
</head>

<body>
  <!-- USER HEADER SECTION STARTS HERE -->
  <?php include '../../includes/user_Header.php'; ?>
  <!-- USER HEADER SECTION ENDS HERE -->

  <!-- USER TOP NAV SECTION STARTS HERE -->
  <?php include '../../includes/user_topNav.php'; ?>
  <!-- USER TOP NAV SECTION ENDS HERE -->

  <!-- LOGIN POPUP SECTION STARTS HERE -->
  <?php include '../../auth/login_popup.php'; ?>
  <!-- LOGIN POPUP SECTION ENDS HERE -->

  <!-- REGISTER POPUP SECTION STARTS HERE -->
  <?php include '../../auth/register_popup.php'; ?>
  <!-- REGISTER POPUP SECTION ENDS HERE -->

  <?php
    // php variables for author's bioadata
    $name = "Muhammad Hisyam Bin Maslan";
    $matnum = "BI22110280";
    $birthDate = "19th August 2002";
    $age = "22";
    $hometown = "Kota Marudu, Sabah";

    // php variables for author's education background
    $highSchool = "Sekolah Menengah Kebangsaan Pantai, International Baccalaureate World School,
                   Wilayah Persekutuan Labuan";
    $uni = "Universiti Malaysia Sabah, Kota Kinabalu, Sabah";
    $course = "UH6481001 - Software Engineering";
    $faculty = "Faculty of Computing and Informatics (FKI)";

    // php variables for author's poem
    $sect_desc =
    "
      <p id='sect-desc'>
        <q> Welcome to my little haven of words and emotions! Here, I weave both thoughts and emotions
        into trove of verses, capturing fleeting moments and timeless reflections.
        Step into the paths of my mind and heart, paved with the beauty of poetry. </q><br><br><br>
      </p>
    ";

    $poem1_title = "<h2 id='poem-title'>-- WHISPERS OF THE DUSK --</h2><br><br>";
    $poem1_content =
    "
      <p id='poem-content'>
        Amidst the tranquil dusk, a spectacle unfolds.<br>
        Golden rays of laughter, crimson tears of pain,<br>
        narrating tales of old, a fleeting, wistful trance.<br>
        It whispers through the breeze, a message clear,<br>
        so hold to it, subtle and true.<br>
        In the calm surrender of day to night,<br>
        a tale of letting go takes its flight.<br><br><br>
      </p>
    ";

    $poem2_title = "<h2 id='poem-title'>-- THE WEATHERED TOME --</h2><br><br>";
    $poem2_content =
    "
      <p id='poem-content'>
        In the memories of yesteryears,<br>
        we explored a tome, its page soaked in tears,<br>
        once adorned with a phosphorescent gleam,<br>
        now it's but a weathered, worn-out dream.<br><br>

        What twisted fate has befallen this tome,<br>
        once ablaze with stories, now silent and alone?<br>
        Was it time that dulled its once vibrant hue,<br>
        or the passing days that stole its value true.<br><br>

        Did the world's harsh trials and bitter strife,<br>
        diminish the tales that once gave life?<br>
        Once a trove of tales untold, now a shadow of what it once beheld.<br>
        The fate of this tome, now lost in its repression.<br><br><br>
      </p>
    ";
  ?>


  <!-- AUTHOR SECTION STARTS HERE -->
  <section class="author">
    <!-- page title -->
    <h2 id="section-title">WEBSITE AUTHOR</h2>

    <!-- main container -->
    <div class="author-container">
      <!-- container: left -->
      <div class="biodata-container">
        <!-- biodata img -->
        <div id="biodata-img">
          <img src="./BI22110280.jpg" alt="biodata image">
        </div>

        <table id="table-bio">
          <!-- biodata details -->
          <th colspan="2">BIODATA</th>
          <tr>
            <td>NAME</td>
            <td><?php echo $name;?></td>
          <tr>
          <tr>
            <td>MATRIC NUMBER</td>
            <td><?php echo $matnum;?></td>
          </tr>
          <tr>
            <td>BIRTH DATE</td>
            <td><?php echo $birthDate;?></td>
          </tr>
          <tr>
            <td>AGE</td>
            <td><?php echo $age;?></td>
          </tr>
          <tr>
            <td>HOMETOWN</td>
            <td><?php echo $hometown;?></td>
          </tr>

          <!-- education background -->
          <th colspan="2">EDUCATION</th>
          <tr>
            <td>HIGH SCHOOL</td>
            <td><?php echo $highSchool;?></td>
          <tr>
          <tr>
            <td>UNIVERSITY</td>
            <td><?php echo $uni;?></td>
          <tr>
          <tr>
            <td>COURSE</td>
            <td><?php echo $course;?></td>
          <tr>
          <tr>
            <td>FACULTY</td>
            <td><?php echo $faculty;?></td>
          <tr>
        </table>

      </div>

      <!-- container: right -->
      <div class="poem-container">
          <?php echo $sect_desc;?>

          <?php echo $poem1_title;?>
          <?php echo $poem1_content;?>

          <?php echo $poem2_title;?>
          <?php echo $poem2_content;?>
        </h2>
      </div>
    </div>

  </section>
  <!-- AUTHOR SECTION ENDS HERE -->
  

  <!-- USER FOOTER SECTION STARTS HERE -->
  <?php include '../../includes/user_Footer.php'; ?>
  <!-- USER FOOTER SECTION ENDS HERE -->

  <!-- js file -->
  <script src="../../js/user_Script.js"></script>
  
</body>