<u>
<?php
// This code list all sessions and value in server
$files = scandir(session_save_path());
foreach ($files as $file){
  echo  "<li>". $file .":==> ".  file_get_contents( session_save_path() ."\\" . $file) ."<li>";
}
?>
</u>
