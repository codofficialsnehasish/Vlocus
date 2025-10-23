@extends('layouts.app')

@section('title','Dashboard')

@section('css')
<!-- Chart.js CDN (v4) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>


<style>
  :root{
    --bg:#f6f8fb;
    --card:#ffffff;
    --muted:#6b7280;
    --primary:#2563eb;
    --accent:#06b6d4;
    --radius:12px;
  }
  *{box-sizing:border-box}
  body{margin:0;font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial;color:#0f172a;background:linear-gradient(180deg,#fbfdff,var(--bg));padding:20px}
  .wrap{/*max-width:1220px;*/margin:0 auto}
  header{display:flex;justify-content:space-between;align-items:flex-start;gap:12px;margin-bottom:18px}
  .brand{display:flex;gap:12px;align-items:center}
  .logo {
  width: 56px;
  height: 56px;
  border-radius: 10px;
  /*background: linear-gradient(135deg, var(--primary), var(--accent));*/
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden; /* ensures image stays inside rounded box */
}

.logo img {
  width: 100%;
  height: 100%;
  object-fit: contain; /* or "cover" depending on look */
  border-radius: 10px;
}
  h1{margin:0;font-size:20px}
  .subtitle{margin:0;color:var(--muted);font-size:13px}

  /* controls */
  .controls{display:flex;gap:8px;align-items:center;flex-wrap:wrap}
  .control {background:var(--card);padding:8px;border-radius:10px;border:1px solid rgba(15,23,42,0.05);display:flex;gap:8px;align-items:center}
  input[type=date], select {border:0;background:transparent;font-size:13px}
  button.btn {background:var(--primary);color:#fff;border:0;padding:8px 12px;border-radius:10px;cursor:pointer}
  button.ghost {background:transparent;border:1px solid rgba(15,23,42,0.06);padding:8px 10px;border-radius:10px;cursor:pointer}

  /* layout */
  .layout{display:grid;grid-template-columns:300px 1fr;gap:16px}
  @media (max-width:980px){.layout{grid-template-columns:1fr;}}
  .sidebar{background:var(--card);padding:12px;border-radius:var(--radius);box-shadow:0 8px 20px rgba(15,23,42,0.04)}
  .tabs{display:flex;gap:6px;margin-bottom:10px}
  .tab{padding:8px 10px;border-radius:8px;font-size:14px;cursor:pointer;color:var(--muted);background:transparent;border:1px solid transparent}
  .tab.active{background:linear-gradient(90deg,rgba(37,99,235,0.08),rgba(6,182,212,0.03));color:var(--primary);border:1px solid rgba(37,99,235,0.08)}
  .card-list{display:flex;flex-direction:column;gap:8px}
  .menu-card{display:flex;gap:10px;align-items:center;padding:10px;border-radius:10px;cursor:pointer}
  .menu-icon{width:40px;height:40px;border-radius:8px;background:#fff;display:flex;align-items:center;justify-content:center;border:1px solid rgba(15,23,42,0.04)}
  .muted{color:var(--muted);font-size:13px}

  .content{display:flex;flex-direction:column;gap:12px}
  .panel{background:var(--card);padding:12px;border-radius:var(--radius);box-shadow:0 10px 30px rgba(15,23,42,0.04)}
  .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:12px}
  @media (max-width:720px){.grid-2{grid-template-columns:1fr}}
  .grid-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px}
  @media (max-width:1100px){.grid-3{grid-template-columns:1fr 1fr}}
  @media (max-width:720px){.grid-3{grid-template-columns:1fr}}

  .route-area{height:320px;border-radius:10px;background:linear-gradient(180deg,#f7fbff,#ffffff);display:flex;flex-direction:column}
  .route-canvas{flex:1;border-radius:10px;padding:8px}

  .controls-small{display:flex;gap:8px;align-items:center}
  .small{font-size:13px;color:var(--muted)}
  .legend{display:flex;gap:8px;align-items:center}
  .sw{width:10px;height:10px;border-radius:2px;display:inline-block}
  footer{color:var(--muted);font-size:13px;text-align:center;margin-top:10px}
</style>
@endsection

@section('content')

<div class="wrap">
    <header>
      <div class="brand">
        <div class="logo"><img src="{{ asset('assets/logo.png') }}" alt=""></div>
        <div>
          <h1>Dashboard</h1>
          {{-- <p class="subtitle">Chart.js charts + Route playback — demo/sample data • Light theme</p> --}}
        </div>
      </div>

      <div class="controls" aria-label="filters">
        <div class="control">
          <label class="small" for="dateFrom">From</label>
          <input type="date" id="dateFrom" />
        </div>
        <div class="control">
          <label class="small" for="dateTo">To</label>
          <input type="date" id="dateTo" />
        </div>
        <div class="control">
          <label class="small" for="vehicleSelect">Vehicle</label>
          <select id="vehicleSelect"></select>
        </div>
        <div class="control">
          <label class="small" for="driverSelect">Driver</label>
          <select id="driverSelect"></select>
        </div>
        <button class="btn" id="applyFilters">Apply</button>
        <button class="ghost" id="resetFilters">Reset</button>
      </div>
    </header>

    <div class="layout">
      <aside class="sidebar" aria-label="report menu">
        <div class="tabs" role="tablist">
          <div class="tab active" data-tab="reports" role="tab">Reports</div>
          <div class="tab" data-tab="safety" role="tab">Driver Behaviour</div>
        </div>

        <div id="reportsList" class="card-list">
          <!-- populated by JS -->
        </div>
        <div id="safetyList" class="card-list" style="display:none;margin-top:12px">
          <!-- populated by JS -->
        </div>
      </aside>

      <main class="content">
        <div class="panel">
          <div style="display:flex;justify-content:space-between;align-items:center">
            <div>
              <strong id="activeReportTitle">Trip Summary</strong>
              <div class="small" id="activeReportSub">Overview of trips, durations and stops</div>
            </div>
            <div class="controls-small">
              <div class="legend">
                <div><span class="sw" style="background:var(--primary)"></span> <span class="small">Moving</span></div>
                <div><span class="sw" style="background:var(--accent)"></span> <span class="small">Idle</span></div>
              </div>
            </div>
          </div>

          <div style="margin-top:12px" class="grid-3">
            <div class="panel">
              <h3 style="margin:0 0 8px">Trips & Distance</h3>
              <canvas id="barChart" height="160"></canvas>
            </div>

            <div class="panel">
              <h3 style="margin:0 0 8px">Distance Trend</h3>
              <canvas id="lineChart" height="160"></canvas>
            </div>

            <div class="panel">
              <h3 style="margin:0 0 8px">Run vs Idle</h3>
              <canvas id="doughnutChart" height="160"></canvas>
            </div>
          </div>

        </div>

        <div class="panel">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
            <div>
              <strong>Route Playback</strong>
              {{-- <div class="small">Abstract map grid + simulated vehicle movement</div> --}}
            </div>
            <div style="display:flex;gap:8px;align-items:center">
              <button class="ghost" id="playRoute" aria-pressed="false">Play</button>
              <button class="ghost" id="pauseRoute" aria-pressed="false">Pause</button>
              <button class="ghost" id="resetRoute">Reset</button>
            </div>
          </div>

          <div class="route-area">
            <canvas id="routeCanvas" class="route-canvas" aria-label="Route playback canvas"></canvas>
            <div style="padding:8px;display:flex;justify-content:space-between;align-items:center">
              <div class="small" id="routeStatus">Idle</div>
              <div class="small" id="routeTime">0 / 0</div>
            </div>
          </div>
        </div>

        <div class="panel" id="metricsPanel">
          <div style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap">
            <div><strong>Total Trips</strong><div id="metricTrips" style="font-size:20px">—</div></div>
            <div><strong>Total Distance</strong><div id="metricDistance" style="font-size:20px">— km</div></div>
            <div><strong>Avg Speed</strong><div id="metricSpeed" style="font-size:20px">— km/h</div></div>
            <div><strong>Overstays</strong><div id="metricOverstay" style="font-size:20px">—</div></div>
          </div>
        </div>

        {{-- <footer>Demo — charts use deterministic sample data so combination of filters yields repeatable results.</footer> --}}
      </main>
    </div>
  </div>

@endsection

@section('scripts')
<script>
/* --------------------------
   Demo data + utilities
   -------------------------- */
const VEHICLES = [
  {id:'V-001', label:'Truck A (V-001)'},
  {id:'V-002', label:'Van B (V-002)'},
  {id:'V-003', label:'Car C (V-003)'}
];
const DRIVERS = [
  {id:'D-01', name:'Rahul'},
  {id:'D-02', name:'Priya'},
  {id:'D-03', name:'Arjun'}
];

const REPORTS = [
  {id:'trip', title:'Trip Summary', desc:'Overview of trips, durations, and stops.', icon:'🗺️'},
  {id:'route', title:'Route History', desc:'Playback and route taken over time.', icon:'📈'},
  {id:'runidle', title:'Run & Idle', desc:'Engine run vs idle analysis.', icon:'⏱️'},
  {id:'distance', title:'Distance', desc:'Distance traveled per vehicle.', icon:'📏'},
  {id:'geofence', title:'Geo-fence', desc:'Geofence enter/exit events & alerts.', icon:'🎯'},
  {id:'overstay', title:'Overstay', desc:'Time spent beyond thresholds.', icon:'⏳'},
];
const SAFETY = [
  {id:'attendance', title:'Monthly Attendance', desc:'Driver attendance calendar.', icon:'📅'},
  {id:'loginlogout', title:'Login/Logout', desc:'Driver login and logout records.', icon:'🔐'},
  {id:'logintime', title:'Login Time', desc:'Login durations and trends.', icon:'🕒'},
  {id:'sos', title:'Emergency SOS', desc:'SOS events and response history.', icon:'🆘'},
];

/* seeded PRNG for deterministic samples */
function seededRand(seed){
  let h = 2166136261 >>> 0;
  for (let i=0;i<seed.length;i++) h = Math.imul(h ^ seed.charCodeAt(i), 16777619);
  return function(){ h += 0x6D2B79F5; let t = Math.imul(h ^ (h >>> 15), 1 | h); t ^= t + Math.imul(t ^ (t >>> 7), 61 | t); return ((t ^ (t >>> 14)) >>> 0) / 4294967296; };
}

/* produce sample dataset for given filters */
function generateSampleData({from, to, vehicle, driver}){
  const days = 8;
  const seed = `${from}|${to}|${vehicle}|${driver}`;
  const rand = seededRand(seed);
  const labels = [];
  const trips = [], distances = [], speeds = [];
  for(let i=0;i<days;i++){
    labels.push(`T${i+1}`);
    trips.push(Math.round(rand()*8 + 1));
    distances.push(Math.round(rand()*180 + 30));
    speeds.push(Math.round(25 + rand()*50));
  }
  const totalTrips = trips.reduce((a,b)=>a+b,0);
  const totalDist = distances.reduce((a,b)=>a+b,0);
  const avgSpeed = Math.round(speeds.reduce((a,b)=>a+b,0)/speeds.length);
  const overstay = Math.round(rand()*8);
  // route: array of normalized points
  const routeLen = 24;
  const base = Array.from({length:routeLen}, (_,i) => {
    const x = i/(routeLen-1);
    const noise = (rand()-0.5)*0.12;
    const y = 0.2 + 0.6*Math.abs(Math.sin(i/3 + rand())) + noise;
    return {x: Math.max(0, Math.min(1, x)), y: Math.max(0, Math.min(1, y))};
  });
  return {labels,trips,distances,speeds,totalTrips,totalDist,avgSpeed,overstay,route:base};
}

/* --------------------------
   DOM refs + init filters
   -------------------------- */
const vehicleSelect = document.getElementById('vehicleSelect');
const driverSelect = document.getElementById('driverSelect');
const dateFrom = document.getElementById('dateFrom');
const dateTo = document.getElementById('dateTo');
const applyBtn = document.getElementById('applyFilters');
const resetBtn = document.getElementById('resetFilters');

function populateFilters(){
  VEHICLES.forEach(v=> {
    const o = document.createElement('option'); o.value=v.id; o.textContent=v.label; vehicleSelect.appendChild(o);
  });
  DRIVERS.forEach(d=>{
    const o = document.createElement('option'); o.value=d.id; o.textContent=d.name; driverSelect.appendChild(o);
  });
  const now = new Date();
  const prior = new Date(now); prior.setDate(now.getDate()-7);
  dateFrom.valueAsDate = prior;
  dateTo.valueAsDate = now;
}
populateFilters();

/* populate menu */
const reportsList = document.getElementById('reportsList');
const safetyList = document.getElementById('safetyList');
function mkCard(it){
  const el = document.createElement('div'); el.className='menu-card'; el.tabIndex=0;
  el.innerHTML = `<div class="menu-icon">${it.icon}</div><div><strong>${it.title}</strong><div class="muted">${it.desc}</div></div>`;
  el.addEventListener('click', ()=> selectReport(it));
  el.addEventListener('keydown', (e)=>{ if(e.key==='Enter') selectReport(it); });
  return el;
}
REPORTS.forEach(r=> reportsList.appendChild(mkCard(r)));
SAFETY.forEach(r=> safetyList.appendChild(mkCard(r)));

/* tabs */
document.querySelectorAll('.tab').forEach(t=>{
  t.addEventListener('click', ()=>{
    document.querySelectorAll('.tab').forEach(x=>x.classList.remove('active'));
    t.classList.add('active');
    const tab = t.dataset.tab;
    document.getElementById('reportsList').style.display = tab==='reports' ? 'block' : 'none';
    document.getElementById('safetyList').style.display = tab==='safety' ? 'block' : 'none';
  });
});

/* --------------------------
   Chart.js charts
   -------------------------- */
let barChart, lineChart, doughnutChart;

function createCharts(sample){
  // bar chart: trips + distances (dual axis)
  const ctxBar = document.getElementById('barChart').getContext('2d');
  if(barChart) barChart.destroy();
  barChart = new Chart(ctxBar, {
    type:'bar',
    data:{
      labels: sample.labels,
      datasets:[
        {label:'Trips', data: sample.trips, yAxisID:'y', backgroundColor:'rgba(37,99,235,0.9)'},
        {label:'Distance (km)', data: sample.distances, yAxisID:'y1', backgroundColor:'rgba(6,182,212,0.85)'}
      ]
    },
    options:{
      responsive:true,
      interaction:{mode:'index', intersect:false},
      scales:{
        y:{position:'left', title:{display:true, text:'Trips'}},
        y1:{position:'right', grid:{drawOnChartArea:false}, title:{display:true, text:'Distance (km)'}}
      },
      plugins:{legend:{position:'bottom'}, tooltip:{mode:'index'}}
    }
  });

  // line chart: distance trend
  const ctxLine = document.getElementById('lineChart').getContext('2d');
  if(lineChart) lineChart.destroy();
  lineChart = new Chart(ctxLine, {
    type:'line',
    data:{
      labels: sample.labels,
      datasets:[{
        label:'Distance',
        data: sample.distances,
        fill:true,
        tension:0.35,
        pointRadius:5,
        pointHoverRadius:7,
        backgroundColor:createGradient(ctxLine, '#e8f1ff', '#cfeaff'),
        borderColor:'#2563eb'
      }]
    },
    options:{responsive:true, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true}}}
  });

  // doughnut chart: run vs idle (simple split)
  const moving = Math.round(sample.totalDist * 0.62);
  const idle = Math.max(1, sample.totalDist - moving);
  const ctxDon = document.getElementById('doughnutChart').getContext('2d');
  if(doughnutChart) doughnutChart.destroy();
  doughnutChart = new Chart(ctxDon, {
    type:'doughnut',
    data:{
      labels:['Moving','Idle'],
      datasets:[{data:[moving,idle], backgroundColor:['rgba(37,99,235,0.95)','rgba(6,182,212,0.9)']}]
    },
    options:{responsive:true, plugins:{legend:{position:'bottom'}}}
  });
}

function createGradient(ctx, c1, c2){
  const g = ctx.createLinearGradient(0,0,0,220);
  g.addColorStop(0, c1);
  g.addColorStop(1, c2);
  return g;
}

/* --------------------------
   Route playback (canvas)
   -------------------------- */
const routeCanvas = document.getElementById('routeCanvas');
const rc = routeCanvas.getContext('2d');
let routeState = {points:[], idx:0, playing:false, speed:1.0, lastTime:null, animId:null};

function resizeRouteCanvas(){
  const rect = routeCanvas.getBoundingClientRect();
  routeCanvas.width = Math.round(rect.width * devicePixelRatio);
  routeCanvas.height = Math.round(rect.height * devicePixelRatio);
  rc.setTransform(devicePixelRatio,0,0,devicePixelRatio,0,0);
}
window.addEventListener('resize', ()=> { resizeRouteCanvas(); drawRoute(); });
resizeRouteCanvas();

function drawGrid(){
  const w = routeCanvas.clientWidth;
  const h = routeCanvas.clientHeight;
  rc.clearRect(0,0,w,h);
  // light grid
  rc.strokeStyle = '#eef4ff';
  rc.lineWidth = 1;
  const step = Math.max(40, Math.min(80, Math.round(w/6)));
  for(let x=0;x<w;x+=step){
    rc.beginPath(); rc.moveTo(x,0); rc.lineTo(x,h); rc.stroke();
  }
  for(let y=0;y<h;y+=step){
    rc.beginPath(); rc.moveTo(0,y); rc.lineTo(w,y); rc.stroke();
  }
}

function drawRoute(currentIdx = 0){
  const pts = routeState.points;
  const w = routeCanvas.clientWidth;
  const h = routeCanvas.clientHeight;
  drawGrid();
  if(!pts || pts.length===0){
    rc.fillStyle = '#f3f7ff';
    rc.fillRect(0,0,w,h);
    rc.fillStyle = '#6b7280';
    rc.font = '14px sans-serif';
    rc.fillText('No route loaded', 12, 22);
    document.getElementById('routeStatus').textContent = 'Idle';
    document.getElementById('routeTime').textContent = `0 / 0`;
    return;
  }
  // draw route path
  rc.lineWidth = 3;
  rc.strokeStyle = '#2563eb';
  rc.beginPath();
  pts.forEach((p,i)=>{
    const x = p.x * (w-20) + 10;
    const y = p.y * (h-20) + 10;
    if(i===0) rc.moveTo(x,y); else rc.lineTo(x,y);
  });
  rc.stroke();

  // draw current moving marker
  const idx = Math.max(0, Math.min(currentIdx, pts.length-1));
  const p = pts[idx];
  const mx = p.x * (w-20) + 10;
  const my = p.y * (h-20) + 10;

  // trailing small circle
  rc.beginPath();
  rc.fillStyle = 'rgba(37,99,235,0.12)';
  rc.arc(mx,my,14,0,Math.PI*2); rc.fill();

  rc.beginPath();
  rc.fillStyle = '#ff8a00';
  rc.arc(mx,my,8,0,Math.PI*2); rc.fill();

  // update status text
  document.getElementById('routeStatus').textContent = routeState.playing ? 'Playing' : 'Paused';
  document.getElementById('routeTime').textContent = `${idx+1} / ${pts.length}`;
}

/* animate along points */
function startRoute(){
  if(routeState.playing) return;
  routeState.playing = true;
  routeState.lastTime = null;
  document.getElementById('playRoute').setAttribute('aria-pressed','true');
  document.getElementById('pauseRoute').setAttribute('aria-pressed','false');
  function step(ts){
    if(!routeState.lastTime) routeState.lastTime = ts;
    const dt = (ts - routeState.lastTime) / 1000; // seconds
    routeState.lastTime = ts;
    const advance = dt * 3 * routeState.speed; // adjustable playback rate
    routeState.idx += advance;
    if(routeState.idx >= routeState.points.length - 1){
      routeState.idx = routeState.points.length - 1;
      routeState.playing = false;
    }
    drawRoute(Math.floor(routeState.idx));
    if(routeState.playing) routeState.animId = requestAnimationFrame(step);
    else {
      cancelAnimationFrame(routeState.animId); routeState.animId = null;
      document.getElementById('playRoute').setAttribute('aria-pressed','false');
      document.getElementById('pauseRoute').setAttribute('aria-pressed','false');
    }
  }
  routeState.animId = requestAnimationFrame(step);
}

function pauseRoute(){
  routeState.playing = false;
  if(routeState.animId) cancelAnimationFrame(routeState.animId);
  routeState.animId = null;
  document.getElementById('playRoute').setAttribute('aria-pressed','false');
  document.getElementById('pauseRoute').setAttribute('aria-pressed','true');
}

function resetRoute(){
  pauseRoute();
  routeState.idx = 0;
  drawRoute(0);
}

/* playback buttons */
document.getElementById('playRoute').addEventListener('click', ()=> startRoute());
document.getElementById('pauseRoute').addEventListener('click', ()=> pauseRoute());
document.getElementById('resetRoute').addEventListener('click', ()=> resetRoute());

/* --------------------------
   Wiring + initial render
   -------------------------- */
const metricTrips = document.getElementById('metricTrips');
const metricDistance = document.getElementById('metricDistance');
const metricSpeed = document.getElementById('metricSpeed');
const metricOverstay = document.getElementById('metricOverstay');
const activeReportTitle = document.getElementById('activeReportTitle');
const activeReportSub = document.getElementById('activeReportSub');

let current = {
  report: 'trip',
  vehicle: VEHICLES[0].id,
  driver: DRIVERS[0].id,
  from: dateFrom.value,
  to: dateTo.value
};

function selectReport(item){
  current.report = item.id;
  activeReportTitle.textContent = item.title;
  activeReportSub.textContent = item.desc;
  // visual highlight optional
  updateDashboard(true);
}

/* when Apply / Reset clicked */
applyBtn.addEventListener('click', ()=>{
  current.vehicle = vehicleSelect.value;
  current.driver = driverSelect.value;
  current.from = dateFrom.value;
  current.to = dateTo.value;
  updateDashboard(true);
});
resetBtn.addEventListener('click', ()=>{
  vehicleSelect.selectedIndex = 0;
  driverSelect.selectedIndex = 0;
  populateFilters();
  current.vehicle = vehicleSelect.value;
  current.driver = driverSelect.value;
  current.from = dateFrom.value;
  current.to = dateTo.value;
  updateDashboard(true);
});

/* populate initial menu selections */
REPORTS.forEach(r => {
  // first becomes active visually by default (no extra UI highlight to keep DOM simple)
});
SAFETY.forEach(r=>{});

/* main update function to refresh charts, metrics, and route */
function updateDashboard(flash=false){
  // ensure defaults set
  current.vehicle = current.vehicle || vehicleSelect.value || VEHICLES[0].id;
  current.driver = current.driver || driverSelect.value || DRIVERS[0].id;
  current.from = current.from || dateFrom.value;
  current.to = current.to || dateTo.value;

  const sample = generateSampleData({from:current.from, to:current.to, vehicle:current.vehicle, driver:current.driver});
  createCharts(sample);
  metricTrips.textContent = sample.totalTrips;
  metricDistance.textContent = sample.totalDist + ' km';
  metricSpeed.textContent = sample.avgSpeed + ' km/h';
  metricOverstay.textContent = sample.overstay;

  // load route
  routeState.points = sample.route;
  routeState.idx = 0;
  routeState.playing = false;
  if(routeState.animId) { cancelAnimationFrame(routeState.animId); routeState.animId = null; }
  resizeRouteCanvas();
  drawRoute(0);

  if(flash){
    const el = document.querySelector('.content .panel');
    el.style.boxShadow = '0 20px 60px rgba(37,99,235,0.08)';
    setTimeout(()=> el.style.boxShadow = '0 10px 30px rgba(15,23,42,0.04)', 600);
  }
}

/* initial values */
current.vehicle = VEHICLES[0].id;
current.driver = DRIVERS[0].id;
current.from = dateFrom.value;
current.to = dateTo.value;

/* fill selects with initial values after DOM ready */
document.addEventListener('DOMContentLoaded', ()=>{
  vehicleSelect.value = current.vehicle;
  driverSelect.value = current.driver;
  updateDashboard();
});

/* keyboard shortcuts: 1-6 select first 6 reports */
window.addEventListener('keydown',(e)=>{
  const n = parseInt(e.key,10);
  if(!isNaN(n) && n>=1 && n<=6){
    const r = REPORTS[n-1];
    if(r) selectReport(r);
  }
});
</script>
@endsection