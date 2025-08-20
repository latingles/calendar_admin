

  <div class="calendar_admin_details_create_cohort_content tab-content" id="addTimeTabContent" style="display:none;">
  <form id="addTimeForm">
    <label class="addtime-label" style="margin-top:5px;">Teacher</label>
    <div class="addtime-teacher-dropdown">
      <div class="addtime-teacher-selected">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="addtime-teacher-avatar">
        <span>Daniella</span>
      </div>
    </div>
    <label class="addtime-label" style="margin-top:16px;">Title</label>
    <input type="text" class="addtime-title-input" value="Busy" />

    <div class="addtime-row">
      <div class="addtime-col">
        <label class="addtime-label">From</label>
        <div class="addtime-picker-row">
          <button type="button" class="addtime-date-btn" id="addTimeFromDateBtn">Select Date</button>
          <button type="button" class="addtime-time-btn" id="addTimeFromTimeBtn">Select Time</button>
        </div>
      </div>
      <div class="addtime-col">
        <label class="addtime-label">Until</label>
        <div class="addtime-picker-row">
          <button type="button" class="addtime-date-btn" id="addTimeUntilDateBtn">Select Date</button>
          <button type="button" class="addtime-time-btn" id="addTimeUntilTimeBtn">Select Time</button>
        </div>
      </div>
    </div>
    <label class="addtime-checkbox-label" style="margin-top:15px;">
      <input type="checkbox" id="addTimeAllDay">
      All Day
    </label>
    <button type="submit" class="addtime-submit-btn">Schedule Time off</button>
  </form>
</div>


