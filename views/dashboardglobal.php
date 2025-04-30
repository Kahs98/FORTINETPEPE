<main class="dashboard-main">
    <!-- Panel izquierdo -->
    <div class="panel-section left-panel">
        <div class="panel-header">
            <h2>DETECCIÓN DE ATAQUES</h2>
            <div class="panel-title-decoration"></div>
        </div>
        <div class="detections-activity">
            <h3>Actividad de Detecciones</h3>
            <div class="chart-container">
                <canvas id="detectionActivityChart"></canvas>
            </div>
        </div>
        <div class="notable-detections">
            <h3>Detecciones Notables <span class="info-badge">en vivo</span></h3>
            <table class="detections-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Puntuación</th>
                        <th>Tiempo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="detection-item critical">
                        <td>Credenciales Robadas con Usuario HTTP Inválido</td>
                        <td>4</td>
                        <td>9 minutos</td>
                    </tr>
                    <tr class="detection-item critical">
                        <td>Ejecución en Root de Web Directory</td>
                        <td>3</td>
                        <td>10 minutos</td>
                    </tr>
                    <tr class="detection-item critical">
                        <td>Ejecución Binaria en Script from VPS</td>
                        <td>3</td>
                        <td>12 minutos</td>
                    </tr>
                    <tr class="detection-item high">
                        <td>Tráfico Sospechoso Trojan SSL Certificado</td>
                        <td>2</td>
                        <td>20 minutos</td>
                    </tr>
                    <tr class="detection-item high">
                        <td>Trickbot HTTP Server Response</td>
                        <td>2</td>
                        <td>25 minutos</td>
                    </tr>
                    <tr class="detection-item high">
                        <td>Trickbot Staging Download</td>
                        <td>2</td>
                        <td>30 minutos</td>
                    </tr>
                    <tr class="detection-item high">
                        <td>Trickbot DNS Exfiltración</td>
                        <td>2</td>
                        <td>35 minutos</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Panel derecho -->
    <div class="panel-section right-panel">
        <div class="observations-panel">
            <div class="panel-header">
                <h2>Observaciones</h2>
                <div class="time-filter">
                    <button class="time-btn active">06/14-05/04</button>
                    <button class="time-btn">05/03-04/27</button>
                    <button class="time-btn">04/26-04/20</button>
                    <button class="change-btn">Cambiar</button>
                </div>
            </div>
            <table class="observations-table">
                <thead>
                    <tr>
                        <th>Tipo de Observación</th>
                        <th>S</th>
                        <th>C</th>
                        <th>O</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="indicator http"></span> HTTP C2 Similitud</td>
                        <td>5</td>
                        <td>5</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td><span class="indicator raw"></span> Raw y Unusual HTTP Authentication</td>
                        <td>3</td>
                        <td>3</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td><span class="indicator malicious"></span> Malicious PE File</td>
                        <td>2</td>
                        <td>2</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td><span class="indicator process"></span> Process Remote Service Creation</td>
                        <td>2</td>
                        <td>2</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td><span class="indicator suspicious"></span> Suspicious Outbound Data Quantity</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td><span class="indicator tcp"></span> TCP Device Enumeration</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                    </tr>
                </tbody>
            </table>
            <div class="observations-chart">
                <canvas id="observationsTimelineChart"></canvas>
            </div>
        </div>

        <div class="investigations-panel">
            <h3>Investigaciones</h3>
            <table class="investigations-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Tiempo desde</th>
                        <th>Última Modificación</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ejecutable Malicioso con Usuario HTTP Inválido</td>
                        <td><span class="status-open">Abierto</span></td>
                        <td>3 días</td>
                        <td>Usuario S.</td>
                    </tr>
                    <tr>
                        <td>Scan Range - 2023-03-30 15:44:09 (215)</td>
                        <td><span class="status-open">Abierto</span></td>
                        <td>7 días</td>
                        <td>Usuario A.</td>
                    </tr>
                    <tr>
                        <td>Dyne Admin - 2023-03-31 07:09:34 (STD)</td>
                        <td><span class="status-open">Abierto</span></td>
                        <td>7 días</td>
                        <td>Usuario K.</td>
                    </tr>
                    <tr>
                        <td>Ejecutable Malicioso con Usuario HTTP Inválido</td>
                        <td><span class="status-open">Abierto</span></td>
                        <td>10 días</td>
                        <td>Usuario B.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="resolved-detections">
            <h3>Detecciones Resueltas</h3>
            <div class="metrics-panel">
                <div class="total-metric">
                    <h4>Total</h4>
                    <div class="metric-value" id="totalDetections">111</div>
                </div>
                <div class="charts-metrics">
                    <div class="chart-metric">
                        <h4>Promedio</h4>
                        <canvas id="averageDetectionsChart"></canvas>
                    </div>
                    <div class="chart-metric">
                        <h4>Mitigaciones</h4>
                        <canvas id="mitigationsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
