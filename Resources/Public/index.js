const A=function(){const t=document.createElement("link").relList;if(t&&t.supports&&t.supports("modulepreload"))return;for(const r of document.querySelectorAll('link[rel="modulepreload"]'))s(r);new MutationObserver(r=>{for(const l of r)if(l.type==="childList")for(const i of l.addedNodes)i.tagName==="LINK"&&i.rel==="modulepreload"&&s(i)}).observe(document,{childList:!0,subtree:!0});function o(r){const l={};return r.integrity&&(l.integrity=r.integrity),r.referrerpolicy&&(l.referrerPolicy=r.referrerpolicy),r.crossorigin==="use-credentials"?l.credentials="include":r.crossorigin==="anonymous"?l.credentials="omit":l.credentials="same-origin",l}function s(r){if(r.ep)return;r.ep=!0;const l=o(r);fetch(r.href,l)}};A();const I=(e,t,o,s)=>o*((e=e/s-1)*e*e*e*e+1)+t;function T(e,t,o){const s=Date.now();console.log(o,e,t);const r=e[t],l=o-r,i=1e3;let E=!1;const S=()=>{const g=Date.now()-s,q=g/i;if(!E){if(q>1){b();return}e[t]=I(g,r,l,i),requestAnimationFrame(S)}},u=()=>{E=!0,b()},b=()=>{e.removeEventListener("wheel",u),e.removeEventListener("touchstart",u)};return e.addEventListener("wheel",u,{passive:!0}),e.addEventListener("touchstart",u,{passive:!0}),S(),u}function D(){let e=!1;try{document.createElement("div").scrollTo({top:0,get behavior(){return e=!0,"smooth"}})}catch{}return e}const M=D();function w(e,t,o){return M?e.scrollTo({[o?"left":"top"]:t,behavior:"smooth"}):T(e,o?"scrollLeft":"scrollTop",t)}function P(e,t){let o;return()=>{clearTimeout(o),o=setTimeout(()=>{o=null,e()},t)}}window.addEventListener("touchstart",function e(){document.body.classList.add("touch"),window.removeEventListener("touchstart",e,!1)},!1);const f=document.querySelector("#rzt-slider"),a=document.querySelector("#rzt-slider .slider"),h=document.querySelectorAll(".indicator-button"),n=document.querySelector(".scroll"),c=document.querySelectorAll(".scroll-item").length,m=document.querySelectorAll(".carousel-controls button"),p=m[0],v=m[1],L=document.querySelector("#stop-button");let d;function W(){if(h===null||n===null)return;y(),N(),O(),h.forEach((t,o)=>{t.addEventListener("click",s=>{s.preventDefault(),s.stopPropagation();const r=Math.floor(n.scrollWidth*(o/c));w(n,r,!0)})});let e;m.forEach(t=>{t.addEventListener("click",o=>{o.preventDefault(),o.stopPropagation(),t.id==="next"?(p.hidden=!1,e=Math.floor(n.scrollLeft+n.scrollWidth/c)):(v.hidden=!1,e=Math.floor(n.scrollLeft-n.scrollWidth/c)),w(n,e,!0)})}),n.addEventListener("scroll",P(()=>{let t=Math.round(n.scrollLeft/n.scrollWidth*c);t+1===c?v.hidden=!0:v.hidden=!1,t!==0?p.hidden=!1:p.hidden=!0},200))}function y(){if(f===null||!f.dataset.autoplay)return;let e;d=setInterval(()=>{n!==null&&(e=Math.floor(n.scrollLeft+n.scrollWidth/c),n.scrollWidth===e&&(f.dataset.infinite||clearInterval(d)),n.scrollTo({left:e,behavior:"smooth"}))},Number(f.dataset.autoplaySpeed))}function N(){h!==null&&h.forEach((e,t)=>{e.setAttribute("aria-label",`Scroll to item #${t+1}`)})}function O(){!a||(a.addEventListener("focus",function(){clearInterval(d)}),a.addEventListener("mouseenter",function(){clearInterval(d)}),a.addEventListener("blur",function(){y()}),a.addEventListener("mouseleave",function(){y()}),L!=null&&L.addEventListener("click",()=>{clearInterval(d)}))}W();