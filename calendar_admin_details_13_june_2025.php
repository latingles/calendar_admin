<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <title>Weekly Calendar Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<style>
    :root {
      --main-red: #fd3c22;
      --menu-bg: #fafbfc;
      --calendar-bg: #f8f8fa;
      --border: #e2e5eb;
      --text-main: #232323;
      --header-font: 1.38rem;
      --calendar-slot-h: 62px;
      --calendar-slot-w: 175px;
      --calendar-event-radius: 13px;
      --dropdown-shadow: 0 4px 16px 0 rgba(60,60,60,0.12);
      --dropdown-radius: 18px;
    }
    body {
      font-family: 'Inter', system-ui, Arial, sans-serif;
      background: var(--calendar-bg);
      color: var(--text-main);
      margin: 0;
    }
    .main-wrapper {
      display: flex;
      min-height: 100vh;
    }
    /* Sidebar */
    .sidebar {
      width: 260px;
      background: var(--menu-bg);
      border-right: 1.5px solid var(--border);
      display: flex;
      flex-direction: column;
      padding: 16px 10px 0 10px;
      box-sizing: border-box;
      min-width: 210px;
      z-index: 2;
    }
    .sidebar button, .sidebar .sidebar-btn {
      width: 100%;
      padding: 17px 0;
      margin-bottom: 15px;
      font-size: 1.13rem;
      background: #fff;
      border: none;
      border-radius: 11px;
      color: var(--text-main);
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 1px 1px rgba(120,120,120,0.05);
      transition: background .13s;
    }
    .sidebar button.create-cohort {
      background: var(--main-red);
      color: #fff;
      font-size: 1.13rem;
      font-weight: 700;
      margin-bottom: 17px;
    }
    .sidebar .label-section {
      margin-top: 30px;
      margin-bottom: 13px;
      font-weight: 600;
      font-size: 1.04rem;
    }
    .sidebar .labels {
      display: flex;
      flex-direction: column;
      gap: 12px;
      font-size: 1rem;
    }
    .label-item {
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: 400;
    }
    .label-circle, .label-icon {
      width: 18px;
      height: 18px;
      border-radius: 50%;
      display: inline-block;
      border: 2px solid #eee;
    }
    .label-green { border-color: #23bb56; background: #e9f5ed;}
    .label-blue { border-color: #2b3990; background: #e8f1fa;}
    .label-purple { border-color: #af4eee; background: #f4eafd;}
    .label-yellow { border-color: #ffdb00; background: #fffce0;}
    .label-grey { border-color: #bbb; background: #edeceb;}
    .label-confirmed { background: #232323; color: #fff; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;}
    .label-clock { background: none; border: 0; font-size: 1.15em; color: #111;}
    .label-repeat { background: none; border: 0; font-size: 1.17em; color: #111;}
    .label-calendar { background: #fff; border: 0; font-size: 1.19em;}
    /* Calendar main */
    .calendar-main {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow: auto;
      min-width: 0;
      background: #fff;
    }
    /* Top Bar New Flex Grid */
    .calendar-topbar2 {
      display: grid;
      grid-template-columns: auto auto auto auto auto 1fr auto auto;
      align-items: center;
      gap: 0 14px;
      padding: 22px 36px 10px 36px;
      border-bottom: 1.5px solid var(--border);
      min-width: 0;
      background: #fff;
      position: relative;
      z-index: 1;
    }
    .calendar-arrows {
      display: flex;
      gap: 7px;
      align-items: center;
    }
    .calendar-arrow {
      background: #fff;
      border: 1.3px solid var(--border);
      border-radius: 8px;
      width: 38px;
      height: 38px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.45rem;
      cursor: pointer;
      transition: background .13s;
    }
    .calendar-arrow:active { background: #f0f0f4;}
    .calendar-date-range2 {
      font-size: var(--header-font);
      font-weight: 700;
      letter-spacing: 0.5px;
      text-align: left;
      margin-left: 6px;
    }
    .cohort-select, .profile-dropdown-trigger {
      padding: 8px 19px 8px 12px;
      border-radius: 8px;
      border: 1.3px solid var(--border);
      background: #fafbfc;
      font-size: 1.07rem;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 9px;
      min-width: 115px;
      position: relative;
      box-sizing: border-box;
    }
    .cohort-select .cohort-icon {
      font-size: 1.14em;
      margin-right: 2px;
    }
    .cohort-select .dropdown-arrow, .profile-dropdown-trigger .dropdown-arrow {
      font-size: 1.17em;
      margin-left: 5px;
    }
    .profile-dropdown-trigger {
      background: #fff;
      min-width: 145px;
      justify-content: flex-start;
      border: 1.3px solid var(--border);
      font-weight: 500;
      color: #222;
    }
    .profile-pic {
      width: 32px; height: 32px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #eee;
      margin-right: 4px;
    }
    .today-btn {
      padding: 8px 24px;
      border-radius: 9px;
      background: #fff;
      border: 1.2px solid var(--border);
      font-size: 1.13rem;
      font-weight: 600;
      cursor: pointer;
      margin: 0 10px 0 10px;
      color: #232323;
    }
    .calendar-views {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .weekview-btn, .agendaview-btn {
      font-size: 1.18rem;
      font-weight: 700;
      color: #ccc;
      background: transparent;
      border: none;
      padding: 8px 17px 11px 17px;
      border-bottom: 3px solid transparent;
      transition: color .15s, border .15s;
      cursor: pointer;
      margin-left: 0;
    }
    .weekview-btn.active {
      color: var(--main-red);
      border-bottom: 3px solid var(--main-red);
      background: transparent;
    }
    .agendaview-btn.active {
      color: #232323;
      border-bottom: 3px solid #ccc;
      background: transparent;
    }
    /* Dropdowns */
    .dropdown-menu {
      position: absolute;
      top: 115%;
      left: 0;
      background: #fff;
      box-shadow: var(--dropdown-shadow);
      border-radius: var(--dropdown-radius);
      padding: 16px 0 16px 0;
      min-width: 255px;
      z-index: 9999;
      display: none;
      border: 1px solid #eee;
      animation: fadeIn .2s;
    }
    @keyframes fadeIn {from{opacity:0;}to{opacity:1;}}
    .cohort-dropdown-list label {
      display: flex;
      align-items: center;
      font-size: 1.08rem;
      padding: 11px 22px 11px 19px;
      cursor: pointer;
      font-weight: 500;
    }
    .cohort-dropdown-list input[type="checkbox"] {
      width: 20px;
      height: 20px;
      margin-right: 15px;
      accent-color: #232323;
      cursor: pointer;
    }
    .profile-dropdown-list {
      display: flex;
      flex-direction: column;
      width: 285px;
      max-width: 95vw;
      padding: 0;
    }
    /* Each user row in dropdown */
    .profile-option {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      gap: 3px;
      padding: 17px 22px 17px 19px;
      font-size: 1.11rem;
      cursor: pointer;
      font-weight: 500;
      border-radius: 10px;
      transition: background .13s;
      position: relative;
      min-width: 0;
      background: transparent;
    }
    .profile-option:hover {
      background: #f2f4f8;
    }
    /* Avatar and name row */
    .profile-option-header {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 3px;
      font-size: 1.13rem;
      font-weight: 600;
    }
    .profile-option img {
      width: 40px; height: 40px; border-radius: 50%; object-fit: cover;
    }
    /* Upcoming event(s) as "chips" below name */
    .dropdown-event-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 8px;
      padding: 2.5px 13px 2.5px 10px;
      margin: 2px 0 0 52px;
      border: 2px solid #fff;
      box-shadow: 0 1px 3px rgba(30,40,40,0.07);
      min-width: 0;
      max-width: 180px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      background: #f8f8fa;
    }
    .dropdown-event-orange {
      background: #fff5f0;
      color: #fd6b2a;
      border-color: #fd6b2a;
    }
    .dropdown-event-yellow {
      background: #fffce0;
      color: #bda900;
      border-color: #ffdb00;
    }
    .dropdown-event-blue {
      background: #e8f1fa;
      color: #2b3990;
      border-color: #2b3990;
    }
    .dropdown-event-purple {
      background: #f4eafd;
      color: #af4eee;
      border-color: #af4eee;
    }
    .dropdown-event-green {
      background: #e9f5ed;
      color: #23bb56;
      border-color: #23bb56;
    }
    /* Calendar Grid */
    .calendar-grid-wrapper {
      flex: 1;
      background: var(--calendar-bg);
      overflow-x: auto;
    }
    .calendar-grid {
      display: grid;
      grid-template-columns: 68px repeat(7, var(--calendar-slot-w));
      grid-auto-rows: var(--calendar-slot-h);
      border-top: 1.4px solid var(--border);
      width: 100%;
      min-width: 1280px;
      background: var(--calendar-bg);
      position: relative;
    }
    .calendar-header {
      background: #fff;
      font-weight: 600;
      text-align: center;
      font-size: 1.11rem;
      border-bottom: 1px solid var(--border);
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding-top: 10px;
    }
    .calendar-time {
      text-align: right;
      padding: 12px 13px 0 0;
      font-size: 1.08rem;
      color: #b5b5b5;
      background: #fff;
      border-bottom: 1px solid var(--border);
      font-weight: 600;
    }
    .calendar-cell {
      position: relative;
      min-width: var(--calendar-slot-w);
      min-height: var(--calendar-slot-h);
      border-bottom: 1px solid var(--border);
      border-right: 1px solid var(--border);
      background: transparent;
      padding: 0;
      vertical-align: middle;
    }
    .calendar-cell:last-child { border-right: none; }
    .calendar-event {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      padding: 9px 17px 9px 13px;
      border-radius: var(--calendar-event-radius);
      font-size: 1.13rem;
      font-weight: 600;
      position: absolute;
      left: 4px; right: 4px; top: 4px; bottom: 4px;
      z-index: 2;
      box-shadow: 0 1px 6px rgba(90,100,110,0.07);
      border: 2.5px solid #fff;
      cursor: pointer;
      overflow: hidden;
      min-height: 44px;
      min-width: 90px;
      transition: box-shadow .14s;
      text-align: left;
      background: #fff;
    }
    .calendar-event .event-title { font-weight: 700; }
    .calendar-event .event-time { font-size: .97rem; margin-top: 2px; font-weight: 500;}
    .calendar-event .event-icons {
      margin-top: 2px;
      font-size: 1.13rem;
      display: flex;
      gap: 5px;
      align-items: center;
    }
    /* Event Colors */
    .event-green { background: #e9f5ed; color: #23bb56; border-color: #23bb56;}
    .event-blue { background: #e8f1fa; color: #2b3990; border-color: #2b3990;}
    .event-purple { background: #f4eafd; color: #af4eee; border-color: #af4eee;}
    .event-yellow { background: #fffce0; color: #bda900; border-color: #ffdb00;}
    .event-grey { background: #edeceb; color: #5a5a5a; border-color: #bbb;}
    .event-orange { background: #fff5f0; color: #fd6b2a; border-color: #fd6b2a;}
    .event-red { background: #ffe0e0; color: #fd3c22; border-color: #fd3c22;}
    .event-brown { background: #f9eee3; color: #ad7735; border-color: #ad7735;}
    /* Empty slot look */
    .empty-slot {
      background: transparent !important;
      border: none !important;
      box-shadow: none !important;
      cursor: default !important;
      min-height: 0;
      min-width: 0;
      padding: 0;
    }

    /* Responsive */
    @media (max-width: 1200px) {
      .calendar-grid { min-width: 1050px;}
      .calendar-header, .calendar-time { font-size: .97em;}
    }
    @media (max-width: 900px) {
      .sidebar { display: none;}
      .calendar-topbar2 { grid-template-columns: 1fr; gap: 14px; padding: 9px 5px;}
      .calendar-grid { min-width: 800px; }
    }
    @media (max-width: 600px) {
      .calendar-grid { min-width: 550px;}
      .calendar-topbar2 { padding: 5px 2px;}
      .calendar-header, .calendar-time { font-size: .93em;}
      .dropdown-menu { left: -20px; min-width: 180px;}
    }
  </style>
</head>
<body>
<div class="main-wrapper">
  <!-- Sidebar -->
  <aside class="sidebar">
    <button class="create-cohort">Create Cohort</button>
    <button class="sidebar-btn">Manage Cohort</button>
    <button class="sidebar-btn">Merge Cohort</button>
    <button class="sidebar-btn">1:1 Class</button>
    <button class="sidebar-btn">Conference</button>
    <button class="sidebar-btn">Add time off</button>
    <button class="sidebar-btn">Add Extra Slots</button>
    <button class="sidebar-btn">Setup Availability</button>
    <div class="label-section">Labels</div>
    <div class="labels">
      <div class="label-item"><span class="label-circle label-green"></span>First Student</div>
      <div class="label-item"><span class="label-circle label-blue"></span>Student Class</div>
      <div class="label-item"><span class="label-circle label-purple" style="background:linear-gradient(120deg,#7536ff,#18baff,#ffbd23);"></span>Cohort Class</div>
      <div class="label-item"><span class="label-circle label-blue"></span>Conversational Class</div>
      <div class="label-item"><span class="label-circle label-yellow"></span>Busy Time</div>
      <div class="label-item"><span class="label-circle label-grey"></span>Google Calendar</div>
      <div class="label-item"><span class="label-confirmed">✔️</span>Confirmed by the student</div>
      <div class="label-item"><span class="label-clock">🕑</span>Not confirmed by the student</div>
      <div class="label-item"><span class="label-repeat">⟲</span>Weekly Class</div>
      <div class="label-item"><span class="label-calendar">📅</span>Single class</div>
    </div>
  </aside>
  <!-- Main calendar -->
  <div class="calendar-main">
    <!-- Top Bar (One Row, Like Snapshot) -->
    <div class="calendar-topbar2">
      <div class="calendar-arrows">
        <div class="calendar-arrow" id="prev-week">&#8592;</div>
        <div class="calendar-arrow" id="next-week">&#8594;</div>
      </div>
      <span class="calendar-date-range2" id="calendar-range"></span>
      <!-- Cohorts Dropdown -->
      <div class="cohort-select" id="cohort-select">
        <span class="cohort-icon">&#9776;</span>
        Cohorts
        <span class="dropdown-arrow">&#9662;</span>
        <div class="dropdown-menu" id="cohort-dropdown">
          <form class="cohort-dropdown-list">
            <label><input type="checkbox" id="select-all-cohorts"> Select All</label>
            <label><input type="checkbox" name="cohort" value="FL1"> FL1</label>
            <label><input type="checkbox" name="cohort" value="FL2"> FL2</label>
            <label><input type="checkbox" name="cohort" value="TX1"> TX1</label>
            <label><input type="checkbox" name="cohort" value="TX2"> TX2</label>
          </form>
        </div>
      </div>

      <!-- Profile Dropdown -->
      <div class="profile-dropdown-trigger" id="profile-dropdown-trigger">
        <img src="https://randomuser.me/api/portraits/women/15.jpg" class="profile-pic" alt="profile">
        dinela
        <span class="dropdown-arrow">&#9662;</span>
        <div class="dropdown-menu" id="profile-dropdown">
          <div class="profile-dropdown-list">
            <div class="profile-option">
              <div class="profile-option-header">
                <img src="https://randomuser.me/api/portraits/men/32.jpg"> Edwards
              </div>
              <span class="dropdown-event-badge dropdown-event-orange">6:00 - 7:00 AM <span style="font-size:1em;">⟲</span></span>
            </div>
            <div class="profile-option">
              <div class="profile-option-header">
                <img src="https://randomuser.me/api/portraits/women/15.jpg"> Daniela
              </div>
              <span class="dropdown-event-badge dropdown-event-yellow">Busy 6:00 - 7:00 AM</span>
            </div>
            <div class="profile-option">
              <div class="profile-option-header">
                <img src="https://randomuser.me/api/portraits/men/15.jpg"> Hawkins
              </div>
              <span class="dropdown-event-badge dropdown-event-blue">8:00 - 9:00 AM <span style="font-size:1em;">⟲</span></span>
            </div>
            <div class="profile-option">
              <div class="profile-option-header">
                <img src="https://randomuser.me/api/portraits/men/45.jpg"> Warren
              </div>
              <span class="dropdown-event-badge dropdown-event-purple">10:00 - 11:00 AM <span style="font-size:1em;">⟲</span></span>
            </div>
          </div>
        </div>
      </div>

      <button class="today-btn" id="today-btn">Today</button>
      <div class="calendar-views">
        <button class="weekview-btn active" id="semana-btn">Semana</button>
        <button class="agendaview-btn" id="agenda-btn">Agenda</button>
      </div>
    </div>
    <!-- Calendar Grid -->
    <div class="calendar-grid-wrapper" id="calendar-grid-wrapper">
      <div class="calendar-grid" id="calendar-grid"></div>
    </div>
  </div>
</div>


<script>
  // --- Calendar Data and Logic
  const hourLabels = ["6:00", "7:00", "8:00", "9:00", "10:00", "11:00"];
  let startDate = new Date(2025, 8, 30); // Sept 30, 2025 (Tuesday)
  const calendarEvents = [
    {day:0, time:2, type:"blue", title:"8:00 - 9:00 AM", icon:"⟲"},
    {day:0, time:4, type:"purple", title:"10:00 - 11:00 AM", icon:"⟲"},
    {day:1, time:1, type:"green", title:"7:00 - 7:25 PM", icon:"⟲"},
    {day:1, time:2, type:"green", title:"7:00 - 8:00 AM", icon:"⟲"},
    {day:1, time:3, type:"blue", title:"8:00 - 9:00 AM", icon:"⟲"},
    {day:1, time:4, type:"purple", title:"10:00 - 11:00 AM", icon:"⟲"},
    {day:2, time:2, type:"green", title:"7:00 - 8:00 AM", icon:"⟲"},
    {day:2, time:3, type:"blue", title:"8:00 - 9:00 AM", icon:"⟲"},
    {day:3, time:0, type:"orange", title:"6:00 - 7:00 AM", icon:"⟲"},
    {day:3, time:2, type:"blue", title:"8:00 - 9:00 AM", icon:"⟲"},
    {day:3, time:4, type:"purple", title:"10:00 - 11:00 AM", icon:"⟲"},
    {day:4, time:0, type:"yellow", title:"Busy<br><span style='font-weight:400;'>6:00 - 7:00 AM</span>", icon:""},
    {day:4, time:2, type:"orange", title:"8:00 - 9:00 AM", icon:"⟲"},
    {day:4, time:4, type:"purple", title:"10:00 - 11:00 AM", icon:"⟲"},
    {day:5, time:2, type:"orange", title:"8:00 - 9:00 AM", icon:"⟲"},
    {day:5, time:4, type:"purple", title:"10:00 - 11:00 AM", icon:"⟲"}
  ];
  function getDateRangeText2(startDate) {
    let endDate = new Date(startDate);
    endDate.setDate(endDate.getDate()+6);
    let opts = {month:'long'};
    let m1 = startDate.toLocaleString('default', opts);
    let d1 = startDate.getDate();
    let m2 = endDate.toLocaleString('default', opts);
    let d2 = endDate.getDate();
    let y = startDate.getFullYear();
    if (m1!==m2)
      return `${m1} ${d1} - ${m2} ${d2}, ${y}`;
    return `${m1} ${d1} - ${d2}, ${y}`;
  }
  function getDayNamesArr(startDate) {
    let days = [];
    for(let i=0; i<7; i++) {
      let d = new Date(startDate);
      d.setDate(d.getDate()+i);
      let wd = d.toLocaleString('default',{weekday:'short'});
      days.push(`${wd} ${d.getDate()}`);
    }
    return days;
  }
  function renderCalendarGrid() {
    let dayNames = getDayNamesArr(startDate);
    let grid = `<div class="calendar-header"></div>`;
    for(let i=0;i<7;i++)
      grid += `<div class="calendar-header">${dayNames[i]}</div>`;
    for(let row=0; row<hourLabels.length; row++) {
      grid += `<div class="calendar-time">${hourLabels[row]}</div>`;
      for(let col=0; col<7; col++) {
        let ev = calendarEvents.find(e=>e.day===col && e.time===row);
        if(ev) {
          let evClass = "calendar-event event-" + ev.type;
          grid += `<div class="calendar-cell"><div class="${evClass}">
            <span class="event-title">${ev.title}</span>
            <span class="event-icons">${ev.icon||""}</span>
          </div></div>`;
        } else {
          grid += `<div class="calendar-cell"><div class="calendar-event empty-slot"></div></div>`;
        }
      }
    }
    $('#calendar-grid').html(grid);
  }
  function renderTopbarRange() {
    $('#calendar-range').text(getDateRangeText2(startDate));
  }
  // --- jQuery Functions
  function prevWeek() {
    startDate.setDate(startDate.getDate()-7);
    updateCalendar();
  }
  function nextWeek() {
    startDate.setDate(startDate.getDate()+7);
    updateCalendar();
  }
  function goToday() {
    startDate = new Date(2025, 8, 30);
    updateCalendar();
  }
  function setView(btn) {
    $('.weekview-btn, .agendaview-btn').removeClass('active');
    $(btn).addClass('active');
  }
  function updateCalendar() {
    renderTopbarRange();
    renderCalendarGrid();
  }
  // Dropdown menu logic
  function closeAllDropdowns() {
    $('.dropdown-menu').hide();
  }
  $(function(){
    $('#prev-week').click(function(){ prevWeek(); });
    $('#next-week').click(function(){ nextWeek(); });
    $('#today-btn').click(function(){ goToday(); });
    $('#semana-btn').click(function(){ setView(this); });
    $('#agenda-btn').click(function(){ setView(this); });
    // Dropdown open/close
    $('#cohort-select').click(function(e){
      e.stopPropagation();
      $('#cohort-dropdown').toggle();
      $('#profile-dropdown').hide();
    });
    $('#profile-dropdown-trigger').click(function(e){
      e.stopPropagation();
      $('#profile-dropdown').toggle();
      $('#cohort-dropdown').hide();
    });
    // Outside click closes
    $(document).click(function(){
      closeAllDropdowns();
    });
    $('.dropdown-menu').click(function(e){
      e.stopPropagation();
    });
    // Cohort select all
    $('#select-all-cohorts').on('change', function(){
      $(this).closest('form').find('input[type="checkbox"]').not(this)
        .prop('checked', this.checked);
    });
    // Profile change demo (avatar and name)
    $('.profile-option').on('click', function(){
      var img = $(this).find('img').attr('src');
      var name = $(this).find('.profile-option-header').text().trim();
      $('#profile-dropdown-trigger .profile-pic').attr('src', img);
      $('#profile-dropdown-trigger').contents().filter(function(){
        return this.nodeType == 3;
      }).remove();
      $('#profile-dropdown-trigger').append(document.createTextNode(' ' + name));
      $('#profile-dropdown').hide();
    });
    updateCalendar();
  });

</script>
</body>
</html>
