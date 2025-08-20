<!-- ===== Scoped styles so nothing else in Moodle is affected ===== -->
<style>
  .lat2 * { box-sizing: border-box; }
  .lat2 .busy-box{
    background:#fffefa; border:2px solid #f1c94a; border-radius:14px;
    box-shadow:0 6px 18px rgba(20,20,20,.06); padding:10px 12px; cursor:pointer;
    display:inline-block; min-width:180px; transition:transform .08s ease;
  }
  .lat2 .busy-box:active{ transform:scale(.98); }
  .lat2 .busy-title{ color:#a07400; font-weight:700; }
  .lat2 .busy-time{ color:#3b3b3b; font-size:.9rem; }

  /* Backdrop + modal (pure jQuery; no Bootstrap JS) */
  .lat2 .lat-backdrop{
    position:fixed; inset:0; display:none; align-items:center; justify-content:center;
    background:rgba(0,0,0,.45); z-index:1060; padding:18px;
  }

  .lat2 .lat-dialog{
    width:520px; max-width:92vw; background:#fff; border-radius:10px;
    box-shadow:0 18px 60px rgba(0,0,0,.22); transform:translateY(10px);
    opacity:0; transition:opacity .18s ease, transform .18s ease;
  }
  .lat2 .lat-dialog.show{ opacity:1; transform:translateY(0); }

  /* Header exactly like snapshot */
  .lat2 .lat-header{ padding:16px 22px 12px 22px; display:flex; align-items:flex-start; justify-content:space-between; }
  .lat2 .lat-title{
    color:#e53935; font-weight:700; font-size:1.05rem; line-height:1; position:relative;
    display:inline-block; padding-bottom:10px; margin-top:2px;
  }
  .lat2 .lat-title:after{
    content:""; position:absolute; left:0; bottom:-24px; height:3px; width:92px;
    background:#e53935; border-radius:2px;
  }
  .lat2 .lat-hr{ height:1px; background:#ececec; }
  .lat2 .lat-close{
    border:0; background:transparent; width:34px; height:34px; opacity:.8; margin-top:2px;
  }
  .lat2 .lat-close:hover{ opacity:1; }

  /* Body spacing */
  .lat2 .lat-body{ padding:14px 22px 10px 22px; }

  /* Busy line (ring + text, no pill) */
  .lat2 .lat-busyline{ display:flex; align-items:center; gap:12px; margin-bottom:6px; }
  .lat2 .lat-busyline .ring{
    width:18px; height:18px; border-radius:50%; background:#fff; border:2px solid #f1c94a; display:inline-block;
  }
  .lat2 .lat-busytext{ font-weight:700; color:#111; }

  /* Date + Time same row */
  .lat2 .lat-dt-row{ display:flex; align-items:flex-start; gap:12px; margin-top:14px; }
  .lat2 .lat-icon{ width:20px; height:20px; margin-top:2px; opacity:.95; }
  .lat2 .lat-dt-wrap{ display:flex; align-items:flex-start; gap:18px; }
  .lat2 .lat-col-date{ min-width:180px; }
  .lat2 .lat-date { font-weight:700; color:#1b1c1d; }
  .lat2 .lat-weekday { color:#7b7f86; margin-top:4px; }
  .lat2 .lat-vbar{ width:1px; background:#e6e6e6; height:40px; margin:0 6px; }
  .lat2 .lat-time { font-weight:700; color:#0f141a; }
  .lat2 .lat-duration { color:#6c7a89; font-weight:700; font-size:.95rem; margin-top:6px; }

  /* Footer button identical to screenshot */
  .lat2 .lat-footer{ padding:8px 22px 18px 22px; }
  .lat2 .btn-cancel{
    width:100%; border:2px solid #e53935; color:#e53935; background:#fff; font-weight:700;
    border-radius:12px; padding:12px 16px;
  }
  .lat2 .btn-cancel:hover{ background:#fff6f6; }

  @media (max-width: 480px){
    .lat2 .lat-dialog{ border-radius:16px; }
  }
</style>

<div class="lat2 container mt-3">
  <!-- Example BUSY box (click to open). Duplicate anywhere in your grid. -->
  <div class="busy-box"
       data-date="September 26"
       data-weekday="Thursday"
       data-start="07:30"
       data-end="07:30">
    <div class="busy-title">Busy</div>
    <div class="busy-time">6:00 – 7:00 AM</div>
  </div>

  <!-- ===== Modal (pure HTML/CSS, opened via jQuery) ===== -->
  <div id="latBusyBackdrop" class="lat-backdrop" aria-hidden="true">
    <div class="lat-dialog" role="dialog" aria-modal="true" aria-labelledby="latBusyTitle">
      <div class="lat-header">
        <h5 id="latBusyTitle" class="lat-title mb-0">Time off</h5>
        <button type="button" class="lat-close" id="latBusyClose" aria-label="Close">
          <svg width="16" height="16" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12" stroke="#4a4a4a" stroke-width="2" stroke-linecap="round"/></svg>
        </button>
      </div>
      <div class="lat-hr"></div>

      <div class="lat-body">
        <!-- Busy line -->
        <div class="lat-busyline">
          <span class="ring"></span>
          <span class="lat-busytext">Busy Time</span>
        </div>

        <!-- Date + Time in the SAME row -->
        <div class="lat-dt-row">
          <!-- single leading icon (clock style) -->
          <svg class="lat-icon" viewBox="0 0 24 24" fill="none">
            <circle cx="12" cy="12" r="9" stroke="#111" stroke-width="1.6"/>
            <path d="M12 7v5l3 2" stroke="#111" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>

          <div class="lat-dt-wrap">
            <div class="lat-col-date">
              <div id="latDate" class="lat-date">September 26</div>
              <div id="latWeekday" class="lat-weekday">Thursday</div>
            </div>

            <div class="lat-vbar"></div>

            <div>
              <div class="lat-time">
                <span id="latStart">07:30</span>
                <span class="mx-2" style="display:inline-flex;vertical-align:middle">
                  <svg width="22" height="16" viewBox="0 0 24 24"><path d="M4 12h14M13 5l7 7-7 7" fill="none" stroke="#111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <span id="latEnd">07:30</span>
              </div>
              <div id="latDuration" class="lat-duration">30 minutes</div>
            </div>
          </div>
        </div>
      </div>

      <div class="lat-footer">
        <button type="button" class="btn btn-cancel" id="latCancelBtn">Cancel time off</button>
      </div>
    </div>
  </div>
</div>

<!-- ===== jQuery only (Moodle already includes it) ===== -->
<script>
  (function($){
    function minutesDiff(hm1, hm2){
      var a = (hm1||'0:0').split(':'), b = (hm2||'0:0').split(':');
      var m1 = (+a[0])*60 + (+a[1]), m2 = (+b[0])*60 + (+b[1]);
      var d = m2 - m1; if (d < 0) d += 1440; return d;
    }
    function openLatModal(){
      const $backdrop = $('#latBusyBackdrop');
      const $dlg = $backdrop.find('.lat-dialog');
      $backdrop.css('display','flex');
      setTimeout(()=> $dlg.addClass('show'), 10);
      $('body').addClass('modal-open').css('overflow','hidden');
    }
    function closeLatModal(){
      const $backdrop = $('#latBusyBackdrop');
      const $dlg = $backdrop.find('.lat-dialog');
      $dlg.removeClass('show');
      setTimeout(()=>{ $backdrop.hide(); $('body').removeClass('modal-open').css('overflow',''); }, 180);
    }

    // Open from any busy box and populate values (duration auto if not provided)
    $('.lat2').on('click', '.busy-box', function(){
      const $b = $(this);
      const start = ($b.data('start') || '').toString();
      const end   = ($b.data('end')   || '').toString();

      $('#latDate').text($b.data('date') || '');
      $('#latWeekday').text($b.data('weekday') || '');
      $('#latStart').text(start);
      $('#latEnd').text(end);

      const dur = $b.data('duration') || (minutesDiff(start, end) + ' minutes');
      $('#latDuration').text(dur);

      openLatModal();
    });

    // Close actions
    $('#latBusyClose, #latCancelBtn').on('click', closeLatModal);
    $('#latBusyBackdrop').on('click', function(e){ if (e.target === this) closeLatModal(); });
    $(document).on('keydown', function(e){ if (e.key === 'Escape' && $('#latBusyBackdrop').is(':visible')) closeLatModal(); });
  })(jQuery);
</script>
