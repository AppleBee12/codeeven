<?php
$title = "쿠폰수정";
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/header.php');

if (!isset($_SESSION['AUID'])) {
  echo "<script>
  alert('로그인을 해주세요');
  location.href='../login/login.php';
  </script>";
}

// $coupon_image = $_FILES['coupon_image']??'';
// $coupon_name = $_POST['coupon_name'] ?? '';
// $coupon_type = $_POST['coupon_type'] ?? 0;
// $coupon_price = $_POST['coupon_price'] ?? 0;
// $coupon_ratio = $_POST['coupon_ratio'] ?? 0;
// $status = $_POST['status'] ?? 0;
// $max_value = $_POST['max_value'] ?? 0;
// $use_min_price = $_POST['use_min_price'] ?? 0;
// $use_max_date = $_POST['use_max_date'] ?? 'NULL';
// $cp_desc = $_POST['cp_desc'] ?? '';

// // 세션에서 사용자 아이디 가져오기
// $userid = $_SESSION['AUID'] ?? 'guest';


if(isset($_FILES['coupon_image'])){
  if($coupon_image['size'] > 10240000 ){
    echo "
     <script>
       alert('10MB이하만 첨부할 수 있습니다.');
       history.back();
     </script>
    ";
   }
   
   //파일 포멧 검사
   if(strpos($coupon_image['type'], 'image') === false){
     echo "
     <script>
       alert('이미지만 첨부할 수 있습니다.');
       history.back();
     </script>
    ";
   }
  
     //파일 업로드
     $save_dir = $_SERVER['DOCUMENT_ROOT'].'/code_even/images/';
     $filename = $coupon_image['name']; //insta.jpg
     $ext = pathinfo($filename,PATHINFO_EXTENSION); //파일명의 확장자를 추출, jpg
     $newFileName = date('YmdHis').substr(rand(), 0, 6);//202410091717123456
     $savefile = $newFileName.'.'.$ext;//202410091717123456.jpg
     
     if(move_uploaded_file($coupon_image['tmp_name'], $save_dir.$savefile)){ //tmp_name임시파일
       $coupon_image = '/code_even/images/'.$savefile;  
     } else{
       echo "<script>
         alert('이미지를 첨부할 수 없습니다.');
       </script>";
     }

}

// $sql = "INSERT INTO coupons 
//     (coupon_name, coupon_image, coupon_type, coupon_price, coupon_ratio, status, userid, max_value, use_min_price, use_max_date, cp_desc)
//   VALUES
//     ('$coupon_name', '$coupon_image', $coupon_type, $coupon_price, $coupon_ratio, $status, '{$_SESSION['AUID']}', $max_value, $use_min_price, $use_max_date, '$cp_desc')
// ";


$cpid = $_GET['cpid'];

$sql = "SELECT * FROM coupons WHERE cpid = $cpid";
$result = $mysqli->query($sql);
$data = $result->fetch_object();
?>

<style>

.box {
  height: 280px !important;
  width: 383px !important;
  background-color: #ccc !important;
  position: relative;

  span{
    text-wrap: nowrap;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
}
.input-group input{
  width: 400px !important;
}
thead,
  tbody,
  tr,
  th,
  td {
    border-style: none;
  }

#datepicker{
  width: 150px !important;
}
#addedImages span{
  color: #a5a5a5;
}
</style>

<div class="container">
  <h2 class="mb-5">쿠폰 수정</h2>
  <form action="coupon_edit_ok.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="cpid" value="<?= $cpid; ?>"> 
    <table class="table">
      <tbody>
        <tr>
          <th scope="row">쿠폰이미지</th>
          <td>
          <div class="box mb-3" id="addedImages">
          <?php if(isset($_POST['coupon_image'])){
          ?>
            <span>쿠폰 이미지를 등록해주세요.</span>
            <?php 
              }
            ?>
            <div class="image">
              <img src="<?= $data->coupon_image; ?>" >
            </div>
          </div>
          <input type="file" multiple accept="image/*" class="form-control w-50" name="coupon_image" id="coupon_image" value="" required>
        </td>
        </tr>
        <tr>
        <tr>
          <th scope="row">쿠폰명</th>
          <td><input type="text" class="form-control w-25" name="coupon_name" placeholder="쿠폰명을 입력하세요" required value="<?= $data->coupon_name; ?>" ></td>
        </tr>
        <tr>
          <th scope="row">쿠폰내용</th>
          <td><input type="text" class="form-control w-25" name="cp_desc" placeholder="쿠폰내용을 입력하세요" required value="<?= $data->cp_desc; ?>"></td>
        </tr>
        <div class="d-flex">
          <th scope="row">사용기한</th>
          <td class="d-flex gap-5">
            <div class="form-check"  id="ct4">
              <input 
                class="form-check-input" 
                type="radio" 
                name="use_max_date" 
                id="use_max_date1"
                value="unlimited"
                <?= ($data->use_max_date === 'unlimited') ? 'checked' : ''; ?>
                >
              <label class="form-check-label" for="use_max_date1"  >
                무제한
              </label>
            </div>
            <div class="form-check"  id="ct3">
              <input class="form-check-input" 
                type="radio" 
                name="use_max_date" 
                id="use_max_date2"
                value="limited"
                <?= ($data->use_max_date === 'limited') ? 'checked' : ''; ?>
                >
              <label class="form-check-label d-flex gap-3" for="use_max_date2" >
                제한
                <input 
                  type="date" 
                  name="sale_end_date" 
                  id="datepicker" 
                  class="form-control w-25" 
                  value="<?= htmlspecialchars($data->sale_end_date ?? ''); ?>" 
                  <?= ($data->use_max_date === 'limited') ? '' : 'disabled'; ?>
                  >
              </label>
            </div>
          </td>
        </div>
                
        </tr> 
            </td>
          </th>
          <tr>
            <th scope="row">상태</th>
            <td>
              <select class="form-select w-25" name="status" aria-label="상태">                            
                <option value="1" <?php if($data->status == 1){echo 'selected';} ?>>활성화</option>
                <option value="2" <?php if($data->status == 2){echo 'selected';} ?>>비활성화</option>
              </select>
            </td>
          </tr>    
        </div>


          <th scope="row">쿠폰타입</th>
          <td>
            <select class="form-select w-25" name="coupon_type" id="coupon_type" aria-label="쿠폰타입">                            
              <option value="1"  <?php if($data->coupon_type == 1){echo 'selected';} ?>>정액</option>
              <option value="2" <?php if($data->coupon_type == 2){echo 'selected';} ?>>정률</option>
            </select>
          </td>
        </tr>
        <tr id="ct1">
          <th scope="row">할인가</th>
          <td>
            <div class="input-group mb-3 w-50">
              <input type="text" name="coupon_price" class="form-control" aria-label="할인가" value=" <?= $data->coupon_price;?>" aria-describedby="coupon_price"> 
              <span class="input-group-text" id="coupon_price">원</span>
            </div>
          </td>
        </tr>        
        <tr id="ct2">
          <th scope="row">할인비율</th>
          <td>
            <div class="input-group mb-3 w-50">
              <input type="text" name="coupon_ratio" class="form-control" aria-label="할인비율" value="0" aria-describedby="coupon_ratio">
              <span class="input-group-text" id="coupon_ratio">%</span>
            </div>
          </td>
        </tr>  
        <tr>
          <th scope="row">최소사용금액</th>
          <td>
            <div class="input-group mb-3 w-50">
              <input type="text" name="use_min_price" class="form-control" aria-label="최소사용금액" value=" <?= $data->use_min_price;?>" aria-describedby="use_min_price">
              <span class="input-group-text" id="use_min_price">원</span>
            </div>
          </td>
        </tr>        
        <tr id="">
          <th scope="row">최대할인금액</th>
          <td>
            <div class="input-group mb-3  w-50">
              <input type="text" name="max_value" class="form-control" aria-label="최대할인금액" value=" <?= $data->max_value;?>" aria-describedby="max_value">
              <span class="input-group-text" id="max_value">원</span>
            </div>
          </td>
        </tr>   
      </tbody>
    </table>
    <div class="d-flex justify-content-end gap-2">
        <a href="coupons.php" class="btn btn-outline-danger mb-5 cancle">취소</a>
        <button type="submit" class="btn btn-secondary mb-5 ">쿠폰수정</button>
    </div>
  </form>
</div>

<script>
   document.addEventListener('DOMContentLoaded', () => {
  const unlimitedRadio = document.getElementById('use_max_date1');
  const limitedRadio = document.getElementById('use_max_date2');
  const dateInput = document.getElementById('datepicker');

  // 라디오 버튼 클릭 시 활성화/비활성화 처리
  const toggleDateInput = () => {
    if (limitedRadio.checked) {
      dateInput.disabled = false;
    } else {
      dateInput.disabled = true;
      dateInput.value = ''; // 비활성화 시 날짜 초기화
    }
  };

  // 초기화 및 이벤트 리스너 등록
  toggleDateInput();
    unlimitedRadio.addEventListener('change', toggleDateInput);
    limitedRadio.addEventListener('change', toggleDateInput);
  });

  $('.cancle').click(function(){
    location.href='coupons.php';
  });

  $('#ct2 input').prop('disabled', true);

  $('#coupon_type').change(function(){
    let value = $(this).val();
    $('#ct1 input, #ct2 input').prop('disabled', true);
    if(value == 1){
      $('#ct1 input').prop('disabled', false);
    } else{
      $('#ct2 input').prop('disabled', false);
    }
  });
</script>




<?php
include_once($_SERVER['DOCUMENT_ROOT']. '/code_even/admin/inc/footer.php');
?>