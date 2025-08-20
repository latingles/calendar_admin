<!-- ===== Trigger button (demo) ===== -->
<button type="button" class="calendar_admin_details_lesson_information_btn"
        style="border:1.5px solid #e7e7ef;border-radius:10px;padding:10px 16px;font-weight:700;background:#111;color:#fff;">
  Lesson info
</button>

<!-- ===== Backdrop (shared by center modal + right drawer) ===== -->
<div id="calendar_admin_details_lesson_information_backdrop" class="calendar_admin_details_lesson_information_scope">
  <!-- ===== CENTER MODAL: Lesson information ===== -->
  <div class="calendar_admin_details_lesson_information_modal" role="dialog" aria-modal="true" aria-labelledby="cali_title">
    <div class="calendar_admin_details_lesson_information_header">
      <h5 id="cali_title" class="calendar_admin_details_lesson_information_title">Lesson information</h5>
      <button type="button" class="calendar_admin_details_lesson_information_close" aria-label="Close">
        <svg width="22" height="22" viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18" stroke="#111" stroke-width="2" stroke-linecap="round"/></svg>
      </button>
    </div>

    <div class="calendar_admin_details_lesson_information_body">
      <div class="calendar_admin_details_lesson_information_card">
        <div class="calendar_admin_details_lesson_information_row">
          <img class="calendar_admin_details_lesson_information_avatar"
               src="https://randomuser.me/api/portraits/men/32.jpg" alt="Student">
          <div class="calendar_admin_details_lesson_information_main">
            <div class="calendar_admin_details_lesson_information_day">Tuesday , Sep 03</div>
            <div class="calendar_admin_details_lesson_information_time">7:00 – 7:25 PM</div>
          </div>
        </div>
        <hr class="calendar_admin_details_lesson_information_divider">
        <div class="calendar_admin_details_lesson_information_meta_row">
          <div class="calendar_admin_details_lesson_information_meta">Jonas | Subscription</div>
          <div class="calendar_admin_details_lesson_information_wallet">
            <svg width="26" height="26" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M21 7H5a2 2 0 0 1 0-4h12" fill="none" stroke="#444" stroke-width="1.6" stroke-linecap="round"/>
              <rect x="3" y="5" width="18" height="14" rx="2" ry="2" fill="none" stroke="#444" stroke-width="1.6"/>
              <circle cx="17" cy="12" r="1.2" fill="#444"/>
            </svg>
            <span class="calendar_admin_details_lesson_information_lessons">2 Lessons</span>
          </div>
        </div>
      </div>

      <button type="button" class="calendar_admin_details_lesson_information_action"
              id="calendar_admin_details_lesson_information_open_chat">Message</button>
      <button type="button" class="calendar_admin_details_lesson_information_action" id="calendar_admin_details_1_1_class">View Or Reschedule Lesson</button>
      <button type="button" class="calendar_admin_details_lesson_information_danger" id="calendar_admin_details_lesson_information_cancel_trigger">Cancel Lesson</button>
    </div>
  </div>

  <!-- ===== RIGHT DRAWER: Message ===== -->
  <aside class="calendar_admin_details_lesson_information_drawer" role="dialog" aria-modal="true"
         aria-labelledby="cali_chat_title">
    <!-- Header -->
    <div class="calendar_admin_details_lesson_information_drawer_header">
      <div class="calendar_admin_details_lesson_information_drawer_titlewrap">
        <div class="calendar_admin_details_lesson_information_header_avatar">
          <svg width="22" height="22" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" fill="#fff"/><path d="M4 20c1.8-4 6.2-6 8-6s6.2 2 8 6" stroke="#fff" stroke-width="1.5" fill="none"/></svg>
        </div>
        <span class="calendar_admin_details_lesson_information_drawer_title" id="cali_chat_title">Jonas</span>
      </div>
      <button type="button" class="calendar_admin_details_lesson_information_drawer_close" aria-label="Close">
        <svg width="22" height="22" viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18" stroke="#111" stroke-width="2" stroke-linecap="round"/></svg>
      </button>
    </div>

    <!-- Messages -->
    <div class="calendar_admin_details_lesson_information_drawer_body">
      <div class="calendar_admin_details_lesson_information_chat_stamp">Today</div>

      <!-- Daniela -->
      <div class="calendar_admin_details_lesson_information_msg">
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Daniela">
        <div class="calendar_admin_details_lesson_information_msg_content">
          <div class="calendar_admin_details_lesson_information_msg_head">
            <strong>Daniela</strong> <span>09:34</span>
          </div>
          <div class="calendar_admin_details_lesson_information_msg_text">
            Good morning, I want to confirm our meeting today and ask if the meeting will take place within the Latingles virtual classroom or will you provide the information?
          </div>
        </div>
      </div>

      <!-- Self 1 -->
      <div class="calendar_admin_details_lesson_information_msg self">
        <div class="calendar_admin_details_lesson_information_avatar_circle">
          <svg width="20" height="20" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" fill="#fff"/><path d="M4 20c1.8-4 6.2-6 8-6s6.2 2 8 6" stroke="#fff" stroke-width="1.5" fill="none"/></svg>
        </div>
        <div class="calendar_admin_details_lesson_information_msg_content">
          <div class="calendar_admin_details_lesson_information_msg_head">
            <strong>Latingles</strong> <span>11:06</span>
          </div>
          <div class="calendar_admin_details_lesson_information_msg_text">I'm already in, is anyone joining</div>
        </div>
      </div>

      <!-- Self 2 -->
      <div class="calendar_admin_details_lesson_information_msg self">
        <div class="calendar_admin_details_lesson_information_avatar_circle">
          <svg width="20" height="20" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" fill="#fff"/><path d="M4 20c1.8-4 6.2-6 8-6s6.2 2 8 6" stroke="#fff" stroke-width="1.5" fill="none"/></svg>
        </div>
        <div class="calendar_admin_details_lesson_information_msg_content">
          <div class="calendar_admin_details_lesson_information_msg_head">
            <strong>Latingles</strong> <span>11:06</span>
          </div>
          <div class="calendar_admin_details_lesson_information_msg_text">Yes Please wait for me ! Thank you</div>
        </div>
      </div>
    </div>

    <!-- Composer panel (matches your snapshot) -->
    <div class="calendar_admin_details_lesson_information_drawer_footer">
      <div class="calendar_admin_details_lesson_information_composerPanel">
        <textarea class="calendar_admin_details_lesson_information_textarea"
                  rows="1" placeholder="Your message"></textarea>

        <div class="calendar_admin_details_lesson_information_composerActions">
          <div class="calendar_admin_details_lesson_information_actions_left">
            <input type="file" id="calendar_admin_details_lesson_information_file" style="display:none">
            <button type="button" class="calendar_admin_details_lesson_information_icon" id="calendar_admin_details_lesson_information_attach" title="Attach">
              <svg width="22" height="22" viewBox="0 0 24 24"><path d="M21 8l-9.4 9.4a5 5 0 01-7.1-7.1L14.5 0" fill="none" stroke="#777" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
            <button type="button" class="calendar_admin_details_lesson_information_icon" id="calendar_admin_details_lesson_information_emoji" title="Emoji">
              <svg width="22" height="22" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" fill="none" stroke="#777" stroke-width="1.7"/><circle cx="9" cy="10" r="1"/><circle cx="15" cy="10" r="1"/><path d="M8 14c1.2 1.3 2.6 2 4 2s2.8-.7 4-2" fill="none" stroke="#777" stroke-width="1.7" stroke-linecap="round"/></svg>
            </button>
          </div>

          <div class="calendar_admin_details_lesson_information_actions_right">
            <button type="button" class="calendar_admin_details_lesson_information_icon" id="calendar_admin_details_lesson_information_mic" title="Voice">
              <svg width="22" height="22" viewBox="0 0 24 24"><rect x="9" y="3" width="6" height="10" rx="3" fill="none" stroke="#777" stroke-width="1.7"/><path d="M5 11a7 7 0 0014 0M12 18v3" fill="none" stroke="#777" stroke-width="1.7" stroke-linecap="round"/></svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </aside>
</div>
<?php require_once('calendar_admin_details_lesson_information_cancel_lesson.php');?>

<style>
/* ===== Backdrop ===== */
#calendar_admin_details_lesson_information_backdrop.calendar_admin_details_lesson_information_scope{
  position: fixed; inset: 0; z-index: 2000;
  display: none; align-items: center; justify-content: center; padding: 18px;
  background: rgba(0,0,0,.45);
}

/* ===== Center Modal ===== */
.calendar_admin_details_lesson_information_modal{
  width:100%; max-width:520px; background:#fff;
  border:1px solid #e9e9f0; border-radius:12px; overflow:hidden;
  box-shadow:0 20px 50px rgba(0,0,0,.12);
}
.calendar_admin_details_lesson_information_header{ display:flex; align-items:center; justify-content:space-between; padding:18px 20px 6px; }
.calendar_admin_details_lesson_information_title{ margin:0; font-weight:800; font-size:1.65rem; letter-spacing:.2px; color:#111; }
.calendar_admin_details_lesson_information_close{ background:transparent; border:0; width:38px; height:38px; border-radius:8px; display:grid; place-items:center; cursor:pointer; }
.calendar_admin_details_lesson_information_body{ padding:12px 20px 20px; }
.calendar_admin_details_lesson_information_card{ border:1px solid #e9e9f0; border-radius:12px; padding:14px; background:#fff; }
.calendar_admin_details_lesson_information_row{ display:flex; align-items:center; gap:12px; }
.calendar_admin_details_lesson_information_avatar{ width:48px; height:48px; border-radius:10px; object-fit:cover; }
.calendar_admin_details_lesson_information_day{ font-weight:800; font-size:1.22rem; color:#111; line-height:1.1; }
.calendar_admin_details_lesson_information_time{ color:#6b7280; font-weight:600; margin-top:2px; line-height:1.1; }
.calendar_admin_details_lesson_information_divider{ margin:12px 0; border:0; height:1px; background:#ececf3; }
.calendar_admin_details_lesson_information_meta_row{ display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap; }
.calendar_admin_details_lesson_information_meta{ color:#2f323a; font-weight:600; }
.calendar_admin_details_lesson_information_wallet{ display:flex; align-items:center; gap:8px; }
.calendar_admin_details_lesson_information_lessons{ color:#4b4f5c; font-weight:700; }
.calendar_admin_details_lesson_information_action{
  width:100%; margin-top:12px; background:#fff; color:#1e1f25; font-weight:700;
  border:1.25px solid #e7e7ef; border-radius:10px; padding:12px 16px; transition:box-shadow .15s ease;
}
.calendar_admin_details_lesson_information_action:hover{ box-shadow:0 6px 18px rgba(0,0,0,.06); }
.calendar_admin_details_lesson_information_danger{
  width:100%; margin-top:14px; background:#ef2d17; color:#fff; font-weight:800; border:0; border-radius:10px; padding:12px 16px; box-shadow:0 10px 26px rgba(239,45,23,.25);
}

/* ===== Right Drawer ===== */
.calendar_admin_details_lesson_information_drawer{
  position:absolute; right:18px; top:18px; bottom:18px;
  width:540px; max-width:calc(100% - 36px);
  background:#fff; border:1px solid #e9e9f0; border-radius:12px;
  box-shadow:0 20px 50px rgba(0,0,0,.12);
  display:flex; flex-direction:column;
  transform:translateX(30px); opacity:0; pointer-events:none;
  transition:transform .18s ease, opacity .18s ease;
}
.calendar_admin_details_lesson_information_drawer_header{
  display:flex; align-items:center; justify-content:space-between;
  padding:16px 18px; border-bottom:1px solid #f0f0f4;
}
.calendar_admin_details_lesson_information_drawer_titlewrap{ display:flex; align-items:center; gap:10px; }
.calendar_admin_details_lesson_information_header_avatar{
  width:32px;height:32px;border-radius:50%;background:#111;display:flex;align-items:center;justify-content:center;color:#fff;
}
.calendar_admin_details_lesson_information_drawer_title{ font-weight:800; font-size:1.25rem; text-decoration:underline; color:#111; }
.calendar_admin_details_lesson_information_drawer_close{ background:transparent; border:0; width:36px; height:36px; border-radius:8px; display:grid; place-items:center; cursor:pointer; }

.calendar_admin_details_lesson_information_drawer_body{ padding:14px 18px; overflow:auto; flex:1; }
.calendar_admin_details_lesson_information_chat_stamp{
  display:inline-block; background:#eef1f6; color:#555; font-weight:700;
  padding:6px 12px; border-radius:9px; margin:8px auto 14px; text-align:center;
}
.calendar_admin_details_lesson_information_msg{ display:flex; gap:10px; margin-bottom:18px; align-items:flex-start; }
.calendar_admin_details_lesson_information_msg img{ width:36px; height:36px; border-radius:50%; object-fit:cover; }
.calendar_admin_details_lesson_information_msg.self .calendar_admin_details_lesson_information_avatar_circle{
  width:36px; height:36px; border-radius:50%; background:#9aa3b2; display:flex; align-items:center; justify-content:center;
}
.calendar_admin_details_lesson_information_msg_content{ max-width:100%; }
.calendar_admin_details_lesson_information_msg_head{ color:#2b2b2b; margin-bottom:4px; }
.calendar_admin_details_lesson_information_msg_head span{ color:#9aa0a6; font-weight:700; margin-left:6px; }
.calendar_admin_details_lesson_information_msg_text{ color:#222; line-height:1.45; }

/* ===== Composer PANEL (outer rounded box + inner input + icon row) ===== */
.calendar_admin_details_lesson_information_drawer_footer{
  border-top:1px solid #f0f0f4; padding:12px; background:#fff;
  padding-bottom: calc(12px + env(safe-area-inset-bottom));
}
.calendar_admin_details_lesson_information_composerPanel{
  background:#fff; border:1px solid #dfe2ea; border-radius:16px;
  padding:10px; box-shadow:0 2px 10px rgba(20,20,20,.03);
}
.calendar_admin_details_lesson_information_textarea{
  width:100%; border:1px solid #e1e3eb; background:#fff; color:#111;
  outline:none; resize:none; border-radius:12px;
  padding:12px 14px; min-height:100px; max-height:160px; line-height:1.35;
}
.calendar_admin_details_lesson_information_textarea::placeholder{ color:#b2b6c3; }

/* icon row under the textarea */
.calendar_admin_details_lesson_information_composerActions{
  display:flex; align-items:center; gap:8px; margin-top:10px;
}
.calendar_admin_details_lesson_information_actions_left{ display:flex; align-items:center; gap:8px; }
.calendar_admin_details_lesson_information_actions_right{ margin-left:auto; display:flex; align-items:center; gap:8px; }

.calendar_admin_details_lesson_information_icon{
  background:#fff; border:1px solid #e1e3eb; width:38px; height:38px;
  border-radius:10px; display:grid; place-items:center; cursor:pointer;
}
.calendar_admin_details_lesson_information_icon:hover{ background:#f7f8fb; }

/* ===== States ===== */
#calendar_admin_details_lesson_information_backdrop.calendar_admin_details_lesson_information_scope.is-open{ display:flex; }
.calendar_admin_details_lesson_information_drawer.is-open{ transform:translateX(0); opacity:1; pointer-events:auto; }

/* ===== Responsive ===== */
@media (max-width: 992px){
  .calendar_admin_details_lesson_information_drawer{ right:10px; left:10px; width:auto; max-width:none; }
}
@media (max-width: 430px){
  .calendar_admin_details_lesson_information_title{ font-size:1.45rem; }
  .calendar_admin_details_lesson_information_day{ font-size:1.11rem; }
  .calendar_admin_details_lesson_information_avatar{ width:44px; height:44px; border-radius:9px; }
}
</style>

<script>
(function($){
  const $backdrop = $('#calendar_admin_details_lesson_information_backdrop');
  const $modal    = $backdrop.find('.calendar_admin_details_lesson_information_modal');
  const $drawer   = $backdrop.find('.calendar_admin_details_lesson_information_drawer');

  function openBackdrop(){
    $backdrop.addClass('is-open').hide().fadeIn(100);
    $('body').css('overflow','hidden');
  }
  function closeAll(){
    $drawer.removeClass('is-open');
    $backdrop.fadeOut(100, function(){ $backdrop.removeClass('is-open'); });
    $('body').css('overflow','');
  }
  function openLessonInfo(){ openBackdrop(); }
  function openChatDrawer(){
    if (!$backdrop.hasClass('is-open')) openBackdrop();
    $drawer.addClass('is-open');
    setTimeout(()=>$('.calendar_admin_details_lesson_information_textarea').trigger('focus'), 120);
  }

  // Openers
  $('.calendar_admin_details_lesson_information_btn').on('click', openLessonInfo);
  $('#calendar_admin_details_lesson_information_open_chat').on('click', openChatDrawer);

  // Closers
  $('.calendar_admin_details_lesson_information_close, .calendar_admin_details_lesson_information_drawer_close').on('click', closeAll);
  $backdrop.on('click', function(e){ if (e.target === this) closeAll(); });

  // Prevent bubbling
  $modal.on('click', function(e){ e.stopPropagation(); });
  $drawer.on('click', function(e){ e.stopPropagation(); });

  // ESC
  $(document).on('keyup', function(e){ if (e.key === 'Escape') closeAll(); });

  // Textarea auto-grow
  const $ta = $('.calendar_admin_details_lesson_information_textarea');
  function autosizeTA(el){
    el.style.height = 'auto';
    const h = Math.min(el.scrollHeight, 160);
    el.style.height = (h < 52 ? 52 : h) + 'px';   // comfy minimum like snapshot
  }
  $ta.each(function(){ autosizeTA(this); });
  $ta.on('input', function(){ autosizeTA(this); });

  // Attach -> hidden file picker
  $('#calendar_admin_details_lesson_information_attach').on('click', function(){
    $('#calendar_admin_details_lesson_information_file').trigger('click');
  });
})(jQuery);


//======================= 1_1_CLASS Tab =========================//
$('#calendar_admin_details_1_1_class').on('click', function () {
    const $mgmt = $('#calendar_admin_details_create_cohort_modal_backdrop');
    const $lesson = $('#calendar_admin_details_lesson_information_backdrop');

    // Tabs UI
    $mgmt.find('.calendar_admin_details_create_cohort_tab').removeClass('active');
    $mgmt.find('.calendar_admin_details_create_cohort_tab[data-tab="class"]').addClass('active');

    // --- Hide Lesson Info while Management is open ---
    $lesson.hide();

    // --- Open Management ---
    $mgmt.css('z-index', 1065).fadeIn(120);

    // Content switches for the Management modal
    $('#calendar_admin_details_create_cohort_content').html('');
    $('#mergeTabContent, #conferenceTabContent, #peerTalkTabContent, #addTimeTabContent, #addExtraSlotsTabContent, #mainModalContent').hide();
    $('#classTabContent').show();
});

/* When Management closes, show Lesson Info modal */
// $(document).on('click', '#calendar_admin_details_create_cohort_modal_backdrop .calendar_admin_details_create_cohort_close', function () {
//     const $mgmt = $('#calendar_admin_details_create_cohort_modal_backdrop');
//     const $lesson = $('#calendar_admin_details_lesson_information_backdrop');

//     $mgmt.fadeOut(120, function () {
//         // Show Lesson Info after Management closes
//         $lesson.css('z-index', 1068).fadeIn(120);
//     });
// });

/* Optional: click outside Management to close it */
// $('#calendar_admin_details_create_cohort_modal_backdrop').on('click', function (e) {
//     if (e.target === this) {
//         $(this).find('.calendar_admin_details_create_cohort_close').trigger('click');
//     }
// });














</script>
