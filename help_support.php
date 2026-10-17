<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
  <link rel="stylesheet" href="./styles/styles.css" />
  <link rel="stylesheet" href="./styles/help_support.css" />
</head>
<body>
    
    <div class="container">
    <button onclick="history.back()" class="back-btn">← Back</button>
    <h1>Help and Support</h1>

    <div class="help-support-wrapper">
      <!-- Left big rectangle -->
      <div class="faq-box">
        <h2>FAQs</h2>

        <div class="faq-item">
          <p class="question">Question: It is a Good System?</p>
          <p class="answer">It is good and efficient.</p>
        </div>

        <div class="faq-item">
          <p class="question">Question: How can I contact Support?</p>
          <p class="answer">You can reach us via the Contact Page.</p>
        </div>

        <div class="faq-item">
          <p class="question">Question: Is this service available 24/7?</p>
          <p class="answer">Yes, we are available around the clock.</p>
        </div>

        <div class="faq-item">
          <p class="question">Question: Do you offer group discounts?</p>
          <p class="answer">Yes, we do offer discounts for groups.</p>
        </div>

        <div class="faq-item">
          <p class="question">Question: How can I leave a review?</p>
          <p class="answer">You can leave a review on your user dashboard.</p>
        </div>

        <div class="faq-item">
          <p class="question">Question: What payment methods are accepted?</p>
          <p class="answer">We accept various payment methods including credit cards and e-wallet etc.</p>
        </div>

        <div class="faq-item">
          <p class="question">Question: How can I personally contact the staff of your system?</p>
          <p class="answer">Tan Chee Fung, 011-1858-5006, vincetan0927@gmail.com.</p>
        </div>
      </div>

      <!-- Right side rectangles -->
      <div class="right-side">
        <div class="queries-box">
          <h2>General queries</h2>
          <p class="contact-number">+023456748</p>
        </div>

        <?php
            if(isset($_SESSION['SES_UserID'])) {
        ?>
              <div class="feedback-box">
                <h2>Feedback</h2>
                <button class="feedback-btn" onclick="window.location.href='feedbackForm.php'">Leave a Feedback</button>
              </div>
        <?php
            }
        ?>
      </div>
    </div>
  </div>

  <script>
    function submitFeedback() {
      alert('Processing to Feedback Form......');
    }
  </script>

  <?php include 'footer.php'; ?>
</body>
</html>







