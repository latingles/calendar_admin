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



.custom-chip-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  background: #fff;
  border: 2px solid #e5e5e8;
  border-radius: 13px;
  font-size: 1.11rem;
  font-weight: 500;
  color: #232323;
  padding: 13px 19px 13px 17px;
  margin: 9px 0;
  box-shadow: 0 3px 18px rgba(80,90,110,0.06);
  min-height: 44px;
}
.chip-label {
  font-weight: bold;
  margin-right: 2px;
}
.chip-assignment {
  font-weight: 600;
}
.chip-details {
  color: #232323;
  font-size: 1.08rem;
  margin-left: auto;
  margin-right: 25px;
  font-weight: 500;
  opacity: 0.95;
}
.chip-remove {
  font-size: 1.51rem;
  color: #cb3939;
  cursor: pointer;
  padding: 3px 11px 2px 11px;
  border-radius: 22px;
  margin-left: auto;
  transition: background 0.12s;
  line-height: 1;
  user-select: none;
}
.chip-remove:hover {
  background: #ffeaea;
}
.chip-left {
  display: flex;
  align-items: center;
}


















#supercal-input {
  padding: 12px 16px;
  font-size: 1.09rem;
  border-radius: 8px;
  border: 2px solid #e0e0e0;
  min-width: 190px;
  outline: none;
  margin-right: 12px;
  cursor: pointer;
  background: #fff;
}

/* ---- Super Unique Calendar Modal Styles ---- */
.supercal-backdrop {
  position: fixed; left: 0; top: 0; right: 0; bottom: 0;
  background: rgba(80,80,80,0.12);
  z-index: 22222;
  display: none;
}
.supercal-modal {
  position: fixed;
  top: 50%; left: 50%;
  transform: translate(-50%, -50%);
  width: 350px;
  max-width: 97vw;
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 8px 44px rgba(60,60,60,0.18);
  z-index: 22223;
  padding: 0 0 24px 0;
  display: none;
  flex-direction: column;
  align-items: stretch;
  animation: supercalFadeIn .18s;
}
@keyframes supercalFadeIn {
  from { opacity: 0; transform: translate(-50%, -60%);}
  to   { opacity: 1; transform: translate(-50%, -50%);}
}
.supercal-header {
  padding: 18px 25px 8px 25px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: relative;
}
.supercal-title {
  font-size: 1.22rem;
  font-weight: 700;
  color: #232323;
  flex: 1;
  text-align: center;
}
.supercal-arrow {
  background: #fff;
  border: 1.7px solid #e4e4e7;
  border-radius: 8px;
  width: 36px;
  height: 36px;
  font-size: 1.22rem;
  font-weight: 700;
  color: #232323;
  cursor: pointer;
  transition: background 0.14s, border 0.14s;
  margin: 0 5px;
}
.supercal-close {
  position: absolute;
  right: 14px; top: 13px;
  font-size: 1.44rem;
  color: #898989;
  cursor: pointer;
  padding: 1px 7px;
  border-radius: 50%;
  transition: background 0.12s, color 0.12s;
}
.supercal-days {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  padding: 0 25px;
  text-align: center;
  font-size: 1rem;
  font-weight: 600;
  color: #949494;
  user-select: none;
  margin: 10px 0 6px 0;
}
.supercal-dates {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  padding: 0 25px;
  text-align: center;
  font-size: 1rem;
  font-weight: 600;
  color: #232323;
  user-select: none;
}
.supercal-date {
  padding: 9px 0;
  font-size: 1.12rem;
  border-radius: 7px;
  cursor: pointer;
  font-weight: 600;
  color: #232323;
  background: none;
  border: none;
  margin: 1px 0;
  outline: none;
}
.supercal-date.selected {
  border: 2px solid #ff3b18;
  color: #ff3b18;
  background: #fff;
}
.supercal-date.disabled {
  color: #d2d2d2;
  background: none;
  pointer-events: none;
}
.supercal-confirm {
  width: 100px;
  margin: 0 24px;
  margin-top: 18px;
  background: #ff3b18;
  color: #fff;
  font-size: 1.18rem;
  font-weight: 700;
  border-radius: 11px;
  border: none;
  padding: 15px 0 13px 0;
  cursor: pointer;
  box-shadow: 0 2px 12px rgba(255,59,24,0.09);
  transition: background 0.13s;
}
.supercal-confirm:hover { background: #e7320e; }
@media (max-width: 540px) {
  .supercal-modal {
    width: 99vw;
    left: 50vw;
    min-width: 0;
    border-radius: 11px;
    padding-left: 0;
    padding-right: 0;
  }
  .supercal-header,
  .supercal-days,
  .supercal-dates {
    padding-left: 8px;
    padding-right: 8px;
  }
}




















#noteDropdownWrapper {
  z-index: 10010;
}
#noteDropdownList {
  max-width: 480px;
  min-width: 300px;
  padding-top: 0 !important;
  padding-bottom: 10px !important;
}
#noteDropdownList .custom-input {
  border-radius: 10px;
  border: 2px solid #e5e5e8;
  margin-bottom: 7px;
}
#noteDropdownList .dropdown-item {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 13px 8px 13px 10px;
  font-size: 1.11rem;
  border-radius: 8px;
  font-weight: 600;
  margin: 0 5px 1px 5px;
  background: #fff;
  color: #232323;
  cursor: pointer;
  transition: background 0.15s;
}
#noteDropdownList .dropdown-item:hover {
  background: #f6f7fc;
  color: #1743e3;
}
.note-avatar {
  width: 39px; height: 39px;
  border-radius: 13px;
  display: inline-block;
  object-fit: cover;
  background: #e4e6eb;
  font-size: 1.01rem;
  font-weight: 800;
  color: #fff;
  text-align: center;
  line-height: 39px;
  margin-right: 5px;
  border: none;
}
















.bar-milestone {
  position: absolute;
  top: -32px;
  width: 36px;
  height: 36px;
  text-align: center;
  z-index: 2;
  pointer-events: none;
}
.bar-milestone-circle {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: #FF3B18;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.25rem;
  font-weight: 700;
  margin: 0 auto;
  box-shadow: 0 2px 6px rgba(240,50,30,0.09);
  z-index: 2;
  border: 3px solid #fff;
}
.bar-milestone-arrow {
  width: 0;
  height: 0;
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-top: 11px solid #FF3B18;
  margin: -2px auto 0 auto;
  z-index: 1;
}
.bar-slider-thumb {
  position: absolute;
  top: -13px;
  width: 27px;
  height: 27px;
  background: #fff;
  border: 3px solid #FF3B18;
  border-radius: 50%;
  z-index: 10;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: left 0.18s;
  box-sizing: border-box;
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
               <div id="selectedAssignmentChipList" style="margin-top:10px;"></div>

              <div class="selected-assignment-chip" id="selectedAssignmentChip" style="display:none;">
                <span class="chip-title" id="selectedAssignmentLabel"></span>
                <span class="chip-detail" id="selectedAssignmentDetail"></span>
                <span class="chip-remove" id="removeAssignmentChip" title="Remove">&#10005;</span>
              </div>






        </div>

        <div class="modal-col" style="flex:1.1; position:relative;">
          <input class="custom-input" id="supercal-open-btn" style="padding-right:32px; cursor:pointer;" readonly value="1 Oct, 2024">
          <span class="icon-btn" style="right:20px; top:2; font-size:1.28rem; pointer-events:none;">
            <svg width="20" height="20" fill="none" viewBox="0 0 20 20"><rect width="20" height="20" rx="4" fill="#F6F6F6"/><path d="M6.5 3v2M13.5 3v2M4.2 7.2h11.6M5 17h10a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1Z" stroke="#232323" stroke-width="1.3" stroke-linecap="round"/></svg>
          </span>
          <div style="position:absolute; top:3px; left:16px; font-size:12px; color:#bababa; pointer-events:none;">Due On</div>
        </div>


      </div>
      <div class="note-link" tabindex="0">Make a note for student or group <span class="dropdown-arrow">&#9660;</span></div>
      <div class="note-area">

          <!-- Student/Group Dropdown -->
          <div class="custom-dropdown-wrapper" id="noteDropdownWrapper" style="display:none; margin-bottom:12px;">
            <div class="custom-dropdown-selected" tabindex="0" id="noteDropdownSelected">
              <span id="noteDropdownText">Select Student or Group</span>
              <span class="dropdown-arrow">&#9662;</span>
            </div>
            <div class="custom-dropdown-list" id="noteDropdownList">
              <div style="padding: 12px;">
                <input type="text" class="custom-input" id="noteDropdownSearch" placeholder="Search for student or group" style="font-size:1.03rem; background: #fafbfc;">
              </div>
              <div class="dropdown-group" id="noteDropdownItems">
                <!-- Example items. Replace with your dynamic content if needed -->
                <div class="dropdown-item"><span class="note-avatar" style="background:#1743e3;">FL1</span> Florida 1</div>
                <div class="dropdown-item"><img class="note-avatar" src="https://randomuser.me/api/portraits/women/68.jpg"> Daniela</div>
                <div class="dropdown-item"><img class="note-avatar" src="https://randomuser.me/api/portraits/men/65.jpg"> Kristin Watson</div>
                <div class="dropdown-item"><img class="note-avatar" src="https://randomuser.me/api/portraits/men/66.jpg"> Courtney Henry</div>
                <div class="dropdown-item"><img class="note-avatar" src="https://randomuser.me/api/portraits/women/69.jpg"> Theresa Webb</div>
                <div class="dropdown-item"><img class="note-avatar" src="https://randomuser.me/api/portraits/men/67.jpg"> Arlene McCoy</div>
              </div>
            </div>
          </div>


          <div id="noteChipsList" style="margin-bottom:15px;"></div>



                <!-- Selected Student/Group "note for" UI -->
              <div id="noteForStudentSection" style="display:none; margin-bottom:22px;">
                <div style="display:flex;align-items:center;gap:11px;margin-bottom:7px;">
                  <img id="noteForAvatar" src="" class="note-avatar" style="width:39px;height:39px;">
                  <span id="noteForName" style="font-weight:600;font-size:1.12rem;"></span>
                </div>
                <div style="font-size:1.05rem;margin-bottom:7px;">
                  Write a note for <span id="noteForNameLabel" style="font-weight:500;"></span>
                </div>
                <textarea class="note-textarea" placeholder="First name" id="noteTextarea"></textarea>
                <button type="button" id="noteSubmitBtn" style="width:100%;margin-top:18px;padding:15px 0 13px 0;background:#fff;color:#232323;font-size:1.19rem;font-weight:700;border:2px solid #232323;border-radius:10px;cursor:pointer;transition:.14s;">Submit</button>
              </div>










      </div>
      <div class="slider-label">What was completion percentage of this topic</div>
      
      
        <div class="completion-bar">
          <div class="bar-track">
            <!-- <div class="bar-slider-point" data-idx="0"><div class="bar-point-circle">1</div></div>
            <div class="bar-slider-point" data-idx="1"><div class="bar-point-circle">2</div></div> -->
            <div class="bar-slider-thumb"></div>
          </div>
            <div class="bar-labels">
              <span>0%</span>
              <span>25%</span>
              <span>60%</span>
              <span>80%</span>
              <span>100%</span>
            </div>
        </div>




      <button type="submit" class="modal-submit-btn">Submit</button>
    </form>
  </div>
</div>





<!-- Standalone Calendar Modal (NO dependencies!) -->
<div class="supercal-backdrop" id="supercal-backdrop"></div>
<div class="supercal-modal" id="supercal-modal">
  <div class="supercal-header">
    <button type="button" class="supercal-arrow" id="supercal-prev-month">&#8592;</button>
    <span class="supercal-title" id="supercal-monthyear">October 2024</span>
    <button type="button" class="supercal-arrow" id="supercal-next-month">&#8594;</button>
    <span class="supercal-close" id="supercal-close-btn">&times;</span>
  </div>
  <div class="supercal-days">
    <span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span><span>Su</span>
  </div>
  <div class="supercal-dates" id="supercal-dates"></div>
  <button type="button" class="supercal-confirm" id="supercal-done-btn">Done</button>
</div>



<!-- CHIP HTML: Place this after your assignment and date fields -->
<div class="selected-assignment-chip" id="selectedAssignmentChip" style="display:none; margin-top:10px;">
  <span class="chip-title" id="selectedAssignmentLabel"></span>
  <span class="chip-detail" id="selectedAssignmentDetail"></span>
  <span class="chip-remove" id="removeAssignmentChip" title="Remove" style="cursor:pointer;">&#10005;</span>
</div>

<!-- CALENDAR MODAL HTML (should be at the end of body, outside modals) -->
<div class="supercal-backdrop" id="supercal-backdrop"></div>
<div class="supercal-modal" id="supercal-modal">
  <div class="supercal-header">
    <button type="button" class="supercal-arrow" id="supercal-prev-month">&#8592;</button>
    <span class="supercal-title" id="supercal-monthyear">October 2024</span>
    <button type="button" class="supercal-arrow" id="supercal-next-month">&#8594;</button>
    <span class="supercal-close" id="supercal-close-btn">&times;</span>
  </div>
  <div class="supercal-days">
    <span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span><span>Su</span>
  </div>
  <div class="supercal-dates" id="supercal-dates"></div>
  <button type="button" class="supercal-confirm" id="supercal-done-btn">Done</button>
</div>

<!-- CALENDAR MODAL CSS -->
<style>
.supercal-backdrop {
  position: fixed; left: 0; top: 0; right: 0; bottom: 0;
  background: rgba(80,80,80,0.12); z-index: 22222; display: none;
}
.supercal-modal {
  position: fixed; top: 50%; left: 50%;
  transform: translate(-50%, -50%);
  width: 350px; max-width: 97vw;
  background: #fff; border-radius: 16px;
  box-shadow: 0 8px 44px rgba(60,60,60,0.18);
  z-index: 22223; padding: 0 0 24px 0; display: none;
  flex-direction: column; align-items: stretch;
  animation: supercalFadeIn .18s;
}
@keyframes supercalFadeIn {
  from { opacity: 0; transform: translate(-50%, -60%);}
  to   { opacity: 1; transform: translate(-50%, -50%);}
}
.supercal-header {
  padding: 18px 25px 8px 25px; display: flex;
  align-items: center; justify-content: space-between; position: relative;
}
.supercal-title { font-size: 1.22rem; font-weight: 700; color: #232323; flex: 1; text-align: center; }
.supercal-arrow {
  background: #fff; border: 1.7px solid #e4e4e7; border-radius: 8px;
  width: 36px; height: 36px; font-size: 1.22rem; font-weight: 700;
  color: #232323; cursor: pointer; transition: background 0.14s, border 0.14s; margin: 0 5px;
}
.supercal-close {
  position: absolute; right: 14px; top: 13px;
  font-size: 1.44rem; color: #898989; cursor: pointer;
  padding: 1px 7px; border-radius: 50%;
  transition: background 0.12s, color 0.12s;
}
.supercal-days, .supercal-dates {
  display: grid; grid-template-columns: repeat(7, 1fr);
  padding: 0 25px; text-align: center; font-size: 1rem; font-weight: 600;
}
.supercal-days { color: #949494; user-select: none; margin: 10px 0 6px 0; }
.supercal-dates { color: #232323; user-select: none; }
.supercal-date {
  padding: 9px 0; font-size: 1.12rem; border-radius: 7px;
  cursor: pointer; font-weight: 600; color: #232323;
  background: none; border: none; margin: 1px 0; outline: none;
}
.supercal-date.selected {
  border: 2px solid #ff3b18; color: #ff3b18; background: #fff;
}
.supercal-date.disabled {
  color: #d2d2d2; background: none; pointer-events: none;
}
.supercal-confirm {
  margin: 0 24px; margin-top: 18px;
  background: #ff3b18; color: #fff; font-size: 1.18rem;
  font-weight: 700; border-radius: 11px; border: none;
  padding: 15px 0 13px 0; cursor: pointer;
  box-shadow: 0 2px 12px rgba(255,59,24,0.09);
  transition: background 0.13s;
}
.supercal-confirm:hover { background: #e7320e; }
@media (max-width: 540px) {
  .supercal-modal {
    width: 99vw; left: 50vw; min-width: 0; border-radius: 11px; padding-left: 0; padding-right: 0;
  }
  .supercal-header, .supercal-days, .supercal-dates {
    padding-left: 8px; padding-right: 8px;
  }
}
</style>

<!-- FULL SCRIPT: Dropdowns, accordion, chip, calendar modal -->

<script>
function openDropdownToBody(wrapperSelector, listSelector) {
  var $wrapper = $(wrapperSelector);
  var $list = $(listSelector);

  // Find position and size
  var offset = $wrapper.offset();
  var width = $wrapper.outerWidth();
  var height = $wrapper.outerHeight();

  // Move the list to body
  $list.appendTo('body').css({
    display: 'block',
    position: 'absolute',
    top: offset.top + height + 4,
    left: offset.left,
    width: width,
    zIndex: 99999
  });
  $wrapper.addClass('custom-dropdown-open');

  // Outside click closes dropdown
  $(document).on('mousedown.dropdown', function(e) {
    if (!$(e.target).closest(listSelector + ', ' + wrapperSelector).length) {
      closeDropdownToBody(wrapperSelector, listSelector);
    }
  });
}

function closeDropdownToBody(wrapperSelector, listSelector) {
  var $wrapper = $(wrapperSelector);
  var $list = $(listSelector);

  $wrapper.removeClass('custom-dropdown-open');
  $list.css({
    display: 'none',
    position: '',
    top: '',
    left: '',
    width: '',
    zIndex: ''
  });
  $list.appendTo($wrapper); // Move back into original wrapper
  $(document).off('mousedown.dropdown');
}

$(function() {
  // --- DROPDOWNS ---

  // Topic dropdown open/close
  $('#topicDropdownSelected').on('click', function(e) {
    if ($('#topicDropdownWrapper').hasClass('custom-dropdown-open')) {
      closeDropdownToBody('#topicDropdownWrapper', '#topicDropdownList');
    } else {
      openDropdownToBody('#topicDropdownWrapper', '#topicDropdownList');
    }
    e.stopPropagation();
  });

  // Topic item select
  $('#topicDropdownList').on('click', '.dropdown-item', function() {
    $('#topicDropdownText').text($(this).text());
    closeDropdownToBody('#topicDropdownWrapper', '#topicDropdownList');
  });

  // Topic create
  $('#createTopicBtn').on('click', function() {
    var val = $('#newTopicInput').val().trim();
    if(val) {
      $('#topicDropdownText').text(val);
      $('#newTopicInput').val('');
      closeDropdownToBody('#topicDropdownWrapper', '#topicDropdownList');
    }
  });

  // Assignment dropdown open/close
  $('#assignmentDropdownSelected').on('click', function(e) {
    if ($('#assignmentDropdownWrapper').hasClass('custom-dropdown-open')) {
      closeDropdownToBody('#assignmentDropdownWrapper', '#assignmentDropdownList');
    } else {
      openDropdownToBody('#assignmentDropdownWrapper', '#assignmentDropdownList');
    }
    e.stopPropagation();
  });

  // Accordion logic for Topic dropdown
  $('#topicDropdownList').on('click', '.accordion-toggle', function() {
    var acc = $(this).data('acc');
    $('#topicDropdownList .dropdown-group-label').not(this).parent().removeClass('open');
    $('#topicDropdownList .dropdown-items').not('[data-acc="'+acc+'"]').slideUp(120);
    var $group = $(this).parent();
    var $items = $group.find('.dropdown-items');
    if ($group.hasClass('open')) {
      $group.removeClass('open');
      $items.slideUp(120);
    } else {
      $group.addClass('open');
      $items.slideDown(140);
    }
  });

  // Accordion logic for Assignment dropdown
  $('#assignmentDropdownList').on('click', '.accordion-toggle', function() {
    var acc = $(this).data('acc');
    $('#assignmentDropdownList .dropdown-group-label').not(this).parent().removeClass('open');
    $('#assignmentDropdownList .dropdown-items').not('[data-acc="'+acc+'"]').slideUp(120);
    var $group = $(this).parent();
    var $items = $group.find('.dropdown-items');
    if ($group.hasClass('open')) {
      $group.removeClass('open');
      $items.slideUp(120);
    } else {
      $group.addClass('open');
      $items.slideDown(140);
    }
  });

  // --- MULTI-CHIP LOGIC (NEW) ---
  // Make sure you have: <div id="selectedAssignmentChipList" style="margin-top:10px;"></div> in your HTML

  function addAssignmentChip() {
    var assignment = $('#assignmentDropdownText').text().trim();
    var date = $('#supercal-open-btn').val().trim();

    // Find assignment group label (e.g., "Homework" or "Quiz")
    var $selectedItem = $('#assignmentDropdownList .dropdown-item').filter(function() {
      return $(this).text().trim() === assignment;
    });
    var label = '';
    if ($selectedItem.length) {
      label = $selectedItem.closest('.dropdown-group').find('.dropdown-group-label span').first().text().trim();
    }

    // Only add if both selected and not "Assignment"
    if (assignment !== '' && assignment !== 'Assignment' && date !== '') {
      // Unique key for deduplication (group+assignment+date)
      var key = label + "|" + assignment + "|" + date;

      // Prevent duplicate chips
      var alreadyExists = $('#selectedAssignmentChipList .assignment-chip').filter(function() {
        return $(this).data('chipKey') === key;
      }).length > 0;

      if (!alreadyExists) {
var chipHtml =
  `<div class="custom-chip-bar assignment-chip" data-chip-key="${key}">
      <span class="chip-left">
        <span class="chip-label"><b>${label ? label : ''}</b></span>
        <span class="chip-assignment"> ${assignment}:</span>
      </span>
      <span class="chip-details">${date}</span>
      <span class="chip-remove" title="Remove">&#10005;</span>
   </div>`;
$('#selectedAssignmentChipList').append(chipHtml);

      }
    }
  }

  // Remove individual chip (event delegation)
  $(document).on('click', '.chip-remove', function() {
    $(this).closest('.assignment-chip').remove();
  });

  // Assignment dropdown select: (NO CHIP added here! just update text)
  $('#assignmentDropdownList').on('click', '.dropdown-item', function() {
    $('#assignmentDropdownText').text($(this).text());
    closeDropdownToBody('#assignmentDropdownWrapper', '#assignmentDropdownList');
    // No chip added here
  });

  // --- CALENDAR MODAL ---
  let supercalSelectedDate = new Date(2024, 9, 1); // Oct 1, 2024
  let supercalTempDate = new Date(supercalSelectedDate);
  let supercalMonth = supercalTempDate.getMonth();
  let supercalYear = supercalTempDate.getFullYear();

  function supercalFormatDate(d) {
    const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    return d.getDate() + " " + months[d.getMonth()] + ", " + d.getFullYear();
  }

  function supercalRenderCalendar(month, year, selDate) {
    $('#supercal-monthyear').text(
      new Date(year, month).toLocaleString('default', { month: 'long', year: 'numeric' })
    );
    let firstDay = new Date(year, month, 1);
    let lastDay = new Date(year, month+1, 0);
    let daysInMonth = lastDay.getDate();
    let startDay = (firstDay.getDay() + 6) % 7;
    let html = '';
    let dayNum = 1;
    for(let row=0; row<6; row++) {
      for(let col=0; col<7; col++) {
        if(row === 0 && col < startDay) {
          html += `<span class="supercal-date disabled"></span>`;
        } else if(dayNum > daysInMonth) {
          html += `<span class="supercal-date disabled"></span>`;
        } else {
          let isSelected = selDate &&
            dayNum === selDate.getDate() &&
            month === selDate.getMonth() &&
            year === selDate.getFullYear();
          html += `<span class="supercal-date${isSelected ? ' selected' : ''}" data-date="${year}-${month+1}-${dayNum}">${dayNum}</span>`;
          dayNum++;
        }
      }
    }
    $('#supercal-dates').html(html);
  }

  function showSupercalModal() {
    supercalTempDate = new Date(supercalSelectedDate);
    supercalMonth = supercalTempDate.getMonth();
    supercalYear = supercalTempDate.getFullYear();
    supercalRenderCalendar(supercalMonth, supercalYear, supercalTempDate);
    $('#supercal-backdrop').show();
    $('#supercal-modal').show();
  }
  function closeSupercalModal() {
    $('#supercal-backdrop').hide();
    $('#supercal-modal').hide();
  }

  // Open calendar when clicking input field
  $('#supercal-open-btn').on('click', function(e) {
    e.stopPropagation();
    showSupercalModal();
  });

  // Calendar prev/next month
  $('#supercal-prev-month').click(function() {
    supercalMonth--;
    if(supercalMonth < 0) { supercalMonth = 11; supercalYear--; }
    supercalRenderCalendar(supercalMonth, supercalYear, supercalTempDate);
  });
  $('#supercal-next-month').click(function() {
    supercalMonth++;
    if(supercalMonth > 11) { supercalMonth = 0; supercalYear++; }
    supercalRenderCalendar(supercalMonth, supercalYear, supercalTempDate);
  });

  // Date select
  $('#supercal-modal').on('click', '.supercal-date:not(.disabled)', function() {
    $('#supercal-modal .supercal-date').removeClass('selected');
    $(this).addClass('selected');
    let parts = $(this).attr('data-date').split('-');
    supercalTempDate = new Date(parts[0], parts[1]-1, parts[2]);
  });

  // Done: Update input and CHIP, then close (CHIP ONLY ADDED HERE!)
  $('#supercal-done-btn').click(function() {
    supercalSelectedDate = new Date(supercalTempDate);
    $('#supercal-open-btn').val(supercalFormatDate(supercalSelectedDate));
    closeSupercalModal();
    addAssignmentChip();
  });

  // Close modal
  $('#supercal-backdrop, #supercal-close-btn').click(function() {
    closeSupercalModal();
  });

  // Esc key closes
  $(document).on('keydown', function(e) {
    if(e.key === "Escape") closeSupercalModal();
  });

  // Parse date from field if exists on load
  let fieldVal = $('#supercal-open-btn').val();
  if(fieldVal) {
    let match = fieldVal.match(/^(\d+)\s+([A-Za-z]+),\s*(\d{4})$/);
    if(match) {
      let months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
      let m = months.indexOf(match[2]);
      if(m > -1) supercalSelectedDate = new Date(parseInt(match[3]), m, parseInt(match[1]));
    }
  }





  

  // NOTE: If you want to use this dropdown elsewhere, change IDs to classes!

// Show/hide student/group dropdown on note-link click
$('.note-link').on('click', function() {
  // Toggle note-area as before

  // Show/hide the note dropdown
  if($('#noteDropdownWrapper').is(':visible')) {
    $('#noteDropdownWrapper').slideUp(110);
    closeDropdownToBody('#noteDropdownWrapper', '#noteDropdownList');
  } else {
    $('#noteDropdownWrapper').slideDown(140);
  }
});

// Open/close logic for custom dropdown (select field)
$('#noteDropdownSelected').on('click', function(e) {
  if ($('#noteDropdownWrapper').hasClass('custom-dropdown-open')) {
    closeDropdownToBody('#noteDropdownWrapper', '#noteDropdownList');
  } else {
    openDropdownToBody('#noteDropdownWrapper', '#noteDropdownList');
    $('#noteDropdownSearch').focus();
  }
  e.stopPropagation();
});

// Item selection
$('#noteDropdownList').on('click', '.dropdown-item', function() {
  var name = $(this).text().trim();
  $('#noteDropdownText').text(name);
  closeDropdownToBody('#noteDropdownWrapper', '#noteDropdownList');
});

// Fuzzy search/filter logic
$('#noteDropdownSearch').on('input', function() {
  var val = $(this).val().toLowerCase();
  $('#noteDropdownItems .dropdown-item').each(function() {
    var txt = $(this).text().toLowerCase();
    $(this).toggle(txt.indexOf(val) !== -1);
  });
});

// Close on outside click (reusing closeDropdownToBody logic)
// Already handled via closeDropdownToBody above




// This will store selected avatar URL and name for the UI
$('#noteDropdownList').on('click', '.dropdown-item', function() {
  // Parse out the avatar and name from dropdown item
  var $item = $(this);
  var avatarSrc = '';
  var name = $item.text().trim();

  // Check if item has image or FL1 (badge)
  var $img = $item.find('img');
  var $badge = $item.find('span.note-avatar');

  if ($img.length) {
    avatarSrc = $img.attr('src');
    $('#noteForAvatar').attr('src', avatarSrc).show();
  } else if ($badge.length) {
    // Render badge as an SVG or fallback img, but for now use a data-uri or blank with initials
    // Here, just set blank src and show the FL1 text in avatar box
    $('#noteForAvatar').attr('src', '').hide(); // Hide for initials only
    $('#noteForAvatar').after('<span id="noteForBadge" class="note-avatar" style="background:#1743e3;margin-left:-39px;margin-top:0;position:relative;z-index:2;">'+$badge.text()+'</span>');
  } else {
    $('#noteForAvatar').attr('src', '').hide();
  }

  $('#noteForName').text(name);
  $('#noteForNameLabel').text(name);

  // Hide dropdown, show note UI
  closeDropdownToBody('#noteDropdownWrapper', '#noteDropdownList');
  $('#noteDropdownWrapper').slideUp(120);
  $('#noteForStudentSection').slideDown(180);

  // Remove any old badge avatars if needed
  $('#noteForAvatar').show();
  $('#noteForBadge').remove();

  // If selected is badge only (no image), swap avatar image for badge text
  if ($img.length === 0 && $badge.length) {
    $('#noteForAvatar').hide();
    $('#noteForBadge').show();
  }
});

// Optional: When you open the note section again, reset the UI
$('.note-link').on('click', function() {
  $('#noteForStudentSection').hide();
  $('#noteForAvatar').attr('src','').show();
  $('#noteForBadge').remove();
  $('#noteTextarea').val('');
});






// Handle note submission (chip add, dropdown reappear)
$('#noteSubmitBtn').on('click', function() {
  var noteText = $('#noteTextarea').val().trim();
  var name = $('#noteForName').text();
  var avatarSrc = $('#noteForAvatar').attr('src');
  var badge = $('#noteForBadge').text() || "";
  if (!noteText) return;

  // Build the chip
  var chipHtml = `<div class="custom-chip-bar note-chip" style="margin-bottom:7px;align-items:center;">
    ${avatarSrc 
      ? `<img src="${avatarSrc}" class="note-avatar" style="width:32px;height:32px;border-radius:9px;object-fit:cover;margin-right:8px;">`
      : badge
        ? `<span class="note-avatar" style="width:32px;height:32px;border-radius:9px;display:inline-flex;align-items:center;justify-content:center;font-size:1rem;background:#1743e3;color:#fff;margin-right:8px;">${badge}</span>`
        : ''
    }
    <span style="font-weight:600;margin-right:7px;">${name}</span>
    <span style="color:#8a8a8a;font-size:1.04rem;flex:1 1 auto;">${noteText}</span>
    <span class="chip-remove" style="font-size:1.43rem;padding:4px 8px 2px 8px;cursor:pointer;">&#10005;</span>
  </div>`;

  $('#noteChipsList').append(chipHtml);

  // Reset and show dropdown again
  $('#noteForStudentSection').hide();
  $('#noteForAvatar').attr('src','').show();
  $('#noteForBadge').remove();
  $('#noteTextarea').val('');
  $('#noteDropdownWrapper').slideDown(120);
});

// Remove chip on close
$(document).on('click', '.note-chip .chip-remove', function() {
  $(this).closest('.note-chip').remove();
});



});










$(function() {
  // Milestone steps (no 0%!)
  const steps = [
    { percent: 25, label: "1" },
    { percent: 60, label: "2" },
    { percent: 80, label: "3" },
    { percent: 100, label: "4" }
  ];
  let currentIdx = 0; // Start at 25%

  function renderBar(idx) {
    let $track = $('.bar-track');
    $track.find('.bar-milestone, .bar-slider-thumb').remove();

    // Render milestone circles (for completed steps ONLY, never 0%)
    for (let i = 0; i < steps.length; i++) {
      if (i < idx) {
        $track.append(`
          <div class="bar-milestone" style="left:calc(${steps[i].percent}% - 18px);">
            <div class="bar-milestone-circle">${steps[i].label}</div>
            <div class="bar-milestone-arrow"></div>
          </div>
        `);
      }
    }
    // Render thumb at the active/current step
    $track.append(`
      <div class="bar-slider-thumb" style="left:calc(${steps[idx].percent}% - 13px);"></div>
    `);

    // Progress bar fill
    $track.css('background', `linear-gradient(90deg,#FF3B18 0 ${steps[idx].percent}%,#ededed ${steps[idx].percent}% 100%)`);

    // Highlight active % label
    $('.bar-labels span').removeClass('selected');
    $('.bar-labels span').each(function() {
      let label = $(this).text().replace('%', '').trim();
      if (parseInt(label) === steps[idx].percent) {
        $(this).addClass('selected').css({color:'#FF3B18','font-weight':'700'});
      } else {
        $(this).css({color:'', 'font-weight':''});
      }
    });
  }

  function getClosestIdx(pageX) {
    let trackLeft = $('.bar-track').offset().left;
    let w = $('.bar-track').width();
    let rel = ((pageX - trackLeft) / w) * 100;
    let minDist = Infinity, idx = 0;
    for (let i = 0; i < steps.length; i++) {
      let d = Math.abs(rel - steps[i].percent);
      if (d < minDist) { minDist = d; idx = i; }
    }
    return idx;
  }

  let dragging = false;
  $(document).on('mousedown touchstart', '.bar-slider-thumb', function(e) {
    dragging = true; e.preventDefault();
  });
  $(document).on('mousemove touchmove', function(e) {
    if (!dragging) return;
    let pageX = e.type === "touchmove" ? e.originalEvent.touches[0].pageX : e.pageX;
    let idx = getClosestIdx(pageX);
    if (idx !== currentIdx) {
      currentIdx = idx;
      renderBar(currentIdx);
    }
  });
  $(document).on('mouseup touchend', function() { dragging = false; });

  // Click bar to jump to nearest step
  $('.bar-track').on('click', function(e) {
    let pageX = e.type === "touchstart" ? e.originalEvent.touches[0].pageX : e.pageX;
    let idx = getClosestIdx(pageX);
    if (idx !== currentIdx) {
      currentIdx = idx;
      renderBar(currentIdx);
    }
  });

  // INITIAL RENDER (always start at 25%)
  renderBar(currentIdx);
});
</script>
