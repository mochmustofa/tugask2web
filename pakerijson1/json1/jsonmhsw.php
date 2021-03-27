<?php
// Check for the path elements
// Turn off error reporting
// error_reporting(1);

// Report runtime errors
// error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Report all errors
error_reporting(E_ALL);

// Same as error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
	case 'GET':
		getDataMahasiswa();
		break;

	case 'POST':
		saveDataMahasiswa();
		break;

	default:
		echo "--- Method not allowed";
		break;
}


function getDataMahasiswa() {
	$link = mysqli_connect('localhost', 'root', '', 'json');

	$nim = isset($_GET['nim']) ? $_GET['nim'] : '';
	if (empty($nim)) {
		$sql = "select * from mahasiswa";
	} else {
		$sql = "select * from mahasiswa where nim='$nim'";
	}

	$result = mysqli_query($link, $sql);

	if (!$result) {
		http_response_code(404);
		die(mysqli_error($link));
	}

	$hasil = array();
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$hasil[] = $row;
	}

	mysqli_close($link);

	if (!empty($nim)) {
		$hasil = isset($hasil[0]) ? $hasil[0] : [];
	}

	$hasil1 = array('status' => true, 'message' => 'Data show succes', 'data' => $hasil);
	echo json_encode($hasil1);
}


function saveDataMahasiswa() {
	$link = mysqli_connect('localhost', 'root', '', 'json');
	mysqli_set_charset($link, 'utf8');

	$input = file_get_contents('php://input');
	$json = json_decode($input, true);
	$nimmhsw = $json["nim"];
	$namamhsw = $json["nama"];
	$prodimhsw = substr(trim($json["prodi"]), 0, 5);

	$querycek = "SELECT * FROM mahasiswa WHERE nim ='$nimmhsw'";
	$result = mysqli_query($link, $querycek);

	if (!$result) {
		http_response_code(404);
		die(mysqli_error($link));
	}

	$mhs = $result->fetch_assoc();
	if (empty($mhs)) {
		$query = "INSERT INTO mahasiswa (nim, nama, prodi)
			VALUES ('$nimmhsw', '$namamhsw', '$prodimhsw')";
		echo "query " . $query;
		mysqli_query($link, $query);

	} else {
		$query = "UPDATE mahasiswa SET
			nama = '$namamhsw',
			prodi = '$prodimhsw'
			WHERE nim ='$nimmhsw'";
		echo "query " . $query;
		mysqli_query($link, $query);

	}

	
	mysqli_close($link);	
}

