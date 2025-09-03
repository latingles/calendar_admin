 <link rel="stylesheet" href="css/my_lessons_details_reshedule.css"/>
<?php
require_once("../../config.php");
// require_once($CFG->dirroot. '/course/lib.php');
$PAGE->requires->css(new moodle_url('./style.css?v=' . time()), true);
$PAGE->requires->css(new moodle_url('./course.css?v=' . time()), true);

echo $OUTPUT->header();

?>

<div class="noSelect">
    <div class="wrapper">
    <header>
        <ul>
        <li><a href="" class="active">Home</a></li>
        <li><a href="">Messages</a></li>
        <li><a href="">My lessons</a></li>
        <li><a href="">Learn</a></li>
        <li><a href="">Settings</a></li>
        </ul>
        <div class="findTutors_and_findGroups">
        <a href="">Find Tutors</a>
        <a href="">Find Groups</a>
        </div>
    </header>

   </div>
 </div>


<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->


<div class="container-xxl py-3 my_lessons_details_reshedule_shell">
  <div class="row h-100 g-0">
    <!-- LEFT -->
    <div class="col-lg-8 pe-lg-4 my_lessons_details_reshedule_left" id="my_lessons_details_reshedule_leftpane">
      <div class="d-flex align-items-center justify-content-between">
        <h1 class="my_lessons_details_reshedule_h1 mb-0" id="my_lessons_details_reshedule_week">Feb 16 – 22, 2025</h1>
        <div class="my_lessons_details_reshedule_nav">
          <button type="button" class="btn" id="my_lessons_details_reshedule_prev">⟨</button>
          <button type="button" class="btn" id="my_lessons_details_reshedule_next">⟩</button>
        </div>
      </div>
      <div class="my_lessons_details_reshedule_note mt-1 mb-3">In your time zone: <span id="my_lessons_details_reshedule_tz">America/New_York (GMT -5:00)</span></div>

      <div class="my_lessons_details_reshedule_days" id="my_lessons_details_reshedule_days">
        <div class="my_lessons_details_reshedule_daypill">Sun 16</div>
        <div class="my_lessons_details_reshedule_daypill" style="background:#fff;border-color:#e6e7ef;color:#111">Mon 17</div>
        <div class="my_lessons_details_reshedule_daypill" style="background:#fff;border-color:#e6e7ef;color:#111">Tue 18</div>
        <div class="my_lessons_details_reshedule_daypill" style="background:#fff;border-color:#e6e7ef;color:#111">Wed 19</div>
        <div class="my_lessons_details_reshedule_daypill" style="background:#fff;border-color:#e6e7ef;color:#111">Thu 20</div>
        <div class="my_lessons_details_reshedule_daypill" style="background:#fff;border-color:#e6e7ef;color:#111">Fri 21</div>
        <div class="my_lessons_details_reshedule_daypill" style="background:#fff;border-color:#e6e7ef;color:#111">Sat 22</div>
      </div>

      <!-- Grid -->
      <div class="my_lessons_details_reshedule_grid" id="my_lessons_details_reshedule_grid"></div>
      <div class="py-4"></div>
    </div>

    <!-- RIGHT -->
    <div class="col-lg-4 my_lessons_details_reshedule_right">
      <div class="my_lessons_details_reshedule_right_sticky">
        <div class="my_lessons_details_reshedule_panel">
          <button class="my_lessons_details_reshedule_close" id="my_lessons_details_reshedule_close" aria-label="Close">×</button>
          <div class="my_lessons_details_reshedule_card">
            <div class="my_lessons_details_reshedule_tutor">
              <img class="my_lessons_details_reshedule_avatar" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=400&auto=format&fit=crop" alt="">
              <div>
                <div class="my_lessons_details_reshedule_title">English with Daniela</div>
                <a href="#" class="my_lessons_details_reshedule_link">50 min lessons <span aria-hidden="true">▾</span></a>
              </div>
            </div>

            <div class="my_lessons_details_reshedule_label">Current lesson time</div>
            <div class="my_lessons_details_reshedule_mutedline">Wed, Feb 19, 12:00 – 12:50</div>

            <div class="my_lessons_details_reshedule_label">New lesson time</div>
            <div class="my_lessons_details_reshedule_chipfield" id="my_lessons_details_reshedule_chipfield">
              <div class="my_lessons_details_reshedule_phField" id="my_lessons_details_reshedule_placeholder">Lesson</div>
            </div>

            <button class="my_lessons_details_reshedule_cta" id="my_lessons_details_reshedule_cta" disabled>Reschedule</button>
            <div class="my_lessons_details_reshedule_policy">Cancel or reschedule for free up to 12 hrs<br>before the lesson starts.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
echo $OUTPUT->footer();
?>


<script src="js/my_lessons_details_reshedule.js"></script>
