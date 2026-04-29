const CACHE_VERSION = 'orcholog-v2';
const APP_SHELL_CACHE = `${CACHE_VERSION}-shell`;
const RUNTIME_CACHE = `${CACHE_VERSION}-runtime`;

const APP_SHELL = [
    '/',
    '/offline.html',
    '/manifest.json',
    '/css/style.css',
    '/icons/pwa-192.png',
    '/icons/pwa-512.png',
    '/icons/list2.svg',
    '/icons/homeW.svg',
    '/icons/plus2.svg',
    '/icons/drop.svg',
    '/js/pwa.js',
    '/storage/bootstrap-5.0.2-dist/css/bootstrap.css',
    '/storage/bootstrap-5.0.2-dist/js/bootstrap.bundle.js',
    '/storage/bootstrap-5.0.2-dist/js/jquery-3.7.1.slim.js'
];

self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(APP_SHELL_CACHE)
            .then((cache) => Promise.all(
                APP_SHELL.map((url) => cache.add(url).catch(() => null))
            ))
            .then(() => self.skipWaiting())
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys()
            .then((keys) => Promise.all(
                keys
                    .filter((key) => ![APP_SHELL_CACHE, RUNTIME_CACHE].includes(key))
                    .map((key) => caches.delete(key))
            ))
            .then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', (event) => {
    const request = event.request;
    const url = new URL(request.url);

    if (request.method !== 'GET' || url.origin !== self.location.origin) {
        return;
    }

    if (request.mode === 'navigate') {
        event.respondWith(networkFirst(request));
        return;
    }

    event.respondWith(cacheFirst(request));
});

async function networkFirst(request) {
    const cache = await caches.open(RUNTIME_CACHE);

    try {
        const response = await fetch(request);
        cache.put(request, response.clone());
        return response;
    } catch (error) {
        return await cache.match(request)
            || await caches.match('/offline.html');
    }
}

async function cacheFirst(request) {
    const cachedResponse = await caches.match(request);

    if (cachedResponse) {
        return cachedResponse;
    }

    const response = await fetch(request);

    if (response && response.ok) {
        const cache = await caches.open(RUNTIME_CACHE);
        cache.put(request, response.clone());
    }

    return response;
}
