


<div class="calendar_admin_details_create_cohort_content tab-content" id="classTabContent" style="display:none;">
  <label class="one2one-section-label">Teacher</label>
  <div class="one2one-teacher-card">
    <img src="https://randomuser.me/api/portraits/women/2.jpg" class="one2one-teacher-avatar" alt="Teacher">
    <span class="one2one-teacher-name">Daniella</span>
  </div>

  <label class="one2one-section-label">Student</label>
  <div class="one2one-student-dropdown-wrapper">
    <div class="one2one-add-student-card" id="one2oneAddStudentBtn" tabindex="0">
      <span class="one2one-add-student-icon">
        <svg width="21" height="21" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="7" r="4" fill="#000"/><ellipse cx="10" cy="15.3" rx="6.5" ry="3.3" fill="#000"/></svg>
      </span>
      <span class="one2one-add-student-placeholder" style="color:#aaa;">Add student</span>
    </div>
    <div class="one2one-student-dropdown-list" id="one2oneStudentDropdown" style="display:none;">
      <div class="one2one-student-list-item" data-name="Jonas">
        <div class="one2one-student-list-avatar">
          <svg width="24" height="24" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="7" r="4" fill="#000"/><ellipse cx="10" cy="15.3" rx="6.5" ry="3.3" fill="#000"/></svg>
        </div>
        <div class="one2one-student-list-meta">
          <div class="one2one-student-list-name">Jonas</div>
          <div class="one2one-student-list-lessons">2 Lessons</div>
        </div>
        <div class="one2one-student-list-status subscription">Subscription</div>
      </div>
      <div class="one2one-student-list-item" data-name="Anna">
        <div class="one2one-student-list-avatar">
          <svg width="24" height="24" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="7" r="4" fill="#000"/><ellipse cx="10" cy="15.3" rx="6.5" ry="3.3" fill="#000"/></svg>
        </div>
        <div class="one2one-student-list-meta">
          <div class="one2one-student-list-name">Anna</div>
          <div class="one2one-student-list-lessons">1 Lessons</div>
        </div>
        <div class="one2one-student-list-status cancelled">Subscription Cancelled</div>
      </div>
      <div class="one2one-student-list-item" data-name="Alina">
        <div class="one2one-student-list-avatar">
          <svg width="24" height="24" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="7" r="4" fill="#000"/><ellipse cx="10" cy="15.3" rx="6.5" ry="3.3" fill="#000"/></svg>
        </div>
        <div class="one2one-student-list-meta">
          <div class="one2one-student-list-name">Alina</div>
          <div class="one2one-student-list-lessons">0 Lessons</div>
        </div>
        <div class="one2one-student-list-status trial">Trial</div>
      </div>
      <div class="one2one-student-list-item" data-name="Bay">
        <div class="one2one-student-list-avatar">
          <svg width="24" height="24" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="7" r="4" fill="#000"/><ellipse cx="10" cy="15.3" rx="6.5" ry="3.3" fill="#000"/></svg>
        </div>
        <div class="one2one-student-list-meta">
          <div class="one2one-student-list-name">Bay</div>
          <div class="one2one-student-list-lessons">2 Lessons</div>
        </div>
        <div class="one2one-student-list-status trial">Trial</div>
      </div>
      <div class="one2one-student-list-item" data-name="Karma">
        <div class="one2one-student-list-avatar">
          <svg width="24" height="24" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="7" r="4" fill="#000"/><ellipse cx="10" cy="15.3" rx="6.5" ry="3.3" fill="#000"/></svg>
        </div>
        <div class="one2one-student-list-meta">
          <div class="one2one-student-list-name">Karma</div>
          <div class="one2one-student-list-lessons">3 Lessons</div>
        </div>
        <div class="one2one-student-list-status trial">Trial</div>
      </div>
    </div>
  </div>

  <label class="one2one-section-label">Lesson type</label>
  <div class="one2one-lesson-type-row">
    <div class="one2one-lesson-type-btn selected" data-type="single">
      <span class="one2one-lesson-type-icon">
        <svg width="21" height="21" fill="none" viewBox="0 0 20 20"><rect x="3" y="5" width="14" height="12" rx="3" fill="#c5c7cd"/><rect x="6" y="9" width="8" height="2" rx="1" fill="#fff"/></svg>
      </span>
      Single lessons
      <input type="radio" class="one2one-radio" name="lessonType" value="single" checked>
    </div>
    <div class="one2one-lesson-type-btn" data-type="weekly">
      <span class="one2one-lesson-type-icon">
        <svg width="21" height="21" viewBox="0 0 20 20" fill="none"><path d="M15.5 10a5.5 5.5 0 1 1-2.2-4.4" stroke="#c5c7cd" stroke-width="2" stroke-linecap="round"/><path d="M13 4.5h3v3" stroke="#c5c7cd" stroke-width="2" stroke-linecap="round"/></svg>
      </span>
      Weekly lessons
      <input type="radio" class="one2one-radio" name="lessonType" value="weekly">
    </div>
  </div>

  
  <label class="one2one-section-label">Date and time</label>
  <div class="one2one-duration-dropdown-wrapper" id="durationDropdownWrapper">
    <div class="one2one-duration-dropdown-display" id="durationDropdownDisplay">50 Minutes ( Standard time )</div>
    <div class="one2one-duration-dropdown-list" id="durationDropdownList" style="display:none;">
      <div class="one2one-duration-option">20 Minutes</div>
      <div class="one2one-duration-option selected">50 Minutes</div>
      <div class="one2one-duration-option">1 Hour</div>
    </div>
  </div>


  <div class="one2one-datetime-dropdown-row">
    <div class="one2one-date-dropdown-display" id="customDateDropdownDisplay" style="flex:1 1 0; min-width:80px; padding:13px 14px; border-radius:10px; border:1.5px solid #dadada; background:#fff; font-size:1.05rem; color:#232323; margin-bottom:12px; cursor:pointer; display:flex; align-items:center; justify-content:space-between;">
      <span id="selectedDateText">Tue, Feb11</span>
      <span style="margin-left:10px; font-size:1.08rem;">&#9660;</span>
    </div>
    <div class="one2one-time-dropdown-wrapper" id="customTimeDropdownWrapper" style="flex:1 1 0; min-width:80px;">
      <div class="one2one-time-dropdown-display" id="customTimeDropdownDisplay">12:00 AM</div>
      <div class="one2one-time-dropdown-list" id="customTimeDropdownList" style="display:none;">
        <!-- Time options rendered by JS -->
      </div>
    </div>
  </div>
</div>





<!-- Custom Calendar Modal -->
<div class="calendar-modal-backdrop" id="calendarModalBackdrop">
  <div class="calendar-modal" id="calendarModal">
    <div class="calendar-modal-header">
      <div class="calendar-modal-arrow" id="calendarPrevMonth">&#8592;</div>
      <span id="calendarMonthYear">January 2025</span>
      <div class="calendar-modal-arrow" id="calendarNextMonth">&#8594;</div>
    </div>
    <div class="calendar-modal-grid">
      <div class="calendar-modal-weekdays">
        <div>Mo</div><div>Tu</div><div>We</div><div>Th</div><div>Fr</div><div>Sa</div><div>Su</div>
      </div>
      <div class="calendar-modal-days" id="calendarDaysGrid">
        <!-- Days rendered by JS -->
      </div>
    </div>
    <div class="calendar-modal-footer">
      <button class="calendar-modal-done" id="calendarDoneBtn">Done</button>
    </div>
  </div>
</div>
