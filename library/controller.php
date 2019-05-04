<?php

$con = mysqli_connect("localhost","root","","db_barang");


class oop
{
	
	function login_level($username,$password,$level)
	{
		global $con;
		$sql   = "SELECT * FROM table_user WHERE username = '$username' AND password = '$password'";
		$query = mysqli_query($con,$sql);
		$baca  = mysqli_num_rows($query);
		$assoc = mysqli_fetch_assoc($query);
		if ($baca > 0) {
			if($assoc['level'] == "Admin" && $level == "Admin"){
				echo "<script>alert('Selamat Datang $username');document.location.href='dashboard.php'</script>";
				$_SESSION['username'] = $username;
			}
			else if($assoc['level'] == "Kasir" && $level == "Kasir"){
				echo "<script>alert('Selamat Datang $username');document.location.href='dashboard_kasir.php'</script>";
				$_SESSION['username'] = $username;
			}
			else if($assoc['level'] == "Manager" && $level == "Manager"){
				echo "<script>alert('Selamat Datang $username');document.location.href='dashboard_manager.php'</script>";
				$_SESSION['username'] = $username;
			}
			else{
				echo "<script>alert('Hak Akses Salah');document.location.href='Login.php'</script>";
			}
		}
		else{
			echo "<script>alert('Username atau Password Salah');document.location.href='Login.php'</script>";
		}
	}

	public function check_session(){
		if(isset($_SESSION['username'])){
			return "true";
		}
		else{
			return "false";
		}
	}

	public function data_table($table){
		global $con;
		$sql = "SELECT * FROM $table";
		$query = mysqli_query($con,$sql);
		$data = [];
		while ($tampung = mysqli_fetch_assoc($query)) {
			$data[] = $tampung;
		}
		return $data;
	}

	public function autokode($table,$field,$pre){
            global $con;
            $sqlc   = "SELECT COUNT($field) as jumlah FROM $table";
            $querys = mysqli_query($con,$sqlc);
            $number = mysqli_fetch_assoc($querys);
            if($number['jumlah'] > 0){
                $sql    = "SELECT MAX($field) as kode FROM $table";
                $query  = mysqli_query($con,$sql);
                $number = mysqli_fetch_assoc($query);
                $strnum = substr($number['kode'],3);
                $strnum = $strnum + 1;
               	if (strlen($strnum) == 4) {
               		$kode = $pre.$strnum;
               	}
               	elseif(strlen($strnum) == 3){
               		$kode = $pre."0".$strnum;
               	}
               	elseif(strlen($strnum) == 2){
               		$kode = $pre."00".$strnum;
               	}
               	elseif(strlen($strnum) == 1){
               		$kode = $pre."000".$strnum;
               	}
               }
               else{
               		$kode = $pre."0001";
               }
          

            return $kode;
        }
           

        

        public function insert($table,$value,$form){
        	global $con;
        	$sql = "INSERT INTO $table VALUES($value)";
        	$query = mysqli_query($con,$sql);
        	if($query > 0){
        		echo "<script>alert('Data Berhasil Di input');document.location.href='?$form'</script>";
        	}else{
        	echo "<script>alert('Data Gagal Di input');document.location.href='?$form'</script>";
        	}
        }

        public function edit($table,$where,$values){
        	global $con;
        	$sql = "SELECT * FROM $table WHERE $where = '$values'";
        	$query = mysqli_query($con,$sql);
        	$data = mysqli_fetch_assoc($query);
        	return $data;
        		
        }

        public function update($table,$values,$where,$value,$form){
        	global $con;
        	$sql = "UPDATE $table SET $values WHERE $where = '$value'";
        	$query = mysqli_query($con,$sql);
        	if($query > 0){
        		echo "<script>alert('Data Berhasil Di ubah');document.location.href='?$form'</script>";
        	}
        	else{
        		echo "<script>alert('Data Gagal Di ubah');document.location.href='?$form'</script>";
        	}
        }

        public function delete($table,$where,$values,$form){
        	global $con;
        	$sql = "DELETE FROM $table WHERE $where = '$values'";
        	$query = mysqli_query($con,$sql);
        	if($query > 0){
        		echo "<script>alert('Data Berhasil Di hapus');document.location.href='?$form'</script>";
        	}
        	else{
        		echo "<script>alert('Data Gagal Hapus');document.location.href='?$form'</script>";
        	}
        }

        public function delete_foto(){
        	$id = $_GET['id'];
        	$gambar = $_GET['nama'];
        	$sql = "DELETE FROM tbl_foto WHERE id_foto = '$id'";
        	$query = mysqli_query($con,$sql);
        	if(file_exists('foto/'.$gambar)){
        		unlink('foto'.$gambar);
        	}
        	
        }

         public function logout(){
            session_destroy();
            header("Location:Login.php");
        }

        public function foto($file){
        $nama_file = $file['name'];
        $tmp_file = $file['tmp_name'];
        $ukuran_file = $file['size'];

        $folder = 'image/';
        $ektensi = ['jpg','png','jpeg'];
        $ekstensi_gambar = explode('.',$nama_file);
        $ekstensi_gambar = strtolower(end($ekstensi_gambar));
        if(file_exists("image/".$nama_file)){
            echo "<script>alert('Foto Sudah Ada/Nama File Sama')</script>";
            return false;
        }
        else{
            if (in_array($ekstensi_gambar,$ektensi) == true) {
                if ($ukuran_file < 1500000) {
                    move_uploaded_file($tmp_file,$folder.$nama_file);
                }
                else{
                    echo "<script>alert('Ukuran Terlalu Besar')</script>";
              return false;
                }
            }
            else{
                echo "<script>alert('Ekstensi Tidak Di Perbolehkan')</script>";
            return false;
            }
        }
        return $nama_file;
        }

        public function select_fields($table,$where,$value){
        	global $con;
        	$sql = "SELECT * FROM $table WHERE $where = '$value'";
        	$query = mysqli_query($con,$sql);
        	$data = [];
			while ($tampung = mysqli_fetch_assoc($query)) {
				$data[] = $tampung;
				}
			return $data;
        }

        public function count($field,$name,$table){
        	global $con;
        	$sql = "SELECT COUNT($field) AS $name FROM $table";
        	$query = mysqli_query($con,$sql);
        	$assoc = mysqli_fetch_assoc($query);
        	return $assoc;
        }
        public function select_field($table,$field,$v1){
            global $con;
            $sql = "SELECT * FROM $table WHERE $field = '$v1'";
            $query = mysqli_query($con,$sql);
            $assoc = mysqli_fetch_assoc($query);
            return $assoc;
        }
        public function count_where($field,$name,$table,$w1,$v1){
            global $con;
            $sql = "SELECT COUNT($field) AS $name FROM $table WHERE $w1 = '$v1'";
            $query = mysqli_query($con,$sql);
            $datas = mysqli_fetch_assoc($query);
            return $datas;
        }
        // public function select_where2_fields(){
        //     $sql = "SELECT * FROM $table WHERE $field1 = '$'"
        // }
        public function sum_where($field,$name,$table,$f1,$v1){
            global $con;
            $sql = "SELECT SUM($field) AS $name FROM $table WHERE $f1 = '$v1'";
            $query = mysqli_query($con,$sql);
            $data = mysqli_fetch_assoc($query);
            return $data;
        }
        public function between($table,$field,$v1,$v2){
            global $con;
            $sql = "SELECT * FROM $table WHERE $field BETWEEN '$v1' AND '$v2'";
            $query = mysqli_query($con,$sql);
            $data = [];
            while ($tampung = mysqli_fetch_assoc($query)) {
                $data[] = $tampung;
            }
            return $data;
        }
        public function update_where_2($table,$values,$w1,$v1,$w2,$v2,$form){
            global $con;
            $sql = "UPDATE $table SET $values WHERE $w1 = '$v1' AND $w2 = '$v2'";
            $query = mysqli_query($con,$sql);
            if($query > 0){
            echo "<script>alert('Data Berhasil Di ubah');document.location.href='?$form'</script>";
            }
            else{
            echo "<script>alert('Data Gagal Di ubah');document.location.href='?$form'</script>";
            }
        }



      







}





?>