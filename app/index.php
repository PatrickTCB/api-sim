<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
  
    <title>API Simulator</title>
  
    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
    <!-- Custom fonts for this template -->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  
    <!-- Custom styles for this template -->
    <link href="/css/clean-blog.min.css" rel="stylesheet" type="text/css">
  
  </head>
<body>
<!-- Page Header -->
    <header class="masthead" style="background-color: #99ccff">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>API Tester</h1>
              <span class="subheading">
                <?php 
                  $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                  echo $actual_link;
                  function base64url_encode($data) {
                    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
                  }
                  
                  function base64url_decode($data) {
                    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
                  }
                ?>
              </span>
            </div>
          </div>
        </div>
      </div>
    </header>
<!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-12 mx-auto"  style="word-wrap: break-word;">
          <p info="headers">Request Headers:<br />
            <ul>
            <?php
              $headers =  getallheaders();
              foreach($headers as $key=>$value){
                echo "<li>", $key, ' = ', $value, "</li>";
              }
            ?>
            </ul>
          </p>
          <p info="cookies">Cookie Info:<br />
            <ul>
              <?php
                foreach ($_COOKIE as $key=>$val)
                  {
                    echo '<li>'.$key.' = '.$val.'</li>\n';
                  }
              ?>
            </ul>
          </p>
          <p info="get">GET Parameters Received:<br />
            <ul>
            <?php
              $getparams = FALSE;
              $getparamsjson = "";
              $getparamsjsonpretty = "";
              foreach($_GET as $key=>$value){
                $getparams = TRUE;
                echo "<li>", $key, ' = ', $value, "</li>";
                $getparamsjson = $getparamsjson . "{\"name\":\"" . $key . "\",\"values\": [\"" . $value . "\"]},";
                $getparamsjsonpretty = $getparamsjsonpretty . "&emsp;&emsp;{\n&emsp;&emsp;&emsp;\"name\":\"" . $key . "\",\n&emsp;&emsp;&emsp;\"values\": [\n&emsp;&emsp;&emsp;&emsp;\"" . $value . "\"\n&emsp;&emsp;&emsp;]\n&emsp;&emsp;},\n";
              }
              echo "</ul>";
              if ($getparams == TRUE){
                $scenario = "{\"url\": \"" . $actual_link . "\",\"method\": \"GET\",\"parameters\": [" . rtrim($getparamsjson, ",") . "]}";
                $prettyscenario = "{\n&emsp;\"url\": \"" . $actual_link . "\",\n&emsp;\"method\": \"GET\",\n&emsp;\"parameters\": [\n" . rtrim(rtrim($getparamsjsonpretty, "\n"), ",") . "\n&emsp;]\n}";
                echo "<p>JSON representation of URL data<br /><pre class=\".code-card\">", $prettyscenario, "</pre></p>";
                $b64scenario = base64url_encode($scenario);
                $b64charcount = strlen($b64scenario);
                $padcount = $b64charcount - ($b64charcount % 4) + 4;
                $b64scenarioPadded = str_pad($b64scenario,$padcount,"=",STR_PAD_RIGHT);
                echo "<p>Base64 URL Safe encoding if this scenario data<br /><span>", $b64scenarioPadded, "</span></p>";
                echo "<p>Base64 info decoded ", $scenario, "</p>";
              }
            ?>
          </p>
          <p info="post">POST Parameters Received:<br />
            <ul>
            <?php
              $postparams = FALSE;
              $postparamsjson = "";
              $postparamsjsonpretty = "";
              foreach($_POST as $key=>$value){
                $postparams = TRUE;
                echo "<li>", $key, ' = ', $value, "</li>";
                $postparamsjson = $postparamsjson . "{\"name\":\"" . $key . "\",\"values\": [\"" . $value . "\"]},";
                $postparamsjsonpretty = $postparamsjsonpretty . "&emsp;&emsp;{\n&emsp;&emsp;&emsp;\"name\":\"" . $key . "\",\n&emsp;&emsp;&emsp;\"values\": [\n&emsp;&emsp;&emsp;&emsp;\"" . $value . "\"\n&emsp;&emsp;&emsp;]\n&emsp;&emsp;},\n";
              }
              if ($postparams == TRUE){
                $scenario = "{\"url\": \"" . $actual_link . "\",\"method\": \"POST\",\"parameters\": [" . rtrim($postparamsjson, ",") . "]}";
                $prettyscenario = "{\n&emsp;\"url\": \"" . $actual_link . "\",\n&emsp;\"method\": \"POST\",\n&emsp;\"parameters\": [\n" . rtrim(rtrim($postparamsjsonpretty, "\n"), ",") . "\n&emsp;]\n}";
                echo "<p>JSON representation of URL data<br /><pre class=\".code-card\">", $prettyscenario, "</pre></p>";
                $b64scenario = base64url_encode($scenario);
                $b64charcount = strlen($b64scenario);
                $padcount = $b64charcount - ($b64charcount % 4) + 4;
                $b64scenarioPadded = str_pad($b64scenario,$padcount,"=",STR_PAD_RIGHT);
                echo "<p>Base64 URL Safe encoding if this scenario data<br /><span>", $b64scenarioPadded, "</span></p>";
                echo "<p>Base64 info decoded ", $scenario, "</p>";
              }
            ?>
            </ul>
            
          </p>
        </div>
      </div>
    </div>
  </article>
<hr>  
<!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="https://hub.docker.com/repository/docker/patricktcb/api-sim">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-docker fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://github.com/PatrickTCB/api-sim">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
          <p class="text-muted text-center">🤖</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="/js/clean-blog.min.js"></script>
</body>
</html>