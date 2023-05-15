import { smoothScroll, debounce } from './smothscroll';

// Touch detection
window.addEventListener('touchstart', function touched() {
  document.body.classList.add('touch');
  window.removeEventListener('touchstart', touched, false);
}, false);


const slider: HTMLElement | null = document.querySelector('.rzt-slider');
const carousel: HTMLElement | null = document.querySelector('.rzt-slider .slider');
const indicators: NodeListOf<HTMLElement> | null  = document.querySelectorAll('.indicator-button');
// const indicatorText: NodeListOf<HTMLElement> = document.querySelectorAll('.indicator-button .visuallyhidden');
const scroller:  HTMLElement | null = document.querySelector('.scroll')
const numberOfImages: number = document.querySelectorAll('.scroll-item').length
const arrows: NodeListOf<HTMLElement> = document.querySelectorAll('.carousel-controls button')
const arrowLeft: HTMLElement = arrows[0]
const arrowRight: HTMLElement = arrows[1]
const stopBtn = document.querySelector('#stop-button');

let interVal: ReturnType<typeof setTimeout>;

function initSlider () {
  if (indicators === null || scroller === null) return;

  autoPlay();
  addListeners();

  indicators.forEach((indicator, i) => {
    indicator.addEventListener('click', e => {
        e.preventDefault()
        e.stopPropagation()

        const scrollLeft = Math.floor(scroller.scrollWidth * (i / numberOfImages))
        smoothScroll(scroller, scrollLeft, true)
    })
  })


  let scrollDirection;
  arrows.forEach((arrow) => {
    arrow.addEventListener('click', e => {
        e.preventDefault()
        e.stopPropagation()
        setAriaPressed(Math.round((scroller.scrollLeft / scroller.scrollWidth) * numberOfImages));

        if (arrow.id === 'btn-next') {
            arrowLeft.hidden = false;
            scrollDirection = Math.floor(scroller.scrollLeft + (scroller.scrollWidth / numberOfImages))
        }
        else {
            arrowRight.hidden = false;
            scrollDirection = Math.floor(scroller.scrollLeft - (scroller.scrollWidth / numberOfImages))
        }

        smoothScroll(scroller, scrollDirection, true)
    })
  })

  scroller.addEventListener('scroll', debounce(() => {
    let index = Math.round((scroller.scrollLeft / scroller.scrollWidth) * numberOfImages)
    setAriaPressed(index)

    if ((index + 1) === numberOfImages) {
        arrowRight.hidden = true
    } else {
        arrowRight.hidden = false
    }
    if (index !== 0) {
        arrowLeft.hidden = false
    } else {
        arrowLeft.hidden = true
    }
  }, 200))
}

function autoPlay () {
  if (slider === null) return
  if (!slider.dataset.autoplay) return;

  let autoplayDirection
  interVal = setInterval(() => {
    if (scroller === null) return
      autoplayDirection = Math.floor(scroller.scrollLeft + (scroller.scrollWidth / numberOfImages))

      if (scroller.scrollWidth === autoplayDirection) {
          slider.dataset.infinite ? '' : clearInterval(interVal)

          // @TODO Implement inifinite loop or direction reverse - Low prio
          // autoplayDirection = Math.floor(scroller.scrollLeft - (scroller.scrollWidth / numberOfImages))

      }

      scroller.scrollTo({
          ['left']: autoplayDirection,
          behavior: 'smooth'
      })
  }, Number(slider.dataset.autoplaySpeed))
}

function setAriaPressed(index: number) {
  if (indicators === null) return;
  indicators.forEach((indicator, i) => {
      indicator.setAttribute('aria-pressed', i === index ? 'true' : 'false')
  })
}

function addListeners() {
  if (!carousel) return;

  carousel.addEventListener('focus', function () {
    clearInterval(interVal);
  });
  carousel.addEventListener('mouseenter', function () {
    clearInterval(interVal);
  });


  carousel.addEventListener('blur', function () {
    autoPlay()
  });
  carousel.addEventListener('mouseleave', function () {
    autoPlay()
  });

  if (stopBtn !== null && stopBtn !== undefined) {
    stopBtn.addEventListener('click', () => {
        clearInterval(interVal);
    });
  }
}

export { initSlider };
