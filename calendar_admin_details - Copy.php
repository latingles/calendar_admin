<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Calendar Admin UI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --calendar-admin-bg: #fafafd;
      --calendar-admin-sidebar-bg: #fff;
      --calendar-admin-sidebar-btn-bg: #f7f7ff;
      --calendar-admin-sidebar-btn-active: #ff3d1f;
      --calendar-admin-sidebar-btn-border: #e2e6ee;
      --calendar-admin-calendar-bg: #f7f7fa; /* GRAY */
      --calendar-admin-border: #e4e5e7;
      --calendar-admin-title: #111;
      --calendar-admin-muted: #6e6e80;
      --calendar-admin-btn-radius: 12px;
      --calendar-admin-gap: 20px;
      --calendar-admin-red: #ff3d1f;
    }
    html, body {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', Arial, sans-serif;
      background: var(--calendar-admin-bg);
      color: var(--calendar-admin-title);
      font-size: 13px;
    }
    .calendar_admin_main_wrapper {
      display: flex;
      min-height: 100vh;
      background: var(--calendar-admin-bg);
    }
    .calendar_admin_sidebar {
      min-width: 240px;
      max-width: 265px;
      background: var(--calendar-admin-sidebar-bg);
      border-right: 1.5px solid var(--calendar-admin-border);
      display: flex;
      flex-direction: column;
      padding: 15px 0 15px 0;
      box-sizing: border-box;
      z-index: 2;
      transition: 0.2s;
      font-size: 13px;
    }
    .calendar_admin_sidebar .calendar_admin_btn {
      display: block;
      width: 88%;
      margin: 0 auto 11px auto;
      background: var(--calendar-admin-sidebar-btn-bg);
      border: 1.2px solid var(--calendar-admin-sidebar-btn-border);
      color: #222;
      padding: 12px 0;
      border-radius: var(--calendar-admin-btn-radius);
      font-size: 13px;
      font-weight: 500;
      outline: none;
      cursor: pointer;
      transition: background 0.18s, border-color 0.15s, color 0.18s;
      text-align: left;
      text-indent: 12px;
      box-sizing: border-box;
      letter-spacing: 0.02em;
    }
    .calendar_admin_sidebar .calendar_admin_btn_active,
    .calendar_admin_sidebar .calendar_admin_btn:hover {
      background: var(--calendar-admin-sidebar-btn-active);
      border: 1.2px solid var(--calendar-admin-sidebar-btn-active);
      color: #fff;
    }
    .calendar_admin_sidebar .calendar_admin_btn:first-child {
      background: var(--calendar-admin-sidebar-btn-active);
      border: 1.2px solid var(--calendar-admin-sidebar-btn-active);
      color: #fff;
      margin-bottom: 16px;
    }
    .calendar_admin_tags_section {
      margin: 22px 0 0 24px;
      font-size: 12px;
    }
    .calendar_admin_tags_section h3 {
      font-size: 13px;
      font-weight: 700;
      margin-bottom: 8px;
      margin-top: 0;
    }
    .calendar_admin_tags_list,
    .calendar_admin_status_list {
      list-style: none;
      margin: 0 0 8px 0;
      padding: 0;
    }
    .calendar_admin_tags_list li {
      display: flex;
      align-items: center;
      font-size: 12px;
      margin-bottom: 7px;
      gap: 8px;
      font-weight: 500;
    }
    .calendar_admin_tag_icon {
      width: 13px;
      height: 13px;
      border-radius: 50%;
      display: inline-block;
      margin-right: 5px;
      border: 2px solid;
      background: transparent;
    }
    .calendar_admin_tag_first { border-color: #12cc35; }
    .calendar_admin_tag_student { border-color: #1853d0; }
    .calendar_admin_tag_cohort { border-color: #c400ff;
      background: linear-gradient(135deg, #1cc9ea, #c400ff, #eae13a, #2df956);
      border: none;
    }
    .calendar_admin_tag_conversation { border-color: #0e37fa; }
    .calendar_admin_tag_busy { border-color: #f9ce27; }
    .calendar_admin_tag_google { border-color: #bfc2c7; }
    .calendar_admin_status_icon {
      width: 14px; height: 14px; display: inline-block; margin-right: 6px; vertical-align: middle;
    }
    .calendar_admin_status_icon_confirmed {
      background: url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/2714.svg') no-repeat center/contain;
      filter: invert(18%) sepia(98%) saturate(600%) hue-rotate(90deg);
    }
    .calendar_admin_status_icon_not_confirmed {
      background: url('https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/25CB.svg') no-repeat center/contain;
      filter: grayscale(0.7);
    }
    .calendar_admin_status_list li {
      font-size: 11px;
      font-weight: 500;
      display: flex;
      align-items: center;
      margin-bottom: 5px;
    }
    .calendar_admin_calendar_outer {
      flex: 1;
      display: flex;
      flex-direction: column;
      background: var(--calendar-admin-calendar-bg);
      min-width: 0;
    }
    .calendar_admin_calendar_header {
      display: flex;
      align-items: center;
      padding: 16px 28px 7px 28px;
      background: var(--calendar-admin-calendar-bg);
      gap: 10px;
      min-width: 100%;
      flex-wrap: wrap;
      font-size: 14px;
    }
    .calendar_admin_header_btn {
      width: 33px; height: 33px;
      border: 1.1px solid #dedede;
      border-radius: 7px;
      background: #fff;
      display: flex; align-items: center; justify-content: center;
      font-size: 16px;
      cursor: pointer;
      transition: 0.15s;
    }
    .calendar_admin_calendar_title {
      font-size: 15px;
      font-weight: 700;
      margin: 0 12px 0 8px;
    }
    .calendar_admin_header_section {
      margin-left: auto;
      display: flex; align-items: center; gap: 9px;
    }
    .calendar_admin_user_avatar {
      width: 25px; height: 25px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #eee;
      margin: 0 2px;
    }
    .calendar_admin_menu_btn {
      padding: 6px 12px;
      border: none;
      border-radius: 6px;
      background: #f7f7ff;
      color: #111;
      font-weight: 600;
      font-size: 11px;
      margin-right: 4px;
      cursor: pointer;
      transition: background 0.16s;
    }
    .calendar_admin_menu_btn_active {
      background: #ff3d1f;
      color: #fff;
    }
    .calendar_admin_calendar_flexrow {
      display: flex;
      align-items: stretch;
      width: 100%;
      background: var(--calendar-admin-calendar-bg);
      position: relative;
    }
    .calendar_admin_time_labels_col {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      background: var(--calendar-admin-calendar-bg);
      padding-top: 37px;
      padding-left: 7px;
      padding-right: 6px;
      user-select: none;
      min-width: 44px;
    }
    .calendar_admin_time_label_item {
      height: 36px;
      line-height: 36px;
      color: #b1b1bb;
      font-size: 11px;
      text-align: right;
      font-weight: 500;
      letter-spacing: 0.01em;
      border: none;
      background: transparent;
      box-sizing: border-box;
    }
    .calendar_admin_calendar_table_wrapper {
      flex: 1;
      overflow-x: auto;
      background: var(--calendar-admin-calendar-bg);
      position: relative;
    }
    .calendar_admin_calendar_table {
      border-collapse: separate;
      border-spacing: 0;
      min-width: 900px;
      width: 100%;
      margin: 0;
      table-layout: fixed;
      font-size: 13px;
      background: var(--calendar-admin-calendar-bg);
    }
    .calendar_admin_calendar_table thead tr th {
      background: var(--calendar-admin-calendar-bg);
      font-weight: 600;
      font-size: 12px;
      color: #6e6e80;
      text-align: center;
      border-bottom: 1.2px solid var(--calendar-admin-border);
      padding: 5px 0 7px 0;
      letter-spacing: 0.01em;
    }
    .calendar_admin_calendar_table tbody tr td {
      background: transparent;
      border: none;
      height: 36px;
      min-width: 65px;
      padding: 0;
      position: relative;
      border-bottom: 1.1px solid var(--calendar-admin-border);
      border-right: 1.1px solid var(--calendar-admin-border);
      vertical-align: top;
    }
    .calendar_admin_calendar_table tbody tr td:first-child {
      border-left: none;
    }
    .calendar_admin_calendar_table tbody tr:last-child td {
      border-bottom: none;
    }
    .calendar_admin_event_card {
      position: absolute;
      left: 4px; right: 4px; top: 5px;
      min-width: 54px;
      padding: 4px 8px 4px 8px;
      background: #fff;
      border-radius: 7px;
      font-size: 11px;
      font-weight: 700;
      z-index: 1;
      border: 2px solid #1853d0;
      color: #222;
      display: flex;
      flex-direction: column;
      gap: 0;
      box-sizing: border-box;
      overflow: visible;
      line-height: 1.15;
      box-shadow: 0 1px 3px rgba(75,81,100,0.03);
      height: calc(100% - 10px);
      justify-content: center;
    }
    .calendar_admin_event_student { border-color: #1853d0; }
    .calendar_admin_event_first { border-color: #12cc35; }
    .calendar_admin_event_fl { border-color: #ff3d1f; background: #fff3f0; color: #ff3d1f;}
    .calendar_admin_event_team { border-color: #adb1ad; background: #f6f7f4; color: #454545;}
    .calendar_admin_event_busy { border-color: #f9ce27; background: #f8f6e3; color: #ad980e;}
    .calendar_admin_event_conversation { border-color: #0e37fa; }
    .calendar_admin_event_peer { border-color: #a51dc6; background: #f9e6ff; color: #a51dc6;}
    .calendar_admin_event_avatar {
      width: 16px; height: 16px; border-radius: 50%; object-fit: cover; margin-right: 6px; display: inline-block; vertical-align: middle;
      border: 1px solid #eee;
    }
    .calendar_admin_event_headerrow {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
    }
    .calendar_admin_event_title {
      display: flex;
      align-items: center;
      font-size: 12px;
      font-weight: 700;
      gap: 5px;
    }
    .calendar_admin_event_repeat {
      font-size: 15px;
      color: #6e6e80;
      margin-left: 8px;
      display: inline-block;
    }
    .calendar_admin_event_subtext {
      font-size: 9px;
      color: #666;
      font-weight: 400;
      margin-top: 2px;
      line-height: 1.1;
    }
    /* Red timeline bar */
    .calendar_admin_red_bar {
      position: absolute;
      left: 0;
      height: 0;
      border-top: 2.5px solid var(--calendar-admin-red);
      z-index: 99;
      pointer-events: none;
      width: 99%;
      display: flex;
      align-items: center;
      transition: top 0.25s;
    }
    .calendar_admin_red_arrow {
      display: inline-block;
      width: 0;
      height: 0;
      border-top: 7px solid var(--calendar-admin-red);
      border-left: 9px solid transparent;
      border-right: 9px solid transparent;
      margin-left: -9px;
      vertical-align: middle;
    }
    @media (max-width: 1100px) {
      .calendar_admin_main_wrapper {
        flex-direction: column;
      }
      .calendar_admin_sidebar {
        min-width: 100vw;
        max-width: 100vw;
        border-right: none;
        border-bottom: 1.1px solid var(--calendar-admin-border);
        flex-direction: row;
        overflow-x: auto;
        padding: 10px 0 8px 0;
      }
      .calendar_admin_sidebar .calendar_admin_btn {
        width: auto;
        min-width: 100px;
        padding: 7px 7px;
        font-size: 11px;
        text-align: center;
        text-indent: 0;
        margin: 0 6px 0 0;
      }
      .calendar_admin_tags_section {
        margin: 10px 0 0 10px;
      }
    }
    @media (max-width: 700px) {
      .calendar_admin_calendar_table {
        min-width: 600px;
      }
      .calendar_admin_calendar_header {
        padding: 7px 3px 5px 3px;
        gap: 5px;
      }
      .calendar_admin_calendar_title {
        font-size: 11px;
        margin: 0 4px 0 3px;
      }
    }

</style>
</head>
<body>
  <div class="calendar_admin_main_wrapper">
    <!-- Sidebar -->
    <aside class="calendar_admin_sidebar">
      <button class="calendar_admin_btn calendar_admin_btn_active">Create Cohort</button>
      <button class="calendar_admin_btn">Manage Cohort</button>
      <button class="calendar_admin_btn">Merge Cohort</button>
      <button class="calendar_admin_btn">1:1 Class</button>
      <button class="calendar_admin_btn">Conference</button>
      <button class="calendar_admin_btn">Peer talk</button>
      <button class="calendar_admin_btn">Add time off</button>
      <button class="calendar_admin_btn">Add Extra Slots</button>
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
        <button class="calendar_admin_header_btn">&#8592;</button>
        <button class="calendar_admin_header_btn">&#8594;</button>
        <span class="calendar_admin_calendar_title">September 02–08 , 2025</span>
        <div class="calendar_admin_header_section">
          <button class="calendar_admin_menu_btn"><span style="margin-right:6px">&#9776;</span> Cohorts</button>
          <img src="https://randomuser.me/api/portraits/women/65.jpg" class="calendar_admin_user_avatar" alt="User">
          <button class="calendar_admin_menu_btn" style="background:#f7f7ff;color:#111;">Today</button>
          <button class="calendar_admin_menu_btn calendar_admin_menu_btn_active">Semana</button>
          <button class="calendar_admin_menu_btn" style="background:transparent;color:#bbb;">Agenda</button>
        </div>
      </div>
      <!-- Calendar flex row (time labels + grid) -->
      <div class="calendar_admin_calendar_flexrow">
        <!-- Time labels, outside the grid -->
        <div class="calendar_admin_time_labels_col" id="calendar_admin_time_labels_col">
          <div class="calendar_admin_time_label_item">6:00</div>
          <div class="calendar_admin_time_label_item">7:00</div>
          <div class="calendar_admin_time_label_item">8:00</div>
          <div class="calendar_admin_time_label_item">9:00</div>
          <div class="calendar_admin_time_label_item">10:00</div>
          <div class="calendar_admin_time_label_item">11:00</div>
          <div class="calendar_admin_time_label_item">12:00</div>
          <div class="calendar_admin_time_label_item">13:00</div>



        </div>
        <!-- Calendar Table -->
        <div class="calendar_admin_calendar_table_wrapper" id="calendar_admin_calendar_table_wrapper">
          <table class="calendar_admin_calendar_table" id="calendar_admin_calendar_table">
            <thead>
              <tr>
                <th>Mon 2</th>
                <th>Tue 3</th>
                <th>Wed 4</th>
                <th>Thu 5</th>
                <th>Fri 6</th>
                <th>Sat 7</th>
                <th>Sun 8</th>
              </tr>
            </thead>
            <tbody>
              <!-- 6:00 -->
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <div class="calendar_admin_event_card calendar_admin_event_fl">
                    <div class="calendar_admin_event_headerrow">
                      <span class="calendar_admin_event_title">FL4</span>
                      <span class="calendar_admin_event_repeat">&#8635;</span>
                    </div>
                    <div class="calendar_admin_event_subtext">6:00 - 7:00 AM</div>
                  </div>
                </td>
                <td></td>
                <td>
                  <div class="calendar_admin_event_card calendar_admin_event_busy">
                    <div class="calendar_admin_event_title">Busy</div>
                    <div class="calendar_admin_event_subtext">6:00 - 7:00 AM</div>
                  </div>
                </td>
              </tr>
              <!-- 7:00 -->
              <tr>
                <td></td>
                <td>
                  <div class="calendar_admin_event_card calendar_admin_event_first">
                    <div class="calendar_admin_event_headerrow">
                      <span class="calendar_admin_event_title">Jonas</span>
                      <span class="calendar_admin_event_repeat">&#8635;</span>
                    </div>
                    <div class="calendar_admin_event_subtext">7:00 - 7:25 PM</div>
                  </div>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <!-- 8:00: FL1 (spans 2 rows) -->
              <tr>
                <td rowspan="2">
                  <div class="calendar_admin_event_card calendar_admin_event_student" style="height:calc(100% + 36px - 10px);display:flex;flex-direction:column;justify-content:center;">
                    <div class="calendar_admin_event_headerrow">
                      <span class="calendar_admin_event_title">FL1</span>
                      <span class="calendar_admin_event_repeat">&#8635;</span>
                    </div>
                    <div class="calendar_admin_event_subtext">8:00 - 9:00 AM</div>
                  </div>
                </td>
                <td></td>
                <td></td>
                <td rowspan="2">
                  <div class="calendar_admin_event_card calendar_admin_event_team" style="height:calc(100% + 36px - 10px);display:flex;flex-direction:column;justify-content:center;">
                    <div class="calendar_admin_event_headerrow">
                      <span class="calendar_admin_event_title">Team Meeting</span>
                    </div>
                    <div class="calendar_admin_event_subtext">09:00 - 10:00 AM</div>
                  </div>
                </td>
                <td></td>
                <td rowspan="2">
                  <div class="calendar_admin_event_card calendar_admin_event_student" style="height:calc(100% + 36px - 10px);display:flex;flex-direction:column;justify-content:center;">
                    <div class="calendar_admin_event_headerrow">
                      <span class="calendar_admin_event_title"><img src="https://randomuser.me/api/portraits/women/43.jpg" class="calendar_admin_event_avatar" alt="MJ"> Mary Janes</span>
                      <span class="calendar_admin_event_repeat">&#8635;</span>
                    </div>
                    <div class="calendar_admin_event_subtext">09:00 - 10:00 AM</div>
                  </div>
                </td>
                <td></td>
              </tr>
              <!-- 9:00: (skip td for FL1, Team, Mary Janes) -->
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <!-- 10:00 -->
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <!-- 11:00 -->
              <tr>
                <td></td>
                <td></td>
                <td>
                  <div class="calendar_admin_event_card calendar_admin_event_student">
                    <div class="calendar_admin_event_headerrow">
                      <span class="calendar_admin_event_title">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="calendar_admin_event_avatar" alt="MJ"> Mary Janes
                      </span>
                      <span class="calendar_admin_event_repeat">
                        <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/svg/1F4C5.svg" style="width:13px;vertical-align:middle;" alt="Single">
                      </span>
                    </div>
                    <div class="calendar_admin_event_subtext">11:00 - 12:00 AM</div>
                  </div>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <!-- 12:00 -->
              <tr>
                <td></td>
                <td></td>
                <td>
                  <div class="calendar_admin_event_card calendar_admin_event_conversation">
                    <div class="calendar_admin_event_headerrow">
                      <span class="calendar_admin_event_title">Conversation</span>
                      <span class="calendar_admin_event_repeat">&#8635;</span>
                    </div>
                    <div class="calendar_admin_event_subtext">12:00 - 13:00 AM</div>
                  </div>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <!-- 13:00 -->
              <tr>
                <td></td>
                <td></td>
                <td>
                  <div class="calendar_admin_event_card calendar_admin_event_peer">
                    <div class="calendar_admin_event_headerrow">
                      <span class="calendar_admin_event_title">Peer Talk</span>
                      <span class="calendar_admin_event_repeat">&#8635;</span>
                    </div>
                    <div class="calendar_admin_event_subtext">12:00 - 13:00 AM</div>
                    <!-- Red arrow will be here if needed -->
                  </div>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
          <!-- Red timeline bar injected here -->
          <div id="calendar_admin_red_bar" class="calendar_admin_red_bar" style="display:none;">
            <span class="calendar_admin_red_arrow"></span>
          </div>
        </div>
      </div>
    </main>
  </div>
  <!-- jQuery for sidebar/menu active state -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Sidebar button highlight
    $('.calendar_admin_btn').on('click', function() {
      $('.calendar_admin_btn').removeClass('calendar_admin_btn_active');
      $(this).addClass('calendar_admin_btn_active');
    });
    $('.calendar_admin_menu_btn').on('click', function() {
      $('.calendar_admin_menu_btn').removeClass('calendar_admin_menu_btn_active');
      $(this).addClass('calendar_admin_menu_btn_active');
    });

    // === RED TIMELINE BAR LOGIC ===
function updateRedBar() {
  var now = new Date();
  var hours = now.getHours();
  var mins = now.getMinutes();
  var dayIdx = now.getDay(); // 0=Sun,1=Mon...
  // Table: [Mon,Tue,Wed,Thu,Fri,Sat,Sun]
  var tableDay = (dayIdx + 6) % 7;
  var slotHours = [6,7,8,9,10,11,12,13];
  var rowHeight = 46;

  var totalSlots = slotHours.length;
  var slotIdx;
  var cellTop;

  if (hours < slotHours[0]) {
    // Before first slot: show at top
    slotIdx = 0;
    cellTop = 0;
  } else if (hours >= slotHours[totalSlots - 1] + 1) {
    // After last slot: stick to just below the last slot
    cellTop = totalSlots * rowHeight;
  } else {
    // In range: dynamic within slot
    slotIdx = hours - slotHours[0];
    if(slotIdx < 0) slotIdx = 0;
    if(slotIdx >= totalSlots) slotIdx = totalSlots - 1;
    cellTop = slotIdx * rowHeight + (mins / 60) * rowHeight;
  }

  // Find day column th
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
  bar.style.display = "flex";
}





$(function(){
  updateRedBar();
  setInterval(updateRedBar, 60 * 1000);
  $(window).on('resize', updateRedBar);
});



  </script>
</body>
</html>
