function validateForm() {
  const nama = document.getElementById("nama").value.trim();         // Ambil dan bersihkan nama
  const cabang = document.getElementById("cabang").value;            // Ambil pilihan cabang
  const dewasa = parseInt(document.getElementById("dewasa").value); // Ambil jumlah tiket dewasa
  const anak = parseInt(document.getElementById("anak").value);     // Ambil jumlah tiket anak
  const tanggal = document.getElementById("tanggal").value;         // Ambil tanggal kunjungan

  // Validasi: nama, cabang, tanggal harus diisi, dan minimal ada 1 tiket dipesan
  if (!nama || !cabang || !tanggal || (dewasa + anak) === 0) {
    alert("Lengkapi semua data dan isi minimal 1 tiket!");
    return false; // Cegah form dikirim
  }

  return true; // Form valid, boleh dikirim
}
