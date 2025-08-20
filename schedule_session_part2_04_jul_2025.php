<style>
/* Modal and layout styles */
.modal2-content {
  padding: 24px 24px 24px 24px;
}
.modal-row {
  display: flex;
  gap: 16px;
  margin-bottom: 18px;
}
.modal-col {
  flex: 1;
}
.custom-select, .custom-input {
  width: 100%;
  padding: 13px 13px 13px 15px;
  font-size: 1.08rem;
  border-radius: 9px;
  border: 2px solid #E4E4E7;
  background: #fff;
  font-family: inherit;
  color: #232323;
  font-weight: 500;
  appearance: none;
  outline: none;
  box-sizing: border-box;
  transition: border 0.17s;
}
.custom-select:focus, .custom-input:focus {
  border-color: #ff3b18;
}
.readonly-box {
  background: #F6F6F6;
  border: 2px solid #E4E4E7;
  border-radius: 9px;
  padding: 13px 13px 13px 15px;
  font-size: 1.07rem;
  font-weight: 600;
  color: #898989;
}
.icon-btn {
  background: transparent;
  border: none;
  position: absolute;
  right: 14px; top: 50%;
  transform: translateY(-50%);
  font-size: 1.27rem;
  color: #898989;
  cursor: pointer;
  padding: 0;
}
.note-link {
  display: block;
  color: #1743e3;
  font-weight: 600;
  font-size: 1.05rem;
  text-decoration: underline;
  margin-bottom: 15px;
  cursor: pointer;
}
.dropdown-arrow {
  font-size: 1.01rem;
  margin-left: 2px;
  transition: transform 0.16s;
  vertical-align: middle;
}
.note-link.open .dropdown-arrow {
  transform: rotate(180deg);
}
.note-area {
  display: none;
  margin-bottom: 15px;
}
.note-textarea {
  width: 100%;
  min-height: 48px;
  padding: 9px;
  font-size: 1rem;
  border-radius: 6px;
  border: 1.5px solid #E4E4E7;
  font-family: inherit;
  resize: vertical;
}
.slider-label {
  font-size: 1.07rem;
  margin-bottom: 6px;
  color: #232323;
  font-weight: 500;
}
.completion-bar {
  background: #fafbfc;
  border-radius: 28px;
  border: 2px solid #ececec;
  padding: 28px 20px 20px 20px;
  margin-top: 8px;
  position: relative;
  width: 100%;
  box-sizing: border-box;
  overflow: visible;
}
.bar-track {
  position: relative;
  height: 10px;
  background: linear-gradient(90deg,#FF3B18 0 80%,#ededed 80% 100%);
  border-radius: 5px;
  margin-bottom: 12px;
}
.bar-slider-point {
  position: absolute;
  top: -22px;
  width: 34px;
  height: 34px;
  left: calc(var(--left, 0%) - 17px);
  display: flex;
  flex-direction: column;
  align-items: center;
}
.bar-point-circle {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: #fff;
  border: 3px solid #FF3B18;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  color: #FF3B18;
  font-size: 1.07rem;
  margin-bottom: -6px;
  box-shadow: 0 2px 6px rgba(240,50,30,0.05);
}
.bar-slider-thumb {
  position: absolute;
  top: -13px;
  left: calc(80% - 13px);
  width: 27px;
  height: 27px;
  background: #fff;
  border: 3px solid #FF3B18;
  border-radius: 50%;
  z-index: 2;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: left 0.18s;
}
.bar-labels {
  display: flex;
  justify-content: space-between;
  font-size: .98rem;
  color: #949494;
  font-weight: 600;
  margin-top: 18px;
}
.bar-labels span.selected {
  color: #FF3B18;
  font-weight: 700;
}
.modal-submit-btn {
  width: 100%;
  margin-top: 24px;
  padding: 18px 0 16px 0;
  background: #FF3B18;
  color: #fff;
  font-size: 1.28rem;
  font-weight: 700;
  border: 2px solid #FF3B18;
  border-radius: 12px;
  cursor: pointer;
  box-shadow: 0 2px 12px rgba(255,59,24,0.10);
  transition: background 0.13s, border 0.13s;
}
.modal-submit-btn:hover, .modal-submit-btn:focus {
  background: #e7320e;
  border-color: #e7320e;
}
@media (max-width: 540px) {
  .custom-modal {
    max-width: 99vw;
    width: 97vw;
    border-radius: 12px;
  }
  .modal-header, .modal-body, .modal-actions, .modal2-content {
    padding-left: 11px !important;
    padding-right: 11px !important;
  }
  .modal-header {
    padding-top: 19px !important;
    padding-bottom: 12px !important;
  }
  .modal-actions {
    flex-direction: column;
    gap: 13px;
    padding-bottom: 16px !important;
    margin-top: 17px;
  }
  .modal-btn {
    width: 100%;
    min-width: 0;
    height: 52px;
    font-size: 1.05rem;
  }
  .modal2-content {
    padding: 20px 8px 15px 8px !important;
  }
  .completion-bar {
    padding: 20px 9px 12px 9px;
  }
  .modal-row {
    flex-direction: column;
    gap: 9px;
  }
}

/* --- Custom Dropdowns: now with stacking fix --- */
.custom-dropdown-wrapper {
  position: relative;
  width: 100%;
  z-index: 1050; /* High enough to float above fields */
}
.custom-dropdown-selected {
  padding: 13px 44px 13px 15px;
  border: 2px solid #232323;
  border-radius: 9px;
  background: #fff;
  font-size: 1.11rem;
  font-weight: 600;
  color: #232323;
  cursor: pointer;
  min-height: 48px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: relative;
  transition: border 0.17s;
  outline: none;
  z-index: 2; /* so input stays above others */
}
.custom-dropdown-selected .dropdown-arrow {
  position: absolute;
  right: 16px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 1.16rem;
  transition: transform 0.18s;
  pointer-events: none;
}
.custom-dropdown-wrapper.custom-dropdown-open .custom-dropdown-selected .dropdown-arrow {
  transform: translateY(-50%) rotate(180deg);
}
.custom-dropdown-list {
  display: none;
  
  width: 100%;
  background: #fff;
  border-radius: 20px;
  box-shadow: 0 8px 32px 0 rgba(60,60,60,0.17);
  padding: 22px 0 18px 0;
  z-index: 2000 !important; /* <<<<<< highest! */
  min-width: 270px;
  max-height: 330px;
  overflow-y: auto;
}
.dropdown-create-row {
  display: flex;
  align-items: center;
  padding: 0 20px 15px 20px;
  gap: 10px;
}
.dropdown-create-input {
  flex: 1;
  border: 2px solid #E4E4E7;
  border-radius: 9px;
  padding: 11px 12px;
  font-size: 1.07rem;
  color: #666;
  outline: none;
  transition: border 0.17s;
  background: #fafbfc;
}
.dropdown-create-input:focus {
  border-color: #232323;
}
.dropdown-create-btn {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  background: #fff;
  border: 2px solid #232323;
  font-size: 1.4rem;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #232323;
  cursor: pointer;
  margin-left: 7px;
  transition: background 0.12s, color 0.12s;
}
.dropdown-create-btn:active {
  background: #f5f6fa;
}
.dropdown-group {
  padding: 0 22px 4px 22px;
}
.dropdown-group-label {
  font-weight: 700;
  font-size: 1.13rem;
  margin: 14px 0 7px 0;
  color: #232323;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: space-between;
  user-select: none;
  padding: 4px 0;
}
.accordion-arrow {
  font-size: 1.01rem;
  margin-left: 8px;
  transition: transform 0.16s;
  vertical-align: middle;
  display: inline-block;
}
.dropdown-group.open .accordion-arrow {
  transform: rotate(180deg);
}
.dropdown-items {
  margin-bottom: 2px;
}
.dropdown-item {
  padding: 11px 0 11px 0;
  font-size: 1.10rem;
  color: #232323;
  cursor: pointer;
  border-radius: 7px;
  transition: background 0.13s;
  font-weight: 500;
  margin-left: 11px;
  margin-right: 5px;
  background: #fff;
  z-index: 3;
}
.dropdown-item:hover {
  background: #f5f6fa;
  color: #FF3B18;
}
@media (max-width: 540px) {
  .custom-dropdown-list {
    border-radius: 12px;
    left: 0;
    width: 99vw;
    min-width: 0;
    max-width: 97vw;
    transform: none;
    padding: 17px 0 12px 0;
  }
  .dropdown-group {
    padding: 0 10px 3px 10px;
  }
  .dropdown-create-row {
    padding-left: 9px;
    padding-right: 9px;
  }
}










.selected-assignment-chip {
  display: flex;
  align-items: center;
  background: #fff;
  border-radius: 11px;
  border: 2px solid #e4e4e7;
  box-shadow: 0 4px 20px rgba(60,60,60,0.06);
  margin-top: 8px;
  margin-bottom: 10px;
  padding: 13px 17px 13px 17px;
  font-size: 1.12rem;
  font-weight: 600;
  color: #232323;
  position: relative;
  min-height: 46px;
  transition: box-shadow 0.13s;
}
.chip-title {
  margin-right: 13px;
  font-weight: 600;
  color: #232323;
}
.chip-detail {
  font-weight: 500;
  color: #9d9d9d;
  margin-right: 13px;
}
.chip-remove {
  font-size: 1.22rem;
  color: #222;
  margin-left: auto;
  cursor: pointer;
  padding: 4px 9px;
  border-radius: 50%;
  transition: background 0.12s, color 0.12s;
}
.chip-remove:hover {
  background: #f2f2f2;
  color: #ff3b18;
}

















.calendar-modal-backdrop {
  position: fixed;
  z-index: 3998;
  left: 0; top: 0; right: 0; bottom: 0;
  background: rgba(80,80,80,0.08);
}

.calendar-modal {
  position: fixed;
  left: 50%; top: 60px;
  transform: translateX(-50%);
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 8px 44px rgba(60,60,60,0.15);
  width: 340px;
  max-width: 97vw;
  z-index: 3999;
  padding: 0 0 20px 0;
  display: flex;
  flex-direction: column;
  align-items: stretch;
  animation: fadeIn .18s;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translate(-50%, 12px);}
  to   { opacity: 1; transform: translate(-50%, 0);}
}

.calendar-modal-header {
  padding: 21px 25px 8px 25px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.calendar-modal-title {
  font-size: 1.33rem;
  font-weight: 700;
  color: #232323;
}
.calendar-modal-close {
  font-size: 1.45rem;
  color: #222;
  cursor: pointer;
  padding: 2px 8px;
  border-radius: 50%;
  transition: background 0.15s, color 0.15s;
}
.calendar-modal-close:hover {
  background: #f6f6fa;
  color: #ff3b18;
}
.calendar-modal-controls {
  padding: 0 25px 8px 25px;
  display: flex;
  gap: 14px;
}
.calendar-modal-select {
  font-size: 1.05rem;
  border-radius: 7px;
  border: 2px solid #e4e4e7;
  padding: 7px 14px;
  font-weight: 600;
  outline: none;
  background: #fafbfc;
  color: #232323;
}
.calendar-modal-days, .calendar-modal-dates {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  padding: 0 25px;
  margin-bottom: 2px;
  text-align: center;
  font-size: 1rem;
  font-weight: 600;
  color: #949494;
  user-select: none;
}
.calendar-modal-days {
  margin-top: 8px;
  margin-bottom: 5px;
}
.calendar-modal-dates {
  min-height: 226px;
  margin-bottom: 22px;
}
.calendar-modal-date {
  padding: 9px 0;
  margin: 4px 0;
  font-size: 1.12rem;
  border-radius: 7px;
  cursor: pointer;
  font-weight: 600;
  color: #232323;
  background: none;
  border: none;
  transition: background 0.14s, color 0.14s;
}
.calendar-modal-date.selected {
  background: #ff3b18;
  color: #fff;
}
.calendar-modal-date.disabled {
  color: #d2d2d2;
  background: none;
  pointer-events: none;
}
.calendar-modal-confirm {
  margin: 0 24px;
  margin-top: 10px;
  background: #ff3b18;
  color: #fff;
  font-size: 1.15rem;
  font-weight: 700;
  border-radius: 11px;
  border: none;
  padding: 15px 0;
  cursor: pointer;
  box-shadow: 0 2px 12px rgba(255,59,24,0.09);
  transition: background 0.13s;
}
.calendar-modal-confirm:hover {
  background: #e7320e;
}
@media (max-width: 540px) {
  .calendar-modal {
    left: 1.5vw;
    transform: none;
    width: 97vw;
    min-width: 0;
    border-radius: 11px;
    padding-left: 0;
    padding-right: 0;
  }
  .calendar-modal-header,
  .calendar-modal-controls,
  .calendar-modal-days,
  .calendar-modal-dates {
    padding-left: 8px;
    padding-right: 8px;
  }
}

</style>

<!-- MODAL 2 -->
<div class="custom-modal" id="topicModal" style="display:none;">
  <div class="modal2-content">
    <form>
      <div class="modal-row">
        <div class="modal-col" style="flex:2;">
          <!-- Topic Dropdown -->
          <div class="custom-dropdown-wrapper" id="topicDropdownWrapper">
            <div class="custom-dropdown-selected" tabindex="0" id="topicDropdownSelected">
              <span id="topicDropdownText">Select Topic</span>
              <span class="dropdown-arrow">&#9662;</span>
            </div>
            <div class="custom-dropdown-list" id="topicDropdownList">
              <div class="dropdown-create-row">
                <input type="text" class="dropdown-create-input" placeholder="Create a new topic if not listed" id="newTopicInput">
                <button type="button" class="dropdown-create-btn" id="createTopicBtn">&#10003;</button>
              </div>
              <div class="dropdown-group">
                <div class="dropdown-group-label accordion-toggle" data-acc="1">
                  <span>A1 - Level 1</span>
                  <span class="accordion-arrow">&#9662;</span>
                </div>
                <div class="dropdown-items" data-acc="1">
                  <div class="dropdown-item">Alphabet</div>
                  <div class="dropdown-item">Number</div>
                  <div class="dropdown-item">Self Introduction</div>
                  <div class="dropdown-item">Verb Be</div>
                  <div class="dropdown-item">Demonstratives</div>
                  <div class="dropdown-item">Present Continuous</div>
                </div>
              </div>
              <div class="dropdown-group">
                <div class="dropdown-group-label accordion-toggle" data-acc="2">
                  <span>A1 - Level 2</span>
                  <span class="accordion-arrow">&#9662;</span>
                </div>
                <div class="dropdown-items" data-acc="2" style="display:none;">
                  <div class="dropdown-item">Past Simple</div>
                  <div class="dropdown-item">Future Intentions</div>
                  <div class="dropdown-item">Family Members</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-col" style="flex:1.1;">
          <div class="readonly-box">Target Sessions : 3</div>
        </div>
      </div>
      <div class="modal-row">
        <div class="modal-col" style="flex:2;">
          <!-- Assignment Dropdown -->
          <div class="custom-dropdown-wrapper" id="assignmentDropdownWrapper">
            <div class="custom-dropdown-selected" tabindex="0" id="assignmentDropdownSelected">
              <span id="assignmentDropdownText">Assignment</span>
              <span class="dropdown-arrow">&#9662;</span>
            </div>
            <div class="custom-dropdown-list" id="assignmentDropdownList">
              <div class="dropdown-group">
                <div class="dropdown-group-label accordion-toggle" data-acc="a1">
                  <span>Homework</span>
                  <span class="accordion-arrow">&#9662;</span>
                </div>
                <div class="dropdown-items" data-acc="a1">
                  <div class="dropdown-item">HW1</div>
                  <div class="dropdown-item">HW2</div>
                  <div class="dropdown-item">HW3</div>
                  <div class="dropdown-item">HW4</div>
                </div>
              </div>
              <div class="dropdown-group">
                <div class="dropdown-group-label accordion-toggle" data-acc="a2">
                  <span>Quizzes</span>
                  <span class="accordion-arrow">&#9662;</span>
                </div>
                <div class="dropdown-items" data-acc="a2" style="display:none;">
                  <div class="dropdown-item">Quiz 1</div>
                  <div class="dropdown-item">Quiz 2</div>
                  <div class="dropdown-item">Quiz 3</div>
                </div>
              </div>
              <div class="dropdown-group">
                <div class="dropdown-group-label accordion-toggle" data-acc="a3">
                  <span>Exams</span>
                  <span class="accordion-arrow">&#9662;</span>
                </div>
                <div class="dropdown-items" data-acc="a3" style="display:none;">
                  <div class="dropdown-item">Midterm</div>
                  <div class="dropdown-item">Final</div>
                </div>
              </div>
            </div>
          </div>



              <!-- Selected Assignment Chip -->
              <div class="selected-assignment-chip" id="selectedAssignmentChip" style="display:none;">
                <span class="chip-title" id="selectedAssignmentLabel"></span>
                <span class="chip-detail" id="selectedAssignmentDetail"></span>
                <span class="chip-remove" id="removeAssignmentChip" title="Remove">&#10005;</span>
              </div>






        </div>
        <div class="modal-col" style="flex:1.1; position:relative;">
          <input class="custom-input" style="padding-right:32px;" readonly value="1 Oct, 2024">
          <span class="icon-btn" style="right:20px; top:55%; font-size:1.28rem;">
            <svg width="20" height="20" fill="none" viewBox="0 0 20 20"><rect width="20" height="20" rx="4" fill="#F6F6F6"/><path d="M6.5 3v2M13.5 3v2M4.2 7.2h11.6M5 17h10a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1Z" stroke="#232323" stroke-width="1.3" stroke-linecap="round"/></svg>
          </span>
        </div>
      </div>
      <div class="note-link" tabindex="0">Make a note for student or group <span class="dropdown-arrow">&#9660;</span></div>
      <div class="note-area">
        <textarea class="note-textarea" placeholder="Type note here..."></textarea>
      </div>
      <div class="slider-label">What was completion percentage of this topic</div>
      <div class="completion-bar">
        <!-- Progress Points -->
        <div class="bar-track" style="width: 100%; background: linear-gradient(90deg,#FF3B18 0 80%,#ededed 80% 100%); height: 11px;">
          <div class="bar-slider-point" style="--left: 18%;">
            <div class="bar-point-circle">1</div>
            <div class="bar-point-label"></div>
          </div>
          <div class="bar-slider-point" style="--left: 48%;">
            <div class="bar-point-circle">2</div>
            <div class="bar-point-label"></div>
          </div>
          <div class="bar-slider-thumb" style="left: calc(80% - 13px);"></div>
        </div>
        <div class="bar-labels">
          <span>0%</span>
          <span>25%</span>
          <span>60%</span>
          <span class="selected">80%</span>
          <span>100%</span>
        </div>
      </div>
      <button type="submit" class="modal-submit-btn">Submit</button>
    </form>
  </div>
</div>



<!-- CALENDAR MODAL -->
<div class="calendar-modal-backdrop" style="display:none;"></div>
<div class="calendar-modal" id="calendarModal" style="display:none;">
  <div class="calendar-modal-header">
    <span class="calendar-modal-title">Select Date</span>
    <span class="calendar-modal-close" id="calendarModalClose">&times;</span>
  </div>
  <div class="calendar-modal-controls">
    <select id="calendarMonth" class="calendar-modal-select"></select>
    <select id="calendarYear" class="calendar-modal-select"></select>
  </div>
  <div class="calendar-modal-days">
    <div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div><div>Sun</div>
  </div>
  <div class="calendar-modal-dates" id="calendarModalDates"></div>
  <button type="button" class="calendar-modal-confirm" id="calendarModalConfirm">Confirm</button>
</div>

