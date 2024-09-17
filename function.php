<?php   
    // Koneksi ke database
$servername = "localhost"; // Sesuaikan dengan server database Anda
$username = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Sesuaikan dengan password database Anda
$dbname = "pitulasan"; // Sesuaikan dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

function query($query){
    global $conn;
    $result = $conn->query($query);
    if (!$result) {
        die("Query error: " . $conn->error);
    }
    
    return $result;
}

function verifyAdmin($link = false){
        if(isset($_COOKIE['admin_pass']) && isset($_COOKIE['admin_name'])){
            $name = $_COOKIE['admin_name'];
            $password = $_COOKIE['admin_pass'];
            $sql = "SELECT * FROM user WHERE nama_user = '$name' AND role = 'admin'";
            $result = query($sql);
            if (isset($_SESSION['admin_id']) && isset($_SESSION['admin_name'])) {
                return; // Jika sesi sudah ada, tidak perlu melakukan apa-apa
            }
            if ($result->num_rows > 0) {
                // Memeriksa password
                $row = $result->fetch_assoc();
                if ($password == $row['password']) {
                    // Password cocok, membuat sesi
                    $_SESSION['admin_id'] = $row['id_user'];
                    $_SESSION['admin_name'] = $row['nama_user'];
        
                    // Redirect ke halaman dashboard atau halaman lain yang diinginkan
                    header("Location: dashboardadmin.php");
                    exit();
                } else if($link) {
                    // Password salah
                 header("location: loginAdmin.php");
                 exit();
                
                }
            } else if($link) {
                // User tidak ditemukan
            header("location: loginAdmin.php");
            exit();

               
            }
            exit();

        }else if(!isset($_SESSION['admin_name']) && !isset($_SESSION['admin_id'])) if($link){
            header("location: loginAdmin.php");
            exit();

        }

}
function verifyUser($link = false){
    if(isset($_COOKIE['user_pass']) && isset($_COOKIE['user_name'])){
        $name = $_COOKIE['user_name'];
        $password = $_COOKIE['user_pass'];
        $sql = "SELECT * FROM user WHERE nama_user = '$name' AND role = 'peserta'";
        $result = query($sql);
        if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
            return; // Jika sesi sudah ada, tidak perlu melakukan apa-apa
        }
        if ($result->num_rows > 0) {
            // Memeriksa password
            $row = $result->fetch_assoc();
            if ($password == $row['password']) {
                // Password cocok, membuat sesi
                $_SESSION['user_id'] = $row['id_user'];
                $_SESSION['user_name'] = $row['nama_user'];
                exit();
            } else if($link) {
                // Password salah
             header("location: login.php");
             exit();
            
            }
        } else if($link) {
            // User tidak ditemukan
        header("location: login.php");
        exit();

           
        }
        exit();

    }else if(!isset($_SESSION['user_name']) && !isset($_SESSION['user_id'])) if($link){
        header("location: login.php");
        exit();

    }
}



?>