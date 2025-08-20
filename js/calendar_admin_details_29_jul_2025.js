
  // ---- DATA ----
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
  // For Agenda
  const agendaData = [
    { date: '2', day: 'Mon', time: '18:30 - 19:30', event: "Latingles - Teachers' Team Meeting" },
    { date: '3', day: 'Tue', time: '18:30 - 19:30', event: "Latingles - Teachers' Team Meeting" },
    { date: '4', day: 'Wed', time: '18:30 - 19:30', event: "Latingles - Teachers' Team Meeting" },
    { date: '5', day: 'Thu', time: '18:30 - 19:30', event: "Latingles - Teachers' Team Meeting" }
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
  // ---- AGENDA ----
  function renderAgendaList() {
    const $list = $('#agendaList');
    $list.empty();
    agendaData.forEach(item => {
      $list.append(`
        <div class="agenda-list-day">
          <div class="agenda-list-date">${item.date} <span>${item.day}</span></div>
          <div class="agenda-list-event">
            <span class="agenda-list-event-time">${item.time}</span>
            <span>${item.event}</span>
          </div>
        </div>
      `);
    });
  }
  // --- Dropdown menu logic
  function closeAllDropdowns() {
    $('.dropdown-menu, .profile-menu').hide();
  }
  // Position dropdown below trigger, fixed to window!
  function showDropdownMenu($trigger, $dropdown) {
    closeAllDropdowns();
    var offset = $trigger.offset();
    var height = $trigger.outerHeight();
    $dropdown.css({
      display: 'block',
      top: offset.top + height + 4,
      left: offset.left
    });
  }
  // --- Tab Switch ---
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
  function updateCalendar() {
    renderTopbarRange();
    renderCalendarGrid();
  }
  $(function(){
    renderAgendaList();
    updateCalendar();
    $('#agendaList').hide(); // Default: show calendar grid, hide agenda list

    // Dropdowns
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
      $(this).closest('form').find('input[type="checkbox"]').not(this)
        .prop('checked', this.checked);
    });
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
    // Tabs
    $('#agenda-btn').click(() => switchTab('agenda'));
    $('#semana-btn').click(() => switchTab('semana'));

    // Navigation
    $('#prev-week').click(function(){ prevWeek(); });
    $('#next-week').click(function(){ nextWeek(); });
    $('#today-btn').click(function(){ goToday(); });

    // Dummy handlers for sidebar buttons (if needed)
    $('.create-cohort, .sidebar-btn').click(function(){
      //alert('Sidebar button pressed!');
    });
  });
