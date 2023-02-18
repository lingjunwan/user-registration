<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>USER REGISTRATION</title>
</head>

<body>

  <?php
  // Define variables and set to empty values
  $email = $password = $retype_password = $first_name = $last_name = $phone_number = $address = $town = $region = $postcode = $country = "";
  $email_err = $password_err = $retype_password_err = $first_name_err = $last_name_err = $phone_number_err = $address_err = $town_err = $region_err = $postcode_err = $country_err = "";

  // Validate email
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
      $email_err = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
      if (!preg_match("/^[^@\s]+@[^@\s]+\.[^@\s]+$/", $email)) {
        $email_err = "Invalid email format";
      }
    }

    // Validate password
    if (empty($_POST["password"])) {
      $password_err = "Password is required";
    } else {
      $password = test_input($_POST["password"]);
      if (!preg_match("/^(?=.*\d)(?=.*[A-Z])(?=.*\W).{10,}$/", $password)) {
        $password_err = "Password should be at least 10 characters, include one uppercase letter, one digit and one special character";
      }
    }

    // Validate retype password
    if (empty($_POST["retype_password"])) {
      $retype_password_err = "Retype password is required";
    } else {
      $retype_password = test_input($_POST["retype_password"]);
      if ($retype_password !== $password) {
        $retype_password_err = "Passwords do not match";
      }
    }

    // Validate first name
    if (empty($_POST["first_name"])) {
      $first_name_err = "First name is required";
    } else {
      $first_name = test_input($_POST["first_name"]);
      if (!preg_match("/^[A-Z]{1}[a-z]{0,9}$/", $first_name)) {
        $first_name_err = "First name should have up to 10 letters and start with an uppercase letter";
      }
    }

    // Validate last name
    if (empty($_POST["last_name"])) {
      $last_name_err = "Last name is required";
    } else {
      $last_name = test_input($_POST["last_name"]);
      if (!preg_match("/^[A-Z]{1}[a-z]{0,14}(\s[A-Z]{1}[a-z]{0,14})?$/", $last_name)) {
        $last_name_err = "Last name should have up to 15 letters, start with an uppercase letter and optionally include one space and another word";
      }
    }

    // Validate phone number
    if (empty($_POST["phone_number"])) {
      $phone_number_err = "Phone number is required";
    } else {
      $phone_number = test_input($_POST["phone_number"]);
      if (!preg_match("/^\+\d{1,15}$/", $phone_number)) {
        $phone_number_err = "Phone number should start with a '+' and include up to 15 digits";
      }
    }

    // Validate address
    if (empty($_POST["address"])) {
      $address_err = "Address is required";
    } else {
      $address = test_input($_POST["address"]);
      if (!preg_match("/^\d+\s[a-zA-Z]+\s[a-zA-Z]+/", $address)) {
        $address_err = "Invalid address format";
      }
    }

    // Validate Town
    if (!empty($_POST["town"])) {
      $town = test_input($_POST["town"]);
      if (!preg_match("/^[A-z\s]{0,15}$/", $town)) {
        $town_err = "Invalid town format";
      }
    }

    // Validate region
    if (empty($_POST["region"])) {
      $region_err = "Region is required";
    } else {
      $region = test_input($_POST["region"]);
      if (!preg_match("/^[A-Z]{2,3}$/", $region)) {
        $region_err = "Invalid region format";
      }
    }

    // Validate postcode
    if (empty($_POST["postcode"])) {
      $postcode_err = "Postcode is required";
    } else {
      $postcode = test_input($_POST["postcode"]);
      if (!preg_match("/^[A-Z]\d[A-Z] \d[A-Z]\d$/", $postcode)) {
        $postcode_err = "Invalid postcode format";
      }
    }

    // Validate country
    if (empty($_POST["country"])) {
      $country_err = "Country is required";
    } else {
      $country = test_input($_POST["country"]);
      if (!preg_match("/^[A-Z][a-z]{3,14}$/", $country)) {
        $country_err = "Invalid country format";
      }
    }
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // if there are no errors, write the data to file
  if (
    empty($email_err) &&
    empty($password_err) &&
    empty($retype_password_err) &&
    empty($first_name_err) &&
    empty($last_name_err) &&
    empty($phone_number_err) &&
    empty($address_err) &&
    empty($town_err) &&
    empty($region_err) &&
    empty($postcode_err) &&
    empty($country_err) &&

    !empty($email) &&
    !empty($password) &&
    !empty($retype_password) &&
    !empty($first_name) &&
    !empty($last_name) &&
    !empty($phone_number) &&
    !empty($address) &&
    //!empty($town) &&
    !empty($region) &&
    !empty($postcode) &&
    !empty($country)
  ) {
    $data = array(
      "Email: " . $email,
      "Password: " . $password,
      "Retype Password: " . $retype_password,
      "First Name: " . $first_name,
      "Last Name: " . $last_name,
      "Phone Number: " . $phone_number,
      "Address: " . $address,
      "Town: " . $town,
      "Region: " . $region,
      "Postcode: " . $postcode,
      "Country: " . $country
    );
    $file = fopen("user.txt", "a") or die("Unable to open file!");
    fwrite($file, implode("\n", $data) . "\n\n\n");
    fclose($file);
    // Display success message
    echo "<div class=\"alert alert-success alert-dismissable\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\"
            aria-hidden=\"true\">
        &times;
    </button>
    Registration successful !<br>Your information has been saved to the file user.txt.<br>You can close the page now.</div>";
  } else if (
    $email_err ||
    $password_err ||
    $retype_password_err ||
    $first_name_err ||
    $last_name_err ||
    $phone_number_err ||
    $address_err ||
    $town_err ||
    $region_err ||
    $postcode_err ||
    $country_err
  ) {
    // Display error message
    echo "<div class=\"alert alert-danger alert-dismissable\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\"
            aria-hidden=\"true\">
        &times;
    </button>
    Please fix the following error(s) before submitting the form.</div>";
  } else
    // Display guidance message
    echo "<div class=\"alert alert-info alert-dismissable\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\"
            aria-hidden=\"true\">
        &times;
    </button>
    To sign up for the form, enter your correct infomation and click the Register button. Your information will be saved to the user.txt file.
</div>";
  ?>

  <h2 class="text-success text-center">Registration Form</h2><br>
  <div class="text-success text-muted text-center">Fields marked <span class="text-danger">*</span> are
    required.<br><br></div>

  <div class="container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="email" class="form-label">Email
          <span class="text-danger">* </span>
        </label>
        <input type="text" name="email" id="email" value="<?php echo $email; ?>" class="form-control">
        <span class="text-danger">
          <?php echo $email_err; ?>
        </span>
      </div>

      <div class="form-group">
        <label for=" password" class="form-label">Password
          <span class="text-danger">* </span>
        </label>
        <input type="password" name="password" id="password" value="<?php echo $password; ?>" required
          class="form-control">
        <span class="text-danger">
          <?php echo $password_err; ?>
        </span>
      </div>

      <div class="form-group">
        <label for="retype_password" class="form-label">Retype Password
          <span class="text-danger">* </span>
        </label>
        <input type="password" name="retype_password" id="retype_password" value="<?php echo $retype_password; ?>"
          required class="form-control">
        <span class="text-danger">
          <?php echo $retype_password_err; ?>
        </span>
      </div>

      <div class="form-group">
        <label for="first_name" class="form-label">First Name
          <span class="text-danger">* </span>
        </label>
        <input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>" required
          class="form-control">
        <span class="text-danger">
          <?php echo $first_name_err; ?>
        </span>
      </div>

      <div class="form-group">
        <label for="last_name" class="form-label">Last Name
          <span class="text-danger">* </span>
        </label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>" required
          class="form-control">
        <span class="text-danger">
          <?php echo $last_name_err; ?>
        </span>
      </div>

      <div class="form-group">
        <label for="phone_number" class="form-label">Phone Number
          <span class="text-danger">* </span>
        </label>
        <input type="text" name="phone_number" id="phone_number" value="<?php echo $phone_number; ?>" required
          class="form-control">
        <span class="text-danger">
          <?php echo $phone_number_err; ?>
        </span>
      </div>

      <div class="form-group">
        <label for="address" class="form-label">Address
          <span class="text-danger">* </span>
        </label>
        <input type="text" name="address" id="address" value="<?php echo $address; ?>" required class="form-control">
        <span class="text-danger">
          <?php echo $address_err; ?>
        </span>
      </div>

      <div class="form-group">
        <label for="town" class="form-label">Town</label>
        <input type="text" name="town" id="town" value="<?php echo $town; ?>" class="form-control">
        <span class="text-danger">
          <?php echo $town_err; ?>
        </span>
      </div>

      <div class="form-group">
        <label for="region" class="form-label">Region
          <span class="text-danger">* </span>
        </label>
        <input type="text" name="region" id="region" value="<?php echo $region; ?>" required class="form-control">
        <span class="text-danger">
          <?php echo $region_err; ?>
        </span>
      </div>

      <div class="form-group">
        <label for="postcode" class="form-label">Postcode / Zip
          <span class="text-danger">* </span>
        </label>
        <input type="text" name="postcode" id="postcode" value="<?php echo $postcode; ?>" required class="form-control">
        <span class="text-danger">
          <?php echo $postcode_err; ?>
        </span>
      </div>

      <div class="form-group">
        <label for="country" class="form-label">Country
          <span class="text-danger">* </span>
        </label>
        <input type="text" name="country" id="country" value="<?php echo $country; ?>" required class="form-control">
        <span class="text-danger">
          <?php echo $country_err; ?>
        </span>
      </div>

      <input type="submit" name="register" value="Register" class="btn btn-success btn-lg">
      <input type="reset" name="reset" value="Reset" class="btn btn-danger btn-lg">
    </form>
    <br><br>
  </div>


</body>

</html>