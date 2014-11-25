<?php
$config = array(
  'title' => '翻译项目创建API测试工具',
  'method' => 'PUT',
  'action' => 'http://192.168.5.253:3000/api/v3/translations/test1',
  'fields' => array(
    'project[platform_project_id]' => '翻译平台项目ID',
    'project[username]' => '创建创建者username',
    'project[title]' => '项目标题',
    'project[description]' => '项目描述',
    'project[start_time]' => '开始时间',
    'project[end_time]' => '结束时间',
    'project[task_progress]' => '任务量',
    'project[status]' => '状态'
  ),
  'header_token_name' => 'AUTHENTICATION-TOKEN',
  'header_token_value' => 'bca863abd05084319371e9057c468fc2'
);

if (!empty($_POST)){
  $options = array(
    CURLOPT_URL => $config['action'],
    CURLOPT_HEADER => 0,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_HTTPHEADER => array("{$config['header_token_name']}: {$config['header_token_value']}"),
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_CUSTOMREQUEST => $config['method'],
    CURLOPT_POSTFIELDS => http_build_query($_POST)
  );
  $ch = curl_init();
  curl_setopt_array($ch, $options);
  $result = curl_exec($ch);
  curl_close($ch);
  print_r($result);
  exit;
}
?>

<html>
  <head>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script>
      function submit_test(){
        $.ajax({url: "", type: 'POST', data: $("#form_1").serialize(), dataType: 'text', timeout: 5000, success: function(result){
          alert(result);
          $('#form_1_result').val(result);
        }});
      }
    </script>
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
    <title><?php echo $config['title'];?></title>
  </head>
  <body>
    <h2><?php echo $config['title'];?></h2>
    <form id="form_1">
      <div>
      <?php foreach($config['fields'] as $column => $des) {?>
        <p>
          <?php echo $des;?>:<input type="text" name="<?php echo $column; ?>" size="50"/> 
        </p>
      <?php } ?>
      <p>结果：<textarea id="form_1_result" rows="10" cols="50"></textarea></p>
      <p><a href="javascript:void(0);" onclick="submit_test();">提交</a></p>
      </div>
    </form>
  </body>
</html>

