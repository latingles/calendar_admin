<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Multi-Step Modal Full Flow</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body { background: #fafbfc; }
    #my_lessons_tutors_tab_add_extra_lessons_modal_backdrop {
      display: none;
      position: fixed; z-index: 9998;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.28);
    }
    #my_lessons_tutors_tab_add_extra_lessons_modal {
      display: none;
      position: fixed; z-index: 9999;
      top: 50%; left: 50%;
      transform: translate(-50%, -50%);
      background: #fff;
      width: 420px;
      max-width: 96vw;
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.15);
      padding: 0 0 28px 0;
      font-family: 'Inter', Arial, sans-serif;
      overflow: hidden;
    }
    .my_lessons_tutors_tab_add_extra_lessons_header,
    .my_lessons_tutors_tab_add_extra_lessons_step6_header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 22px 0 18px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_header .back-arrow,
    .my_lessons_tutors_tab_add_extra_lessons_header .close-icon,
    .my_lessons_tutors_tab_add_extra_lessons_step6_header .back-arrow,
    .my_lessons_tutors_tab_add_extra_lessons_step6_header .close-icon {
      font-size: 1.8rem;
      color: #232323;
      cursor: pointer;
      background: none;
      border: none;
      padding: 0 2px;
      line-height: 1;
    }
    .my_lessons_tutors_tab_add_extra_lessons_profile_img,
    .my_lessons_tutors_tab_add_extra_lessons_step3_profile_img,
    .my_lessons_tutors_tab_add_extra_lessons_step5_profile_img {
      width: 54px; height: 54px;
      border-radius: 8px;
      margin: 18px auto 6px auto;
      display: block;
      object-fit: cover;
    }
    .my_lessons_tutors_tab_add_extra_lessons_content {
      text-align: center;
      padding: 0 24px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_title {
      font-size: 1.36rem;
      font-weight: 700;
      margin: 9px 0 7px 0;
      color: #181818;
    }
    .my_lessons_tutors_tab_add_extra_lessons_desc {
      color: #393939;
      font-size: 1.01rem;
      margin-bottom: 30px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_counter_row {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 35px;
      margin: 13px 0 8px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_counter_btn {
      width: 44px; height: 44px;
      border-radius: 10px;
      border: 1.7px solid #d2d2d2;
      background: #fafafa;
      color: #232323;
      font-size: 2.2rem;
      cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: background 0.16s;
    }
    .my_lessons_tutors_tab_add_extra_lessons_counter_btn:active {
      background: #ececec;
    }
    .my_lessons_tutors_tab_add_extra_lessons_counter_number {
      font-size: 2.4rem;
      font-weight: 600;
      min-width: 44px;
      color: #232323;
      text-align: center;
      line-height: 1;
    }
    .my_lessons_tutors_tab_add_extra_lessons_counter_label {
      font-size: 1.02rem;
      color: #7d7d7d;
      margin-bottom: 10px;
      margin-top: -7px;
      letter-spacing: 0.03em;
    }
    .my_lessons_tutors_tab_add_extra_lessons_divider {
      border: none;
      border-top: 1px solid #eee;
      margin: 26px 0 18px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_total {
      font-size: 1.19rem;
      color: #181818;
      margin-bottom: 15px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_continue_btn {
      display: block;
      width: 90%;
      margin: 0 auto;
      background: #fe330a;
      color: #fff;
      font-size: 1.19rem;
      font-weight: 600;
      border: none;
      border-radius: 9px;
      padding: 13px 0;
      cursor: pointer;
      transition: background 0.18s;
      box-shadow: 0 1px 8px rgba(0,0,0,0.03);
    }
    .my_lessons_tutors_tab_add_extra_lessons_continue_btn:active {
      background: #d82700;
    }
    /* Step 2 */
    .my_lessons_tutors_tab_add_extra_lessons_step2 {
      text-align: left;
      padding: 0 28px 30px 28px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step2_title {
      font-size: 2rem;
      font-weight: 700;
      margin: 18px 0 11px 0;
      color: #181818;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step2_desc {
      color: #393939;
      font-size: 1.16rem;
      margin-bottom: 24px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step2_option {
      display: flex;
      align-items: flex-start;
      gap: 16px;
      margin-bottom: 22px;
      cursor: pointer;
      transition: background 0.13s;
      border-radius: 8px;
      padding: 10px 8px 10px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step2_option:hover,
    .my_lessons_tutors_tab_add_extra_lessons_step2_option.selected {
      background: #f9f9f9;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step2_icon {
      margin-top: 4px;
      font-size: 1.36rem;
      color: #181818;
      min-width: 28px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step2_option strong {
      font-size: 1.17rem;
      font-weight: 700;
      display: block;
      color: #181818;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step2_option small {
      font-size: 1.09rem;
      color: #777;
      display: block;
      margin-top: 1px;
    }
    /* Step 3 */
    .my_lessons_tutors_tab_add_extra_lessons_step3 {
      text-align: left;
      padding: 0 28px 30px 28px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_title {
      font-size: 1.33rem;
      font-weight: 700;
      color: #181818;
      margin: 16px 0 5px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_title .red {
      color: #fe330a;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_currentplan {
      font-size: 1rem;
      color: #232323;
      margin-bottom: 22px;
      font-weight: 500;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_optionbox {
      border: 2px solid #eee;
      background: #fafbfc;
      border-radius: 12px;
      padding: 16px 17px 13px 17px;
      margin-bottom: 13px;
      cursor: pointer;
      transition: border 0.17s, background 0.15s;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_optionbox.selected {
      border: 2px solid #232323;
      background: #fff;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_optionbox strong {
      font-weight: 700;
      font-size: 1.11rem;
      color: #181818;
      display: block;
      margin-bottom: 2px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_optionbox small {
      font-size: 1.02rem;
      color: #555;
      display: block;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_footer {
      margin-top: 10px;
      font-size: 0.99rem;
      color: #888;
      text-align: center;
      margin-bottom: 12px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_continue_btn {
      display: block;
      width: 100%;
      background: #fe330a;
      color: #fff;
      font-size: 1.15rem;
      font-weight: 600;
      border: none;
      border-radius: 9px;
      padding: 13px 0;
      cursor: pointer;
      margin-top: 10px;
      transition: background 0.18s;
      box-shadow: 0 1px 8px rgba(0,0,0,0.03);
    }
    .my_lessons_tutors_tab_add_extra_lessons_step3_continue_btn:active {
      background: #d82700;
    }
    /* Step 4: Custom Plan */
    .my_lessons_tutors_tab_add_extra_lessons_step4 {
      text-align: center;
      padding: 0 28px 30px 28px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_title {
      font-size: 1.36rem;
      font-weight: 700;
      margin: 9px 0 7px 0;
      color: #181818;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_sub {
      font-size: 1.06rem;
      margin-bottom: 24px;
      color: #484848;
      font-weight: 500;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_currentplan {
      font-size: 1rem;
      color: #232323;
      margin-bottom: 18px;
      font-weight: 500;
      text-align: left;
      margin-top: 8px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_counter_row {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 35px;
      margin: 10px 0 0 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_counter_btn {
      width: 44px; height: 44px;
      border-radius: 10px;
      border: 1.7px solid #d2d2d2;
      background: #fafafa;
      color: #232323;
      font-size: 2.2rem;
      cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      transition: background 0.16s;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_counter_btn:active {
      background: #ececec;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_counter_number {
      font-size: 2.4rem;
      font-weight: 600;
      min-width: 44px;
      color: #232323;
      text-align: center;
      line-height: 1;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_counter_label {
      font-size: 1.04rem;
      color: #7d7d7d;
      margin-bottom: 10px;
      margin-top: -7px;
      letter-spacing: 0.03em;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_divider {
      border: none;
      border-top: 1px solid #eee;
      margin: 26px 0 18px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_total {
      font-size: 1.19rem;
      color: #181818;
      margin-bottom: 15px;
      font-weight: 700;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_continue_btn {
      display: block;
      width: 100%;
      background: #fe330a;
      color: #fff;
      font-size: 1.19rem;
      font-weight: 600;
      border: none;
      border-radius: 9px;
      padding: 13px 0;
      cursor: pointer;
      margin-top: 10px;
      transition: background 0.18s;
      box-shadow: 0 1px 8px rgba(0,0,0,0.03);
    }
    .my_lessons_tutors_tab_add_extra_lessons_step4_continue_btn:active {
      background: #d82700;
    }
    /* Step 5: Review Changes */
    .my_lessons_tutors_tab_add_extra_lessons_step5 {
      padding: 0 28px 30px 28px;
      text-align: left;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_title {
      font-size: 1.36rem;
      font-weight: 700;
      color: #181818;
      margin: 16px 0 12px 0;
      text-align: left;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_plan_summary {
      font-size: 1.07rem;
      font-weight: 600;
      margin: 4px 0 0 0;
      color: #232323;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_plan_desc {
      color: #888;
      font-size: 1rem;
      margin-bottom: 2px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_arrow {
      font-size: 1.8rem;
      color: #222;
      text-align: center;
      margin: 4px 0 2px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_divider {
      border: none;
      border-top: 1px solid #eee;
      margin: 16px 0 18px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_when_label {
      font-size: 1.12rem;
      font-weight: 700;
      margin-bottom: 7px;
      margin-top: 2px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_options_group {
      display: flex;
      flex-direction: column;
      gap: 13px;
      margin-bottom: 18px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_option {
      display: flex;
      align-items: flex-start;
      border: 2px solid #ddd;
      border-radius: 12px;
      padding: 16px 14px 13px 14px;
      background: #fafbfc;
      cursor: pointer;
      transition: border 0.18s, background 0.13s;
      gap: 13px;
      position: relative;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_option.selected {
      border: 2px solid #232323;
      background: #fff;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_option_icon {
      font-size: 1.38rem;
      color: #232323;
      margin-right: 10px;
      margin-top: 3px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_option_content {
      flex: 1;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_option_title {
      font-weight: 700;
      font-size: 1.04rem;
      margin-bottom: 3px;
      color: #181818;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_option_sub {
      font-size: 0.99rem;
      color: #767676;
      display: none;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_option_radio {
      font-size: 1.28rem;
      color: #fe330a;
      margin-left: 10px;
      margin-top: 5px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_checkout_btn {
      display: block;
      width: 100%;
      background: #fe330a;
      color: #fff;
      font-size: 1.19rem;
      font-weight: 600;
      border: none;
      border-radius: 9px;
      padding: 13px 0;
      cursor: pointer;
      margin-top: 12px;
      transition: background 0.18s;
      box-shadow: 0 1px 8px rgba(0,0,0,0.03);
      text-align: center;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step5_checkout_btn:active {
      background: #d82700;
    }

    /* Step 6: Confirm Payment */
    .my_lessons_tutors_tab_add_extra_lessons_step6 {
      display: none;
      padding: 0 28px 30px 28px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_title {
      font-size: 2rem;
      font-weight: 700;
      margin: 20px 0 16px 0;
      color: #181818;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_item {
      display: flex;
      align-items: center;
      font-size: 1.13rem;
      margin-bottom: 9px;
      color: #181818;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_item .step6-badge {
      font-size: 0.97rem;
      font-weight: 700;
      background: #e5e6eb;
      color: #4d5165;
      border-radius: 8px;
      padding: 2px 10px;
      margin-left: 10px;
      margin-right: 5px;
      display: inline-block;
      vertical-align: middle;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_item_label {
      flex: 1;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_table {
      width: 100%;
      margin-bottom: 12px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_table td {
      font-size: 1.08rem;
      color: #222;
      padding: 4px 0;
      text-align: right;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_table td:first-child {
      text-align: left;
      color: #232323;
      font-weight: 400;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_table .step6-total-label {
      font-weight: bold;
      font-size: 1.18rem;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_table .step6-total {
      font-weight: bold;
      font-size: 1.22rem;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_payment {
      margin: 18px 0 8px 0;
      font-size: 1.1rem;
      font-weight: 500;
      color: #181818;
      display: flex;
      align-items: center;
      background: #fafbfc;
      border: 2px solid #e2e2e2;
      border-radius: 10px;
      padding: 12px 12px;
      gap: 10px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_payment img {
      width: 38px;
      height: 26px;
      object-fit: contain;
      margin-right: 5px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_payment .step6-down-arrow {
      margin-left: auto;
      font-size: 1.12rem;
      color: #888;
      padding-left: 10px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_confirm_btn {
      display: block;
      width: 100%;
      background: #fe330a;
      color: #fff;
      font-size: 1.23rem;
      font-weight: 600;
      border: none;
      border-radius: 9px;
      padding: 15px 0;
      cursor: pointer;
      margin-top: 18px;
      transition: background 0.18s;
      box-shadow: 0 1px 8px rgba(0,0,0,0.03);
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_confirm_btn:active {
      background: #d82700;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_policy {
      font-size: 0.95rem;
      color: #56596b;
      margin-top: 10px;
      margin-bottom: 4px;
      line-height: 1.5;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step6_policy a {
      color: #2323ff;
      text-decoration: underline;
    }
    .step6-q-icon {
      display: inline-block;
      width: 18px;
      height: 18px;
      border-radius: 100%;
      background: #e9e9e9;
      color: #555;
      font-size: 1rem;
      line-height: 19px;
      text-align: center;
      margin-left: 6px;
      cursor: pointer;
      font-weight: bold;
    }
    /* Step 7: Confirmed Change */
    .my_lessons_tutors_tab_add_extra_lessons_step7 {
      display: none;
      background: #fcebeb;
      border-radius: 0 0 16px 16px;
      animation: fadein .25s;
      min-height: 350px;
      padding: 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step7_top {
      background: #fcebeb;
      padding: 38px 42px 18px 28px;
      position: relative;
      border-radius: 16px 16px 0 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step7_close {
      position: absolute;
      right: 18px; top: 18px;
      font-size: 1.7rem;
      background: none;
      border: none;
      color: #222;
      cursor: pointer;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step7_badge {
      display: inline-block;
      width: 43px; height: 43px;
      font-size: 2rem;
      font-weight: 700;
      background: #ff3a0c;
      color: #fff;
      border: 3px solid #232323;
      border-radius: 11px;
      text-align: center;
      line-height: 40px;
      margin-bottom: 14px;
      margin-right: 10px;
      vertical-align: middle;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step7_title {
      font-size: 2.1rem;
      font-weight: 800;
      color: #222;
      margin: 0 0 0 0;
      padding-top: 18px;
      line-height: 1.17;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step7_content {
      background: #fff;
      padding: 24px 32px 40px 32px;
      border-radius: 0 0 16px 16px;
      text-align: center;
      font-size: 1.18rem;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step7_info {
      color: #222;
      font-size: 1.18rem;
      margin-bottom: 33px;
      padding-top: 7px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step7_bold {
      font-weight: 700;
      font-size: 1.18rem;
      color: #181818;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step7_btn {
      width: 100%;
      background: #fe330a;
      color: #fff;
      font-size: 1.35rem;
      font-weight: 700;
      border: 2px solid #232323;
      border-radius: 12px;
      padding: 15px 0;
      cursor: pointer;
      margin-top: 12px;
      transition: background 0.18s;
      box-shadow: 0 1px 8px rgba(0,0,0,0.03);
    }
    .my_lessons_tutors_tab_add_extra_lessons_step7_btn:active {
      background: #d82700;
    }



        /* Success Step 8 */
    .my_lessons_tutors_tab_add_extra_lessons_step8 {
      display: none;
      padding: 0 28px 36px 28px;
      text-align: center;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step8_header {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      padding: 18px 22px 0 18px;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step8_icon {
      margin: 0 auto 8px auto;
      width: 56px;
      height: 56px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step8_title {
      font-size: 2rem;
      font-weight: 700;
      color: #181818;
      margin: 15px 0 12px 0;
    }
    .my_lessons_tutors_tab_add_extra_lessons_step8_text {
      font-size: 1.16rem;
      color: #232323;
      margin-bottom: 34px;
      margin-top: 6px;
      line-height: 1.5;
    }
    .confirm_payment_2nd_tab_btn_success {
      display: block;
      width: 98%;
      background: #fe330a;
      color: #fff;
      font-size: 1.36rem;
      font-weight: 600;
      border: 2px solid #232323;
      border-radius: 10px;
      padding: 13px 0;
      cursor: pointer;
      transition: background 0.16s, color 0.16s;
      margin: 0 auto;
    }
    .confirm_payment_2nd_tab_btn_success:active {
      background: #d82700;
    }



    @media (max-width: 520px) {
      #my_lessons_tutors_tab_add_extra_lessons_modal {
        width: 98vw;
        max-width: 98vw;
        padding-bottom: 20px;
      }
      .my_lessons_tutors_tab_add_extra_lessons_content,
      .my_lessons_tutors_tab_add_extra_lessons_step2,
      .my_lessons_tutors_tab_add_extra_lessons_step3,
      .my_lessons_tutors_tab_add_extra_lessons_step4,
      .my_lessons_tutors_tab_add_extra_lessons_step5,
      .my_lessons_tutors_tab_add_extra_lessons_step6,
      .my_lessons_tutors_tab_add_extra_lessons_step7 .my_lessons_tutors_tab_add_extra_lessons_step7_content,
      .my_lessons_tutors_tab_add_extra_lessons_step8 {
        padding: 0 6vw 30px 6vw;
      }

      .my_lessons_tutors_tab_add_extra_lessons_title,
      .my_lessons_tutors_tab_add_extra_lessons_step2_title,
      .my_lessons_tutors_tab_add_extra_lessons_step3_title,
      .my_lessons_tutors_tab_add_extra_lessons_step4_title,
      .my_lessons_tutors_tab_add_extra_lessons_step5_title,
      .my_lessons_tutors_tab_add_extra_lessons_step6_title,
      .my_lessons_tutors_tab_add_extra_lessons_step7_title,
      .my_lessons_tutors_tab_add_extra_lessons_step8_title 
      {
        font-size: 1.12rem;
      }
    }
  </style>
</head>
<body>
<!-- Trigger Button (for demo/testing) -->
<button id="my_lessons_tutors_tab_add_extra_lessons_open_modal" style="margin:36px 18px;">Add Extra Lessons</button>
<div id="my_lessons_tutors_tab_add_extra_lessons_modal_backdrop"></div>
<div id="my_lessons_tutors_tab_add_extra_lessons_modal">
  <!-- Step 1: Add Extra Lessons -->
  <div class="my_lessons_tutors_tab_add_extra_lessons_step1" style="display:block;">
    <div class="my_lessons_tutors_tab_add_extra_lessons_header">
      <button class="back-arrow" title="Back" style="visibility:visible;">&#8592;</button>
      <button class="close-icon" title="Close">&times;</button>
    </div>
    <img class="my_lessons_tutors_tab_add_extra_lessons_profile_img" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Tutor Profile"/>
    <div class="my_lessons_tutors_tab_add_extra_lessons_content">
      <div class="my_lessons_tutors_tab_add_extra_lessons_title">Add Extra Lessons With Daniela</div>
      <div class="my_lessons_tutors_tab_add_extra_lessons_desc">
        Buy more lessons without changing your plan. Schedule these lessons before Jan 07.
      </div>
      <div class="my_lessons_tutors_tab_add_extra_lessons_counter_row">
        <button class="my_lessons_tutors_tab_add_extra_lessons_counter_btn" id="my_lessons_tutors_tab_add_extra_lessons_minus">-</button>
        <span class="my_lessons_tutors_tab_add_extra_lessons_counter_number" id="my_lessons_tutors_tab_add_extra_lessons_count">2</span>
        <button class="my_lessons_tutors_tab_add_extra_lessons_counter_btn" id="my_lessons_tutors_tab_add_extra_lessons_plus">+</button>
      </div>
      <div class="my_lessons_tutors_tab_add_extra_lessons_counter_label">extra lessons</div>
      <hr class="my_lessons_tutors_tab_add_extra_lessons_divider"/>
      <div class="my_lessons_tutors_tab_add_extra_lessons_total">Total: $<span id="my_lessons_tutors_tab_add_extra_lessons_total_price">10</span></div>
      <button class="my_lessons_tutors_tab_add_extra_lessons_continue_btn">Continue</button>
    </div>
  </div>
  <!-- Step 2: Upgrade Plan Instead -->
  <div class="my_lessons_tutors_tab_add_extra_lessons_step2" style="display:none;">
    <div class="my_lessons_tutors_tab_add_extra_lessons_header">
      <button class="back-arrow" title="Back">&#8592;</button>
      <button class="close-icon" title="Close">&times;</button>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step2_title">Upgrade Your Plan Instead?</div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step2_desc">
      Get a bigger plan so you don’t have to add extra lessons every cycle.
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step2_option" tabindex="0" data-step="3">
      <span class="my_lessons_tutors_tab_add_extra_lessons_step2_icon">&#10227;</span>
      <span>
        <strong>Yes Upgrade Now</strong>
        <small>Get more lessons every cycle</small>
      </span>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step2_option" tabindex="0" data-step="6">
      <span class="my_lessons_tutors_tab_add_extra_lessons_step2_icon">&#10227;</span>
      <span>
        <strong>Continue adding extra lesson</strong>
        <small>one time change will not affect next cycle</small>
      </span>
    </div>
  </div>
  <!-- Step 3: Plan Upgrade Options -->
  <div class="my_lessons_tutors_tab_add_extra_lessons_step3" style="display:none;">
    <div class="my_lessons_tutors_tab_add_extra_lessons_header">
      <button class="back-arrow" title="Back">&#8592;</button>
      <button class="close-icon" title="Close">&times;</button>
    </div>
    <img class="my_lessons_tutors_tab_add_extra_lessons_step3_profile_img" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Tutor Profile"/>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step3_title">
      Upgrade your plan to <span class="red">improve your English skills faster</span>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step3_currentplan">
      <b>Current plan:</b> 8 lessons &bull; $61.44 every 4 weeks
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step3_optionbox" tabindex="0" data-plan="12">
      <strong>12 lessons</strong>
      <small>$92 every 4 weeks</small>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step3_optionbox" tabindex="0" data-plan="16">
      <strong>16 lessons</strong>
      <small>$123 every 4 weeks</small>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step3_optionbox" tabindex="0" data-plan="custom">
      <strong>Custom plans</strong>
      <small>Choose the right number of lessons for you</small>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step3_footer">
      Prices are for our standard lesson time of 50 min
    </div>
    <button class="my_lessons_tutors_tab_add_extra_lessons_step3_continue_btn" disabled>Continue</button>
  </div>
  <!-- Step 4: Custom Plan -->
  <div class="my_lessons_tutors_tab_add_extra_lessons_step4" style="display:none;">
    <div class="my_lessons_tutors_tab_add_extra_lessons_header">
      <button class="back-arrow" title="Back">&#8592;</button>
      <button class="close-icon" title="Close">&times;</button>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step4_title">Create A Plan That Works Best For You</div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step4_currentplan">
      <b>Current plan:</b> 8 lessons &bull; $61.44 every 4 weeks
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step4_counter_row">
      <button class="my_lessons_tutors_tab_add_extra_lessons_step4_counter_btn" id="my_lessons_tutors_tab_add_extra_lessons_step4_minus">-</button>
      <span class="my_lessons_tutors_tab_add_extra_lessons_step4_counter_number" id="my_lessons_tutors_tab_add_extra_lessons_step4_count">9</span>
      <button class="my_lessons_tutors_tab_add_extra_lessons_step4_counter_btn" id="my_lessons_tutors_tab_add_extra_lessons_step4_plus">+</button>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step4_counter_label">lessons every 4 week</div>
    <hr class="my_lessons_tutors_tab_add_extra_lessons_step4_divider"/>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step4_total">
      $<span id="my_lessons_tutors_tab_add_extra_lessons_step4_total_price">72</span> every 4 weeks
    </div>
    <button class="my_lessons_tutors_tab_add_extra_lessons_step4_continue_btn">Continue</button>
  </div>
  <!-- Step 5: Review Your Changes -->
  <div class="my_lessons_tutors_tab_add_extra_lessons_step5" style="display:none;">
    <div class="my_lessons_tutors_tab_add_extra_lessons_header">
      <button class="back-arrow" title="Back">&#8592;</button>
      <button class="close-icon" title="Close">&times;</button>
    </div>
    <img class="my_lessons_tutors_tab_add_extra_lessons_step5_profile_img" src="https://randomuser.me/api/portraits/women/44.jpg" alt="Tutor Profile"/>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_title">Review Your Changes</div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_plan_summary">
      2 lessons per week
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_plan_desc">
      8 lessons &bull; $61 every 4 weeks
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_arrow">&#8595;</div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_plan_summary">
      3 lessons per week
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_plan_desc">
      12 lessons &bull; $92 every 4 weeks
    </div>
    <hr class="my_lessons_tutors_tab_add_extra_lessons_step5_divider"/>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_when_label">
      When do you want to upgrade?
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step5_options_group">
      <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option selected" data-value="now">
        <span class="my_lessons_tutors_tab_add_extra_lessons_step5_option_icon">&#128197;</span>
        <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option_content">
          <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option_title">Now</div>
          <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option_sub" id="now_detail" style="display:block;">
            Start your new plan and make a payment today. Schedule all your remaining lessons from the current plan before Apr 07.
          </div>
        </div>
        <span class="my_lessons_tutors_tab_add_extra_lessons_step5_option_radio">&#9679;</span>
      </div>
      <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option" data-value="next_billing">
        <span class="my_lessons_tutors_tab_add_extra_lessons_step5_option_icon">&#128181;</span>
        <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option_content">
          <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option_title">
            On your next billing date, Mar 18
          </div>
          <div class="my_lessons_tutors_tab_add_extra_lessons_step5_option_sub" id="next_billing_detail">
            Your total is $100 and includes a $11 processing fee.<br>
            We’ll renew your plan automatically using your saved payment method.
          </div>
        </div>
        <span class="my_lessons_tutors_tab_add_extra_lessons_step5_option_radio">&#9675;</span>
      </div>
    </div>
    <button class="my_lessons_tutors_tab_add_extra_lessons_step5_checkout_btn">Continue to checkout</button>
  </div>
  <!-- Step 6: Confirm Payment -->
  <div class="my_lessons_tutors_tab_add_extra_lessons_step6" style="display:none;">
    <div class="my_lessons_tutors_tab_add_extra_lessons_step6_header">
      <button class="back-arrow" title="Back">&#8592;</button>
      <button class="close-icon" title="Close">&times;</button>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step6_title">Confirm Payment</div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step6_item">
      <span class="my_lessons_tutors_tab_add_extra_lessons_step6_item_label">1 extra lesson</span>
      <span class="step6-badge">Expires May 3</span>
      <span style="margin-left: auto; font-weight: 500;">$4.97</span>
    </div>
    <table class="my_lessons_tutors_tab_add_extra_lessons_step6_table">
      <tr>
        <td>Taxes &amp; fees <span class="step6-q-icon" title="Includes service fee and tax.">?</span></td>
        <td>$0.65</td>
      </tr>
      <tr>
        <td class="step6-total-label">Total</td>
        <td class="step6-total">$5.61</td>
      </tr>
    </table>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step6_payment">
      <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" alt="Visa"/>
      Visa ****7583
      <span class="step6-down-arrow">&#9660;</span>
    </div>
    <button class="my_lessons_tutors_tab_add_extra_lessons_step6_confirm_btn">Confirm $5.61</button>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step6_policy">
      By pressing the "Confirm payment · $5.61" button, you agree to
      <a href="#" target="_blank">latingles’s Refund and Payment Policy</a>
    </div>
  </div>
  <!-- Step 7: Confirmed Change -->
  <div class="my_lessons_tutors_tab_add_extra_lessons_step7" style="display:none;">
    <div class="my_lessons_tutors_tab_add_extra_lessons_step7_top">
      <button class="my_lessons_tutors_tab_add_extra_lessons_step7_close" title="Close">&times;</button>
      <span class="my_lessons_tutors_tab_add_extra_lessons_step7_badge">1</span>
      <div class="my_lessons_tutors_tab_add_extra_lessons_step7_title">
        We Have Confirmed Your Change.
      </div>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step7_content">
      <div class="my_lessons_tutors_tab_add_extra_lessons_step7_info">
        starting may 01, your weekly plan will be <span class="my_lessons_tutors_tab_add_extra_lessons_step7_bold">7 lessons every 4 week</span>
      </div>
      <button class="my_lessons_tutors_tab_add_extra_lessons_step7_btn">Okay, thanks!</button>
    </div>
  </div>



    <!-- Step 8: Success / Extra Lessons Added -->
  <div class="my_lessons_tutors_tab_add_extra_lessons_step8">
    <div class="my_lessons_tutors_tab_add_extra_lessons_step8_header">
      <button class="close-icon" title="Close">&times;</button>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step8_icon">
      <!-- Success SVG badge (tick inside orange) -->
      <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
        <circle cx="28" cy="28" r="28" fill="#fff0ec"/>
        <path d="M38.48 20.53a2.07 2.07 0 0 0-2.92.06l-8.08 8.23-3.08-3.11a2.07 2.07 0 0 0-2.95 2.9l4.53 4.59a2.07 2.07 0 0 0 2.95 0l9.54-9.71a2.07 2.07 0 0 0-.09-2.96Z" fill="#fff"/>
        <circle cx="28" cy="28" r="18" fill="#fe330a"/>
        <path d="M38.48 20.53a2.07 2.07 0 0 0-2.92.06l-8.08 8.23-3.08-3.11a2.07 2.07 0 0 0-2.95 2.9l4.53 4.59a2.07 2.07 0 0 0 2.95 0l9.54-9.71a2.07 2.07 0 0 0-.09-2.96Z" fill="#fff"/>
      </svg>
    </div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step8_title">Extra Lessons Added</div>
    <div class="my_lessons_tutors_tab_add_extra_lessons_step8_text">
      Congratulations! You have successfully added new lessons to your account. Enjoy your learning journey!
    </div>
    <button class="confirm_payment_2nd_tab_btn_success" id="confirm_payment_2nd_tab_btn_success">Schedule lessons</button>
  </div>







</div>

<script>
$(function(){
  // Your step logic...
  var pricePerLesson = 5;
  var minLessons = 1;
  var maxLessons = 10;
  var lessonCount = 2;
  var customPlanMin = 1;
  var customPlanMax = 30;
  var customPlanLessonCount = 9;
  var customPlanPricePerLesson = 8;
  function updateModal() {
    $('#my_lessons_tutors_tab_add_extra_lessons_count').text(lessonCount);
    $('#my_lessons_tutors_tab_add_extra_lessons_total_price').text(lessonCount * pricePerLesson);
    $('#my_lessons_tutors_tab_add_extra_lessons_minus').prop('disabled', lessonCount <= minLessons);
    $('#my_lessons_tutors_tab_add_extra_lessons_plus').prop('disabled', lessonCount >= maxLessons);
  }
  function updateCustomPlan() {
    $('#my_lessons_tutors_tab_add_extra_lessons_step4_count').text(customPlanLessonCount);
    $('#my_lessons_tutors_tab_add_extra_lessons_step4_total_price').text(customPlanLessonCount * customPlanPricePerLesson);
    $('#my_lessons_tutors_tab_add_extra_lessons_step4_minus').prop('disabled', customPlanLessonCount <= customPlanMin);
    $('#my_lessons_tutors_tab_add_extra_lessons_step4_plus').prop('disabled', customPlanLessonCount >= customPlanMax);
  }
  function showStep(stepNum) {
    $('.my_lessons_tutors_tab_add_extra_lessons_step1, .my_lessons_tutors_tab_add_extra_lessons_step2, .my_lessons_tutors_tab_add_extra_lessons_step3, .my_lessons_tutors_tab_add_extra_lessons_step4, .my_lessons_tutors_tab_add_extra_lessons_step5, .my_lessons_tutors_tab_add_extra_lessons_step6, .my_lessons_tutors_tab_add_extra_lessons_step7, .my_lessons_tutors_tab_add_extra_lessons_step8').hide();
    if(stepNum == 1) $('.my_lessons_tutors_tab_add_extra_lessons_step1').fadeIn(120);
    if(stepNum == 2) $('.my_lessons_tutors_tab_add_extra_lessons_step2').fadeIn(120);
    if(stepNum == 3) $('.my_lessons_tutors_tab_add_extra_lessons_step3').fadeIn(120);
    if(stepNum == 4) $('.my_lessons_tutors_tab_add_extra_lessons_step4').fadeIn(120);
    if(stepNum == 5) $('.my_lessons_tutors_tab_add_extra_lessons_step5').fadeIn(120);
    if(stepNum == 6) $('.my_lessons_tutors_tab_add_extra_lessons_step6').fadeIn(120);
    if(stepNum == 7) $('.my_lessons_tutors_tab_add_extra_lessons_step7').fadeIn(120);
    if(stepNum == 8) $('.my_lessons_tutors_tab_add_extra_lessons_step8').fadeIn(120);
  }

  $('#my_lessons_tutors_tab_add_extra_lessons_open_modal').on('click', function(){
    $('#my_lessons_tutors_tab_add_extra_lessons_modal_backdrop').fadeIn(140);
    $('#my_lessons_tutors_tab_add_extra_lessons_modal').fadeIn(180);
    showStep(1);
    updateModal();
    $('.my_lessons_tutors_tab_add_extra_lessons_step3_optionbox').removeClass('selected');
    $('.my_lessons_tutors_tab_add_extra_lessons_step3_continue_btn').prop('disabled', true);
    customPlanLessonCount = 9;
    updateCustomPlan();
    $('.my_lessons_tutors_tab_add_extra_lessons_step5_option').removeClass('selected');
    $('.my_lessons_tutors_tab_add_extra_lessons_step5_option[data-value="now"]').addClass('selected');
    updateStep5Radios();
  });
  function closeModal() {
    $('#my_lessons_tutors_tab_add_extra_lessons_modal').fadeOut(120);
    $('#my_lessons_tutors_tab_add_extra_lessons_modal_backdrop').fadeOut(100);
  }
  $('.my_lessons_tutors_tab_add_extra_lessons_header .close-icon, .my_lessons_tutors_tab_add_extra_lessons_step6_header .close-icon, .my_lessons_tutors_tab_add_extra_lessons_step7_close, .my_lessons_tutors_tab_add_extra_lessons_step8 .close-icon').on('click', closeModal);
  $('#my_lessons_tutors_tab_add_extra_lessons_modal_backdrop').on('click', closeModal);
  $('.my_lessons_tutors_tab_add_extra_lessons_step1 .back-arrow').on('click', closeModal);
  $('.my_lessons_tutors_tab_add_extra_lessons_step2 .back-arrow').on('click', function(){ showStep(1); });
  $('.my_lessons_tutors_tab_add_extra_lessons_step3 .back-arrow').on('click', function(){ showStep(2); });
  $('.my_lessons_tutors_tab_add_extra_lessons_step4 .back-arrow').on('click', function(){ showStep(3); });
  $('.my_lessons_tutors_tab_add_extra_lessons_step5 .back-arrow').on('click', function(){ showStep(3); });
  $('.my_lessons_tutors_tab_add_extra_lessons_step6 .back-arrow').on('click', function(){ showStep(2); });

  $('#my_lessons_tutors_tab_add_extra_lessons_plus').on('click', function(){
    if(lessonCount < maxLessons) {
      lessonCount++;
      updateModal();
    }
  });
  $('#my_lessons_tutors_tab_add_extra_lessons_minus').on('click', function(){
    if(lessonCount > minLessons) {
      lessonCount--;
      updateModal();
    }
  });
  $('.my_lessons_tutors_tab_add_extra_lessons_continue_btn').on('click', function(){ showStep(2); });
  $('.my_lessons_tutors_tab_add_extra_lessons_step2_option').on('click', function(){
    var goToStep = $(this).attr('data-step');
    showStep(Number(goToStep));
    if(goToStep == "3") {
      $('.my_lessons_tutors_tab_add_extra_lessons_step3_optionbox').removeClass('selected');
      $('.my_lessons_tutors_tab_add_extra_lessons_step3_continue_btn').prop('disabled', true);
    }
  });
  $('.my_lessons_tutors_tab_add_extra_lessons_step3_optionbox').on('click', function(){
    $('.my_lessons_tutors_tab_add_extra_lessons_step3_optionbox').removeClass('selected');
    $(this).addClass('selected');
    $('.my_lessons_tutors_tab_add_extra_lessons_step3_continue_btn').prop('disabled', false);
  });
  $('.my_lessons_tutors_tab_add_extra_lessons_step3_continue_btn').on('click', function(){
    var selectedPlan = $('.my_lessons_tutors_tab_add_extra_lessons_step3_optionbox.selected').attr('data-plan');
    if(selectedPlan === 'custom') {
      showStep(4);
    } else {
      showStep(5);
    }
  });
  $('#my_lessons_tutors_tab_add_extra_lessons_step4_plus').on('click', function(){
    if(customPlanLessonCount < customPlanMax) {
      customPlanLessonCount++;
      updateCustomPlan();
    }
  });
  $('#my_lessons_tutors_tab_add_extra_lessons_step4_minus').on('click', function(){
    if(customPlanLessonCount > customPlanMin) {
      customPlanLessonCount--;
      updateCustomPlan();
    }
  });
  $('.my_lessons_tutors_tab_add_extra_lessons_step4_continue_btn').on('click', function(){ showStep(5); });
  function updateStep5Radios() {
    $('.my_lessons_tutors_tab_add_extra_lessons_step5_option').each(function(){
      var radio = $(this).find('.my_lessons_tutors_tab_add_extra_lessons_step5_option_radio');
      if($(this).hasClass('selected')) {
        radio.html('&#9679;');
      } else {
        radio.html('&#9675;');
      }
    });
    if ($('.my_lessons_tutors_tab_add_extra_lessons_step5_option[data-value="now"]').hasClass('selected')) {
      $('#now_detail').show();
      $('#next_billing_detail').hide();
      $('.my_lessons_tutors_tab_add_extra_lessons_step5_checkout_btn').text('Continue to checkout');
    } else {
      $('#now_detail').hide();
      $('#next_billing_detail').show();
      $('.my_lessons_tutors_tab_add_extra_lessons_step5_checkout_btn').text('Confirm');
    }
  }
  $('.my_lessons_tutors_tab_add_extra_lessons_step5_option').on('click', function(){
    $('.my_lessons_tutors_tab_add_extra_lessons_step5_option').removeClass('selected');
    $(this).addClass('selected');
    updateStep5Radios();
  });
  $('.my_lessons_tutors_tab_add_extra_lessons_step5_checkout_btn').on('click', function(){
    var selectedOption = $('.my_lessons_tutors_tab_add_extra_lessons_step5_option.selected').attr('data-value');
    if(selectedOption === 'next_billing') {
      showStep(7);
    } else {
      alert('Proceeding to checkout. Upgrade timing: ' + (selectedOption === 'now' ? 'Now' : 'Next Billing Date'));
      closeModal();
    }
  });
  // Show success step 8 on step 6 confirm payment
  $('.my_lessons_tutors_tab_add_extra_lessons_step6_confirm_btn').on('click', function(){
    showStep(8);
  });
  // Close success (schedule lessons) button
  $('#confirm_payment_2nd_tab_btn_success').on('click', closeModal);
  $('.my_lessons_tutors_tab_add_extra_lessons_step7_btn').on('click', closeModal);

  // Initial state
  updateModal();
  updateCustomPlan();
  updateStep5Radios();
});
</script>



</body>
</html>
