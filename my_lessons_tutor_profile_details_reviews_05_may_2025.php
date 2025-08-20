<style>
    /* Backdrop */
#my_lessons_tutor_profile_modal_backdrop {
  display: none;
  position: fixed; top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0.4);
  z-index: 999;
}

/* Modal container */
#my_lessons_tutor_profile_modal {
  display: none;
  position: fixed;
   top: 400px;
   left: 50%;
  transform: translate(-50%, -50%);
  width: 600px; max-width: 90%;
  background: #fff; border-radius: 8px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.2);
  z-index: 1000;
  overflow: hidden;
}

/* Header */
.my_lessons_tutor_profile_modal_header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #f5f5f5;
  padding: 12px 16px;
}
.my_lessons_tutor_profile_modal_company {
  font-size: 14px;
  color: #444;
  display: flex;
  align-items: center;
  gap: 4px;
}
.my_lessons_tutor_profile_modal_drop_arrow {
  cursor: pointer;
}
.my_lessons_tutor_profile_modal_close {
  font-size: 20px;
  background: none;
  border: none;
  cursor: pointer;
}

/* Body */
.my_lessons_tutor_profile_modal_body {
  padding: 24px;
  font-family: system-ui, sans-serif;
  color: #1d1d1f;
}
.my_lessons_tutor_profile_modal_body h3 {
  margin: 0 0 16px;
  font-size: 1.2rem;
  display: flex;
  align-items: center;
  gap: 8px;
}
.my_lessons_tutor_profile_modal_info {
  color: #6e6e73;
}

/* Rating summary */
.my_lessons_tutor_profile_modal_rating_summary {
  display: flex;
  align-items: center;
  gap: 16px;
  margin-bottom: 16px;
}
.modal_avg {
  font-size: 3rem;
  line-height: 1;
}
.modal_stars {
  font-size: 1.2rem;
  color: #f5a623;
}
.modal_total {
  color: #6e6e73;
  font-size: 0.9rem;
}

/* Bars */
.my_lessons_tutor_profile_modal_bars {
  list-style: none;
  padding: 0;
  margin: 0 0 24px;
}
.my_lessons_tutor_profile_modal_bars li {
  display: flex;
  align-items: center;
  margin-bottom: 6px;
  gap: 8px;
}
.my_lessons_tutor_profile_modal_bars li > span:first-child {
  width: 16px;
  font-size: 0.9rem;
}
.bar_bg {
  flex: 1;
  height: 8px;
  background: #eee;
  border-radius: 4px;
  overflow: hidden;
}
.bar_fill {
  height: 100%;
  background: #1d1d1f;
}

/* Review edit */
.my_lessons_tutor_profile_modal_review_edit {
  margin-top: 16px;
}
.my_lessons_tutor_profile_modal_avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 12px;
}
.my_lessons_tutor_profile_modal_review_meta {
  font-size: 0.9rem;
  color: #3c3c43;
  display: flex;
  gap: 8px;
  margin-bottom: 12px;
  align-items: center;
}

/* Star input */
.my_lessons_tutor_profile_modal_star_input {
  margin-bottom: 16px;
}
.my_lessons_tutor_profile_modal_star_input span {
  font-size: 24px;
  cursor: pointer;
  color: #ccc;
  margin-right: 4px;
}
.my_lessons_tutor_profile_modal_star_input .selected {
  color: #f5a623;
}

/* Textarea */
#my_lessons_tutor_profile_modal_text {
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 8px;
  font-size: 1rem;
  margin-bottom: 24px;
  resize: vertical;
}

/* Actions */
.my_lessons_tutor_profile_modal_actions {
  display: flex;
  justify-content: flex-end;
  gap: 12px;
}
#my_lessons_tutor_profile_modal_cancel {
  background: #fff;
  border: 1px solid #444;
  color: #444;
  padding: 8px 16px;
  border-radius: 4px;
  cursor: pointer;
}
#my_lessons_tutor_profile_modal_update {
  background: #ff3b30;
  border: none;
  color: #fff;
  padding: 8px 16px;
  border-radius: 4px;
  cursor: pointer;
}

</style>


<!-- Edit Button (wherever you need it) -->
<button id="my_lessons_tutor_profile_edit_button" class="my_lessons_tutor_profile_edit_button">
  <i class="fas fa-pencil-alt"></i>
</button>

<!-- Modal Backdrop -->
<div id="my_lessons_tutor_profile_modal_backdrop"></div>

<!-- Modal -->
<div id="my_lessons_tutor_profile_modal">
  <div class="my_lessons_tutor_profile_modal_header">
    <div class="my_lessons_tutor_profile_modal_company">
      <span>Latingles Designs</span>
      <span class="my_lessons_tutor_profile_modal_drop_arrow">▼</span>
    </div>
    <button id="my_lessons_tutor_profile_modal_close" class="my_lessons_tutor_profile_modal_close">×</button>
  </div>
  <div class="my_lessons_tutor_profile_modal_body">
    <h3>
      What my students say
      <i class="fas fa-info-circle my_lessons_tutor_profile_modal_info"></i>
    </h3>

    <!-- summary -->
    <div class="my_lessons_tutor_profile_modal_rating_summary">
      <div class="modal_avg">5</div>
      <div class="modal_stars">★★★★★</div>
      <div class="modal_total">3 reviews</div>
    </div>

    <!-- breakdown bars -->
    <ul class="my_lessons_tutor_profile_modal_bars">
      <li><span>5</span><div class="bar_bg"><div class="bar_fill" style="width:100%"></div></div><span>(3)</span></li>
      <li><span>4</span><div class="bar_bg"><div class="bar_fill" style="width:0%"></div></div><span>(0)</span></li>
      <li><span>3</span><div class="bar_bg"><div class="bar_fill" style="width:0%"></div></div><span>(0)</span></li>
      <li><span>2</span><div class="bar_bg"><div class="bar_fill" style="width:0%"></div></div><span>(0)</span></li>
      <li><span>1</span><div class="bar_bg"><div class="bar_fill" style="width:0%"></div></div><span>(0)</span></li>
    </ul>

    <!-- edit your review -->
    <div class="my_lessons_tutor_profile_modal_review_edit">
      <img src="https://i.imgur.com/your-logo.png" alt="Latingles" class="my_lessons_tutor_profile_modal_avatar">
      <div class="my_lessons_tutor_profile_modal_review_meta">
        <strong>Latingles</strong>
        <span>May 12, 2025</span>
      </div>

      <div class="my_lessons_tutor_profile_modal_star_input">
        <span data-value="1">★</span>
        <span data-value="2">★</span>
        <span data-value="3">★</span>
        <span data-value="4">★</span>
        <span data-value="5">★</span>
      </div>

      <textarea id="my_lessons_tutor_profile_modal_text" rows="4">excellent teacher. great experience</textarea>

      <div class="my_lessons_tutor_profile_modal_actions">
        <button id="my_lessons_tutor_profile_modal_cancel">Cancel</button>
        <button id="my_lessons_tutor_profile_modal_update">Update review</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(function(){
    // open
    $('#my_lessons_tutor_profile_edit_button').on('click', function(){
      $('#my_lessons_tutor_profile_modal_backdrop, #my_lessons_tutor_profile_modal')
        .fadeIn(200);
      // initialize stars to 5
      $('.my_lessons_tutor_profile_modal_star_input span')
        .addClass('selected')
        .text('★');
    });
    // close
    function closeModal(){
      $('#my_lessons_tutor_profile_modal_backdrop, #my_lessons_tutor_profile_modal')
        .fadeOut(200);
    }
    $('#my_lessons_tutor_profile_modal_close, #my_lessons_tutor_profile_modal_cancel, #my_lessons_tutor_profile_modal_backdrop')
      .on('click', closeModal);

    // star rating input
    $('.my_lessons_tutor_profile_modal_star_input').on('click', 'span', function(){
      var val = +$(this).data('value');
      $('.my_lessons_tutor_profile_modal_star_input span').each(function(){
        var v = +$(this).data('value');
        if (v <= val) {
          $(this).addClass('selected').text('★');
        } else {
          $(this).removeClass('selected').text('★')
                 .css('color','#ccc');
        }
      });
    });
  });
</script>
