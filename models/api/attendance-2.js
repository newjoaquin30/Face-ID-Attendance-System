// attendance.js - face-recognition attendance (plain JS, no backend).
// Uses the elements already in attendance.php:
//   #vid, #face-status, .clock, #date, #log
// Requires face-api.js to be loaded before this file (it already is).
//
// Flow: the student types their name, looks at the camera and presses Submit.
// The face on camera must match the enrolled face for THAT name, otherwise an error is shown.

(() => {
  // ---------- Config ----------
  const MODEL_URL = "https://cdn.jsdelivr.net/npm/@vladmandic/face-api/model/";
  // If you host the models yourself, point this at that folder instead, e.g. "../models/weights/"
  const MATCH_THRESHOLD = 0.5;   // max face distance to count as the same person (lower = stricter, 0.6 is the library default)
  const SCAN_INTERVAL_MS = 400;
  const ENROLL_SAMPLES = 5;
  const ERROR_HOLD_MS = 6000;    // how long a result/error message stays before the live status returns

  const STUDENTS_KEY = "attendance_students";           // { "Name": [[128 numbers], ...] }
  const attendanceKey = () => `attendance_${todayKey()}`; // [{ name, time }]

  // ---------- Elements ----------
  const video = document.getElementById("vid");
  const statusEl = document.getElementById("face-status");
  const clockEl = document.querySelector(".clock");
  const dateEl = document.getElementById("date");
  const logEl = document.getElementById("log");

  const detectorOptions = new faceapi.TinyFaceDetectorOptions({ inputSize: 416, scoreThreshold: 0.5 });

  let enrolling = false;
  let verifying = false;
  let holdUntil = 0;     // while now < holdUntil, the live scan does not overwrite the status message
  let nameInput = null;
  let submitBtn = null;

  // ---------- Helpers ----------
  function pad(n) { return String(n).padStart(2, "0"); }

  function todayKey() {
    const d = new Date();
    return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`;
  }

  function setStatus(msg, color, holdMs = 0) {
    statusEl.textContent = msg;
    statusEl.style.color = color || "";
    holdUntil = holdMs ? Date.now() + holdMs : 0;
  }

  // status updates from the live scan; skipped while a result/error message is being shown
  function liveStatus(msg, color) {
    if (Date.now() >= holdUntil) setStatus(msg, color);
  }

  function loadJSON(key, fallback) {
    try { return JSON.parse(localStorage.getItem(key)) ?? fallback; }
    catch { return fallback; }
  }

  function saveJSON(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
  }

  function enrolledCount() {
    return Object.keys(loadJSON(STUDENTS_KEY, {})).length;
  }

  // ---------- Clock & date ----------
  function updateClock() {
    const now = new Date();
    clockEl.textContent = now.toLocaleTimeString();
    dateEl.textContent = now.toLocaleDateString(undefined, {
      weekday: "long", year: "numeric", month: "long", day: "numeric",
    });
  }

  // ---------- Attendance log ----------
  function renderLog() {
    const records = loadJSON(attendanceKey(), []);
    logEl.innerHTML = "";

    if (records.length === 0) {
      const li = document.createElement("li");
      li.textContent = "No students yet.";
      logEl.appendChild(li);
      return;
    }

    for (const r of records) {
      const li = document.createElement("li");
      li.textContent = `${r.name} - ${r.time}`; // textContent avoids HTML injection
      logEl.appendChild(li);
    }
  }

  function markPresent(name) {
    const records = loadJSON(attendanceKey(), []);
    if (records.some(r => r.name === name)) return false; // already marked today

    records.push({ name, time: new Date().toLocaleTimeString() });
    saveJSON(attendanceKey(), records);
    renderLog();
    return true;
  }

  // ---------- Enrolled students ----------
  async function getDescriptor() {
    const result = await faceapi
      .detectSingleFace(video, detectorOptions)
      .withFaceLandmarks()
      .withFaceDescriptor();
    return result ? result.descriptor : null;
  }

  async function enrollStudent() {
    const name = (prompt("Student name to enroll:") || "").trim();
    if (!name) return;

    enrolling = true;
    const samples = [];
    setStatus(`Enrolling ${name}... hold still`, "orange");

    let tries = 0;
    while (samples.length < ENROLL_SAMPLES && tries < 40) {
      const d = await getDescriptor();
      if (d) samples.push(Array.from(d));
      tries++;
      await new Promise(r => setTimeout(r, 300));
    }

    if (samples.length < ENROLL_SAMPLES) {
      setStatus("Enrollment failed: face not seen clearly. Try again.", "red", ERROR_HOLD_MS);
    } else {
      const students = loadJSON(STUDENTS_KEY, {});
      students[name] = samples;
      saveJSON(STUDENTS_KEY, students);
      setStatus(`${name} enrolled`, "green", ERROR_HOLD_MS);
    }
    enrolling = false;
  }

  // ---------- Submit: check that the face on camera matches the typed name ----------
  async function submitAttendance() {
    if (verifying || enrolling) return;

    const typed = nameInput.value.trim();
    if (!typed) {
      return setStatus("Error: Please enter your name.", "red", ERROR_HOLD_MS);
    }

    // find the enrolled student (case-insensitive)
    const students = loadJSON(STUDENTS_KEY, {});
    const name = Object.keys(students).find(n => n.toLowerCase() === typed.toLowerCase());
    if (!name) {
      return setStatus(`Error: "${typed}" is not enrolled. Check the spelling or ask to be enrolled.`, "red", ERROR_HOLD_MS);
    }

    verifying = true;
    submitBtn.disabled = true;
    setStatus("Checking your face...", "orange");

    try {
      const faces = await faceapi
        .detectAllFaces(video, detectorOptions)
        .withFaceLandmarks()
        .withFaceDescriptors();

      if (faces.length === 0) {
        return setStatus("Error: no face detected. Look at the camera and try again.", "red", ERROR_HOLD_MS);
      }
      if (faces.length > 1) {
        return setStatus("Error: more than one face in the camera. Only the student should be visible.", "red", ERROR_HOLD_MS);
      }

      // distance between the live face and the closest enrolled sample for this name
      const live = faces[0].descriptor;
      const distance = Math.min(
        ...students[name].map(d => faceapi.euclideanDistance(new Float32Array(d), live))
      );

      if (distance >= MATCH_THRESHOLD) {
        return setStatus(`Error: the face on camera does not match the name "${name}".`, "red", ERROR_HOLD_MS);
      }

      if (markPresent(name)) {
        setStatus(`${name}: face verified, attendance submitted`, "green", ERROR_HOLD_MS);
        nameInput.value = "";
      } else {
        setStatus(`${name} is already marked present today`, "green", ERROR_HOLD_MS);
      }
    } catch (err) {
      setStatus("Error: " + err.message, "red", ERROR_HOLD_MS);
    } finally {
      verifying = false;
      submitBtn.disabled = false;
    }
  }

  // ---------- Controls (injected, so the PHP/HTML stays untouched) ----------
  function addControls() {
    const wrap = document.createElement("div");
    wrap.style.cssText = "display:flex; gap:8px; margin:10px 0; flex-wrap:wrap;";

    nameInput = document.createElement("input");
    nameInput.type = "text";
    nameInput.id = "student-name";
    nameInput.placeholder = "Enter your name";
    nameInput.autocomplete = "off";
    nameInput.style.cssText = "flex:1 1 100%; padding:8px 12px; border:1px solid #ccc; border-radius:8px; font-size:15px; font-family: var(--primary-font);";
    nameInput.addEventListener("keydown", e => { if (e.key === "Enter") submitAttendance(); });
    wrap.appendChild(nameInput);

    const mk = (label, onClick) => {
      const b = document.createElement("button");
      b.type = "button";
      b.textContent = label;
      b.style.cssText = "padding:8px 14px; border:0; border-radius:8px; cursor:pointer; font-family: var(--primary-font);";
      b.style.marginBottom = "1rem";
      b.addEventListener("click", onClick);
      wrap.appendChild(b);
      return b;
    };

    submitBtn = mk("Submit attendance", submitAttendance);
    mk("Scan Face", enrollStudent);
    mk("Clear Attendance", () => {
      if (confirm("Clear today's attendance list?")) {
        localStorage.removeItem(attendanceKey());
        renderLog();
      }
    });

    statusEl.insertAdjacentElement("afterend", wrap);
  }

  // ---------- Live camera status ----------
  async function scan() {
    if (!enrolling && !verifying && video.readyState >= 2) {
      const faces = await faceapi.detectAllFaces(video, detectorOptions);

      if (faces.length === 0) {
        liveStatus(enrolledCount() ? "Look at the camera" : "No students enrolled yet.");
      } else if (faces.length > 1) {
        liveStatus("More than one face detected", "orange");
      } else {
        liveStatus("Face detected. Enter your name.", "green");
      }
    }
    setTimeout(scan, SCAN_INTERVAL_MS);
  }

  // ---------- Init ----------
  async function init() {
    updateClock();
    setInterval(updateClock, 1000);
    renderLog();
    addControls();

    try {
      setStatus("Loading models...");
      await Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL),
        faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
        faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL),
      ]);

      video.srcObject = await navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" } });
      await new Promise(r => (video.onloadedmetadata = r));

      setStatus(enrolledCount() ? "Look at the camera" : "No students enrolled yet.");
      scan();
    } catch (err) {
      setStatus("Error: " + err.message, "red");
    }
  }

  init();
})();