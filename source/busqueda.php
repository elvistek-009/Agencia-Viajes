<?php
// Validación básica de entrada
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $origen  = isset($_POST['origen'])  ? strtoupper(trim($_POST['origen']))  : '';
    $destino = isset($_POST['destino']) ? strtoupper(trim($_POST['destino'])) : '';
    $fecha   = isset($_POST['fecha'])   ? trim($_POST['fecha'])               : '';

    if ($origen === '' || strlen($origen) < 3)   { $errores[] = "Origen inválido (mínimo 3 letras)."; }
    if ($destino === '' || strlen($destino) < 3) { $errores[] = "Destino inválido (mínimo 3 letras)."; }
    if ($fecha === '')                           { $errores[] = "La fecha es requerida."; }

    // Simulación de consulta
    $resultados = [];
    if (empty($errores)) {
        $resultados = [
            [
                'aerolinea' => 'LATAM',
                'vuelo'     => 'LA600',
                'origen'    => $origen,
                'destino'   => $destino,
                'salida'    => $fecha . ' 08:00',
                'llegada'   => $fecha . ' 14:30',
                'precio'    => 850.000
            ],
            [
                'aerolinea' => 'American Airlines',
                'vuelo'     => 'AA998',
                'origen'    => $origen,
                'destino'   => $destino,
                'salida'    => $fecha . ' 10:15',
                'llegada'   => $fecha . ' 16:40',
                'precio'    => 560.000
            ]
        ];
    }
} else {
    $errores[] = "Método no permitido.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Resultados de búsqueda</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <h1>Resultados</h1>

  <?php if (!empty($errores)): ?>
    <div class="errores">
      <h2>Errores</h2>
      <ul>
        <?php foreach ($errores as $e): ?>
          <li><?php echo htmlspecialchars($e); ?></li>
        <?php endforeach; ?>
      </ul>
      <a href="busqueda.html">Volver</a>
    </div>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Aerolínea</th>
          <th>Vuelo</th>
          <th>Origen</th>
          <th>Destino</th>
          <th>Salida</th>
          <th>Llegada</th>
          <th>Precio (CLP)</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($resultados as $r): ?>
          <tr>
            <td><?php echo htmlspecialchars($r['aerolinea']); ?></td>
            <td><?php echo htmlspecialchars($r['vuelo']); ?></td>
            <td><?php echo htmlspecialchars($r['origen']); ?></td>
            <td><?php echo htmlspecialchars($r['destino']); ?></td>
            <td><?php echo htmlspecialchars($r['salida']); ?></td>
            <td><?php echo htmlspecialchars($r['llegada']); ?></td>
            <td><?php echo htmlspecialchars($r['precio']); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <a href="busqueda.html">Nueva búsqueda</a>
  <?php endif; ?>
</body>
</html>
