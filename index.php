<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/header.php');
$main_js = "<script src=\"http://" . $_SERVER['HTTP_HOST'] . "/code_even/front/js/main.js\"></script>";
?>

<!-- 쿠키 모달 창 -->
<div id="cookieModal" class="cookie-modal ">
  <div class="cookie-modal-content ">
    <h4 class="d-flex justify-content-center mb-3">CODE EVEN</h4>
    <p>본 웹사이트는 구직용 포트폴리오 웹사이트이며, <br>
      실제로 운영되는 사이트가 아닙니다.</p>
    <hr>
    <div class="text-start">
      <div>
        <span><b>팀원 : </b>홍수진(팀장), 배유나, 조채림, 최은화, 홍은진</span><br>
        <span><b>제작기간</b> : 2024.11.24 - 2024.12.23 </span><br>
        <span><b>개발환경</b> : HTML/CSS, Javascript, J-Query, PHP</span><br>
        <div class="link3">
          <span><b>기획자료 :</b> <a href="https://www.figma.com/deck/MQfJi66QGjjvn4nzpNfIQz/CODE_EVEN_LMS%EA%B5%AC%ED%98%84%EB%B0%9C%ED%91%9C-%EC%B5%9C%EC%A2%85?node-id=1-466&node-type=slide&viewport=-123%2C-137%2C0.7&t=QMdQYEzDrnraOO0y-1&scaling=min-zoom&content-scaling=fixed&page-id=0%3A1" target="_blank">figma</a>
            <b> 코드 :</b> <a href="https://github.com/AppleBee12/Code_Even.git" target="_blank">github</a>
            <b> 관리자 페이지 :</b> <a href="http://localhost/code_even/admin/index.php" target="_blank">Admin Page</a></p>
        </div>
      </div>
      <hr>
      <div>
        <span><b>업무분장</b></span>
        <p><b>기획 : </b>팀원 전체 <b>디자인 : </b>구현 담당자</p>
      </div>
      <hr>
      <div class="link3">
        <span><b>* 구현 완료 페이지 *</b></span><br>
        <span><b>홍수진 : </b>
          <a href="admin/index.php">대시보드,</a> 공통헤더,
          <a href="admin/community/counsel.php">커뮤니티 관리, </a>
          <a href="admin/manual/for_admin.php">관리자 매뉴얼 </a>
        </span><br>
        <span><b>배유나 : </b>
          <a href="admin/student/student_list.php">수강생 관리, </a>
          <a href="admin/inquiry/notice.php">문의 게시판 관리 </a>
        </span><br>
        <span><b>조채림 : </b>
          <a href="members/signup/signup.php">로그인/회원가입, </a>
          <a href="admin/category/category.php">카테고리관리, </a>
          <a href="admin/coupons/coupons.php">쿠폰관리 </a>
        </span><br>
        <span><b>최은화 : </b>
          <a href="admin/lecture/lecture_list.php">강좌관리, </a>
          <a href="admin/book/book_list.php">교재관리 </a>
        </span><br>
        <span><b>홍은진 : </b>
          <a href="admin/teacher/teacher_list.php">강사관리, </a>
          <a href="admin/orders/orders_list.php">결제/배송관리, </a>
          <a href="admin/sales/lectuer_sales.php">매출통계관리, </a>
          <a href="admin/user/user_list.php">전체회원관리 </a>
        </span><br>
      </div>
      <hr>
      <div>
        <span><b>강사용 아이디 </b>: even_teacher</span><br>
        <span><b>강사용 비밀번호 </b>: 12345</span>
      </div>
      <hr>
      <div>
        <span><b>학생용 아이디 </b>: even_student</span><br>
        <span><b>학생용 비밀번호 </b>: 12345</span>
      </div>
    </div>
    <hr>
    <p class="link3"><a href="http://localhost/code_even/admin/login/login.php">어드민(관리자&강사)페이지 바로가기</a></p>
    <hr>
    <div class="d-flex justify-content-start gap-2 mb-3">
      <label class="align-items-end cookie_btn td_hidden" for="check">오늘 하루 안보기</label>
      <input type="checkbox" id="check">
    </div>
    <button id="cookieCloseBtn" type="button" class="close_txt alarm">
      <img src="admin/images/sb_logo.png" width="50" height="30" alt="코드이븐로고">
      close
    </button>
  </div>
</div>

<section class="sec01">
  <div>
    <div class="swiper sec01_swiper">
      <ul class="swiper-wrapper">
        <li class="swiper-slide">
          <div class="sec01_banner sec01_banner01">
            <div class="sec01_textwrapper">
              <h5>EVENT</h5>
              <h3>비슷한 부분을 자꾸 잊는다면?</h3>
              <h3>코드이븐 레시피 강좌를 만날 때!</h3>
            </div>
            <img src="front/images/sec01_banner01.png" alt="">
          </div>
        </li>
        <li class="swiper-slide">
          <div class="sec01_banner sec01_banner02">
            <div class="sec01_textwrapper">
              <h5>2024.12.01 - 12.31</h5>
              <h3>크리스마스 특별 50% 쿠폰 증정!</h3>
              <h3>추운 날 따뜻한 쿠폰 받아가세요</h3>
            </div>
            <img src="front/images/sec01_banner02.png" alt="">
          </div>
        </li>
        <li class="swiper-slide">
          <div class="sec01_banner sec01_banner03">
            <div class="sec01_textwrapper">
              <h5>OPEN</h5>
              <h3>HTML의 정석</h3>
              <h3>개발자를 위한 HTML강의</h3>
            </div>
            <img src="front/images/sec01_banner03.png" alt="">
          </div>
        </li>
        <li class="swiper-slide">
          <div class="sec01_banner sec01_banner04">
            <div class="sec01_textwrapper">
              <h5>BEST</h5>
              <h3>이달의 베스트 선생님</h3>
              <h3>웹코딩의 절대강자 김동주</h3>
            </div>
            <img src="front/images/sec01_banner04.png" alt="">
          </div>
        </li>
      </ul>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
      <div class="autoplay-progress">
        <svg viewBox="0 0 48 48">
          <circle cx="24" cy="24" r="20"></circle>
        </svg>
        <span></span>
      </div>
    </div>
  </div>
</section>
<section class="sec02 container">
  <h5>sec02카테고리가 나올 부분입니다</h5>
  <ul>
    <li>카테1</li>
    <li>카테2</li>
    <li>카테3</li>
    <li>카테4</li>
    <li>카테5</li>
    <li>카테6</li>
  </ul>
</section>
<section class="sec03 container">
  <h5>sec03 베스트 추천 강좌</h5>
  <div></div>
</section>
<section class="sec04 container">
  <h5>sec04 지금 가장 인기있는 레시피</h5>
  <div></div>
</section>
<section class="sec05">
  <div class="container d-flex">
    <div class="reviewContent">
      <h3 class="headt3 reviewTitle">수강생들의 이야기,
      코드이븐에서 확인해보세요!</h3>
      <a href="" alt="" class="reviewMore">수강평 더보기 ></a>
    </div>
    <div class="swiper sec05_swiper">
      <ul class="swiper-wrapper">
        <li class="swiper-slide">
          <div class="reviewBG">
            <div>
              <div>
                <p class="body2 review_title">기초부터 확실하게!</p>
                <div class="box">
                  <span class="review_bk">성춘향</span><span class="body2 review_date">2024년 11월 30일</span>
                </div>
              </div>
              <span>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
            </div>
            <p class="review_bk">너무 쉽게 알려주셔서 감사합니다. 덕분에 많은 걸 배울 수 있었어요.</p>
          </div>
        </li>
        <li class="swiper-slide">
          <div class="reviewBG">
            <div>
              <div>
                <p class="body2 review_title">기초부터 확실하게!</p>
                <div class="box">
                  <span class="review_bk">성춘향</span><span class="body2 review_date">2024년 11월 30일</span>
                </div>
              </div>
              <span>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
            </div>
            <p class="review_bk">너무 쉽게 알려주셔서 감사합니다. 덕분에 많은 걸 배울 수 있었어요.</p>
          </div>
        </li>
        <li class="swiper-slide">
          <div class="reviewBG">
            <div>
              <div>
                <p class="body2 review_title">기초부터 확실하게!</p>
                <div class="box">
                  <span class="review_bk">성춘향</span><span class="body2 review_date">2024년 11월 30일</span>
                </div>
              </div>
              <span>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
            </div>
            <p class="review_bk">너무 쉽게 알려주셔서 감사합니다. 덕분에 많은 걸 배울 수 있었어요.</p>
          </div>
        </li>
        <li class="swiper-slide">
          <div class="reviewBG">
            <div>
              <div>
                <p class="body2 review_title">기초부터 확실하게!</p>
                <div class="box">
                  <span class="review_bk">성춘향</span><span class="body2 review_date">2024년 11월 30일</span>
                </div>
              </div>
              <span>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
            </div>
            <p class="review_bk">너무 쉽게 알려주셔서 감사합니다. 덕분에 많은 걸 배울 수 있었어요.</p>
          </div>
        </li>
        <li class="swiper-slide">
          <div class="reviewBG">
            <div>
              <div>
                <p class="body2 review_title">기초부터 확실하게!</p>
                <div class="box">
                  <span class="review_bk">성춘향</span><span class="body2 review_date">2024년 11월 30일</span>
                </div>
              </div>
              <span>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
            </div>
            <p class="review_bk">너무 쉽게 알려주셔서 감사합니다. 덕분에 많은 걸 배울 수 있었어요.</p>
          </div>
        </li>
        <li class="swiper-slide">
          <div class="reviewBG">
            <div>
              <div>
                <p class="body2 review_title">기초부터 확실하게!</p>
                <div class="box">
                  <span class="review_bk">성춘향</span><span class="body2 review_date">2024년 11월 30일</span>
                </div>
              </div>
              <span>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
            </div>
            <p class="review_bk">너무 쉽게 알려주셔서 감사합니다. 덕분에 많은 걸 배울 수 있었어요.</p>
          </div>
        </li>
        <li class="swiper-slide">
          <div class="reviewBG">
            <div>
              <div>
                <p class="body2 review_title">기초부터 확실하게!</p>
                <div class="box">
                  <span class="review_bk">성춘향</span><span class="body2 review_date">2024년 11월 30일</span>
                </div>
              </div>
              <span>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
            </div>
            <p class="review_bk">너무 쉽게 알려주셔서 감사합니다. 덕분에 많은 걸 배울 수 있었어요.</p>
          </div>
        </li>
        <li class="swiper-slide">
          <div class="reviewBG">
            <div>
              <div>
                <p class="body2 review_title">기초부터 확실하게!</p>
                <div class="box">
                  <span class="review_bk">성춘향</span><span class="body2 review_date">2024년 11월 30일</span>
                </div>
              </div>
              <span>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
            </div>
            <p class="review_bk">너무 쉽게 알려주셔서 감사합니다. 덕분에 많은 걸 배울 수 있었어요.</p>
          </div>
        </li>
        <li class="swiper-slide">
          <div class="reviewBG">
            <div>
              <div>
                <p class="body2 review_title">기초부터 확실하게!</p>
                <div class="box">
                  <span class="review_bk">성춘향</span><span class="body2 review_date">2024년 11월 30일</span>
                </div>
              </div>
              <span>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </span>
            </div>
            <p class="review_bk">너무 쉽게 알려주셔서 감사합니다. 덕분에 많은 걸 배울 수 있었어요.</p>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>
<section class="sec06 container">
  <h5>sec06 이달의 BEST 선생님</h5>
  <div></div>
</section>
<section class="sec07">
  <div class="container d-flex justify-content-between sec_height align-items-center">
    <div class="">
      <h3>현직자 리드멘토가 되어주세요!</h3>
      <h5>여러분들만의 지식과 배움을 공유하고 <br>
      코드이븐의 꿈나무들에게 미래를 응원해주세요!</h5>
      <p class="tc_borderline_banner mt-4">
        <a href="tc_applyform.php">강사 신청하러 가기</a>
      </p>
    </div>  
    <div class="logo_img d-flex align-items-center">
      <h1 class="logo">CODE EVEN</h1>
      <img src="front/images/superhero.png" alt="">
    </div>
  </div>
</section>
<section class="sec08 container">
  <h5>sec08 최신 강좌</h5>
  <div></div>
</section>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/CODE_EVEN/front/inc/footer.php');
?>