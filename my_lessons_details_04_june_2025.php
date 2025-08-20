
<link rel="stylesheet"  href="css/my_lesson_details.css"/>
<link rel="stylesheet" href="css/my_lesson_tutor_profile_details_send_message.css">

  <div id="my_lessons_container">
    <!-- Header + Actions -->
    <h1 class="my_lessons_header">My Lessons</h1>
    <div class="my_lessons_actions">
      <button  class="openTransfer my_lessons_btn_outline">
        Transfer lessons or subscription
      </button>
      <div class="my_lessons_schedule_dropdown my_lessons_calendar_slot_empty">
        <button id="my_lessons_schedule_btn" class="my_lessons_btn_primary">
          + Schedule lesson <i class="fas fa-chevron-down"></i>
        </button>
        <div id="my_lessons_schedule_menu" class="my_lessons_dropdown_menu">
          <div class="my_lessons_schedule_option" data-type="weekly">
            <i class="fas fa-sync-alt my_lessons_option_icon"></i>
            <div class="my_lessons_option_text">
              <span class="my_lessons_recommended_pill">Recommended</span>
              <h4>Weekly lessons</h4>
              <p>Lessons are scheduled automatically for the same time every week</p>
            </div>
          </div>

          <div class="my_lessons_schedule_option" data-type="single">
            <i class="fas fa-calendar-alt my_lessons_option_icon"></i>
            <div class="my_lessons_option_text">
              <h4>Single lessons</h4>
              <p>Lessons happen once</p>
            </div>
          </div>
          
        </div>
      </div>
    </div>

    <!-- Tabs -->
    <ul id="my_lessons_tabs" class="my_lessons_tabs">
      <li class="my_lessons_tab_item active" data-target="#my_lessons_tab_lessons">
        <i class="fas fa-video"></i> Lessons
      </li>
      <li class="my_lessons_tab_item" data-target="#my_lessons_tab_calendar">
        <i class="fas fa-calendar-alt"></i> Calendar
      </li>
      <li class="my_lessons_tab_item" data-target="#my_lessons_tab_tutors">
        <i class="fas fa-user-graduate"></i> Tutors
      </li>
    </ul>

    <!-- Lessons Tab -->
    <div id="my_lessons_tab_lessons" class="my_lessons_tab_content" style="display:block;">
      <h2 class="my_lessons_section_heading">Upcoming lessons</h2>

      <!-- Tomorrow (recurring) -->
      <div class="my_lessons_lesson_card">
        <img
          src="https://randomuser.me/api/portraits/women/4.jpg"
          alt="Daniela"
          class="my_lessons_lesson_avatar"/>
        <div class="my_lessons_lesson_details">
          <div class="my_lessons_lesson_header">
            <i class="fas fa-sync-alt my_lessons_lesson_icon"></i>
            <span class="my_lessons_lesson_time">
              Tomorrow, Nov 13, 15:00 – 15:50
            </span>
          </div>
          <div class="my_lessons_lesson_subject">English</div>
        </div>
        <div class="my_lessons_menu_section">
          <i class="fas fa-ellipsis-h my_lessons_menu_icon"></i>
        </div>
        <div class="my_lessons_card_menu">
          <ul>
            <li><a href="my_lessons_details_reshedule.php"><i class="fas fa-calendar-alt"></i> Reschedule</a></li>
            <li><i class="fas fa-comment"></i> Message Tutor</li>
            <li><i class="fas fa-user"></i> See Tutor Profile</li>
            <li class="my_lessons_cancel my_lesson_details_cancel__open"><i class="fas fa-ban"></i> Cancel</li>
          </ul>
        </div>
      </div>

      <!-- One-off lessons -->
      <div class="my_lessons_lesson_card">
        <img
          src="https://randomuser.me/api/portraits/women/4.jpg"
          alt="Daniela"
          class="my_lessons_lesson_avatar"/>
        <div class="my_lessons_lesson_details">
          <div class="my_lessons_lesson_header">
            <span class="my_lessons_lesson_time">
              Thursday, Nov 14, 15:00 – 15:50
            </span>
          </div>
          <div class="my_lessons_lesson_subject">English</div>
        </div>
        <div class="my_lessons_menu_section">
          <i class="fas fa-ellipsis-h my_lessons_menu_icon"></i>
        </div>
        <div class="my_lessons_card_menu">
          <ul>
            <li><i class="fas fa-calendar-alt"></i> Reschedule</li>
            <li><i class="fas fa-comment"></i> Message Tutor</li>
            <li><i class="fas fa-user"></i> See Tutor Profile</li>
            <li class="my_lessons_cancel"><i class="fas fa-ban"></i> Cancel</li>
          </ul>
        </div>
      </div>

      <div class="my_lessons_lesson_card">
        <img
          src="https://randomuser.me/api/portraits/women/4.jpg"
          alt="Daniela"
          class="my_lessons_lesson_avatar"/>
        <div class="my_lessons_lesson_details">
          <div class="my_lessons_lesson_header">
            <span class="my_lessons_lesson_time">
              Monday, Nov 18, 15:00 – 15:50
            </span>
          </div>
          <div class="my_lessons_lesson_subject">English</div>
        </div>
        <div class="my_lessons_menu_section">
          <i class="fas fa-ellipsis-h my_lessons_menu_icon"></i>
        </div>
        <div class="my_lessons_card_menu">
          <ul>
            <li><i class="fas fa-calendar-alt"></i> Reschedule</li>
            <li><i class="fas fa-comment"></i> Message Tutor</li>
            <li><i class="fas fa-user"></i> See Tutor Profile</li>
            <li class="my_lessons_cancel"><i class="fas fa-ban"></i> Cancel</li>
          </ul>
        </div>
      </div>

      <div class="my_lessons_lesson_card">
        <img
          src="https://randomuser.me/api/portraits/women/4.jpg"
          alt="Daniela"
          class="my_lessons_lesson_avatar"/>
        <div class="my_lessons_lesson_details">
          <div class="my_lessons_lesson_header">
            <span class="my_lessons_lesson_time">
              Wednesday, Nov 20, 15:00 – 15:50
            </span>
          </div>
          <div class="my_lessons_lesson_subject">English</div>
        </div>
        <div class="my_lessons_menu_section">
          <i class="fas fa-ellipsis-h my_lessons_menu_icon"></i>
        </div>
        <div class="my_lessons_card_menu">
          <ul>
            <li><i class="fas fa-calendar-alt"></i> Reschedule</li>
            <li><i class="fas fa-comment"></i> Message Tutor</li>
            <li><i class="fas fa-user"></i> See Tutor Profile</li>
            <li class="my_lessons_cancel"><i class="fas fa-ban"></i> Cancel</li>
          </ul>
        </div>
      </div>

      <h2 class="my_lessons_section_heading">Weekly lessons</h2>

      <div class="my_lessons_lesson_card">
        <img
          src="https://randomuser.me/api/portraits/women/4.jpg"
          alt="Daniela"
          class="my_lessons_lesson_avatar"/>
        <div class="my_lessons_lesson_details">
          <div class="my_lessons_lesson_header">
            <i class="fas fa-sync-alt my_lessons_lesson_icon"></i>
            <span class="my_lessons_lesson_time">
              Every Wednesday, 15:00 – 15:50
            </span>
          </div>
          <div class="my_lessons_lesson_subject">English</div>
        </div>
        <div class="my_lessons_menu_section">
          <i class="fas fa-ellipsis-h my_lessons_menu_icon"></i>
        </div>
        <div class="my_lessons_card_menu">
          <ul>
            <li><i class="fas fa-calendar-alt"></i> Reschedule</li>
            <li><i class="fas fa-comment"></i> Message Tutor</li>
            <li><i class="fas fa-user"></i> See Tutor Profile</li>
            <li class="my_lessons_cancel"><i class="fas fa-ban"></i> Cancel</li>
          </ul>
        </div>
      </div>
    </div>

     <!-- Calendar Tab -->
    <div id="my_lessons_tab_calendar" class="my_lessons_tab_content">
      <div class="my_lessons_calendar_actions">
        <div class="my_lessons_calendar_nav">


          <button class="my_lessons_today_btn my_lessons_btn_outline" id="todayBtn">Today</button>
          <button class="my_lessons_nav_btn my_lessons_btn_outline"   id="prevWeek">
            <i class="fas fa-chevron-left"></i>
          </button>
          <button class="my_lessons_nav_btn my_lessons_btn_outline" id="nextWeek">
            <i class="fas fa-chevron-right"></i>
          </button>
        
          
          <div class="my_lessons_calendar_date">September 02–08, 2024</div>
        </div>
        <div class="my_lessons_calendar_legend">
          <div><i class="fas fa-check-circle"></i> Confirmed by the student</div>
          <div><i class="fas fa-sync-alt"></i> Weekly Class</div>
          <div><i class="fas fa-calendar-alt"></i> Single Class</div>
        </div>
      </div>
      <table class="my_lessons_calendar_table">
        <thead>
          <tr>

            <th></th>
            <th class="calendar-day-header" data-index="0">Mon 2</th>
            <th class="calendar-day-header" data-index="1">Tue 3</th>
            <th class="calendar-day-header" data-index="2">Wed 4</th>
            <th class="calendar-day-header" data-index="3">Thu 5</th>
            <th class="calendar-day-header" data-index="4">Fri 6</th>
            <th class="calendar-day-header" data-index="5">Sat 7</th>
            <th class="calendar-day-header" data-index="6">Sun 8</th>

          </tr>
        </thead>
        <tbody>
          <tr><th>6:00</th><td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
          <tr>
            <th>7:00</th>
      
            <td class="my_lessons_calendar_slot_empty"></td>
            <td class="my_lessons_calendar_slot_empty"></td>
            <td class="my_lessons_calendar_slot_empty"></td>

            <td>
              <div class="my_lessons_calendar_event my_lessons_event_weekly my_lessons_calendar_event my_lessons_event_weekly">
                <img class="my_lessons_event_avatar"
                     src="https://randomuser.me/api/portraits/women/4.jpg"
                     alt="Mary Janes">
                <i class="fas fa-sync-alt my_lessons_event_icon"></i>
                <div class="my_lessons_event_time">07:00–08:00 AM</div>
                <div class="my_lessons_event_name">Mary Janes</div>
              </div>
            </td>

            <td></td><td></td>
            <td>
              <div class="my_lessons_calendar_event my_lessons_event_single">
                <img class="my_lessons_event_avatar"
                     src="https://randomuser.me/api/portraits/women/4.jpg"
                     alt="Mary Janes">
                <i class="fas fa-check-circle my_lessons_event_icon"></i>
                <div class="my_lessons_event_time">07:00–08:00 AM</div>
                <div class="my_lessons_event_name">Mary Janes</div>
              </div>
            </td>
          </tr>
          <tr>
            <th>8:00</th><td></td>

            
            <td>
              <div class="my_lessons_calendar_event my_lessons_event_confirmed">
                <img class="my_lessons_event_avatar"
                     src="https://randomuser.me/api/portraits/men/2.jpg"
                     alt="Mary Janes">
                <i class="fas fa-check-circle my_lessons_event_icon"></i>
                <div class="my_lessons_event_time">08:00–09:00 AM</div>
                <div class="my_lessons_event_name">Mary Janes</div>
              </div>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

          </tr>

      <tr><th>9:00</th><td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        
        </tr>

          <tr>
            <th>10:00</th>
            <td>
              <div class="my_lessons_calendar_event my_lessons_event_single">
                <img class="my_lessons_event_avatar"
                     src="https://randomuser.me/api/portraits/women/4.jpg"
                     alt="Mary Janes">
                <i class="fas fa-check-circle my_lessons_event_icon"></i>
                <div class="my_lessons_event_time">10:00–11:00 AM</div>
                <div class="my_lessons_event_name">Mary Janes</div>
              </div>
            </td>
            <td colspan="3"></td>
            <td>
              <div class="my_lessons_calendar_event my_lessons_event_single">
                <img class="my_lessons_event_avatar"
                     src="https://randomuser.me/api/portraits/women/4.jpg"
                     alt="Mary Janes">
                <i class="fas fa-calendar-alt my_lessons_event_icon"></i>
                <div class="my_lessons_event_time">10:00–11:00 AM</div>
                <div class="my_lessons_event_name">Mary Janes</div>
              </div>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
      <tr><th>20:00</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        </tbody>
      </table>
    </div>

<!-- Tutors Tab -->
<div id="my_lessons_tab_tutors" class="my_lessons_tab_content">
  <!-- Tutor 1 -->
  <div class="my_lessons_card" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; position:relative;">
    <div style="display: flex; align-items: center;">
      <img class="my_lessons_avatar" src="https://randomuser.me/api/portraits/women/4.jpg" alt="Daniela" style="width:56px; height:56px; border-radius:50%; margin-right:18px;">
      <div>
        <a href="#" class="my_lessons_name" style="font-weight:bold; text-decoration:underline;">Daniela</a>
        <div style="color:#888;">English</div>
      </div>
    </div>
    <div style="text-align: right;">
      <div style="font-weight:bold;">11 lessons</div>
     
      <!-- <div style="color:#888; font-size:15px;">to schedule <i class="fas fa-sync-alt" style="color:#3fb37f; margin-left:5px;"></i></div> -->

        <div style="color:#888; font-size:15px; display:inline-block; position:relative;">
          to schedule 
          <span class="my-subscription-tooltip-anchor" style="position:relative;">
            <i class="fas fa-sync-alt" style="color:#3fb37f; margin-left:5px; cursor:pointer;"></i>
            <div class="my-subscription-tooltip">
              <div style="font-weight:600; font-size:19px; margin-bottom:6px;">Your Subscription</div>
              <div style="margin-bottom:4px;">8 lessons • $61.44 every 4 weeks</div>
              <div style="font-size:15px; margin-bottom:12px;">Next billing : 2025-03-18</div>
              <a href="YOUR_LINK_HERE" target="_blank" style="font-weight:600; text-decoration:underline; color:#fff;">View Setting</a>
            </div>
          </span>
        </div>

    
    </div>
    <div style="text-align: right;">
      <div style="font-weight:bold;">$5.40</div>
      <div style="color:#888; font-size:15px;">per lesson</div>
    </div>
    <div style="position:relative;">
      <span class="tutor-action-dot"><i class="fas fa-ellipsis-h"></i></span>
      <div class="tutor-action-menu">
        <ul>
          <li class="open_step1"><i class="fas fa-comment"></i> Message Tutor</li>
          <li><i class="fas fa-dollar-sign"></i> Change your plan</li>
          <a href="my_lesson_tutor_profile_detail_schedule_lesson.php"><li><i class="fas fa-calendar-alt"></i> Schedule lessons</li></a>
          <li><i class="fas fa-wallet"></i> Add extra lessons</li>
          <li class="openTransfer"><i class="fas fa-sync-alt"></i> Transfer lessons or subscription</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Tutor 2 -->
  <div class="my_lessons_card" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; position:relative;">
    <div style="display: flex; align-items: center;">
      <img class="my_lessons_avatar" src="https://randomuser.me/api/portraits/women/68.jpg" alt="Patricia" style="width:56px; height:56px; border-radius:50%; margin-right:18px;">
      <div>
        <a href="#" class="my_lessons_name" style="font-weight:bold; text-decoration:underline;">Patricia</a>
        <div style="color:#888;">English</div>
      </div>
    </div>
    <div style="text-align: right;">
      <div style="font-weight:bold;">0 lessons</div>
      <div style="color:#888; font-size:15px;">to schedule</div>
    </div>
    <div style="text-align: right;">
      <div style="font-weight:bold;">$11.00</div>
      <div style="color:#888; font-size:15px;">per lesson</div>
    </div>
    <div style="position:relative;">
      <span class="tutor-action-dot"><i class="fas fa-ellipsis-h"></i></span>
      <div class="tutor-action-menu">
        <ul>
          <li><i class="fas fa-comment"></i> Message Tutor</li>
          <li><i class="fas fa-dollar-sign"></i> Change your plan</li>
          <li><i class="fas fa-calendar-alt"></i> Schedule lessons</li>
          <li><i class="fas fa-wallet"></i> Add extra lessons</li>
          <li><i class="fas fa-sync-alt"></i> Transfer lessons or subscription</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Tutor 3 -->
  <div class="my_lessons_card" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; position:relative;">
    <div style="display: flex; align-items: center;">
      <img class="my_lessons_avatar" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Guy Hawkins" style="width:56px; height:56px; border-radius:50%; margin-right:18px;">
      <div>
        <a href="#" class="my_lessons_name" style="font-weight:bold; text-decoration:underline;">Guy Hawkins</a>
        <div style="color:#888;">English</div>
      </div>
    </div>
    <div style="text-align: right;">
      <div style="font-weight:bold;">0 lessons</div>
      <div style="color:#888; font-size:15px;">to schedule</div>
    </div>
    <div style="text-align: right;">
      <div style="font-weight:bold;">$7.00</div>
      <div style="color:#888; font-size:15px;">per lesson</div>
    </div>
    <div style="position:relative;">
      <span class="tutor-action-dot"><i class="fas fa-ellipsis-h"></i></span>
      <div class="tutor-action-menu">
        <ul>
          <li><i class="fas fa-comment"></i> Message Tutor</li>
          <li><i class="fas fa-dollar-sign"></i> Change your plan</li>
          <li><i class="fas fa-calendar-alt"></i> Schedule lessons</li>
          <li><i class="fas fa-wallet"></i> Add extra lessons</li>
          <li><i class="fas fa-sync-alt"></i> Transfer lessons or subscription</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Tutor 4 -->
  <div class="my_lessons_card" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px;">
    <div style="display: flex; align-items: center;">
      <img class="my_lessons_avatar" src="https://randomuser.me/api/portraits/women/4.jpg" alt="Daniela" style="width:56px; height:56px; border-radius:50%; margin-right:18px;">
      <div>
        <a href="#" class="my_lessons_name" style="font-weight:bold; text-decoration:underline;">Daniela</a>
        <div style="color:#888;">English</div>
      </div>
    </div>
    <div style="text-align: right;">
      <div style="font-weight:bold;">1 lessons</div>
      <div style="color:#888; font-size:15px;">to schedule</div>
    </div>
    <div style="text-align: right;">
      <div style="font-weight:bold;">$5.00</div>
      <div style="color:#888; font-size:15px;">per lesson</div>
    </div>
    <div style="display:flex;gap:7px;">
      <button class="open_step1" style="background:transparent; border:1.5px solid #ececec; border-radius:8px; padding:7px 9px; margin-right:5px; cursor:pointer;">
        <i class="fas fa-comment" style="font-size:17px;"></i>
      </button>
      <a href="my_lesson_tutor_profile_detail_schedule_lesson.php"><button style="background:#fff; border:2px solid #232323; border-radius:8px; padding:7px 17px; font-weight:bold; cursor:pointer;">
        Shedule Lesson
      </button></a>
    </div>
  </div>

  <!-- Tutor 5 -->
  <div class="my_lessons_card" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px;">
    <div style="display: flex; align-items: center;">
      <img class="my_lessons_avatar" src="https://randomuser.me/api/portraits/men/41.jpg" alt="Jacob Jones" style="width:56px; height:56px; border-radius:50%; margin-right:18px;">
      <div>
        <a href="#" class="my_lessons_name" style="font-weight:bold; text-decoration:underline;">Jacob Jones</a>
        <div style="color:#888;">English</div>
      </div>
    </div>
    <div style="text-align: right;">
      <div style="font-weight:bold;">Subscription cancelled</div>
    </div>
    <div style="text-align: right;">
      <div style="font-weight:bold;">$10.00</div>
      <div style="color:#888; font-size:15px;">per lesson</div>
    </div>
    <div style="display:flex;gap:7px;">
      <button style="background:transparent; border:1.5px solid #ececec; border-radius:8px; padding:7px 9px; margin-right:5px; cursor:pointer;">
        <i class="fas fa-comment" style="font-size:17px;"></i>
      </button>
      <button style="background:#fff; border:2px solid #232323; border-radius:8px; padding:7px 17px; font-weight:bold; cursor:pointer;">
        Resubscribe
      </button>
    </div>
  </div>
</div>

</div>

  <!-- jQuery + Logic -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/my_lessons_details.js"></script>
  <script src="js/my_lessons_tutor_profile_details_send_message.js"></script>


  <?php require_once('my_lesson_details_calendar_cancel.php');?>
  <?php require_once('my_lesson_details_calendar_empty_slot.php');?>
  <?php require_once('my_lesson_details_calendar_show_details.php');?>
  <?php require_once('my_lesson_details_calendar_show_rating.php');?>
  <?php require_once('my_lesson_details_calendar_show_feedback.php');?>

  <?php require_once('../theme/alpha/layout/transfer_lessons.php');?>

  <?php require_once('my_lessons_tutor_profile_details_send_message.php');?>
/\''
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Multi-Step Modal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    #my_lessons_tutors_tab_add_extra_lessons_modal_backdrop {
      display: none;
      position: fixed; z-index: 9998;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.28);
    }
    #my_lessons_tutors_tab_add_extra_lessons_modal {
      display: none;
      position: fixed; z-index: 9999;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      background: #fff;
      width: 420px;
      max-width: 96vw;
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.15);
      padding: 0 0 28px 0;
      font-family: 'Inter', Arial, sans-serif;
    }
    .my_lessons_tutors_tab_add_extra_lessons_header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 22px 0 18px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_header .back-arrow,
    .my_lessons_tutors_tab_add_extra_lessons_header .close-icon {
      font-size: 1.8rem;
      color: #232323;
      cursor: pointer;
      background: none;
      border: none;
      padding: 0 2px;
      line-height: 1;
    }
    .my_lessons_tutors_tab_add_extra_lessons_profile_img {
      width: 54px; height: 54px;
      border-radius: 8px;
      margin: 18px auto 6px auto;
      display: block;
      object-fit: cover;
    }
    .my_lessons_tutors_tab_add_extra_lessons_content {
      text-align: center;
      padding: 0 24px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_title {
      font-size: 1.36rem;
      font-weight: 700;
      margin: 9px 0 7px 0;
      color: #181818;
    }
    .my_lessons_tutors_tab_add_extra_lessons_desc {
      color: #393939;
      font-size: 1.01rem;
      margin-bottom: 30px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_counter_row {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 35px;
      margin: 13px 0 8px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_counter_btn {
      width: 44px; height: 44px;
      border-radius: 10px;
      border: 1.7px solid #d2d2d2;
      background: #fafafa;
      color: #232323;
      font-size: 2.2rem;
      cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: background 0.16s;
    }
    .my_lessons_tutors_tab_add_extra_lessons_counter_btn:active {
      background: #ececec;
    }
    .my_lessons_tutors_tab_add_extra_lessons_counter_number {
      font-size: 2.4rem;
      font-weight: 600;
      min-width: 44px;
      color: #232323;
      text-align: center;
      line-height: 1;
    }
    .my_lessons_tutors_tab_add_extra_lessons_counter_label {
      font-size: 1.02rem;
      color: #7d7d7d;
      margin-bottom: 10px;
      margin-top: -7px;
      letter-spacing: 0.03em;
    }
    .my_lessons_tutors_tab_add_extra_lessons_divider {
      border: none;
      border-top: 1px solid #eee;
      margin: 26px 0 18px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_total {
      font-size: 1.19rem;
      color: #181818;
      margin-bottom: 15px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_continue_btn {
      display: block;
      width: 90%;
      margin: 0 auto;
      background: #fe330a;
      color: #fff;
      font-size: 1.19rem;
      font-weight: 600;
      border: none;
      border-radius: 9px;
      padding: 13px 0;
      cursor: pointer;
      transition: background 0.18s;
      box-shadow: 0 1px 8px rgba(0,0,0,0.03);
    }
    .my_lessons_tutors_tab_add_extra_lessons_continue_btn:active {
      background: #d82700;
    }
    /* Step 2 */
    .my_lessons_tutors_tab_add_extra_lessons_step2 {
      text-align: left;
      padding: 0 28px 30px 28px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step2_title {
      font-size: 1.6rem;
      font-weight: 700;
      margin: 10px 0 16px 0;
      color: #181818;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step2_desc {
      color: #393939;
      font-size: 1.02rem;
      margin-bottom: 24px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step2_option {
      display: flex;
      align-items: flex-start;
      gap: 16px;
      margin-bottom: 22px;
      cursor: pointer;
      transition: background 0.13s;
      border-radius: 8px;
      padding: 9px 4px 9px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step2_option:hover,
    .my_lessons_tutors_tab_add_extra_lessons_step2_option.selected {
      background: #f9f9f9;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step2_icon {
      margin-top: 4px;
      font-size: 1.3rem;
      color: #181818;
      min-width: 26px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step2_option strong {
      font-size: 1.05rem;
      font-weight: 700;
      display: block;
      color: #181818;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step2_option small {
      font-size: 1rem;
      color: #777;
      display: block;
      margin-top: 1px;
    }
    /* Step 3 */
    .my_lessons_tutors_tab_add_extra_lessons_step3 {
      text-align: left;
      padding: 0 28px 30px 28px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_profile_img {
      width: 54px; height: 54px;
      border-radius: 8px; object-fit: cover;
      margin-top: 6px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_title {
      font-size: 1.33rem;
      font-weight: 700;
      color: #181818;
      margin: 16px 0 5px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_title .red {
      color: #fe330a;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_currentplan {
      font-size: 1rem;
      color: #232323;
      margin-bottom: 22px;
      font-weight: 500;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_optionbox {
      border: 2px solid #eee;
      background: #fafbfc;
      border-radius: 12px;
      padding: 16px 17px 13px 17px;
      margin-bottom: 13px;
      cursor: pointer;
      transition: border 0.17s, background 0.15s;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_optionbox.selected {
      border: 2px solid #232323;
      background: #fff;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_optionbox strong {
      font-weight: 700;
      font-size: 1.11rem;
      color: #181818;
      display: block;
      margin-bottom: 2px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_optionbox small {
      font-size: 1.02rem;
      color: #555;
      display: block;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_footer {
      margin-top: 10px;
      font-size: 0.99rem;
      color: #888;
      text-align: center;
      margin-bottom: 12px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_continue_btn {
      display: block;
      width: 100%;
      background: #fe330a;
      color: #fff;
      font-size: 1.15rem;
      font-weight: 600;
      border: none;
      border-radius: 9px;
      padding: 13px 0;
      cursor: pointer;
      margin-top: 10px;
      transition: background 0.18s;
      box-shadow: 0 1px 8px rgba(0,0,0,0.03);
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_continue_btn:active {
      background: #d82700;
    }
    /* Step 4: Custom Plan */
    .my_lessons_tutors_tab_add_extra_lessons_step4 {
      text-align: center;
      padding: 0 28px 30px 28px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_title {
      font-size: 1.36rem;
      font-weight: 700;
      margin: 9px 0 7px 0;
      color: #181818;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_sub {
      font-size: 1.06rem;
      margin-bottom: 24px;
      color: #484848;
      font-weight: 500;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_currentplan {
      font-size: 1rem;
      color: #232323;
      margin-bottom: 18px;
      font-weight: 500;
      text-align: left;
      margin-top: 8px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_counter_row {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 35px;
      margin: 10px 0 0 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_counter_btn {
      width: 44px; height: 44px;
      border-radius: 10px;
      border: 1.7px solid #d2d2d2;
      background: #fafafa;
      color: #232323;
      font-size: 2.2rem;
      cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: background 0.16s;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_counter_btn:active {
      background: #ececec;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_counter_number {
      font-size: 2.4rem;
      font-weight: 600;
      min-width: 44px;
      color: #232323;
      text-align: center;
      line-height: 1;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_counter_label {
      font-size: 1.04rem;
      color: #7d7d7d;
      margin-bottom: 10px;
      margin-top: -7px;
      letter-spacing: 0.03em;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_divider {
      border: none;
      border-top: 1px solid #eee;
      margin: 26px 0 18px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_total {
      font-size: 1.19rem;
      color: #181818;
      margin-bottom: 15px;
      font-weight: 700;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_continue_btn {
      display: block;
      width: 100%;
      background: #fe330a;
      color: #fff;
      font-size: 1.19rem;
      font-weight: 600;
      border: none;
      border-radius: 9px;
      padding: 13px 0;
      cursor: pointer;
      margin-top: 10px;
      transition: background 0.18s;
      box-shadow: 0 1px 8px rgba(0,0,0,0.03);
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_continue_btn:active {
      background: #d82700;
    }
    /* Step 5: Review Changes */
    .my_lessons_tutors_tab_add_extra_lessons_step5 {
      padding: 0 28px 30px 28px;
      text-align: left;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_profile_img {
      width: 54px; height: 54px;
      border-radius: 8px;
      object-fit: cover;
      display: block;
      margin: 18px auto 6px auto;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_title {
      font-size: 1.36rem;
      font-weight: 700;
      color: #181818;
      margin: 16px 0 12px 0;
      text-align: left;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_plan_summary {
      font-size: 1.07rem;
      font-weight: 600;
      margin: 4px 0 0 0;
      color: #232323;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_plan_desc {
      color: #888;
      font-size: 1rem;
      margin-bottom: 2px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_arrow {
      font-size: 1.8rem;
      color: #222;
      text-align: center;
      margin: 4px 0 2px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_divider {
      border: none;
      border-top: 1px solid #eee;
      margin: 16px 0 18px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_when_label {
      font-size: 1.12rem;
      font-weight: 700;
      margin-bottom: 7px;
      margin-top: 2px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_options_group {
      display: flex;
      flex-direction: column;
      gap: 13px;
      margin-bottom: 18px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_option {
      display: flex;
      align-items: flex-start;
      border: 2px solid #ddd;
      border-radius: 12px;
      padding: 16px 14px 13px 14px;
      background: #fafbfc;
      cursor: pointer;
      transition: border 0.18s, background 0.13s;
      gap: 13px;
      position: relative;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_option.selected {
      border: 2px solid #232323;
      background: #fff;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_option_icon {
      font-size: 1.38rem;
      color: #232323;
      margin-right: 10px;
      margin-top: 3px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_option_content {
      flex: 1;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_option_title {
      font-weight: 700;
      font-size: 1.04rem;
      margin-bottom: 3px;
      color: #181818;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_option_sub {
      font-size: 0.99rem;
      color: #767676;
      display: none;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_option_radio {
      font-size: 1.28rem;
      color: #fe330a;
      margin-left: 10px;
      margin-top: 5px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_checkout_btn {
      display: block;
      width: 100%;
      background: #fe330a;
      color: #fff;
      font-size: 1.19rem;
      font-weight: 600;
      border: none;
      border-radius: 9px;
      padding: 13px 0;
      cursor: pointer;
      margin-top: 12px;
      transition: background 0.18s;
      box-shadow: 0 1px 8px rgba(0,0,0,0.03);
      text-align: center;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_checkout_btn:active {
      background: #d82700;
    }
    @media (max-width: 520px) {
      #my_lessons_tutors_tab_add_extra_lessons_modal {
        width: 98vw;
        max-width: 98vw;
        padding-bottom: 20px;
      }
      .my_lessons_tutors_tab_add_extra_lessons_content,
      .my_lessons_tutors_tab_add_extra_lessons_step2,
      .my_lessons_tutors_tab_add_extra_lessons_step3,
      .my_lessons_tutors_tab_add_extra_lessons_step4,
      .my_lessons_tutors_tab_add_extra_lessons_step5 {
        padding: 0 6vw 30px 6vw;
      }
      .my_lessons_tutors_tab_add_extra_lessons_title,
      .my_lessons_tutors_tab_add_extra_lessons_step3_title,
      .my_lessons_tutors_tab_add_extra_lessons_step4_title,
      .my_lessons_tutors_tab_add_extra_lessons_step5_title {
        font-size: 1.05rem;
      }
      .my_lessons_tutors_tab_add_extra_lessons_counter_btn,
      .my_lessons_tutors_tab_add_extra_lessons_step4_counter_btn {
        width: 36px; height: 36px;
        font-size: 1.55rem;
      }
      .my_lessons_tutors_tab_add_extra_lessons_counter_number,
      .my_lessons_tutors_tab_add_extra_lessons_step4_counter_number {
        font-size: 1.4rem;
        min-width: 28px;
      }
      .my_lessons_tutors_tab_add_extra_lessons_profile_img,
      .my_lessons_tutors_tab_add_extra_lessons_step3_profile_img,
      .my_lessons_tutors_tab_add_extra_lessons_step5_profile_img {
        width: 39px; height: 39px;
      }
      .my_lessons_tutors_tab_add_extra_lessons_step2_title {
        font-size: 1.18rem;
      }
    }
  </style>
</head>
<body style="background: #fafbfc">

<!-- Trigger Button (for demo/testing) -->
<button id="my_lessons_tutors_tab_add_extra_lessons_open_modal" style="margin:36px 18px;">Add Extra Lessons</button>

<div id="my_lessons_tutors_tab_add_extra_lessons_modal_backdrop"></div>
<div id="my_lessons_tutors_tab_add_extra_lessons_modal">
  <!-- Step 1: Add Extra Lessons -->
  <div class="my_lessons_tutors_tab_add_extra_lessons_step1" style="display:block;">
    <div class="my_lessons_tutors_tab_add_extra_lessons_header">
      <button class="back-arrow" title="Back" style="visibility:visible;">&#8592;</button>
      <button class="close-icon" title="Close">&times;</button>
    </div>
    <img class="my_lessons_tutors_tab_add_extra_lessons_profile_img" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Tutor Profile"/>
    <div class="my_lessons_tutors_tab_add_extra_lessons_content">
      <div class="my_lessons_tutors_tab_add_extra_lessons_title">Add Extra Lessons With Daniela</div>
      <div class="my_lessons_tutors_tab_add_extra_lessons_desc">
        Buy more lessons without changing your plan. Schedule these lessons before Jan 07.
      </div>
      <div class="my_lessons_tutors_tab_add_extra_lessons_counter_row">
        <button class="my_lessons_tutors_tab_add_extra_lessons_counter_btn" id="my_lessons_tutors_tab_add_extra_lessons_minus">-</button>
        <span class="my_lessons_tutors_tab_add_extra_lessons_counter_number" id="my_lessons_tutors_tab_add_extra_lessons_count">2</span>
        <button class="my_lessons_tutors_tab_add_extra_lessons_counter_btn" id="my_lessons_tutors_tab_add_extra_lessons_plus">+</button>
      </div>
      <div class="my_lessons_tutors_tab_add_extra_lessons_counter_label">extra lessons</div>
      <hr class="my_lessons_tutors_tab_add_extra_lessons_divider"/>
      <div class="my_lessons_tutors_tab_add_extra_lessons_total">Total: $<span id="my_lessons_tutors_tab_add_extra_lessons_total_price">10</span></div>
      <button class="my_lessons_tutors_tab_add_extra_lessons_continue_btn">Continue</button>
    </div>
  </div>
  <!-- Step 2: Upgrade Plan Instead -->
  <div class="my_lessons_tutors_tab_add_extra_lessons_step2" style="display:none;">
    <div class="my_lessons_tutors_tab_add_extra_lessons_header">
      <button class="back-arrow" title="Back">&#8592;</button>
      <button class="close-icon" title="Close">&times;</button>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step2_title">Upgrade Your Plan Instead?</div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step2_desc">
      Get a bigger plan so you don’t have to add extra lessons every cycle.
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step2_option" tabindex="0" data-step="3">
      <span class="my_lessons_tutors_tab_add_extra_lessons_step2_icon">&#10227;</span>
      <span>
        <strong>Yes Upgrade Now</strong>
        <small>Get more lessons every cycle</small>
      </span>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step2_option" tabindex="0" data-step="1">
      <span class="my_lessons_tutors_tab_add_extra_lessons_step2_icon">&#10227;</span>
      <span>
        <strong>Continue adding extra lesson</strong>
        <small>one time change will not affect next cycle</small>
      </span>
    </div>
  </div>
  <!-- Step 3: Plan Upgrade Options -->
  <div class="my_lessons_tutors_tab_add_extra_lessons_step3" style="display:none;">
    <div class="my_lessons_tutors_tab_add_extra_lessons_header">
      <button class="back-arrow" title="Back">&#8592;</button>
      <button class="close-icon" title="Close">&times;</button>
    </div>
    <img class="my_lessons_tutors_tab_add_extra_lessons_step3_profile_img" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Tutor Profile"/>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step3_title">
      Upgrade your plan to <span class="red">improve your English skills faster</span>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step3_currentplan">
      <b>Current plan:</b> 8 lessons &bull; $61.44 every 4 weeks
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step3_optionbox" tabindex="0" data-plan="12">
      <strong>12 lessons</strong>
      <small>$92 every 4 weeks</small>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step3_optionbox" tabindex="0" data-plan="16">
      <strong>16 lessons</strong>
      <small>$123 every 4 weeks</small>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step3_optionbox" tabindex="0" data-plan="custom">
      <strong>Custom plans</strong>
      <small>Choose the right number of lessons for you</small>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step3_footer">
      Prices are for our standard lesson time of 50 min
    </div>
    <button class="my_lessons_tutors_tab_add_extra_lessons_step3_continue_btn" disabled>Continue</button>
  </div>
  <!-- Step 4: Custom Plan -->
  <div class="my_lessons_tutors_tab_add_extra_lessons_step4" style="display:none;">
    <div class="my_lessons_tutors_tab_add_extra_lessons_header">
      <button class="back-arrow" title="Back">&#8592;</button>
      <button class="close-icon" title="Close">&times;</button>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step4_title">Create A Plan That Works Best For You</div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step4_currentplan">
      <b>Current plan:</b> 8 lessons &bull; $61.44 every 4 weeks
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step4_counter_row">
      <button class="my_lessons_tutors_tab_add_extra_lessons_step4_counter_btn" id="my_lessons_tutors_tab_add_extra_lessons_step4_minus">-</button>
      <span class="my_lessons_tutors_tab_add_extra_lessons_step4_counter_number" id="my_lessons_tutors_tab_add_extra_lessons_step4_count">9</span>
      <button class="my_lessons_tutors_tab_add_extra_lessons_step4_counter_btn" id="my_lessons_tutors_tab_add_extra_lessons_step4_plus">+</button>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step4_counter_label">lessons every 4 week</div>
    <hr class="my_lessons_tutors_tab_add_extra_lessons_step4_divider"/>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step4_total">
      $<span id="my_lessons_tutors_tab_add_extra_lessons_step4_total_price">72</span> every 4 weeks
    </div>
    <button class="my_lessons_tutors_tab_add_extra_lessons_step4_continue_btn">Continue</button>
  </div>
  <!-- Step 5: Review Your Changes -->
  <div class="my_lessons_tutors_tab_add_extra_lessons_step5" style="display:none;">
    <div class="my_lessons_tutors_tab_add_extra_lessons_header">
      <button class="back-arrow" title="Back">&#8592;</button>
      <button class="close-icon" title="Close">&times;</button>
    </div>
    <img class="my_lessons_tutors_tab_add_extra_lessons_step5_profile_img" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Tutor Profile"/>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_title">Review Your Changes</div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_plan_summary">
      2 lessons per week
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_plan_desc">
      8 lessons &bull; $61 every 4 weeks
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_arrow">&#8595;</div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_plan_summary">
      3 lessons per week
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_plan_desc">
      12 lessons &bull; $92 every 4 weeks
    </div>
    <hr class="my_lessons_tutors_tab_add_extra_lessons_step5_divider"/>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_when_label">
      When do you want to upgrade?
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_options_group">
      <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option selected" data-value="now">
        <span class="my_lessons_tutors_tab_add_extra_lessons_step5_option_icon">&#128197;</span>
        <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option_content">
          <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option_title">Now</div>
          <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option_sub" id="now_detail" style="display:block;">
            Start your new plan and make a payment today. Schedule all your remaining lessons from the current plan before Apr 07.
          </div>
        </div>
        <span class="my_lessons_tutors_tab_add_extra_lessons_step5_option_radio">&#9679;</span>
      </div>
      <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option" data-value="next_billing">
        <span class="my_lessons_tutors_tab_add_extra_lessons_step5_option_icon">&#128181;</span>
        <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option_content">
          <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option_title">
            On your next billing date, Mar 18
          </div>
          <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option_sub" id="next_billing_detail">
            Your total is $100 and includes a $11 processing fee.<br>
            We’ll renew your plan automatically using your saved payment method.
          </div>
        </div>
        <span class="my_lessons_tutors_tab_add_extra_lessons_step5_option_radio">&#9675;</span>
      </div>
    </div>
    <button class="my_lessons_tutors_tab_add_extra_lessons_step5_checkout_btn">Continue to checkout</button>
  </div>
</div>

<script>
$(function(){
  // Step 1: add extra lessons
  var pricePerLesson = 5;
  var minLessons = 1;
  var maxLessons = 10;
  var lessonCount = 2;

  // Step 4: custom plan
  var customPlanMin = 1;
  var customPlanMax = 30;
  var customPlanLessonCount = 9;
  var customPlanPricePerLesson = 8;
  function updateModal() {
    $('#my_lessons_tutors_tab_add_extra_lessons_count').text(lessonCount);
    $('#my_lessons_tutors_tab_add_extra_lessons_total_price').text(lessonCount * pricePerLesson);
    $('#my_lessons_tutors_tab_add_extra_lessons_minus').prop('disabled', lessonCount <= minLessons);
    $('#my_lessons_tutors_tab_add_extra_lessons_plus').prop('disabled', lessonCount >= maxLessons);
  }
  function updateCustomPlan() {
    $('#my_lessons_tutors_tab_add_extra_lessons_step4_count').text(customPlanLessonCount);
    $('#my_lessons_tutors_tab_add_extra_lessons_step4_total_price').text(customPlanLessonCount * customPlanPricePerLesson);
    $('#my_lessons_tutors_tab_add_extra_lessons_step4_minus').prop('disabled', customPlanLessonCount <= customPlanMin);
    $('#my_lessons_tutors_tab_add_extra_lessons_step4_plus').prop('disabled', customPlanLessonCount >= customPlanMax);
  }
  function showStep(stepNum) {
    $('.my_lessons_tutors_tab_add_extra_lessons_step1').hide();
    $('.my_lessons_tutors_tab_add_extra_lessons_step2').hide();
    $('.my_lessons_tutors_tab_add_extra_lessons_step3').hide();
    $('.my_lessons_tutors_tab_add_extra_lessons_step4').hide();
    $('.my_lessons_tutors_tab_add_extra_lessons_step5').hide();
    if(stepNum == 1) $('.my_lessons_tutors_tab_add_extra_lessons_step1').fadeIn(120);
    if(stepNum == 2) $('.my_lessons_tutors_tab_add_extra_lessons_step2').fadeIn(120);
    if(stepNum == 3) $('.my_lessons_tutors_tab_add_extra_lessons_step3').fadeIn(120);
    if(stepNum == 4) $('.my_lessons_tutors_tab_add_extra_lessons_step4').fadeIn(120);
    if(stepNum == 5) $('.my_lessons_tutors_tab_add_extra_lessons_step5').fadeIn(120);
  }

  $('#my_lessons_tutors_tab_add_extra_lessons_open_modal').on('click', function(){
    $('#my_lessons_tutors_tab_add_extra_lessons_modal_backdrop').fadeIn(140);
    $('#my_lessons_tutors_tab_add_extra_lessons_modal').fadeIn(180);
    showStep(1);
    updateModal();
    // Reset step 3
    $('.my_lessons_tutors_tab_add_extra_lessons_step3_optionbox').removeClass('selected');
    $('.my_lessons_tutors_tab_add_extra_lessons_step3_continue_btn').prop('disabled', true);
    // Reset custom plan
    customPlanLessonCount = 9;
    updateCustomPlan();
    // Reset step 5
    $('.my_lessons_tutors_tab_add_extra_lessons_step5_option').removeClass('selected');
    $('.my_lessons_tutors_tab_add_extra_lessons_step5_option[data-value="now"]').addClass('selected');
    updateStep5Radios();
  });
  function closeModal() {
    $('#my_lessons_tutors_tab_add_extra_lessons_modal').fadeOut(120);
    $('#my_lessons_tutors_tab_add_extra_lessons_modal_backdrop').fadeOut(100);
  }
  $('.my_lessons_tutors_tab_add_extra_lessons_header .close-icon').on('click', closeModal);
  $('#my_lessons_tutors_tab_add_extra_lessons_modal_backdrop').on('click', closeModal);

  // Step 1 Back: closes modal
  $('.my_lessons_tutors_tab_add_extra_lessons_step1 .back-arrow').on('click', closeModal);
  // Step 2 Back: returns to step 1
  $('.my_lessons_tutors_tab_add_extra_lessons_step2 .back-arrow').on('click', function(){
    showStep(1);
  });
  // Step 3 Back: returns to step 2
  $('.my_lessons_tutors_tab_add_extra_lessons_step3 .back-arrow').on('click', function(){
    showStep(2);
  });
  // Step 4 Back: returns to step 3
  $('.my_lessons_tutors_tab_add_extra_lessons_step4 .back-arrow').on('click', function(){
    showStep(3);
  });
  // Step 5 Back: returns to step 3 or 4 (optional, you may want to add logic for custom plan review)
  $('.my_lessons_tutors_tab_add_extra_lessons_step5 .back-arrow').on('click', function(){
    showStep(3); // Or 4, if coming from custom
  });

  // Step 1: Plus/minus handlers
  $('#my_lessons_tutors_tab_add_extra_lessons_plus').on('click', function(){
    if(lessonCount < maxLessons) {
      lessonCount++;
      updateModal();
    }
  });
  $('#my_lessons_tutors_tab_add_extra_lessons_minus').on('click', function(){
    if(lessonCount > minLessons) {
      lessonCount--;
      updateModal();
    }
  });
  // Step 1: Continue -> Step 2
  $('.my_lessons_tutors_tab_add_extra_lessons_continue_btn').on('click', function(){
    showStep(2);
  });
  // Step 2: Option click
  $('.my_lessons_tutors_tab_add_extra_lessons_step2_option').on('click', function(){
    var goToStep = $(this).attr('data-step');
    showStep(Number(goToStep));
    if(goToStep == "3") {
      // Reset plan selection in step 3
      $('.my_lessons_tutors_tab_add_extra_lessons_step3_optionbox').removeClass('selected');
      $('.my_lessons_tutors_tab_add_extra_lessons_step3_continue_btn').prop('disabled', true);
    }
  });
  // Step 3: Plan select
  $('.my_lessons_tutors_tab_add_extra_lessons_step3_optionbox').on('click', function(){
    $('.my_lessons_tutors_tab_add_extra_lessons_step3_optionbox').removeClass('selected');
    $(this).addClass('selected');
    $('.my_lessons_tutors_tab_add_extra_lessons_step3_continue_btn').prop('disabled', false);
  });
  // Step 3: Continue (handle selection)
  $('.my_lessons_tutors_tab_add_extra_lessons_step3_continue_btn').on('click', function(){
    var selectedPlan = $('.my_lessons_tutors_tab_add_extra_lessons_step3_optionbox.selected').attr('data-plan');
    if(selectedPlan === 'custom') {
      showStep(4);
    } else {
      showStep(5);
    }
  });
  // Step 4: Custom plan plus/minus
  $('#my_lessons_tutors_tab_add_extra_lessons_step4_plus').on('click', function(){
    if(customPlanLessonCount < customPlanMax) {
      customPlanLessonCount++;
      updateCustomPlan();
    }
  });
  $('#my_lessons_tutors_tab_add_extra_lessons_step4_minus').on('click', function(){
    if(customPlanLessonCount > customPlanMin) {
      customPlanLessonCount--;
      updateCustomPlan();
    }
  });
  // Step 4: Continue
  $('.my_lessons_tutors_tab_add_extra_lessons_step4_continue_btn').on('click', function(){
    showStep(5);
  });
  // Step 5: Review Your Changes: radio selection logic
  function updateStep5Radios() {
    // update radio visuals
    $('.my_lessons_tutors_tab_add_extra_lessons_step5_option').each(function(){
      var radio = $(this).find('.my_lessons_tutors_tab_add_extra_lessons_step5_option_radio');
      if($(this).hasClass('selected')) {
        radio.html('&#9679;'); // filled radio
      } else {
        radio.html('&#9675;'); // empty radio
      }
    });

    // show/hide details under each option, button text
    if ($('.my_lessons_tutors_tab_add_extra_lessons_step5_option[data-value="now"]').hasClass('selected')) {
      $('#now_detail').show();
      $('#next_billing_detail').hide();
      $('.my_lessons_tutors_tab_add_extra_lessons_step5_checkout_btn').text('Continue to checkout');
    } else {
      $('#now_detail').hide();
      $('#next_billing_detail').show();
      $('.my_lessons_tutors_tab_add_extra_lessons_step5_checkout_btn').text('Confirm');
    }
  }
  $('.my_lessons_tutors_tab_add_extra_lessons_step5_option').on('click', function(){
    $('.my_lessons_tutors_tab_add_extra_lessons_step5_option').removeClass('selected');
    $(this).addClass('selected');
    updateStep5Radios();
  });
  // Step 5: Checkout button
  $('.my_lessons_tutors_tab_add_extra_lessons_step5_checkout_btn').on('click', function(){
    var selectedOption = $('.my_lessons_tutors_tab_add_extra_lessons_step5_option.selected').attr('data-value');
    alert('Proceeding to checkout. Upgrade timing: ' + (selectedOption === 'now' ? 'Now' : 'Next Billing Date'));
    closeModal();
  });

  // Initial state
  updateModal();
  updateCustomPlan();
  updateStep5Radios();
});
</script>
</body>
</html>

























