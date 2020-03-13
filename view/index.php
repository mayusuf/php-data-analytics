<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $title; ?></title>
	</head>
	<body>
		<form action="index.php" method="post" enctype="multipart/form-data">
			File Name: <input type="text" name="file_name" /> <br><br>
			File Name: <input type="file" name="file_upload" /> <br> <br>
			<input type="hidden" name="action" value="file_upload" />
			<input type="submit" name="Upload" /> <br> <br>
		</form>
	</body>
</html>


