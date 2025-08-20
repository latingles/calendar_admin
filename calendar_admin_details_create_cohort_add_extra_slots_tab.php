  <style>
    /* Namespaced styles */
    .slot-widget-wrap { max-width: 480px; margin: 35px auto 0 auto; background: #fff; border-radius: 14px; box-shadow: 0 4px 20px 0 rgba(60,40,30,0.08); padding: 22px 19px 30px 19px; }
    .slot-widget-label { font-size: 1rem; font-weight: 500; color: #232323; margin-bottom: 6px; display: block;}
    .slot-widget-teacher-dropdown { width: 100%; margin-bottom: 13px; }
    .slot-widget-teacher-selected {
      display: flex; align-items: center; background: #fafbfc;
      border: 2px solid #dadada; border-radius: 12px; padding: 10px 16px; min-height: 48px;
      font-size: 1.09rem; font-weight: 500;
    }
    .slot-widget-teacher-avatar {
      width: 38px; height: 38px; border-radius: 50%; margin-right: 11px; border: 1.2px solid #ececec;
      object-fit: cover; background: #eaeaea;
    }
    .slot-widget-heading {
      font-size: 1.14rem; font-weight: bold; text-align: center;
      margin: 11px 0 13px 0; color: #232323;
    }
    .slot-widget-add-btn {
      width: 100%; margin-top: 9px; background: #fff; color: #fe2e0c;
      border: 2px solid #fe2e0c; font-weight: bold; font-size: 1.09rem;
      border-radius: 9px; padding: 13px 0; cursor: pointer;
      transition: background .13s, color .13s;
    }
    .slot-widget-add-btn:hover { background: #fe2e0c; color: #fff; }
    .slot-widget-tasks-label { margin: 17px 0 8px 2px; color: #232323; font-size: 1rem; font-weight: 500;}
    .slot-widget-tasks-list { margin-bottom: 8px;}
    .slot-widget-task-chip {
      display: flex; align-items: center; justify-content: space-between;
      background: #fafbfc; border: 2px solid #dadada; border-radius: 12px;
      font-size: 1.07rem; color: #959595; padding: 13px 17px; margin-bottom: 8px;
      transition: background .13s; cursor: default;
    }
    .slot-widget-task-remove { color: #222; font-size: 1.2rem; cursor: pointer; margin-left: 13px; transition: color .16s;}
    .slot-widget-task-remove:hover { color: #fe2e0c; }

    /* Modal */
    .slot-widget-modal-backdrop { display:none; position:fixed; left:0; top:0; right:0; bottom:0; z-index: 9999; background:rgba(0,0,0,0.16);}
    .slot-widget-modal {
      background: #fff; width: 97%; max-width: 520px;
      margin: 55px auto 0 auto; border-radius: 16px; box-shadow: 0 8px 34px 0 rgba(40,28,15,.10);
      padding: 24px 16px 18px 16px; position:relative; top: 25px;
    }
    .slot-widget-modal-close { position:absolute; right:12px; top:12px; color:#222; font-size:1.28rem; cursor:pointer;}
    .slot-widget-modal-title { text-align:center; font-weight: bold; font-size: 1.11rem; margin-bottom: 14px; color: #222;}
    .slot-widget-row { display:flex; gap:14px; margin-bottom: 12px;}
    .slot-widget-col { flex:1 1 160px; min-width: 115px;}
    .slot-widget-picker-row { display:flex; gap:8px; margin-top:5px;}
    .slot-widget-date-btn, .slot-widget-time-btn {
      background: #fff; border:2px solid #dadada; border-radius: 20px;
      padding:10px 0; font-size:1.05rem; font-weight:500; width:100%;
      cursor:pointer; transition: border .12s;
      position:relative; z-index: 2;
    }
    .slot-widget-date-btn.selected, .slot-widget-time-btn.selected { border: 2px solid #fe2e0c; color: #fe2e0c; background: #fff4f1;}
    .slot-widget-modal-main-btn {
      width:100%; margin-top: 12px; background: #fe2e0c; color:#fff; border:none; font-weight:bold;
      font-size:1.08rem; border-radius:9px; padding:12px 0; cursor:pointer; letter-spacing:.5px;
      box-shadow: 0 3px 13px 0 rgba(254,46,12,.07);
    }
    /* Inline popups */
    .slot-widget-inline-pop {
      display:none; position:absolute; left:0; top:100%; margin-top:5px; z-index:1112;
      background:#fff; border-radius:10px; box-shadow:0 8px 34px 0 rgba(40,28,15,.10);
      padding:12px 11px 9px 11px; border:1.5px solid #dadada; min-width:205px;
    }
    .slot-widget-calendar-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:4px; font-size:1rem; font-weight:500; color:#222;}
    .slot-widget-calendar-prev, .slot-widget-calendar-next {
      background: #fff4f1; color: #fe2e0c; border:none; border-radius:7px; padding:3px 10px; cursor:pointer; font-size:1.10rem;
    }
    .slot-widget-calendar-grid { display:grid; grid-template-columns: repeat(7, 1fr); gap:2.5px; margin-top:3px; margin-bottom:5px;}
    .slot-widget-calendar-day, .slot-widget-calendar-date {
      text-align:center; font-size:1.01rem; padding:3.5px 0; border-radius:5px; cursor:pointer; background:none; border:none;
    }
    .slot-widget-calendar-day { color:#969696; cursor:default; font-weight:500; font-size:.97rem; padding:2px 0; background: #f7f7f7;}
    .slot-widget-calendar-date.today { border:1.3px solid #fe2e0c;}
    .slot-widget-calendar-date.selected { background:#fe2e0c; color:#fff; font-weight:bold; border-radius:5px;}
    .slot-widget-calendar-done-btn { width:100%; background: #fe2e0c; color: #fff; border:none; border-radius:7px; padding:9px 0; font-size:1.01rem; font-weight:bold; cursor:pointer; margin-top:6px;}
    .slot-widget-inline-pop ul { margin:0;padding:0;list-style:none;max-height:180px;overflow:auto;font-size:1.02rem;}
    .slot-widget-inline-pop li { padding: 6px 0 6px 8px; cursor:pointer; border-radius:5px; margin-bottom:1px;}
    .slot-widget-inline-pop li:hover { background: #f7e3dc; color: #fe2e0c;}
    @media (max-width:600px) {
      .slot-widget-row { flex-direction:column; gap:5px;}
      .slot-widget-col { min-width: 0;}
      .slot-widget-modal { max-width:99vw;}
    }
  </style>



<div class="calendar_admin_details_create_cohort_content tab-content" id="addExtraSlotsTabContent" style="display:none;">
  <div>
    <label class="slot-widget-label" style="margin-top:5px;">Teacher</label>
    <div class="slot-widget-teacher-dropdown">
      <div class="slot-widget-teacher-selected">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="slot-widget-teacher-avatar">
        <span>Daniella</span>
      </div>
    </div>
    <h3 class="slot-widget-heading">Add Extra slots for Booking</h3>
    <button type="button" class="slot-widget-add-btn" id="slotWidgetOpenModalBtn">Add Extra Slot Date</button>
    <div class="slot-widget-tasks-label">You have previously added these tasks</div>
    <div class="slot-widget-tasks-list" id="slotWidgetTasksList"></div>
  </div>

  <!-- Modal -->
  <div class="slot-widget-modal-backdrop" id="slotWidgetModalBackdrop">
    <div class="slot-widget-modal">
      <span class="slot-widget-modal-close" id="slotWidgetCloseModalBtn">&times;</span>
      <div class="slot-widget-modal-title">Add Extra Slot Date &amp; Time</div>
      <div class="slot-widget-row">
        <div class="slot-widget-col" style="position:relative;">
          <label class="slot-widget-label">From</label>
          <div class="slot-widget-picker-row">
            <button type="button" class="slot-widget-date-btn" id="slotWidgetFromDateBtn">Select Date</button>
            <button type="button" class="slot-widget-time-btn" id="slotWidgetFromTimeBtn">Select Time</button>
          </div>
          <div class="slot-widget-inline-pop" id="slotWidgetFromDatePopup"></div>
          <div class="slot-widget-inline-pop" id="slotWidgetFromTimePopup"></div>
        </div>
        <div class="slot-widget-col" style="position:relative;">
          <label class="slot-widget-label">Until</label>
          <div class="slot-widget-picker-row">
            <button type="button" class="slot-widget-date-btn" id="slotWidgetUntilDateBtn">Select Date</button>
            <button type="button" class="slot-widget-time-btn" id="slotWidgetUntilTimeBtn">Select Time</button>
          </div>
          <div class="slot-widget-inline-pop" id="slotWidgetUntilDatePopup"></div>
          <div class="slot-widget-inline-pop" id="slotWidgetUntilTimePopup"></div>
        </div>
      </div>
      <button type="button" class="slot-widget-modal-main-btn" id="slotWidgetModalAddBtn">Add date and time</button>
    </div>
  </div>
</div>
<script>
(function() {
  // Only inside slotWidget:
  let from = { date: null, time: null };
  let until = { date: null, time: null };
  let cal = {
    from: {year:null, month:null, selected:null},
    until: {year:null, month:null, selected:null}
  };

  function renderCal(year, month, selected, pick) {
    let today = new Date();
    let daysInMonth = new Date(year, month+1, 0).getDate();
    let firstDay = new Date(year, month, 1).getDay();
    let weekdays = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
    let months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    let calHtml = `<div class="slot-widget-calendar-head">
      <button class="slot-widget-calendar-prev" data-pick="${pick}">&#8592;</button>
      <span>${months[month]} ${year}</span>
      <button class="slot-widget-calendar-next" data-pick="${pick}">&#8594;</button>
    </div>
    <div class="slot-widget-calendar-grid">`;
    for (let wd of weekdays) calHtml += `<div class="slot-widget-calendar-day">${wd}</div>`;
    for (let i=0;i<firstDay;i++) calHtml += `<div></div>`;
    for (let d=1;d<=daysInMonth;d++) {
      let dstr = `${year}-${String(month+1).padStart(2,"0")}-${String(d).padStart(2,"0")}`;
      let isToday = (today.getFullYear()===year && today.getMonth()===month && today.getDate()===d);
      let isSelected = selected===dstr;
      calHtml += `<button class="slot-widget-calendar-date${isToday?' today':''}${isSelected?' selected':''}" data-date="${dstr}" data-pick="${pick}">${d}</button>`;
    }
    calHtml += `</div>
      <button class="slot-widget-calendar-done-btn" data-pick="${pick}">Done</button>`;
    return calHtml;
  }

  // Open modal
  $('#slotWidgetOpenModalBtn').on('click', function() {
    $('#slotWidgetFromDateBtn, #slotWidgetUntilDateBtn').text('Select Date').removeClass('selected');
    $('#slotWidgetFromTimeBtn, #slotWidgetUntilTimeBtn').text('Select Time').removeClass('selected');
    from = { date: null, time: null };
    until = { date: null, time: null };
    cal.from = {year:null, month:null, selected:null};
    cal.until = {year:null, month:null, selected:null};
    $('#slotWidgetModalBackdrop').fadeIn(140);
    $('.slot-widget-inline-pop').hide();
  });

  $('#slotWidgetCloseModalBtn').on('click', function(){
    $('#slotWidgetModalBackdrop').fadeOut(130);
    $('.slot-widget-inline-pop').hide();
  });

  // Calendar logic - From
  $('#slotWidgetFromDateBtn').on('click', function(e){
    e.preventDefault(); $('.slot-widget-inline-pop').hide();
    let now = new Date();
    cal.from.year = now.getFullYear();
    cal.from.month = now.getMonth();
    $('#slotWidgetFromDatePopup').html(
      renderCal(cal.from.year, cal.from.month, cal.from.selected, 'from')
    ).show();
  });
  // Calendar logic - Until
  $('#slotWidgetUntilDateBtn').on('click', function(e){
    e.preventDefault(); $('.slot-widget-inline-pop').hide();
    let now = new Date();
    cal.until.year = now.getFullYear();
    cal.until.month = now.getMonth();
    $('#slotWidgetUntilDatePopup').html(
      renderCal(cal.until.year, cal.until.month, cal.until.selected, 'until')
    ).show();
  });
  // Nav
  $(document).on('click', '.slot-widget-calendar-prev', function(){
    let pick = $(this).data('pick');
    cal[pick].month--;
    if (cal[pick].month<0) { cal[pick].month=11; cal[pick].year--; }
    let html = renderCal(cal[pick].year, cal[pick].month, cal[pick].selected, pick);
    if (pick==='from') $('#slotWidgetFromDatePopup').html(html);
    else $('#slotWidgetUntilDatePopup').html(html);
  });
  $(document).on('click', '.slot-widget-calendar-next', function(){
    let pick = $(this).data('pick');
    cal[pick].month++;
    if (cal[pick].month>11) { cal[pick].month=0; cal[pick].year++; }
    let html = renderCal(cal[pick].year, cal[pick].month, cal[pick].selected, pick);
    if (pick==='from') $('#slotWidgetFromDatePopup').html(html);
    else $('#slotWidgetUntilDatePopup').html(html);
  });
  // Select a date
  $(document).on('click', '.slot-widget-calendar-date', function(){
    let pick = $(this).data('pick');
    let val = $(this).data('date');
    cal[pick].selected = val;
    let html = renderCal(cal[pick].year, cal[pick].month, val, pick);
    if (pick==='from') $('#slotWidgetFromDatePopup').html(html);
    else $('#slotWidgetUntilDatePopup').html(html);
  });
  // Done button
  $(document).on('click', '.slot-widget-calendar-done-btn', function(){
    let pick = $(this).data('pick');
    let val = cal[pick].selected;
    if (!val) return alert('Please select a date');
    let d = new Date(val);
    let weekdays = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
    let months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    let label = weekdays[d.getDay()] + ", " + months[d.getMonth()] + d.getDate();
    if (pick==='from') {
      $('#slotWidgetFromDateBtn').text(label).addClass('selected');
      from.date = label;
      $('#slotWidgetFromDatePopup').hide();
    } else {
      $('#slotWidgetUntilDateBtn').text(label).addClass('selected');
      until.date = label;
      $('#slotWidgetUntilDatePopup').hide();
    }
  });

  // Time pickers
  function renderTimeList(id) {
    let times = [];
    let start = 10; let end = 47;
    for (let i = start; i <= end; i++) {
      let hour = Math.floor(i/2);
      let min = i%2 === 0 ? "00" : "30";
      let hour12 = ((hour+11)%12+1);
      let ampm = hour < 12 ? "AM" : "PM";
      let str = hour12.toString().padStart(2, "0") + ":" + min + " " + ampm;
      times.push(str);
    }
    let html = `<ul>`;
    for (let t of times) html += `<li class="slot-widget-timelist" data-for="${id}">${t}</li>`;
    html += `</ul>`;
    return html;
  }
  $('#slotWidgetFromTimeBtn').on('click', function(e){
    e.preventDefault(); $('.slot-widget-inline-pop').hide();
    $('#slotWidgetFromTimePopup').html(renderTimeList('from')).show();
  });
  $('#slotWidgetUntilTimeBtn').on('click', function(e){
    e.preventDefault(); $('.slot-widget-inline-pop').hide();
    $('#slotWidgetUntilTimePopup').html(renderTimeList('until')).show();
  });
  $(document).on('click', '.slot-widget-timelist', function(){
    let val = $(this).text();
    let which = $(this).data('for');
    if (which === "from") {
      $('#slotWidgetFromTimeBtn').text(val).addClass('selected');
      from.time = val;
      $('#slotWidgetFromTimePopup').hide();
    } else {
      $('#slotWidgetUntilTimeBtn').text(val).addClass('selected');
      until.time = val;
      $('#slotWidgetUntilTimePopup').hide();
    }
  });

  // Add chip
  $('#slotWidgetModalAddBtn').on('click', function(){
    if (!from.date || !from.time || !until.date || !until.time) {
      alert('Please select both From and Until dates and times!');
      return;
    }
    let slotStr = `${from.date}, ${from.time}–${until.time}`;
    let $chip = $(
      `<div class="slot-widget-task-chip">
        ${slotStr}
        <span class="slot-widget-task-remove" title="Remove">&#10005;</span>
      </div>`
    );
    $('#slotWidgetTasksList').append($chip);
    $('#slotWidgetModalBackdrop').fadeOut(120);
    $('.slot-widget-inline-pop').hide();
  });

  // Remove chip
  $(document).on('click', '.slot-widget-task-remove', function(){
    $(this).closest('.slot-widget-task-chip').fadeOut(140, function(){ $(this).remove(); });
  });

  // Click outside to close popups
  $(document).on('mousedown', function(e) {
    let $modal = $('#slotWidgetModalBackdrop .slot-widget-modal');
    if (!$modal.is(e.target) && $modal.has(e.target).length === 0) {
      $('.slot-widget-inline-pop').hide();
    }
  });

})(); // END NAMESPACE


// Tab logic unchanged
$('.calendar_admin_details_create_cohort_tab').click(function () {
  $('.calendar_admin_details_create_cohort_tab').removeClass('active');
  $(this).addClass('active');
  let tab = $(this).data('tab');
  $('#mainModalContent').toggle(tab === "cohort");
  $('#conferenceTabContent').toggle(tab === "conference");
  $('#peerTalkTabContent').toggle(tab === "peertalk");
  $('#mergeTabContent').toggle(tab === "merge");
  $('#addTimeTabContent').toggle(tab === "addtime");
  $('#addExtraSlotsTabContent').toggle(tab === "extraslots");
});

</script>
