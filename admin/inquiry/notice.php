<?php
$title = "문의게시판 관리";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');

// 게시글 개수 구하기
$keywords = isset($_GET['keywords']) ? $mysqli->real_escape_string($_GET['keywords']) : '';
$where_clause = '';

if ($keywords) {
  $where_clause = "WHERE notice.title LIKE '%$keywords%' OR user.username LIKE '%$keywords%' OR user.userid LIKE '%$keywords%'";
}

$page_sql = "SELECT COUNT(*) AS cnt FROM notice JOIN user ON notice.uid = user.uid $where_clause";
$page_result = $mysqli->query($page_sql);
$page_data = $page_result->fetch_assoc();
$row_num = $page_data['cnt'];

// 페이지네이션
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$list = 10;
$start_num = ($page - 1) * $list;
$block_ct = 5;
$block_num = ceil($page / $block_ct);
$block_start = (($block_num - 1) * $block_ct) + 1;
$block_end = $block_start + $block_ct - 1;

$total_page = ceil($row_num / $list);
$total_block = ceil($total_page / $block_ct);
if ($block_end > $total_page) {
  $block_end = $total_page;
}

$sql = "SELECT notice.*, user.username, user.userid 
        FROM notice 
        JOIN user ON notice.uid = user.uid 
        $where_clause 
        ORDER BY notice.ntid DESC 
        LIMIT $start_num, $list";
$result = $mysqli->query($sql);

$dataArr = [];
while ($data = $result->fetch_object()) {
  $dataArr[] = $data;
}
?>

<div class="container">
  <h2>전체 공지사항</h2>
  <form action="" method="get" class="row justify-content-end">
    <div class="col-lg-4">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="검색어를 입력하세요." name="keywords"
          value="<?= htmlspecialchars($keywords); ?>">
        <button type="submit" class="btn btn-secondary">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>
  </form>

  <form action="notice_write.php" method="POST">
    <table class="table list_table">
      <thead>
        <tr>
          <th scope="col">번호</th>
          <th scope="col">아이디</th>
          <th scope="col">이름</th>
          <th scope="col">제목</th>
          <th scope="col">조회수</th>
          <th scope="col">등록일</th>
          <th scope="col">상태</th>
        <?php if ($level == 100): ?>
          <th scope="col">관리</th>
        <?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($dataArr) {
          foreach ($dataArr as $no) {
            ?>
            <tr>
              <td><?= $no->ntid; ?></td>
              <td><?= $no->userid; ?></td>
              <td><?= $no->username; ?></td>
              <td>
              <?php if ($level == 100): ?>
                <a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice_modify.php?ntid=<?= $no->ntid; ?>"
                  class="underline"><?= $no->title; ?>
                </a>
              <?php endif; ?>
              <?php if ($level == 10): ?>
                <a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice_details.php?ntid=<?= $no->ntid; ?>"
                  class="underline"><?= $no->title; ?>
                </a>
              <?php endif; ?>
              </td>
              <td><?= $no->view; ?></td>
              <td><?= $no->regdate; ?></td>
              <td>
                <?php
                $class = $no->status == 'on' ? 'text-bg-success' : 'text-bg-light';
                $text = $no->status == 'on' ? '노출' : '숨김';
                echo "<span class='badge $class'>$text</span>";
                ?>
              </td>
              <?php if ($level == 100): ?>
              <td class="edit_col">
                <a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice_modify.php?ntid=<?= $no->ntid; ?>">
                  <i class="bi bi-pencil-fill"></i>
                </a>
                <a
                  href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/inquiry/notice_delete.php?ntid=<?= $no->ntid; ?>">
                  <i class="bi bi-trash-fill"></i>
                </a>
              </td>
              <?php endif; ?>
            </tr>
            <?php
          }
        } else {
          echo "<tr><td colspan='10'>검색 결과가 없습니다.</td></tr>";
        }
        ?>
      </tbody>
    </table>
    <?php if ($level == 100): ?>
    <button type="submit" class="btn btn-secondary ms-auto d-block">등록</button>
    <?php endif; ?>
  </form>
</div>

<!-- //Pagination -->
<div class="list_pagination" aria-label="Page navigation example">
  <ul class="pagination d-flex justify-content-center">
    <?php
    $previous = $block_start - $block_ct;
    if ($previous < 1)
      $previous = 1;
    if ($block_num > 1) {
      ?>
      <li class="page-item">
        <a class="page-link" href="notice.php?page=<?= $previous; ?>" aria-label="Previous">
          <i class="bi bi-chevron-left"></i>
        </a>
      </li>
      <?php
    }
    ?>
    <?php
    for ($i = $block_start; $i <= $block_end; $i++) {
      $active = ($page == $i) ? 'active' : '';
      ?>
      <li class="page-item <?= $active; ?>"><a class="page-link" href="notice.php?page=<?= $i; ?>"><?= $i; ?></a></li>
      <?php
    }
    $next = $block_end + 1;
    if ($total_block > $block_num) {
      ?>
      <li class="page-item">
        <a class="page-link" href="notice.php?page=<?= $next; ?>" aria-label="Next">
          <i class="bi bi-chevron-right"></i>
        </a>
      </li>
      <?php
    }
    ?>
  </ul>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>