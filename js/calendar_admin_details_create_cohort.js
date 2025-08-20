
$('.cohort-tooltip-target').on('mouseenter focus', function() {
  var tid = $(this).attr('id') === 'cohortInput' ? '#tooltip-cohort' : '#tooltip-cohortshort';
  $(tid).fadeIn(100);
});
$('.cohort-tooltip-target').on('mouseleave blur', function() {
  var tid = $(this).attr('id') === 'cohortInput' ? '#tooltip-cohort' : '#tooltip-cohortshort';
  $(tid).fadeOut(100);
});


//============Time dropdowns=============//
const times = [
  "05:30 PM","06:00 PM","06:30 PM","07:00 PM","07:30 PM",
  "08:00 PM","08:30 PM","09:00 PM","09:30 PM","10:00 PM",
  "10:30 PM","11:00 PM","11:30 PM","12:00 PM","12:30 PM","13:00 PM"
];

// Render dropdown for a pill with a given filter
function renderDropdown($dropdown, filterVal='') {
  $dropdown.empty();
  let filter = (filterVal && filterVal.trim().length > 0) ? filterVal.trim().toLowerCase() : "";
  let filtered = filter ? times.filter(t =>
    t.toLowerCase().includes(filter)
  ) : times.slice(); // if filter empty, show all
  if(filtered.length === 0){
    $dropdown.append('<div class="no-matches">No matches</div>');
    return;
  }
  filtered.forEach(t => {
    $dropdown.append('<div class="dropdown-item">'+t+'</div>');
  });
}

// Show dropdown and enable editing
$(document).on('click focus', '.custom-time-pill .time-input', function(e){
  let $pill = $(this).closest('.custom-time-pill');
  $('.custom-time-pill').not($pill).removeClass('active').find('.custom-time-dropdown').hide();
  $pill.addClass('active');
  $(this).removeAttr('readonly');
  let $dropdown = $pill.find('.custom-time-dropdown');
  renderDropdown($dropdown, ''); // <-- Show all times by default
  $dropdown.show();
  // Place cursor at end
  let val = $(this).val(); this.value = ''; this.value = val;
  e.stopPropagation();
});

// Filter dropdown on input
$(document).on('input', '.custom-time-pill .time-input', function() {
  let $pill = $(this).closest('.custom-time-pill');
  let $dropdown = $pill.find('.custom-time-dropdown');
  renderDropdown($dropdown, $(this).val());
  $dropdown.show();
});

// Dropdown click: select time
$(document).on('mousedown', '.custom-time-dropdown .dropdown-item', function(e){
  let val = $(this).text();
  let $pill = $(this).closest('.custom-time-pill');
  $pill.find('.time-input').val(val);
  $pill.removeClass('active');
  $pill.find('.custom-time-dropdown').hide();
});

// Hide all dropdowns on outside click
$(document).on('mousedown', function(e){
  if (!$(e.target).closest('.custom-time-pill').length) {
    $('.custom-time-pill').removeClass('active');
    $('.custom-time-dropdown').hide();
    $('.time-input').attr('readonly', true);
  }
});

// Hide dropdown on blur (unless dropdown is active)
$(document).on('blur', '.custom-time-pill .time-input', function(){
  setTimeout(() => {
    if (!$(document.activeElement).closest('.custom-time-dropdown').length) {
      $('.custom-time-pill').removeClass('active');
      $('.custom-time-dropdown').hide();
      $('.time-input').attr('readonly', true);
    }
  }, 120);
});


//==================Time dropdowns for right side of the modal===============================//
const rightTimes = [
  "05:30 PM","06:00 PM","06:30 PM","07:00 PM","07:30 PM",
  "08:00 PM","08:30 PM","09:00 PM","09:30 PM","10:00 PM",
  "10:30 PM","11:00 PM","11:30 PM","12:00 PM","12:30 PM","13:00 PM"
];

// Render dropdown for a pill with a given filter
function renderRightDropdown($dropdown, filterVal='') {
  $dropdown.empty();
  let filter = (filterVal && filterVal.trim().length > 0) ? filterVal.trim().toLowerCase() : "";
  let filtered = filter ? rightTimes.filter(t =>
    t.toLowerCase().includes(filter)
  ) : rightTimes.slice();
  if(filtered.length === 0){
    $dropdown.append('<div class="no-matches">No matches</div>');
    return;
  }
  filtered.forEach(t => {
    $dropdown.append('<div class="dropdown-item">'+t+'</div>');
  });
}

// Show dropdown and enable editing
$(document).on('click focus', '.calendar_admin_details_time_right_time-pill .calendar_admin_details_time_right_time-input', function(e){
  let $pill = $(this).closest('.calendar_admin_details_time_right_time-pill');
  $('.calendar_admin_details_time_right_time-pill').not($pill).removeClass('active').find('.calendar_admin_details_time_right_time-dropdown').hide();
  $pill.addClass('active');
  $(this).removeAttr('readonly');
  let $dropdown = $pill.find('.calendar_admin_details_time_right_time-dropdown');
  renderRightDropdown($dropdown, '');
  $dropdown.show();
  let val = $(this).val(); this.value = ''; this.value = val;
  e.stopPropagation();
});

// Filter dropdown on input
$(document).on('input', '.calendar_admin_details_time_right_time-pill .calendar_admin_details_time_right_time-input', function() {
  let $pill = $(this).closest('.calendar_admin_details_time_right_time-pill');
  let $dropdown = $pill.find('.calendar_admin_details_time_right_time-dropdown');
  renderRightDropdown($dropdown, $(this).val());
  $dropdown.show();
});

// Dropdown click: select time
$(document).on('mousedown', '.calendar_admin_details_time_right_time-dropdown .dropdown-item', function(e){
  let val = $(this).text();
  let $pill = $(this).closest('.calendar_admin_details_time_right_time-pill');
  $pill.find('.calendar_admin_details_time_right_time-input').val(val);
  $pill.removeClass('active');
  $pill.find('.calendar_admin_details_time_right_time-dropdown').hide();
});

// Hide all dropdowns on outside click
$(document).on('mousedown', function(e){
  if (!$(e.target).closest('.calendar_admin_details_time_right_time-pill').length) {
    $('.calendar_admin_details_time_right_time-pill').removeClass('active');
    $('.calendar_admin_details_time_right_time-dropdown').hide();
    $('.calendar_admin_details_time_right_time-input').attr('readonly', true);
  }
});

// Hide dropdown on blur (unless dropdown is active)
$(document).on('blur', '.calendar_admin_details_time_right_time-pill .calendar_admin_details_time_right_time-input', function(){
  setTimeout(() => {
    if (!$(document.activeElement).closest('.calendar_admin_details_time_right_time-dropdown').length) {
      $('.calendar_admin_details_time_right_time-pill').removeClass('active');
      $('.calendar_admin_details_time_right_time-dropdown').hide();
      $('.calendar_admin_details_time_right_time-input').attr('readonly', true);
    }
  }, 120);
});
