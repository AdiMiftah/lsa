<?php
// Membuat koneksi ke database
$host = 'localhost';
$user = 'rswt';
$password = '';
$database = 'tempate';
$koneksi = mysqli_connect($host, $user, $password, $database);

// Mengecek apakah ada file yang diupload
if(isset($_FILES['pdf'])){
    $total_files = count($_FILES['pdf']['name']);

    // Looping untuk menyimpan informasi file ke dalam database
    for($i=0; $i<$total_files; $i++){
        // Informasi file
        $file_name = $_FILES['pdf']['name'][$i];
        $file_tmp = $_FILES['pdf']['tmp_name'][$i];
        $file_size = $_FILES['pdf']['size'][$i];
        
        // Pastikan file yang diupload adalah file PDF
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = array('pdf');
        
        if(in_array($file_ext, $allowed_ext)){
            // Buat direktori untuk menyimpan file jika belum ada
            if(!file_exists('pdf_files')){
                mkdir('pdf_files');
            }
            
            // Pindahkan file ke direktori pdf_files
            move_uploaded_file($file_tmp, 'pdf_files/'.$file_name);
            
            // Simpan informasi file ke dalam database
            $sql = "INSERT INTO karyawan (files, filesize) VALUES ('$file_name', '$file_size')";
            mysqli_query($koneksi, $sql);
        }
    }
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>

<form method="post" action="" enctype="multipart/form-data">
    <input type="file" name="pdf[]" multiple />
    <input type="submit" name="submit" value="Upload" />
</form>
