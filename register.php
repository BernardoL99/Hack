<?
$username = $_POST['username'];
$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$cont = $_POST['cont'];
$edad = $_POST['edad'];
if (!empty($username) || !empty(usuario) || !empty(correo) || !empty(cont) || !empty(edad))
{
  $host = ""; // nombre del host
  $dbUsername = ""; // nombre de usuario
  $dbPassword =""; //pass
  $dbname = "";   //nombre de la carpeta  
  $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

      if (mysqli_connect_error()){
        die('Error de conexion')
//
      } else { //rregistro es la subcarpeta donde iran los dato de registro//
        $SELECT= "SELECT correo From registro Where correo = ? Limit: 1";
        $INSERT= "INSERT Into registro (username, usuario, correo, cont, edad) values (?,?,?,?,?)";
        
        $stmt = $conn->  prepare($SELECT);
        $stmt->bind_param("s",$correo);
        $stmt->execute();
        $stmt->bind_result($correo);
        $stmt->store_result();
        $rnum = $stmt -> num_rows;
        
        if(rnum==0){
          $stmt-> close();
          $stmt = $conn->prepare($INSERT);
          $stmt-> bind_param("s,s,s,s,s", $username, $usuario, $correo, $cont, $edad);
          $stmt->execute();
          echo "Registrado correctamente"
          
        } else{
          echo "Ese correo ya fue registrado"
        }
        $stmt->close();
        $conn->close();

      }


} else {
  echo "Todos los espacios son requeridos";
  die();

}




?>  
