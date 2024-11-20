<?php
$title = "팀 프로젝트";
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/header.php');
?>

<div class="container">
  <h2><?=$title?></h2>
  <div class="content_bar">
    <h3>글 수정하기</h3>
  </div>

  <form action="">
    <table class="table info_table">
      <tbody>
        <?php
        $post_id = $_GET['post_id'] ?? null;

        if ($post_id) {
          // Prepared Statement로 SQL 작성
          $stmt = $mysqli->prepare("
          SELECT c.*, u.usernick 
          FROM counsel c 
          JOIN user u ON c.uid = u.uid 
          WHERE c.post_id = ?
      ");
      $stmt->bind_param('s', $post_id); // 's'는 string 타입

          // 쿼리 실행
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result && $row = $result->fetch_assoc()) {
            // $row에서 데이터를 가져와서 input 태그에 출력
        ?>
            <tr>
              <th scope="row">
                <label for="titles">글 제목 <b>*</b></label>
              </th>
              <td>
                <input type="text" id="titles" name="titles" class="form-control" placeholder="입력 필수 값 입니다." value="<?= $row['titles'] ?>">
              </td>
              <th scope="row">상태 <b>*</b></th>
              <td class="d-flex gap-3">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="status" value="0" <?= ($row['status'] === '0') ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="status">
                    미해결
                  </label>
                </div>
                <div class="form-check">
                  <input class=" form-check-input" type="radio" name="status" id="status" value="1"<?= ($row['status'] === '1') ? 'checked' : ''; ?>>
                  <label class="form-check-label" for="status">
                    해결
                  </label>
                </div>
              </td>
            </tr>
            <tr>
              <th scope="row">
                <label for="usernick">닉네임</label>
              </th>
              <td>
                <input type="text" id="usernick" name="usernick" class="form-control"  value="<?= $row['usernick'] ?>" disabled readonly>
              </td>
              <th scope="row">
                <label for="regdate">작성일</label>
              </th>
              <td colspan="3">
                <input type="date" id="regdate" name="date" class="form-control w_512" value="<?= date('Y-m-d',strtotime($row['regdate'])) ?>" disabled readonly>
              </td>
            </tr>
            <tr>
              <th scope="row">글 내용 <b>*</b></th>
              <td colspan="5" class="editor">
                <div id="summernote"><?= $row['contents'] ?></div>
              </td>
            </tr>
        <?php
          } else {
            echo "해당 게시글을 찾을 수 없습니다.";
          }

          $stmt->close();
        } else {
          echo "잘못된 요청입니다.";
        }


        ?>
      </tbody>
    </table>
  </form>
  <div class="d-flex justify-content-end gap-2">
    <a href="javascript:history.back();"><button class="btn btn-outline-danger">취소</button></a>
    <a href="http://<?= $_SERVER['HTTP_HOST']; ?>/code_even/admin/community/counsel.php"><button class="btn btn-outline-secondary">수정</button></a>
  </div>
</div>



<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/code_even/admin/inc/footer.php');
?>