
<style>

#addExtraSlotsTabContent { padding: 0 6px; }
.addslots-label {
  font-size: 1rem;
  font-weight: 500;
  color: #232323;
  margin-bottom: 6px;
  display: block;
}
.addslots-teacher-dropdown { width: 100%; margin-bottom: 13px; }
.addslots-teacher-selected {
  display: flex; align-items: center; background: #fafbfc;
  border: 2px solid #dadada; border-radius: 12px; padding: 10px 16px; min-height: 48px;
  font-size: 1.09rem; font-weight: 500;
}
.addslots-teacher-avatar {
  width: 38px; height: 38px; border-radius: 50%; margin-right: 11px; border: 1.2px solid #ececec;
  object-fit: cover; background: #eaeaea;
}
.addslots-heading {
  font-size: 1.15rem;
  font-weight: bold;
  text-align: center;
  margin: 12px 0 13px 0;
  color: #232323;
}
.addslots-row {
  display: flex; gap: 20px; margin-bottom: 14px;
}
.addslots-col {
  flex: 1 1 180px; min-width: 150px;
}
.addslots-picker-row {
  display: flex; gap: 11px; margin-top: 6px;
}
.addslots-date-btn, .addslots-time-btn {
  background: #fff; border: 2px solid #dadada; border-radius: 21px;
  padding: 11px 0; font-size: 1.07rem; font-weight: 500; width: 100%;
  cursor: pointer; transition: border .13s;
}
.addslots-date-btn.selected, .addslots-time-btn.selected {
  border: 2px solid #fe2e0c; color: #fe2e0c; background: #fff4f1;
}
.addslots-tasks-label {
  margin: 16px 0 8px 2px;
  color: #232323;
  font-size: 1rem;
  font-weight: 500;
}
#addslotsTasksList { margin-bottom: 18px; }
.addslots-task-chip {
  display: flex; align-items: center; justify-content: space-between;
  background: #fafbfc;
  border: 2px solid #dadada;
  border-radius: 12px;
  font-size: 1.07rem;
  color: #959595;
  padding: 15px 19px;
  margin-bottom: 8px;
  transition: background .13s;
  cursor: default;
}
.addslots-task-remove {
  color: #222;
  font-size: 1.27rem;
  cursor: pointer;
  margin-left: 16px;
  transition: color .18s;
}
.addslots-task-remove:hover { color: #fe2e0c; }
.addslots-submit-btn {
  width: 100%; background: #fe2e0c; color: #fff; border: none;
  font-weight: bold; font-size: 1.10rem; border-radius: 9px; padding: 15px 0;
  margin-top: 22px; cursor: pointer; letter-spacing: .5px;
  box-shadow: 0 3px 13px 0 rgba(254,46,12,.07);
}
@media (max-width: 600px) {
  .addslots-row { flex-direction: column; gap: 7px; }
  .addslots-col { min-width: 0; }
}

</style>

<div class="calendar_admin_details_create_cohort_content tab-content" id="addExtraSlotsTabContent" style="display:none;">
  <form id="addExtraSlotsForm">
    <label class="addslots-label" style="margin-top:5px;">Teacher</label>
    <div class="addslots-teacher-dropdown">
      <div class="addslots-teacher-selected">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="addslots-teacher-avatar">
        <span>Daniella</span>
      </div>
    </div>
    <h3 class="addslots-heading">Add Extra slots for Booking</h3>
    <div class="addslots-row">
      <div class="addslots-col">
        <label class="addslots-label">From</label>
        <div class="addslots-picker-row">
          <button type="button" class="addslots-date-btn" id="addSlotsFromDateBtn">Select Date</button>
          <button type="button" class="addslots-time-btn" id="addSlotsFromTimeBtn">Select Time</button>
        </div>
      </div>
      <div class="addslots-col">
        <label class="addslots-label">Untill</label>
        <div class="addslots-picker-row">
          <button type="button" class="addslots-date-btn" id="addSlotsUntilDateBtn">Select Date</button>
          <button type="button" class="addslots-time-btn" id="addSlotsUntilTimeBtn">Select Time</button>
        </div>
      </div>
    </div>
    <div class="addslots-tasks-label">You have previously added these tasks</div>
    <div id="addslotsTasksList">
      <!-- Sample tasks; in real code, generate from data -->
      <div class="addslots-task-chip">
        Thu , Sep26, 14:30–15:00
        <span class="addslots-task-remove" title="Remove">&#10005;</span>
      </div>
      <div class="addslots-task-chip">
        Fri , Sep27, 16:30–17:00
        <span class="addslots-task-remove" title="Remove">&#10005;</span>
      </div>
    </div>
    <button type="submit" class="addslots-submit-btn">Add</button>
  </form>
</div>


<script>
    // --- Your existing code with upgrades ---

// Store the selected date/time for both From and Until
let addSlotsFrom = { date: null, time: null };
let addSlotsUntil = { date: null, time: null };
let addSlotsDateTargetBtn = null;

// Date pickers for "Add Extra Slots"
$('#addSlotsFromDateBtn, #addSlotsUntilDateBtn').click(function(e){
  e.preventDefault();
  addSlotsDateTargetBtn = $(this);
  let now = new Date();
  mergeCalendarMonth = {year: now.getFullYear(), month: now.getMonth()};
  mergeSelectedCalendarDate = null;
  $('#mergeCalendarModalBackdrop').fadeIn(100);
  mergeRenderCalendarModal();
});

// On calendar Done (reuse logic): set date text and .selected on btn and store value
$('.merge-calendar-done-btn').off('click').on('click', function() {
  if (!mergeSelectedCalendarDate || !addSlotsDateTargetBtn) return;
  var d = new Date(mergeSelectedCalendarDate);
  var weekdays = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  var label = weekdays[d.getDay()] + ", " + months[d.getMonth()] + d.getDate();

  addSlotsDateTargetBtn.text(label).addClass('selected').data('date', mergeSelectedCalendarDate);

  // Store which date is being set
  if (addSlotsDateTargetBtn.attr('id') === 'addSlotsFromDateBtn') {
    addSlotsFrom.date = label;
  }
  if (addSlotsDateTargetBtn.attr('id') === 'addSlotsUntilDateBtn') {
    addSlotsUntil.date = label;
  }
  $('#mergeCalendarModalBackdrop').fadeOut(120);
  mergeSelectedCalendarDate = null;
});

// Time picker for Add Extra Slots
$('#addSlotsFromTimeBtn, #addSlotsUntilTimeBtn').click(function(e){
  e.preventDefault();
  let $btn = $(this);
  let times = [];
  let start = 10; // 5:00 AM
  let end = 47;   // 11:30 PM
  for (let i = start; i <= end; i++) {
    let hour = Math.floor(i/2);
    let min = i%2 === 0 ? "00" : "30";
    let hour12 = ((hour+11)%12+1);
    let ampm = hour < 12 ? "AM" : "PM";
    let str = hour12.toString().padStart(2, "0") + ":" + min + " " + ampm;
    times.push(str);
  }
  let html = "";
  for (let t of times) html += `<li>${t}</li>`;
  $('#timeModal ul').html(html);

  // Position time modal near btn
  let offset = $btn.offset();
  let left = offset.left + $btn.outerWidth()/2 - 105; // Centered
  let top = offset.top + $btn.outerHeight() + 2;
  if ($(window).width() < 500) {
    left = "50%"; top = $(window).scrollTop() + $(window).height() * 0.22;
    $('#timeModal').css({ left: left, top: top, transform: "translate(-50%,0)" });
  } else {
    $('#timeModal').css({ left: left, top: top, transform: "none" });
  }
  $('#timeModalBackdrop').show().data('targetBtn', $btn);
});

// When time selected, update and store value
$('#timeModal').off("click", "li").on("click", "li", function(){
  let $btn = $('#timeModalBackdrop').data('targetBtn');
  $btn.text($(this).text()).addClass('selected');
  if ($btn.attr('id') === 'addSlotsFromTimeBtn') {
    addSlotsFrom.time = $(this).text();
  }
  if ($btn.attr('id') === 'addSlotsUntilTimeBtn') {
    addSlotsUntil.time = $(this).text();
  }
  $('#timeModalBackdrop').hide();
});

// Remove slot/task chip
$(document).on('click', '.addslots-task-remove', function(){
  $(this).closest('.addslots-task-chip').fadeOut(180, function(){ $(this).remove(); });
});

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

// --- New Feature: Add slot chip on submit ---
$('#addExtraSlotsForm').off('submit').on('submit', function(e){
  e.preventDefault();
  // Check all fields
  if (!addSlotsFrom.date || !addSlotsFrom.time || !addSlotsUntil.date || !addSlotsUntil.time) {
    alert('Please select both From and Until dates and times.');
    return;
  }
  // Format string as: Thu, Jun 27, 10:30 AM–11:00 AM
  let slotStr = `${addSlotsFrom.date}, ${addSlotsFrom.time}–${addSlotsUntil.time}`;
  let $chip = $(`
    <div class="addslots-task-chip">
      ${slotStr}
      <span class="addslots-task-remove" title="Remove">&#10005;</span>
    </div>
  `);
  $('#addslotsTasksList').append($chip);

  // Optional: reset selection after add
  // addSlotsFrom = { date: null, time: null };
  // addSlotsUntil = { date: null, time: null };
  // $('#addSlotsFromDateBtn, #addSlotsUntilDateBtn').text('Select Date').removeClass('selected');
  // $('#addSlotsFromTimeBtn, #addSlotsUntilTimeBtn').text('Select Time').removeClass('selected');
});

</script>