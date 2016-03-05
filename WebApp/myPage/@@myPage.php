

<!DOCTYPE html>
<html>
<head>
  <!-- 
  Name : myPage.html
  Description : 내 정보 보기
  Modification Information
  1. 2016.02.10. 남현석 최초생성
  2. 2016.02.12.  "" 프레임 완성
  3. 2016.02.18.  "" 포인트 기능추가

  since
  version 1.1
  see
  -->
  <title>accounts for LotteMall customer</title>
  <meta name ="author" Content="Web Application Project Team">
  <meta name ="keywords" Content="Lotte, mall, shopping, 롯데, 쇼핑">
  <meta name ="description" Content="GPS기반 쇼핑전용 애플리케이션입니다.">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- CSS -->
  
  <link rel="stylesheet" href="../style/css/bootstrap.min.css" type="text/css">

  <!-- Plugin CSS -->
  <link rel="stylesheet" href="../style/css/animate.min.css" type="text/css">
  <link rel="stylesheet" href="../style/css/m.v2.min.css" type="text/css">

  <!-- backward Operator -->
  <!-- jQuery -->
  <script src="../style/js/jquery.js"></script>
  <!-- Bootstrap Core js -->
  <script src="../style/js/bootstrap.min.js"></script>

  <!-- Plugin js -->
  <script src="../style/js/jquery.easing.min.js"></script>
  <script src="../style/js/jquery.fittext.js"></script>
  <script src="../style/js/wow.min.js"></script>

</head>
<body onload="test(); sendWhichPlatform();">

  <div class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../index.html">Lotte Mall</a>
        </div>
<?php 

require_once ($_SERVER['DOCUMENT_ROOT']."/preset.php");

session_start();
//$post = $_POST['flag'];
$data = json_decode(file_get_contents('php://input'),true);
$flag = $data['flag'];

	$is_logged = $_SESSION['is_logged'];
	$usr_id = $_SESSION['usr_id'];
	$account_idx = $_SESSION['account_idx'];
	
	$query = "SELECT point FROM account WHERE id ='{$usr_id}'";
	$result = mysql_query($query);
	$res = mysql_fetch_row($result); //
	
	$_SESSION['point'] = $res[0];
	
	$point = $_SESSION['point'];
	
	$message = $usr_id . ' 님, 로그인 했습니다.<br />';

	//echo "<script>account_idx='$account_idx'; point='$point';</script>";
?>
        <!-- Collect the nav links, forms, and other content for toggling ('in': open, '': close, 'active': click effect)-->
        <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-left">
            <li>
              <a href="isLogin.php">마이정보</a>
            </li>
            <li>
              <a href="#">프로모션/쿠폰</a>
            </li>
            <li>
              <a href="#">오프라인매장</a>
            </li>
            
            <li>
              <a href="../php_db/logout.php">로그아웃</a>
            </li>
            <!--
            <li class="divider"></li>
            -->
          </ul>

          <form class="navbar-form navbar-right" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">상품 검색</button>
          </form>
             <ul class="nav navbar-nav navbar-right">
            <li><a href="./myCartisNotEmpty.html">장바구니</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><?php echo $usr_id." "; ?>님 환영합니다.           </a></li>
          </ul>
        </div><!-- end of navbar -->
      </div><!-- end of container -->
    </div>

    <!--  blank -->
    <div id="blank" style="height:50.5px; width:100%"></div>

    <!-- topMenu -->
    <nav id="topMenu" >
      <ul id="scroller">
        
        <li>
          <a class="top-menu0 on" href="./myPage.php" data-cclick="MOBILE_B,SCROLLER,TODAYRECOMM,0">포인트/쿠폰</a>
        </li>
        
        <li>
          <a class="top-menu1" href="isMyAccount.php" data-cclick="MOBILE_B,SCROLLER,TODAYRECOMM,0">개인정보확인/수정</a>
        </li>
        
        <li>
          <a class="top-menu2" href="#" data-cclick="MOBILE_B,SCROLLER,TODAYRECOMM,0">주문목록</a>
        </li>
    
        <li>
          <a class="top-menu3" href="#" data-cclick="MOBILE_B,SCROLLER,TODAYRECOMM,0">취소반품내역</a>
        </li>
    
        <li>
          <a class="top-menu4" href="#" data-cclick="MOBILE_B,SCROLLER,TODAYRECOMM,0">상품평</a>
        </li>
    
        <li>
          <a class="top-menu5" href="#" data-cclick="MOBILE_B,SCROLLER,TODAYRECOMM,0">FAQ보기</a>
        </li>
    
        <li>
          <a class="top-menu6" href="#" data-cclick="MOBILE_B,SCROLLER,TODAYRECOMM,0">고객의소리</a>
        </li>
    
        <li>
          <a class="top-menu7" href="#" data-cclick="MOBILE_B,SCROLLER,TODAYRECOMM,0">문의내역 확인</a>
        </li>
    
        <li>
          <a class="top-menu8" href="#" data-cclick="MOBILE_B,SCROLLER,TODAYRECOMM,0">전화문의</a>
        </li>
      </ul>
      <span id="scroller-left" class="scroller-arr-left" data-cclick="MOBILE_B,SCROLLER,LEFT,0"></span>
      <span id="scroller-right" class="scroller-arr-right" data-cclick="MOBILE_B,SCROLLER,RIGHT,0"></span>
    </nav>

    <script src="../style/js/iscroll.js" type="text/javascript"></script>
    <script src="../style/js/topMenuScript.js" type="text/javascript"></script>
    <script src="../style/js/floatingTitle.js" type="text/javascript"></script>

    <!--  blank -->
    <div id="blank" style="height:50.5px; width:100%"></div>

    <div class="list-group" style="width:80%; margin-left: auto; margin-right:auto">
      <a href="#" class="list-group-item active">
        
      </a>
      <a href="#" class="list-group-item" style="font-weight: bold;">사용가능 포인트
      </a>
      <p id="point" href="#" class="list-group-item">
      <!-- 소멸예정 0 P | 예치금 0 P  --> <?php echo $point. " 점";?>
      </p>

    </div>

    <div class="list-group" style="width:80%; margin-left: auto; margin-right:auto">
      <a href="#" class="list-group-item active">
        
      </a>
      <a href="#" class="list-group-item" style="font-weight: bold;">사용가능 쿠폰
      </a>
      <a href="#" class="list-group-item">
        배송비 1회 무료 쿠폰
      </a>
      <a href="#" class="list-group-item">
        2만원 이상 상품 10%할인 쿠폰
      </a>
    </div>

    <form class="form-horizontal" style="width:80%; margin-left: auto; margin-right:auto">
      <fieldset>
        <div class="form-group">
          <label for="inputEmail" class="col-lg-2 control-label">교환권 코드 등록</label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="inputEmail" placeholder="'-' 없이 20자리를 입력하세요.">
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="reset" class="btn btn-default">취소</button>
            <button type="submit" class="btn btn-primary">등록</button>
          </div>
        </div>
      </fieldset>
    </form>


<script>
/*
	var account_idx;
    var point;
    $(document).ready(init);
      function init() {
    	  document.getElementById("point").innerHTML = point;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../php_db/points.php');
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 && xhr.status === 200){
                var _tzs = xhr.responseText;
                tzs = JSON.parse(_tzs);
                var _str = '';
                    point = tzs[0].point + ' 원' ; //포인트
                document.getElementById("point").innerHTML = point;
            }
            document.getElementById("point").innerHTML = 'aa로그인이 필요합니다.'; //포인트
        }
        var data = new Object();
        data.account_idx = account_idx;
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(JSON.stringify(data));

      }
*/
function isMobile() {
    var filter = "win16|win32|win64|mac|macintel";
    if( navigator.platform  ){
      if( filter.indexOf(navigator.platform.toLowerCase())<0 ){
        return true;
      }else{
        return false;
      }
    }
  }

var latlngCount;

function sendWhichPlatform(){
        if(isMobile()) {
          console.log("모바일이다");
          
          var xhr = new XMLHttpRequest();
     	  xhr.open('POST', '../php_db/wishList.php');
     	  xhr.onreadystatechange = function(){
     	     if(xhr.readyState === 4 && xhr.status === 200){
     	        var _tzs = xhr.responseText;   
     	        tzs = JSON.parse(_tzs);
	            var _str='';
	            latlngCount = tzs.length;
	            for(var i = 0; i< latlngCount; i++){
		            var product_idx = tzs[i].product_idx;
		            var market_name = tzs[i].market_name;
		            var lat = tzs[i].latitude;
		            var lng = tzs[i].longitude;
		            sendJSON(product_idx,market_name,lat,lng);
     	        }
     	     }
         var data = new Object();
         data.account_idx = account_idx;
         xhr.setRequestHeader("Content-Type", "application/json");
         xhr.send(JSON.stringify(data)); 
        }
        }
}

function sendJSON(product_idx,market_name,lat,lng){
	
	 var xhr = new XMLHttpRequest();
	  xhr.open('POST', '../myPage/sendlatlng.php');
	  xhr.onreadystatechange = function(){
	     if(xhr.readyState === 4 && xhr.status === 200){
	        var _tzs = xhr.responseText;   
	        tzs = JSON.parse(_tzs);
	     }
    var data = new Object();
    data.product_idx = product_idx;
    data.market_name = market_name;
    data.lat = lat;
    data.lng = lng;
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(data)); 
   }
}
function test(){
	if(isMobile()) {
	 var xhr = new XMLHttpRequest();
	  xhr.open('POST', '../myPage/sendlatlng.php');
	  xhr.onreadystatechange = function(){
	     if(xhr.readyState === 4 && xhr.status === 200){
	        var _tzs = xhr.responseText;   
	        tzs = JSON.parse(_tzs);
	     }
   var data = new Object();
   data.product_idx = 2;
   data.market_name = "롯데백화점";
   data.lat = "lat";
   data.lng = "lng";
   xhr.setRequestHeader("Content-Type", "application/json");
   xhr.send(JSON.stringify(data)); 
  }
	}
}
</script>
<?php 
//var_dump($_SESSION);
mysql_close($connect);
?>
</body>
</html>