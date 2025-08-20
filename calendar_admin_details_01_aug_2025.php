
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="css/calendar_admin_details.css">
  <link rel="stylesheet" href="css/calendar_admin_details_create_cohort_tab_details.css">
  <link rel="stylesheet" href="css/calendar_admin_details_create_cohort_class_tab.css">
  <link rel="stylesheet" href="css/calendar_admin_details_create_cohort_merge_tab.css">
  <link rel="stylesheet" href="css/calendar_admin_details_create_cohort_add_time_tab.css">








<div class="main-wrapper">
  <!-- Sidebar -->
  <aside class="sidebar">
    <button class="create-cohort">Create Cohort</button>
    <button class="sidebar-btn">Manage Cohort</button>
    <button class="sidebar-btn">Merge Cohort</button>
    <button class="sidebar-btn">1:1 Class</button>
    <button class="sidebar-btn">Conference</button>
    <button class="sidebar-btn">Add time off</button>
    <button class="sidebar-btn">Add Extra Slots</button>
    <button class="sidebar-btn">Single class</button>
    <div class="label-section">Tags</div>
    <div class="labels">
      <div class="label-item"><span class="label-circle label-green"></span>First Student</div>
      <div class="label-item"><span class="label-circle label-blue"></span>Student Class</div>
      <div class="label-item"><span class="label-circle label-gradient"></span>Cohort Class</div>
      <div class="label-item"><span class="label-circle label-blue"></span>Conversational Class</div>
      <div class="label-item"><span class="label-circle label-yellow"></span>Busy Time</div>
      <div class="label-item"><span class="label-circle label-grey"></span>Google Calendar</div>
    </div>
    <div class="legend-section">Lesson status</div>
    <div class="legend-items">
      <div class="legend-item"><span class="legend-dot legend-green"></span>Confirmed by the student</div>
      <div class="legend-item"><span class="legend-dot legend-blue"></span>Confirmed by the student</div>
      <div class="legend-item"><span class="legend-icon legend-repeat"></span>Weekly Class</div>
      <div class="legend-item"><span class="legend-dot legend-gradient"></span>Not confirmed by the student</div>
      <div class="legend-item"><span class="legend-icon legend-calendar"></span>Single class</div>
    </div>
  </aside>
  <!-- Main calendar/agenda -->
  <div class="calendar-main">
    <!-- Top Bar -->
    <div class="calendar-topbar2">
      
    
<div class="calendar-arrows arrow-btns">
  <div class="calendar-arrow arrow-btn" id="prev-week">&#x2039;</div>
  <div class="calendar-arrow arrow-btn" id="next-week">&#x203A;</div>
</div>



      <span class="calendar-date-range2 agenda-date-range" id="calendar-range"></span>
      <!-- Cohorts Dropdown -->
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
      <button class="today-btn" id="today-btn">Today</button>
      <div class="calendar-views view-tabs">
        <button class="weekview-btn view-tab active" id="semana-btn">Semana</button>
        <button class="agendaview-btn view-tab" id="agenda-btn">Agenda</button>
      </div>
    </div>
    <!-- Calendar Grid -->
    <div class="calendar-grid-wrapper" id="calendar-grid-wrapper" style="position:relative;">


    <div class="calendar-grid" id="calendar-grid"></div>


      <div id="current-time-indicator"></div>
      <!-- Arrow/vertical line overlay, SVG will be injected by JS -->
      <svg id="calendar-arrow-svg" style="position:absolute; left:0; top:0; z-index:20; pointer-events:none; display:block;">
        <line id="calendar-arrow-line" x1="0" y1="0" x2="0" y2="0" stroke="#ff5c00" stroke-width="3"/>
      </svg>
    </div>
    <!-- Agenda List -->
    <div class="agenda-list" id="agendaList"></div>
  </div>
</div>












<script src="js/calendar_admin_details.js"></script>
<?php require_once('calendar_admin_details_create_cohort.php'); ?>

<script src="js/calendar_admin_details_create_cohort_tab_details.js"></script>
<script src="js/calendar_admin_details_create_cohort_class_tab.js"></script>
<script src="js/calendar_admin_details_create_cohort_merge_tab.js"></script>
<script src="js/calendar_admin_details_create_cohort_add_time_tab.js"></script>














