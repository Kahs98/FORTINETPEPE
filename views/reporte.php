<?php
// views/reporte.php

// --- Datos de ejemplo (reemplaza con tu lógica real) ---
$dataRange     = '2023-03-01 al 2023-03-31';
$totalControls = 16;
$passedCount   = 9;
$failedCount   = 4;
$untestedCount = 2;
$exemptCount   = 1;
$score         = 157.27;
$grade         = 'C';

// Detalle de grados por categoría
$grades = [
    'Fabric Security Hardening'        => 'F',
    'Threat & Vulnerability Management'=> 'D',
    'Endpoint Management'              => 'A',
    'Network Design & Policies'        => 'B',
    'Firmware & Subscription'          => 'A',
    'Porting Outbreak Detection'       => 'D',
];

// Resultados de controles
$controls = [
    [
      'name'   => 'Admin Password Policy',
      'device' => '2 Devices',
      'scope'  => '2 Scopes',
      'score'  => -20,
      'result' => 'Failed',
      'compliance' => 'FSBP SH05.1'
    ],
    // ... más filas aquí
];

// Recomendaciones
$recs = [
    [
      'device' => 'FAZVMSTM',
      'scope'  => 'Global',
      'score'  => -10,
      'text'   => 'Enable a simple password policy for system administrators. By default, the password policy will enforce a minimum password length of 8 characters.'
    ],
    // ... más filas aquí
];
?>

<link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">

<div class="report-container">

  <!-- SECURITY POSTURE -->
  <section class="posture">
    <h2>SECURITY POSTURE</h2>
    <p class="report-date">Data Range: <?= htmlspecialchars($dataRange) ?></p>

    <div class="posture-overview">
      <!-- Donut Chart -->
      <div class="chart-container" style="width:200px; height:200px;">
        <canvas id="postureChart"></canvas>
      </div>

      <!-- Resumen de métricas -->
      <div class="overview-details">
        <p><strong><?= $totalControls ?></strong> Total Controls</p>
        <ul class="status-list">
          <li><span class="badge passed"></span> <?= $passedCount ?> Passed</li>
          <li><span class="badge failed"></span> <?= $failedCount ?> Failed</li>
          <li><span class="badge untested"></span> <?= $untestedCount ?> Untested</li>
          <li><span class="badge exempt"></span> <?= $exemptCount ?> Exempt</li>
        </ul>
        <p><strong>Score:</strong> <?= $score ?></p>
        <p><strong>Overall Grade:</strong> <span class="grade"><?= $grade ?></span></p>
      </div>
    </div>

    <h3>Grades</h3>
    <ul class="grades-list">
      <?php foreach($grades as $cat => $g): ?>
        <li><strong><?= htmlspecialchars($cat) ?>:</strong> <?= htmlspecialchars($g) ?></li>
      <?php endforeach; ?>
    </ul>
  </section>

  <!-- SECURITY CONTROL RESULTS -->
  <section class="controls">
    <h2>SECURITY CONTROL RESULT: <?= $failedCount ?> Failed</h2>
    <table class="controls-table">
      <thead>
        <tr>
          <th>Security Control</th>
          <th>Device</th>
          <th>Scope</th>
          <th>Score</th>
          <th>Result</th>
          <th>Compliance</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($controls as $c): ?>
        <tr class="<?= strtolower($c['result']) ?>">
          <td><?= htmlspecialchars($c['name']) ?></td>
          <td><?= htmlspecialchars($c['device']) ?></td>
          <td><?= htmlspecialchars($c['scope']) ?></td>
          <td><?= htmlspecialchars($c['score']) ?></td>
          <td><?= htmlspecialchars($c['result']) ?></td>
          <td><?= htmlspecialchars($c['compliance']) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>

  <!-- RECOMMENDATIONS -->
  <section class="recommendations">
    <h2>Recommendations</h2>
    <table class="recs-table">
      <thead>
        <tr>
          <th>Device</th>
          <th>Scope</th>
          <th>Score</th>
          <th>Recommendation</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($recs as $r): ?>
        <tr>
          <td><?= htmlspecialchars($r['device']) ?></td>
          <td><?= htmlspecialchars($r['scope']) ?></td>
          <td><?= htmlspecialchars($r['score']) ?></td>
          <td><?= htmlspecialchars($r['text']) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>

</div>

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
// Donut para Security Posture
document.addEventListener('DOMContentLoaded', function(){
  const passed   = <?= $passedCount ?>;
  const failed   = <?= $failedCount ?>;
  const untested = <?= $untestedCount ?>;
  const exempt   = <?= $exemptCount ?>;

  new Chart(
    document.getElementById('postureChart').getContext('2d'),
    {
      type: 'doughnut',
      data: {
        labels: ['Passed','Failed','Untested','Exempt'],
        datasets: [{
          data: [passed, failed, untested, exempt],
          backgroundColor: ['#2ecc71','#e74c3c','#f1c40f','#3498db'],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'right' }
        }
      }
    }
  );
});
</script>
