<?php
$chapterNo = $_GET['ch'];
$coursename = $_GET['course'];
$db = new SQLite3('../../db/table.db');
if (!$db) {
    echo $db->lastErrorMsg();
    exit();
}
$sql = "SELECT Chapter.* FROM `Chapter` JOIN `Course` ON Chapter.course_id = Course.id WHERE Course.name = '$coursename' AND Chapter.chapterNo = $chapterNo";
$result = $db->query($sql);
$row = $result->fetchArray(SQLITE3_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เอกสารประกอบการสอน</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
        embed {
            width: 100vw;
            height: 100vh;
        }
    </style>
</head>
<body>
    <?php if ($row): ?>
        <embed src="data:application/pdf;base64,<?php echo base64_encode($row['file_content']); ?>" type="application/pdf" />
    <?php else: ?>
        <p>ไม่พบเอกสารประกอบการสอน</p>
    <?php endif; ?>
</body>