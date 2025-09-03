
/* --- Data (trimmed to match your flow) --- */
const my_lessons_details_reshedule_weekData = {
  days: [
    { key:"Sun 16", slots:["03:00","07:30","08:00","08:30","09:00","10:00","10:30"] },
    { key:"Mon 17", slots:["07:30","08:00","08:30","09:00","09:30","10:00"] },
    { key:"Tue 18", slots:["07:30","08:00","08:30","09:00","10:30"] },
    { key:"Wed 19", slots:["07:30","08:00","08:30","09:00","09:30","10:00"] },
    { key:"Thu 20", slots:["05:00","05:30","06:00","06:30","07:00","08:30","09:00"] },
    { key:"Fri 21", slots:["07:00","07:30","08:00","08:30","09:00"] },
    { key:"Sat 22", slots:["07:00","07:30","08:00"] }
  ],
  reservedTips: {
    "07:00@Fri 21": { title:"Your Lesson With Daniela", sub:"Saturday, Frb 22, 7:00 – 7:25 PM" }
  }
};

/* --- Helpers --- */
function my_lessons_details_reshedule_dayNice(dayKey){
  const map={Sun:"Sunday",Mon:"Monday",Tue:"Tuesday",Wed:"Wednesday",Thu:"Thursday",Fri:"Friday",Sat:"Saturday"};
  const p=dayKey.split(' ');return (map[p[0]]||p[0])+" "+p[1];
}
function my_lessons_details_reshedule_addMinutes(hhmm, add=50){
  const [h,m]=hhmm.split(':').map(Number);
  const total=h*60+m+add, hh=Math.floor(total/60)%24, mm=total%60;
  const pad=n=>String(n).padStart(2,'0'); return `${pad(hh)}:${pad(mm)}`;
}
function my_lessons_details_reshedule_format(dayKey,time){
  const full=my_lessons_details_reshedule_dayNice(dayKey);
  const end=my_lessons_details_reshedule_addMinutes(time,50);
  const startPretty=time.startsWith("0")?time.slice(1):time;
  return `${full}, Frb, ${startPretty}–${end}`;
}
function my_lessons_details_reshedule_allTimesSorted(){
  const set=new Set(); my_lessons_details_reshedule_weekData.days.forEach(d=>d.slots.forEach(t=>set.add(t)));
  return [...set].sort((a,b)=> (+a.slice(0,2)*60+ +a.slice(3)) - (+b.slice(0,2)*60+ +b.slice(3)));
}

/* --- State --- */
const my_lessons_details_reshedule_selected = new Map(); // key -> label

/* --- Render grid --- */
function my_lessons_details_reshedule_renderGrid(){
  const times=my_lessons_details_reshedule_allTimesSorted();
  const $grid=$("#my_lessons_details_reshedule_grid").empty();

  times.forEach(time=>{
    const $row=$('<div class="my_lessons_details_reshedule_row"></div>');
    my_lessons_details_reshedule_weekData.days.forEach(day=>{
      const key=`${time}@${day.key}`;
      const has=day.slots.includes(time);
      if(!has){
        $row.append(`<div class="my_lessons_details_reshedule_cell"><div class="my_lessons_details_reshedule_placeholder"></div></div>`);
      }else{
        const tip=my_lessons_details_reshedule_weekData.reservedTips[key];
        const sel=my_lessons_details_reshedule_selected.has(key);
        const cls=`my_lessons_details_reshedule_slot${tip?' my_lessons_details_reshedule_disabled':''}${sel?' my_lessons_details_reshedule_selected':''}`;
        $row.append(`<div class="my_lessons_details_reshedule_cell">
          <div class="${cls}" data-key="${key}" data-time="${time}" data-day="${day.key}">${time}</div>
        </div>`);
      }
    });
    $grid.append($row.children());
  });
}

/* --- Right panel list of boxes --- */
function my_lessons_details_reshedule_refreshBoxes(){
  const $f=$("#my_lessons_details_reshedule_chipfield").empty();
  if(my_lessons_details_reshedule_selected.size===0){
    $f.append('<div class="my_lessons_details_reshedule_phField" id="my_lessons_details_reshedule_placeholder">Lesson</div>');
  }else{
    for(const [key,label] of my_lessons_details_reshedule_selected){
      $f.append(`<div class="my_lessons_details_reshedule_chipBox" data-key="${key}">
        <span>${label}</span>
        <button type="button" class="my_lessons_details_reshedule_chipRemove" aria-label="Remove">×</button>
      </div>`);
    }
  }
  my_lessons_details_reshedule_updateCTA();
}

/* --- CTA state (disabled grey -> active red) --- */
function my_lessons_details_reshedule_updateCTA(){
  const $cta=$("#my_lessons_details_reshedule_cta");
  if(my_lessons_details_reshedule_selected.size>0){
    $cta.prop("disabled",false).addClass("my_lessons_details_reshedule_active");
  }else{
    $cta.prop("disabled",true).removeClass("my_lessons_details_reshedule_active");
  }
}

/* --- Tooltip helpers --- */
let my_lessons_details_reshedule_tipEl=null;
function my_lessons_details_reshedule_showTip($slot,data){
  my_lessons_details_reshedule_hideTip();
  const r=$slot[0].getBoundingClientRect();
  my_lessons_details_reshedule_tipEl=$(`
    <div class="my_lessons_details_reshedule_tip" id="my_lessons_details_reshedule_tip">
      ${data.title}<span class="my_lessons_details_reshedule_tip_sub">${data.sub}</span>
    </div>`).appendTo(document.body);
  const t=my_lessons_details_reshedule_tipEl[0].getBoundingClientRect();
  let top=r.bottom+8,left=r.left+Math.max(0,(r.width-t.width)/2);
  left=Math.max(8,Math.min(left,window.innerWidth-t.width-8));
  my_lessons_details_reshedule_tipEl.css({top:top+"px",left:left+"px"});
}
function my_lessons_details_reshedule_hideTip(){
  if(my_lessons_details_reshedule_tipEl){my_lessons_details_reshedule_tipEl.remove();my_lessons_details_reshedule_tipEl=null;}
}

/* --- Events --- */
$(document).on("click",".my_lessons_details_reshedule_slot",function(){
  const $el=$(this);
  const key=$el.data("key"), time=$el.data("time"), day=$el.data("day");
  const tip=my_lessons_details_reshedule_weekData.reservedTips[key];

  if($el.hasClass("my_lessons_details_reshedule_disabled") && tip){
    my_lessons_details_reshedule_showTip($el, tip);
    return;
  }
  my_lessons_details_reshedule_hideTip();

  if(my_lessons_details_reshedule_selected.has(key)){
    my_lessons_details_reshedule_selected.delete(key);
    $el.removeClass("my_lessons_details_reshedule_selected");
  }else{
    my_lessons_details_reshedule_selected.set(key, my_lessons_details_reshedule_format(day,time));
    $el.addClass("my_lessons_details_reshedule_selected");
  }
  my_lessons_details_reshedule_refreshBoxes();
});

$(document).on("click",".my_lessons_details_reshedule_chipRemove",function(){
  const $box=$(this).closest(".my_lessons_details_reshedule_chipBox");
  const key=$box.data("key");
  my_lessons_details_reshedule_selected.delete(key);
  $(`.my_lessons_details_reshedule_slot[data-key="${key}"]`).removeClass("my_lessons_details_reshedule_selected");
  my_lessons_details_reshedule_refreshBoxes();
});

$(document).on("click",e=>{
  if(!$(e.target).closest(".my_lessons_details_reshedule_slot,#my_lessons_details_reshedule_tip").length){
    my_lessons_details_reshedule_hideTip();
  }
});
$("#my_lessons_details_reshedule_leftpane").on("scroll",my_lessons_details_reshedule_hideTip);
$(window).on("resize",my_lessons_details_reshedule_hideTip);

/* Close icon: go back or close */
$("#my_lessons_details_reshedule_close").on("click",function(){
  if (window.history.length>1) { window.history.back(); }
  else { window.close(); }
});

/* Demo arrows */
$("#my_lessons_details_reshedule_prev,#my_lessons_details_reshedule_next").on("click",()=>alert("Hook to your data source"));

/* Init */
$(function(){
  my_lessons_details_reshedule_renderGrid();
  my_lessons_details_reshedule_refreshBoxes();
});
