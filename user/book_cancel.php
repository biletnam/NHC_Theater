<?php
if(!isset($_SESSION['user_id'])) {
    header("location: ../index.php");
}
?>

<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>NHC Theater User Page</title>

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/2-col-portfolio.css" rel="stylesheet">
  <!-- CSS
  <link rel="stylesheet" href="http://163.180.118.201/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://163.180.118.201/assets/css/bootstrap-theme.min.css">
-->
  <!-- JS
  <script src="http://163.180.118.201/assets/js/jquery-1.12.2.min.js"></script>
  <script src="http://163.180.118.201/assets/js/bootstrap.min.js"></script>
-->

  <style>
  body {
    /* Margin bottom by footer height */
    margin-bottom: 60px;
  }
  .footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    /* Set the fixed height of the footer here */
    height: 60px;
    background-color: #f5f5f5;
  }
  </style>

  <script>
  $(function() {
    //예매내역 로드
    $.post('../php/book_list.php', {id: "<?php echo $_SESSION['user_id']; ?>"}, function(data, textStatus, xhr) {
      if (textStatus == "success")
      {
        var books = JSON.parse(data);
        var option = $('#book_list');

        $.each(books, function(i, val) {
          option.append($('<option>', {
            value: val.ID,
            text: "예매ID: " + val.ID + ", 영화ID: " + val.PLAYID + ", 예매시각: " + val.screen_time          }));
        });
      }
    });
  });

  function cancel() {
    var bookID = $('#book_list').val();
    if (bookID == -1)
    {
      alert("취소할 예매 정보를 선택해주세요");
      return false;
    }

    $.post('../php/book_cancel.php', {user_id: "<?php echo $_SESSION['user_id']; ?>", book_id: bookID}, function(data, textStatus, xhr) {
      alert("취소되었습니다");

      //update session
      window.location.href = '../php/update_user_session.php';
    });

  }
  </script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">NHC_Theater</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="./index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../php/logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <!-- <h2><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Reservation cancel</h2> -->

    <!-- breadcrumb -->
    <ol class="breadcrumb">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <li><a href="./">User Page</a></li>
      <li class="active"> Reservation cancel</li>
    </ol>
    <hr>

    <!-- 예매 목록 -->
    <label for="book_list">영화 예매 목록</label>
    <select class="form-control" id="book_list">
      <option value="-1">선택</option>
    </select>

    <hr>
    <button class="btn btn-lg btn-danger btn-block" onclick="cancel();">예매 취소</button>
    <button class="btn btn-lg btn-default btn-block" onclick="location.href='./';">뒤로</button>
  </div>

<!--
  <footer class="footer">
    <div class="container">
      <button type="button" class="btn btn-default" onclick="location.href='../php/logout.php';">
        <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout
      </button>
    </div>
  </footer>
-->

  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
