// Service Worker с стратегией Cache First
const staticCacheName = 's-app-v1';

const assetUrls = [
    'index.html',
    'app.js',
    'style.css'
];

self.addEventListener('install', async event => {
    const cache = await caches.open(staticCacheName);
    await cache.addAll(assetUrls);

    // Альтернативный вариант с event.waitUntil:
    // event.waitUntil(
    //     caches.open(staticCacheName).then(cache => cache.addAll(assetUrls))
    // );
});

self.addEventListener('activate', event => {
    // Здесь должна быть логика очистки старых кэшей
});

self.addEventListener('fetch', event => {
    console.log('Fetch', event.request.url);
    event.respondWith(cacheFirst(event.request));
});

async function cacheFirst(request) {
    const cached = await caches.match(request);
    return cached ?? await fetch(request);
}