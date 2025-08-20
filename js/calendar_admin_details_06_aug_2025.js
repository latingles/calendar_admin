// --- Button Activation ---
$('.calendar_admin_btn').on('click', function() {
  $('.calendar_admin_btn').removeClass('calendar_admin_btn_active');
  $(this).addClass('calendar_admin_btn_active');
});
$('.calendar_admin_menu_btn').on('click', function() {
  $('.calendar_admin_menu_btn').removeClass('calendar_admin_menu_btn_active');
  $(this).addClass('calendar_admin_menu_btn_active');
});

// --- Helper Functions ---
function pad(num) { return num < 10 ? "0"+num : num; }
function getMonday(date) {
  let d = new Date(date);
  let day = d.getDay();
  let diff = d.getDate() - day + (day === 0 ? -6 : 1);
  d.setDate(diff);
  d.setHours(0,0,0,0);
  return d;
}
function isSameDay(d1, d2) {
  return d1.getFullYear()===d2.getFullYear() && d1.getMonth()===d2.getMonth() && d1.getDate()===d2.getDate();
}
function isDateInWeek(date, weekStart) {
  let d = new Date(date);
  let ws = new Date(weekStart);
  let we = new Date(ws);
  we.setDate(ws.getDate() + 6);
  d.setHours(0,0,0,0);
  ws.setHours(0,0,0,0);
  we.setHours(0,0,0,0);
  return d >= ws && d <= we;
}

// --- Example: Only show in correct week ---
// Set the correct "date" for each event below
var demoEvents = [
  
  { date: '2025-08-10', day: 0, hour: 2, min: 0, duration: 60, title: "FL1", className: "calendar_admin_event_student", subtext: "8:00 - 9:00 AM", repeat: true },
  { date: '2025-08-10', day: 0, hour: 3, min: 0, duration: 60, title: "FL1", className: "calendar_admin_event_student", subtext: "8:00 - 9:00 AM", repeat: true },
  { date: '2025-08-10', day: 0, hour: 2, min: 0, duration: 60, title: "FL1", className: "calendar_admin_event_student", subtext: "8:00 - 9:00 AM", repeat: true },
  { date: '2025-08-10', day: 0, hour: 2, min: 0, duration: 60, title: "FL1", className: "calendar_admin_event_student", subtext: "8:00 - 9:00 AM", repeat: true },
  
  { date: '2025-08-09', day: 1, hour: 3, min: 0, duration: 25, title: "Jonas", className: "calendar_admin_event_first", subtext: "7:00 - 7:25 PM", repeat: true },
  { date: '2025-08-09', day: 2, hour: 6, min: 0, duration: 60, name: 'Mary Janes', avatar: 'https://randomuser.me/api/portraits/women/44.jpg', className: "calendar_admin_event_student", subtext: "09:00 - 10:00 AM", repeat: false, imgRepeat: true },
  { date: '2025-08-09', day: 2, hour: 1, min: 0, duration: 60, title: "Conversation", className: "calendar_admin_event_conversation", subtext: "12:00 - 13:00 AM", repeat: true },
  { date: '2025-08-09', day: 2, hour: 5, min: 0, duration: 60, title: "Peer Talk", className: "calendar_admin_event_peer", subtext: "12:00 - 13:00 AM", repeat: true },
  { date: '2025-08-09', day: 3, hour: 3, min: 0, duration: 60, title: "Team Meeting", className: "calendar_admin_event_team", subtext: "09:00 - 10:00 AM" },
  { date: '2025-08-09', day: 4, hour: 1, min: 0, duration: 60, title: "FL4", className: "calendar_admin_event_fl", subtext: "6:00 - 7:00 AM", repeat: true },
  { date: '2025-08-09', day: 5, hour: 5, min: 0, duration: 60, name: 'Mary Janes', avatar: 'https://randomuser.me/api/portraits/women/43.jpg', className: "calendar_admin_event_student", subtext: "09:00 - 10:00 AM", repeat: true },
  { date: '2025-08-09', day: 6, hour: 2, min: 0, duration: 60, title: "Busy", className: "calendar_admin_event_busy", subtext: "6:00 - 7:00 AM" }
];

// --- Render Time Labels (1 per hour) ---
function renderTimeLabels() {
  var container = document.getElementById('calendar_admin_time_labels_col');
  container.innerHTML = '';
  for(var hour=1; hour < 24; hour++) {
    var div = document.createElement('div');
    div.className = "calendar_admin_time_label_item";
    div.style.height = "92px";
    div.style.display = "flex";
    div.style.alignItems = "flex-start";
    div.style.fontWeight = "600";
    div.textContent = pad(hour)+":00";
    container.appendChild(div);
  }
}

// --- Render Calendar Header ---
function renderCalendarHeader(weekStart) {
  const months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
  let start = new Date(weekStart);
  let end = new Date(start);
  end.setDate(start.getDate() + 6);

  $('#calendar-range').text(
    `${months[start.getMonth()]} ${String(start.getDate()).padStart(2,'0')}–${String(end.getDate()).padStart(2,'0')} , ${start.getFullYear()}`
  );
  let days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
  let tr = '';
  let temp = new Date(start);
  for(let i=0; i<7; i++) {
    tr += `<th>${days[i]} ${String(temp.getDate()).padStart(2,'0')}</th>`;
    temp.setDate(temp.getDate() + 1);
  }
  $('#calendar_admin_calendar_head').html(tr);
}

// --- Render Calendar Body (show only events for current week) ---
function renderCalendarBody(weekStart) {
  var tbody = document.getElementById('calendar_admin_calendar_body');
  tbody.innerHTML = '';
  var grid = [];
  for (var r = 0; r < 48; r++) {
    grid[r] = [];
    for (var c = 0; c < 7; c++) grid[r][c] = null;
  }

  // Filter events for this week
  var eventsThisWeek = demoEvents.filter(function(ev){
    return isDateInWeek(ev.date, weekStart);
  });

  eventsThisWeek.forEach(function(ev) {
    var startRow = ev.hour * 2 + (ev.min >= 30 ? 1 : 0);
    var slots = Math.ceil(ev.duration / 30);
    var free = true;
    for (var i = 0; i < slots; i++) if (grid[startRow + i] && grid[startRow + i][ev.day]) free = false;
    if (!free) return;
    grid[startRow][ev.day] = { ev: ev, rowspan: slots };
    for (var i = 1; i < slots; i++) grid[startRow + i][ev.day] = { skip: true };
  });
  for (var r = 0; r < 48; r++) {
    var tr = document.createElement('tr');
    for (var c = 0; c < 7; c++) {
      if (grid[r][c] && grid[r][c].skip) continue;
      var td = document.createElement('td');
      if (grid[r][c] && grid[r][c].ev) {
        if (grid[r][c].rowspan > 1) td.rowSpan = grid[r][c].rowspan;
        var ev = grid[r][c].ev;

        td.innerHTML =
          '<div class="calendar_admin_event_card '+ev.className+'">'+
            '<div class="calendar_admin_event_headerrow">'+
              // If avatar (Mary Janes), show avatar here:
              (ev.avatar ? '<img src="'+ev.avatar+'" class="calendar_admin_event_avatar" alt="'+(ev.name||'Student')+'">' : '') +
              // If NOT Mary Janes event, show the title here:
              (!ev.avatar && ev.title ? '<span class="calendar_admin_event_title">'+ev.title+'</span>' : '')+
              // Repeat icon logic
              (ev.repeat ? '<span class="calendar_admin_event_repeat">&#8635;</span>' :
                (ev.imgRepeat ? '<span class="calendar_admin_event_repeat"><img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1F4C5.svg" style="width:13px;vertical-align:middle;" alt="Single"></span>' : ''))+
            '</div>'+

            // For ALL events, show the time
            (ev.subtext ? '<div class="calendar_admin_event_subtext">'+ev.subtext+'</div>' : '')+

            // If Mary Janes (avatar present), show the name below the time
            (ev.avatar && ev.name ? '<div class="calendar_admin_event_name">'+ev.name+'</div>' : '')+
          '</div>';


}
      tr.appendChild(td);
    }
    tbody.appendChild(tr);
  }
}

// --- RED TIMELINE BAR ---
function updateRedBar() {
  var now = new Date();
  var hours = now.getHours();
  var mins = now.getMinutes();
  var dayIdx = now.getDay();
  var tableDay = (dayIdx + 6) % 7;
  var rowHeight = 46;
  var slotIdx = hours * 2 + (mins < 30 ? 0 : 1);
  var slotOffset = (mins % 30) / 30 * rowHeight;
  var cellTop = slotIdx * rowHeight + slotOffset;
  if(slotIdx < 0) cellTop = 0;
  if(slotIdx > 47) cellTop = 48 * rowHeight;
  var table = document.getElementById('calendar_admin_calendar_table');
  var wrapper = document.getElementById('calendar_admin_calendar_table_wrapper');
  var bar = document.getElementById('calendar_admin_red_bar');
  if(!table || !bar) return;
  var ths = table.querySelectorAll('thead th');
  if(tableDay < 0 || tableDay > 6) tableDay = 0;
  var th = ths[tableDay];
  if(!th) return;
  var thRect = th.getBoundingClientRect();
  var wrapperRect = wrapper.getBoundingClientRect();
  var left = thRect.left - wrapperRect.left;
  var width = thRect.width;
  bar.style.left = left + 'px';
  bar.style.width = width + 'px';
  bar.style.top = cellTop + 'px';
  // Only show if on this week
  let nowMonday = getMonday(now);
  let weekMonday = getMonday(startDate);
  bar.style.display = (nowMonday.getTime() === weekMonday.getTime()) ? "flex" : "none";
}

// --- Calendar State ---
let startDate = getMonday(new Date());

// --- Initial Render ---
$(function() {
  renderTimeLabels();
  renderCalendarHeader(startDate);
  renderCalendarBody(startDate);
  updateRedBar();

  // --- Week Navigation ---
  $('#prev-week').on('click', function() {
    startDate.setDate(startDate.getDate() - 7);
    renderCalendarHeader(startDate);
    renderCalendarBody(startDate);
    updateRedBar();
  });
  $('#next-week').on('click', function() {
    startDate.setDate(startDate.getDate() + 7);
    renderCalendarHeader(startDate);
    renderCalendarBody(startDate);
    updateRedBar();
  });

  setInterval(updateRedBar, 60 * 1000);
  $(window).on('resize', updateRedBar);

  // --- Dropdown/Profile Logic ---
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
  setInterval(function(){
    if($('#calendar-grid').is(':visible')) renderCurrentTimeBar();
  }, 60*1000);
});

// --- Dropdown Helper Functions ---
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

