<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Session Modals</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <style>
    body {
      background: #f5f6fa;
      font-family: 'Inter', Arial, sans-serif;
      margin: 0;
      min-height: 100vh;
    }
    .modal-backdrop {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(30,40,60,0.14);
      z-index: 1000;
    }
    .custom-modal {
      display: none;
      position: fixed;
      z-index: 1001;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: #fff;
      border-radius: 18px;
      max-width: 600px;
      width: 94vw;
      box-shadow: 0 6px 32px rgba(40,30,60,0.18);
      padding: 0;
      overflow: hidden;
      animation: fadeIn .16s;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translate(-50%,-46%);}
      to   { opacity: 1; transform: translate(-50%,-50%);}
    }
    /* MODAL 1 */
    .modal-header {
      background: #FDE8E6;
      padding: 30px 24px 18px 24px;
      text-align: left;
    }
    .modal-header h2 {
      font-size: 1.46rem;
      font-weight: 700;
      margin: 0;
      line-height: 1.26;
      color: #232323;
    }
    .modal-body {
      background: #fff;
      padding: 24px 24px 20px 24px;
      text-align: left;
    }
    .modal-body p {
      margin: 0;
      font-size: 1.08rem;
      color: #424242;
      line-height: 1.44;
    }
    .modal-actions {
      display: flex;
      gap: 22px;
      justify-content: flex-start;
      padding: 0 24px 28px 24px;
      margin-top: 20px;
    }
    .modal-btn {
      flex: 1 1 0;
      min-width: 120px;
      height: 56px;
      font-size: 1.13rem;
      font-weight: 700;
      border-radius: 12px;
      border: 2px solid #232323;
      outline: none;
      cursor: pointer;
      transition: background 0.15s, color 0.15s, border 0.15s;
      box-shadow: 0 2px 7px rgba(45,45,45,0.04);
    }
    .modal-btn.yes {
      background: #FF3B18;
      color: #fff;
      border: 2px solid #FF3B18;
      margin-right: 2px;
    }
    .modal-btn.yes:hover, .modal-btn.yes:focus {
      background: #e7320e;
      border-color: #e7320e;
    }
    .modal-btn.no {
      background: #fff;
      color: #232323;
      border: 2px solid #232323;
    }
    .modal-btn.no:hover, .modal-btn.no:focus {
      background: #f5f6fa;
    }

  </style>
</head>
<body>

<!-- Modal Overlay -->
<div class="modal-backdrop"></div>

<!-- MODAL 1 -->
<div class="custom-modal" id="sessionModal">
  <div class="modal-header">
    <h2>Did you teach your<br>session with FL1 on<br>November 11?</h2>
  </div>
  <div class="modal-body">
    <p>
      Please confirm whether you conducted your scheduled session with FL1 on November 11. Your response helps ensure accurate attendance and lesson tracking.
    </p>
  </div>
  <div class="modal-actions">
    <button class="modal-btn yes">Yes</button>
    <button class="modal-btn no">No</button>
  </div>
</div>
 <?php require_once('schedule_session_part2.php');?>

<script>
  $(document).ready(function() {
    // Show first modal on page load
    $('.modal-backdrop, #sessionModal').fadeIn(170);

    // YES button shows Modal 2
    $('.modal-btn.yes').click(function() {
      $('#sessionModal').fadeOut(130, function() {
        $('#topicModal').fadeIn(170);
      });
    });
    
    // NO button closes all
    $('.modal-btn.no').click(function() {
      $('.modal-backdrop, #sessionModal, #topicModal').fadeOut(130);
    });

    // Backdrop closes any open modal
    $('.modal-backdrop').click(function() {
      $('.custom-modal:visible').fadeOut(130);
      $(this).fadeOut(130);
    });

    // Toggle note area in Modal 2
    $('.note-link').click(function() {
      $(this).toggleClass('open');
      $('.note-area').slideToggle(130);
    });

    // Prevent form submit and close modal
    $('#topicModal form').submit(function(e){
      e.preventDefault();
      alert("Submitted!");
      $('.modal-backdrop, #topicModal').fadeOut(130);
    });
  });


  










// Helper functions to portal dropdown list to body and back
function openDropdownToBody(wrapperSelector, listSelector) {
  var $wrapper = $(wrapperSelector);
  var $list = $(listSelector);

  // Find position and size
  var offset = $wrapper.offset();
  var width = $wrapper.outerWidth();
  var height = $wrapper.outerHeight();

  // Move the list to body
  $list.appendTo('body').css({
    display: 'block',
    position: 'absolute',
    top: offset.top + height + 4,
    left: offset.left,
    width: width,
    zIndex: 99999
  });
  $wrapper.addClass('custom-dropdown-open');

  // Outside click closes dropdown
  $(document).on('mousedown.dropdown', function(e) {
    if (!$(e.target).closest(listSelector + ', ' + wrapperSelector).length) {
      closeDropdownToBody(wrapperSelector, listSelector);
    }
  });
}

function closeDropdownToBody(wrapperSelector, listSelector) {
  var $wrapper = $(wrapperSelector);
  var $list = $(listSelector);

  $wrapper.removeClass('custom-dropdown-open');
  $list.css({
    display: 'none',
    position: '',
    top: '',
    left: '',
    width: '',
    zIndex: ''
  });
  $list.appendTo($wrapper); // Move back into original wrapper
  $(document).off('mousedown.dropdown');
}

// Topic dropdown open/close
$('#topicDropdownSelected').on('click', function(e) {
  if ($('#topicDropdownWrapper').hasClass('custom-dropdown-open')) {
    closeDropdownToBody('#topicDropdownWrapper', '#topicDropdownList');
  } else {
    openDropdownToBody('#topicDropdownWrapper', '#topicDropdownList');
  }
  e.stopPropagation();
});

// Topic item select
$('#topicDropdownList').on('click', '.dropdown-item', function() {
  $('#topicDropdownText').text($(this).text());
  closeDropdownToBody('#topicDropdownWrapper', '#topicDropdownList');
});
// Topic create
$('#createTopicBtn').on('click', function() {
  var val = $('#newTopicInput').val().trim();
  if(val) {
    $('#topicDropdownText').text(val);
    $('#newTopicInput').val('');
    closeDropdownToBody('#topicDropdownWrapper', '#topicDropdownList');
  }
});

// Assignment dropdown open/close
$('#assignmentDropdownSelected').on('click', function(e) {
  if ($('#assignmentDropdownWrapper').hasClass('custom-dropdown-open')) {
    closeDropdownToBody('#assignmentDropdownWrapper', '#assignmentDropdownList');
  } else {
    openDropdownToBody('#assignmentDropdownWrapper', '#assignmentDropdownList');
  }
  e.stopPropagation();
});
// Assignment item select
$('#assignmentDropdownList').on('click', '.dropdown-item', function() {
  $('#assignmentDropdownText').text($(this).text());
  closeDropdownToBody('#assignmentDropdownWrapper', '#assignmentDropdownList');
});







// Accordion logic for Topic dropdown
$('#topicDropdownList').on('click', '.accordion-toggle', function() {
  var acc = $(this).data('acc');
  $('#topicDropdownList .dropdown-group-label').not(this).parent().removeClass('open');
  $('#topicDropdownList .dropdown-items').not('[data-acc="'+acc+'"]').slideUp(120);
  var $group = $(this).parent();
  var $items = $group.find('.dropdown-items');
  if ($group.hasClass('open')) {
    $group.removeClass('open');
    $items.slideUp(120);
  } else {
    $group.addClass('open');
    $items.slideDown(140);
  }
});

// Accordion logic for Assignment dropdown
$('#assignmentDropdownList').on('click', '.accordion-toggle', function() {
  var acc = $(this).data('acc');
  $('#assignmentDropdownList .dropdown-group-label').not(this).parent().removeClass('open');
  $('#assignmentDropdownList .dropdown-items').not('[data-acc="'+acc+'"]').slideUp(120);
  var $group = $(this).parent();
  var $items = $group.find('.dropdown-items');
  if ($group.hasClass('open')) {
    $group.removeClass('open');
    $items.slideUp(120);
  } else {
    $group.addClass('open');
    $items.slideDown(140);
  }
});















// Show selected assignment as a chip below dropdown
$('#assignmentDropdownList').on('click', '.dropdown-item', function() {
  var label = $(this).closest('.dropdown-group').find('.dropdown-group-label span').text();
  var assignment = $(this).text();

  // Example: You can update this detail with real data if needed
  var detail = "Thu,Sep26, 14:30–15:30";

  $('#selectedAssignmentLabel').text(label + " " + assignment + ":");
  $('#selectedAssignmentDetail').text(detail);
  $('#selectedAssignmentChip').show();

  // Optionally, also update the dropdown display (keep your original code)
  $('#assignmentDropdownText').text(assignment);
  closeDropdownToBody('#assignmentDropdownWrapper', '#assignmentDropdownList');
});

// Remove chip on close
$('#removeAssignmentChip').on('click', function() {
  $('#selectedAssignmentChip').hide();
  $('#assignmentDropdownText').text('Assignment');
});












// ----- Calendar Modal -----
const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
let calendarSelected = { year: 2024, month: 8, day: 6 }; // default is Sep 6, 2024

function renderCalendar(year, month, day) {
  $('#calendarMonth').empty();
  $('#calendarYear').empty();

  // Populate months/years
  for(let m=0; m<12; m++) {
    $('#calendarMonth').append(`<option value="${m}" ${m===month ? 'selected' : ''}>${monthNames[m]}</option>`);
  }
  const thisYear = new Date().getFullYear();
  for(let y=thisYear-1; y<=thisYear+4; y++) {
    $('#calendarYear').append(`<option value="${y}" ${y===year ? 'selected' : ''}>${y}</option>`);
  }

  // Dates grid
  let firstDay = new Date(year, month, 1);
  let startDay = (firstDay.getDay() + 6) % 7; // Monday=0
  let daysInMonth = new Date(year, month+1, 0).getDate();

  let daysPrevMonth = new Date(year, month, 0).getDate();

  let grid = [];
  // Prev month's trailing days
  for(let i=0; i<startDay; i++) {
    grid.push({d: daysPrevMonth-startDay+1+i, disabled:true});
  }
  // This month's days
  for(let d=1; d<=daysInMonth; d++) {
    grid.push({d, selected: (d === day), disabled: false});
  }
  // Next month's leading days
  while(grid.length%7!==0) {
    grid.push({d: grid.length%7, disabled:true});
  }

  // Render dates
  let html = '';
  grid.forEach(obj=>{
    html += `<button class="calendar-modal-date${obj.selected?' selected':''}${obj.disabled?' disabled':''}" type="button" ${obj.disabled?'disabled':''}>${obj.d}</button>`;
  });
  $('#calendarModalDates').html(html);
}

function openCalendarModal() {
  $('.calendar-modal-backdrop').show();
  $('#calendarModal').show();
  renderCalendar(calendarSelected.year, calendarSelected.month, calendarSelected.day);
}
function closeCalendarModal() {
  $('.calendar-modal-backdrop').hide();
  $('#calendarModal').hide();
}

$(document).on('click', '.calendar-open-btn, #assignmentDateInput', function() {
  openCalendarModal();
});

$('#calendarModalClose, .calendar-modal-backdrop').on('click', function() {
  closeCalendarModal();
});

// When user selects month/year
$('#calendarMonth, #calendarYear').on('change', function() {
  let y = parseInt($('#calendarYear').val());
  let m = parseInt($('#calendarMonth').val());
  calendarSelected.year = y; calendarSelected.month = m;
  renderCalendar(y, m, calendarSelected.day);
});

// Select a date
$('#calendarModalDates').on('click', '.calendar-modal-date:not(.disabled)', function() {
  $('#calendarModalDates .calendar-modal-date').removeClass('selected');
  $(this).addClass('selected');
  calendarSelected.day = parseInt($(this).text());
});

// Confirm date
$('#calendarModalConfirm').on('click', function() {
  // Format: e.g., Thu,Sep26, 14:30–15:30
  let dt = new Date(calendarSelected.year, calendarSelected.month, calendarSelected.day);
  let label = dt.toLocaleDateString('en-US', {weekday:'short', month:'short', day:'numeric', year:undefined});
  let formatted = label.replace(',', '') + ", 14:30–15:30";
  $('#assignmentDateInput').val(label.replace(',', ''));
  $('#selectedAssignmentDetail').text(formatted);
  closeCalendarModal();
});

</script>

</body>
</html>
