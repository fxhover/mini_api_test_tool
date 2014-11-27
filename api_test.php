<?php
$configs = array(
  array(
    'title' => '翻译项目创建API测试工具',
    'method' => 'POST',
    'action' => 'http://192.168.5.253:3000/api/v3/translations/create_or_update_project',
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
  ),
  array(
    'title' => '翻译任务创建API测试工具',
    'method' => 'POST',
    'action' => 'http://192.168.5.253:3000/api/v3/translations/create_or_update_task',
    'fields' => array(
      'task[platform_project_id]' => '翻译平台项目ID',
      'task[username]' => '创建创建者username',
      'task[platform_task_id]' => '翻译平台任务ID',
      'task[title]' => '任务标题',
      'task[description]' => '任务描述',
      'task[start_time]' => '开始时间',
      'task[end_time]' => '结束时间',
      'task[status]' => '状态'
    ),
    'header_token_name' => 'AUTHENTICATION-TOKEN',
    'header_token_value' => 'bca863abd05084319371e9057c468fc2'
  )
);

if (!empty($_POST)){
  $index = $_POST['index'];
  unset($_POST['index']);
  $options = array(
    CURLOPT_URL => $configs[$index]['action'],
    CURLOPT_HEADER => 0,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_HTTPHEADER => array("{$configs[$index]['header_token_name']}: {$configs[$index]['header_token_value']}"),
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_CUSTOMREQUEST => $configs[$index]['method'],
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
      function submit_test(number){
        $.ajax({url: "", type: 'POST', data: $("#form_" + number).serialize(), dataType: 'text', timeout: 5000, success: function(result){
          alert(result);
          $('#form_' + number + '_result').val(result);
        }});
      }
    </script>
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
    <title>API测试工具</title>
  </head>
  <body>
    <?php foreach($configs as $index=>$config) { ?>
      <h2><?php echo $config['title'];?></h2>
      <form id="form_<?php echo $index;?>">
        <div>
        <input type="hidden" name="index" value="<?php echo $index;?>" />
        <?php foreach($config['fields'] as $column => $des) {?>
          <p>
            <?php echo $des;?>:<input type="text" name="<?php echo $column; ?>" size="50"/> 
          </p>
        <?php } ?>
        <p>结果：<textarea id="form_<?php echo $index;?>_result" rows="10" cols="50"></textarea></p>
        <p><a href="javascript:void(0);" onclick="submit_test(<?php echo $index;?>);">提交</a></p>
        </div>
      </form>
      <hr/>
    <?php } ?>
  </body>
</html>



