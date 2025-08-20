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
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Week Calendar – Stacked Overlaps</title>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<style>
  :root{
    --start-hour: 6;
    --end-hour: 24;
    --hour-h: 64px;                 /* hour row height */
    --col-border: #e6e7ef;          /* column borders */
    --slot-grid: #f1f2f6;           /* empty-slot grid lines */
    --text: #0f1320;
    --muted:#6b7280;
    --event-radius: 16px;
    --stack-offset: 18px;           /* horizontal shift for stacked overlaps */
    --stack-cap: 3;                  /* cap how many visible offsets */
  }
  *{box-sizing:border-box}
  body{margin:0;background:#f5f6fb;font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif;color:var(--text)}
  .wrap{max-width:1220px;margin:20px auto;padding:0 14px}
  .cal{background:#fff;border:1px solid var(--col-border);border-radius:18px;overflow:hidden;box-shadow:0 10px 30px rgba(20,20,40,.08);
  width: 1190px;
  }
  /* header */
  .cal-head{display:grid;grid-template-columns:84px repeat(7,1fr);border-bottom:1px solid var(--col-border);background:#fafbff}
  .cal-head .gutter{border-right:1px solid var(--col-border)}
  .day-h{padding:14px 6px 12px;text-align:center}
  .day-h .dow{font-weight:700;font-size:15px}
  .day-h .dt{display:block;margin-top:2px;color:var(--muted);font-weight:600;font-size:13px}
  /* grid */
  .grid{display:grid;grid-template-columns:84px repeat(7,1fr);max-height:calc((var(--end-hour)-var(--start-hour))*var(--hour-h) + 2px);overflow:auto}
  .gutter{position:sticky;left:0;z-index:3;background:#fff;border-right:1px solid var(--col-border)}
  .time-row{height:var(--hour-h);border-top:1px solid var(--slot-grid);position:relative}
  .time-row:first-child{border-top-color:var(--col-border)}
  .time-label{position:absolute;top:-0.6em;right:8px;background:#fff;padding:0 4px;font-size:12px;color:var(--muted)}
  /* day columns with EMPTY-slot borders (both directions) */
  .day{
    position:relative;border-left:1px solid var(--col-border);
    background:
      /* vertical faint stripes (keeps time gutter white) */
      linear-gradient(to right, transparent 0, transparent calc(100% - 0px)) padding-box,
      /* horizontal hour lines */
      repeating-linear-gradient(to bottom,
        transparent, transparent calc(var(--hour-h) - 1px),
        var(--slot-grid) calc(var(--hour-h) - 1px),
        var(--slot-grid) var(--hour-h)
      );
  }
  .day:first-of-type{border-left-color:var(--col-border)}
  .day-inner{position:relative;height:calc((var(--end-hour)-var(--start-hour))*var(--hour-h))}
  /* events */
  .event{
    position:absolute;background:#fff;border:2.5px solid #1f57ff;border-radius:var(--event-radius);
    padding:10px 12px;box-shadow:0 8px 18px rgba(25,35,60,.08);display:flex;flex-direction:column;gap:6px;overflow:hidden;
    width:calc(96% - 4px);          /* WIDE like snapshot; we’ll shift for overlaps */
    left:4px;                       /* small inner gutter */
  }
  .title{font-weight:800;font-size:16px;letter-spacing:.2px}
  .time{font-size:12px;font-weight:700;color:var(--muted)}
  .chip{display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:700;color:#374151}
  .avatar{width:22px;height:22px;border-radius:50%;object-fit:cover;border:2px solid #fff;box-shadow:0 0 0 1px rgba(0,0,0,.05)}
  /* colors */
  .e-blue{border-color:#1f57ff}
  .e-green{border-color:#2faa7f}
  .e-rose{border-color:#ea3a3a}
  .e-purple{border-color:#a855f7}
  .e-gold{border-color:#d4a017}
  .e-gray{border-color:#d3d7df;background:#f4f5f8}
  /* now line */
  .now{position:absolute;left:0;right:0;height:2px;background:#ff3b30;z-index:2}
  .now:before{content:"";position:absolute;width:10px;height:10px;border-radius:50%;background:#ff3b30;transform:translate(-50%,-4px)}
  /* mobile: horizontal scroll days */
  @media (max-width:700px){
    .cal-head,.grid{grid-template-columns:70px repeat(7,320px)}
  }
</style>
</head>
<body>
<div class="wrap">
  <div class="cal">
    <div id="head" class="cal-head"><div class="gutter"></div></div>
    <div id="grid" class="grid">
      <div id="gutter" class="gutter"></div>
    </div>
  </div>
</div>

<script>
/* ===== CONFIG ===== */
const WEEK_START = new Date(2025,7,4);     // Monday Aug 4, 2025
const START_H = 6, END_H = 24;
const HOUR_H  = 64, PX_PER_MIN = HOUR_H/60;
const STACK_OFFSET = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--stack-offset')) || 18;
const STACK_CAP    = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--stack-cap')) || 3;

/* ===== YOUR EVENTS (edit freely) ===== */
const events = [
  { day:0, title:"FL1",          start:"07:00", end:"09:40", color:"e-blue",  repeat:true },
  { day:1, title:"Jonas",        start:"19:00", end:"19:25", color:"e-green", repeat:true },
  { day:2, title:"Conversation", start:"07:00", end:"09:00", color:"e-blue",  repeat:true },
  { day:2, title:"Conversation", start:"07:10", end:"09:00", color:"e-blue",  repeat:true },
  { day:2, title:"Conversation", start:"07:20", end:"09:20", color:"e-blue",  repeat:true },
  { day:2, title:"Team Meeting", start:"09:00", end:"10:00", color:"e-gray" },
  { day:4, title:"FL4",          start:"06:00", end:"07:00", color:"e-rose",  repeat:true },
  { day:6, title:"Busy",         start:"06:00", end:"07:00", color:"e-gold" },
  { day:5, title:"Peer Talk",    start:"07:30", end:"08:30", color:"e-purple",repeat:true },
  { day:4, title:"Mary Janes",   start:"09:00", end:"10:00", color:"e-blue",  avatar:"https://randomuser.me/api/portraits/women/44.jpg", repeat:true },
  { day:2, title:"Mary Janes",   start:"11:00", end:"12:00", color:"e-blue",  avatar:"https://randomuser.me/api/portraits/women/68.jpg" },
  { day:2, title:"Conversation", start:"12:00", end:"13:00", color:"e-blue",  repeat:true },
  { day:3, title:"Peer Talk",    start:"12:00", end:"13:00", color:"e-purple",repeat:true },
];

/* ===== RENDER (jQuery) ===== */
$(function(){
  document.documentElement.style.setProperty('--start-hour', START_H);
  document.documentElement.style.setProperty('--end-hour',   END_H);
  document.documentElement.style.setProperty('--hour-h',     HOUR_H + 'px');

  const $head = $('#head'), $grid = $('#grid'), $gut = $('#gutter');
  const DOW = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];

  // header
  for(let i=0;i<7;i++){
    const d = new Date(WEEK_START); d.setDate(d.getDate()+i);
    $('<div class="day-h">')
      .append(`<span class="dow">${DOW[i]}</span>`)
      .append(`<span class="dt">${d.getDate()}</span>`)
      .appendTo($head);
  }
  // time gutter
  for(let h=START_H; h<=END_H; h++){
    const $row = $('<div class="time-row">');
    if(h!==START_H) $row.append(`<div class="time-label">${hourLabel(h)}</div>`);
    $gut.append($row);
  }
  // 7 day columns
  const dayEls = [];
  for(let i=0;i<7;i++){
    const $col = $('<div class="day">');
    const $in  = $('<div class="day-inner">').appendTo($col);
    $grid.append($col); dayEls.push($in);
  }

  // prepare events per day
  const perDay = Array.from({length:7}, ()=>[]);
  events.forEach(e => perDay[e.day].push(prep(e)));

  // stacked-overlap layout
  perDay.forEach((list, di)=>{
    list.sort((a,b)=> a.start - b.start || a.end - b.end);
    const active = [];
    list.forEach(ev=>{
      // remove finished
      for(let i=active.length-1;i>=0;i--) if(active[i].end <= ev.start) active.splice(i,1);
      // lane index = current active length (stack order)
      ev.stackIndex = Math.min(active.length, STACK_CAP-1);
      active.push(ev);

      // render
      const top = (ev.start - START_H*60)*PX_PER_MIN;
      const h   = (ev.end   - ev.start)*PX_PER_MIN - 4;

      const $ev = $(`<div class="event ${ev.color}">
          <div class="title">${ev.title}</div>
          <div class="time">${fmt12(ev.start)} – ${fmt12(ev.end)}</div>
          ${ev.avatar||ev.repeat ? `<div class="chip">
            ${ev.avatar? `<img class="avatar" src="${ev.avatar}" alt="">`:''}
            ${ev.repeat? '&#8635;':''}
          </div>`:''}
        </div>`).css({
          top: top+'px',
          height: h+'px',
          left: (4 + ev.stackIndex*STACK_OFFSET) + 'px',
          width: `calc(96% - ${ev.stackIndex*STACK_OFFSET + 4}px)`
        });

      dayEls[di].append($ev);
    });
  });

  drawNow(); setInterval(drawNow, 60*1000);

  function drawNow(){
    $('.now').remove();
    const now = new Date();
    const ws = new Date(WEEK_START), we = new Date(ws); we.setDate(we.getDate()+7);
    if(now<ws || now>=we) return;
    const di = (now.getDay()+6)%7;
    const mins = now.getHours()*60 + now.getMinutes();
    if(mins < START_H*60 || mins > END_H*60) return;
    const y = (mins - START_H*60)*PX_PER_MIN;
    $('<div class="now">').css({top:y}).appendTo(dayEls[di]);
  }

  // helpers
  function prep(e){
    const [sh,sm]=e.start.split(':').map(Number);
    const [eh,em]=e.end.split(':').map(Number);
    return {...e,start:sh*60+sm,end:eh*60+em};
  }
  function hourLabel(h){ const hh=((h+11)%12)+1; return `${hh}:00`; }
  function fmt12(min){ let h=Math.floor(min/60), m=min%60, a=h>=12?'AM':'AM'; a=h>=12?'PM':'AM'; h=(h%12)||12; return `${h}:${String(m).padStart(2,'0')} ${a}`; }
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

