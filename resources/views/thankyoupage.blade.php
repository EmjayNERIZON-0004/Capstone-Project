<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Thank You - Survey Submitted</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="icon" href="{{asset('logo.png')}}" type="image/png" />
  <style>
    body {
      background-color: #f4f8fb;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .thank-you-container {
      max-width: 700px;
      margin: 60px auto;
      padding: 40px;
      background: #ffffff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      border-radius: 16px;
      text-align: center;
    }

    .thank-you-icon {
      font-size: 60px;
      color: #0d6efd;
    }

    .thank-you-title {
      font-size: 28px;
      font-weight: bold;
      margin-top: 20px;
    }

    .thank-you-text {
      font-size: 16px;
      color: #555;
      margin-top: 15px;
    }

    .return-home {
      margin-top: 30px;
    }

    .return-home a {
      text-decoration: none;
    }

    img {
      width: 100%;
      max-width: 200px;
      height: auto;
    }

    @media (max-width: 576px) {
      .thank-you-container {
        padding: 20px;
        margin: 20px;
      }

      .thank-you-icon {
        font-size: 50px;
      }

      .thank-you-title {
        font-size: 22px;
      }

      .thank-you-text {
        font-size: 15px;
      }

      img {
        max-width: 140px;
      }
    }
  </style>
</head>
<body>
  <div class="thank-you-container">
    <div class="thank-you-icon">
      <i class="fas fa-check-circle"></i>
    </div>

    <div class="thank-you-title">Thank You for Completing the Survey!</div>

    <p class="thank-you-text">
      We sincerely appreciate your time and effort in providing us with your feedback. <br />
      Your responses will help us improve our services and deliver a better experience.
    </p>

    <img src="{{ asset('check-list.svg') }}" alt="Checklist SVG" />

    <p class="thank-you-text">
      If you have additional questions, concerns, or suggestions, feel free to reach out to us anytime.
    </p>

    <p class="thank-you-text">Have a wonderful day ahead!</p>

    <div class="return-home">
      <a href="{{route('page1')}}" class="btn btn-primary px-4">Submit another response.</a>
    </div>
  </div>

  <!-- Font Awesome for the check icon -->
  <script src="https://kit.fontawesome.com/a2e0ad34ae.js" crossorigin="anonymous"></script>
</body>
</html>
