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
      <!-- Calendar flex row (time labels + grid) -->
      <div class="calendar_admin_calendar_flexrow" id="calendar_admin_calendar_flexrow">
        <!-- Time labels, outside the grid -->
        <div class="calendar_admin_time_labels_col" id="calendar_admin_time_labels_col"></div>
        <!-- Calendar Table -->
        <div class="calendar_admin_calendar_table_wrapper" id="calendar_admin_calendar_table_wrapper">
          <table class="calendar_admin_calendar_table" id="calendar_admin_calendar_table">
            <thead>
              <tr id="calendar_admin_calendar_head">
                <!-- <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
                <th>Sun</th> -->
              </tr>
            </thead>
            <tbody id="calendar_admin_calendar_body">
              <!-- Calendar slots will be injected here by JS -->
            </tbody>
          </table>
          <!-- Red timeline bar injected here -->
 
          <div id="calendar_admin_red_bar" class="calendar_admin_red_bar" style="display:none;">
            <!-- LEFT ARROW SVG -->
            <svg class="calendar_admin_red_arrow" width="20" height="13" viewBox="0 0 25 16"><polygon fill="#ff3d1f" points="0,7 10,0 10,5 20,5 20,9 10,9 10,14"/></svg>
            <span style="flex:1"></span>
            <!-- RIGHT ARROW SVG -->
            <svg class="calendar_admin_red_arrow" width="20" height="14" viewBox="0 0 25 16"><polygon fill="#ff3d1f" points="20,7 10,0 10,5 0,5 0,9 10,9 10,14"/></svg>
          </div>

        </div>
      </div>

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

