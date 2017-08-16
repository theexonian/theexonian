<?php
if (hash('sha256', $_POST['secret']) == '2faf270e76df7d2e3ec491f0bb5c7467f93988034728f8761186d61dc9bfb1f4') {
  require('../wp-config.php');
  $db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $stmt = $db->prepare('INSERT INTO '.$table_prefix.'ads (position, image, tooltip, link) VALUES (?, ?, ?, ?)') or die($db->error);
  $stmt->bind_param('ssss', $_POST['position'], $_POST['image'], $_POST['tooltip'], $_POST['link']) or die($db->error);
  $stmt->execute() or die($db->error);
  $db->close();
  die('OK');
}
?>
