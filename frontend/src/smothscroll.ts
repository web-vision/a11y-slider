// via https://github.com/tootsuite/mastodon/blob/f59ed3a4fafab776b4eeb92f805dfe1fecc17ee3/app/javascript/mastodon/scroll.js
const easingOutQuint = (t: number, b: number, c: number, d: number) =>
  c * ((t = t / d - 1) * t * t * t * t + 1) + b

function smoothScrollPolyfill(node: any, key: any, target: any) {
  const startTime: number = Date.now()
  type target = typeof target;
  type node = typeof node;
  type key = typeof key;

  const offset = node[key]
  const gap = target - offset
  const duration = 1000
  let interrupt = false

  const step = () => {
      const elapsed = Date.now() - startTime
      const percentage = elapsed / duration

      if (interrupt) {
          return
      }

      if (percentage > 1) {
          cleanup()
          return
      }

      node[key] = easingOutQuint(elapsed, offset, gap, duration)
      requestAnimationFrame(step)
  }

  const cancel = () => {
      interrupt = true
      cleanup()
  }

  const cleanup = () => {
      node.removeEventListener('wheel', cancel)
      node.removeEventListener('touchstart', cancel)
  }

  node.addEventListener('wheel', cancel, { passive: true })
  node.addEventListener('touchstart', cancel, { passive: true })

  step()

  return cancel
}

function testSupportsSmoothScroll() {
  let supports = false
  try {
      let div = document.createElement('div')
      div.scrollTo({
          top: 0,
          // @ts-ignore
          get behavior() {
              supports = true
              return 'smooth'
          }
      })
  } catch (err) { } // Edge throws an error
  return supports
}

const hasNativeSmoothScroll = testSupportsSmoothScroll()

function smoothScroll(node: any, topOrLeft: any, horizontal: any) {
  if (hasNativeSmoothScroll) {
      return node.scrollTo({
          [horizontal ? 'left' : 'top']: topOrLeft,
          behavior: 'smooth'
      })
  } else {
      return smoothScrollPolyfill(node, horizontal ? 'scrollLeft' : 'scrollTop', topOrLeft)
  }
}

function debounce (func: any, ms: number) {
  let timeout: any;
  return () => {
        // @ts-ignore
      clearTimeout(timeout)
      timeout = setTimeout(() => {
          timeout = null
          func()
      }, ms)
  }
}

export { smoothScroll, debounce };
