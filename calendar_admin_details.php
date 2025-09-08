  <style>
  /* Trigger layout */
  .profile-dropdown.profile-dropdown-trigger {
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
  }

  /* Hide/overlay the menu */
  #profile-dropdown.profile-menu {
    position: absolute;
    top: 100%;
    left: 0;
    display: none;
    z-index: 1000;
    background: #fff;
    border: 1px solid #e3e3e3;
    border-radius: 10px;
    min-width: 240px;
    max-height: 320px;
    overflow-y: auto;
    box-shadow: 0 12px 28px rgba(0,0,0,.12);
  }
  #profile-dropdown.profile-menu.open { display: block; }

  /* Prevent any CSS from injecting text near the arrow */
  .profile-dropdown-trigger .dropdown-arrow::before,
  .profile-dropdown-trigger .dropdown-arrow::after { content: none !important; }
</style>
  
  
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="css/calendar_admin_details.css">
    <link rel="stylesheet" href="css/calendar_admin_details_calendar_content.css">
  <link rel="stylesheet" href="css/calendar_admin_details_create_cohort_tab_details.css">
  <link rel="stylesheet" href="css/calendar_admin_details_create_cohort_class_tab.css">
  <link rel="stylesheet" href="css/calendar_admin_details_create_cohort_merge_tab.css">
  <link rel="stylesheet" href="css/calendar_admin_details_create_cohort_add_time_tab.css">
  <link rel="stylesheet" href="css/calendar_admin_details_create_cohort.css">

<div class="calendar_admin_main_wrapper">
  
    <!-- Sidebar -->
    <aside class="calendar_admin_sidebar">
      <button class="calendar_admin_btn calendar_admin_btn_active calendar_admin_details_create_cohort_open">Create Cohort</button>
      <button class="calendar_admin_btn" id="calendar_admin_details_manage_cohort">Manage Cohort</button>
      <button class="calendar_admin_btn" id="calendar_admin_details_merge">Merge Cohort</button>
      <button class="calendar_admin_btn calendar_admin_details_1_1_class">1:1 Class</button>
      <button class="calendar_admin_btn calendar_admin_details_conference">Conference</button>
      <button class="calendar_admin_btn" id="calendar_admin_details_peer_talk">Peer talk</button>
      <button class="calendar_admin_btn" id="calendar_admin_details_add_time_off">Add time off</button>
      <button class="calendar_admin_btn" id="calendar_admin_details_add_extra_slots">Add Extra Slots</button>
      <a href="calendar_admin_details_setup_availablity.php"><button class="calendar_admin_btn">Setup Availability</button></a>
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
      <!-- <div class="cohort-select dropdown" id="cohort-select">
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
      </div> -->


      <?php
require_once(__DIR__ . '/../../config.php');
require_login();

global $DB;

// Fetch cohorts you want to expose (enabled/visible, with a shortname)
$cohorts = $DB->get_records_select(
    'cohort',
    'enabled = 1 AND visible = 1 AND shortname IS NOT NULL AND shortname <> :empty',
    ['empty' => ''],
    'shortname ASC',
    'id, shortname'
);
?>
<div class="cohort-select dropdown" id="cohort-select">
  <span class="cohort-icon">&#9776;</span>
  Cohorts
  <span class="dropdown-arrow"><i class="fa fa-chevron-down" style="font-size:14px;"></i></span>

  <div class="dropdown-menu" id="cohort-dropdown">
    <form class="cohort-dropdown-list" id="cohortDropdownList">
      <label><input type="checkbox" id="select-all-cohorts"> Select All</label>

      <?php if (!empty($cohorts)): ?>
        <?php foreach ($cohorts as $c): ?>
          <label for="cohort_<?php echo (int)$c->id; ?>">
            <input
              type="checkbox"
              name="cohort[]"
              id="cohort_<?php echo (int)$c->id; ?>"
              value="<?php echo s($c->shortname); ?>">
            <?php echo format_string($c->shortname); ?>
          </label>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="muted">No cohorts found</div>
      <?php endif; ?>
    </form>
  </div>
</div>

<script>
(function(){
  const trigger   = document.getElementById('cohort-select');
  const menu      = document.getElementById('cohort-dropdown');
  const selectAll = document.getElementById('select-all-cohorts');
  const list      = document.getElementById('cohortDropdownList');

  // Toggle open/close (don’t close when clicking inside the menu)
  trigger.addEventListener('click', function(e){
    if (!e.target.closest('#cohort-dropdown')) {
      menu.classList.toggle('open');
    }
  });

  // Close when clicking outside
  document.addEventListener('click', function(e){
    if (!trigger.contains(e.target)) menu.classList.remove('open');
  });

  // Select All behavior + tri-state
  function updateSelectAllState(){
    const boxes = [...menu.querySelectorAll('input[name="cohort[]"]')];
    if (!boxes.length) { selectAll.checked = false; selectAll.indeterminate = false; return; }
    const allChecked = boxes.every(b => b.checked);
    const noneChecked = boxes.every(b => !b.checked);
    selectAll.checked = allChecked;
    selectAll.indeterminate = !allChecked && !noneChecked;
  }

  selectAll?.addEventListener('change', function(){
    const boxes = menu.querySelectorAll('input[name="cohort[]"]');
    boxes.forEach(b => b.checked = selectAll.checked);
    updateSelectAllState();
  });

  list.addEventListener('change', function(e){
    if (e.target && e.target.name === 'cohort[]') updateSelectAllState();
  });

  // Initialize tri-state on load
  updateSelectAllState();
})();
</script>





      <!-- Profile Dropdown -->
      <!-- <div class="profile-dropdown profile-dropdown-trigger" id="profile-dropdown-trigger">
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
      </div> -->


      <?php
require_once(__DIR__ . '/../../config.php');
require_login();

global $DB, $PAGE, $OUTPUT;

// 1) Collect unique teacher user IDs from your customized cohort table.
$userids = $DB->get_fieldset_sql("
    SELECT DISTINCT uid
      FROM (
            SELECT cohortmainteacher AS uid FROM {cohort}
             WHERE cohortmainteacher IS NOT NULL AND cohortmainteacher > 0
            UNION
            SELECT cohortguideteacher AS uid FROM {cohort}
             WHERE cohortguideteacher IS NOT NULL AND cohortguideteacher > 0
      ) t
");

// 2) Fetch teacher users (filter deleted/suspended).
$teachers = [];
if ($userids) {
    list($insql, $params) = $DB->get_in_or_equal($userids, SQL_PARAMS_NAMED);
    $fields = "id, firstname, lastname, picture, imagealt, firstnamephonetic, lastnamephonetic, middlename, alternatename";
    $teachers = $DB->get_records_select('user', "id $insql AND deleted = 0 AND suspended = 0", $params, 'firstname ASC, lastname ASC', $fields);
}

// 3) Prepare default (first teacher if available).
$defaultName = 'Select teacher';
$defaultPic  = $OUTPUT->image_url('i/user')->out(false); // generic user icon
$defaultId   = '';
if ($teachers) {
    $first = reset($teachers);
    $pic = new user_picture($first);
    $pic->size = 50;
    $defaultPic = $pic->get_url($PAGE)->out(false);
    $defaultName = fullname($first, true);
    $defaultId = (int)$first->id;
}

// 4) Build options HTML.
$profile_options_html = '';
if ($teachers) {
    foreach ($teachers as $t) {
        $pic = new user_picture($t);
        $pic->size = 50;
        $url  = $pic->get_url($PAGE)->out(false);
        $name = fullname($t, true);

        $profile_options_html .= '<div class="profile-option" data-userid="'.(int)$t->id
            .'" data-name="'.s($name).'" data-pic="'.s($url).'">'
            .'<div class="profile-option-header"><img src="'.s($url).'" alt="'.s($name).'"> '
            .format_string($name).'</div></div>';
    }
} else {
    $profile_options_html = '<div class="profile-option"><div class="profile-option-header">No teachers found</div></div>';
}
?>

<!-- Profile Dropdown -->
<div class="profile-dropdown profile-dropdown-trigger" id="profile-dropdown-trigger">
  <img src="<?php echo s($defaultPic); ?>" class="profile-pic" alt="profile">
  <span class="profile-name"><?php echo format_string($defaultName); ?></span>
  <span class="dropdown-arrow"><i class="fa fa-chevron-down" style="font-size:14px;"></i></span>

  <input type="hidden" name="selectedteacherid" id="selectedTeacherId" value="<?php echo s($defaultId); ?>">

  <div class="dropdown-menu profile-menu" id="profile-dropdown">
    <div class="profile-dropdown-list">
      <?php echo $profile_options_html; ?>
    </div>
  </div>
</div>

<script>
(function(){
  const trigger = document.getElementById('profile-dropdown-trigger');
  const menu    = document.getElementById('profile-dropdown');
  const picEl   = trigger.querySelector('.profile-pic');
  const nameEl  = trigger.querySelector('.profile-name');
  const hidden  = document.getElementById('selectedTeacherId');

  // Toggle open/close
  trigger.addEventListener('click', function(e){
    // If clicking inside menu, selection handler will manage closing.
    if (!e.target.closest('.profile-menu')) {
      menu.classList.toggle('open'); // Ensure your CSS shows .profile-menu.open
    }
  });

  // Close when clicking outside
  document.addEventListener('click', function(e){
    if (!trigger.contains(e.target)) menu.classList.remove('open');
  });

  // Select teacher
  menu.addEventListener('click', function(e){
    debugger
    const opt = e.target.closest('.profile-option');
    if (!opt) return;
    picEl.src       = opt.dataset.pic;
    nameEl.textContent = opt.dataset.name;
    hidden.value    = opt.dataset.userid;
    menu.classList.remove('open');
  });
})();
</script>


       <?php require_once('calendar_admin_details_tabs.php'); ?>
        </div>
      </div>





<!--============Calendar Content start======================-->
<style>
  /* Force selected empty slots to be white */
#grid .day .day-inner .slots > div.slot-white{
  background:#fff !important;
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
<!--============Calendar Content end======================-->

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
<script src="js/calendar_admin_details_calendar_content.js"></script>
<?php require_once('calendar_admin_details_create_cohort.php'); ?>
<script src="js/calendar_admin_details_create_cohort_tab_details.js"></script>
<script src="js/calendar_admin_details_create_cohort_class_tab.js"></script>
<script src="js/calendar_admin_details_create_cohort_merge_tab.js"></script>
<script src="js/calendar_admin_details_create_cohort_add_time_tab.js"></script>

<script src="js/calendar_admin_details_create_cohort.js"></script>
<?php require_once('calendar_admin_details_time_off.php'); ?>
<?php require_once('calendar_admin_details_lesson_information.php'); ?>  

