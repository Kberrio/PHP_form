    <?php

    $name = $email = $contBack = $comment = ""; //variables that hold values
    $nameErr = $emailErr = $contBackErr = ""; //variables that check for errors
    $formErr = false;


    function cleanInput($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }


    if ($_SERVER["REQUEST_METHOD"] ==  "POST") {
      if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $formErr = true;
      } else {
        $name = cleanInput($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
          $nameErr = "Only letters and spaces are allowed";
          $formErr = true;
        }
      }

      if (empty($_POST["email"])) {
        $emailErr = "Email is required.";
        $formErr = true;
      } else {
        $email = cleanInput($_POST["email"]);
        // Check if e-mail address is formatted correctly
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Please enter a valid email address.";
          $formErr = true;
        }
      }

      if (empty($_POST["contact-back"])) {
        #echo $_POST["contact-back"] // echo my selection

        $contBackErr = "Please let us know if we can contact you back.";
        $formErr = true;
      } else {
        $contBack = cleanInput($_POST["contact-back"]);
      }

      $comment = cleanInput($_POST["comments"]);
    }


    ?>

    <section id="contact">
      <div class="container py-5">
        <!-- Section Title -->
        <div class="row justify-content-center text-center">
          <div class="col-md-6">
            <h2 class="display-4 font-weight-bold">Contact Me</h2>
            <hr />
          </div>
        </div>
        <!-- Contact Form Row -->
        <div class="row justify-content-center">
          <div class="col-6">

            <!-- Contact Form Start -->
            <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> method="POST">

              <!-- Name Field -->
              <div class="form-group">
                <label for="name">Full Name:</label>
                <span class="text-danger">*<?php echo $nameErr; ?></span>
                <input type="text" class="form-control" id="name" placeholder="Full Name" name="name" />

              </div>

              <!-- Email Field -->
              <div class="form-group">
                <label for="email">Email address:</label>
                <span class="text-danger">*<?php echo $emailErr; ?></span>
                <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" />
              </div>

              <!-- Radio Button Field -->
              <div class="form-group">
                <label class="control-label">Can we contact you back?</label>
                <span class="text-danger">*<?php echo $contBackErr; ?></span>
                <div class="form-check">
                  <input type="radio" class="form-check-input" name="contact-back" id="yes" value="Yes" />
                  <label class="form-check-label" for="yes">Yes</label>
                </div>
                <div class="form-check">
                  <input type="radio" class="form-check-input" name="contact-back" id="no" value="No" />
                  <label class="form-check-label" for="no">No</label>
                </div>
              </div>

              <!-- Comments Field -->
              <div class="form-group">
                <label for="comments">Comments:</label>
                <textarea id="comments" class="form-control" rows="3" name="comments"></textarea>
              </div>

              <!-- Required Fields Note-->
              <div class="text-danger text-right">* Indicates required fields</div>

              <!-- Submit Button -->
              <button class="btn btn-primary mb-2" type="submit" role="button" name="submit">Submit</button>
            </form>

          </div>
        </div>
      </div>
    </section>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>

      <section id="results" style="background-color: lightsteelblue;">
        <div class="container py-2">
          <div class="row ">
            <h1>Form Entries:</h1>
          </div>
          <div class="row">
            <ul>
              <?php
              //BONUS STEP: show field only if not empty
              if ($name !== "") {
                echo "<li>NAME: $name </li>";
              }
              if ($email !== "") {
                echo "<li>EMAIL: $email </li>";
              }
              if ($contBack !== "") {
                echo "<li>CONTACT BACK: $contBack </li>";
              }
              if ($comment !== "") {
                echo "<li>COMMENT: $comment </li>";
              }
              ?>
            </ul>
          </div>
        </div>
      </section>


    <?php } ?>