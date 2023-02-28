self.addEventListener('install', function (event) {
    console.log('Service worker installed');
});

self.addEventListener('activate', function (event) {
    console.log('Service worker activated');
});

self.addEventListener('fetch', function (event) {
    // console.log('Service worker fetching:', event.request.url);
    event.respondWith(fetch(event.request));
});