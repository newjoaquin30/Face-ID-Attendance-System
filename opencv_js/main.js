const API_URL = '/Database-Projects/Face_ID_System/api/';
const MODEL_URL = 'https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/';
const MATCH_THRESHOLD = 0.5; // lower = stricter

const video = document.getElementById('vid');
const canvas = document.getElementById('overlay');
const statusEl = document.getElementById('face-status');
const logEl = document.getElementById('log');
const clockEl = document.querySelector('.clock');
const dateEl = document.getElementById('date');

function setStatus(text, type = '') {
  statusEl.textContent = text;
  statusEl.className = 'face-status ' + type;
}

function startClock() {
  const tick = () => {
    const d = new Date();
    clockEl.textContent = d.toLocaleTimeString();
    dateEl.textContent = d.toLocaleDateString(undefined,
      { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
  };
  tick();
  setInterval(tick, 1000);
}

function addLog(name) {
  logEl.querySelector('.empty')?.remove();
  const li = document.createElement('li');
  const n = document.createElement('span');
  const t = document.createElement('span');
  n.textContent = name;
  t.textContent = new Date().toLocaleTimeString();
  li.append(n, t);
  logEl.prepend(li);
}

async function init() {
  startClock();
  setStatus('Loading face models…');

  try {
    await Promise.all([
      faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL),
      faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
      faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL)
    ]);
    video.srcObject = await navigator.mediaDevices.getUserMedia({ video: { width: 640, height: 480 } });
    await new Promise(r => (video.onloadedmetadata = r));
  } catch (e) {
    console.error(e);
    return setStatus('Camera or models failed to load or permission denied. Use HTTPS/localhost and allow camera access.', 'err');
  }

  let students = [];
  try {
    students = await (await fetch(API_URL + 'get-face.php')).json();
  } catch (e) {
    console.error(e);
    return setStatus('Could not load registered students.', 'err');
  }
  if (!Array.isArray(students) || !students.length) {
    return setStatus('No students are registered for face ID yet.', 'warn');
  }

  const byId = Object.fromEntries(students.map(s => [String(s.id), s]));
  const matcher = new faceapi.FaceMatcher(
    students.map(s => new faceapi.LabeledFaceDescriptors(
      String(s.id), [new Float32Array(JSON.parse(s.descriptor))]
    )),
    MATCH_THRESHOLD
  );

  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  const ctx = canvas.getContext('2d');
  const handled = new Set();
  let busy = false;
  setStatus('Ready. Look at the camera.');

  setInterval(async () => {
    if (busy) return;
    busy = true;
    try {
      const det = await faceapi.detectSingleFace(video).withFaceLandmarks().withFaceDescriptor();
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      if (!det) return setStatus('No face detected…');

      const best = matcher.findBestMatch(det.descriptor);
      const known = best.label !== 'unknown';

      // The video is mirrored with CSS, so mirror the box x-position (keeps label text readable)
      const b = det.detection.box;
      const box = new faceapi.Box({ x: canvas.width - b.x - b.width, y: b.y, width: b.width, height: b.height });
      new faceapi.draw.DrawBox(box, {
        label: known ? byId[best.label].name : 'Unknown',
        boxColor: known ? '#2b9348' : '#d62839'
      }).draw(canvas);

      if (!known) return setStatus('Face not recognized.', 'err');

      const s = byId[best.label];
      if (handled.has(s.id)) return setStatus(`${s.name}: attendance already recorded today`, 'warn');

      const r = await fetch(API_URL + 'mark.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ student_id: s.id })
      });
      if (!r.ok) return setStatus('Server error. Try again.', 'err');

      const data = await r.json();
      handled.add(s.id);
      if (data.already) {
        setStatus(`${s.name}: attendance already recorded today`, 'warn');
      } else {
        addLog(s.name);
        setStatus(`✔ Attendance marked: ${s.name}`, 'ok');
      }
    } catch (e) {
      console.error(e);
    } finally {
      busy = false;
    }
  }, 1200);
}

init();