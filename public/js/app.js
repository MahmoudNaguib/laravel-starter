(()=>{var a,t={80:()=>{$((function(){"use strict";$("form").submit((function(){$(this).find("button").prop("disabled",!0)})),$(".select2").select2({placeholder:"Select"}),$(".datepicker").datepicker({dateFormat:"yy-mm-dd",changeMonth:!0,changeYear:!0,yearRange:"c-90:c+10"}),$("a[data-confirm]").on("click",(function(){var a=$(this).attr("href");return $("#dataConfirmModal").length||$("body").append('<div class="modal fade" id="dataConfirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">\n  <div class="modal-dialog modal-dialog-centered modal-sm">\n    <div class="modal-content">\n      <div class="d-flex justify-content-center mt-2">\n        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>\n      </div>\n      <div class="modal-body">\n        <div class="content d-flex justify-content-center"></div>        <div class="buttons d-flex justify-content-center mt-3">           <a class="btn btn-lg btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i></a>&nbsp; &nbsp; &nbsp; &nbsp;           <a class="btn btn-lg btn-success" id="dataConfirmOK"><i class="fa fa-check"></i></a></div>      </div>\n    </div>\n  </div>\n</div>'),$("#dataConfirmModal").find(".modal-body .content").html($(this).attr("data-confirm")),$("#dataConfirmOK").attr("href",a),new bootstrap.Modal(document.getElementById("dataConfirmModal"),{keyboard:!1}).show(),!1})),$(".tags").tagsinput()})),$(document).ready((function(){$(window).scroll((function(){$(this).scrollTop()>50?$(".navbar").addClass("nav-fixed"):$(".navbar").removeClass("nav-fixed")}))}))},425:()=>{}},n={};function e(a){var d=n[a];if(void 0!==d)return d.exports;var o=n[a]={exports:{}};return t[a](o,o.exports,e),o.exports}e.m=t,a=[],e.O=(t,n,d,o)=>{if(!n){var i=1/0;for(c=0;c<a.length;c++){for(var[n,d,o]=a[c],s=!0,r=0;r<n.length;r++)(!1&o||i>=o)&&Object.keys(e.O).every((a=>e.O[a](n[r])))?n.splice(r--,1):(s=!1,o<i&&(i=o));if(s){a.splice(c--,1);var l=d();void 0!==l&&(t=l)}}return t}o=o||0;for(var c=a.length;c>0&&a[c-1][2]>o;c--)a[c]=a[c-1];a[c]=[n,d,o]},e.o=(a,t)=>Object.prototype.hasOwnProperty.call(a,t),(()=>{var a={773:0,170:0};e.O.j=t=>0===a[t];var t=(t,n)=>{var d,o,[i,s,r]=n,l=0;if(i.some((t=>0!==a[t]))){for(d in s)e.o(s,d)&&(e.m[d]=s[d]);if(r)var c=r(e)}for(t&&t(n);l<i.length;l++)o=i[l],e.o(a,o)&&a[o]&&a[o][0](),a[o]=0;return e.O(c)},n=self.webpackChunk=self.webpackChunk||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))})(),e.O(void 0,[170],(()=>e(80)));var d=e.O(void 0,[170],(()=>e(425)));d=e.O(d)})();