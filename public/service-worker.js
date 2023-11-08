// service-worker.js

const CACHE_NAME = 'my-cache';

// Inisialisasi Service Worker
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        return cache.addAll([
          '/css/',
          '/js/',
          // Daftar sumber daya lain yang ingin di-cache
        ]).catch((error) => {
          console.error('Gagal menambahkan sumber daya ke dalam cache:', error);
        });
      })
  );
});

// Hapus cache lama jika ada perubahan dalam file cache
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((name) => {
          if (name !== CACHE_NAME) {
            return caches.delete(name);
          }
        })
      );
    })
  );
});

// Event listener untuk mengintersep dan mengelola permintaan fetch
self.addEventListener('fetch', (event) => {
  event.respondWith(
    fetch(event.request) // Coba cari sumber daya dari jaringan terlebih dahulu
      .then((response) => {
        // Jika permintaan berhasil, simpan sumber daya yang baru di-cache
        const clonedResponse = response.clone();
        caches.open(CACHE_NAME)
          .then((cache) => {
            cache.put(event.request, clonedResponse);
          });
        return response;
      })
      .catch(() => {
        // Jika permintaan gagal, cari sumber daya dari cache
        return caches.match(event.request);
      })
  );
});