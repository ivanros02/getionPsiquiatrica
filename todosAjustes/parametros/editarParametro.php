<?php
require_once "../../conexion.php"; // Asegúrate de que la ruta a tu archivo de conexión es correcta

// Obtener los datos del formulario
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$inst = isset($_POST['inst']) ? $_POST['inst'] : '';
$razon_social = isset($_POST['razon_social']) ? $_POST['razon_social'] : '';
$c_interno = isset($_POST['c_interno']) ? intval($_POST['c_interno']) : 0;
$c_pami = isset($_POST['c_pami']) ? intval($_POST['c_pami']) : 0;
$cuit = isset($_POST['cuit']) ? intval($_POST['cuit']) : 0;
$u_efect = isset($_POST['u_efect']) ? $_POST['u_efect'] : '';
$clave_efect = isset($_POST['clave_efect']) ? $_POST['clave_efect'] : '';
$mail = isset($_POST['mail']) ? $_POST['mail'] : '';
$boca_ate = isset($_POST['boca_ate']) ? intval($_POST['boca_ate']) : 0;
$dir = isset($_POST['dir']) ? $_POST['dir'] : '';
$localidad = isset($_POST['localidad']) ? $_POST['localidad'] : '';
$cod_sucursal = isset($_POST['cod_sucursal']) ? intval($_POST['cod_sucursal']) : 0;
$tel = isset($_POST['tel']) ? intval($_POST['tel']) : 0;

// Actualizar el registro en la base de datos usando mysqli
$query = "UPDATE parametro_sistema SET inst = ?, razon_social = ?, c_interno = ?, c_pami = ?, cuit = ?, u_efect = ?, clave_efect = ?, mail = ?, boca_ate = ?, dir = ?, localidad = ?, cod_sucursal = ?, tel = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param(
    'ssiiisssissisi',
    $inst,
    $razon_social,
    $c_interno,
    $c_pami,
    $cuit,
    $u_efect,
    $clave_efect,
    $mail,
    $boca_ate,
    $dir,
    $localidad,
    $cod_sucursal,
    $tel,
    $id
);
$stmt->execute();

// Verificar si la actualización fue exitosa
if ($stmt->affected_rows > 0) {
    echo "Registro actualizado correctamente.";
    header('Location: ./parametros.php');
} else {
    echo "No se realizaron cambios.";
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>
