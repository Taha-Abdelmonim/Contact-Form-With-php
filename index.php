<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  
  //Load Composer's autoloader
  require 'vendor/autoload.php';
  
  //Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->SMTPAuth   = true;
  $mail->SMTPDebug = 2;
  $mail->Host = 'smtp.gmail.com'; 
  $mail->Username = '1taha2abdelmonim@gmail.com';
  $mail->Password = '';
  $mail->SMTPSecure = "tls"; // ssl
  $mail->Port = 587; // 465
  

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $formErrors = array();
    $headers = "From " . $email . "\r\n";
    $myEmail = "taha.abdelmoonim@gmail.com";
    $Subject = "Contact Form";
    $keySite = "6LcagMofAAAAAEOxdJukE7yGNBocpACrtVv8YZM6";
    $secret = "6LcagMofAAAAAB_c0rRK2R5QGlo6_HB9pwSsPxjo";

    $mail->setFrom($email);
    $mail->FromName = $user;
    $mail->addAddress('1taha2abdelmonim@gmail.com', "Taha Abdelmoneim");
    $mail->Subject = 'Message From Contact PHP';
    $mail->isHTML(true);
    $mail->Body = "Name is:" . $user ."<br />Phone is:" . $phone . "<br /> ...Message<br />" . $message;

    if (strlen($user) <= 3) {
      $formErrors[] = "Username <= <b>3</b> Characters";
    }
    if (strlen($message) < 10) {
      $formErrors[] = "Message <= <b>10</b> Characters";
    }
    
    if (empty($formErrors)) {
      if ($mail->send()) {
        echo "Done Send mail";
      } else {
        echo "Error Send mail";
      }

      $user = "";
      $email = "";
      $phone = "";
      $message = "";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/contact.css">
</head>
<body>
  <!-- Start Form -->
  <main>
    <div class="container">
      <h1 class="text-center text-primary fw-bold">Contact Me</h1>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="contact-form">
        <?php if (! empty($formErrors)) { ?>
          <div class="alert alert-danger alert-dismissible" role="start">
          <?php
            foreach($formErrors as $error) {
              echo $error . "<br />";
            }
          ?>
          </div>
        <?php } ?>
        <div class="form-group position-relative">
          <input class="form-control username" type="text" name="username" placeholder="Username" value="<?php if(isset($user)) {echo $user; } ?>">
          <i class="fa fa-user"></i>
          <span class="asterisx first">*</span>
          <div class="alert alert-danger custom-alert">
            Username <= <b>3</b> Characters
          </div>
        </div>
        <div class="form-group position-relative">
          <input class="form-control email" type="email" name="email" placeholder="Email" value="<?php if(isset($email)) {echo $email; } ?>">
          <i class="fa fa-envelope"></i>
          <span class="asterisx">*</span>
          <div class="alert alert-danger custom-alert">
            Email cant be <b>empty</b>
          </div>
        </div>
        <div class="form-group position-relative">
          <input class="form-control phone" type="text" name="phone" placeholder="Phone" value="<?php if(isset($phone)) {echo $phone; } ?>">
          <i class="fa fa-phone"></i>
          <span class="asterisx">*</span>
          <div class="alert alert-danger custom-alert">
            phone <= <b>10</b> Characters
          </div>
        </div>
        <div class="form-group position-relative textarea">
          <textarea class="form-control message" name="message" placeholder="Your Message"><?php if(isset($message)) {echo $message; } ?></textarea>
          <span class="asterisx">*</span>
          <div class="alert alert-danger custom-alert">
            Message <= <b>10</b> Characters
          </div>
        </div>
        <input class="btn btn-success" type="submit" value="Send Message">
        <i class="fa fa-plus-circle"></i>
        <div class="g-recaptcha" data-sitekey="6LcagMofAAAAAEOxdJukE7yGNBocpACrtVv8YZM6"></div>
      </form>
    </div>
  </main>
  <!-- End Form -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
  <script src="./js/custom.js"></script>
</body>
</html>