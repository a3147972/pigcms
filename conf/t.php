<?php 
$data =  array (
  'ToUserName' => 'gh_8d45dfafc353',
  'FromUserName' => 'onfo6t1pAigsVLvky418NVqr2lq8',
  'CreateTime' => '1420538492',
  'MsgType' => 'event',
  'Event' => 'subscribe',
  'EventKey' => 'qrscene_19',
  'Ticket' => 'gQFC8ToAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL0QwejU1cXZsbjczbUJaOTlLR0JaAAIEIQGpVAMEAAAAAA==',
);

$id = substr($data['EventKey'], 8);
echo $id;