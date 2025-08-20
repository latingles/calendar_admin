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



 

      <!-- <div class="calendar-topbar2">
    <div class="calendar-arrows arrow-btns">
      <div class="calendar-arrow arrow-btn" id="prev-week">&#x2039;</div>
      <div class="calendar-arrow arrow-btn" id="next-week">&#x203A;</div>
    </div> -->


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
       <?php require_once('calendar_admin_details_tabs.php'); ?>
        </div>
      </div>











<style>
  :root{
    --start-hour: 7;
    --end-hour: 24;

    /* 30-minute grid */
    --slot-h: 36px;
    --rows: 34;

    /* colors */
    --page-bg:  #f5f6fb;
    --day-bg:   #f6f7fb;
    --slot-line:#e6e8f2;
    --hour-line:#dfe2ec;
    --col-border:#e1e3ec;

    --text: #0f1320;
    --muted:#6b7280;

    --event-radius: 5px;
    --stack-offset: 18px;  /* horizontal offset for overlaps */
    --stack-cap: 3;

    /* keep 3 lanes clickable/visible */
    --reveal-front: 12px;  /* extra right reveal for lane 0 */
    --reveal-mid:   8px;   /* extra right reveal for lane 1 */
  }

  *{box-sizing:border-box}
  body{margin:0;background:var(--page-bg);font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif;color:var(--text)}
  .wrap{max-width:1220px;margin:20px auto;padding:0 14px}
  .cal{
    background:#fff;border:1px solid var(--col-border);border-radius:18px;overflow:hidden;
    box-shadow:0 10px 30px rgba(20,20,40,.08);
    width:1190px;
  }

  .cal-head{
    display:grid;grid-template-columns:84px repeat(7,1fr);
    border-bottom:1px solid var(--col-border);background:#fafbff
  }
  .cal-head .gutter{border-right:1px solid var(--col-border)}
  .day-h{padding:14px 6px 12px;text-align:center}
  .day-h .dow{font-size:15px}
  .day-h .dt{display:block;margin-top:2px;color:var(--muted);font-weight:600;font-size:13px}

  .grid{display:grid;grid-template-columns:84px repeat(7,1fr);max-height:calc(var(--rows)*var(--slot-h) + 2px);overflow:auto}

  .gutter{position:sticky;left:0;z-index:5;background:#fff;border-right:1px solid var(--col-border)}
  .time-row{height:var(--slot-h);position:relative;border-top:none!important}
  .time-label{
    position:absolute; right:8px; background:#fff; padding:0 4px; font-size:12px; color:var(--muted);
    font-weight:600; line-height:1; top: calc(var(--slot-h) - 0.7em);
  }

  .day{ position:relative; background:var(--day-bg); border-left:1px solid var(--col-border) }
  .day-inner{ position:relative; height:calc(var(--rows) * var(--slot-h)); }
  .day-inner .slots{
    position:absolute; inset:0; pointer-events:none; z-index:0;
    display:grid; grid-template-rows:repeat(var(--rows), var(--slot-h));
  }
  .day-inner .slots > div{ border-top:1px solid var(--slot-line); }
  .day-inner .slots > div:first-child{ border-top-color:var(--hour-line); }
  .day-inner .slots > div:nth-child(2n+1){ border-top-color:var(--hour-line); }

  /* Events */
  .event{
    position:absolute; z-index:1; overflow:hidden;
    background:#fff;border:2px solid #1f57ff;border-radius:var(--event-radius);
    padding:8px 8px 6px; box-shadow:0 4px 10px rgba(25,35,60,.08);
    width:calc(100% - 12px); left:4px;
    transition:left .15s ease, width .15s ease, box-shadow .15s ease;
    cursor:pointer;
  }
  .event.is-front{ box-shadow:0 10px 24px rgba(17,24,39,.18); z-index:999; }

  .ev-top{ display:flex; align-items:center; justify-content:space-between; margin-bottom:4px;}
  .ev-left{ display:flex; align-items:center; gap:6px; min-width:0;}
  .ev-avatar{ width:22px;height:22px;border-radius:50%;object-fit:cover;border:1px solid #fff;box-shadow:0 0 0 1px rgba(0,0,0,.06) }
  .ev-repeat{ display:inline-flex;align-items:center;justify-content:center;width:15px;height:15px;border-radius:50%;border:1px solid #cfd6ea;font-size:10px;color:#4b5563;line-height:1 }

  .ev-when{ font-size:9px;color:var(--muted);margin-bottom:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis }
  .ev-title{ font-size:12px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis }

  .e-blue{border-color:#1f57ff}
  .e-green{border-color:#2faa7f}
  .e-rose{border-color:#ea3a3a}
  .e-purple{border-color:#a855f7}
  .e-gold{border-color:#d4a017}
  .e-gray{border-color:#d3d7df;background:#f4f5f8}


/* NOW line: arrows pointing toward each other */
.now {
  position: absolute;
  left: 0;
  right: 0;
  height: 3px;
  background: #ff3b30;
  z-index: 3;
  pointer-events: none;
}

/* Left arrow should point RIGHT (→) */
.now::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 0px;
  transform: translateY(-50%);
  border-top: 6px solid transparent;
  border-bottom: 6px solid transparent;
  border-left: 10px solid #ff3b30; /* Was border-right before */
}

/* Right arrow should point LEFT (←) */
.now::after {
  content: "";
  position: absolute;
  top: 50%;
  right: 0px;
  transform: translateY(-50%);
  border-top: 6px solid transparent;
  border-bottom: 6px solid transparent;
  border-right: 10px solid #ff3b30; /* Was border-left before */
}




  @media (max-width:700px){
    .cal-head,.grid{grid-template-columns:70px repeat(7,320px)}
  }
</style>

<div class="wrap" id="calendar_admin_calendar_flexrow">
  <div class="cal">
    <div id="head" class="cal-head"><div class="gutter"></div></div>
    <div id="grid" class="grid">
      <div id="gutter" class="gutter"></div>
    </div>
  </div>
</div>









<script>
/* ====== CONFIG ====== */
const START_H = 7, END_H = 24, SLOT_MIN = 30;
const SLOT_H = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--slot-h'))||36;
const PX_PER_MIN = SLOT_H / SLOT_MIN;
const STACK_OFFSET = 18, STACK_CAP = 3;
const REVEAL_FRONT = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--reveal-front'))||12;
const REVEAL_MID   = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--reveal-mid'))||8;

const DOW = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];

/* ====== DATA (mix of dated + weekly) ======
   - Use `date: "YYYY-MM-DD"` for one-off items (only shown if that date is inside visible week)
   - Use `day: 0..6` for items that repeat every week (0=Mon .. 6=Sun)
*/

const events = [
  { day:2, title:"Conversation 1", start:"07:00", end:"08:00", color:"e-blue", repeat:true },
  { day:2, title:"Conversation 2", start:"07:00", end:"08:00", color:"e-blue", repeat:true },
  { day:2, title:"Conversation 3", start:"07:00", end:"08:00", color:"e-blue", repeat:true },
  { day:2, title:"Team Meeting",   start:"09:00", end:"10:00", color:"e-gray" },
  { day:4, title:"Mary Janes",     start:"09:00", end:"12:00", color:"e-blue", avatar:"https://randomuser.me/api/portraits/women/44.jpg", repeat:true },
  { day:2, title:"Mary Janes",     start:"11:00", end:"12:00", color:"e-blue", avatar:"https://randomuser.me/api/portraits/women/68.jpg" },
  { day:2, title:"Conversation",   start:"12:00", end:"13:00", color:"e-blue", repeat:true },
  { day:3, title:"Peer Talk",      start:"12:00", end:"13:00", color:"e-purple", repeat:true },

  // Examples with exact dates (shown only in the week containing that date)
  { date:"2025-08-12", title:"One-off Review", start:"10:00", end:"11:15", color:"e-gold" },
  { date:"2025-08-15", title:"Demo Lesson",    start:"07:20", end:"08:00", color:"e-rose" }
];

/* ====== HELPERS ====== */
function pad2(n){return String(n).padStart(2,'0');}
function fmt12(min){let h=Math.floor(min/60),m=min%60,ap=h>=12?'PM':'AM';h=(h%12)||12;return `${h}:${pad2(m)} ${ap}`;}
function minutes(hhmm){const [h,m]=hhmm.split(':').map(Number);return h*60+m;}
function ymd(d){return `${d.getFullYear()}-${pad2(d.getMonth()+1)}-${pad2(d.getDate())}`;}
function mondayOf(date){
  const d = new Date(date.getFullYear(), date.getMonth(), date.getDate());
  const dow = (d.getDay()+6)%7; // Mon=0..Sun=6
  d.setDate(d.getDate()-dow);
  d.setHours(0,0,0,0);
  return d;
}
function rangeText(startDate){
  const endDate = new Date(startDate); endDate.setDate(endDate.getDate()+6);
  const opts = { month: 'long' };
  const m1 = startDate.toLocaleString('default', opts);
  const m2 = endDate.toLocaleString('default', opts);
  const d1 = startDate.getDate();
  const d2 = endDate.getDate();
  const y  = startDate.getFullYear();
  return (m1!==m2) ? `${m1} ${d1} - ${m2} ${d2}, ${y}` : `${m1} ${d1} - ${d2}, ${y}`;
}

/* ====== STATE ====== */
let currentWeekStart = mondayOf(new Date());

$(function(){
  const rows=(END_H-START_H)*(60/SLOT_MIN);
  document.documentElement.style.setProperty('--rows',rows);








  // Overlap click re-order (delegated)
  let zSeed=1000;
  $('#grid').on('click','.event',function(){
    const $clicked=$(this), $day=$clicked.closest('.day-inner');
    const cs=+$clicked.data('start'), ce=+$clicked.data('end');

    const group=$day.find('.event').filter(function(){
      const s=+$(this).data('start'), e=+$(this).data('end');
      return !(e<=cs || s>=ce);
    }).toArray();
    if(group.length<=1) return;

    group.sort((a,b)=> parseFloat($(a).css('left')) - parseFloat($(b).css('left')));
    const idx=group.indexOf($clicked[0]);
    const rotated=[ group[idx], ...group.slice(0,idx), ...group.slice(idx+1) ];

    rotated.forEach((el,lane)=>{
      const $ev=$(el);
      const leftPx=4 + lane*STACK_OFFSET;
      let rightPad=8; if(lane===0) rightPad+=REVEAL_FRONT; if(lane===1) rightPad+=REVEAL_MID;

      $ev.toggleClass('is-front', lane===0).css({
        left:leftPx+'px',
        width:`calc(100% - ${leftPx + rightPad}px)`,
        zIndex: lane===0 ? ++zSeed : (zSeed - lane)
      });
    });
  });




  

  // First render
  renderWeek(true);

  // Navigation
  $('#prev-week').on('click',()=>{ currentWeekStart.setDate(currentWeekStart.getDate()-7); renderWeek(true); });
  $('#next-week').on('click',()=>{ currentWeekStart.setDate(currentWeekStart.getDate()+7); renderWeek(true); });

  // Now line heartbeat
  setInterval(drawNow,60*1000);

  /* ====== RENDER ====== */
  function renderWeek(resetScroll=false){
    // Header
    const $head=$('#head');
    $head.find('.day-h').remove();
    for(let i=0;i<7;i++){
      const d=new Date(currentWeekStart); d.setDate(d.getDate()+i);
      $('<div class="day-h">')
        .append(`<span class="dow">${DOW[i]}</span>`)
        .append(`<span class="dt">${d.getDate()}</span>`)
        .appendTo($head);
    }
    $('#calendar-range').text(rangeText(currentWeekStart));

    // FULL GRID rebuild (gutter + 7 columns with slots)
    const $grid=$('#grid');
    $grid.empty().append('<div id="gutter" class="gutter"></div>');
    const $gut=$('#gutter');
    for(let m=START_H*60; m<=END_H*60; m+=SLOT_MIN){
      const $row=$('<div class="time-row">');
      if(m%60===0) $row.append(`<div class="time-label">${fmt12(m)}</div>`);
      $gut.append($row);
    }

    const dayEls=[];
    const weekDates = [];
    for(let i=0;i<7;i++){
      const d=new Date(currentWeekStart); d.setDate(d.getDate()+i);
      weekDates.push(ymd(d));
      const $col=$('<div class="day">');
      const $inner=$('<div class="day-inner">').appendTo($col);
      const $slots=$('<div class="slots">').appendTo($inner);
      for(let r=0;r<rows;r++) $('<div>').appendTo($slots);
      $grid.append($col); dayEls.push($inner);
    }

    // Prepare per-day buckets, filtering to this visible week
    const perDay=Array.from({length:7},()=>[]);
    events.forEach(raw=>{
      // Decide target day index (0..6) for current week, or skip if out of range
      let di = null;
      if (raw.date){
        const idx = weekDates.indexOf(raw.date);
        if (idx === -1) return; // dated event is outside current week -> skip
        di = idx;
      } else if (typeof raw.day === 'number'){
        di = raw.day; // weekly repeat on fixed weekday
      } else {
        return; // neither date nor day provided
      }
      const e = {...raw};
      e.start = (typeof e.start === 'string') ? minutes(e.start) : e.start;
      e.end   = (typeof e.end   === 'string') ? minutes(e.end)   : e.end;
      perDay[di].push(e);
    });

    // Layout per day (overlap lanes)
    perDay.forEach((list,di)=>{
      list.sort((a,b)=>a.start-b.start || a.end-b.end);
      const active=[];
      list.forEach(ev=>{
        for(let i=active.length-1;i>=0;i--) if(active[i].end<=ev.start) active.splice(i,1);
        ev.stackIndex = Math.min(active.length, STACK_CAP-1);
        active.push(ev);

        const top=(ev.start-START_H*60)*PX_PER_MIN;
        const h=(ev.end-ev.start)*PX_PER_MIN - 4;
        const leftPx=4 + ev.stackIndex*STACK_OFFSET;

        const $ev=$(`<div class="event ${ev.color||'e-blue'}" data-start="${ev.start}" data-end="${ev.end}">
            <div class="ev-top">
              <div class="ev-left">${ev.avatar?`<img class="ev-avatar" src="${ev.avatar}" alt="">`:''}</div>
              ${ev.repeat?`<span class="ev-repeat" title="Repeats">&#8635;</span>`:''}
            </div>
            <div class="ev-when">${fmt12(ev.start)} – ${fmt12(ev.end)}</div>
            <div class="ev-title">${ev.title||''}</div>
          </div>`).css({
            top: top+'px',
            height: h+'px',
            left: leftPx+'px',
            width: `calc(100% - ${leftPx + 8}px)`
          });

        dayEls[di].append($ev);
      });
    });

    if(resetScroll) $grid.scrollTop(0);
    drawNow(); // respect visible week
  }

  function drawNow(){
    $('.now').remove();
    const now=new Date();
    const ws=new Date(currentWeekStart), we=new Date(ws); we.setDate(we.getDate()+7);
    if(now<ws || now>=we) return;                     // only if now is in the visible week
    const di=(now.getDay()+6)%7;
    const mins=now.getHours()*60+now.getMinutes();
    if(mins<START_H*60 || mins>END_H*60) return;      // only inside visible hours
    const y=(mins-START_H*60)*PX_PER_MIN;
    const dayInner = $('#grid .day .day-inner').eq(di);
    $('<div class="now">').css({top:y}).appendTo(dayInner);
  }
});
</script>




<?php require_once('calendar_admin_details_agenda_tab.php'); ?>

    </main>
  </div>

  

<script>
$(function() {
  // On "Semana" button click
  $('#calendar_admin_semana_btn').on('click', function() {
    $('#calendar_admin_semana_btn').addClass('active');
    $('#calendar_admin_agenda_btn').removeClass('active');

    $('#calendar_admin_calendar_flexrow').show();
    $('#calendar_admin_agenda_content').hide();
  });

  // On "Agenda" button click
  $('#calendar_admin_agenda_btn').on('click', function() {
    $('#calendar_admin_agenda_btn').addClass('active');
    $('#calendar_admin_semana_btn').removeClass('active');

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

