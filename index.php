<?php
    include_once ('scramblerf.php');

    $task = "encode";

    if ( isset($_GET['task']) && $_GET['task'] != '' ) {
        $task = $_GET['task'];
    }

	$key = "abcdefghijklmnopqrstuvwxyz1234567890$#&*_";
// Generating random key
    if ( 'key' == $task ) {
        $key_original = str_split($key);
        shuffle($key_original);
        $key = join('', $key_original);
    } elseif ( isset($_REQUEST['key']) && $_REQUEST['key'] != '' ) {
        $key = $_REQUEST['key'];
    }

//    Encoding data
    $scrambledData = '';

    if ( 'encode' == $task ) {
        $data = $_POST['data'] ?? '';
        if ( $data != '' ) {
           $scrambledData = scrambleData($data, $key);
        }
    }

//    Decoding data
	if ( 'decode' == $task ) {
		$data = $_POST['data'] ?? '';
		if ( $data != '' ) {
			$scrambledData = decodeData($data, $key);
		}
	}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Data Scrambler</title>
</head>
<body>
 <div class="container">
     <div class="description">
         <h1>Data Scrambler</h1>
         <p>Use this application to scramble your data</p>
         <p>
             <a href="./index.php?task=encode">Encode |</a>
             <a href="./index.php?task=decode">Decode |</a>
             <a href="./index.php?task=key">Generate Key</a>
         </p>
     </div>
     <div class="form">
         <form method="POST" action="index.php<?php if ('decode' == $task) { echo '?task=decode'; }?>">
             <label for="key" class="form-label mb-3">Key</label>
             <input type="text" name="key" id="key" class="form-control mb-3" <?php displayKey($key); ?>>
             <label for="data" class="form-label">Data</label>
             <textarea name="data" id="data" rows="3" class="form-control mb-3"><?php if (isset($_POST['data'])) {
                 echo $_POST['data']; }
                 ?></textarea>
             <label for="result" class="form-label">Result</label>
             <textarea name="result" id="result" rows="3" class="form-control mb-3"><?php echo $scrambledData;
             ?></textarea>
             <button type="submit" class="btn btn-primary">Do it for me</button>
         </form>
     </div>
 </div>
</body>
</html>