NexaWP Theme — DETAILED CHANGELOG

Version: 1.0.3
Date: 2026-01-03

Perubahan utama (Perbaikan di versi 1.0.3):
- Menambahkan aturan CSS layout untuk sidebar (`left` / `right` / `no-sidebar`) dan responsive collapse (file: `assets/css/layout.css`).
- Memperbaiki kegagalan patch CSS sebelumnya sehingga layout sidebar sekarang berfungsi sesuai harapan.
- Memperbarui versi tema menjadi `1.0.3`.
- Memastikan autoloader PSR-like dan require eksplisit bekerja untuk mencegah error "class not found" pada aktivasi tema.
- Memperbaiki beberapa error sintaksis:
  - Menutup kurung kurawal yang hilang di `inc/Core/Assets.php`.
  - Menghapus token stray yang menyebabkan parse error di `inc/Core/Setup.php`.
- Mengganti `theme.json` kosong dengan JSON valid untuk menghilangkan notice/percobaan decode yang gagal.
- Penyempurnaan enqueue: expose lebih banyak Customizer values sebagai CSS variables (header/footer/logo) dan penambahan skrip kecil `back-to-top.js`.

Ringkasan fitur di versi sebelumnya (1.0.2):
- Struktur dasar dan arsitektur:
  - Namespace-based class files (`NexaWP\*`) dengan autoloader ringan dan fallback `require`.
  - Target PHP 8.0+ dan WordPress 6.2+.
- Customizer:
  - Panel Header Builder (Above / Primary / Below) — background, border, padding, toggle enable/disable.
  - Panel Footer Builder — copyright text, enable footer widgets, columns (1–6), footer width (full/boxed), Back-to-Top toggle.
  - `Logo Width` control ditambahkan ke Site Identity.
- Frontend & Templates:
  - Header rendering dengan lokasi menu terpisah: `above`, `primary`, `below` (menghindari duplikasi menu).
  - Footer widget areas terdaftar (up to 6) dan dirender dinamis dengan ARIA roles.
  - Back-to-Top button (skrip ringan) dan basic page templates (`page.php`, `templates/content-page.php`).
- Sidebar & Layout:
  - Registrasi primary sidebar (`sidebar-1`) dan per-page sidebar meta (post meta + Editor plugin panel).
  - Editor script `assets/js/editor-page-sidebar.js` untuk mengatur sidebar per-halaman melalui Block Editor.
- Compatibility & Accessibility:
  - WooCommerce basic support enabled in `inc/Core/Setup.php`.
  - Selective refresh partials untuk branding/header/footer di Customizer.
  - Sanitasi input Customizer menggunakan callbacks WP core (`absint`, `sanitize_hex_color`, `wp_kses_post`).

Petunjuk singkat untuk pengujian setelah update:
1. Aktifkan tema, buka Customizer: periksa Header & Footer panels dan set `Logo Width`.
2. Tambah widget ke Appearance → Widgets → Footer 1..6 dan cek grid pada frontend.
3. Atur per-page sidebar melalui dokumen editor (panel "Sidebar" di block editor) dan verifikasi layout left/right/no-sidebar.
4. Jika ada error PHP, kirimkan `wp-content/debug.log` agar saya bisa bantu analisa.

File yang diubah pada rilis ini:
- `style.css` (Version → 1.0.3)
- `assets/css/layout.css` (sidebar layout/responsive rules)
- `inc/Core/Assets.php`, `inc/Core/Setup.php` (perbaikan sintaksis dan enqueue)
- `README.txt` (changelog dan instruksi ini)

Butuh bantuan selanjutnya?
- Saya bisa menyiapkan changelog versi singkat untuk distribusi, membuat unit test PHP basic, atau melakukan polishing CSS untuk kompatibilitas tema anak.

Terima kasih — beri tahu saya jika mau saya commit perubahan ini atau mengekspor changelog ke format lain.
