<?php
// my_lessons_details_reshedule.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reschedule lesson</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      margin: 0;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      background: #f8f9fb;
    }
    /* Header */
    #my_lessons_details_reshedule_header {
      display: flex;
      align-items: center;
      padding: 16px 32px;
      background: #fff;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    #my_lessons_details_reshedule_header img {
      height: 32px;
      margin-right: 12px;
    }
    #my_lessons_details_reshedule_header h1 {
      font-size: 24px;
      margin: 0;
    }

    /* Main layout */
    #my_lessons_details_reshedule_main {
      display: flex;
      padding: 24px 32px;
      gap: 32px;
    }

    /* Calendar section */
    #my_lessons_details_reshedule_calendar {
      flex: 2;
      background: #fff;
      border-radius: 10px;
      padding: 24px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    #my_lessons_details_reshedule_date_range {
      font-size: 20px;
      font-weight: 600;
      text-align: center;
      margin-bottom: 16px;
    }
    .my_lessons_details_reshedule_nav {
      display: flex;
      justify-content: center;
      gap: 8px;
      margin-bottom: 24px;
    }
    .my_lessons_details_reshedule_nav button {
      width: 40px;
      height: 32px;
      border: 1px solid #ccc;
      border-radius: 6px;
      background: #fff;
      cursor: pointer;
      font-size: 18px;
    }
    /* Days row */
    #my_lessons_details_reshedule_days {
      display: flex;
      justify-content: space-around;
      border-bottom: 1px solid #e4e4e4;
      padding-bottom: 8px;
      margin-bottom: 8px;
      font-size: 16px;
      font-weight: 500;
    }
    
    #my_lessons_details_reshedule_days .day {
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
    }
    #my_lessons_details_reshedule_days .day.active {
      background: #ffe4e6;
      color: #ff3b30;
    }
    /* Timezone note */
    #my_lessons_details_reshedule_timezone {
      font-size: 12px;
      color: #666;
      text-align: center;
      margin-bottom: 16px;
    }
    /* Slots */
    #my_lessons_details_reshedule_slots {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      justify-content: center;
    }
    #my_lessons_details_reshedule_slots .slot {
      min-width: 80px;
      padding: 8px;
      text-align: center;
      border: 1px solid #d7d7e0;
      border-radius: 8px;
      background: #fff;
      cursor: pointer;
      font-size: 14px;
      color: #333;
    }
    #my_lessons_details_reshedule_slots .slot.selected {
      background: #000;
      color: #fff;
      border-color: #000;
    }
    #my_lessons_details_reshedule_slots .slot.disabled {
      background: #f1f1f1;
      color: #999;
      border-color: #f1f1f1;
      cursor: not-allowed;
      /* for tooltip trigger */
      position: relative;
    }

    /* Tooltip for disabled slots */
    .my_lessons_details_reshedule_tooltip {
      position: absolute;
      background: #111;
      color: #fff;
      padding: 8px 12px;
      border-radius: 8px;
      font-size: 14px;
      text-align: center;
      max-width: 200px;
      z-index: 30;
    }
    .my_lessons_details_reshedule_tooltip::after {
      content: "";
      position: absolute;
      bottom: -6px;
      left: 50%;
      transform: translateX(-50%);
      border-width: 6px;
      border-style: solid;
      border-color: #111 transparent transparent transparent;
    }
    .my_lessons_details_reshedule_tooltip .title {
      font-weight: 600;
      margin-bottom: 4px;
    }
    .my_lessons_details_reshedule_tooltip .subtitle {
      font-size: 13px;
      color: #ccc;
    }

    /* Details panel */
    #my_lessons_details_reshedule_panel {
      flex: 1;
      position: relative;
      background: #fff;
      border-radius: 10px;
      padding: 24px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    #my_lessons_details_reshedule_close {
      position: absolute;
      top: 16px;
      right: 16px;
      font-size: 20px;
      cursor: pointer;
      color: #666;
    }
    #my_lessons_details_reshedule_tutor {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 16px;
    }
    #my_lessons_details_reshedule_tutor img {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      object-fit: cover;
    }
    #my_lessons_details_reshedule_tutor_info {
      flex: 1;
    }
    #my_lessons_details_reshedule_tutor_info h2 {
      margin: 0;
      font-size: 18px;
      line-height: 1.2;
    }
    #my_lessons_details_reshedule_duration {
      margin-top: 6px;
      font-size: 14px;
      color: #555;
      text-decoration: underline;
      cursor: pointer;
    }

    /* Current and new time */
    #my_lessons_details_reshedule_current,
    #my_lessons_details_reshedule_new {
      margin-top: 16px;
    }
    #my_lessons_details_reshedule_current label,
    #my_lessons_details_reshedule_new label {
      display: block;
      font-size: 14px;
      color: #333;
      margin-bottom: 4px;
    }
    .my_lessons_details_reshedule_input_container {
      position: relative;
      margin-top: 4px;
    }
    #my_lessons_details_reshedule_new_time {
      width: 100%;
      padding: 10px 32px 10px 12px;
      border: 1px solid #000;
      border-radius: 8px;
      font-size: 14px;
      color: #333;
      background: #fff;
      box-sizing: border-box;
    }
    #my_lessons_details_reshedule_clear {
      position: absolute;
      right: 8px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 16px;
      color: #666;
      cursor: pointer;
      display: none;
    }

    /* Reschedule button */
    #my_lessons_details_reshedule_reschedule_btn {
      margin-top: 24px;
      width: 100%;
      padding: 12px;
      font-size: 16px;
      font-weight: 600;
      background: #ccc;
      color: #fff;
      border: none;
      border-radius: 8px;
      cursor: not-allowed;
    }
    #my_lessons_details_reshedule_reschedule_btn.enabled {
      background: #ff3b30;
      cursor: pointer;
    }
    #my_lessons_details_reshedule_notice {
      margin-top: 12px;
      font-size: 12px;
      color: #666;
      text-align: center;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header id="my_lessons_details_reshedule_header">
    <img src="logo.png" alt="LATINGLES Logo" />
    <h1>Reschedule lesson</h1>
  </header>

  <!-- Main content -->
  <div id="my_lessons_details_reshedule_main">
    <!-- Left: calendar -->
    <section id="my_lessons_details_reshedule_calendar">
      <div id="my_lessons_details_reshedule_date_range">
        Feb&nbsp;16&nbsp;–&nbsp;22,&nbsp;2025
      </div>
      <div class="my_lessons_details_reshedule_nav">
        <button id="my_lessons_details_reshedule_prev">&lt;</button>
        <button id="my_lessons_details_reshedule_next">&gt;</button>
      </div>
      <ul id="my_lessons_details_reshedule_days">
        <li class="day active" data-day="16">Sun 16</li>
        <li class="day" data-day="17">Mon 17</li>
        <li class="day" data-day="18">Tue 18</li>
        <li class="day" data-day="19">Wed 19</li>
        <li class="day" data-day="20">Thu 20</li>
        <li class="day" data-day="21">Fri 21</li>
        <li class="day" data-day="22">Sat 22</li>
      </ul>
      <div id="my_lessons_details_reshedule_timezone">
        In your time zone: America/New_York (GMT −5:00)
      </div>
      <div id="my_lessons_details_reshedule_slots">
        <button class="slot" data-time="03:00">03:00</button>
        <button class="slot disabled"
                data-time="07:00"
                data-tooltip-title="Your Lesson With Daniela"
                data-tooltip-subtitle="Saturday, Feb 22, 7:00 – 7:25 PM"
                disabled>07:00</button>
        <button class="slot" data-time="05:00">05:00</button>
        <button class="slot" data-time="05:30">05:30</button>
        <button class="slot" data-time="06:00">06:00</button>
        <button class="slot" data-time="06:30">06:30</button>
        <button class="slot" data-time="07:30">07:30</button>
      </div>
    </section>

    <!-- Right: details panel -->
    <aside id="my_lessons_details_reshedule_panel">
      <div id="my_lessons_details_reshedule_close">&times;</div>

      <div id="my_lessons_details_reshedule_tutor">
        <img src="https://randomuser.me/api/portraits/women/4.jpg" alt="Daniela" />
        <div id="my_lessons_details_reshedule_tutor_info">
          <h2>English with Daniela</h2>
          <div id="my_lessons_details_reshedule_duration">50 min lessons&nbsp;▼</div>
        </div>
      </div>

      <div id="my_lessons_details_reshedule_current">
        <label>Current lesson time</label>
        <div class="value">Wed, Feb 19, 12:00 – 12:50</div>
      </div>

      <div id="my_lessons_details_reshedule_new">
        <label>New lesson time</label>
        <div class="my_lessons_details_reshedule_input_container">
          <input
            type="text"
            id="my_lessons_details_reshedule_new_time"
            placeholder="Select a time slot above"
            readonly
          />
          <span id="my_lessons_details_reshedule_clear">&times;</span>
        </div>
      </div>

      <button
        id="my_lessons_details_reshedule_reschedule_btn"
      >Reschedule</button>
      <div id="my_lessons_details_reshedule_notice">
        Cancel or reschedule for free up to 12 hrs before the lesson starts.
      </div>
    </aside>
  </div>

  <script>
    $(function(){
      // Close panel
      $('#my_lessons_details_reshedule_close').click(function(){
        window.history.back();
      });

      // Day select
      $('#my_lessons_details_reshedule_days .day').click(function(){
        $('#my_lessons_details_reshedule_days .day').removeClass('active');
        $(this).addClass('active');
      });

      // Slot click
      $('#my_lessons_details_reshedule_slots .slot:not(.disabled)').click(function(){
        $('#my_lessons_details_reshedule_slots .slot').removeClass('selected');
        $(this).addClass('selected');
        var dayText = $('#my_lessons_details_reshedule_days .day.active').text();
        var time = $(this).data('time');
        var end = (function(){
          var p = time.split(':'),
              h = parseInt(p[0]), m = parseInt(p[1]) + 50;
          if(m >= 60){ h++; m-=60; }
          return (h<10?'0'+h:h) + ':' + (m<10?'0'+m:m);
        })();
        $('#my_lessons_details_reshedule_new_time')
          .val(dayText + ', ' + time + '–' + end)
          .css('border','1px solid #000');
        $('#my_lessons_details_reshedule_clear').show();
        $('#my_lessons_details_reshedule_reschedule_btn')
          .addClass('enabled')
          .css({ 'cursor':'pointer','background':'#ff3b30' });
      });

      // Clear new time
      $('#my_lessons_details_reshedule_clear').click(function(){
        $('#my_lessons_details_reshedule_new_time').val('').css('border','1px dashed #ccc');
        $(this).hide();
        $('#my_lessons_details_reshedule_slots .slot').removeClass('selected');
        $('#my_lessons_details_reshedule_reschedule_btn')
          .removeClass('enabled')
          .css({ 'cursor':'not-allowed','background':'#ccc' });
      });

      // Tooltip on disabled slots
      $('#my_lessons_details_reshedule_slots').on('mouseenter',' .slot.disabled', function(){
        var $btn = $(this);
        var title = $btn.data('tooltip-title');
        var sub = $btn.data('tooltip-subtitle');
        var $tip = $('<div class="my_lessons_details_reshedule_tooltip"><div class="title">'+title+'</div><div class="subtitle">'+sub+'</div></div>');
        $('body').append($tip);
        var off = $btn.offset(),
            w = $btn.outerWidth(),
            th = $tip.outerHeight(),
            tw = $tip.outerWidth();
        $tip.css({
          left: off.left + w/2 - tw/2,
          top: off.top - th - 8
        });
        $btn.data('tooltipEl',$tip);
      }).on('mouseleave',' .slot.disabled', function(){
        var $tip = $(this).data('tooltipEl');
        if($tip) $tip.remove();
      });

      // Prev/Next stub
      $('#my_lessons_details_reshedule_prev, #my_lessons_details_reshedule_next').click(function(){
        alert('Week navigation not implemented yet.');
      });

      // Reschedule button
      $('#my_lessons_details_reshedule_reschedule_btn').click(function(){
        if(!$(this).hasClass('enabled')) return;
        var newTime = $('#my_lessons_details_reshedule_new_time').val();
        alert('Rescheduling to ' + newTime);
        // TODO: send to server
      });
    });
  </script>
</body>
</html>
