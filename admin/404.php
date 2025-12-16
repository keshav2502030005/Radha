<?php
// Send proper 404 HTTP status
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>404 - Page Not Found</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- 404 Page CSS -->
  <link rel="stylesheet" href="/css/404.css">
</head>

<body>

<section class="page_404">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="col-sm-10 col-sm-offset-1 text-center">

          <div class="four_zero_four_bg">
            <h1 class="text-center">404</h1>
          </div>

          <div class="contant_box_404">
            <h3 class="h2">Look like you're lost</h3>
            <p>The page you are looking for is not available.</p>

            <a href="/admin/dashboard/index.html" class="link_404">
              Go to Dashboard
            </a>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>
