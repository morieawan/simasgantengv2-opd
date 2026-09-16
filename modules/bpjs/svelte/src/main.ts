import App from './App.svelte'
import { push } from 'svelte-spa-router'

const target = document.getElementById('svelte-content-root')

if (target) {
  const initialRoute = target.dataset.initialRoute || '/bulanan'

  // Clear elemen pendukung di Yii2
  target.innerHTML = ''

  // 1. Mount komponen Svelte lebih dulu
  const app = new App({
    target: target
  })

  // 2. Arahkan router internal Svelte ke rute awal jika hash masih kosong
  if (!window.location.hash || window.location.hash === '#/') {
    push(initialRoute)
  }
}