<style type="text/css">
.wpmchimpa-overlay-bg {
background: rgba(0,0,0,{{data.theme.l1.lite_bg_op/100 ||'0.4'}});
}

.wpmchimpa-overlay-bg #wpmchimpa-main {
min-width: 700px;
max-width: 850px;
min-height: 350px;
background: {{data.theme.l1.lite_bg_col || '#fff'}};
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
display: inline-block;
position: relative;
margin: 135px auto;
left: 50%;
-webkit-transform: translatex(-50% );
-moz-transform: translatex(-50% );
-ms-transform: translatex(-50% );
-o-transform: translatex(-50% );
transform: translatex(-50% );
}
#wpmchimpa-main .wpmchimpa-leftpane{
width:250px;
float: left;
}
#wpmchimpa-main #wpmchimpa-newsletterform{
display: block;
padding: 0 50px 0 250px;
}
#wpmchimpa-main .wpmchimpa{
position: relative;
display: inline-block;
}
#wpmchimpa .lite_heading{
line-height: 34px;
margin: 40px 0 20px;
color: {{data.theme.l1.lite_heading_fc||'#454545'}};
font-size: {{data.theme.l1.lite_heading_fs||'34'}}px;
font-weight: {{data.theme.l1.lite_heading_fw||'bold'}};
font-family: {{data.theme.l1.lite_heading_f | livepf}};
font-style: {{data.theme.l1.lite_heading_fst}};
}
#wpmchimpa .lite_msg{
display:block;
width:450px;
font-size: {{data.theme.l1.lite_msg_fs}}px;
font-family: {{data.theme.l1.lite_msg_f | livepf}};
}
#wpmchimpa .lite_tbox{
margin: 10px 0;
padding-left: 20px;
   -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    -ms-border-radius: 5px;
    -o-border-radius: 5px;
    border-radius: 5px;
outline:0;
display: block;
color: {{data.theme.l1.lite_tbox_fc||'#b3b3b3'}};
font-size: {{data.theme.l1.lite_tbox_fs||'16'}}px;
font-weight: {{data.theme.l1.lite_tbox_fw||'bold'}};
font-family:Arial;
font-family: {{data.theme.l1.lite_tbox_f | livepf}};
font-style: {{data.theme.l1.lite_tbox_fst}};
background-color: {{data.theme.l1.lite_tbox_bgc||'#f8fafa'}};
width: {{data.theme.l1.lite_tbox_w||'420'}}px;
height: {{data.theme.l1.lite_tbox_h||'55'}}px;
border: {{data.theme.l1.lite_tbox_bor||'1'}}px solid {{data.theme.l1.lite_tbox_borc||'#e4e9e9'}};

}
#wpmchimpa .lite_tbox div{
top: 50%;
-webkit-transform: translatey(-50% );
-moz-transform: translatey(-50% );
-ms-transform: translatey(-50% );
-o-transform: translatey(-50% );
transform: translatey(-50% );
position: relative;
}
#wpmchimpa .wpmchimpa-groups{
display: block;
}
#wpmchimpa .wpmchimpa-item{
display:inline-block;
margin: 2px 15px;
}
#wpmchimpa .lite_check {
cursor: pointer;
display: inline-block;
position: relative;
padding-left: 30px;
line-height: 25px;
min-width: 100px;
}
#wpmchimpa .lite_check .cbox{
display: inline-block;
width: 22px;
height: 22px;
left: 0;
bottom: 0;
text-align: center;
position: absolute;
-webkit-box-shadow: 0 0 1px 1px {{data.theme.l1.lite_check_borc||'#ccc'}};
-moz-box-shadow: 0 0 1px 1px {{data.theme.l1.lite_check_borc||'#ccc'}};
-ms-box-shadow: 0 0 1px 1px {{data.theme.l1.lite_check_borc||'#ccc'}};
-o-box-shadow: 0 0 1px 1px {{data.theme.l1.lite_check_borc||'#ccc'}};
box-shadow: 0 0 1px 1px {{data.theme.l1.lite_check_borc||'#ccc'}};
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
border-radius: 3px;
-ms-transition: all 0.3s ease-in-out;
-moz-transition: all 0.3s ease-in-out;
-o-transition: all 0.3s ease-in-out;
-webkit-transition: all 0.3s ease-in-out;
transition: all 0.3s ease-in-out;
}
#wpmchimpa .lite_check .ctext{
color: {{data.theme.l1.lite_check_fc}};
font-size: {{data.theme.l1.lite_check_fs}}px;
font-weight: {{data.theme.l1.lite_check_fw}};
font-family: {{data.theme.l1.lite_check_f | livepf}};
font-style: {{data.theme.l1.lite_check_fst}};
}
#wpmchimpa .lite_check .cbox.checked{
background-color: {{data.theme.l1.lite_check_c}};
}
#wpmchimpa .lite_check .cbox.checked:after,#wpmchimpa .lite_check:hover .cbox:after{
content:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAYAAACpF6WWAAAAtklEQVQ4y2P4//8/A7Ux1Q0cxoaCADIbCUgCMTvVXAoE5kA8CYidyXYpGrAH4iVAHIXiCwoMDQTimUBcBsRMlBrKCsTpUANzkC0j11BuIK6EGlgKsoAkQ4FgChD7AzELVI8YEDdDDawDYk6YQaQY6gg1oAqILYC4D8oHGcyLbBAphoJAKtQgGO4EYiHk2CLHUJAXm6AG9gCxNHoSIMdQEJCFGqiALaGSayjMxQwUGzq0S6nhZygA2ojsbh6J67kAAAAASUVORK5CYII=);
content: {{data.theme.l1.lite_check_shade | chshade}};
margin-top: 1px;
display: block;
}
#wpmchimpa .lite_check:hover .cbox:after{
opacity: 0.5;
}

#wpmchimpa .lite_button{
border-radius: 3px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
-ms-border-radius: 3px;
-o-border-radius: 3px;
color: #fff;
line-height: 45px;
text-align: center;
cursor: pointer;
margin-top: 15px;
text-align: center;
color: {{data.theme.l1.lite_button_fc||'#fff'}};
font-size: {{data.theme.l1.lite_button_fs || "28"}}px;
font-weight: {{data.theme.l1.lite_button_fw||'bold'}};
font-family: {{data.theme.l1.lite_button_f | livepf}};
font-style: {{data.theme.l1.lite_button_fst}};
{{data.theme.l1.lite_button_bc? "background-color:"+data.theme.l1.lite_button_bc+";" : "background-color: #4d90fe;
background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
background-image: -moz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -mz-linear-gradient(top,#4d90fe,#4787ed);
background-image: -o-linear-gradient(top,#4d90fe,#4787ed);
background-image: linear-gradient(top,#4d90fe,#4787ed);"}}
width: {{data.theme.l1.lite_button_w||'440'}}px;
height: {{data.theme.l1.lite_button_h||'45'}}px;
border: {{data.theme.l1.lite_button_bor||'1'}}px solid {{data.theme.l1.lite_button_borc||'#3079ed'}};
}
#wpmchimpa .lite_button:hover{
color: {{data.theme.l1.lite_button_fch}};
background-color: {{data.theme.l1.lite_button_bch}};
}
#wpmchimpa-main .wpmchimpa-close-button{
position: absolute;
display: block;
top: 0;
right: 0;
margin: 10px 20px;
cursor: pointer;
}
#wpmchimpa-main .wpmchimpa-close-button::before{
content: "\00D7";
font-size: 30px;
font-weight: 600;
color: {{data.theme.l1.lite_close_col||'#000'}};
opacity: 0.4;
}
#wpmchimpa-main .wpmchimpa-close-button:hover:before{
opacity: 1;
}


.lite_spinner {
height: 40px;
width: 40px;
display: inline-block;
margin: 15px 0;
left: -webkit-calc(50% - 20px);
left: -moz-calc(50% - 20px);
left: -o-calc(50% - 20px);
left: calc(50% - 20px);
position: relative;
border: 2px solid {{data.theme.l1.lite_spinner_c||'#000'}};
-webkit-border-radius: 50%; 
-moz-border-radius: 50%; 
-ms-border-radius: 50%; 
-o-border-radius: 50%; 
border-radius: 50%; 
}

.lite_status{
position: relative;
font-size: 18px;
margin-bottom: 15px;
}

#wpmchimpa-main .wpmchimpa-imgcont{
-webkit-border-radius: 50%;
-moz-box-border-radius: 50%;
-ms-border-radius: 50%;
-o-border-radius: 50%;
border-radius: 50%;
background: {{data.theme.l1.lite_head_col || '#3079ed'}};
height: 230px;
width: 230px;
margin: -50px 0px 0 -50px;
border: 20px solid {{data.theme.l1.lite_bg_c || '#fff'}};
-webkit-box-shadow: 0 3px 15px 2px {{data.theme.l1.lite_hshad_col || '#979797'}};
-moz-box-shadow: 0 3px 15px 2px {{data.theme.l1.lite_hshad_col || '#979797'}};
-ms-box-shadow: 0 3px 15px 2px {{data.theme.l1.lite_hshad_col || '#979797'}};
-o-box-shadow: 0 3px 15px 2px {{data.theme.l1.lite_hshad_col || '#979797'}};
box-shadow: 0 3px 15px 2px {{data.theme.l1.lite_hshad_col || '#979797'}};
display: block;
}
#wpmchimpa-main .wpmchimpa-imgcont::before{
content: "";
background: {{data.theme.l1.lite_head_col || '#4d90fe'}};
background-image: url({{data.theme.l1.lite_img1||'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHdpZHRoPSIxMjBweCIgaGVpZ2h0PSIxMjBweCIgdmlld0JveD0iMCAwIDEyMCAxMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDEyMCAxMjAiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxnPjxwYXRoIG9wYWNpdHk9IjAuMiIgZmlsbD0iIzAyMDIwMiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAgICAiIGQ9Ik0xMTkuNiw5Mi45YzAsNC40LTMuNiw3LjktOCw3LjloLTEwMWMtNC40LDAtOC0zLjUtOC03LjlWMjQuMmMwLTQuNCwzLjYtNy45LDgtNy45aDEwMWM0LjQsMCw4LDMuNSw4LDcuOVY5Mi45eiIvPjxwYXRoIGZpbGw9IiNDNjMyM0QiIGQ9Ik0xLjgsMjljLTAuMywwLjgtMC40LDEuOC0wLjQsMi43djU4LjljMCw1LjEsNC4xLDkuMiw5LjIsOS4yaDk5YzUuMSwwLDkuMi00LjEsOS4yLTkuMlYzMS43YzAtMC45LTAuMi0xLjgtMC40LTIuN0gxLjh6Ii8+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF8xXyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSIyNDIuMTYxNCIgeTE9Ii0yOTcuMDQyIiB4Mj0iMzU1LjE3MzgiIHkyPSItMjk3LjA0MiIgZ3JhZGllbnRUcmFuc2Zvcm09Im1hdHJpeCgxIDAgMCAtMSAtMjM3LjYgLTIzOC44NCkiPjxzdG9wICBvZmZzZXQ9IjAiIHN0eWxlPSJzdG9wLWNvbG9yOiNGRkZGRkY7c3RvcC1vcGFjaXR5OjAiLz48c3RvcCAgb2Zmc2V0PSIwLjE0MzQiIHN0eWxlPSJzdG9wLWNvbG9yOiNENEQ0RDQ7c3RvcC1vcGFjaXR5OjAuMTI5MSIvPjxzdG9wICBvZmZzZXQ9IjAuNDYiIHN0eWxlPSJzdG9wLWNvbG9yOiM3QTdBN0E7c3RvcC1vcGFjaXR5OjAuNDE0Ii8+PHN0b3AgIG9mZnNldD0iMC43MTgiIHN0eWxlPSJzdG9wLWNvbG9yOiMzODM4Mzg7c3RvcC1vcGFjaXR5OjAuNjQ2MiIvPjxzdG9wICBvZmZzZXQ9IjAuOTA0MiIgc3R5bGU9InN0b3AtY29sb3I6IzEwMTAxMDtzdG9wLW9wYWNpdHk6MC44MTM4Ii8+PHN0b3AgIG9mZnNldD0iMSIgc3R5bGU9InN0b3AtY29sb3I6IzAwMDAwMDtzdG9wLW9wYWNpdHk6MC45Ii8+PC9saW5lYXJHcmFkaWVudD48cGF0aCBvcGFjaXR5PSI2LjAwMDAwMGUtMDAyIiBmaWxsPSJ1cmwoI1NWR0lEXzFfKSIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAgICAiIGQ9Ik0xMTIuNiw5NC40TDkuNCwyMy40Yy0xLjktMS4zLTMuMy0yLjktNC4yLTQuOGMtMC40LDEuMS0wLjcsMi4zLTAuNywzLjV2NjYuNWMwLDUuMSw0LjEsOS4yLDkuMiw5LjJoOTljMS44LDAsMy40LTAuNSw0LjgtMS40QzExNS45LDk2LjEsMTE0LjEsOTUuNSwxMTIuNiw5NC40eiIvPjxwYXRoIGZpbGw9IiNENkQ2RDYiIGQ9Ik0xMC44LDk2LjNsMTAzLjItNzFjMS45LTEuMywzLjMtMi45LDQuMi00LjhjMC40LDEuMSwwLjcsMi4zLDAuNywzLjV2NjYuNWMwLDUuMS00LjEsOS4yLTkuMiw5LjJoLTk5Yy0xLjgsMC0zLjQtMC41LTQuOC0xLjRDNy41LDk4LjEsOS4zLDk3LjMsMTAuOCw5Ni4zeiIvPjxwYXRoIGZpbGw9IiNFRkVGRUYiIGQ9Ik0xMDguOSw5Ni43TDUuNywyNS43Yy0xLjktMS4zLTMuMy0yLjktNC4yLTQuOGMtMC40LDEuMS0wLjcsMi4zLTAuNywzLjV2NjYuNWMwLDUuMSw0LjEsOS4yLDkuMiw5LjJoOTljMS44LDAsMy40LTAuNSw0LjgtMS40QzExMi4xLDk4LjUsMTEwLjQsOTcuNywxMDguOSw5Ni43eiIvPjxwYXRoIG9wYWNpdHk9IjAuOCIgZmlsbD0iI0U1RTVFNSIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAgICAiIGQ9Ik0xMDguOSw5Ni43TDU5LjYsNjIuN0wxMC4zLDk2LjdjLTEuNSwxLjEtMy4zLDEuOC00LjksMi4xYzEuNCwwLjgsMywxLjQsNC44LDEuNGg0My43aDU1LjJjMS44LDAsMy40LTAuNSw0LjgtMS40QzExMi4xLDk4LjUsMTEwLjQsOTcuNywxMDguOSw5Ni43eiIvPjxwYXRoIG9wYWNpdHk9IjAuMSIgZmlsbD0iIzAyMDIwMiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAgICAiIGQ9Ik0xMTguNywyNS4zYzAtMC42LTAuMS0xLjEtMC4yLTEuNmMwLjMtMC4xLDAuNy0wLjIsMS0wLjNjLTAuNC0wLjItMC44LTAuNC0xLjItMC43Yy0xLjEtMy44LTQuNi02LjUtOC43LTYuNUgxMS4yYy00LjMsMC03LjksMi45LTguOCw2LjljLTAuMiwwLjEtMC40LDAuMi0wLjYsMC4zYzAuMiwwLjEsMC4zLDAuMSwwLjQsMC4xYy0wLjEsMC42LTAuMiwxLjItMC4yLDEuN2MwLDAsMC4yLTAuNCwwLjctMS41YzAuOSwxLjgsMi4zLDMuNCw0LjEsNC42bDUzLjUsMzYuNGw1My41LTM2LjNjMS44LTEuMiwzLjItMi45LDQuMS00LjZoMC4xQzExOC41LDI0LjksMTE4LjcsMjUuMywxMTguNywyNS4zeiIvPjxwYXRoIGZpbGw9IiNFOEU4RTgiIGQ9Ik0xMDkuNiwxNC42SDEwLjNjLTUuMSwwLTkuMiw0LjEtOS4yLDkuMmMwLDAsMC4yLTAuNCwwLjctMS41QzIuNywyNC4xLDQuMSwyNS43LDYsMjdsNTMuOSwzNy4ybDU0LTM3LjFjMS45LTEuMywzLjMtMi45LDQuMi00LjhjMC40LDEuMSwwLjcsMS41LDAuNywxLjVDMTE4LjcsMTguOCwxMTQuNiwxNC42LDEwOS42LDE0LjZ6Ii8+PC9nPjwvc3ZnPg=='}});
background-repeat: no-repeat;
background-position: center; 
border: 15px solid {{data.theme.l1.lite_bg_col || '#fff'}};
height: 170px;
width: 170px;
display: block;
-webkit-border-radius: 50%;
-moz-box-border-radius: 50%;
-ms-border-radius: 50%;
-o-border-radius: 50%;
border-radius: 50%;
top: 15px;
left: 15px;
position: relative;
}

#wpmchimpa-main .wpmchimpa-social{
display: block;
text-align: center;
padding: 100px 50px;
}
#wpmchimpa-main .wpmchimpa-social::before{
content:"{{data.theme.l1.lite_soc_head||'Subscribe with'}}";
line-height: 30px;
display: block;
color: {{data.theme.l1.lite_soc_fc||'#b3b3b3'}};
font-size: {{data.theme.l1.lite_soc_fs||'20'}}px;
font-weight: {{data.theme.l1.lite_soc_fw}};
font-family: {{(data.theme.l1.lite_soc_f | livepf)}};
font-style: {{data.theme.l1.lite_soc_fst}};
}

#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc{
width:40px;
height: 40px;
-webkit-border-radius: 50%;
-moz-box-border-radius: 50%;
-ms-border-radius: 50%;
-o-border-radius: 50%;
border-radius: 50%;
float: left;
margin: 5px;
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc::before{
display: block;
margin: 7px;
}

#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb {
background: #2d609b;
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb::before {
content: <?php echo $this->plugin->getIcon('fb',25,'#fff');?>
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp {
background: #eb4026;
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp::before {
content: <?php echo $this->plugin->getIcon('gp',25,'#fff');?>
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms {
background: #00BCF2;
}
#wpmchimpa-main .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms::before {
content: <?php echo $this->plugin->getIcon('ms',25,'#fff');?>
}


#wpmchimpa-main.woleft{
min-width: inherit;
max-width:500px;
padding-right: 45px;
}
#wpmchimpa-main.woleft .wpmchimpa-leftpane{
display: none;
}
#wpmchimpa-main.woleft #wpmchimpa-newsletterform{
padding-left: 50px;
}

#wpmchimpa-main.limgonly .wpmchimpa-social{
display: none;
}
#wpmchimpa-main.lsoconly .wpmchimpa-imgcont{
display: none;
}
#wpmchimpa-main.lsoconly .wpmchimpa-social{
padding: 150px 50px;
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc {
width:140px;
height: 35px;
margin-bottom: 5px;
border-radius: 5px;
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc::before{
padding: 0px 5px;
display: inline-block;
border-right: 1px solid #cccccc;
height: 23px;
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc::after{
position: absolute;
line-height: 35px;
padding-left: 10px;
color: #fff;
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-fb::after {
content:"Facebook";
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-gp::after {
content:"Google Plus";
}
#wpmchimpa-main.lsoconly .wpmchimpa-social .wpmchimpa-soc.wpmchimpa-ms::after {
content:"Outlook";
}
#wpmchimpa .wpmchimpa-tag{
display: {{data.theme.l1.lite_tag_en? 'block':'none'}};
}
#wpmchimpa .wpmchimpa-tag,
#wpmchimpa .wpmchimpa-tag *{
pointer-events: none;
text-align: center;
color: {{data.theme.l1.lite_tag_fc||'#000'}};
font-size: {{data.theme.l1.lite_tag_fs||'10'}}px;
font-weight: {{data.theme.l1.lite_tag_fw||'500'}};
font-family:Arial;
font-family: {{data.theme.l1.lite_tag_f | livepf}};
font-style: {{data.theme.l1.lite_tag_fst}};
}
#wpmchimpa .wpmchimpa-tag:before{
content:{{getIcon('lock1',data.theme.l1.lite_tag_fs||10,data.theme.l1.lite_tag_fc||'#000')}};
margin: 5px;
top: 1px;
position: relative;
}
</style>

<div class="wpmchimpa-overlay-bg overcss" id="lightbox1">
	<div id="wpmchimpa-main" ng-class="{'lsoconly':data.theme.l1.lite_dislogo,'limgonly':data.theme.l1.lite_dissoc,'woleft':data.theme.l1.lite_dislogo&&data.theme.l1.lite_dissoc}">
        <div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="7" data-lhint="Go to Additional Theme Options" style="margin:25px;bottom:0">6</div>
        <div class="wpmchimpa-leftpane">
            <div class="wpmchimpa-imgcont"></div>
            <div class="wpmchimpa-social">
                <div class="wpmchimpa-soc wpmchimpa-fb"></div>
                <div class="wpmchimpa-soc wpmchimpa-gp"></div>
                <div class="wpmchimpa-soc wpmchimpa-ms"></div>
            </div>
        </div>
		<div id="wpmchimpa-newsletterform">
			<div class="wpmchimpa" id="wpmchimpa">
    			<div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="1" data-lhint="Go to Custom Message Settings">1</div>
            <div class="lite_heading">{{data.theme.l1.lite_heading}}</div>
      			<div class="lite_msg"><p ng-bind-html="data.theme.l1.lite_msg | safe"></p></div>
          </div>
          <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="2" data-lhint="Go to Text Box Settings" style="right: -20px;">2</div>
            <div class="lite_tbox"><div class="in-name">Name</div></div>
      			<div class="lite_tbox"><div class="in-mail">Email address</div></div>
          </div>
          <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="3" data-lhint="Go to Checkbox Settings">3</div>
         		<div class="wpmchimpa-groups">
              <div class="lite_check_c"></div>
              <div class="wpmchimpa-item">
                  <div class="lite_check">
                    <div class="cbox"></div>
                    <div class="ctext">group1</div>
                  </div>
              </div>
              <div class="wpmchimpa-item">
                  <div class="lite_check">
                    <div class="cbox checked"></div>
                    <div class="ctext">group2</div>
                  </div>
              </div>
            </div>
          </div>
          <div><div class="wpmc-live-sc righthov" ng-click="gotos($event)" data-optno="4" data-lhint="Go to Button Settings" style="right: -20px;">4</div>
        		<div class="lite_button">{{data.theme.l1.lite_button}}</div>
          </div>
          <div><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="7" data-lhint="Go to Tag Settings">6</div>
	    		<div class="wpmchimpa-tag" ng-bind-html="data.theme.l1.lite_tag||'Secure and Spam free...' | safe"></div></div>
          <div>
          	<div class="lite_spinner"><div class="wpmc-live-sc" ng-click="gotos($event)" data-optno="5" data-lhint="Go to Spinner Settings" style="margin:25%">5</div></div>
          </div>
    			
          </div>
			</div>
      <div class="wpmchimpa-close-button"></div>
		</div>        
	</div>
</div>
