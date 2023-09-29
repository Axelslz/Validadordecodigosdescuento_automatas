<?php

function validador($input_string, $states) {
    $current_state = "q0";
    $state_sequence = [$current_state];

    for ($i = 0; $i < strlen($input_string); $i++) {
        $char = $input_string[$i];

        if (isset($states[$current_state][$char])) {
            $current_state = $states[$current_state][$char];
            $state_sequence[] = $current_state;
        } else {
            return ['success' => false, 'message' => "Autómata no válido, error en el estado $current_state", 'sequence' => $state_sequence];
        }
    }

    return ['success' => true, 'message' => 'Autómata válido', 'sequence' => $state_sequence];
}

$STATES = [
    'q0' => ['L' => 'q1', 'I' => 'q2', 'R' => 'q3', 'W' => 'q4'],
    'q1' => ['B' => 'q5'],
    'q5' => ['6' => 'q6'],
    'q6' => ['0' => 'q7'],
    'q7' => ['0' => 'q8'],
    'q8' => [],    // Estado final LB600
    'q2' => ['M' => 'q20','P' => 'q9'],
    'q9' => ['H' => 'q10'],
    'q10' => ['O' => 'q11'],
    'q11' => ['N' => 'q12'],
    'q12' => ['E' => 'q13'], 
    'q13' => ['W' => 'q14'],
    'q14' => ['M' => 'q15'], 
    'q15' => ['1' => 'q16', '0' => 'q18'],
    'q16' => ['0' => 'q17'],
    'q17' => [], // Estado final IPHONEWM10
    'q18' => ['9' => 'q19'],
    'q19' => [], // Estado final IPHONEWM09
    'q20' => ['P' => 'q21'],
    'q21' => ['O' => 'q22'],
    'q22' => ['R' => 'q23'],
    'q23' => ['T' => 'q24'], 
    'q24' => ['W' => 'q25'], 
    'q25' => ['M' => 'q26'],
    'q26' => [], // Estado Final IMPORTWM
    'q3' => ['E' => 'q27'],
    'q27' => ['G' => 'q28'], 
    'q28' => ['R' => 'q29', 'A' => 'q37'],
    'q29' => ['E' => 'q30'],
    'q30' => ['S' => 'q31'],
    'q31' => ['O' => 'q32'],
    'q32' => ['H' => 'q33'],
    'q33' => ['P' => 'q34'],
    'q34' => ['W' => 'q35'], 
    'q35' => ['M' => 'q36'], 
    'q36' => [], // Estado Final REGRESOHPWM
    'q37' => ['L' => 'q38'], 
    'q38' => ['O' => 'q39'],
    'q39' => ['W' => 'q40'],
    'q40' => ['M' => 'q41'],
    'q41' => ['6' => 'q42'],
    'q42' => [], // Estado Final REGALOWM6
    'q4'  => ['M' => 'q43'],
    'q43' => ['S' => 'q44', 'T' => 'q49', 'B' => 'q55'],
    'q44' => ['E' => 'q45'],
    'q45' => ['P' => 'q46'],
    'q46' => ['1' => 'q47'],
    'q47' => ['7' => 'q48'],
    'q48' => [], // Estado Final WMSEP17
    'q49' => ['E' => 'q50'],
    'q50' => ['C' => 'q51'], 
    'q51' => ['7' => 'q52'],
    'q52' => ['0' => 'q53'],
    'q53' => ['0' => 'q54'],
    'q54' => [],// Estado Final WMTEC700
    'q55' => ['O' => 'q56'], 
    'q56' => ['N' => 'q57'],
    'q57' => ['S' => 'q58'],
    'q58' => ['E' => 'q59'],
    'q59' => ['P' => 'q60'],
    'q60' => [], // Estado Final WMBONSEP

];


$resultado = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['entrada'])) {
    $entrada = $_POST['entrada'];
    $resultado = validador($entrada, $STATES);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AUTOMATAS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<img src="./Automatas.jpg" alt="Descripción de la imagen">
<div class="container mt-5">
    <h2>Validador de Codigo de descuento </h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="entrada">Ingresa el autómata:</label>
            <input type="text" class="form-control" id="entrada" name="entrada" required>
        </div>
        <button type="submit" class="btn btn-primary">Validar</button>
    </form>

    <?php if ($resultado): ?>
    <div class="mt-4">
        <h3>Resultado:</h3>
        <p><strong>Mensaje:</strong> <?= $resultado['message']; ?></p>
        <p><strong>Secuencia de estados:</strong> <?= implode(' -> ', $resultado['sequence']); ?></p>
    </div>
    <?php endif; ?>
</div>

</body>
</html>