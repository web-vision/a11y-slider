(function(){const t=document.createElement("link").relList;if(t&&t.supports&&t.supports("modulepreload"))return;for(const r of document.querySelectorAll('link[rel="modulepreload"]'))s(r);new MutationObserver(r=>{for(const l of r)if(l.type==="childList")for(const c of l.addedNodes)c.tagName==="LINK"&&c.rel==="modulepreload"&&s(c)}).observe(document,{childList:!0,subtree:!0});function o(r){const l={};return r.integrity&&(l.integrity=r.integrity),r.referrerPolicy&&(l.referrerPolicy=r.referrerPolicy),r.crossOrigin==="use-credentials"?l.credentials="include":r.crossOrigin==="anonymous"?l.credentials="omit":l.credentials="same-origin",l}function s(r){if(r.ep)return;r.ep=!0;const l=o(r);fetch(r.href,l)}})();const P=(e,t,o,s)=>o*((e=e/s-1)*e*e*e*e+1)+t;function A(e,t,o){const s=Date.now(),r=e[t],l=o-r,c=1e3;let E=!1;const b=()=>{const g=Date.now()-s,q=g/c;if(!E){if(q>1){S();return}e[t]=P(g,r,l,c),requestAnimationFrame(b)}},u=()=>{E=!0,S()},S=()=>{e.removeEventListener("wheel",u),e.removeEventListener("touchstart",u)};return e.addEventListener("wheel",u,{passive:!0}),e.addEventListener("touchstart",u,{passive:!0}),b(),u}function I(){let e=!1;try{document.createElement("div").scrollTo({top:0,get behavior(){return e=!0,"smooth"}})}catch{}return e}const O=I();function w(e,t,o){return O?e.scrollTo({[o?"left":"top"]:t,behavior:"smooth"}):A(e,o?"scrollLeft":"scrollTop",t)}function T(e,t){let o;return()=>{clearTimeout(o),o=setTimeout(()=>{o=null,e()},t)}}window.addEventListener("touchstart",function e(){document.body.classList.add("touch"),window.removeEventListener("touchstart",e,!1)},!1);const f=document.querySelector(".rzt-slider"),a=document.querySelector(".rzt-slider .slider"),h=document.querySelectorAll(".indicator-button"),n=document.querySelector(".scroll"),i=document.querySelectorAll(".scroll-item").length,y=document.querySelectorAll(".carousel-controls button"),m=y[0],p=y[1],v=document.querySelector("#stop-button");let d;function D(){if(h===null||n===null)return;L(),M(),W(),h.forEach((t,o)=>{t.addEventListener("click",s=>{s.preventDefault(),s.stopPropagation();const r=Math.floor(n.scrollWidth*(o/i));w(n,r,!0)})});let e;y.forEach(t=>{t.addEventListener("click",o=>{o.preventDefault(),o.stopPropagation(),t.id==="btn-next"?(m.hidden=!1,e=Math.floor(n.scrollLeft+n.scrollWidth/i)):(p.hidden=!1,e=Math.floor(n.scrollLeft-n.scrollWidth/i)),w(n,e,!0)})}),n.addEventListener("scroll",T(()=>{let t=Math.round(n.scrollLeft/n.scrollWidth*i);t+1===i?p.hidden=!0:p.hidden=!1,t!==0?m.hidden=!1:m.hidden=!0},200))}function L(){if(f===null||!f.dataset.autoplay)return;let e;d=setInterval(()=>{n!==null&&(e=Math.floor(n.scrollLeft+n.scrollWidth/i),n.scrollWidth===e&&(f.dataset.infinite||clearInterval(d)),n.scrollTo({left:e,behavior:"smooth"}))},Number(f.dataset.autoplaySpeed))}function M(){h!==null&&h.forEach((e,t)=>{e.setAttribute("aria-label",`Scroll to item #${t+1}`)})}function W(){a&&(a.addEventListener("focus",function(){clearInterval(d)}),a.addEventListener("mouseenter",function(){clearInterval(d)}),a.addEventListener("blur",function(){L()}),a.addEventListener("mouseleave",function(){L()}),v!=null&&v.addEventListener("click",()=>{clearInterval(d)}))}D();
