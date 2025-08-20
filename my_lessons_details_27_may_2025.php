
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>My Lessons</title>
  <!-- Font Awesome -->

  <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
      integrity="sha512-dyZtQ4My9Yf+LJTyPNunwVj1C1jO6qKcJ5lmz7Qcf5GX1wS7qy7qkZULD0f+WJy1rO7cDzr9hwK94PGe9R2L9g=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"/>
    
  <link rel="stylesheet"  href="css/my_lesson_details.css"/>

  <div id="my_lessons_container">
    <!-- Header + Actions -->
    <h1 class="my_lessons_header">My Lessons</h1>
    <div class="my_lessons_actions">
      <button id="my_lessons_transfer_btn" class="my_lessons_btn_outline">
        Transfer lessons or subscription
      </button>
      <div class="my_lessons_schedule_dropdown">
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
          <button class="my_lessons_today_btn my_lessons_btn_outline">Today</button>
          <button class="my_lessons_nav_btn my_lessons_btn_outline">
            <i class="fas fa-chevron-left"></i>
          </button>
          <button class="my_lessons_nav_btn my_lessons_btn_outline">
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
            <th>Mon 2</th><th>Tue 3</th><th>Wed 4</th><th>Thu 5</th>
            <th>Fri 6</th><th>Sat 7</th><th>Sun 8</th>
          </tr>
        </thead>
        <tbody>
          <tr><th>6:00</th><td colspan="7"></td></tr>
          <tr>
            <th>7:00</th><td></td><td></td><td></td>
            <td>
              <div class="my_lessons_calendar_event my_lessons_event_weekly">
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
                <i class="fas fa-calendar-alt my_lessons_event_icon"></i>
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
            <td colspan="5"></td>
          </tr>
          <tr><th>9:00</th><td colspan="7"></td></tr>
          <tr>
            <th>10:00</th>
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
            <td colspan="2"></td>
          </tr>
          <tr><th>11:00</th><td colspan="7"></td></tr>
        </tbody>
      </table>
    </div>

    <!-- Tutors Tab -->
    <div id="my_lessons_tab_tutors" class="my_lessons_tab_content">
      <!-- Display-only -->
      <div class="my_lessons_card">
        <div class="my_lessons_profile_section">
          <img
            class="my_lessons_avatar"
            src="https://randomuser.me/api/portraits/women/4.jpg"
            alt="Daniela"
          />
          <div class="my_lessons_profile_info">
            <a href="#" class="my_lessons_name">Daniela</a>
            <div class="my_lessons_subtitle">English</div>
          </div>
        </div>
        <div class="my_lessons_lessons_section">
          <div class="my_lessons_lessons_count">
            11 lessons
            <span class="my_lessons_lessons_text">to schedule</span>
            <i class="fas fa-sync-alt my_lessons_sync_icon"></i>
          </div>
        </div>
        <div class="my_lessons_price_section">
          <div class="my_lessons_price">
            $5.40
            <span class="my_lessons_price_text">per lesson</span>
          </div>
        </div>
      </div>

      <!-- ... other tutors cards ... -->
    </div>
  </div>

  <!-- jQuery + Logic -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/my_lessons_details.js"></script>



<!-- 3) Overlay -->
<div id="my_lesson_details_cancel_overlay"
     class="my_lesson_details_cancel__overlay"></div>

<!-- 4) Modal container -->
<div id="my_lesson_details_cancel_modal"
     class="my_lesson_details_cancel__modal">

  <!-- Step 1: Cancel Lesson -->
  <div class="modal-step my_lesson_details_cancel__step1" data-step="1">
    <div class="my_lesson_details_cancel__header">
      <button type="button"
              class="my_lesson_details_cancel__back"
              aria-label="Go Back">←
      </button>
      <button type="button"
              class="my_lesson_details_cancel__close"
              aria-label="Close">×
      </button>
    </div>
    <div class="my_lesson_details_cancel__body">
      <div class="my_lesson_details_cancel__avatar">
        <img src="https://via.placeholder.com/48" alt="Teacher Avatar">
      </div>
      <h2 class="my_lesson_details_cancel__title">Cancel Lesson</h2>
      <p class="my_lesson_details_cancel__date">
        Wednesday, November 20, 07:00–08:50 PM
      </p>

      <div class="my_lesson_details_cancel__form-group">
        <label for="my_lesson_details_cancel_reason">
          Please choose a reason for cancel lesson
        </label>
        <div class="my_lesson_details_cancel__select-wrapper">
          <select id="my_lesson_details_cancel_reason"
                  class="my_lesson_details_cancel__select">
            <option value="" disabled selected>Select Reason</option>
            <option value="sick">I’m sick</option>
            <option value="emergency">Family emergency</option>
            <option value="other">Other</option>
          </select>
          <span class="my_lesson_details_cancel__select-arrow">▾</span>
        </div>
      </div>

      <div class="my_lesson_details_cancel__form-group">
        <label for="my_lesson_details_cancel_message">
          Message for Daniela • Optional
        </label>
        <textarea id="my_lesson_details_cancel_message"
                  class="my_lesson_details_cancel__textarea"
                  placeholder="Message for Daniela"></textarea>
      </div>
    </div>

    <div class="my_lesson_details_cancel__actions">
      <button type="button"
              class="my_lesson_details_cancel__btn my_lesson_details_cancel__btn--outline">
        Reschedule instead
      </button>
      <button type="button"
              class="my_lesson_details_cancel__btn my_lesson_details_cancel__btn--danger">
        Confirm Cancel
      </button>
    </div>
  </div>

  <!-- Future steps (e.g. step2, step3…) go here, each with class="modal-step" -->
</div>

<!-- 5) Styles (same as before) -->
<style>
  .my_lesson_details_cancel__overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.4); z-index: 999;
  }
  .my_lesson_details_cancel__modal {
    display: none; position: fixed; top:50%; left:50%;
    width:90%; max-width:500px;
    background:#fff; border-radius:8px;
    transform:translate(-50%,-50%);
    z-index:1000;
    box-shadow:0 8px 24px rgba(0,0,0,0.2);
    overflow:hidden; font-family:sans-serif;
  }
  .my_lesson_details_cancel__header {
    display:flex; justify-content:space-between;
    align-items:center; padding:12px 16px;
    border-bottom:1px solid #eee;
  }
  .my_lesson_details_cancel__back,
  .my_lesson_details_cancel__close {
    background:none; border:none; font-size:20px;
    cursor:pointer;
  }
  .my_lesson_details_cancel__body { padding:16px; }
  .my_lesson_details_cancel__avatar img {
    width:48px; height:48px; border-radius:50%;
    object-fit:cover;
  }
  .my_lesson_details_cancel__title {
    margin:12px 0 4px; font-size:1.5rem;
  }
  .my_lesson_details_cancel__date {
    color:#666; font-size:0.9rem; margin-bottom:16px;
  }
  .my_lesson_details_cancel__form-group {
    margin-bottom:16px;
  }
  .my_lesson_details_cancel__form-group label {
    display:block; margin-bottom:4px;
    font-weight:500; font-size:0.9rem;
  }
  .my_lesson_details_cancel__select-wrapper {
    position:relative;
  }
  .my_lesson_details_cancel__select {
    width:100%;
    padding:10px 36px 10px 12px;
    font-size:1rem;
    border:1px solid #ccc;
    border-radius:6px;
    appearance:none;
    background:#fff;
  }
  .my_lesson_details_cancel__select-arrow {
    position:absolute; right:12px;
    top:50%; transform:translateY(-50%);
    pointer-events:none;
  }
  .my_lesson_details_cancel__textarea {
    width:100%; min-height:80px;
    padding:10px 12px; font-size:1rem;
    border:1px solid #ccc; border-radius:6px;
    resize:vertical;
  }
  .my_lesson_details_cancel__actions {
    display:flex; justify-content:space-between;
    padding:16px; border-top:1px solid #eee;
  }
  .my_lesson_details_cancel__btn {
    flex:1; padding:10px 0; font-size:1rem;
    border-radius:6px; cursor:pointer;
    border:1px solid transparent; margin:0 4px;
  }
  .my_lesson_details_cancel__btn--outline {
    background:#fff; color:#000; border-color:#000;
  }
  .my_lesson_details_cancel__btn--danger {
    background:#ff3b30; color:#fff; border-color:#ff3b30;
  }
</style>

<!-- 6) jQuery to open Step 1 only -->
<script>
  $(function(){
    // Open modal & show Step 1
    $('.my_lesson_details_cancel__open').on('click', function(e){
      e.preventDefault();
      $('#my_lesson_details_cancel_overlay, #my_lesson_details_cancel_modal').fadeIn(200);
      // hide all steps, then show step1
      $('#my_lesson_details_cancel_modal .modal-step').hide();
      $('#my_lesson_details_cancel_modal .my_lesson_details_cancel__step1').show();
    });

    // Close modal (back, X or overlay)
    $('#my_lesson_details_cancel_overlay, .my_lesson_details_cancel__close, .my_lesson_details_cancel__back')
      .on('click', function(){
        $('#my_lesson_details_cancel_overlay, #my_lesson_details_cancel_modal').fadeOut(200);
      });
  });
</script>
