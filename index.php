<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Lists the course categories
 *
 * @copyright 1999 Martin Dougiamas  http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package course
 */

require_once("../config.php");
require_once($CFG->dirroot. '/course/lib.php');

$PAGE->requires->css(new moodle_url('./style.css?v=' . time()), true);
$PAGE->requires->css(new moodle_url('./calendar.css?v=' . time()), true);
$PAGE->requires->css(new moodle_url('./MessageBox.css?v=' . time()), true);
$PAGE->requires->css(new moodle_url('./course.css?v=' . time()), true);
$PAGE->requires->css(new moodle_url('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css'), true);
$PAGE->requires->js(new moodle_url('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js '), true);

$user = $USER;
$urlCourse = new moodle_url($CFG->wwwroot .'/course/view.php?id');

$categoryid = optional_param('categoryid', 0, PARAM_INT); // Category id
$site = get_site();

if ($CFG->forcelogin) {
    require_login();
}


$heading = $site->fullname;


if ($categoryid) {
    $category = core_course_category::get($categoryid); // This will validate access.
    $PAGE->set_category_by_id($categoryid);
    $PAGE->set_url(new moodle_url('/course/index.php', array('categoryid' => $categoryid)));
    $PAGE->set_pagetype('course-index-category');
    $heading = $category->get_formatted_name();
} else if ($category = core_course_category::user_top()) {
    // Check if there is only one top-level category, if so use that.
    $categoryid = $category->id;
    $PAGE->set_url('/course/index.php');
    if ($category->is_uservisible() && $categoryid) {
        $PAGE->set_category_by_id($categoryid);
        $PAGE->set_context($category->get_context());
        if (!core_course_category::is_simple_site()) {
            $PAGE->set_url(new moodle_url('/course/index.php', array('categoryid' => $categoryid)));
            $heading = $category->get_formatted_name();
        }
    } else {
        $PAGE->set_context(context_system::instance());
    }
    $PAGE->set_pagetype('course-index-category');
} else {
    // throw new moodle_exception('cannotviewcategory');
}

$PAGE->set_pagelayout('coursecategory');
$PAGE->set_primary_active_tab('home');
$PAGE->add_body_class('limitedwidth');
$courserenderer = $PAGE->get_renderer('core', 'course');

$PAGE->set_heading($heading);
$content = $courserenderer->course_category($categoryid);

$PAGE->set_secondary_active_tab('categorymain');

echo $OUTPUT->header();

// Ejecutamos la consulta
$cursos = $DB->get_records('course', null, 'fullname ASC');

$cursosArray = [];
// Mostrar los cursos
function ordering($fullname) {
    // Usamos una expresión regular para obtener el número al final del fullname
    preg_match('/(\d+)$/', $fullname, $coincidencias);
    return isset($coincidencias[1]) ? (int)$coincidencias[1] : 0;
}

// Mostrar los cursos
foreach ($cursos as $curso) {
    // Creamos un objeto para almacenar la información del curso
    $cursoObj = new stdClass();
    $cursoObj->id = $curso->id;
    $cursoObj->fullname = $curso->fullname;
    $cursoObj->category = $curso->category;
    $cursoObj->summary = $curso->summary;

    // Verificar si el usuario está inscrito en el curso
    if (is_enrolled(context_course::instance($curso->id), $user)) {
        $cursoObj->inscrito = true; // El usuario está inscrito
    } else {
        $cursoObj->inscrito = false; // El usuario NO está inscrito
    }

    // Añadir el objeto curso al array
    $cursosArray[] = $cursoObj;
}

// Ordenar el array de cursos según el número al final del fullname
usort($cursosArray, function($a, $b) {
    return ordering($a->fullname) - ordering($b->fullname);
});
if (is_siteadmin($user->id)) {
    // echo $content; // Aquí va el contenido que quieres mostrar
} else {
    echo "";
}
function verificarInscripcion($cursos, $id) {
    $bol = false;  // Inicializamos bol como false para el caso en que no se encuentre el id

    // Recorremos todos los cursos
    foreach ($cursos as $curso) {
        // Verificamos si el fullname del curso coincide con el nombre
        if ($curso->id == $id) {
            // Si el curso está inscrito, retornamos true, si no, false
            if ($curso->inscrito === true) {
                $bol = true;  // El usuario está inscrito
            }
            return $bol;  // Salimos de la función inmediatamente
        }
    } 
    return $bol;  // Si no encuentra el nombre en los cursos, devuelve false
}

function getLink($cursos, $id, $url) {
    foreach ($cursos as $curso) {
        if ($curso->id == $id && !empty($curso->inscrito)) {
            return $url . "=" . $id; // Si está inscrito, devuelve la URL
        }
    }
    return "#"; // Si no está inscrito o no se encontró el curso, devuelve "#"
}

if (is_siteadmin($user->id)) {
    echo $content; // Aquí va el contenido que quieres mostrar
} else {
    echo "";
}
echo $OUTPUT->skip_link_target(); ?>

<script>
    function joinClass(url) {
        //window.location.href = url;  // Redirect to the sample URL
        window.open(url, '_blank');  // Open the URL in a new window or tab
    }
    function redirectToRecordings(cohortId, courseid) {
        if(courseid && cohortId){
            window.location.href = 'sessionRecordings.php?cohortid=' + cohortId + '&courseid=' + courseid;
        }
     // Ensure both googleMeetId and id (cmid) are included in the URL query string
    }
</script>
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

    <section class="page_top">
        <div class="center_content">
            <?php
            
            
            if (isloggedin()) {
                if (!is_siteadmin($user->id)) {

                    global $DB;
                
                    // Fetch the course details using the idnumber.
                    $course = $DB->get_record('course', ['idnumber' => 'CR001'], '*');
                
                    // SQL query to fetch the cohort names the user belongs to
                    $sql = "SELECT c.id, c.name
                            FROM {cohort} c
                            JOIN {cohort_members} cm ON cm.cohortid = c.id
                            WHERE cm.userid = :userid";
                
                    // Execute the query and fetch the results
                    $cohorts = $DB->get_records_sql($sql, ['userid' => $user->id]);
                
                
                    foreach ($cohorts as $cohort) {
                        $cohortid = $cohort->id;
                    }
                    
                
                    // Fetch all sections in the course
                $sections = $DB->get_records('course_sections', ['course' => $course->id], 'section ASC');
                
                // Loop through sections to find those restricted to the cohort
                $allowed_sections = [];
                foreach ($sections as $section) {
                    if (!empty($section->availability)) {
                        // Decode the availability JSON
                        $availability = json_decode($section->availability, true);
                
                        // Check if there is a cohort restriction
                        if (isset($availability['c']) && is_array($availability['c'])) {
                            foreach ($availability['c'] as $condition) {
                                if ($condition['type'] === 'cohort' && $condition['id'] == $cohortid) {
                                    $allowed_sections[] = $section;
                                    break;
                                }
                            }
                        }
                    }
                }
                
                $googleMeetActivities = []; // Array to store Google Meet activities with their upcoming schedules
                
                if (!empty($allowed_sections)) {
                    //echo "Topics allowed for cohort ID $cohortid:<br>";
                
                    foreach ($allowed_sections as $section) {
                        //echo "Section: " . $section->section . " - " . $section->name . "<br>";
                
                        // Fetch all modules in this section
                        $modules = $DB->get_records('course_modules', ['section' => $section->id]);
                
                        if (!empty($modules)) {
                            //echo "Activities in this section:<br>";
                
                            foreach ($modules as $module) {
                                // Get module information from modinfo
                                $modinfo = $DB->get_record('modules', ['id' => $module->module]);
                
                                if ($modinfo && $modinfo->name === 'googlemeet') { // Check if it's a Google Meet module
                                    // Fetch Google Meet activity details
                                    $googleMeetActivity = $DB->get_record('googlemeet', ['id' => $module->instance]);
                                    if ($googleMeetActivity) {
                                        $schedules[] = [
                                            'starthour' => $googleMeetActivity->starthour,
                                            'startminute' => $googleMeetActivity->startminute,
                                            'days' => $googleMeetActivity->days,
                                        ];
                
                                        // Fetch the upcoming schedule for this Google Meet activity
                                        $sql = "SELECT * 
                                                FROM {googlemeet_events}
                                                WHERE googlemeetid = :googlemeetid 
                                                AND eventdate > :currenttime
                                                ORDER BY eventdate ASC
                                                LIMIT 1";
                                        $params = [
                                            'googlemeetid' => $googleMeetActivity->id,
                                            'currenttime' => time()
                                        ];
                                        $upcomingSchedule = $DB->get_record_sql($sql, $params);
                
                                        // Store activity details and the upcoming schedule
                                        $googleMeetActivities[] = (object) [
                                            'name' => $googleMeetActivity->name,
                                            'section' => $section->section,
                                            'module_id' => $module->id,
                                            'upcoming_schedule' => $upcomingSchedule
                                        ];
                
                                        //echo "- Google Meet: " . $googleMeetActivity->name . "<br>";
                                        if ($upcomingSchedule) {
                                            //echo "-- Upcoming Event Date: " . date('Y-m-d H:i:s', $upcomingSchedule->eventdate) . "<br>";
                                        // echo "-- Duration: " . $upcomingSchedule->duration . " minutes<br>";
                                        } else {
                                            //echo "-- No upcoming schedule found.<br>";
                                        }
                                    }
                                }
                            }
                        } else {
                            //echo "No activities found in this section.<br>";
                        }
                    }
                
                    // Final Output
                    if (!empty($googleMeetActivities)) {
                        $mostUpcomingSchedule = null;
                        //echo "<br>Final Google Meet Activities with Upcoming Schedules:<br>";
                        foreach ($googleMeetActivities as $activity) {
                            //echo "- " . $activity->name . " (Section: " . $activity->section . ")<br>";
                    
                            if ($activity->upcoming_schedule) {
                
                            // Directly compare eventdate for each activity to find the most upcoming one
                            if (!$mostUpcomingSchedule || $activity->upcoming_schedule->eventdate < $mostUpcomingSchedule->eventdate) {
                                $d = $activity->upcoming_schedule->eventdate;
                                $s = $mostUpcomingSchedule?->eventdate ?? null;
                                $mostUpcomingSchedule = $activity->upcoming_schedule;
                            }
                            } else {
                                //echo "-- No upcoming schedule found.<br>";
                            }
                        }
                    } 
                } else {
                    //echo "No topics are restricted to cohort ID $cohortid in this course.";
                }
                
                // Fetch the Google Meet activity record
                if($mostUpcomingSchedule){
                    $googleMeet = $DB->get_record('googlemeet', ['id' => $mostUpcomingSchedule->googlemeetid], '*', MUST_EXIST);
                
                }
                // Extract the URL from the record
                $googleMeetURL = $googleMeet->url;
                $dayOrder = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
                // Master array to store sorted data across schedules
                $allDaysWithHours = [];

                // Collect available days and their timings
                foreach ($schedules as $schedule) {
                    // Convert starthour and startminute to a 12-hour format with AM/PM
                    $hour24 = $schedule['starthour'];
                    $minute = str_pad($schedule['startminute'], 2, "0", STR_PAD_LEFT); // Ensure 2 digits for minutes
                    $formattedHour = date("g:i A", strtotime("$hour24:$minute"));

                    // Decode the JSON data in 'days'
                    $days = json_decode($schedule['days'], true); // Decoded as associative array

                    // Sort and add available days to the master array
                    foreach ($dayOrder as $day) {
                        if (isset($days[$day]) && $days[$day] === "1") {
                            $allDaysWithHours[$day][] = $formattedHour; // Group timings by day
                        }
                    }
                }

                // Ensure all days are present and in sorted order
                foreach ($dayOrder as $day) {
                    if (!isset($allDaysWithHours[$day])) {
                        $allDaysWithHours[$day] = []; // Add empty entry for non-available days
                    }
                }
                ?> 
                <div class="rightSide">
                    <div class="row01">
                    <h1 class="selectGroup_titleChange">Your 1 on 1 starts soon</h1>
                    <div href="" class="whichTutor_open">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="40"
                        height="40"
                        viewBox="0 0 40 40"
                        fill="none"
                        >
                        <path
                            d="M14.8295 9.5C14.64 9.5 14.4582 9.5753 14.3241 9.70935C14.1901 9.84339 14.1148 10.0252 14.1148 10.2148V11.3277H11.8475C11.2792 11.3293 10.7347 11.5557 10.3328 11.9575C9.93088 12.3592 9.7043 12.9037 9.70251 13.472V15.602H29.7178V13.472C29.7162 12.9037 29.4898 12.3592 29.088 11.9573C28.6863 11.5554 28.1418 11.3288 27.5735 11.327H25.3063V10.2155C25.3063 10.1216 25.2878 10.0287 25.2519 9.94198C25.2159 9.85526 25.1633 9.77647 25.0969 9.7101C25.0305 9.64372 24.9518 9.59108 24.865 9.55516C24.7783 9.51924 24.6854 9.50075 24.5915 9.50075C24.4977 9.50075 24.4047 9.51924 24.318 9.55516C24.2313 9.59108 24.1525 9.64372 24.0861 9.7101C24.0197 9.77647 23.9671 9.85526 23.9312 9.94198C23.8953 10.0287 23.8768 10.1216 23.8768 10.2155V11.3285H15.5443V10.2148C15.5443 10.1209 15.5258 10.0279 15.4899 9.94123C15.4539 9.85451 15.4013 9.77572 15.3349 9.70935C15.2685 9.64297 15.1898 9.59033 15.103 9.55441C15.0163 9.51849 14.9234 9.5 14.8295 9.5ZM25.5005 19.4705C27.1228 19.4705 28.6025 20.0997 29.7178 21.1145V17.033H9.70326V26.483C9.70505 27.0513 9.93163 27.5957 10.3335 27.9975C10.7354 28.3993 11.28 28.6257 11.8483 28.6273H20.0038C19.5181 27.7268 19.265 26.7193 19.2673 25.6962C19.2673 22.265 22.0625 19.4705 25.5005 19.4705Z"
                            fill="black"
                        />
                        <path
                            d="M25.5005 30.5C28.145 30.5 30.2968 28.3482 30.2968 25.6962C30.2954 24.4246 29.7896 23.2055 28.8905 22.3063C27.9913 21.4071 26.7721 20.9014 25.5005 20.9C22.8485 20.9 20.6968 23.0517 20.6968 25.6962C20.697 26.9702 21.2031 28.192 22.104 29.0928C23.0048 29.9936 24.2266 30.4998 25.5005 30.5ZM24.071 24.9815H24.7858V24.2667C24.7855 24.1728 24.8038 24.0797 24.8396 23.9929C24.8754 23.906 24.928 23.8271 24.9945 23.7607C25.0609 23.6942 25.1398 23.6416 25.2267 23.6058C25.3135 23.57 25.4066 23.5517 25.5005 23.552C25.8935 23.552 26.2153 23.8737 26.2153 24.2667V24.9815H26.93C27.323 24.9815 27.6448 25.3032 27.6448 25.6962C27.6451 25.7902 27.6268 25.8833 27.591 25.9701C27.5552 26.057 27.5025 26.1359 27.4361 26.2023C27.3697 26.2687 27.2908 26.3214 27.2039 26.3572C27.117 26.393 27.024 26.4113 26.93 26.411H26.2153V27.1257C26.2156 27.2197 26.1973 27.3128 26.1615 27.3996C26.1257 27.4865 26.073 27.5654 26.0066 27.6318C25.9402 27.6982 25.8613 27.7509 25.7744 27.7867C25.6875 27.8225 25.5945 27.8408 25.5005 27.8405C25.4064 27.8414 25.3131 27.8235 25.2259 27.7879C25.1388 27.7523 25.0597 27.6997 24.9931 27.6332C24.9266 27.5666 24.8739 27.4875 24.8383 27.4003C24.8027 27.3132 24.7849 27.2199 24.7858 27.1257V26.411H24.071C23.9769 26.4119 23.8836 26.394 23.7964 26.3584C23.7093 26.3228 23.6302 26.2702 23.5636 26.2037C23.4971 26.1371 23.4444 26.058 23.4088 25.9708C23.3732 25.8837 23.3554 25.7904 23.3563 25.6962C23.356 25.6023 23.3743 25.5092 23.4101 25.4224C23.4459 25.3355 23.4985 25.2566 23.565 25.1902C23.6314 25.1237 23.7103 25.0711 23.7972 25.0353C23.884 24.9995 23.9771 24.9812 24.071 24.9815Z"
                            fill="black"
                        />
                        </svg>
                    </div>
                    </div>

                    <div class="row02">
                    <div class="row02_leftSide">
                        <div class="imageContainer">
                        <img
                            src="../img/cour/1.png"
                            alt=""
                            class="selectGroup_changeImage"
                        />
                        </div>

                        <div class="col02 selectGroup_changeContent">
                        <h5>Today</h5>
                        <h1>Monday, 09:30 - 10:20</h1>
                        <p>Weekly English with <?php echo $cohort->name; ?></p>
                        </div>
                    </div>

                    <div class="row02_rightSide">
                        <div class="threeDots userOptionOpen">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M3 10H7V14H3V10ZM10 10H14V14H10V10ZM21 10H17V14H21V10Z"
                            fill="#121117"
                            />
                        </svg>
                        </div>
                        
                        <?php if ($googleMeet) { ?>
                            <button class="joinLesson"  onclick='joinClass(<?php echo json_encode($googleMeetURL) ?>)'>Join Lesson</button>
                        <?php } ?>
                    </div>
                    </div>

                    <div class="row03">
                    <div class="top">
                        <h5>Up Next</h5>
                        <a href="">See all (12)</a>
                    </div>

                    <div class="bottom">
                        <div class="card">
                        <div class="content">
                            <div class="card_leftSide selectGroupBTN">
                            <p>January 15</p>
                            <h1>Wednesday, 5:00 - 6:00</h1>
                            <p class="shortText">Group Class with Florida 1</p>
                            </div>

                            <div class="threeDots userOptionOpen">
                            <svg
                                width="18"
                                height="4"
                                viewBox="0 0 18 4"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M0 0H4V4H0V0ZM7 0H11V4H7V0ZM18 0H14V4H18V0Z"
                                fill="#121117"
                                />
                            </svg>
                            </div>
                        </div>
                        <div class="underline"></div>
                        </div>
                        <div class="card">
                        <div class="content">
                            <div class="card_leftSide">
                            <p>January 17</p>
                            <h1>Friday, 4:00 - 5:50</h1>
                            <div class="shortDetail">
                                <p>1 on 1</p>
                                <div class="userShortDetail">
                                <div class="imageContainer">
                                    <img src="../img/cour/1.png" alt="" />
                                </div>
                                <p>Dinela</p>
                                </div>
                            </div>
                            </div>

                            <div class="threeDots userOptionOpen">
                            <svg
                                width="18"
                                height="4"
                                viewBox="0 0 18 4"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M0 0H4V4H0V0ZM7 0H11V4H7V0ZM18 0H14V4H18V0Z"
                                fill="#121117"
                                />
                            </svg>
                            </div>
                        </div>
                        <div class="underline"></div>
                        </div>
                        <div class="card">
                        <div class="content">
                            <div class="card_leftSide">
                            <p>January 15</p>
                            <h1>Wednesday, 16:00-16:50</h1>
                            <div class="shortDetail">
                                <p>Arabic with</p>
                                <div class="userShortDetail">
                                <div class="imageContainer">
                                    <img src="../img/cour/1.png" alt="" />
                                </div>
                                <p>Dinela</p>
                                </div>
                            </div>
                            </div>

                            <div class="threeDots userOptionOpen">
                            <svg
                                width="18"
                                height="4"
                                viewBox="0 0 18 4"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M0 0H4V4H0V0ZM7 0H11V4H7V0ZM18 0H14V4H18V0Z"
                                fill="#121117"
                                />
                            </svg>
                            </div>
                        </div>
                        <div class="underline"></div>
                        </div>
                        <div class="card">
                        <div class="content">
                            <div class="card_leftSide">
                            <p>January 15</p>
                            <h1>Wednesday, 16:00-16:50</h1>
                            <div class="shortDetail">
                                <p>Arabic with</p>
                                <div class="userShortDetail">
                                <div class="imageContainer">
                                    <img src="../img/cour/1.png" alt="" />
                                </div>
                                <p>Dinela</p>
                                </div>
                            </div>
                            </div>

                            <div class="threeDots userOptionOpen">
                            <svg
                                width="18"
                                height="4"
                                viewBox="0 0 18 4"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M0 0H4V4H0V0ZM7 0H11V4H7V0ZM18 0H14V4H18V0Z"
                                fill="#121117"
                                />
                            </svg>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                <?php
                // Left COntent
                ?>
                
                <div class="leftSide">
                    <!-- <h1 class="heading">My group Classes</h1> -->

                    

  <style>

.group-classes-header {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 28px 26px 0 26px;
}
.group-classes-title {
  font-size: 1.35rem;   /* Smaller, less bold */
  font-weight: 700;
  letter-spacing: -0.5px;
}
.group-dropdown {
  position: relative;
  display: inline-block;
  margin-left: 13px;
}
.group-dropdown-btn {
  font-size: 0.99rem;    /* Smaller font */
  font-weight: 500;
  padding: 4px 14px 4px 13px; /* More compact padding */
  background: #fff;
  /* border: 1.7px solid; */
  border-radius: 15px;
  color: #232323;
  cursor: pointer;
  outline: none;
  box-sizing: border-box;
  display: flex;
  align-items: center;
  gap: 6px;
  line-height: 1.3;
  transition: box-shadow 0.13s;
  box-shadow: none;
  position: relative;
}
.group-dropdown-btn:after {
  content: "";
  display: inline-block;
  margin-left: 6px;
  border: solid #232323;
  border-width: 0 1.7px 1.7px 0;
  padding: 3px;
  transform: rotate(45deg);
  vertical-align: middle;
  margin-bottom: 2px;
}
.group-dropdown.open .group-dropdown-btn {
  box-shadow: 0 2px 12px 0 rgba(255,96,28,0.11);
}

.group-dropdown-list {
  display: none;
  position: absolute;
  top: 110%;
  left: 0;
  min-width: 232px;
  background: #fff;
  border-radius: 13px;
  box-shadow: 0 6px 22px 0 rgba(38,42,120,0.10);
  padding: 16px 0 16px 0;
  z-index: 10;
}
.group-dropdown.open .group-dropdown-list {
  display: block;
  animation: fadeIn 0.15s;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(8px);}
  to { opacity: 1; transform: translateY(0);}
}

.group-list-item {
  display: flex;
  align-items: center;
  gap: 11px;
  padding: 6px 22px;
  font-size: 0.98rem;
  color: #222;
  cursor: pointer;
  border-radius: 9px;
  transition: background 0.09s;
  font-weight: 400;
}
.group-list-item:hover {
  background: #f2f3fa;
}

.group-list-avatar {
  width: 32px;
  height: 32px;
  border: 1.5px solid #bdbdbd;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #fff;
  font-size: 0.96rem;
  font-weight: 600;
  color: #232323;
  letter-spacing: 0.5px;
}

</style>

  <div class="group-classes-header">
    <span class="group-classes-title">My Group Classes</span>
    <div class="group-dropdown" id="groupDropdown">
      <span type="button" class="group-dropdown-btn">
        Group Florida 1 Information
      </span>
      <div class="group-dropdown-list">
        <div class="group-list-item"><span class="group-list-avatar">FL2</span>Florida 2</div>
        <div class="group-list-item"><span class="group-list-avatar">TX1</span>Texas 1</div>
        <div class="group-list-item"><span class="group-list-avatar">NY2</span>Newyork 2</div>
        <div class="group-list-item"><span class="group-list-avatar">NY4</span>Newyork 4</div>
        <div class="group-list-item"><span class="group-list-avatar">NY5</span>Newyork 5</div>
        <div class="group-list-item"><span class="group-list-avatar">BL1</span>Berlin 1</div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    // Dropdown open/close
    $(function(){
      $('.group-dropdown-btn').on('click', function(e){
        e.stopPropagation();
        $(this).closest('.group-dropdown').toggleClass('open');
      });
      $(document).on('click', function(){
        $('.group-dropdown').removeClass('open');
      });
      $('.group-dropdown-list .group-list-item').on('click', function(){
        var text = $(this).text();
        $('.group-dropdown-btn').contents().first()[0].textContent = text.trim();
        $('.group-dropdown').removeClass('open');
      });
    });
  </script>

                <div class="cards">

<style>
   .card-row-section {
  display: flex;
  gap: 15px;
  /* padding: 16px 0; */
  background: #fff;
}
.card-box {
  flex: 1 1 0;
  background: #fff;
  border: 2px solid #e0e0ec;
  border-radius: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  /* padding: 18px 10px 14px 10px; */
  min-width: 180px;
  min-height: 65px;
  box-sizing: border-box;
  transition: box-shadow 0.2s;
}
.card-box:hover {
  box-shadow: 0 2px 12px rgba(40,60,160,0.08);
}
.card-title {
  font-size: 10px;
  color: #888a95;
  font-weight: 400;
  margin-bottom: 2px;
  text-align: center;
  letter-spacing: 0.01em;
}
.card-main-link {
  font-size: 12px;
  font-weight: 700;
  color: #0033cc;
  text-decoration: none;
  line-height: 1.1;
  display: flex;
  align-items: center;
  gap: 8px;
  text-align: center;
}
.ellipsis {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 165px;
  display: inline-block;
  vertical-align: bottom;
}
@media (max-width: 700px) {
  .card-row-section {
    flex-direction: column;
    gap: 15px;
  }
  .card-box {
    min-width: 0;
    width: 100%;
  }
}





.schedule-section {
  /* padding: 26px 32px 28px 32px; */
  border-radius: 18px;
  background: #fff;
  /* max-width: 720px; */
  /* margin: 28px auto 0 auto; */
  box-sizing: border-box;
}
.schedule-title {
  font-size: 18px;
  font-weight: 500;
  margin-bottom: 8px;
  color: #111;
  letter-spacing: -0.5px;
}
.schedule-tabs-row {
  display: flex;
  align-items: flex-end;
  gap: 100px;
  margin-bottom: 0;
}
.schedule-tab {
  font-size: 16px;
  font-weight: 400;
  color: #8e8e97;
  padding-bottom: 6px;
  cursor: pointer;
  position: relative;
  transition: color 0.15s;
}
.schedule-tab.active {
  color: #ff2d18;
  font-weight: 500;
}
.schedule-tab:last-child {
  color: #111;
  font-weight: 600;
}
.schedule-divider {
  border-bottom: 1.3px solid #e5e5ea;
  width: 100%;
  margin-top: 0px;
  margin-bottom: 16px;
}
.schedule-timeslots {
  display: flex;
  gap: 155px;
  margin-top: 10px;
}
.slot-btn {
  min-width: 86px;
  background: #fafcff;
  color: #17171b;
  border: 2px solid #e1e3f3;
  border-radius: 13px;
  font-size: 17px;
  font-weight: 600;
  padding: 7px 0;
  text-align: center;
  box-sizing: border-box;
  transition: border 0.15s, color 0.15s;
}
.slot-btn.active {
  border: 2px solid #0033cc;
  color: #111;
  background: #fff;
}
@media (max-width: 700px) {
  .schedule-section {
    padding: 13px 2vw 15px 2vw;
    max-width: 99vw;
  }
  .schedule-title { font-size: 18px; }
  .schedule-tabs-row {
    gap: 10px;
  }
  .schedule-timeslots {
    gap: 9px;
    flex-wrap: wrap;
  }
}
  </style>


                                <section class="card-row-section">
                                    <div class="card-box">
                                    <div class="card-title">Current Topic</div>
                                    <a href="#" class="card-main-link"><span class="ellipsis">Possessive adjectives..</span></a>
                                    </div>
                                    <div class="card-box">
                                    <div class="card-title">Task due in 5 days</div>
                                    <a href="#" class="card-main-link">
                                        <span class="ellipsis">myhomewok.pdf</span>
                                        <span class="card-check">
                                        <svg viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="9" stroke="currentColor" stroke-width="1.5"/><path d="M6 11l3 3 5-5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        </span>
                                    </a>
                                    </div>
                                    <div class="card-box">
                                    <div class="card-title">Quizzes</div>
                                    <a href="#" class="card-main-link"><span class="ellipsis">Quizzes 1</span></a>
                                    </div>
                                </section>

                                <section class="card-row-section">
                                <div class="card-box">
                                    <div class="card-title">See Slides</div>
                                    <div style="margin-top:10px;">
                                    <!-- Slides Icon SVG -->
                                    <svg width="38" height="25" viewBox="0 0 38 38" fill="none">
                                        <rect width="38" height="38" rx="8" fill="#0033cc"/>
                                        <rect x="11.8" y="12.2" width="14.5" height="13.5" rx="2" fill="#fff"/>
                                        <rect x="13.5" y="14" width="11" height="8.5" rx="1" fill="#fff"/>
                                        <rect x="13.5" y="22.5" width="2.5" height="2" rx="1" fill="#fff"/>
                                        <rect x="22" y="22.5" width="2.5" height="2" rx="1" fill="#fff"/>
                                        <rect x="13.5" y="17.3" width="11" height="0.8" fill="#e2e6f6"/>
                                        <rect x="24.3" y="10.5" width="3.2" height="3" rx="0.8" fill="#b7bdf2"/>
                                    </svg>
                                    </div>
                                </div>
                                <div class="card-box">
                                    <div class="card-title">Previous Recording</div>
                                    <div style="margin-top:12px;">
                                    <!-- Video Camera Icon SVG -->
                                    <svg width="35" height="25" viewBox="0 0 38 38" fill="none">
                                        <rect width="38" height="38" rx="8" fill="#0033cc"/>
                                        <rect x="12.2" y="14" width="10.8" height="9.2" rx="2" fill="#fff"/>
                                        <rect x="24.2" y="17" width="4" height="4" rx="1" fill="#0033cc"/>
                                    </svg>
                                    </div>
                                </div>
                                <div class="card-box">
                                    <div class="card-title">Group Level</div>
                                    <a href="#" class="card-main-link"><span class="ellipsis">A1-Level 1</span></a>
                                </div>
                                </section>


                                    <!-- Schedule Section -->
                                    <div class="schedule-section">
                                    <div class="schedule-title">Schedule</div>
                                    <div class="schedule-tabs-row">
                                        <div class="schedule-tab active">Mon</div>
                                        <div class="schedule-tab">Tue</div>
                                        <div class="schedule-tab">Wed</div>
                                        <div class="schedule-tab">Thu</div>
                                        <div class="schedule-tab">Fri</div>
                                    </div>
                                    <div class="schedule-divider"></div>
                                    <div class="schedule-timeslots">
                                        <div class="slot-btn active">5: 40 am</div>
                                        <div class="slot-btn active">5: 40 am</div>
                                        <div class="slot-btn">5: 40 am</div>
                                    </div>
                                    </div>







                    <!-- <div style="cursor:pointer" onclick="redirectToRecordings(<?php echo $cohortid; ?>, <?php echo $course->id; ?>)" class="card">
                        <p><span class="desktop">Previous</span> Recording</p>
                        <svg
                        width="32"
                        height="19"
                        viewBox="0 0 32 19"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        >
                        <path
                            d="M18.1007 0.0995483H3.50109C1.57549 0.0995483 0 1.67504 0 3.60064V15.3993C0 17.3249 1.57549 18.9004 3.50109 18.9004H18.1007C20.0263 18.9004 21.6017 17.3249 21.6017 15.3993V3.60064C21.6017 1.64003 20.0263 0.0995483 18.1007 0.0995483ZM29.4092 2.02515C29.1991 2.06016 28.9891 2.16519 28.814 2.27023L23.3523 5.42121V13.5437L28.849 16.6947C29.8643 17.2899 31.1247 16.9398 31.7199 15.9245C31.895 15.6094 32 15.2593 32 14.8742V4.05578C32 2.76038 30.7746 1.71005 29.4092 2.02515Z"
                            fill="#001CB1"
                        />
                        </svg>
                    </div> -->
                    </div>

                    <!-- <div class="schedule">
                    <h4>Schedule</h4>
                        <div class="row"> 

                        <?php
                        // Generate the final HTML output in sorted order
                        foreach ($dayOrder as $day) {
                            if (!empty($allDaysWithHours[$day])) {
                                // Print the day with all associated timings
                                foreach ($allDaysWithHours[$day] as $hour) {
                                    echo "
                                    <div class='date'>
                                        <div class='day'><h1>" . htmlspecialchars($day) . "</h1></div>
                                        <p>" . htmlspecialchars($hour) . "</p>
                                    </div>
                                    ";
                                }
                            } else {
                                
                                echo "
                                <div class='date'>
                                    <div class='day gray'><h1>" . htmlspecialchars($day) . "</h1></div>
                                </div>
                                ";
                            }
                        }
                        ?> 
                        </div>
                    </div> -->
                </div>

                <?php
                
                }else{
                    $googleMeetURL="";
                }
            }
            ?> 
        </div>
    </section>

    <section class="page_bottom">
        <div class="center_content">
        <h1 class="heading">Take a Look at Your Level and Access It</h1>

        <div class="levels">
            <div class="card subLevelOpen1">
            <div class="top">
                <p>A1</p>
                <h2>Begginer</h2>
            </div>
            <div class="bottom">
                <div class="stag">
                <div class="content">
                    <h3>100%</h3>
                    <p>completed</p>
                </div>
                <a href="<?php echo getLink($cursosArray, 21, $urlCourse); ?>" class="stagBox <?php echo verificarInscripcion($cursosArray, 21) ? '' : 'lock'; ?>">
                    <?php
                        if(!verificarInscripcion($cursosArray, 21)){
                            echo "
                            <div style='position:absolute;width: 100%;height: 100%;background: #00000063;' ;></div>
                                <svg 
                            style='margin-bottom: -30px;position:relative;'
                            width='18'
                            height='24'
                            viewBox='0 0 18 24'
                            fill='none'
                            xmlns='http://www.w3.org/2000/svg'
                            >
                            <path
                                d='M17.5 9H16V6.99998C16 3.14016 12.8599 0 9 0C5.14012 0 2.00002 3.14016 2.00002 6.99998V9H0.500016C0.434341 8.99996 0.369301 9.01286 0.308617 9.03797C0.247933 9.06309 0.192794 9.09992 0.146355 9.14635C0.0999157 9.19279 0.0630866 9.24793 0.0379738 9.30862C0.0128609 9.3693 -4.30326e-05 9.43434 1.07813e-07 9.50002V22C1.07813e-07 23.103 0.896953 24 2.00002 24H16C17.103 24 18 23.103 18 22V9.50002C18 9.43434 17.9871 9.3693 17.962 9.30862C17.9369 9.24793 17.9001 9.19279 17.8536 9.14635C17.8072 9.09992 17.7521 9.06309 17.6914 9.03797C17.6307 9.01286 17.5657 8.99996 17.5 9ZM10.4971 19.4448C10.5048 19.5147 10.4977 19.5855 10.4763 19.6524C10.4548 19.7194 10.4195 19.7811 10.3726 19.8335C10.3257 19.8859 10.2683 19.9278 10.2041 19.9565C10.1399 19.9852 10.0704 20 10 20H8.00002C7.9297 20 7.86017 19.9852 7.79597 19.9565C7.73177 19.9278 7.67435 19.8859 7.62744 19.8335C7.58054 19.7811 7.5452 19.7194 7.52375 19.6524C7.5023 19.5855 7.49522 19.5147 7.50295 19.4448L7.81838 16.6084C7.30617 16.2359 7.00003 15.6465 7.00003 15C7.00003 13.897 7.89698 13 9.00005 13C10.1031 13 11.0001 13.8969 11.0001 15C11.0001 15.6465 10.6939 16.2359 10.1817 16.6084L10.4971 19.4448ZM13 9H5.00002V6.99998C5.00002 4.79442 6.79444 3 9 3C11.2056 3 13 4.79442 13 6.99998V9Z'
                                fill='white'
                            />
                            </svg>
                            ";
                        }
                    ?>
                    <h1>1</h1>
                    <p>Level</p>
                </a>
                </div>
                <div class="stag">
                <div class="content">
                    <h3>100%</h3>
                    <p>completed</p>
                </div>

                <a href="<?php echo getLink($cursosArray, 10, $urlCourse); ?>" class="stagBox <?php echo verificarInscripcion($cursosArray, 10) ? '' : 'lock'; ?>">
                    <?php
                        if(!verificarInscripcion($cursosArray, 10)){
                            echo "
                            <div style='position:absolute;width: 100%;height: 100%;background: #00000063;' ;></div>
                                <svg 
                            style='margin-bottom: -30px;position:relative;'
                            width='18'
                            height='24'
                            viewBox='0 0 18 24'
                            fill='none'
                            xmlns='http://www.w3.org/2000/svg'
                            >
                            <path
                                d='M17.5 9H16V6.99998C16 3.14016 12.8599 0 9 0C5.14012 0 2.00002 3.14016 2.00002 6.99998V9H0.500016C0.434341 8.99996 0.369301 9.01286 0.308617 9.03797C0.247933 9.06309 0.192794 9.09992 0.146355 9.14635C0.0999157 9.19279 0.0630866 9.24793 0.0379738 9.30862C0.0128609 9.3693 -4.30326e-05 9.43434 1.07813e-07 9.50002V22C1.07813e-07 23.103 0.896953 24 2.00002 24H16C17.103 24 18 23.103 18 22V9.50002C18 9.43434 17.9871 9.3693 17.962 9.30862C17.9369 9.24793 17.9001 9.19279 17.8536 9.14635C17.8072 9.09992 17.7521 9.06309 17.6914 9.03797C17.6307 9.01286 17.5657 8.99996 17.5 9ZM10.4971 19.4448C10.5048 19.5147 10.4977 19.5855 10.4763 19.6524C10.4548 19.7194 10.4195 19.7811 10.3726 19.8335C10.3257 19.8859 10.2683 19.9278 10.2041 19.9565C10.1399 19.9852 10.0704 20 10 20H8.00002C7.9297 20 7.86017 19.9852 7.79597 19.9565C7.73177 19.9278 7.67435 19.8859 7.62744 19.8335C7.58054 19.7811 7.5452 19.7194 7.52375 19.6524C7.5023 19.5855 7.49522 19.5147 7.50295 19.4448L7.81838 16.6084C7.30617 16.2359 7.00003 15.6465 7.00003 15C7.00003 13.897 7.89698 13 9.00005 13C10.1031 13 11.0001 13.8969 11.0001 15C11.0001 15.6465 10.6939 16.2359 10.1817 16.6084L10.4971 19.4448ZM13 9H5.00002V6.99998C5.00002 4.79442 6.79444 3 9 3C11.2056 3 13 4.79442 13 6.99998V9Z'
                                fill='white'
                            />
                            </svg>
                            ";
                        }
                    ?>
                    <h1>2</h1>
                    <p>Level</p>
                </a>
                </div>
            </div>
            </div>
            <div class="card subLevelOpen2">
            <div class="top">
                <p>A2</p>
                <h2>Elementary</h2>
            </div>
            <div class="bottom">
                <div class="stag">
                <div class="content">
                    <h3>100%</h3>
                    <p>completed</p>
                </div>

                <a href="<?php echo getLink($cursosArray, 22, $urlCourse); ?>" class="stagBox <?php echo verificarInscripcion($cursosArray, 22) ? '' : 'lock'; ?>">
                    <?php
                        if(!verificarInscripcion($cursosArray, 22)){
                            echo "
                            <div style='position:absolute;width: 100%;height: 100%;background: #00000063;' ;></div>
                                <svg 
                            style='position:relative;'
                            width='18'
                            height='24'
                            viewBox='0 0 18 24'
                            fill='none'
                            xmlns='http://www.w3.org/2000/svg'
                            >
                            <path
                                d='M17.5 9H16V6.99998C16 3.14016 12.8599 0 9 0C5.14012 0 2.00002 3.14016 2.00002 6.99998V9H0.500016C0.434341 8.99996 0.369301 9.01286 0.308617 9.03797C0.247933 9.06309 0.192794 9.09992 0.146355 9.14635C0.0999157 9.19279 0.0630866 9.24793 0.0379738 9.30862C0.0128609 9.3693 -4.30326e-05 9.43434 1.07813e-07 9.50002V22C1.07813e-07 23.103 0.896953 24 2.00002 24H16C17.103 24 18 23.103 18 22V9.50002C18 9.43434 17.9871 9.3693 17.962 9.30862C17.9369 9.24793 17.9001 9.19279 17.8536 9.14635C17.8072 9.09992 17.7521 9.06309 17.6914 9.03797C17.6307 9.01286 17.5657 8.99996 17.5 9ZM10.4971 19.4448C10.5048 19.5147 10.4977 19.5855 10.4763 19.6524C10.4548 19.7194 10.4195 19.7811 10.3726 19.8335C10.3257 19.8859 10.2683 19.9278 10.2041 19.9565C10.1399 19.9852 10.0704 20 10 20H8.00002C7.9297 20 7.86017 19.9852 7.79597 19.9565C7.73177 19.9278 7.67435 19.8859 7.62744 19.8335C7.58054 19.7811 7.5452 19.7194 7.52375 19.6524C7.5023 19.5855 7.49522 19.5147 7.50295 19.4448L7.81838 16.6084C7.30617 16.2359 7.00003 15.6465 7.00003 15C7.00003 13.897 7.89698 13 9.00005 13C10.1031 13 11.0001 13.8969 11.0001 15C11.0001 15.6465 10.6939 16.2359 10.1817 16.6084L10.4971 19.4448ZM13 9H5.00002V6.99998C5.00002 4.79442 6.79444 3 9 3C11.2056 3 13 4.79442 13 6.99998V9Z'
                                fill='white'
                            />
                            </svg>
                            ";
                        }
                    ?>
                    <h1>3</h1>
                    <p>Level</p>
                </a>
                </div>
                <div class="stag">
                <div class="content">
                    <h3>100%</h3>
                    <p>completed</p>
                </div>

                <a href="<?php echo getLink($cursosArray, 12, $urlCourse); ?>" class="stagBox <?php echo verificarInscripcion($cursosArray, 12) ? '' : 'lock'; ?>">
                    <?php
                        if(!verificarInscripcion($cursosArray, 12)){
                            echo "
                            <div style='position:absolute;width: 100%;height: 100%;background: #00000063;' ;></div>
                                <svg 
                            style='position:relative;'
                            width='18'
                            height='24'
                            viewBox='0 0 18 24'
                            fill='none'
                            xmlns='http://www.w3.org/2000/svg'
                            >
                            <path
                                d='M17.5 9H16V6.99998C16 3.14016 12.8599 0 9 0C5.14012 0 2.00002 3.14016 2.00002 6.99998V9H0.500016C0.434341 8.99996 0.369301 9.01286 0.308617 9.03797C0.247933 9.06309 0.192794 9.09992 0.146355 9.14635C0.0999157 9.19279 0.0630866 9.24793 0.0379738 9.30862C0.0128609 9.3693 -4.30326e-05 9.43434 1.07813e-07 9.50002V22C1.07813e-07 23.103 0.896953 24 2.00002 24H16C17.103 24 18 23.103 18 22V9.50002C18 9.43434 17.9871 9.3693 17.962 9.30862C17.9369 9.24793 17.9001 9.19279 17.8536 9.14635C17.8072 9.09992 17.7521 9.06309 17.6914 9.03797C17.6307 9.01286 17.5657 8.99996 17.5 9ZM10.4971 19.4448C10.5048 19.5147 10.4977 19.5855 10.4763 19.6524C10.4548 19.7194 10.4195 19.7811 10.3726 19.8335C10.3257 19.8859 10.2683 19.9278 10.2041 19.9565C10.1399 19.9852 10.0704 20 10 20H8.00002C7.9297 20 7.86017 19.9852 7.79597 19.9565C7.73177 19.9278 7.67435 19.8859 7.62744 19.8335C7.58054 19.7811 7.5452 19.7194 7.52375 19.6524C7.5023 19.5855 7.49522 19.5147 7.50295 19.4448L7.81838 16.6084C7.30617 16.2359 7.00003 15.6465 7.00003 15C7.00003 13.897 7.89698 13 9.00005 13C10.1031 13 11.0001 13.8969 11.0001 15C11.0001 15.6465 10.6939 16.2359 10.1817 16.6084L10.4971 19.4448ZM13 9H5.00002V6.99998C5.00002 4.79442 6.79444 3 9 3C11.2056 3 13 4.79442 13 6.99998V9Z'
                                fill='white'
                            />
                            </svg>
                            ";
                        }
                    ?>
                    <h1>4</h1>
                    <p>Level</p>
                </a>
                </div>
            </div>
            </div>
            <div class="card subLevelOpen3">
            <div class="top">
                <p>B1</p>
                <h2>Intermediate</h2>
            </div>
            <div class="bottom">
                <div class="stag">
                <div class="content">
                    <h3>100%</h3>
                    <p>completed</p>
                </div>

                <a href="<?php echo getLink($cursosArray, 13, $urlCourse); ?>" class="stagBox <?php echo verificarInscripcion($cursosArray, 13) ? '' : 'lock'; ?>">
                    <?php
                        if(!verificarInscripcion($cursosArray, 13)){
                            echo "
                            <div style='position:absolute;width: 100%;height: 100%;background: #00000063;' ;></div>
                                <svg 
                            style='position:relative;'
                            width='18'
                            height='24'
                            viewBox='0 0 18 24'
                            fill='none'
                            xmlns='http://www.w3.org/2000/svg'
                            >
                            <path
                                d='M17.5 9H16V6.99998C16 3.14016 12.8599 0 9 0C5.14012 0 2.00002 3.14016 2.00002 6.99998V9H0.500016C0.434341 8.99996 0.369301 9.01286 0.308617 9.03797C0.247933 9.06309 0.192794 9.09992 0.146355 9.14635C0.0999157 9.19279 0.0630866 9.24793 0.0379738 9.30862C0.0128609 9.3693 -4.30326e-05 9.43434 1.07813e-07 9.50002V22C1.07813e-07 23.103 0.896953 24 2.00002 24H16C17.103 24 18 23.103 18 22V9.50002C18 9.43434 17.9871 9.3693 17.962 9.30862C17.9369 9.24793 17.9001 9.19279 17.8536 9.14635C17.8072 9.09992 17.7521 9.06309 17.6914 9.03797C17.6307 9.01286 17.5657 8.99996 17.5 9ZM10.4971 19.4448C10.5048 19.5147 10.4977 19.5855 10.4763 19.6524C10.4548 19.7194 10.4195 19.7811 10.3726 19.8335C10.3257 19.8859 10.2683 19.9278 10.2041 19.9565C10.1399 19.9852 10.0704 20 10 20H8.00002C7.9297 20 7.86017 19.9852 7.79597 19.9565C7.73177 19.9278 7.67435 19.8859 7.62744 19.8335C7.58054 19.7811 7.5452 19.7194 7.52375 19.6524C7.5023 19.5855 7.49522 19.5147 7.50295 19.4448L7.81838 16.6084C7.30617 16.2359 7.00003 15.6465 7.00003 15C7.00003 13.897 7.89698 13 9.00005 13C10.1031 13 11.0001 13.8969 11.0001 15C11.0001 15.6465 10.6939 16.2359 10.1817 16.6084L10.4971 19.4448ZM13 9H5.00002V6.99998C5.00002 4.79442 6.79444 3 9 3C11.2056 3 13 4.79442 13 6.99998V9Z'
                                fill='white'
                            />
                            </svg>
                            ";
                        }
                    ?>
                    <h1>5</h1>
                    <p>Level</p>
                </a>
                </div>
                <div class="stag">
                <a href="<?php echo getLink($cursosArray, 14, $urlCourse); ?>" class="stagBox <?php echo verificarInscripcion($cursosArray, 14) ? '' : 'lock'; ?>">
                    <?php
                        if(!verificarInscripcion($cursosArray, 14)){
                            echo "
                            <div style='position:absolute;width: 100%;height: 100%;background: #00000063;' ;></div>
                                <svg 
                            style='position:relative;'
                            width='18'
                            height='24'
                            viewBox='0 0 18 24'
                            fill='none'
                            xmlns='http://www.w3.org/2000/svg'
                            >
                            <path
                                d='M17.5 9H16V6.99998C16 3.14016 12.8599 0 9 0C5.14012 0 2.00002 3.14016 2.00002 6.99998V9H0.500016C0.434341 8.99996 0.369301 9.01286 0.308617 9.03797C0.247933 9.06309 0.192794 9.09992 0.146355 9.14635C0.0999157 9.19279 0.0630866 9.24793 0.0379738 9.30862C0.0128609 9.3693 -4.30326e-05 9.43434 1.07813e-07 9.50002V22C1.07813e-07 23.103 0.896953 24 2.00002 24H16C17.103 24 18 23.103 18 22V9.50002C18 9.43434 17.9871 9.3693 17.962 9.30862C17.9369 9.24793 17.9001 9.19279 17.8536 9.14635C17.8072 9.09992 17.7521 9.06309 17.6914 9.03797C17.6307 9.01286 17.5657 8.99996 17.5 9ZM10.4971 19.4448C10.5048 19.5147 10.4977 19.5855 10.4763 19.6524C10.4548 19.7194 10.4195 19.7811 10.3726 19.8335C10.3257 19.8859 10.2683 19.9278 10.2041 19.9565C10.1399 19.9852 10.0704 20 10 20H8.00002C7.9297 20 7.86017 19.9852 7.79597 19.9565C7.73177 19.9278 7.67435 19.8859 7.62744 19.8335C7.58054 19.7811 7.5452 19.7194 7.52375 19.6524C7.5023 19.5855 7.49522 19.5147 7.50295 19.4448L7.81838 16.6084C7.30617 16.2359 7.00003 15.6465 7.00003 15C7.00003 13.897 7.89698 13 9.00005 13C10.1031 13 11.0001 13.8969 11.0001 15C11.0001 15.6465 10.6939 16.2359 10.1817 16.6084L10.4971 19.4448ZM13 9H5.00002V6.99998C5.00002 4.79442 6.79444 3 9 3C11.2056 3 13 4.79442 13 6.99998V9Z'
                                fill='white'
                            />
                            </svg>
                            ";
                        }
                    ?>
                    <h1>6</h1>
                    <p>Level</p>
                </a>
                </div>
            </div>
            </div>
            <div class="card subLevelOpen4">
            <div class="top">
                <p>B2</p>
                <h2>
                Upper <br />
                Intermediate
                </h2>
            </div>
            <div class="bottom">
                <div class="stag">
                <a href="<?php echo getLink($cursosArray, 15, $urlCourse); ?>" class="stagBox <?php echo verificarInscripcion($cursosArray, 15) ? '' : 'lock'; ?>">
                    <?php
                        if(!verificarInscripcion($cursosArray, 15)){
                            echo "
                            <div style='position:absolute;width: 100%;height: 100%;background: #00000063;' ;></div>
                                <svg 
                            style='position:relative;'
                            width='18'
                            height='24'
                            viewBox='0 0 18 24'
                            fill='none'
                            xmlns='http://www.w3.org/2000/svg'
                            >
                            <path
                                d='M17.5 9H16V6.99998C16 3.14016 12.8599 0 9 0C5.14012 0 2.00002 3.14016 2.00002 6.99998V9H0.500016C0.434341 8.99996 0.369301 9.01286 0.308617 9.03797C0.247933 9.06309 0.192794 9.09992 0.146355 9.14635C0.0999157 9.19279 0.0630866 9.24793 0.0379738 9.30862C0.0128609 9.3693 -4.30326e-05 9.43434 1.07813e-07 9.50002V22C1.07813e-07 23.103 0.896953 24 2.00002 24H16C17.103 24 18 23.103 18 22V9.50002C18 9.43434 17.9871 9.3693 17.962 9.30862C17.9369 9.24793 17.9001 9.19279 17.8536 9.14635C17.8072 9.09992 17.7521 9.06309 17.6914 9.03797C17.6307 9.01286 17.5657 8.99996 17.5 9ZM10.4971 19.4448C10.5048 19.5147 10.4977 19.5855 10.4763 19.6524C10.4548 19.7194 10.4195 19.7811 10.3726 19.8335C10.3257 19.8859 10.2683 19.9278 10.2041 19.9565C10.1399 19.9852 10.0704 20 10 20H8.00002C7.9297 20 7.86017 19.9852 7.79597 19.9565C7.73177 19.9278 7.67435 19.8859 7.62744 19.8335C7.58054 19.7811 7.5452 19.7194 7.52375 19.6524C7.5023 19.5855 7.49522 19.5147 7.50295 19.4448L7.81838 16.6084C7.30617 16.2359 7.00003 15.6465 7.00003 15C7.00003 13.897 7.89698 13 9.00005 13C10.1031 13 11.0001 13.8969 11.0001 15C11.0001 15.6465 10.6939 16.2359 10.1817 16.6084L10.4971 19.4448ZM13 9H5.00002V6.99998C5.00002 4.79442 6.79444 3 9 3C11.2056 3 13 4.79442 13 6.99998V9Z'
                                fill='white'
                            />
                            </svg>
                            ";
                        }
                    ?>
                    <h1>7</h1>
                    <p>Level</p>
                </a>
                </div>
                <div class="stag">
                <a href="<?php echo getLink($cursosArray, 16, $urlCourse); ?>" class="stagBox <?php echo verificarInscripcion($cursosArray, 16) ? '' : 'lock'; ?>">
                    <?php
                        if(!verificarInscripcion($cursosArray, 16)){
                            echo "
                            <div style='position:absolute;width: 100%;height: 100%;background: #00000063;' ;></div>
                                <svg 
                            style='position:relative;'
                            width='18'
                            height='24'
                            viewBox='0 0 18 24'
                            fill='none'
                            xmlns='http://www.w3.org/2000/svg'
                            >
                            <path
                                d='M17.5 9H16V6.99998C16 3.14016 12.8599 0 9 0C5.14012 0 2.00002 3.14016 2.00002 6.99998V9H0.500016C0.434341 8.99996 0.369301 9.01286 0.308617 9.03797C0.247933 9.06309 0.192794 9.09992 0.146355 9.14635C0.0999157 9.19279 0.0630866 9.24793 0.0379738 9.30862C0.0128609 9.3693 -4.30326e-05 9.43434 1.07813e-07 9.50002V22C1.07813e-07 23.103 0.896953 24 2.00002 24H16C17.103 24 18 23.103 18 22V9.50002C18 9.43434 17.9871 9.3693 17.962 9.30862C17.9369 9.24793 17.9001 9.19279 17.8536 9.14635C17.8072 9.09992 17.7521 9.06309 17.6914 9.03797C17.6307 9.01286 17.5657 8.99996 17.5 9ZM10.4971 19.4448C10.5048 19.5147 10.4977 19.5855 10.4763 19.6524C10.4548 19.7194 10.4195 19.7811 10.3726 19.8335C10.3257 19.8859 10.2683 19.9278 10.2041 19.9565C10.1399 19.9852 10.0704 20 10 20H8.00002C7.9297 20 7.86017 19.9852 7.79597 19.9565C7.73177 19.9278 7.67435 19.8859 7.62744 19.8335C7.58054 19.7811 7.5452 19.7194 7.52375 19.6524C7.5023 19.5855 7.49522 19.5147 7.50295 19.4448L7.81838 16.6084C7.30617 16.2359 7.00003 15.6465 7.00003 15C7.00003 13.897 7.89698 13 9.00005 13C10.1031 13 11.0001 13.8969 11.0001 15C11.0001 15.6465 10.6939 16.2359 10.1817 16.6084L10.4971 19.4448ZM13 9H5.00002V6.99998C5.00002 4.79442 6.79444 3 9 3C11.2056 3 13 4.79442 13 6.99998V9Z'
                                fill='white'
                            />
                            </svg>
                            ";
                        }
                    ?>
                    <h1>8</h1>
                    <p>Level</p>
                </a>
                </div>
            </div>
            </div>
            <div class="card subLevelOpen5">
            <div class="top">
                <p>C1</p>
                <h2>Advanced</h2>
            </div>
            <div class="bottom">
                <div class="stag">
                    
                <a href="<?php echo getLink($cursosArray, 17, $urlCourse); ?>" class="stagBox <?php echo verificarInscripcion($cursosArray, 17) ? '' : 'lock'; ?>">
                    <?php
                        if(!verificarInscripcion($cursosArray, 17)){
                            echo "
                            <div style='position:absolute;width: 100%;height: 100%;background: #00000063;' ;></div>
                                <svg 
                            style='position:relative;'
                            width='18'
                            height='24'
                            viewBox='0 0 18 24'
                            fill='none'
                            xmlns='http://www.w3.org/2000/svg'
                            >
                            <path
                                d='M17.5 9H16V6.99998C16 3.14016 12.8599 0 9 0C5.14012 0 2.00002 3.14016 2.00002 6.99998V9H0.500016C0.434341 8.99996 0.369301 9.01286 0.308617 9.03797C0.247933 9.06309 0.192794 9.09992 0.146355 9.14635C0.0999157 9.19279 0.0630866 9.24793 0.0379738 9.30862C0.0128609 9.3693 -4.30326e-05 9.43434 1.07813e-07 9.50002V22C1.07813e-07 23.103 0.896953 24 2.00002 24H16C17.103 24 18 23.103 18 22V9.50002C18 9.43434 17.9871 9.3693 17.962 9.30862C17.9369 9.24793 17.9001 9.19279 17.8536 9.14635C17.8072 9.09992 17.7521 9.06309 17.6914 9.03797C17.6307 9.01286 17.5657 8.99996 17.5 9ZM10.4971 19.4448C10.5048 19.5147 10.4977 19.5855 10.4763 19.6524C10.4548 19.7194 10.4195 19.7811 10.3726 19.8335C10.3257 19.8859 10.2683 19.9278 10.2041 19.9565C10.1399 19.9852 10.0704 20 10 20H8.00002C7.9297 20 7.86017 19.9852 7.79597 19.9565C7.73177 19.9278 7.67435 19.8859 7.62744 19.8335C7.58054 19.7811 7.5452 19.7194 7.52375 19.6524C7.5023 19.5855 7.49522 19.5147 7.50295 19.4448L7.81838 16.6084C7.30617 16.2359 7.00003 15.6465 7.00003 15C7.00003 13.897 7.89698 13 9.00005 13C10.1031 13 11.0001 13.8969 11.0001 15C11.0001 15.6465 10.6939 16.2359 10.1817 16.6084L10.4971 19.4448ZM13 9H5.00002V6.99998C5.00002 4.79442 6.79444 3 9 3C11.2056 3 13 4.79442 13 6.99998V9Z'
                                fill='white'
                            />
                            </svg>
                            ";
                        }
                    ?>
                    <h1>9</h1>
                    <p>Level</p>
                </a>
                </div>
                <div class="stag">
                
                <a href="<?php echo getLink($cursosArray, 18, $urlCourse); ?>" class="stagBox <?php echo verificarInscripcion($cursosArray, 18) ? '' : 'lock'; ?>">
                    <?php
                        if(!verificarInscripcion($cursosArray, 18)){
                            echo "
                            <div style='position:absolute;width: 100%;height: 100%;background: #00000063;' ;></div>
                                <svg 
                            style='position:relative;'
                            width='18'
                            height='24'
                            viewBox='0 0 18 24'
                            fill='none'
                            xmlns='http://www.w3.org/2000/svg'
                            >
                            <path
                                d='M17.5 9H16V6.99998C16 3.14016 12.8599 0 9 0C5.14012 0 2.00002 3.14016 2.00002 6.99998V9H0.500016C0.434341 8.99996 0.369301 9.01286 0.308617 9.03797C0.247933 9.06309 0.192794 9.09992 0.146355 9.14635C0.0999157 9.19279 0.0630866 9.24793 0.0379738 9.30862C0.0128609 9.3693 -4.30326e-05 9.43434 1.07813e-07 9.50002V22C1.07813e-07 23.103 0.896953 24 2.00002 24H16C17.103 24 18 23.103 18 22V9.50002C18 9.43434 17.9871 9.3693 17.962 9.30862C17.9369 9.24793 17.9001 9.19279 17.8536 9.14635C17.8072 9.09992 17.7521 9.06309 17.6914 9.03797C17.6307 9.01286 17.5657 8.99996 17.5 9ZM10.4971 19.4448C10.5048 19.5147 10.4977 19.5855 10.4763 19.6524C10.4548 19.7194 10.4195 19.7811 10.3726 19.8335C10.3257 19.8859 10.2683 19.9278 10.2041 19.9565C10.1399 19.9852 10.0704 20 10 20H8.00002C7.9297 20 7.86017 19.9852 7.79597 19.9565C7.73177 19.9278 7.67435 19.8859 7.62744 19.8335C7.58054 19.7811 7.5452 19.7194 7.52375 19.6524C7.5023 19.5855 7.49522 19.5147 7.50295 19.4448L7.81838 16.6084C7.30617 16.2359 7.00003 15.6465 7.00003 15C7.00003 13.897 7.89698 13 9.00005 13C10.1031 13 11.0001 13.8969 11.0001 15C11.0001 15.6465 10.6939 16.2359 10.1817 16.6084L10.4971 19.4448ZM13 9H5.00002V6.99998C5.00002 4.79442 6.79444 3 9 3C11.2056 3 13 4.79442 13 6.99998V9Z'
                                fill='white'
                            />
                            </svg>
                            ";
                        }
                    ?>
                    <h1>10</h1>
                    <p>Level</p>
                </a>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>

    <section id="level1" class="sub_level">
        <div class="center_content">
        <h1 class="heading">Levels Of Begginer-A1</h1>

        <div class="cards">
            <div class="card">
            <img src="../img/cour/card-01.png" alt="" class="bg" />

            <div class="top">
                <h1>Level 1</h1>
                <p>
                Rem tempore est ea velit. Possimus consequatur totam iusto
                dolorum facere aut aut eius nesciunt. Ratione ut in
                repellendus neque autem ea enim.
                </p>
            </div>
            <div class="bottom">
                <div class="progress">
                <!-- <svg class="progress-ring" width="44" height="44">
                    <circle
                    class="progress-ring__circle"
                    cx="22"
                    cy="22"
                    r="20"
                    stroke-width="4"
                    />
                </svg> -->
                <!-- <div class="progress-text">100%</div> -->
                </div>
                <a href="<?php echo getLink($cursosArray, 21, $urlCourse); ?>" class="btn">View Level 1</a>
            </div>
            </div>
            <div class="card">
            <img src="../img/cour/card-02.png" alt="" class="bg" />

            <div class="top">
                <h1>Level 2</h1>
                <p>
                Rem tempore est ea velit. Possimus consequatur totam iusto
                dolorum facere aut aut eius nesciunt. Ratione ut in
                repellendus neque autem ea enim.
                </p>
            </div>
            <div class="bottom">
                <div class="progress">
                <!-- <svg class="progress-ring" width="44" height="44">
                    <circle
                    class="progress-ring__circle"
                    cx="22"
                    cy="22"
                    r="20"
                    stroke-width="4"
                    />
                </svg> -->
                <!-- <div class="progress-text">100%</div> -->
                </div>
                <a href="<?php echo getLink($cursosArray, 10, $urlCourse); ?>" class="btn">View Level 2</a>
            </div>
            </div>
        </div>
        </div>
    </section>

    
    <section id="level2" class="sub_level">
        <div class="center_content">
        <h1 class="heading">Levels Of Elementary-A2</h1>

        <div class="cards">
            <div class="card">
            <img src="../img/cour/card-01.png" alt="" class="bg" />

            <div class="top">
                <h1>Level 3</h1>
                <p>
                Rem tempore est ea velit. Possimus consequatur totam iusto
                dolorum facere aut aut eius nesciunt. Ratione ut in
                repellendus neque autem ea enim.
                </p>
            </div>
            <div class="bottom">
                <div class="progress">
                <!-- <svg class="progress-ring" width="44" height="44">
                    <circle
                    class="progress-ring__circle"
                    cx="22"
                    cy="22"
                    r="20"
                    stroke-width="4"
                    />
                </svg> -->
                <!-- <div class="progress-text">100%</div> -->
                </div>
                <a href="<?php echo getLink($cursosArray, 22, $urlCourse); ?>" class="btn">View Level 3</a>
            </div>
            </div>
            <div class="card">
            <img src="../img/cour/card-02.png" alt="" class="bg" />

            <div class="top">
                <h1>Level 4</h1>
                <p>
                Rem tempore est ea velit. Possimus consequatur totam iusto
                dolorum facere aut aut eius nesciunt. Ratione ut in
                repellendus neque autem ea enim.
                </p>
            </div>
            <div class="bottom">
                <div class="progress">
                <!-- <svg class="progress-ring" width="44" height="44">
                    <circle
                    class="progress-ring__circle"
                    cx="22"
                    cy="22"
                    r="20"
                    stroke-width="4"
                    />
                </svg> -->
                <!-- <div class="progress-text">100%</div> -->
                </div>
                <a href="<?php echo getLink($cursosArray, 12, $urlCourse); ?>" class="btn">View Level 4</a>
            </div>
            </div>
        </div>
        </div>
    </section>

    <section id="level3" class="sub_level">
        <div class="center_content">
        <h1 class="heading">Levels Of Intermediate-B1</h1>

        <div class="cards">
            <div class="card">
            <img src="../img/cour/Figure2.png" alt="" class="bg" />

            <div class="top">
                <h1>Level 5</h1>
                <p>
                Rem tempore est ea velit. Possimus consequatur totam iusto
                dolorum facere aut aut eius nesciunt. Ratione ut in
                repellendus neque autem ea enim.
                </p>
            </div>
            <div class="bottom">
                <div class="progress">
                <!-- <svg class="progress-ring" width="44" height="44">
                    <circle
                    class="progress-ring__circle"
                    cx="22"
                    cy="22"
                    r="20"
                    stroke-width="4"
                    />
                </svg> -->
                <!-- <div class="progress-text">100%</div> -->
                </div>
                <a href="<?php echo getLink($cursosArray, 13, $urlCourse); ?>" class="btn">View Level 5</a>
            </div>
            </div>
            <div class="card">
            <img src="../img/cour/Figure.png" alt="" class="bg" />

            <div class="top">
                <h1>Level 6</h1>
                <p>
                Rem tempore est ea velit. Possimus consequatur totam iusto
                dolorum facere aut aut eius nesciunt. Ratione ut in
                repellendus neque autem ea enim.
                </p>
            </div>
            <div class="bottom">
                <div class="progress">
                <!-- <svg class="progress-ring" width="44" height="44">
                    <circle
                    class="progress-ring__circle"
                    cx="22"
                    cy="22"
                    r="20"
                    stroke-width="4"
                    />
                </svg> -->
                <!-- <div class="progress-text">100%</div> -->
                </div>
                <a href="<?php echo getLink($cursosArray, 14, $urlCourse); ?>" class="btn">View Level 6</a>
            </div>
            </div>
        </div>
        </div>
    </section>
    
    <section id="level4" class="sub_level">
        <div class="center_content">
        <h1 class="heading">Levels Of Upper Intermediate-B2</h1>

        <div class="cards">
            <div class="card">
            <img src="../img/cour/Figure2.png" alt="" class="bg" />

            <div class="top">
                <h1>Level 7</h1>
                <p>
                Rem tempore est ea velit. Possimus consequatur totam iusto
                dolorum facere aut aut eius nesciunt. Ratione ut in
                repellendus neque autem ea enim.
                </p>
            </div>
            <div class="bottom">
                <div class="progress">
                <!-- <svg class="progress-ring" width="44" height="44">
                    <circle
                    class="progress-ring__circle"
                    cx="22"
                    cy="22"
                    r="20"
                    stroke-width="4"
                    />
                </svg> -->
                <!-- <div class="progress-text">100%</div> -->
                </div>
                <a href="<?php echo getLink($cursosArray, 15, $urlCourse); ?>" class="btn">View Level 7</a>
            </div>
            </div>
            <div class="card">
            <img src="../img/cour/Figure.png" alt="" class="bg" />

            <div class="top">
                <h1>Level 8</h1>
                <p>
                Rem tempore est ea velit. Possimus consequatur totam iusto
                dolorum facere aut aut eius nesciunt. Ratione ut in
                repellendus neque autem ea enim.
                </p>
            </div>
            <div class="bottom">
                <div class="progress">
                <!-- <svg class="progress-ring" width="44" height="44">
                    <circle
                    class="progress-ring__circle"
                    cx="22"
                    cy="22"
                    r="20"
                    stroke-width="4"
                    />
                </svg> -->
                <!-- <div class="progress-text">100%</div> -->
                </div>
                <a href="<?php echo getLink($cursosArray, 16, $urlCourse); ?>" class="btn">View Level 8</a>
            </div>
            </div>
        </div>
        </div>
    </section>
        
    <section id="level5" class="sub_level">
        <div class="center_content">
        <h1 class="heading">Levels Of Advanced-C1</h1>

        <div class="cards">
            <div class="card">
            <img src="../img/cour/FigureF1.png" alt="" class="bg" />

            <div class="top">
                <h1>Level 9</h1>
                <p>
                Rem tempore est ea velit. Possimus consequatur totam iusto
                dolorum facere aut aut eius nesciunt. Ratione ut in
                repellendus neque autem ea enim.
                </p>
            </div>
            <div class="bottom">
                <div class="progress">
                <!-- <svg class="progress-ring" width="44" height="44">
                    <circle
                    class="progress-ring__circle"
                    cx="22"
                    cy="22"
                    r="20"
                    stroke-width="4"
                    />
                </svg> -->
                <!-- <div class="progress-text">100%</div> -->
                </div>
                <a href="<?php echo getLink($cursosArray, 17, $urlCourse); ?>" class="btn">View Level 9</a>
            </div>
            </div>
            <div class="card">
            <img src="../img/cour/FigureF2.png" alt="" class="bg" />

            <div class="top">
                <h1>Level 10</h1>
                <p>
                Rem tempore est ea velit. Possimus consequatur totam iusto
                dolorum facere aut aut eius nesciunt. Ratione ut in
                repellendus neque autem ea enim.
                </p>
            </div>
            <div class="bottom">
                <div class="progress">
                <!-- <svg class="progress-ring" width="44" height="44">
                    <circle
                    class="progress-ring__circle"
                    cx="22"
                    cy="22"
                    r="20"
                    stroke-width="4"
                    />
                </svg> -->
                <!-- <div class="progress-text">100%</div> -->
                </div>
                <a href="<?php echo getLink($cursosArray, 18, $urlCourse); ?>" class="btn">View Level 10</a>
            </div>
            </div>
        </div>
        </div>
    </section>

    <section class="subscriptions">
        <div class="topPart">
        <h1>Subscriptions</h1>
        <a href="">Manage</a>
        </div>
        <div class="bottomPart">
        <div class="card">
            <div class="card_top">
            <div class="row_01">
                <div class="imageContainer">
                <img src="../img/cour/2.png" alt="" />
                </div>
                <p class="status notStarted">Not Started</p>
            </div>
            <div class="row_02">
                <h1>English with Wade Warren</h1>
                <!-- <div class="balance">
                <img src="../img/cour/icons/wallet_lg.png" alt="" />
                <p>Balance : 0 Lessons</p>
                </div>
                <div class="balance revision">
                <img src="../img/cour/icons/revision.png" alt="">
                <p>Subscription to 1 lesson renews 
                    automatically on February 18</p>
                </div> -->
                <p class="text">
                Start a Monthly Subscription and set up the schedule
                </p>
            </div>
            </div>
            <div class="row_03">
            <a href="" class="btn">Subscribe</a>
            <!-- <div class="options">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="4"
                viewBox="0 0 18 4"
                fill="none"
                >
                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M0 0.00012207H4V4.00012H0V0.00012207ZM7 0.00012207H11V4.00012H7V0.00012207ZM18 0.00012207H14V4.00012H18V0.00012207Z"
                    fill="#121117"
                />
                </svg>
            </div> -->
            </div>
        </div>

        <div class="card">
            <div class="card_top">
            <div class="row_01">
                <div class="imageContainer">
                <img src="../img/cour/1.png" alt="" />
                </div>
                <p class="status active">Active</p>
            </div>
            <div class="row_02">
                <h1>English with Dainiela</h1>
                <div class="balance">
                <img src="../img/cour/icons/wallet_lg.png" alt="" />
                <p>Balance : 0 Lessons</p>
                </div>
                <div class="balance revision">
                <img src="../img/cour/icons/revision.png" alt="" />
                <p>
                    Subscription to 1 lesson renews automatically on February 18
                </p>
                </div>
            </div>
            </div>
            <div class="row_03">
            <button href="" class="btn addExtraLessonsModalOpen">
                Add Lessons
            </button>
            <div class="options subscription_dropdown_options_open">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="4"
                viewBox="0 0 18 4"
                fill="none"
                >
                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M0 0.00012207H4V4.00012H0V0.00012207ZM7 0.00012207H11V4.00012H7V0.00012207ZM18 0.00012207H14V4.00012H18V0.00012207Z"
                    fill="#121117"
                />
                </svg>
            </div>
            </div>
        </div>

        <div class="card">
            <div class="card_top">
            <div class="row_01">
                <div class="imageContainer">
                <img src="../img/cour/3.png" alt="" />
                </div>
                <p class="status active">Active</p>
            </div>
            <div class="row_02">
                <h1>English with David</h1>
                <div class="balance">
                <img src="../img/cour/icons/wallet_lg.png" alt="" />
                <p>Balance : 1 Lessons</p>
                </div>
                <div class="balance revision">
                <img src="../img/cour/icons/revision.png" alt="" />
                <p>
                    Subscription to 20 lesson renews automatically on February
                    18
                </p>
                </div>
            </div>
            </div>
            <div class="row_03">
            <a href="" class="btn">Scheule Lessons</a>
            <div class="options subscription_dropdown_options_open">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                height="4"
                viewBox="0 0 18 4"
                fill="none"
                >
                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M0 0.00012207H4V4.00012H0V0.00012207ZM7 0.00012207H11V4.00012H7V0.00012207ZM18 0.00012207H14V4.00012H18V0.00012207Z"
                    fill="#121117"
                />
                </svg>
            </div>
            </div>
        </div>

        <div class="anotherOptions">
            <a href="" class="anotherOptions_card">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="32"
                height="33"
                viewBox="0 0 32 33"
                fill="none"
            >
                <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M10.9174 29.0573C11.0155 29.1355 11.1336 29.1846 11.2582 29.1987C11.3829 29.2129 11.509 29.1916 11.6221 29.1373C11.7351 29.0829 11.8306 28.9978 11.8975 28.8917C11.9644 28.7856 11.9999 28.6627 12.0001 28.5373V20.6439C11.9999 20.5185 11.9644 20.3956 11.8975 20.2895C11.8306 20.1834 11.7351 20.0982 11.6221 20.0439C11.509 19.9896 11.3829 19.9683 11.2582 19.9825C11.1336 19.9966 11.0155 20.0456 10.9174 20.1239L5.9841 24.0706C5.90624 24.1331 5.8434 24.2122 5.80022 24.3022C5.75704 24.3922 5.73462 24.4908 5.73462 24.5906C5.73462 24.6904 5.75704 24.789 5.80022 24.879C5.8434 24.969 5.90624 25.0481 5.9841 25.1106L10.9174 29.0573ZM21.0828 4.12393C20.9847 4.04565 20.8666 3.99662 20.742 3.98247C20.6173 3.96831 20.4912 3.98962 20.3781 4.04393C20.2651 4.09824 20.1696 4.18336 20.1027 4.28949C20.0358 4.39563 20.0003 4.51848 20.0001 4.64393V12.5373C20.0003 12.6627 20.0358 12.7856 20.1027 12.8917C20.1696 12.9978 20.2651 13.0829 20.3781 13.1373C20.4912 13.1916 20.6173 13.2129 20.742 13.1987C20.8666 13.1846 20.9847 13.1355 21.0828 13.0573L26.0161 9.1106C26.094 9.04813 26.1568 8.96897 26.2 8.87897C26.2432 8.78897 26.2656 8.69042 26.2656 8.5906C26.2656 8.49077 26.2432 8.39222 26.2 8.30222C26.1568 8.21222 26.094 8.13306 26.0161 8.0706L21.0828 4.12393Z"
                fill="black"
                />
                <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M24 8.5906C24 8.23697 23.8596 7.89784 23.6095 7.64779C23.3595 7.39774 23.0203 7.25726 22.6667 7.25726H10.6667C9.33168 7.25696 8.01779 7.59078 6.8448 8.22828C5.6718 8.86578 4.677 9.7867 3.95104 10.9071C3.22509 12.0275 2.79107 13.3118 2.68855 14.6429C2.58602 15.974 2.81824 17.3096 3.36405 18.5279C3.51047 18.8478 3.77738 19.0968 4.10661 19.2208C4.43585 19.3447 4.80072 19.3336 5.12174 19.1897C5.44276 19.0458 5.69391 18.7809 5.82046 18.4526C5.94702 18.1244 5.93872 17.7594 5.79738 17.4373C5.43358 16.625 5.27884 15.7345 5.34729 14.8471C5.41573 13.9597 5.70517 13.1036 6.18923 12.3567C6.67329 11.6098 7.33658 10.9959 8.11864 10.571C8.9007 10.1461 9.77667 9.92362 10.6667 9.92393H22.6667C23.0203 9.92393 23.3595 9.78345 23.6095 9.53341C23.8596 9.28336 24 8.94422 24 8.5906ZM8.00005 24.5906C8.00005 24.9442 8.14052 25.2834 8.39057 25.5334C8.64062 25.7835 8.97976 25.9239 9.33338 25.9239H21.3334C22.6684 25.9242 23.9823 25.5904 25.1553 24.9529C26.3283 24.3154 27.3231 23.3945 28.0491 22.2741C28.775 21.1537 29.209 19.8694 29.3115 18.5383C29.4141 17.2072 29.1819 15.8716 28.636 14.6533C28.4896 14.3334 28.2227 14.0844 27.8935 13.9604C27.5642 13.8365 27.1994 13.8476 26.8784 13.9915C26.5573 14.1354 26.3062 14.4003 26.1796 14.7286C26.0531 15.0568 26.0614 15.4218 26.2027 15.7439C26.5665 16.5562 26.7213 17.4467 26.6528 18.3341C26.5844 19.2215 26.2949 20.0776 25.8109 20.8245C25.3268 21.5714 24.6635 22.1853 23.8815 22.6102C23.0994 23.0351 22.2234 23.2576 21.3334 23.2573H9.33338C8.97976 23.2573 8.64062 23.3977 8.39057 23.6478C8.14052 23.8978 8.00005 24.237 8.00005 24.5906Z"
                fill="black"
                />
            </svg>

            <p>Transfer Lesson or Subscription</p>
            </a>
            <a href="" class="anotherOptions_card">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="32"
                height="33"
                viewBox="0 0 32 33"
                fill="none"
            >
                <path
                d="M28.8701 27.2282L23.7441 22.1022C25.3072 20.0644 26.153 17.5671 26.1498 14.9989C26.1498 11.8613 24.928 8.91266 22.7096 6.69425C21.6216 5.60018 20.3274 4.73278 18.9019 4.14226C17.4764 3.55174 15.9479 3.24983 14.405 3.25401C11.2682 3.25401 8.31955 4.47584 6.10035 6.69425C1.52205 11.2733 1.52205 18.7244 6.10035 23.3035C7.18832 24.3976 8.48253 25.265 9.90803 25.8556C11.3335 26.4461 12.862 26.748 14.405 26.7437C17.0083 26.7437 19.4748 25.891 21.5091 24.3372L26.6351 29.464C26.9433 29.7722 27.348 29.9271 27.7526 29.9271C28.1572 29.9271 28.5619 29.7722 28.8701 29.464C29.017 29.3172 29.1334 29.143 29.2129 28.9511C29.2924 28.7593 29.3333 28.5537 29.3333 28.3461C29.3333 28.1385 29.2924 27.9329 29.2129 27.7411C29.1334 27.5493 29.017 27.375 28.8701 27.2282ZM8.33615 21.0685C4.98916 17.7215 4.98995 12.2762 8.33615 8.92926C9.13149 8.12992 10.0774 7.49623 11.1193 7.06484C12.1611 6.63346 13.2782 6.41295 14.4058 6.41606C15.5333 6.41296 16.6502 6.63349 17.6919 7.06487C18.7336 7.49626 19.6794 8.12995 20.4746 8.92926C21.2741 9.72449 21.908 10.6704 22.3396 11.7123C22.7711 12.7541 22.9917 13.8712 22.9886 14.9989C22.9886 17.2916 22.0955 19.4468 20.4746 21.0685C18.8537 22.6902 16.6985 23.5817 14.405 23.5817C12.1131 23.5817 9.95708 22.6886 8.33536 21.0685H8.33615Z"
                fill="black"
                />
            </svg>

            <p>Find Another Tutor</p>
            </a>
        </div>
        </div>
    </section>
    </div>

    <!-- Share Tutor -->
    <!-- =========== -->
    <section class="shareTutor">
    <div class="shareTutor_close_icon secondLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        />
        </svg>
    </div>

    <h1 class="heading">Share this tutor</h1>

    <div class="row01">
        <div class="col01">
        <img src="../img/cour/1.png" alt="" />
        </div>

        <div class="col02">
        <div class="r">
            <h1>Dinella</h1>

            <div class="rating">
            <svg
                width="18"
                height="17"
                viewBox="0 0 18 17"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                d="M9 0L11.221 5.942L17.559 6.219L12.594 10.169L14.29 16.281L9 12.78L3.71 16.281L5.405 10.168L0.440002 6.218L6.778 5.942L9 0Z"
                fill="#121117"
                />
            </svg>
            <h1>5</h1>
            </div>

            <p>(28 reviews)</p>
        </div>

        <div class="r_1">
            <div class="verified">
            <svg
                width="20"
                height="20"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                d="M19.56 8.73908L18.2 7.15908C17.94 6.85908 17.73 6.29908 17.73 5.89908V4.19908C17.73 3.13908 16.86 2.26908 15.8 2.26908H14.1C13.71 2.26908 13.14 2.05908 12.84 1.79908L11.26 0.439082C10.57 -0.150918 9.44001 -0.150918 8.74001 0.439082L7.17001 1.80908C6.87001 2.05908 6.30001 2.26908 5.91001 2.26908H4.18001C3.12001 2.26908 2.25001 3.13908 2.25001 4.19908V5.90908C2.25001 6.29908 2.04 6.85908 1.79 7.15908L0.440005 8.74908C-0.139995 9.43908 -0.139995 10.5591 0.440005 11.2491L1.79 12.8391C2.04 13.1391 2.25001 13.6991 2.25001 14.0891V15.7991C2.25001 16.8591 3.12001 17.7291 4.18001 17.7291H5.91001C6.30001 17.7291 6.87001 17.9391 7.17001 18.1991L8.75001 19.5591C9.44001 20.1491 10.57 20.1491 11.27 19.5591L12.85 18.1991C13.15 17.9391 13.71 17.7291 14.11 17.7291H15.81C16.87 17.7291 17.74 16.8591 17.74 15.7991V14.0991C17.74 13.7091 17.95 13.1391 18.21 12.8391L19.57 11.2591C20.15 10.5691 20.15 9.42908 19.56 8.73908ZM14.16 8.10908L9.33001 12.9391C9.18938 13.0795 8.99876 13.1584 8.80001 13.1584C8.60126 13.1584 8.41063 13.0795 8.27001 12.9391L5.85001 10.5191C5.56001 10.2291 5.56001 9.74908 5.85001 9.45908C6.14001 9.16908 6.62001 9.16908 6.91001 9.45908L8.80001 11.3491L13.1 7.04908C13.39 6.75908 13.87 6.75908 14.16 7.04908C14.45 7.33908 14.45 7.81908 14.16 8.10908Z"
                fill="black"
                />
            </svg>
            <p>Verified</p>
            </div>

            <div class="professional">
            <svg
                width="24"
                height="18"
                viewBox="0 0 24 18"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                d="M23.4003 6.30357C23.4023 6.72553 23.2819 7.13902 23.0537 7.49396C22.8255 7.84891 22.4993 8.1301 22.1147 8.30349L19.5575 9.46077L18.129 10.1035L14.0718 11.9465C13.4253 12.2476 12.7207 12.4036 12.0075 12.4036C11.2943 12.4036 10.5898 12.2476 9.94329 11.9465L5.87193 10.1035L4.44345 9.46077L3.01497 8.80365V14.9748C3.11638 15.0384 3.1998 15.127 3.25731 15.232C3.31482 15.3371 3.34451 15.455 3.34353 15.5748V17.0462C3.34446 17.1403 3.32663 17.2336 3.29106 17.3206C3.2555 17.4077 3.20292 17.4868 3.13641 17.5533C3.0699 17.6198 2.99079 17.6724 2.90372 17.708C2.81664 17.7435 2.72335 17.7614 2.62929 17.7605H1.97217C1.8781 17.7614 1.78478 17.7436 1.69768 17.7081C1.61057 17.6725 1.53144 17.6199 1.4649 17.5534C1.39837 17.4869 1.34577 17.4078 1.31019 17.3207C1.27461 17.2336 1.25676 17.1403 1.25769 17.0462V15.575C1.25677 15.4553 1.2865 15.3373 1.34405 15.2322C1.4016 15.1272 1.48506 15.0387 1.58649 14.975V8.40333C1.5855 8.32042 1.59999 8.23805 1.62921 8.16045C1.29233 7.94979 1.01913 7.65143 0.838872 7.29734C0.658618 6.94326 0.578111 6.5468 0.605979 6.15045C0.633847 5.75411 0.769041 5.37281 0.99707 5.04743C1.2251 4.72206 1.53737 4.46486 1.90041 4.30341L9.94353 0.660693C11.2544 0.0606934 12.7611 0.0606934 14.072 0.660693L22.1149 4.30365C22.4996 4.47707 22.8257 4.75827 23.0539 5.11321C23.2821 5.46815 23.4023 5.88162 23.4003 6.30357ZM14.6576 13.2463C13.8275 13.6321 12.9231 13.832 12.0077 13.832C11.0922 13.832 10.1878 13.6321 9.35769 13.2463L4.44345 11.0321V12.8606C4.44501 13.4098 4.57193 13.9513 4.81454 14.444C5.05715 14.9366 5.40903 15.3674 5.84337 15.7034C9.48249 18.4843 14.5328 18.4843 18.1719 15.7034C18.6044 15.3666 18.9541 14.9354 19.1942 14.4426C19.4344 13.9499 19.5586 13.4088 19.5575 12.8606V11.0179L18.7146 11.4036L14.6576 13.2463Z"
                fill="black"
                />
            </svg>
            <p>Professional</p>
            </div>
        </div>
        </div>
    </div>

    <div class="row02">
        <div class="link">
        <p id="copyLinkText">https://latingles.com/Dinela26121264</p>
        <img src="../img/cour/icons/copy.png" alt="" class="copyLinkBTN" />
        </div>

        <button class="copyLinkBTN">Copy link</button>
    </div>

    <div class="socialLinks">
        <a href="">
        <svg
            width="18"
            height="14"
            viewBox="0 0 18 14"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M15.333 2H2.667L9 6.75L15.333 2ZM2 4V12H16V4L9.6 8.8L9 9.25L8.4 8.8L2 4ZM0 0H18V14H0V0Z"
            fill="#121117"
            />
        </svg>
        <span>Email</span>
        </a>

        <a href="">
        <svg
            width="18"
            height="18"
            viewBox="0 0 18 18"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
            d="M15.303 2.61603C14.4768 1.78426 13.4937 1.12473 12.4107 0.675678C11.3277 0.226625 10.1664 -0.00302758 8.994 3.01367e-05C4.078 3.01367e-05 0.0769999 4.00003 0.0739999 8.91903C0.0720007 10.4842 0.482814 12.0223 1.265 13.378L0 18L4.728 16.76C6.03594 17.4724 7.50164 17.8455 8.991 17.845H8.994C13.91 17.845 17.912 13.844 17.914 8.92603C17.9178 7.75393 17.689 6.59272 17.241 5.50961C16.793 4.42651 16.1346 3.443 15.304 2.61603H15.303ZM8.994 16.339H8.991C7.66347 16.3392 6.36032 15.9824 5.218 15.306L4.948 15.145L2.141 15.881L2.891 13.145L2.714 12.865C1.97142 11.683 1.57861 10.3149 1.581 8.91903C1.582 4.83203 4.908 1.50603 8.998 1.50603C10.978 1.50703 12.838 2.27903 14.238 3.68103C14.9284 4.36827 15.4757 5.18559 15.8482 6.08572C16.2206 6.98584 16.4109 7.95089 16.408 8.92503C16.406 13.013 13.08 16.338 8.994 16.338V16.339ZM13.061 10.787C12.838 10.675 11.742 10.137 11.538 10.062C11.333 9.98803 11.185 9.95003 11.037 10.174C10.888 10.397 10.461 10.899 10.331 11.047C10.201 11.197 10.071 11.214 9.848 11.103C9.625 10.991 8.908 10.756 8.056 9.99703C7.393 9.40603 6.946 8.67703 6.816 8.45303C6.686 8.23003 6.802 8.10903 6.913 7.99803C7.013 7.89803 7.136 7.73803 7.248 7.60803C7.36 7.47803 7.396 7.38503 7.471 7.23603C7.545 7.08703 7.508 6.95703 7.452 6.84603C7.397 6.73403 6.951 5.63703 6.765 5.19103C6.584 4.75703 6.4 4.81603 6.264 4.80803C6.12141 4.8023 5.9787 4.79997 5.836 4.80103C5.72309 4.80401 5.61203 4.83033 5.50979 4.87835C5.40756 4.92637 5.31638 4.99504 5.242 5.08003C5.038 5.30303 4.462 5.84203 4.462 6.93903C4.462 8.03503 5.26 9.09503 5.372 9.24403C5.484 9.39403 6.944 11.644 9.179 12.61C9.711 12.84 10.126 12.977 10.449 13.08C10.984 13.249 11.469 13.225 11.853 13.168C12.282 13.104 13.172 12.628 13.358 12.108C13.543 11.588 13.543 11.141 13.488 11.048C13.432 10.955 13.283 10.899 13.06 10.788V10.787H13.061Z"
            fill="#121117"
            />
        </svg>

        <span>WhatsApp</span>
        </a>

        <a href="">
        <svg
            width="16"
            height="16"
            viewBox="0 0 16 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
            d="M14.546 0H1.455C0.65 0 0 0.65 0 1.455V14.545C0 15.35 0.65 16 1.455 16H14.545C15.35 16 16 15.35 16 14.546V1.455C16 0.65 15.35 0 14.546 0ZM5.057 13.09H2.912V6.188H5.057V13.09ZM3.963 5.2C3.63135 5.2 3.31328 5.06825 3.07876 4.83374C2.84425 4.59922 2.7125 4.28115 2.7125 3.9495C2.7125 3.61785 2.84425 3.29978 3.07876 3.06526C3.31328 2.83075 3.63135 2.699 3.963 2.699C4.29479 2.699 4.61298 2.8308 4.84759 3.06541C5.0822 3.30002 5.214 3.61821 5.214 3.95C5.214 4.28179 5.0822 4.59998 4.84759 4.83459C4.61298 5.0692 4.29479 5.201 3.963 5.201M13.093 13.091H10.95V9.735C10.95 8.935 10.935 7.905 9.835 7.905C8.718 7.905 8.547 8.776 8.547 9.677V13.092H6.403V6.189H8.461V7.132H8.491C8.777 6.589 9.476 6.017 10.52 6.017C12.692 6.017 13.094 7.447 13.094 9.306L13.093 13.091Z"
            fill="#121117"
            />
        </svg>

        <span>LinkedIn</span>
        </a>

        <a href="">
        <svg
            width="18"
            height="18"
            viewBox="0 0 18 18"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
            d="M10.482 7.622L17.04 0H15.486L9.793 6.618L5.245 0H0L6.876 10.007L0 18H1.554L7.566 11.011L12.368 18H17.613L10.482 7.622ZM8.354 10.096L7.657 9.099L2.114 1.169H4.5L8.974 7.569L9.671 8.565L15.486 16.884H13.099L8.354 10.096Z"
            fill="#121117"
            />
        </svg>

        <span>X (Twitter)</span>
        </a>
    </div>
    </section>

    <!-- Reshedule Lesson -->
    <!-- ================ -->
    <section class="resheduleLesson resheduleLesson_popup">
    <div class="goBack">
        <img src="../img/cour/icons/Goback.png" alt="" />
    </div>

    <div class="closeIcon secondLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        />
        </svg>
    </div>

    <h1 class="heading">Reshedule lesson</h1>

    <div class="row01">
        <p>Current Lesson</p>
        <div class="card">
        <div class="left">
            <div class="imageContainer">
            <img src="../img/cour/1.png" alt="" />
            </div>
            <div class="container">
            <h5>Today</h5>
            <h1>Monday, Dec 9, 09:30 - 10:20</h1>
            <p>Weekly English with Dinella</p>
            </div>
        </div>

        <div class="totalLesson">
            <img src="../img/cour/icons/wallet.png" alt="" />
            <p>0 lessons</p>
        </div>
        </div>
    </div>

    <div class="newDateAndTime">
        <p>New date and time</p>

        <div class="dropdown time_dropdown">
        <div class="dropdown-button">
            <p>25 minutes</p>
            <svg
            width="14"
            height="8"
            viewBox="0 0 14 8"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            >
            <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M13.7004 1.32082C13.5918 1.1849 13.4575 1.07171 13.3051 0.987713C13.1527 0.903714 12.9853 0.850552 12.8124 0.831262C12.6395 0.811973 12.4645 0.826934 12.2973 0.875291C12.1302 0.923648 11.9742 1.00445 11.8383 1.11309L7.36694 4.68998L2.89451 1.11309C2.75941 0.998034 2.60257 0.911288 2.43331 0.858005C2.26404 0.804722 2.0858 0.785989 1.90915 0.802917C1.73251 0.819845 1.56106 0.872088 1.405 0.956548C1.24893 1.04101 1.11143 1.15596 1.00064 1.29459C0.889854 1.43321 0.808048 1.59268 0.760078 1.76353C0.712107 1.93437 0.69895 2.11312 0.721386 2.28915C0.743823 2.46518 0.801396 2.6349 0.890689 2.78826C0.979981 2.94161 1.09917 3.07546 1.24119 3.18186L6.54028 7.42113C6.77503 7.60859 7.06653 7.7107 7.36694 7.7107C7.66735 7.7107 7.95885 7.60859 8.1936 7.42113L13.4927 3.18186C13.6286 3.07324 13.7418 2.93891 13.8258 2.78654C13.9098 2.63417 13.963 2.46675 13.9822 2.29383C14.0015 2.12092 13.9866 1.9459 13.9382 1.77876C13.8899 1.61163 13.8091 1.45566 13.7004 1.31976V1.32082Z"
                fill="#121117"
            />
            </svg>
        </div>
        <div class="dropdown-menu">
            <div class="dropdown-item">25 minutes</div>
            <div class="dropdown-item">20 Minutes</div>
            <div class="dropdown-item">50 Minutes</div>
            <div class="dropdown-item">1 Hour</div>
            <div class="dropdown-item">1.5 Hour</div>
            <div class="dropdown-item">2 Hours</div>
        </div>
        </div>

        <div class="row02">
        <div class="date calendarOpen">
            <p id="selectedData">Monday, Dec 9</p>
            <svg
            width="8"
            height="4"
            viewBox="0 0 8 4"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            >
            <path
                d="M4.08934 3.89511C3.89586 4.04591 3.62463 4.04591 3.43115 3.89511L0.352673 1.49567C-0.0491378 1.18249 0.172324 0.538106 0.68177 0.538106L6.83872 0.538107C7.34817 0.538107 7.56963 1.18249 7.16782 1.49567L4.08934 3.89511Z"
                fill="black"
            />
            </svg>
        </div>

        <div class="dropdown limitedTime">
            <div class="dropdown-button">
            <p>10:30</p>
            <svg
                width="8"
                height="4"
                viewBox="0 0 8 4"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                d="M4.08934 3.89511C3.89586 4.04591 3.62463 4.04591 3.43115 3.89511L0.352673 1.49567C-0.0491378 1.18249 0.172324 0.538106 0.68177 0.538106L6.83872 0.538107C7.34817 0.538107 7.56963 1.18249 7.16782 1.49567L4.08934 3.89511Z"
                fill="black"
                />
            </svg>
            </div>
            <div class="dropdown-menu">
            <div class="dropdown-item">05:00</div>
            <div class="dropdown-item">05:30</div>
            <div class="dropdown-item">06:00</div>
            <div class="dropdown-item">06:30</div>
            <div class="dropdown-item">07:00</div>
            </div>
        </div>
        </div>
    </div>

    <button class="secondLayerBackdropClose">Continue</button>
    </section>

    <!-- Change your plan with Ranim A. -->
    <!-- ============================== -->
    <section class="change_your_plane change_your_plane_popup">
    <div class="closeIcon secondLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        />
        </svg>
    </div>

    <div class="row01">
        <div class="imageContainer">
        <img src="../img/cour/1.png" alt="" />
        </div>

        <h1>Change your plan with Ranim A.</h1>
    </div>
    <div class="row02">
        <div class="currentPlane">
        <p>Current plan</p>
        </div>

        <h4>4 lessons per week</h4>
        <p>16 lessons · $86 every 4 weeks</p>
    </div>
    <div class="row03 changePlaneBox">
        <div class="leftSide">
        <h4>5 lessons per week</h4>
        <p>20 lessons · $108 every 4 weeks</p>
        </div>
        <div class="rightSide">
        <div class="center_box"></div>
        </div>
    </div>
    <div class="row04">
        <p>Prices are for our standard lesson time of 50 min</p>
        <button class="btnToContinueChangePlane">Continue</button>
    </div>
    </section>

    <!-- Upgrade now? -->
    <!-- ============ -->
    <section class="upgradeNow upgradeNow_popup">
    <div class="backArrow">
        <img src="../img/cour/icons/Goback.png" alt="" />
    </div>

    <div class="closeIcon secondLayerBackdropCloses">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        />
        </svg>
    </div>

    <div class="top">
        <h1>Upgrade now?</h1>
        <p>
        You can activate your new plan immediately or wait until your billing
        cycle renews on December 10
        </p>
    </div>

    <div class="bottom">
        <div class="card review_your_changes_popupOpen">
        <div class="left">
            <img src="../img/cour/icons/process.png" alt="" />

            <div class="content">
            <div class="tag">
                <p>Recommended</p>
            </div>

            <h1>Proceed with the upgrade now</h1>
            <p>Start your new plan today with a payment.</p>
            </div>
        </div>

        <img src="../img/cour/icons/leftArrow.png" alt="" />
        </div>
        <div class="divider"></div>
        <div class="card great_popup_open">
        <div class="left">
            <img src="../img/cour/icons/calander_red.png" alt="" />

            <div class="content">
            <h1>Wait to upgrade on December 10</h1>
            <p>
                Your new plan will begin, and payment will be processed on
                December 10.
            </p>
            </div>
        </div>

        <img src="../img/cour/icons/leftArrow.png" alt="" />
        </div>
    </div>
    </section>

    <!-- Review your changes -->
    <!-- =================== -->
    <section class="review_your_changes review_your_changes_popup">
    <div class="backArrow">
        <img src="../img/cour/icons/Goback.png" alt="" />
    </div>

    <div class="closeIcon secondLayerBackdropCloses">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        />
        </svg>
    </div>

    <div class="review_your_changes_row01">
        <div class="imageContainer">
        <img src="../img/cour/1.png" alt="" />
        </div>
        <h1>Review your changes</h1>
    </div>

    <div class="review_your_changes_row02">
        <div class="row01">
        <h4>4 lessons per week</h4>
        <p>16 lessons · $86 every 4 weeks</p>
        </div>

        <img src="../img/cour/icons/bottomArrow.png" alt="" />

        <div class="row01">
        <h4>5 lessons per week</h4>
        <p>20 lessons · $108 every 4 weeks</p>
        </div>
    </div>

    <div class="review_your_changes_row03">
        <img src="../img/cour/icons/wallet.png" alt="" />
        <p>
        You’ll keep all remaining lessons from your current plan. Schedule
        them before <span>Dec 10</span>.
        </p>
    </div>

    <a href="" class="continueBtn">Continue to checkout</a>
    </section>

    <!-- Great! We’ve confirmed your upgrade. -->
    <!-- ==================================== -->
    <section class="great_popup">
    <div class="closeIcon secondLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        />
        </svg>
    </div>

    <div class="top">
        <div class="highlighted">
        <h1>5</h1>
        </div>
        <h1>Great! We’ve confirmed your upgrade.</h1>
    </div>

    <div class="bottom">
        <p>
        Starting Dec 10, your plan with Ranim A. will change to 5 lessons per
        week. Keep up the good work!
        </p>

        <button class="secondLayerBackdropClose">Okay, thanks!</button>
    </div>
    </section>

    <!-- Cancel lesson -->
    <!-- ============= -->
    <section class="cancel_lesson_popup">
    <div class="closeIcon secondLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        />
        </svg>
    </div>

    <div class="top">
        <div class="imageContainer">
        <img src="../img/cour/1.png" alt="" />
        </div>

        <div class="row01">
        <h1>Cancel lesson</h1>
        <p>Wednesday, November 20, 15:00-15:50</p>
        </div>

        <div class="policy">
        <img src="../img/cour/icons/policy.png" alt="" />

        <div class="policy_col01">
            <p>Cancellation policy</p>
            <p>
            When you cancel with less than 12 hours notice, the lesson will be
            deducted from your balance
            </p>
        </div>
        </div>
    </div>

    <form action="">
        <div class="row">
        <p>Please choose a reason for canceling</p>

        <div class="dropdown reasonOption">
            <div class="dropdown-button">
            <p>Select a reason</p>
            <svg
                width="14"
                height="8"
                viewBox="0 0 14 8"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M13.7004 1.32082C13.5918 1.1849 13.4575 1.07171 13.3051 0.987713C13.1527 0.903714 12.9853 0.850552 12.8124 0.831262C12.6395 0.811973 12.4645 0.826934 12.2973 0.875291C12.1302 0.923648 11.9742 1.00445 11.8383 1.11309L7.36694 4.68998L2.89451 1.11309C2.75941 0.998034 2.60257 0.911288 2.43331 0.858005C2.26404 0.804722 2.0858 0.785989 1.90915 0.802917C1.73251 0.819845 1.56106 0.872088 1.405 0.956548C1.24893 1.04101 1.11143 1.15596 1.00064 1.29459C0.889854 1.43321 0.808048 1.59268 0.760078 1.76353C0.712107 1.93437 0.69895 2.11312 0.721386 2.28915C0.743823 2.46518 0.801396 2.6349 0.890689 2.78826C0.979981 2.94161 1.09917 3.07546 1.24119 3.18186L6.54028 7.42113C6.77503 7.60859 7.06653 7.7107 7.36694 7.7107C7.66735 7.7107 7.95885 7.60859 8.1936 7.42113L13.4927 3.18186C13.6286 3.07324 13.7418 2.93891 13.8258 2.78654C13.9098 2.63417 13.963 2.46675 13.9822 2.29383C14.0015 2.12092 13.9866 1.9459 13.9382 1.77876C13.8899 1.61163 13.8091 1.45566 13.7004 1.31976V1.32082Z"
                fill="#121117"
                />
            </svg>
            </div>
            <div class="dropdown-menu">
            <div class="dropdown-item">Select a reason 1</div>
            <div class="dropdown-item">Select a reason 2</div>
            <div class="dropdown-item">Select a reason 3</div>
            <div class="dropdown-item">Select a reason 4</div>
            <div class="dropdown-item">Select a reason 5</div>
            <div class="dropdown-item">Select a reason 6</div>
            </div>
        </div>
        </div>

        <div class="row">
        <label for="reason">Message for Dinela • Optional</label>
        <textarea
            name="reason"
            id="reason"
            placeholder="I need to cancel because..."
        ></textarea>
        </div>

        <button type="submit">Confirm cancellation</button>
    </form>
    </section>

    <!-- Message Toaster -->
    <div class="toaster notActive">
    <div class="correct"></div>
    <p>Successfully toasted!</p>
    </div>

    <!-- Calander -->
    <!-- ========= -->
    <div class="calendar-modal" id="calendarModal">
    <div class="calendar-container">
        <div class="calendar-header">
        <h2>Select Date</h2>
        <button class="close-btn" id="closeBtn">✖</button>
        </div>
        <input
        type="text"
        id="datePicker"
        name="datePicker"
        placeholder="Select a date"
        />
        <button class="confirm-btn">Confirm</button>
    </div>
    </div>

    <!-- Which tutor? -->
    <!-- ============ -->
    <div class="whichTutor">
    <div class="whichTutor_close_icon firstLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        ></path>
        </svg>
    </div>

    <h1>Which tutor?</h1>

    <div class="tutors">
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/1.png" alt="" />
            </div>
            <div class="content">
            <h1>Dinela</h1>
            <p>6 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/2.png" alt="" />
            </div>
            <div class="content">
            <h1>Wade Warren</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/3.png" alt="" />
            </div>
            <div class="content">
            <h1>Albert Flores</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/4.png" alt="" />
            </div>
            <div class="content">
            <h1>Daniel A.</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/5.png" alt="" />
            </div>
            <div class="content">
            <h1>Javier G.</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/6.png" alt="" />
            </div>
            <div class="content">
            <h1>David H.</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/7.png" alt="" />
            </div>
            <div class="content">
            <h1>Marbe B.</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/8.png" alt="" />
            </div>
            <div class="content">
            <h1>Andrew S.</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/7.png" alt="" />
            </div>
            <div class="content">
            <h1>Marbe B.</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/8.png" alt="" />
            </div>
            <div class="content">
            <h1>Andrew S.</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/1.png" alt="" />
            </div>
            <div class="content">
            <h1>Dinela</h1>
            <p>6 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/2.png" alt="" />
            </div>
            <div class="content">
            <h1>Wade Warren</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/3.png" alt="" />
            </div>
            <div class="content">
            <h1>Albert Flores</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/4.png" alt="" />
            </div>
            <div class="content">
            <h1>Daniel A.</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/5.png" alt="" />
            </div>
            <div class="content">
            <h1>Javier G.</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/6.png" alt="" />
            </div>
            <div class="content">
            <h1>David H.</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/7.png" alt="" />
            </div>
            <div class="content">
            <h1>Marbe B.</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/8.png" alt="" />
            </div>
            <div class="content">
            <h1>Andrew S.</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/7.png" alt="" />
            </div>
            <div class="content">
            <h1>Marbe B.</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
        <div class="tutor_card">
        <div class="tutor_card_leftSide">
            <div class="imageContainer">
            <img src="../img/cour/8.png" alt="" />
            </div>
            <div class="content">
            <h1>Andrew S.</h1>
            <p>0 lessons to schedule</p>
            </div>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="7"
            height="12"
            viewBox="0 0 7 12"
            fill="none"
            class="tutor_card_rightArrow"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.195225 0.195191C0.0702444 0.320209 3.40715e-05 0.489748 3.40715e-05 0.666524C3.40715e-05 0.8433 0.0702444 1.01284 0.195225 1.13786L5.05723 5.99986L0.195225 10.8619C0.131552 10.9234 0.0807631 10.9969 0.0458238 11.0783C0.0108845 11.1596 -0.0075064 11.2471 -0.00827561 11.3356C-0.00904482 11.4241 0.00782347 11.5119 0.0413441 11.5938C0.0748647 11.6758 0.124367 11.7502 0.186962 11.8128C0.249557 11.8754 0.323991 11.9249 0.405922 11.9584C0.487853 11.9919 0.575639 12.0088 0.664159 12.008C0.752678 12.0073 0.840159 11.9889 0.921495 11.9539C1.00283 11.919 1.07639 11.8682 1.13789 11.8045L6.47123 6.47119C6.59621 6.34617 6.66642 6.17663 6.66642 5.99986C6.66642 5.82308 6.59621 5.65354 6.47123 5.52852L1.13789 0.195191C1.01287 0.0702102 0.843334 0 0.666558 0C0.489782 0 0.320244 0.0702102 0.195225 0.195191Z"
            fill="#6A697C"
            />
        </svg>
        </div>
    </div>
    </div>

    <!-- User Options -->
    <!-- ============ -->
    <div class="options userOptions">
    <a href="" class="option">
        <img src="../img/cour/icons/message.png" alt="" />
        <p>Message Tutor</p>
    </a>
    <div class="option shareTutorOpen">
        <img src="../img/cour/icons/share.png" alt="" />
        <p>Share Tutor</p>
    </div>
    <a href="" class="option">
        <img src="../img/cour/icons/User.png" alt="" />
        <p>See Tutor Profile</p>
    </a>
    <div href="" class="option reshedule_popup_open">
        <img src="../img/cour/icons/calander.png" alt="" />
        <p>Reshedule</p>
    </div>
    <div href="" class="option cancel_popup_open">
        <img src="../img/cour/icons/cancel.png" alt="" />
        <p>Cancel</p>
    </div>
    </div>

    <!-- Subcribtion options -->
    <!-- =================== -->
    <div class="options userOptions subscription_dropdown_options">
    <a href="" class="option">
        <img src="../img/cour/icons/calander.png" alt="" />
        <p>Schedule lessons</p>
    </a>
    <div class="option">
        <img src="../img/cour/icons/revision.png" alt="" />
        <p>Change nenewal date</p>
    </div>
    <a href="" class="option">
        <img src="../img/cour/icons/dollar.png" alt="" />
        <p>Change your plan</p>
    </a>
    <div href="" class="option">
        <img src="../img/cour/icons/wallet.png" alt="" />
        <p>Add extra lessons</p>
    </div>
    <div href="" class="option">
        <img src="../img/cour/icons/revision.png" alt="" />
        <p>Transfer lessons or subscription</p>
    </div>
    <div href="" class="option">
        <img src="../img/cour/icons/cancel.png" alt="" />
        <p>Cancel Subscription</p>
    </div>
    </div>

    <!-- extra lessons -->
    <!-- ============= -->
    <div class="extraLesson">
    <div class="closeIcon firstLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        ></path>
        </svg>
    </div>

    <div class="row01">
        <div class="imageContainer">
        <img src="../img/cour/1.png" alt="" />
        </div>
        <h1>Add extra lessons with Dinela</h1>
        <p>
        Buy more lessons without changing your plan. Schedule these lessons
        before Jan 07.
        </p>
    </div>

    <div class="row02">
        <div class="top">
        <div class="increment">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="2"
            viewBox="0 0 16 2"
            fill="none"
            >
            <path d="M0 0H16V2H0V0Z" fill="#121117" />
            </svg>
        </div>
        <div class="value">
            <h1>1</h1>
            <p>extra lessons</p>
        </div>
        <div class="decrement">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            >
            <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M13 4H11V11H4V13H11V20H13V13H20V11H13V4Z"
                fill="#121117"
            />
            </svg>
        </div>
        </div>
        <div class="horizontalLine"></div>
        <div class="bottom">
        <h1>
            Total: $<span class="after_increment_and_decrement_value">5</span>
        </h1>
        </div>
    </div>

    <button class="confirm_payment_modal_open">Continue</button>
    </div>

    <!-- Confirm Payment -->
    <!-- =============== -->
    <div class="confirm_payment">
    <div class="goBack">
        <img src="../img/cour/icons/Goback.png" alt="" />
    </div>
    <div class="closeIcon firstLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        ></path>
        </svg>
    </div>

    <h1 class="heading">Confirm payment</h1>

    <div class="row01">
        <div class="top">
        <div class="row01_top_row1">
            <div class="row01_top_row1_left">
            <p><span class="extraLesson_count">2</span> extra lessons</p>
            <p class="tag">Expire Jan 7</p>
            </div>
            <p class="price totalLessonAmount">$10.80</p>
        </div>
        <div class="row01_top_row1">
            <div class="row01_top_row1_left">
            <p>Processing fee</p>
            </div>
            <p class="price">$0.54</p>
        </div>
        </div>
        <div class="bottom">
        <p>Total</p>
        <p class="totalLesson_amountWithProcessingFee">$11.34</p>
        </div>
    </div>
    <div class="horizontalLine"></div>
    <h2>Payment with</h2>
    <div class="paymentLabel">
        <div class="left">
        <img src="../img/cour/icons/visa.png" alt="" />
        <p>Visa **** 1345</p>
        </div>

        <a href="" class="editBTN">Edit</a>
    </div>
    <p class="instruction">
        By pressing the "Confirm payment" button, you agree to
        <a href="">Preply’s Refund</a> <a href="">and Payment Policy</a>
    </p>

    <button class="firstLayerBackdropClose">
        Confirm payment · $<span class="totalAmountShowInBtn">11.34</span>
    </button>
    </div>

    <!-- Transfer lessons or subscription -->
    <!-- =============================== -->
    <div class="transferLessons_subscription">
    <div class="closeIcon secondLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        ></path>
        </svg>
    </div>

    <h1 class="heading">Transfer lessons or subscription</h1>

    <div class="cards">
        <div class="card">
        <div class="left">
            <h1>Transfer balance for a trial lesson</h1>
            <p>
            If you need to learn more with another tutor for some time If your
            lessons are expiring soon and you want to use them with another
            tutor
            </p>
        </div>
        <div class="circle"><div class="innerCircle"></div></div>
        </div>

        <div class="card">
        <div class="left">
            <h1>Transfer lessons</h1>
            <p>
            If you need to learn more with another tutor for some time If your
            lessons are expiring soon and you want to use them with another
            tutor
            </p>
        </div>
        <div class="circle"><div class="innerCircle"></div></div>
        </div>

        <div class="card">
        <div class="left">
            <h1>Transfer subscription</h1>
            <p>Completely switch your monthly plan to a new tutor</p>
        </div>
        <div class="circle"><div class="innerCircle"></div></div>
        </div>
    </div>

    <button class="transferLessons_subscription_btn_ModalOpen">
        Continue
    </button>
    </div>

    <!-- Transfer Balance -->
    <!-- ================ -->
    <div class="transferBalance">
    <div class="closeIcon secondLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        ></path>
        </svg>
    </div>

    <div class="backButton">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        viewBox="0 0 16 16"
        fill="none"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M3.91406 8.9932L15.9141 8.9932L15.9141 6.99319L3.91406 6.9932L9.20706 1.7002L7.79306 0.286195L0.0860627 7.9932L7.79306 15.7002L9.20706 14.2862L3.91406 8.9932Z"
            fill="#121117"
        />
        </svg>
    </div>

    <h1 class="heading">Transfer balance</h1>

    <div class="row01">
        <div class="from">
        <h1>From</h1>
        <p>Select teacher</p>
        </div>

        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="17"
        height="16"
        viewBox="0 0 17 16"
        fill="none"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M12.5859 6.99313H0.585938V8.99313H12.5859L7.29294 14.2861L8.70694 15.7001L16.4139 7.99313L8.70694 0.286133L7.29294 1.70013L12.5859 6.99313Z"
            fill="#121117"
        />
        </svg>
    </div>

    <p class="peragraph">
        Select the tutor you want to transfer balance from
    </p>

    <div class="cards cardsfrom">
        <div class="card">
        <div class="left">
            <div class="imageContainer">
            <img src="../img/cour/13.png" alt="" />
            </div>

            <div class="content">
            <h1>Albert</h1>
            <p>English · 8-week plan · $7.60/lesson</p>
            <h2>5 lessons · $25.65 left</h2>
            </div>
        </div>
        <div class="circle">
            <div class="innerCircle"></div>
        </div>
        </div>

        <div class="card">
        <div class="left">
            <div class="imageContainer">
            <img src="../img/cour/14.png" alt="" />
            </div>

            <div class="content">
            <h1>Karen V.</h1>
            <p>English · 6-week plan · $7.60/lesson</p>
            <h2>1 lessons · $25.65 left</h2>
            </div>
        </div>
        <div class="circle">
            <div class="innerCircle"></div>
        </div>
        </div>
    </div>

    <button class="transferBalanceFrom_ModalOpen">Continue</button>
    </div>

    <!-- Transfer Balance -->
    <!-- ================ -->
    <div class="transferBalance transferBalanceTo">
    <div class="closeIcon secondLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        ></path>
        </svg>
    </div>

    <div class="backButton">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        viewBox="0 0 16 16"
        fill="none"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M3.91406 8.9932L15.9141 8.9932L15.9141 6.99319L3.91406 6.9932L9.20706 1.7002L7.79306 0.286195L0.0860627 7.9932L7.79306 15.7002L9.20706 14.2862L3.91406 8.9932Z"
            fill="#121117"
        />
        </svg>
    </div>

    <h1 class="heading">Transfer balance</h1>

    <div class="row01">
        <div class="from">
        <h1>Albert</h1>
        <p>lessons . $</p>
        </div>

        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="17"
        height="16"
        viewBox="0 0 17 16"
        fill="none"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M12.5859 6.99313H0.585938V8.99313H12.5859L7.29294 14.2861L8.70694 15.7001L16.4139 7.99313L8.70694 0.286133L7.29294 1.70013L12.5859 6.99313Z"
            fill="#121117"
        />
        </svg>

        <div class="from to">
        <h1>To</h1>
        <p>Select teacher</p>
        </div>
    </div>

    <p class="peragraph">
        Select the tutor you want to transfer balance from
    </p>

    <div class="cards cardsTo">
        <div class="card">
        <div class="left">
            <div class="imageContainer">
            <img src="../img/cour/15.png" alt="" />
            </div>

            <div class="content">
            <h1>Lucia B.</h1>
            <p>English · 4-week plan · $7.60/lesson</p>
            <h2 class="blueColor">Book a trial lesson!</h2>
            </div>
        </div>
        <div class="circle">
            <div class="innerCircle"></div>
        </div>
        </div>
        <div class="card">
        <div class="left">
            <div class="imageContainer">
            <img src="../img/cour/16.png" alt="" />
            </div>

            <div class="content">
            <h1>Triny A.</h1>
            <p>English · 6-week plan · $7.60/lesson</p>
            <h2 class="blueColor">Book a trial lesson!</h2>
            </div>
        </div>
        <div class="circle">
            <div class="innerCircle"></div>
        </div>
        </div>
        <div class="card">
        <div class="left">
            <div class="imageContainer">
            <img src="../img/cour/16.png" alt="" />
            </div>

            <div class="content">
            <h1>Triny A.</h1>
            <p>English · 6-week plan · $7.60/lesson</p>
            <h2 class="blueColor">Book a trial lesson!</h2>
            </div>
        </div>
        <div class="circle">
            <div class="innerCircle"></div>
        </div>
        </div>
        <div class="card">
        <div class="left">
            <div class="imageContainer">
            <img src="../img/cour/16.png" alt="" />
            </div>

            <div class="content">
            <h1>Triny A.</h1>
            <p>English · 6-week plan · $7.60/lesson</p>
            <h2 class="blueColor">Book a trial lesson!</h2>
            </div>
        </div>
        <div class="circle">
            <div class="innerCircle"></div>
        </div>
        </div>
        <div class="card">
        <div class="left">
            <div class="imageContainer">
            <img src="../img/cour/16.png" alt="" />
            </div>

            <div class="content">
            <h1>Triny A.</h1>
            <p>English · 6-week plan · $7.60/lesson</p>
            <h2 class="blueColor">Book a trial lesson!</h2>
            </div>
        </div>
        <div class="circle">
            <div class="innerCircle"></div>
        </div>
        </div>
        <div class="card">
        <div class="left">
            <div class="imageContainer">
            <img src="../img/cour/16.png" alt="" />
            </div>

            <div class="content">
            <h1>Triny A.</h1>
            <p>English · 6-week plan · $7.60/lesson</p>
            <h2 class="blueColor">Book a trial lesson!</h2>
            </div>
        </div>
        <div class="circle">
            <div class="innerCircle"></div>
        </div>
        </div>
    </div>

    <a href="">Find Tutors</a>
    <button class="transferLessonsOpen">Continue</button>
    </div>

    <!-- Transfer lessons -->
    <!-- ================ -->
    <div class="transferBalance transferLessonsTo transferLessons">
    <div class="closeIcon secondLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        ></path>
        </svg>
    </div>

    <div class="backButton">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        viewBox="0 0 16 16"
        fill="none"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M3.91406 8.9932L15.9141 8.9932L15.9141 6.99319L3.91406 6.9932L9.20706 1.7002L7.79306 0.286195L0.0860627 7.9932L7.79306 15.7002L9.20706 14.2862L3.91406 8.9932Z"
            fill="#121117"
        />
        </svg>
    </div>

    <h1 class="heading">Transfer lessons</h1>

    <div class="row01">
        <div class="from">
        <h1>Albert</h1>
        <p class="fromLessonAndAmount">lessons . $</p>
        </div>

        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="17"
        height="16"
        viewBox="0 0 17 16"
        fill="none"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M12.5859 6.99313H0.585938V8.99313H12.5859L7.29294 14.2861L8.70694 15.7001L16.4139 7.99313L8.70694 0.286133L7.29294 1.70013L12.5859 6.99313Z"
            fill="#121117"
        />
        </svg>

        <div class="from to">
        <h1>Lucia B.</h1>
        <p class="toLessonAndAmount">lessons . $</p>
        </div>
    </div>

    <div class="horizontalLine"></div>

    <p class="peragraph">Select the amount of lessons to transfer</p>

    <div class="lesson_and_dragger">
        <h1 id="lessonCount">1 lesson</h1>

        <div class="drag_lesson">
        <div class="blackArea slider-track"></div>
        <div class="grayArea"></div>
        <div class="dragger slider-thumb"></div>
        </div>
    </div>

    <div class="box lessonDetailBox">
        <p class="topPera accortingLessonTexts">
        Your tutors have different lesson prices, so when you transfer
        <span>1 lesson from Albert ($5.18/lesson)</span>, you will need to
        cover a price difference of
        <span>$2.50 to get 1 lesson with Lucia B. ($7.68/lesson)</span>
        </p>

        <div class="bottomContent">
        <div class="left">
            <div class="user">
            <div class="imageContainer">
                <img src="../img/cour/13.png" alt="" />
            </div>

            <h1>Albert</h1>
            </div>

            <div class="lesson lessonFromBox">
            <div></div>
            </div>

            <h1 class="shortDetail_fromUser">1 lesson</h1>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
        >
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M16.0859 10.9931H4.08594V12.9931H16.0859L10.7929 18.2861L12.2069 19.7001L19.9139 11.9931L12.2069 4.28613L10.7929 5.70013L16.0859 10.9931Z"
            fill="#121117"
            />
        </svg>

        <div class="left">
            <div class="user">
            <div class="imageContainer">
                <img src="../img/cour/15.png" alt="" />
            </div>
            <h1>Lucia B.</h1>
            </div>

            <div class="lesson lessonToBox">
            <div></div>
            </div>

            <h1 class="shortDetail_toUser">
            <span>$2.50 to pay</span> for a full lesson
            </h1>
        </div>
        </div>

        <p class="extraContent_ofTransferLessons"></p>
    </div>

    <button class="active tellUsWhyOpen">Continue</button>
    </div>

    <!-- Tell Us Why -->
    <!-- =========== -->
    <div class="transferBalance tellUsWhy">
    <div class="closeIcon secondLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        ></path>
        </svg>
    </div>

    <div class="backButton">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        viewBox="0 0 16 16"
        fill="none"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M3.91406 8.9932L15.9141 8.9932L15.9141 6.99319L3.91406 6.9932L9.20706 1.7002L7.79306 0.286195L0.0860627 7.9932L7.79306 15.7002L9.20706 14.2862L3.91406 8.9932Z"
            fill="#121117"
        />
        </svg>
    </div>

    <h1 class="heading">Tell us why</h1>

    <div class="row01">
        <div class="from">
        <h1>Albert</h1>
        <p>lessons . $</p>
        </div>

        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="17"
        height="16"
        viewBox="0 0 17 16"
        fill="none"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M12.5859 6.99313H0.585938V8.99313H12.5859L7.29294 14.2861L8.70694 15.7001L16.4139 7.99313L8.70694 0.286133L7.29294 1.70013L12.5859 6.99313Z"
            fill="#121117"
        />
        </svg>

        <div class="from to">
        <h1>Lucia B.</h1>
        <p>lessons . $</p>
        </div>
    </div>

    <div class="horizontalLine"></div>

    <p class="peragraph">
        Tell us why you decided to transfer. We won't share this with your
        tutors.
    </p>

    <div class="options">
        <div class="option">
        <p>I want to focus on another subject</p>
        <div class="circle"><div class="innerCircle"></div></div>
        </div>

        <div class="option">
        <p>Too many lessons left</p>
        <div class="circle"><div class="innerCircle"></div></div>
        </div>

        <div class="option">
        <p>Problems with availability</p>
        <div class="circle"><div class="innerCircle"></div></div>
        </div>

        <div class="option">
        <p>Unhappy with my tutor</p>
        <div class="circle"><div class="innerCircle"></div></div>
        </div>

        <div class="otherAsyncTextarea">
        <p>Other</p>
        <div class="circle"><div class="innerCircle"></div></div>
        </div>

        <textarea
        name="defineWhatOther"
        id="defineWhatOther"
        placeholder="Define here..."
        class="otherAsync"
        ></textarea>
    </div>

    <button class="transferCompleteOpen">Continue</button>
    </div>

    <!-- Transfer complete! -->
    <!-- ================= -->
    <div class="TransferComplete">
    <div class="closeIcon secondLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        ></path>
        </svg>
    </div>

    <div class="topPart">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="40"
        height="41"
        viewBox="0 0 40 41"
        fill="none"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M26.582 4.61L20 0.5L13.418 4.61L5.858 6.358L4.11 13.918L0 20.5L4.11 27.082L5.858 34.642L13.418 36.39L20 40.5L26.582 36.39L34.142 34.642L35.89 27.082L40 20.5L35.89 13.918L34.142 6.358L26.582 4.61ZM15.586 27.914L17 29.328L18.414 27.914L30.414 15.914L27.586 13.086L17 23.672L12.414 19.086L9.586 21.914L15.586 27.914Z"
            fill="#FF2500"
        />
        </svg>
        <h1>Transfer complete!</h1>
    </div>

    <div class="content">
        <p>
        You have <span>1 Trial lessons</span> available to schedule with Lucia
        B. and <span>$2.66 credit</span> for your future payments.
        </p>

        <p>
        Remember to schedule your balance by <span>Mar 18, 2025</span> so it
        doesn't expire when your subscription renews.
        </p>
    </div>

    <a href="">Schedule lessons</a>
    </div>

    <!-- Review Your Transfer -->
    <!-- ==================== -->
    <div class="transferBalance transferLessonsTo reviewYourTransfer">
    <div class="closeIcon secondLayerBackdropClose">
        <svg
        width="13"
        height="13"
        viewBox="0 0 13 13"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M1.414 0L0 1.414L4.95 6.364L0 11.314L1.414 12.728L6.364 7.778L11.314 12.728L12.728 11.314L7.778 6.364L12.728 1.414L11.314 0L6.364 4.95L1.414 0Z"
            fill="#121117"
        ></path>
        </svg>
    </div>

    <div class="backButton">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        viewBox="0 0 16 16"
        fill="none"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M3.91406 8.9932L15.9141 8.9932L15.9141 6.99319L3.91406 6.9932L9.20706 1.7002L7.79306 0.286195L0.0860627 7.9932L7.79306 15.7002L9.20706 14.2862L3.91406 8.9932Z"
            fill="#121117"
        />
        </svg>
    </div>

    <h1 class="heading">Review your transfer</h1>

    <div class="row01">
        <div class="from">
        <h1>Dinela</h1>
        <p>16 lessons / 4 weeks</p>
        </div>

        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="17"
        height="16"
        viewBox="0 0 17 16"
        fill="none"
        >
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M12.5859 6.99313H0.585938V8.99313H12.5859L7.29294 14.2861L8.70694 15.7001L16.4139 7.99313L8.70694 0.286133L7.29294 1.70013L12.5859 6.99313Z"
            fill="#121117"
        />
        </svg>

        <div class="from to">
        <h1>David</h1>
        <p class="toLessonAndAmount">16 lessons / 4 weeks</p>
        </div>
    </div>

    <div class="content">
        <h1>What happens next</h1>

        <ul>
        <li>
            Your subscription with Ranim will stop and you won’t be charged
            again
        </li>
        <li>
            Your first subscription refill and payment with Patricia willhappen
            on Dec 10, 2024 (16 lessons · $176.00 every 4 weeks)
        </li>
        </ul>
    </div>

    <button class="active secondLayerBackdropClose">Continue</button>
    </div>

    <section class="backdrop"></section>
    <section class="backdrop_nested"></section>
    <section class="calendar_backdrop"></section>

</div>

 <?php require_once('schedule_session.php');?>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="../js/calendar.js?v=<?php echo time(); ?>"></script>
<script src="../js/MessageTypingArea.js?v=<?php echo time(); ?>"></script>
<script src="../js/script.js?v=<?php echo time(); ?>"></script>
<script src="../js/modifyindex.js?v=<?php echo time(); ?>"></script>
<?php

echo $OUTPUT->footer();

