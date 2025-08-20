  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="css/calendar_admin_details.css">
  <link rel="stylesheet" href="css/calendar_admin_details_create_cohort_tab_details.css">
  <link rel="stylesheet" href="css/calendar_admin_details_create_cohort_class_tab.css">
  <link rel="stylesheet" href="css/calendar_admin_details_create_cohort_merge_tab.css">
  <link rel="stylesheet" href="css/calendar_admin_details_create_cohort_add_time_tab.css">
  <link rel="stylesheet" href="css/calendar_admin_details_create_cohort.css">

<div class="calendar_admin_main_wrapper">


    <!-- Sidebar -->
    <aside class="calendar_admin_sidebar">
      <button class="calendar_admin_btn calendar_admin_btn_active" id="calendar_admin_details_create_cohort_open">Create Cohort</button>
      <button class="calendar_admin_btn">Manage Cohort</button>
      <button class="calendar_admin_btn" id="calendar_admin_details_merge">Merge Cohort</button>
      <button class="calendar_admin_btn" id="calendar_admin_details_1_1_class">1:1 Class</button>
      <button class="calendar_admin_btn" id="calendar_admin_details_conference">Conference</button>
      <button class="calendar_admin_btn" id="calendar_admin_details_peer_talk">Peer talk</button>
      <button class="calendar_admin_btn" id="calendar_admin_details_add_time_off">Add time off</button>
      <button class="calendar_admin_btn" id="calendar_admin_details_add_extra_slots">Add Extra Slots</button>
      <button class="calendar_admin_btn">Setup Availability</button>
      <div class="calendar_admin_tags_section">
        <h3>Tags</h3>
        <ul class="calendar_admin_tags_list">
          <li><span class="calendar_admin_tag_icon calendar_admin_tag_first"></span>First Student</li>
          <li><span class="calendar_admin_tag_icon calendar_admin_tag_student"></span>Student Class</li>
          <li><span class="calendar_admin_tag_icon calendar_admin_tag_cohort"></span>Cohort Class</li>
          <li><span class="calendar_admin_tag_icon calendar_admin_tag_conversation"></span>Conversational Class</li>
          <li><span class="calendar_admin_tag_icon calendar_admin_tag_busy"></span>Busy Time</li>
          <li><span class="calendar_admin_tag_icon calendar_admin_tag_google"></span>Google Calendar</li>
        </ul>
        <h3>Lesson status</h3>
        <ul class="calendar_admin_status_list">
          <li><span class="calendar_admin_status_icon calendar_admin_status_icon_confirmed"></span>Confirmed by the student</li>
          <li><span class="calendar_admin_status_icon calendar_admin_status_icon_not_confirmed"></span>Not confirmed by the student</li>
          <li><img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1F501.svg" style="width:14px;margin-right:6px;vertical-align:middle;">Weekly Class</li>
          <li><img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1F4C5.svg" style="width:14px;margin-right:6px;vertical-align:middle;">Single class</li>
        </ul>
      </div>
    </aside>




    <!-- Calendar Main -->
    <main class="calendar_admin_calendar_outer">
      <!-- Header -->
      <div class="calendar_admin_calendar_header">


  <button class="calendar_arrow_btn" id="prev-week">
    <svg width="20" height="20" viewBox="0 0 24 24">
      <polyline points="15 19 8 12 15 5" fill="none" stroke="#222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  </button>
  <button class="calendar_arrow_btn" id="next-week">
    <svg width="20" height="20" viewBox="0 0 24 24">
      <polyline points="9 5 16 12 9 19" fill="none" stroke="#222" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
  </button>
  <span class="calendar_admin_calendar_title" id="calendar-range"></span>



  <div class="calendar_admin_header_section">
      <div class="cohort-select dropdown" id="cohort-select">
        <span class="cohort-icon">&#9776;</span>
        Cohorts
        <span class="dropdown-arrow"><i class="fa fa-chevron-down" style="font-size:14px;"></i></span>
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
      <div class="profile-dropdown profile-dropdown-trigger" id="profile-dropdown-trigger">
        <img src="https://randomuser.me/api/portraits/women/15.jpg" class="profile-pic" alt="profile">
        dlinela
        <span class="dropdown-arrow"><i class="fa fa-chevron-down" style="font-size:14px;"></i></span>
        <div class="dropdown-menu profile-menu" id="profile-dropdown">
          <div class="profile-dropdown-list">
            <div class="profile-option"><div class="profile-option-header"><img src="https://randomuser.me/api/portraits/men/32.jpg"> Edwards</div></div>
            <div class="profile-option"><div class="profile-option-header"><img src="https://randomuser.me/api/portraits/women/15.jpg"> Daniela</div></div>
            <div class="profile-option"><div class="profile-option-header"><img src="https://randomuser.me/api/portraits/men/15.jpg"> Hawkins</div></div>
            <div class="profile-option"><div class="profile-option-header"><img src="https://randomuser.me/api/portraits/men/45.jpg"> Warren</div></div>
          </div>
        </div>
      </div>

          <button class="calendar_admin_menu_btn" style="background:#f7f7ff;color:#111;">Today</button>
          
          <div class="mb-3">
            <button class="calendar_admin_menu_btn calendar_admin_menu_btn_active" id="calendar_admin_semana_btn">
              Semana
            </button>
            <button class="calendar_admin_menu_btn" id="calendar_admin_agenda_btn" style="background:transparent;color:#bbb;">
              Agenda
            </button>
          </div>

        </div>
      </div>
















      
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Stacked Calendar Snapshot-Accurate</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <style>
    body {
      background: #f5f5f9;
      font-family: 'Inter', Arial, sans-serif;
    }
    .calendar-container {
      margin: 32px auto;
      max-width: 1380px;
      background: #f7f7fb;
      border-radius: 18px;
      padding: 16px 12px 24px 12px;
      box-shadow: 0 8px 38px rgba(40,60,110,0.09), 0 1.5px 6px rgba(20,20,20,0.04);
      overflow-x: auto;
    }
    .calendar-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      table-layout: fixed;
      background: #f7f7fb;
      font-size: 1.03rem;
    }
    .calendar-table th, .calendar-table td {
      padding: 0;
      border: none;
      background: #f7f7fb;
      position: relative;
      vertical-align: top;
    }
    .calendar-table th {
      font-size: 1.08rem;
      font-weight: 600;
      color: #888da8;
      background: #f7f7fb;
      height: 44px;
      border-bottom: 2px solid #e4e7ee;
      border-top: none;
      letter-spacing: 0.02em;
    }
    .calendar-table .time-col {
      width: 70px;
      min-width: 56px;
      font-size: 1.05rem;
      color: #b1b3be;
      background: #f7f7fb;
      border-right: 2px solid #e4e7ee;
      text-align: right;
      padding-right: 14px;
      font-weight: 400;
      border-radius: 13px 0 0 13px;
      letter-spacing: 0.01em;
    }
    .calendar-table .calendar-slot {
      min-height: 48px;
      height: 48px;
      border-bottom: 1px solid #e4e7ee;
      border-right: 1px solid #e4e7ee;
      background: #f7f7fb;
      position: relative;
      padding: 0 2px;
      vertical-align: top;
      overflow: visible;
      z-index: 1;
    }
    .calendar-table tr:last-child .calendar-slot { border-bottom: 1.5px solid #e4e7ee; }
    .calendar-table .calendar-slot:last-child { border-right: none; }
    /* Event box with stacking effect */
    .calendar-event {
      border-radius: 13px;
      background: #fff;
      border: 2.1px solid #232d3b;
      box-shadow: 0 2px 12px rgba(20,20,20,0.10);
      padding: 12px 16px 10px 16px;
      font-size: 1.08rem;
      font-weight: 500;
      display: flex;
      flex-direction: column;
      cursor: pointer;
      overflow: hidden;
      margin: 0;
      position: absolute;
      left: 2px;
      right: 2px;
      z-index: 2;
      min-height: 42px;
      max-width: 97%;
      transition: box-shadow 0.15s, left 0.1s;
      word-break: normal;
      white-space: normal;
    }
    .calendar-event.event-green {
      border-color: #2eb872;
      background: #f3fef8;
      color: #176e35;
    }
    .calendar-event.event-orange {
      border-color: #ff7f50;
      background: #fff5f1;
      color: #9e3a08;
    }
    .calendar-event.event-blue {
      border-color: #2f50ed;
      background: #f3f7fe;
      color: #1c2347;
    }
    .calendar-event.event-gray {
      border-color: #b3b3b9;
      background: #f5f5f5;
      color: #222;
    }
    .calendar-event.event-purple {
      border-color: #be37d8;
      background: #f7eafd;
      color: #612e6b;
    }
    .calendar-event.event-yellow {
      border-color: #ffcc00;
      background: #fffdea;
      color: #8a6e00;
    }
    .calendar-event .event-title {
      font-weight: 700;
      font-size: 1.09rem;
      margin-bottom: 0;
      line-height: 1.2;
      display: flex;
      align-items: center;
      word-break: break-word;
      white-space: normal;
    }
    .calendar-event .event-time {
      font-size: 0.98rem;
      font-weight: 400;
      margin-top: 3px;
      margin-bottom: 0;
      color: #777;
      letter-spacing: 0.01em;
    }
    .calendar-event .event-avatar {
      width: 26px; height: 26px;
      border-radius: 50%;
      margin-right: 8px;
      border: 2px solid #fff;
      object-fit: cover;
      background: #f8f8fa;
    }
    .calendar-event .event-repeat {
      font-size: 1.1em;
      margin-left: 6px;
      color:#888;
      font-weight: normal;
    }
    /* Stacking effect for overlapping events */
    .calendar-event.stack-1 { left: 22px; z-index: 3; box-shadow: 0 2px 12px rgba(20,20,20,0.18);}
    .calendar-event.stack-2 { left: 44px; z-index: 2; box-shadow: 0 2px 12px rgba(20,20,20,0.13);}
    .calendar-event.stack-3 { left: 66px; z-index: 1; box-shadow: 0 2px 8px rgba(20,20,20,0.08);}
    .calendar-event:not(.stack-1):not(.stack-2):not(.stack-3) { left: 2px; }
    @media (max-width: 1100px) {
      .calendar-container { max-width: 100vw; }
      .calendar-event { font-size: 0.98rem; padding: 9px 8px 8px 9px;}
      .calendar-table .calendar-slot { min-height: 36px; height: 36px;}
    }
    @media (max-width: 900px) {
      .calendar-event { font-size: 0.93rem; padding: 8px 6px;}
      .calendar-table th, .calendar-table .time-col { font-size: 0.93rem;}
      .calendar-table .calendar-slot { min-height: 28px; height: 28px;}
    }
    @media (max-width: 600px) {
      .calendar-container { padding: 2px 1px;}
      .calendar-table th, .calendar-table .time-col { font-size: 0.80rem;}
      .calendar-table .calendar-slot { min-height: 16px; height: 16px;}
      .calendar-event { font-size: 0.87rem; padding: 3px 2px 4px 3px;}
    }
  </style>
</head>
<body>
<div class="calendar-container">
  <table class="calendar-table" id="calendarTable">
    <thead>
      <tr>
        <th class="time-col"></th>
        <th>Mon 2</th>
        <th>Tue 3</th>
        <th>Wed 4</th>
        <th>Thu 5</th>
        <th>Fri 6</th>
        <th>Sat 7</th>
        <th>Sun 8</th>
      </tr>
    </thead>
    <tbody>
      <!-- Filled by jQuery -->
    </tbody>
  </table>
</div>



<script>
const days = ['Mon 2', 'Tue 3', 'Wed 4', 'Thu 5', 'Fri 6', 'Sat 7', 'Sun 8'];
const startHour = 6, endHour = 24; // 6:00 to 13:00 (for your snapshot; use 0,24 for full day)
const slotMinutes = 30;

// Events: allow overlaps, stacking, avatar, etc.
const events = [
  { day: 1, start: "07:00", end: "07:25", title: "Jonas", colorClass: "event-green", repeat: true },
  { day: 0, start: "08:00", end: "09:00", title: "FL1", colorClass: "event-blue", repeat: true },
  { day: 0, start: "09:00", end: "10:00", title: "Conversation", colorClass: "event-blue", avatar: "https://randomuser.me/api/portraits/women/44.jpg", repeat: true },
  { day: 2, start: "07:00", end: "08:00", title: "Conversation", colorClass: "event-blue", repeat: true },
  { day: 2, start: "09:00", end: "10:00", title: "Mary Janes", colorClass: "event-blue", avatar: "https://randomuser.me/api/portraits/women/44.jpg" },
  { day: 2, start: "09:00", end: "10:00", title: "Team Meeting", colorClass: "event-gray" },
  { day: 4, start: "06:00", end: "07:00", title: "FL4", colorClass: "event-orange", repeat: true },
  { day: 5, start: "07:30", end: "08:30", title: "Peer Talk", colorClass: "event-purple", repeat: true },
  { day: 6, start: "06:00", end: "07:00", title: "Busy", colorClass: "event-yellow" },
  { day: 5, start: "09:00", end: "10:00", title: "Mary Janes", colorClass: "event-blue", avatar: "https://randomuser.me/api/portraits/women/44.jpg" },
  { day: 5, start: "12:00", end: "13:00", title: "Peer Talk", colorClass: "event-purple" },
  // Overlapping events for demo
  { day: 2, start: "07:00", end: "08:00", title: "Mary", colorClass: "event-blue", avatar: "https://randomuser.me/api/portraits/men/31.jpg" },
  { day: 2, start: "07:00", end: "08:00", title: "Jerry", colorClass: "event-blue", avatar: "https://randomuser.me/api/portraits/men/32.jpg" }
];

// Build 30-min slot labels
function pad(num) { return num < 10 ? "0"+num : num; }
function timeLabels() {
  const labels = [];
  for (let h = startHour; h < endHour; ++h) {
    labels.push(pad(h) + ":00");
    labels.push(pad(h) + ":30");
  }
  return labels;
}
function parseTime(t) {
  const [h, m] = t.split(':').map(Number);
  return h * 60 + m;
}

// Find all events overlapping this time slot for a day
function findEventsForSlot(row, day, labels, events) {
  const slotStart = parseTime(labels[row]);
  const slotEnd = slotStart + slotMinutes;
  // Find all events active in this slot and which start in this slot
  return events.filter(ev => {
    const evStart = parseTime(ev.start);
    const evEnd = parseTime(ev.end);
    return ev.day === day && evStart < slotEnd && evEnd > slotStart && evStart >= slotStart;
  });
}

$(function(){
  const labels = timeLabels();
  const slotHeight = 48; // px, matches CSS
  const $tbody = $("#calendarTable tbody").empty();

  // For each time slot, each day, render events if present (with stacking!)
  for(let row=0; row<labels.length; ++row) {
    const $tr = $('<tr></tr>');
    // Time label
    $tr.append('<td class="time-col align-top">'+labels[row]+'</td>');
    for(let day=0; day<7; ++day) {
      const $td = $('<td class="calendar-slot"></td>');
      // Gather all events *starting* in this slot (for stacking)
      const eventsInSlot = events.filter(ev =>
        ev.day === day && parseTime(ev.start) === parseTime(labels[row])
      );
      // For each event, stack with offset
      eventsInSlot.forEach((ev, stackIdx) => {
        // Duration in slots
        let startIdx = labels.findIndex(l=>parseTime(l)===parseTime(ev.start));
        let endIdx = labels.findIndex(l=>parseTime(l)===parseTime(ev.end));
        if (endIdx === -1) endIdx = labels.length;
        const duration = (endIdx > startIdx ? endIdx-startIdx : 1);
        const top = 2 + stackIdx*8; // for stacked effect
        const leftOffset = stackIdx*20; // for stacked effect
        let avatarHTML = ev.avatar ? `<img src="${ev.avatar}" class="event-avatar" alt=""/>` : '';
        let repeatHTML = ev.repeat ? `<span class="event-repeat">&#8635;</span>` : '';
        let timeStr = `${ev.start.replace(/^0/, '')} - ${ev.end.replace(/^0/, '')} ${parseTime(ev.end)<720?'AM':'PM'}`;
        let stackClass = stackIdx === 1 ? 'stack-1' : stackIdx === 2 ? 'stack-2' : stackIdx === 3 ? 'stack-3' : '';
        let box = `
          <div class="calendar-event ${ev.colorClass} ${stackClass}" 
            style="top:${top}px; left:${leftOffset}px; height:${duration*slotHeight-8}px;">
            <span class="event-title">${avatarHTML}${ev.title}${repeatHTML}</span>
            <span class="event-time">${timeStr}</span>
          </div>`;
        $td.append(box);
      });
      $tr.append($td);
    }
    $tbody.append($tr);
  }
});
</script>
</body>
</html>


















       <?php require_once('calendar_admin_details_agenda_tab.php'); ?>

    </main>
  </div>

  

<script>
$(function() {
  // On "Semana" button click
  $('#calendar_admin_semana_btn').on('click', function() {
    $(this).addClass('calendar_admin_menu_btn_active')
      .css({'background':'', 'color':''});
    $('#calendar_admin_agenda_btn')
      .removeClass('calendar_admin_menu_btn_active')
      .css({'background':'transparent', 'color':'#bbb'});
    $('#calendar_admin_calendar_flexrow').show();
    $('#calendar_admin_agenda_content').hide();
  });

  // On "Agenda" button click
  $('#calendar_admin_agenda_btn').on('click', function() {
    $(this).addClass('calendar_admin_menu_btn_active')
      .css({'background':'', 'color':''});
    $('#calendar_admin_semana_btn')
      .removeClass('calendar_admin_menu_btn_active')
      .css({'background':'transparent', 'color':'#bbb'});
    $('#calendar_admin_calendar_flexrow').hide();
    $('#calendar_admin_agenda_content').show();
  });
});
</script>


<script src="js/calendar_admin_details.js"></script>
<?php require_once('calendar_admin_details_create_cohort.php'); ?>
<script src="js/calendar_admin_details_create_cohort_tab_details.js"></script>
<script src="js/calendar_admin_details_create_cohort_class_tab.js"></script>
<script src="js/calendar_admin_details_create_cohort_merge_tab.js"></script>
<script src="js/calendar_admin_details_create_cohort_add_time_tab.js"></script>

<script src="js/calendar_admin_details_create_cohort.js"></script>

