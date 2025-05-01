<main class="dashboard-main dashboard-dsh">

  <!-- Panel izquierdo -->
  <div class="panel-section left-panel">
    <div class="panel-header">
      <h2>DETECCIÓN DE ATAQUES</h2>
      <div class="panel-title-decoration"></div>
    </div>

    <!-- Gráfico principal -->
    <div class="detections-activity">
      <h3>Actividad de Detecciones</h3>
      <div class="chart-container" style="height:300px;">
        <canvas id="detectionActivityChart"></canvas>
      </div>
    </div>

    <!-- Tabla de detecciones notables -->
    <div class="notable-detections">
      <h3>Detecciones Notables <span class="info-badge">en vivo</span></h3>
      <table class="detections-table">
        <!-- ... tbody con sus filas ... -->
      </table>
    </div>

    <!-- 🚩 Aquí va el gráfico de barras (Promedio) -->
    <div class="average-detections">
      <h3>Detecciones Promedio</h3>
      <div class="chart-container" style="height:250px; margin-top:1rem;">
        <canvas id="averageDetectionsChart"></canvas>
      </div>
    </div>
  </div>

  <!-- Panel derecho -->
  <div class="panel-section right-panel">
    <!-- Observaciones -->
    <div class="observations-panel">
      <div class="panel-header">
        <h2>Observaciones</h2>
        <div class="time-filter">
          <!-- ... botones de filtro ... -->
        </div>
      </div>
      <table class="observations-table">
        <!-- ... filas de observaciones ... -->
      </table>
      <div class="observations-chart" style="height:200px; margin-top:1rem;">
        <canvas id="observationsTimelineChart"></canvas>
      </div>
    </div>

    <!-- Investigaciones -->
    <div class="investigations-panel">
      <h3>Investigaciones</h3>
      <table class="investigations-table">
        <!-- ... filas de investigaciones ... -->
      </table>
    </div>

    <!-- Detenciones Resueltas -->
    <div class="resolved-detections">
  <!-- 1) Título arriba -->
  <h3 class="resolved-title">Detecciones Resueltas</h3>

  <!-- 2) Panel de métricas: Total + Gráfico -->
  <div class="resolved-metrics">
    <div class="total-metric">
      <h4>Total</h4>
      <div class="metric-value" id="totalDetections">111</div>
    </div>

    <div class="chart-container">
      <canvas id="mitigationsChart"></canvas>
    </div>
  </div>
</div>
  </div>

</main>
