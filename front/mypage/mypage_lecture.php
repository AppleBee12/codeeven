<?php
$title = '마이페이지-강좌보기';
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/mypage_header.php');
$mypage_main_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/mypage_main.js\"></script>";


//강좌데이터
$sql = "SELECT class_data.*, user.*, lecture.*, stuscores.* 
        FROM class_data 
        JOIN user ON class_data.uid = user.uid 
        JOIN lecture ON class_data.leid = lecture.leid 
        LEFT JOIN stuscores ON user.uid = stuscores.stu_id 
        WHERE class_data.uid = '" . (isset($_SESSION['UID']) ? $_SESSION['UID'] : '') . "'";

$result = $mysqli->query($sql);
$classArr = [];
while ($class_data = $result->fetch_object()) {
  $classArr[] = $class_data; // 각 행을 배열에 추가
  //print_r($classArr);
}


$sql = "
    SELECT 
        cd.*, 
        l.title AS lecture_title, 
        l.name AS lecture_teacher, 
        l.date AS lecture_date, 
        l.image AS lecture_image, 
        ld.id AS detail_id, 
        ld.title AS detail_title, 
        ld.video_order, -- video_order 추가
        ld.video_url,
        ss.quiz_score, 
        ss.test_score, 
        ss.test
    FROM class_data cd
    JOIN lecture l ON cd.leid = l.leid
    LEFT JOIN lecture_detail ld ON l.leid = ld.lecture_id
    LEFT JOIN stuscores ss ON cd.uid = ss.stu_id AND cd.leid = ss.leid AND ld.id = ss.detail_id
    WHERE cd.uid = '" . (isset($_SESSION['UID']) ? $_SESSION['UID'] : '') . "'
    ORDER BY cd.leid, ld.video_order ASC
";

$result = $mysqli->query($sql);
$classArr = [];
while ($class_data = $result->fetch_object()) {
  $classArr[] = $class_data;
}




?>
<!--탭 메뉴 시작-->
<nav>
  <div class="mypage_tap_wrapper nav nav-underline headt6" id="nav-tab" role="tablist">
    <button class="mypage_tap nav-link active" id="nav-myLecTab1-tab" data-bs-toggle="tab"
      data-bs-target="#nav-myLecTab1" role="tab" aria-controls="nav-myLecTab1" aria-selected="true">진행강좌</button>
    <button class="mypage_tap nav-link" id="nav-myLecTab2-tab" data-bs-toggle="tab" data-bs-target="#nav-myLecTab2"
      role="tab" aria-controls="nav-myLecTab2" aria-selected="false">종료 강좌</button>
  </div>
</nav>
<!--탭 메뉴 끝-->
<!--탭 내용 시작-->
<div class="tab-content" id="nav-tabContent">
  <!-- 탭메뉴1의 내용-->
  <div class="tab-pane fade show active" id="nav-myLecTab1" role="tabpanel" aria-labelledby="nav-myLecTab1-tab">
    <div class="my_lecture_wrapper">
      <!-- 강의목록 시작 -->

      <?php
      $currentLectureId = null;
      foreach ($classArr as $class) {
        if ($currentLectureId !== $class->leid) {
          // 이전 강좌의 강의 목록 출력 완료
          if ($currentLectureId !== null) {
            // 강좌 닫기
          }

          // 새로운 강좌 시작
          $currentLectureId = $class->leid;
      ?>
          <div class="my_lecture mb-4">
            <div class="my_lec_top d-flex">
              <img src="<?= isset($class->lecture_image) ? htmlspecialchars($class->lecture_image) : 'default.jpg'; ?>" alt="강좌 이미지">
              <div class="d-flex flex-column justify-content-evenly">
                <p class="headt5"><?= isset($class->lecture_title) ? htmlspecialchars($class->lecture_title) : '강좌 제목 없음'; ?></p>
                <p><b><?= isset($class->lecture_teacher) ? htmlspecialchars($class->lecture_teacher) : '강사명 없음'; ?></b> | <span>레시피강좌</span></p>
              </div>
            </div>
            <!-- 강좌 디테일 시작 -->
            <div class="my_lec_desc">
              <div class="d-flex justify-content-between">
                <div class="my_lec_txt">
                  <ul class="d-flex flex-column gap-2">
                    <li class="d-flex gap-5">
                      <p class="my_lec_title">강좌기간</p>
                      <p><?= isset($class->regdate) ? htmlspecialchars($class->regdate) : '기간 정보 없음'; ?></p>
                    </li>
                    <li class="d-flex gap-5 align-items-center">
                      <p class="my_lec_title">진도율</p>
                      <div class="progress" role="progressbar" aria-valuenow="<?= isset($class->progress_rate) ? $class->progress_rate : 0; ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" style="width: <?= isset($class->progress_rate) ? $class->progress_rate : 0; ?>%">
                          <?= isset($class->progress_rate) ? $class->progress_rate : 0; ?>%
                        </div>
                      </div>
                    </li>
                    <li class="d-flex gap-5">
                      <p class="my_lec_title">평균 점수</p>
                      <p><?= isset($class->test_score) ? $class->test_score : '0'; ?>점</p>
                    </li>
                  </ul>
                  <div class="my_lec_btn d-flex mt-3 gap-2">
                    <button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#howToGetCertificate">
                      수료기준
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="howToGetCertificate" tabindex="-1" aria-labelledby="howToGetCertificateLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="howToGetCertificateLabel">수료기준</h1>
                          </div>
                          <div class="modal-body">
                            <p>강좌 진도율: 총 <span>80%</span> 이상</p>
                            <p>평균 점수: 총 <span>80점</span> 이상</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-outline-dark btn-sm printButton">수료증</button>
                  </div>
                </div>

                <!-- 그래프 영역 -->
                <div class="my_lec_graph_wrapper d-flex">
                  <div class="my_lec_graph d-flex flex-column align-items-center">
                    <div class="donut-chart" style="--percentage: <?= isset($class->quiz_score) ? $class->quiz_score : 0; ?>%;">
                      <div class="percentage-label"><?= isset($class->quiz_score) ? $class->quiz_score : 0; ?>%</div>
                    </div>
                    <p>강의</p>
                  </div>
                  <div class="my_lec_graph d-flex flex-column align-items-center">
                    <div class="donut-chart" style="--percentage: <?= isset($class->quiz_score) ? $class->quiz_score : 0; ?>%;">
                      <div class="percentage-label"><?= isset($class->quiz_score) ? $class->quiz_score : 0; ?>%</div>
                    </div>
                    <p>퀴즈</p>
                  </div>
                  <div class="my_lec_graph d-flex flex-column align-items-center">
                    <div class="donut-chart" style="--percentage: <?= isset($class->test_score) ? $class->test_score : 0; ?>%;">
                      <div class="percentage-label"><?= isset($class->test_score) ? $class->test_score : 0; ?>%</div>
                    </div>
                    <p>시험</p>
                  </div>
                </div>
              </div>
              <hr>
              <!-- 세부 강의 1강2강3강 목록 시작 -->
              <div class="d-flex justify-content-between align-items-center">
                
                <div class="d-flex justify-content-between align-items-center w-100"> <!--한 강의 내용 -->
                  <div class="d-flex align-items-center gap-3 lecture_title">
                    <p><?= isset($class->video_order) ? htmlspecialchars($class->video_order) : 'N/A'; ?>강</p>
                    <p><?= isset($class->detail_title) ? htmlspecialchars($class->detail_title) : '강의 제목 없음'; ?></p>
                  </div>
                  <!-- 각 강좌별 점수 데이터 -->
                  <div class="lecture_one d-flex justify-content-between align-items-center">
                    <div class="score_wrapper d-flex align-items-center gap-4">
                      <div class="d-flex gap-2">
                        <p class="weight">퀴즈 점수</p>
                        <p><span><?= isset($class->quiz_score) ? $class->quiz_score : '0'; ?></span>점</p>
                      </div>
                      <div class="d-flex gap-2">
                        <p class="weight">시험 점수</p>
                        <p><span><?= isset($class->test_score) ? $class->test_score : '0'; ?></span>점</p>
                      </div>
                      <div class="d-flex gap-2 align-items-center">
                        <p class="weight">진행 여부</p>
                        <?= isset($class->quiz_score)
                          ? '<button class="btn btn-outline-success btn-sm" onclick="window.location.href=\'http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/lecture_detail.php?detail_id=' . (isset($class->detail_id) ? $class->detail_id : 0) . '\'">수강완료</button>'
                          : '<button class="btn btn-outline-secondary btn-sm" onclick="window.location.href=\'http://' . $_SERVER['HTTP_HOST'] . '/code_even/front/lecture_detail.php?detail_id=' . (isset($class->detail_id) ? $class->detail_id : 0) . '\'">미수강</button>'; ?>
                      </div>
                    </div>
                  </div>
                  <div>
                    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/front/lecture_detail.php?detail_id=<?= isset($class->detail_id) ? $class->detail_id : 0; ?>" class="btn btn-secondary">강의보러가기</a>
                  </div>
                </div><!--한 강의 내용 끝-->
              </div><!-- 세부 강의 1강2강3강 목록 끝 -->
            </div><!-- 강좌 디테일 끝 -->
          </div><!-- 강의목록 끝 -->
      <?php

        }
      };
      ?>


    </div>
  </div>
</div>
<!-- 탭메뉴1의 내용 끝-->
<!-- 탭메뉴2의 내용-->
<div class="tab-pane fade" id="nav-myLecTab2" role="tabpanel" aria-labelledby="nav-myLecTab2-tab">
  <div class="my_lecture_wrapper">
    <?php
        if ($currentLectureId !== null) {
          echo "<div class='m-5'>'종료 강좌'가 없습니다</div>"; 
        }
    ?>
  </div><!-- 강의목록 끝 -->
</div>
<!-- 탭메뉴2의 내용 끝-->


</div>
<!--탭 메뉴 내용 끝-->


<script>
  // 도넛 차트를 업데이트하는 함수
  function updateDonut(percentage) {
    const donutChart = document.querySelector('.donut-chart');
    const label = donutChart.querySelector('.percentage-label');
    donutChart.style.setProperty('--percentage', `${percentage}%`);
    label.textContent = `${percentage}%`;
  }

  // // 슬라이더 값 변경 시 업데이트
  // const progressInput = document.getElementById('progress');
  // progressInput.addEventListener('input', (e) => {
  //   const percentage = e.target.value;
  //   updateDonut(percentage);
  // });


  /* 이수증 버튼 함수 */
  function printPage() {
    const fileUrl = "../../images/certificate_of_completion.pdf";

    // PDF를 iframe으로 페이지에 삽입
    const iframe = document.createElement("iframe");
    iframe.style.position = "absolute";
    iframe.style.width = "0px";
    iframe.style.height = "0px";
    iframe.style.border = "none";
    iframe.src = fileUrl;

    // iframe을 body에 추가
    document.body.appendChild(iframe);

    // PDF 파일이 로드된 후 인쇄
    iframe.onload = function() {
      iframe.contentWindow.print(); // iframe 내에서 print() 호출
    };
  }

  const button = document.querySelector(".printButton");
  if (button) {
    button.addEventListener("click", printPage);
  }
</script>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>