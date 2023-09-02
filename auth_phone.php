<?php
// POST: /auth
$userPhoneNum = $_POST['userPhoneNum'];

try {
  // Twilio API를 사용하여 문자 메시지를 보냄
  $twilio = new Twilio\Rest\Client($accountSid, $authToken);
  $message = $twilio->messages->create(
    $userPhoneNum,
    array(
      'from' => $twilioPhoneNumber,
      'body' => 'Your verification code is: ' . $verificationCode
    )
  );

  // 정상적으로 문자가 보내진 경우
  http_response_code(200);
} catch (Exception $err) {
  error_log('error is ' . $err);
  http_response_code(500);
  echo json_encode(array('error' => $err));
}


// POST: /auth/verify
$userVerifyNum = $_POST['userVerifyNum'];
$userPhoneNum = $_POST['userPhoneNum'];

if (isset($userVerifyNum) && isset($userPhoneNum)) {
  if ($tempAuthObj[$userPhoneNum] === (int)$userVerifyNum) {
    unset($tempAuthObj[$userPhoneNum]);
    http_response_code(200);
  } else {
    http_response_code(401);
  }
} else {
  if (empty($userPhoneNum)) {
    http_response_code(400);
    echo json_encode('변경할 휴대폰 번호를 입력해주세요');
  } else if (!isset($userVerifyNum)) {
    http_response_code(400);
    echo json_encode('인증번호를 입력해주세요');
  } else {
    http_response_code(400);
    echo json_encode('변경할 휴대폰 번호를 입력해주세요');
  }
}
?>
