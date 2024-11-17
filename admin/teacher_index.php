<?php

$chart_js = "<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>";
$host = $_SERVER['HTTP_HOST'];
$t_main_js = "<script src=\"http://$host/code_even/admin/js/t_main.js\"></script>";

include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/header.php');

if (!isset($_SESSION['AUID'])) {
  echo "<script>
  alert('로그인을 해주세요');
  location.href='admin/login/login.php';
  </script>";
}
$user_id = $_SESSION['AUID'];
$user_level = $_SESSION['AULEVEL'];
$user_name = $_SESSION['AUNAME'];

$sql = "SELECT useremail FROM user WHERE userid = '$user_id' && username = '$user_name'";
$result = $mysqli->query($sql);


// print_r($result->fetch_assoc());


?>

<div class="container">
  <div class="top_wrapper d-flex justify-content-between">
    <div class="d-flex justify-content-between">
      <img src="https://picsum.photos/200" width=100 height=100 alt="강사 프로필 사진">
      <div class="d-flex flex-column justify-content-end align-items-end">
        <h3><?= $user_name ?><span class="top_text"> Teacher</span></h3>
        <p><span class="top_text">code@even.co.kr</span></p>
      </div>
    </div>
    <div>
      <h3>과정 개설 현황</h3>
      <p>
        <span class="top_text">대기</span> 2
        <span class="top_text"> / 개설</span> 63
        <span class="top_text"> / 종료</span> 23
      </p>
    </div>
    <div>
      <h3>평균 평점</h3>
      <ul id="rating_star" data-rating="2.2">
        <li data-value="1"><i class="bi bi-star"></i></li>
        <li data-value="2"><i class="bi bi-star"></i></li>
        <li data-value="3"><i class="bi bi-star"></i></li>
        <li data-value="4"><i class="bi bi-star"></i></li>
        <li data-value="5"><i class="bi bi-star"></i></li>
      </ul>
    </div>
    <div>
      <h3>미답변 질문</h3>
      <p>2<span class="top_text">건</span></p>
    </div>
  </div>
  <div class="bottom_wrapper d-flex justify-content-between">
    <div class="bott_left d-flex flex-column justify-content-between ">
      <h3>최근 6개월 수익률</h3>
      <canvas id="current_six_returns" width="550" height="500"></canvas>
    </div>
    <div class="bott_right d-flex flex-column justify-content-between">
      <div class="sellcost_best_table">
        <div class="d-flex justify-content-between">
          <h3>판매 금액 BEST 강좌</h3>
          <p class="month">11월 현황</p>
        </div>
        <div class="row g-0 text-center">
          <div class="p-2 col-2 sst">순위</div>
          <div class="p-2 col-5 sst">강좌 명</div>
          <div class="p-2 col-2 sst">강사 명</div>
          <div class="p-2 col-3 sst">판매 금액</div>
        </div>
        <div class="row g-0 text-center">
          <div class="p-2 col-2 sst">매출 1위</div>
          <div class="p-2 col-5 text-truncate">[HTML]홈페이지 기본 메뉴부터 투명한 메뉴, 방향전환까지 완벽 마스터</div>
          <div class="p-2 col-2">김동주</div>
          <div class="p-2 col-3">812,345 <span>원</span></div>
        </div>
        <div class="row g-0 text-center">
          <div class="p-2 col-2 sst">매출 2위</div>
          <div class="p-2 col-5 text-truncate">입문자도 실무에서 바로 써먹는 PHP 기초부터 시니어까지</div>
          <div class="p-2 col-2">김동주</div>
          <div class="p-2 col-3">712,345<span>원</span></div>
        </div>
        <div class="row g-0 text-center">
          <div class="p-2 col-2 sst">매출 3위</div>
          <div class="p-2 col-5 text-truncate">REACT 커리어를 갈아끼워드립니다</div>
          <div class="p-2 col-2">김동주</div>
          <div class="p-2 col-3">612,345<span>원</span></div>
        </div>
      </div>
      <div class="d-flex justify-content-between">
        <div>
          <div class="d-flex justify-content-between">
            <h3>신규 가입자 현황</h3>
            <p class="month">11월 현황</p>
          </div>
          <p>5,412<span class="top_text"> 명</span></p>
          <canvas id="current_six_news" width="400" height="250"></canvas>
        </div>
        <div>
          <div class="d-flex justify-content-between">
            <h3>카테고리별 매출 금액</h3>
            <p class="month">11월 현황</p>
          </div>
          <p>7,123,000<span class="top_text"> 원</span></p>
          <canvas id="cate_one_return" width="250" height="250"></canvas>
        </div>
      </div>
    </div>
  </div>

</div>

<?php
$host = $_SERVER['HTTP_HOST'];


include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/admin/inc/footer.php');
?>