

<link rel="stylesheet" href="css/explore_tutors_details.css">

<div class="filters">
  <!-- 1: Class taught in -->
  <div class="filter">
    <div class="filter-button">
      <span class="label">Class taught in</span>
      <div class="selection">
        <span class="value">English &amp; Spanish</span>
        <span class="icon">▾</span>
      </div>
    </div>
    <div class="dropdown_filters">
      <div class="search-wrapper">
        <input type="text" placeholder="Type to search..." />
        <span class="search-icon">🔍</span>
      </div>
      <ul>
        <li class="section-label">Popular</li>
        <li class="item">
          <span>English &amp; Spanish</span>
          <span class="checkbox selected"></span>
        </li>
        <li class="item">
          <span>English (only)</span>
          <span class="checkbox"></span>
        </li>
        <li class="item">
          <span>Spanish (only)</span>
          <span class="checkbox"></span>
        </li>
      </ul>
    </div>
  </div>

  <!-- 2: English Level -->
  <div class="filter">
    <div class="filter-button">
      <span class="label">English Level</span>
      <div class="selection">
        <span class="value">Basic</span>
        <span class="icon">▾</span>
      </div>
    </div>
    <div class="dropdown_filters">
      <ul>
        <li class="item">Basic</li>
        <li class="item">Beginner</li>
        <li class="item">Elementary</li>
        <li class="item">Intermediate</li>
        <li class="item">Upper Intermediate</li>
        <li class="item">Advanced</li>
      </ul>
    </div>
  </div>

  <!-- 3: Availability -->
  <div class="filter">
    <div class="filter-button">
      <span class="label">I'm available</span>
      <div class="selection">
        <span class="value">Anytime</span>
        <span class="icon">▾</span>
      </div>
    </div>
    <div class="dropdown_filters">
      <li class="section-label">Times</li>
      <div class="segment-group">
        <div class="segment-label">Daytime</div>
        <div class="segment-options">
          <div class="time-option"><span>🌅</span>9–12</div>
          <div class="time-option"><span>☀️</span>12–15</div>
          <div class="time-option"><span>🌤️</span>15–18</div>
        </div>
      </div>
      <div class="segment-group">
        <div class="segment-label">Evening & night</div>
        <div class="segment-options">
          <div class="time-option"><span>🌇</span>18–21</div>
          <div class="time-option"><span>🌙</span>21–24</div>
          <div class="time-option"><span>🌑</span>0–3</div>
        </div>
      </div>
      <div class="segment-group">
        <div class="segment-label">Morning</div>
        <div class="segment-options">
          <div class="time-option"><span>🌙</span>3–6</div>
          <div class="time-option"><span>🌅</span>6–9</div>
        </div>
      </div>
      <li class="section-label">Days</li>
      <div class="day-options">
        <div class="day-option">Sun</div>
        <div class="day-option">Mon</div>
        <div class="day-option">Tue</div>
        <div class="day-option">Wed</div>
        <div class="day-option">Thu</div>
        <div class="day-option">Fri</div>
        <div class="day-option">Sat</div>
      </div>
    </div>
  </div>

  <!-- 4: Class Type -->
  <div class="filter">
    <div class="filter-button">
      <span class="label">Class Type</span>
      <div class="selection">
        <span class="value">Theoretical &amp; Conversational</span>
        <span class="icon">▾</span>
      </div>
    </div>
    <div class="dropdown_filters">
      <ul>
        <li class="section-label">Popular</li>
        <li class="item">
          <span>Theoretical &amp; Conversational</span>
          <span class="checkbox selected"></span>
        </li>
        <li class="item">
          <span>Conversational (only)</span>
          <span class="checkbox"></span>
        </li>
      </ul>
    </div>
  </div>

  <!-- 5: Price per Month with slider -->
  <div class="filter">
    <div class="filter-button">
      <span class="label">Price per Month</span>
      <div class="selection">
        <span class="value">$1 – $40+</span>
        <span class="icon">▾</span>
      </div>
    </div>
    <div class="dropdown_filters slider-dropdown_filters">
      <div class="range-label">
        $<span id="min-val">1</span> – $<span id="max-val">40+</span>
      </div>
      <div class="slider-container">
        <div class="slider-track"></div>
        <input type="range" class="range-min" min="1" max="100" value="1">
        <input type="range" class="range-max" min="1" max="100" value="40">
      </div>
    </div>
  </div>
</div>


  <!-- Teacher Section -->
  <section id="teacherSection">
    <div class="teacher-card">
      <div class="teacher-avatar"><img src="https://randomuser.me/api/portraits/women/4.jpg" alt="Daniela"/></div>
      <div class="teacher-details">
        <div class="teacher-header">
          <h3 class="teacher-name">Daniela <span class="verified">✔️</span></h3>
          <button class="favorite">♡</button>
        </div>
        <ul class="meta-list">
          <li>🎓 English</li>
          <li>👥 30 active students • 1,260 lessons</li>
          <li>🌐 English (Native)</li>
        </ul>
        <p class="bio">Hi! I’m Daniela, an experienced English teacher with over a decade of helping students master the language. I’m passionate about creating engaging lessons tailored to each learner’s needs.</p>
        <a class="see-more">See More...</a>
      </div>
      <div class="action-panel">
        <div class="rating">★ 4.7 <small>17 reviews</small></div>
        <div class="stats"><div>858<small>lessons</small></div><div>US$8<small>50-min lesson</small></div></div>
        <button class="btn-primary" id="open-booking">Book trial lesson US$0</button>
        <button class="btn-outline">Send a Message</button>
      </div>
      
    </div>
    <div class="schedule-panel">
      <div class="schedule-preview"><span class="play-icon">▶</span></div>
      <button class="schedule-btn">View full schedule</button>
    </div>
  </section>
























  <style>
    :root {
      --border: #d0d5dd;
      --border-focus: #2563eb;
      --bg: #ffffff;
      --bg-hover: #f2f4f7;
      --text: #101828;
      --text-muted: #667085;
      --accent: #f53d2d;
    }
    body { font-family: 'Inter', sans-serif; margin: 0; }
    .modal-overlay {
      position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
      background: rgba(0,0,0,0.4); display: none; align-items: center; justify-content: center;
      z-index: 10000;
    }
    .booking-modal {
      background: #fff; border-radius: 8px; width: 360px; max-width: 90vw;
      max-height: 90vh; overflow-y: auto; box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .booking-modal header {
      display: flex; justify-content: space-between; align-items: center;
      padding: 16px; border-bottom: 1px solid var(--border);
    }
    .booking-modal header h2 { margin: 0; font-size: 18px; font-weight: 600; }
    .booking-modal header .close-btn {
      background: none; border: none; font-size: 20px; cursor: pointer;
    }
    .subtitle {
      padding: 0 16px 16px; font-size: 14px; color: var(--text-muted);
    }
    .durations {
      display: flex; margin: 0 16px 16px; border: 1px solid var(--border); border-radius: 6px; overflow: hidden;
    }
    .durations button {
      flex: 1; padding: 12px 0; background: var(--bg-hover); border: none; font-weight: 600; cursor: pointer;
    }
    .durations button.active { background: var(--bg); border-bottom: 2px solid var(--accent); }
    .week-picker {
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 16px; margin-bottom: 12px;
    }
    .week-picker .arrow {
      background: none; border: none; font-size: 18px; cursor: pointer;
    }
    .week-picker .range { font-size: 14px; font-weight: 600; }
    .day-list {
      display: flex; justify-content: space-between; padding: 0 16px; margin-bottom: 16px;
    }
    .day-list .day {
      text-align: center; font-size: 12px; color: var(--text-muted); cursor: pointer;
      display: flex; flex-direction: column; align-items: center;
    }
    .day-list .day.active { color: var(--text); font-weight: 600; }
    .segment-group { padding: 0 16px 16px; }
    .segment-group h4 {
      display: flex; align-items: center; gap: 8px; margin: 0 0 8px;
      font-size: 14px; font-weight: 600;
    }
    .segment-options {
      display: grid; grid-template-columns: 1fr 1fr; gap: 8px;
    }
    .segment-options button {
      padding: 8px; border: 1px solid var(--border); border-radius: 6px;
      background: var(--bg); font-size: 13px; cursor: pointer;
    }
    .segment-options button.selected {
      background: var(--accent); color: #fff; border-color: var(--accent);
    }
    .continue-btn {
      width: calc(100% - 32px); margin: 0 16px 16px; padding: 12px;
      background: var(--accent); color: #fff; border: none; border-radius: 6px;
      font-size: 16px; font-weight: 600; cursor: pointer;
    }
  </style>

<div class="modal-overlay" id="bookingModal">
    <div class="booking-modal">
      <header>
        <h2>Book a trial lesson</h2>
        <button class="close-btn" id="closeBooking">×</button>
      </header>
      <div class="subtitle">To meet your classmates and teachers</div>
      <div class="durations">
        <button data-duration="25" class="active">25 min</button>
        <button data-duration="50">50 min</button>
      </div>
      <div class="week-picker">
        <button class="arrow" id="prevWeek">‹</button>
        <div class="range" id="weekRange"></div>
        <button class="arrow" id="nextWeek">›</button>
      </div>
      <div class="day-list" id="dayList"></div>
      <div class="segment-group">
        <h4>🌙 Night</h4>
        <div class="segment-options" id="nightSlots"></div>
      </div>
      <div class="segment-group">
        <h4>☀️ Morning</h4>
        <div class="segment-options" id="morningSlots"></div>
      </div>
      <button class="continue-btn">Continue</button>
    </div>
  </div>



  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    const now = new Date();
    let currentMonday = new Date(now.setDate(now.getDate() - now.getDay() + 1));

    function formatDate(date) {
      return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
    }
    function updateWeek() {
      const start = new Date(currentMonday);
      const end = new Date(currentMonday);
      end.setDate(end.getDate() + 6);
      $('#weekRange').text(`${formatDate(start)} – ${formatDate(end)}, ${start.getFullYear()}`);
      // Day list
      $('#dayList').empty();
      for (let i=0; i<7; i++) {
        const d = new Date(currentMonday);
        d.setDate(d.getDate()+i);
        $('<div>')
          .addClass('day')
          .toggleClass('active', i===0)
          .text(d.toLocaleDateString('en-US',{weekday:'short', day:'numeric'}))
          .attr('data-day', i)
          .appendTo('#dayList');
      }
      updateTimes();
    }
    function updateTimes() {
      const selectedDay = $('#dayList .day.active').data('day');
      $('#timeSlots').empty();
      // For simplicity, static slots
      ['3:00 AM','3:30 AM'].forEach(t => {
        $('<button>')
          .addClass('time-option')
          .text(t)
          .appendTo('#timeSlots');
      });
    }
    
    $(function(){
      // Open modal
      $('#open-booking').click(()=> $('#bookingModal').fadeIn(200));
      $('#closeBooking').click(()=> $('#bookingModal').fadeOut(200));

      // Duration toggle
      $('.durations button').click(function(){
        $('.durations button').removeClass('active'); $(this).addClass('active');
      });
      // Week nav
      $('#prevWeek').click(()=>{ currentMonday.setDate(currentMonday.getDate()-7); updateWeek(); });
      $('#nextWeek').click(()=>{ currentMonday.setDate(currentMonday.getDate()+7); updateWeek(); });
      // Day select
      $('#dayList').on('click','.day',function(){ $('#dayList .day').removeClass('active'); $(this).addClass('active'); updateTimes(); });

      updateWeek();
    });
  </script>









  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/explore_tutors_details.js"></script>