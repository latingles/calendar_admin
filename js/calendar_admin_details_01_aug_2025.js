const hourLabels = [
  "0:00",  "1:00",  "2:00",  "3:00",  "4:00",  "5:00",  "6:00",  "7:00",
  "8:00",  "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00",
  "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00", "24:00"
];

let startDate = new Date();
startDate.setHours(0,0,0,0);
// Always set to Monday of current week
startDate.setDate(startDate.getDate() - ((startDate.getDay() + 6) % 7));

// ==== Event icon map (Unicode or SVG) ====
const eventIcons = {
  repeat: '<span class="event-icon" title="Repeats">&#8635;</span>',  // ⟲
  calendar: '<span class="event-icon" title="Single class">&#128197;</span>', // 🗓
  // You can add more icons here if needed!
};

const calendarEvents = [
  // day, time, type, title, start, end, iconType, photo, span (default 2)
  {day:1, time:1, type:"green", title:"Jonas", start:"7:00", end:"7:25 PM", iconType:"repeat", span:1},
  {day:0, time:2, type:"blue", title:"FL1", start:"8:00", end:"9:00 AM", iconType:"repeat", span:2},
  {day:2, time:3, type:"grey", title:"Team Meeting", start:"09:00", end:"10:00 AM", span:2},
  {day:4, time:2, type:"blue", title:"Mary Janes", start:"09:00", end:"10:00 AM", iconType:"repeat", photo:"https://randomuser.me/api/portraits/women/15.jpg", span:2},
  {day:0, time:4, type:"blue", title:"Conversation", start:"12:00", end:"13:00 AM", iconType:"repeat", span:2},
  {day:4, time:6, type:"purple", title:"Peer Talk", start:"12:00", end:"13:00 AM", iconType:"repeat", span:2},
  {day:1, time:5, type:"blue", title:"Mary Janes", start:"11:00", end:"12:00 AM", iconType:"calendar", photo:"https://randomuser.me/api/portraits/women/15.jpg", span:2},
  {day:5, time:1, type:"orange", title:"FL4", start:"6:00", end:"7:00 AM", iconType:"repeat", span:2},
  {day:6, time:1, type:"yellow", title:"Busy", start:"6:00", end:"7:00 AM", span:2}
];

// Helpers
function getDateRangeText2(startDate) {
  let endDate = new Date(startDate);
  endDate.setDate(endDate.getDate()+6);
  let opts = {month:'long'};
  let m1 = startDate.toLocaleString('default', opts);
  let d1 = startDate.getDate();
  let m2 = endDate.toLocaleString('default', opts);
  let d2 = endDate.getDate();
  let y = startDate.getFullYear();
  if (m1!==m2) return `${m1} ${d1} - ${m2} ${d2}, ${y}`;
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

// ==== CALENDAR RENDER ====
function renderCalendarGrid() {
  let dayNames = getDayNamesArr(startDate);
  let grid = `<div class="calendar-header"></div>`;
  for(let i=0;i<7;i++)
    grid += `<div class="calendar-header">${dayNames[i]}</div>`;

  let skipSlots = Array(7).fill(0);

  for(let row=0; row<hourLabels.length; row++) {
    grid += `<div class="calendar-time">${hourLabels[row]}</div>`;
    for(let col=0; col<7; col++) {
      if(skipSlots[col] > 0) {
        skipSlots[col]--;
        continue;
      }
      // Find event starting at this slot
      let ev = calendarEvents.find(e=>e.day===col && e.time===row);
      if(ev) {
        let span = ev.span || 2;
        let evClass = "calendar-event event-" + ev.type;
        let photoHtml = ev.photo ? `<img src="${ev.photo}" class="event-profile-pic">` : '';
        let iconHtml = ev.iconType && eventIcons[ev.iconType] ? eventIcons[ev.iconType] : '';
        grid += `
          <div class="calendar-cell" style="grid-row: span ${span};">
            <div class="${evClass}">
              <div class="event-card-header">
                <div class="event-title">
                  ${photoHtml}${ev.title}
                </div>
                ${iconHtml}
              </div>
              <div class="event-time">${ev.start} – ${ev.end}</div>
            </div>
          </div>
        `;
        skipSlots[col] = span - 1;
      } else {
        // Figure out what span to use for this empty cell
        let nextEvent = calendarEvents.find(e => e.day === col && e.time > row);
        let nextSpan = 1;
        if(nextEvent) {
          nextSpan = Math.max(1, nextEvent.time - row);
        } else {
          nextSpan = hourLabels.length - row;
        }
        grid += `<div class="calendar-cell" style="grid-row: span ${nextSpan};"><div class="calendar-event empty-slot"></div></div>`;
        skipSlots[col] = nextSpan - 1;
      }
    }
  }
  $('#calendar-grid').html(grid);
  renderCurrentTimeBar();
}

function renderTopbarRange() {
  $('#calendar-range').text(getDateRangeText2(startDate));
}
function renderAgendaList() {
  // ... keep your agenda code here ...
}

// --- Current Time Bar (unchanged) ---
function renderCurrentTimeBar() {
  const $grid = $('#calendar-grid');
  const cellW = $grid.find('.calendar-cell').eq(0).outerWidth() || 175;
  const cellH = $grid.find('.calendar-cell').eq(0).outerHeight() || 62;
  const headerH = $grid.find('.calendar-header').eq(0).outerHeight() || 48;
  const timeW = $grid.find('.calendar-time').eq(0).outerWidth() || 68;

  let now = new Date();
  let gridStart = new Date(startDate); gridStart.setHours(0,0,0,0);
  let gridEnd = new Date(startDate); gridEnd.setDate(gridEnd.getDate()+6); gridEnd.setHours(23,59,59,999);

  if (now < gridStart || now > gridEnd) {
    $('#current-time-indicator').empty();
    return;
  }

  let todayIdx = (now.getDay() + 6) % 7;
  let hour = now.getHours();
  let mins = now.getMinutes();

  let slotRow = -1;
  let slotStartH = 0, slotEndH = 0;
  for (let i = 0; i < hourLabels.length - 1; i++) {
    let hStart = parseInt(hourLabels[i].split(':')[0]);
    let hEnd = parseInt(hourLabels[i+1].split(':')[0]);
    if(hourLabels[i] === "24:00") hStart = 24;
    if(hourLabels[i+1] === "24:00") hEnd = 24;
    if (hour >= hStart && hour < hEnd) {
      slotRow = i;
      slotStartH = hStart;
      slotEndH = hEnd;
      break;
    }
  }
  if (slotRow === -1) {
    $('#current-time-indicator').empty();
    return;
  }
  let y = headerH + slotRow * cellH;
  let slotMinutes = (hour - slotStartH) * 60 + mins;
  let slotTotalMinutes = (slotEndH - slotStartH) * 60;
  let topOffset = (slotMinutes / slotTotalMinutes) * cellH;
  let barY = y + topOffset - 1;
  let left = timeW + todayIdx * cellW;
  let width = cellW;

  $('#current-time-indicator').html(
    `<div class="current-time-bar" style="left:${left}px; top:${barY}px; width:${width}px;"></div>
     <div class="current-time-dot" style="left:${left + width - 6}px; top:${barY - 5}px;"></div>`
  );
}

// ==== UI LOGIC (unchanged, keep as needed) ====
function closeAllDropdowns() { $('.dropdown-menu, .profile-menu').hide(); }
function showDropdownMenu($trigger, $dropdown) {
  closeAllDropdowns();
  var offset = $trigger.offset();
  var height = $trigger.outerHeight();
  $dropdown.css({ display: 'block', top: offset.top + height + 4, left: offset.left });
}
function switchTab(tab) {
  if(tab === 'agenda') {
    $('#agenda-btn').addClass('active');
    $('#semana-btn').removeClass('active');
    $('#calendar-grid-wrapper').hide();
    $('#agendaList').show();
  } else {
    $('#agenda-btn').removeClass('active');
    $('#semana-btn').addClass('active');
    $('#calendar-grid-wrapper').show();
    $('#agendaList').hide();
  }
}
function prevWeek() { startDate.setDate(startDate.getDate()-7); updateCalendar(); }
function nextWeek() { startDate.setDate(startDate.getDate()+7); updateCalendar(); }
function goToday() { startDate = new Date(); updateCalendar(); }
function updateCalendar() {
  renderTopbarRange();
  renderCalendarGrid();
}

$(function(){
  // Your agenda rendering
  renderAgendaList && renderAgendaList();
  updateCalendar();
  $('#agendaList').hide();

  // Dropdowns etc.
  $('#cohort-select').click(function(e){
    e.stopPropagation();
    showDropdownMenu($(this), $('#cohort-dropdown'));
    $('#profile-dropdown').hide();
  });
  $('#profile-dropdown-trigger').click(function(e){
    e.stopPropagation();
    showDropdownMenu($(this), $('#profile-dropdown'));
    $('#cohort-dropdown').hide();
  });
  
  $(document).click(function(){ closeAllDropdowns(); });
  $('.dropdown-menu, .profile-menu').click(function(e){ e.stopPropagation(); });
  $('#select-all-cohorts').on('change', function(){
    $(this).closest('form').find('input[type="checkbox"]').not(this).prop('checked', this.checked);
  });
  $('.profile-option').on('click', function(){
    var img = $(this).find('img').attr('src');
    var name = $(this).find('.profile-option-header').text().trim();
    $('#profile-dropdown-trigger .profile-pic').attr('src', img);
    $('#profile-dropdown-trigger').contents().filter(function(){ return this.nodeType == 3; }).remove();
    $('#profile-dropdown-trigger').append(document.createTextNode(' ' + name));
    $('#profile-dropdown').hide();
  });
  // Tabs
  $('#agenda-btn').click(() => switchTab('agenda'));
  $('#semana-btn').click(() => switchTab('semana'));
  // Navigation
  $('#prev-week').click(function(){ prevWeek(); });
  $('#next-week').click(function(){ nextWeek(); });
  $('#today-btn').click(function(){ goToday(); });
  // Auto-refresh the current time line every minute
  setInterval(function(){
    if($('#calendar-grid').is(':visible')) renderCurrentTimeBar();
  }, 60*1000);
});
