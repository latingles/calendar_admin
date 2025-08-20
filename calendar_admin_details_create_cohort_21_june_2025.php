<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cohort Modal with Conference Tab and Calendar Picker</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body { font-family: Arial, sans-serif; }
    #calendar_admin_details_create_cohort_modal_backdrop {
      display: none; position: fixed; z-index: 1000;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,.6);
    }
    #calendar_admin_details_create_cohort_modal {
      background: #fff;
      width: 95%; max-width: 570px; max-height: 93vh;
      margin: 5vh auto; border-radius: 12px;
      padding: 28px 20px 20px 20px;
      overflow-y: auto; position: relative;
      box-shadow: 0 10px 36px 0 rgba(0,0,0,.17);
    }
    .calendar_admin_details_create_cohort_close {
      position: absolute; top: 16px; right: 15px;
      font-size: 22px; cursor: pointer; font-weight: bold; color: #222;
    }
    h2 { margin: 10px 0 0 0; font-size: 1.35rem; font-weight: bold; }
    .calendar_admin_details_create_cohort_tabs_scroll {
      overflow-x: auto;
      white-space: nowrap;
      border-bottom: 1px solid #ececec;
      margin: 18px 0 20px 0;
      padding-bottom: 2px;
      -webkit-overflow-scrolling: touch;
    }
    .calendar_admin_details_create_cohort_tabs {
      display: inline-flex; gap: 15px;
    }
    .calendar_admin_details_create_cohort_tab {
      display: inline-block;
      padding: 8px 12px 10px 12px; cursor: pointer; font-size: 1.03rem;
      color: #989898;
      border: none; background: none;
      font-weight: 500;
      transition: color 0.2s, border-bottom 0.2s;
    }
    .calendar_admin_details_create_cohort_tab.active {
      border-bottom: 3px solid #fe2e0c; color: #fe2e0c; font-weight: bold;
    }
    .calendar_admin_details_create_cohort_tabs_scroll::-webkit-scrollbar {height:4px;background:#ececec;}
    .calendar_admin_details_create_cohort_tabs_scroll::-webkit-scrollbar-thumb {background:#d1d1d1; border-radius:2px;}
    .calendar_admin_details_create_cohort_content {
      margin-top: 5px;
      animation: fadeIn .19s;
    }
    @keyframes fadeIn {from{opacity:0;}to{opacity:1;}}
    /* Conference Content (scoped styles) */
    .conference_modal_schedule {
      display: flex; align-items: center; gap: 7px;
      color: #b5b5b5; font-size: 1.07rem; font-weight: 600;
      margin-bottom: 7px;
    }
    .conference_modal_schedule input[type="checkbox"] {
      accent-color: #dadada; width: 19px; height: 19px; margin: 0 5px 0 0;
    }
    .conference_modal_repeat_row {
      display: flex; align-items: center; gap: 15px; margin-bottom: 7px;
    }
    .conference_modal_repeat_btn {
      padding: 11px 13px;
      border-radius: 8px 8px 0 0;
      border: none; border-bottom: 2.5px solid #fe2e0c;
      background: none; color: #232323; font-weight: 600; font-size: 1rem;
      min-width: 153px;
    }
    .conference_modal_date_btn {
      background: #fff; border: 2px solid #dadada; border-radius: 24px;
      padding: 10px 20px; font-size: 1.05rem; font-weight: 500;
      min-width: 123px; margin: 0 0 0 0;
      margin-right: 10px; cursor: pointer;
    }
    .conference_modal_time_btn,
    .calendar_admin_details_create_cohort_time_btn {
      background: #fff;
      border: 2px solid #232323;
      border-radius: 26px;
      padding: 10px 22px;
      font-size: 1.09rem; font-weight: 600;
      cursor: pointer; margin: 0 7px 0 0; display: inline-flex; align-items: center;
      min-width: 112px; transition: border 0.16s, background 0.13s;
    }
    .conference_modal_time_btn.selected,
    .calendar_admin_details_create_cohort_time_btn.selected {
      border: 2px solid #fe2e0c; color: #fe2e0c; background: #fff4f1;
    }
    .conference_modal_findtime_link {
      color: #064ae6; font-size: 1.06rem; text-decoration: none; font-weight: 500;
    }
    .conference_modal_findtime_circle {
      width: 30px; height: 30px; background: #1736e6; border-radius: 50%; display: inline-block; border: 2.3px solid #1736e6;
    }
    .conference_modal_timezone {
      width: 100%; padding: 12px 13px;
      border-radius: 10px; border: 1.4px solid #dadada;
      background: #fafbfc; font-size: 1.02rem; margin-bottom: 13px;
      color: #6d6d6d;
    }
    .conference_modal_fieldrow {
      display: flex; flex-wrap: wrap; gap: 13px;
      margin-bottom: 18px;
    }
    .conference_modal_fieldrow > div {
      flex: 1 1 47%; min-width: 150px; position: relative;
    }
    .conference_modal_label {
      font-size: 1rem; font-weight: 500; color: #232323; margin-bottom: 4px; display: block;
    }
    .conference_modal_dropdown_btn {
      width: 100%; padding: 13px 14px;
      border: 1.5px solid #dadada;
      border-radius: 10px; background: #fff;
      font-size: 1.02rem; text-align: left;
      cursor: pointer; position: relative;
      display: flex; align-items: center; justify-content: space-between;
    }
    .conference_modal_dropdown_btn svg {
      width: 18px; height: 18px; margin-left: auto; fill: #aaa;
    }
    .conference_modal_dropdown_list {
      display: none; position: absolute; top: 100%; left: 0; width: 100%;
      background: #fff; border: 1.5px solid #dadada;
      border-radius: 11px; box-shadow: 0 4px 18px #0001;
      z-index: 100; margin-top: 1px;
    }
    .conference_modal_dropdown_list ul { list-style: none; padding: 0; margin: 0; }
    .conference_modal_dropdown_list li {
      padding: 13px 18px; font-size: 1rem;
      cursor: pointer; border-radius: 8px;
      transition: background 0.18s;
      display: flex; align-items: center; gap: 10px;
    }
    .conference_modal_dropdown_list li:hover {
      background: #f7f7f7; color: #fe2e0c;
    }
    .conference_modal_teacher_avatar {
      width: 38px; height: 38px; border-radius: 50%; object-fit: cover; background: #eaeaea; border: 1.2px solid #ececec;
    }
    .conference_modal_attendees_section {margin: 18px 0 9px 0;}
    .conference_modal_attendees_list {
      background: #fff; border-radius: 12px; box-shadow: 0 2px 11px #0002;
      padding: 0; margin: 0; list-style: none;
    }
    .conference_modal_attendee {
      display: flex; align-items: center; gap: 13px;
      padding: 12px 16px; border-bottom: 1px solid #f1f1f1;
      font-size: 1.02rem; background: #fff;
    }
    .conference_modal_attendee:last-child { border-bottom: none; }
    .conference_modal_cohort_chip {
      background: #d6e8cf; color: #497b26; font-weight: 700; font-size: 1rem;
      padding: 7px 13px; border-radius: 50px; margin-right: 7px;
      display: flex; align-items: center; min-width: 35px; justify-content: center;
    }
    .conference_modal_attendee_name { font-weight: 600; }
    .conference_modal_icon {
      font-size: 1.3rem; color: #626262; margin-left: auto; margin-right: 6px;
      display: flex; align-items: center;
    }
    .conference_modal_icon.user { font-size: 1.17rem; }
    .conference_modal_remove { color: #c53c2a; cursor: pointer; font-size: 1.5rem; margin-left: 8px; }
    .conference_modal_btn {
      width: 100%; background-color: #fe2e0c; color: white; padding: 15px 0;
      border: none; font-weight: bold; font-size: 1.11rem; margin-top: 18px;
      border-radius: 9px; cursor: pointer; letter-spacing: .5px;
      box-shadow: 0 3px 13px 0 rgba(254,46,12,.07);
    }
    /* Time Picker Modal Styles */
    .calendar_admin_details_create_cohort_time_modal_backdrop {
      display: none; position: fixed; z-index: 3001; top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.08);
    }
    .calendar_admin_details_create_cohort_time_modal {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 8px 24px 0 rgba(0,0,0,.14);
      width: 210px;
      max-width: 98vw;
      max-height: 72vh;
      overflow-y: auto;
      padding: 0;
      position: absolute;
      left: 50%; transform: translateX(-50%);
      margin-top: 8px;
      animation: fadeIn .16s;
      border: 1.5px solid #eaeaea;
    }
    .calendar_admin_details_create_cohort_time_modal ul { list-style: none; margin: 0; padding: 0; }
    .calendar_admin_details_create_cohort_time_modal li {
      font-size: 1.13rem; padding: 14px 28px; cursor: pointer; transition: background .15s, color .15s;
      border-radius: 0;
      text-align: left; color: #232323;
    }
    .calendar_admin_details_create_cohort_time_modal li:hover,
    .calendar_admin_details_create_cohort_time_modal li.selected {
      background: #f7f7f7; color: #fe2e0c;
    }
    @media(max-width: 600px){
      .calendar_admin_details_create_cohort_time_modal {
        width: 96vw; padding: 0; font-size: 1rem;
      }
      .calendar_admin_details_create_cohort_time_modal li { padding: 12px 10vw; }
    }
    /* All your previous styles remain below! */
    .calendar_admin_details_create_cohort_row {display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 13px;}
    .calendar_admin_details_create_cohort_row > div {flex: 1 1 45%; position: relative;}
    .calendar_admin_details_create_cohort_dropdown_wrapper,
    .calendar_admin_details_create_cohort_teacher_dropdown_wrapper,
    .calendar_admin_details_create_cohort_class_dropdown_wrapper,
    .calendar_admin_details_create_cohort_shortname_dropdown_wrapper {position: relative; margin-bottom: 12px;}
    .calendar_admin_details_create_cohort_dropdown_btn,
    .calendar_admin_details_create_cohort_shortname_btn,
    .calendar_admin_details_create_cohort_teacher_btn,
    .calendar_admin_details_create_cohort_class_btn {
      width: 100%; padding: 12px 14px;
      border: 1.5px solid #232323; border-radius: 8px; background: #fff;
      cursor: pointer; font-size: 1rem; text-align: left;
      position: relative; box-sizing: border-box;
      display: flex; align-items: center; justify-content: space-between;
    }
    .calendar_admin_details_create_cohort_dropdown_btn svg,
    .calendar_admin_details_create_cohort_shortname_btn svg,
    .calendar_admin_details_create_cohort_teacher_btn svg,
    .calendar_admin_details_create_cohort_class_btn svg {
      width: 19px; height: 19px; margin-left: auto;
      fill: #232323; flex-shrink: 0;
    }
    .calendar_admin_details_create_cohort_dropdown_list,
    .calendar_admin_details_create_cohort_shortname_list,
    .calendar_admin_details_create_cohort_teacher_list,
    .calendar_admin_details_create_cohort_class_list {
      position: absolute; top: 100%; left: 0;
      width: 100%; min-width: 180px; max-height: 290px; overflow-y: auto;
      background: #fff; border: 1.5px solid #232323;
      border-radius: 10px; box-shadow: 0px 4px 16px rgba(0,0,0,0.14);
      z-index: 40; display: none;
      padding: 8px 0 8px 0; margin-top: 0; box-sizing: border-box;
    }
    .calendar_admin_details_create_cohort_teacher_list li {
      display: flex; align-items: center; gap: 11px;
      padding: 10px 14px; border-radius: 8px; font-size: 1rem; cursor: pointer; transition: background 0.18s;
    }
    .calendar_admin_details_create_cohort_teacher_list li:hover {background: #f7f7f7; color: #fe2e0c;}
    .calendar_admin_details_create_cohort_teacher_avatar {
      width: 38px; height: 38px; border-radius: 50%;
      object-fit: cover; background: #eaeaea; border: 1.2px solid #ececec;
    }
    .calendar_admin_details_create_cohort_time_btn.selected {border: 2px solid #fe2e0c; color: #fe2e0c; background: #fff4f1;}
    label { font-size: .97rem; font-weight: 500; color: #232323; }
    .calendar_admin_details_create_cohort_event_nav {
      display: flex; align-items: center; justify-content: center; gap: 18px; margin: 18px 0 13px 0;
      font-size: 1.07rem; font-weight: 600;
    }
    .calendar_admin_details_create_cohort_event_nav button {
      background: #fff; border: 1.1px solid #ccc; border-radius: 7px; padding: 4px 12px;
      font-weight: 600; font-size: 1.14rem; color: #232323; cursor: pointer; outline: none; transition: background .16s;
    }
    .calendar_admin_details_create_cohort_event_nav .calendar_admin_details_create_cohort_add {
      color: #fff; background: #fe2e0c; border: none; font-size: 1.3rem; border-radius: 50%; width: 34px; height: 34px; padding: 0;
      display: flex; align-items: center; justify-content: center; margin-left: 6px; box-shadow: 0 2px 8px rgba(254,46,12,0.10);
    }
    select, input[type="text"], input[type="date"] {
      width: 100%; padding: 9px; border-radius: 5px; border: 1px solid #ccc;
      font-size: 1rem; margin-top: 2px; margin-bottom: 6px;
    }
    .calendar_admin_details_create_cohort_find-time {
      display: flex; gap: 10px; align-items: center; margin: 5px 0 0 0;
    }
    .calendar_admin_details_create_cohort_find-time a {
      color: #064ae6; font-size: 1.03rem; text-decoration: none; font-weight: 500;
    }
    .calendar_admin_details_create_cohort_circle-dropdown {
      width: 26px; height: 26px; background: #1736e6;
      border-radius: 50%; display: inline-block; position: relative; cursor: pointer; border: 2px solid #1736e6;
    }
    .calendar_admin_details_create_cohort_bottom {
      display: flex; gap: 16px; justify-content: space-between;
      align-items: center; margin: 20px 0 10px 0;
    }
    .calendar_admin_details_create_cohort_switch {
      display: flex; align-items: center; gap: 9px; font-size: 1.07rem;
    }
    .calendar_admin_details_create_cohort_toggle {
      width: 43px; height: 24px; background: #ededed; border-radius: 20px; position: relative; cursor: pointer; transition: background 0.2s; border: 1.5px solid #ddd;
    }
    .calendar_admin_details_create_cohort_toggle::before {
      content: ''; width: 21px; height: 21px; background: #fff; position: absolute; top: 1px; left: 1px; border-radius: 50%; transition: all 0.28s; box-shadow: 0 1px 6px 0 rgba(0,0,0,.07);
    }
    .calendar_admin_details_create_cohort_toggle.active {background: #5ec76c; border-color: #51b95f;}
    .calendar_admin_details_create_cohort_toggle.active::before {left: 21px;}
    .calendar_admin_details_create_cohort_btn {
      width: 100%; background-color: #fe2e0c; color: white; padding: 15px 0;
      border: none; font-weight: bold; font-size: 1.11rem; margin-top: 13px;
      border-radius: 9px; cursor: pointer; letter-spacing: .5px;
      box-shadow: 0 3px 13px 0 rgba(254,46,12,.07);
    }
    /* Calendar modal styles ... */
    .calendar_admin_details_create_cohort_calendar_modal_backdrop {
      display: none; position: fixed; z-index: 2050;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.11);
    }
    .calendar_admin_details_create_cohort_calendar_modal {
      background: #fff;
      border-radius: 13px;
      box-shadow: 0 10px 36px 0 rgba(0,0,0,.16);
      width: 340px;
      padding: 20px 18px 18px 18px;
      position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);
      max-width: 96vw;
    }
    .calendar_admin_details_create_cohort_calendar_nav {
      display: flex; align-items: center; justify-content: space-between;
      font-size: 1.18rem; font-weight: 600;
      margin-bottom: 10px;
    }
    .calendar_admin_details_create_cohort_calendar_nav button {
      background: #fafafa; border: none; font-size: 1.45rem; border-radius: 7px;
      padding: 2px 13px; cursor: pointer; color: #222;
      transition: background .15s;
    }
    .calendar_admin_details_create_cohort_calendar_nav button:hover {
      background: #ececec;
    }
    .calendar_admin_details_create_cohort_calendar_days {
      display: grid; grid-template-columns: repeat(7,1fr); gap: 3px;
      text-align: center; font-size: 1.07rem; margin-bottom: 10px;
    }
    .calendar_admin_details_create_cohort_calendar_day_header {
      color: #b2b2b2; font-weight: 600; padding: 7px 0 4px 0;
    }
    .calendar_admin_details_create_cohort_calendar_day,
    .calendar_admin_details_create_cohort_calendar_day_inactive {
      padding: 11px 0;
      border-radius: 8px;
      cursor: pointer;
      font-size: 1.11rem;
      font-weight: 500;
      transition: background .15s, color .15s, border .17s;
    }
    .calendar_admin_details_create_cohort_calendar_day_inactive {
      color: #bdbdbd; background: #fafafa; cursor: not-allowed;
    }
    .calendar_admin_details_create_cohort_calendar_day.selected {
      border: 2px solid #fe2e0c;
      color: #fe2e0c;
      background: #fff;
      font-weight: 700;
    }
    .calendar_admin_details_create_cohort_calendar_done_btn {
      width: 100%; background: #fe2e0c; color: #fff; font-weight: bold;
      border: none; border-radius: 8px; padding: 12px 0; margin-top: 14px; font-size: 1.12rem;
      cursor: pointer; box-shadow: 0 3px 11px 0 rgba(254,46,12,.07);
    }
    @media(max-width:600px){
      #calendar_admin_details_create_cohort_modal {padding: 16px 2vw;}
      .calendar_admin_details_create_cohort_row > div {flex: 1 1 100%;}
      .calendar_admin_details_create_cohort_tabs {font-size: .97rem;}
      .conference_modal_fieldrow {flex-direction: column; gap: 8px;}
      .calendar_admin_details_create_cohort_calendar_modal {width:96vw;padding:13px 1vw;}
    }





.color-dropdown-wrapper {
  display: inline-block;
  position: relative;
  margin-left: 10px;
  vertical-align: middle;
}
.color-dropdown-toggle {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 54px;
  height: 32px;
  border: 2px solid #232323;
  border-radius: 18px;
  background: #fff;
  padding: 3px 8px 3px 3px;
  cursor: pointer;
  transition: border .15s;
  position: relative;
}
.color-dropdown-toggle .color-circle {
  width: 22px; height: 22px; border-radius: 50%;
  display: inline-block;
  border: none;
}
.color-dropdown-toggle .color-dropdown-arrow {
  margin-left: 5px;
  transition: transform .16s;
}
.color-dropdown-toggle.active .color-dropdown-arrow {
  transform: rotate(180deg);
}
.color-dropdown-list {
  display: none;
  position: absolute;
  top: 115%;
  left: 50%;
  transform: translateX(-50%);
  min-width: 54px;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 5px 18px #0001;
  padding: 13px 8px 13px 8px;
  z-index: 101;
}
.color-dropdown-color {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin: 8px auto;
  cursor: pointer;
  border: 2.2px solid transparent;
  transition: border .15s;
}
.color-dropdown-color:hover,
.color-dropdown-color.selected {
  border: 2.2px solid #fe2e0c;
}
@media(max-width:600px){
  .color-dropdown-list { min-width: 46px; }
  .color-dropdown-toggle { width: 44px; height: 28px; }
  .color-dropdown-color { width: 22px; height: 22px; }
}











  </style>
</head>
<body>
  <button id="calendar_admin_details_create_cohort_open">Create Cohort</button>
  <div id="calendar_admin_details_create_cohort_modal_backdrop">
    <div id="calendar_admin_details_create_cohort_modal">
      <span class="calendar_admin_details_create_cohort_close">&times;</span>
      <h2>Management</h2>
      <div class="calendar_admin_details_create_cohort_tabs_scroll">
        <div class="calendar_admin_details_create_cohort_tabs">
          <div class="calendar_admin_details_create_cohort_tab active" data-tab="cohort">Cohort</div>
          <div class="calendar_admin_details_create_cohort_tab" data-tab="class">1:1 Class</div>
          <div class="calendar_admin_details_create_cohort_tab" data-tab="merge">Merge</div>
          <div class="calendar_admin_details_create_cohort_tab" data-tab="conference">Conference</div>
          <div class="calendar_admin_details_create_cohort_tab" data-tab="peertalk">Peer Talk</div>
          <div class="calendar_admin_details_create_cohort_tab" data-tab="addtime">Add Time</div>
          <div class="calendar_admin_details_create_cohort_tab" data-tab="extraslots">Add Extra Slots</div>
        </div>
      </div>

      
      <div class="calendar_admin_details_create_cohort_content" id="mainModalContent">
        <div class="calendar_admin_details_create_cohort_row">
          <div class="calendar_admin_details_create_cohort_dropdown_wrapper">
            <label>Cohort</label>
            <div class="calendar_admin_details_create_cohort_dropdown_btn" id="cohortDropdownBtn">
              Select Existing Cohort
              <svg viewBox="0 0 20 20"><path d="M7 8l3 3 3-3"></path></svg>
            </div>
            <div class="calendar_admin_details_create_cohort_dropdown_list" id="cohortDropdownList">
              <button type="button">Create Cohort</button>
              <strong>Existing Cohorts</strong>
              <ul>
                <li>FII-1–030423–0090</li>
                <li>OH–12–032023–0089</li>
                <li>NY–2–042522–0088</li>
                <li>OH–12–032023–0089</li>
                <li>TX–1–030423–0090</li>
              </ul>
            </div>
          </div>
          <div class="calendar_admin_details_create_cohort_shortname_dropdown_wrapper">
            <label>Cohort’s Short Name</label>
            <div class="calendar_admin_details_create_cohort_shortname_btn" id="shortNameDropdownBtn">
              XX#
              <svg viewBox="0 0 20 20"><path d="M7 8l3 3 3-3"></path></svg>
            </div>
            <div class="calendar_admin_details_create_cohort_shortname_list" id="shortNameDropdownList">
              <ul>
                <li>TX1</li>
                <li>FL6</li>
                <li>OHI2</li>
                <li>NY2</li>
                <li>FL1</li>
              </ul>
            </div>
          </div>
        </div>
        <!-- Event navigation -->
        <div class="calendar_admin_details_create_cohort_event_nav">
          <button type="button">&#60;</button>
          <span style="flex: 1; text-align: center;">Events</span>
          <button type="button">&#62;</button>
          <button type="button" class="calendar_admin_details_create_cohort_add">+</button>
        </div>
        <div class="calendar_admin_details_create_cohort_row">
          <div>
            <div class="calendar_admin_details_create_cohort_teacher_dropdown_wrapper">
              <label>Teacher 1</label>
              <div class="calendar_admin_details_create_cohort_teacher_btn" id="teacher1DropdownBtn">
                Select Teacher
                <svg viewBox="0 0 20 20"><path d="M7 8l3 3 3-3"></path></svg>
              </div>
              <div class="calendar_admin_details_create_cohort_teacher_list" id="teacher1DropdownList">
                <ul>
                  <li><img src="https://randomuser.me/api/portraits/men/11.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Edwards</li>
                  <li><img src="https://randomuser.me/api/portraits/women/44.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Daniela</li>
                  <li><img src="https://randomuser.me/api/portraits/men/31.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Hawkins</li>
                  <li><img src="https://randomuser.me/api/portraits/men/32.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Lane</li>
                  <li><img src="https://randomuser.me/api/portraits/men/33.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Warren</li>
                  <li><img src="https://randomuser.me/api/portraits/men/52.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Fox</li>
                </ul>
              </div>
            </div>
            <div class="calendar_admin_details_create_cohort_class_dropdown_wrapper">
              <label>Class Name</label>
              <div class="calendar_admin_details_create_cohort_class_btn" id="className1DropdownBtn">
                Main Class
                <svg viewBox="0 0 20 20"><path d="M7 8l3 3 3-3"></path></svg>
              </div>
              <div class="calendar_admin_details_create_cohort_class_list" id="className1DropdownList">
                <ul>
                  <li>Main Class</li>
                  <li>Tutoring Class</li>
                  <li>Conversational Class</li>
                </ul>
              </div>
            </div>
            <select>
              <option>Does not repeat</option>
              <option>Weekly</option>
              <option>Monthly</option>
            </select>
            <div style="display:flex; gap:8px; margin:10px 0;">
              <button class="calendar_admin_details_create_cohort_time_btn" id="startTime1Btn">Start Time</button>
              <button class="calendar_admin_details_create_cohort_time_btn" id="endTime1Btn">End Time</button>
            </div>
            <select>
              <option>(GMT-05:00) Eastern</option>
              <option>(GMT+05:00) Pakistan</option>
            </select>
            <label>Start On</label>
            <button class="conference_modal_date_btn">Select Date</button>
            <div class="calendar_admin_details_create_cohort_find-time">
              <a href="#">Find a time</a>
              <div class="calendar_admin_details_create_cohort_circle-dropdown"></div>
            </div>
          </div>
          <div>
            <div class="calendar_admin_details_create_cohort_teacher_dropdown_wrapper">
              <label>Teacher 2</label>
              <div class="calendar_admin_details_create_cohort_teacher_btn" id="teacher2DropdownBtn">
                Select Teacher
                <svg viewBox="0 0 20 20"><path d="M7 8l3 3 3-3"></path></svg>
              </div>
              <div class="calendar_admin_details_create_cohort_teacher_list" id="teacher2DropdownList">
                <ul>
                  <li><img src="https://randomuser.me/api/portraits/women/45.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Maria</li>
                  <li><img src="https://randomuser.me/api/portraits/men/38.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Joseph</li>
                  <li><img src="https://randomuser.me/api/portraits/women/32.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Lisa</li>
                  <li><img src="https://randomuser.me/api/portraits/men/21.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Fox</li>
                </ul>
              </div>
            </div>
            <div class="calendar_admin_details_create_cohort_class_dropdown_wrapper">
              <label>Class Name</label>
              <div class="calendar_admin_details_create_cohort_class_btn" id="className2DropdownBtn">
                Main Class
                <svg viewBox="0 0 20 20"><path d="M7 8l3 3 3-3"></path></svg>
              </div>
              <div class="calendar_admin_details_create_cohort_class_list" id="className2DropdownList">
                <ul>
                  <li>Main Class</li>
                  <li>Tutoring Class</li>
                  <li>Conversational Class</li>
                </ul>
              </div>
            </div>
            <select>
              <option>Does not repeat</option>
              <option>Weekly</option>
            </select>
            <div style="display:flex; gap:8px; margin:10px 0;">
              <button class="calendar_admin_details_create_cohort_time_btn" id="startTime2Btn">Start Time</button>
              <button class="calendar_admin_details_create_cohort_time_btn" id="endTime2Btn">End Time</button>
            </div>
            <select>
              <option>(GMT-05:00) Eastern</option>
            </select>
            <label>Start On</label>
            <button class="conference_modal_date_btn">Select Date</button>
            <div class="calendar_admin_details_create_cohort_find-time">
              <a href="#">Find a time</a>
              <div class="calendar_admin_details_create_cohort_circle-dropdown"></div>
            </div>
          </div>
        </div>
        <div class="calendar_admin_details_create_cohort_bottom">
          <div class="calendar_admin_details_create_cohort_switch">
            <div class="calendar_admin_details_create_cohort_toggle" id="toggleActive"></div> Active
          </div>
          <div class="calendar_admin_details_create_cohort_switch">
            <div class="calendar_admin_details_create_cohort_toggle" id="toggleAvailable"></div> Available
          </div>
        </div>
        <button class="calendar_admin_details_create_cohort_btn">Create Update Cohort</button>
      </div>





















      <div class="calendar_admin_details_create_cohort_content tab-content" id="peerTalkTabContent" style="display:none;">
  <!-- Peer Talk: (same structure as Conference, you can modify as needed) -->
  <div class="conference_modal_schedule">
    <input type="checkbox" disabled checked> Peer Talk Schedule
  </div>
  <div class="conference_modal_repeat_row">
    <div style="flex:1;">
      <div class="conference_modal_repeat_btn" style="border-bottom:2.5px solid #fe2e0c;">
        Does not repeat
        <span style="float:right; font-size:1rem;">&#9660;</span>
      </div>
    </div>
    <div class="conference_modal_label" style="font-weight:400;">Start On</div>
    <div style="flex:1;">
      <button class="conference_modal_date_btn">Select Date</button>
    </div>
  </div>
  <div style="display:flex; gap:12px; align-items:center; margin-bottom:7px;">
    <button class="conference_modal_time_btn">Start Time</button>
    <span>-</span>
    <button class="conference_modal_time_btn">End Time</button>
    <a class="conference_modal_findtime_link" href="#">Find a time</a>
    <div class="color-dropdown-wrapper">
      <button type="button" class="color-dropdown-toggle" id="peerTalkColorDropdownToggle" style="width:75px;">
        <span class="color-circle" style="background:#22b07e"></span>
        <span style="float:right; font-size:1rem;">▼</span>
      </button>
      <div class="color-dropdown-list" id="peerTalkColorDropdownList">
        <div class="color-dropdown-color" data-color="#1736e6" style="background:#1736e6"></div>
        <div class="color-dropdown-color" data-color="#22b07e" style="background:#22b07e"></div>
        <div class="color-dropdown-color" data-color="#3c3b4d" style="background:#3c3b4d"></div>
        <div class="color-dropdown-color" data-color="#ff2f1b" style="background:#ff2f1b"></div>
        <div class="color-dropdown-color" data-color="#daaf36" style="background:#daaf36"></div>
      </div>
    </div>
  </div>
  <select class="conference_modal_timezone">
    <option>(GMT-05:00) Eastern</option>
    <option>(GMT+05:00) Pakistan</option>
  </select>
  <div class="conference_modal_fieldrow">
    <div>
      <span class="conference_modal_label">Attending Cohorts</span>
      <div class="conference_modal_dropdown_btn" id="peerTalkCohortsDropdown">
        XX#
        <span style="float:right; font-size:1rem;">▼</span>
      </div>
      <div class="conference_modal_dropdown_list" id="peerTalkCohortsDropdownList">
        <ul>
          <li>FL1</li>
          <li>TX1</li>
          <li>NY2</li>
          <li>OHI2</li>
        </ul>
      </div>
    </div>
    <div>
      <span class="conference_modal_label">Teachers</span>
      <div class="conference_modal_dropdown_btn" id="peerTalkTeachersDropdown">
        Select Teacher
        <span style="float:right; font-size:1rem;">▼</span>
      </div>
      <div class="conference_modal_dropdown_list" id="peerTalkTeachersDropdownList">
        <ul>
          <li><img src="https://randomuser.me/api/portraits/men/11.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Edwards</li>
          <li><img src="https://randomuser.me/api/portraits/women/44.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Daniela</li>
          <li><img src="https://randomuser.me/api/portraits/men/31.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Hawkins</li>
          <li><img src="https://randomuser.me/api/portraits/men/32.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Lane</li>
          <li><img src="https://randomuser.me/api/portraits/men/33.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Warren</li>
          <li><img src="https://randomuser.me/api/portraits/men/52.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Fox</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="conference_modal_attendees_section">
    <ul class="conference_modal_attendees_list">
      <li class="conference_modal_attendee">
        <span class="conference_modal_cohort_chip">FL1</span>
        <span class="conference_modal_attendee_name">Florida 1</span>
        <span class="conference_modal_icon">&#128101;</span>
        <span class="conference_modal_remove">&times;</span>
      </li>
      <li class="conference_modal_attendee">
        <img src="https://randomuser.me/api/portraits/men/31.jpg" style="width:40px;height:40px;border-radius:50%;border:1.2px solid #e1e1e1;">
        <span>jackson.graham@example.com</span>
        <span class="conference_modal_icon user">&#128100;</span>
        <span class="conference_modal_remove">&times;</span>
      </li>
      <li class="conference_modal_attendee">
        <img src="https://randomuser.me/api/portraits/men/23.jpg" style="width:40px;height:40px;border-radius:50%;border:1.2px solid #e1e1e1;">
        <span>bill.sanders@example.com</span>
        <span class="conference_modal_icon user">&#128100;</span>
        <span class="conference_modal_remove">&times;</span>
      </li>
    </ul>
  </div>
  <button class="conference_modal_btn">Schedule Peer Talk</button>
</div>










      
      <!-- Conference Content: loaded by JS when needed -->
      <div id="conferenceTabContent" style="display:none;">
        <div class="conference_modal_schedule">
          <input type="checkbox" disabled checked> Conference Schedule
        </div>
        <div class="conference_modal_repeat_row">
          <div style="flex:1;">
            <div class="conference_modal_repeat_btn" style="border-bottom:2.5px solid #fe2e0c;">
              Does not repeat
              <span style="float:right; font-size:1rem;">&#9660;</span>
            </div>
          </div>
            <div class="conference_modal_label" style="font-weight:400;">Start On</div>

          <div style="flex:1;">
            <button class="conference_modal_date_btn">Select Date</button>
          </div>
        </div>
        <div style="display:flex; gap:12px; align-items:center; margin-bottom:7px;">
          <button class="conference_modal_time_btn">Start Time</button>
          <span>-</span>
          <button class="conference_modal_time_btn">End Time</button>
          <a class="conference_modal_findtime_link" href="#">Find a time</a>



         <!-- Color Picker Dropdown (inline with Find a time) -->
          <div class="color-dropdown-wrapper">
            <button type="button" class="color-dropdown-toggle" id="colorDropdownToggle" style="width:75px;">
              <span class="color-circle" style="background:#1736e6"></span>
               <span style="float:right; font-size:1rem;">▼</span>
            </button>
            <div class="color-dropdown-list" id="colorDropdownList">
              <div class="color-dropdown-color" data-color="#1736e6" style="background:#1736e6"></div>
              <div class="color-dropdown-color" data-color="#22b07e" style="background:#22b07e"></div>
              <div class="color-dropdown-color" data-color="#3c3b4d" style="background:#3c3b4d"></div>
              <div class="color-dropdown-color" data-color="#ff2f1b" style="background:#ff2f1b"></div>
              <div class="color-dropdown-color" data-color="#daaf36" style="background:#daaf36"></div>
            </div>
          </div>

        
        
        </div>
        <select class="conference_modal_timezone">
          <option>(GMT-05:00) Eastern</option>
          <option>(GMT+05:00) Pakistan</option>
        </select>
        <div class="conference_modal_fieldrow">
          <div>
            <span class="conference_modal_label">Attending Cohorts</span>
            <div class="conference_modal_dropdown_btn" id="conferenceCohortsDropdown">
              XX#
            <span style="float:right; font-size:1rem;">▼</span>
            </div>
            <div class="conference_modal_dropdown_list" id="conferenceCohortsDropdownList">
              <ul>
                <li>FL1</li>
                <li>TX1</li>
                <li>NY2</li>
                <li>OHI2</li>
              </ul>
            </div>
          </div>
          <div>
            <span class="conference_modal_label">Teachers</span>
            <div class="conference_modal_dropdown_btn" id="conferenceTeachersDropdown">
              Select Teacher
                 <span style="float:right; font-size:1rem;">▼</span>
            </div>
            <div class="conference_modal_dropdown_list" id="conferenceTeachersDropdownList">
              <ul>
                  <li><img src="https://randomuser.me/api/portraits/men/11.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Edwards</li>
                  <li><img src="https://randomuser.me/api/portraits/women/44.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Daniela</li>
                  <li><img src="https://randomuser.me/api/portraits/men/31.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Hawkins</li>
                  <li><img src="https://randomuser.me/api/portraits/men/32.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Lane</li>
                  <li><img src="https://randomuser.me/api/portraits/men/33.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Warren</li>
                  <li><img src="https://randomuser.me/api/portraits/men/52.jpg" class="calendar_admin_details_create_cohort_teacher_avatar"> Fox</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="conference_modal_attendees_section">
          <ul class="conference_modal_attendees_list">
            <li class="conference_modal_attendee">
              <span class="conference_modal_cohort_chip">FL1</span>
              <span class="conference_modal_attendee_name">Florida 1</span>
              <span class="conference_modal_icon">&#128101;</span>
              <span class="conference_modal_remove">&times;</span>
            </li>
            <li class="conference_modal_attendee">
              <img src="https://randomuser.me/api/portraits/men/31.jpg" style="width:40px;height:40px;border-radius:50%;border:1.2px solid #e1e1e1;">
              <span>jackson.graham@example.com</span>
              <span class="conference_modal_icon user">&#128100;</span>
              <span class="conference_modal_remove">&times;</span>
            </li>
            <li class="conference_modal_attendee">
              <img src="https://randomuser.me/api/portraits/men/23.jpg" style="width:40px;height:40px;border-radius:50%;border:1.2px solid #e1e1e1;">
              <span>bill.sanders@example.com</span>
              <span class="conference_modal_icon user">&#128100;</span>
              <span class="conference_modal_remove">&times;</span>
            </li>
          </ul>
        </div>
        <button class="conference_modal_btn">Schedule Conference</button>
      </div>
    </div>
    <!-- Time Picker Modal -->
    <div class="calendar_admin_details_create_cohort_time_modal_backdrop" id="timeModalBackdrop">
      <div class="calendar_admin_details_create_cohort_time_modal" id="timeModal">
        <ul>
          <!-- Time options rendered via JS -->
        </ul>
      </div>
    </div>
    <!-- Calendar Date Picker Modal -->
    <div class="calendar_admin_details_create_cohort_calendar_modal_backdrop" id="calendarDateModalBackdrop" style="display:none;">
      <div class="calendar_admin_details_create_cohort_calendar_modal" id="calendarDateModal">
        <div class="calendar_admin_details_create_cohort_calendar_nav">
          <button class="calendar_prev_month">&lt;</button>
          <span id="calendarDateMonth"></span>
          <button class="calendar_next_month">&gt;</button>
        </div>
        <div class="calendar_admin_details_create_cohort_calendar_days"></div>
        <button class="calendar_admin_details_create_cohort_calendar_done_btn">Done</button>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      // Modal open/close
      $('#calendar_admin_details_create_cohort_open').click(function () {
        $('#calendar_admin_details_create_cohort_modal_backdrop').fadeIn();
      });
      $('.calendar_admin_details_create_cohort_close').click(function () {
        $('#calendar_admin_details_create_cohort_modal_backdrop').fadeOut();
      });

      // Tabs - Peer Talk tab shows Conference content
      $('.calendar_admin_details_create_cohort_tab').click(function () {
        $('.calendar_admin_details_create_cohort_tab').removeClass('active');
        $(this).addClass('active');
        let tab = $(this).data('tab');
        $('#mainModalContent').toggle(tab === "cohort");
        
        $('#conferenceTabContent').toggle(tab === "conference");
        $('#peerTalkTabContent').toggle(tab === "peertalk");


        // Hide both if not cohort/conference/peertalk
        if(tab !== "cohort" && tab !== "conference" && tab !== "peertalk"){
          $('#mainModalContent').hide();
          $('#conferenceTabContent').hide();
        }
      });

      // Dropdowns
      $('#cohortDropdownBtn').click(function (e) {
        e.stopPropagation();
        $('#cohortDropdownList').toggle();
        $('#shortNameDropdownList, #teacher1DropdownList, #teacher2DropdownList, #className1DropdownList, #className2DropdownList').hide();
      });
      $('#cohortDropdownList li').click(function () {
        $('#cohortDropdownBtn').contents().first()[0].textContent = $(this).text() + " ";
        $('#cohortDropdownList').hide();
      });
      $('#shortNameDropdownBtn').click(function (e) {
        e.stopPropagation();
        $('#shortNameDropdownList').toggle();
        $('#cohortDropdownList, #teacher1DropdownList, #teacher2DropdownList, #className1DropdownList, #className2DropdownList').hide();
      });
      $('#shortNameDropdownList li').click(function () {
        $('#shortNameDropdownBtn').contents().first()[0].textContent = $(this).text() + " ";
        $('#shortNameDropdownList').hide();
      });
      $('#teacher1DropdownBtn').click(function(e){
        e.stopPropagation();
        $('#teacher1DropdownList').toggle();
        $('#cohortDropdownList, #shortNameDropdownList, #teacher2DropdownList, #className1DropdownList, #className2DropdownList').hide();
      });
      $('#teacher1DropdownList li').click(function(){
        $('#teacher1DropdownBtn').html($(this).html() + '<svg viewBox="0 0 20 20"><path d="M7 8l3 3 3-3"></path></svg>');
        $('#teacher1DropdownList').hide();
      });
      $('#teacher2DropdownBtn').click(function(e){
        e.stopPropagation();
        $('#teacher2DropdownList').toggle();
        $('#cohortDropdownList, #shortNameDropdownList, #teacher1DropdownList, #className1DropdownList, #className2DropdownList').hide();
      });
      $('#teacher2DropdownList li').click(function(){
        $('#teacher2DropdownBtn').html($(this).html() + '<svg viewBox="0 0 20 20"><path d="M7 8l3 3 3-3"></path></svg>');
        $('#teacher2DropdownList').hide();
      });
      $('#className1DropdownBtn').click(function(e){
        e.stopPropagation();
        $('#className1DropdownList').toggle();
        $('#cohortDropdownList, #shortNameDropdownList, #teacher1DropdownList, #teacher2DropdownList, #className2DropdownList').hide();
      });
      $('#className1DropdownList li').click(function(){
        $('#className1DropdownBtn').contents().first()[0].textContent = $(this).text() + " ";
        $('#className1DropdownList').hide();
      });
      $('#className2DropdownBtn').click(function(e){
        e.stopPropagation();
        $('#className2DropdownList').toggle();
        $('#cohortDropdownList, #shortNameDropdownList, #teacher1DropdownList, #teacher2DropdownList, #className1DropdownList').hide();
      });
      $('#className2DropdownList li').click(function(){
        $('#className2DropdownBtn').contents().first()[0].textContent = $(this).text() + " ";
        $('#className2DropdownList').hide();
      });
      // Conference tab dropdowns
      $('#conferenceCohortsDropdown').click(function(e){
        e.stopPropagation();
        $('#conferenceCohortsDropdownList').toggle();
        $('#conferenceTeachersDropdownList').hide();
      });
      $('#conferenceTeachersDropdown').click(function(e){
        e.stopPropagation();
        $('#conferenceTeachersDropdownList').toggle();
        $('#conferenceCohortsDropdownList').hide();
      });
      $('#conferenceCohortsDropdownList li').click(function(){
        $('#conferenceCohortsDropdown').contents().first()[0].textContent = $(this).text() + " ";
        $('#conferenceCohortsDropdownList').hide();
      });
      $('#conferenceTeachersDropdownList li').click(function(){
        $('#conferenceTeachersDropdown').html($(this).html() + '<svg viewBox="0 0 20 20"><path d="M7 8l3 3 3-3"></path></svg>');
        $('#conferenceTeachersDropdownList').hide();
      });
      $(document).click(function () {
        $('.calendar_admin_details_create_cohort_dropdown_list, .calendar_admin_details_create_cohort_teacher_list, .calendar_admin_details_create_cohort_class_list, .calendar_admin_details_create_cohort_shortname_list, .conference_modal_dropdown_list').hide();
      });
      // Remove attendee
      $('.conference_modal_remove').click(function(){
        $(this).closest('.conference_modal_attendee').fadeOut(200, function() { $(this).remove(); });
      });
      // Toggles
      $('#toggleActive, #toggleAvailable').click(function () {
        $(this).toggleClass('active');
      });

      // ===== TIME PICKER (all "Start Time" & "End Time" buttons, both tabs) =====
      function openTimePickerModal($btn) {
        let times = [];
        let start = 10; // 5:00 AM (10th half hour after midnight)
        let end = 47; // 11:30 PM
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
        // Position
        let offset = $btn.offset();
        let left = offset.left + $btn.outerWidth()/2 - 105; // Centered (210px wide)
        let top = offset.top + $btn.outerHeight() + 2;
        if ($(window).width() < 500) {
          left = "50%"; top = $(window).scrollTop() + $(window).height() * 0.20;
          $('#timeModal').css({ left: left, top: top, transform: "translate(-50%,0)" });
        } else {
          $('#timeModal').css({ left: left, top: top, transform: "none" });
        }
        $('#timeModalBackdrop').show().data('targetBtn', $btn);
      }
      // --- Bind time picker for both class and conference time buttons! ---
      $(document).on("click", ".calendar_admin_details_create_cohort_time_btn, .conference_modal_time_btn", function(e){
        e.stopPropagation();
        openTimePickerModal($(this));
      });
      $('#timeModal').off("click", "li").on("click", "li", function(){
        let $btn = $('#timeModalBackdrop').data('targetBtn');
        $btn.text($(this).text()).addClass('selected');
        $('#timeModalBackdrop').hide();
      });
      $('#timeModalBackdrop').off("click").on("click", function(e){
        if (e.target === this) $(this).hide();
      });
      $(document).on("keydown", function(e){
        if (e.key === "Escape") $('#timeModalBackdrop').hide();
      });

      // ===== CALENDAR PICKER LOGIC =====
      function daysInMonth(year, month) {
        return new Date(year, month+1, 0).getDate();
      }
      let calendarDateTargetBtn = null;
      let selectedCalendarDate = null;
      let calendarModalMonth = null;
      $(document).on('click', '.conference_modal_date_btn', function(e){
        e.preventDefault();
        calendarDateTargetBtn = $(this);
        if ($(this).parents('#conferenceTabContent').length) {
          calendarModalMonth = {year: 2025, month: 0}; // Jan 2025
        } else {
          let now = new Date();
          calendarModalMonth = {year: now.getFullYear(), month: now.getMonth()};
        }
        selectedCalendarDate = null;
        renderCalendarModal();
        $('#calendarDateModalBackdrop').fadeIn();
      });
      $(document).on('click', '.calendar_prev_month', function(){
        calendarModalMonth.month--;
        if(calendarModalMonth.month < 0) {
          calendarModalMonth.month = 11; calendarModalMonth.year--;
        }
        renderCalendarModal();
      });
      $(document).on('click', '.calendar_next_month', function(){
        calendarModalMonth.month++;
        if(calendarModalMonth.month > 11) {
          calendarModalMonth.month = 0; calendarModalMonth.year++;
        }
        renderCalendarModal();
      });
      function renderCalendarModal(){
        const monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        let y = calendarModalMonth.year, m = calendarModalMonth.month;
        $('#calendarDateMonth').text(`${monthNames[m]} ${y}`);
        let html = '';
        let dayHeaders = ['Mo','Tu','We','Th','Fr','Sa','Su'];
        for(let d=0;d<7;d++) html += `<div class="calendar_admin_details_create_cohort_calendar_day_header">${dayHeaders[d]}</div>`;
        let firstDay = new Date(y,m,1).getDay(); firstDay = (firstDay+6)%7;
        let totalDays = daysInMonth(y,m);
        let prevMonthDays = firstDay;
        let day = 1;
        for(let i=0;i<prevMonthDays;i++) html += `<div class="calendar_admin_details_create_cohort_calendar_day_inactive"></div>`;
        for(let d=1; d<=totalDays; d++){
          let sel = selectedCalendarDate &&
            selectedCalendarDate.getFullYear() === y &&
            selectedCalendarDate.getMonth() === m &&
            selectedCalendarDate.getDate() === d ? ' selected' : '';
          html += `<div class="calendar_admin_details_create_cohort_calendar_day${sel}" data-day="${d}">${d}</div>`;
          day++;
        }
        let rem = (prevMonthDays + totalDays)%7;
        if(rem>0) for(let i=rem;i<7;i++) html += `<div class="calendar_admin_details_create_cohort_calendar_day_inactive"></div>`;
        $('.calendar_admin_details_create_cohort_calendar_days').html(html);
      }
      $(document).on('click', '.calendar_admin_details_create_cohort_calendar_day', function(){
        $('.calendar_admin_details_create_cohort_calendar_day').removeClass('selected');
        $(this).addClass('selected');
        let day = parseInt($(this).attr('data-day'));
        selectedCalendarDate = new Date(calendarModalMonth.year, calendarModalMonth.month, day);
      });
      $('.calendar_admin_details_create_cohort_calendar_done_btn').click(function(){
        if(selectedCalendarDate && calendarDateTargetBtn){
          let d = selectedCalendarDate;
          let nice = d.toLocaleDateString('en-GB', { day: '2-digit', month:'short', year:'numeric' });
          calendarDateTargetBtn.text(nice);
          $('#calendarDateModalBackdrop').fadeOut();
        }
      });
      $('#calendarDateModalBackdrop').click(function(e){
        if(e.target === this) $(this).fadeOut();
      });

      // Color dropdown logic
      $('#colorDropdownToggle').click(function(e){
        e.stopPropagation();
        $(this).toggleClass('active');
        $('#colorDropdownList').toggle();
      });
      $('#colorDropdownList .color-dropdown-color').click(function(e){
        e.stopPropagation();
        var color = $(this).attr('data-color');
        $('#colorDropdownToggle .color-circle').css('background', color);
        $('#colorDropdownList .color-dropdown-color').removeClass('selected');
        $(this).addClass('selected');
        $('#colorDropdownList').hide();
        $('#colorDropdownToggle').removeClass('active');
      });
      $(document).click(function(){
        $('#colorDropdownList').hide();
        $('#colorDropdownToggle').removeClass('active');
      });

      // Conference modal button example
      $('.conference_modal_btn').on('click', function(e) {
        e.preventDefault();
        let repeat = $('.conference_modal_repeat_btn').text().trim();
        let startOn = $('#conferenceTabContent .conference_modal_date_btn').first().text().trim();
        let startTime = $('#conferenceTabContent .conference_modal_time_btn').eq(0).text().trim();
        let endTime = $('#conferenceTabContent .conference_modal_time_btn').eq(1).text().trim();
        let timezone = $('#conferenceTabContent .conference_modal_timezone').val();
        let cohorts = $('#conferenceTabContent #conferenceCohortsDropdown').contents().first()[0].textContent.trim();
        let teachers = $('#conferenceTabContent #conferenceTeachersDropdown').text().replace(/\s+/g, ' ').trim();
        let attendees = [];
        $('#conferenceTabContent .conference_modal_attendee').each(function() {
          let cohort = $(this).find('.conference_modal_attendee_name').text().trim();
          let email = $(this).find('span').eq(1).text().trim();
          if(cohort) attendees.push(cohort);
          else if(email) attendees.push(email);
        });
        let confData = {
          repeat: repeat,
          startOn: startOn,
          startTime: startTime,
          endTime: endTime,
          timezone: timezone,
          cohorts: cohorts,
          teachers: teachers,
          attendees: attendees
        };
        alert(JSON.stringify(confData, null, 2));
      });

    });
  
  </script>

  <?php require_once('calendar_admin_details_create_cohort_select_date.php');?>

</body>
</html>
