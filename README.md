# MindGeek-Task-1
A page on a site was needed to display information about a video. It should be able to display the video's title, its HTML description, and a link to the page itself for sharing.
A developer wrote this piece of code to do the job and review is needed.
What do you think? Are there any obvious issues? Would you write it differently?
Please rewrite it to meet your standards.

<?php
mysql_connect('localhost', 'root', '');
mysql_select_db('mydatabase');
$id = $_GET['id'];
$query = mysql_query("SELECT * FROM videos WHERE id='" . $id . "'");
while ($video = mysql_fetch_assoc($query)) {
echo '<h3>' . $video['title'] . '</h3>';
echo $video['description'];
echo 'You are viewing <a href="' . $_SERVER['PHP_SELF'] . '?id=' . $_GET['id'] . '">This video</a>';

